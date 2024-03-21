<!DOCTYPE html>
<html lang="en">
<head>
    <title>StrengthSculptStudio - Shop</title>
    <?php include "inc/head.inc.php"; ?>
</head>
<body>
    <?php include "inc/nav.inc.php"; ?>
    <?php include "inc/header.inc.php"; ?>

    <main class="container">
        <section id="shop">
            <h2>Shop</h2>
            <div class="row">
                <?php
                // Connect to the MySQL database
                $servername = "127.0.0.1"; // Change this to your MySQL server
                $username = "inf1005-sqldev2"; // Change this to your MySQL username
                $password = "inf1005_p5-8"; // Change this to your MySQL password
                $database = "Products"; // Change this to your MySQL database name

                $conn = new mysqli($servername, $username, $password, $database);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

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
    </main>

    <?php include "inc/footer.inc.php"; ?>
</body>
</html>
