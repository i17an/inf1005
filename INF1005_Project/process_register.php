<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include "inc/head.inc.php";
    ?>
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
                    // Define the sanitize_input function
                    function sanitize_input($data)
                    {
                        $data = trim($data);
                        $data = stripslashes($data);
                        $data = htmlspecialchars($data);
                        return $data;
                    }

                    /* Write member to database */
                    function saveMemberToDB()
                    {
                        global $fname, $lname, $email, $pwd_hashed, $errorMsg, $success;

                        // Create database connection.
                        $config = parse_ini_file('/var/www/private/db-config.ini');
                        if (!$config)
                        {
                        $errorMsg = "Failed to read database config file.";
                        $success = false;
                        }
                        else
                        {
                            $conn = new mysqli(
                                $config['servername'],
                                $config['username'],
                                $config['password'],
                                $config['dbname']
                                );

                            // Check connection
                            if ($conn->connect_error)
                            {
                            $errorMsg = "Connection failed: " . $conn->connect_error;
                            $success = false;
                            }
                            else
                            {
                               

                                // Prepare the statement:
                                $stmt = $conn->prepare("INSERT INTO registered_members
                                (fname, lname, email, password) VALUES (?, ?, ?, ?)");
                                // Bind & execute the query statement:
                                $stmt->bind_param("ssss", $fname, $lname, $email, $pwd_hashed);
                                if (!$stmt->execute())
                                {
                                $errorMsg = "Execute failed: (" . $stmt->errno . ") " .
                                $stmt->error;
                                $success = false;
                                }
                                $stmt->close();
                            }

                            $conn -> close();
                        }
                    }

                    // Retrieve form data and perform validation and sanitization
                    $firstName = sanitize_input($_POST['fname']);
                    $lastName = sanitize_input($_POST['lname']);
                    $email = sanitize_input($_POST['email']);
                    $password = $_POST['pwd'];
                    $pwd_hashed = password_hash($password, PASSWORD_DEFAULT);

                    // Save new user after validation and sanitization
                    saveMemberToDB();

                    // Display registration success message with styled class
                    echo "<p class='registration-message'>Registration successful, $firstName $lastName </p>";


                    // Display hyperlink to the login page
                    echo "<p><a href='login.php' class='back-to-login'>Back to login page</a></p>";
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
