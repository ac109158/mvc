<?php
class DbModel extends Model
	{
    public function __construct()
	    {
		parent::__construct();
		parent::__construct();
		$this->InitDB(/*hostname*/'mysql.andy.plusonedevelopment.com',
		      /*username*/'andy2013',
		      /*password*/'PlusOne',
		      /*database name*/'andy_database',
		      /*table name*/'fgusers3');
		 }
		
	function InitDB($host,$uname,$pwd,$database,$tablename){
		$this->db_host  = $host;
		$this->username = $uname;
		$this->pwd  = $pwd;
		$this->database  = $database;
		$this->tablename = $tablename;
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
		
	function HandleDBError($err)
		{
		$this->HandleError($err."\r\n mysqlerror:".mysql_error());
		}
		
	function CheckLoginInDB($username,$password)
		{
		if(!$this->DBLogin())
			{
			$this->HandleError("Database login failed!");
			return false;
			}          
		$username = $this->SanitizeForSQL($username);
		$pwdmd5 = md5($password);
		$qry = "Select CONCAT(first_name, ' ', last_name) as name, email, user_id from $this->tablename where username='$username' and password='$pwdmd5' and confirmcode='y'";	
		$result = mysql_query($qry,$this->connection);		
		if(!$result || mysql_num_rows($result) <= 0)
			{
			$this->HandleError("Error logging in. The username or password does not match");
			return false;
			}		
		$row = mysql_fetch_assoc($result);	
		$_SESSION['name_of_user']  = $row['name'];
		$_SESSION['email_of_user'] = $row['email'];				
		$_SESSION['user_id'] = $row['user_id'];				
		return true;
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
		
		
	
	}