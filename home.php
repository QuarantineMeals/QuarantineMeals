<?php

include('config/db_connect.php');
session_start();
$_SESSION['cur_amt'] = false;
$_SESSION['list_of_food'] = [];
$user_id = $_SESSION['user_id'];

$sql_uc = "SELECT user_city FROM user WHERE user_id='$user_id'";
$result_uc = mysqli_query($conn, $sql_uc);
$user_city = mysqli_fetch_assoc($result_uc)['user_city'];

$sql = "SELECT * from food WHERE food_city='$user_city' ORDER BY food_name";
$result = mysqli_query($conn, $sql);
$list_of_food = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql_ch = "SELECT * from chef where chef_city='$user_city'";
$result_ch = mysqli_query($conn, $sql_ch);
$chefs = mysqli_fetch_all($result_ch, MYSQLI_ASSOC);

?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quarantine Meals</title>

  <link rel="stylesheet" href="css/user_home.css">
  <!-- Jquery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

  <!-- Slider Scripts -->
  <link type="text/css" rel="stylesheet" href="css/lightslider.css" />
  <script src="js/lightslider.js"></script>

  <!--using FontAwesome--------------->
  <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
  <style>
    .food_img {
      object-fit: cover;
      width: auto;
      height: 30vh !important;
    }

    .chef_img {
      height: 25vh !important;
      object-fit: cover;
    }

    .material-icons {
      display: inline-flex;
      vertical-align: top;
    }

    * {
      scroll-behavior: smooth;
    }

    body{
      background-color: whitesmoke;
    }
  </style>


</head>

<body>
  <header>
    <nav>
      <div class="nav-wrapper ">
        <img src="img/txtlogo.png" class="brand-logo responsive-img" alt="logo">
        <ul class="right valign-wrapper" style="font-family: 'Merienda', cursive;">
          <li><a href="#"><i class="fas fa-map-marker-alt red-text"></i> <?php echo $user_city; ?></a></li>
          <li><a href="#">Home</a></li>
          <li><a href=<?php echo "my_orders.php" ?>>My Orders</a></li>
          <li><a href="#home_chef">Home-Chefs</a></li>
          <li><a href="admin/logout.php">Logout</a></li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- Card Slider Section -->
  <section id="main">
    <h1 class="showcase-heading">See What's Cooking...</h1>
    <ul id="lightSlider">
      <li class="item-a">
        <div class="showcase-box">
          <img src="img/slider-images/slide1.jpeg" />
        </div>
      </li>
      <li class="item-c">
        <div class="showcase-box">
          <img src="img/slider-images/slide2.jpg" />
        </div>
      </li>

      <li class="item-e">
        <div class="showcase-box">
          <img src="img/slider-images/slide3.jpg" />
        </div>
      </li>
      <li class="item-e">
        <div class="showcase-box">
          <img src="img/slider-images/slide4.jpg" />
        </div>
      </li>
      <li class="item-e">
        <div class="showcase-box">
          <img src="img/slider-images/slide5.jpg" />
        </div>
      </li>
      <li class="item-e">
        <div class="showcase-box">
          <img src="img/slider-images/slide6.jpg" />
        </div>
      </li>
      <li class="item-e">
        <div class="showcase-box">
          <img src="img/slider-images/slide7.jpg" />
        </div>
      </li>
    </ul>
  </section>
  <!-- Free Foods -->
  <section id="popular-foods">
    <h3 class="center green-text text-darken-3">Free foods for covid Patients</h3>
    <p class="center">Get nutritious home food from our Homechefs and have a speedy recovery</p>

    <div class="container">
      <div class="row">
        <?php foreach ($list_of_food as $food) : ?>
          <?php if ($food['food_price'] == 0) : ?>
            <div class="col s12 m4">
              <div class="card">
                <div class="card-image">
                  <img class="responsive-img food_img" src=<?php echo "admin/uploads/" . $food['food_img']; ?>>
                </div>
                <div class="card-content">
                  <span class="card-title truncate"><?php echo $food['food_name']; ?></span>
                  <p class="truncate"><?php echo $food['food_desc']; ?></p>
                </div>
                <div class="card-action">
                  <div class="row"><span class="price green-text">FREE</span>
                    <a href=<?php echo "order_now.php?chef_id=" . $food['chef_id'] . '#' . $food['food_id']; ?> class="btn orange right valign-wrapper">Order Now</a>
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
    </div>

  </section>

  <!-- Popular Foods -->
  <section id="popular-foods">
    <h3 class="center">Popular Dishes Of The Month</h3>
    <p class="center">Don't miss out these amazing mouth-watering dishes</p>

    <div class="container">
      <div class="row">
        <?php foreach ($list_of_food as $food) : ?>

          <?php if ($food['food_price'] != 0) : ?>
            <div class="col s12 m4">
              <div class="card">
                <div class="card-image">
                  <img class="responsive-img food_img" src=<?php echo "admin/uploads/" . $food['food_img']; ?>>
                </div>
                <div class="card-content">
                  <span class="card-title truncate"><?php echo $food['food_name']; ?></span>
                  <p class="truncate"><?php echo $food['food_desc']; ?></p>
                </div>
                <div class="card-action">
                  <div class="row"><span class="price">&#8377 <?php echo $food['food_price']; ?></span>
                    <a href=<?php echo "order_now.php?chef_id=" . $food['chef_id'] . '#' . $food['food_id']; ?> class="btn orange right valign-wrapper">Order Now</a>
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
    </div>

  </section>

  <section id="home_chef" class="featuredchefs container">
    <h3 class="center">Featured Home-Chefs</h3>
    <p class="center">See all the Home-Chefs supplying food in your city</p>
    <br>
    <div class="row">
      <?php foreach ($chefs as $chef) : ?>
        <div class="col s12 m6">
          <div class="card">
            <div class="row">
              <div class="col s6">
                <img class='responsive-img chef_img' src=<?php echo "admin/uploads/" . $chef['chef_img'] ?>>
                <br>
                <br>
              </div>
              <div class="col s6">
                <h5 class="truncate"><?php echo $chef['chef_name']; ?></h5>
                <p class="truncate"><?php echo $chef['chef_desc']; ?></p>
                <br>
                <p><i class="fas fa-phone-volume green-text"></i> <?php echo $chef['chef_number']; ?></p>
                <br>
                <p class="">Rating: <i class="fas fa-star yellow-text text-darken-2"></i> 5 </p>
              </div>
            </div>
            <div class="card-action center">
              <a href=<?php echo "order_now.php?chef_id=" . $food['chef_id']; ?> class="btn  orange">About Chef and Food</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>



  <!-- start: FOOTER -->
  <footer class="page-footer grey darken-4">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text"><img src="img/txtlogo.png" class="brand-logo responsive-img" alt="logo" id="logo"></h5>
          <p class="grey-text text-lighten-4">Serving you homemade food during quarantine :)</p>
        </div>
        <div class="col l4 offset-l2 s12">
          <h5 class="white-text">Quarantine Meals</h5>
          <ul>
            <li><a class="grey-text text-lighten-3" href="#whyus">Why Us?</a></li>
            <li><a class="grey-text text-lighten-3" href="#our-chefs">Our Chef Warriors</a></li>
            <li><a class="grey-text text-lighten-3" href="#aboutus">About Us</a></li>
            <li><a class="grey-text text-lighten-3" href="admin/index.php">Login</a></li>
            <li><a class="grey-text text-lighten-3" href="#signin">Sign In</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container center">
        Made with <svg viewBox="0 0 1792 1792" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" style="height: 0.8rem;">
          <path d="M896 1664q-26 0-44-18l-624-602q-10-8-27.5-26T145 952.5 77 855 23.5 734 0 596q0-220 127-344t351-124q62 0 126.5 21.5t120 58T820 276t76 68q36-36 76-68t95.5-68.5 120-58T1314 128q224 0 351 124t127 344q0 221-229 450l-623 600q-18 18-44 18z" fill="#e25555"></path>
        </svg> by <a href="#" style="text-decoration: none;color: white;"><i class="fa fa-github" style="font-size:20px;color:white;"></i> Team Quarantine Meals</a>
      </div>
    </div>
  </footer>
  <!-- end:Footer -->
  <script type="text/javascript">
    $(document).ready(function() {
      $("#lightSlider").lightSlider({
        speed: 300, //ms'
        auto: true,
        loop: true,
        slideEndAnimation: true,
        pause: 2000
      });
    });
  </script>
</body>

</html>