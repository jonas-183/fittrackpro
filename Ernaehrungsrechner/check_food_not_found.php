<?php
session_start();

$response = ['foodNotFound' => isset($_SESSION['foodNotFound']) ? $_SESSION['foodNotFound'] : false];
echo json_encode($response);
$_SESSION['foodNotFound'] = false;
?>