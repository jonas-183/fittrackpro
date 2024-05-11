<?php
require_once("../connect.php");
$user = $_REQUEST['user'];
$passwd = $_REQUEST['passwd'];
$encryptedPasswd = md5($passwd);

$query = "insert into users values(null,'$user','$encryptedPasswd','0','0')";
$result = $mysql->query($query) or die($mysql->error);
header("Location: ../Login/login.html");
?>