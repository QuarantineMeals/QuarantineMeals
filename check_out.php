<?php
// header( "refresh:5;url=wherever.php" );
include('config/db_connect.php');
session_start();
$msg1 = "";
$chef_id = $_SESSION['chef_id'];
$user_id = $_SESSION['user_id'];
$food = array_keys($_SESSION['list_of_food']);
ksort($_SESSION['list_of_food']);
$foodi = implode(',', $food);
$sql_ff = "SELECT food_name FROM food where FIND_IN_SET(food_id,'$foodi') ORDER BY food_id";
$result = mysqli_query($conn, $sql_ff);
$foods = "";
$qunatity = implode(' ', $_SESSION['list_of_food']);
while ($row = mysqli_fetch_array($result)) {
    $foods .= $row[0] . ", ";
}

$foods = substr($foods, 0, -2);

if ($result) {
    // print_r($foods);
} else {
    echo mysqli_error($conn);
}
if (isset($_POST['place_order'])) {
    $sql = "INSERT INTO orders(chef_id,user_id,total_amt,foods,qunatity,status) VALUES ('$chef_id','$user_id','$_SESSION[cur_amt]','$foods','$qunatity','Yet to be packed')";
    if (mysqli_query($conn, $sql)) {
        $msg1 = "yes";
        header("refresh:5;url=home.php");
    } else {
        $msg1 =  "no";
        header("refresh:5;url=home.php");
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
        nav {
            z-index: 99999;
            width: 100%;
            background-color: #000 !important;
        }

        .brand-logo {
            max-height: 100%;
        }

        #title {
            padding: 5vmin 1vmin;
        }

        [type="radio"]:checked+span:after,
        [type="radio"].with-gap:checked+span:before,
        [type="radio"].with-gap:checked+span:after {
            border: 2px solid orange;
        }

        [type="radio"]:checked+span:after,
        [type="radio"].with-gap:checked+span:after {
            background-color: orange;
        }
    </style>
    <script>
        var timeleft = 5;
        var downloadTimer = setInterval(function() {
            if (timeleft <= 0) {
                clearInterval(downloadTimer);
                document.getElementById("countdown").innerHTML = "Finished";
            } else {
                document.getElementById("countdown").innerHTML = timeleft + " seconds remaining";
            }
            timeleft -= 1;
        }, 1000);
    </script>

</head>

<body>
    <header>
        <!-- ################### nav bar ######################### -->
        <nav>
            <div class="nav-wrapper ">
                <img src="img/txtlogo.png" class="brand-logo responsive-img" alt="logo">
                <ul class="right valign-wrapper" style="font-family: 'Merienda', cursive;">
                    <li><a href="home.php">Home</a></li>
                    <li><a href=<?php echo "order_now.php?chef_id=" . $chef_id ?>>Back to order page</a></li>
                    <li><a href="admin/logout.php">Logout</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <section class="section">
        <div class="container z-depth-3 center">
            <?php if ($msg1 == "yes") : ?>
                <h3 class="orange-text section">Order placed successfully!</h3>
                <h6 class="red-text section">You will be automatically redirected to the home page in <span id="countdown"></span></h6>
                <h4 class="section blue-text">Thank you for using Quaratine Meals</h4>
            <?php elseif ($msg1 == "no") : ?>
                <h3 class="orange-text section">Some error occured</h3>
                <h5>Please try after sometime</h5>
                <h6 class="red-text section">You will be automatically redirected to the home page in <span id="countdown"></span></h6>
                <h4 class="blue-text section">Thank you for using Quaratine Meals</h4>
            <?php else : ?>
                <h4 class="section orange-text" id="title">Payment and Order placement</h4>
                <h5>Total payable amount : </h5>
                <h5><i class="fas fa-rupee-sign green-text"></i> <?php echo $_SESSION['cur_amt'] ?> (incl of all taxes)</h5>
                <form action="check_out.php" method="POST" class="section left-align" style="padding-left:20px;">
                    <p>
                        <label>
                            <input type="radio" name="cod" class="with-gap orange-text" checked>
                            <span class="black-text">Cash on Delivery <i class="fas fa-money-check green-text"></i></span>
                        </label>
                    </p>

                    <p>
                        <label>
                            <input name="cod" type="radio" disabled>
                            <span class="black-text">Online payment <i class="fab fa-cc-mastercard orange-text"></i> <i class="fab fa-cc-visa red-text"></i> <i class="fas fa-credit-card blue-text"></i> <i class="fab fa-amazon-pay yellow-text text-darken-4"></i> <i class="fab fa-google-pay blue-text"></i> <i class="fab fa-cc-apple-pay black-text"></i></span>
                        </label>
                    <p class="red-text">
                        Due to Some technical issues, our online payment mode has been temporarily down <br>
                        Sorry for the inconvinience!
                    </p>
                    </p>
                    <div class="center">
                        <input type="submit" value="place Order" name="place_order" class="btn orange">
                    </div>
                </form>
            <?php endif; ?>
        </div>

    </section>
</body>

</html>