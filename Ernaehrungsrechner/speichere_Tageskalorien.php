<?php
session_start();
require_once('../connect.php');

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $data = json_decode(file_get_contents('php://input'), true);
    $kalorien = $data['totalCalories'];

    $query = "UPDATE users SET Tageskalorien = '$kalorien' WHERE user = '$user'";
    $result = $mysql->query($query) or die($mysql->error);
}else{
    header("Location: ../Login/login.html");
}
?>