<?php require_once VIEW. "header-dash.php" ?>

<div id="slider_wrapper"> <?php require_once('inc/slider.php')?>
<div id="side_panel_chat_wrapper"><?php require_once  VIEW .'pusher.php'?></div>
</div>


    
<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<link href="css/chat-style.css" rel="stylesheet">
 
<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<!-- Include Gritter Css for real time notifications -->
<link rel="stylesheet" type="text/css" href="lib/gritter/css/jquery.gritter.css" />
<script src="lib/gritter/js/jquery.gritter.min.js"></script>
<script src="scripts/PusherNotifier.js"></script>
<script src="scripts/jquery.pusherchat.js" type="text/javascript"></script>
<script>
var message_history = <?php echo json_encode($vars['message_history']); ?>;
$("#notify-body").hide();
$("#dashboard_group_chat_panel").toggle();
$("#stream-widget").toggle();
$("#dashboard_chat_widget_panel").hide();
/*
var message_data = message_history.pop();
var author = {displayName : message_data[1], objectType :  'person',  image : null};
var data = { id : message_data[0], body : message_data[2], published : message_data[3], type : 'chat-message', actor : author};
 $.each(data, function(key, element) {
    alert('key: ' + key + '\n' + 'value: ' + element);
});
*/
</script>
<script src="chat-widget/js/PusherChatWidget.js"></script>
<script>
var pusher = new Pusher('71d3c4ea25f712272ad3');
var channel = pusher.subscribe('all');
var notifier = new PusherNotifier(channel);
var channel2 = pusher.subscribe('shared');
var notifier2 = new PusherNotifier(channel2);
var channel3 = pusher.subscribe('group_chat');
var notifier3 = new PusherNotifier(channel3);
 var chatWidget = new PusherChatWidget(pusher, {
  appendTo: '#dashboard_group_chat_panel',
  maxItems: 50,
});
/* $("#dashboard_chat_widget_panel").slideToggle(); */

 

  </script>
	

</script>



<script type="text/javascript">
    var id = "<?php echo $_SESSION['user_id']; ?>";
    //var id = getUrlVars()['user_id'];
    var name = "<?php echo $_SESSION['name_of_user']; ?>";
    //var name = getUrlVars()['name'];

    if (id=="undefined") {
        id="";
    } else $('#user_'+id).hide();
    if (name=="undefined") name="";
    if (!id) $('#pusherChat').remove();
    /*
* this part is only for demo you don't need this
*/
</script>

<script>
    $.fn.pusherChat({
        'pusherKey':'71d3c4ea25f712272ad3',
        'authPath':'index.php?controller=ajax&task=pusher_auth&user_id='+id+'&name='+name,
/*         'friendsList' : 'ajax/friends-list.json', */
        'friendsList' : '?controller=ajax&task=chat_list',
        'serverPath' : 'index.php?controller=ajax&task=pusher_server',
        'profilePage':false,
        'onFriendConnect': function(member){
            if (member.id) $('#user_'+member.id).hide();
            if (!$('.account a:visible').html()) $('.hide').show();
        },
        'onFriendLogOut': function(member){
            if (member.id) $('#user_'+member.id).show();
            if ($('.account a:visible').html()) $('.hide').hide();
        },
        'onSubscription':function(members){
            if ($('.account a:visible').html()) $('.hide').hide();
            $.each(members._members_map, function(val){
                $('#user_'+val).hide();
            });
        }
    });
</script>
<script>
  var NOTIFY_ENDPOINT = "index.php?controller=ajax&task=notify_endpoint";
  $(function() {
    $(".notify").click(handleNotifyButtonClick);
  });
  function handleNotifyButtonClick()
  {
   if ( $('#channel').val() == "")
   {
   $('#channel').css('border','2px solid red');
   }
   else
   {
   $('#channel').css('border','0px');
   }
  
   if ( $('#method').val() == "")
   {
   $('#method').css('border','2px solid red');
   }
   else
   {
   $('#method').css('border','0px');
   }
    var message = $.trim($("#notifyMessage").val());
    var name = $("#name").val();
    var method = $("#method").val();
    var frequency = $("#channel").val();
    if(message)
    {
$.ajax({
url: NOTIFY_ENDPOINT,
data: {"message": message, 'channel': frequency, 'method' : method, 'name' : name}	
      });
      $('#channel').val('Channel...');
      $('#method').val('Method...');
      $('#name').val('<?php echo $_SESSION['name_of_user']?>');
    }
  };
</script>
    <script>
$(document).keypress(function(event){

    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        $('#pusher-chat-widget-send-btn').click();  
        $(".chat-activity-stream").animate({ scrollTop: "5000px"}, 10);
        $('.chat-text').emoticonize({
					delay: 0,
					animate: true,
					//exclude: 'pre, code, .no-emoticons'
				});
    }
});
   </script>
   
    <script>
  $("#chat-title").click(function(){
	  $("#dashboard_group_chat_panel").slideToggle();
    });
</script>
<script>
  $("#notify-title").click(function(){
	  $("#notify-body").slideToggle();
    });
</script>
<script>
  $("#stream-title").click(function(){
	  $("#stream-widget").slideToggle();
    });
</script>
 <script>
  $("#group").click(function(){
	  $("#dashboard_chat_widget_panel ").toggle();
    });
</script>


<script type="text/javascript">

function handle_mousedown(e){
    window.my_dragging = {};
    my_dragging.pageX0 = e.pageX;
    my_dragging.pageY0 = e.pageY;
    my_dragging.elem = this;
    my_dragging.offset0 = $(this).offset();
    function handle_dragging(e){
        var left = my_dragging.offset0.left + (e.pageX - my_dragging.pageX0);
        var top = my_dragging.offset0.top + (e.pageY - my_dragging.pageY0);
        $(my_dragging.elem)
        .offset({top: top, left: left});
    }
    function handle_mouseup(e){
        $('body')
        .off('mousemove', handle_dragging)
        .off('mouseup', handle_mouseup);
    }
    $('body')
    .on('mouseup', handle_mouseup)
    .on('mousemove', handle_dragging);
}
$('#').mousedown(handle_mousedown);


</script>
<script>
$("#dashboard_chat_widget_panel").show();
</script>
<link href="css/jquery.cssemoticons.css" media="screen" rel="stylesheet" type="text/css" />
<script src="js/jquery.cssemoticons.min.js" type="text/javascript"></script>


<script> //date/Clock Widgit
document.querySelector(".date").addEventListener("mouseover", function(){
    var txt = document.querySelector(".date").innerHTML;
  var currentTime = new Date ( );    
  var currentHours = currentTime.getHours ( );   
  var currentMinutes = currentTime.getMinutes ( );   
  currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;   
  var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";    
  currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;    
  currentHours = ( currentHours == 0 ) ? 12 : currentHours;    
  var currentTimeString = currentHours + ":" + currentMinutes + " " + timeOfDay;       
    document.querySelector(".date").innerHTML = currentTimeString;
    this.addEventListener("mouseout", function(){
        document.querySelector(".date").innerHTML = txt;
    });
});
</script> 

<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
$("#side_panel").click(function () {
    $('#dashboard_side_panel').toggle("slide", {
        direction: "right"
    }, 500);
});
</script>



