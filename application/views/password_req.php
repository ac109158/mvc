<div class='ajax_content'>
<div class='ajax_pull'>
<div class='form_wrapper'>
<form id='resetreq' action='<?php echo $vars['action']; ?>' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Reset Password</legend>

<input type='hidden' name='submitted_email_reset' id='submitted' value='1'/>

<div class='container'>
    <label for='username' >Your Email: <span class="required">*</span></label>
    <input type='text' name='email' id='email' value="<?php echo $vars['email']?>" maxlength="50" /><br/>
    <span id='resetreq_email_errorloc' class='error'></span>
</div>
<div class='short_explanation'>A link to reset your password will be sent to the email address</div>
<div class='container'>
    <input type='submit' name='Submit' value='Submit' /><br /><br /> 
</div>
<br /> 
<div><span class='errormsg'><?php echo $vars['errors'];?></span></div>
</fieldset>

</form>


<!-- client-side Form Validations:
Uses the excellent form validation script from JavaScript-coder.com-->

<script type='text/javascript'>
// <![CDATA[

    var frmvalidator  = new Validator("resetreq");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();

    frmvalidator.addValidation("email","req","Please provide the email address used to sign-up");
    frmvalidator.addValidation("email","email","Please provide the email address used to sign-up");

// ]]>
</script>

</div>
</div>
</div>
</div>


<!--
Form Code End (see html-form-guide.com for more info.)
-->