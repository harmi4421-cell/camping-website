<?php
include 'config.php';

$error = "";

if(isset($_POST['login'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Database mein check karenge ki admin details sahi hain ya nahi
    $query = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
    
    if(mysqli_num_rows($query) > 0){
        $row = mysqli_fetch_assoc($query);
        // Admin session create kar rahe hain
        $_SESSION['admin'] = $row['username'];
        header('location:admin_dashboard.php');
        exit();
    } else {
        $error = "Invalid Username or Password!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>
<link rel="stylesheet" href="style.css">
<style>
/* Login page ke liye custom clean background layout */
.login-body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: #eef2f3;
}
.login-box {
    background: white;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    width: 100%;
    max-width: 400px;
}
.login-box h2 {
    text-align: center;
    margin-bottom: 25px;
    color: #1a1a1a;
}
.error-msg {
    color: #e74c3c;
    background: #fde8e7;
    padding: 10px;
    border-radius: 4px;
    font-size: 14px;
    margin-bottom: 15px;
    text-align: center;
}
</style>
</head>
<body class="login-body">

<div class="login-box">
    <h2>Admin Login</h2>
    
    <?php if(!empty($error)){ ?>
        <div class="error-msg"><?php echo $error; ?></div>
    <?php } ?>

    <form action="admin_login.php" method="POST">
        <div class="contact-form-box">
            <input type="text" name="username" placeholder="Username" required style="margin-bottom: 15px;">
            <input type="password" name="password" placeholder="Password" required style="margin-bottom: 20px;">
            <button type="submit" name="login" style="width: 100%;">Login As Admin</button>
        </div>
    </form>
</div>

</body>
</html>
