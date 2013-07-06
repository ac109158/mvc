<div class='ajax_content'>
<div class='ajax_pull'>
<div class='form_wrapper'>
<form id='register' action='?controller=register&task=validate' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Register</legend>

<input type='hidden' name='submitted' id='submitted' value='1'/>

<div class='short_explanation'>* required fields</div>
<input type='text'  class='spmhidip' name='<?php echo $vars['spamTrapInputName'] ?>' />

<div><span class='error'><?php echo $vars[errors]; ?></span></div>
<div class='container'>
    <label for='name' >First Name*: </label>
    <input type='text' name='first_name' id='first_name' value='<?php echo $vars['first_name'] ?>' maxlength="50" /><br/>
    <span id='register_name_errorloc' class='error'></span>
</div>
<div class='container'>
    <label for='name' >Last Name*: </label>
    <input type='text' name='last_name' id='last_name' value='<?php echo $vars['last_name'] ?>' maxlength="50" /><br/>
    <span id='register_name_errorloc' class='error'></span>
</div>
<div class='container'>
    <label for='email' >Email Address*:</label>
    <input type='text' name='email' id='email' value='<?php echo $vars['email'] ?>' maxlength="50" /><br/>
    <span id='register_email_errorloc' class='error'></span>
</div>
<div class='container'>
    <label for='phone' >Phone*:</label>
    <input type='text' name='phone_number' id='phone_number' value='<?php echo $vars['phone_number'] ?>' maxlength="50" /><br/>
    <span id='phone_errorloc' class='error'></span>
</div>
<div class='container'>
    <label for='username' >UserName*:</label>
    <input type='text' name='username' id='username' value='<?php echo $vars['username'] ?>' maxlength="50" /><br/>
    <span id='register_username_errorloc' class='error'></span>
</div>
<div class='container'>
    <label for='password' >Password*:</label>
    <input type='password' name='password' id='password' value="<?php echo $vars['password']?>" maxlength="50" /> <br /> 
	<span id='register_password_errorloc' class='error'></span>
</div>
<div class='container' style='height:80px;'>
    <label for='password' >Confirm*:</label>
    <input type='password' name='confirm_password' id='confirm_password' maxlength="50" />
    <span id='register_confirm_password_errorloc' class='error' style='clear:both'></span>
</div>

<div class='container'>
    <input type='submit' name='Submit' value='Submit' />
</div>

</fieldset>
</form>
</div>
</div>
</div>
<!-- client-side Form Validations:
Uses the excellent form validation script from JavaScript-coder.com-->

<script type='text/javascript'>
// <![CDATA[
    /*
var pwdwidget = new PasswordWidget('thepwddiv','password');
    pwdwidget.MakePWDWidget();
*/
    
    var frmvalidator  = new Validator("register");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();
    frmvalidator.addValidation("first_name","req","Please provide your first name");
    
    frmvalidator.addValidation("last_name","req","Please provide your first name");

    frmvalidator.addValidation("email","req","Please provide your email address");

    frmvalidator.addValidation("email","email","Please provide a valid email address");
    
    frmvalidator.addValidation("phone_number","reg","Please provide your phone number");
    
    frmvalidator.addValidation("phone_number","phone","Please provide a valid phone number");

    frmvalidator.addValidation("username","req","Please provide a username");
    
    frmvalidator.addValidation("password","req","Please provide a password");
    
    frmvalidator.addValidation("confirm_password","req","Please confirm your password");


// ]]>
</script>




<!--
Form Code End (see html-form-guide.com for more info.)
-->