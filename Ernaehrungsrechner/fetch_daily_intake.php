<?php
session_start();
require_once('../connect.php');

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];

    $query = "SELECT UserNr FROM users WHERE user = '$user'";
    $result = $mysql->query($query) or die($mysql->error);
    $arr = $result->fetch_array();
    $UserNr = $arr['UserNr'];

    $today = date('Y-m-d');
    $query = "SELECT * FROM dailyIntake WHERE userID = $UserNr AND date = '$today'";
    $result = $mysql->query($query) or die($mysql->error);

    $dailyIntake = array();
    while ($row = $result->fetch_assoc()) {
        array_push($dailyIntake, $row);
    }

    $totalCalories = 0;
    foreach ($dailyIntake as $item) {
    $totalCalories += $item['calories'];
    }
    $query = "UPDATE users SET Tageskalorien = '$totalCalories' WHERE user = '$user'";
    $result = $mysql->query($query) or die($mysql->error);

    echo json_encode($dailyIntake);
} else {
    echo json_encode(array());
}
?>