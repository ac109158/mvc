<div id="container"> <!-- main container -->
	<div id="flipbox">	
		<div id='landing_header'>
			<div id = "logo">
				<?php echo $vars['title'] . $vars['slogan'] ;?>
			</div> <!-- end of logo -->
		</div> <!-- end of landing_header -->
			<div style="clear:both"></div>
	
	
	
	<div id="landing_content">
		<div id="landing_nav">
			<div id='landing_date'>
				<ul>
					<li><?php echo $vars['time']['weekday']; ?> &nbsp;</li>
					<li><?php echo $vars['time']['month']; ?></li>
					<li><?php echo $vars['time']['mday']; ?>,</li>
					<li><?php echo $vars['time']['year']; ?></li>
				<ul>
			</div> <!-- end of landing date -->
			<div>
				<ul id = "landing_nav_links">				
					<li><a class = "ajax_trigger" href="<?php echo VIEW.'login.php' ?>">LOGIN</a></li>
					<li><a class = "ajax_trigger" href="<?php echo VIEW.'register.php' ?>">REGISTER</a></li>
					<li><a href="#">ABOUT</a></li>
					<li><a href="#">CONTACT</a></li>
				</ul>
			</div>				
		</div> <!-- end of landing_nav -->
		<div id='landing_main_content'>
			<div class="ajax_content">
				<div class="ajax_pull">
				</div> <!-- end of ajax_pull -->			
			</div>	 <!-- end of ajax_content -->
		</div><!-- end of landing_main_content -->
	</div> <!-- end of landing_content -->
	<div id="landing_footer">
		footer
	</div> <!-- end of footer -->
	</div> <!-- end of flipbox -->
</div> <!-- end of main container -->
<div id="flipPad">
	<a  href="#" class="right" rel="lr" rev="aqua" content="Hello">Login</a>
	<a  href="#" class="revert" rel="lr" rev="aqua" content="Hello">Revert</a>	
</div>


	
	
<script type="text/javascript" src="./js/test.js"> </script>
<?php require_once(JS.'flip.js') ?>