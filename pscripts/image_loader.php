<?php

	// For some reason, this is required always. Pah!
	session_start();
	if( !isset( $_SESSION['id'] ) ) {
		$session_msg = $result . "Starting new session - " . session_id();
		$_SESSION['id'] = session_id();
	}
	else {
		$session_msg = "Continuing old session - " . $_SESSION['id'] ;
	}
	$result = '{ "session_msg": "' . $session_msg . '", ';
	
	$userInfo 	= $_SESSION['userInfo'];
	$gID 		= $userInfo->{'id'};
	$result = $result . ' "user_id": "' . $gID . '", ';

	if( ( $_SERVER["REQUEST_METHOD"] == "POST" ) and ( !empty( $_FILES['Filedata']['tmp_name'] ) ) ) {
		$tmp_file_name = $_FILES['Filedata']['tmp_name'];
		$ok = move_uploaded_file( $tmp_file_name, '../../profile_pics/' . $gID );
		$result = $result . '"newFile": "' . $gID . '",   ';
		if( $ok )	{ $result = $result . '"status": "1",   '; }
		else		{ $result = $result . '"status": "0",   '; }
		$result = $result . '"time": "' . date('d-M-y h:m:s') . '" }';
		echo $result . "\n";
	}
	
	else {
		header('Content-type: image/jpeg');
		readfile('../../profile_pics/' . $gID );
	}

?>