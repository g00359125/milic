<?php
	$page = 'Shopping Cart';
	session_start();
	require 'database.php';

	if(isset($_GET['create']) && isset($_GET['totalCharges']) && $_GET['totalCharges'] != '' &&
		number_format(explode(" ", $_GET['totalCharges'])[0],2) > 0) {
	try {
		$conn->beginTransaction();
		$total = number_format(explode(" ", $_GET['totalCharges'])[0],2);
		
		// insert into orders table
		$sql = 'INSERT INTO `orders` (`user_id`, `order_total`, `status`, `discount`) VALUES (?, ?, ?, ?);';
		$conn->prepare($sql)->execute([$_SESSION['user_id'], $total, "CREATED", $_GET['discount_rate']]);
		
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
		header('Location: shoppingCart.php?delete=Empty+Cart');
		exit(0);
		
	} catch (Exception $e) {
		$conn->rollback();
		$_SESSION['alert'] = "There was a problem creating order <br\>";
		$_SESSION['alert'] += "Error: " + $e.getMessage();
		$_SESSION['alert_style'] = 'danger';
	}
} 
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
		<script>
            <?php
            if (isset($_GET['delete'])) {
                echo 'sessionStorage.setItem( "milic-cart", JSON.stringify({items:[]}) );';
				echo 'sessionStorage.setItem( "milic-shipping-rates", 0 );';
				echo 'sessionStorage.setItem( "milic-discount-rate", 0 );';
				echo 'sessionStorage.setItem( "milic-total", 0 );';
            }  
            ?>
    	</script>
		<script type="text/javascript" src="js/jquery.shop.js"></script>
		<script type="text/javascript" src="js/color-modes.js"></script>
		<script src="https://kit.fontawesome.com/a6efd8a22c.js" crossorigin="anonymous"></script>
	</head>
	<body id="site" class="d-flex flex-column h-100">
		<?php
			require 'header.php'; // <= Session started here
			$discount_value = 0;
			if(isset($_GET['discount']) && isset($_GET['code'])){
				$sql = "SELECT code, discount_value FROM discounts WHERE NOW() > valid_from AND NOW() < valid_to and code = :code;";
				$stmn = $conn->prepare($sql);
				$stmn->bindParam(':code',$_GET['code']);
				$stmn->execute();
				$record = $stmn->fetch();
				if (isset($record)){
					$discount_value = $record['discount_value'];
				}
			}
		?>
		<main class="flex-shrink-0">
        	<div class="container">
				<?php
					if( !isset($_SESSION['user_id']) ){
						echo '<h1 class="display-3">Forbidden Access. Please login.</h1>';
					} else {
				?>
            	<h1 class="display-3"><?php echo $page; ?></h1>
				<?php require 'alert.php'; ?>

				<form id="shopping-cart" action="shoppingCart.php" method="get">
					<div class="row d-flex justify-content-center align-items-center h-100">
						<div class="col-12">
							<div class="card mb-4">
								<div class="card-body p-0">
									<div class="row g-0">
										<div class="col-lg-8 p-5">
											<div id="shopping-cart-actions" class="row">
												<h6 class="col-12 col-md-3 m-1 p-0">
													<a href="shop.php" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Back to shop</a>
												</h6>
												<input type="submit" name="update" id="update-cart" class="col-12 col-md-3 btn btn-dark btn-block btn-lg m-1" value="Update Cart" />
												<input type="submit" name="delete" id="empty-cart" class="col-12 col-md-3 btn btn-dark btn-block btn-lg m-1" value="Empty Cart" />
												<div class="col-12 col-md-2 m-1 p-0 text-muted"><span class="itemCounter"></span> items</div>
											</div>
											<hr class="my-4">
											<div id="cart-items">
											</div>
											<div class="pt-5">
												<h6 class="mb-0">
													<a href="shop.php" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Back to shop</a>
												</h6>
											</div>
										</div>
										<div id="sub-total" class="col-lg-4 bg-grey p-5">
											<h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
											<hr class="my-4">
											<!-- Subtotal -->
											<div class="d-flex justify-content-between">
												<h5 class="text-uppercase mb-0 py-4">items <span class="itemCounter"></span></h5>
												<input id="stotal" name="stotal" value="" type="text"
													class="h5 mb-0 form-control-plaintext form-control-sm fs-5 float-end text-end w-50" readonly/>
											</div>
											<!-- Discount code -->
											<h5 class="text-uppercase mb-3">Discount code</h5>
											<div class="form-floating mb-3">
												<input type="text" name="code" id="code" class="form-control form-control-lg" value="<?=isset($_GET['code']) ? $_GET['code'] : '' ?>" />
												<input type="hidden" name="discount_rate" id="discount-rate" value="<?= $discount_value ?>" />
												<label class="form-label" for="code">Enter your code</label>
												<!-- Apply Discount btn -->
												<input type="submit" name="discount" id="apply-discount" class="btn btn-dark btn-block mt-3" value="Apply Discount"/>
											</div>
											
											<hr class="my-4">
											<!-- Total Price -->
											<div class="d-flex justify-content-between">
												<h5 class="text-uppercase py-4">Total price</h5>
												<!-- <h5 id="totalCharges"></h5> -->
												<input id="totalCharges" name="totalCharges" value="" type="text"
													class="h5 mb-0 form-control-plaintext form-control-sm fs-5 float-end text-end w-50" readonly/>
											</div>
											<!-- Create Order btn -->
											<input type="submit" name="create" id="create-order" class="btn btn-dark btn-block btn-lg" value="Create Order"/>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
				<?php } ?>
			</div>
		</main>
		<?php
			require 'footer.php';
		?>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
		<script src="https://kit.fontawesome.com/a6efd8a22c.js" crossorigin="anonymous"></script>
		
	</body>
</html>	
