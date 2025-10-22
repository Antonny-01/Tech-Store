<?php
session_start();
require 'db.php'; // PDO connection

header('Content-Type: application/json'); // always return JSON

$response = array("success" => false, "message" => "", "fullname" => "");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $response['message'] = "Email and password are required";
        echo json_encode($response);
        exit;
    }

    try {
        // Fetch user
        $stmt = $conn->prepare("SELECT id, fullname, password FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['fullname'];

            // Generate initials
            $names = explode(" ", $user['fullname']);
            $_SESSION['initials'] = strtoupper(substr($names[0],0,1) . substr($names[1] ?? "",0,1));

            $response['success'] = true;
            $response['message'] = "Login successful";
            $response['fullname'] = $user['fullname'];
        } else {
            $response['message'] = "Invalid email or password";
        }

    } catch (PDOException $e) {
        $response['message'] = "Database error: " . $e->getMessage();
    }

} else {
    $response['message'] = "Invalid request method";
}

echo json_encode($response);
?>