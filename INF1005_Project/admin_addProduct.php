<!-- add_product.php -->
<?php
session_start(); // Start the session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
</head>
<body>
    <h2>Add Product</h2>
    <!-- Display any error messages from previous submissions -->
    <?php if(isset($_SESSION['errors']) && !empty($_SESSION['errors'])): ?>
        <ul>
            <?php foreach($_SESSION['errors'] as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
        <?php unset($_SESSION['errors']); // Clear errors after displaying ?>
    <?php endif; ?>
    <form action="admin_addProductProcessing.php" method="post" enctype="multipart/form-data">
        <label for="id">Product ID:</label>
        <input type="text" id="id" name="id"><br> <!-- Add input field for ID -->
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name"><br>
        <label for="price">Price:</label>
        <input type="text" id="price" name="price"><br>
        <label for="description">Description:</label><br>
        <textarea id="description" name="description"></textarea><br>
        <label for="image">Image:</label>
        <input type="file" id="image" name="image"><br>
        <button type="submit">Add Product</button>
    </form>
</body>
</html>
