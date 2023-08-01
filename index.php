<?php
	$page = 'Home';
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
		<div class="container">
			<div class="px-4 py-1 my-1 text-center">
				<img class="d-block mx-auto mb-4 w-100" src="images/lLogoGold.png" alt="">
				<h1 class="display-5 fw-bold text-body-emphasis">Milic Rakija <br/> <span class="tagline">Finest rakija this side of the Danube!</h1>
				<div class="col-lg-6 mx-auto">
					<p class="lead mb-4">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
					<div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
						<!-- <button type="button" class="btn btn-primary btn-lg px-4 gap-3">Primary button</button> -->
						<button type="button" class="btn btn-outline-secondary btn-lg px-4">Oreder Now!</button>
					</div>
				</div>
			</div>

			<h1 class="display-4"></h1>
			<!-- START THE FEATURETTES -->
			<div class="list-group">
			<hr class="featurette-divider">

			<div id="featurette-1" class="row featurette text-whitesmoke ">
				<div class="col-md-7">
					<h2 class="featurette-heading">First featurette heading. <span class="text-muted">It’ll blow your mind.</span></h2>
					<p class="lead">Some great placeholder content for the first featurette here. Imagine some exciting prose here.</p>
				</div>
				<div class="col-md-5">
					<!-- <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"></rect><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg> -->
					<img src="images/kajsija.jpg" width="500">
				</div>
			</div>

			<hr class="featurette-divider">

			<div id="featurette-2" class="row featurette text-whitesmoke ">
				<div class="col-md-7 order-md-2">
					<h2 class="featurette-heading">Oh yeah, it’s that good. <span class="text-muted">See for yourself.</span></h2>
					<p class="lead">Another featurette? Of course. More placeholder content here to give you an idea of how this layout would work with some actual real-world content in place.</p>
				</div>
				<div class="col-md-5 order-md-1">
					<!-- <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"></rect><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg> -->
					<img src="images/orah.jpg" width="500">
				</div>
			</div>

			<hr class="featurette-divider">

			<div id="featurette-3" class="row featurette text-whitesmoke ">
				<div class="col-md-7">
					<h2 class="featurette-heading">And lastly, this one. <span class="text-muted">Checkmate.</span></h2>
					<p class="lead">And yes, this is the last block of representative placeholder content. Again, not really intended to be actually read, simply here to give you a better view of what this would look like with some actual content. Your content.</p>
				</div>
				<div class="col-md-5">
					<!-- <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"></rect><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg> -->
					<img src="images/dunja.jpg" width="500">
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
		<!-- Container element -->
		
		<!-- <div class="parallax2"></div>
		<div style="height:10px;background-color:black;font-size:36px"></div>
		<div class="parallax3"></div> -->
	</main>
	<!-- Footer -->
	<?php
		require 'footer.php';
	?>
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
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