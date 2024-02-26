<?php

if (isset($_COOKIE['user_token'])) {
	// Set the cookie's expiration time to a past time to remove it
	setcookie('user_token', '', time() - 3600, '/');
}

// Redirect to the login page or any other desired page
header( 'Location: /public/index.php' );

?>
