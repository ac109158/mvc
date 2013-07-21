<?php
class AjaxModel extends Model {

    function __construct()
    {
    	parent::__construct();
    }
    
    private function getLocalVars($array) 
    {
	    return $array;
    }
    
    public function validate_field($vars)
	{
	    
	    $validateId=$vars[0];
	    $validateValue=$vars[1];		
		$validateError= "This $validateId is already taken";
		$validateSuccess= "This $validateId is available";
		/* RETURN VALUE */
		$arrayToJs = array();

		$arrayToJs[0] = $validateId;
		//$field_val = $this->SanitizeForSQL($value);	
		$qry = "select $validateId from fgusers3 where $validateId='".$validateValue."'";
		$con = mysqli_connect("mysql.andy.plusonedevelopment.com","andy2013","PlusOne", "andy_database");
		if (mysqli_connect_errno($con))
			{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
			mysqli_close($con);
			exit;
			}


		$result = mysqli_query($con, $qry);
		if($result && mysqli_num_rows($result) <= 0)
		{		// validate??
			$arrayToJs[1] = true;			// RETURN TRUE
			$arrayToJs[2] = $validateSuccess;			
			echo json_encode($arrayToJs);			// RETURN ARRAY WITH success
			exit;
		}else
			{
				for($x=0;$x<1000000;$x++)
				{
					if($x == 990000)
						{
						$arrayToJs[1] = false;
						$arrayToJs[2] = $validateError;
						echo json_encode($arrayToJs);		// RETURN ARRAY WITH ERROR
						exit;
						}
				}
			}
		}
		}
	
?>