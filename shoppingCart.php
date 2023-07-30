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
			require 'header.php'; // <= Session started here

			if(isset($_GET['create'])) {
				try {
					$conn->beginTransaction();
					$total = number_format(explode(" ", $_GET['totalCharges'])[0],2);
					
					// insert into orders table
					$sql = 'INSERT INTO `orders` (`user_id`, `order_total`, `status`) VALUES (?, ?, ?);';
					$conn->prepare($sql)->execute([$_SESSION['user_id'], $total, "CREATED"]);
					
					$orderId = $conn->lastInsertId();

					foreach($_GET as $key => $value){
						if(str_starts_with($key, 'qty-')){
							$product_id = number_format(explode("-", $key)[1]);
							$price = number_format(explode(" ", $_GET['price_EUR-'.$product_id])[0],2);

							// insert into orders details table
							$sql = "INSERT INTO `order_details`(`order_id`, `product_id`, `qty`, `unit_price`, `discount`) VALUES (?,?,?,?,?);";
							$conn->prepare($sql)->execute([$orderId, $product_id, $value, $price, 0]);
						}
					}
					$conn->commit();
					$_SESSION['alert'] = "Thank you, order number ".$orderId." is created!";
					$_SESSION['alert_style'] = 'info';
				} catch (Exception $e) {
					$pdo->rollback();
					$_SESSION['alert'] = "There was a problem creating order <br\>";
					$_SESSION['alert'] += "Error: " + $e.getMessage();
					$_SESSION['alert_style'] = 'danger';
				}
			} 
		?>
		<main>
        	<div class="container">
            	<h1 class="display-3"><?php echo $page; ?></h1>
				<?php require 'alert.php'; ?>
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
											<div id="shopping-cart-actions" class="d-flex justify-content-between align-items-center mb-5">
												<h6 class="mb-0"><a href="shop.php" class="text-body"><i
													class="fas fa-long-arrow-alt-left me-2"></i>Back to shop</a></h6>
												<input type="submit" name="update" id="update-cart" class="btn btn-dark btn-block btn-lg" value="Update Cart" />
												<input type="submit" name="delete" id="empty-cart" class="btn btn-dark btn-block btn-lg" value="Empty Cart" />
												<h6 class="mb-0 text-muted"><span class="itemCounter"></span> items</h6>
											</div>
											<hr class="my-4">
											<div id="cart-items">
											</div>
						
											<div class="pt-5">
												<h6 class="mb-0"><a href="shop.php" class="text-body"><i
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
												<!-- <h5 id="stotal"></h5> -->
												<input id="stotal" 
									   				name="stotal" 
									   				value="" 
									   				type="text"
									   				class="h5 mb-0 form-control form-control-sm" readonly/>
												</div>
							
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
												<!-- <h5 id="totalCharges"></h5> -->
												<input id="totalCharges" 
									   				name="totalCharges" 
									   				value="" 
									   				type="text"
									   				class="h5 mb-0 form-control form-control-sm" readonly/>
												</div>

												<input type="submit" name="create" id="create-order" class="btn btn-dark btn-block btn-lg"
												data-mdb-ripple-color="dark" value="Create Order"/>
							
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
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
