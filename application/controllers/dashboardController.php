<?php
class ControllerDashboard extends Controller
{

    function __construct() 
	  {
		parent::__construct();
		$model = App::fetchModel('user');
		if(!$model::detectLogin())
			{
			$model::RedirectToURL('?controller=login&task=display');
			exit;
			}
		if(!App::fetchModel('user', 'detectActive', $_SESSION['user_id']))
			{
			$model::RedirectToURL('?controller=login&task=display');
			exit;
			}
	   }
	   
	private function getLocalVars($array) 
    {
    	$vars['title'] = 'Dashboard';
    	$vars['user_name'] = App::fetchModel('user', 'UserFullName');
    	$vars['profile'] = ControllerDashboard::userProfileArray($_SESSION['user_id']);
		$array['header'] = VIEW . 'dash_header.php';
	    $array['tab'] = 'register';
	    $array['form'] = VIEW.'register.php';
	    return $array;
    }
  
	public function display($msg=null) 
	{
		$view = App::fetchView();
		$vars = App::getDefaultVars($vars, $msg);
		$vars = ControllerDashboard::getLocalVars($vars);
		$vars['msg'] = $msg;
        $view::render('dashboard',$vars);
        exit;
	}
		
	public function userProfileArray($user_id) 
	{
		return App::fetchModel( 'user', 'getUserProfile', $user_id  );
	}	
		
	public function user_password_chg()
	{		
		if ( isset( $_POST[ 'password_chg_submitted' ] ) )
			{
			if ( App::fetchModel( 'user', 'ChangePassword' ) )
				{
				$msg = "Your password is updated!";
				App::execute( 'dashboard', 'display', $msg );				
				}
			}
		$view = App::fetchView();
		$vars['oldpwd'] = App::request($_REQUEST['oldpwd']);
		$vars = App::cleanArray($vars);
		$vars = ControllerDashboard::getLocalVars($vars);
		$vars['title'] = "Change Password";
		$vars['action'] = "?controller=dashboard&task=user_password_chg";
		$view::render('password_chg',$vars);
		exit;
		}


	private function password_reset_email()
	{
		$msg = 
			'
			<h2>Reset password link sent</h2>
			<div id="msg">
			An email is sent to your email address that contains the link to reset the password.
			</div>
			';			
		$view = App::fetchView();
		$vars['title'] = 'Reset Password';
		$vars['msg'] = $msg;
		$view::render('message',$vars);
		exit;
	}
		
	private function chg_pass_confirm()
	{
		$msg = 
		'
		<h2>Changed password</h2>
		<div id="msg">
		An email is sent to your email address that contains the link to reset the password.
		<p>
		<a href="logout.php">logout</a>
		</p>			
		</div>
		';			
		$this->controller->getView($this->controller,'Changed Password',$msg);
		$this->controller->view->render('message');
		exit;
	}
	
	public function logout()
	{
		App::fetchModel('user', 'LogOut');
		session_destroy();
		App::fetchModel('base', 'RedirectToURL', URL);		
		exit;
	}	
	
	public function UserList()
	{
		$msg = '';
		foreach ((App::fetchModel('user', 'listBuddies')) as $user){
			$msg.="<a href=''>$user</a><br />";
		}
		$this->display($msg);
		exit;
	}



		
		
} //end of Class