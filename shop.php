<?php 
	$page="Shop";
	session_start();
	require 'database.php';
?>
<!doctype html>
<html lang="en" data-bs-theme="dark" class="h-100">
<head>
	<title>Products</title>
	<meta charset="utf-8" />
	<!-- Required meta tag for Bootstrap -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
	<link href="css/style.css" rel="stylesheet" media="screen" type="text/css" />
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery.shop.js"></script>
	<script type="text/javascript" src="js/color-modes.js"></script>
</head>
<body id="site" class="d-flex flex-column h-100">
	<?php
		require 'header.php';
	?>
	<main class="flex-shrink-0">
		<div class="container">
			<h1 class="display-3">Shop</h1>
		</div>
		<div class="container mb-4">
			
			<?php require 'alert.php'; ?>

			<div class="row row-cols-1 row-cols-md-3 g-4">
			<?php 
				$query = "SELECT * FROM `prices_view_en`;";
				$counter = 0;	
				$stmt = $conn->query($query);
				while ($row = $stmt->fetch()){
					$counter++;
			?>
				<div class="col">
					<div class="card h-100">
						<div class="card-header px-0 py-0">
							<img src="images/<?= $row['image']; ?>" alt="" class="card-img-top"/>
						</div>
						<div class="card-body text-center">	
							<h3 class="card-title"><?= $row['name']; ?></h3>				
							<div class="product-description" 
								data-id="<?=$row['product_id'];?>"
								data-name="<?=$row['name'];?>" 
								data-desc="<?=$row['description'];?>"
								data-abv="<?=$row['abv'];?>"
								data-volume="<?=$row['volume'];?>"
								data-year="<?=$row['year'];?>"
								data-image="images/<?=$row['image'];?>"
								data-stock="<?=$row['qty'];?>"
								data-price="<?=$row['price'];?>"
								data-currency="EUR"
							>
								<p class="card-text text-muted">ABV: <?= $row['abv']; ?> % | Vol: <?= $row['volume']; ?> L | Year: <?= $row['year']; ?></p>	
								<p class=""><?= $row['description']; ?></p>
								<p class="product-price display-6"><strong><?= $row['price']; ?> EUR</strong></p>
								<form class="add-to-cart row g-3" action="shoppingCart.php" method="get">
									<!-- <div class="col-sm-1 offset-sm-1">
										<button class="btn btn-link px-2"
											onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
											<i class="fas fa-minus"></i>
										</button>
									</div> -->
									<div class="col-sm-5 offset-sm-1">
										<!-- <label class="form-label" for="qty-<?=$row['product_id'];?>">Quantity</label> -->
										<input type="number" 
											name="qty-<?=$row['product_id'];?>" 
											id="qty-<?=$row['product_id'];?>" 
											min="0" max="<?=$row['qty'];?>" 
											class="qty form-control form-control-sm text-center fs-5 <?=$row['qty'] == 0 ? 'disabled' : 'enabled';?>" 
											value="<?=$row['qty'] == 0 ? 0 : 1;?>" />
									</div>
									<!-- <div class="col-sm-1">
										<button class="btn btn-link px-2" 
											onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
											<i class="fas fa-plus"></i>
										</button>
									</div> -->
									<div class="col-sm-4">
										<input type="submit" value="Add to cart" class="btn btn-secondary form-control form-control-sm <?=$row['qty'] == 0 ? 'disabled' : 'enabled';?>" />
									</div>
								</form>
							</div>
						</div>
						<div class="card-footer text-center">
						<?php 
							if ($row['qty'] == 0)
								echo '<small class="text-danger" id="stock">Sorry out of stock</small>';
							else 
								echo '<small class="text-body-secondary" id="stock">Only '.$row['qty'].' left</small>';
						?>
						</div>
					</div>
				</div>
			<?php
				}

				if($counter == 0) {   
					echo "<h5> No Record Found </h5>";
				}
			?>
			</div>
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
