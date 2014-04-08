<?php

function extractEmailAddress($emailAddressVector) {
	$emailvals = array_values($emailAddressVector);
	return $emailAddressVector[0]->value;
}

function createUserInfo() {

	// Get user ID from the session variable
	session_start();
	$userInfo 	= $_SESSION['userInfo'];
	$gID 		= $userInfo->{'id'};

	// Data access flag - to tell where to get data from 
	$dataAccessFlag = 0;
	$result = '{ ';
	
	// connect to the database to check if user details are already present
	include '../db_access/user_info.php';
	$con=mysqli_connect($host_userInfo,$username_userInfo,$password_userInfo,$db_name_userInfo);
	
	// Check connection - if no connection, use all blanks
	if (mysqli_connect_errno()) {
  		echo "Failed to connect to MySQL: " . mysqli_connect_error() . "\n";
		echo "Username: " . $username_userInfo . "\n";
		$dataAccessFlag = -1;				// Cannot connect to the database
 	}
	else {
		$qry    	= "SELECT * FROM $tbl_name_personalInfo WHERE gID='$gID' LIMIT 1";
		$db_result 	= mysqli_query($con,$qry);
		$row 		= mysqli_fetch_array($db_result);
		if ($row) 	{	$dataAccessFlag = 2;	}	// Read from database
		else		{	$dataAccessFlag = 1;	}	// Can't find user - read from Google
	}
	// Access all data from Google
	if( $dataAccessFlag == 1 ) {
		$emailAddress = extractEmailAddress( $userInfo->{'emails'} );
	
		$result = $result . '"isUser": "' . '0'  							. '", ';
		$result = $result . '"id":     "' . $userInfo->{'id'}  				. '", ';
		$result = $result . '"name":   "' . $userInfo->{'displayName'} 		. '", ';
		$result = $result . '"admNo":  "' . "" 								. '", ';
		$result = $result . '"batch":  "' . "" 								. '", ';
		$result = $result . '"gender": "' . $userInfo->{'gender'} 			. '", ';
		$result = $result . '"email":  "' . $emailAddress 					. '", ';
		$result = $result . '"phone":  "' . "" 								. '", ';
	}
	// Access all data from database
	elseif( $dataAccessFlag == 2 ) {
	
		$result = $result . '"isUser": "' . '1'				. '", ';
		$result = $result . '"id":     "' . $row['gID']		. '", ';
		$result = $result . '"name":   "' . $row['name'] 	. '", ';
		$result = $result . '"admNo":  "' . $row['admNo']	. '", ';
		$result = $result . '"batch":  "' . $row['batch']	. '", ';
		$result = $result . '"gender": "' . $row['gender']	. '", ';
		$result = $result . '"email":  "' . $row['email'] 	. '", ';
		$result = $result . '"phone":  "' . $row['phone']	. '", ';
	}

	$result = $result . '"time": "' . date('d-M-y h:m:s') . '" }';

	return json_decode($result);
}

?>