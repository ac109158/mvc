<?php
class DashboardModel extends Model
	{
    public function __construct()
    {
        parent::__construct();
    }

	function CheckLogin()
		{
		if(!isset($_SESSION)){ session_start(); }
		
		$sessionvar = $this->GetLoginSessionVar();
		
		if(empty($_SESSION[$sessionvar]))
		{
		return false;
		}
		return true;
		}
		
	function GetLoginSessionVar()
		{
		$retvar = md5($this->rand_key);
		$retvar = 'usr_'.substr($retvar,0,10);
		return $retvar;
		}
	} //end of Class
   