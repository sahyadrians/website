<?php 

	// List down the required libraries/functions
	require_once './pscripts/create_menu.php';
	require_once './pscripts/create_user_info.php';
	
	if( !isset($_SESSION) ){
		header("Location: ./index.php");
	}
	elseif( !isset($_SESSION['auth']) or ($_SESSION['auth'] == 0 ) ){
		header("Location: ./index.php");
	}
?>

<?php
	$userInfo = createUserInfo();
	
	// Flag tells us whether to update the database or not
	$updateDB = 0;

	// This in the information we want from people
	$gID	 = $userInfo->{'id'};
	$isDB	 = $userInfo->{'isUser'};
	$name    = $userInfo->{'name'};
	$admNo   = $userInfo->{'admNo'};
	$batch   = $userInfo->{'batch'};
	$gender  = $userInfo->{'gender'};
	$email   = $userInfo->{'email'};
	$phone   = $userInfo->{'phone'};
	$img	 = $userInfo->{'image'};
	
	//	$comment = "";
	//	$website = $userInfo->{'url'};

	// define variables and set to empty values
	$gIDErr = $nameErr = $admNoErr = $emailErr = $batchErr = $genderErr = $emailErr = $phoneErr = "";
	$websiteErr = "";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
		// Google ID
		if (empty($gID))	{ $gIDErr = "Google ID is required";}
		else 				{ $gID = $userInfo->{'id'}; }
		
		// Name
		if (empty($_POST["name"]))	{$nameErr = "Name is required";}
		else {
			$name = test_input($_POST["name"]);
			// check if name only contains letters and whitespace
			if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
				$nameErr = "Only letters and white space allowed"; 
			}
		}
		
		// Admission Number
		if (empty($_POST["admNo"]))	{$admNoErr = "Admission Number is required";}
		else {
			$admNo = test_input($_POST["admNo"]);
			// check if name only contains letters and whitespace
			if (!preg_match("/^[0-9]*$/",$admNo)) {
				$admNoErr = "Must be a number!!"; 
			}
		}

		// Batch
		if (empty($_POST["batch"]))	{$batchErr = "Batch is required";}
		else {
			$batch = test_input($_POST["batch"]);
			// check if name only contains letters and whitespace
			if (!preg_match("/^[0-9]*$/",$batch)) {
				$batchErr = "Must be a number!!"; 
			}
		}
		
		// Gender
		if (empty($_POST["gender"])) { $genderErr = "Gender is required";}
		else {$gender = test_input($_POST["gender"]);}

		// Email
		if (empty($_POST["email"]))	{$emailErr = "Email is required";}
		else {
			$email = test_input($_POST["email"]);
			// check if e-mail address syntax is valid
			if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
				$emailErr = "Invalid email format"; 
			}
		}
		
		// Phone
		if (empty($_POST["phone"]))	{$phoneErr = "Phone number is required";}
		else {
			$phone = test_input($_POST["phone"]);
			// check if phone address syntax is valid
			if (!preg_match("/^[+][0-9]{1,15}$/",$phone)) {
				$phoneErr = "Invalid phone number format. Format e.g. +919988776655"; 
			}
		}
	
		// If this comes in as a post request and no errors are there
		if ( isset($_POST["updateDB"]) and ($_POST["updateDB"] ==1) ){
			if( ( $gIDErr == "" )  and ( $nameErr == "" ) and ( $admNoErr == "" ) and ($batchErr == "" ) and ($genderErr == "" )
				and ($emailErr == "" ) and ( $phoneErr == "" ) ) {
					$updateDB = 1;
				}
			else {
//				echo "no";
//				echo $gIDErr . $nameErr . $admNoErr . $emailErr . $batchErr . $genderErr . $emailErr . $phoneErr;
			}
		}
	}

	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
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

	<!-- Code with Google sign-in data -->
	<meta name="google-signin-callback" content="signinCallback" />
	<script type="text/javascript"	src="jscripts/google-signin.js"/>
	
	<!-- Code that creates AJAX uploader -->
	
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
				<h1><a href="#">Profile</a></h1>
			</div>
			<div id="menu">
				<?php create_menu(7) ?>
			</div>
		</div>
<!--		
		<div id="featuredBorder">
			<div class="container">
				<a>Sahyadrian Alumni Profile</a>
			</div>
		</div>
-->		
		<div id="userProfile">
			<div class="centerBox">
				<h2 align="center">Sahyadrians User Information<br><br></h2>
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<table style="width:600px">
						<tr>
							<td valign="center" align="right">
								<a>Display Picture:</a>
							</td>
							<td align="center">
								<div id="userImg">
									<img src="<?php echo $userInfo->{'image'} ?>" height="150">
								</div>
								<input type="button" id="uploader" value="Upload">
							</td>
						</tr>
						<tr>
							<td valign="center" align="right">
								<a>Name:</a>
								<span class="error">*</span>
							</td>
							<td align="center">
								<input type="text" size="30" name="name" value="<?php echo $name;?>"><br>
								<span class="error"><?php echo $nameErr;?></span>
							</td>
						</tr>
						<tr>
							<td valign="center" align="right">
								<a>Admission Number:</a>
								<span class="error">*</span>
							</td>
							<td align="center">
								<input type="text" size="30" name="admNo" value="<?php echo $admNo;?>"><br>
								<span class="error"><?php echo $admNoErr;?></span>
							</td>
						</tr>
						<tr>
							<td valign="center" align="right">
								<a>Batch (the year you finished 10th grade):</a>
								<span class="error">*</span>
							</td>
							<td align="center">
								<select name="batch">
									<?php
										function createOptions($yr,$yrSelect){
											if ($yr == $yrSelect) 	{ echo '<option value="' . $yr . '" selected="selected">' . $yr . '</option>' . "\n"; }
											else					{ echo '<option value="' . $yr . '">' . $yr . '</option>' . "\n"; }
										}
										createOptions(1999,$batch);
										createOptions(2000,$batch);
										createOptions(2001,$batch);
										createOptions(2002,$batch);
										createOptions(2003,$batch);
										createOptions(2004,$batch);
										createOptions(2005,$batch);
										createOptions(2006,$batch);
										createOptions(2007,$batch);
										createOptions(2008,$batch);
										createOptions(2009,$batch);
										createOptions(2010,$batch);
										createOptions(2011,$batch);
										createOptions(2012,$batch);
										createOptions(2013,$batch);
										createOptions(2014,$batch);
									?>
								</select>
								<span class="error"><?php echo $batchErr;?></span>
							</td>
						</tr>
						<tr>
							<td valign="center" align="right">
								<a>Gender:</a>
								<span class="error">*</span>
							</td>
							<td align="center">
								<input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?>  value="female">Female
								<input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?>  value="male">Male<br>
								<span class="error"><?php echo $genderErr;?></span>
							</td>
						</tr>
						<tr>
							<td valign="center" align="right">
								<a>E-mail:</a>
								<span class="error">*</span>
							</td>
							<td align="center">
								<input type="text" size="30" name="email" value="<?php echo $email;?>"><br>
								<span class="error"><?php echo $emailErr;?></span>
							</td>
						</tr>
						<tr>
							<td valign="center" align="right">
								<a>Phone (with country code):</a>
								<span class="error">*</span>
							</td>
							<td align="center">
								<input type="text" size="30" name="phone" value="<?php echo $phone;?>"><br>
								<span class="error"><?php echo $phoneErr;?></span>
							</td>
						</tr>
					</table>
					<br>
					<table style="width:600px">
						<tr>
							<td align="center">
								<input type="checkbox" name="updateDB" value="1">I agree that the above is true!
							</td>
						</tr>
						<tr>
							<td align="center">
								<input type="submit" name="submit" value="Submit"> 
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	
	<?php
	
	if( $updateDB == 1 ) {
		include '../db_access/user_info.php';
		$con=mysqli_connect($host_userInfo,$username_userInfo,$password_userInfo,$db_name_personalInfo);
		// If a new user is registering, insert data into database
		if( $userInfo->{'isUser'} == '0' ) {
			$qry = "INSERT INTO $tbl_name_personalInfo" .
					"(gID, admNo, name, batch, gender, email, phone)" .
					" VALUES ( '$gID', '$admNo', '$name', '$batch', '$gender', '$email', '$phone' )";
			if (!mysqli_query($con,$qry)) { die('Error: ' . mysqli_error($con)); }
			
			// Print a message when success
			print '<script type="text/javascript">'; 
			print 'alert("New user has been registered!")'; 
			print '</script>';
		}
		elseif( $userInfo->{'isUser'} == '1' ) {
			$qry = "UPDATE $tbl_name_personalInfo SET " .
					"admNo='$admNo', name='$name', batch='$batch', gender='$gender', email='$email', phone='$phone' WHERE gID='$gID'";
			if (!mysqli_query($con,$qry)) { die('Error: ' . mysqli_error($con)); }
			
			// Print a message when success
			print '<script type="text/javascript">'; 
			print 'alert("User data has been updated!")'; 
			print '</script>';
		}
		mysqli_close($con);
	}
	
	if( ( $updateDB == 0 ) and ($_SERVER["REQUEST_METHOD"] == "POST") ) {
			
		// Print a message when success
		print '<script type="text/javascript">'; 
		print 'alert("Please check the agreement checkbox")'; 
		print '</script>';	
	}
?>
	</div>
	
	<?php include './pscripts/create_copyright.php'; ?>

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
	
	<!-- This manages the AJAX image uploading section -->
	<script type="text/javascript" src="./jscripts/upclick-min.js"></script>
	<script type="text/javascript">
		var uploader = document.getElementById('uploader');
		upclick({
			element: uploader,
			action: './pscripts/image_loader.php',
			onstart:
				function(filename) {
					alert('Start upload: '+filename);
				},
			oncomplete:
				function(response_data) {
					console.log(response_data);
					obj = JSON.parse(response_data);
					console.log("Token status - \n" +
							'\tSession message: ' + obj.session_msg 	+ "\n" +
							'\tNew file       : ' + obj.newFile			+ "\n" +
							'\tStatus         : ' + obj.status );
					if( obj.status == '0' ){
						console.log( "Error saving image\n" );
						alert( "Sorry - there was an error loading your image." );
					}
					else{ 
						document.getElementById("userImg").innerHTML = "<img src=\"./pscripts/image_loader.php\" height=\"150\">";
					}
				}
		});
	</script>
</body>

</html>
