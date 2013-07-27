 
<!--     <link rel="stylesheet/less" type="text/css" href="chat-widget/css/twitter-bootstrap/lib/bootstrap.less"> -->
<!--     <script src="chat-widget/css/less/less-1.1.5.min.js"></script> -->
    
<!--     <link href="chat-widget/css/styles.css" rel="stylesheet" /> -->
<!--     <link href="chat-widget/css/pusher-chat-widget.css" rel="stylesheet" /> -->
    
    <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
    <script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    
    <script src="chat-widget/js/PusherChatWidget.js"></script>    
    <script>
    
      $(function() {
		  var pusher = new Pusher('71d3c4ea25f712272ad3');    
         var chatWidget = new PusherChatWidget(pusher, {
          appendTo: '#dashboard_group_chat_panel',
          maxItems: 50
        });
           
      });
  </script>
	

    
    <script>
$(document).keypress(function(event){

    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        $('#pusher-chat-widget-send-btn').click();  
        $(".chat-activity-stream").animate({ scrollTop: "5000px"}, 0);
    }
    
/* 	$('#pusher-chat-widget-messages').scrollTop( '100%' ); */
	
	

});
   </script>
