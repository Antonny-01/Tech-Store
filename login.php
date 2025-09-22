<?php
session_start();
require 'db.php'; // database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Check if email exists
    $stmt = $conn->prepare("SELECT id, fullname, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $fullname, $hashed_password);
        $stmt->fetch();

        // Verify password
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $fullname;

            // Generate initials (first letters of first and second name)
            $names = explode(" ", $fullname);
            $initials = strtoupper(substr($names[0], 0, 1) . substr($names[1] ?? "", 0, 1));
            $_SESSION['initials'] = $initials;

            header("Location: index.php"); // Redirect after login
            exit;
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "Email not registered!";
    }
    $stmt->close();
}
$conn->close();
?>