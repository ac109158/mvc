<?php
class ControllerAjax extends Controller{

    function __construct() 
    {
    parent::__construct();
    }
    
    private function getLocalVars($array) 
    {
	    return $array;
	    exit;
    }
    
    public function validate_field()
	{
	$vars[0] = App::request($_REQUEST['fieldId']);	
	$vars[1] = App::request($_REQUEST['fieldValue']);	
	if(!App::fetchModel("ajax","validate_field",$vars))
	{
		return false;
		exit;
	}
	}
	
	public function trigger_activity() 
	{
		App::fetchModel('pusher', 'trigger_init');
		exit;
	}
	
	public function notify_endpoint() 
	{
		$vars[0]= App::request($_REQUEST['message']);
		$vars[1] = App::request($_REQUEST['channel']);		
		$vars[2] = App::request($_REQUEST['method']);	
		$vars[3] = App::request($_REQUEST['name']);	
		App::fetchModel('pusher', 'notify_endpoint', $vars);
		exit;
	}
	
	public function pusher_auth() 
	{	
		App::fetchModel('pusher', 'pusher_auth');
		exit;
	}
	
		public function pusher_server() 
	{	
		App::fetchModel('pusher', 'pusher_server');
		exit;
	}
	
	public function pusher_chat() 
		{	
			App::fetchModel('pusher', 'pusher_chat');
			exit;
		}
		
	public function file_upload() 
		{	
			App::fetchModel('user', 'file_upload');
			exit;
		}
		
	public function chat_list() 
		{	
			App::fetchModel('pusher', 'getChatList');
			exit;
		}	



	
}
?>