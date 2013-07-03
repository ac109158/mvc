<?php

class ControllerIndex extends Controller {

    function __construct() {
        parent::__construct();
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
   $model=App::fetchModel("database");
   $vars['title'] = 'SHIFT BUDDY';
	$view = App::fetchView();
	$vars['errors'] = $model->GetErrorMessage();
	$view::render('landing', 1,$vars);
	exit;
   }            
	

}
