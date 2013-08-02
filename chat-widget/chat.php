<link href="css/jquery.cssemoticons.css" media="screen" rel="stylesheet" type="text/css" />
<!-- <script src="javascripts/jquery-1.4.2.min.js" type="text/javascript"></script> -->
<script src="js/jquery.cssemoticons.min.js" type="text/javascript"></script>


    
    <script>
$(document).keypress(function(event){

    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        $('#pusher-chat-widget-send-btn').click();
        $(".chat-activity-stream").animate({ scrollTop: "5000px"}, 0);
    }
});
   </script>
   
 <script type="text/javascript">
		$(document).ready(function(){
			$('.chat-text').emoticonize({
				//delay: 800,
				//animate: false,
				//exclude: 'pre, code, .no-emoticons'
			});
			$('#toggle-headline').toggle(
				function(){
					$('#large').unemoticonize({
						//delay: 800,
						//animate: false
					})
				}, 
				function(){
					$('#large').emoticonize({
						//delay: 800,
						//animate: false
					})
				}
			);
		})
	</script>
   