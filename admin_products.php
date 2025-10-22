<?php
session_start();
include 'db.php';
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}

// PDO query to get all products
$stmt = $conn->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manage Products - Tech Store</title>
<style>
body { font-family: Arial, sans-serif; margin:0; padding:0; background:#f2f2f2; }
header { background:#3b03d6; color:white; padding:15px; display:flex; justify-content:space-between; align-items:center; }
header a { color:white; text-decoration:none; margin-left:15px; }
nav { background:#1a1a1a; width:200px; height:100vh; position:fixed; top:0; left:0; padding-top:60px; }
nav a { display:block; color:white; padding:12px 20px; text-decoration:none; }
nav a:hover { background:#333; }
main { margin-left:200px; padding:20px; }
table { width:100%; border-collapse: collapse; background:white; }
th, td { padding:12px; border:1px solid #ccc; text-align:left; }
th { background:#3b03d6; color:white; }
a.btn { background:#3b03d6; color:white; padding:6px 12px; text-decoration:none; border-radius:4px; }
a.btn:hover { background:#2563eb; }
</style>
</head>
<body>

<header>
    <h1>Manage Products</h1>
    <a href="logout.php">Logout</a>
</header>

<nav>
    <a href="admin_dashboard.php">Dashboard</a>
    <a href="admin_products.php">Products</a>
    <a href="admin_orders.php">Orders</a>
    <a href="admin_users.php">Users</a>
</nav>

<main>
    <a href="add_product.php" class="btn">Add New Product</a>
    <table>
        <tr>
            <th>ID</th><th>Name</th><th>Price</th><th>Category</th><th>Actions</th>
        </tr>
        <?php foreach($products as $row) { ?>
        <tr>
            <td><?php echo htmlspecialchars($row['id']); ?></td>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td>$<?php echo htmlspecialchars($row['price']); ?></td>
            <td><?php echo htmlspecialchars($row['category']); ?></td>
            <td>
                <a href="edit_product.php?id=<?php echo $row['id'];?>" class="btn">Edit</a>
                <a href="delete_product.php?id=<?php echo $row['id'];?>" class="btn" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</main>

</body>
</html>