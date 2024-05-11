<?php
session_start();
require_once("../connect.php");
function checkPasswd($user,$passwd){
  global $mysql;
  $encPasswd = md5($passwd);

  $query = "select * from users
              where user = '$user' and passwd = '$encPasswd'";

  $result = $mysql->query($query) or die($mysql->error);
  
  return $result->fetch_array();
}
if (isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
  header("Location: ../Dashboard/dashboard.html");
}else{
  $user   = $_REQUEST['user'];
  $passwd = $_REQUEST['passwd'];
  if(checkPasswd($user,$passwd)){
    $_SESSION['user'] = $user;
    header("Location: ../Dashboard/dashboard.html");
  }else{
    die("Der Passwortcheck schlug fehl!");
  }
}
?>