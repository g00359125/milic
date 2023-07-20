<?php
    $page = "Contact";
?>
<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
	<title>About</title>
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
        require 'header.php';
    ?>

    <main>
        <div class="container">
            <h1 class="display-3">Contact us</h1>
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
                        <img class="mb-4" src="images/lLogo.png" alt="" width="300">
                        <form action="register.php" method="POST">
                        <!-- Name -->
                        <div class="form-floating mb-4">
                            <input type="text" id="name" name="name" class="form-control" placeholder="Name"/>
                            <label for="name">Name</label>
                        </div>

                        <!-- Email -->
                        <div class="form-floating mb-4">
                            <input type="email" id="email" name="email" class="form-control" placeholder="name@email.com" autocomplete="off" readonly 
            onfocus="this.removeAttribute('readonly');"/>
                            <label class="form-label" for="email">Email address</label>
                        </div>
                        
                        <!-- Message -->
                            <div class="form-floating mb-4">
                            <textarea class="form-control" id="message" type="text" placeholder="Message" style="height: 10rem;" data-sb-validations="required"></textarea>
                            <label class="form-label" for="Message">Message</label>
                            <div class="invalid-feedback" data-sb-feedback="message:required">Message is required.</div>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-secondary btn-block mb-4">
                            Submit
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
        </div>
    </main>

    <?php
        require 'footer.php';
    ?>
    <!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
	<script src="https://kit.fontawesome.com/a6efd8a22c.js" crossorigin="anonymous"></script>
</body>
</html>	