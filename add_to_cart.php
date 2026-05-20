<?php
include 'config.php';

$id=$_POST['id'];

$_SESSION['cart'][]=$id;

header('location:cart.php');
?>
