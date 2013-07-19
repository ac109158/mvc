<div id="dashboard_wrapper">
<div id="dashboard_top">
	<div id="dashboard_main_panel_wrapper">	
		<?php require 'slider.php';  ?>	
	</div> <?php // end of dashboard_main_panel_wrapper ?>
		
	<div id="dashboard_options_panel">		
	</div> <?php // end of dashboard_side_panel ?>
	
	<div id="dashboard_side_panel">
	<div id="side_panel_content">
		<div id="side_panel_notify_panel">
			<?php require_once 'notify.php';  ?>			
		</div>
		<div id="side_panel_notify_panel">
			<?php require_once 'activity_stream.php';  ?>			
		</div>
		
	</div>
	<div id="side_panel_chat_wrapper">
			<?php require VIEW. 'pusher.php';  ?>
	</div>
	</div> <?php // end of dashboard_chat_box ?>
	
</div> <?php // end of dashboard_top ?>


<div id="dashboard_bottom">
	
</div><?php //end of dashboard _bottom ?>

<link rel="stylesheet" type="text/css" href="notifications/lib/gritter/css/jquery.gritter.css" />
    
<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="notifications/lib/gritter/js/jquery.gritter.min.js"></script>
<script src="http://js.pusher.com/2.1/pusher.min.js"></script>
<script src="notifications/js/PusherNotifier.js"></script>
<script>
var pusher = new Pusher('71d3c4ea25f712272ad3');
var channel = pusher.subscribe('my_notifications');
var notifier = new PusherNotifier(channel);
</script>
	
</div> <?php // end of dashboard_wrapper ?>



<script>
$(".notify").click(function() {
agents = []
$(".widgetContent").find('.slick_cell').each
var agents=[];
$('.widgetContent').find('.slick_cell').each(function(){
    agents.push(this.val());
});
alert(agents);
});


</script>

