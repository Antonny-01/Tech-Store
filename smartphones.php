<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Tech Store - Smartphones</title>
  <link rel="stylesheet" href="style.css">
</head>
<style>
  body {
    background: url('images/download2.jpg') no-repeat center center fixed;
    background-size: cover;
    color: #222;
    margin: 0;
    font-family: Arial, sans-serif;
  }
</style>
<body>

  <header>
    <div class="logo">Tech Store</div>
    <div class="search-bar">
      <input type="text" placeholder="Search tech products..." />
      <button>Search</button>
    </div>
    <div class="user-links">
      <a href="cart.php"><i class="fas fa-shopping-cart"></i></a>
    </div>
  </header>

  <nav>
    <a href="index.php">Home</a>
    <a href="deals.html">Deals</a>
    <a href="laptops.php">Laptops</a>
    <a href="smartphones.php">Smartphones</a>
    <a href="accessories.html">Accessories</a>
    <a href="support.html">Support</a>
  </nav>

  <div class="banner">Smartphones On Sale</div>

  <section class="products-section">
    <div class="section-title">Hot Smartphone Deals (15 Items)</div>
    <div class="product-grid">
      <div class="product-card">
        <a href="smartphone-details.php?id=1">
          <img src="images/iphone15.jpg" alt="iPhone 15">
          <div class="product-title">iPhone 15</div>
          <div class="price">$999.00</div>
        </a>
      </div>
      <div class="product-card">
        <a href="smartphone-details.php?id=2">
          <img src="images/iphone15pro.jpg" alt="iPhone 15 Pro">
          <div class="product-title">iPhone 15 Pro</div>
          <div class="price">$1,199.00</div>
        </a>
      </div>
      <div class="product-card">
        <a href="smartphone-details.php?id=3">
          <img src="images/galaxys23.jpg" alt="Samsung Galaxy S23">
          <div class="product-title">Samsung Galaxy S23</div>
          <div class="price">$899.00</div>
        </a>
      </div>
      <div class="product-card">
        <a href="smartphone-details.php?id=4">
          <img src="images/pixel8.jpg" alt="Google Pixel 8">
          <div class="product-title">Google Pixel 8</div>
          <div class="price">$799.00</div>
        </a>
      </div>
      <div class="product-card">
        <a href="smartphone-details.php?id=5">
          <img src="images/oneplus12.jpg" alt="OnePlus 12">
          <div class="product-title">OnePlus 12</div>
          <div class="price">$749.00</div>
        </a>
      </div>
      <div class="product-card">
        <a href="smartphone-details.php?id=6">
          <img src="images/xiaomi14.jpg" alt="Xiaomi 14">
          <div class="product-title">Xiaomi 14</div>
          <div class="price">$699.00</div>
        </a>
      </div>
      <div class="product-card">
        <a href="smartphone-details.php?id=7">
          <img src="images/sony1v.jpg" alt="Sony Xperia 1 V">
          <div class="product-title">Sony Xperia 1 V</div>
          <div class="price">$949.00</div>
        </a>
      </div>
      <div class="product-card">
        <a href="smartphone-details.php?id=8">
          <img src="images/huaweiP60.jpg" alt="Huawei P60 Pro">
          <div class="product-title">Huawei P60 Pro</div>
          <div class="price">$899.00</div>
        </a>
      </div>
      <div class="product-card">
        <a href="smartphone-details.php?id=9">
          <img src="images/motorolaedge40.jpg" alt="Motorola Edge 40">
          <div class="product-title">Motorola Edge 40</div>
          <div class="price">$599.00</div>
        </a>
      </div>
      <div class="product-card">
        <a href="smartphone-details.php?id=10">
          <img src="images/nokiaX50.jpg" alt="Nokia X50">
          <div class="product-title">Nokia X50</div>
          <div class="price">$499.00</div>
        </a>
      </div>
      <div class="product-card">
        <a href="smartphone-details.php?id=11">
          <img src="images/asusrog8.jpg" alt="Asus ROG Phone 8">
          <div class="product-title">Asus ROG Phone 8</div>
          <div class="price">$899.00</div>
        </a>
      </div>
      <div class="product-card">
        <a href="smartphone-details.php?id=12">
          <img src="images/oppoX6.jpg" alt="Oppo Find X6">
          <div class="product-title">Oppo Find X6</div>
          <div class="price">$699.00</div>
        </a>
      </div>
      <div class="product-card">
        <a href="smartphone-details.php?id=13">
          <img src="images/iphone14.jpg" alt="iPhone 14">
          <div class="product-title">iPhone 14</div>
          <div class="price">$799.00</div>
        </a>
      </div>
      <div class="product-card">
        <a href="smartphone-details.php?id=14">
          <img src="images/galaxys22.jpg" alt="Samsung Galaxy S22">
          <div class="product-title">Samsung Galaxy S22</div>
          <div class="price">$699.00</div>
        </a>
      </div>
      <div class="product-card">
        <a href="smartphone-details.php?id=15">
          <img src="images/pixel7.jpg" alt="Google Pixel 7">
          <div class="product-title">Google Pixel 7</div>
          <div class="price">$599.00</div>
        </a>
      </div>
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