<?php 
	/**
	 *Written by Andy 6/10/13
	 *This program is to familarize myself with the Model View Controller structure
	 *
	 */
/* Get the controller from the url
*******************************************************
* $task = $_REQUEST['task'];
$controller = $_REQUEST['controller'];

$path = '/controllers/'.$controller.'.php';
if( file_exists($path) ) {
	require_once $path;
}

$classname = 'Controller'.ucfirst($controller);
$controller = new $classname();

$controller->execute( $task );
*
**********************************************************/
require './config.php';  // Global vars and database
require CONTROLLER."Controller.php"; // Base Controller Class
//require VIEW."View.php"; //Base View Class
//require './lib/Database.php';  // Database with PDO
/**********************************************************/

if (isset($_REQUEST['controller'])) 
	{
	$controller = $_REQUEST['controller'];
	if (isset($_REQUEST['task'])) 
		{
		$task = $_REQUEST['task'];
		}
	else
		{
		$task = 'index';
		 }
	}
else 
	{
	$controller = 'index';
	$task = 'index';
	}
$path = CONTROLLER.$controller.'.php';
if( file_exists("$path") ) {
	require_once "$path";
	$classname = 'Controller'.ucfirst($controller);
	if ($controller != false and $task != false)
		{
		if (method_exists("$classname", "$task")) 
			{
			$controller = new $classname();
			$controller->$task(); 
			die();
			} 
		else 
			{
			require CONTROLLER."error.php";
			$controller = new ControllerError();
			$controller->index();
			die();
			}      
		}
	else 
		{
		require CONTROLLER."error.php";
		$controller = new ControllerError();
		$controller->index();
		die();
		}
	}
else	
		{
		require CONTROLLER."error.php";
		$controller = new ControllerError();
		$controller->index();
		die();
		}                                            
/**********************************************************
**                   
*/
	 
?>