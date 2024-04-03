<?php
session_start(); // Start the session

// Validate the product ID
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $product_id = $_GET['id'];
    
    // Include necessary files and initialize database connection
    include "functions.php";
    include "inc/db_connect.php";

    // Prepare and execute the SQL DELETE query
    $sql = "DELETE FROM products WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $product_id);
    $stmt->execute();

    // Check if the product was successfully deleted
    if ($stmt->affected_rows > 0) {
        echo "Product removed successfully.";
    } else {
        echo "Failed to remove product. Product may not exist or an error occurred.";
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
} else {
    // Redirect the user back to the page listing products if product ID is not provided
    header("Location: admin_removeProducts.php");
    exit();
}

// Redirect the user back to the page listing products
header("refresh:2;url=admin_removeProducts.php"); // Redirect after 2 seconds
?>
