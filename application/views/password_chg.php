<!-- Form Code Start -->
<div id='fg_membersite'>
<form id='changepwd' action='<?php echo $vars['action']; ?>' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Change Password</legend>

<input type='hidden' name='password_chg_submitted' id='password_chg_submitted' value='1'/>

<div class='short_explanation'>* required fields</div>

<div><span class='error'><?php echo $vars['errors']; ?></span></div>
<div class='container'>
    <label for='oldpwd' >Old Password*:</label><br/>
    <div class='pwdwidgetdiv' id='oldpwddiv' ></div><br/>
    <!-- <noscript> -->
    <input type='password' name='oldpwd' id='oldpwd' value = '<?php  echo $vars['oldpwd']; ?>'maxlength="50" />
    <!-- </noscript>  -->   
    <span id='changepwd_oldpwd_errorloc' class='error'></span>
</div>

<div class='container'>
    <label for='newpwd' >New Password*:</label><br/>
    <div class='pwdwidgetdiv' id='newpwddiv' ></div>
    <!-- <noscript> -->
    <input type='password' name='newpwd' id='newpwd' maxlength="50" /><br/>
   <!--  </noscript> -->
    <span id='changepwd_newpwd_errorloc' class='error'></span>
</div>

<br/><br/><br/>
<div class='container'>
    <input type='submit' name='Submit' value='Submit' />
</div>

</fieldset>
</form>
<!-- client-side Form Validations:
Uses the excellent form validation script from JavaScript-coder.com-->

<script type='text/javascript'>
// <![CDATA[
    var pwdwidget = new PasswordWidget('oldpwddiv','oldpwd');
    pwdwidget.enableGenerate = false;
    pwdwidget.enableShowStrength=false;
    pwdwidget.enableShowStrengthStr =false;
    pwdwidget.MakePWDWidget();
    
    var pwdwidget = new PasswordWidget('newpwddiv','newpwd');
    pwdwidget.MakePWDWidget();
    
    
    var frmvalidator  = new Validator("changepwd");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();

    frmvalidator.addValidation("oldpwd","req","Please provide your old password");
    
    frmvalidator.addValidation("newpwd","req","Please provide your new password");

// ]]>
</script>

<p>
<a href='?controller=dashboard'>Dashboard</a>
</p>

</div>
<!--
Form Code End (see html-form-guide.com for more info.)
-->