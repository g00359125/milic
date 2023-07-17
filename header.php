<?php
session_start();

require 'database.php';

if( isset($_SESSION['user_id']) ){

	$records = $conn->prepare('SELECT id,email,password,name,surname,dob,address,mobile,isAdmin FROM users WHERE id = :id');
	$records->bindParam(':id', $_SESSION['user_id']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	$user = NULL;

	if( count($results) > 0){
		$user = $results;
	}

}
?>
<header class="p-3 bg-dark text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="./index.php" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <!-- <svg class="bi me-2" width="40" height="32" role="img" aria-label="Milic"><use xlink:href="#bootstrap"></use></svg> -->
                <img
                    src="./images/lLogoWhite.png"
                    height="70"
                    alt="Milic Logo"
                    loading="lazy"
                    class="d-inline-block align-text-middle"
                />
                <!-- Rakije Milic -->
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="index.php" class="nav-link px-2 <?php if($page == 'Home') echo 'text-secondary'; else echo 'text-white' ?>">Home</a></li>
                <li><a href="products.php" class="nav-link px-2 <?php if($page == 'Products') echo 'text-secondary'; else echo 'text-white' ?>">Products</a></li>
                <li><a href="contact.php" class="nav-link px-2 <?php if($page == 'Contact') echo 'text-secondary'; else echo 'text-white' ?>">Contact</a></li>
                <li><a href="about.php" class="nav-link px-2 <?php if($page == 'About') echo 'text-secondary'; else echo 'text-white' ?>">About</a></li>
            </ul>

            <div class="text-end">
                <?php if (!empty($user)) { ?>
                    <a href="#" class="text-decoration-none dropdown-toggle text-white" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                <?php echo $user['name'].' '.$user['surname'].' '; ?>
                    </a>
                    <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser" style="">
                        <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                        <li><a class="dropdown-item" href="shoppingCart.php">View Cart</a></li>
                        <li><a class="dropdown-item" href="orderHistory.php">Order History</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <?php if(!empty($user) && $user['isAdmin']) { ?>
                            <li><a class="dropdown-item" href="orders.php">Orders</a></li>
                            <li><a class="dropdown-item" href="inventory.php">Inventory</a></li>
                            <li><a class="dropdown-item" href="prices.php">Prices</a></li>
                            <li><hr class="dropdown-divider"></li>
                        <?php };?>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                    <a class="text-reset me-3" href="shoppingCart.php"><i class="fas fa-shopping-cart"></i></a>
                    <a href="logout.php"><button type="button" class="btn btn-outline-light me-2">Logout</button></a>
                <?php } else {?>
                    <a href="login.php"><button type="button" class="btn btn-outline-light me-2">Login</button></a>
                    <a href="register.php"><button type="button" class="btn btn-outline-light me-2">Register</button></a>
                <?php }; ?>
            </div>
        </div>
    </div>
</header>
<!-- Header -->	
<?php
    require 'themeToggle.php';
?>