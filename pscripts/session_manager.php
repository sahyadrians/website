<?php
	session_start();

	if( isset( $_POST['token'] ) and isset( $_POST['access_token'] ) and isset( $_POST['expiry'] ) and isset( $_POST['code'] ) ) {
		$_SESSION['token'] 			= $_POST['token'];
		$_SESSION['access_token'] 	= $_POST['access_token'];
		$_SESSION['expiry'] 		= $_POST['expiry'];
		$_SESSION['code']			= $_POST['code'];
		echo "Token (POST) - " . $_SESSION['token'];
	}
	
	// Checking token status
	elseif( isset( $_POST['getTokenStatus'] ) or isset( $_GET['getTokenStatus'] ) ) {
		if( isset( $_SESSION['token'] ) ) 	{ 
			$_SESSION['auth']		= true;
			echo $_SESSION['auth'];
		}
		else { echo 0; }
	}

	else {
		session_destroy();
		echo "Session destroyed";
	}

?>