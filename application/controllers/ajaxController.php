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
	
	public function activity_trigger() 
	{
		App::fetchModel('pusher', 'activity_trigger');
		exit;
	}
	
	public function notify_endpoint() 
	{
		$vars[0]= App::request($_REQUEST['message']);
		$vars[1] = App::request($_REQUEST['channel']);		
		App::fetchModel('pusher', 'notify_endpoint', $vars);
		exit;
	}	

	
}
?>