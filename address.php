<?php
session_start();
if (!isset($_SESSION['payment_method'])) header("Location: checkout.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['address'] = $_POST['address'];
    $_SESSION['phone']   = $_POST['phone'];
    header("Location: confirmation.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Delivery Address - Tech Store</title>
<style>
body{font-family:Arial,sans-serif;text-align:center;padding:50px;background:#f5f5f5;}
input{padding:10px;width:300px;margin:10px 0;border-radius:5px;border:1px solid #ccc;}
button{padding:15px 30px;font-size:18px;border:none;background:#2563eb;color:white;border-radius:6px;cursor:pointer;}
</style>
</head>
<body>
<h2>Enter Delivery Address</h2>
<form method="POST">
<input type="text" name="address" placeholder="Address" required><br>
<input type="text" name="phone" placeholder="Phone Number" required><br>
<button type="submit">Confirm Order</button>
</form>
</body>
</html>