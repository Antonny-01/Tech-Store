<?php
session_start();
include 'db.php';

// Simple login check for admin
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}

// Functions to get counts
function getTotalProducts($conn) {
    $res = $conn->query("SELECT COUNT(*) as total FROM products");
    $row = $res->fetch(PDO::FETCH_ASSOC);
    return $row['total'];
}

function getTotalOrders($conn) {
    $res = $conn->query("SELECT COUNT(*) as total FROM orders");
    $row = $res->fetch(PDO::FETCH_ASSOC);
    return $row['total'];
}

function getTotalUsers($conn) {
    $res = $conn->query("SELECT COUNT(*) as total FROM users");
    $row = $res->fetch(PDO::FETCH_ASSOC);
    return $row['total'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard - Tech Store</title>
<style>
body { font-family: Arial, sans-serif; margin:0; padding:0; background:#f2f2f2; }
header { background:#3b03d6; color:white; padding:15px; display:flex; justify-content:space-between; align-items:center; }
header a { color:white; text-decoration:none; margin-left:15px; }
nav { background:#1a1a1a; width:200px; height:100vh; position:fixed; top:0; left:0; padding-top:60px; }
nav a { display:block; color:white; padding:12px 20px; text-decoration:none; }
nav a:hover { background:#333; }
main { margin-left:200px; padding:20px; }
.card { background:white; padding:20px; margin:10px 0; border-radius:6px; box-shadow:0 2px 5px rgba(0,0,0,0.2); }
.card h3 { margin:0; color:#3b03d6; }
.flex-container { display:flex; gap:20px; flex-wrap:wrap; }
.flex-item { flex:1; min-width:150px; }
</style>
</head>
<body>

<header>
    <h1>Tech Store Admin</h1>
    <a href="logout.php">Logout</a>
</header>

<nav>
    <a href="admin_dashboard.php">Dashboard</a>
    <a href="admin_products.php">Products</a>
    <a href="admin_orders.php">Orders</a>
    <a href="admin_users.php">Users</a>
</nav>

<main>
    <h2>Dashboard</h2>
    <div class="flex-container">
        <div class="card flex-item">
            <h3>Total Products</h3>
            <p><?php echo getTotalProducts($conn); ?></p>
        </div>
        <div class="card flex-item">
            <h3>Total Orders</h3>
            <p><?php echo getTotalOrders($conn); ?></p>
        </div>
        <div class="card flex-item">
            <h3>Total Users</h3>
            <p><?php echo getTotalUsers($conn); ?></p>
        </div>
    </div>
</main>

</body>
</html>