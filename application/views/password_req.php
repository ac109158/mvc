<div class='ajax_content'>
<div class='ajax_pull'>
<div id='ajaxForm' class="">
<form id='formID' action='<?php echo $vars['action']; ?>' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Reset Password</legend>

<input type='hidden' name='submitted_email_reset' id='submitted' value='1'/>

<div class='field_container'>
	<input value='<?php echo $vars['email'] ?>' class="validate[required,custom[email],minSize[8]maxSize[30]] text-input" type="text" name="email" id="email" 
	data-errormessage-value-missing="Email is required!"
	/>
	<label>Email:<span class='required'> *</span></label>		
	</div><br />	
<div class='short_explanation'>A link to reset your password will be sent to the email address.</div><br /> 
   <input type='submit' name='Submit' value='Submit' /><br /><br /> 
<br /> 
<hr/>
<div class='form_message' ><span class='errormsg'><?php echo $msg = isset($vars['errors']) ?$vars['errors'] : ' REQUIRED * '; ?></span></div>
</fieldset>
</form>
</div>
</div>
</div>