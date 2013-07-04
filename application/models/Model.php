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
		
	function GetLoginSessionVar()
    	{
        //$retvar = md5($this->rand_key);
        $retvar = md5($rand_key);
        $retvar = 'usr_'.substr($retvar,0,10);
        return $retvar;
		}
		
		
	function GetEmailHost($email)
		{
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
		
	function ChangePasswordInDB($user_rec, $newpwd)
		{
		$newpwd = $this->SanitizeForSQL($newpwd);	
		$qry = "Update $this->tablename Set password='".md5($newpwd)."' Where  user_id=".$user_rec['user_id']."";		
		if(!mysql_query( $qry ,$this->connection))
			{
			$this->HandleDBError("Error updating the password \nquery:$qry");
			return false;
			}     
		return true;
		} //end of function
		
	
	
	
	}// end of Model class
    
    