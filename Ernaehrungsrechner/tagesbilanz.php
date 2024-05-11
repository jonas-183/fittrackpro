<?php
session_start();
require_once('../connect.php');

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];

    $query = "SELECT UserNr FROM users WHERE user = '$user'";
    $result = $mysql->query($query) or die($mysql->error);
    $arr = $result->fetch_array();
    $UserNr = $arr['UserNr'];
    $date = $_GET['dateIn']; 

    $query = "SELECT * FROM dailyIntake WHERE userID = $UserNr AND date = DATE_FORMAT('$date','%Y-%m-%e')";
    $result = $mysql->query($query) or die($mysql->error);

    $dailyIntake = array();
    while ($row = $result->fetch_assoc()) {
        array_push($dailyIntake, $row);
    }
    echo json_encode($dailyIntake);
} else {
    echo json_encode(array());
}
?>