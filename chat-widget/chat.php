<!-- <link rel="stylesheet/less" type="text/css" href="chat-widget/css/twitter-bootstrap/lib/bootstrap.less"> -->
<!-- <script src="chat-widget/css/less/less-1.1.5.min.js"></script> -->
    
<!-- <link href="chat-widget/css/styles.css" rel="stylesheet" /> -->
<!-- <link href="chat-widget/css/pusher-chat-widget.css" rel="stylesheet" /> -->
    
    <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->



    
    <script>
$(document).keypress(function(event){

    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        $('#pusher-chat-widget-send-btn').click();
        $(".chat-activity-stream").animate({ scrollTop: "5000px"}, 0);
    }
    
/* $('#pusher-chat-widget-messages').scrollTop( '100%' ); */



});
   </script>
   