<?php
require __DIR__ . '/../boot/boot.php';

use Hotel\User;

//Get users
$user = new User();

$userRecord = $user->getByEmail('hotel_user@example.com');
print_r( $userRecord );


