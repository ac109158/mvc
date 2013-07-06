
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
     <title><?php echo $title= (isset($vars['title'])) ? $vars['title'] : 'MVC'; ?></title>
    <link rel="STYLESHEET" type="text/css" href="<?php echo STYLE ?>" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
	<script src="<?php echo JS.'jquery.flip.min.js' ?>"></script>
	<script src="<?php echo JS.'jquery.flip.js' ?>"></script>
	
<script src="<?php echo JS.'ajax.js' ?>"></script>
<!--
	<script src="<?php echo JS.'jquery.js' ?>"></script>
	-->
	<script type="text/javascript">google.load("jquery", "1");</script>

     
    <script type='text/javascript' src='<?php echo VALIDATOR; ?>'></script>
    <link rel="STYLESHEET" type="text/css" href="<?php echo PWDSTYLE; ?>" />
    <script src="<?php echo PWDWIDGET; ?>" type="text/javascript"></script>
    
</head>
<body id="<?php echo $vars['tab']; ?>">
<div id="container"> <!-- main container -->
	<div id="flipbox">	
		<div id='landing_header'>
			<div id = "logo">
				<a href="<?php echo URL ?>"><?php echo $vars['site'] . $vars['slogan'] ;?></a>
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
				<li><a  id="loginnav" href="index.php?controller=login&task=display">LOGIN</a></li>
				<li><a  id="registernav" href="index.php?controller=register&task=display">REGISTER</a></li>
				<li><a href="#">ABOUT</a></li>
				<li><a href="#">CONTACT</a></li>
				</ul>						
			</div> <!-- end of landing_nav -->		
		</div> <!-- end of landing_header -->
			<div style="clear:both"></div>