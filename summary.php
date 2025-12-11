<?php
session_start();

if (!isset($_POST['reference'])) {
    header("Location: payment.php");
    exit;
}

$_SESSION['payment_reference'] = $_POST['reference'];

// Calculate total
$grandTotal = 0;
foreach($_SESSION['cart'] as $item){
    $grandTotal += $item['price'] * $item['qty'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Order Summary - Tech Store</title>
<style>
body {font-family: Arial; background:#f5f5f5;}
.container {max-width:700px; margin:40px auto; background:#fff; padding:25px; border-radius:8px;}
table {width:100%; border-collapse:collapse;}
td, th {border-bottom:1px solid #ddd; padding:10px; text-align:left;}
button {background:#2563eb; color:white; padding:12px; border:none; width:100%; border-radius:6px;}
</style>
</head>
<body>
<div class="container">
<h2>Order Summary</h2>
<table>
<tr><th>Product</th><th>Qty</th><th>Price</th></tr>
<?php foreach($_SESSION['cart'] as $item): ?>
<tr>
  <td><?= htmlspecialchars($item['name']) ?></td>
  <td><?= $item['qty'] ?></td>
  <td>$<?= number_format($item['price'] * $item['qty'],2) ?></td>
</tr>
<?php endforeach; ?>
</table>
<p><strong>Payment Method:</strong> <?= $_SESSION['payment_method'] ?></p>
<p><strong>Reference:</strong> <?= $_SESSION['payment_reference'] ?></p>
<p><strong>Total:</strong> $<?= number_format($grandTotal,2) ?></p>

<form action="address.php" method="POST">
  <button type="submit">Add Delivery Address</button>
</form>
</div>
</body>
</html>