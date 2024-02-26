<?php
use Hotel\User;
use Hotel\Favorite;

// Boot application
require __DIR__ . '/../../boot/boot.php';

//Return to home page if not a post request
if ( strtolower( $_SERVER['REQUEST_METHOD'] ) != 'post' ) {
	echo 'This is a post script';
	die;
}

// If no user is logged in, do nothing
if ( empty( User::getCurrentUserId() ) ) {
	echo '<script>alert("Please login to add favorite room");</script>';
	die;
}

// Check if room id is given
$roomId = $_REQUEST['room_id'];
if ( empty ( $roomId ) ) {
	echo 'No room is given for this operation';
	die;
}


// Verify csrf
$csrf = $_REQUEST['csrf'];
if ( ! $csrf || ! User::verifyCsrf( $csrf ) ) {
	echo '<script>alert("This is an invalid request");</script>';
	return;
}

// Set room to favorites
$favorite = new Favorite();

// Add or remove room from favorites
$isFavorite = $_REQUEST['is_favorite'];

if ( ! $isFavorite ) {
	$status = $favorite->addFavorite( $roomId, User::getCurrentUserId() );
} else {
	$status = $favorite->removeFavorite( $roomId, User::getCurrentUserId() );
}


// Return operation status
header( 'Content-Type: application/json' );

echo json_encode( ['status' => $status, 'is_favorite' => ! $isFavorite] );

// Return to room page
// header( sprintf('Location: /../public/room.php?room_id=%s', $roomId ) );