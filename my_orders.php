<?php

include('config/db_connect.php');

session_start();
$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM orders WHERE user_id='$user_id'";
$result = mysqli_query($conn, $sql);
$orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
$order_id_array = array();
foreach ($orders as $o) {
    $order_id_array[] = $o['order_id'];
}
if (isset($_GET['cancel_id'])) {
    $cancel_id = mysqli_real_escape_string($conn, $_GET['cancel_id']);
    $sql_c = "DELETE from orders where order_id='$cancel_id'";
    if (mysqli_query($conn, $sql_c)) {
        //success
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
    <title>Quarantine Meals</title>
    <!--jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <!--using FontAwesome--------------->
    <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('.modal').modal();
            var order_ids = <?php echo json_encode($order_id_array); ?>;
            $.each(order_ids, function(index, item) {
                $("#yes_" + item).hide();
                $("#no_" + item).hide();
                $('#enjoy_yes_' + item).click(function() {
                    $('#yes_' + item).show();
                    $("#temp1_" + item).hide();
                });
                $('#enjoy_no_' + item).click(function() {
                    $('#no_' + item).show();
                    $("#temp1_" + item).hide();
                });
            });
        });
    </script>
    <style>
        nav {
            z-index: 99999;
            width: 100%;
            background-color: #000 !important;
        }

        .brand-logo {
            max-height: 100%;
        }

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

        .btn-flat:hover {
            background-color: hsl(0, 100%, 70%);
        }

    </style>
</head>

<body>
    <!-- ################### nav bar ######################### -->
    <nav>
        <div class="nav-wrapper ">
            <img src="img/txtlogo.png" class="brand-logo responsive-img" alt="logo">
            <ul class="right valign-wrapper" style="font-family: 'Merienda', cursive;">
                <li><a href="home.php">Home</a></li>
                <li><a href="admin/logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>

    <!-- ################################## table ############### -->
    <div class="section">
        <div class="container z-depth-3">
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
                            <?php if ($status == "Delivered") : ?>
                                <th class="green-text text-darken-3"><?php echo $status; ?></th>
                            <?php else : ?>
                                <th><?php echo $status; ?></th>
                            <?php endif; ?>
                            <th><?php echo $created_at; ?></th>
                            <th><a href=<?php echo '#' . $order_id ?> class="btn-small modal-trigger orange">click</a></th>
                            <?php if ($status == "Yet to be packed") : ?>
                                <th><a href=<?php echo "my_orders.php?cancel_id=" . $order_id ?> class="red-text white btn-small">Cancel</a></th>
                            <?php else : ?>
                                <th><a href="" class="red-text disabled white btn-small">Cancel</a></th>
                            <?php endif; ?>
                            <div id=<?php echo $order_id ?> class="modal">
                                <div class="modal-content">
                                    <div class="center">
                                        <h4 class="orange-text">Your Order Details</h4>
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
                                    <?php if ($status == "Delivered") : ?>
                                        <div id=<?php echo "temp1_" . $order_id ?>>
                                            <h5>Have you enjoyed your meals?</h5>
                                            <span id=<?php echo "enjoy_no_" . $order_id ?> class="btn-small btn-flat">No</span>
                                            <span href="" id=<?php echo "enjoy_yes_" . $order_id ?> class="btn-small green">Yes</span>
                                        </div>
                                        <div id=<?php echo "yes_" . $order_id ?>>
                                            <div class="section green-text">
                                                <h4>Thank you for using Quarantine Meals!</h4>
                                                <h4>We're happy to hear that!</h4>
                                            </div>
                                        </div>
                                        <div id=<?php echo "no_" . $order_id ?>>
                                            <div class="section orange-text">
                                                <h4>We'll try to improve user experience!</h4>
                                                <h4>We're sorry to hear about that!</h4>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="modal-footer">
                                    <a href="#!" class="modal-close orange btn">Okay</a>
                                </div>
                            </div>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- <script>
        window.onload = function(){
            var order_ids = ;
            for (var i = 0; i < order_ids.length; i++) {
                document.getElementById("yes_" + order_ids[i]).style.display = "block" ? 'none' : 'none';
                console.log("yes_" + order_ids[i]);
            }
        }
    </script> -->

</body>

</html>