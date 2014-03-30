<?php
	session_start();

	if( isset( $_POST['token'] ) ) {
		$_SESSION['token'] = $_POST['token'];
		echo "Token (POST) - " . $_SESSION['token'];
	}
	elseif( isset( $_GET['token'] ) ) {
		$_SESSION['token'] = $_GET['token'];
		echo "Token (GET) - " . $_SESSION['token'];
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