<?php
class ControllerAjax {

    function __construct() 
    {
    }
    
    private function getLocalVars($array) 
    {
	    return $array;
    }
    
    public function validate()
	{
	    $validateValue=$_REQUEST['fieldValue'];
		$validateId=$_REQUEST['fieldId'];
		$validateError= "This username is already taken";
		$validateSuccess= "This username is available";
		/* RETURN VALUE */
		$arrayToJs = array();
		$arrayToJs[0] = $validateId;
		$formvars[$validateId] = $validateValue;
		$formvars[0] = $validateId;
		$result = ControllerAjax::IsUnique($formvars);
		if($result === true)
		{		// validate??
			$arrayToJs[1] = true;			// RETURN TRUE
			echo json_encode($arrayToJs);			// RETURN ARRAY WITH success
		}else
			{
				for($x=0;$x<1000000;$x++)
				{
					if($x == 990000)
						{
						$arrayToJs[1] = false;
						echo json_encode($arrayToJs);		// RETURN ARRAY WITH ERROR
						}
				}
			}
	}
	
	function IsUnique($formvars)
	{
		$fieldname = $formvars[0];
		//$fieldname = $this->SanitizeForSQL($fieldname);		
		$field_val = $formvars[$fieldname];
		//$field_val = $this->SanitizeForSQL($value);	
		$qry = "select $fieldname from fgusers3 where $fieldname='".$field_val."'";
		$con = mysql_connect('mysql.andy.plusonedevelopment.com','andy2013','PlusOne');
		$result = mysql_query($qry,$con);		
		if($result && mysql_num_rows($result) > 0) { return false; }
		return true;
	}
	
}
?>