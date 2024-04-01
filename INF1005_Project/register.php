<?php
// Start the session
session_start();

// Include the database connection file
require_once 'inc/db_connect.php';

// Define variables and initialize with empty values
$fname = $lname = $email = $pwd_hashed = $errorMsg = "";
$success = true;

// Function to save member to the database
function saveMemberToDB($conn) {
    global $fname, $lname, $email, $pwd_hashed, $errorMsg, $success;

    // Prepare an insert statement
    $stmt = $conn->prepare("INSERT INTO members (fname, lname, email, password) VALUES (?, ?, ?, ?)");
    
    // Bind variables to the prepared statement as parameters
    $stmt->bind_param("ssss", $fname, $lname, $email, $pwd_hashed);
    
    // Attempt to execute the prepared statement
    if (!$stmt->execute()) {
        $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        $success = false;
    }
    
    // Close statement
    $stmt->close();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $email = trim($_POST['email']);
    $pwd_hashed = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);

    saveMemberToDB($conn);
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "inc/head.inc.php"; ?>
    <link rel="stylesheet" href="css/register.css">
    <title>Register</title>
</head>
<body>
    <?php include "inc/nav.inc.php"; ?>
    
    <main>
        <section class="showcase">
            <video src="assets/videos/gymvideo.mp4" muted loop autoplay></video>
            <div class="overlay"></div>
            <div class="registration-form" style="z-index: 2; position: relative;">
                <h2>Join Now</h2>
                <?php 
                if (!$success && !empty($errorMsg)): 
                    echo "<p class='error-message'>$errorMsg</p>"; 
                elseif ($success):
                    echo "<p class='success-message'>New member registered successfully.</p>";
                endif;
                ?>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group">
                        <label for="fname">First Name</label>
                        <input type="text" name="fname" id="fname" required>
                    </div>
                    <div class="form-group">
                        <label for="lname">Last Name</label>
                        <input type="text" name="lname" id="lname" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" required>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn">Register</button>
                    </div>
                </form>
                <p>Already a member? <a href="login.php">Log in</a>.</p>
            </div>
        </section>
    </main>

    <?php include "inc/footer.inc.php"; ?>

    <script defer src="js/main.js"></script>
</body>
</html>
