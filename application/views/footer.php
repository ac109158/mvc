

<script>
(function($) {})(jQuery);
</script>

<script>
	jQuery(document).ready(function(){
		$("#formID").not('.ignore').validationEngine({promptPosition : "topLeft", scroll: false, showOneMessage : true, autoHidePrompt : true, autoHideDelay : 3000});
		//$("#formID").bind("jqv.field.result", function(event, field, errorFound, prompText){ console.log(errorFound) });
		$('#formID input').not('.ignore').not('.submit').blur(function(){
			x = $(this).focusout().validationEngine('validate');
			if (x == true || x[1] == true) {
			$(this).removeClass('error');
			$(this).addClass('error');				
			} 
			else 
			{
				$(this).removeClass('error');
				 $(this).addClass('validated');
			}
	});
	});
</script>
<script> //date/Clock Widgit
document.querySelector(".date").addEventListener("mouseover", function(){
    var txt = document.querySelector(".date").innerHTML;
	var currentTime = new Date ( );    
	var currentHours = currentTime.getHours ( );   
	var currentMinutes = currentTime.getMinutes ( );   
	currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;   
	var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";    
	currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;    
	currentHours = ( currentHours == 0 ) ? 12 : currentHours;    
	var currentTimeString = currentHours + ":" + currentMinutes + " " + timeOfDay;       
    document.querySelector(".date").innerHTML = currentTimeString;
    this.addEventListener("mouseout", function(){
        document.querySelector(".date").innerHTML = txt;
    });
});
</script>


<script>
	jQuery(document).ready(function(){
	x = jQuery(input).find('#ctl00_BaseContent_tbxUserName').val();
	alert(x);
	});
</script>


<!--
<script type="text/javascript">
$("#flipbox").flip({
	direction:'tb',
	content:'this is my new content'
})
</script>
-->

</body>
</html>



