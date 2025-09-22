<?php
// db.php - Database connection

$servername = "localhost";   // usually localhost
$username = "root";          // MySQL username (default: root in XAMPP)
$password = "";              // MySQL password (default: empty in XAMPP)
$dbname = "tech_store";       // your database name

// Create connectiongit config --global user.name "Your Name"
git config --global user.email "mthokozisiantonny625@gmail.com"
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: set charset to utf8 for proper encoding
$conn->set_charset("utf8");
?>