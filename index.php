<?php
	$page = 'Home';
	session_start();
	require 'database.php';
?>

<!doctype html>
<html lang="en" data-bs-theme="dark" class="h-100">
<head>
	<title>Milic Rakija</title>
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
	<?php
		require 'header.php';
	?>

	<!-- Main -->
	<main class="flex-shrink-0">
		<div class="container mb-3">
			<div class="px-4 py-1 my-1 text-center">
				<img class="d-block mx-auto mb-4 w-100" src="images/lLogoGold.png" alt="">
				<h1 class="display-5 fw-bold text-body-emphasis">Milic Rakija <br/> <span class="tagline">Finest rakija this side of the Danube!</h1>
				<div class="col-lg-6 mx-auto">
					<p class="lead mb-4">We stand by our claim. Try for yourself and see!</p>
					<div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
						<a href="shop.php" class="btn btn-outline-secondary btn-lg px-4">Order Now!</a>
					</div>
				</div>
			</div>

			<h1 class="display-4"></h1>
			<!-- START THE FEATURETTES -->
			<div class="list-group">
			<hr class="featurette-divider">

			<div id="featurette-1" class="row featurette text-whitesmoke parallax rounded-3 justify-content-between" style="border: 2px solid black;">
				<div class="col-md-7">
					<div class="container card mt-3" style = "background: hsla(0, 0%, 100%, 0.55);backdrop-filter: blur(10px)">
						<h3 class="featurette-heading ">Try our best-seller Kajsija!<span class="text-muted"></span></h3>
						<h3 class="featurette-heading ">Made from our locally grown apricots.</h3>
						<p class="lead">The perfect gift for a loved one.</p>
					</div>
				</div>
				<div class="col-md-3 mt-3">
					<img src="images/kajsija.jpg" width="300" class="rounded-3 card" style ="background: hsla(0, 0%, 100%, 0.55);backdrop-filter: blur(10px);">
				</div>
			</div>

			<hr class="featurette-divider">

			<div id="featurette-2" class="row featurette text-whitesmoke parallax2 rounded-3">
				<div class="col-md-7 order-md-2">
					<div class="container card mt-3" style = "background: hsla(0, 0%, 100%, 0.55);backdrop-filter: blur(10px)">
						<h2 class=" featurette-heading"> Our Location<span class="text-muted"></span></h2>
						<p class="lead">We are situated in a small town in Serbia called 'Vrsac'. Come visit us and soak in the beautiful scenery around our town.</p>
					</div>
				</div>
				<div class="col-md-5 order-md-1 mt-3">
					<img src="images/orah.jpg" width="300" class="rounded-3">
				</div>
			</div>

			<hr class="featurette-divider">

			<div id="featurette-3" class="row featurette text-whitesmoke parallax3 rounded-3 justify-content-between">
				<div class="col-md-7">
					<div class="container card mt-3" style = "background: hsla(0, 0%, 100%, 0.55);backdrop-filter: blur(10px)">
						<h2 class="featurette-heading ">And lastly, this one. <span class="text-muted">Checkmate.</span></h2>
						<p class="lead">And yes, this is the last block of representative placeholder content. Again, not really intended to be actually read, simply here to give you a better view of what this would look like with some actual content. Your content.</p>
					</div>
				</div>

				<div class="col-md-3 mt-3 align-items-start">
					<img src="images/dunja.jpg" width="300" class="rounded-3">
				</div>
			</div>
			</div>
			<!-- /END THE FEATURETTES -->

		</div>
		<div id="prelaoder">
			<video autoplay muted>
				<source src="./images/LastAnim.jpg0000-0200.mkv" type="video/mp4">
				Your browser does not support html video
			</video>
		</div>
		
		<!-- <div class="parallax2"></div> -->
		<!-- <div style="height:10px;background-color:black;font-size:36px"></div> -->
		<!-- <div class="parallax3"></div> -->
	</main>
	<!-- Footer -->
	<?php
		require 'footer.php';
	?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
	<script src="https://kit.fontawesome.com/a6efd8a22c.js" crossorigin="anonymous"></script>
	<script>
		setTimeout(function() {
			let body = document.getElementsByTagName("body")[0]
			body.classList.add("loaded")
		}, 1000);
	</script>
</body>
</html>	