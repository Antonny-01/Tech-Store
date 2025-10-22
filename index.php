<?php
session_start();

// Static products array 
$products = [
    1 => ["Gaming Laptop GTX 3060", 1299.00, "images/download4.jpg", "Laptops"],
    2 => ["iPhone 15 - 128GB", 999.00, "images/iphone15.jpg", "Smartphones"],
    3 => ["Dell Inspiron 15", 699.00, "images/laptop1.jpg", "Laptops"],
    4 => ["Fast Wireless Charger", 39.99, "images/wirelesscharger.jpg", "Accessories"]
];

// Add to cart logic
if(isset($_GET['add_id'])){
    $id = $_GET['add_id'];

    if(isset($products[$id])){
        $product = $products[$id];

        if(isset($_SESSION['cart'][$id])){
            $_SESSION['cart'][$id]['qty']++;
        } else {
            $_SESSION['cart'][$id] = [
                'name' => $product[0],
                'price' => $product[1],
                'image' => $product[2],
                'qty' => 1
            ];
        }

        
        header("Location: cart.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tech Store - Latest Tech Products & Gadgets</title>
  

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


.top-bar {
  background-color: #2563eb;
  color: white;
  padding: 8px 0;
  font-size: 0.85rem;
  text-align: center;
}


header {
  background-color: white;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
  position: sticky;
  top: 0;
  z-index: 100;
}

.header-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 15px 5%;
  max-width: 1400px;
  margin: 0 auto;
}

.logo {
  font-size: 1.8rem;
  font-weight: 700;
  color: #2563eb;
  display: flex;
  align-items: center;
  gap: 8px;
}

.logo i {
  color: #f59e0b;
}

.search-bar {
  flex: 1;
  max-width: 600px;
  margin: 0 20px;
  position: relative;
}

.search-bar input {
  width: 100%;
  padding: 12px 20px;
  border: 1px solid #e5e7eb;
  border-radius: 8px;
  font-size: 1rem;
  background-color: #f9fafb;
  transition: all 0.2s;
}

.search-bar input:focus {
  outline: none;
  border-color: #2563eb;
  box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
  background-color: white;
}

.search-bar button {
  position: absolute;
  right: 5px;
  top: 5px;
  padding: 7px 15px;
  border: none;
  background-color: #2563eb;
  color: white;
  border-radius: 6px;
  cursor: pointer;
  transition: background-color 0.2s;
}

.user-links {
  display: flex;
  align-items: center;
  gap: 20px;
}

.user-links a {
  color: #1f2937;
  text-decoration: none;
  display: flex;
  flex-direction: column;
  align-items: center;
  font-size: 0.9rem;
  transition: color 0.2s;
}

.user-links a:hover {
  color: #2563eb;
}

.user-initials {
  background-color: #2563eb;
  color: white;
  font-weight: 600;
  padding: 10px;
  border-radius: 50%;
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
}

/* ===============================
   NAVIGATION
=============================== */
nav {
  background-color: rgba(242, 243, 246, 1);
  border-top: 1px solid #e5e7eb;
  padding: 0 5%;
}

.nav-container {
  display: flex;
  justify-content: center;
  gap: 30px;
  max-width: 1400px;
  margin: 0 auto;
}

nav a {
  color: #1f2937;
  text-decoration: none;
  padding: 12px 0;
  font-weight: 500;
  position: relative;
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


.hero {
  background: linear-gradient(to right, rgba(0,0,0,0.7), rgba(0,0,0,0.3));
  background-image: url('images/download1.jpg');
  background-repeat: no-repeat;
  background-position: center center;
  background-size: cover;
  color: white;
  padding: 80px 5%;
  text-align: center;
  margin-bottom: 40px;
}

.hero h1 {
  font-size: 2.8rem;
  margin-bottom: 16px;
  font-weight: 700;
}

.hero p {
  font-size: 1.2rem;
  margin-bottom: 30px;
}

.btn {
  padding: 12px 24px;
  border-radius: 8px;
  font-weight: 600;
  text-decoration: none;
  transition: all 0.2s;
}

.btn-primary {
  background-color: #2563eb;
  color: white;
}

/* ===============================
   CONTAINER & SECTION TITLE
=============================== */
.container {
  max-width: 1400px;
  margin: 0 auto;
  padding: 0 5%;
}

.section-title {
  font-size: 1.8rem;
  font-weight: 700;
  margin-bottom: 30px;
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
}


.product-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
  gap: 25px;
  margin-bottom: 50px;
}

.product-card {
  background-color: white;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 4px 6px rgba(0,0,0,0.05);
  transition: transform 0.3s;
  transition: box-shadow 0.3s;
  cursor: pointer;
}

.product-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 15px rgba(0,0,0,0.1);
}

.product-image {
  height: 200px;
  width: 100%;
  object-fit: cover;
}

.product-info {
  padding: 20px;
}

.product-category {
  color: #6b7280;
  font-size: 0.85rem;
  margin-bottom: 5px;
}

.product-title {
  font-size: 1.1rem;
  font-weight: 600;
  margin-bottom: 10px;
}

.product-price {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-top: 15px;
}

.price {
  font-weight: 700;
  color: #2563eb;
  font-size: 1.2rem;
}

.add-to-cart {
  background-color: #2563eb;
  color: white;
  border: none;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  cursor: pointer;
  transition: background-color 0.2s;
}


footer {
  background-color: #1f2937;
  color: white;
  padding: 60px 5% 30px;
  margin-top: 50px;
}

.footer-container {
  max-width: 1400px;
  margin: 0 auto;
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 40px;
}

.social-links {
  display: flex;
  gap: 15px;
  margin-top: 20px;
}

.social-links a {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  background-color: rgba(255,255,255,0.1);
  transition: 0.3s;
}

.social-links a:hover {
  background-color: #2563eb;
}

footer a {
  color: #fafafa;
  text-decoration: none;
  margin: 0 8px;
}

.copyright {
  text-align: center;
  margin-top: 50px;
  border-top: 1px solid rgba(255,255,255,0.1);
  padding-top: 20px;
  color: #9ca3af;
}
  </style>
</head>
<body>
 
  <div class="top-bar">
    <p>Free shipping on orders over $50 | 30-day money-back guarantee</p>
  </div>
>
  <header>
    <div class="header-container">
      <a href="index.php" class="logo"><i class="fas fa-laptop-code"></i> TechStore</a>

      <div class="search-bar">
        <input type="text" placeholder="Search for products...">
        <button><i class="fas fa-search"></i></button>
      </div>

      <div class="user-links">
        <?php if(isset($_SESSION['initials'])): ?>
          <div class="user-initials"><?php echo $_SESSION['initials']; ?></div>
          <a href="logout.php">Logout</a>
        <?php else: ?>
          <a href="login.html"><i class="fas fa-user"></i><span>Login</span></a>
        <?php endif; ?>
        <a href="cart.php">🛒 Cart</a>
      </div>
    </div>
  </header>


  <nav>
    <div class="nav-container">
      <a href="index.php">Home</a>
      <a href="deals.php">Deals</a>
      <a href="laptops.php">Laptops</a>
      <a href="smartphones.php">Smartphones</a>
      <a href="accessories.php">Accessories</a>
      <a href="support.html">Support</a>
    </div>
  </nav>

  
  <section class="hero">
    <h1>Cutting-Edge Technology for Everyday Life</h1>
    <p>Discover the latest gadgets and innovations with free shipping and satisfaction guaranteed.</p>
    <a href="deals.php" class="btn btn-primary">Shop Latest Deals</a>
  </section>

  <!-- Featured Products -->
  <section class="container">
    <h2 class="section-title">Featured Products</h2>
    <div class="product-grid">
      <?php
      // Render products
      foreach($products as $id => $p){
          echo '<div class="product-card">';
          echo '<img src="'.$p[2].'" class="product-image" alt="'.$p[0].'">';
          echo '<div class="product-info">';
          echo '<div class="product-category">'.$p[3].'</div>';
          echo '<h3 class="product-title">'.$p[0].'</h3>';
          echo '<div class="product-price">';
          echo '<div class="price">$'.number_format($p[1],2).'</div>';
          echo '<form method="get" action="">';
          echo '<input type="hidden" name="add_id" value="'.$id.'">';
          echo '<button type="submit" class="add-to-cart"><i class="fas fa-plus"></i></button>';
          echo '</form>';
          echo '</div>'; // product-price
          echo '</div>'; // product-info
          echo '</div>'; // product-card
      }
      ?>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <div class="footer-container">
      <div>
        <h3>TechStore</h3>
        <p>Your trusted partner for all tech needs. The latest gadgets with guaranteed quality and support.</p>
      </div>
    </div>
    <div class="copyright">
      <p>&copy; 2025 TechStore. All rights reserved.</p>
    </div>
  </footer>
</body>
</html>