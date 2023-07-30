<?php
    $page="Orders";
?>
<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
	<title><?=$page?></title>
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
            <h1 class="display-3"><?=$page?></h1>
            <div class="container mt-4">

                <?php include('alert.php'); ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <!-- <div class="card-header">
                                <h4>Details
                                    <a href="student-create.php" class="btn btn-primary float-end">Add Students</a>
                                </h4>
                            </div> -->
                            <div class="card-body">

                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Customer</th>
                                            <th>Order Time</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Delivery Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $query = "SELECT orders.id, user_id, CONCAT(users.name, ' ', users.surname) AS customer, 
                                                order_time, order_total, status, delivery_time 
                                                FROM `orders` JOIN users ON orders.user_id = users.id ORDER BY order_time DESC;";
                                            // $query = "SELECT * FROM orders;";
                                            // $records = $conn->prepare($query);
	                                        //$records->bindParam(':id', $_SESSION['user_id']);
	                                        // $records->execute();
	                                        // $results = $records->fetch(PDO::FETCH_ASSOC);
                                            $counter = 0;
                                            
                                            $stmt = $conn->query($query);
                                            while ($row = $stmt->fetch()){
                                                // print_r($row);
                                                $counter++;
                                                ?>
                                                    <tr>
                                                        <td><?= $row['id']; ?></td>
                                                        <td><?= $row['customer']; ?></td>
                                                        <td><?= $row['order_time']; ?></td>
                                                        <td><?= $row['order_total']; ?></td>
                                                        <td><?= $row['status']; ?></td>
                                                        <td><?= $row['delivery_time']; ?></td>
                                                        <td>
                                                            <a href="order-view.php?id=<?= $row['id']; ?>" class="btn btn-info btn-sm">View</a>
                                                            <!-- <a href="inventory-edit.php?id=<?= $row['id']; ?>" class="btn btn-success btn-sm">Edit</a> -->
                                                            <!-- <form action="code.php" method="POST" class="d-inline">
                                                                <button type="submit" name="delete_inventory" value="<?=$row['id'];?>" class="btn btn-danger btn-sm">Delete</button>
                                                            </form> -->
                                                        </td>
                                                    </tr>
                                                    <?php
                                            }

                                            if($counter == 0) {   
                                                echo "<h5> No Record Found </h5>";
                                            }
                                        ?>
                                        
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
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