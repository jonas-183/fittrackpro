<?php
session_start();
require_once('../connect.php');

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];

    $foodName = $_REQUEST['foodName'];
    $quantityInput= $_REQUEST['quantityInput'];
    $dateInput = $_REQUEST['dateInput'];

    $query = "SELECT protein, carbohydrates, fat, calories FROM food WHERE name = '$foodName'";
    $result = $mysql->query($query) or die($mysql->error);

    if ($result->num_rows > 0) {
        $_SESSION['foodNotFound'] = false;
        $arr = $result->fetch_array();

        $protein = $arr['protein'];
        $carbohydrates = $arr['carbohydrates'];
        $fat = $arr['fat'];
        $calories = $arr['calories'];

        $query = "SELECT UserNr FROM users WHERE user = '$user'";
        $result = $mysql->query($query) or die($mysql->error);
        $arr = $result->fetch_array();
        $UserNr = $arr['UserNr'];

        $protein = $protein/100 * $quantityInput;
        $carbohydrates = $carbohydrates/100 * $quantityInput;
        $fat = $fat/100 * $quantityInput;
        $calories = $calories/100 * $quantityInput;

        $query = "INSERT INTO dailyIntake values ($UserNr,DATE_FORMAT('$dateInput','%Y-%m-%e'),'$foodName',$quantityInput,$protein,$carbohydrates,$fat,$calories)";
        $result = $mysql->query($query) or die($mysql->error);

    } else {
        $_SESSION['foodNotFound'] = true;
    }
    header("Location: ernaehrungstabelle.html");
}else{
    header("Location: ../Login/login.html");
}
?>
