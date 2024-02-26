<?php
require_once __DIR__ . '/../public/header.php';
?>
<main class="main-content">
	<div class="container">
		<div class="row justify-content-center">
			<div class="text-center pt-5 mt-5">
				<form method="post" action="actions/register.php">
					<?php
					if ( ! empty( $_GET['error'] ) ) {
						?>
						<div class="alert alert-danger alert-styled-left">Register Error: <?php echo $_GET['error']; ?></div>
						<?php
					}
					?>
					<div class="row">
						<div class="form-group">
							<label for="name">Your Name</label>
							<input id="name" class="form-control" type="text" name="name" placeholder="Your Name">
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<label for="email">Your E-mail Address</label>
							<input id="email" class="form-control" type="email" name="email" placeholder="Your E-mail Address">
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<label for="email_repeat">Verify your address</label>
							<input id="email_repeat" class="form-control" type="email" name="email_repeat" placeholder="Verify your address">
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<label for="password">Your password</label>
							<input id="password" class="form-control" type="password" name="password" placeholder="Your password">
						</div>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-warning">Register</button>
					</div>
				</form>
				<!-- <form method="POST" action="index.php">
					<fieldset class="introduction" id="formSearch">
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
					<div class="action">
						<input name="submit" id="submitButton" type="button" value="Submit">
					</div>
				</form> -->
			</div>
		</div>
	</div>
</main>
<?php
require_once __DIR__ . '/../public/footer.php';
?>