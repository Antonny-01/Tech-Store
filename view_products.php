<?php
session_start();
include 'db.php';
if(!isset($_SESSION['admin_logged_in'])){
    header("Location: admin_login.php");
    exit;
}

// Handle delete
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM products WHERE id=?");
    $stmt->execute([$id]);
}

// Fetch all products
$stmt = $conn->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>View Products - Admin</title>
<style>
body { font-family: Arial, sans-serif; background:#f2f2f2; padding:20px; }
table { border-collapse: collapse; width:100%; background:white; }
th, td { padding:10px; border:1px solid #ccc; text-align:left; }
th { background:#3b03d6; color:white; }
a { text-decoration:none; color:#2563eb; margin-right:10px; }
a:hover { color:#3b03d6; }
img { max-width:80px; }
</style>
</head>
<body>
<h2>All Products</h2>
<table>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Price</th>
    <th>Image</th>
    <th>Description</th>
    <th>Actions</th>
</tr>
<?php foreach($products as $row): ?>
<tr>
    <td><?php echo htmlspecialchars($row['id']); ?></td>
    <td><?php echo htmlspecialchars($row['name']); ?></td>
    <td><?php echo htmlspecialchars($row['price']); ?></td>
    <td><img src="<?php echo htmlspecialchars($row['image']); ?>" alt="Product"></td>
    <td><?php echo htmlspecialchars($row['description']); ?></td>
    <td>
        <a href="edit_product.php?id=<?php echo $row['id']; ?>">Edit</a>
        <a href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('Delete this product?')">Delete</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
<a href="admin_dashboard.php">Back to Dashboard</a>
</body>
</html>