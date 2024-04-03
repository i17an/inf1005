<?php 
    // Start the session
    session_start();
    
    // Include the appropriate navigation file based on the login status
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        include "inc/nav.inc.profile.php";
    } else {
        include "inc/nav.inc.php";
    }
?>