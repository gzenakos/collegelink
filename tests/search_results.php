<?php
require __DIR__ . '/../boot/boot.php';

use Hotel\Room;

//Get cities
$room = new Room();
//$cities = $room->getCities();
//print_r( $cities );


// Search room

$rooms = $room->search( 'Athens', 2, new DateTime( '2024-06-01' ), new DateTime( '2024-6-12' ) );
print_r($rooms);
