<?php
session_start();


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



if (isset($_GET['action'])) {
    $id = $_GET['id'] ?? null;

    switch ($_GET['action']) {
        case "add":
            if ($id && isset($laptops[$id])) {
                if (!isset($_SESSION['cart'][$id])) {
                    $_SESSION['cart'][$id] = ["qty" => 1];
                } else {
                    $_SESSION['cart'][$id]["qty"]++;
                }
            }
            break;

        case "remove":
            if ($id && isset($_SESSION['cart'][$id])) {
                unset($_SESSION['cart'][$id]);
            }
            break;

        case "clear":
            unset($_SESSION['cart']);
            break;
    }

    header("Location: cart.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Shopping Cart - Tech Store</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }
    table, th, td {
      border: 1px solid #ddd;
      text-align: center;
      padding: 10px;
    }
    th {
      background: #f4f4f4;
    }
    img {
      width: 100px;
    }
    .btn {
      padding: 8px 15px;
      border: none;
      color: #fff;
      cursor: pointer;
      border-radius: 4px;
    }
    .btn-remove {
      background: red;
    }
    .btn-clear {
      background: orange;
    }
    .btn-checkout {
      background: green;
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

<h2>Your Shopping Cart</h2>

<?php if (!empty($_SESSION['cart'])): ?>
  <table>
    <tr>
      <th>Image</th>
      <th>products</th>
      <th>Price</th>
      <th>Quantity</th>
      <th>Total</th>
      <th>Action</th>
    </tr>
    <?php
    $grandTotal = 0;
    foreach ($_SESSION['cart'] as $id => $item):
      $name = $laptops[$id][0];
      $price = floatval(str_replace(['$', ','], '', $laptops[$id][1]));
      $image = $laptops[$id][2];
      $qty = $item['qty'];
      $total = $price * $qty;
      $grandTotal += $total;
    ?>
    <tr>
      <td><img src="<?php echo $image; ?>" alt="<?php echo $name; ?>"></td>
      <td><?php echo $name; ?></td>
      <td><?php echo $laptops[$id][1]; ?></td>
      <td><?php echo $qty; ?></td>
      <td>$<?php echo number_format($total, 2); ?></td>
      <td><a class="btn btn-remove" href="cart.php?action=remove&id=<?php echo $id; ?>">Remove</a></td>
    </tr>
    <?php endforeach; ?>
    <tr>
      <td colspan="4"><strong>Grand Total</strong></td>
      <td colspan="2"><strong>$<?php echo number_format($grandTotal, 2); ?></strong></td>
    </tr>
  </table>

  <a class="btn btn-clear" href="cart.php?action=clear">Clear Cart</a>
  <a class="btn btn-checkout" href="checkout.php">Proceed to Checkout</a>

<?php else: ?>
  <p>Your cart is empty.</p>
<?php endif; ?>

</body>
</html>