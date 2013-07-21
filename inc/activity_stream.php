	<ul id="activity_stream" class="activity-stream no-actions"></ul>
            
    <?php require_once('config.php'); ?>
    
    <!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
    <script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script src="http://js.pusher.com/2.1/pusher.min.js"></script>
    <script src="stream/js/PusherActivityStreamer.js"></script>
    <script src="stream/js/ExampleActivities.js"></script>
    <script>
      $(function() {
        
        var pusher = new Pusher('<?php echo APP_KEY; ?>')
        var activityChannel = pusher.subscribe('site-activity');
        var activityMonitor = new PusherActivityStreamer(activityChannel, "#activity_stream");
        
        var examples = new ExampleActivities(activityMonitor, pusher);
        
        $("#sendTest").click(function(){
          activityMonitor.sendActivity('test-event');
        });
      });
    </script>
