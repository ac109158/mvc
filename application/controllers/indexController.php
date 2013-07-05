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
   $vars = array(
   'title' => 'SHIFT BUDDY',
   'slogan' => ".......... making shit easier",
   'time' => getdate() );
	$view = App::fetchView();
	$path = '<div id="form_wrapper"><div id="ajax_content"><div id="ajax_pull">Ajax Content</div></div></div>';
	$vars['login_form'] = $path;
	$view::render('landing', $vars);
	exit;
   }            
	

}
