<?php 
	session_start();
	
	// List down the required libraries/functions
	require_once './pscripts/create_menu.php';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<!-- Hide the sign-in message -->
	<style>iframe[src^="https://apis.google.com/u/0/_/widget/oauthflow/toast"] {display: none;}</style>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title>Sahyadrians</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	
	<link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" />
	<link href="style/default.css" 	rel="stylesheet" type="text/css" media="all" />
	<link href="style/fonts.css" 	rel="stylesheet" type="text/css" media="all" />

	<!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="https://apis.google.com/js/client:plusone.js" type="text/javascript"></script>
	<script src="https://apis.google.com/js/client:platform.js" type="text/javascript"></script>
	
	<!-- Code to check if user has signed in -->

	<!-- Code with Google sign-in data -->
	<meta name="google-signin-callback" content="signinCallback" />
	<script type="text/javascript"	src="jscripts/google-signin.js"/>

	<!-- Other scripts used for this and that -->
	<script type="text/javascript" src="./jscripts/create_menu.js"></script>
	<script type="text/javascript" src="./jscripts/create_copyright.js"></script>
	
	<!-- Ensure that functions are called asynchronously -->
	<script>
		(function() {
			var po = document.createElement('script');
			po.type = 'text/javascript'; po.async = true;
			po.src = 'https://apis.google.com/js/client:plusone.js?onload=render';
			var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(po, s);
		})();
	</script>
	
</head>
<body>
	<div id="wrapper">
		<div id="header" class="container">
			<div id="logo">
				<h1><a href="#">Sahyadrians</a></h1>
			</div>
			<div id="menu">
				<?php create_menu(1) ?>
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
				<li><a id="signinButton" href="#" class="button" >Log-In</a></li>
			</ul>
		</div>
	</div>
	<script>create_copyright()</script>

	<div id="signinButton-hack">
		<span class="g-signin"
			data-scope="https://www.googleapis.com/auth/plus.profile.emails.read"
			data-clientid="427000476887.apps.googleusercontent.com"
			data-requestvisibleactions='http://schemas.google.com/AddActivity'
			data-cookiepolicy="single_host_origin"
			data-callback="signInCallback">
		</span>
	</div>
</body>

</html>
