	<div id="landing_content">
		<div class = "transparent" id='landing_form_content'>
			<?php include $vars['form']; ?>
		</div><!-- end of landing_form_content -->
	</div> <!-- end of landing_content -->
	</div> <!-- end of flipbox -->
</div> <!-- end of main container -->
<div id="my_div"></div>

<script type="text/javascript">
//jQuery('#landing_form_content').find('.container').css({margin:'-20px 10px'});
jQuery('#landing_form_content').find('span.required').css('color','orange');
setTimeout("jQuery('#landing_form_content').find('span.required').css('color', 'white')", 1000);

</script>

<?php require_once(JS.'flip.js') ?>