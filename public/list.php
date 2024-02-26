<?php
require_once __DIR__ . '/../public/header.php';

require __DIR__ . '/../boot/boot.php';

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
// var_dump($_REQUEST);
//search for room
// $allAvalailableRooms = $room->search( new DateTime( $checkInDate ), new DateTime( $checkOutDate ), $city, $typeId, $countOfGuests );
// var_dump($allAvalailableRooms);die;


$selectedAvailableRooms = $room->search( new DateTime( $selectedCheckInDate ), new DateTime( $selectedCheckOutDate ), $selectedCity, $selectedTypeId, $selectedCountOfGuests, $selectedPriceMin, $selectedPriceMax );

// print_r($selectedAvailableRooms);


?>

<main class="main-content">
	<div class="container">
		<div class="row">
			<aside class="col-md-3 hotel-search">
				<div class="fancySidebar">
					<form class="searchFormList p-4" method="get" action="list.php" onsubmit="">
						<div class="sidebar bg-white">
							<h4 class="uppercase motive section-top text-orange text-center">
								Find the perfect Hotel
							</h4>
							<br>
							<div class="form-row mt-2">
								<div class="form-group w-100 m-0">
									<label for="count_of_guests" class="sr-only">Count of Guests</label>
									<select name="count_of_guests" class="form-control my-0 form-control-md custom-control text-center" id="count_of_guests">
										<option value="" selected="true">Count of Guests</option>
										<?php
										foreach ( $allCountOfGuests as $CountOfGuests ) {
											?>
											<option <?php echo $selectedCountOfGuests === $CountOfGuests ? 'selected="true"' : '' ; ?> value="<?php echo $CountOfGuests; ?>"><?php echo $CountOfGuests; ?></option>
											<?php
										}
										?>
									</select>
								</div>
							</div>
							<div class="form-row mt-2">
								<div class="form-group w-100 m-0">
									<label for="RoomTypeSelect" class="sr-only">Room Type</label>
									<select name="room_type" class="form-control my-0 form-control-md custom-control text-center" id="RoomTypeSelect">
										<option value="" selected="true">Room Type</option>
										<?php
										foreach ( $allTypes as $type ) {
											?>
											<option <?php echo $selectedTypeId === $type['type_id'] ? 'selected="true"' : '' ; ?> value="<?php echo $type['type_id']; ?>"><?php echo $type['title']; ?></option>
											<?php
										}
										?>
									</select>
								</div>
							</div>
							<div class="form-row mt-2">
								<div class="form-group w-100 m-0">
									<label for="CitiesSelect" class="sr-only">City</label>
									<select name="city" class="form-control my-0 form-control-md custom-control text-center" id="CitiesSelect" required>
										<option value="" selected="true">City</option>
										<?php
										foreach ( $cities as $city ) {
											?>
											<option <?php echo $selectedCity === $city ? 'selected="true"' : '' ; ?> value="<?php echo $city; ?>"><?php echo $city; ?></option>
											<?php
										}
										?>
									</select>
								</div>
							</div>
							<div class="form-row mt-2">
								<div class="form-group column w-100 d-flex justify-content-between slider-range-group">
									<div class="col-5 p-0">
										<input name="price_min" value="<?php echo $selectedPriceMin ? $selectedPriceMin : '0 €' ; ?>" class="form-control my-0 w-100" type="text" id="amount-min">
									</div>
									<div class="col-5 p-0">
										<input name="price_max" value="<?php echo $selectedPriceMax ? $selectedPriceMax : '1000 €' ; ?>" class="form-control my-0 w-100" type="text" id="amount-max">
									</div>
								</div>
								<div id="slider-range" class="w-100"></div>
								<small class="w-100"><span>Price min</span><span class="float-right">Price max</span></small>
							</div>
							<div class="form-row mt-2">
								<div class="form-group w-100 m-0">
									<input name="check_in_date" value="<?php echo $_REQUEST['check_in_date']; ?>" class="form-control my-0 form-control-md custom-control text-center" type="text" id="check-in-date" placeholder="Check-in Date" required />
								</div>
							</div>
							<div class="form-row mt-2">
								<div class="form-group w-100 m-0">
									<input name="check_out_date" value="<?php echo $_REQUEST['check_out_date']; ?>" class="form-control my-0 form-control-md custom-control text-center" type="text" id="check-out-date" placeholder="Check-out Date" required />
								</div>
							</div>
							<div class="form-row mt-2 d-flex justify-content-center">
								<button type="submit" class="btn btn-warning w-100">FIND HOTEL</button>
							</div>
							<?php if ( ! empty( $_GET ) ) { ?>
							<div class="form-row mt-2 d-flex justify-content-center mt-2">
								<a href="list.php" type="button" class="text-white btn btn-warning w-100">Clear</a>
							</div>
							<?php } ?>
						</div>
					</form>
				</div>
			</aside>
			<div class="col-md-1"></div>
			<div id="search-results-container" class="col-md-8">
				<?php require_once __DIR__ . '/../public/ajax/search_results.php'; ?>
			</div>
		</div>
	</div>
	<section>
	<!-- Menu section start -->
		<!-- <section class="menu">
			<div class="secondary-menu">
				<ol>
					<li><h4><a href="">Sort by Name</a></h4></li>
					<li><p>Price > 100€</p></li>
					<li>
						Filter by Location
						<ul>
							<li>Thessaloniki</li>
							<li>Athens</li>
						</ul>
					</li>
				</ol>
			</div>
		</section> -->
	<!-- Menu section end -->
	</section>
</main>


<!-- scripts -->
<script type="text/javascript">

	// var check_in_date = document.forms["searchFormList"]["check_in_date"];
	// var check_out_date = document.forms["searchFormList"]["check_out_date"];

	// var check_in_date_error = document.getElementById("check_in_date_error");
	// var check_out_date_error = document.getElementById("check_out_date_error");

	// function validateForm() {
	// 	if (check_in_date.value === ""){
	// 		check_in_date_error.textContent = "Please enter a Check-in Date."
	// 		check_in_date.focus();
	// 		return false;
	// 	}
	// 	if (check_out_date.value === ""){
	// 		check_out_date_error.textContent = "Please enter a Check-out Date."
	// 		check_out_date.focus();
	// 		return false;
	// 	}
	// }
</script>

<?php
require_once __DIR__ . '/../public/footer.php';
?>