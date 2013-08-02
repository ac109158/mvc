
<link href="style.css" rel="stylesheet" type="text/css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>





<div id="output"></div>
<form action="../index.php?controller=ajax&task=file_upload" id="FileUploader" enctype="multipart/form-data" method="post" >
    <label>Title
    <span class="small">Title of the File</span>
    </label>
    <input type="text" name="mName" id="mName" />
    
    <label>File
    <span class="small">Choose a File</span>
    </label>
    <input type="file" name="mFile" id="mFile" />
    <button type="submit" class="red-button" id="uploadButton">Upload (1MB)</button>
    <div class="spacer"></div>
</form>
<script>
$(document).ready(function()
{
    $('#FileUploader').on('submit', function(e)
    {
        e.preventDefault();
        $('#uploadButton').attr('disabled', ''); // disable upload button
        //show uploading message
        $("#output").html('<div style="padding:10px"><img src="images/ajax-loader.gif" alt="Please Wait"/> <span>Uploading...</span></div>');
        $(this).ajaxSubmit({
        target: '#output',
        success:  afterSuccess //call function after success
        });
    });
});
 
function afterSuccess()
{
    $('#FileUploader').resetForm();  // reset form
    $('#uploadButton').removeAttr('disabled'); //enable submit button
}
</script>