<?php
session_start();

// Include database connection
include "inc/db_connect.php";

// Initialize variables for form validation
$id = $name = $description = $price = $image = "";
$id_err = $name_err = $description_err = $price_err = $image_err = "";

// Handle form submission
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $id = sanitize_input($_POST['id']);
    $name = sanitize_input($_POST['name']);
    $description = sanitize_input($_POST['description']);
    $price = floatval($_POST['price']); // Convert price to float
    // Validate image upload
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image'];
        // Check if the uploaded file is an image
        $allowed_types = array("image/jpeg", "image/png");
        if(!in_array($image['type'], $allowed_types)) {
            $image_err = "Only JPG, PNG, and GIF files are allowed.";
        }
    } else {
        $image_err = "Please upload an image.";
    }

    // Validate other fields
    if(empty($id)) {
        $id_err = "Please enter an ID for the product.";
    }
    if(empty($name)) {
        $name_err = "Please enter a name for the product.";
    }
    if(empty($description)) {
        $description_err = "Please enter a description for the product.";
    }
    if(empty($price) || $price <= 0) {
        $price_err = "Please enter a valid price for the product.";
    }

    // If no errors, insert product into database
    if(empty($id_err) && empty($name_err) && empty($description_err) && empty($price_err) && empty($image_err)) {
        // Move uploaded image to a directory
        $target_dir = "images/";
        $target_file = $target_dir . basename($image["name"]);
        move_uploaded_file($image["tmp_name"], $target_file);

        // Insert product into database
        $stmt = $conn->prepare("INSERT INTO products (ID, Name, Description, Price, Image) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("isds", $id, $name, $description, $price, $target_file);
        $stmt->execute();
        $stmt->close();

        // Redirect to admin dashboard or display a success message
        //header("Location: admin_dashboard.php");
        header("Location: shop.php");
        exit();
    }
}

// Function to sanitize user input
function sanitize_input($input) {
    return htmlspecialchars(trim($input));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - Admin Panel</title>
</head>
<body>
    <h1>Add Product</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <div>
            <label for="id">Product ID:</label>
            <input type="text" id="id" name="id" value="<?php echo $id; ?>">
            <span><?php echo $id_err; ?></span>
        </div>
        <div>
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>">
            <span><?php echo $name_err; ?></span>
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description"><?php echo $description; ?></textarea>
            <span><?php echo $description_err; ?></span>
        </div>
        <div>
            <label for="price">Price:</label>
            <input type="text" id="price" name="price" value="<?php echo $price; ?>">
            <span><?php echo $price_err; ?></span>
        </div>
        <div>
            <label for="image">Product Image:</label>
            <input type="file" id="image" name="image">
            <span><?php echo $image_err; ?></span>
        </div>
        <button type="submit">Add Product</button>
    </form>
</body>
</html>
