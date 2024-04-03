<!DOCTYPE html>
<html lang="en">

<head>
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
                    <a href="/login.php">Sign In page</a>
                </p>

                <form action = "process_register.php" method = "post" class="registration-form" onsubmit="return checkForm()">
                <div class = "mb-3">
                <label for="fname" class="form-label">First Name:</label>
                <input type="text" id="fname" name="fname" class="form-control" placeholder="Enter first name">
                </div>


                <div class = "mb-3">
                <label for="lname" class="form-label">Last Name:</label>
                <input required maxlength="45" type="text" id="lname" name="lname" class="form-control" placeholder="Enter last name">
                </div>


                <div class = "mb-3">
                <label for="email" class="form-label">Email:</label>
                <input required maxlength="45" type="email" id="email" name="email" class="form-control" placeholder="Enter email">
                </div>


                <div class = "mb-3">
                <label for="pwd" class="form-label">Password:</label>
                <input required type="password" id="pwd" name="pwd" class="form-control" minlength="4" placeholder="Enter password">
                </div>


                <div class = "mb-3">
                <label for="pwd_confirm" class="form-label">Confirm Password:</label>
                <input required type="password" id="pwd_confirm" name="pwd_confirm" class="form-control" placeholder="Confirm password">
                <p id="message"></p>
                </div>


                <div class="mb-3">
                <button type="submit" class="btn btn-primary">Submit</button>

            </form>
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
