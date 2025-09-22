<?php
session_start();

// All laptops (name, price, image, description)
$laptops = [
  1 => ["Dell Inspiron 15", "$699.00", "images/laptop1.jpg", "15.6'' Full HD Display, Intel i5, 8GB RAM, 512GB SSD."],
  2 => ["HP Pavilion 14", "$649.00", "images/laptop2.jpg", "14'' Full HD, Intel i5, 8GB RAM, 256GB SSD, Windows 11."],
  3 => ["Lenovo IdeaPad 5", "$599.00", "images/laptop3.jpg", "15.6'' FHD, AMD Ryzen 5, 8GB RAM, 512GB SSD."],
  4 => ["Asus VivoBook 15", "$629.00", "images/laptop4.jpg", "15.6'' FHD, Intel i5, 8GB RAM, 256GB SSD."],
  5 => ["Acer Aspire 7", "$699.00", "images/laptop5.jpg", "15.6'' FHD, Ryzen 5, 8GB RAM, 512GB SSD, GTX 1650 GPU."],
  6 => ["Apple MacBook Air M1", "$999.00", "images/laptop6.jpg", "13.3'' Retina, Apple M1, 8GB RAM, 256GB SSD."],
  7 => ["Apple MacBook Pro 14\"", "$1,699.00", "images/laptop7.jpg", "14'' Liquid Retina XDR, Apple M1 Pro, 16GB RAM, 512GB SSD."],
  8 => ["Microsoft Surface Laptop 4", "$1,099.00", "images/laptop8.jpg", "13.5'' Touchscreen, Ryzen 5, 8GB RAM, 256GB SSD."],
  9 => ["Razer Blade 15 Gaming", "$1,899.00", "images/laptop9.jpg", "15.6'' FHD 144Hz, i7, 16GB RAM, RTX 3060, 512GB SSD."],
  10 => ["Alienware m15 R6", "$2,099.00", "images/laptop10.jpg", "15.6'' QHD 240Hz, i7, 16GB RAM, RTX 3070, 1TB SSD."],
  11 => ["Samsung Galaxy Book Pro", "$1,149.00", "images/laptop11.jpg", "15.6'' AMOLED, i7, 16GB RAM, 512GB SSD."],
  12 => ["Huawei MateBook D15", "$749.00", "images/laptop12.jpg", "15.6'' FHD, Ryzen 5, 8GB RAM, 512GB SSD."],
  13 => ["MSI GF65 Thin", "$1,099.00", "images/laptop13.jpg", "15.6'' 144Hz, i7, 16GB RAM, GTX 1660 Ti, 512GB SSD."],
  14 => ["Gigabyte Aorus 15", "$1,299.00", "images/laptop14.jpg", "15.6'' 144Hz, i7, 16GB RAM, RTX 3060, 512GB SSD."],
  15 => ["Chromebook Flex 5", "$429.00", "images/laptop15.jpg", "13.3'' Touchscreen, Intel i3, 4GB RAM, 64GB eMMC."],
];

$id = $_GET['id'] ?? null;
if (!$id || !isset($laptops[$id])) {
  die("Laptop not found.");
}

$laptop = $laptops[$id];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo $laptop[0]; ?> - Tech Store</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
    }
    .product-details {
      max-width: 600px;
      margin: auto;
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      text-align: center;
    }
    .product-details img {
      width: 100%;
      max-height: 300px;
      object-fit: cover;
      margin-bottom: 20px;
    }
    .price {
      font-size: 20px;
      color: green;
      margin: 10px 0;
    }
    button {
      padding: 10px 20px;
      background: #007BFF;
      border: none;
      color: #fff;
      font-size: 16px;
      cursor: pointer;
      border-radius: 5px;
    }
    button:hover {
      background: #0056b3;
    }
  </style>
</head>
<body>

<header>
  <div class="logo">Tech Store</div>
</header>

<nav>
  <a href="index.php">Home</a>
  <a href="laptops.php">Laptops</a>
  <a href="cart.php">Cart</a>
</nav>

<section class="product-details">
  <img src="<?php echo $laptop[2]; ?>" alt="<?php echo $laptop[0]; ?>">
  <h2><?php echo $laptop[0]; ?></h2>
  <p><?php echo $laptop[3]; ?></p>
  <p class="price"><?php echo $laptop[1]; ?></p>
  <button onclick="window.location.href='cart.php?action=add&id=<?php echo $id; ?>'">Buy Now</button>
</section>

</body>
</html>