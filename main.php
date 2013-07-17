<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <title>JQuery</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	    
    </head>
    <body>
<input type="text" name="first_name" class="cleanup" />
<input type="text" name="last_name" class="cleanup" />
	    
    </body>
    <script>
   (function($) {
    $(document).ready(function() {
        $('input.cleanup').blur(function() {
            var value = $.trim( $(this).val() );
            $(this).val( value );
        });
    });
})(jQuery);
    
    

</script>
</html>