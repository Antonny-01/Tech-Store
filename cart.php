<?php
session_start();

// Remove or clear items
if(isset($_GET['remove_id'])){
    unset($_SESSION['cart'][$_GET['remove_id']]);
    header("Location: cart.php");
    exit;
}
if(isset($_GET['clear'])){
    unset($_SESSION['cart']);
    header("Location: cart.php");
    exit;
}

$grandTotal = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Your Cart - Tech Store</title>
<link rel="stylesheet" href="style.css">
<style>
body {font-family: Arial, sans-serif; background:#f5f5f5; margin:0; padding:0;}
nav {background:#333; padding:10px 20px; display:flex; justify-content:space-between; align-items:center;}
nav a {color:#fff; margin-right:15px; text-decoration:none;}
nav a:hover { text-decoration:underline; }

.nav-left, .nav-right {display:flex; align-items:center;}

.container {max-width:1200px; margin:30px auto; padding:0 20px;}
.cart-card {background:#fff; display:flex; align-items:center; padding:15px; margin-bottom:15px; border-radius:5px; box-shadow:0 2px 5px rgba(0,0,0,0.1);}
.cart-card img {width:120px; height:auto; margin-right:20px; border:1px solid #ddd; border-radius:5px;}
.cart-details {flex:1;}
.cart-details h3 {margin:0 0 10px 0;}
.cart-details .price {color:green; font-weight:bold; margin-bottom:5px;}
.cart-details .qty {margin-bottom:5px;}
.cart-actions {text-align:center;}
.cart-actions a {display:inline-block; padding:8px 15px; margin:3px 0; border-radius:4px; color:#fff; text-decoration:none;}
.btn-remove { background:red; }
.btn-clear { background:orange; }
.btn-checkout { background:green; font-size:16px; padding:10px 20px; }

.total-section {text-align:right; font-size:20px; margin-top:20px; margin-bottom:20px;}
.empty-cart {text-align:center; font-size:20px; margin-top:50px;}

.btn-login, .btn-signup {background:#2563eb; color:white; padding:8px 15px; border-radius:4px; text-decoration:none; margin-left:10px;}
.btn-login:hover, .btn-signup:hover {background:#1d4ed8;}
</style>
</head>
<body>

<header>Tech Store</header>

<!-- Navigation -->
<nav>
    <div class="nav-left">
        <a href="index.php">Home</a>
        <a href="laptops.php">Laptops</a>
        <a href="smartphones.php">Smartphones</a>
        <a href="accessories.php">Accessories</a>
        <a href="deals.php" class="active">Deals</a>
        
    </div>
    <div class="nav-right">
        <?php if(isset($_SESSION['initials'])): ?>
            <span style="color:white; font-weight:bold;">Hello, <?= $_SESSION['initials'] ?></span>
            <a class="btn-login" href="logout.php">Logout</a>
        <?php else: ?>
            <a class="btn-login" href="login.html">Login</a>
            <a class="btn-signup" href="signup.php">Signup</a>
        <?php endif; ?>
    </div>
</nav>

<div class="container">
<h2>Your Shopping Cart</h2>

<?php if(!empty($_SESSION['cart'])): ?>

<?php foreach($_SESSION['cart'] as $id => $item):
    $total = $item['price'] * $item['qty'];
    $grandTotal += $total;
?>
<div class="cart-card">
    <img src="<?= $item['image'] ?>" alt="<?= $item['name'] ?>">
    <div class="cart-details">
        <h3><?= $item['name'] ?></h3>
        <div class="price">$<?= number_format($item['price'],2) ?></div>
        <div class="qty">Quantity: <?= $item['qty'] ?></div>
        <div>Total: $<?= number_format($total,2) ?></div>
    </div>
    <div class="cart-actions">
        <a class="btn-remove" href="cart.php?remove_id=<?= $id ?>">Remove</a>
    </div>
</div>
<?php endforeach; ?>

<div class="total-section">
    <strong>Grand Total: $<?= number_format($grandTotal,2) ?></strong>
</div>

<div class="cart-actions">
    <a class="btn-clear" href="cart.php?clear=1">Clear Cart</a>
    <?php if(isset($_SESSION['initials'])): ?>
        <a class="btn-checkout" href="checkout.php">Proceed to Checkout</a>
    <?php else: ?>
        <a class="btn-checkout" href="javascript:void(0);" onclick="alert('Please login or signup before checking out!')">Proceed to Checkout</a>
    <?php endif; ?>
</div>

<?php else: ?>
<div class="empty-cart">
    <p>Your cart is empty.</p>
</div>
<?php endif; ?>
</div>

</body>
</html>