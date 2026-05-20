<?php
include "db.php";

if(isset($_POST['login'])){

    $name = $_POST['name'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users
            WHERE name='$name'
            AND password='$password'";

    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) > 0){

        header("Location: index.php");

    }else{

        echo "<script>alert('Invalid Name or Password')</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

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

    <h2>Login</h2>

    <form method="POST">

        <input type="text" name="name" placeholder="Name" required>

        <input type="password" name="password" placeholder="Password" required>

        <button type="submit" name="login">Login</button>

    </form>

    <p>
        Don't have account?
        <a href="register.php">Register</a>
    </p>

</div>

</body>
</html>