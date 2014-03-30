<!--

// Additional params including the callback, the rest of the params will
// come from the page-level configuration.
var additionalParams = {
	'clientid'		: '427000476887.apps.googleusercontent.com',
	'cookiepolicy' 	: 'single_host_origin',
	'callback'		: signinCallback,
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

	// First check if a token has already been generated
	$.ajax({
		type: 'POST',
		url: './pscripts/session_manager.php?getTokenStatus=1',
		async: false,
		success: function(result) {
			userLoggedIn = result;
			console.log('Current user log-in status: ' + userLoggedIn);
		},
		error: function(e) {
			console.log(e);
		}
	});
	if( userLoggedIn == 1 ) {
		alert('User has already logged in');
		console.log('User has already logged in');
		$.ajax({
			type: 'POST',
			url: './pscripts/session_manager.php?setLogin=1',
			async: false,
			success: function(result) {
				userLoggedIn = result;
				console.log('Current user log-in status: ' + userLoggedIn);
			},
			error: function(e) {
				console.log(e);
			}
		});
		window.location.reload(true);
		return;
	}
	
	// If token is not there, we need to initiate flow to get the token
	gapi.auth.signIn(additionalParams);
}

function signoutUser() {
	gapi.auth.signOut();
}

function signinCallback(authResult) {
	
	// Hide the Google sign-in button (hack!)
	$('#signinButton-hack').attr('style', 'display: none');
	console.log('Checking user signed-in status');
	
	if (authResult['status']['signed_in']) {
		// Update the app to reflect a signed in user
		// Hide the sign-in button now that the user is authorized, for example:
		document.getElementById('signinButton').setAttribute('style', 'display: none');
		console.log('Signed in');

		// Sign in and create token in session variable
		console.log('Update token with latest value after sign-in');
		$.ajax({
			type: 'POST',
			url: './pscripts/session_manager.php?token=1',
			async: false,
			success: function(result) {
				console.log('Creating session by storing tokens: ' + result);
			},
			error: function(e) {
				console.log(e);
			}
		});

		if( authResult['status']['method'] == 'PROMPT' ) {
			console.log('Change sign-in status to 1');
			$.ajax({
				type: 'POST',
				url: './pscripts/session_manager.php?setLogin=1',
				async: false,
				success: function(result) {
					userLoggedIn = result;
					console.log('Current user log-in status: ' + userLoggedIn);
				},
				error: function(e) {
					console.log(e);
				}
			});
			window.location.reload(true);
		}
	}
	else {
		// Update the app to reflect a signed out user
		// Possible error values:
		//   "user_signed_out" - User is signed-out
		//   "access_denied" - User denied access to your app
		//   "immediate_failed" - Could not automatically log in the user
		console.log('Sign-in state: ' + authResult['error']);
		document.getElementById('signinButton').setAttribute('style', 'display: show');
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
		if( authResult['error'] == 'user_signed_out' ) { window.location.reload(true); }
	}
}
-->