<!DOCTYPE html>
<html lang="en">

<head>
    <?php
        include "inc/head.inc.php";
    ?>
</head>


<body>
    <!--Navbar-->
    <?php
        include "inc/nav.inc.php";
    ?>
    <!--End of Navbar-->
    <main>
        <section class="showcase">
            <video src="assets/videos/gymvideo.mp4" muted loop autoplay></video>
            <div class="overlay"></div>
            <div class="text">
            <p>
                For existing members, please go to the
                <a href="/login.php">Sign In page</a>.
            </p>
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
