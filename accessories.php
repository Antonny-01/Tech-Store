<?php
session_start();
require 'db.php'; // PDO connection

// Fetch dynamic accessories from DB
try {
    $category = 'accessories';
    $stmt = $conn->prepare("SELECT * FROM products WHERE category = ?");
    $stmt->execute([$category]);
    $dynamicProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error loading products: " . $e->getMessage());
}

// Add to cart logic
if(isset($_GET['add_id'])){
    $id = $_GET['add_id'];

    // Find the product in the database
    $found = false;
    foreach($dynamicProducts as $dp){
        if($dp['id'] == $id){
            $found = true;
            $name = $dp['name'];
            $price = $dp['price'];
            $image = $dp['image']; // Ensure this is the correct filename/path
            break;
        }
    }

    if($found){
        // If product already in cart, increase qty, otherwise add new
        if(isset($_SESSION['cart'][$id])){
            $_SESSION['cart'][$id]['qty']++;
        } else {
            $_SESSION['cart'][$id] = [
                'name' => $name,
                'price' => $price,
                'image' => "images/$image", // Store full path for cart
                'qty' => 1
            ];
        }

        header("Location: cart.php");
        exit;
    }
}

$conn = null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Tech Store - Accessories</title>
<link rel="stylesheet" href="style.css">
<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Inter', sans-serif;
}

body {
  background-color: #167adeff;
  color: #1f2937;
  line-height: 1.6;
}



nav {
  background-color: rgba(242,243,246,1);
  border-top: 1px solid #e5e7eb;
  padding: 0 5%;
}

nav a {
  color: #0d0d0dff;
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
  background-color: #0644caff;
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
  object-fit: contain;
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
  margin-bottom: 10px;
}

.product-card form button,
.product-card a.buy-btn {
  display: inline-block;
  padding: 10px 16px;
  margin-top: 10px;
  background-color: #2563eb;
  color: white;
  border-radius: 8px;
  text-decoration: none;
  font-weight: 600;
  border: none;
  cursor: pointer;
  transition: background-color 0.2s;
}

.product-card form button:hover,
.product-card a.buy-btn:hover {
  background-color: #1d4ed8;
}

footer {
  background-color: #1b6ddfff;
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
  <div class="logo">Tech Store</div>
  <div><a href="cart.php" style="color:#fff; text-decoration:none;">Cart</a></div>
</header>

<nav>
  <a href="index.php">Home</a>
  <a href="deals.php">Deals</a>
  <a href="laptops.php">Laptops</a>
  <a href="smartphones.php">Smartphones</a>
  <a href="accessories.php">Accessories</a>
  <a href="support.php">Support</a>
</nav>

<div class="banner">Accessories On Sale</div>

<section class="products-section">
  <div class="section-title">Hot Accessories Deals</div>
  <div class="product-grid">

  <?php
  // Static accessories (optional)
  $staticProducts = [
      // Example: ["USB Cable", "usb-cable.jpg", 9.99, 101]
  ];
  foreach($staticProducts as $sp){
      echo "<div class='product-card'>
              <img src='images/{$sp[1]}' alt='{$sp[0]}'>
              <div class='product-title'>{$sp[0]}</div>
              <div class='price'>\$".number_format($sp[2],2)."</div>
              <form method='get' action='accessories.php'>
                  <input type='hidden' name='add_id' value='{$sp[3]}'>
                  <button type='submit'>Buy</button>
              </form>
            </div>";
  }

  // Dynamic products
  foreach($dynamicProducts as $dp){
      echo "<div class='product-card'>
              <img src='images/{$dp['image']}' alt='{$dp['name']}'>
              <div class='product-title'>{$dp['name']}</div>
              <div class='price'>\$".number_format($dp['price'],2)."</div>
              <form method='get' action='accessories.php'>
                  <input type='hidden' name='add_id' value='{$dp['id']}'>
                  <button type='submit'>Buy</button>
              </form>
            </div>";
  }
  ?>

  </div>
</section>

<footer>
  2025 Tech Store |
  <a href="#">About Us</a> |
  <a href="#">Help</a> |
  <a href="#">Privacy</a> |
  <a href="#">Terms</a>
</footer>

</body>
</html>