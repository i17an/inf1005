<?php
session_start();

// Check if the user is logged in as admin
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["email"] !== "admin@email.com") {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
</head>
<body>
    <h2>Admin Dashboard</h2>
    <!-- Logout button -->
    <button type="button" class="btn btn-primary"
        style="font-size: 21px;background-color: #f00;padding: 0;border-radius:12px;width:150px;font-weight: 600;text-align: center; border: none;">
        <a class="nav-link" href="/logout.php" style="color: white; text-decoration: none;">Logout</a>
    </button>
    <ul>
        <li><a href="admin_addProduct.php">Add Product</a></li>
        <li><a href="admin_removeProduct.php">Remove Product</a></li>
    </ul>
</body>
</html>
