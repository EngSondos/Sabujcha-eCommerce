<?php
if(empty($_SESSION['user']))
{
    header('location:Login.php');
    die;
}
?>