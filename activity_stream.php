
    
    <link rel="stylesheet/less" type="text/css" href="lib/twitter-bootstrap/lib/bootstrap.less">
    <script src="css/less/less-1.1.5.min.js"></script>
    
    <link href="steam/css/styles.css" rel="stylesheet" />
    <link href="steam/lib/activity-streams.css" rel="stylesheet" />
    
    <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script src="http://js.pusher.com/1.11/pusher.min.js"></script>
    <script src="stream/js/PusherActivityStreamer.js"></script>
    <script src="stream/js/ExampleActivities.js"></script>    
    <script>
      $(function() {
        
        var pusher = new Pusher('<?php echo APP_KEY;?>');
        var activityChannel = pusher.subscribe('site-activity');
        var activityMonitor = new PusherActivityStreamer(activityChannel, "#activity_stream_example");
        
        var examples = new ExampleActivities(activityMonitor, pusher);
        
        $("#sendTest").click(function(){
          activityMonitor.sendActivity('test-event');
        });
      });
    </script>

        
        <div id="gravatar" class="alert-message block-message info">
          <p><strong>Email Address for Activity Stream</p>
          <div class="alert-actions">
            <input class="xlarge" id="email" name="email" size="30" type="text" value="Email [optional]" />
          </div>
        </div>
        
        <div class="row show-grid">
          
          <div class="span4">
            <p><button id="sendTest" class="btn info">Send Test</button></p>
          </div>
          <div class="span7">
            
            <ul id="activity_stream_example" class="activity-stream no-actions"></ul>
            
          </div>
          
        </div>
