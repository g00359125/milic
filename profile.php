<?php
    $page="Profile";
?>
<!doctype html>
<html lang="en" data-bs-theme="dark" class="h-100">
<head>
	<title>Profile</title>
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
<body id="site" class="d-flex flex-column h-100">
    
    <?php require 'header.php'; ?>
    
    <main class="flex-shrink-0">
        <div class="container">
            <?php
                if( isset($_SESSION['user_id']) ){
            ?>
            <h1 class="display-3">Profile</h1>
        </div>
        <div class="container mb-4">

            <?php include('alert.php'); ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <!-- <div class="card-header">
                                <a href="customer-create.php" class="btn btn-primary float-end">Add Customer</a>
                        </div> -->
                        <div class="card-body">
                        <?php 
                            $query = "SELECT `id`, `email`, `name`, `surname`, `dob`, `address`, `mobile`, `password` 
                                FROM `users` WHERE `id` = ".$_SESSION['user_id'].";";
                            
                            $counter = 0;
                            
                            $stmt = $conn->query($query);
                            $row = $stmt->fetch();
                        ?>
                            <form action="profile.php" method="POST">
                                <!-- 2 column grid layout with text inputs for the first and last names -->
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                    <div class="form-floating">
                                        <input type="text" id="name" name="name" class="form-control" placeholder="Name" value="<?= $row['name'] ?>" />
                                        <label for="name">First name</label>
                                    </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                    <div class="form-floating">
                                        <input type="text" id="surname" name="surname" class="form-control" placeholder="Surname" value="<?= $row['surname'] ?>"/>
                                        <label class="form-label" for="surname">Last name</label>
                                    </div>
                                    </div>
                                </div>

                                <!-- Email input -->
                                <div class="form-floating mb-4">
                                    <input type="email" id="email" name="email" class="form-control" placeholder="name@email.com" autocomplete="off" readonly 
                    onfocus="this.removeAttribute('readonly');" value="<?= $row['email'] ?>" />
                                    <label class="form-label" for="email">Email address</label>
                                </div>

                                <!-- Password input -->
                                <div class="form-floating mb-4">
                                    <input type="password" id="password" name="password" class="form-control" placeholder="**********" autocomplete="off" readonly 
                    onfocus="this.removeAttribute('readonly');" value="<?= $row['password'] ?>" />
                                    <label class="form-label" for="password">Password</label>
                                </div>

                                <!-- Confirm Password input -->
                                <div class="form-floating mb-4">
                                    <input type="password" id="password_confirm" name="password_confirm" class="form-control" placeholder="**********" value="<?= $row['password'] ?>"/>
                                    <label class="form-label" for="password_confirm">Confirm Password</label>
                                </div>
                                
                                <!-- Address input -->
                                    <div class="form-floating mb-4">
                                    <input type="text" id="address" name="address" class="form-control" placeholder="Street No, Post Code City, Country" value="<?= $row['address'] ?>"/>
                                    <label class="form-label" for="address">Address</label>
                                </div>

                                
                                <div class="row">
                                    <!-- DOB input -->
                                    <div class="col-md-6 mb-4">
                                    <div class="form-floating">
                                        <input type="text" id="dob" name="dob" class="form-control" placeholder="YYYY-MM-DD" value="<?= $row['dob'] ?>"/>
                                        <label class="form-label" for="dob">DOB (YYYY-MM-DD)</label>
                                    </div>
                                    </div>
                                    <!-- Mobile input -->
                                    <div class="col-md-6 mb-4">
                                    <div class="form-floating">
                                        <input type="text" id="mobile" name="mobile" class="form-control" placeholder="(0XX) XXX XXXX" value="<?= $row['mobile'] ?>"/>
                                        <label class="form-label" for="mobile">Mobile (0XX) XXX XXXX</label>
                                    </div>
                                    </div>
                                </div>

                                <!-- Submit button -->
                                <button type="submit" class="btn btn-secondary btn-block mb-4">
                                    Update
                                </button>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                } else {
                    echo '<h1 class="display-3">No Access</h1>';
                }
            ?>
        </div>    
    </main>

    <?php require 'footer.php'; ?>
    <!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
	<script src="https://kit.fontawesome.com/a6efd8a22c.js" crossorigin="anonymous"></script>
</body>
</html>	