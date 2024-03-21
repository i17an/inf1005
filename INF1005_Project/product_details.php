<!DOCTYPE html>
<html lang="en">
<head>
    <title>Product Details</title>
    <?php include "inc/head.inc.php"; ?>
    <style>
        .product-info h2 {
            margin-bottom: 30px; /* Adjust the value as needed */
        }
    </style>
</head>
<body>
    <?php include "inc/nav.inc.php"; ?>
    <?php include "inc/header.inc.php"; ?>
    <?php include "functions.php"; ?>

    <main class="container" style="margin-top: 50px;">
    <section id="product-details" style="margin-bottom: 50px;">
        <?php
        // Check if the product ID is provided in the query string
        if (isset($_GET['id'])) {
            $product_id = $_GET['id'];

            // Retrieve product details from the database using the product ID
            // Assuming you have a function to fetch product details by ID
            $product = getProductDetails($product_id);

            if ($product) {
                // Display product details
                echo '<div class="product-details">';
                echo '<div class="product-image">';
                echo '<img src="' . $product['Image'] . '" alt="' . $product['Name'] . '" class="product-details-img">';
                echo '</div>';
                echo '<div class="product-info">';
                echo '<h2>' . $product['Name'] . '</h2>';
                echo '<p>Overview:<br>' . $product['Description'] . '</p>';
                echo '<p>Price: $' . number_format($product['Price'], 2) . '</p>';
                // Add to cart form
                echo '<form action="add_to_cart.php" method="post">';
                echo '<input type="hidden" name="product_id" value="' . $product['ID'] . '">';
                echo '<input type="hidden" name="product_name" value="' . $product['Name'] . '">';
                echo '<input type="hidden" name="product_price" value="' . $product['Price'] . '">';
                echo '<button type="submit" class="btn btn-primary">Add to Cart</button>';
                echo '</form>';
                // You can add more product details here
                echo '</div>';
                echo '</div>';
            } else {
                echo 'Product not found.';
            }
        } else {
            echo 'Product ID not provided.';
        }
        ?>
    </section>
    </main>



    <?php include "inc/footer.inc.php"; ?>
</body>
</html>
