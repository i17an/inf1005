<?php
// Function to retrieve product details from the database based on the product ID
function getProductDetails($product_id) {
    // Connect to the MySQL database
    $servername = "127.0.0.1"; // Change this to your MySQL server
    $username = "inf1005-sqldev"; // Change this to your MySQL username
    $password = "password"; // Change this to your MySQL password
    $database = "Products"; // Change this to your MySQL database name

    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL query to retrieve product details based on the product ID
    $sql = "SELECT * FROM ProductsTable WHERE ID = $product_id";
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
?>
