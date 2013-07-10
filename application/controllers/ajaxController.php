<?php
class ControllerAjax extends Controller {

    function __construct() 
    {
        parent::__construct();
    }
    
    private function getLocalVars($array) 
    {
	    return $array;
    }
    
    public function validateUser($username)
    {
	    $result = App::fetchModel('ajax',  'IsUserValueUnique', $username);
	    if ($result[0] !== true)
	    {
		    echo "True";
	    }else{
		    echo 'False';
	    }
	    
    }
    
    
}