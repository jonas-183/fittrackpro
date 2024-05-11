<?php
session_start();
require_once('../connect.php');

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];

    $query = "SELECT berechneteKalorien,Tageskalorien FROM users WHERE user = '$user'";
    $result = $mysql->query($query) or die($mysql->error);
    $kalorien = $result->fetch_assoc();

    $kalorien['berechneteKalorien'] = floatval($kalorien['berechneteKalorien']);
    $kalorien['Tageskalorien'] = floatval($kalorien['Tageskalorien']);

    echo json_encode($kalorien);
}else{
    header("Location: ../Login/login.html");
}
?>