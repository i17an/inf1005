<?php
session_start();
// Check if the user is logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    // Redirect the user to the login page if not logged in
    header("location: login.php");
    exit;
}

// Retrieve user's purchase history from the database
include "inc/db_connect.php";
$member_id = $_SESSION["member_id"];

$sql = "SELECT * FROM orders WHERE MemberID = ?";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $member_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Close statement
    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Purchase History</title>
    <?php include "inc/head.inc.php"; ?>
</head>
<body class="purchase_history_body">
    <?php include "inc/include_nav.php"; ?>
    <main class="container purchase_history_main">
        <h1>Purchase History</h1>
        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Order Details</th>
                        <th>Total Price</th>
                        <th>Order Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['OrderID']; ?></td>
                            <td><?php echo $row['Name']; ?></td>
                            <td><?php echo $row['Address']; ?></td>
                            <td><?php echo $row['OrderDetails']; ?></td>
                            <td><?php echo $row['TotalPrice']; ?></td>
                            <td><?php echo $row['OrderDate']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No purchase history found.</p>
        <?php endif; ?>

        <!-- Add your HTML for the purchase history page here -->
    </main>
    <?php include "inc/footer.inc.php"; ?>
</body>
</html>
