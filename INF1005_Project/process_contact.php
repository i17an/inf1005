<!DOCTYPE html>
<html lang="en">

<head>
    <title>Form Submitted</title>
    <?php
    // use PHPMailer\PHPMailer\PHPMailer;
    // use PHPMailer\PHPMailer\Exception;

    // require 'inc/PHPMailer/src/Exception.php';
    // require 'inc/PHPMailer/src/PHPMailer.php';
    // require 'inc/PHPMailer/src/SMTP.php';

    include "inc/head.inc.php";
    ?>
    <link rel="stylesheet" href="css/contact-us.css">
    <style>
        main{
            min-height: 80vh;
        }
    </style>
</head>

<body>
    <!--Navbar-->
    <?php
    include "inc/nav.inc.php";
    ?>
    <!--End of Navbar-->
    <main>
        <div style="padding-top: 25vh;"></div>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            function sanitize_input($data)
            {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            function validate_alpha($data)
            {
                $data = preg_match('/^[\p{L} ]+$/u', $data); // Remove anything that is not an alphabet or space
                return $data;
            }

            function saveMemberToDB($title, $fname, $lname, $email, $phone, $outlet, $topics, $comment, &$errorMsg)
            {
                // Create database connection.
                $config = parse_ini_file('/var/www/private/db-config.ini');
                if (!$config) {
                    $errorMsg = "Failed to read database config file.";
                    return false;
                } else {
                    $conn = new mysqli(
                        $config['servername'],
                        $config['username'],
                        $config['password'],
                        $config['dbname']
                    );
                    // Check connection
                    if ($conn->connect_error) {
                        $errorMsg = "Connection failed: " . $conn->connect_error;
                        $success = false;
                    } else {
                        // Prepare the statement:
                        $stmt = $conn->prepare("INSERT INTO contact_us_users(title, fname, lname, email, phone, outlet, topics, comment) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                        // Bind & execute the query statement:
                        $stmt->bind_param("ssssssss", $title, $fname, $lname, $email, $phone, $outlet, $topics, $comment);
                        if (!$stmt->execute()) {
                            $errorMsg = "Execute failed: (" . $stmt->errno . ") " .
                                $stmt->error;
                            $success = false;
                        }
                        $stmt->close();
                    }
                    $conn->close();
                }
            }


            $title = $fname = $lname = $email = $phone = $outlet = $topics = $comment = $errorMsg = "";
            $success = true;

            if (empty($_POST["title"])) {
                $errorMsg .= "Title is required.<br>";
                $success = false;
            } else {
                $title = sanitize_input($_POST["title"]);
            }

            if (!empty($_POST["title"])) {
                if (validate_alpha($_POST["fname"])) {
                    $fname = sanitize_input($_POST["fname"]);
                } else {
                    $errorMsg .= "Only alphabetic characters are allowed. <br>";
                    $success = false;
                }
            }

            if (empty($_POST["lname"])) {
                $errorMsg .= "Last Name is required.<br>";
                $success = false;
            } else {
                if (validate_alpha($_POST["lname"])) {
                    $lname = sanitize_input($_POST["lname"]);
                } else {
                    $errorMsg .= "Only alphabetic characters are allowed. <br>";
                    $success = false;
                }
            }

            if (empty($_POST["email"])) {
                $errorMsg .= "Email is required.<br>";
                $success = false;
            } else {
                $email = sanitize_input($_POST["email"]);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errorMsg .= "Invalid email format.";
                    $success = false;
                }
            }

            if (empty($_POST['phone'])) {
                $errorMsg .= "Phone number is required. <br>";
                $success = false;
            } else {
                $phone = sanitize_input($_POST["phone"]);
                if (!is_numeric($phone) || strlen($phone) != 8) {
                    $errorMsg .= "Phone number must be 8 digits.<br>";
                    $success = false;
                }
            }

            if (empty($_POST["outlet"])) {
                $errorMsg .= "Outlet is required.<br>";
                $success = false;
            } else {
                $outlet = sanitize_input($_POST["outlet"]);
            }

            if (empty($_POST["topics"])) {
                $errorMsg .= "Topic is required.<br>";
                $success = false;
            } else {
                $topics = sanitize_input($_POST["topics"]);
            }

            if (empty($_POST['comment'])) {
                $errorMsg .= "Comment is required. <br>";
                $success = false;
            } else {
                $comment = sanitize_input($_POST["comment"]);
                $comment = htmlspecialchars($_POST['comment'], ENT_QUOTES, 'UTF-8');
            }

            if ($success) {
                saveMemberToDB($title, $fname, $lname, $email, $phone, $outlet, $topics, $comment, $errorMsg);
                // Send confirmation email
                // $mail = new PHPMailer(true);
                // try {
                //     // Server settings
                //     $mail->isSMTP();                                      // Set mailer to use SMTP
                //     $mail->Host = 'smtp.example.com';                     // Specify main and backup SMTP servers
                //     $mail->SMTPAuth = true;                               // Enable SMTP authentication
                //     $mail->Username = 'your_email@example.com';           // SMTP username
                //     $mail->Password = 'your_password';                    // SMTP password
                //     $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                //     $mail->Port = 587;                                    // TCP port to connect to
        

                //     // Recipients
                //     $mail->setFrom('from@example.com', 'Mailer'); // Use your own email address here
                //     $mail->addAddress($email, "$fname $lname");   // Add the form's email address as the recipient
        
                //     // Content
                //     $mail->isHTML(true);
                //     $mail->Subject = 'Thank you for your submission';
                //     $mail->Body = 'This is a confirmation that we have received your message.';
                //     $mail->AltBody = 'This is a plain-text message body';

                //     $mail->send();
                //     echo '<h3>Message has been sent</h3>';
                // } catch (Exception $e) {
                //     // Error handling for PHPMailer
                //     echo '<h3>Message could not be sent. Mailer Error: ' . $mail->ErrorInfo . '</h3>';
                // }
                echo '<div class="successMsg">';
                echo "<h3>We have received your contact form!</h3>";
                echo "Please wait up to 1-2 working days for a reply. Thank you.";
                echo "<br/><br/>";
                echo '<a href="/"><input type="submit" class="submit-btn-success" value="Back to Homepage"/></a></div>';
            } else {
                echo '<div class="errorMsg">';
                echo "<h3>Oops!</h3>";
                echo "<h4>The following input errors were detected:</h4>";
                echo "<p>" . $errorMsg . "</p>";
                echo '<a href="/contact-us.php"><input type="submit" class="submit-btn-error" value="Return to Contact Us Form"/></a></div>';
            }
        }
        ?>
    </main>
    <?php
    include "inc/footer.inc.php";
    ?>
    <!--Custom JS-->
    <script defer src="js/main.js"></script>
</body>

</html>