<?php
// Yeh aapki config file ko include karega jisse database aur session dono connect ho sakein
include 'config.php';

if(isset($_POST['cart_key'])){
    $key = $_POST['cart_key'];
    
    // Check karega ki cart mein woh item hai ya nahi aur use delete karega
    if(isset($_SESSION['cart'][$key])){
        unset($_SESSION['cart'][$key]);
        
        // Items ki numbering ko wapas line se set karega (0, 1, 2...)
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
}

// Item delete hone ke baad page automatic reload hokar wapas cart page par bhej dega
header('location:cart.php');
exit();
?>
