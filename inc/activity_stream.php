	<ul id="activity_stream" class="activity-stream no-actions"></ul>
	<textarea id="stream_message" style="width:96%; margin:0px auto; resize:none;border-radius:5px;">Stream Message</textarea><br />	
	<select id="stream_channel" name="stream_channel">
	<option value="">Select...</option>
	<option value="shared">Shared Agents</option>
	<option value="rosetta">Rosetta Agents</option>
	<option value="shift">Shift Manager</option>
	<option value="support">Tech Support</option>
	<option value="performance">Performance</option>
	<option value="traffic">Traffic</option>
	<option value="scripts">Scripts</option>
	<option value="control">Quality Control</option>
	<option value="payroll">Payroll</option>
	<option value="Management">Management</option>
	<option value="all">All</option>
	</select>
	
	<button class="stream">Stream</button>
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
        var activityChannel = pusher.subscribe('all');
        //activityChannel = pusher.subscribe('shared');
        var activityMonitor = new PusherActivityStreamer(activityChannel, "#activity_stream");
        
        var activityChannel = pusher.subscribe('shared');
        var activityMonitor = new PusherActivityStreamer(activityChannel, "#activity_stream");
        
        //var examples = new ExampleActivities(activityMonitor, pusher);
        
        });
   </script>
   <script>        
        $(".stream").click(function()
        {
        	if ( $('#stream_channel').val() == "")
				{
				$('#stream_channel').css('border','2px solid red');
				} 
			else 
				{
				$('#stream_channel').css('border','0px');
				var text = $.trim($("#stream_message").val());
				var id = $("#stream_channel").val();
				if(text) 
					{
					var url = "index.php?controller=ajax&task=trigger_activity";				
					var dataString = 'activity_channel='+id+'&activity_type=page-load&action_text='+text;
					jQuery.ajax({url: url,cache: false,type: "GET",	data: dataString});
					}
				}
			$('#stream_channel').val('Select...');
		});
    </script>


