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

/*
	
	// To get a session variable, one should give the parameter varName
	if( isset( $_POST['varNameGet'] ) ) {
		$varName = $_POST['varNameGet'];
		if( isset( $_SESSION[varName] ) )	{ echo $_SESSION[$varName]; }
		else								{ echo ""; }
	}
	elseif( isset( $_GET['varNameGet'] ) ) {
		$varName = $_GET['varNameGet'];
		if( isset( $_SESSION[$varName] ) )	{ echo $_SESSION[$varName]; }
		else								{ echo ""; }
	}
	
	// To get a set a variable, one should give the parameter varNameSet and val
	elseif( isset( $_POST['varNameSet'] ) and isset( $_POST['val'] ) ) {
		$varName = $_POST['varName'];
		$_SESSION[$varName] = $_POST['val'];
		echo $_POST['val'];
	}
	elseif( isset( $_GET['varNameSet'] ) and isset( $_GET['val'] ) ) {
		$varName = $_GET['varName'];
		$_SESSION[$varName] = $_GET['val'];
		echo $_GET['val'];
	}
	
	// To check if a session exists, the script is called with parameter check=1
	elseif( isset( $_POST['checkToken'] ) or isset($_GET['checkToken'] ) ) {
		if( isset( $_SESSION['token'] ) )	{ echo 1; }
		else								{ echo 0; }
	}

	elseif( isset( $_POST['token'] ) ) {
		$_SESSION['token'] = $_POST['token'];
		echo "Token (POST) - " . $_SESSION['token'];
	}
	elseif( isset( $_GET['token'] ) ) {
		$_SESSION['token'] = $_GET['token'];
		echo "Token (GET) - " . $_SESSION['token'];
	}
*/
	else {
		session_destroy();
		echo "Session destroyed";
	}

?>