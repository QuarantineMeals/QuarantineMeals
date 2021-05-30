<?php
include('../config/db_connect.php');
session_start();
$_SESSION['user_id'] = "";
$_SESSION['chef_id'] = "";
$user_name = $user_password = "";
$user_name_error = $user_password_error = "";
if (isset($_POST['login'])) {
    $user_name = mysqli_real_escape_string($conn, $_POST['_user_name']);
    $user_password = mysqli_real_escape_string($conn, $_POST['_user_password']);

    if (empty($user_name)) {
        $user_name_error = "Please enter UserName";
    } else if (!filter_var($user_name, FILTER_VALIDATE_EMAIL)) {
        $user_name_error = "Invalid email format";
    }

    if (empty($user_password)) {
        $user_password_error = "Please Enter password";
    } else if (strlen($user_password) < 8) {
        $user_password_error = "Password is >= 8 characters";
    }

    if (empty($user_name_error) && empty($user_password_error)) {
        $result1 = mysqli_query($conn, "SELECT * FROM chef WHERE chef_mail='$user_name'");
        $chef = mysqli_fetch_assoc($result1);
        if ($chef) {
            $_SESSION["chef_id"] = $chef['chef_id'];
            $_SESSION["user_id"] = '';
            if ($user_password === $chef['chef_password']) {
                header('Location: dashboard.php');
            }else{
                $user_password_error = "Incorrect password";
            }
        }
        $result2 = mysqli_query($conn, "SELECT * FROM user WHERE user_mail='$user_name'");
        $user = mysqli_fetch_assoc($result2);
        if ($user) {
            $_SESSION["user_id"] = $user['user_id'];
            $_SESSION['chef_id'] = '';
            if ($user_password === $user['user_password']) {
                header('Location: ../home.php');
            }else{
                $user_password_error = "Incorrect password";
            }
        }
        if (!$user && !$chef) {
            $user_name_error = "Username not found";
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
    <title>Login</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
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
                $('.suffix').css('color', '#26a69a');
            });
            $("#_user_password").focusout(function() {
                $('.suffix').css('color', 'black');
            });
            $('.modal').modal();

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
    </style>

</head>

<body>
    <!-- <nav class="teal">
        <div class="nav-wrapper">
            <div style="padding:0 20px;">
                <a href="#" class="brand-logo left">QuarantineMeals</a>
            </div>
        </div>
    </nav> -->
    <br>
    <br>
    <div id="forgot_pass" class="modal">
        <div class="modal-content">
            <h5>Hmm... &#128533;</h5>
            <div class="divider"></div>
            <p>We're afraid, we can do nothing about it &#128542;</p>
            <p>May be trying your other accounts' passwords may work &#128517;</p>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-small">Okay &#128513;</a>
        </div>
    </div>

    <br>
    <div class="section ">
        <div class="container z-depth-4" style="padding:30px; max-width:60vw;">
            <h3 class="grey-text center ">Login</h3>
            <br>
            <div class="row">
                <div class="container col s8 offset-s2">
                    <form action="index.php" method="POST">
                        <div class="input-field">
                            <input type="text" id="_user_name" name="_user_name" value="<?php echo htmlspecialchars($user_name) ?>">
                            <label for="_user_name" class="active">Enter Email id</label>
                            <div class="red-text">
                                <?php echo $user_name_error ?>
                            </div>
                        </div>
                        <div class="input-field">
                            <i class="material-icons suffix visibility_off ">visibility_off</i>
                            <i class="material-icons suffix visibility">visibility</i>
                            <input type="password" id="_user_password" name="_user_password" value="<?php echo htmlspecialchars($user_password) ?>">
                            <label for="_user_password" class="active">Enter Password</label>
                            <div class="red-text">
                                <?php echo $user_password_error ?>
                            </div>
                        </div>
                        <div class="right-align">
                            <a class="modal-trigger" href="#forgot_pass">Forgot password?</a>
                        </div>
                        <div class="center">
                            <input type="submit" value="login" name="login" class="btn">
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>