<?php
class ErrorModel extends Model
	{
    public function __construct()
    {
        parent::__construct();
        $this->db_errors = '';
        $this->form_errors = '';
        $this->error_message = '';
    }
    
	}