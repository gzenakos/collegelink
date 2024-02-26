<?php
use Hotel\User;
use Hotel\Favorite;

// Boot application
require __DIR__ . '/../../boot/boot.php';

//Return to home page if not a post request
if ( strtolower( $_SERVER['REQUEST_METHOD'] ) != 'post' ) {
	header( 'Location: /public/' );
	return;
}

// If no user is logged in, return to main
if ( empty( User::getCurrentUserId() ) ){
	header( 'Location: /public/' );
	return;
}

// Check if room id is given
$roomId = $_REQUEST['room_id'];
if ( empty ( $roomId ) ) {
	header( 'Location: /public/' );
	return;
}

// Set room to favorites
$favorite = new Favorite();

// Add or remove room from favorites
$isFavorite = $_REQUEST['is_favorite'];

if ( ! $isFavorite ) {
	$favorite->addFavorite( $roomId, User::getCurrentUserId() );
} else {
	$favorite->removeFavorite( $roomId, User::getCurrentUserId() );
}


// Return to room page
header( sprintf('Location: /public/room.php?room_id=%s', $roomId ) );

// // Verify user
// $user = new User();

// try {
// 	if ( ! $user->verify($_REQUEST['email'], $_REQUEST['password'] ) ) {
// 		header( 'Location: /public/login.php?error=Could not verify user' );
// 		return;
// 	}
// } catch ( InvalidArgumentException $ex ) {
// 	header( 'Location: /public/login.php?error=No user exists with the given email' );
// 	return;
// }

// // Create token as cookie for user, for 30 days
// $userInfo = $user->getByEmail( $_REQUEST['email'] );
// $token = $user->getUserToken( $userInfo['user_id'] );
// setcookie( 'user_token', $token, time() * 60 * 60 * 24 * 30, '/' );

// // Return to home page
// header( 'Location: /public/index.php' );