<?php


?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuarantineMeals</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.dropdown-trigger').dropdown({
                coverTrigger: false
            });
            
        });
    </script>
</head>

<body>
    <header id="index-header">
        <nav>
            <div class="nav-wrapper">
                <img src="img/txtlogo.png" class="brand-logo responsive-img" alt="logo" id="logo">
                <ul class="right valign-wrapper">
                    <li><a href="#">Covid - 19</a></li>
                    <li><a href="#">Our Chefs</a></li>
                    <li><a href="admin/index.php">Login</a></li>
                    <li><a class='dropdown-trigger' href='#' data-target='dropdown1'>Sign In</a>
                        <ul id='dropdown1' class='dropdown-content mild-transparent'>
                            <li><a href="admin/chef_reg.php" class="white-text drop-hover">Chef</a></li>
                            <li><a href="user_reg.php" class="white-text drop-hover">User</a></li>
                        </ul>
                    </li>
                    <li><a href="#">About Us</a></li>
                </ul>
            </div>
        </nav>


        <div class="index-container left">
            Need comforting home-cooked foods during this covid time?<br>
            Our chefs provide just that.<br><br>

            Find the best foods that carries the taste of home <br>
            @ free of cost / affordable prices
        </div>
    </header>

    <section class="why-us-section">
        <h1>Why Quarantine Meals?</h1>
        <div class="why-us">
            <div class="card z-depth-0">
                <img src="img/why-us/wholesome icon-min.png" alt="img">
                <h3>Wholesome and Healthy</h3>
                <p>We take utmost care in ensuring that every meal is devoid of nasty preservatives, food colourants, or additives and each meal is nutrient dense and seasoned with love and care.</p>
            </div>
            <div class="card z-depth-0">
                <img src="img/why-us/chef cooking icon-min.png" alt="img">
                <h3>Homemade by homechefs</h3>
                <p>Quarantine Meals takes pride in empowering local home-chefs by helping them showcase their culinary skills. So, every meal you buy at Quarantine Meals, results in the upliftment of a home-chef. </p>
            </div>
            <div class="card z-depth-0">
                <img src="img/why-us/one stop shop icon-min.png" alt="img">
                <h3>One-stop shop</h3>
                <p>Whether you are craving for a homemade delicacy or a simple home cooked meal, you can always count on us for all your food-related needs, from breakfast to dinner.</p>
            </div>
            <div class="card z-depth-0">
                <img src="img/why-us/stress free icon-min.png" alt="img">
                <h3>Stress Free Experience</h3>
                <p>Bid goodbye to the hassle of planning what to cook, where to buy groceries from, or figuring out a healthy recipe on a busy day - as Quarantine Meals has got it all covered.</p>
            </div>
            <div class="card z-depth-0">
                <img src="img/why-us/diverseanddelightfulicon-min.png" alt="img">
                <h3>Diverse and delightful</h3>
                <p>From everyday meals, delectable biryanis, exclusive treats for special occasions, to an extensive range of baked goods and essential condiments - Quarantine Meals has ticked all the boxes.</p>
            </div>
            <div class="card z-depth-0">
                <img src="img/why-us/delivery icon-min.png" alt="img">
                <h3>Diligent Delivery</h3>
                <p>Our Home Chefs and their delivery partners are highly efficient in ensuring that your food reaches your doorstep in the safest and most hassle free way possible.</p>
            </div>
        </div>
    </section>
</body>

</html>