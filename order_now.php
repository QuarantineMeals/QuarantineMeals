<?php

session_start();
include('config/db_connect.php');

if (isset($_GET['chef_id'])) {
    $chef_id = $_GET['chef_id'];
}

$sql_for_chef = "SELECT * FROM chef WHERE chef_id='$chef_id'";
$result_for_chef = mysqli_query($conn, $sql_for_chef);
$chef = mysqli_fetch_assoc($result_for_chef);
if ($result_for_chef) {
    // print_r($chef);
} else {
    echo mysqli_error($conn);
}

$food = [];
$sql_for_food = "SELECT * from food WHERE chef_id='$chef_id' ORDER BY food_id";
$result_for_food = mysqli_query($conn, $sql_for_food);
$foode = mysqli_fetch_all($result_for_food, MYSQLI_ASSOC);
foreach ($foode as $fe) {
    $food[$fe['food_id']] = $fe;
}

if ($result_for_food) {
    // print_r($food);
} else {
    echo mysqli_error($conn);
}

$meal_options = explode(" ", $chef['meal_option']);
$delivery_options = explode(" ", $chef['delivery_option']);

if (isset($_POST['re-do_total'])) {
    $_SESSION['cur_amt'] = 0;
    $_SESSION['list_of_food'][$_POST['food_id']] = (int)$_POST['food_qty'];
    $food_ids = array_keys($_SESSION['list_of_food']);
    foreach ($food_ids as $ids) {
        $_SESSION['cur_amt'] += $food[$ids]['food_price'] * $_SESSION['list_of_food'][$ids];
    }
}

if (isset($_GET['id_to_del'])) {
    $_SESSION['cur_amt'] = 0;
    $del_id = mysqli_real_escape_string($conn, $_GET['id_to_del']);
    unset($_SESSION['list_of_food'][$del_id]);
    $food_ids = array_keys($_SESSION['list_of_food']);
    foreach ($food_ids as $ids) {
        $_SESSION['cur_amt'] += $food[$ids]['food_price'] * $_SESSION['list_of_food'][$ids];
    }
}

if (isset($_GET['check_out'])) {
    $check_out = mysqli_real_escape_string($conn, $_GET['check_out']);
    if ($check_out) {
        $_SESSION['chef_id'] = $chef_id;
        header('Location: check_out.php');
    } else {
        // header('Location: order_now.php?chef_id=' . $chef_id . '#check_out_error');
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
    <style>
        .order_now_header {
            background: linear-gradient(hsla(0, 0%, 0%, 0.2), hsla(0, 0%, 0%, 0.5)), url('https://d19fbfhz0hcvd2.cloudfront.net/UC/wp-content/uploads/2014/10/Food-photography-eastern-europe-city-illustrations-banner1.jpg');
            background-size: cover;
            height: 100vh;
            width: 100%;
        }

        .chef_img {
            height: 18vmax;
            width: 18vmax;
            object-fit: cover;
            margin-top: 17vh;
            margin-left: 10vw;
            border-radius: 50%;
        }

        .chef_name {
            margin-top: 2vh;
            margin-left: 10vw;
        }

        .section_img {
            object-fit: cover;
            width: 30vmin;
            height: 30vmin !important;
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
        });
    </script>
</head>

<body>
    <header class="order_now_header">
        <!-- ################### nav bar ######################### -->
        <nav>
            <div class="nav-wrapper ">
                <img src="img/txtlogo.png" class="brand-logo responsive-img" alt="logo">
                <ul class="right valign-wrapper" style="font-family: 'Merienda', cursive;">
                    <li><a href="#"><i class="fas fa-map-marker-alt red-text"></i> <?php echo $chef['chef_city']; ?></a></li>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="#">Home-Chefs</a></li>
                    <li><a href="#my_cart">My Cart</a></li>
                    <li><a href="admin/logout.php">Logout</a></li>
                </ul>
            </div>
        </nav>

        <!-- ########################### chef banner ################################# -->
        <div class="row white-text">
            <div class="col s6">
                <img class="chef_img " src="https://images.unsplash.com/photo-1600565193348-f74bd3c7ccdf?ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8Y2hlZnxlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&w=1000&q=80">
            </div>
            <div class="col s6">
                <div class="section">
                    <h5>Meal Options Available: </h5>
                    <?php if (in_array('breakfast', $meal_options)) : ?>
                        <h5><i class="fas fa-check green-text"></i> Breakfast</h5>
                    <?php else : ?>
                        <h5><i class="fas fa-times red-text"></i> Breakfast</h5>
                    <?php endif; ?>
                    <?php if (in_array('lunch', $meal_options)) : ?>
                        <h5><i class="fas fa-check green-text"></i> Lunch</h5>
                    <?php else : ?>
                        <h5><i class="fas fa-times red-text"></i> Lunch</h5>
                    <?php endif; ?>
                    <?php if (in_array('dinner', $meal_options)) : ?>
                        <h5><i class="fas fa-check green-text"></i> Dinner</h5>
                    <?php else : ?>
                        <h5><i class="fas fa-times red-text"></i> Dinner</h5>
                    <?php endif; ?>
                </div>
                <div class="section">
                    <h5>Delivery Options Avaliable:</h5>
                    <?php if (in_array('home_del', $delivery_options)) : ?>
                        <h5><i class="fas fa-check green-text"></i> Home delivery</h5>
                    <?php else : ?>
                        <h5><i class="fas fa-times red-text"></i> Home delivery</h5>
                    <?php endif; ?>
                    <?php if (in_array('self_pick', $delivery_options)) : ?>
                        <h5><i class="fas fa-check green-text"></i> Self Pickup</h5>
                    <?php else : ?>
                        <h5><i class="fas fa-times red-text"></i> Self Pickup</h5>
                    <?php endif; ?>
                </div>

            </div>
        </div>
        <div class="row white-text">
            <div class="col s6">
                <h4 class="chef_name white-text "><?php echo $chef["chef_name"]; ?></h4>
            </div>
            <div class="col s6">
                <h5><i class="fas fa-phone-volume blue-text"></i> Phone number : <?php echo $chef['chef_number']; ?></h5>
            </div>
        </div>
    </header><!-- end of header -->

    <section class="section">

        <!-- #################### checkout Error modal ##################################-->
        <div id="check_out_error" class="modal">
            <div class="modal-content">
                <h4 class="orange-text">Cart Empty!!</h4>
                <p>Please add some items into your cart inorder to proceed!</p>
            </div>
            <div class="modal-footer">
                <div class="center">
                    <a href="#" class="modal-close btn orange">Okay</a>
                </div>
            </div>
        </div>

        <!-- ###################### Cart ################################## -->
        <div id="my_cart" class="row">
            <div class="col s12 m3" style="margin-top:20vh;">
                <div class="card ">
                    <div class="card-title orange white-text center">Your Cart</div>
                    <div class="card-content center">
                        <?php
                        if ($_SESSION['cur_amt'] == false) {
                            echo "<h5> Your cart is empty! </h5>";
                        } else {
                            echo "<h5> Your Food :  </h5>";
                            foreach (array_keys($_SESSION['list_of_food']) as $fod) : ?>
                                <?php
                                foreach ($food as $fod1) {
                                    if ($fod1['food_id'] == $fod) { ?>
                                        <h6><?php echo $fod1['food_name'] . " - " . $_SESSION['list_of_food'][$fod] . " (&#8377;" . $food[$fod]['food_price'] * $_SESSION['list_of_food'][$fod] . ")"; ?> <a href=<?php echo "order_now.php?chef_id=" . $chef_id . "&id_to_del=" . $fod . "#my_cart" ?>><i class="far fa-trash-alt red-text"></i></a></h6>
                                <?php
                                        break;
                                    }
                                }
                                ?>

                        <?php endforeach;
                        }
                        ?>
                        <h5>Your Current total</h5>
                        <h4><i class="fas fa-rupee-sign green-text"></i> <?php echo $_SESSION['cur_amt']; ?></h4>
                    </div>
                    <div class="card-action center">
                        <?php if (count($_SESSION['list_of_food'])) : ?>
                            <h5><a href=<?php echo "order_now.php?chef_id=" . $chef_id . "&check_out=" . count($_SESSION['list_of_food']); ?> class="btn orange">Place order</a></h5>
                        <?php else : ?>
                            <h5><a href="#check_out_error" class="modal-trigger btn orange">Place order</a></h5>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- ############################### list of Foods ############################ -->
            <div class="col s12 m8">
                <?php foreach ($food as $fd) : ?>
                    <div class="container">
                        <form action=<?php echo "order_now.php?chef_id=" . $chef_id . "#my_cart" ?> method="POST">
                            <div class="card" id=<?php echo $fd['food_id']; ?>>
                                <h5 class="center orange white-text"><?php echo strtoupper($fd['food_name']); ?></h5>
                                <div class="card-content">
                                    <div class="row">
                                        <div class="col s6">
                                            <img class="section_img" src=<?php echo "admin/uploads/" . $fd['food_img']; ?> alt=<?php echo $fd['food_name']; ?>>
                                        </div>
                                        <div class="col s6">
                                            <div class="row">
                                                <div class="col s12">
                                                    <h5><i class="fas fa-rupee-sign green-text"></i> <?php echo $fd['food_price']; ?></h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col s6">
                                                    <h5>Qty: </h5>
                                                </div>
                                                <div class="col s6">
                                                    <?php
                                                    if (array_key_exists($fd['food_id'], $_SESSION['list_of_food'])) {
                                                        $value = $_SESSION['list_of_food'][$fd['food_id']];
                                                    } else {
                                                        $value = 0;
                                                    }
                                                    ?>
                                                    <input type="hidden" name="food_id" value=<?php echo $fd['food_id']; ?>>
                                                    <input type="hidden" name="food_price" value=<?php echo $fd['food_price']; ?>>
                                                    <input type="number" min='0' name="food_qty" value=<?php echo $value ?>>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p><?php echo $fd['food_desc']; ?></p>
                                </div>
                                <div class="card-action center">
                                    <input type="submit" name="re-do_total" value="Add to cart" class="btn orange">
                                </div>
                            </div>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </section>

</body>

</html>