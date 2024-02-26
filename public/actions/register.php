<?php
// Boot application
require __DIR__ . '/../../boot/boot.php';

use Hotel\User;

//Return to home page if not a post request
if ( strtolower( $_SERVER['REQUEST_METHOD'] ) != 'post' ) {

	header( 'Location: /' );
	return;
}

// Retrieve user
$userInfo = $user->getByEmail( $_REQUEST['email'] );

try {
	if ( $userInfo ) {
		header( 'Location: /public/register.php?error=User exists, try login' );
		return;
	}
} catch ( InvalidArgumentException $ex ) {
	header( 'Location: /public/register.php?error=something is missing try again' );
	return;
}

// Create new user
$user = new User();
$user->insert( $_REQUEST['name'], $_REQUEST['email'], $_REQUEST['password'] );

// Retrieve user
$userInfo = $user->getByEmail( $_REQUEST['email'] );

// Generate token
$token = $user->getUserToken( $userInfo['user_id'] );

// Set cookie
setcookie( 'user_token', $token, time() + ( 30 * 24 * 60 * 60 ), '/' );

// Return to home page
header( 'Location: /public/index.php' );
