<?php
require __DIR__ . '/../boot/boot.php';

use Hotel\Favorite;
use Hotel\User;
use Hotel\Review;
use Hotel\Booking;

//Check for existing logged in user
$userId =  User::getCurrentUserId();
if ( empty( $userId  ) ) {
	// Return to home page

	Header( 'Location: /public/index.php' );
	die;
}

require_once __DIR__ . '/../public/header.php';

//Get all Favorites
$favorite      = new Favorite();
$userFavorites = $favorite->getListByUser( $userId );

//Get all Reviews
$review      = new Review();
$userReviews = $review->getListByUser( $userId );

//Get all bookings
$booking      = new Booking();
$userBookings = $booking->getListByUser( $userId );


?>
<main class="main-content">
	<div class="container">
		<div class="row">
			<aside class="col-md-3 hotel-search fancySidebar">
				<h4 class="uppercase motive section-top text-orange"><strong>Favorites</strong></h4>
				<?php
				if ( count( $userFavorites ) > 0 ) {
					?>
					<ol>
						<?php
						foreach ( $userFavorites as $favorite ) {
							?>
							<h3>
								<li>
									<h3>
										<a href="room.php?room_id=<?php echo $favorite['room_id']; ?>"><?php echo $favorite['name']; ?></a>
									</h3>
								</li>
							</h3>
							<?php
						}
						?>
					</ol>
					<?php
				} else {
					?>
					<h4 class="alert-profile">You don't have any favorite Hotel !!!</h4>
					<?php
				}
				?>
				<h4 class="uppercase motive section-top text-orange"><strong>Reviews</strong></h4>
				<?php
				if ( count( $userReviews ) > 0 ) {
					?>
					<ol>
						<?php
						foreach ( $userReviews as $review ) {
							?>
							<h2>
								<li>
									<h3>
										<a href="room.php?room_id=<?php echo $review['room_id']; ?>"><?php echo $review['name']; ?></a>
										<br>
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
									</h3>
								</li>
							</h2>
							<?php
						}
						?>
					</ol>
					<?php
				} else {
					?>
					<h4 class="alert-profile">You haven't made any review yet !!!</h4>
					<?php
				}
				?>
			</aside>
			<div class="col-md-1"></div>
			<div id="search-results-container" class="col-md-8">
				<section class="hotel-list box w-100 p-0 mt-5 m-md-0">
					<header class="page-title rounded bg-orange">
						<h2 class="py-2 px-3 m-0 h5 text-white">My bookings</h2>
					</header>
				</section>
				<section>
				<?php
				if ( count( $userBookings ) > 0 ) {
					?>
					<section>
						<?php
						foreach ( $userBookings as $booking ) {
							?>
							<article class="hotel media container w-100 py-3 py-md-5 d-flex flex-wrap px-0">
								<aside class="media col-md-2 px-0 pr-md-2">
									<div class="image">
										<img class="w-100" src="/public/assets/images/rooms/<?php echo $booking['photo_url']; ?>" alt="<?php echo $booking['name']; ?> thumbnail image" height="auto">
									</div>
								</aside>
								<main class="info col-md-10 border-left-orange mt-2 mt-md-0 pr-0">
									<h1 class="h4 mb-0"><?php echo $booking['name']; ?></h1>
									<h2 class="h5"><small><?php echo sprintf( '%s, %s', $booking['city'], $booking['area'] ); ?></small></h2>
									<p><?php echo $booking['description_short']; ?></p>
									<div class="text-right text-white">
										<a class="btn rounded py-1 px-2 btn-warning" href="room.php?room_id=<?php echo $booking['room_id']; ?>&check_in_date=<?php echo $selectedCheckInDate; ?>&check_out_date=<?php echo $selectedCheckOutDate; ?>">Go to room page</a>
									</div>
								</main>
								<footer class="col-12 d-flex flex-wrap pl-0 pr-0 mt-4">
									<div class="col-md-2 price-per-night px-1 py-2 text-white text-center">
										<small class="m-0">Total Cost: <?php echo $booking['total_price']; ?> €</small>
									</div>
									<div class="col-md-10 px-0 pl-md-2">
										<div class="d-flex flex-wrap rounded count-and-type">
											<div class="col-sm-6 count-of-guests px-1 py-2 text-center">
											<small><span data-toggle="tooltip" data-placement="left">Check-in Date: <?php echo date('d-m-Y', strtotime( $booking['check_in_date'] ) ); ?></span></small>
											</div>
											<div class="col-sm-6 type-of-room px-1 py-2 text-center">
											<small><span data-toggle="tooltip" data-placement="left">Check-out Date: <?php echo date('d-m-Y', strtotime( $booking['check_out_date'] ) ); ?></span></small>
											</div>
										</div>

									</div>
								</footer>
								<div class="clear"></div>
							</article>

							<?php
						}
						?>
					</section>
					<?php
				} else {
					?>
					<h4 class="alert-profile">You don't have any booking !!!</h4>
					<hr>
					<?php
				}
				?>
				</section>
			</div>
		</div>
	</div>
</main>

<?php
require_once __DIR__ . '/../public/footer.php';
?>