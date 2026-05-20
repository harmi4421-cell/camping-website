<?php
include 'config.php';

// Security Check: Agar admin login nahi hai to login page par bhej do
if(!isset($_SESSION['admin'])){
    header('location:admin_login.php');
    exit();
}

$message = "";
$msg_class = "";

if(isset($_POST['add_product'])){
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    
    // Image Upload Logic
    $image_name = $_FILES['product_image']['name'];
    $image_tmp_name = $_FILES['product_image']['tmp_name'];
    $image_folder = 'images/' . $image_name;

    // Database mein check karenge ki kahin ye product pehle se to nahi hai
    $check_product = mysqli_query($conn, "SELECT * FROM products WHERE product_name = '$product_name'");

    if(mysqli_num_rows($check_product) > 0){
        $message = "Product name already exists!";
        $msg_class = "error-msg";
    } else {
        // Query to insert product into database
        $insert_query = mysqli_query($conn, "INSERT INTO products (product_name, price, image) VALUES ('$product_name', '$price', '$image_name')");
        
        if($insert_query){
            // Agar database mein save ho gaya, to image file ko 'images' folder mein move karenge
            if(move_uploaded_file($image_tmp_name, $image_folder)){
                $message = "Product added successfully!";
                $msg_class = "success-msg";
            } else {
                $message = "Product added to database, but image upload failed. Check 'images' folder permissions.";
                $msg_class = "error-msg";
            }
        } else {
            $message = "Could not add the product. Please try again.";
            $msg_class = "error-msg";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin - Add Product</title>
<link rel="stylesheet" href="style.css">
<style>
.admin-container { display: flex; min-height: calc(100vh - 60px); }
.sidebar { width: 250px; background: #1a1a1a; color: white; padding: 20px; }
.sidebar h3 { padding-bottom: 15px; border-bottom: 1px solid #333; margin-bottom: 20px; font-size: 18px; }
.sidebar a { display: block; color: #bbb; text-decoration: none; padding: 12px 10px; border-radius: 4px; margin-bottom: 8px; transition: all 0.3s; }
.sidebar a:hover { background: #2ecc71; color: white; }
.sidebar a.active { background: #2ecc71; color: white; }
.main-content { flex: 1; padding: 40px; background: #f8f9fa; }

/* Form Card Styling */
.form-card { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); max-width: 500px; margin: 0 auto; }
.form-card h2 { margin-bottom: 20px; font-size: 24px; color: #1a1a1a; text-align: center; }
.form-group { margin-bottom: 15px; }
.form-group label { display: block; margin-bottom: 5px; font-weight: 600; color: #444; }

/* Alert Messages */
.success-msg { color: #27ae60; background: #e8f8f0; padding: 10px; border-radius: 4px; font-size: 14px; margin-bottom: 15px; text-align: center; border: 1px solid #d4edda; }
.error-msg { color: #e74c3c; background: #fde8e7; padding: 10px; border-radius: 4px; font-size: 14px; margin-bottom: 15px; text-align: center; border: 1px solid #f8d7da; }
</style>
</head>
<body>

<header>
    <h1>Camping Gear - Admin Panel</h1>
    <nav>
        <span style="color: #2ecc71; font-weight: 600;">Welcome, <?php echo $_SESSION['admin']; ?></span>
    </nav>
</header>

<div class="admin-container">
    <!-- Sidebar Navigation -->
    <div class="sidebar">
        <h3>Menu</h3>
        <a href="admin_dashboard.php">🏠 Dashboard Home</a>
        <a href="admin_add_product.php" class="active">➕ Add New Product</a>
        <a href="admin_view_products.php">📦 View/Manage Products</a>
        <a href="admin_logout.php" style="color: #e74c3c; margin-top: 30px; border-top: 1px solid #333; padding-top: 15px;">🚪 Logout</a>
    </div>

    <!-- Main Content Area -->
    <div class="main-content">
        <div class="form-card">
            <h2>Add New Camping Gear</h2>
            
            <?php if(!empty($message)){ ?>
                <div class="<?php echo $msg_class; ?>"><?php echo $message; ?></div>
            <?php } ?>

            <!-- Form standard setup image upload ke liye: enctype="multipart/form-data" zaroori hai -->
            <form action="admin_add_product.php" method="POST" enctype="multipart/form-data" class="contact-form-box">
                <div class="form-group">
                    <label>Product Name</label>
                    <input type="text" name="product_name" placeholder="Enter Product Name" required>
                </div>
                
                <div class="form-group">
                    <label>Price (₹)</label>
                    <input type="number" name="price" placeholder="Enter Price" min="0" required>
                </div>
                
                <div class="form-group">
                    <label>Product Image</label>
                    <input type="file" name="product_image" accept="image/png, image/jpeg, image/jpg" required style="padding: 8px;">
                </div>
                
                <button type="submit" name="add_product" style="width: 100%; margin-top: 10px;">Upload Product</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
