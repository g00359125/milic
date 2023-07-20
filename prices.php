<?php
    $page="Prices";
?>
<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
	<title>Prices</title>
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
            <h1 class="display-3">Prices</h1>
        </div>
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
                                            <th>Product Name</th>
                                            <th>Product Volume</th>
                                            <th>Product Year</th>
                                            <th>Price</th>
                                            <th>Created Price</th>
                                            <th>Created By</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $query = "SELECT * FROM `prices_view`";
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
                                                        <td><?= $row['product_id']; ?></td>
                                                        <td><?= $row['name']; ?></td>
                                                        <td><?= $row['volume']; ?></td>
                                                        <td><?= $row['year']; ?></td>
                                                        <td><?= $row['price_eur']; ?></td>
                                                        <td><?= $row['price_created']; ?></td>
                                                        <td><?= $row['user']; ?></td>
                                                        <td>
                                                            <a href="prices-view.php?id=<?= $row['product_id']; ?>" class="btn btn-info btn-sm">View</a>
                                                            <!-- <a href="inventory-edit.php?id=<?= $row['product_id']; ?>" class="btn btn-success btn-sm">Edit</a> -->
                                                            <!-- <form action="code.php" method="POST" class="d-inline">
                                                                <button type="submit" name="delete_inventory" value="<?=$row['product_id'];?>" class="btn btn-danger btn-sm">Delete</button>
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