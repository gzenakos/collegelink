<?php

function generateToken( $userId )
{
	// Signing key
	$key = 'asfdhkgjlr;ofijhgbfdklfsadf';

	// Create token payload
	$payload = [
	    'user_id' => $userId,
	];
	$payloadEncoded = base64_encode(json_encode($payload));
	$signature = hash_hmac('sha256', $payloadEncoded, $key);

	return sprintf('%s.%s', $payloadEncoded, $signature);
}

function getTokenPayload($token)
{
    // Get payload and signature
    [$payloadEncoded] = explode('.', $token);

    // Get payload
    return json_decode(base64_decode($payloadEncoded), true);
}

function verifyToken($token)
{
    // Get payload
    $payload = getTokenPayload($token);
    $userId = $payload['user_id'];

    // Generate signature and verify
    return generateToken($userId) == $token;
}

// Generate token
$token = generateToken(10);
var_dump($token);

// Verify token
$verified = verifyToken($token);
var_dump($verified);

