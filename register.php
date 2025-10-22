<?php
session_start();
require 'db.php'; // PDO connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Trim and get form data
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // --- Basic Validation ---
    if ($password !== $confirm_password) {
        die("Passwords do not match!");
    }

    if (strlen($password) < 6) {
        die("Password must be at least 6 characters long.");
    }

    try {
        // --- Check if email already exists ---
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingUser) {
            die("Email already registered!");
        }

        // --- Hash the password ---
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // --- Insert new user ---
        $stmt = $conn->prepare("INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$fullname, $email, $hashed_password]);

        // Get inserted user ID
        $user_id = $conn->lastInsertId();

        // --- Create session ---
        $_SESSION['user_id'] = $user_id;
        $names = explode(" ", $fullname);
        $_SESSION['initials'] = strtoupper(substr($names[0],0,1) . substr($names[1] ?? "",0,1));

        // Redirect to homepage
        header("Location: index.php");
        exit();

    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }

} else {
    echo "Invalid request method.";
}
?>