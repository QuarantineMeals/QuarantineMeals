<?php

include('config/db_connect.php');
session_start();
session_destroy();

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuarantineMeals</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="index.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script>
        $(document).ready(function() {
            $('.dropdown-trigger').dropdown({
                coverTrigger: false
            });

        });
    </script>
    <style>
        * {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body>
    <header id="index-header">
        <nav>
            <div class="nav-wrapper">
                <img src="img/txtlogo.png" class="brand-logo responsive-img" alt="logo" id="logo">
                <ul class="right valign-wrapper">
                    <li><a href="#">Home</a></li>
                    <li><a href="#whyus">Why Us?</a></li>
                    <li><a href="#our-chefs">Our Chef Warriors</a></li>
                    <li><a href="#aboutus">About Us</a></li>
                    <li><a href="admin/index.php">Login</a></li>
                    <li><a class='dropdown-trigger' href='#' data-target='dropdown1' id="signin">Sign up</a>
                        <ul id='dropdown1' class='dropdown-content mild-transparent'>
                            <li><a href="admin/chef_reg.php" class="white-text drop-hover">Chef</a></li>
                            <li><a href="user_reg.php" class="white-text drop-hover">User</a></li>
                        </ul>
                    </li>

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

    <section class="why-us-section" id="whyus">
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

    <div class="parallax-container">
        <div class="parallax"><img src="img/parallaximg.jpg">

        </div>
    </div>

    <section id="our-chefs">
        <h1>Meet some of the Covid-19 Chef Warriors</h1>
        <div class="row">
            <p class="our-chefs-intro"> When Deepika Venkatachalam, a speech pathology student, posted a note on Instagram about her willingness to provide food to ‘home alone’ quarantined people living in and around Besant Nagar, many got on board, showing similar intent. In a matter of days, a community was formed, distributing home-cooked food in their respective areas. </p>
            <div class="col s6">
                <img src="img/warriors/quote1.png" class="quote1">

            </div>
            <div class="col s6">
                <img src="img/warriors/deepika.jpg" class="chef-img">
            </div>
            <p class="our-chefs-intro" style="margin-top:35%;"> One of the delivery volunteers, Y Anusha, a bank employee living in Mylapore, chips in, </p>
            <div class="col s6">
                <img src="img/warriors/anusha.jpg" class="quote1">

            </div>
            <div class="col s6">
                <img src="img/warriors/quote2.png" class="quote1">
            </div>
            <p class="our-chefs-intro" style="margin-top:35%;"> Another group that has been serving food to needy COVID-19 patients is Mission Upkhar.The team has been sharing details about their work on all social media platforms and messaging services. </p>
            <div class="col s6">
                <img src="img/warriors/quote3.png" class="quote1">

            </div>
            <div class="col s6">
                <img src="img/warriors/chef3.jpg" class="quote1">
            </div>
        </div>
    </section>

    <section id="testimonials">
        <div class="slider">
            <ul class="slides">
                <li>
                    <img src="img/foodbg.jpg"> <!-- random image -->
                    <div class="caption center-align">
                        <i class="large material-icons">account_circle </i>
                        <h3>Sai Charan</h3>
                        <h5 class="light grey-text text-lighten-3">Enjoyed the food was very tasty and felt good after having it...home food cooked safe and served with love</h5>
                    </div>
                </li>
                <li>
                    <img src="img/foodbg.jpg"> <!-- random image -->
                    <div class="caption center-align">
                        <i class="large material-icons">account_circle </i>
                        <h3>Bindu G</h3>
                        <h5 class="light grey-text text-lighten-3">Timely delivery. Very tasty and homely food. Excellent Quarantine Meals!!!</h5>
                    </div>
                </li>
                <li>
                    <img src="img/foodbg.jpg"> <!-- random image -->
                    <div class="caption center-align">
                        <i class="large material-icons">account_circle </i>
                        <h3>Aishwarya Kathir</h3>
                        <h5 class="light grey-text text-lighten-3">Awesome home made food. Have ordered multiple times and there has been no compromise on taste and good varieties for people who would want to have it everyday.</h5>
                    </div>
                </li>
                <li>
                    <img src="img/foodbg.jpg"> <!-- random image -->
                    <div class="caption center-align">
                        <i class="large material-icons">account_circle </i>
                        <h3>Sanjana</h3>
                        <h5 class="light grey-text text-lighten-3">Excellent home cooked food have tasted till date .. It's run by small team where you can get it delivered by ordering in advance i tried biriyani and brinjal curry everything was perfect and tasty</h5>
                    </div>
                </li>
                <li>
                    <img src="img/foodbg.jpg"> <!-- random image -->
                    <div class="caption center-align">
                        <i class="large material-icons">account_circle </i>
                        <h3>Ramesh Kumar</h3>
                        <h5 class="light grey-text text-lighten-3">Glad I found this site. I didn't have any worry about food during this covid time. Thanks </h5>
                    </div>
                </li>

            </ul>
        </div>
    </section>

    <section id="aboutus">
        <h1>About Us</h1>

        <div class="row">
            <div class="col s6">
                <img class="about-img" src="img/chefsimage.jpg" style="z-index:0">
            </div>
            <div class="col s6">
                <div class="container" style="width: 40vw; z-index:99999;">
                    <p>Humans have always shown resilience and strength in unity during crises — this holds true during this pandemic as well. While many are involved in coordinating and updating information regarding the availability of hospital beds and medical amenities across different locations, there have also been a good number of them who’ve been delivering nutritious, home-cooked food to COVID-19 patients, who are in home isolation, and the elderly, who are stranded at homes with no help.
                        <br><br>
                        Many have spread the information through social media, but we wanted to bring out a platform that enables user to contact the Home-chefs and get their food easily. This was how the idea of “Quarantine Meals” was born.
                        <br><br>
                        This is a one-stop solution for your healthy homemade food cravings. Prepared hygienically and freshly without any added preservatives by talented home chefs around you. Your never-ending love for homemade food matters to us!
                    </p>
                </div>
            </div>
        </div>
    </section>

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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.parallax');
            var instances = M.Parallax.init(elems, options);
        });

        // Or with jQuery

        $(document).ready(function() {
            $('.parallax').parallax();
        });

        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.slider');
            var instances = M.Slider.init(elems, options);
        });

        // Or with jQuery

        $(document).ready(function() {
            $('.slider').slider();
        });
    </script>
</body>

</html>