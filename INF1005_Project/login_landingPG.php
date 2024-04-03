<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "inc/head.inc.php"; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Back Gainer!</title>
    <link rel="stylesheet" href="css/welcome.css">
    <!-- Other head elements -->
</head>
<body>
    <?php include "inc/nav.inc.profile.php"; ?>
    <main>
        <section class="welcome-section">
            <h1>Welcome back, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</h1>
            <p>Train to be the best</p>
            <p style="color: white;"><a href="viewProfile.php">VIEW PROFILE</a></p>
            <button onclick="location.href='plan_workout.php'">Plan workout</button>
        </section>

        <section class="content-section">
            <div class="blog">
                <h2>NEWS</h2>
                <p>Don't miss out on EXCITING EVENTS!</p>
                <button onclick="location.href='news.profile.php'">Click here!</button>
            </div>
            <div class="shop">
                <h2>Shop</h2>
                <p>Always keep up with the discounts and great deals!</p>
                <button onclick="location.href='shop.php'">Click here!</button>
            </div>
        </section>
    </main>

    <?php include "inc/footer.inc.php"; ?>
</body>
</html>
