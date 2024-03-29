/**
 * Creates an instance of a PusherChatWidget, binds to a chat channel on the pusher instance and
 * and creates the UI for the chat widget.
 *
 * @param {Pusher} pusher The Pusher object used for the chat widget.
 * @param {Map} options A hash of key value options for the widget.
 */
function PusherChatWidget(pusher, options) {
  PusherChatWidget.instances.push(this);
  var self = this;
  
  this._pusher = pusher;
  this._autoScroll = true;
  
  options = options || {};
  this.settings = $.extend({
    maxItems: 50, // max items to show in the UI. Items beyond this limit will be removed as new ones come in.
    chatEndPoint: 'index.php?controller=ajax&task=pusher_chat', // the end point where chat messages should be sanitized and then triggered
    channelName: document.location.href, // the name of the channel the chat will take place on
    appendTo: document.body, // A jQuery selector or object. Defines where the element should be appended to
    debug: true
  }, options);
  
  if(this.settings.debug && !Pusher.log) {
    Pusher.log = function(msg) {
      if(console && console.log) {
        console.log(msg);
      }
    }
  }
  
  // remove any unsupported characters from the chat channel name
  // see: http://pusher.com/docs/client_api_guide/client_channels#naming-channels
  this.settings.channelName = PusherChatWidget.getValidChannelName(this.settings.channelName);
  
  this._chatChannel = this._pusher.subscribe(this.settings.channelName);
  
  this._chatChannel.bind('chat_message', function(data) {
    self._chatMessageReceived(data);
  })
    
  this._itemCount = 0;
  
  this._widget = PusherChatWidget._createHTML(this.settings.appendTo);
/*
  this._nicknameEl = this._widget.find('input[name=nickname]');
  this._emailEl = this._widget.find('input[name=email]');  
*/
  this._messageInputEl = this._widget.find('textarea');
  this._messagesEl = this._widget.find('.chat-activity-stream');  
  this._widget.find('button').click(function() {
    self._sendChatButtonClicked();
  })
  
  var messageEl = this._messagesEl;
  messageEl.scroll(function() {
    var el = messageEl.get(0);
    var scrollableHeight = (el.scrollHeight - messageEl.height());
    self._autoScroll = ( scrollableHeight === messageEl.scrollTop() );
  });
  
  this._startTimeMonitor();
};
PusherChatWidget.instances = [];

/* @private */
PusherChatWidget.prototype._chatMessageReceived = function(data) {
  var self = this;
  
  if(this._itemCount === 0) {
    this._messagesEl.html('');
  }
  
  var messageEl = PusherChatWidget._buildListItem(data);
  messageEl.hide();
  this._messagesEl.append(messageEl);
  messageEl.slideDown(function() {
    if(self._autoScroll) {
      var messageEl = self._messagesEl.get(0);
      var scrollableHeight = (messageEl.scrollHeight - self._messagesEl.height());
      $(self._messagesEl).animate({ scrollTop: $(self._messagesEl)[0].scrollHeight}, 400);
      //self._messagesEl.scrollTop(messageEl.scrollHeight);
    }
  });
  
  ++this._itemCount;
  
  if(this._itemCount > this.settings.maxItems) {
  	this._messagesEl.children(':first').remove();
  }
};
/* @private */
PusherChatWidget.prototype._sendChatButtonClicked = function() {
/*
  var nickname = $.trim(this._nicknameEl.val()); // optional
  var email = $.trim(this._emailEl.val()); // optional
  if(!nickname) {
    alert('please supply a nickname');
    return;
  }
  */
  var message = $.trim(this._messageInputEl.val());
  if(!message) {
    this._messageInputEl.css('border','2px solid red');
    return;
  }
  else 
  {
	  this._messageInputEl.css('border','1px solid grey');
	  this._messageInputEl.val(' ');
  }

  var chatInfo = {
    /* email: email, */
    text: message
  };
  this._sendChatMessage(chatInfo);
};

/* @private */
PusherChatWidget.prototype._sendChatMessage = function(data) {
  var self = this;
  
  this._messageInputEl.attr('readonly');
  $.ajax({
    url: this.settings.chatEndPoint,
    type: 'post',
    data: {
      'chat_info': data
    },
    complete: function(xhr, status) {
      Pusher.log('Chat message sent. Result: ' + status + ' : ' + xhr.responseText);
      if(xhr.status === 200) {
        self._messageInputEl.val('');
      }
      self._messageInputEl.removeAttr('readonly');
    },
    success: function(result) {
      var activity = result.activity;
      var imageInfo = activity.actor.image;
      var image = $('<div class="pusher-chat-widget-current-user-image">' +
                      '<img src="' + imageInfo.url + '" width="32" height="32" />' +
                    '</div>');
      var name = $('<div class="pusher-chat-widget-current-user-name">' + activity.actor.displayName + '</div>');
      var header = self._widget.find('.pusher-chat-widget-header');
      header.html(image).append(name);
    }
  })
};

/* @private */
PusherChatWidget.prototype._startTimeMonitor = function() {
  var self = this;
  
  setInterval(function() {
    self._messagesEl.children('.chat-activity').each(function(i, el) {
      var timeEl = $(el).find('a.timestamp span[data-activity-published]');
      var time = timeEl.attr('data-activity-published');
      var newDesc = PusherChatWidget.timeToDescription(time);
      timeEl.text(newDesc);
    });
  }, 10 * 1000)
};

/* @private */
PusherChatWidget._createHTML = function(appendTo) {
  var html = '' +
  '<div class="pusher-chat-widget">' +
  '<div id="chat-title">PlusOne Group Chat</div>' +
/*
'<div class="pusher-chat-widget-header">' +
'<label for="nickname">Name</label>' +
'<input type="text" name="nickname" />' +
'<label for="email" title="So we can look up your Gravatar">Email (optional)</label>' +
'<input type="email" name="email" />' +
'</div>' +
*/
    '<div id="pusher-chat-widget-messages"class="pusher-chat-widget-messages">' +
      '<ul class="chat-activity-stream">' +
        '<li class="waiting">No chat messages available</li>' +
      '</ul>' +
    '</div>' +
    '<div class="pusher-chat-widget-input">' +
      '<textarea name="message" id="chat-widget-message-box"></textarea>' +
      '<button class="pusher-chat-widget-send-btn" hidden="hidden" id="pusher-chat-widget-send-btn">Send</button>' +
    '</div>' +
/*
'<div class="pusher-chat-widget-footer">' +
'<a href="http://pusher.com">Pusher</a> powered realtime chat' +
'</div>' +
*/
  '</div>';
  var widget = $(html);
  $(appendTo).append(widget);
  return widget;
};



/* @private */
PusherChatWidget._buildListItem = function(activity) {
  var li = $('<li class="chat-activity"></li>');
  li.attr('data-activity-id', activity.id);
  var item = $('<div class="chat-stream-item-content"></div>');
  li.append(item);
  
  var imageInfo = activity.actor.image;
  var image = $('<div class="test"><div class="image">' +
                  '<img src="' + imageInfo.url + '" width="' + imageInfo.width + '" height="' + imageInfo.height + '" />' +
                '</div>');
  item.append(image);
  
  var content = $('<div class="chat-content"></div>');
  item.append(content);
  
  var user = $('<div class="chat-activity-row">' +
                '<span class="user-name">' +
                  '<a class="chat-screen-name" title="' + activity.actor.displayName + '">' + activity.actor.displayName + '</a>' +
                  //'<span class="full-name">' + activity.actor.displayName + '</span>' +
                '</span>' +
                 '<a ' + (activity.link?'href="' + activity.link + '" ':'') + ' class="timestamp">' +
                  '<span title="' + activity.published + '" data-activity-published="' + activity.published + '">' + PusherChatWidget.timeToDescription(activity.published) + '</span>' +
                '</a>' +
              '</div>');
  content.append(user);
  
  var message = $('<div class="chat-activity-row">' +
                    '<div class="chat-text">' + activity.body.replace(/\\('|&quot;)/g, '$1') + '</div>' +
                  '</div>');
  content.append(message);
  return li;
};


/**
 * converts a string into something which can be used as a valid channel name in Pusher.
 * @param {String} from The string to be converted.
 *
 * @see http://pusher.com/docs/client_api_guide/client_channels#naming-channels
 */
PusherChatWidget.getValidChannelName = function(from) {
  var pattern = /(\W)+/g;
  return from.replace(pattern, '-');
}

/**
 * converts a string or date parameter into a 'social media style'
 * time description.
 */
PusherChatWidget.timeToDescription = function(time) {
  if(time instanceof Date === false) {
    time = new Date(Date.parse(time));
  }
  var desc = "dunno";
  var now = new Date();
  var howLongAgo = (now - time);
  var seconds = Math.round(howLongAgo/1000);
  var minutes = Math.round(seconds/60);
  var hours = Math.round(minutes/60);
  if(seconds === 0) {
    desc = "just now";
  }
  else if(minutes < 1) {
    desc = seconds + " second" + (seconds !== 1?"s":"") + " ago";
  }
  else if(minutes < 60) {
    desc =  minutes + " minute" + (minutes !== 1?"s":"") + " ago";
  }
  else if(hours < 24) {
    desc = hours + " hour"  + (hours !== 1?"s":"") + " ago";
  }
  else {
    desc = time.getDay() + " " + ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"][time.getMonth()]
  }
  return desc;
};