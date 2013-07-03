<?php

class ControllerHello extends Controller {

    function __construct() {
        parent::__construct(); 
    }
    
    public function index() {
        echo "<p>Hello World</p>";        
            }
            
            
	public function checkDatabase() {
		$model = new Model;
		$result = $model->db->select("SELECT CONCAT_WS(' ', first_name, last_name, role) as name FROM user"); 
		foreach($result as $value)
		$stringval.=  implode(",", $value) .', ';		
		echo $stringval;
		}
}