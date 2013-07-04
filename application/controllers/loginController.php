<?php
class ControllerLogin extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    public function checkLogin() {
	    return $model = App::fetchModel('user','detectLogin');
    }
    
    public function validate()
    	{
    	$model = App::fetchModel('login');
    	if(isset($_POST['submitted']))
			{
			if($model->Login())
				{
				$model::RedirectToURL('?controller=dashboard&task=display');
				exit;
				}
			}
		ControllerLogin::display();
		exit;
		}
			
	public function display()
		{
		$model = App::fetchModel('login');
		$view = App::fetchView();
		$vars['title'] = "Login";
		$vars['errors'] = $model->GetErrorMessage();
		if (isset($_POST['submitted']))
			{
			$vars['username'] = App::request('username');
			$vars = App::sticky($vars);
			}
		$view::render('login',$vars);
		exit;
		}

	public function reset_pwd()
		{
		if(App::fetchModel('login', 'ResetUserPassword'))
			{
			$email = App::request($_REQUEST['email']);
			$link = App::fetchModel('base',"GetEmailHost($email)");
			ControllerLogin::password_reset__success_message($link, $email);
			exit;
			}
		ControllerLogin::password_reset__success_message("$link","$email");
		exit;		
		}
	
    function password_reset__success_message($link, $email)
		{
		$msg = '<center><h2>Your password has successfully reset!</h2><br />
		An email was sent to your email address that contains your new password..<br />'
		.'Go to '. "$link ". "for " . "$email.". '<br />'
		.'<a href="?controller=index">Home</a></center.';
		$view = App::fetchView();
		$vars['title'] = 'Password Success';
		$vars['msg'] = $msg;
		$view::render('message',$vars);
		exit;
		}
		
		
	function password_reset__failure_message()
		{
		$msg = '<center><h2>The attempt to reset your password was unsuccessful!</h2><br />
		<p>Please try again or contact your system administrator.</p><br /> 
		<a href="?controller=index">Login</a></center.';
		$view = App::fetchView();
		$vars['title'] = 'Password Failure';
		$vars['msg'] = $msg;
		$view::render('message',$vars);
		exit;
		}
	
    
   public function password_reset_request() 
		{
		$emailsent = false;
		if(isset($_REQUEST['submitted_email_reset']))
			{
			if(App::fetchModel('login','EmailResetPasswordLink'))
				{
				$email = App::request( $_REQUEST['email']);
				$link = App::fetchModel('login', 'GetEmailHost',"$email");
				ControllerLogin::password_reset_message("$link", "$email");
				exit;
				}
			else
				{
				$msg = "The email provided was invalid.";	
				}
		}
		else
			{
			$msg = "Please provide the email that you registered with.";
			}
		$view = App::fetchView();
		$vars['email'] = App::request('email');		
		$vars['errors'] = App::fetchModel('error','GetErrorMessage');	
		$vars['action'] = '?controller=login&task=password_reset_request';
		$vars['title'] = "Password Reset";
		$vars['message'] = '';
		$vars = App::sticky($vars);
		$view->render('password_req', $vars);
		exit;
		}//end of password_reset_request		
		
	function password_reset_message($link, $email)
		{
		$msg = '<center><h2>Reset password link sent!</h2><br />
		An email is sent to your email address that contains the link to reset the password..<br />'
		.'Go to '. "$link ". "for " . "$email.". '<br />'
		.'<a href="?controller=index">Home</a></center.';
		$view = App::fetchView();
		$vars['title'] = "Thank you";
		$vars = App::sticky($vars);
		$vars['msg'] = $msg;
		$view::render('message', $vars);
		}	

}