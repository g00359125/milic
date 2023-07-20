<?php
	$page = 'Shopping Cart';
?>
<!doctype html>
<html lang="en" data-bs-theme="dark">
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
		<script src="https://kit.fontawesome.com/a6efd8a22c.js" crossorigin="anonymous"></script>
	</head>
	<body id="site">
		<?php
			require 'header.php';
		?>
		<main>
        	<div class="container">
            <h1 class="display-3"><?php echo $page; ?></h1>
        	</div>
			<form id="shopping-cart" action="shoppingCart.php" method="get">
			<section class="h-100 h-custom">
				<div class="container py-5 h-100">
					<div class="row d-flex justify-content-center align-items-center h-100">
						<div class="col-12">
							<div class="card card-registration card-registration-2" style="border-radius: 15px;">
								<div class="card-body p-0">
									<div class="row g-0">
										<div class="col-lg-8">
										<div class="p-5">
											<div class="d-flex justify-content-between align-items-center mb-5">
											<h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
											<h6 class="mb-0 text-muted"><span class="itemCounter"></span> items</h6>
											</div>
											<hr class="my-4">
											<div id="cart-items">
											</div>
						
											<div class="pt-5">
												<h6 class="mb-0"><a href="products.php" class="text-body"><i
													class="fas fa-long-arrow-alt-left me-2"></i>Back to shop</a></h6>
											</div>
										</div>
										</div>
										<div class="col-lg-4 bg-grey">
											<div class="p-5" id="sub-total">
												<h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
												<hr class="my-4">
							
												<div class="d-flex justify-content-between mb-4">
												<h5 class="text-uppercase">items <span class="itemCounter"></span></h5>
												<h5 id="stotal"></h5>
												</div>
							
												<!-- <h5 class="text-uppercase mb-3">Shipping</h5>
							
												<div class="mb-4 pb-2">
												<select class="select">
													<option value="1">Standard-Delivery- €5.00</option>
													<option value="2">Two</option>
													<option value="3">Three</option>
													<option value="4">Four</option>
												</select>
												</div> -->
							
												<h5 class="text-uppercase mb-3">Give code</h5>
							
												<div class="mb-5">
												<div class="form-outline">
													<input type="text" id="form3Examplea2" class="form-control form-control-lg" />
													<label class="form-label" for="form3Examplea2">Enter your code</label>
												</div>
												</div>
							
												<hr class="my-4">
							
												<div class="d-flex justify-content-between mb-5">
												<h5 class="text-uppercase">Total price</h5>
												<h5>€ 137.00</h5>
												</div>
							
												<button type="button" class="btn btn-dark btn-block btn-lg"
												data-mdb-ripple-color="dark">Register</button>
							
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<div id="content">
				
					
					<p id="sub-total">
						<strong>Sub Total</strong>: <span id="stotal"></span>
					</p>
					<ul id="shopping-cart-actions">
						<li>
							<input type="submit" name="update" id="update-cart" class="btn" value="Update Cart" />
						</li>
						<li>
							<input type="submit" name="delete" id="empty-cart" class="btn" value="Empty Cart" />
						</li>
						<li>
							<a href="products.php" class="btn">Continue Shopping</a>
							<!-- Uncomment next line to integrate shopping cart -->
							<!-- <a href="shop.html" class="btn">Continue Shopping</a> -->
						</li>
						<li>
							<a href="checkout.html" class="btn">Go To Checkout</a>
						</li>
					</ul>
				</form>
			</div>
		</main>
		<?php
			require 'footer.php';
		?>
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
		<script>$(document).ready(function(){ $("h1").addClass("animated bounce"); });</script>
	</body>
</html>	
