<?php
session_start();
require_once('../connect.php');

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];

    $query = "SELECT UserNr FROM users WHERE user = '$user'";
    $result = $mysql->query($query) or die($mysql->error);
    $arr = $result->fetch_array();
    $UserNr = $arr['UserNr'];

    $query = "SELECT datum, gewicht FROM gewichtsVerlauf WHERE userID ='$UserNr' ORDER BY datum";
    $result = $mysql->query($query) or die($mysql->error);

    $weights = array();
    while($row = $result->fetch_assoc()) {
    $weights[] = $row;
    }   
    echo json_encode($weights);
} else {
    echo json_encode(array());
}
?>