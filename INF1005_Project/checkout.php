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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Checkout</title>
    <?php include "inc/head.inc.php"; ?>
</head>
<body class="checkout_body">
    <?php include "inc/nav.inc.php"; ?>
    <?php include "inc/header.inc.php"; ?>
    <main class="container checkout_main">
        <h1>Checkout</h1>

        <?php if(empty($cart)): ?>
            <p>Your cart is empty.</p>
        <?php else: ?>
            <h2>Order Summary</h2>
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($cart as $item): ?>
                        <tr>
                            <td><?php echo $item['name']; ?></td>
                            <td>$<?php echo number_format($item['price'], 2); ?></td>
                            <td><?php echo $item['quantity']; ?></td>
                            <td>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
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

            <!-- Checkout form -->
            <h2>Checkout Form</h2>
            <form action="process_checkout.php" method="post">
                <!-- Add input fields for user details like name, address, etc. -->
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required><br><br>

                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required><br><br>

                <!-- Add more input fields as needed -->

                <button type="submit">Place Order</button>
            </form>
        <?php endif; ?>
    </main>
    <?php include "inc/footer.inc.php"; ?>
</body>
</html>
