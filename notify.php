    <script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    
    <script>
      var NOTIFY_ENDPOINT = "index.php?controller=dashboard&task=notify_endpoint";    
      $(function() {          
        $(".notify").click(handleNotifyButtonClick);
      });      
      function handleNotifyButtonClick() {
        var message = $.trim($("#notifyMessage").val());
        message += "<br><br> Sent by:  <?php	echo $_SESSION['name_of_user'];?>";
        if(message) {
          $.ajax({
            url: NOTIFY_ENDPOINT,
            data: {"message": message}
          });
        }
      }
    </script>

<div>
<textarea id="notifyMessage" style="width:96%; margin:0px auto; resize:none;border-radius:5px;">HTML5 Realtime Push Notification</textarea><br />
<button class="notify">Notify</button>
</div>

