<?php
$conn = mysqli_connect("camping-db-service", "root", "MySecretPass123", "camping_db");

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

session_start();
?>
