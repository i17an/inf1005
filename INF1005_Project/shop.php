<!DOCTYPE html>
<html lang="en">
<head>
    <title>StrengthSculptStudio - Shop</title>
    <?php include "inc/head.inc.php"; ?>
</head>
<body class="shop-page">
    <?php include "inc/nav.inc.php"; ?>
    <?php include "inc/header.inc.php"; ?>

    <main class="container shop-main">
        <section id="shop">
            <h2 class="shop-title">Shop</h2>
            <div class="row">
                <?php
                include "sql_login_details.php";

                // Query to select products from the database
                $sql = "SELECT * FROM ProductsTable";
                $result = $conn->query($sql);

                // Check if there are any products
                if ($result->num_rows > 0) {
                    // Loop through products and display them
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="col-sm-4">';
                        echo '<div class="product">';
                        // Wrap product image with anchor tag to redirect to product details page
                        echo '<a href="product_details.php?id=' . $row["ID"] . '">';
                        echo '<img class="img-thumbnail product-image" src="' . $row["Image"] . '" alt="' . $row["Name"] . '" title="View product details..."/>';
                        echo '</a>';
                        echo '<h3>' . $row["Name"] . '</h3>';
                        echo '<p>Price: $' . number_format($row["Price"], 2) . '</p>';
                        // Display "Add to Cart" button
                        echo '<form action="add_to_cart.php" method="post">';
                        echo '<input type="hidden" name="product_id" value="' . $row["ID"] . '">';
                        echo '<input type="hidden" name="product_name" value="' . $row["Name"] . '">';
                        echo '<input type="hidden" name="product_price" value="' . $row["Price"] . '">';
                        echo '<button type="submit" class="btn btn-primary">Add to Cart</button>';
                        echo '</form>';
                        echo '</div>'; // Close product div
                        echo '</div>'; // Close col-sm-4 div
                    }
                } else {
                    echo "No products found";
                }

                // Close the database connection
                $conn->close();
                ?>
            </div>
        </section>
        <!-- View Cart Icon -->
        <a href="view_cart.php" class="view-cart-shop-page">
            <i class="fas fa-shopping-cart"></i> View Cart
        </a>
    </main>

    <?php include "inc/footer.inc.php"; ?>
</body>
</html>
