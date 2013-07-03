<?php

class EmailModel extends Model
{
    public function __construct()
	    {
	    parent::__construct();
	    EmailModel::InitSite();
	    EmailModel::SetAdminEmail('ac109158@plusonecompany.info');
	    EmailModel::SetRandomKey('qSRcVS6DrTzrPvr');
	    }

    public function index()
	    {
	    }  
	function InitSite()
		{
	        $this->sitename = 'www.andy.plusonedevelopment.com';
	        $this->rand_key = '0iQx5oBk66oVZep';
	    }
    
	function SetAdminEmail($email)
		{
			$this->admin_email = $email;
		}
		
	function SetWebsiteName($sitename)
		{
			$this->sitename = $sitename;
		}
	
	function SetRandomKey($key)
		{
			$this->rand_key = $key;
		}	
	
	
	


} //end of EmailModel

    