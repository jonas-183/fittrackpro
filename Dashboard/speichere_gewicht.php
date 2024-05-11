<?php
session_start();
require_once('../connect.php');

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];

    $query = "SELECT UserNr FROM users WHERE user = '$user'";
    $result = $mysql->query($query) or die($mysql->error);
    $arr = $result->fetch_array();
    $UserNr = $arr['UserNr'];

    $datum = $_GET['datum'];
    $gewicht = $_GET['gewicht'];

    $query = "INSERT INTO gewichtsVerlauf (userID, datum, gewicht) VALUES ($UserNr, DATE_FORMAT('$datum','%Y-%m-%e'), '$gewicht')";
    $result = $mysql->query($query) or die($mysql->error);
}else{
    header("Location: ../Login/login.html");
}
?>