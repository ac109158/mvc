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
<script type="text/javascript">
$("#flipbox").flip({
	direction:'tb',
	content:'this is my new content'
})
</script>

</body>
</html>



