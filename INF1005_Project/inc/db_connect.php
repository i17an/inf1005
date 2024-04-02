<?php
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
        }

/*
// db_connect.php
$servername = "127.0.0.1"; // Change this to your MySQL server
$username = "inf1005-sqldev2"; // Change this to your MySQL username
$password = "inf1005_p5-8"; // Change this to your MySQL password
$database = "iron_gains_gym";// Change this to your MySQL database name


// Create connection
$conn = new mysqli($servername, $username, $password, $database);*/

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
