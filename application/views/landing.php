<div id="container"> <!-- main container -->
	<div id="flipbox">	
		<div id='landing_header'>
			<div id = "logo">
				<?php echo $vars['site'] . $vars['slogan'] ;?>
				<div id='landing_date'>
					<ul id = "landing_date_list">
						<li><?php echo $vars['time']['weekday']; ?> &nbsp;</li>
						<li><?php echo $vars['time']['month']; ?>&nbsp;</li>
						<li><?php echo $vars['time']['mday']; ?>,&nbsp;</li>
						<li><?php echo $vars['time']['year']; ?></li>
					<ul>
				</div> <!-- end of landing date -->	
			</div> <!-- end of logo -->
			<div id="landing_nav">
				<ul id = "landing_links_list">				
				<li><a  href="index.php?controller=login&task=display">LOGIN</a></li>
				<li><a  href="index.php?controller=register&task=display">REGISTER</a></li>
				<li><a href="#">ABOUT</a></li>
				<li><a href="#">CONTACT</a></li>
				</ul>						
			</div> <!-- end of landing_nav -->		
		</div> <!-- end of landing_header -->
			<div style="clear:both"></div>

	
	
	
	<div id="landing_content">
		<div class = "transparent" id='landing_main_content'>
			<?php include $vars['form']; ?>
		</div><!-- end of landing_main_content -->
	</div> <!-- end of landing_content -->
	</div> <!-- end of flipbox -->
</div> <!-- end of main container -->
<div id="flipPad">
	<a  href="#" class="right" rel="lr" rev="aqua" content="Hello">Login</a>
	<a  href="#" class="revert" rel="lr" rev="aqua" content="Hello">Revert</a>	
</div>


	
	
<script type="text/javascript" src="./js/test.js"> </script>
<?php require_once(JS.'flip.js') ?>