<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>Products</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<h2 style="text-align:center;">Camping Products</h2>

<div class="card-container">

<?php
$query=mysqli_query($conn,"SELECT * FROM products");

while($row=mysqli_fetch_assoc($query)){
?>

<div class="card">

<img src="images/<?php echo $row['image']; ?>">

<h3><?php echo $row['product_name']; ?></h3>

<p>₹<?php echo $row['price']; ?></p>

</div>

<?php } ?>

</div>

</body>
</html>
