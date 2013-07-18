<div id='landing_header'>
			<div id = "logo">
				<a href="<?php echo URL ?>"><?php echo $vars['site'] . $vars['slogan'] ;?></a>
				<div id='landing_date'>
				<span class='date' style = "font-size:.8em;"><?php echo $vars['date'];?></span>
				</div> <!-- end of landing date -->	
			</div> <!-- end of logo -->
			<div id="landing_nav">
				<ul id = "landing_links_list">				
				<li><a  id="homenav" href="?controller=dashboard&task=display">HOME</a></li>
				<li><a  id="passwordnav" href="?controller=dashboard&task=user_password_chg">PASSWORD</a></li>
				<li><a href="#">ABOUT</a></li>
				<li><a href="?controller=dashboard&task=logout">LOGOUT</a></li>
				</ul>				
			</div> <!-- end of landing_nav -->
			<div style="clear:both"></div>
			<div id="icon_tray">
					<ul id="icon_tray_list">
						<li>+1</li>
						<li>NG</li>
						<li>GM</li>
					</ul>	
					<ul id="system_tray_list">
						<li>SS</li>
						<li>US</li>
						<li>AB</li>
					</ul>					
			</div>	
									
		</div> <!-- end of landing_header -->
			<div style="clear:both"></div>
		<?php
		$date = date(“format”, $timestamp);
		?>
		
		
