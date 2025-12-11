<?php
session_start();



// Database config
$host = 'localhost';
$dbname = 'techstore_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Fetch orders
try {
    $stmt = $pdo->query("SELECT * FROM orders ORDER BY id DESC");
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin - Orders</title>
<style>
body {font-family: Arial, sans-serif; background: #f2f4f7; margin:0; padding:20px;}
h1 {color: #333; text-align:center; margin-bottom:30px;}
table {width:100%; border-collapse:collapse; background:white;}
th, td {padding:12px; border:1px solid #ccc; text-align:center;}
th {background:#007bff; color:white;}
tr:nth-child(even) {background:#f9f9f9;}
.status-pending {color: orange; font-weight:bold;}
.status-onway {color: green; font-weight:bold;}
.no-orders {text-align:center; margin-top:20px; font-size:18px; color:#555;}
</style>
</head>
<body>

<h1>Orders Management</h1>

<?php if (!empty($orders)): ?>
<table>
<tr>
    <th>ID</th>
    <th>Customer</th>
    <th>Phone</th>
    <th>Products</th>
    <th>Payment Method</th>
    <th>Payment Number</th>
    <th>Total</th>
    <th>Status</th>
    <th>Date</th>
</tr>

<?php foreach ($orders as $order): 
    // Split payment method and number
    $paymentMethod = $order['payment_method'];
    $paymentNumber = '';
    
    // Check if it contains a space (for mobile money number)
    if (strpos($paymentMethod, ' ') !== false) {
        $parts = explode(' ', $paymentMethod, 2);
        $paymentMethod = $parts[0] . ' ' . $parts[1]; // keep full method name
        $paymentNumber = $parts[1]; // number
        // For MTN/Airtel/Zamtel
        if (preg_match('/\d{10}/', $paymentMethod, $matches)) {
            $paymentNumber = $matches[0];
        }
    }
?>
<tr>
    <td><?= htmlspecialchars($order['id']) ?></td>
    <td><?= htmlspecialchars($order['user_initials']) ?></td>
    <td><?= htmlspecialchars($order['phone']) ?></td>
    <td><?= htmlspecialchars($order['customer_name']) ?></td>
    <td><?= htmlspecialchars($order['payment_method']) ?></td>
    <td><?= htmlspecialchars($paymentNumber) ?></td>
    <td>$<?= number_format($order['total'], 2) ?></td>
    <td class="<?= strtolower(str_replace(' ','',$order['status'])) === 'pending' ? 'status-pending' : 'status-onway' ?>">
        <?= htmlspecialchars($order['status']) ?>
    </td>
    <td><?= htmlspecialchars($order['order_date']) ?></td>
</tr>
<?php endforeach; ?>

</table>
<?php else: ?>
<p class="no-orders">No orders found.</p>
<?php endif; ?>

</body>
</html>