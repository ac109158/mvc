jQuery(function($) { //This is the short hand version of: "jQuery(document).ready(function($){"
	//We start by hiding our page ajax_content, to ensure a smooth transition
	$('.ajax_content').hide();



	//FOR LOADING ajax_content WHEN LINK IS CLICKED
    //Bind a "click" function to our nav links.
	$('.ajax_trigger').click(function(){
    
        //Tell us that we want to grab everything from the "ajax_content" id in the file linked
		var toLoad = $(this).attr('href')+' .ajax_pull';
        
        //Hide the current page ajax_content
		$('.ajax_content').hide();

/*
        
//**************** OPTIONAL FUNCTIONALLITY JUST TO HELP THE USER ****************      
        //Change the URL adding '.!/' + the linked file name
        window.location.hash = '!/'+$(this).attr('href');
//**************** END OF OPTIONAL FUNCTIONALLITY *******************************
*/


		//Load the new ajax_content, after it is loaded fade in the new ajax_content
		$('.ajax_content').load(toLoad,'',function(){
			$('.ajax_content').fadeIn(500);
		});


        //Stop the link from reloading the page
		return false;    
	});
    
    
    
//**************** OPTIONAL FUNCTIONALLITY JUST TO HELP THE USER ****************
	//FOR GRABBING ajax_content ON PAGE REFRESH
    //Remove '.!/' from the front of the hash value
    var hash = window.location.hash.substr(3);
    
    //Check the current HREF
    $('.ajax_trigger').each(function(){
        var href = $(this).attr('href');
        
        //if the 'href' is the same as the 'hash' value it will load the correct ajax_content
        //We do this just to make sure the page is one of our pages
        if(hash===href){
            
            //Grabs the ajax_contents from the hash file
            var toLoad = hash+' .ajax_pull';
            
            //Loads the ajax_content
            $('.ajax_content').load(toLoad);
        }                                            
    });
//**************** END OF OPTIONAL FUNCTIONALLITY *******************************





	//fade the ajax_content of the page in smoothly
	$('.ajax_content').fadeIn(500);
});