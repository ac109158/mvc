

<?php

class RegisterModel extends Model
{
    public function __construct()
    {
	    parent::__construct();
	 }
	 
	 function ConfirmUser()
	{
		if(empty($_REQUEST['key'])||strlen($_REQUEST['key'])<=10)	{ return array(false, 'Please provide the confirm key');}
		$user_rec = array();
		if(!$this->UpdateDBRecForConfirmation($user_rec)) { return false; }
		$this->SendUserWelcomeEmail($user_rec);	
		$this->SendAdminIntimationOnRegComplete($user_rec);	
		return true;
	}   //end of ConfirmUser
	   
	function RegisterUser()
	{
		if(!isset($_POST['submitted'])) { return array(false); }
		$formvars = array();	
		$result = $this->ValidateRegistrationSubmission();
		if($result !== true) { return $result; }
		$this->CollectRegistrationSubmission($formvars); 
		$result = $this->SaveToDatabase($formvars);
		if($result !== true) { return $result; }
		$result = $this->SendUserConfirmationEmail($formvars);
		if($result !== true) { return $result; }
		$this->SendAdminIntimationEmail($formvars);	
		return true;
		}//end of RegisterUser function
		
	function CollectRegistrationSubmission(&$formvars)
	{
		$formvars['first_name'] = $this->Sanitize($_POST['first_name']);
		$formvars['last_name'] = $this->Sanitize($_POST['last_name']);
		$formvars['email'] = $this->Sanitize($_POST['email']);
		$formvars['phone_number'] = App::numbersOnly($_POST['phone_number']);
		$formvars['phone_number'] = $this->Sanitize($formvars['phone_number']);		
		$formvars['username'] = $this->Sanitize($_POST['username']);
		$formvars['password'] = $this->Sanitize($_POST['password']);
	} 
	
	function ValidateRegistrationSubmission()
	{
		//This is a hidden input field. Humans won't fill this field.
		if(!empty($_POST[ $this->GetSpamTrapInputName() ] ) ) 
		{ 
			//The proper error is not given intentionally
			return array("Automated submission prevention: case 2 failed", false);
		}
		require_once LIB.'formvalidator.php';
		$validator = new FormValidator();
		$validator->addValidation("first_name","req","Please fill in First Name");
		$validator->addValidation("last_name","req","Please fill in Last Name");
		$validator->addValidation("email","email","The input for Email should be valid");
		$validator->addValidation("email","req","Please fill in Email");
		$validator->addValidation("phone_number","req","Please fill in Phone Number");
		$validator->addValidation("phone_number","phone","The input for Phone Number should be valid");
		$validator->addValidation("username","req","Please fill in UserName");
		$validator->addValidation("password","req","Please fill in Password");
		$validator->addValidation("confirm_password","req","Please fill in Confirm with your Password");
		if(!$validator->ValidateForm())
			{
			$error='';
			$error_hash = $validator->GetErrors();
			/*
foreach($error_hash as $inpname => $inp_err)
				{
				$error .= $inpname.':'.$inp_err."<br />";
				}
*/
			return array(false, array_shift($error_hash)); // just want the first error for cosmetic purposes
			}
		return true;
		}       
    
	function InsertIntoDB(&$formvars)
	{
		$confirmcode = $this->MakeConfirmationMd5($formvars['email']);	
		$invite_code = $this->MakeConfirmationMd5($formvars['email']);	
		$formvars['confirmcode'] = $confirmcode;	
		$insert_query = 'insert into '.$this->tablename.'(
			first_name,
			last_name,
			email,
			phone_number,
			username,
			password,
			confirmcode,
			invite_code,
			date_registered
			)
			values
			(
			"' . $this->SanitizeForSQL($formvars['first_name']) . '",
			"' . $this->SanitizeForSQL($formvars['last_name']) . '",
			"' . $this->SanitizeForSQL($formvars['email']) . '",
			"' . $this->SanitizeForSQL($formvars['phone_number']) . '",
			"' . $this->SanitizeForSQL($formvars['username']) . '",
			"' . md5($formvars['password']) . '",
			"' . $confirmcode . '",
			"' . $invite_code . '",
			"now()"
		)';
		  
		if(!mysql_query( $insert_query ,$this->connection) ) { $this->HandleDBError("Error inserting data to the table\nquery:$insert_query" ); return false; }        
		return true;
	}
	
	function DBLogin()
	{
		$this->connection = mysql_connect($this->db_host,$this->username,$this->pwd);
			
		if(!$this->connection) { $this->HandleDBError( 'Database Login failed! Please make sure that the DB login credentials provided are correct' ); return false; 	}
		if(!mysql_select_db($this->database, $this->connection)) { $this->HandleDBError('Failed to select database: '.$this->database.' Please make sure that the database name provided is correct'); return false; }
		if(!mysql_query("SET NAMES 'UTF8'",$this->connection)) { $this->HandleDBError( 'Error setting utf8 encoding' ); return false; }
		return true;
	}  
		
	function SaveToDatabase(&$formvars)
	{
		if ( !$this->DBLogin() ) { return array(false,'Database login failed!'); }
		if ( !$this->IsFieldUnique( $formvars,'email' ) ) { return array(false,"This email is already registered"); }
		if ( !$this->IsFieldUnique( $formvars,'username') ) 	{ return array(false,'This UserName is already registered'); }        
		if ( !$this->InsertIntoDB( $formvars ) ) { return array(false, 'Inserting to Database failed!'); }
		return true;
	}
		
	function IsFieldUnique($formvars,$fieldname)
	{
		$field_val = $this->SanitizeForSQL($formvars[$fieldname]);
		$qry = "select username from $this->tablename where $fieldname='".$field_val."'";
		$result = mysql_query($qry,$this->connection);
		
		if($result && mysql_num_rows($result) > 0) { return false; }
		return true;
	}
	
	function UpdateDBRecForConfirmation(&$user_rec)
	{
		if(!$this->DBLogin()) 
		{
			return array(false, '"Database login failed!'); 
			return false;
		}  
		$confirmcode = $this->SanitizeForSQL($_REQUEST['key']);
		$query = "Select first_name AS name, email from $this->tablename where confirmcode='".$confirmcode."'";
		$result = mysql_query("$query",$this->connection);   
		if( !$result || mysql_num_rows($result) <= 0 ) 
		{
			return array(false, 'Wrong confirm key.'); 
		}
		$row = mysql_fetch_assoc($result);
		$user_rec['name'] = $row['name']; $user_rec['email']= $row['email'];		
		$qry = "Update $this->tablename Set confirmcode='y' Where  confirmcode='".$confirmcode."'";
		if( !mysql_query( $qry ,$this->connection) ) 
		{ 
			$this->HandleDBError("Error inserting data to the table\nquery:$qry"); 
			return false; 
		}      
		return true;
	}
	
	function MakeConfirmationMd5($email)
	{
		$randno1 = rand();
		$randno2 = rand();		
		return md5($email.$this->rand_key.$randno1.''.$randno2);
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
		
		if(!$mailer->Send())	{return array(false, "Failed sending user welcome email.");}
		return true;
	}
		
	function SendAdminIntimationOnRegComplete(&$user_rec)
	{
		if(empty($this->admin_email)){	return false;}
		require_once LIB.'class.phpmailer.php';
		$mailer = new PHPMailer();		
		$mailer->CharSet = 'utf-8';		
		$mailer->AddAddress($this->admin_email);		
		$mailer->Subject = "Registration Completed: ".$user_rec['name'];		
		$mailer->From = $this->GetFromAddress();	
		$mailer->Body ="A new user registered at ".$this->sitename."\r\n".
		"Name: ".$user_rec['name']."\r\n".
		"Email address: ".$user_rec['email']."\r\n";
		if(!$mailer->Send())	{return false;}
		return true;
	}
	
	function SendUserConfirmationEmail(&$formvars)
	{	
		require_once LIB.'class.phpmailer.php';
		$mailer = new PHPMailer();	
		$mailer->CharSet = 'utf-8';	
		$mailer->AddAddress($formvars['email'],$formvars['name']);	
		$mailer->Subject = "Your registration with ".$this->sitename;	
		$mailer->From = $this->GetFromAddress(); 
		$confirmcode = $formvars['confirmcode'];	
		$confirm_url = URL.'/?controller=confirm&task=validate&key='."$confirmcode";	
		$mailer->Body ="Hello ".$formvars['name']."\r\n\r\n".
		"Thanks for your registration with ".$this->sitename."\r\n".
		"Please click the link below to confirm your registration.\r\n".
		"$confirm_url\r\n".
		"\r\n".
		"Regards,\r\n".
		"Webmaster\r\n".
		$this->sitename;
		
		if ( !$mailer->Send() ) { return array(false, 'Failed sending registration confirmation email.');}
		return true;
	}
	
	function SendAdminIntimationEmail(&$formvars)
	{
		if ( empty( $this->admin_email )) { return false; }
		require_once LIB.'class.phpmailer.php';
		$mailer = new PHPMailer();	
		$mailer-> CharSet = 'utf-8';	
		$mailer->AddAddress( $this->admin_email );	
		$mailer->Subject = "New registration: ".$formvars['name'];	
		$mailer->From = $this->GetFromAddress();		
		$mailer->Body = "A new user registered at ".$this->sitename."\r\n".
		"Name: ".$formvars['name']."\r\n".
		"Email address: ". $formvars['email'] . "\r\n".
		"UserName: ". $formvars['username'];
		if ( !$mailer->Send() ) { return array(false); }
		return true;
	}
		
	function GetFromAddress()
	{
		if(!empty($this->from_address)){return $this->from_address;}		
		$host = $_SERVER['SERVER_NAME'];		
		$from ="nobody@$host";
		return $from;
	}	
    
} // end of RegisterModel