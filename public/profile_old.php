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
			<div class="col col-md-4 sidebar-top-small">
				<div class="sidebar">
					<h4 class="uppercase motive section-top"><strong>Favorites</strong></h4>
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
					<h4 class="uppercase motive section-top"><strong>Reviews</strong></h4>
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
				</div>
			</div>
			<div class="col-md-8">
				<section>
					<div class="title">
						My bookings
					</div>
				</section>
				<section>
				<?php
				if ( count( $userBookings ) > 0 ) {
					?>
					<section>
						<?php
						foreach ( $userBookings as $booking ) {
							?>
							<div class="thumbnail clean list-style">
								<div class=listng-image>
									<div class="media">
										<div class="pull-left">
											<div class="image">
												<div class="image-content">
													<div class="inner">
														<img src="/public/assets/images/rooms/<?php echo $booking['photo_url']; ?>" alt="<?php echo $booking['name']; ?> thumbnail image">
													</div>
												</div>
											</div>
											<div class="image-links">
												<div class="left">
													<a class="inner" href="/public/assets/images/rooms/<?php echo $booking['photo_url']; ?>" data-lightbox="rlated-9">
														<i class="fa fa-camera"></i>
													</a>
												</div>
											</div>
										</div>
										<div class="media-body">
											<div class="caption">
												<h4 class="uppercase"><?php echo $booking['photo_url']; ?></h4>
												<small><?php echo sprintf( '%s, %s', $booking['city'], $booking['area'] ); ?></small>
												<p><?php echo $booking['description_short']; ?></p>
												<div class="links">
													<a href="room.php?room_id=<?php echo $booking['room_id']; ?>" class="btn button-profile_page">Go to Room Page</a>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="property-info">
									<div class="tabe">
										<div class="table-cell">
											<div class="price-tag pull-left">
												Total Cost: <?php echo $booking['total_price']; ?> €
											</div>
										</div>
										<div class="table-cell">
											<ul class="price-tags">
												<li class="property-tags">
													<span data-toggle="tooltip" data-placement="left">Check-in Date: <?php echo date('d-m-Y', strtotime( $booking['check_in_date'] ) ); ?></span>
												</li>
												<li class="property-tags">
													<span data-toggle="tooltip" data-placement="left">Check-out Date: <?php echo date('d-m-Y', strtotime( $booking['check_out_date'] ) ); ?></span>
												</li>
											</ul>
										</div>
									</div>

								</div>
							</div>
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
<a href="#" id="toTop"><i class="fas fa-angle-up"></i></a>
<?php
require_once __DIR__ . '/../public/footer.php';
?>