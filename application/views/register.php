<div class='ajax_content'>
<div class='ajax_pull'>
<div class='form_wrapper'>

	<script>
		jQuery(document).ready(function(){
			$("#register").validationEngine();
			$("#register").bind("jqv.field.result", function(event, field, errorFound, prompText){ console.log(errorFound) })
		});
	</script>

<form id='register' action='?controller=register&task=validate' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Register</legend>

<input type='hidden' name='submitted' id='submitted' value='1'/>

<input type='text'  class='spmhidip' name='<?php echo $vars['spamTrapInputName'] ?>' />
<div class='container'>
    <label for='name' >First Name: <span class="required">*</span>  </label>
    <input type="text"  class="validate[required,custom[onlyLetterNumber]]"  value='<?php echo $vars['first_name'] ?>' name="first_name" id="first_name" maxlength="20" /><br />
    <span id='register_name_errorloc' class='error'></span>
</div>

<div class='container'>
    <label for='name' >Last Name: <span class="required">*</span>  </label>
    <input type='text' name='last_name' id='last_name' value='<?php echo $vars['last_name'] ?>' maxlength="50"
        data-validation-engine="validate[required,custom[onlyLetterSp]]"
    data-errormessage-value-missing="Last Name is required" 
    data-errormessage-custom-error="Letters Only: ABC" 
    data-errormessage="This is the fall-back error message."/><br />
    <span id='register_name_errorloc' class='error'></span>
</div>

<div class='container'>
    <label for='email' >Email: <span class="required">*</span> </label>
    <input 
    type='text' 
    name='email' 
    id='email' 
    data-validation-engine="validate[required,custom[email]]"
    data-errormessage-value-missing="Email is required!" 
    data-errormessage-custom-error="Let me give you a hint: someone@nowhere.com" 
    data-errormessage="This is the fall-back error message."
    value='<?php echo $vars['email'] ?>'
     maxlength="50" />
    <br/>
    <span id='register_email_errorloc' class='error'></span>
</div>

<div class='container'>
    <label for='phone' >Phone Number: <span class="required">*</span> </label>
    <input 
    type='text' 
    name='phone_number' 
    id='phone_number' 
    data-validation-engine="validate[required,custom[phone]]"
    data-errormessage-value-missing="Phone Number is required!" 
    data-errormessage-custom-error="Let me give you a hint: ###-###-####" 
    data-errormessage="This is the fall-back error message."
    value='<?php echo $vars['phone_number'] ?>'
     maxlength="50" />
    <br/>
    <span id='register_email_errorloc' class='error'></span>
</div>

<div class='container'>
    <label for='username' >UserName: <span class="required">*</span> </label>
    <input 
    type='text' 
    name='username' 
    id='username' 
    data-validation-engine="validate[required,custom[onlyLetterNumber]]"
    data-errormessage-value-missing="UserName is required!" 
    data-errormessage-custom-error="Let me give you a hint: user" 
    data-errormessage="This is the fall-back error message."
    value='<?php echo $vars['username'] ?>'
     maxlength="50" />
    <br/>
    <span id='register_email_errorloc' class='error'></span>
</div>
<div class='container'>
    <label for='password' >Password: <span class="required">*</span> </label>
    <input type='password' name='password' id='password' value="<?php echo $vars['password']?>" maxlength="50"
    data-validation-engine="validate[required]"
    data-errormessage-value-missing="Password is required!" 
    data-errormessage="This is the fall-back error message."/><br/>
     
	<span id='register_password_errorloc' class='error'></span>
</div>
<div class='container' style='height:20px;'>
    <label for='password' >Confirm Password: <span class="required">*</span> </label>
    <input type='password' name='confirm_password' id='confirm_password' value="<?php echo $vars['confirm_password']?>" maxlength="50"
     data-validation-engine="validate[required,equals[password]]"
    data-errormessage-value-missing="Confirm Password is required!" 
    data-errormessage="The Confirm Password does not match. "/><br/>
    <span id='register_confirm_password_errorloc' class='error' style='clear:both'></span>
</div>


<div class='container'>
    <br /><input type='submit' name='Submit' value='Submit' /><br /> 
</div>
<div ><span class='errormsg'><?php echo $msg = isset($vars['errors']) ?$vars['errors'] : ' REQUIRED * '; ?></span></div>


</fieldset>
</form>

</div>
</div>
</div>
