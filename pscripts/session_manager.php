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
		if( isset( $_SESSION['token'] ) ) 	{ echo 1; }
		else								{ echo 0; }
	}
	
	// Set the log-in status to whatever value
	elseif( isset( $_POST['setLogin'] ) ) {
		$_SESSION['auth'] = $_POST['setLogin'];
		echo "Auth set to " . $_SESSION['auth'] . " by POST method";
	}
	elseif( isset( $_GET['setLogin'] ) ) {
		$_SESSION['auth'] = $_GET['setLogin'];
		echo "Auth set to " . $_SESSION['auth'] . " by GET method";
	}

	else {
		session_destroy();
		echo "Session destroyed";
	}

?>