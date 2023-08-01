<?php
    $page="Customers";
?>
<!doctype html>
<html lang="en" data-bs-theme="dark" class="h-100">
<head>
	<title><?=$page?></title>
	<meta charset="utf-8" />
	<!-- Required meta tag for Bootstrap -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
	<link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet"  media="screen" type="text/css" />
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
            <?php
                if( !isset($_SESSION['user_id'])){
                    echo '<h1 class="display-3">Forbidden Access. Please login.</h1>';
                } else if (!$user['isAdmin']) {
                    echo '<h1 class="display-3">Forbidden Access. No Admin Rights.</h1>';
                } else { 
            ?>
            <h1 class="display-3"><?=$page?></h1>
        </div>
        <div class="container mb-4">

            <?php include('alert.php'); ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <!-- <div class="card-header">
                                <a href="customer-create.php" class="btn btn-primary float-end">Add Customer</a>
                        </div> -->
                        <div class="card-body">

                            <table id="customersTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>E-mail</th>
                                        <th>DOB</th>
                                        <th>Address</th>
                                        <th>Mobile</th>
                                        <th># Orders</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $query = 
                                        "SELECT 
                                            `users`.`id`,
                                            `users`.`email`,
                                            CONCAT(`users`.`name`, ' ', `users`.`surname`) AS `customer`,
                                            `users`.`dob`,
                                            `users`.`address`,
                                            `users`.`mobile`,
                                            `users`.`isAdmin`,
                                            COUNT(orders.id) as `num_orders`,
                                            SUM(orders.order_total) as `total_orders`
                                        FROM
                                            `users` left join `orders` on `users`.`id` = `orders`.`user_id`
                                        GROUP by users.id;";
                                        $stmt = $conn->query($query);
                                        while ($row = $stmt->fetch()){
                                            ?>
                                                <tr>
                                                    <td><?= $row['id']; ?></td>
                                                    <td><?= $row['customer']; ?> <?= $row['isAdmin'] ? '<span class="badge rounded-pill bg-primary">Admin</span>' : '' ?></td>
                                                    <td><?= $row['email']; ?></td>
                                                    <td><?= $row['dob']; ?></td>
                                                    <td><?= $row['address']; ?></td>
                                                    <td><?= $row['mobile']; ?></td>
                                                    <td><a href="orderHistory.php?id=<?= $row['id']; ?>" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                                                        <?= $row['num_orders']?>
                                                    </a></td>
                                                    <td><a href="orderHistory.php?id=<?= $row['id']; ?>" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                                                        <?= $row['total_orders']?>
                                                    </a></td>
                                                </tr>
                                                <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </main>

    <?php
        require 'footer.php';
    ?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
	<script src="https://kit.fontawesome.com/a6efd8a22c.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $( document ).ready(function() {
            $('#customersTable').DataTable( {
                "pageLength": 25,
                "order": [[0, 'asc']]
            });
        });
    </script>
</body>
</html>	