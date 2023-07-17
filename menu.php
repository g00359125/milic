<?php

?>
<!-- Navbar -->
<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-black">
			<!-- Container wrapper -->
			<div class="container-fluid">
			
			<!-- Toggle button -->
			<button
				class="navbar-toggler"
				type="button"
				data-mdb-toggle="collapse"
				data-mdb-target="#navbarSupportedContent"
				aria-controls="navbarSupportedContent"
				aria-expanded="false"
				aria-label="Toggle navigation"
			>
				<i class="fas fa-bars"></i>
			</button>
		
			<!-- Collapsible wrapper -->
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<!-- Navbar brand -->
				<a class="navbar-brand mt-2 mt-lg-0" href="#">
				<img
					src="./images/lLogoWhite.png"
					height="70"
					alt="MDB Logo"
					loading="lazy"
				/>
				</a>
				<!-- Left links -->
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<a class="nav-link" href="./index.php">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="products.php">Products</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="contact.html">Contact</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="about.html">About</a>
				</li>
				</ul>
				<!-- Left links -->
			</div>
			<!-- Collapsible wrapper -->
		
			<!-- Right elements -->
			<div class="d-flex align-items-center">
				<!-- Icon -->
				<a class="text-reset me-3" href="shoppingCart.php">
				<i class="fas fa-shopping-cart"></i>
				</a>
		
				
				<!-- Avatar -->
				<div class="dropdown">
				
				<a
					class="dropdown-toggle d-flex align-items-center hidden-arrow"
					href="#"
					id="navbarDropdownMenuAvatar"
					role="button"
					data-mdb-toggle="dropdown"
					aria-expanded="false"
				>
					<img
					src="./images/userWhite.png"
					class="rounded-circle"
					height="25"
					alt="Black and White Portrait of a Man"
					loading="lazy"
					/>
				</a>
				<?php 
					if (!empty($user)) {
						#header('Location: ./index.php');
						echo $user['name'].' '.$user['surname'].' <a href="logout.php">Logout</a>';
					} else {
						echo '<a href="login.php">Login</a>';
					}
				?>
				<ul
					class="dropdown-menu dropdown-menu-dark dropdown-menu-end"
					aria-labelledby="navbarDropdownMenuAvatar"
				>
					<li >
					<a class="dropdown-item" href="#">My profile</a>
					</li>
					<li>
					<a class="dropdown-item" href="#">Settings</a>
					</li>
					<li>
					<a class="dropdown-item" href="#">Logout</a>
					</li>
				</ul>
				</div>
			</div>
			<!-- Right elements -->
			</div>
			<!-- Container wrapper -->
		</nav>
		<!-- Navbar -->