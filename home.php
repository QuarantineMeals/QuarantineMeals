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
          <li><a href=<?php echo "my_orders.php"?>>My Orders</a></li>
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
          <img src="https://drivetribe.imgix.net/fvzJ72EzQ3mdKF3wsAVkqA?w=1200&h=675&fm=jpe&auto=compress&fit=crop&crop=faces" />
        </div>
      </li>
      <li class="item-b">
        <div class="showcase-box">
          <img src="https://anitahendrieka.com/wp-content/uploads/2019/05/indian-sweet-371357_1280.jpg" />
        </div>
      </li>
      <li class="item-c">
        <div class="showcase-box">
          <img src="https://miro.medium.com/max/2048/1*4FK_k898oPwKQT0uCwwkIw.jpeg" />
        </div>
      </li>
      <li class="item-d">
        <div class="showcase-box">
          <img src="https://i.ytimg.com/vi/pGiFN0Se0C8/maxresdefault.jpg" />
        </div>
      </li>
      <li class="item-e">
        <div class="showcase-box">
          <img src="https://i.pinimg.com/originals/2d/47/55/2d4755077b1c7d3d583e0b36bc772185.jpg" />
        </div>
      </li>
    </ul>
  </section>

  <!-- Popular Foods -->
  <section id="popular-foods">
    <h3 class="center">Popular Dishes Of The Month</h3>
    <p class="center">Don't miss out these amazing mouth-watering dishes</p>

    <div class="container">
      <div class="row">
        <?php foreach ($list_of_food as $food) : ?>

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
                <img class='responsive-img chef_img' src="https://st3.depositphotos.com/1037987/15097/i/600/depositphotos_150975580-stock-photo-portrait-of-businesswoman-in-office.jpg">
                <br>
                <br>
                <p class="center">Rating: <i class="fas fa-star yellow-text text-darken-2"></i> 5 </p>
              </div>
              <div class="col s6">
                <h5 class="truncate"><?php echo $chef['chef_name']; ?></h5>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Perspiciatis ea iste dicta?</p>
                <br>
                <p><i class="fas fa-phone-volume green-text"></i> <?php echo $chef['chef_number']; ?></p>
              </div>
            </div>
            <div class="card-action center">
              <a href=<?php echo "order_now.php?chef_id=" . $food['chef_id']; ?> class="btn  orange">About his/her food</a>
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
          <h5 class="white-text">Footer Content</h5>
          <p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer content.</p>
        </div>
        <div class="col l4 offset-l2 s12">
          <h5 class="white-text">Links</h5>
          <ul>
            <li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
            <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
            <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
            <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
        © 2014 Copyright Text
        <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
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