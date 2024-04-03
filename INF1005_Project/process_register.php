<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/register.css">
    <?php
        include "inc/head.inc.php";
    ?>
    <style>
        main {
            min-height: 100vh; /* Override the min-height property */
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <?php
        include "inc/nav.inc.php";
    ?>
    <!-- End of Navbar -->
    <main>
        <section class="showcase">
            <video src="assets/videos/gymvideo.mp4" muted loop autoplay></video>
            <div class="overlay"></div>
            <div class="text">
                <?php
                    //Start session
                    session_start(); 

                    //Include the database connection file
                    require_once 'inc/db_connect.php';

                    // Define global variables
                    $fname = $lname = $email = $pwd_hashed = $errorMsg = "";
                    $success = true;

                    function saveMemberToDB($conn) {
                        global $fname, $lname, $email, $pwd_hashed, $errorMsg, $success;
                    
                        $stmt = $conn->prepare("INSERT INTO members (fname, lname, email, password) VALUES (?, ?, ?, ?)");
                        $stmt->bind_param("ssss", $fname, $lname, $email, $pwd_hashed);
                        if (!$stmt->execute()) {
                            $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                            $success = false;
                        }
                        $stmt->close();
                    }

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $fname = trim($_POST['fname']);
                        $lname = trim($_POST['lname']);
                        $email = trim($_POST['email']);
                        $pwd_hashed = password_hash(trim($_POST['pwd']), PASSWORD_DEFAULT);
                    
                        // Check if email already exists in the database
                        $stmt = $conn->prepare("SELECT * FROM members WHERE email = ?");
                        $stmt->bind_param("s", $email);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        
                        if ($result->num_rows > 0) {
                            $errorMsg = "Email already exists! <a href='register.php'>Try Again</a>";
                            $success = false;
                        } else {
                            saveMemberToDB($conn);
                        }
                    
                        $stmt->close();
                    }

                    if (!$success && !empty($errorMsg)): 
                        echo "<p class='error-message'>$errorMsg</p>"; 
                    elseif ($success):
                        echo "<p class='success-message'>New member registered successfully. <a href='login.php'>Click here to login</a></p>";
                    endif;
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
