<?php
    $page="Order History";
    session_start();
	require 'database.php';
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
            <?php
                if( !isset($_SESSION['user_id']) ){
                    echo '<h1 class="display-3">Forbidden Access. Please login.</h1>';
                    $_SESSION['alert'] = "Forbidden Access. Please login.";
                    $_SESSION['alert_style'] = "danger";
                } else {
            ?>
            <h1 class="display-3"><?=$page?>
            <?php
                if($user['isAdmin'] && isset($_GET['user_id'])) {
                    echo ' for customer: '.$_GET['user_id'];
                } 
            ?>
            </h1>

            <?php include('alert.php'); ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="ordersTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
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
                                            FROM `orders` JOIN users ON orders.user_id = users.id 
                                            WHERE user_id = :userId;";
                                        // $query = "SELECT * FROM orders;";
                                        $records = $conn->prepare($query);
                                        if($user['isAdmin'] && isset($_GET['user_id'])) {
                                            $records->bindParam(':userId', $_GET['user_id']);
                                        } else {
                                            $records->bindParam(':userId', $_SESSION['user_id']);
                                        }
                                        $records->execute();

                                        while ($row = $records->fetch()){
                                    ?>
                                    <tr>
                                        <td><?= $row['id']; ?></td>
                                        <td><?= $row['customer']; ?></td>
                                        <td><?= $row['order_time']; ?></td>
                                        <td><?= $row['order_total']; ?></td>
                                        <td><?= $row['status']; ?></td>
                                        <td><?= $row['delivery_time']; ?></td>
                                        <td>
                                            <a href="orderHistory.php?action=view&id=<?= $row['id']; ?>" class="btn btn-primary btn-sm">View</a>
                                        </td>
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
        // check if edit is requested and get order
        $show = '';
        if( isset($_GET['action']) && $_GET['action'] == 'view' && isset($_GET['id'])){
            $sql = "SELECT *	 
                    FROM orders 
                    JOIN users ON orders.user_id = users.id 
                    WHERE orders.id = :orderId;";
            $stmn = $conn->prepare($sql);
            $stmn->bindParam(':orderId', $_GET['id']);
            $stmn->execute();
            $order = $stmn->fetch();
            $show = 'show';
    ?>

    <!-- Edit Order Modal Start -->
    <div class="modal fade <?= $show ?>" tabindex="-1" id="editOrderModal" data-bs-config={backdrop:true}>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form href="orders.php?action=edit" method="post" id="edit-order-form" class="p-2" novalidate>
                    <div class="modal-header">
                        <h5 class="modal-title">Order #<?= $_GET['id']?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Customer input -->
                                <div class="form-floating mb-4">
                                    <input type="text" id="customer" name="customer" class="form-control" placeholder="Customer name" value="<?= $order['name'] ?> <?= $order['surname'] ?>" required readonly/>
                                    <label class="form-label" for="customer">Customer</label>
                                    <div class="invalid-feedback">Please provide customer name.</div>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Order Time input -->
                                <div class="form-floating mb-4">
                                    <input type="text" id="order_time" name="order_time" class="form-control" placeholder="Order time" value="<?= $order['order_time'] ?>" required readonly/>
                                    <label class="form-label" for="order_time">Order time</label>
                                    <div class="invalid-feedback">Please provide time of order.</div>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Total input -->
                                <div class="form-floating mb-4">
                                    <input type="text" id="total" name="total" class="form-control" placeholder="total" value="<?= $order['order_total'] ?>" required readonly/>
                                    <label class="form-label" for="total">Total</label>
                                    <div class="invalid-feedback">Please provide total for order.</div>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Status input -->
                                <div class="form-floating mb-4">
                                    <select class="form-select" id="status" name="status" <?= $user['isAdmin'] ? '' : 'disabled'?>>
                                        <option value="CREATED"   <?= ($order['status'] == 'CREATED')   ? 'selected' : '' ?>>CREATED</option>
                                        <option value="PROCESSED" <?= ($order['status'] == 'PROCESSED') ? 'selected' : '' ?>>PROCESSED</option>
                                        <option value="DELIVERED" <?= ($order['status'] == 'DELIVERED') ? 'selected' : '' ?>>DELIVERED</option>
                                        <option value="CANCELLED" <?= ($order['status'] == 'CANCELLED') ? 'selected' : '' ?>>CANCELLED</option>
                                    </select>
                                    <label class="form-label" for="status">Status</label>
                                    <div class="invalid-feedback">Please provide order status.</div>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Delivery Time input -->
                                <div class="form-floating mb-4">
                                    <input type="datetime-local" id="delivery_time" name="delivery_time" class="form-control" placeholder="Delivery time" value="<?= $order['delivery_time'] ?>" required <?= $user['isAdmin'] ? '' : 'readonly' ?> />
                                    <label class="form-label" for="delivery_time">Delivery time</label>
                                    <div class="invalid-feedback">Please provide time of order.</div>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Discount input -->
                                <div class="form-floating mb-4">
                                    <input type="text" id="discount" name="discount" class="form-control" placeholder="Discount" value="<?= $order['discount'] ?>" readonly/>
                                    <label class="form-label" for="discount">Discount (%)</label>
                                    <div class="invalid-feedback">Please provide order discount.</div>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Order Details Table -->
                            <div class="form-floating mb-4">
                                <h5>Order Details</h5>
                                <table id="orderDetailsTable" class="table">
                                    <thead>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>ABV</th>
                                        <th>Vol</th>
                                        <th>Year</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                    </thead>
                                    <tbody>

                        <?php
                        // check if edit is requested and get order details
                        if( isset($_GET['action']) && $_GET['action'] == 'view' && isset($_GET['id'])){
                            $sql = "SELECT order_details.product_id,  
                                            order_details.qty,
                                            order_details.unit_price,
                                            products.name_en,
                                            products.abv,
                                            products.volume,
                                            products.year
                                    FROM order_details 
                                    JOIN products ON order_details.product_id = products.id 
                                    WHERE order_details.order_id = :orderId;";
                            $order_details = $conn->prepare($sql);
                            $order_details->bindParam(':orderId', $_GET['id']);
                            $order_details->execute();
                            while ($row = $order_details->fetch()){
                                echo '<tr>';
                                echo '  <td>'.$row['product_id'].'</td>';
                                echo '  <td>'.$row['name_en'].'</td>';
                                echo '  <td>'.$row['abv'].'</td>';
                                echo '  <td>'.$row['volume'].'</td>';
                                echo '  <td>'.$row['year'].'</td>';
                                echo '  <td>'.$row['unit_price'].'</td>';
                                echo '  <td>'.$row['qty'].'</td>';
                                echo '</tr>';
                            }
                        
                        }
                        ?>  
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="mb-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                        <?php 
                        if($user['isAdmin']) {
                            echo '<div class="mb-3">';
                            echo '  <input type="submit" value="Update Order" class="btn btn-secondary" id="edit-user-btn">';
                            echo '</div>';
                        }
                        ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Order Modal End -->

    <?php
        }

        require 'footer.php';
    ?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
	<script src="https://kit.fontawesome.com/a6efd8a22c.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $( document ).ready(function() {
            $('#ordersTable').DataTable( {
                "pageLength": 25,
                "order": [[2, 'desc']]
            });

            <?php 
            if ($show == 'show') {
                echo '(new bootstrap.Modal(document.getElementById("editOrderModal"))).show()';
            }  
            ?>
        });
    </script>
</body>
</html>	