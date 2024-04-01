<!DOCTYPE html>
<html lang="en">

<head>
    <title>Contact Us</title>
    <?php
    include "inc/head.inc.php";
    ?>
    <link rel="stylesheet" href="css/externalcss/cirrus.css">
    <link rel="stylesheet" href="css/contact-us.css">

</head>

<body>
    <!--Navbar-->
    <?php
    include "inc/nav.inc.php";
    ?>
    <!--End of Navbar-->
    <main>
        <!--Contact Us Form-->
        <div style="padding-top: 14vh;"></div>

        <form action="process_contact.php" class="contact-form" method="post">
            <div class="col">
                <div class="padded">
                    <div class="u-text-center u-font-alt">
                        <h1>Send Us Your Enquiries</h1>
                    <div class="divider"></div>
                    <p class="u-text-center">Ask Your Questions!</p>
                    <div class="divider"></div>
                    </div>
                    
                    <div class="form-section section-inline">
                        <div class="section-body row">
                            <div class="form-group col-4 pl-0">
                                <label class="form-group-label" for="title">
                                    <span class="icon">
                                        <i class='bx bx-face' ></i>
                                    </span>
                                </label>
                                <select required class="select form-group-input" placeholder="Title" id="title" name="title">
                                    <option>Mr.</option>
                                    <option>Ms.</option>
                                    <option>Mrs.</option>
                                    <option>Miss.</option>
                                    <option>Master.</option>
                                    <option>Madam.</option>
                                </select>
                            </div>
                            
                            <div class="form-group col-4 pr-0">
                                <label class="form-group-label" for="fname">
                                    <span class="icon">
                                        <i class='bx bx-user'></i>
                                    </span>
                                </label>
                                <input type="text" class="form-group-input" placeholder="First Name" id="fname" name="fname" maxlength="45"/>
                            </div>

                            <div class="form-group col-4 pr-0">
                                <label class="form-group-label" for="lname">
                                    <span class="icon">
                                        <i class='bx bx-user'></i>
                                    </span>
                                </label>
                                <input required type="text" class="form-group-input" placeholder="Last Name" id="lname" name="lname" maxlength="45"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-section section-inline">
                        <div class="section-body row">
                            <div class="form-group col-6 pl-0">
                                <label class="form-group-label" for="email">
                                    <span class="icon">
                                    <i class='bx bx-envelope' ></i>
                                    </span>
                                </label>
                                <input required type="email" class="form-group-input" placeholder="Enter your email" id="email" name="email" maxlength="45"/>
                            </div>

                            <div class="form-group col-6 pr-0">
                                <label class="form-group-label" for="phone">
                                    <span class="icon">
                                    <i class='bx bx-phone' ></i>
                                    </span>
                                </label>
                                <input required type="tel" class="form-group-input" placeholder="Enter your phone number" id="phone" name="phone"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-section section-inline">
                        <div class="section-body row">
                            <div class="form-group col-6 pl-0">
                                <label class="form-group-label" for="outlet">
                                    <span class="icon">
                                    <i class='bx bx-map' ></i>
                                    </span>
                                </label>
                                <select required class="select form-group-input" placeholder="Select Outlet" id="outlet" name="outlet">
                                    <option>Tampines CC</option>
                                    <option>Ngee Ann City</option>
                                    <option>East Coast Park</option>
                                </select>
                            </div>

                            <div class="form-group col-6 pr-0">
                                <label class="form-group-label" for="topics">
                                    <span class="icon">
                                    <i class='bx bx-question-mark' ></i>
                                    </span>
                                </label>
                                <select required class="select form-group-input" placeholder="Select Topic" id="topics" name="topics">
                                    <option>Membership</option>
                                    <option>Personal Training</option>
                                    <option>Corporate Membership</option>
                                    <option>Trial / Gym Tour</option>
                                    <option>Payment Matters</option>
                                    <option>Feedback</option>
                                    <option>Others</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <textarea required placeholder="Comment here" type="text" maxlength="500" id="comment" name="comment"></textarea>

                    <div class="btn-group u-pull-right">
                        <button class="btn-info">Send</button>
                    </div>

                </div>
            </div>
        </form>

        <section class="text-module" data-attr-module-name="module-text" id="contact-section"
            style="margin-bottom: 0vh;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="editorial-title">
                            <h2><span class="headline">CONTACT US</span></h2>
                        </div><br>
                    </div>
                    <div class="col-lg-6 col-md-12 contact-info" style="color:white;">
                        <b>EMAIL US</b>
                        <p><a href="mailto:irongainsgym@wow.com">IronGainsGyms@wow.com</a></p>

                        <b>CALL US</b>
                        <p>65-1234-5678 Monday through Sunday, 8am to 11pm <br>
                            Holiday Hours are subject to change</p>

                        <b>MAILING ADDRESS</b>
                        <p>180 Ang Mo Kio Ave 8, Singapore 569830</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="text-module" data-attr-module-name="module-text" id="faq-section" style="margin-bottom: 0vh;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="editorial-title">
                            <h2><span class="headline">FREQUENTLY ASKED QUESTIONS & REQUESTS</span></h2>
                        </div><br>
                    </div>
                    <div class="col-lg-6 col-md-12 faq-info" style="color:white;">
                        <b>FAQ</b>
                        <p><a href="/faq">Click here for our FAQ</a></p>
                    </div>
                </div>
            </div>
        </section>


    </main>
</body>

<!--Footer-->
<?php
include "inc/footer.inc.php";
?>
<!--End of Footer-->

<!--Custom JS-->
<script defer src="js/main.js"></script>
</body>

</html>