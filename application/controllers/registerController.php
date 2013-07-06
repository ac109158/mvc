<?php
class ControllerRegister extends Controller {

    function __construct() 
    {
        parent::__construct();
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
			$vars = App::cleanArray($vars);
			}
		$vars = App::getDefaultVars($vars,$msg);
		$vars['spamInputTrapName'] = App::fetchModel('base','GetSpamTrapInputName');
		$vars['title'] = 'Register';
		//$vars['errors'] = $msg;
		$vars['form'] = VIEW.'register.php';
		$vars['tab'] = 'register';
		$view = App::fetchView();
		$view::render('landing',$vars);
		exit;
	}
    
    public function validate()
    {
		if (isset($_POST['submitted']))
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
	}
	
	private function validated($link,$email) 
	{
		$msg = '<center><h2>Thanks for registering!</h2><br />
		Your confirmation email is on its way. Please click the link in the email to complete the registration.<br />'
		.'Go to '. "$link ". "for " . "$email.". '<br />'
		.'<a href="?controller=index">Home</a></center.';
		$view = App::fetchView();
		$vars['msg'] = $msg;
		$vars['title'] = "Thank You";
		$vars['tab'] = "register";
		$view::render('message',$vars);
		$display = false;
		exit;
	}
	
}
	

	