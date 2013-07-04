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
   $vars['title'] = 'SHIFT BUDDY';
	$view = App::fetchView();
	$view::render('landing', $vars, 1);
	exit;
   }            
	

}
