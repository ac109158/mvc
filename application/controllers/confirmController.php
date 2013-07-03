<?php
class ControllerConfirm extends Controller {

    function __construct() {
        parent::__construct();
        $display = true;
    }    

    private function render() 
    	{
    	$model=App::fetchModel("confirm");
		$model::index();
    	$key = (isset($_REQUEST['key'])) ? $_REQUEST['key']:'';
    	$view = App::fetchView();
    	$vars['title'] = 'Confirm Registration';
    	$vars['key'] = $key;
    	$view::render('confirm',$vars,1);
		}
		
    
     public function validate()
    	{
		if(isset($_REQUEST['key']))
			{
			$model = App::fetchModel('confirm');
			if($model->ConfirmUser())
				{
				$display = false;
				ControllerConfirm::validated();
				exit;
				}
				else
				{
				$display = false;
				ControllerConfirm::render();
				exit;
				}
			}
		ControllerConfirm::failure();
		exit;
		}//end of validate
		
		
	private function validated () {
		$msg = '<center><h2>Thanks for registering!</h2><br /> 
						Your registration is now complete.<br /> 
						<p><a href="?controller=login">Click here to login</a></p>
						</center.';
		$view = App::fetchView();
		$vars['title'] = 'Registration Complete';
		$vars['msg'] = $msg;
		$display = false;
		$view::render('message',$vars,1);
		exit;
	}
	
	private function failure() {
		$msg = '<h2>Registration Unsuccesful</h2><br /> 
		This attempt to register was unsucessful.<br /> 
		This user may be already been registered, if not
		please use the link in your Confirmation Email.<br /> 
		<p><a href="?controller=index">Home</a></p>';
		$view = App::fetchView();
		$vars['title'] = 'Registration Unsuccessful';
		$vars['msg'] = $msg;
		$view::render('message',$vars);
		$display = false;
		exit;
		}
	
} // end of class