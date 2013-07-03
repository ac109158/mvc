<?php
class View{

    function __construct() {
    require_once LIB.'formvalidator.php';
	}

    public function render($name, $vars = false, $noInclude = false)
    	{
    	//echo VIEW. $name . '.php';
    	if ($noInclude == false){
	    	require_once VIEW.'header.php';  
    	}
		require_once VIEW."$name.php"; 
		if ($noInclude == false){
	    	require_once VIEW.'footer.php'; 
    	}       
		}
    
    
    }