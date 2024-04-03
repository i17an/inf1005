<?php
include "functions.php";
session_start();

// Check if the form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $id = sanitize_input($_POST['id']);
    $name = sanitize_input($_POST['name']);
    $price = intval($_POST['price']); // Assuming Price is a decimal type in your database
    $description = sanitize_input($_POST['description']);

    // Validate user input
    if (validate_input_addProduct($name, $price)) {
        include "inc/db_connect.php";

        // Check if image is uploaded
        if(!isset($_FILES["image"]) || $_FILES["image"]["error"] != UPLOAD_ERR_OK) {
            $errors[] = "Please upload an image.";
        } else {
            // Handle file upload
            $target_directory = "images/";
            $target_file = $target_directory . basename($_FILES["image"]["name"]);

            // Check if file is an image
            $image_info = getimagesize($_FILES["image"]["tmp_name"]);
            if(!$image_info) {
                $errors[] = "Uploaded file is not an image.";
            } else {
                // Move uploaded image to target directory
                if(!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $errors[] = "Failed to upload image.";
                }
            }
        }

        
        // Perform SQL insertion
        $sql = "INSERT INTO products (ID, Name, Price, Description, Image) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssiss", $id, $name, $price, $description, $target_file);

        // Execute the statement
        $stmt->execute();

        // Close statement and database connection
        $stmt->close();
        $conn->close();

        // Redirect back to the shop page or any other page
        header("Location: admin_addProduct.php");
        exit();
    } else {
        // Redirect the user back to the checkout page with an error message
        header('Location: admin_addProduct.php?error=invalid_input');
        exit();
    }
} else {
    // If the form is not submitted via POST method, redirect the user back to the checkout page
    header('Location: admin_addProduct.php');
    exit();
}
?>
