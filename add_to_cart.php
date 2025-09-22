<?php
session_start();

// Create cart if not exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Add product
if (isset($_POST['name']) && isset($_POST['price'])) {
    $id = uniqid(); // unique ID for each item
    $_SESSION['cart'][$id] = [
        'name' => $_POST['name'],
        'price' => $_POST['price']
    ];
}

// Redirect back
header("Location: cart.php");
exit;
?>