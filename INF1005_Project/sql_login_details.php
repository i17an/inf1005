<?php
$servername = "127.0.0.1"; // Change this to your MySQL server
$username = "inf1005-sqldev"; // Change this to your MySQL username
$password = "password"; // Change this to your MySQL password
$database = "Products"; // Change this to your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
