<?php
require __DIR__ . '/../boot/boot.php';
$GLOBALS['loggedIn'];
use Hotel\User;

require_once __DIR__ . '/../public/header.php';

//Check for existing logged in user
if ( $GLOBALS['loggedIn'] ) { // DEFINED IN HEADER
	// Return to home page
	Header( 'Location: /public/index.php' );
	return;
}

?>
<main class="main-content">
	<div class="container">
		<div class="row justify-content-center">
			<div class="text-center pt-5 mt-5">
				<form method="post" action="actions/login.php">
					<?php
					if ( ! empty( $_GET['error'] ) ) {
						?>
						<div class="alert alert-danger alert-styled-left">Login Error: <?php echo $_GET['error']; ?></div>
						<?php
					}
					?>
					<div class="row">
						<div class="form-group">
							<label for="email">Your E-mail Address</label>
							<input id="email" class="form-control" type="email" name="email" placeholder="Your E-mail Address">
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<label for="password">Your password</label>
							<input id="password" class="form-control" type="password" name="password" placeholder="Your password">
						</div>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-warning">Login</button>
					</div>
				</form>

			</div>
		</div>
	</div>
</main>
<?php
require_once __DIR__ . '/../public/footer.php';
?>