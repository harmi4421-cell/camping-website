<?php
include 'config.php';

// Security Check: Agar admin login nahi hai to login page par bhej do
if(!isset($_SESSION['admin'])){
    header('location:admin_login.php');
    exit();
}

$message = "";
$msg_class = "";

/* --- DELETE PRODUCT LOGIC --- */
if(isset($_GET['delete'])){
    $delete_id = mysqli_real_escape_string($conn, $_GET['delete']);
    
    // Pehle image ka naam nikalenge taaki folder se bhi delete kar sakein
    $select_img = mysqli_query($conn, "SELECT image FROM products WHERE id = '$delete_id'");
    $fetch_img = mysqli_fetch_assoc($select_img);
    
    if($fetch_img) {
        $image_path = 'images/' . $fetch_img['image'];
        
        // Database se product delete karenge
        $delete_query = mysqli_query($conn, "DELETE FROM products WHERE id = '$delete_id'");
        
        if($delete_query){
            // Agar file folder mein exist karti hai to use unlink (delete) kar denge
            if(file_exists($image_path) && !empty($fetch_img['image'])){
                unlink($image_path);
            }
            $message = "Product deleted successfully!";
            $msg_class = "success-msg";
        } else {
            $message = "Failed to delete product from database.";
            $msg_class = "error-msg";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin - Manage Products</title>
<link rel="stylesheet" href="style.css">
<style>
.admin-container { display: flex; min-height: calc(100vh - 60px); }
.sidebar { width: 250px; background: #1a1a1a; color: white; padding: 20px; }
.sidebar h3 { padding-bottom: 15px; border-bottom: 1px solid #333; margin-bottom: 20px; font-size: 18px; }
.sidebar a { display: block; color: #bbb; text-decoration: none; padding: 12px 10px; border-radius: 4px; margin-bottom: 8px; transition: all 0.3s; }
.sidebar a:hover { background: #2ecc71; color: white; }
.sidebar a.active { background: #2ecc71; color: white; }
.main-content { flex: 1; padding: 40px; background: #f8f9fa; }

/* Table Styling */
.table-card { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); width: 100%; overflow-x: auto; }
.table-card h2 { margin-bottom: 20px; font-size: 24px; color: #1a1a1a; }
table { width: 100%; border-collapse: collapse; margin-top: 15px; text-align: left; }
table th, table td { padding: 12px 15px; border-bottom: 1px solid #eee; vertical-align: middle; }
table th { background-color: #f4f6f7; color: #333; font-weight: 600; }
.table-img { width: 60px; height: 60px; object-fit: cover; border-radius: 6px; }

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
        <a href="admin_add_product.php">➕ Add New Product</a>
        <a href="admin_view_products.php" class="active">📦 View/Manage Products</a>
        <a href="admin_logout.php" style="color: #e74c3c; margin-top: 30px; border-top: 1px solid #333; padding-top: 15px;">🚪 Logout</a>
    </div>

    <!-- Main Content Area -->
    <div class="main-content">
        <div class="table-card">
            <h2>All Camping Products</h2>
            
            <?php if(!empty($message)){ ?>
                <div class="<?php echo $msg_class; ?>"><?php echo $message; ?></div>
            <?php } ?>

            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Database se saare products fetch kar rahe hain
                    $select_products = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");
                    
                    if(mysqli_num_rows($select_products) > 0){
                        while($row = mysqli_fetch_assoc($select_products)){
                    ?>
                    <tr>
                        <td><img src="images/<?php echo $row['image']; ?>" class="table-img"></td>
                        <td><?php echo $row['product_name']; ?></td>
                        <td>₹<?php echo $row['price']; ?></td>
                        <td>
                            <!-- Delete Link with Confirmation Javascript Box -->
                            <a href="admin_view_products.php?delete=<?php echo $row['id']; ?>" 
                               class="btn-remove" 
                               style="text-decoration:none; display:inline-block;" 
                               onclick="return confirm('Are you sure you want to delete this product?');">
                               🗑️ Delete
                            </a>
                        </td>
                    </tr>
                    <?php 
                        }
                    } else {
                        echo "<tr><td colspan='4' style='text-align:center; color:#777;'>No products uploaded yet.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
