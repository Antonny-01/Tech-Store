<?php
session_start();
include 'db.php';

if(isset($_POST['product_id']) && isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];
    $quantity = 1;

    // Get product price
    $stmt = $conn->prepare("SELECT price FROM products WHERE id = ?");
    $stmt->execute([$product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    $total = $product['price'] * $quantity;

    // Insert order
    $stmt = $conn->prepare("INSERT INTO orders (user_id, product_id, quantity, total) VALUES (?, ?, ?, ?)");
    $stmt->execute([$user_id, $product_id, $quantity, $total]);

    echo "Product added to orders!";
}
?>