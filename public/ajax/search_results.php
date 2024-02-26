<?php

require __DIR__ . '/../../boot/boot.php';

use Hotel\Room;
use Hotel\RoomType;
// use DateTime;

// Initialize Room service
$room = new Room();

//Get all cities
$cities = $room->getCities();

//Get all Room types
$type     = new RoomType();
$allTypes = $type->getAllTypes();

//Get all Count Of Guests
// $countOfGuests    = new CountOfGuests();
$allCountOfGuests = $room->getAllCountOfGuests();


//Get page parameters
$selectedCity          = $_REQUEST['city'];
$selectedTypeId        = $_REQUEST['room_type'];
$selectedCheckInDate   = date( 'Y-m-d', strtotime( $_REQUEST['check_in_date'] ) );
$selectedCheckOutDate  = date( 'Y-m-d', strtotime( $_REQUEST['check_out_date'] ) );
$selectedCountOfGuests = $_REQUEST['count_of_guests'];
$selectedPriceMin      = $_REQUEST['price_min'];
$selectedPriceMax      = $_REQUEST['price_max'];


$selectedAvailableRooms = $room->search( new DateTime( $selectedCheckInDate ), new DateTime( $selectedCheckOutDate ), $selectedCity, $selectedTypeId, $selectedCountOfGuests, $selectedPriceMin, $selectedPriceMax );


?>
<section class="hotel-list box w-100 p-0 mt-5 m-md-0">
	<header class="page-title rounded bg-orange">
		<h2 class="py-2 px-3 m-0 h5 text-white">Search Results From Ajax</h2>
	</header>
	<section>
		<?php
		foreach ( $selectedAvailableRooms as $avalailableRoom ) {
			?>
			<article class="hotel media container w-100 py-3 py-md-5 d-flex flex-wrap px-0">
				<aside class="media col-md-2 px-0 pr-md-2">
					<img class="w-100" src="assets/images/rooms/<?php echo $avalailableRoom['photo_url']; ?>" alt=<?php echo $avalailableRoom['name']; ?> thumbnail image" height="auto">
				</aside>
				<main class="info col-md-10 border-left-orange mt-2 mt-md-0 pr-0">
					<h1 class="h4 mb-0"><?php echo $avalailableRoom['name']; ?></h1>
					<h2 class="h5"><small><?php echo $avalailableRoom['city']; ?>, <?php echo $avalailableRoom['area']; ?></small></h2>
					<p><?php echo $avalailableRoom['description_short']; ?></p>
					<div class="text-right text-white">
						<a class="btn rounded py-1 px-2 btn-warning" href="room.php?room_id=<?php echo $avalailableRoom['room_id']; ?>&check_in_date=<?php echo $selectedCheckInDate; ?>&check_out_date=<?php echo $selectedCheckOutDate; ?>">Go to room page</a>
					</div>
				</main>
				<footer class="col-12 d-flex flex-wrap pl-0 pr-0 mt-4">
					<div class="col-md-2 price-per-night px-1 py-2 text-white text-center">
						<small class="m-0">Per night: <?php echo $avalailableRoom['price']; ?>€</small>
					</div>
					<div class="col-md-10 px-0 pl-md-2">
						<div class="d-flex flex-wrap rounded count-and-type">
							<div class="col-sm-6 count-of-guests px-1 py-2 text-center">
							<small>Count of Guests:<?php echo $avalailableRoom['count_of_guests']; ?></small>
							</div>
							<div class="col-sm-6 type-of-room px-1 py-2 text-center">
							<small>Type of Room:<?php echo $avalailableRoom['type_id']; ?></small>
							</div>
						</div>

					</div>
				</footer>
				<div class="clear"></div>
			</article>
			<?php
		}
		?>
		<?php
		if ( count( $selectedAvailableRooms ) === 0 ) {
			?>
			<h2 class="mt-3">There are no rooms !!!</h2>
			<?php
		}
		?>
		<br>
	</section>
</section>
