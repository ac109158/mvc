<div id="stream-widget">
<div id="stream-body">
<ul id="activity_stream" class="activity-stream"></ul>
</div>
</div>
    
<script>
var stream_history = <?php echo json_encode($vars['stream_history']); ?>;

function buildHistoryStreamItem (data) {
	var time = '<div class="activity-row"><a href="' + data.link + '" class="stream-timestamp"><span title="' + data.published + '">' + data.published + '</span>' +
	'</a><span class="activity-actions"><span class="tweet-action action-favorite"><a href="#" class="stream-like-action" data-activity="like" title="Like"><span><i></i><b>Like</b></span></a></span></span></div>';
	
	var message = '<div class="activity-row"><div class="text">' + data.body + '</div></div>';
	
	var user = '<div class="activity-row"><span class="user-name"><a class="screen-name" title="' + data.actor.displayName + '">' + data.actor.displayName + '</a></span></div>';
	
	var content = '<div class="content">' + user + message + time + '</div>';
	
	var imageInfo =data.actor.image;
	var image = '<div class="image"><img src="' + imageInfo.url + '" width="' + imageInfo.width + '" height="' + imageInfo.height + '" /></div>';
	
	var item = '<li class="activity" data-activity-id = "' + data.id +'"><div class="stream-item-content">' + image + content + '</div></li>';   
	return item;
	};

function fetchStreamHistory(stream_history) {
	messageList = [];
	$.each(stream_history, function (i, elem) {
			 var pic = {url : 'http://www.gravatar.com/avatar/00000000000000000000000000000000?d=wavatar&s=48', width : 40, height : 40 };
			var author = {displayName : elem[2], objectType :  'person',  image : pic};
			var data = { id : elem[0], body : elem[3], published : elem[4], type : 'chat-message', actor : author};
			var messageEl = buildHistoryStreamItem(data);
			messageList.push(messageEl);
	    });
	   return  messageList;
	   };	   
	var $history = fetchStreamHistory(stream_history);
	$('#activity_stream').append($history);
	
</script>
<script src="scripts/PusherActivityStreamer.js"></script>
<script>
    
    var pusher = new Pusher('<?php echo APP_KEY; ?>');
    var activityChannels = Array;
    var $ch1 = pusher.subscribe('all');
    var $ch2 = pusher.subscribe('shared');
    var $ch3 = pusher.subscribe('shift');
    activityChannels[0] =$ch1;
    activityChannels[1] = $ch2;
    activityChannels[2] = $ch3;
    var activityMonitor = new PusherActivityStreamer(activityChannels, "#activity_stream");    
</script>