<?php

class AjaxModel extends RegisterModel
{
    public function __construct()
    {
	    parent::__construct();
	 }
	 
	 
	 function IsUserValueUnique($userValue)
	{
		$field_val = $this->SanitizeForSQL($userValue);
		$qry = "select username from $this->tablename where username ='".$field_val."'";
		$result = mysql_query($qry,$this->connection);
		
		if($result && mysql_num_rows($result) > 0) { return array(false, 'This username is already in use.'); }
		return array(true, "This username is available";
	}
	 
}
				
/*
<!--
				// Internal URL for AJax call
				var url  = "/index.php?option=com_callcenter&controller=submissions&task=agencySubmissionFunction&format=raw&classFunction=efoodsOrderLookup";
				//var url  = "/index.php?option=com_callcenter&controller=submissions&task=agencySubmissionFunction&format=raw&classFunction=legacyOrders";
				
				// Var that will contain the post variables
				var dataString = "orderID=" + document.getElementById('orderID').value+"&lookupID=" + document.getElementById("additional_2_text_1").value + "&shippingPhone=" + document.getElementById("additional_2_text_2").value + "&lastName=" + document.getElementById("additional_2_text_3").value + "&zipCode=" + document.getElementById("additional_2_text_4").value;
				
				jQuery.ajax({
					url: url,
					cache: false,
					type: "POST",	
					data: dataString,
					success: function(txt){
						eval( txt );

				});

				
				document.getElementById("lookupOrderLabel").innerHTML = "";
			}
		}
	}
	*/
-->