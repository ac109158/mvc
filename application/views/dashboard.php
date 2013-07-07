	    	<div id="content">	    	
		    	<div class="" id="left_panel">
					<div class="grid" id="login_box">
					<p>Welcome Back, <?php echo $vars['user_name']; ?></p>
						<div id="time"><?php echo date("F j, Y, g:i a"); ?> </div>
					</div>	<!-- end of login_box -->
					<div class="spreader"></div>
					<div class="grid" id="chat">
						Message Center
					</div>
		    	</div><!-- end of left_panel -->
		    	
				<div id="main_panel">
			    	<div class="grid" id="main_content">
				    	<center><h2>Welcome to Shift Buddy</h2></center>
				    	<div id="msg"><?php echo $vars['msg']; ?></div>
			    	</div>
			    </div><!-- end of main_panel -->
			    
			    <div id="right_panel">			    
			    	<div class="grid" id="recent_activity">Recent Activity</div>
			    	<div class="spreader"></div>
			    	<div class="grid" id="pending">Pending</div>
			    </div><!-- end of right_panel -->
			    
			   <div style="clear:both;"></div>
	    	</div><!-- end of content -->
	    	
	   