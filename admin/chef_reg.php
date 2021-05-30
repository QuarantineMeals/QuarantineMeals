<?php

include('../config/db_connect.php');
session_start();
$radio_box = ['veg' => "", "non_veg" => "", "both" => ""];
$check_delivery_type = ['self_pick' => '', 'home_del' => ''];
$check_meal_option = ['breakfast' => '', 'lunch' => '', 'dinner' => ''];
$chef_name = $chef_address = $chef_city = $chef_number = $chef_mail = $chef_password = $food_type = $breakfast = $lunch = $dinner = $self_pick = $home_del = "";
$chef_name_error = $chef_address_error = $chef_city_error = $chef_password_error = $chef_number_error = $chef_mail_error = "";
$food_type_error = $delivery_error = $meal_option_error = "";
$is_error = false;
if (isset($_POST['chef_reg'])) {
    $chef_name = mysqli_real_escape_string($conn, $_POST['chef_name']);
    $chef_address = mysqli_real_escape_string($conn, $_POST['chef_address']);
    $chef_city = mysqli_real_escape_string($conn, $_POST['chef_city']);
    $chef_number = mysqli_real_escape_string($conn, $_POST['chef_number']);
    $chef_mail = mysqli_real_escape_string($conn, $_POST['chef_mail']);
    $chef_password = mysqli_real_escape_string($conn, $_POST['chef_password']);
    if (isset($_POST['food_type'])) {
        $food_type = mysqli_real_escape_string($conn, $_POST['food_type']);
    }
    if (isset($_POST['breakfast'])) {
        $breakfast = mysqli_real_escape_string($conn, $_POST['breakfast']);
    }
    if (isset($_POST['lunch'])) {
        $lunch = mysqli_real_escape_string($conn, $_POST['lunch']);
    }
    if (isset($_POST['dinner'])) {
        $dinner = mysqli_real_escape_string($conn, $_POST['dinner']);
    }
    if (isset($_POST['self_pick'])) {
        $self_pick = mysqli_real_escape_string($conn, $_POST['self_pick']);
    }
    if (isset($_POST['home_del'])) {
        $home_del = mysqli_real_escape_string($conn, $_POST['home_del']);
    }
    if (empty($chef_name)) {
        $chef_name_error = "Please enter your name";
        $is_error = true;
    }
    if (empty($chef_address)) {
        $chef_address_error = "Please enter your address";
        $is_error = true;
    }
    if (empty($chef_password)) {
        $chef_password_error = "Please enter your password";
        $is_error = true;
    } else if (strlen($chef_password) < 8) {
        $chef_password_error = "Password must be >= 8 characters";
        $is_error = true;
    }

    if (empty($chef_city)) {
        $chef_city_error = "Please enter your City";
        $is_error = true;
    } else if (!preg_match("/^[a-zA-z]*$/", $chef_city)) {
        $chef_city_error = "Enter only Alphabets and whitespaces";
        $is_error = true;
    }

    if (empty($chef_number)) {
        $chef_number_error = "Please enter your Mobile number";
        $is_error = true;
    } else if (!filter_var($chef_number, FILTER_VALIDATE_INT)) {
        $chef_number_error = "Mobile number should be numbers";
        $is_error = true;
    }

    if (empty($chef_mail)) {
        $chef_mail_error = "please enter your email";
        $is_error = true;
    } else if (!filter_var($chef_mail, FILTER_VALIDATE_EMAIL)) {
        $chef_mail_error = "Invalid email format";
        $is_error = true;
    }

    if (empty($food_type)) {
        $food_type_error = "Please select atleast one Option";
        $is_error = true;
    } else {
        $radio_box[$food_type] = "checked";
    }

    if (empty($breakfast) && empty($lunch) && empty($dinner)) {
        $meal_option_error = "Please select atleast one meal Option";
        $is_error = true;
    } else {
        if (!empty($breakfast)) {
            $check_meal_option['breakfast'] = 'checked';
        }
        if (!empty($lunch)) {
            $check_meal_option['lunch'] = 'checked';
        }
        if (!empty($dinner)) {
            $check_meal_option['dinner'] = 'checked';
        }
    }

    if (empty($home_del) && empty($self_pick)) {
        $delivery_error = "Please select atleast one delivery option";
        $is_error = true;
    } else {
        if (!empty($home_del)) {
            $check_delivery_type['home_del'] = 'checked';
        }
        if (!empty($self_pick)) {
            $check_delivery_type['self_pick'] = 'checked';
        }
    }
    if ($is_error == false) {
        $delivery_option = $meal_option  = "";
        if (!empty($home_del)) {
            $delivery_option .= 'home_del ';
        }
        if (!empty($self_pick)) {
            $delivery_option .= 'self_pick';
        }
        if (!empty($breakfast)) {
            $meal_option .= 'breakfast ';
        }
        if (!empty($lunch)) {
            $meal_option .= 'lunch ';
        }
        if (!empty($dinner)) {
            $meal_option .= 'dinner';
        }
        $sql = "INSERT INTO chef (chef_password,chef_name,chef_mail,chef_address,chef_number,chef_city,meal_option,delivery_option,food_type) VALUES ('$chef_password','$chef_name','$chef_mail','$chef_address','$chef_number','$chef_city','$meal_option','$delivery_option','$food_type');";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header('Location: ../admin');
        } else {
            echo mysqli_error($conn);
        }
        // $chef_id_r = mysqli_query($conn, "SELECT * FROM chef WHERE chef_mail='$chef_mail'");
        // $chef_id = mysqli_fetch_assoc($chef_id_r);
        // $_SESSION['chef_id'] = $chef_id['chef_id'];
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuarantineMeals</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Reggae+One&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script>
        $(document).ready(function() {
            $('.visibility_off').hide();
            $('.suffix').click(function() {
                if ($('#_user_password').attr('type') == 'password') {
                    $('.visibility_off').show();
                    $('.visibility').hide();
                    $('#_user_password').attr('type', 'text');
                } else {
                    $('.visibility_off').hide();
                    $('.visibility').show();
                    $('#_user_password').attr('type', 'password');
                }
            });
            $("#_user_password").focus(function() {
                $('.suffix').css('color', '#ff9800');
            });
            $("#_user_password").focusout(function() {
                $('.suffix').css('color', 'black');
            });
        });
    </script>
    <style>
        .suffix {
            position: absolute;
            float: right;
            right: 1rem !important;
            top: 1rem;
        }

        .suffix:hover {
            cursor: pointer;
        }

        .input-field label {
            color: orange;
        }

        /* label focus color */
        .input-field input:focus+label {
            color: orange !important;
        }

        /* label underline focus color */
        .input-field input:focus {
            border-bottom: 1px solid orange !important;
            box-shadow: 0 1px 0 0 orange !important;
        }

        /* icon prefix focus color */
        .input-field .suffix .active {
            color: orange !important;
        }

        [type="checkbox"].filled-in:checked+span:not(.lever):after {
            background-color: orange;
            border: 2px solid orange;
        }

        [type="radio"]:checked+span:after,
        [type="radio"].with-gap:checked+span:after {
            background-color: orange;
        }

        [type="radio"]:checked+span:after,
        [type="radio"].with-gap:checked+span:before,
        [type="radio"].with-gap:checked+span:after {
            border: 2px solid orange;
        }

        body {
            background: whitesmoke;
        }
    </style>

</head>

<body>
    <section class="section">
        <h3 class="center">Sign-up as a home chef</h3>
        <div class="container">
            <form action="chef_reg.php" method="POST" class="section">
                <div class="row">
                    <div class="input-field col s12 m6">
                        <input type="text" id="chef_name" name="chef_name" value="<?php echo htmlspecialchars($chef_name) ?>">
                        <label for="chef_name">Enter your name</label>
                        <div class="red-text"><?php echo htmlspecialchars($chef_name_error) ?></div>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="text" id="chef_number" name="chef_number" value="<?php echo htmlspecialchars($chef_number) ?>">
                        <label for="chef_number">Enter your Mobile-number</label>
                        <div class="red-text"><?php echo htmlspecialchars($chef_number_error) ?></div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m6">
                        <input type="text" id="chef_city" name="chef_city" value="<?php echo htmlspecialchars($chef_city) ?>">
                        <label for="chef_city">Enter your City</label>
                        <div class="red-text"><?php echo htmlspecialchars($chef_city_error) ?></div>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="text" id="chef_address" name="chef_address" value="<?php echo htmlspecialchars($chef_address) ?>">
                        <label for="chef_address">Enter your Address</label>
                        <div class="red-text"><?php echo htmlspecialchars($chef_address_error) ?></div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m6">
                        <input type="text" id="chef_mail" name="chef_mail" value="<?php echo htmlspecialchars($chef_mail) ?>">
                        <label for="chef_mail">Enter your Email</label>
                        <div class="red-text"><?php echo htmlspecialchars($chef_mail_error) ?></div>
                    </div>
                    <div class="input-field col s12 m6">
                        <i class="material-icons suffix visibility_off ">visibility_off</i>
                        <i class="material-icons suffix visibility">visibility</i>
                        <input type="password" id="_user_password" name="chef_password" value="<?php echo htmlspecialchars($chef_password) ?>">
                        <label for="chef_password" class="active">Enter Password</label>
                        <div class="red-text">
                            <?php echo $chef_password_error ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <h6>Delivery mode</h6>
                            <div class="row">
                                <label for="home_del" class="col s6 m3">
                                    <input type="checkbox" name="home_del" class="filled-in" value="true" id="home_del" <?php echo $check_delivery_type['home_del'] ?>>
                                    <span>Home Delivery</span>
                                </label>
                                <label for="self_pick" class="col s6 m3">
                                    <input type="checkbox" name="self_pick" class="filled-in" value="true" id="self_pick" <?php echo $check_delivery_type['self_pick'] ?>>
                                    <span>Self-Pickup</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="red-text">
                        <?php echo htmlspecialchars($delivery_error) ?>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <h6>Meal Options</h6>
                            <div class="row">
                                <label for="breakfast" class="col s6 m3">
                                    <input type="checkbox" name="breakfast" class="filled-in" value="true" id="breakfast" <?php echo $check_meal_option['breakfast'] ?>>
                                    <span>Breakfast</span>
                                </label>
                                <label for="lunch" class="col s6 m3">
                                    <input type="checkbox" name="lunch" class="filled-in" value="true" id="lunch" <?php echo $check_meal_option['lunch'] ?>>
                                    <span>Lunch</span>
                                </label>
                                <label for="dinner" class="col s6 m3">
                                    <input type="checkbox" name="dinner" class="filled-in" value="true" id="dinner" <?php echo $check_meal_option['dinner'] ?>>
                                    <span>Dinner</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="red-text">
                        <?php echo htmlspecialchars($meal_option_error) ?>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <h6>What type of food do you sell?</h6>
                            <div class="row">
                                <label for="veg" class="col s6 m3">
                                    <input type="radio" class="with-gap" id="veg" name="food_type" value="veg" <?php echo $radio_box['veg'] ?>>
                                    <span>Only VEG</span>
                                </label>
                                <label for="non_veg" class="col s6 m3">
                                    <input type="radio" class="with-gap" id="non_veg" name="food_type" value="non_veg" <?php echo $radio_box['non_veg'] ?>>
                                    <span>Only NON-VEG</span>
                                </label>
                                <label for="both" class="col s6 m3">
                                    <input type="radio" class="with-gap" id="both" name="food_type" value="both" <?php echo $radio_box['both'] ?>>
                                    <span>BOTH</span>
                                </label>

                            </div>
                            <div class="red-text">
                                <?php echo htmlspecialchars($food_type_error) ?>
                            </div>
                        </div>
                    </div>
                    <div class="center">
                        <input type="submit" class="btn orange" value="submit" name="chef_reg">
                    </div>
            </form>
        </div>
    </section>
</body>

</html>