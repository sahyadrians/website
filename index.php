<?php session_start(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<!--
Design by Free CSS Templates
http://www.freecsstemplates.org
Released for free under a Creative Commons Attribution 2.5 License

Name       : CrossWalk 
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20140216

-->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="google-signin-callback" content="signinCallback" />

	<title>Sahyadrians</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	
	<link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" />
	<link href="style/style.css" 	rel="stylesheet" type="text/css" media="all" />
	<link href="style/subModal.css" rel="stylesheet" type="text/css" media="all" />
	<link href="style/default.css" 	rel="stylesheet" type="text/css" media="all" />
	<link href="style/fonts.css" 	rel="stylesheet" type="text/css" media="all" />

	<!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->

<!--	<script type="text/javascript" src="jscripts/javascript_asynchronous_loader.js"></script> -->

	<script type="text/javascript">
		(function() {
			var po = document.createElement('script');
			po.type = 'text/javascript'; po.async = true;
			po.src = 'https://plus.google.com/js/client:plusone.js';
			var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(po, s);
		})();
	</script>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="https://apis.google.com/js/client:plusone.js" type="text/javascript"></script>
	<script type="text/javascript" src="jscripts/common.js"></script>
	<script type="text/javascript" src="jscripts/subModal.js"></script>
	<script type="text/javascript" src="jscripts/check_login.js"></script>
	<script type="text/javascript" src="jscripts/create_menu.js"></script>
	<script type="text/javascript" src="jscripts/create_copyright.js"></script>
	
	<script>
		function signinCallback(authResult) {
			if (authResult['status']['signed_in']) {
				// Your user is signed in. You can use the access token to perform API
				// calls or if you get a `code`, you could send that to your server to
				// get server-side access to the APIs.
				alert('Logged in');
			} else {
				// User is not signed in to your app, handle any user interface
				// changes or other aspects of your design based on this condition.
				alert('Not logged in');
			}
			return 1;
		}
		var v = gapi.auth.checkSessionState({client_id:'427000476887.apps.googleusercontent.com'}, signinCallback);
	</script>
</head>
<body>
	
	<!-- Create the Sign-In With Google Button -->
	<!--
	<div align="center" id="gConnect" class="hide">
		<button class="g-signin"
			data-scope="https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/plus.profile.emails.read"
			data-requestvisibleactions="http://schemas.google.com/AddActivity"
			data-clientId="427000476887.apps.googleusercontent.com"
			data-accesstype="offline"
			data-callback="onSignInCallback"
			data-theme="dark"
			data-cookiepolicy="single_host_origin">
		</button>
	</div>
	-->
	
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

<script>
</script>

</html>
