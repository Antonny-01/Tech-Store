<?php
session_start();

// Ensure session data exists
if (!isset($_SESSION['payment_method']) || empty($_SESSION['cart'])) {
    header("Location: checkout.php");
    exit;
}

$pdo = new PDO("mysql:host=localhost;dbname=techstore_db;charset=utf8","root","");
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$userInitials  = $_SESSION['initials'];
$paymentMethod = $_SESSION['payment_method'] ?? 'Unknown'; // fallback
$address       = $_SESSION['address'] ?? 'Not provided';
$phone         = $_SESSION['phone'] ?? 'Not provided';
$paymentNumber = $_SESSION['payment_number'] ?? '';
$total         = $_SESSION['payment_amount'] ?? 0;
$ref           = 'REF'.time();
$status        = 'On the way!';

// Combine product names
$products = [];
foreach ($_SESSION['cart'] as $item) {
    $products[] = $item['name'] . " x" . $item['qty'];
}
$productSummary = implode(", ", $products);

// Insert order into DB
$stmt = $pdo->prepare("INSERT INTO orders 
(user_initials, customer_name, address, phone, payment_method, payment_reference, total, status)
VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->execute([$userInitials, $productSummary, $address, $phone, $paymentMethod.' '.$paymentNumber, $ref, $total, $status]);

// Clear session data
unset($_SESSION['cart'], $_SESSION['payment_method'], $_SESSION['payment_amount'], $_SESSION['address'], $_SESSION['phone'], $_SESSION['payment_number']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Order Confirmation</title>
<style>
body{font-family:Arial,sans-serif;text-align:center;padding:50px;background:#f5f5f5;}
h1{color:#2563eb;}
p{font-size:18px;margin:10px 0;}
a{background:#2563eb;color:white;padding:10px 20px;border-radius:6px;text-decoration:none;}
</style>
</head>
<body>
<h1>🎉 Order Confirmed!</h1>
<p>Thank you, <strong><?= htmlspecialchars($userInitials) ?></strong></p>
<p>Payment Method: <strong><?= htmlspecialchars($paymentMethod) ?></strong></p>
<?php if ($paymentNumber): ?>
<p>Payment Number: <strong><?= htmlspecialchars($paymentNumber) ?></strong></p>
<?php endif; ?>
<p>Reference: <strong><?= htmlspecialchars($ref) ?></strong></p>
<p>Delivery Address: <strong><?= htmlspecialchars($address) ?></strong></p>
<p>Phone: <strong><?= htmlspecialchars($phone) ?></strong></p>
<p>Status: 🚚 On the way!</p>
<a href="index.php">Return to Home</a>
</body>
</html>