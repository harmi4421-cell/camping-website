<?php
include 'config.php';

// Sirf admin ka session destroy karenge taaki normal user ka cart delete na ho
if(isset($_SESSION['admin'])){
    unset($_SESSION['admin']);
}

header('location:admin_login.php');
exit();
?>
