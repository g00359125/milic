<?php

session_start();

if( isset($_SESSION['user_id']) ){
	header('Location: index.php');
}

require 'database.php';

if(!empty($_POST['email']) && !empty($_POST['password'])):
	
	$records = $conn->prepare('SELECT id,email,password,name,surname,dob,address,mobile FROM users WHERE email = :email');
	$records->bindParam(':email', $_POST['email']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	$message = '';

if ($results === false || count($results) == 0 || !password_verify($_POST['password'], $results['password'])) {
        $message = 'Sorry, those credentials do not match';
    } else {
        $_SESSION['user_id'] = $results['id'];
        header('Location: ./index.php');
    }

endif;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta charset="utf-8" />
	<!-- Required meta tag for Bootstrap -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery.shop.js"></script>
</head>
<body>
	<main>

	<?php
			require 'menu.php';
	?>

		<section>
			<div class="container-fluid h-custom">
				<div class="row d-flex justify-content-center align-items-center h-100">
					<div class="col-md-9 col-lg-6 col-xl-5">
						<form action="login.php" method="POST">
						<!-- Email input -->
						<div class="form-outline mb-4">
							<input type="email" placeholder="Enter your email" id="email" name="email"  class="form-control" />
							<label class="form-label" for="email">Email address</label>
						</div>

						<!-- Password input -->
						<div class="form-outline mb-4">
							<input type="password" placeholder="and password" id="password" name="password" class="form-control" />
							<label class="form-label" for="password">Password</label>
						</div>

						<!-- 2 column grid layout for inline styling -->
						<div class="row mb-4">
							<div class="col d-flex justify-content-center">
							<!-- Checkbox -->
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="" id="remember" checked />
								<label class="form-check-label" for="remember"> Remember me </label>
							</div>
							</div>

							<div class="col">
							<!-- Simple link -->
							<a href="#!">Forgot password?</a>
							</div>
						</div>

						<!-- Submit button -->
						<button type="submmit" class="btn btn-primary btn-block mb-4">Sign in </button>

						<!-- Register buttons -->
						<div class="text-center">
							<p>Not a member? <a href="register.php">Register</a></p>
							<p>or sign up with:</p>
							<button type="button" class="btn btn-link btn-floating mx-1">
							<i class="fab fa-facebook-f"></i>
							</button>

							<button type="button" class="btn btn-link btn-floating mx-1">
							<i class="fab fa-google"></i>
							</button>

							<button type="button" class="btn btn-link btn-floating mx-1">
							<i class="fab fa-twitter"></i>
							</button>

							<button type="button" class="btn btn-link btn-floating mx-1">
							<i class="fab fa-github"></i>
							</button>
						</div>
						</form>
					</div>
				</div>
			</div>
			
		<?php if(!empty($message)): ?>
				<p><?= $message ?></p>
		<?php endif; ?>
		</section>
	</main>
	<footer class="text-muted py-5">
		<div class="container">
		<p class="float-end mb-1">
      		<a href="#">Back to top</a>
    	</p>
    	<p class="mb-1">Album example is © Bootstrap, but please download and customize it for yourself!</p>
    	<p class="mb-0">New to Bootstrap? <a href="/">Visit the homepage</a> or read our <a href="/docs/5.0/getting-started/introduction/">getting started guide</a>.</p>
  		</div>
	</footer>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/a6efd8a22c.js" crossorigin="anonymous"></script>
	
</body>
</html>
