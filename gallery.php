<?php 
	// List down the required libraries/functions
	require_once './pscripts/create_menu.php';
?>

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

<?php
	include '../db_access/gallery_main.php';
	
	// get the required id
	$numAlbums = 0;
	
	// Create connection
	$con=mysqli_connect($host,$username,$password,$db_name);

	// Check connection
	if (mysqli_connect_errno()) {
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		$errorFlag = 2;				// Cannot connect to the database
 	}
	else {
		$qry    	= "SELECT * FROM gallery_main";
		$result 	= mysqli_query($con,$qry);
	}
?>

<head>
	<!-- Hide the sign-in message -->
	<style>iframe[src^="https://apis.google.com/u/0/_/widget/oauthflow/toast"] {display: none;}</style>
	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	<title>Sahyadrians Gallery</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	
	<link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" />
	<link href="style/default.css" 	rel="stylesheet" type="text/css" media="all" />
	<link href="style/fonts.css" 	rel="stylesheet" type="text/css" media="all" />

<!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="https://apis.google.com/js/client:plusone.js" type="text/javascript"></script>
	<script src="https://apis.google.com/js/client:platform.js" type="text/javascript"></script>

	<!-- Code with Google sign-in data -->
	<meta name="google-signin-callback" content="signinCallback" />
	<script type="text/javascript"	src="./jscripts/google-signin.js"/>
	
	<!-- page won't load if I don't include this! god only knows why! -->
	<script src="./jscripts/create_copyright.js"></script>
</head>
<body>
	<div id="wrapper">
		<div id="header" class="container">
			<div id="logo">
				<h1><a href="#">Gallery</a></h1>
			</div>
			<div id="menu">
				<?php create_menu(5) ?>
			</div>
		</div>
		
		<div id="galleryAll" class="container">
			<div class="imageFrames">
				<?php
					$ix = 1;
					while($row = mysqli_fetch_array($result)) {
						if 		($ix % 3 == 1) 	{ echo('<div class="boxGalleryA">'); }
						elseif 	($ix % 3 == 2) 	{ echo('<div class="boxGalleryB">'); }
						else					{ echo('<div class="boxGalleryC">'); }
						echo('<a href="./gallery_each.php?id=' . $row['id'] . '">');
						echo('<img src="' . $row['thumbnail_url'] . '" width="320" height="200" alt="" />');
						echo('</a>');
						echo('<a href="./gallery_each.php?id=' . $row['id'] . '">' . $row['thumbnail_name'] . '!</a>');
						echo('</br></br></br>');
						echo('</div>');
						$ix++;
					}
				?>
			</div>
		</div>
	</div>

	<?php include './pscripts/create_copyright.php';?>

	<div id="signinButton-hack">
		<span class="g-signin"
			data-scope="https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/plus.profile.emails.read"
			data-accesstype="offline"
			data-clientid="427000476887.apps.googleusercontent.com"
			data-redirecturi="postmessage"
			data-requestvisibleactions='http://schemas.google.com/AddActivity'
			data-cookiepolicy="single_host_origin"
			data-callback="signInCallback">
		</span>
	</div>
</body>

</html>
