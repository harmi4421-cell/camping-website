<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>Cart</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="cart-wrapper">
    <h2 class="cart-title">Your Cart</h2>

    <?php
    $total = 0;
    if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
        // $key ka use sahi item ko target karne ke liye ho raha hai
        foreach($_SESSION['cart'] as $key => $id){
            $id = mysqli_real_escape_string($conn, $id);
            $query = mysqli_query($conn, "SELECT * FROM products WHERE id='$id'");
            $row = mysqli_fetch_assoc($query);

            if($row) {
                echo "<div class='cart-item'>";
                echo "<h3>".$row['product_name']."</h3>";
                echo "<p>₹".$row['price']."</p>";
                // Remove Button Form
                echo "<form action='remove_from_cart.php' method='POST' style='width:auto; margin:0;'>";
                echo "<input type='hidden' name='cart_key' value='".$key."'>";
                echo "<button type='submit' class='btn-remove'>Remove</button>";
                echo "</form>";
                echo "</div>";
                
                $total += $row['price'];
            }
        }
        echo "<div class='cart-total'>Total = ₹$total</div>";
    } else {
        echo "<p style='text-align:center; color:#777;'>Your cart is empty.</p>";
    }
    ?>
</div>

</body>
</html>
