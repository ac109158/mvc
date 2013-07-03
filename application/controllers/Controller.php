<?php
class Controller {	
		public function __construct()
		{	
		require_once  MODEL.'Model.php';
		require_once  VIEW.'View.php';
		require_once LIB.'formvalidator.php';
		}
		
	public function load_errors() {
		$var = $this->error_message;
		return $var;		
	}
	
	public function set_errors($msg) {
		$this->error_message .=$msg;		
	}
	
	public function getModel($model)
		{
		include_once MODEL."$model"."Model.php";
		$modelname = ucfirst($model).'Model';
		//echo $modelname;
		$this->model = new $modelname();
		}
		
	public function getView($controller, $title='', $msg='', $var1='')
		{
		$controller->view = new View();
		if (isset($title))
			{
			$controller->view->title="$title";
			}
		if (isset($msg))
			{
			$controller->view->msg="$msg";
			}
		if (isset($var1))
			{
			$controller->view->var1="$var1";
			}	
		if (isset($controller->error_message))
			{
			$controller->view->error_message = $controller->error_message;
			}
		
		} //end of getView
		
/*
		public function render ($view) {
			require_once VIEW.$view.'.php';
		}
*/
}//end of class

?>
