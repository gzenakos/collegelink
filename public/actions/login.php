<?php
// Boot application
require __DIR__ . '/../../boot/boot.php';

use Hotel\User;

//Return to home page if not a post request
if ( strtolower( $_SERVER['REQUEST_METHOD'] ) != 'post' ) {
	header( 'Location: /public/' );
	return;
}

// If there is already logged in user, return to main page
if ( ! empty( User::getCurrentUserId() ) ) {
	header( 'Location: /public/' );
	return;
}

// Verify user
$user = new User();

try {
	if ( ! $user->verify( $_REQUEST['email'], $_REQUEST['password'] ) ) {
		header( 'Location: /public/login.php?error=Could not verify user' );
		return;
	}
} catch ( InvalidArgumentException $ex ) {
	header( 'Location: /public/login.php?error=No user exists with the given email' );
	return;
}

// Create token as cookie for user, for 30 days
$userInfo = $user->getByEmail( $_REQUEST['email'] );
$token    = $user->getUserToken( $userInfo['user_id'] );

setcookie( 'user_token', $token, time() + ( 30 * 24 * 60 * 60 ), '/' );

// Return to home page
header( 'Location: /public/index.php' );