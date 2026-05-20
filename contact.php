<?php
include 'config.php';

$name=$_POST['name'];
$email=$_POST['email'];
$message=$_POST['message'];

mysqli_query($conn,
"INSERT INTO contact_messages(name,email,message)
VALUES('$name','$email','$message')");

echo "Message Sent Successfully";
?>
