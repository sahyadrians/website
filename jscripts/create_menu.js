<!--

function create_menu(pageIdx,auth) {

	if (pageIdx == 1) {
		document.write("<li class=\"current_page_item\"><a href=\"./index.html\" accesskey=\"1\" title=\"\">Homepage</a></li>");
	} else {
		document.write("<li><a href=\"./index.html\" accesskey=\"1\" title=\"\">Homepage</a></li>");
	}
		
	if (pageIdx == 2) {
		document.write("<li class=\"current_page_item\"><a href=\"#\" accesskey=\"2\" title=\"\">Events</a></li>");
	} else {
		document.write("<li><a href=\"#\" accesskey=\"2\" title=\"\">Events</a></li>");
	}
	
	if (pageIdx == 3) {
		document.write("<li class=\"current_page_item\"><a href=\"#\" accesskey=\"3\" title=\"\">Alumni</a></li>");
	} else {
		document.write("<li><a href=\"#\" accesskey=\"3\" title=\"\">Alumni</a></li>");
	}
	
	if (pageIdx == 4) {
		document.write("<li class=\"current_page_item\"><a href=\"#\" accesskey=\"4\" title=\"\">Forum</a></li>");
	} else {
		document.write("<li><a href=\"#\" accesskey=\"4\" title=\"\">Forum</a></li>");
	}
	
	if (pageIdx == 5 ) {
		document.write("<li class=\"current_page_item\"><a href=\"./gallery.php\" accesskey=\"5\" title=\"\">Gallery</a></li>");
	} else {
		document.write("<li><a href=\"./gallery.php\" accesskey=\"5\" title=\"\">Gallery</a></li>");
	}
	
	if (pageIdx == 6 ) {
		document.write("<li class=\"current_page_item\"><a href=\"#\" accesskey=\"6\" title=\"\">Give Back</a></li>");
	} else {
		document.write("<li><a href=\"#\" accesskey=\"6\" title=\"\">Give Back</a></li>");
	}
	
	var x = isUserLoggedIn(auth);
	if (x) {
		document.write("<li><a href=\"#\" accesskey=\"7\" title=\"\">My Profile</a></li>");
		document.write("<li><a href=\"#\" accesskey=\"8\" title=\"\">Log Out</a></li>");
	} else {
		document.write("<li><a href=\"#\" accesskey=\"7\" title=\"\">Log In</a></li>");
	}
	
	return true;
}

-->