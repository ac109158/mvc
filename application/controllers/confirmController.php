<?php
class ControllerConfirm extends Controller {

    function __construct() {
        parent::__construct();
        $display = true;
    }
    
    private function getLocalVars($array) 
    {
	    $array['header'] = VIEW . 'landing_header.php';
	    $array['tab'] = "register";
	    $array['title'] = 'Confirm Registration';
	    $array['form'] = VIEW . 'message.php';
	    return $array;
    }   

    private function render() 
    {
    	$view = App::fetchView();
    	$vars['key'] = App::request( $_REQUEST[ 'key' ] );
    	$vars = App::cleanArray($vars);
    	$vars = App::getDefaultVars($vars, $msg);
    	$vars = ControllerConfirm::getLocalVars($vars);  	
    	$vars['action'] = '?controller=confirm&task=validate';
    	$view::render('confirm',$vars);
	}		

	public function validate()
    {
		if ( isset( $_REQUEST['key'] ) ) 
		{
			if ( App::fetchModel( 'register', 'ConfirmUser' ) ) 
			{ 
				$display = false; 
				ControllerConfirm::validated();
				exit;
			 } else 
			 		{ 
						$display = false; 
						ControllerConfirm::failure(); 
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
		$vars = App::getDefaultVars($vars);
		$vars = ControllerConfirm::getLocalVars($vars);  	
		$vars['title'] = 'Complete';
		$vars['msg'] = $msg;
		$display = false;
		$view::render('landing',$vars);
		exit;
	}
	
	private function failure() {
		$msg = '<h2 style="color:red;">Registration Unsuccesful</h2><br /> 
		This attempt to register was unsucessful.<br /> 
		This user may be already been registered, if not
		please use the link in your Confirmation Email.<br /> 
		<p><a href="?controller=index">Home</a></p>';
		$view = App::fetchView();
		$vars = App::getDefaultVars($vars);
		$vars = ControllerConfirm::getLocalVars($vars);  	
		$vars['title'] = 'Registration Unsuccessful';
		$vars['msg'] = $msg;
		$view::render('landing',$vars);
		$display = false;
		exit;
		}
	
} // end of class