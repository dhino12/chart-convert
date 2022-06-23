<?php 
session_start();

include 'script/functions.php';
$username = $_SESSION['identity'];
$level = $_SESSION['level'];
var_dump($username);

$queryUpdateStatus = "UPDATE $level SET status='unactive' WHERE username='$username'";
$result = query($queryUpdateStatus, '');
var_dump($result);
die;

session_destroy();
$_SESSION = [];
header("Location: ../login.php");
?>