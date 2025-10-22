<?php
session_start();
include 'db.php';
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}

$stmt = $conn->query("SELECT * FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Manage Users - Tech Store</title>
<style>
body { font-family: Arial,sans-serif; margin:0; background:#f2f2f2; }
header { background:#3b03d6; color:white; padding:15px; display:flex; justify-content:space-between; align-items:center; }
nav { background:#1a1a1a; width:200px; height:100vh; position:fixed; top:0; left:0; padding-top:60px; }
nav a { display:block; color:white; padding:12px 20px; text-decoration:none; }
nav a:hover { background:#333; }
main { margin-left:200px; padding:20px; }
table { width:100%; border-collapse: collapse; background:white; }
th, td { padding:12px; border:1px solid #ccc; text-align:left; }
th { background:#3b03d6; color:white; }
</style>
</head>
<body>

<header>
    <h1>Manage Users</h1>
    <a href="logout.php" style="color:white;">Logout</a>
</header>

<nav>
    <a href="admin_dashboard.php">Dashboard</a>
    <a href="admin_products.php">Products</a>
    <a href="admin_orders.php">Orders</a>
    <a href="admin_users.php">Users</a>
</nav>

<main>
    <h2>Registered Users</h2>
    <table>
        <tr>
            <th>ID</th><th>Full Name</th><th>Email</th><th>Joined</th>
        </tr>
        <?php foreach($users as $user) { ?>
        <tr>
            <td><?= htmlspecialchars($user['id']); ?></td>
            <td><?= htmlspecialchars($user['fullname']); ?></td>
            <td><?= htmlspecialchars($user['email']); ?></td>
            <td><?= htmlspecialchars($user['created_at']); ?></td>
        </tr>
        <?php } ?>
    </table>
</main>

</body>
</html>