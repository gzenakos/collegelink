<?php
require_once __DIR__ . '/../boot/boot.php';

use Hotel\User;

//Check for existing logged in user
$userId = User::getCurrentUserId();
if ( ! empty( $userId ) ) {
	$GLOBALS['loggedIn'] = true;
	//Get User name
	$user = new User();
	$userName = $user->getByUserId( $userId )['name'];
}


?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="student" content="CollegeLink">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Room search</title>
		<!-- to do create function to return room title -->
		<link rel="stylesheet" href="assets/css/global.css?ver=<?php echo gmdate( 'ymd-Gis' ); ?>">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
		<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css"/>

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/css/bootstrap-slider.css" integrity="sha512-SZgE3m1he0aEF3tIxxnz/3mXu/u/wlMNxQSnE0Cni9j/O8Gs+TjM9tm1NX34nRQ7GiLwUEzwuE3Wv2FLz2667w==" crossorigin="anonymous" />

		<?php
		switch ( basename( $_SERVER['PHP_SELF'] ) ) {
			case 'index.php':
				echo '<link rel="stylesheet" href="assets/css/index.css?ver=' . gmdate( 'ymd-Gis' ) . '">';
				break;
			case 'list.php':
				echo '<link rel="stylesheet" href="assets/css/list.css?ver=' . gmdate( 'ymd-Gis' ) . '">';
				break;
			case 'register.php':
				echo '<link rel="stylesheet" href="assets/css/register.css?ver=' . gmdate( 'ymd-Gis' ) . '">';
				break;
			case 'profile.php':
				echo '<link rel="stylesheet" href="assets/css/profile.css?ver=' . gmdate( 'ymd-Gis' ) . '">';
				break;
			case 'login.php':
				echo '<link rel="stylesheet" href="assets/css/login.css?ver=' . gmdate( 'ymd-Gis' ) . '">';
				break;
			case 'room.php':
				echo '<link rel="stylesheet" href="assets/css/room.css?ver=' . gmdate( 'ymd-Gis' ) . '">';
				echo '<link rel="stylesheet" href="assets/css/magnificpopup.css?ver=' . gmdate( 'ymd-Gis' ) . '">';
				break;
			default:
			//code block
		}

		// var_dump($_COOKIE['user_token']);die;
		?>

	</head>
	<body class="">
		<header class="main-header">
			<nav class="navbar navbar-expand-md navbar-light">
				<div class="container flex-column">
					<?php
					if ( $GLOBALS['loggedIn'] ) {
						?>
						<div class="d-md-flex justify-content-end w-100">
							<small><b>Hello <?php echo $userName; ?></b></small>
						</div>
						<?php
					}
					?>
					<div class="d-md-flex justify-content-md-between w-100">
						<div class="d-flex justify-content-between">
							<span class="navbar-brand" href="">Hotels</span>
							<button class="navbar-toggler" type="button" data-toggle="offcanvas" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
								<span class="navbar-toggler-icon"></span>
							</button>
						</div>
						<div>
							<div class="navbar-collapse offcanvas-collapse" id="navbarNav">
								<ul class="navbar-nav">
									<li class="nav-item">
										<a class="nav-link<?php if ( basename( $_SERVER['PHP_SELF'] ) === 'index.php' ) echo ' text-orange'; ?>" href="index.php"><i class="fas fa-home"></i> Home <span class="sr-only">(current)</span></a>
									</li>
									<?php
									if ( $GLOBALS['loggedIn'] ) {
										?>
										<li class="nav-item">
											<a class="nav-link<?php if ( basename( $_SERVER['PHP_SELF'] ) === 'profile.php' ) echo ' text-orange'; ?>" href="profile.php"><i class="fas fa-user"></i> Profile</a>
										</li>
										<li class="nav-item">
											<a class="nav-link<?php if ( basename( $_SERVER['PHP_SELF'] ) === 'actions/logout.php' ) echo ' text-orange'; ?>" href="actions/logout.php"><i class="fas fa-sign-out"></i> Logout</a>
										</li>
										<?php
									} else {
										?>
										<li class="nav-item">
											<a class="nav-link<?php if ( basename( $_SERVER['PHP_SELF'] ) === 'login.php' ) echo ' text-orange'; ?>" href="login.php"><i class="fas fa-sign-in"></i> Login</a>
										</li>
										<li class="nav-item">
											<a class="nav-link<?php if ( basename( $_SERVER['PHP_SELF'] ) === 'register.php' ) echo ' text-orange';?>" href="register.php"><i class="fas fa-sign-out"></i> Register</a>
										</li>
										<?php
									}
									?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</nav>
			<div class="container nav-seperator"></div>
		</header>

