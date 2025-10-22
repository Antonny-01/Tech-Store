<?php
session_start();
include 'db.php'; // make sure this connects $conn as PDO

$error = '';

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare query with SHA2 hash comparison
    $stmt = $conn->prepare("SELECT * FROM admins WHERE email = :email AND password = SHA2(:password, 256)");
    $stmt->execute(['email' => $email, 'password' => $password]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if($admin){
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_name'] = $admin['fullname'];
        header("Location: admin_dashboard.php");
        exit;
    } else {
        $error = "Invalid email or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Login - Tech Store</title>
<style>
body { font-family: Arial, sans-serif; background:#f2f2f2; display:flex; justify-content:center; align-items:center; height:100vh; }
form { background:white; padding:30px; border-radius:8px; box-shadow:0 2px 5px rgba(0,0,0,0.2); width:300px; }
input { width:100%; padding:10px; margin:10px 0; border:1px solid #ccc; border-radius:4px; }
button { width:100%; padding:10px; background:#3b03d6; color:white; border:none; border-radius:4px; cursor:pointer; }
button:hover { background:#2563eb; }
.error { color:red; font-size:14px; }
</style>
</head>
<body>
<form method="POST">
    <h2>Admin Login</h2>
    <?php if($error) echo "<p class='error'>$error</p>"; ?>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button name="login">Login</button>
</form>
</body>
</html>