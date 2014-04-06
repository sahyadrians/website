<!--

// Additional params including the callback, the rest of the params will
// come from the page-level configuration.
var additionalParams = {
	'clientid'		: '427000476887.apps.googleusercontent.com',
	'cookiepolicy' 	: 'single_host_origin',
	'callback'		: signinCallback,
	'redirecturi'	: 'postmessage',
    'accesstype'	: 'offline',
	'scope' 		: 'https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/plus.profile.emails.read',
	'requestvisibleactions' : 'http://schemas.google.com/AddActivity'
};

// Executed when the APIs finish loading
function render() {
	console.log('Calling render function');
	
	// Attach a click listener to a button to trigger the flow.
	var signinButton = document.getElementById('signinButton');
	signinButton.addEventListener('click', function() {
		gapi.auth.signIn(additionalParams); // Will use page level configuration
	});
}


function signinUser() {

	// First check if user has signed into Google and given Sahyadrians access
	// (i.e. we check if a token has already been generated)
	isToken = 1;
	$.ajax({
		type: 'POST',
		url: './pscripts/session_manager.php?getTokenStatus=1',
		async: false,
		success: function(result) {
			obj = JSON.parse(result);
			console.log("Token status - \n" +
							'\tSession message: ' + obj.session_msg 	+ "\n" +
							'\tAction message : ' + obj.msg  			+ "\n" +
							'\tStatus         : ' + obj.status );
			isToken = obj.status;
		},
		error: function(e) {
			console.log(e);
		},
		data: {
			getTokenStatus: "1",
		},
	});

	if( isToken == 0 ) {
		// If token is not there, we need to initiate flow to get the token
		gapi.auth.signIn(additionalParams);
		return;
	}
	
	// else, we check if user has registered - if yes, reload page, else make him fill profile
	window.location.reload(true);
}

function signoutUser() {
	console.log('Signing out user');
	gapi.auth.signOut();
	window.location.reload(true);
}

function signinCallback(authResult) {
	
	// Hide the Google sign-in button (hack!)
	$('#signinButton-hack').attr('style', 'display: none');
	console.log('Checking user signed-in status');
	
	if (authResult['status']['signed_in']) {
		// Update the app to reflect a signed in user
		// Hide the sign-in button now that the user is authorized, for example:
		try {
			document.getElementById('signinButton').setAttribute('style', 'display: none');
		}
		catch (err){
			console.log("Cannot hide sign-in button. Error: " + err );	
		}
		console.log('Signed in');
		 
		// Sign in and create token in session variable
		console.log('Update token with latest value after sign-in');
		$.ajax({
			type: 'POST',
			url: './pscripts/session_manager.php',
			data: {
				token: 			authResult['id_token'],
				access_token: 	authResult['access_token'],
				expiry: 		authResult['expires_in'],
				code:			authResult['code']
			},
			async: false,
			success: function(result) {
				obj = JSON.parse(result);
				console.log("Set tokens - \n" +
								'\tSession message: ' + obj.session_msg 	+ "\n" +
								'\tAction message : ' + obj.msg  			+ "\n" +
								'\tStatus         : ' + obj.status );
			},
			error: function(e) {
				console.log(e);
			}
		});

		console.log( 'Sign-in callback method: ' + authResult['status']['method'] );
		if( authResult['status']['method'] == 'PROMPT' ) {
			console.log('Change sign-in status to 1');
			signinUser();
		}
	}
	else {
		// Update the app to reflect a signed out user
		// Possible error values:
		//   "user_signed_out" - User is signed-out
		//   "access_denied" - User denied access to your app
		//   "immediate_failed" - Could not automatically log in the user
		console.log('Sign-in state: ' + authResult['error']);
		try {
			document.getElementById('signinButton').setAttribute('style', 'display: show');
		}
		catch (err){
			console.log("Cannot show sign-in button. Error: " + err );	
		}
		// Create session by storing token in session variable
		$.ajax({
			type: 'POST',
			url: './pscripts/session_manager.php',
			async: false,
			success: function(result) {
				console.log('Destroying tokens: ' + result);
			},
			error: function(e) {
				console.log(e);
			}
		});
	}
}

-->