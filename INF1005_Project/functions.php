<?php
// Function to retrieve product details from the database based on the product ID
function getProductDetails($product_id) {
    include "inc/db_connect.php";

    // Prepare SQL query to retrieve product details based on the product ID
    $sql = "SELECT * FROM products WHERE ID = $product_id";
    $result = $conn->query($sql);

    // Check if the query was successful and if it returned any rows
    if ($result && $result->num_rows > 0) {
        // Fetch the product details from the result set
        $row = $result->fetch_assoc();
        // Close the database connection
        $conn->close();
        return $row; // Return the product details as an associative array
    } else {
        // Close the database connection
        $conn->close();
        return false; // Return false if the product is not found
    }
}

// Function to sanitize user input
function sanitize_input($input) {
    return htmlspecialchars(trim($input));
}

// Function to validate name and address fields
function validate_input_checkout($name, $address) {
    // Define maximum lengths for name and address
    $max_name_length = 50; 
    $max_address_length = 100;

    // Check if name and address are not empty and within the maximum lengths
    if (empty($name) || empty($address) || strlen($name) > $max_name_length || strlen($address) > $max_address_length) {
        return false;
    }
    // Add more validation rules as needed
    // For example, you can validate the format of the email address
    // using PHP's filter_var() function with FILTER_VALIDATE_EMAIL flag.
    
    return true;
}

function validate_input_addProduct($name, $price) {
    // Validate name
    if(empty($name)) {
        return false;
    }
    // Validate price
    if(empty($price) || $price <= 0) {
        return false;
    }

    return true;
}

?>
