<!-- 
Nicholas Werner, James Bailey, Larissa Passamani Lima ,Shia Goldberger
CSD 460 - Red Team
 -->
<?php session_start(); ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Provisio | About Us page</title>
    <link rel="stylesheet" href="css/custom-style.css" type="text/css" />
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tiro+Bangla&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"
        integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <?php
    //Global user check
    require("php/databaseMgmt.php");


    if (isset($_SESSION['username'])) {
        if (validateUser($_SESSION['username']) == false) {
            signOutUser();
        }
    }
    ?>
</head>

<body>
    <header class="about-header-bg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <nav class="navbar navbar-expand-lg">
                        <div class="container-fluid">
                            <a class="navbar-brand nav-bar" href="index.html"><img class="img-fluid"
                                    src="images/provisiologo.svg" /></a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse navbar-nav-custom" id="navbarSupportedContent">
                                <ul class="navbar-nav custom-nav">
                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="index.php">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="about-us.php">About Us</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="location.php">Location</a>
                                    </li>
                                    <?php
                                    //Show the dropdown if a user is signed in
                                    if (isset($_SESSION['username'])) {
                                        ?>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" role="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <?php
                                                echo $_SESSION['username'];
                                                ?>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="hotel-reservation.php">Start a
                                                        Reservation</a></li>
                                                <li><a class="dropdown-item" href="reservation-lookup.php">Manage
                                                        Reservations</a></li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li><a class="dropdown-item" href="propoints.php">ProPoints</a></li>
                                            </ul>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                    <div class="login-btn">
                                        <?php
                                        //Green Button Space; Either logout or login
                                        if (isset($_SESSION['username'])) {
                                            ?>
                                            <a href="php\logout.php">
                                                <?php
                                        } else {
                                            ?>
                                                <a href="login.php">
                                                    <?php
                                        }

                                        if (isset($_SESSION['username'])) {
                                            echo "Log Out";
                                        } else {
                                            echo "Login / Sign Up";
                                        }
                                        ?>
                                            </a>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <section class="about-us-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="mtop-20rem">
                        <div class="main-wrapper">
                            <div class="about-us-btn"> About Us </div>
                            <div class="about-content">
                                <p>Proviso is a hotel company that was founded with the mission to provide the highest
                                    quality of hospitality services for our customers. Our company was started in the
                                    late 1990s by a group of experienced hospitality professionals who saw a need in the
                                    industry for a higher level of service. We have since grown to become one of the
                                    leading hotel companies in the country.</p>

                                <p>At Proviso, we believe that true hospitality starts with the people that work for us.
                                    We strive to create a supportive and inclusive work environment, where everyone is
                                    respected and valued. Our team is made up of experienced professionals who are
                                    dedicated to providing a superior customer service experience.</p>
                            </div>
                            <div class="about-us-img"><img class="img-fluid" src="images/about-us-img.png" /></div>
                        </div>
                    </div>
                    <div class="contact-us-wrapper">
                        <h2>Have Questions ? Contact us by Phone or Email</h2>
                        <p>Customer Service email: <a href="#">support@provisiohotel.com</a></p>
                        <p>Customer Service Phone Number: <a href="#">(888)-989-0001</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="hotels-directly">
                        <h3>You can also contact one of our hotels directly</h3>
                    </div>
                </div>
                <?php
                $hotelList = getAllHotels();
                if ($hotelList == false) {
                    echo "Error accessing hotel list try again later";
                } else {
                    while ($hotel = mysqli_fetch_assoc($hotelList)) {
                        echo "<div class='col-lg-4 col-md-6 col-sm-12 col-12'>";
                        echo "  <div class='directly-text mt-50'>";
                        echo "      <p>Provisio Hotel - " . $hotel['hotelName'] . "<br />";
                        echo $hotel['hotelAddress'] . "<br />";
                        echo $hotel['hotelCity'] . ", " . $hotel['hotelState'] . " " . $hotel['hotelZip'] . "<br />";
                        echo "          Phone: " . $hotel['hotelPhone'] . "<br />";
                        echo "          Email: <a href='mailto:" . $hotel['hotelEmail'] . "'>" . $hotel['hotelEmail'] . "</a>";
                        echo "      </p>";
                        echo "  </div>";
                        echo "  <div class='directly-img'>";
                        echo "      <img class='img-fluid' src=" . $hotel['pictureAddress'] . " />";
                        echo "  </div>";
                        echo "</div>";
                    }
                }
                ?>
            </div>
        </div>
    </section>

    <footer class="mt-70">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="copyright-text">2023 Provisio . Inc</div>
                </div>
            </div>
        </div>
    </footer>

    <script src="js/bootstrap.min.js" type="text/javascript"></script>
</body>

</html>
