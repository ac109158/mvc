<div id="slider_wrapper">
<?php
$slider =file_get_contents('slider.php');
echo $slider;
?>
</div>
<div id="chat_wrappper">
<?php require VIEW. 'pusher.php';  ?>	
</div>
<div id="bottom_spacer">
	
</div>
<div id="footer">
	<center><em>Display motivational quotes, Agent Focus, 5 things, Principles of the Plus One Method Here..........<em></center>
</div>
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