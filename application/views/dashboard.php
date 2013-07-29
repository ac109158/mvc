<?php require_once VIEW. "header-dash.php" ?>

<div id="slider_wrapper"> <?php require_once('inc/slider.php')?></div>

    
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
        'friendsList' : 'ajax/friends-list.json',
        'serverPath' : 'index.php?controller=ajax&task=pusher_server',
        'profilePage':true,
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
    }
});
   </script>


