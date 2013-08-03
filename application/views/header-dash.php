
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
     <title><?php echo $title= (isset($vars['title'])) ? $vars['title'] : 'MVC'; ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE ?>" />    
    
<!-- include Jquery because it is awesome --> 
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<!-- Include all of the nessary css files for the Anything Slider -->
	<link rel="stylesheet" href="css/slider/theme-metallic.css">
	<link rel="stylesheet" href="css/slider/theme-minimalist-round.css">
	<link rel="stylesheet" href="css/slider/theme-minimalist-square.css">
	<link rel="stylesheet" href="css/slider/theme-construction.css">
	<link rel="stylesheet" href="css/slider/theme-cs-portfolio.css">
<!-- Include all of the nessary JS files for the Anything Slider -->  
	<script src="js/slider/jquery.easing.1.2.js"></script>
	<script src="js/slider/swfobject.js"></script>
	<script src="js/slider/jquery.anythingslider.js"></script>
<!-- AnythingSlider optional extensions -->
	<script src="js/slider/jquery.anythingslider.fx.js"></script>
	<script src="js/slider/jquery.anythingslider.video.js"></script>
	
<!-- Include all the pusher files -->
<script src="http://js.pusher.com/2.1/pusher.min.js"></script

</head>
<body id="<?php echo $vars['tab']; ?>">
<div id="container"> <!-- main container -->