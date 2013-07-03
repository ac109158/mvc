<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $vars['title'] ?></title>
	<style>
		body {
			background-color: tan;
		}

	</style>
</head>
<body>
	<center><h2><?php echo $vars['title']  ?></h2></center>
	<header>
		<ul>
			<li><a href="?controller=login&task=display">Login</a></li>
			<li><a href="?controller=register&task=display">Register</a></li>
		</ul>
	</header>
	<div>
	<?php 
	echo ($vars['errors']);
	?>
	</div>

	
</body>
</html>