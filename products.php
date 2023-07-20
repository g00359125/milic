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
<body id="site">
	<?php
		require 'header.php';
	?>
	<main>
		<div class="container">
			<h1 class="display-3">Products</h1>

			<?php include('alert.php'); ?>

			<!-- <div class="row"> -->
				<!-- <div class="col-md-12"> -->
				<div class="card-group">
				<?php 
					$query = "SELECT * FROM `products` LEFT JOIN prices ON products.id = prices.product_id";
					$counter = 0;	
					$stmt = $conn->query($query);
					while ($row = $stmt->fetch()){
						$counter++;
				?>
					<div class="card" >
						<div class="card-header">
							<img src="images/<?= $row['image']; ?>" alt="" class="card-img-top"/>
						</div>
						<div class="card-body">	
							<h5 class="card-title"><?= $row['name_en']; ?></h5>				
							<div class="product-description" 
								data-id="<?=$row['product_id'];?>"
								data-name="<?=$row['name_en'];?>" 
								data-desc="<?=$row['desc_en'];?>"
								data-abv="<?=$row['abv'];?>"
								data-volume="<?=$row['volume'];?>"
								data-year="<?=$row['year'];?>"
								data-image="images/<?=$row['image'];?>"
								data-stock="30"
								data-price="<?=$row['price_eur'];?>"
								data-currency="EUR"
							>
								<p class="product-price"><?= $row['price_eur']; ?> EUR</p> 
								<p>ABV: <?= $row['abv']; ?> % </p>
								<p>Volume: <?= $row['volume']; ?> L </p>
								<p>Year: <?= $row['year']; ?></p>
								<form class="add-to-cart" action="shoppingCart.php" method="get">
									<div>
										<label for="qty-<?=$row['product_id'];?>">Quantity</label>
										<input type="text" name="qty-<?=$row['product_id'];?>" id="qty-<?=$row['product_id'];?>" class="qty" value="1" />
									</div>
									<p><input type="submit" value="Add to cart" class="btn" /></p>
								</form>
							</div>
						
							<!-- <a href="inventory-edit.php?id=<?= $row['id']; ?>" class="btn btn-success btn-sm">Edit</a> -->
							<!-- <form action="code.php" method="POST" class="d-inline">
								<button type="submit" name="delete_inventory" value="<?=$row['id'];?>" class="btn btn-danger btn-sm">Delete</button>
							</form> -->
						</div>
					</div>
				<?php
					}

					if($counter == 0) {   
						echo "<h5> No Record Found </h5>";
					}
				?>
				</div>
			<!-- </div> -->
		</div>
		<h1 class="display-3"><?php echo $page; ?></h1>
		<ul>
			<li>
				<div class="product-image">
					<img src="images/wine1.jpg" alt="" />
				</div>
				<div class="product-description" data-name="Wine #1" data-price="5">
					<h3 class="product-name">Dunja</h3>
					<p class="product-price">&euro; 5</p>
					<form class="add-to-cart" action="shoppingCart.php" method="get">
						<div>
							<label for="qty-5">Quantity</label>
							<input type="text" name="qty-5" id="qty-5" class="qty" value="1" />
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
					<form class="add-to-cart" action="shoppingCart.php" method="get">
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
					<form class="add-to-cart" action="shoppingCart.php" method="get">
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
