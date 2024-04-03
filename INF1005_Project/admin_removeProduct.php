<?php
session_start(); // Start the session
// Check if the user is logged in as admin
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["email"] !== "admin@email.com") {
    header("location: login.php");
    exit;
}

// Include necessary files and initialize database connection
include "functions.php";
include "inc/db_connect.php";

// Retrieve list of products from the database
$sql = "SELECT ID, Name FROM products";
$result = $conn->query($sql);

// Check if there are products available
if ($result->num_rows > 0) {
    // Display the list of products
    echo "<h2>Remove Product</h2>";
    echo "<ul>";
    while($row = $result->fetch_assoc()) {
        echo "<li><a href='admin_removeProductProcessing.php?id=" . $row['ID'] . "'>" . $row['Name'] . "</a></li>";
    }
    echo "</ul>";
} else {
    echo "No products available.";
}

// Close the database connection
$conn->close();
?>

<button onclick="window.location.href = 'admin_dashboard.php';">Back to Dashboard</button>
