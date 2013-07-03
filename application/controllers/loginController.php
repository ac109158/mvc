<?php
class ControllerLogin extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    public function checkLogin() {
	    $model = App::fetchModel('user');
	    return $model::detectLogin();
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
	
	private function action($action)
		{
		switch ($action) 
		{
		case "pass_reset":
			//echo "0-init request<br /> ";
			$this->password_reset_request();
			break;
		case "resetpwd":
			//NEED TO PUT SOME SECURITY BUFFERS HERE
			if ($this->controller->model->ResetUserPassword());
				{
				$email = $_REQUEST['email'];
				$link = $this->controller->model->GetEmailHost($email);
				$this->password_reset__success_message($link, $email);
				exit;
				}
			$this->password_reset__failure_message();
			break;

		default:
			$this->password_reset__failure_message();
		
		} // end of switch 
		} // end of action	
	
    function password_reset__success_message($link, $email)
		{
		$msg = '<center><h2>Your password has successfully reset!</h2><br />
		An email was sent to your email address that contains your new password..<br />'
		.'Go to '. "$link ". "for " . "$email.". '<br />'
		.'<a href="?controller=index">Home</a></center.';
		$this->controller->getView($this->controller, 'Password Sucess', $msg);
		$this->controller->view->render('message');
		exit;
		}
		
		
	function password_reset__failure_message()
		{
		$msg = '<center><h2>The attempt to reset your password was unsuccessful!</h2><br />
		<p>Please try again or contact your system administrator.</p><br /> 
		<a href="?controller=index">Login</a></center.';
		$this->controller->getView($this->controller, 'Password Success', $msg);
		$this->controller->view->render('message');
		exit;
		}
	
    
   public function password_reset_request() 
		{
		$emailsent = false;
		if(isset($_REQUEST['submitted_email_reset']))
			{
			if($this->controller->model->EmailResetPasswordLink())
				{
				$email = $_REQUEST['email'];
				$link = $this->controller->model->GetEmailHost($email);
				$this->password_reset_message("$link", "$email");
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
		//echo"3-render form<br /> ";
		$this->controller->getView($this->controller, "Password Reset",$msg);
		$this->controller->view->action = "?controller=login&action=pass_reset";
		$this->controller->view->render('password_req');
		}//end of password_reset_request		
		
	function password_reset_message($link, $email)
		{
		$msg = '<center><h2>Reset password link sent!</h2><br />
		An email is sent to your email address that contains the link to reset the password..<br />'
		.'Go to '. "$link ". "for " . "$email.". '<br />'
		.'<a href="?controller=index">Home</a></center.';
		$this->controller->getView($this->controller, 'Thank You', $msg);
		$this->controller->view->render('message');
		}	

}