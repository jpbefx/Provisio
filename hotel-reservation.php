<?php session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Provisio - Red Team | Hotel Reservation page</title>
    <link rel="stylesheet" href="css/custom-style.css" type="text/css" />
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tiro+Bangla&display=swap" rel="stylesheet">
    <link href="css/rome.css" rel="stylesheet" type="text/css" />
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
    <header class="customer-loyalty-bg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <nav class="navbar navbar-expand-lg">
                        <div class="container-fluid">
                            <a class="navbar-brand nav-bar" href="index.html"><img class="img-fluid"
                                    src="images/white-logo.svg" /></a>
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
                                        <a class="nav-link" aria-current="page" href="about-us.php">About Us</a>
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
                                                <li><a class="dropdown-item" href="#">Manage Reservations</a></li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li><a class="dropdown-item" href="#">ProPoints</a></li>
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
                        <div class="location-btn"> Start your Booking </div>
                        <div class="location-wrapper">
                            <div class="hotels-directly">
                                <h3>Choose your Dates</h3>
                            </div>
                            <div class="mt-5">
                                <form action="#" class="row">
                                    <div class="col-md-6">
                                        <div class="form-group check-text">
                                            <label for="input_from">Check In</label>
                                            <input type="text" class="form-control" id="input_from" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group check-text">
                                            <label for="input_from">Check Out</label>
                                            <input type="text" class="form-control" id="input_to" placeholder="">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="mt-5">
                                <div class="hotels-directly">
                                    <h3>Number of guests:</h3> <input class="form-control" type="text"
                                        aria-label="input">
                                </div>
                            </div>
                            <div class="hotels-directly mt-5">
                                <h3>Locations</h3>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                    <div class="nyc-location">
                                        <div class="hotel-location-text custom-form-check">New York <input
                                                type="checkbox" class="form-check-input" id="exampleCheck1"></div>
                                        <img class="img-fluid" src="images/location-newyork-img.png" />
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                    <div class="nyc-location">
                                        <div class="hotel-location-text custom-form-check">Las Vegas <input
                                                type="checkbox" class="form-check-input" id="exampleCheck1"></div>
                                        <img class="img-fluid" src="images/location-lasvegas-img.png" />
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                    <div class="nyc-location">
                                        <div class="hotel-location-text custom-form-check">Honolulu <input
                                                type="checkbox" class="form-check-input" id="exampleCheck1"></div>
                                        <img class="img-fluid" src="images/location-honolulu-img.png" />
                                    </div>
                                </div>
                            </div>
                            <div class="hotels-directly mt-5">
                                <h3>Room Type</h3>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 offset-lg-1 col-md-6 col-sm-12 col-12">
                                    <div class="nyc-location">
                                        <div class="hotel-location-text custom-form-check">Double Full Beds $110.00
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        </div>
                                        <img class="img-fluid" src="images/double-full-bed.png" />
                                    </div>
                                </div>
                                <div class="col-lg-4 offset-lg-1 col-md-6 col-sm-12 col-12">
                                    <div class="nyc-location">
                                        <div class="hotel-location-text custom-form-check">Double Queen Beds $125.00
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        </div>
                                        <img class="img-fluid" src="images/double-queen-bed.png" />
                                    </div>
                                </div>
                                <div class="col-lg-4 offset-lg-1 col-md-6 col-sm-12 col-12">
                                    <div class="nyc-location">
                                        <div class="hotel-location-text custom-form-check">Queen Bed $150.00 <input
                                                type="checkbox" class="form-check-input" id="exampleCheck1"></div>
                                        <img class="img-fluid" src="images/queen-bed.png" />
                                    </div>
                                </div>
                                <div class="col-lg-4 offset-lg-1 col-md-6 col-sm-12 col-12">
                                    <div class="nyc-location">
                                        <div class="hotel-location-text custom-form-check">King Bed $165.00 <input
                                                type="checkbox" class="form-check-input" id="exampleCheck1"></div>
                                        <img class="img-fluid" src="images/king-bed.png" />
                                    </div>
                                </div>
                            </div>
                            <div class="hotels-directly mt-5">
                                <h3>Amenities</h3>
                            </div>
                            <div class="col-12">
                                <div class="amenities-box">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                                            <div class="hotel-location-text text-start custom-form-check">
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1"> WiFi
                                                +$12.99 flat fee
                                            </div>
                                            <div class="hotel-location-text text-start custom-form-check mt-50">
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                Parking + $19.99 per night
                                            </div>
                                            <div class="hotel-location-text text-start custom-form-check mt-50">
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                Breakfast + $8.99 per night
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                                            <div class="hotel-location-text text-start custom-form-check"> Included with
                                                every stay: </div>
                                            <div class="hotel-location-text text-start custom-form-check mt-50">
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1"
                                                    checked> Earn 150 Provisio points per night
                                            </div>
                                            <div class="hotel-location-text text-start custom-form-check mt-50">
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1"
                                                    checked> Gym/ Pool Access
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="booknow-btn text-center mt-5"> <button type="button"> Book Now </button></div>
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
    <script src="js/jquery-3.3.1.min.js" type="text/javascript"></script>
    <script src="js/popper.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script src="js/rome.js" type="text/javascript"></script>
    <script src="js/main.js" type="text/javascript"></script>

</body>

</html>