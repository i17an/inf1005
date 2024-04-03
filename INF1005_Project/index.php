<!DOCTYPE html>
<html lang="en">

<head>
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
                <h2>Elevate Your Fitness</h2>
                <p>Welcome to a place where every sweat drop counts and every breath fuels your journey towards peak
                    fitness. At Iron Gain's Gym, we believe in the power of movement, the thrill of pushing limits, and
                    the joy of reaching goals. </p>
                <a href="#">Explore More</a>
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
