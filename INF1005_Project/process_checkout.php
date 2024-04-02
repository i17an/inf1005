<?php
include "functions.php";
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
    $name = sanitize_input($_POST['name']);
    $address = sanitize_input($_POST['address']);

    // Validate user input
    if (validate_input_checkout($name, $address)) {
        include "inc/db_connect.php";

        // Prepare and bind the INSERT statement
        $stmt = $conn->prepare("INSERT INTO orders (Name, Address, OrderDate) VALUES (?, ?, NOW())");
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
        // Redirect the user back to the checkout page with an error message
        header('Location: checkout.php?error=invalid_input');
        exit();
    }
} else {
    // If the form is not submitted via POST method, redirect the user back to the checkout page
    header('Location: checkout.php');
    exit();
}
?>
