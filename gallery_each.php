<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php 
	include '../db_access/gallery_main.php';
	
	// get the required id
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	}
	else {
		$id = 1;
	}
	
	// Create connection
	$con=mysqli_connect($host,$username,$password,$db_name);

	// Check connection
	if (mysqli_connect_errno()) {
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		$errorFlag = 2;				// Cannot connect to the database
 	}
	else {
		$qry    = "SELECT * FROM gallery_main WHERE id=$id LIMIT 1";
		$result = mysqli_query($con,$qry);
		$row = mysqli_fetch_array($result);
		if ($row) 	{	$errorFlag = 0;	}	// All is well
		else		{	$errorFlag = 1;	}	// Cannot find required row
	}
?>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>
		<?php
			if($errorFlag === 0) {echo($row['page_name']);}
			else				{echo("Error");}
		?>
	</title>
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
				<h1><a href="#">
					<?php
						echo("Gallery");
//						if($errorFlag === 0) {echo($row['page_name']);}
//						else				 {echo("Error");}
					?>
				</a></h1>
			</div>
			<div id="menu">
				<ul>
					<script>create_menu(5,1)</script>
				</ul>
			</div>
		</div>
		
		<?php
			// proceed only if there is no error
			if($errorFlag === 0) {
				// proceed if element exists
				if($row['image_title'] != '') {
					echo("<div id=\"slideshow\">");
						echo("<div class=\"title\">");
							echo("<span class=\"byline\">" . $row['image_title'] . "</span>");
						echo("</div>");
						echo("<div>");
							echo ("<embed type=\"application/x-shockwave-flash\" src=\"https://photos.gstatic.com/media/slideshow.swf\" width=\"800\" height=\"533\" flashvars=\"host=picasaweb.google.com&captions=1&hl=en_US&feat=flashalbum&RGB=0x000000&feed=https%3A%2F%2Fpicasaweb.google.com%2Fdata%2Ffeed%2Fapi%2Fuser%2F116857686714701962822%2Falbumid%" . $row['image_albumid'] . "%3Falt%3Drss%26kind%3Dphoto%26authkey%" . $row['image_authuser'] . "%3Den_US\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\"></embed>");
						echo("</div>");
					echo("</div>");
				}
			}
		?>
		
		<?php
			// proceed only if there is no error
			if($errorFlag === 0) {
				// proceed if element exists
				if($row['video_title'] != '') {
					echo ("<div id=\"slideshow\">");
						echo("<div class=\"title\">");
							echo("<span class=\"byline\">" . $row['video_title'] . "</span>" );
						echo("</div>");
						echo("<div>");
							echo("<iframe width=\"800\" height=\"533\" src=\"https://www.youtube.com/embed/" . "videoseries?list=PLzRUWtQwdqL7tQor1o_nYlW-FWPL44p1E" . "\" frameborder=\"0\" allowfullscreen></iframe>");
						echo("</div>");
					echo("</div>");
				}
			}
		?>
	</div>
	
	<script>create_copyright()</script>
</body>

</html>
