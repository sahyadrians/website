<?php session_start(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title>Sahyadrians</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	
	<link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" />
	<link href="style/default.css" 	rel="stylesheet" type="text/css" media="all" />
	<link href="style/fonts.css" 	rel="stylesheet" type="text/css" media="all" />

	<!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script type="text/javascript" src="jscripts/check_login.js"></script>
	<script type="text/javascript" src="jscripts/create_menu.js"></script>
	<script type="text/javascript" src="jscripts/create_copyright.js"></script>

</head>

<body>
	<div id="wrapper">
		<div id="header" class="container">
			<div id="logo">
				<h1><a href="#">Sahyadrians</a></h1>
			</div>
			<div id="menu">
				<ul>
					<script>create_menu(1,0)</script>
				</ul>
			</div>
		</div>
		<div id="banner"></div>
		<div id="featured">
			<div class="container">
				<div class="title">
					<h2>Sahyadri School Alumni Association</h2>
					<span class="byline">"A friend is someone who gives you total freedom to be yourself."<br> - Jim Morisson</span>
				</div>
			</div>
			<ul class="actions">
				<li><a href="#" class="button">Log-In</a></li>
			</ul>
		</div>
	</div>
	<script>create_copyright()</script>
</body>

</html>
