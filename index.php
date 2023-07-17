<?php

session_start();

require 'database.php';

if( isset($_SESSION['user_id']) ){

	$records = $conn->prepare('SELECT id,email,password,name,surname,dob,address,mobile FROM users WHERE id = :id');
	$records->bindParam(':id', $_SESSION['user_id']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	$user = NULL;

	if( count($results) > 0){
		$user = $results;
	}

}

?>

<!doctype html>
<html lang="en">
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
	</head>
	<body>
		
		<?php
			require 'menu.php';
		?>
		<div class="container marketing">

<!-- Three columns of text below the carousel -->
<div class="row">
  <div class="col-lg-4">
	<!-- <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"></rect><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg> -->
	<img src="images/wine1.jpg" height="300">

	<h2>Heading</h2>
	<p>Some representative placeholder content for the three columns of text below the carousel. This is the first column.</p>
	<p><a class="btn btn-secondary" href="#">View details »</a></p>
  </div><!-- /.col-lg-4 -->
  <div class="col-lg-4">
	<!-- <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"></rect><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg> -->
	<img src="images/wine2.jpg" height="300">
	<h2>Heading</h2>
	<p>Another exciting bit of representative placeholder content. This time, we've moved on to the second column.</p>
	<p><a class="btn btn-secondary" href="#">View details »</a></p>
  </div><!-- /.col-lg-4 -->
  <div class="col-lg-4">
	<!-- <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"></rect><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg> -->
	<img src="images/wine3.jpg" height="300">
	<h2>Heading</h2>
	<p>And lastly this, the third column of representative placeholder content.</p>
	<p><a class="btn btn-secondary" href="#">View details »</a></p>
  </div><!-- /.col-lg-4 -->
</div><!-- /.row -->

<!-- <div></div>
	<div style="height:10px;background-color:black;font-size:36px">
</div> -->

<!-- START THE FEATURETTES -->
<hr class="featurette-divider">

<div class="row featurette text-white parallax">
  <div class="col-md-7">
	<h2 class="featurette-heading">First featurette heading. <span class="text-muted">It’ll blow your mind.</span></h2>
	<p class="lead">Some great placeholder content for the first featurette here. Imagine some exciting prose here.</p>
  </div>
  <div class="col-md-5">
	<!-- <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"></rect><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg> -->
	<img src="images/wine1.jpg" width="500">
  </div>
</div>

<hr class="featurette-divider">

<div class="row featurette text-white parallax2">
  <div class="col-md-7 order-md-2">
	<h2 class="featurette-heading">Oh yeah, it’s that good. <span class="text-muted">See for yourself.</span></h2>
	<p class="lead">Another featurette? Of course. More placeholder content here to give you an idea of how this layout would work with some actual real-world content in place.</p>
  </div>
  <div class="col-md-5 order-md-1">
	<!-- <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"></rect><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg> -->
	<img src="images/wine2.jpg" width="500">
  </div>
</div>

<hr class="featurette-divider">

<div class="row featurette text-white parallax3">
  <div class="col-md-7">
	<h2 class="featurette-heading">And lastly, this one. <span class="text-muted">Checkmate.</span></h2>
	<p class="lead">And yes, this is the last block of representative placeholder content. Again, not really intended to be actually read, simply here to give you a better view of what this would look like with some actual content. Your content.</p>
  </div>
  <div class="col-md-5">
	<!-- <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"></rect><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg> -->
	<img src="images/wine3.jpg" width="500">
  </div>
</div>

<hr class="featurette-divider">
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