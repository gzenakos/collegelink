<?php
require_once __DIR__ . '/../public/header.php';

use Hotel\Room;
use Hotel\RoomType;
// use Hotel\CountOfGuests;
//Get cities
$room   = new Room();
$cities = $room->getCities();

//Get all room types
$type     = new RoomType();
$allTypes = $type->getAllTypes();
//  print_r($allTypes); die;

?>

<main class="main-content view_hotel page-home d-flex justify-content-center">
	<div class="container">
		<!-- Form section start -->
		<form class="searchFormHome px-5 py-5 bg-white rounded" method="get" action="list.php" onsubmit="">
			<div class="form-row">
				<div class="col-sm col-md-6">
					<div class="form-group">
						<label for="CitiesSelect" class="sr-only">City</label>
						<select name="city" class="form-control form-control-lg" id="CitiesSelect" required>
							<option disabled selected="true">City</option>
							<?php
							foreach ( $cities as $city ) {
								?>
								<option value="<?php echo $city; ?>"><?php echo $city; ?></option>
								<?php
							}
							?>
						</select>
					</div>
				</div>
				<div class="col-sm col-md-6">
					<div class="form-group">
						<label for="RoomTypeSelect" class="sr-only">Room Type</label>
						<select name="room_type" class="form-control form-control-lg" id="RoomTypeSelect" required>
							<option disabled selected="true">Room Type</option>
							<?php
							foreach ( $allTypes as $type ) {
								?>
								<option value="<?php echo $type['type_id']; ?>"><?php echo $type['title']; ?></option>
								<?php
							}
							?>
						</select>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm col-md-6">
					<div class="form-group">
						<input name="check_in_date" class="form-control form-control-lg" type="text" id="check-in-date" placeholder="Check-in Date" required />
					</div>
				</div>
				<div class="col-sm col-md-6">
					<div class="form-group">
						<input name="check_out_date" class="form-control form-control-lg" type="text" id="check-out-date" placeholder="Check-out Date" required />
					</div>
				</div>
			</div>
			<div class="form-row d-flex justify-content-center">
				<button type="submit" class="btn btn-warning ">Search</button>
			</div>
		</form>
		<!-- <form method="POST" action="index.php">
			<fieldset class="introduction" id="form-introduction">
				<div class="form-group">
					<label for="firstName"><span style="color: red;">*</span>First Name:</label>
					<input id="firstName" value="John" placeholder="ex. John" type="text" data-name data-chart data-mywebsite-name>
				</div>
				<div class="form-group">
					<label for="lastName"><span style="color: red;">*</span>Last Name:</label>
					<input id="lastName" value="" placeholder="ex. Doe" type="text">
				</div>
			</fieldset>
			<div class="form-group email">
				<label for="emailAddress"><span style="color: red;">*</span>E-mail:</label>
				<input id="emailAddress" value="" placeholder="ex. example@example.com" type="email">
			</div>
			<div class="form-group password">
				<label for="formPassword"><span style="color: red;">*</span>Password:</label>
				<input name="formPassword" id="formPassword" value="" type="password">
			</div>
			<div class="form-group comments">
				<label for="formComments"><span style="color: red;">*</span>Comments:</label>
				<textarea id="formComments" name="formComments" placeholder="Your comments here"></textarea>
			</div>
			<div class="form-group gender">
				<label for="formGender">Gender:</label>
				<select id="formGender">
					<option value="null" selected>Choose your gender</option>
					<option value="male">Male</option>
					<option value="female">Female</option>
				</select>
			</div>
			<fieldset class="form-group">
				<label for="formNewsletter">Sign up to our newsletter:</label>
				<input id="newsletter_yes" name="formNewsletter" type="radio">
				<input id="newsletter_no" name="formNewsletter" type="radio">
			</fieldset>
			<div class="form-group">
				<label for="agreeTerms">I have understood and agree with the Terms of Service:</label>
				<input id="agreeTerms" name="agreeTerms" type="checkbox">
			</div>
			<div class="action text-center">
				<input name="submit" id="submitButton" type="button" value="Submit">
			</div>
		</form> -->
	</div>
</main>

<?php
require_once __DIR__ . '/../public/footer.php';
?>
