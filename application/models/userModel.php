<?php
class UserModel extends Model
	{
    public function __construct()
	    {
		parent::__construct();
					
		}
		
	function UserFullName()
		{
		return isset($_SESSION['name_of_user'])?$_SESSION['name_of_user']:'';
		}
	
	function UserEmail()
		{
		return isset($_SESSION['email_of_user'])?$_SESSION['email_of_user']:'';
		}
		
		
	public function detectLogin() 
		{
		$detect = UserModel::CheckLogin();
		return $detect;
		}
	
	private function CheckLogin()
    	{
         if(!isset($_SESSION)){ session_start(); }
         $sessionvar = Model::GetLoginSessionVar();   
         if(empty($_SESSION[$sessionvar]))
	         {
	            return false;
	         }
         return true;
		 }
		
	function ChangePassword()
		{
		if(!$this->CheckLogin())
			{
			$this->HandleError("Not logged in!");
			return false;
			}		
		if(empty($_POST['oldpwd']))
			{
			$this->HandleError("Old password is empty!");
			return false;
			}
		if(empty($_POST['newpwd']))
			{
			$this->HandleError("New password is empty!");
			return false;
			}		
		$user_rec = array();
		if(!$this->GetUserFromEmail($this->UserEmail(),$user_rec))
			{
			return false;
			}			
		$pwd = trim($_POST['oldpwd']);		
		if($user_rec['password'] != md5($pwd))
			{
			$this->HandleError("The old password does not match!");
			return false;
			}
		$newpwd = trim($_POST['newpwd']);		
		if(!$this->ChangePasswordInDB($user_rec, $newpwd))
			{
			return false;
			}
		return true;
		} // end ChangePassword	
		
		
		function LogOut()
			{
			session_start();			
			$sessionvar = $this->GetLoginSessionVar();			
			$_SESSION[$sessionvar]=NULL;			
			unset($_SESSION[$sessionvar]);
			}
			
		function listBuddies() {
			$users = array(); 
			$qry = "Select CONCAT(first_name,' ', last_name) as name from $this->tablename";
			$result = mysql_query($qry,$this->connection);	
			while ($row = mysql_fetch_row($result)) {
			$users[] = $row[0];
			}			
			return $users;			
			
		}
		
		
	function getUserProfile($user_id)
		{
		if(!$this->DBLogin())
			{
			$this->HandleError("Database login failed!");
			echo "fail 4";
			return false;
			}          
		$user_id = $this->SanitizeForSQL($user_id);
		$qry = "Select * from $this->tablename where user_id='$user_id'";
		$result = mysql_query($qry,$this->connection);		
		if(!$result || mysql_num_rows($result) <= 0)
			{
			$this->HandleError("Error retrieving info. This user does not exist");
			return false;
			}
		$row = mysql_fetch_assoc($result);
		$uservars = array();	
		foreach ($row as $field => $value){
			$uservars["$field"] = $value;
		}			
		return $uservars;
		}
	
	function hey() {
		echo "wassssssuuuuuuppp";
	}
		
		
	} //end of UserModel