<?php
session_start();

// Check if the cart exists in the session
if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    // Cart exists and is not empty
    $cart = $_SESSION['cart'];
} else {
    // Cart is empty or doesn't exist
    $cart = array();
}


// Check if the form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize user input
    $name = $_POST['name'];
    $address = $_POST['address'];

    // Here you can perform further validation and sanitization of other form fields

    // If everything is valid, you can process the order
    // For demonstration purposes, let's assume the order is processed successfully
    // You can add your logic here to save the order details to the database, send confirmation emails, etc.

    // Database connection credentials
    $servername = "127.0.0.1"; // Change this to your MySQL server
    $username = "inf1005-sqldev2"; // Change this to your MySQL username
    $password = "inf1005_p5-8"; // Change this to your MySQL password
    $database = "Products"; // Change this to your MySQL database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind the INSERT statement
    $stmt = $conn->prepare("INSERT INTO OrdersTable (Name, Address, OrderDate) VALUES (?, ?, NOW())");
    $stmt->bind_param("ss", $name, $address);

    // Execute the statement
    $stmt->execute();

    // Close statement and database connection
    $stmt->close();
    $conn->close();

    // Clear the cart after successful checkout
    unset($_SESSION['cart']);

    // Redirect the user to a thank you page or any other appropriate page
    header('Location: thank_you.php');
    exit();
} else {
    // If the form is not submitted via POST method, redirect the user back to the checkout page
    header('Location: checkout.php');
    exit();
}
?>
