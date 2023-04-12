<!-- 
Nicholas Werner, James Bailey, Larissa Passamani Lima
CSD 460 - Red Team
 -->
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
    } else {
        header("Location: index.php");
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
                            <a class="navbar-brand nav-bar" href="index.php"><img class="img-fluid"
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
                                        <a class="nav-link" href="aboutus.php">About Us</a>
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
                                                <li><a class="dropdown-item" href="reservation.php">Start a Reservation</a>
                                                </li>
                                                <li><a class="dropdown-item" href="manageReservation.php">Manage
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


    <section class="location-bg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="mtop-20rem">
                        <div class="location-btn"> Start your Booking </div>
                        <div class="location-wrapper">
                            <?php
                            //Reservation Logic
                            if (array_key_exists('bookButton', $_POST)) {
                                checkReservationFields();
                            }

                            function checkReservationFields()
                            {
                                global $redirectReady;
                                $hasError = false;
                                $errorStr = "";

                                //check in blank
                                if ($_POST["checkIn"] == "") {
                                    $hasError = true;
                                    $errorStr .= "<li>Check In is blank!</li>";
                                } else {
                                    //check in date is in the past
                                    if ($_POST["checkIn"] < date("Y-m-d")) {
                                        $hasError = true;
                                        $errorStr .= "<li>Check In is earlier then today!</li>";
                                    }
                                }

                                //check out blank
                                if ($_POST["checkOut"] == "") {
                                    $hasError = true;
                                    $errorStr .= "<li>Check Out is blank!</li>";
                                } else {
                                    //check out date is in the past
                                    if ($_POST["checkOut"] < date("Y-m-d")) {
                                        $hasError = true;
                                        $errorStr .= "<li>Check Out is earlier then today!</li>";
                                    }
                                }

                                //check in is before check out
                                if ($_POST["checkIn"] > $_POST["checkOut"]) {
                                    $hasError = true;
                                    $errorStr .= "<li>Check In is after Check Out!</li>";
                                }

                                //check if hotel is selected
                                if (isset($_POST['hotelGroup']) == false) {
                                    $hasError = true;
                                    $errorStr .= "<li>Select one of the hotels</li>";
                                }

                                //check if room is selected
                                if (isset($_POST['roomGroup']) == false) {
                                    $hasError = true;
                                    $errorStr .= "<li>Select one of the hotels</li>";
                                }

                                //check if num guests has a value
                                if ($_POST['numGuests'] < 0) {
                                    $hasError = true;
                                    $errorStr .= "<li>Number of guests is negative or blank</li>";
                                }
                                if ($_POST['numGuests'] > 4) {
                                    $hasError = true;
                                    $errorStr .= "<li>Number of guests exceeds 4. For parties requiring more then 4 people, please create a seperate reservation.</li>";
                                }


                                if ($hasError == false) {
                                    $_SESSION['checkIn'] = $_POST["checkIn"];
                                    $_SESSION['checkOut'] = $_POST["checkOut"];
                                    $_SESSION['numGuests'] = $_POST['numGuests'];
                                    $_SESSION['hotel'] = $_POST['hotelGroup'];
                                    $_SESSION['room'] = $_POST['roomGroup'];

                                    $hasWifi = "No";
                                    if(isset($_POST['wifi'])){
                                        $hasWifi = "Yes";
                                    }
                                    $_SESSION['hasWifi'] = $hasWifi;

                                    $hasParking = "No";
                                    if(isset($_POST['parking'])){
                                        $hasParking = "Yes";
                                    }
                                    $_SESSION['hasParking'] = $hasParking;

                                    $hasBreakfest = "No";
                                    if(isset($_POST['breakfest'])){
                                        $hasBreakfest = "Yes";
                                    }
                                    $_SESSION['hasBreakfest'] = $hasBreakfest;

                                    echo "<script> location.replace('reservationSummary.php'); </script>";
                                } else {
                                    echo "<div class='response-text'>One or more errors:<br><ul>" . $errorStr . "</div>";
                                }
                            }

                            ?>
                            </ul>
                            <div class="hotels-directly">
                                <h3>Choose your Dates</h3>
                            </div>
                            <form class="row" method="post">
                                <div class="mt-5">
                                    <div class="col-md-6">
                                        <div class="form-group check-text">
                                            <label for="input_from">Check In</label>
                                            <?php
                                            echo "<input type='date' class='form-control' name='checkIn' id='input_from' min=" . date("Y-m-d") . ">";
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group check-text">
                                            <label for="input_from">Check Out</label>
                                            <?php
                                            echo "<input type='date' class='form-control' name='checkOut' id='input_from' min=" . date('Y-m-d', strtotime("+1 day")) . ">";
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-5">
                                    <div class="hotels-directly">
                                        <h3>Number of guests:</h3>
                                        <input class="form-control" type="text" name="numGuests" aria-label="input">
                                    </div>
                                </div>
                                <div class="hotels-directly mt-5">
                                    <h3>Locations</h3>
                                </div>
                                <div class="row">
                                    <fieldset id="hotelGroup">
                                        <?php
                                        $hotelList = getAllHotels();
                                        if ($hotelList == false) {
                                            echo "Error accessing hotel list try again later";
                                        } else {
                                            while ($hotel = mysqli_fetch_assoc($hotelList)) {
                                                echo "<div class='col-lg-4 col-md-6 col-sm-12 col-12'>";
                                                echo "  <div class='nyc-location'>";
                                                echo "      <div class='hotel-location-text custom-form-check'>" . $hotel['hotelName'];
                                                echo "          <input type='radio' name='hotelGroup' class='form-check-input' value=" . $hotel['hotelName'] . ">";
                                                echo "      </div>";
                                                echo "      <img class='img-fluid' src=" . $hotel['pictureAddress'] . " />";
                                                echo "  </div>";
                                                echo "</div>";
                                            }
                                        }
                                        ?>
                                    </fieldset>
                                </div>
                                <div class="hotels-directly mt-5">
                                    <h3>Room Type</h3>
                                </div>
                                <div class="row">
                                    <fieldset id="roomGroup">
                                        <?php
                                        $roomList = getAllRooms();
                                        if ($roomList == false) {
                                            echo "Error accessing room list try again later";
                                        } else {
                                            while ($room = mysqli_fetch_assoc($roomList)) {
                                                echo "<div class='col-lg-4 offset-lg-1 col-md-6 col-sm-12 col-12'>";
                                                echo "  <div class='nyc-location'>";
                                                echo "      <div class='hotel-location-text custom-form-check'>" . $room['roomType'] . " $" . $room['roomCost'];
                                                echo "          <input type='radio' name='roomGroup'class='form-check-input' value=" . $room['roomType'] . ">";
                                                echo "      </div>";
                                                echo "      <img class='img-fluid' src=" . $room['pictureAddress'] . " />";
                                                echo "  </div>";
                                                echo "</div>";
                                            }
                                        }

                                        ?>
                                    </fieldset>
                                </div>
                                <div class="hotels-directly mt-5">
                                    <h3>Amenities</h3>
                                </div>
                                <div class="col-12">
                                    <div class="amenities-box">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                                                <div class="hotel-location-text text-start custom-form-check">
                                                    <input type="checkbox" class="form-check-input" name="wifi"
                                                        id="exampleCheck1">
                                                    WiFi
                                                    +$12.99 flat fee
                                                </div>
                                                <div class="hotel-location-text text-start custom-form-check mt-50">
                                                    <input type="checkbox" class="form-check-input" name="Parking"
                                                        id="exampleCheck1">
                                                    Parking + $19.99 per night
                                                </div>
                                                <div class="hotel-location-text text-start custom-form-check mt-50">
                                                    <input type="checkbox" class="form-check-input" name="Breakfest"
                                                        id="exampleCheck1">
                                                    Breakfast + $8.99 per night
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                                                <div class="hotel-location-text text-start custom-form-check"> Included
                                                    with
                                                    every stay: </div>
                                                <div class="hotel-location-text text-start custom-form-check mt-50">
                                                    <input type="checkbox" class="form-check-input"
                                                        onclick="return false;" id="exampleCheck1" checked> Earn 150
                                                    Provisio points per night
                                                </div>
                                                <div class="hotel-location-text text-start custom-form-check mt-50">
                                                    <input type="checkbox" class="form-check-input"
                                                        onclick="return false;" id="exampleCheck1" checked> Gym/ Pool
                                                    Access
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="booknow-btn text-center mt-5">
                                    <button type="submit" name="bookButton"> Book Now </button>
                                </div>
                            </form>
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