<?php
session_start();
require 'db.php'; // PDO connection

// STATIC LAPTOPS
$staticLaptops = [
  1 => ["Dell Inspiron 15", 699.00, "images/laptop1.jpg"],
  2 => ["HP Pavilion 14", 649.00, "images/laptop2.jpg"],
  3 => ["Lenovo IdeaPad 5", 599.00, "images/laptop3.jpg"],
  4 => ["Asus VivoBook 15", 629.00, "images/laptop4.jpg"],
  5 => ["Acer Aspire 7", 699.00, "images/laptop5.jpg"],
  6 => ["Apple MacBook Air M1", 999.00, "images/laptop6.jpg"],
  7 => ["Apple MacBook Pro 14\"", 1699.00, "images/laptop7.jpg"],
  8 => ["Microsoft Surface Laptop 4", 1099.00, "images/laptop8.jpg"],
  9 => ["Razer Blade 15 Gaming", 1899.00, "images/laptop9.jpg"],
  10 => ["Alienware m15 R6", 2099.00, "images/laptop10.jpg"]
];

// DYNAMIC LAPTOPS FROM DATABASE (id > 10)
$stmt = $conn->prepare("SELECT id, name, price, image FROM products WHERE category='laptop' AND id > 10 ORDER BY id DESC");
$stmt->execute();
$dynamicLaptops = $stmt->fetchAll(PDO::FETCH_ASSOC);

// ADD TO CART LOGIC
if(isset($_GET['add_id'])){
    $id = $_GET['add_id'];

    // Check static laptops first
    if(isset($staticLaptops[$id])){
        $product = $staticLaptops[$id];
        $name = $product[0];
        $price = $product[1];
        $image = $product[2];
    } else {
        // Look in DB
        $stmt = $conn->prepare("SELECT id,name,price,image FROM products WHERE id=?");
        $stmt->execute([$id]);
        $dbProduct = $stmt->fetch(PDO::FETCH_ASSOC);
        if($dbProduct){
            $name = $dbProduct['name'];
            $price = $dbProduct['price'];
            $image = $dbProduct['image'];
        } else {
            $name = $price = $image = null;
        }
    }

    if($name){
        if(isset($_SESSION['cart'][$id])){
            $_SESSION['cart'][$id]['qty']++;
        } else {
            $_SESSION['cart'][$id] = [
                'name' => $name,
                'price' => $price,
                'image' => $image,
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
<title>Tech Store - Laptops</title>
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
  background-color: rgba(242, 243, 246,1);
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

nav a:hover {
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
  background: #2563eb;
  color: white;
  padding: 40px 5%;
  text-align: center;
  font-size: 1.8rem;
  font-weight: 700;
  margin-bottom: 30px;
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
  grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
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
  height: 200px;
  object-fit: cover;
}

.product-title {
  font-size: 1.1rem;
  font-weight: 600;
  margin: 15px 0 10px 0;
}

.price {
  font-weight: 700;
  color: #2563eb;
  font-size: 1.2rem;
  margin-bottom: 15px;
}

.product-card form button {
  background-color: #2563eb;
  color: white;
  border: none;
  padding: 10px 18px;
  border-radius: 8px;
  cursor: pointer;
  font-weight: 600;
  transition: background-color 0.2s;
}

.product-card form button:hover {
  background-color: #1d4ed8;
}

footer {
  background-color: #1f2937;
  color: white;
  padding: 40px 5% 20px;
  text-align: center;
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

<header>Tech Store</header>

<nav>
  <a href="index.php">Home</a>
  <a href="deals.php">Deals</a>
  <a href="laptops.php">Laptops</a>
  <a href="smartphones.php">Smartphones</a>
  <a href="accessories.php">Accessories</a>
  <a href="cart.php">Cart</a>
</nav>

<div class="banner">Laptops On Sale</div>

<section class="products-section">
<div class="section-title">Hot Laptop Deals</div>
<div class="product-grid">

<?php
// STATIC LAPTOPS
foreach($staticLaptops as $id => $lap){
    echo "<div class='product-card'>
        <a href='laptops.php?add_id=$id'>
            <img src='{$lap[2]}' alt='{$lap[0]}'>
            <div class='product-title'>{$lap[0]}</div>
            <div class='price'>\${$lap[1]}</div>
        </a>
        <form method='get' action='laptops.php'>
            <input type='hidden' name='add_id' value='$id'>
            <button type='submit'>Buy</button>
        </form>
    </div>";
}

// DYNAMIC LAPTOPS
if($dynamicLaptops){
    foreach($dynamicLaptops as $row){
        echo "<div class='product-card'>
            <a href='laptops.php?add_id={$row['id']}'>
                <img src='{$row['image']}' alt='{$row['name']}'>
                <div class='product-title'>{$row['name']}</div>
                <div class='price'>\${$row['price']}</div>
            </a>
            <form method='get' action='laptops.php'>
                <input type='hidden' name='add_id' value='{$row['id']}'>
                <button type='submit'>Buy</button>
            </form>
        </div>";
    }
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