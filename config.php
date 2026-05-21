<?php
$db_url = "postgresql://root:x0Ok0JBKoZOBljlsad5T5v4HwZFoHfFu@dpg-d87e4857vvec738v60ng-a/camping_db_i9iu";

try {
    $url = parse_url($db_url);
    $host = $url["host"];
    $port = $url["port"] ?? 5432;
    $user = $url["user"];
    $pass = $url["pass"];
    $dbname = ltrim($url["path"], '/');

    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection Failed: " . $e->getMessage());
}

session_start();
?>
