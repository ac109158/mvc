<?php
class LoginModel extends Model
	{
    public function __construct()
    {
        parent::__construct();   
    }

	
	function Login()
		{
		if(empty($_POST['username']))
		{
		   return  array(false,'UserName is empty!');
		}
		if(empty($_POST['password']))
		{
		    return array(false, 'Password is empty!');
		}
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);		
		if(!isset($_SESSION)){ session_start(); }
		$result = $this->CheckLoginInDB($username,$password);
		if($result !== true )
			{
		    return array(false,'The Username or Password does not match!');
			}
		$_SESSION[$this->GetLoginSessionVar()] = $username;
		//$this->setChatActive();
		
		return true;
	   }
	   
	   
	   private function setChatActive() {
		   echo json_encode(array('success' => true));
	   }
	   public function CheckLoginInDB($username,$password)
		{
			$result = $this->DBLogin();
			if($result !== true)
				{
				return $result[] = "Database login failed!";
				}          
			$username = $this->SanitizeForSQL($username);
			$pwdmd5 = md5($password);
			$qry = "Select CONCAT(first_name, ' ', last_name) as name, email, user_id from $this->tablename where username='$username' and password='$pwdmd5' and confirmcode='y'";	
			$result = mysql_query($qry,$this->connection);		
			if(!$result || mysql_num_rows($result) <= 0)
				{
				return array(false, "Error logging in. The username or password does not match");
				}		
			$row = mysql_fetch_assoc($result);	
			$name = $_SESSION['name_of_user']  = $row['name'];
			$_SESSION['email_of_user'] = $row['email'];				
			$_SESSION['user_id'] = $row['user_id'];
			require_once('pusher_config.php');
			if(!$this->setActive($username, $_SESSION['email_of_user'])){return false;}			
			return true;
		}
		
		
	function setActive($username, $email)
	{
		$insert_query = "Update $this->tablename  SET status = '1' WHERE username = '$username' AND email='$email'";
		//echo $insert_query;  
		if(!mysql_query( $insert_query ,$this->connection) ) { return false;}
		App::fetchModel('pusher');
		$msg = $_SESSION['name_of_user'] .  " has logged in";
		PusherModel::trigger_activity('all', $msg, 'SYSTEM', 'page-load' );       
		return true;
	}
	
	function setInactive()
			{
				$user_id = $_SESSION['user_id'];
				$con = mysqli_connect("$this->db_host","$this->username","$this->pwd", "$this->database");
				if (mysqli_connect_errno($con))
					{
					echo "Failed to connect to MySQL: " . mysqli_connect_error();
					mysqli_close($con);
					exit;
					}
				$qry = "Update $this->tablename SET status = '0' WHERE user_id = '$user_id'";
				//echo $qry;
				$result = mysqli_query($con, $qry);
				if($result && mysqli_affected_rows($con) <= 0)
				{	
				return false;
				}
				return true;
			}
			
	function checkActive($id) 
	{
			$con = mysqli_connect("$this->db_host","$this->username","$this->pwd", "$this->database");
			if (mysqli_connect_errno($con))
				{
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
				mysqli_close($con);
				exit;
				}
			$qry = "SELECT status FROM $this->tablename WHERE user_id = '$id' LIMIT 1";
			$result = mysqli_query($con, $qry);
			$row = mysqli_fetch_row($result);
			if( $row[0] != '1') {return false;} 
			return true;			
		}
		
	function DBLogin()
    	{
        $this->connection = mysql_connect($this->db_host,$this->username,$this->pwd);
        if(!$this->connection)
        	{   
            return array(false,"Database Login failed! Please make sure that the DB login credentials provided are correct");
			}
        if(!mysql_select_db($this->database, $this->connection))
        	{
            return array(false,"Failed to select database: '.$this->database.' Please make sure that the database name provided is correct");
			}
        if(!mysql_query("SET NAMES 'UTF8'",$this->connection))
        	{
            return array(false,'Error setting utf8 encoding');
			}
        return true;
		}
		
	function GetUserFromEmail($email,&$user_rec)
		{
		$result = LoginModel::DBLogin();
        if($result !== true)
        	{
            return $result[] = 'Database login failed!';
			}   
        $email = $this->SanitizeForSQL($email);        
        $result = mysql_query("Select * from $this->tablename where email='$email'",$this->connection); 
        if(!$result || mysql_num_rows($result) <= 0)
        	{
            return array("There is no user with email: $email");
			}
        $user_rec = mysql_fetch_assoc($result);        
        return true;
		}
		
		
	function ResetUserPassword()
		{
		if(empty($_GET['email']))
			{
			return "Email is empty!";
			}
		if(empty($_GET['code']))
			{
			return "Reset code is empty!";
			}
		$email = trim($_GET['email']);
		$code = trim($_GET['code']);
		
		if($this->GetResetPasswordCode($email) != $code)
			{
			return "Bad reset code!";
			}		
		$user_rec = array();
		if(!$this->GetUserFromEmail($email,$user_rec))
			{
			return "Error";
			}		
		$new_password = $this->ResetUserPasswordInDB($user_rec);
		if(false === $new_password || empty($new_password))
			{
			return "Error updating new password";
			}		
		if(false == $this->SendNewPassword($user_rec,$new_password))
			{
			return "Error sending new password";
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
		require_once LIB.'class.phpmailer.php';
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
		require_once LIB.'class.phpmailer.php';
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
			return array("Email is empty!");
			}
		$user_rec = array();
		if(false === $this->GetUserFromEmail($_POST['email'], $user_rec))
			{
			return array("Error");
			}
		if(false === $this->SendResetPasswordLink($user_rec))
			{
			return array("That email is not registered to a user!");
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