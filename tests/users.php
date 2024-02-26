<?php

require __DIR__ . '/../boot/boot.php';

use Hotel\User;

$user = new User();
$list = $user->getList();
print_r( $list );

// create new user
// $status = $user->insert( 'hotel', 'hotel_user@example.com', 'password' );

// var_dump( $status );
print_r( $list );

$verified = $user->verify( 'hotel_user@example.com', 'password' );
var_dump($verified);