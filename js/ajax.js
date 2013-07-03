jQuery(function($) { //This is the short hand version of: "jQuery(document).ready(function($){"
	//We start by hiding our page content, to ensure a smooth transition
	$('#content').hide();



	//FOR LOADING CONTENT WHEN LINK IS CLICKED
    //Bind a "click" function to our nav links.
	$('#nav li a').click(function(){
    
        //Tell us that we want to grab everything from the "content" id in the file linked
		var toLoad = $(this).attr('href')+' #ajax_pull';
        
        //Hide the current page content
		$('#content').hide();

        
//**************** OPTIONAL FUNCTIONALLITY JUST TO HELP THE USER ****************      
        //Change the URL adding '#!/' + the linked file name
        window.location.hash = '!/'+$(this).attr('href');
//**************** END OF OPTIONAL FUNCTIONALLITY *******************************


		//Load the new content, after it is loaded fade in the new content
		$('#content').load(toLoad,'',function(){
			$('#content').fadeIn(500);
		});


        //Stop the link from reloading the page
		return false;    
	});
    
    
    
//**************** OPTIONAL FUNCTIONALLITY JUST TO HELP THE USER ****************
	//FOR GRABBING CONTENT ON PAGE REFRESH
    //Remove '#!/' from the front of the hash value
    var hash = window.location.hash.substr(3);
    
    //Check the current HREF
    $('#nav li a').each(function(){
        var href = $(this).attr('href');
        
        //if the 'href' is the same as the 'hash' value it will load the correct content
        //We do this just to make sure the page is one of our pages
        if(hash===href){
            
            //Grabs the contents from the hash file
            var toLoad = hash+' #ajax_pull';
            
            //Loads the content
            $('#content').load(toLoad);
        }                                            
    });
//**************** END OF OPTIONAL FUNCTIONALLITY *******************************





	//fade the content of the page in smoothly
	$('#content').fadeIn(500);
});