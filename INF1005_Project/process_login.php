<?php
// process_login.php

session_start();

require_once 'inc/db_connect.php';

$email = $password = "";
$email_err = $password_err = "";

$admin_email = "admin@email.com";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (empty($email)) {
        $email_err = "Please enter your email.";
    }

    if (empty($password)) {
        $password_err = "Please enter your password.";
    }

    if (empty($email_err) && empty($password_err)) {
        // Perform regular user login
        $sql = "SELECT member_id, fname, lname, email, password FROM members WHERE email = ?";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();

                if (password_verify($password, $row["password"])) {
                    $_SESSION["loggedin"] = true;
                    $_SESSION["member_id"] = $row["member_id"];
                    $_SESSION["fname"] = $row["fname"];
                    $_SESSION["lname"] = $row["lname"];
                    $_SESSION["email"] = $row["email"];

                    if ($email === $admin_email) {
                        // Redirect to the admin dashboard
                        header("location: admin_dashboard.php");
                        exit();
                    } else {
                    header("location: login_landingPG.php");
                    exit();
                    }
                } else {
                    $password_err = "The password you entered was not valid.";
                }
            } else {
                $email_err = "No account found with that email.";
            }

            $stmt->close();
        }
        $conn->close();
        
    }

    if (!empty($email_err) || !empty($password_err)) {
        $_SESSION["email_err"] = $email_err;
        $_SESSION["password_err"] = $password_err;
        header("location: login.php");
        exit();
    }
}
?>