<?php
session_start();

// Redirect to cart if cart is empty
if(empty($_SESSION['cart'])){
    header("Location: cart.php");
    exit;
}

// Check if user is logged in
if(!isset($_SESSION['initials'])){
    header("Location: login.html");
    exit;
}

// Calculate Grand Total
$grandTotal = 0;
foreach($_SESSION['cart'] as $item){
    $grandTotal += $item['price'] * $item['qty'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Payment - Tech Store</title>
<link rel="stylesheet" href="style.css">
<style>
body {font-family: Arial, sans-serif; background:#f5f5f5; margin:0; padding:0;}
header {background:#2563eb; color:white; text-align:center; padding:20px; font-size:1.5rem;}
nav {background:#333; padding:10px 20px; display:flex; justify-content:space-between;}
nav a {color:#fff; margin-right:15px; text-decoration:none;}
nav a:hover {text-decoration:underline;}

.container {max-width:800px; margin:30px auto; padding:20px; background:#fff; border-radius:8px; box-shadow:0 2px 10px rgba(0,0,0,0.1);}
h2 {text-align:center; margin-bottom:20px;}
.payment-method {margin:20px 0;}
.payment-method button {display:block; width:100%; padding:15px; margin-bottom:10px; font-size:16px; border:none; border-radius:6px; cursor:pointer; transition:0.2s;}
.payment-method button:hover {opacity:0.9;}

.btn-mtn {background:#ffcd00; color:#003087;}
.btn-airtel {background:#e60000; color:white;}
.btn-zamtel {background:#009933; color:white;}
.btn-debit {background:#2563eb; color:white;}
.total-section {font-size:20px; text-align:right; margin-top:20px;}
</style>
<script>
function payVia(method){
    alert("You selected " + method + ".\nThis is a demo page, implement API integration for real payments.");
}
</script>
</head>
<body>

<header>Tech Store - Payment</header>
<nav>
    <div>
        <a href="index.php">Home</a>
        <a href="cart.php">Cart</a>
        <a href="deals.php">Deals</a>
    </div>
    <div>
        <span style="color:white;">Hello, <?= $_SESSION['initials'] ?></span>
        <a style="margin-left:10px; color:white;" href="logout.php">Logout</a>
    </div>
</nav>

<div class="container">
<h2>Select Payment Method</h2>

<div class="total-section">
<strong>Total Amount: $<?= number_format($grandTotal,2) ?></strong>
</div>

<div class="payment-method">
    <button class="btn-mtn" onclick="payVia('MTN Mobile Money')">MTN Mobile Money</button>
    <button class="btn-airtel" onclick="payVia('Airtel Money')">Airtel Money</button>
    <button class="btn-zamtel" onclick="payVia('Zamtel Kwacha')">Zamtel Kwacha</button>
    <button class="btn-debit" onclick="payVia('Debit Card / PayPal')">Debit Card / PayPal</button>
</div>

<p style="text-align:center; color:#555; margin-top:30px;">After selecting a payment method, you would be redirected to the payment gateway to complete the transaction.</p>
</div>

</body>
</html>