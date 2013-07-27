<div id="dashboard_wrapper">
	<div id="dashboard_top">	
		<div id="dashboard_group_chat_panel">
		<?php require_once('chat-widget/chat.php');?>	
		</div>	
		
		<div id="dashboard_main_panel_wrapper">	
		</div> <?php // end of dashboard_main_panel_wrapper ?>		
			
		<div id="dashboard_options_panel"> </div> <?php // end of dashboard_side_panel ?>
		
		<div id="dashboard_side_panel">
			<div id="side_panel_content">
				<div id="side_panel_info_panel">
					<?php echo $_SESSION['name_of_user'] ?>			
				</div>		
				<div id="side_panel_notify_panel">
					<?php require_once 'inc/notify.php';  ?>			
				</div>
				<div id="side_panel_stream_panel">
					<?php require_once 'inc/activity_stream.php';  ?>		
				</div>
			</div> <?php //end of side_panel_content ?>
		</div> <?php //end of dashboard_side _panel; ?>
		
		<div id="side_panel_chat_wrapper"><?php require VIEW. 'pusher.php';  ?>
	</div>	<?php // end of dashboard_top ?>
</div> <?php //end of dashbaord_wrapper ?>


<div id="dashboard_bottom">
	
</div><?php //end of dashboard _bottom ?>

    
<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="http://js.pusher.com/2.1/pusher.min.js"></script>
<link href="css/chat-style.css" rel="stylesheet">
<script src="scripts/PusherNotifier.js"></script>
<script src="scripts/jquery.pusherchat.js" type="text/javascript"></script>
<script>
var pusher = new Pusher('71d3c4ea25f712272ad3');
var channel = pusher.subscribe('all');
var notifier = new PusherNotifier(channel);
var channel2 = pusher.subscribe('shared');
var notifier2 = new PusherNotifier(channel2);
var channel3 = pusher.subscribe('group_chat');
var notifier3 = new PusherNotifier(channel3);

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
    var objDiv =document.getElementsByClassName("pusher-chat-widget-messages");
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


