<?php
    $page="Profile";
    session_start();
	require 'database.php';

    $message = '';

    if( empty($_POST['password']) || empty($_POST['password_confirm']) || 
        (!empty($_POST['password']) && !empty($_POST['password_confirm'] && $_POST['password'] != $_POST['password_confirm']))) {
        $message = 'Passwords did not match!';
	    $_SESSION['alert_style'] = 'info';
    } else if(!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_confirm']) && !empty($_POST['dob'])
        && !empty($_POST['address']) && !empty($_POST['mobile'])){
        
        // Enter the new user in the database
        $sql = "UPDATE `users` SET `email`=:email,`password`=:password,`name`=:name,`surname`=:surname,`dob`=:dob,`address`=:address,`mobile`=:mobile WHERE `id`=:id";
        $stmt = $conn->prepare($sql);
        $enc = password_hash($_POST['password'], PASSWORD_BCRYPT);
        
        $stmt->bindParam(':id', $_SESSION['user_id']);
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindParam(':password', $enc);
        $stmt->bindParam(':name', $_POST['name']);
        $stmt->bindParam(':surname', $_POST['surname']);
        $stmt->bindParam(':dob', $_POST['dob']);
        $stmt->bindParam(':address', $_POST['address']);
        $stmt->bindParam(':mobile', $_POST['mobile']);

        if( $stmt->execute() ){
            $message = 'Successfully updated your profile';
	        $_SESSION['alert_style'] = 'info';
        } else {
            $message = 'Sorry there must have been an issue updating your profile';
	        $_SESSION['alert_style'] = 'danger';
        };
        
    };
    if ($message != ''){
        $_SESSION['alert'] = $message;
    }
?>
<!doctype html>
<html lang="en" data-bs-theme="dark" class="h-100">
<head>
	<title>Profile</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery.shop.js"></script>
    <script type="text/javascript" src="js/color-modes.js"></script>
</head>
<body id="site" class="d-flex flex-column h-100">
    
    <?php require 'header.php'; ?>
    
    <main class="flex-shrink-0">
        <div class="container">
            <?php
                if( !isset($_SESSION['user_id']) ){
                    echo '<h1 class="display-3">Forbidden Access. Please login.</h1>';
                } else {
            ?>
            <h1 class="display-3">Profile</h1>
        </div>
        <div class="container mb-4">

            

            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <?php include('alert.php'); ?>
                    <div class="card">
                        <div class="card-body">
                        <?php 
                            $query = "SELECT * FROM `users` WHERE `id` = ".$_SESSION['user_id'].";";
                            
                            $counter = 0;
                            
                            $stmt = $conn->query($query);
                            $row = $stmt->fetch();
                        ?>
                            <form class="needs-validation" novalidate action="profile.php" method="POST">
                                <!-- 2 column grid layout with text inputs for the first and last names -->
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-floating">
                                            <input type="text" id="name" name="name" class="form-control" placeholder="Name" value="<?= $row['name'] ?>" required />
                                            <label for="name">First name</label>
                                            <div class="invalid-feedback">Please provide a name.</div>
							                <div class="valid-feedback">Looks good!</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-floating">
                                            <input type="text" id="surname" name="surname" class="form-control" placeholder="Surname" value="<?= $row['surname'] ?>" required/>
                                            <label class="form-label" for="surname">Last name</label>
                                            <div class="invalid-feedback">Please provide a surname.</div>
							                <div class="valid-feedback">Looks good!</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Email input -->
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <div class="form-floating mb-4">
                                            <input type="email" id="email" name="email" class="form-control" placeholder="name@email.com" autocomplete="off" readonly 
                                                onfocus="this.removeAttribute('readonly');" value="<?= $row['email'] ?>" required />
                                            <label class="form-label" for="email">Email address</label>
                                            <div class="invalid-feedback">Please provide your e-mail address.</div>
						                    <div class="valid-feedback">Looks good!</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Password input -->
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <div class="form-floating mb-4">
                                            <input type="password" id="password" name="password" class="form-control" placeholder="**********" autocomplete="off" readonly 
                                                onfocus="this.removeAttribute('readonly');" value="" required />
                                            <label class="form-label" for="password">Password</label>
                                            <div class="invalid-feedback">Please provide your password.</div>
						                    <div class="valid-feedback">Looks good!</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Confirm Password input -->
                                <div class="row">
                                    <div class="col-md-12 mb-4"> 
                                        <div class="form-floating mb-4">
                                            <input type="password" id="password_confirm" name="password_confirm" class="form-control" placeholder="**********" autocomplete="off" readonly 
                                                onfocus="this.removeAttribute('readonly');" value="" required />
                                            <label class="form-label" for="password_confirm">Confirm Password</label>
                                            <div class="invalid-feedback">Please confirm your password.</div>
						                    <div class="valid-feedback">Looks good!</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Address input -->
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <div class="form-floating mb-4">
                                            <input type="text" id="address" name="address" class="form-control" placeholder="Street No, Post Code City, Country" value="<?= $row['address'] ?>" required />
                                            <label class="form-label" for="address">Address</label>
                                            <div class="invalid-feedback">Please provide your address.</div>
						                    <div class="valid-feedback">Looks good!</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <!-- DOB input -->
                                    <div class="col-md-6 mb-4">
                                        <div class="form-floating">
                                            <input type="text" id="dob" name="dob" class="form-control" placeholder="YYYY-MM-DD" value="<?= $row['dob'] ?>" required />
                                            <label class="form-label" for="dob">DOB (YYYY-MM-DD)</label>
                                            <div class="invalid-feedback">Please provide a date of birth.</div>
							                <div class="valid-feedback">Looks good!</div>
                                        </div>
                                    </div>
                                    <!-- Mobile input -->
                                    <div class="col-md-6 mb-4">
                                        <div class="form-floating">
                                            <input type="text" id="mobile" name="mobile" class="form-control" placeholder="(0XX) XXX XXXX" value="<?= $row['mobile'] ?>" required />
                                            <label class="form-label" for="mobile">Mobile (0XX) XXX XXXX</label>
                                            <div class="invalid-feedback">Please provide a mobile number.</div>
							                <div class="valid-feedback">Looks good!</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="text-center">
                                    <!-- Submit button -->
                                    <button type="submit" class="btn btn-secondary btn-block mb-4">
                                        Update
                                    </button>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>    
    </main>

    <?php require 'footer.php'; ?>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
	<script src="https://kit.fontawesome.com/a6efd8a22c.js" crossorigin="anonymous"></script>
    <script>
        // Disabling form submissions if there are invalid fields
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