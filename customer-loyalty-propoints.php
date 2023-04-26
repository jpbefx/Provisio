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
    <title>Provisio | Customer Loyalty Points page</title>
    <link rel="stylesheet" href="css/custom-style.css" type="text/css" />
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tiro+Bangla&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"
        integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        html,
        body {
            height: 100%;
        }

        .wrapper {
            min-height: calc(100% - 70px);
            position: relative;
        }

        .footer {
            height: 70px;
            width: 100%;
            bottom: 0;
            position: absolute;
        }
    </style>
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
    <div class="wrapper">
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
                                                            Reservation</a>
                                                    </li>
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
                                </div>
                            </div>
        </header>

        <section class="about-us-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="mtop-20rem">
                            <div class="loyalty-heading"> You have <span>0</span> ProPoints </div>
                            <div class="loyalty-wrapper">
                                <div class="loyalty-content-bg">
                                    <table class="table caption-top">
                                        <thead class="custom-table-dark">
                                            <tr>
                                                <th scope="col">Reservation ID</th>
                                                <th scope="col">Location</th>
                                                <th scope="col">Check In</th>
                                                <th scope="col">Check Out</th>
                                                <th scope="col">Points Earned</th>
                                                <th scope="col">Total Points </th>
                                            </tr>
                                        </thead>
                                        <tbody class="custom-table-body">
                                            <tr>
                                                <td>2678</td>
                                                <td>New York City</td>
                                                <td>Text</td>
                                                <td>Text</td>
                                                <td>Text</td>
                                                <td>Text</td>
                                            </tr>
                                            <!-- Additional rows of data can be added here -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
    </div>
    <footer class="mt-70 footer">
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