<?php
require_once __DIR__ . '/../public/header.php';

require __DIR__ . '/../boot/boot.php';

use Hotel\Room;
use Hotel\Favorite;
use Hotel\User;
use Hotel\Review;
use Hotel\Booking;

//Initialize Room Service
$room     = new Room();
$favorite = new Favorite();

//Check for Room id
$roomId = $_REQUEST['room_id'];
if ( empty( $roomId ) ) {
	header( 'Location: index.php' );
	return;
}

$roomInfo = $room->get( $roomId );
if ( empty( $roomInfo ) ) {
	header( 'Location: index.php' );
	return;
}

//Get current user id
$userId = User::getCurrentUserId();

//check if room is favorite for current user
$isFavorite = $favorite->isFavorite( $roomId, $userId );

// Load all room reviews
$review = new Review();
$allReviews = $review->getReviewsByRoom( $roomId );

// print_r( $roomInfo );

//Check for booking room
$checkInDate   = $_REQUEST['check_in_date'];
$checkOutDate  = $_REQUEST['check_out_date'];
$alreadyBooked = empty( $checkInDate ) || empty( $checkOutDate );


if ( ! $alreadyBooked ) {
	//Look for bookings
	$booking       = new Booking();
	$alreadyBooked = $booking->isBooked( $roomId, $checkInDate, $checkOutDate );
}
?>

<main class="main-content">
	<div class="container">
		<div class="d-flex flex-wrap">
			<section class="flex-row w-100">
				<div class="title rounded bg-orange text-white py-2 px-3 m-0 h5">
					<?php echo sprintf( '%s - %s, %s', $roomInfo['name'], $roomInfo['city'], $roomInfo['area'] ); ?>
					<span class="title-reviews d-inline"></span>
					<span>| Reviews:</span>
					<span>
					<?php
					$roomAvgReview = $roomInfo['avg_reviews'];
					for ( $i=1; $i <= 5; $i++ ) {
						if ( $roomAvgReview >= $i ) {
							?>
							<span class="fas fa-star checked"></span>
							<?php
						} else {
							?>
							<span class="fas fa-star"></span>
							<?php
						}
					}
					?>
					 |
					</span>
					<span class="title-reviews" id="favorite">
						<form name="favoriteForm" method="post" id="favoriteForm" class="favoriteForm d-inline" action="">
							<input type="hidden" name="room_id" value="<?php echo $roomId; ?>">
							<input type="hidden" name="is_favorite" value="<?php echo $isFavorite ? '1' : '0'; ?>">
							<input type="hidden" name="csrf" value="<?php echo User::getCsrf(); ?>">
							<span class="search_stars_div">
								<button type="submit" class="fav_star">
									<span class="star<?php echo $isFavorite ? ' selected' : ''; ?>" id="fav">❤︎</span>
								</button>
							</span>
						</form>
					</span>
					<span class="float-right title-price">Per Night: <?php echo $roomInfo['price']; ?></span>
				</div>
			</section>
			<section class="photos flex-row w-100">
				<div class="py-4">
					<a class="image-popup-vertical-fit" href="/public/assets/images/rooms/<?php echo $roomInfo['photo_url']; ?>" title="<?php echo $roomInfo['name']; ?>">
						<img src="/public/assets/images/rooms/<?php echo $roomInfo['photo_url']; ?>" alt="<?php echo $roomInfo['name']; ?> Preview Image" class="mw-100">
					</a>
				</div>
			</section>
			<section class="flex-row w-100">
				<ul class="property-tags list-group list-group-horizontal-md rounded bg-orange text-white py-2 px-3 m-0 h5 text-md-center">
					<li class="list-group-item col position-relative">
						<div class="position-absolute">X</div>
						<div class="d-flex flex-wrap justify-content-md-center">
							<div class="w-100">
								<i class="fas fa-user"></i> <?php echo $roomInfo['count_of_guests']; ?>
							</div>
							<div class="w-100">Count of Guests</div>
						</div>
					</li>
					<li class="list-group-item col">
						<div class="d-flex flex-wrap justify-content-md-center">
							<div class="w-100">
								<i class="fas fa-bed"></i> <?php echo $roomInfo['type_id']; ?>
							</div>
							<div class="w-100">Type of Room</div>
						</div>
					</li>
					<li class="list-group-item col">
						<div class="d-flex flex-wrap justify-content-md-center">
							<div class="w-100">
								<i class="fas fa-warehouse"></i> <?php echo '1' === $roomInfo['parking'] ? 'Yes' : 'No'; ?>
							</div>
							<div class="w-100">Parking</div>
						</div>
					</li>
					<li class="list-group-item col">
						<div class="d-flex flex-wrap justify-content-md-center">
							<div class="w-100">
								<i class="fas fa-signal"></i> <?php echo '1' === $roomInfo['wifi'] ? 'Yes' : 'No'; ?>
							</div>
							<div class="w-100">Wifi</div>
						</div>
					</li>
					<li class="list-group-item col">
						<div class="d-flex flex-wrap justify-content-md-center">
							<div class="w-100">
								<i class="fas fa-paw"></i> <?php echo '1' === $roomInfo['pet_friendly'] ? 'Yes' : 'No'; ?>
							</div>
							<div class="w-100">Pet Friendly</div>
						</div>
					</li>
				</ul>
			</section>

		</div>
		<section>
			<div class="room-full-description my-4">
				<div class="ml-3">
					<h3>Room Description</h3>
					<div><?php echo $roomInfo['description_long']; ?></div>
				</div>

			</div>
			<br>
			<div class="text-right">
				<?php
				if ( $alreadyBooked ) {
					?>
					<span class="btn btn-sm btn-danger disabled rounded py-1 px-2">Already Booked</span>
					<?php
				} else {
					?>
					<form name="bookingForm" class="bookingForm" method="post" action="actions/book.php">
						<input type="hidden" name="room_id" value="<?php echo $roomId; ?>">
						<input type="hidden" name="check_in_date" value="<?php echo $checkInDate; ?>">
						<input type="hidden" name="check_out_date" value="<?php echo $checkOutDate; ?>">
						<input type="hidden" name="csrf" value="<?php echo User::getCsrf(); ?>">
						<button class="btn btn-sm btn-warning rounded py-1 px-2" type="submit">Book Now</button>
					</form>
					<?php
				}
				?>
			</div>
			<br>
			<hr class="dashed-2">
			<div id="map" data-lat="<?php echo $roomInfo['location_lat']; ?>" data-long="<?php echo $roomInfo['location_long']; ?>" class="googlemaps">
			</div>
		</section>
		<hr class="dashed-2">
		<div class="border-left-orange">
			<div class="ml-3">
				<h3>Reviews</h3>
				<br>
				<div id="room-reviews-container">
				<?php
					if (count( $allReviews ) > 0 ) {
						foreach ( $allReviews as $counter => $review ) {
						?>
						<div class="room-reviews">
							<h4>
								<span><?php echo  sprintf('%d. %s', $counter + 1 , $review['user_name'] ); ?></span>
								<div class="div-reviews">
								<?php
								for ( $i=1; $i <= 5; $i++ ) {
									if ( $review['rate'] >= $i ) {
										?>
										<span class="fas fa-star checked"></span>
										<?php
									} else {
										?>
										<span class="fas fa-star"></span>
										<?php
									}
								}
								?>
								</div>
							</h4>
							<h5>Created at <?php echo $review['created_time'] ?></h5>
							<p><?php echo htmlentities( $review['comment'] ); ?></p>
						</div>
						<?php
					}
				} else {
					?>
					<div class="room-reviews text-muted font-italic">
						<h4>No reviews yet</h4>
					</div>
					<?php
				}
				?>
				</div>
			</div>
		</div>
		<hr class="dashed-2">
		<div class="border-left-orange">
			<div class="ml-3">
				<h3>Add review</h3>
				<br>
				<form name="reviewForm" class="reviewForm" method="post" action="actions/review.php">
					<input type="hidden" name="room_id" value="<?php echo $roomId; ?>">
					<input type="hidden" name="csrf" value="<?php echo User::getCsrf(); ?>">
					<h4 class="mb-0">
					<fieldset class="rating">
						<input type="radio" id="star5" name="rate" value="5">
						<label for="star5" title="Awesome - 5 stars"><i class="fas fa-star"></i></label>
						<input type="radio" id="star4" name="rate" value="4">
						<label for="star4" title="Awesome - 4 stars"><i class="fas fa-star"></i></label>
						<input type="radio" id="star3" name="rate" value="3">
						<label for="star3" title="Awesome - 3 stars"><i class="fas fa-star"></i></label>
						<input type="radio" id="star2" name="rate" value="2">
						<label for="star2" title="Awesome - 2 stars"><i class="fas fa-star"></i></label>
						<input type="radio" id="star1" name="rate" value="1">
						<label for="star1" title="Awesome - 1 star"><i class="fas fa-star"></i></label>
					</fieldset>
					</h4>
					<div class="floating-label-form-group controls">
						<textarea name="comment" id="reviewField" class="form-control_loading review-textarea w-100" placeholder="Review" data-validation-required-message="Please enter a review."></textarea>
					</div>
					<div class="text-center">
						<button class="btn btn-sm btn-warning rounded py-1 px-2" type="submit">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</main>

<?php
require_once __DIR__ . '/../public/footer.php';
?>