<?php
class DatabaseModel extends Model
	{
    public function __construct()
    {
        parent::__construct();
    }
		
	function HandleDBError($err)
		{
		$this->HandleError($err."\r\n mysqlerror:".mysql_error());
		}
		
	
	function CreateTable()
		{
		$qry = "Create Table $this->tablename (".
		"id_user INT NOT NULL AUTO_INCREMENT ,".
		"name VARCHAR( 128 ) NOT NULL ,".
		"email VARCHAR( 64 ) NOT NULL ,".
		"phone_number VARCHAR( 16 ) NOT NULL ,".
		"username VARCHAR( 16 ) NOT NULL ,".
		"password VARCHAR( 32 ) NOT NULL ,".
		"confirmcode VARCHAR(32) ,".
		"PRIMARY KEY ( id_user )".
		")";		
		if(!mysql_query($qry,$this->connection))
			{
			$this->HandleDBError("Error creating the table \nquery was\n $qry");
			return false;
			}
		return true;
		}
		}