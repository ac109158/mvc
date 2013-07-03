<?php
class Model {

    function __construct() {	
    $this->InitDB(/*hostname*/'mysql.andy.plusonedevelopment.com',
                      /*username*/'andy2013',
                      /*password*/'PlusOne',
                      /*database name*/'andy_database',
                      /*table name*/'fgusers3');  
	$this->sitename = 'www.andy.plusonedevelopment.com/mvc';
	$this->rand_key = '0iQx5oBk66oVZep';
	$rand_key = '0iQx5oBk66oVZep';
	$this->admin_email='ac109158@plusonecompany.info';
	$this->error_message = array();
    }
    
	function InitDB($host,$uname,$pwd,$database,$tablename){
		$this->db_host  = $host;
		$this->username = $uname;
		$this->pwd  = $pwd;
		$this->database  = $database;
		$this->tablename = $tablename;
	}
	
	function Sanitize($str,$remove_nl=true)
	{
	$str = $this->StripSlashes($str);	
	if($remove_nl)
		{
		$injections = array('/(\n+)/i',
		'/(\r+)/i',
		'/(\t+)/i',
		'/(%0A+)/i',
		'/(%0D+)/i',
		'/(%08+)/i',
		'/(%09+)/i'
		);
		$str = preg_replace($injections,'',$str);
		}	
	return $str;
	} 
	
	function StripSlashes($str)
	{
	if(get_magic_quotes_gpc())
		{
		$str = stripslashes($str);
		}
	return $str;
	}
	
	function SanitizeForSQL($str)
	{
	if( function_exists( "mysql_real_escape_string" ) )
		{
		$ret_str = mysql_real_escape_string( $str );
		}
	else
		{
		$ret_str = addslashes( $str );
		}
	return $ret_str;
	}
	
	function GetSelfScript()
		{
		return htmlentities($_SERVER['PHP_SELF']);
		}    
		
	function SafeDisplay($value_name)
		{
		if(empty($_POST[$value_name]))
			{
			return'';
			}
		return htmlentities($_POST[$value_name]);
		}
		
	function RedirectToURL($url)
		{
		header("Location: $url");
		exit;
		}
		
	function GetSpamTrapInputName()
		{
		return 'sp'.md5('KHGdnbvsgst'.$this->rand_key);
		}
		
	 function GetErrorMessage()
	 	{
	 	$result = $this->error_message;
        if(empty($result))
        {
            return '';
        }
 
        foreach ($result as $error => $msg){
        	$errormsg .= nl2br(htmlentities($msg)).'<br />';
        }        
        return $errormsg;
		}  
	
	function HandleError($err)
		{
		//echo 'Function: RegisterModel-HandleError($err)<br /> ';
		$this->error_message[] = ($err);
		}
		
	function GetLoginSessionVar()
    	{
        //$retvar = md5($this->rand_key);
        $retvar = md5($rand_key);
        $retvar = 'usr_'.substr($retvar,0,10);
        return $retvar;
		}
		
		
	function GetEmailHost($email)
		{
		echo "email is $email";
		$email = $email;
		$sign_loc = strpos("$email", "@");
		$dot_loc = strrpos("$email", ".");
		if ($sign_loc != false && $dot_loc != false && $dot_loc > $sign_loc)
			{
			$email = substr($email, 0,$dot_loc);
			$host = substr($email, (strpos($email, '@')+1));
			//$msg.=' Host: '.$host.' ';
			} 
		else 
			{
			//echo 4;
			$msg = "Email is invalid";
			}
			
	switch ($host) 
		{
		case 'gmail':
			$msg.='<a href="https://www.gmail.com">Gmail</a>';
			break;
		case 'zoho':
			$msg.='<a href="https://www.zoho.com/mail/">Zoho</a>';
			break;
		case 'aim':
			$msg.='<a href="https://www.aim.com">AIM</a>';
			break;
		case 'outlook':
			$msg.='<a href="https://www.outlook.com/mail">Outlook</a>';
			break;
		case 'cpaz':
			$msg.='<a href="https://www.cpaz.net/">CPAZ</a>';
			break;
		case 'msn':
			$msg.='<a href="https://login.live.com">MSN</a>';
			break;
		case 'hotmail':
			$msg.='<a href="https://login.live.com">Hotmail</a>';
			break;
		case 'yahoo':
			$msg.='<a href="https://login.yahoo.com">Yahoo!</a>';
			break;
		case 'plusonecompany':
			$msg.='<a href="https://www.gmail.com">Gmail</a>';
			break;		
		default:
			$msg.='your email';
			break;
		}
	return $msg;
	}
	
	function GetUserFromEmail($email,&$user_rec)
		{
        if(!$this->DBLogin())
        	{
            $this->HandleError("Database login failed!");
            return false;
			}   
        $email = $this->SanitizeForSQL($email);        
        $result = mysql_query("Select * from $this->tablename where email='$email'",$this->connection); 
        if(!$result || mysql_num_rows($result) <= 0)
        	{
            $this->HandleError("There is no user with email: $email");
            return false;
			}
        $user_rec = mysql_fetch_assoc($result);        
        return true;
		}
		
		function ChangePasswordInDB($user_rec, $newpwd)
		{
		$newpwd = $this->SanitizeForSQL($newpwd);		
		$qry = "Update $this->tablename Set password='".md5($newpwd)."' Where  id_user=".$user_rec['id_user']."";		
		if(!mysql_query( $qry ,$this->connection))
			{
			$this->HandleDBError("Error updating the password \nquery:$qry");
			return false;
			}     
		return true;
		} //end of function
		
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
		
		function HandleDBError($err)
		{
		$this->HandleError($err."\r\n mysqlerror:".mysql_error());
		}
	
	
	
	}// end of Model class
    
    