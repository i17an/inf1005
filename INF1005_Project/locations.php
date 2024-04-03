<!DOCTYPE html>
<html lang="en">

<head>
    <?php
        include "inc/head.inc.php";
    ?>
    <link rel="stylesheet" href="../css/locations.css">
    <style>
        main {
            min-height: 100vh; /* Override the min-height property */
        }
        .text{
            padding-top: 75px;
        }
    </style>
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
                <h2>OUR LOCATIONS</h2>
                <iframe id="map" src="https://www.google.com/maps/d/embed?mid=15yjdCJUh0EdK-7_C8js5cdZaI6V1lg4&ehbc=2E312F" width="640" height="480"></iframe>
                <div class="row">
                <div class="col-sm-6">
                    <h3><b>IRON GAINS GYM NORTH</b><br></h3>
                    <p>Monday - Friday: 9AM - 9PM<br></p>
                    <p>Saturday and Sunday: 10AM - 10PM<br></p>
                    <p>Public Holidays: 12PM - 8.30PM</p>
                </div>
                <div class="col-sm-6">
                    <h3>IRON GAINS GYM SOUTH</h3>
                    <p>Monday - Friday: 9AM - 9PM<br></p>
                    <p>Saturday and Sunday: 10AM - 10PM<br></p>
                    <p>Public Holidays: 12PM - 8.30PM</p>
                </div>
                <div class="row">
                <div class="col-sm-6">
                    <h3>IRON GAINS GYM EAST</h3>
                    <p>Monday - Friday: 9AM - 9PM<br></p>
                    <p>Saturday and Sunday: 10AM - 10PM<br></p>
                    <p>Public Holidays: 12PM - 8.30PM</p>
                </div>
                <div class="col-sm-6">
                    <h3>IRON GAINS GYM WEST</h3>
                    <p>Monday - Friday: 9AM - 9PM<br></p>
                    <p>Saturday and Sunday: 10AM - 10PM<br></p>
                    <p>Public Holidays: 12PM - 8.30PM</p>
                </div>
                </div>            
            </div>
        </section>
    </main>
    <!--Footer-->
    <?php
        include "inc/footer.inc.php";
    ?>
    <!--End of Footer-->

    <!--Custom JS-->
    <script defer src="js/main.js"></script>
</body>

</html>