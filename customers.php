<?php
    $page="Orders";
?>
<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
	<title>Customers</title>
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
<body id="site">
    
    <?php
        require 'header.php';
    ?>

    <main>
        <div class="container">
            <h1 class="display-3">Customers</h1>
            <div class="container mt-4">

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
                                            <th>Action(s)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $query = "SELECT `id`, `email`, CONCAT(name, ' ', surname) AS `customer`, 
                                                `dob`, `address`, `mobile`, `isAdmin` 
                                                FROM `users`;";
                                            $counter = 0;
                                            
                                            $stmt = $conn->query($query);
                                            while ($row = $stmt->fetch()){
                                                $counter++;
                                                ?>
                                                    <tr>
                                                        <td><?= $row['id']; ?></td>
                                                        <td><?= $row['customer']; ?> <?= $row['isAdmin'] ? '<span class="badge rounded-pill bg-primary">Admin</span>' : '' ?></td>
                                                        <td><?= $row['email']; ?></td>
                                                        <td><?= $row['dob']; ?></td>
                                                        <td><?= $row['address']; ?></td>
                                                        <td><?= $row['mobile']; ?></td>
                                                        <td>
                                                            <a href="orderHistory.php?id=<?= $row['id']; ?>" class="btn btn-primary btn-sm">View Orders</a>
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
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>E-mail</th>
                                            <th>DOB</th>
                                            <th>Address</th>
                                            <th>Mobile</th>
                                            <th>Action(s)</th>
                                        </tr>
                                        </tfoot>
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
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $( document ).ready(function() {
            $('#customersTable').DataTable( {
                "pageLength": 25
            });
            //new DataTable('#customersTable');
        });
        
    </script>
</body>
</html>	