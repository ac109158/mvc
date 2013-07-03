<?php
class App {

    function __construct() 
    	{
		require './config.php';  // Global vars and database
		require CONTROLLER."Controller.php"; // Base Controller Class
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
    	
/*
    public function setVar($name,$value) 
    	{
		$vars["$name"] = $value;
		}
*/
    
    public function checkLogin() 
 		{
 		//echo "Inside of app checking login";
		 	if(App::execute('login', 'checkLogin'))
			 	{
				 return true;
			 	}
			 return false;
	 	}
 
	public function request($param){
		if (isset($param)) 
		{
		$request = $param;
		return $request;
		}
		return null;
		}
		
	public function fetchModel($model, $action=false, $arg = false)
		{
		$path = MODEL.$model.'Model.php';
		$class_name = ucfirst($model).'Model';
		if (!file_exists("$path"))
			{
			return false;
			}
		require_once "$path";
		$model = new $class_name();
		if($action)
			{
			if (!method_exists("$class_name", "$action") )
				{
				return false;
				}
			return $model->$action($value = ($arg != false) ? $arg : void);
			}
		return $model;
		}
	
	public function fetchController($controller, $task)
		{
		$path = CONTROLLER.$controller.'Controller.php';
		$class_name = 'Controller'.ucfirst($controller);
		if( file_exists("$path"))
			{
			require_once "$path";
			}
		   if (method_exists("$class_name", "$task") )
			{
			$controller = new $class_name();
			return $controller;
			}
		//echo "shit be broken";
		return false;
		}
		
		
	public function fetchView($vars = false) {
    	require_once  VIEW.'View.php';
    	$new_view = new View();
  /*
  	if($vars)
    		{
	    	foreach ($vars as $name => $value)
	    		{
	    		echo "$name, $value";
	    		App::setVar($name, $value);
				}
			}
*/
		return $new_view;  	
        }
	
	
	public function sticky($array)
	{
	$sticky = array();
	foreach ($array as $name => $value){
		$sticky["$name"] = Model::SafeDisplay("$value");
	}
	return $sticky;	
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
		return $url;
		}

}