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
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Sahyadrians Gallery</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	
	<link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" />
	<link href="style/default.css" 	rel="stylesheet" type="text/css" media="all" />
	<link href="style/fonts.css" 	rel="stylesheet" type="text/css" media="all" />

<!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->

	<script src="jscripts/check_login.js"></script>
	<script src="jscripts/create_menu.js"></script>
	<script src="jscripts/create_copyright.js"></script>

</head>
<body>
	<div id="wrapper">
		<div id="header" class="container">
			<div id="logo">
				<h1><a href="#">Gallery</a></h1>
			</div>
			<div id="menu">
				<ul>
					<script>create_menu(5,1)</script>
				</ul>
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
	
	<script>create_copyright()</script>
</body>

</html>
