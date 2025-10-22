<?php
include 'db.php';
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

$stmt = $conn->prepare("SELECT * FROM products WHERE category='accessories'");
$stmt->execute();

$products = [];

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $products[] = [
        "id" => $row['id'],
        "name" => $row['name'],
        "price" => $row['price'],
        "description" => $row['description'],
        "image" => "http://172.20.10.4/Tech%20Store/images/" . urlencode($row['image']) 
    ];
}

echo json_encode($products);
?>