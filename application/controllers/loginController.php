<?php
class ControllerLogin extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    
    
    private function getLocalVars($array) 
    {
	    $array['header'] = VIEW . 'landing_header.php';
	    $array['main'] = VIEW.'message.php';
	    $array['tab'] = "login";
	    return $array;
    }
    
    public function checkLogin() {
	    return $model = App::fetchModel('user','detectLogin');
    }
    
    public function validate()
    {
    	if(isset($_POST['submitted']))
		{
			$result = App::fetchModel( 'login','Login');
			if( $result === true )
			{
				App::fetchModel('base','RedirectToURL','?controller=dashboard&task=display');
				exit;
			}
			else 
				{
				$result = array_pop($result);
				ControllerLogin::display($result);
				exit;
				}
		}
		echo 4;
		ControllerLogin::display();
		exit;
	}
			
	public function display($msg = null)
		{
		//$model = App::fetchModel('login');
		$view = App::fetchView();
		if (isset($_POST['submitted']))
			{
			$vars['username'] = App::request('username');
			$vars = App::cleanArray($vars);
			}
		$vars = App::getDefaultVars($vars, $msg);
		$vars = ControllerLogin::getLocalVars($vars);
		$vars['title'] = 'LOGIN';		
		$vars['form'] = VIEW.'login.php';		
		$view::render('landing',$vars);
		
		exit;
		}

	public function reset_pwd()
		{
		if(App::fetchModel('login', 'ResetUserPassword'))
			{
			$email = App::request($_REQUEST['email']);
			$link = App::fetchModel('base','GetEmailHost', $email);
			ControllerLogin::password_reset__success_message($link, $email);
			exit;
			}
		ControllerLogin::password_reset__success_message("$link","$email");
		exit;		
		}
	
    function password_reset__success_message($link, $email)
		{
		$msg = '<center><h2 style="color:green;">Your password has successfully reset!</h2><br />
		An email was sent to your email address that contains your new password..<br />'
		.'Go to '. "$link ". "for " . "$email.". '<br />'
		.'<a href="?controller=index">Home</a></center.';
		$view = App::fetchView();
		$vars = App::getDefaultVars('$vars');
		$vars = ControllerLogin::getLocalVars($vars);
		$vars['title'] = 'Password Success';
		$vars['msg'] = $msg;
		$vars['form'] = VIEW.'message.php';
		$view::render('landing',$vars);
		exit;
		}		
		
	function password_reset__failure_message()
		{
		$msg = '<center><h2 style ="color:red;">The attempt to reset your password was unsuccessful!</h2><br />
		<p>Please try again or contact your system administrator.</p><br /> 
		<a href="?controller=index">Login</a></center.';
		$view = App::fetchView();
		$vars = App::getDefaultVars($vars);
		$vars = ControllerLogin::getLocalVars($vars);
		$vars['title'] = 'Password Failure';
		$vars['msg'] = $msg;
		$vars['form']= VIEW.'message.php';
		$view::render('landing',$vars);
		exit;
		}
	
    
   public function password_reset_request() 
		{
		$emailsent = false;
		if(isset($_REQUEST['submitted_email_reset']))
			{
			$result = App::fetchModel('login','EmailResetPasswordLink');
			if($result === true)
				{
				$email = App::request( $_REQUEST['email']);
				$link = App::fetchModel('base', 'GetEmailHost',"$email");
				ControllerLogin::password_reset_message($link, $email);
				exit;
				}
			else
				{
				$msg = array_pop($result);
				}
		}
		else
			{
			$msg = "Please provide the email that you registered with.";
			}
		$view = App::fetchView();
		$vars['email'] = App::request('email');
		$vars = App::cleanArray($vars);
		$vars = App::getDefaultVars($vars, $msg);
		$vars = ControllerLogin::getLocalVars($vars);
		$vars['action'] = '?controller=login&task=password_reset_request';
		$vars['title'] = "Password Reset";
		$vars['form'] =  VIEW.'password_req.php';
		$view->render('landing', $vars);
		exit;
		}//end of password_reset_request
		
		
		
   
   	
		
	function password_reset_message($link, $email)
		{
		$email = App::request( $_REQUEST['email']);
		$link = App::fetchModel('base', 'GetEmailHost',"$email");
		$msg = '<center><h2 style="color:green;">Reset password link sent!</h2><br />
		An email is sent to your email address that contains the link to reset the password..<br />'
		.'Go to '. "$link ". "for " . "$email.". '<br />'
		.'<a href="?controller=index">Home</a></center.';
		$view = App::fetchView();
		$vars = App::getDefaultVars($vars);
		$vars = ControllerLogin::getLocalVars($vars);
		$vars['form'] = VIEW.'message.php';
		$vars['msg'] = $msg;
		$vars['title'] = 'Reset Success';
		$view::render('landing', $vars);
		}	

}