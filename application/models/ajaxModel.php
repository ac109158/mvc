	// Called from the Lookup Order button that is dynamically added above.
	function lookupOrder()
	{
		//Starting with a simple if statment to limit the "happy clicker" ;-)
		var currentTime = new Date();
		currentTime = currentTime.getTime();
		var waitTime = 5000;
		
		//checks the time between clicks.
		if( document.getElementById("additional_2_text_8").value != "" && (currentTime - Number(document.getElementById("additional_2_text_8").value) <= waitTime ) ) {
			alert("Please wait " + waitTime/1000 + " seconds before searching the order again.");
		}else{
			document.getElementById("additional_2_text_8").value = currentTime;
			var msg = "Please correct the following: \n\n";
			var error = false;
			
			if( document.getElementById("additional_2_text_1").value == "" && document.getElementById("additional_2_text_2").value == "" && document.getElementById("additional_2_text_3").value == "" && document.getElementById("additional_2_text_4").value == "" ){
				redBorder("additional_2_text_1", "on");
				msg += "You must enter a search criteria.\n";
				error = true;
			}else{
				redBorder("additional_2_text_1", "off");
			}
			
			if( document.getElementById("additional_2_text_1").value != "" ) {
				if( isNaN( document.getElementById("additional_2_text_1").value ) ){
					redBorder("additional_2_text_1", "on");
					msg += "Order ID field can only contain numerical data.\n";
					error = true;
				}else{
					redBorder("additional_2_text_1", "off");
				}
			}else if( document.getElementById("additional_2_text_2").value != "" ){
				if( isNaN( document.getElementById("additional_2_text_2").value ) || document.getElementById("additional_2_text_2").value.length != 10 ){
					redBorder("additional_2_text_2", "on");
					msg += "Number can contain only numerical data, no spaces, and must be 10 digits.\n";
					error = true;
				}else{
					redBorder("additional_2_text_2", "off");
				}
			}else if( document.getElementById("additional_2_text_3").value != "" || document.getElementById("additional_2_text_4").value != "" ){
				if( document.getElementById("additional_2_text_3").value != "" && document.getElementById("additional_2_text_4").value != "" ){
					if(document.getElementById("additional_2_text_3").value.match(/[0-9]/)){
						redBorder("additional_2_text_3", "on");
						msg += "Last Name can contain only letters, and no spaces.\n";
						error = true;
					}else if( isNaN( document.getElementById("additional_2_text_4").value )){
						redBorder("additional_2_text_4", "on");
						msg += "Zip Code can contain only numerical data.\n";
						error = true;
					}else{
						redBorder("additional_2_text_3", "off");
						redBorder("additional_2_text_4", "off");
					}
				} else {
					if (document.getElementById("additional_2_text_3").value == "" ){
						redBorder("additional_2_text_3", "on");
						msg += "Last Name must be filled in with Zip Code.\n";
						error = true;
					} else if (document.getElementById("additional_2_text_4").value == ""){
						redBorder("additional_2_text_4", "on");
						msg += "Zip Code must be filled in with Last Name.\n";
						error = true;
					} else {
						redBorder("additional_2_text_3", "off");
						redBorder("additional_2_text_4", "off");
					}
				}
			}
			if(error){
				alert(msg);			
			}else{
				// Adds and animated gif at the start of the ajax call
				document.getElementById("lookupOrderLabel").innerHTML = '<img src="../../images/ajax-loader2.gif">';
				
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

						if ( typeof lookupError != 'undefined' ) {
							alert( lookupError );
						}else if( typeof orderList != 'undefined' ){
							var orderNumbers = "Order Numbers: ";
							document.getElementById("originalOrderInfo").innerHTML = "";
							for( i=0; i<orderList.orders.length; i++ ) {
								orderNumbers = orderNumbers + orderList.orders[i].orderID + ", ";
								document.getElementById("originalOrderInfo").innerHTML += "<br /><br /><a onmousedown='getOrderInfo(" + orderList.orders[i].orderID + ")'>" + orderList.orders[i].orderID + "</a> - " + orderList.orders[i].orderFirstName + " " + orderList.orders[i].orderLastName + "<br />Order Date: " + orderList.orders[i].orderDate + "<br />Order Phone: " + orderList.orders[i].orderPhone + "<br />" + orderList.orders[i].orderAddress + "<br />" + orderList.orders[i].orderCity + ", " + orderList.orders[i].orderState + ". " + orderList.orders[i].orderZip;
							}
						}else{
							alert( "System Error, please record any pertinent information and send to development" );
						}
					}
				});
				
				document.getElementById("lookupOrderLabel").innerHTML = "";
			}
		}
	}