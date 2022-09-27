<?php
$title="Logout";
session_start();
unset($_SESSION['user']);
if(isset($_COOKIE['user'])){
    setcookie('user', '', time()-5,'/');
}
header('location:login.php');
die;