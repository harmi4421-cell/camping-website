<?php
include 'config.php';

// Agar admin login nahi hai, toh use login page par wapas bhej do (Security Check)
if(!isset($_SESSION['admin'])){
    header('location:admin_login.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<link rel="stylesheet" href="style.css">
<style>
/* Dashboard layout styles */
.admin-container {
    display: flex;
    min-height: calc(100vh - 60px);
}
.sidebar {
    width: 250px;
    background: #1a1a1a;
    color: white;
    padding: 20px;
}
.sidebar h3 {
    padding-bottom: 15px;
    border-bottom: 1px solid #333;
    margin-bottom: 20px;
    font-size: 18px;
}
.sidebar a {
    display: block;
    color: #bbb;
    text-decoration: none;
    padding: 12px 10px;
    border-radius: 4px;
    margin-bottom: 8px;
    transition: all 0.3s;
}
.sidebar a:hover, .sidebar a.active {
    background: #2ecc71;
    color: white;
}
.main-content {
    flex: 1;
    padding: 40px;
    background: #f8f9fa;
}
.welcome-box {
    background: white;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}
</style>
</head>
<body>

<!-- Header for Admin Panel -->
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
        <a href="admin_dashboard.php" class="active">🏠 Dashboard Home</a>
        <a href="admin_add_product.php">➕ Add New Product</a>
        <a href="admin_view_products.php">📦 View/Manage Products</a>
        <a href="admin_logout.php" style="color: #e74c3c; margin-top: 30px; border-top: 1px solid #333; padding-top: 15px;">🚪 Logout</a>
    </div>

    <!-- Main Content Area -->
    <div class="main-content">
        <div class="welcome-box">
            <h2>Welcome to your Control Room!</h2>
            <p style="color: #666; margin-top: 10px;">Yahaan se aap apni camping website ke products ko manage kar sakti hain. Agle step mein hum product add karne ka system banayenge.</p>
        </div>
    </div>
</div>

</body>
</html>
