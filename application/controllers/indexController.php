<?php

class ControllerIndex extends Controller {

    function __construct() {
        parent::__construct();
		//$error_messages = array();
    }
    
    private function getLocalVars($array) 
    {
	    $array['header'] = VIEW . 'landing_header.php';
	    $array['tab'] = "login";
	    $array['form'] = VIEW.'login.php';
	    return $array;
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
	$vars = ControllerIndex::getLocalVars($vars);
	$view::render('landing', $vars);
	exit;
   }            
	

}
