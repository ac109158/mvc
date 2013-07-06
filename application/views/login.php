<!-- Form Code Start -->
<div class='ajax_content'>
<div class='ajax_pull'>
<div class='form_wrapper'>
<form id='login' action='?controller=login&task=validate' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Login</legend>

<input type='hidden' name='submitted' id='submitted' value='1'/>

<div class='container'>
    <label for='username' >UserName*:</label>
    <input type='text' name='username' id='username' value='<?php echo $vars['username'];?>' maxlength="50" /><br/>
    <span id='login_username_errorloc' class='error'></span>
</div>
<div class='container'>
    <label for='password' >Password*:</label>
    <input type='password' name='password' id='password' maxlength="50" /><br/>
    <span id='login_password_errorloc' class='error'></span>
</div>

<div class='container'>
    <input  type='submit' name='Submit' value='Submit' /><br /><br />
</div>
<div><span class='errormsg'><?php echo $msg = isset($vars['errors']) ?$vars['errors'] : ' REQUIRED * '; ?></span></div><br /><br /> 
<div class='short_explanation'><a href="?controller=login&task=password_reset_request">Forgot Password?</a></div>

</fieldset>
</form>
<!-- client-side Form Validations:
Uses the excellent form validation script from JavaScript-coder.com-->

<script type='text/javascript'>
// <![CDATA[

    var frmvalidator  = new Validator("login");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();

    frmvalidator.addValidation("username","req","Please provide your username");
    
    frmvalidator.addValidation("password","req","Please provide the password");

// ]]>
</script>
</div>
 </div></div>
<!--
Form Code End (see html-form-guide.com for more info.)
-->