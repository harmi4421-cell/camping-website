<?php
$host = "b2ugtp3gikow9pc5abij-mysql.services.clever-cloud.com";
$user = "ue9i3yhwk0geiyun";
$password = "IQK8oUFQ8x6oiPlbbKIX"; 
$database = "b2ugtp3gikow9pc5abij";

$conn = mysqli_connect($host, $user, $password, $database, 3306);

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

session_start();
?>
