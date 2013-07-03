<?php
class LoginModel extends Model
	{
    public function __construct()
    {
        parent::__construct();
        require_once LIB.'class.phpmailer.php';
    }

    public function index()
    {
    //require_once LIB.'formvalidator.php';
	}
	
	function Login()
		{
		if(empty($_POST['username']))
		{
		    $this->HandleError("UserName is empty!");
		    //echo "fail 1";
		    return false;
		}		
		if(empty($_POST['password']))
		{
		    $this->HandleError("Password is empty!");
		    echo "fail 2";
		    return false;
		}		
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		
		if(!isset($_SESSION)){ session_start(); }
		
		if(!$this->CheckLoginInDB($username,$password))
			{
			echo "fail 3";
		    return false;
			}	
		$_SESSION[$this->GetLoginSessionVar()] = $username;		
		return true;
	   }		
		
	function ResetUserPassword()
		{
		if(empty($_GET['email']))
			{
			$this->HandleError("Email is empty!");
			return false;
			}
		if(empty($_GET['code']))
			{
			$this->HandleError("reset code is empty!");
			return false;
			}
		$email = trim($_GET['email']);
		$code = trim($_GET['code']);
		
		if($this->GetResetPasswordCode($email) != $code)
			{
			$this->HandleError("Bad reset code!");
			return false;
			}		
		$user_rec = array();
		if(!$this->GetUserFromEmail($email,$user_rec))
			{
			return false;
			}		
		$new_password = $this->ResetUserPasswordInDB($user_rec);
		if(false === $new_password || empty($new_password))
			{
			$this->HandleError("Error updating new password");
			return false;
			}		
		if(false == $this->SendNewPassword($user_rec,$new_password))
			{
			$this->HandleError("Error sending new password");
			return false;
			}
		return true;
		}
		
	function GetResetPasswordCode($email)
		{
		return substr(md5($email.$this->sitename.$this->rand_key),0,10);
		}	
	
	private function GetAbsoluteURLFolder()
		{
		$scriptFolder = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on')) ? 'https://' : 'http://';
		$scriptFolder .= $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']);
		return $scriptFolder;
		}
		
		
	private function SendNewPassword($user_rec, $new_password)
		{
		$email = $user_rec['email'];		
		$mailer = new PHPMailer();		
		$mailer->CharSet = 'utf-8';		
		$mailer->AddAddress($email,$user_rec['name']);		
		$mailer->Subject = "Your new password for ".$this->sitename;		
		$mailer->From = $this->GetFromAddress();		
		$mailer->Body ="Hello ".$user_rec['name']."\r\n\r\n".
		"Your password is reset successfully. ".
		"Here is your updated login:\r\n".
		"username:".$user_rec['username']."\r\n".
		"password:$new_password\r\n".
		"\r\n".
		"Login here: ".$this->GetAbsoluteURLFolder()."\r\n".
		"\r\n".
		"Regards,\r\n".
		"Webmaster\r\n".
		$this->sitename;		
		if(!$mailer->Send())
			{
			return false;
			}
		return true;
		}
		
		
	function ResetUserPasswordInDB($user_rec)
		{
		$new_password = substr(md5(uniqid()),0,10);		
		if(false == $this->ChangePasswordInDB($user_rec,$new_password))
			{
			return false;
			}
		return $new_password;
		}

	function SendResetPasswordLink($user_rec)
		{
		echo "here";
		$email = $user_rec['email'];		
		$mailer = new PHPMailer();		
		$mailer->CharSet = 'utf-8';		
		$mailer->AddAddress($email,$user_rec['name']);		
		$mailer->Subject = "Your reset password request at ".$this->sitename;		
		$mailer->From = $this->GetFromAddress();		
		$link = $this->GetAbsoluteURLFolder().
		'/?controller=login&task=reset_pwd&email='.
		urlencode($email).'&code='.
		urlencode($this->GetResetPasswordCode($email));		
		$mailer->Body ="Hello ".$user_rec['name']."\r\n\r\n".
		"There was a request to reset your password at ".$this->sitename."\r\n".
		"Please click the link below to complete the request: \r\n".$link."\r\n".
		"Regards,\r\n".
		"Webmaster\r\n".
		$this->sitename;		
		if(!$mailer->Send())
			{
			return false;
			}
		return true;
		}
		
	function EmailResetPasswordLink()
		{
		if(empty($_POST['email']))
			{
			$this->HandleError("Email is empty!");
			return false;
			}
		$user_rec = array();
		if(false === $this->GetUserFromEmail($_POST['email'], $user_rec))
			{
			return false;
			}
		if(false === $this->SendResetPasswordLink($user_rec))
			{
			return false;
			}
		return true;
		}
		
	function GetFromAddress()
		{
		if(!empty($this->from_address))
			{
			return $this->from_address;
			}			
		$host = $_SERVER['SERVER_NAME'];		
		$from ="no_reply@$host";
		return $from;
		}	
	
	}