<?php

class RegisterModel extends Model
{
    public function __construct()
	    {
	    parent::__construct();

	    }

    public function index()
	    {
	    require_once LIB.'formvalidator.php';
	    }
	   
	function RegisterUser()
		{
		if(!isset($_POST['submitted']))
			{
			return false;
			}
		$formvars = array();	
		if(!$this->ValidateRegistrationSubmission())
			{
			return false;
			}
		$this->CollectRegistrationSubmission($formvars);	
		if(!$this->SaveToDatabase($formvars))
			{
			return false;
			}
		if(!$this->SendUserConfirmationEmail($formvars))
			{
			return false;
			}
		$this->SendAdminIntimationEmail($formvars);	
		return true;
		}//end of RegisterUser function
	
	function ValidateRegistrationSubmission()
		{
		//This is a hidden input field. Humans won't fill this field.
		if(!empty($_POST[$this->GetSpamTrapInputName()]) )
			{
			//The proper error is not given intentionally
			$this->HandleError("Automated submission prevention: case 2 failed");
			return false;
			}
		$validator = new FormValidator();
		$validator->addValidation("first_name","req","Please fill in first name");
		$validator->addValidation("last_name","req","Please fill in last name");
		$validator->addValidation("email","email","The input for Email should be a valid email value");
		$validator->addValidation("email","req","Please fill in Email");
		$validator->addValidation("phone_number","req","Please fill in phone number");
		$validator->addValidation("phone_number","phone","The input for phone number should be valid");
		$validator->addValidation("username","req","Please fill in UserName");
		$validator->addValidation("password","req","Please fill in Password");
		$validator->addValidation("confirm_password","req","Please confirm your password");
		if(!$validator->ValidateForm())
			{
			$error='';
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err)
				{
				$error .= $inpname.':'.$inp_err."\n";
				}
			$this->HandleError($error);
			return false;
			}
		return true;
		}    
    
	function CollectRegistrationSubmission(&$formvars)
		{
		$formvars['first_name'] = $this->Sanitize($_POST['first_name']);
		$formvars['last_name'] = $this->Sanitize($_POST['last_name']);
		$formvars['email'] = $this->Sanitize($_POST['email']);
		$formvars['phone_number'] = $this->Sanitize($_POST['phone_number']);
		$formvars['username'] = $this->Sanitize($_POST['username']);
		$formvars['password'] = $this->Sanitize($_POST['password']);
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
		if(!mysql_query( $insert_query ,$this->connection))
			{
			$this->HandleDBError("Error inserting data to the table\nquery:$insert_query");
			return false;
			}        
		return true;
		} //end of InsertIntoDB
	
	function MakeConfirmationMd5($email)
		{
		$randno1 = rand();
		$randno2 = rand();
		return md5($email.$this->rand_key.$randno1.''.$randno2);
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
		
	function SaveToDatabase(&$formvars)
		{
		if(!$this->DBLogin())
			{
			$this->HandleError("Database login failed!");
			return false;
			}
		if(!$this->Ensuretable())
			{
			return false;
			}
		if(!$this->IsFieldUnique($formvars,'email'))
			{
			$this->HandleError("This email is already registered");
			return false;
			}
		
		if(!$this->IsFieldUnique($formvars,'username'))
			{
			$this->HandleError("This UserName is already used. Please try another username");
			return false;
			}        
		if(!$this->InsertIntoDB($formvars))
			{
			$this->HandleError("Inserting to Database failed!");
			return false;
			}
		return true;
		}
		
	function Ensuretable()
		{
		$result = mysql_query("SHOW COLUMNS FROM $this->tablename");   
		if(!$result || mysql_num_rows($result) <= 0)
			{
			return $this->CreateTable();
			}
		return true;
		}
		
	function IsFieldUnique($formvars,$fieldname)
		{
		$field_val = $this->SanitizeForSQL($formvars[$fieldname]);
		$qry = "select username from $this->tablename where $fieldname='".$field_val."'";
		$result = mysql_query($qry,$this->connection);   
		if($result && mysql_num_rows($result) > 0)
			{
			return false;
			}
		return true;
		}
		
	function SendUserConfirmationEmail(&$formvars)
		{
		echo "sending user email";
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
		if(!$mailer->Send())
			{
			$this->HandleError("Failed sending registration confirmation email.");
			return false;
			}
		echo "done sending user email";
		return true;
		}
		
	function SendAdminIntimationEmail(&$formvars)
		{
		echo "starting to send email";
		if(empty($this->admin_email))
			{
			echo "$this->admin_email";
			return false;
			}
		$mailer = new PHPMailer();	
		$mailer->CharSet = 'utf-8';	
		$mailer->AddAddress($this->admin_email);	
		$mailer->Subject = "New registration: ".$formvars['name'];	
		$mailer->From = $this->GetFromAddress();	
		$mailer->Body ="A new user registered at ".$this->sitename."\r\n".
		"Name: ".$formvars['name']."\r\n".
		"Email address: ".$formvars['email']."\r\n".
		"UserName: ".$formvars['username'];	
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
		
    
} // end of RegisterModel