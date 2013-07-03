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
	    }
  
	public function display($msg=null) 
		{
		$model = App::fetchModel('user');
		$view = App::fetchView();
		$vars['title'] = 'Dashboard';
		$vars['user_name'] = $model->UserFullName();
		$vars['errors'] = $model->GetErrorMessage();
		$vars['msg'] = $msg;
		$vars['profile'] = ControllerDashboard::userProfileArray($_SESSION['user_id']);
        $view::render('dashboard',$vars,1);
        exit;
		}
		
	public function userProfileArray($user_id) 
		{
		$model = App::fetchModel('user');
		$userInfoArray = $model->getUserProfile($user_id);
        return $userInfoArray;
		}
		
		
		
		
	private function action($action)
		{
		switch ($action)
		{
		case "chgpass":
			$this->user_password_chg();
			break;
		case "logout":
			$this->logout_user_dash();
			break;
		case "listBuddies":
			$this->listBuddies();
			break;
		default:
			$this->controller->model->RedirectToURL("?controller=dashboard");
			break;
		
		} // end of switch 
		} // end of action
	
		
		public function user_password_chg()
		{
		if(!$this->controller->model->CheckLogin())
			{
			$this->controller->model->RedirectToURL("?controller=login");
			exit;
			}		
		if(isset($_POST['password_chg_submitted']))
			{
			if($this->user->model->ChangePassword())
				{
				$msg = "Your password is updated!";
				$this->controller->model->RedirectToURL("?controller=dashboard");
				exit;
				}
			}
		$this->controller->getView($this->controller, "Change Password");
		$this->controller->view->render('password_chg');
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
		$this->controller->getView($this->controller,'Reset Password',$msg);
		$this->controller->view->render('message');
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
			$model = App::fetchModel('user');
			$model->LogOut();
			session_destroy();
			$model->RedirectToURL(URL);
			exit;
			}
		
		
		
		
		private function listBuddies() {
			if(!$this->controller->model->CheckLogin())
			{
			$this->controller->model->RedirectToURL("?controller=login");
			exit;
			}
			if (!$this->user->model->DBLogin()) 
			{
			$this->render();
			}
			$buddies = $this->user->model->listBuddies();
			$msg = '';
			foreach ($buddies as $user){
				$msg.="<a href=''>$user</a><br />";
			}
			$this->render($msg);
		}



		
		
} //end of Class