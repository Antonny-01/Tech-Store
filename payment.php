<?php
session_start();
if (!isset($_SESSION['payment_method']) || empty($_SESSION['cart'])) {
    header("Location: checkout.php");
    exit;
}

// Calculate total
$grandTotal = 0;
foreach ($_SESSION['cart'] as $item) {
    $grandTotal += $item['price'] * $item['qty'];
}

$method = $_SESSION['payment_method'];

// Handle form submission
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (in_array($method, ['MTN Mobile Money','Airtel Money','Zamtel Kwacha'])) {
        $number = trim($_POST['number']);
        if (!preg_match('/^\d{10}$/', $number)) {
            $error = "Please enter a valid 10-digit number.";
        } else {
            $_SESSION['payment_number'] = $number;
            $_SESSION['payment_amount'] = $grandTotal;
            header("Location: address.php");
            exit;
        }
    } else {
        // Debit / PayPal
        $_SESSION['payment_amount'] = $grandTotal;
        header("Location: address.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Payment - Tech Store</title>
<style>
body{font-family:Arial,sans-serif;text-align:center;padding:50px;background:#f5f5f5;}
input{padding:10px;width:300px;margin:10px 0;border-radius:5px;border:1px solid #ccc;}
button{padding:15px 30px;font-size:18px;border:none;background:#2563eb;color:white;border-radius:6px;cursor:pointer;}
.error{color:red;margin:10px 0;}
</style>
</head>
<body>
<h2>Payment - <?= htmlspecialchars($method) ?></h2>
<p>Total Amount: $<?= number_format($grandTotal,2) ?></p>

<?php if ($error): ?>
<p class="error"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST">
<?php if (in_array($method, ['MTN Mobile Money','Airtel Money','Zamtel Kwacha'])): ?>
    <label>Enter <?= $method ?> Number (10 digits):</label><br>
    <input type="text" name="number" placeholder="e.g. 0971234567" maxlength="10" required pattern="\d{10}"><br>
<?php else: ?>
    <p>No additional info needed. Click Confirm to proceed.</p>
<?php endif; ?>

<button type="submit">Next</button>
</form>
</body>
</html>