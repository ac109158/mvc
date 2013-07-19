<div class='ajax_content'>
<div class='ajax_pull'>
<div id='ajaxForm' class="">
	<fieldset>
	<legend>Register</legend>
	<form id="formID" method="post" action='<?php echo $vars['action'] ?>'   >
		<div class='field_container'>
		
		<input type='hidden' name='submitted' id='submitted' value='1'/>
		
		<input type='text'  class='spmhidip' name='<?php echo $vars['spamTrapInputName'] ?>' />
		
		<input value='<?php echo $vars['first_name'] ?>' class="validate[required,custom[onlyLetterNumber],minSize[2],maxSize[20] text-input ready" type="text" name="first_name" id="first_name" 
		data-errormessage-value-missing="First Name is required" 
		data-errormessage-custom-error="Letters Only: ABC" 
		data-errormessage="This is the fall-back error message."
		/>
		<label>First Name:<span class='required'> *</span></label>
		</div>
			
		<div class='field_container'>
		<input value='<?php echo $vars['last_name'] ?>' class="validate[required,custom[onlyLetterNumber],minSize[2],maxSize[25] text-input ready" type="text" name="last_name" id="last_name" 
		data-errormessage-value-missing="Last Name is required" 
		data-errormessage-custom-error="Letters Only: ABC" 
		data-errormessage="This is the fall-back error message."
		/>
		<label>Last Name:<span class='required'> *</span></label>
		</div> 
			
		<div class='field_container'>
		<input value='<?php echo $vars['email'] ?>' class="validate[required,custom[email],minSize[8]maxSize[40],ajax[ajaxNameCall]] text-input ignore" type="text" name="email" id="email" 
		data-errormessage-value-missing="Email is required!" 
		data-errormessage-custom-error="Let me give you a hint: someone@nowhere.com" 
		/>
		<label>Email:<span class='required'> *</span></label>		
		</div>
			
		<div class='field_container'>
		<input value='<?php echo $vars['phone_number'] ?>' class="validate[required,custom[phone],minSize[14],maxSize[14] text-input ready" type="text" name="phone_number" id="phone_number" 
		data-errormessage-value-missing="Phone Number is required!" 
		data-errormessage-custom-error="Let me give you a hint: (###) ###-####" 
		/>
		<label>Phone:<span class='required'> *</span></label>
		</div>	
			
		<div class='field_container'>
		<input value='<?php echo $vars['username'] ?>' class="validate[required,custom[onlyLetterNumber],minSize[4],maxSize[20],ajax[ajaxUserCall]] text-input ignore" type="text" name="username" id="username" 
		data-errormessage-value-missing="UserName is required!" 
		data-errormessage-custom-error="Username must be 4 - 20 characters" 
		data-errormessage="Letters and numbers only."
		/>
		<label>UserName:<span class='required'> *</span></label>
		</div>
		
		<div class='field_container'>
		<input value='<?php echo $vars['password'] ?>' class="validate[required,minSize[5,]maxSize[20] text-input ready" type="password" name="password" id="password" 
		data-errormessage-value-missing="Password is required!"
		/>
		<label>Password:<span class='required'> *</span></label>
		</div>
				
		<div class='field_container'>
		<input value='<?php echo $vars['confirm_password'] ?>' 
		class="validate[required,equals[password]],minSize[5],maxSize[20] text-input ready"
		type="password" 
		name="confirm_password" 
		id="confirm_password" 
		data-errormessage-value-missing="Confirm Password is required!" 
		/>
		<label style="font-size:.5em;">Confirm Password<span class='required'> *</span></label>
		</div>
	<input class="submit" type="submit" value="Submit"/><br />
	<hr/>
	<div class='form_message' ><span class='errormsg'><?php echo $msg = isset($vars['errors']) ?$vars['errors'] : ' REQUIRED * '; ?></span></div>
	</fieldset>
	</form>
</div>
</div>
</div>




<script>
	jQuery(document).ready(function(){
		$("#formID").not('.ignore').validationEngine({promptPosition : "topLeft", scroll: false, showOneMessage : true, autoHidePrompt : true, autoHideDelay : 3000});
		//$("#formID").bind("jqv.field.result", function(event, field, errorFound, prompText){ console.log(errorFound) });
		$('#formID input').not('.ignore').not('.submit').blur(function(){
			x = $(this).focusout().validationEngine('validate');
			if (x == true || x[1] == true) {
			$(this).removeClass('error');
			$(this).addClass('error');				
			} 
			else 
			{
				$(this).removeClass('error');
				 $(this).addClass('validated');
			}
	});
	});
</script>

<script>
jQuery(function($){
$("#phone_number").mask("(999) 999-9999",{completed:function(){$("input[id=phone_number]").removeClass('error').addClass('validated');}});
$("#username").mask("****?***************", ({placeholder:""}));
//$("#email").mask("********@**************.info",{completed:function(){$("input[id=email]").removeClass('error').addClass('validated');}});
});
</script>

<script>
	var email = -1;
	$('#formID').find('#email').blur(function () {
	if (($(this).val().contains("@") != -1) && ($(this).val().contains(".") != -1) && $(this).val().length >= 8 && $(this).val().length <= 40 )
		{
		  email = 1;
		}
	
	if (email != 1) {
    $(this).removeClass('validated').addClass('error');
	} 
	else {
	if (email == 1) {
    $(this).removeClass('error').addClass('validated');
	}}});
	
	$('#formID').find('#username').blur(function () {
	var x = 0;
	var username = -1;
	x = $.trim($(this).val()).length;
	if (x >= 4)
		{
		  username = 1;
		}
	if (x < 4){username = -1}
	if (username != 1) {
    $(this).removeClass('validated').addClass('error');
	} 
	if (username == 1) {
    $(this).removeClass('error').addClass('validated');
	}});	
</script>





<!--
<script>
	function errorcheck () {
	$('input').focusout(function () {
	$.each(result, function(index, val) {
    console.log(val.category);
});
	
	if	(result == null) 
	 	{
		 	jQuery(this).css({'borderColor' : 'red', borderWidth : '2px'});
	 	} else {
		 	jQuery(this).css({'borderColor' : 'green', borderWidth : '2px'});
	 	}
		
	});
	};
	errorcheck();
	 
</script>
-->

