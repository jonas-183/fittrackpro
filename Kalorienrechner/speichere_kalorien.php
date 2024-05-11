<?php
session_start();
require_once('../connect.php');

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $kalorien = $_GET['kalorien'];

    $query = "UPDATE users SET berechneteKalorien = '$kalorien' WHERE user = '$user'";
    $result = $mysql->query($query) or die($mysql->error);
}else{
    header("Location: ../Login/login.html");
}
?>

