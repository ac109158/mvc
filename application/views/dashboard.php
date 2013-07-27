<?php require_once VIEW. "header-dash.php" ?>

<div id="slider_wrapper"> <?php require_once('inc/slider.php')?></div>

    
<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="http://js.pusher.com/2.1/pusher.min.js"></script>
<script src="scripts/PusherNotifier.js"></script>
<script>
var pusher = new Pusher('71d3c4ea25f712272ad3');
var channel = pusher.subscribe('my_notifications');
var notifier = new PusherNotifier(channel);
</script>


