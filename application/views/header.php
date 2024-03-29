
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
     <title><?php echo $title= (isset($vars['title'])) ? $vars['title'] : 'MVC'; ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE ?>" />    
    <link rel="stylesheet" type="text/css" href="<?php echo CSS. 'validationEngine.jquery.css' ?>" /> 
    <link rel="stylesheet" type="text/css" href="lib/gritter/css/jquery.gritter.css" />

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="<?php echo JS.'jquery.validationEngine-en.js' ?>" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo JS.'jquery.validationEngine.js' ?>" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo JS.'jquery.maskedinput.min.js' ?>" type="text/javascript" charset="utf-8"></script>
	<!--
<script src="<?php echo JS.'jquery.flip.min.js' ?>"></script>
	<script src="<?php echo JS.'jquery.flip.js' ?>"></script>	
-->
<script src="<?php echo JS.'ajax.js' ?>"></script>    
</head>
<body id="<?php echo $vars['tab']; ?>">
<div id="container"> <!-- main container -->
		<?php require $vars['header']; ?>