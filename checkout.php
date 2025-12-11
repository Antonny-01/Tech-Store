<?php
session_start();

// Redirect if cart is empty
if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit;
}

// Check login
if (!isset($_SESSION['initials'])) {
    header("Location: login.html");
    exit;
}

// Calculate total
$grandTotal = 0;
foreach ($_SESSION['cart'] as $item) {
    $grandTotal += $item['price'] * $item['qty'];
}

// Handle payment selection
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['method'])) {
    $_SESSION['payment_method'] = $_POST['method'];
    header("Location: payment.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Checkout - Tech Store</title>
<style>
body {font-family: Arial,sans-serif;background:#f5f5f5;margin:0;padding:0;}
header {background:#2563eb;color:white;text-align:center;padding:20px;font-size:1.5rem;}
nav {background:#333;padding:10px 20px;display:flex;justify-content:space-between;}
nav a {color:#fff;margin-right:15px;text-decoration:none;}
nav a:hover{text-decoration:underline;}
.container {max-width:800px;margin:30px auto;padding:20px;background:#fff;border-radius:8px;box-shadow:0 2px 10px rgba(0,0,0,0.1);}
h2{text-align:center;margin-bottom:20px;}
.total-section{text-align:right;font-size:20px;margin-bottom:20px;}
.payment-method {display:flex; flex-direction: column; gap: 10px;}
.payment-method button {padding:15px;font-size:16px;border:none;border-radius:6px;cursor:pointer;transition:0.2s;width:100%;}
.btn-mtn{background:#ffcd00;color:#003087;}
.btn-airtel{background:#e60000;color:white;}
.btn-zamtel{background:#009933;color:white;}
.btn-debit{background:#2563eb;color:white;}
.payment-method button:hover {opacity:0.9;}
</style>
</head>
<body>
<header>Tech Store - Checkout</header>
<nav>
<div>
<a href="index.php">Home</a>
<a href="cart.php">Cart</a>
<a href="deals.php">Deals</a>
</div>
<div>
<span style="color:white;">Hello, <?= htmlspecialchars($_SESSION['initials']) ?></span>
<a style="margin-left:10px;color:white;" href="logout.php">Logout</a>
</div>
</nav>

<div class="container">
<h2>Select Payment Method</h2>
<div class="total-section">
<strong>Total Amount: $<?= number_format($grandTotal, 2) ?></strong>
</div>

<form method="POST">
<div class="payment-method">
    <button type="submit" name="method" value="MTN Mobile Money" class="btn-mtn">MTN Mobile Money</button>
    <button type="submit" name="method" value="Airtel Money" class="btn-airtel">Airtel Money</button>
    <button type="submit" name="method" value="Zamtel Kwacha" class="btn-zamtel">Zamtel Kwacha</button>
    <button type="submit" name="method" value="Debit Card / PayPal" class="btn-debit">Debit Card / PayPal</button>
</div>
</form>
</div>
</body>
</html>