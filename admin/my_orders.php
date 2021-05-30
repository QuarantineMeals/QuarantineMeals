<?php

include('../config/db_connect.php');
session_start();
$chef_id = $_SESSION['chef_id'];

$sql_o = "SELECT * FROM orders where chef_id='$chef_id'";
$result_o = mysqli_query($conn, $sql_o);
$orders = mysqli_fetch_all($result_o, MYSQLI_ASSOC);

if (isset($_POST['submit'])) {
    $food_status = $_POST['food_status'];
    $cur_order_id = $_POST['order_id'];
    $cur_food_status = "";
    if ($food_status == 1) {
        $cur_food_status = "Yet to be packed";
    } elseif ($food_status == 2) {
        $cur_food_status = "dispatched";
    } else {
        $cur_food_status = "Delivered";
    }
    $sql_u = "UPDATE orders SET status='$cur_food_status' WHERE order_id='$cur_order_id'";
    if (mysqli_query($conn, $sql_u)) {
        // echo "Updated";
        header('Location: my_orders.php');
    } else {
        echo mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quaranine Meals</title>
    <!--jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <!--using FontAwesome--------------->
    <style>
        table.striped>tbody>tr:nth-child(even) {
            background-color: hsl(36, 100%, 70%);
        }

        table.striped>tbody>tr:nth-child(odd) {
            background-color: white;
        }

        table {
            border-spacing: 1px;
            border-collapse: separate;
        }

        td,
        th {
            text-align: left;
            max-width: 20vw;
        }

        .side-margin {
            margin-left: 2vw;
            margin-right: 2vw;
        }

        .status-row {
            width: 12vw;
        }

        .dropdown-content li>a,
        .dropdown-content li>span {
            color: orange;
            font-size: 1rem;
        }

        nav {
            z-index: 99999;
            width: 100%;
            background-color: #000 !important;
        }

        .brand-logo {
            max-height: 100%;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('.modal').modal();
            $('select').formSelect();
        });
    </script>
</head>

<body>
    <header>
        <nav>
            <div class="nav-wrapper">
                <img class="brand-logo" src="../img/txtlogo.png" alt="Quarantine Meals">
                <ul class="right" style="font-family: 'Merienda', cursive;">
                    <li><a href="dashboard.php">Back</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- ################################## table ############### -->
    <div class="section">
        <div class="side-margin z-depth-3">
            <form action="my_orders.php" method="POST">
                <?php $count = 1 ?>
                <table class="striped responsive-table">
                    <thead>
                        <tr class="orange white-text">
                            <th>Serial No</th>
                            <th>Order id</th>
                            <th>Foods</th>
                            <th>Total Price</th>
                            <th>status</th>
                            <th>Modified at</th>
                            <th>Details</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $row) : ?>
                            <?php $order_id = $row['order_id'];
                            $foods = $row['foods'];
                            $quantity = $row['qunatity'];
                            $price = $row['total_amt'];
                            $status = $row['status'];
                            $created_at = $row['created_at'] ?>
                            <tr>
                                <th><?php echo $count++ ?></th>
                                <th><?php echo $order_id; ?></th>
                                <th class="truncate"><?php echo $foods; ?></th>
                                <th>&#8377; <?php echo $price; ?></th>
                                <th class="status-row">
                                    <div class="input-field col s12">
                                        <select name="food_status" id="food_status">
                                            <option value="" disabled selected><?php echo $status ?></option>
                                            <option value="1">Yet to be cooked</option>
                                            <option value="2">dispatched</option>
                                            <option value="3">Delivered</option>
                                        </select>
                                    </div>
                                </th>
                                <th><?php echo $created_at; ?></th>
                                <th><a href=<?php echo '#' . $order_id ?> class="btn-small modal-trigger orange">click</a></th>

                                <th>
                                    <input type="submit" value="Update" name="submit" class="green btn-small">
                                    <input type="hidden" name="order_id" value=<?php echo $order_id ?>>
                                </th>

                                <div id=<?php echo $order_id ?> class="modal">
                                    <?php
                                    $sql_u = "SELECT user_number, user_address FROM user where user_id='$row[user_id]'";
                                    $result_u = mysqli_query($conn, $sql_u);
                                    if ($result_u) {
                                        $user = mysqli_fetch_array($result_u);
                                    } else {
                                        echo mysqli_error($conn);
                                    }
                                    ?>
                                    <div class="modal-content">
                                        <div class="center">
                                            <h4 class="orange-text">Order Details</h4>
                                        </div>
                                        <p>Order Id : <?php echo $order_id ?></p>
                                        <p>Foods ordered</p>
                                        <ol>
                                            <?php $list_of_foods = explode(', ', $foods);
                                            $quantity_f_foods = explode(' ', $quantity);
                                            ?>
                                            <?php for ($i = 0; $i < count($list_of_foods); $i++) : ?>
                                                <li><?php echo $list_of_foods[$i] . " ( " . $quantity_f_foods[$i] . " )" ?></li>
                                            <?php endfor; ?>
                                        </ol>
                                        <p>Grand total : &#8377; <?php echo $price; ?></p>
                                        <p>Status : <?php echo $status; ?></p>
                                        <p>Last modification on : <?php echo $created_at; ?></p>
                                        <p>Address : <?php echo $user['user_address']; ?></p>
                                        <p>Phone : <?php echo $user['user_number']; ?></p>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="#!" class="modal-close orange btn">Okay</a>
                                    </div>
                                </div>
                            </tr>


                        <?php endforeach; ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>

</body>

</html>