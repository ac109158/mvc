<?php
class ControllerRegister extends Controller {

    function __construct() 
    {
        parent::__construct();
    }   
    
    public function display() 
    {
		$model = App::fetchModel("register");
		if (isset($_POST['submitted']))
			{
			$vars['first_name'] = App::request('first_name');
			$vars['last_name'] = App::request('last_name');
			$vars['email'] = App::request('email');
			$vars['phone_number'] = App::request('phone_number');
			$vars['username'] = App::request('username');
			$vars['password'] = App::request('password');
			$vars = App::sticky($vars);
			}
		$vars['spamInputTrapName'] = $model->GetSpamTrapInputName();
		$vars['title'] = 'Register';
		$vars['errors'] = $model->GetErrorMessage();
		$view = App::fetchView();
		$view::render('register',$vars);
		exit;
	}
    
    public function validate()
    {
		if (isset($_POST['submitted']))
			{
			$model = App::fetchModel('register');
			if($model->RegisterUser())
				{
				$email = $_REQUEST['email'];
				$link = $model->GetEmailHost($email);
				if (!ControllerRegister::validated("$link", "$email")) { return false; }
			} else 
					{
					ControllerRegister::display(); exit;
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
		$view::render('message',$vars);
		$display = false;
		exit;
	}
	
}
	

	