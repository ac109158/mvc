<?php
class App {

    function __construct() 
    	{
		require './config.php';  // Global vars and database
		require CONTROLLER."Controller.php"; // Base Controller Class
		$error_messages = array();
		date_default_timezone_set('America/Denver');
		
/*
		$errors = array();
		$vars = array();
*/
		}
    
    public function setErrorMsg($msg)
    	{
	    $errors[] =$msg;
    	}

    	
    public function getErrorMsg()
    	{
	    return $errors;
    	}
    
    public function checkLogin() 
	{
	 	if(App::execute('login', 'checkLogin')) { return true; }
		return false;
 	}
 
	public function request($param)
	{
		if (isset($param)) { $request = $param; return trim($request); }
		return null;
	}
		
	public function fetchModel($model, $action=false, $arg = false)
	{
		$path = MODEL.$model.'Model.php';
		$class_name = ucfirst($model).'Model';
		if (!file_exists("$path")) { return false; }
		require_once "$path";
		if($action)
			{
			if (!method_exists("$class_name", "$action") ) { return false; }
			$model = new $class_name();
			return $model->$action($value = ($arg != false) ? $arg : void);
			}
		return new $class_name();
	}		
		
	public function fetchView($vars = false) 
	{
    	require_once  VIEW.'View.php';
    	return  new View();
    }
	
	
	public function cleanArray($array)
	{
		$sticky = array();
		foreach ($array as $name => $value)
			{
			$sticky["$name"] = Model::SafeDisplay("$value");
			}
		return $sticky;	
	}

	
	
	public function getDefaultVars($array,$errMsg=null)
	{

		$array['site'] =  SITENAME;
		$array['title']= SITENAME;
		$array['slogan'] = SLOGAN;
		$date = getdate();
		$array['date'] =  $date['weekday'] . ' ' . $date['month'] . ' '.  $date['mday'] . ', ' . $date['year'];
		//$array['form']= VIEW.'login.php';
		$array['errors'] = $errMsg;
		$array['tab'] = "login";
		$array['errors'] =  (isset($errMsg)) ? $errMsg : " REQUIRED * ";
		return $array;	
	}
	
	
	public function getTime()
	{
		echo date('g:i a');
	}
	
	public function fetchController($controller, $task)
	{
		$path = CONTROLLER.$controller.'Controller.php';
		$class_name = 'Controller'.ucfirst($controller);
		if( file_exists("$path")) { require_once "$path"; }
		if (method_exists("$class_name", "$task") ) { return new $class_name(); }
		return false;
	}		
		
	public function execute($controller, $task, $arg=false)
	{
		if (!$controller = App::fetchController($controller, $task)) {return false;}
		if(!$controller::$task($value = ($arg != false) ? $arg : null)){return false;}
		return true;
	}
		
	public function init()
	{
		$url = array();
		$url['controller'] = App::request($_REQUEST['controller']);
		$url['task'] = App::request($_REQUEST['task']);
		$url['model'] = App::request($_REQUEST['model']);
		$url['action'] = App::request($_REQUEST['action']);
		$url['key'] = App::request($_REQUEST['key']);
		$url['fieldId'] = App::request($_REQUEST['fieldId']);
		$url['fieldValue'] = App::request($_REQUEST['fieldValue']);
		return $url;
	}
	public function isArrayFull($array)
	{		
		foreach ($array as $value => $contents)
		{
    		if (!$contents)
    			{
    			if (!$pos = strpos($value, '_'))
    				{
	    			return 'Please fill in ' . strtoupper($value);
    				}
    			$value = strtoupper($value);
    			$value = str_replace('_', ' ', $value);
	    		return 'Please fill in '.  $value;
				}
		}
    	return true;
    }
    
    
    public function isMatch($var1, $var2)
    {
    	return $var1 === $var2;
    }
    
   	public function validatePhone($string) {
    $numbersOnly = preg_replace('/\D/', '', $string);
    $numberOfDigits = strlen($numbersOnly);
    if ($numberOfDigits == 10) {
        return true;
    } else {
        return false;
    }
	}
	
	public function numbersOnly($string) 
	{
    return preg_replace('/\D/', '', $string);
	}
	
	

}