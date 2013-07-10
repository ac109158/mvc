<div class='ajax_content'>
<div class='ajax_pull'>
<div id='ajaxForm' class="">

	<script>
		jQuery(document).ready(function(){
			$("#formID").validationEngine();
			$("#formID").bind("jqv.field.result", function(event, field, errorFound, prompText){ console.log(errorFound) })
		});
	</script>
	<fieldset>
	<legend>Register</legend>
	<form id="formID" method="post" action='?controller=register&task=validate'   >
		<div class='field_container'>
		
		<input type='hidden' name='submitted' id='submitted' value='1'/>
		
		<input type='text'  class='spmhidip' name='<?php echo $vars['spamTrapInputName'] ?>' />
		
		<input value='<?php echo $vars['first_name'] ?>' class="validate[required,custom[onlyLetterNumber],minSize[2],maxSize[20] text-input" type="text" name="first_name" id="first_name" />
		<label>First Name:<span class='required'> *</span></label>
		</div><br />	
			
		<div class='field_container'>
		<input value='<?php echo $vars['last_name'] ?>' class="validate[required,custom[onlyLetterNumber],minSize[2],maxSize[25] text-input" type="text" name="last_name" id="last_name" />
		<label>Last Name:<span class='required'> *</span></label>
		</div><br />	 
			
		<div class='field_container'>
		<input value='<?php echo $vars['email'] ?>' class="validate[required,custom[email],minSize[8]maxSize[30] text-input" type="text" name="email" id="email" />
		<label>Email:<span class='required'> *</span></label>		
		</div><br />	
			
		<div class='field_container'>
		<input value='<?php echo $vars['phone_number'] ?>' class="validate[required,custom[phone],minSize[10],maxSize[12] text-input" type="text" name="phone_number" id="phone_number" />
		<label>Phone:<span class='required'> *</span></label>
		</div><br />			
			
		<div class='field_container'>
		<input value='<?php echo $vars['username'] ?>' class="validate[required,custom[onlyLetterNumber],minSize[4],maxSize[20],ajax[ajaxUserCallPhp]] text-input" type="text" name="username" id="username" />
		<label>UserName:<span class='required'> *</span></label>
		</div><br />
		
		<div class='field_container'>
		<input value='<?php echo $vars['password'] ?>' class="validate[required,custom[onlyLetterNumber],minSize[8,]maxSize[20] text-input" type="password" name="password" id="password" />
		<label>Password:<span class='required'> *</span></label>
		</div><br />
		
		<div class='field_container'>
		<input value='<?php echo $vars['confirm_password'] ?>' 
		class="validate[required,equals[password]],minSize[8],maxSize[20] text-input"
		type="password" 
		name="confirm_password" 
		id="confirm_password" />
		<label style="font-size:1em;">Confirm Password<span class='required'> *</span></label>
		</div>
	<input class="submit" type="submit" value="Submit"/><br />
	<hr/>
	<div class='form_message' ><span class='errormsg'><?php echo $msg = isset($vars['errors']) ?$vars['errors'] : ' REQUIRED * '; ?></span></div>
	</fieldset>
	</form>
</div>
</div>
</div>

