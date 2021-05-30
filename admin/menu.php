<?php
include('../config/db_connect.php');
session_start();
$chef_id = $_SESSION['chef_id'];
$sql = "SELECT * FROM food WHERE chef_id='$chef_id'";
$result = mysqli_query($conn, $sql);
$my_food = mysqli_fetch_all($result, MYSQLI_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuarantineMeals</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <style>
        .responsive-img {
            object-fit: cover;
            width: 100%;
            /* width: 25vmin;
            height: 25vmin; */
            height: 30vh !important;
        }

    
    </style>
</head>

<body>

    <div class="section">
        <div class="container center">
            <h4>My Menu</h4>
        </div>
        <div class="row">
            <?php for ($i = 0; $i < count($my_food); $i++) : ?>
                <?php $food = $my_food[$i]; ?>
                <div class="col s12 m3">
                    <div class="card">
                        <div class="card-image">
                            <img class="responsive-img" src=<?php echo "uploads/" . $food['food_img'] ?>>
                            <a class="btn-floating halfway-fab green" href=<?php echo "edit_food.php?food_id=" . $food['food_id']; ?>><i class="material-icons">edit</i></a>
                        </div>
                        <div class="card-content">
                            <span class="card-title"><?php echo $food['food_name']; ?></span>
                            <p class="truncate">DESC:<strong> <?php echo $food['food_desc']; ?></strong></p>
                            <p>PRICE: RS. <strong> <?php echo $food['food_price']; ?></strong></p>
                            <p>RATING: <strong><?php echo $food['food_rating']; ?></strong></p>
                        </div>
                    </div>
                </div>
                <?php if ($i % 3 == 0 && $i != 0) {
                    echo '</div> <div class="row">';
                } ?>
            <?php endfor; ?>
        </div>
    </div>

</body>

</html>