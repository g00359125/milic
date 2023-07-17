<?php 
	$page="Products";
?>
<!doctype html>
<html lang="en" data-bs-theme="dark">
	<head>
		<title>Products</title>
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
	<body>
		<?php
			require 'header.php';
		?>
		<main class="container">
			<h1 class="display-3"><?php echo $page; ?></h1>
			<ul>
				<li>
					<div class="product-image">
						<img src="images/wine1.jpg" alt="" />
					</div>
					<div class="product-description" data-name="Wine #1" data-price="5">
						<h3 class="product-name">Dunja</h3>
						<p class="product-price">&euro; 5</p>
						<form class="add-to-cart" action="cart.html" method="get">
							<div>
								<label for="qty-1">Quantity</label>
								<input type="text" name="qty-1" id="qty-1" class="qty" value="1" />
							</div>
							<p><input type="submit" value="Add to cart" class="btn" /></p>
						</form>
					</div>
				</li>
				<li>
					<div class="product-image">
						<img src="images/wine2.jpg" alt="" />
					</div>
					<div class="product-description" data-name="Wine #2" data-price="8">
						<h3 class="product-name">Kajsija</h3>
						<p class="product-price">&euro; 8</p>
						<form class="add-to-cart" action="cart.html" method="get">
							<div>
								<label for="qty-2">Quantity</label>
								<input type="text" name="qty-2" id="qty-2" class="qty" value="1" />
							</div>
							<p><input type="submit" value="Add to cart" class="btn" /></p>
						</form>
					</div>
				</li>

				<li>
					<div class="product-image">
						<img src="images/wine3.jpg" alt="" />
					</div>
					<div class="product-description" data-name="Wine #3" data-price="11">
						<h3 class="product-name">Orah</h3>
						<p class="product-price">&euro; 11</p>
						<form class="add-to-cart" action="cart.html" method="get">
							<div>
								<label for="qty-3">Quantity</label>
								<input type="text" name="qty-3" id="qty-3" class="qty" value="1" />
							</div>
							<p><input type="submit" value="Add to cart" class="btn" /></p>
						</form>
					</div>
				</li>
			</ul>

		</main>
		<?php
			require 'footer.php';
		?>
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
		<script src="https://kit.fontawesome.com/a6efd8a22c.js" crossorigin="anonymous"></script>
		<!-- <script>$(document).ready(function(){ $("h1").addClass("animated bounce"); });</script> -->
	</body>
</html>	
