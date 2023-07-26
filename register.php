<?php

session_start();

if( isset($_SESSION['user_id']) ){
	header("Location: /");
}

require 'database.php';

$message = '';

if(!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['dob'])
	&& !empty($_POST['address']) && !empty($_POST['mobile'])):
	
	// Enter the new user in the database
	$sql = "INSERT INTO users (email, password, name, surname, dob, address, mobile) VALUES (:email, :password, :name, :surname, :dob, :address, :mobile)";
	$stmt = $conn->prepare($sql);
	$enc = password_hash($_POST['password'], PASSWORD_BCRYPT);

	$stmt->bindParam(':email', $_POST['email']);
	$stmt->bindParam(':password', $enc);
	$stmt->bindParam(':name', $_POST['name']);
	$stmt->bindParam(':surname', $_POST['surname']);
	$stmt->bindParam(':dob', $_POST['dob']);
	$stmt->bindParam(':address', $_POST['address']);
	$stmt->bindParam(':mobile', $_POST['mobile']);

	if( $stmt->execute() ):
		$message = 'Successfully created new user';
	else:
		$message = 'Sorry there must have been an issue creating your account';
	endif;

endif;

if (!empty($message)) {
	$_SESSION['alert'] = $message;
	$_SESSION['alert_style'] = 'danger';
}
if ($message == "Successfully created new user") {
	$_SESSION['alert'] = "Redirecting to Login Page...";
	$_SESSION['alert_style'] = 'info';

	//Send email
	$to = $_POST['email'];
	$subject = "Welcome to Milic Rakije";

	$message = "
	<html>
	<head>
	<title>Welcome</title>
	</head>
	<body>
	<p>Thank you for registration with Milic Rakije!</p>
	<table>
	<tr>
	<th>Firstname</th>
	<th>Lastname</th>
	</tr>
	<tr>
	<td>".$_POST['name']."</td>
	<td>".$_POST['surname']."</td>
	</tr>
	</table>
	</body>
	</html>
	";

	// Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	// More headers
	$headers .= 'From: <admin@milic.com>' . "\r\n";
	$headers .= 'Cc: mateja.serbia@gmail.com' . "\r\n";

	//mail($to,$subject,$message,$headers);

	header("Refresh: 3; URL=login.php");
}

?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
	<title>Register</title>
	<meta charset="utf-8" />
	<!-- Required meta tag for Bootstrap -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery.shop.js"></script>
	<script type="text/javascript" src="js/color-modes.js"></script>
</head>
<body id="site">
<?php
		require 'themeToggle.php';
?>
<!-- Section: Design Block -->
<section class="text-center text-lg-start">
	<style>
		.cascading-right {
			margin-right: -50px;
		}

		@media (max-width: 991.98px) {
			.cascading-right {
				margin-right: 0;
			}
		}
	</style>
	<?php include('alert.php'); ?>
	<!-- Jumbotron -->
	<div class="container py-4">
		<div class="row g-0 align-items-center">
			<div class="col-lg-6 mb-5 mb-lg-0">
			<div class="card cascading-right" style="
				background: hsla(0, 0%, 100%, 0.55);
				backdrop-filter: blur(30px);
				">
				<div class="card-body p-5 shadow-5 text-center">
				<img class="mb-4" src="images/lLogo.png" alt="" width="300">
				<h1 class="h3 mb-5 fw-bold">Please sign up</h1>
				<!-- <h2 class="fw-bold mb-5">Register</h2> -->
				<form class="needs-validation" novalidate action="register.php" method="POST">
					<!-- 2 column grid layout with text inputs for the first and last names -->
					<div class="row">
					<div class="col-md-6 mb-4">
						<div class="form-floating">
							<input type="text" id="name" name="name" class="form-control" placeholder="Name" required/>
							<label for="name">First name</label>
							<div class="invalid-feedback">Please provide a name.</div>
							<div class="valid-feedback">Looks good!</div>
						</div>
					</div>
					<div class="col-md-6 mb-4">
						<div class="form-floating">
							<input type="text" id="surname" name="surname" class="form-control" placeholder="Surname" required/>
							<label class="form-label" for="surname">Last name</label>
							<div class="invalid-feedback">Please provide a surname.</div>
							<div class="valid-feedback">Looks good!</div>
						</div>
					</div>
					</div>

					<!-- Email input -->
					<div class="form-floating mb-4">
						<input type="email" id="email" name="email" class="form-control" placeholder="name@email.com" autocomplete="off" readonly 
			onfocus="this.removeAttribute('readonly');" required/>
						<label class="form-label" for="email">Email address</label>
						<div class="invalid-feedback">Please provide your e-mail address.</div>
						<div class="valid-feedback">Looks good!</div>
					</div>

					<!-- Password input -->
					<div class="form-floating mb-4">
						<input type="password" id="password" name="password" class="form-control" placeholder="**********" autocomplete="off" readonly 
		onfocus="this.removeAttribute('readonly');" required/>
						<label class="form-label" for="password">Password</label>
						<div class="invalid-feedback">Please provide your password.</div>
						<div class="valid-feedback">Looks good!</div>
					</div>

					<!-- Confirm Password input -->
					<div class="form-floating mb-4">
						<input type="password" id="password_confirm" name="password_confirm" class="form-control" placeholder="**********" required/>
						<label class="form-label" for="password_confirm">Confirm Password</label>
						<div class="invalid-feedback">Please confirm your password.</div>
						<div class="valid-feedback">Looks good!</div>
					</div>
				
					<!-- Address input -->
					<div class="form-floating mb-4">
						<input type="text" id="address" name="address" class="form-control" placeholder="Street No, Post Code City, Country" required/>
						<label class="form-label" for="address">Address</label>
						<div class="invalid-feedback">Please provide your address.</div>
						<div class="valid-feedback">Looks good!</div>
					</div>

					
					<div class="row">
					<!-- DOB input -->
					<div class="col-md-6 mb-4">
						<div class="form-floating">
							<input type="text" id="dob" name="dob" class="form-control" placeholder="YYYY-MM-DD" required/>
							<label class="form-label" for="dob">DOB (YYYY-MM-DD)</label>
							<div class="invalid-feedback">Please provide a date of birth.</div>
							<div class="valid-feedback">Looks good!</div>
						</div>
					</div>
					<!-- Mobile input -->
					<div class="col-md-6 mb-4">
						<div class="form-floating">
							<input type="text" id="mobile" name="mobile" class="form-control" placeholder="(0XX) XXX XXXX" required/>
							<label class="form-label" for="mobile">Mobile (0XX) XXX XXXX</label>
							<div class="invalid-feedback">Please provide a mobile number.</div>
							<div class="valid-feedback">Looks good!</div>
						</div>
					</div>
					</div>

					<!-- Submit button -->
					<button type="submit" class="btn btn-secondary btn-block mb-4">
					Register
					</button>
					
				</form>
				</div>
			</div>
			</div>

			<div class="col-lg-6 mb-5 mb-lg-0">
			<img src="https://mdbootstrap.com/img/new/ecommerce/vertical/004.jpg" class="w-100 rounded-4 shadow-4"
				alt="" />
			</div>
		</div>
	</div>
  <!-- Jumbotron -->
</section>
<!-- Section: Design Block -->
	
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
	<script src="https://kit.fontawesome.com/a6efd8a22c.js" crossorigin="anonymous"></script>
	<script>
		// Example starter JavaScript for disabling form submissions if there are invalid fields
		(function () {
		'use strict'

		// Fetch all the forms we want to apply custom Bootstrap validation styles to
		var forms = document.querySelectorAll('.needs-validation')

		// Loop over them and prevent submission
		Array.prototype.slice.call(forms)
			.forEach(function (form) {
			form.addEventListener('submit', function (event) {
				if (!form.checkValidity()) {
				event.preventDefault()
				event.stopPropagation()
				}

				form.classList.add('was-validated')
			}, false)
			})
		})()
	</script>
</body>
</html>
