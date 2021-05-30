<?php

include('config/db_connect.php');
session_start();
$user_name = $user_address = $user_city = $user_number = $user_mail = $user_password = "";
$user_name_error = $user_address_error = $user_city_error = $user_password_error = $user_number_error = $user_mail_error = "";

$is_error = false;
if (isset($_POST['user_reg'])) {
    $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
    $user_address = mysqli_real_escape_string($conn, $_POST['user_address']);
    $user_city = mysqli_real_escape_string($conn, $_POST['user_city']);
    $user_number = mysqli_real_escape_string($conn, $_POST['user_number']);
    $user_mail = mysqli_real_escape_string($conn, $_POST['user_mail']);
    $user_password = mysqli_real_escape_string($conn, $_POST['user_password']);
    if (empty($user_name)) {
        $user_name_error = "Please enter your name";
        $is_error = true;
    }
    if (empty($user_address)) {
        $user_address_error = "Please enter your address";
        $is_error = true;
    }
    if (empty($user_password)) {
        $user_password_error = "Please enter your password";
        $is_error = true;
    } else if (strlen($user_password) < 8) {
        $user_password_error = "Password should be >=8 characters";
        $is_error = true;
    }

    if (empty($user_city)) {
        $user_city_error = "Please enter your City";
        $is_error = true;
    } else if (!preg_match("/^[a-zA-z]*$/", $user_city)) {
        $user_city_error = "Enter only Alphabets and whitespaces";
        $is_error = true;
    }

    if (empty($user_number)) {
        $user_number_error = "Please enter your Mobile number";
        $is_error = true;
    } else if (!filter_var($user_number, FILTER_VALIDATE_INT)) {
        $user_number_error = "Mobile number should be numbers";
        $is_error = true;
    }

    if (empty($user_mail)) {
        $user_mail_error = "please enter your email";
        $is_error = true;
    } else if (!filter_var($user_mail, FILTER_VALIDATE_EMAIL)) {
        $user_mail_error = "Invalid email format";
        $is_error = true;
    }


    if ($is_error == false) {
        $sql = "INSERT INTO user (user_password,user_name,user_mail,user_address,user_number,user_city) VALUES ('$user_password','$user_name','$user_mail','$user_address','$user_number','$user_city')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header('Location: admin/');
        } else {
            echo mysqli_error($conn);
        }
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
                if ($('#user_password').attr('type') == 'password') {
                    $('.visibility_off').show();
                    $('.visibility').hide();
                    $('#user_password').attr('type', 'text');
                } else {
                    $('.visibility_off').hide();
                    $('.visibility').show();
                    $('#user_password').attr('type', 'password');
                }
            });
            $("#user_password").focus(function() {
                $('.suffix').css('color', '#26a69a');
            });
            $("#user_password").focusout(function() {
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

        .input-field {
            position: relative;
            padding-bottom: 30px !important;
        }
    </style>

</head>

<body>
    <section class="section">
        <h3 class="center">Sign-up as a user</h3>
        <div class="container">
            <form action="user_reg.php" method="POST" class="section">
                <div class="row">
                    <div class="input-field col s12 m6">
                        <input type="text" id="user_name" name="user_name" value="<?php echo htmlspecialchars($user_name) ?>">
                        <label for="user_name">Enter your name</label>
                        <div class="red-text"><?php echo htmlspecialchars($user_name_error) ?></div>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="text" id="user_number" name="user_number" value="<?php echo htmlspecialchars($user_number) ?>">
                        <label for="user_number">Enter your Mobile-number</label>
                        <div class="red-text"><?php echo htmlspecialchars($user_number_error) ?></div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m6">
                        <input type="text" id="user_city" name="user_city" value="<?php echo htmlspecialchars($user_city) ?>">
                        <label for="user_city">Enter your City</label>
                        <div class="red-text"><?php echo htmlspecialchars($user_city_error) ?></div>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="text" id="user_address" name="user_address" value="<?php echo htmlspecialchars($user_address) ?>">
                        <label for="user_address">Enter your Address</label>
                        <div class="red-text"><?php echo htmlspecialchars($user_address_error) ?></div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m6">
                        <input type="text" id="user_mail" name="user_mail" value="<?php echo htmlspecialchars($user_mail) ?>">
                        <label for="user_mail">Enter your Email</label>
                        <div class="red-text"><?php echo htmlspecialchars($user_mail_error) ?></div>
                    </div>
                    <div class="input-field col s12 m6">
                        <i class="material-icons suffix visibility_off ">visibility_off</i>
                        <i class="material-icons suffix visibility">visibility</i>
                        <input type="password" id="user_password" name="user_password" value="<?php echo htmlspecialchars($user_password) ?>">
                        <label for="user_password" class="active">Enter Password</label>
                        <div class="red-text">
                            <?php echo $user_password_error ?>
                        </div>
                    </div>
                </div>
                <div class="center">
                    <input type="submit" class="btn" value="submit" name="user_reg">
                </div>


            </form>
        </div>
    </section>
</body>

</html>