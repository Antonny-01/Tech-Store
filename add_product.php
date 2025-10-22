<?php
session_start();
include 'db.php';
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}

$error = '';
if(isset($_POST['add'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $image = $_POST['image'];

    // PDO way: prepare + execute with array
    $stmt = $conn->prepare("INSERT INTO products (name, price, category, image) VALUES (?, ?, ?, ?)");
    if($stmt->execute([$name, $price, $category, $image])){
        header("Location: admin_products.php");
        exit;
    } else {
        $error = "Failed to add product.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Product - Tech Store</title>
<style>
body { font-family: Arial, sans-serif; background:#f2f2f2; padding:50px; }
form { background:white; padding:20px; border-radius:8px; width:400px; margin:auto; }
input { width:100%; padding:10px; margin:10px 0; border:1px solid #ccc; border-radius:4px; }
button { padding:10px; width:100%; background:#3b03d6; color:white; border:none; border-radius:4px; cursor:pointer; }
button:hover { background:#2563eb; }
.error { color:red; }
</style>
</head>
<body>
<form method="POST">
    <h2>Add New Product</h2>
    <?php if($error) echo "<p class='error'>$error</p>"; ?>
    <input type="text" name="name" placeholder="Product Name" required>
    <input type="text" name="price" placeholder="Price" required>
    <input type="text" name="category" placeholder="Category" required>
    <input type="text" name="image" placeholder="Image URL" required>
    <textarea name="description" placeholder="Product Description" rows="4" required></textarea>
    <button name="add">Add Product</button>
</form>
</body>
</html>