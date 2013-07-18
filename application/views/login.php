<!-- Form Code Start -->
<div class='ajax_content'>
<div class='ajax_pull'>
<div id='ajaxForm' class="">
<form id='formID' action='?controller=login&task=validate' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Login</legend>
<div class='field_container'>
<input type='hidden' name='submitted' id='submitted' value='1'/>

<input value='<?php echo $vars['username'] ?>' class="validate[required] text-input" type="text" name="username" id="username" 
data-errormessage-value-missing="Username is required" 
/>
<label>UserName:<span class='required'> *</span></label>
</div><br />

<div class='field_container'>
<input value='<?php echo $vars['password'] ?>' class="validate[required] text-input" type="password" name="password" id="password" 
data-errormessage-value-missing="Password is required!"
/>
<label>Password:<span class='required'> *</span></label>
</div><br />


<div class='container'>
    <input  type='submit' name='Submit' value='Submit' /><br /><br />
</div>
<br />	
<hr/>
<div class='form_message' ><span class='errormsg'><?php echo $msg = isset($vars['errors']) ?$vars['errors'] : ' REQUIRED * '; ?></span></div><br /> 
<div ><a class='short_explanation ajax_trigger' href="<?php echo VIEW.'password_req.php' ?>">Forgot Password?</a></div>

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
