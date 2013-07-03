<?php
class ControllerError extends Controller {

    function __construct() {
        parent::__construct(); 
    }
    
    function index() {
    	$controller = new Controller();
    	$msg = 'This page does not exist';
    	$controller->getView($controller,"404 Error", $msg);       
        $controller->view->render('error');
    }

}