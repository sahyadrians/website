<?php
	// For some reason, this is required always. Pah!
	session_start();
	
	if( !isset( $_SESSION['id'] ) ) {
		$session_msg = $result . "Starting new session - " . session_id();
		$_SESSION['id'] = session_id();
	}
	else {
		$session_msg = "Continuing old session - " . session_id() ;
	}
	$result = '{ "session_msg" : "' . $session_msg . '", ';
	

	if( isset( $_POST['token'] ) and isset( $_POST['access_token'] ) and isset( $_POST['expiry'] ) and isset( $_POST['code'] ) ) {
		$_SESSION['token'] 			= $_POST['token'];
		$_SESSION['access_token'] 	= $_POST['access_token'];
		$_SESSION['expiry'] 		= $_POST['expiry'];
		$_SESSION['code']			= $_POST['code'];
		$result = $result . '"msg": "Setting session variables - token, access_token, code and expiry", ';
		$result	= $result . '"status": "1" ';
	}
	
	// Checking token status
	elseif( isset( $_POST['getTokenStatus'] ) or isset( $_GET['getTokenStatus'] ) ) {
		if( isset( $_SESSION['token'] ) ) 	{ 
			$_SESSION['auth']		= true;
			$result = $result . '"msg": "Setting auth variables - ' . $_SESSION['auth'] . '", ';
			$result	= $result . '"status": "1" ';
		}
		else {
			$result = $result . '"msg": "Not setting auth variables\n", ';
			$result	= $result . '"status": "0" ';
		}
	}

	else {
		if( $_SESSION ){		
			session_destroy();
			$result = $result . '"msg": "Destroying session: ' . session_id() . ', ';
		}
		else {
			$result = $result . '"msg": "No session present", ';
		}
		$result	= $result . '"status": "0" ';
	}
	
	$result = $result . '}';

	echo $result;
?>