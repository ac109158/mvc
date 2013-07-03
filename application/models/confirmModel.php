<?php

class ConfirmModel extends Model
{
    public function __construct()
	    {
	    parent::__construct();
	    }

    public function index()
    	{
    	require_once LIB.'formvalidator.php';	    
    	}
    
	function ConfirmUser()
		{
		if(empty($_REQUEST['key'])||strlen($_REQUEST['key'])<=10)
			{
			$this->HandleError("Please provide the confirm key");
			return false;
			}
		$user_rec = array();
		if(!$this->UpdateDBRecForConfirmation($user_rec))
			{
			return false;
			}
		$this->SendUserWelcomeEmail($user_rec);	
		$this->SendAdminIntimationOnRegComplete($user_rec);	
		return true;
		}   //end of ConfirmUser
		
	function HandleError($err)
		{
		$this->error_message .= $err."\r\n";
		}
		
		function UpdateDBRecForConfirmation(&$user_rec)
		{
		if(!$this->DBLogin())
			{
			$this->HandleError("Database login failed!");
			return false;
			}  
		$confirmcode = $this->SanitizeForSQL($_REQUEST['key']);
		$query = "Select first_name AS name, email from $this->tablename where confirmcode='".$confirmcode."'";
		$result = mysql_query("$query",$this->connection);   
		if(!$result || mysql_num_rows($result) <= 0)
			{
			$this->HandleError("Wrong confirm key.");
			return false;
			}
		$row = mysql_fetch_assoc($result);
		$user_rec['name'] = $row['name'];
		$user_rec['email']= $row['email'];		
		$qry = "Update $this->tablename Set confirmcode='y' Where  confirmcode='".$confirmcode."'";
		if(!mysql_query( $qry ,$this->connection))
			{
			$this->HandleDBError("Error inserting data to the table\nquery:$qry");
			return false;
			}      
		return true;
		}
		
	function DBLogin()
		{
		
		$this->connection = mysql_connect($this->db_host,$this->username,$this->pwd);
		
		if(!$this->connection)
			{   
			$this->HandleDBError("Database Login failed! Please make sure that the DB login credentials provided are correct");
			return false;
			}
		if(!mysql_select_db($this->database, $this->connection))
			{
			$this->HandleDBError('Failed to select database: '.$this->database.' Please make sure that the database name provided is correct');
			return false;
			}
		if(!mysql_query("SET NAMES 'UTF8'",$this->connection))
			{
			$this->HandleDBError('Error setting utf8 encoding');
			return false;
			}
		return true;
		}
		
	function SendUserWelcomeEmail(&$user_rec)
		{
		require_once LIB.'class.phpmailer.php';
		$mailer = new PHPMailer();		
		$mailer->CharSet = 'utf-8';		
		$mailer->AddAddress($user_rec['email'],$user_rec['name']);		
		$mailer->Subject = "Welcome to ".$this->sitename;		
		$mailer->From = $this->GetFromAddress();		
		$mailer->Body ="Hello ".$user_rec['name']."\r\n\r\n".
		"Welcome! Your registration  with ".$this->sitename." is completed.\r\n".
		"\r\n".
		"Regards,\r\n".
		"Webmaster\r\n".
		$this->sitename;		
		if(!$mailer->Send())
			{
			$this->HandleError("Failed sending user welcome email.");
			return false;
			}
		return true;
		}
		
	function SendAdminIntimationOnRegComplete(&$user_rec)
		{
		if(empty($this->admin_email))
			{
			return false;
			}
		$mailer = new PHPMailer();		
		$mailer->CharSet = 'utf-8';		
		$mailer->AddAddress($this->admin_email);		
		$mailer->Subject = "Registration Completed: ".$user_rec['name'];		
		$mailer->From = $this->GetFromAddress();	
		$mailer->Body ="A new user registered at ".$this->sitename."\r\n".
		"Name: ".$user_rec['name']."\r\n".
		"Email address: ".$user_rec['email']."\r\n";		
		if(!$mailer->Send())
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
		$from ="nobody@$host";
		return $from;
		} 
    
    
    
    

}

?>