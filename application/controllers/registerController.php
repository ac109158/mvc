<?php
class ControllerRegister extends Controller {

    function __construct() 
    {
        parent::__construct();
    }
    
    private function getLocalVars($array) 
    {
	    $array['header'] = VIEW . 'landing_header.php';
	    $array['tab'] = "register";
	    $array['form'] = VIEW.'register.php';
	    $vars['spamInputTrapName'] = App::fetchModel('base','GetSpamTrapInputName');
	    return $array;
    }
    
    
    
    public function display($msg = null) 
    {
		if (isset($_POST['submitted']))
			{
			$vars['first_name'] = App::request('first_name');
			$vars['last_name'] = App::request('last_name');
			$vars['email'] = App::request('email');
			$vars['phone_number'] = App::request('phone_number');
			$vars['username'] = App::request('username');
			$vars['password'] = App::request('password');
			$vars['confirm_password'] = App::request('confirm_password');
			$vars = App::cleanArray($vars);
			}
		$vars = App::getDefaultVars($vars,$msg);	
		$vars = ControllerRegister::getLocalVars($vars);
		$vars['title'] = 'Register';
		$vars['msg'] = $msg;
		$view = App::fetchView();
		$view::render('landing',$vars);
		exit;
	}
    
    public function validate()
    {
    	$complete = App::isArrayFull($_POST);
    	if ($complete !== true) {ControllerRegister::display($complete); exit;}
    	if ( !App::isMatch($_POST['password'], $_POST['confirm_password'] ) ) {$complete = "Your passwords do not match.";}
    	else 
    		{
    		if (!App::validatePhone($_POST['phone_number'])) {$complete = "Your Phone Number is invalid.";}
    		}
		if (isset($_POST['submitted']) && $complete === true)
			{
			$result = App::fetchModel('register', 'RegisterUser');
			if($result === true)
				{
				$email = $_REQUEST['email'];
				$link = App::fetchModel('base', 'GetEmailHost',$email);
				if (!ControllerRegister::validated("$link", "$email")) { return false; }
			} else 
					{
					$result = array_pop($result);
					ControllerRegister::display($result); exit;
					}			
		}
		ControllerRegister::display($complete); exit;
	}
	
	private function validated($link,$email) 
	{
		$msg = '<center><h2 style="color:green;">You have sucessfully registered!</h2><br />
		Your confirmation email is on its way. Please click the link in the email to complete the registration.<br />'
		.'Go to '. "$link ". "for " . "$email.". '<br />'
		.'<a href="?controller=index">Home</a></center.';
		$view = App::fetchView();
		$vars = App::getDefaultVars($vars);
		$vars = ControllerRegister::getLocalVars($vars);
		$vars['msg'] = $msg;
		$vars['title'] = "Thank You";
		$vars['form'] = VIEW.'message.php';
		$display = false;
		$view::render('landing',$vars);		
		exit;
	}
	
}
	

	