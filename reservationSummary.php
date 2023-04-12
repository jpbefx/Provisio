<?php session_start(); ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Provisio - Red Team | Reservation Lookup page</title>
    <link rel="stylesheet" href="css/custom-style.css" type="text/css" />
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tiro+Bangla&display=swap" rel="stylesheet">
    <link href="css/rome.css" rel="stylesheet" type="text/css" />
</head>

<?php
//Global user check
require("php/databaseMgmt.php");
if (isset($_SESSION['username'])) {
    if (validateUser($_SESSION['username']) == false) {
        signOutUser();
    }
    $hasError = false;
    if(isset($_SESSION['checkIn']) == false){
        $hasError = true;
    }
    if(isset($_SESSION['checkOut']) == false){
        $hasError = true;
    }
    if(isset($_SESSION['numGuests']) == false){
        $hasError = true;
    }
    if(isset($_SESSION['hotel']) == false){
        $hasError = true;
    }
    if(isset($_SESSION['room']) == false){
        $hasError = true;
    }
    if(isset($_SESSION['hasWifi']) == false){
        $hasError = true;
    }
    if(isset($_SESSION['hasParking']) == false){
        $hasError = true;
    }
    if(isset($_SESSION['hasBreakfest']) == false){
        $hasError = true;
    }
    if($hasError == true){
        header("Location: index.php");
    }

    $hotelInfo = getHotelInfo($_SESSION['hotel']);
    $hotelAddress = $hotelInfo['hotelAddress'];

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
                        <div class="reservation-list">
                            <div class="hotel-heading text-center">
                                <h2>Here is your Booking Summary </h2>
                            </div>
                            <div class="reservation-list-wrapper">
                                <div class="mb-61">
                                    <div class="row">
                                        <div class="col-lg-8 col-md-9 col-sm-12 col-12">
                                            <div class="hotel-heading">
                                                <h2>
                                                <?php
                                                    echo "Provisio Hotel - " . $_SESSION['hotel'];
                                                ?>
                                                </h2>
                                                <p>
                                                <?php
                                                    echo $hotelAddress;
                                                ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-3 col-sm-12 col-12">
                                        </div>
                                        <div class="reservation-content">
                                            <ul>
                                                <li><span>Booking Dates:</span></li>
                                                <li>
                                                    <?php
                                                        echo "Check In Date : " . $_SESSION['checkIn'];
                                                    ?>
                                                </li>
                                                <li>
                                                <?php
                                                        echo "Check Out Date : " . $_SESSION['checkOut'];
                                                ?>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                                <div class="reservation-content">
                                                    <ul>
                                                        <li><span>Number of guests:</span></li>
                                                        <li>
                                                            <?php
                                                                echo $_SESSION['numGuests'];
                                                            ?>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-6 col-sm-12 col-12">
                                                <div class="reservation-content">
                                                    <ul>
                                                        <li><span>Room Type:</span></li>
                                                        <li>
                                                            <?php
                                                                echo $_SESSION['room'];
                                                            ?>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                                <div class="reservation-content">
                                                    <ul>
                                                        <li><span>Number of Nights:</span></li>
                                                        <li>??????</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div class="reservation-content">
                                                    <ul>
                                                        <li><span>Chosen Amenities:</span></li>
                                                        <li>
                                                            <?php
                                                                echo "WiFi : " . $_SESSION['hasWifi'] . "<br>";
                                                            ?>
                                                        </li>
                                                        <li>
                                                            <?php
                                                                echo "Breakfast : " . $_SESSION['hasBreakfest'] . "<br>";
                                                            ?>
                                                        </li>
                                                        <li>
                                                            <?php
                                                                echo "Parking : " . $_SESSION['hasParking'];
                                                            ?>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div class="reservation-content text-center mt-4">
                                                    <ul>
                                                        <li><span>Total Price:</span></li>
                                                        <li>$???.??</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="submit-btns text-center">
                                            <button type="button">Cancel</button>
                                            <button type="button">Submit</button>
                                        </div>
                                        <div class="earn-points-text">
                                            <p>Earn 150 Provisio points per night </p>
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

    <script src="js/jquery-3.3.1.min.js" type="text/javascript"></script>
    <script src="js/popper.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script src="js/rome.js" type="text/javascript"></script>
    <script src="js/main.js" type="text/javascript"></script>
</body>

</html>