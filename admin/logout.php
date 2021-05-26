<?php
include('../config/db_connection.php');
session_start();
session_destroy();
header('Location: ../');
?>