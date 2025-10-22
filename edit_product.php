<?php
session_start();
include 'db.php';
if (!isset($_SESSION['admin_logged_in'])) { header("Location: admin_login.php"); exit; }

$error = '';
$success = '';

$id = $_GET['id'] ?? null;
if (!$id) { header("Location: admin_products.php"); exit; }

$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) { header("Location: admin_products.php"); exit; }

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $image = $_POST['image'];
    $stmt = $conn->prepare("UPDATE products SET name=?, price=?, category=?, image=? WHERE id=?");
    if ($stmt->execute([$name, $price, $category, $image, $id])) {
        $success = "Product updated successfully!";
        $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        $error = "Failed to update product.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Product - Tech Store</title>
<style>
body { font-family: Arial,sans-serif; background:#f2f2f2; padding:20px; }
form { background:white; padding:20px; border-radius:8px; max-width:400px; margin:auto; }
input, select { width:100%; padding:10px; margin:8px 0; border-radius:4px; border:1px solid #ccc; }
button { padding:10px; width:100%; background:#3b03d6; color:white; border:none; border-radius:4px; cursor:pointer; }
button:hover { background:#2563eb; }
.success { color:green; }
.error { color:red; }
</style>
</head>
<body>

<h2>Edit Product</h2>
<?php if($success) echo "<p class='success'>$success</p>"; ?>
<?php if($error) echo "<p class='error'>$error</p>"; ?>

<form method="POST">
    <input type="text" name="name" value="<?= htmlspecialchars($product['name']); ?>" placeholder="Product Name" required>
    <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($product['price']); ?>" placeholder="Price" required>
    <input type="text" name="category" value="<?= htmlspecialchars($product['category']); ?>" placeholder="Category" required>
    <input type="text" name="image" value="<?= htmlspecialchars($product['image']); ?>" placeholder="Image URL" required>
    <button name="update">Update Product</button>
</form>

<a href="admin_products.php">Back to Products</a>

</body>
</html>