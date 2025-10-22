<?php
include 'db.php';

if(isset($_POST['add_product'])){
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $description = $_POST['description'];

    move_uploaded_file($_FILES['image']['tmp_name'], "images/$image");

    $stmt = $conn->prepare("INSERT INTO products (name, category, price, image, description) VALUES (?, ?, ?, ?, ?)");
    if($stmt->execute([$name, $category, $price, $image, $description])){
        echo "Product added successfully!";
    } else {
        echo "Error adding product.";
    }
}
?>