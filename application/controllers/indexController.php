<?php

class ControllerIndex extends Controller {

    function __construct() {
        parent::__construct();
		//$error_messages = array();
    }
    
    function display($view, $vars) {
    	require_once  VIEW.'View.php';
    	$vw= new View();
    	foreach ($vars as $name => $value)
    		{
    		$app::setVar($name, $value);
			}
		$app->view->render('$view');   	
        }
    
   function index()
   {
   $view = App::fetchView();
	$vars = App::getDefaultVars($vars);	
	$vars['form'] = VIEW.'login.php';
	$view::render('landing', $vars);
	exit;
   }            
	

}
