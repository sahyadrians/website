<?php

	session_start();

	function get_menu_item_class($idx, $pageIdx) {
		if( $idx == $pageIdx )	{ return " class=\"current_page_item\"";}
		else					{ return "";}
	}

	function create_menu($pageIdx) {

		// Write to console
		echo("<script>console.log('Creating menu')</script>");
		
		// Start creating the page
		echo("<ul>");
		
		// Check if the token object has been defined
		echo(
			"<li" . get_menu_item_class( 1, $pageIdx ) . "><a href=\"./index.php\" accesskey=\"1\" title=\"\">Homepage</a></li>" . "\n" .
			"<li" . get_menu_item_class( 2, $pageIdx ) . "><a href=\"#\" accesskey=\"2\" title=\"\">Events</a></li>" . "\n" .
			"<li" . get_menu_item_class( 3, $pageIdx ) . "><a href=\"#\" accesskey=\"3\" title=\"\">Alumni</a></li>" . "\n" .
			"<li" . get_menu_item_class( 4, $pageIdx ) . "><a href=\"#\" accesskey=\"4\" title=\"\">Forum</a></li>" . "\n" .
			"<li" . get_menu_item_class( 5, $pageIdx ) . "><a href=\"./gallery.php\" accesskey=\"5\" title=\"\">Gallery</a></li>" . "\n" .
			"<li" . get_menu_item_class( 6, $pageIdx ) . "><a href=\"#\" accesskey=\"6\" title=\"\">Give Back</a></li>" . "\n"
		);

		if (isset($_SESSION['auth'])) {
			echo(
				"<li" . get_menu_item_class( 7, $pageIdx ) . "><a href=\"./profile.php\" accesskey=\"7\" title=\"\">My Profile</a></li>" . "\n" .
				"<li><a href=\"#\" accesskey=\"8\" title=\"\" onclick=\"signoutUser();return false;\">Log Out</a></li>" . "\n"
			);
		} else {
			echo("<li><a href=\"#\" accesskey=\"7\" title=\"\" onclick=\"signinUser();return false;\">Log In</a></li>" . "\n");
		}
		
		echo("</ul>");
	}

?>