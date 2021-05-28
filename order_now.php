<?php

session_start();
$_SESSION['cur_amt'] = 0;
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

$sql_for_food = "SELECT * from food WHERE chef_id='$chef_id'";
$result_for_food = mysqli_query($conn, $sql_for_food);
$food = mysqli_fetch_all($result_for_food, MYSQLI_ASSOC);
if ($result_for_food) {
    print_r($food);
} else {
    echo mysqli_error($conn);
}

$meal_options = explode(" ", $chef['meal_option']);
$delivery_options = explode(" ", $chef['delivery_option']);

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
            margin-top: 30vh;
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
    </style>
</head>

<body>

    <header class="order_now_header">
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
    </header>
    <section class="section">
        <div class="row">
            <div class="col s6 m3">
                <!-- <div class="valign-wrapper"> -->
                <div class="card">
                    <div class="card-title orange white-text center">
                        CheckOut
                    </div>
                    <div class="card-content center">
                        <h5>Your Current total</h5>
                        <h4><i class="fas fa-rupee-sign green-text"></i> <?php echo $_SESSION['cur_amt']; ?></h4>
                    </div>
                    <div class="card-action center">
                        <h5><a href="" class="btn orange">Place order</a></h5>
                    </div>
                </div>
                <!-- </div> -->
            </div>
            <div class="col s6 m8">
                <?php foreach ($food as $fd) : ?>
                    <div class="container">
                        <div class="card">
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
                                            <div class="col s3">
                                                <h5>Qty: </h5>
                                            </div>
                                            <div class="col s3">
                                                <input type="number" name="" value='1'>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p><?php echo $fd['food_desc']; ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </section>

</body>

</html>