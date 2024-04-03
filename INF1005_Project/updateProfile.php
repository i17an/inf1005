<?php
// Initialize the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Include the database connection file
require_once 'inc/db_connect.php';

// Define variables and initialize with empty values
$new_fname = $new_lname = $new_email = $new_password = "";
$new_fname_err = $new_lname_err = $new_email_err = $new_password_err = "";
$success_message = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Validate new first name
    if (empty(trim($_POST["new_fname"]))) {
        $new_fname_err = "Please enter your new first name.";
    } else {
        $new_fname = trim($_POST["new_fname"]);
    }
    
    // Validate new last name
    if (empty(trim($_POST["new_lname"]))) {
        $new_lname_err = "Please enter your new last name.";
    } else {
        $new_lname = trim($_POST["new_lname"]);
    }
    
    // Validate new email
    if (empty(trim($_POST["new_email"]))) {
        $new_email_err = "Please enter your new email.";
    } else {
        $new_email = trim($_POST["new_email"]);
    }

    // Validate new password
    if (!empty(trim($_POST["new_password"]))) {
        $new_password = trim($_POST["new_password"]);
    }

    // Check input errors before updating the database
    if (empty($new_fname_err) && empty($new_lname_err) && empty($new_email_err)) {
        // Prepare an update statement
        $sql = "UPDATE members SET fname = ?, lname = ?, email = ?";

        // Include the password update only if a new password is provided
        if (!empty($new_password)) {
            $sql .= ", password = ?";
        }

        $sql .= " WHERE member_id = ?";

        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            if (!empty($new_password)) {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $stmt->bind_param("ssssi", $new_fname, $new_lname, $new_email, $hashed_password, $_SESSION["member_id"]);
            } else {
                $stmt->bind_param("sssi", $new_fname, $new_lname, $new_email, $_SESSION["member_id"]);
            }

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Profile updated successfully
                $success_message = "<p class='success-message'>Profile updated successfully. <a href='index.php'>Back to home</a></p>";
            } else {
                // Something went wrong with the database update
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Close connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/register.css">
    <?php
        include "inc/head.inc.php";
    ?>
</head>
<body>
<?php
    // Initialize the session
    session_start();

    // Check if the user is logged in
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        // If user is logged in, include the profile navigation
        include "inc/nav.inc.profile.php";
    } else {
        // If user is not logged in, include the regular navigation
        include "inc/nav.inc.php";
    }
    ?>
    <main>
    <section class="showcase">
    <video src="assets/videos/gymvideo.mp4" muted loop autoplay></video>
    <div class="overlay"></div>
    <div class="text">
        <?php
            // Check if there's a success message
            if (!empty($success_message)) {
                echo '<p class="success-message">' . $success_message . '</p>';
            }
            
            // Check if there are any error messages
            if (!empty($new_fname_err)) {
                echo '<p class="error-message">' . $new_fname_err . '</p>';
            }
            if (!empty($new_lname_err)) {
                echo '<p class="error-message">' . $new_lname_err . '</p>';
            }
            if (!empty($new_email_err)) {
                echo '<p class="error-message">' . $new_email_err . '</p>';
            }
            if (!empty($new_password_err)) {
                echo '<p class="error-message">' . $new_password_err . '</p>';
            }
        ?>
    </div>
</section>

    </main>
    <!-- Footer -->
    <?php
        include "inc/footer.inc.php";
    ?>
    <!-- End of Footer -->


    <!-- Custom JS -->
    <script defer src="js/main.js"></script>
</body>
</html>
