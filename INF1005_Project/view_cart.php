<?php
session_start();

// Check if the cart exists in the session
if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    // Cart exists and is not empty
    $cart = $_SESSION['cart'];
} else {
    // Cart is empty or doesn't exist
    $cart = array();
}

// Check if the product ID to remove is received via GET
if(isset($_GET['remove_id'])) {
    $remove_id = $_GET['remove_id'];
    // Check if the product to remove exists in the cart
    if(isset($cart[$remove_id])) {
        // Remove the product from the cart
        unset($cart[$remove_id]);
        // Update the session cart
        $_SESSION['cart'] = $cart;
        // Redirect back to this page to refresh the cart display
        header('Location: view_cart.php');
        exit();
    }
}

// Check if the reset cart action is triggered
if(isset($_GET['reset_cart'])) {
    unset($_SESSION['cart']); // Reset the cart by unsetting the session variable
    header('Location: view_cart.php'); // Redirect to refresh the page
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Cart</title>
    <?php include "inc/head.inc.php"; ?>
</head>
<body class="view_cart_body">
    <?php include "inc/nav.inc.php"; ?>

    <main class="container view_cart_main">
        
        <h1>View Cart</h1>
        <!-- Back button -->
        <a href="shop.php" class="btn btn-primary mb-2 mr-2">Continue Shopping</a>
        <!-- Button to reset the cart -->
        <a href="view_cart.php?reset_cart=true" class="btn btn-danger mb-2">Reset Cart</a>

        <?php if(empty($cart)): ?>
            <p>Your cart is empty.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th> <!-- New column for action buttons -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($cart as $item_id => $item): ?>
                        <tr>
                            <td><?php echo $item['name']; ?></td>
                            <td>$<?php echo number_format($item['price'], 2); ?></td>
                            <td><?php echo $item['quantity']; ?></td>
                            <td>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                            <td><a href="view_cart.php?remove_id=<?php echo $item_id; ?>">Remove</a></td> <!-- Remove button -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <p>Total: $<?php
                $total = 0;
                foreach($cart as $item) {
                    $total += $item['price'] * $item['quantity'];
                }
                echo number_format($total, 2);
            ?></p>
            <a href="checkout.php">Proceed to Checkout</a>
        <?php endif; ?>
    </main>
    <?php include "inc/footer.inc.php"; ?>
</body>
</html>
