<?php

include('../config/db_connect.php');
session_start();

if (isset($_SESSION['chef_id'])) {
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuarantineMeals</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <header>
        <nav>
            <div class="nav-wrapper">
                <div class="brand-logo">
                    Dashboard
                </div>
                <ul class="right">
                    <li><a href="menu.php">My Menu</a></li>
                    <li><a href="food_add.php">Add food</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </nav>
    </header>

</body>

</html>