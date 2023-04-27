<!-- 
Nicholas Werner, James Bailey, Larissa Passamani Lima
CSD 460 - Red Team
 -->
<?php session_start(); ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Red Team - Provisio | Location page</title>
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
    <header class="location-header-bg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <nav class="navbar navbar-expand-lg">
                        <div class="container-fluid">
                            <a class="navbar-brand nav-bar" href="index.php"><img class="img-fluid"
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
                                                <li><a class="dropdown-item"
                                                        href="customer-loyalty-propoints.php">ProPoints</a></li>
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
    <section class="location-bg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="mtop-20rem">
                        <div class="location-btn"> Our Locations </div>
                        <div class="location-wrapper">
                            <div class="row">
                                <div class="col-lg-5 col-md-12 col-sm-12 col-12">
                                    <div class="">
                                        <img class="img-fluid" src="images/ny-img.png" />
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-12 col-sm-12 col-12">
                                    <div class="ny-text">
                                        <h1>New York City, NY</h1>
                                        <p>The Provisio New York hotel is located in the Midtown East district of
                                            Manhattan. The area is full of shops, restaurants, bars, and business
                                            offices, making it an ideal spot for business trips, family vacations,
                                            or a
                                            romantic getaway. </p>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="hotels-directly mt-50">
                                        <h3>Top Attractions near our NYC location</h3>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                    <div class="nyc-location">
                                        <img class="img-fluid" src="images/time-square-img.png" />
                                        <div class="nyc-location-text">Times Square</div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                    <div class="nyc-location">
                                        <img class="img-fluid" src="images/central-park-img.png" />
                                        <div class="nyc-location-text">Central Park</div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                    <div class="nyc-location">
                                        <img class="img-fluid" src="images/empire-state-img.png" />
                                        <div class="nyc-location-text">Empire State</div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5">
                                <div class="row">
                                    <div class="col-lg-5 col-md-12 col-sm-12 col-12">
                                        <div class="">
                                            <img class="img-fluid" src="images/nv-img.png" />
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-12 col-sm-12 col-12">
                                        <div class="ny-text">
                                            <h1>Las Vegas, NV</h1>
                                            <p>The Provisio Las Vegas hotel is located in a prime location just
                                                minutes
                                                away from the glitz and glamour of the world-renowned Las Vegas
                                                Strip.
                                                Whether looking for a night out, a relaxed stroll, or a quiet moment
                                                of
                                                peace, this hotel is the perfect destination for all types of
                                                travelers.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="hotels-directly mt-50">
                                            <h3>Top Attractions near our Last Vegas location</h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                        <div class="nyc-location">
                                            <img class="img-fluid" src="images/las-strip-img.png" />
                                            <div class="nyc-location-text">Las Vegas Strip</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                        <div class="nyc-location">
                                            <img class="img-fluid" src="images/dam-img.png" />
                                            <div class="nyc-location-text">Hover Dam</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                        <div class="nyc-location">
                                            <img class="img-fluid" src="images/casinos-img.png" />
                                            <div class="nyc-location-text">Casinos</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5">
                                <div class="row">
                                    <div class="col-lg-5 col-md-12 col-sm-12 col-12">
                                        <div class="">
                                            <img class="img-fluid" src="images/honolulu-img.png" />
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-12 col-sm-12 col-12">
                                        <div class="ny-text">
                                            <h1>Honolulu, HI</h1>
                                            <p>Provisio Hawaii is located in the heart of Waikiki, Honolulu, Hawaii.
                                                This is the perfect place to stay during a vacation to the island,
                                                with
                                                its beachfront views, luxurious amenities and convenient location.
                                                Guests can enjoy breathtaking views of the Pacific Ocean.</p>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="hotels-directly mt-50">
                                            <h3>Top Attractions near our Honolulu location</h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                        <div class="nyc-location">
                                            <img class="img-fluid" src="images/waikiki-beach-img.png" />
                                            <div class="nyc-location-text">Waikiki Beach</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                        <div class="nyc-location">
                                            <img class="img-fluid" src="images/hanauma-bay-img.png" />
                                            <div class="nyc-location-text">Hanauma Bay</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                        <div class="nyc-location">
                                            <img class="img-fluid" src="images/iolani-palace-img.png" />
                                            <div class="nyc-location-text">Iolani Palace</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
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
