<?php
$conn = mysqli_connect("localhost","root","","camping_db");

if(!$conn){
    die("Connection Failed");
}

session_start();
?>
