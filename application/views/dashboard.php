<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<!-- 		<META HTTP-EQUIV="refresh" CONTENT="30, url=http://www.andy.plusonedevelopment.com/mvc/?controller=dashboard"> -->
		<title><?php echo $vars['title']; ?></title>
		<link href="./css/style.css" rel="stylesheet" type="text/css" />
		<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css' />
		<script type="text/javascript" src="js/modernizr.custom.79639.js"></script> 
		<noscript><link rel="stylesheet" type="text/css" href="css/noJS.css" /></noscript>
    	</head>
<?php
date_default_timezone_set('America/Denver');
$date = date(“format”, $timestamp);
?>
    <body id="body">
    	<div id="container">
	    	<div id="header">
			<div id = "navbar">
				<ul id="nav" class="drop">
			 		<li><a href="#">Home</a></li>
			  		<li>Create Task
			    			<ul>
							<li><a href="#">Listen to Call</a></li>
							<li><a href="#">Fix Order</a></li>
							<li><a href="#">Change Routing</a></li>
							<li><a href="#">Shift Trade</a>
								<ul>
								<li><a href="#">George Orsmond</a>
									<ul>
										<li>Web Design</li>
										<li>Graphic Design</li>
										<li>HTML</li>
										<li>CSS</li>
									</ul>
								</li>
								<li><a href="#">Dave Macleod</a></li>
								</ul>
								</li>
								<li><a href="#">FAQs</a></li>
								</ul>
								</li>
					<li>Email
					<ul>
					<li><a href="#">Schedule Email</a></li>
					<li><a href="#">Group</a></li>
					<li><a href="#">Send Mail</a></li>
					</ul>
					</li>
					<li>Tools
						<ul>
							<li class="dir"><a href="#">Groups</a></li>
							<li class="dir"><a href="#">CANS</a>
								<ul>
								<li><a href="#">Can Book</a></li>
								<li><a href="#">Can Journal</a></li>
								</ul>
							</li>
							<li><a href="#">My Schedule</a></li>
							<li><a href="?controller=dashboard&task=UserList">My Buddies</a></li>
							<li><a href="#">Resources</a></li>
						</ul>
					</li>
					<li>Profile
						<ul>
						<li><a href="?controller=dashboard&task=user_password_chg">Change Password</a></li>
						<li><a href="#">Info</a></li>
						<li><a href="?controller=dashboard&task=logout">Logout</a></li>
						</ul>
					</li>
				</ul>
					
			</div> <!-- end of navibar -->  	
	    	</div><!-- end of header -->
	    	<div class="spreader"></div>
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
				    	<div class="error_msg"><p><?php echo $vars['errors']; ?></p></div>
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
	    	
	    	<div class="spreader"></div>
	    	<div class="spreader"></div>
	    	
	    	<div class="grid" id="footer">
		    		Footer
		    </div>    	
    	</div><!-- end of container -->
    </body><!-- end of body -->
</html><!-- end of html -->