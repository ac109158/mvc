<div id="stream-widget">
<div id="stream-title">
Activity Stream
</div>
<div id="stream-body">
<ul id="activity_stream" class="activity-stream no-actions"></ul>
</div>
</div>
    
    <!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
    <!--
<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script src="http://js.pusher.com/2.1/pusher.min.js"></script>    
    <script src="scripts/ExampleActivities.js"></script>
-->
    <script src="scripts/PusherActivityStreamer.js"></script>
    <script>
      $(function() {
        
        var pusher = new Pusher('<?php echo APP_KEY; ?>')
        var activityChannel = pusher.subscribe('all');
        //activityChannel = pusher.subscribe('shared');
        var activityMonitor = new PusherActivityStreamer(activityChannel, "#activity_stream");
        
        var activityChannel = pusher.subscribe('shared');
        var activityMonitor = new PusherActivityStreamer(activityChannel, "#activity_stream");
        
        //var examples = new ExampleActivities(activityMonitor, pusher);
        
        });
   </script>
