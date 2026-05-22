<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>Camping Website</title>
<link rel="stylesheet" href="style.css?v=1.1">
</head>
<body>

<header>
<h1>Camping Gear Website</h1>

<nav>
<a href="index.php">Home</a>
<a href="products.php">Products</a>
<a href="cart.php">Cart</a>
<a href="admin_login.php" style="font-size: 15px;">Admin</a>

<?php
if(isset($_SESSION['user'])){ 
    echo "<a href='logout.php'>Logout</a>";
}else{ 
    echo "<a href='login.php'>Login</a>"; 
    echo "<a href='register.php'>Register</a>";
}
?>
</nav>
</header>

<section class="hero">
<h2>Camping Gear and Essentials</h2>
<p>Best camping products available here.</p>
</section>

<div class="card-container">

<?php
$query = mysqli_query($conn,"SELECT * FROM products");

while($row = mysqli_fetch_assoc($query)){
?>

<div class="card">
<img src="images/<?php echo $row['image']; ?>">

<h3><?php echo $row['product_name']; ?></h3>

<p>₹<?php echo $row['price']; ?></p>

<form action="add_to_cart.php" method="POST">
<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
<button type="submit">Add To Cart</button>
</form>

</div>

<?php } ?>

</div>

<section class="contact-section"> 
    <div class="contact-header"> 
        <h2>Contact Us</h2> 
        <p>Reach out to us for any inquiries or feedback.</p> 
    </div> 

    <div class="contact-container"> 
        <div class="contact-info"> 
            <div class="info-item">📞 9687250251</div> 
            <div class="info-item">🕒 Monday - Friday: 9:00 AM - 5:00 PM</div> 
            <div class="info-item">🕒 Saturday: 10:00 AM - 3:00 PM</div> 
            <div class="info-item">🕒 Sunday: Closed</div> 
        </div> 

        <div class="contact-form-box"> 
            <form action="contact.php" method="POST"> 
                <input type="text" name="name" placeholder="Name*" required> 
                <input type="email" name="email" placeholder="Email*" required> 
                <textarea name="message" placeholder="Message*" rows="5" required></textarea> 
                <button type="submit">Send Message</button> 
            </form> 
        </div> 
    </div>
</section>

</body>
</html>
