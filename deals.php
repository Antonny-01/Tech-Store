<?php
session_start();
require 'db.php'; // PDO connection

// Fetch dynamic deals
$stmt = $conn->prepare("SELECT * FROM products WHERE category='deals'");
$stmt->execute();
$dealProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
$conn = null;

// Static deals
$staticDeals = [
    1 => ["High-Performance Laptop", "download1.jpg", 999.00, 1299.00],
    2 => ["Noise-Cancelling Earbuds", "deal2.jpg", 69.99, 99.99],
    3 => ["Ultra HD 4K Monitor", "deal3.jpg", 299.00, 399.00],
    4 => ["Mechanical Gaming Keyboard", "deal4.jpg", 79.99, 109.99],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Tech Store - Deals</title>
<link rel="stylesheet" href="style.css">
<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Inter', sans-serif;
}

body {
  background-color: #f8fafc;
  color: #1f2937;
  line-height: 1.6;
}


nav {
  background-color: rgba(242,243,246,1);
  border-top: 1px solid #e5e7eb;
  padding: 0 5%;
}

nav a {
  color: #1f2937;
  text-decoration: none;
  font-weight: 500;
  padding: 12px 0;
  display: inline-block;
  position: relative;
  transition: color 0.2s;
}

nav a:hover,
nav a.active {
  color: #2563eb;
}

nav a:hover::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 3px;
  background-color: #2563eb;
  border-radius: 3px 3px 0 0;
}

.banner {
  background-color: #2563eb;
  color: white;
  text-align: center;
  padding: 40px 5%;
  font-size: 1.8rem;
  font-weight: 700;
  margin: 20px 5%;
  border-radius: 8px;
}

.products-section {
  padding: 0 5%;
  margin-bottom: 50px;
}

.section-title {
  font-size: 1.8rem;
  font-weight: 700;
  margin-bottom: 25px;
  position: relative;
  padding-bottom: 10px;
}

.section-title::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 60px;
  height: 4px;
  background-color: #f59e0b;
  border-radius: 2px;
}

.product-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(250px,1fr));
  gap: 25px;
}

.product-card {
  background-color: white;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 4px 6px rgba(0,0,0,0.05);
  transition: transform 0.3s, box-shadow 0.3s;
  text-align: center;
}

.product-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 15px rgba(0,0,0,0.1);
}

.product-card img {
  width: 100%;
  height: 160px;
  object-fit: cover;
  border-radius: 6px;
  margin-bottom: 10px;
}

.product-title {
  font-size: 1.1rem;
  font-weight: 600;
  margin: 10px 0 8px 0;
}

.price {
  font-weight: 700;
  color: #2563eb;
  font-size: 1.2rem;
}

.original-price {
  text-decoration: line-through;
  color: #777;
  margin-left: 8px;
  font-weight: normal;
  font-size: 0.9rem;
}

.product-card a.buy-btn {
  display: inline-block;
  padding: 10px 16px;
  margin-top: 10px;
  background-color: #2563eb;
  color: white;
  border-radius: 8px;
  text-decoration: none;
  font-weight: 600;
  transition: background-color 0.2s;
}

.product-card a.buy-btn:hover {
  background-color: #1d4ed8;
}

footer {
  background-color: #0a66e8ff;
  color: white;
  text-align: center;
  padding: 40px 5% 20px;
  margin-top: 50px;
}

footer a {
  color: white;
  margin: 0 5px;
  text-decoration: none;
}

footer a:hover {
  text-decoration: underline;
}
</style>
</head>
<body>

<header>
  Tech Store
  <a href="cart.php" style="color:#fff; text-decoration:none;">Cart</a>
</header>

<nav>
  <a href="index.php">Home</a>
  <a href="deals.php" class="active">Deals</a>
  <a href="laptops.php">Laptops</a>
  <a href="smartphones.php">Smartphones</a>
  <a href="accessories.php">Accessories</a>
  <a href="support.php">Support</a>
</nav>

<div class="banner">Hot Tech Deals</div>

<section class="products-section">
  <div class="section-title">Limited-Time Discounts</div>
  <div class="product-grid">

  <?php
  // Static deals
  foreach($staticDeals as $id => $sd){
      echo "<div class='product-card'>
              <img src='images/{$sd[1]}' alt='{$sd[0]}'>
              <div class='product-title'>{$sd[0]}</div>
              <div><span class='price'>\$".number_format($sd[2],2)."</span>
                   <span class='original-price'>\$".number_format($sd[3],2)."</span>
              </div>
              <a class='buy-btn' href='cart.php?action=add&id={$id}'>Buy</a>
            </div>";
  }

  // Dynamic deals
  foreach($dealProducts as $dp){
      echo "<div class='product-card'>
              <img src='images/{$dp['image']}' alt='{$dp['name']}'>
              <div class='product-title'>{$dp['name']}</div>
              <div class='price'>\$".number_format($dp['price'],2)."</div>
              <a class='buy-btn' href='cart.php?action=add&id={$dp['id']}'>Buy</a>
            </div>";
  }
  ?>

  </div>
</section>

<footer>
  &copy; 2025 Tech Store |
  <a href="#">About Us</a> |
  <a href="#">Help</a> |
  <a href="#">Privacy</a> |
  <a href="#">Terms</a>
</footer>

</body>
</html>