<?php
session_start();

// Smartphones array
$smartphones = [
  1 => ["iPhone 15", "999.00", "images/iphone15.jpg", "Latest iPhone with A16 Bionic chip and Dynamic Island."],
  2 => ["iPhone 15 Pro", "1199.00", "images/iphone15pro.jpg", "Pro model with titanium frame and A17 Pro chip."],
  3 => ["Samsung Galaxy S23", "899.00", "images/galaxys23.jpg", "Samsung’s flagship with Snapdragon 8 Gen 2 processor."],
  4 => ["Google Pixel 8", "799.00", "images/pixel8.jpg", "Pixel with AI-powered camera features and Android 14."],
  5 => ["OnePlus 12", "749.00", "images/oneplus12.jpg", "High-performance flagship with fast charging and AMOLED display."],
  6 => ["Xiaomi 14", "699.00", "images/xiaomi14.jpg", "Xiaomi’s premium smartphone with Leica cameras."],
  7 => ["Sony Xperia 1 V", "949.00", "images/sony1v.jpg", "Professional camera phone with 4K OLED display."],
  8 => ["Huawei P60 Pro", "899.00", "images/huaweiP60.jpg", "Flagship camera phone with advanced zoom technology."],
  9 => ["Motorola Edge 40", "599.00", "images/motorolaedge40.jpg", "Midrange device with curved display and clean Android."],
  10 => ["Nokia X50", "499.00", "images/nokiaX50.jpg", "Durable smartphone with long-lasting battery."],
  11 => ["Asus ROG Phone 8", "899.00", "images/asusrog8.jpg", "Gaming smartphone with Snapdragon 8 Gen 2 and cooling tech."],
  12 => ["Oppo Find X6", "699.00", "images/oppoX6.jpg", "Stylish Oppo flagship with Hasselblad-tuned cameras."],
  13 => ["iPhone 14", "799.00", "images/iphone14.jpg", "Previous generation iPhone with strong performance."],
  14 => ["Samsung Galaxy S22", "699.00", "images/galaxys22.jpg", "Samsung flagship from last year with strong camera setup."],
  15 => ["Google Pixel 7", "599.00", "images/pixel7.jpg", "Affordable Pixel with excellent Google software support."]
];

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if (!isset($smartphones[$id])) {
  echo "Smartphone not found!";
  exit;
}

$product = $smartphones[$id];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo $product[0]; ?> - Tech Store</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <header>
    <div class="logo">Tech Store</div>
    <div class="user-links">
      <a href="cart.php"><i class="fas fa-shopping-cart"></i></a>
    </div>
  </header>

  <nav>
    <a href="index.php">Home</a>
    <a href="smartphones.php">Back to Smartphones</a>
  </nav>

  <div class="product-details">
    <img src="<?php echo $product[2]; ?>" alt="<?php echo $product[0]; ?>">
    <h1><?php echo $product[0]; ?></h1>
    <p><?php echo $product[3]; ?></p>
    <div class="price">$<?php echo $product[1]; ?></div>
    <a href="cart.php?action=add&id=<?php echo $id; ?>&type=smartphone" class="btn">Buy Now</a>
  </div>

</body>
</html>