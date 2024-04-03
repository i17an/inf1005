<?php
session_start();

// check if not logged in
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit();
}

// Check if the product ID, name, and price are received via POST
if(isset($_POST['product_id'], $_POST['product_name'], $_POST['product_price'])) {
    // Retrieve product data from the POST request
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];

    // Create an array to hold the product data
    $product = array(
        'id' => $product_id,
        'name' => $product_name,
        'price' => $product_price,
        'quantity' => 1 // You can initialize the quantity to 1
    );

    // Check if the cart exists in the session
    if(!isset($_SESSION['cart'])) {
        // If the cart doesn't exist, create it
        $_SESSION['cart'] = array();
    }

    // Check if the product already exists in the cart
    if(isset($_SESSION['cart'][$product_id])) {
        // If the product exists, increment its quantity
        $_SESSION['cart'][$product_id]['quantity']++;
    } else {
        // If the product doesn't exist, add it to the cart
        $_SESSION['cart'][$product_id] = $product;
    }

    // Redirect back to the referring page
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
} else {
    // If the POST data is not received, redirect to the home page or display an error message
    header('Location: index.php'); // Change index.php to the appropriate page
    exit();
}

?>
