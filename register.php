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
	echo "<p>" . $message . "</p>";
}
if ($message == "Successfully created new user") {
	echo "<p>Redirecting to Login Page...</p>";
	header("Refresh: 3; URL=login.php");
}

?>

<!DOCTYPE html>
<html>

<head>
	<title>Register Below</title>
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

  <!-- Jumbotron -->
  <div class="container py-4">
    <div class="row g-0 align-items-center">
      <div class="col-lg-6 mb-5 mb-lg-0">
        <div class="card cascading-right" style="
            background: hsla(0, 0%, 100%, 0.55);
            backdrop-filter: blur(30px);
            ">
          <div class="card-body p-5 shadow-5 text-center">
            <h2 class="fw-bold mb-5">Register</h2>
            <form action="register.php" method="POST">
              <!-- 2 column grid layout with text inputs for the first and last names -->
              <div class="row">
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <input type="text" id="name" name="name" class="form-control" />
                    <label class="form-label" for="name">First name</label>
                  </div>
                </div>
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <input type="text" id="surname" name="surname" class="form-control" />
                    <label class="form-label" for="surname">Last name</label>
                  </div>
                </div>
              </div>

              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="email" id="email" name="email" class="form-control" />
                <label class="form-label" for="email">Email address</label>
              </div>

              <!-- Password input -->
              <div class="form-outline mb-4">
                <input type="password" id="password" name="password" class="form-control" />
                <label class="form-label" for="password">Password</label>
              </div>

			  <!-- Confirm Password input -->
			  <div class="form-outline mb-4">
                <input type="password" id="password_confirm" name="password_confirm" class="form-control" />
                <label class="form-label" for="password_confirm">Confirm Password</label>
              </div>
			
			  <!-- Address input -->
			    <div class="form-outline mb-4">
                <input type="text" id="address" name="address" class="form-control" />
                <label class="form-label" for="address">Address</label>
              </div>

			  
			  <div class="row">
				<!-- DOB input -->
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <input type="text" id="dob" name="dob" class="form-control" />
                    <label class="form-label" for="dob">DOB (YYYY-MM-DD)</label>
                  </div>
                </div>
				<!-- Mobile input -->
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <input type="text" id="mobile" name="mobile" class="form-control" />
                    <label class="form-label" for="mobile">Mobile</label>
                  </div>
                </div>
              </div>

              <!-- Submit button -->
              <button type="submit" class="btn btn-primary btn-block mb-4">
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
</body>
</html>
