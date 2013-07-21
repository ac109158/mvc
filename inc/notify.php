    <script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    
    <script>
      var NOTIFY_ENDPOINT = "index.php?controller=ajax&task=notify_endpoint";    
      $(function() {          
        $(".notify").click(handleNotifyButtonClick);
      });      
      function handleNotifyButtonClick() {
      	if ( $('#channel').val() == "")
      	{
      		$('#channel').css('border','2px solid red');
      	} else {
      	$('#channel').css('border','0px');
        var message = $.trim($("#notifyMessage").val());
        var frequency = $("#channel").val();
        if(message) 
        {
			message += "<br><br> Sent by:  <?php	echo $_SESSION['name_of_user'];?>";
			$.ajax({
			url: NOTIFY_ENDPOINT,
			data: {"message": message, "channel": frequency}		
          });
          $('#channel').val('Select...');
        }
      }
      };
    </script>

<div>
<textarea id="notifyMessage" style="width:96%; margin:0px auto; resize:none;border-radius:5px;">HTML5 Realtime Push Notification</textarea><br />

<select id="channel" name="channel">
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

<button class="notify">Notify</button>
</div>