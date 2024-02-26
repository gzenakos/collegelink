<?php

function generateToken( $userId ) {
	// Signing key
	$key = 'asfdhkgjlr;ofijhgbfdklfsadf';

	// Create token payload
	$payload = [
	    'user_id' => $userId,
	];
	$payloadEncoded = base64_encode( json_encode( $payload ) );
	$signature      = hash_hmac( 'sha256', $payloadEncoded, $key );

	return sprintf( '%s.%s', $payloadEncoded, $signature );
}

// Generate token
$token = generateToken( 20123 );
var_dump( $token );
