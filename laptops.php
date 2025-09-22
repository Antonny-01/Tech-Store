<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Tech Store - Laptops</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      background: url('images/download1.jpg') no-repeat center center fixed;
      background-size: cover;
      color: #222;
      margin: 0;
      font-family: Arial, sans-serif;
    }
    .product-grid {
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      gap: 20px;
      padding: 20px;
    }
    .product-card {
      background: #fff;
      padding: 10px;
      border-radius: 8px;
      text-align: center;
      transition: 0.3s;
    }
    .product-card:hover {
      transform: scale(1.05);
    }
    .product-card img {
      width: 100%;
      height: 150px;
      object-fit: cover;
    }
    .product-title {
      font-weight: bold;
      margin: 10px 0;
    }
    .price {
      color: green;
      font-size: 18px;
    }
    header, nav, footer {
      padding: 15px;
      background: rgba(255,255,255,0.9);
      margin-bottom: 10px;
    }
    nav a {
      margin: 0 10px;
      text-decoration: none;
    }
    footer {
      text-align: center;
    }
  </style>
</head>
<body>

<header>
  <div class="logo">Tech Store</div>
</header>

<nav>
  <a href="index.php">Home</a>
  <a href="deals.html">Deals</a>
  <a href="laptops.php">Laptops</a>
  <a href="smartphones.php">Smartphones</a>
  <a href="accessories.html">Accessories</a>
  <a href="support.php">Support</a>
</nav>

<div class="banner">Laptops On Sale</div>

<section class="products-section">
  <div class="section-title">Hot Laptop Deals (15 Items)</div>
  <div class="product-grid">

    <?php
    $laptops = [
      1 => ["Dell Inspiron 15", "$699.00", "images/laptop1.jpg"],
      2 => ["HP Pavilion 14", "$649.00", "images/laptop2.jpg"],
      3 => ["Lenovo IdeaPad 5", "$599.00", "images/laptop3.jpg"],
      4 => ["Asus VivoBook 15", "$629.00", "images/laptop4.jpg"],
      5 => ["Acer Aspire 7", "$699.00", "images/laptop5.jpg"],
      6 => ["Apple MacBook Air M1", "$999.00", "images/laptop6.jpg"],
      7 => ["Apple MacBook Pro 14\"", "$1,699.00", "images/laptop7.jpg"],
      8 => ["Microsoft Surface Laptop 4", "$1,099.00", "images/laptop8.jpg"],
      9 => ["Razer Blade 15 Gaming", "$1,899.00", "images/laptop9.jpg"],
      10 => ["Alienware m15 R6", "$2,099.00", "images/laptop10.jpg"],
      11 => ["Samsung Galaxy Book Pro", "$1,149.00", "images/laptop11.jpg"],
      12 => ["Huawei MateBook D15", "$749.00", "images/laptop12.jpg"],
      13 => ["MSI GF65 Thin", "$1,099.00", "images/laptop13.jpg"],
      14 => ["Gigabyte Aorus 15", "$1,299.00", "images/laptop14.jpg"],
      15 => ["Chromebook Flex 5", "$429.00", "images/laptop15.jpg"],
    ];

    foreach ($laptops as $id => $lap) {
      echo "
        <div class='product-card'>
          <a href='laptop-details.php?id=$id'>
            <img src='{$lap[2]}' alt='{$lap[0]}'>
            <div class='product-title'>{$lap[0]}</div>
            <div class='price'>{$lap[1]}</div>
          </a>
        </div>
      ";
    }
    ?>

  </div>
</section>

<footer>
  2025 Tech Store | <a href="#">About Us</a> | <a href="#">Help</a> | 
  <a href="#">Privacy</a> | <a href="#">Terms</a>
</footer>

</body>
</html>