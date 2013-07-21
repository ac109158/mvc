<div id="dashboard_wrapper">
<div id="dashboard_top">
	<div id="dashboard_main_panel_wrapper">	
		<?php require 'inc/slider.php';  ?>	
	</div> <?php // end of dashboard_main_panel_wrapper ?>
		
	<div id="dashboard_options_panel">		
	</div> <?php // end of dashboard_side_panel ?>
	
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
		
	</div>
	<div id="side_panel_chat_wrapper">
			<?php require VIEW. 'pusher.php';  ?>
	</div>
	</div> <?php // end of dashboard_chat_box ?>
	
</div> <?php // end of dashboard_top ?>


<div id="dashboard_bottom">
	
</div><?php //end of dashboard _bottom ?>

<link rel="stylesheet" type="text/css" href="lib/gritter/css/jquery.gritter.css" />
    
<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="lib/gritter/js/jquery.gritter.min.js"></script>
<script src="http://js.pusher.com/2.1/pusher.min.js"></script>
<script src="scripts/PusherNotifier.js"></script>
<script>
var pusher = new Pusher('71d3c4ea25f712272ad3');
var channel = pusher.subscribe('all');
var notifier = new PusherNotifier(channel);
var channel2 = pusher.subscribe('shared');
var notifier2 = new PusherNotifier(channel2);

</script>
	
</div> <?php // end of dashboard_wrapper ?>


</script>

