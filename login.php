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
<html lang="en" data-bs-theme="dark">
<head>
	<title>Login</title>
	<meta charset="utf-8" />
	<!-- Required meta tag for Bootstrap -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
	<link rel="stylesheet" href="css/signin.css" type="text/css" />
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery.shop.js"></script>
	<script type="text/javascript" src="js/color-modes.js"></script>
	<style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
</head>
<body class="text-center">
	<?php
		require 'themeToggle.php';
	?>
	<main class="form-signin">
		<form action="login.php" method="POST">
			 <picture class="mb-4">
  				 <source srcset="images/lLogo.png" media="(prefers-color-scheme: light)"/>
				 <source srcset="images/lLogoWhite.png"  media="(prefers-color-scheme: dark) "/>
  				<img src="images/lLogoGold.png" alt="" width="300">
			</picture>
			<!--<img class="mb-4" src="images/lLogo.png"  width="300">-->
			<h1 class="h3 mb-3 fw-bold">Please sign in</h1>
			<!-- Email input -->
			<div class="form-floating">
				<input type="email" placeholder="Enter your email" id="email" name="email"  class="form-control" />
				<label class="form-label" for="email">Email address</label>
			</div>

			<!-- Password input -->
			<div class="form-floating">
				<input type="password" placeholder="and password" id="password" name="password" class="form-control" />
				<label class="form-label" for="password">Password</label>
			</div>

			<!-- 2 column grid layout for inline styling -->
			<div class="row mb-4">
				<div class="col d-flex justify-content-center">
				<!-- Checkbox -->
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="" id="remember" />
					<label class="form-check-label" for="remember"> Remember me </label>
				</div>
				</div>

				<div class="col">
				<!-- Simple link -->
				<a href="#!">Forgot password?</a>
				</div>
			</div>

			<!-- Submit button -->
			<button type="submmit" class="w-100 btn btn-lg btn-secondary">Sign in </button>

			<!-- Register buttons -->
			<div class="text-center">
				<p>Not a member? <a href="register.php">Register</a></p>
			</div>
		</form>
			
		<?php if(!empty($message)): ?>
				<p><?= $message ?></p>
		<?php endif; ?>
	</main>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/a6efd8a22c.js" crossorigin="anonymous"></script>
	
</body>
</html>
