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
	<link href="css/addtohomescreen.css" rel="stylesheet">

<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="application-name" content="Milic rakije">
<meta name="apple-mobile-web-app-title" content="Milic rakije">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

<link rel="apple-touch-icon" href="meta/0/ios-appicon-120-120.png">
<link rel="apple-touch-icon" sizes="152x152" href="meta/0/ios-appicon-152-152.png">
<link rel="apple-touch-icon" sizes="180x180" href="meta/0/ios-appicon-180-180.png">
<link rel="apple-touch-icon" sizes="120x120" href="meta/0/ios-appicon-120-120.png">
<link href="meta/0/apple-touch-startup-image-320x460.png" media="(device-width: 320px)"
    rel="apple-touch-startup-image">
<!-- iPhone (Retina) SPLASHSCREEN-->
<link href="meta/0/apple-touch-startup-image-640x920.png"
    media="(device-width: 320px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image">
<!-- iPad (portrait) SPLASHSCREEN-->
<link href="meta/0/apple-touch-startup-image-768x1004.png" media="(device-width: 768px) and (orientation: portrait)"
    rel="apple-touch-startup-image">
<!-- iPad (landscape) SPLASHSCREEN-->
<link href="meta/0/apple-touch-startup-image-748x1024.png" media="(device-width: 768px) and (orientation: landscape)"
    rel="apple-touch-startup-image">
<!-- iPad (Retina, portrait) SPLASHSCREEN-->
<link href="meta/0/apple-touch-startup-image-1536x2008.png"
    media="(device-width: 1536px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 2)"
    rel="apple-touch-startup-image">
<!-- iPad (Retina, landscape) SPLASHSCREEN-->
<link href="meta/0/apple-touch-startup-image-2048x1496.png"
    media="(device-width: 1536px)  and (orientation: landscape) and (-webkit-device-pixel-ratio: 2)"
    rel="apple-touch-startup-image">
<!-- iPhone 6/7/8 -->
<link href="/meta/0/apple-touch-startup-image-750x1334.png"
    media="(device-width: 375px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
<!-- iPhone 6 Plus/7 Plus/8 Plus -->
<link href="/meta/0/apple-touch-startup-image-1242x2208.png"
    media="(device-width: 414px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image" />

<meta name="msapplication-starturl" content="/home.php">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link href="./images/favicon.ico" rel="shortcut icon">
<link rel="icon" type="image/png" href="./images/favicon-16x16.png" sizes="16x16">
<link rel="icon" type="image/png" href="./images/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="./images/favicon-96x96.png" sizes="96x96">

<meta name="theme-color" content="#ffffff">

<link rel="manifest" href="manifest.json">
<meta name="generator" content="PWA Starter">
</head>
<body id="site" class="d-flex flex-column h-100">
	<?php
		require 'header.php';
	?>

	<!-- Main -->
	<main class="flex-shrink-0">
		<div class="container mb-3">
			<div class="px-4 py-1 my-1 text-center ">
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

			<div id="featurette-1" class="row featurette text-whitesmoke parallax rounded-3 justify-content-between">
				<div class="col-md-7 align-items-center d-flex"  data-bs-theme="light">
					<div class="container card mt-3" style = "background: hsla(0, 0%, 100%, 0.55);backdrop-filter: blur(10px)">
						<h3 class="featurette-heading ">Try our best-seller Kajsija!<span class="text-muted"></span></h3>
						<h3 class="featurette-heading ">Made from our locally grown apricots.</h3>
						<p class="lead">The perfect gift for a loved one.</p>
					</div>
				</div>
				<div class="col-md-5 mt-3 mb-3 text-center">
					<img src="images/kajsija.jpg" class="rounded-3 float-md-end img-fluid" style ="background: hsla(0, 0%, 100%, 0.55);backdrop-filter: blur(10px);">
				</div>
			</div>

			<hr class="featurette-divider">

			<div id="featurette-2" class="row featurette text-whitesmoke parallax2 rounded-3 justify-content-between">
				<div class="col-md-7 order-md-2 align-items-center d-flex"  data-bs-theme="light">
					<div class="container card mt-3" style = "background: hsla(0, 0%, 100%, 0.55);backdrop-filter: blur(10px)">
						<h2 class="featurette-heading"> Our Location<span class="text-muted"></span></h2>
						<p class="lead">We are situated in a small town in Serbia called 'Vrsac'. Come visit us and soak in the beautiful scenery around our town.</p>
						<div class="mh-100">
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1303039.33366493!2d19.431127965318034!3d45.52110430322704!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475014c5c5a2f53d%3A0x1a10369c2cb8e43a!2zVnLFoWFj!5e0!3m2!1sen!2srs!4v1692781772384!5m2!1sen!2srs" style="border:0;" class="w-100" height="400" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
						</div>
					</div>
				</div>
				<div class="col-md-5 order-md-1 mt-3 mb-3 text-center">
					<img src="images/orah.jpg" class="rounded-3 float-md-start img-fluid">
				</div>
			</div>

			<hr class="featurette-divider">

			<div id="featurette-3" class="row featurette text-whitesmoke parallax3 rounded-3 justify-content-between">
				<div class="col-md-7 align-items-center d-flex"  data-bs-theme="light">
					<div class="container card mt-3" style = "background: hsla(0, 0%, 100%, 0.55);backdrop-filter: blur(10px)">
						<h2 class="featurette-heading ">History<span class="text-muted"></span></h2>
						<p class="lead">Milic Rakije was founded in 1950 by the Milic family. It's been run by the Milic family for three generations. 
						The same formula for spirit making is still being used today.</p>
					</div>
				</div>

				<div class="col-md-5 mt-3 mb-3 text-center">
					<img src="images/dunja.jpg" class="rounded-3 float-md-end img-fluid">
				</div>
			</div>
			</div>
			<!-- /END THE FEATURETTES -->

		</div>
		<div>
			<!-- Common Add to Homescreen Template -->
			<div class="ath-container banner-bottom-center">
				<div class="ath-banner">
					<div class="ath-banner-cell">
						<img src="images/lLogo.png" alt="PWA" class="ath-prompt-logo" width="96">
					</div>
					<div class="ath-banner-title">
						<p>Install this PWA?</p>
					</div>
					<div class="ath-banner-cell">
						<button class="btn btn-cancel btn-link">Not Now</button>
					</div>
					<div class="ath-banner-cell">
						<button class="btn btn-install btn-success">Install</button>
					</div>

				</div>
    		</div>
			
		</div>
		<div id="prelaoder">
			<video autoplay muted height="700">
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
		}, 8000);

		
	</script>
	<script src="js/addtohomescreen.js" type="application/javascript"></script>

	<script src="js/addtohomescreen.js"></script>
	<script>
	addToHomescreen( {
		appID: "rs.milic-rakije",
		appName: "Milic rakije",
		lifespan: 15,
		startDelay:0,
		autostart: true,
		skipFirstVisit: false,
		minSessions: 1,
		displayPace: 0,
		customPrompt: {
			title: "Install Milic-rakije?",
			src: "meta/0/favicon-96x96.png",
			cancelMsg: "Cancel",
			installMsg: "Install"
		}
	} );
	</script>
	<script>
	if ( "serviceWorker" in navigator ) {

		navigator.serviceWorker.register( "./sw.js" )
			.then( function ( registration ) { // Registration was successful

				console.log( "ServiceWorker registration successful with scope: ", registration.scope );

			} ).catch( function ( err ) { // registration failed :(

				console.log( "ServiceWorker registration failed: ", err );

			} );

	}
	</script>
</body>
</html>	