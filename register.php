<?php
include "db.php";

if(isset($_POST['register'])){

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users(name,phone,email,password)
            VALUES('$name','$phone','$email','$password')";

    mysqli_query($conn,$sql);

    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>

    <style>

        body{
            font-family:Arial;
            background:#f4f4f4;

            display:flex;
            justify-content:center;
            align-items:center;

            height:100vh;
        }

        .box{
            width:400px;
            background:white;
            padding:40px;

            border-radius:10px;

            box-shadow:0 5px 15px rgba(0,0,0,0.2);
        }

        h2{
            text-align:center;
            margin-bottom:20px;
        }

        input{
            width:100%;
            padding:12px;
            margin:10px 0;

            border:1px solid #ccc;
            border-radius:5px;
        }

        button{
            width:100%;
            padding:12px;

            background:#222;
            color:white;

            border:none;
            border-radius:5px;

            font-size:18px;
            cursor:pointer;
        }

        button:hover{
            background:#ff9800;
        }

        p{
            text-align:center;
            margin-top:20px;
        }

        a{
            text-decoration:none;
            color:blue;
        }

    </style>
</head>

<body>

<div class="box">

    <h2>Register</h2>

    <form method="POST">

        <input type="text" name="name" placeholder="Name" required>

        <input type="text" name="phone" placeholder="Phone Number" required>

        <input type="email" name="email" placeholder="Email Address" required>

        <input type="password" name="password" placeholder="Password" required>

        <button type="submit" name="register">Register</button>

    </form>

    <p>
        Already have account?
        <a href="login.php">Login</a>
    </p>

</div>

</body>
</html>