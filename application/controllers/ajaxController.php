<?php
class ControllerAjax extends Controller{

    function __construct() 
    {
    parent::__construct();
    }
    
    private function getLocalVars($array) 
    {
	    return $array;
    }
    
    public function validate($vars)
	{
	if(!App::fetchModel("ajax","validate",$vars))
	{
		return false;
	}
	}

	
}
?>