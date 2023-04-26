<!-- 
Nicholas Werner, James Bailey, Larissa Passamani Lima
CSD 460 - Red Team
 -->
<?php session_start();
//ini_set("display_errors", 1);
?>
<?php
//Global user check
require("php/databaseMgmt.php");
require("php/dateMgmt.php");

if (isset($_SESSION['username'])) {
  if (validateUser($_SESSION['username']) == false) {
    signOutUser();
  }
} else {
  header("Location: index.php");
}

//Need to add a check to make sure user doesnt navigate to this page on there own.
//IE Check if reservation session fields exist
//If these do not exist, kick user back to landing page.
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Provisio | Reservation Lookup page</title>
  <link rel="stylesheet" href="css/custom-style.css" type="text/css" />
  <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Tiro+Bangla&display=swap" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"
    integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
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
                      <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
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
                        <li><a class="dropdown-item" href="customer-loyalty-propoints.php">ProPoints</a></li>
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

    <div class="booking-text">
      <h2>My Bookings</h2>
      <div class="search-bar">

        <form method="post" action="">
          <ul>
            <li>Search by Reservation Number:</li>
            <li>
              <?php
              if (!isset($_REQUEST["search_reserveno"])) {
                $_REQUEST["search_reserveno"] = "";
              }
              ?>
              <input class="form-control" type="number" name="search_reserveno" required placeholder=""
                aria-label="default input" value=<?= $_REQUEST["search_reserveno"]; ?> />
            </li>
            <li><button name="searchbtn" type="submit" class="">Search</button></li>
          </ul>
        </form>
      </div>
      <div class="check-propoints">Check my Loyalty ProPoints Here</div>
    </div>
    </div>
    </div>
    </div>
  </header>

  <section class="location-bg">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <?php if (isset($_REQUEST["searchbtn"])) { ?>
            <?php
            getUserInfo($_SESSION['username'])['userID'];
            $results = getReservation($_REQUEST["search_reserveno"], getUserInfo($_SESSION['username'])['userID']);
            if ($results) {
              while ($row = mysqli_fetch_array($results)) {
                //print_r($row->reservationID);
          
                $hotel = getHotelInfowithID($row['hotelID']);

                $room = getRoomInfowithID($row['roomID']);

                ?>
                <div class="reservation-list mt-50 mb-61">
                  <div class="reservation-list-wrapper">
                    <div class="mb-61">
                      <div class="row">
                        <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                          <div class="hotel-heading">
                            <h2>
                              <?php echo $hotel["hotelName"]; ?> -
                              <?php echo $hotel["hotelCity"]; ?>
                            </h2>
                            <p>
                              <?php echo $hotel["hotelAddress"]; ?>
                              <?php echo $hotel["hotelCity"]; ?>,
                              <?php echo $hotel["hotelState"]; ?>
                              <?php echo $hotel["hotelZip"]; ?>
                            </p>
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                          <div class="reservation-id">Reservation #:
                            <?php echo $row["reservationID"]; ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="reservation-content">
                      <ul>
                        <li><span>Booking Dates:</span></li>
                        <li>Check in Date :
                          <?php echo $row["checkIn"]; ?>
                        </li>
                        <li>Check out Date :
                          <?php echo $row["checkOut"]; ?>
                        </li>
                      </ul>
                    </div>
                    <div class="row">
                      <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="reservation-content">
                          <ul>
                            <li><span>Number of guests:</span></li>
                            <li>
                              <?php echo $row["numGuests"]; ?>
                            </li>
                          </ul>
                        </div>
                      </div>
                      <div class="col-lg-8 col-md-6 col-sm-12 col-12">
                        <div class="reservation-content">
                          <ul>
                            <li><span>Room Type:</span></li>
                            <li>
                              <?php echo $room["roomType"]; ?>
                            </li>
                          </ul>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="reservation-content">
                          <ul>
                            <li><span>Number of Nights:</span></li>
                            <li>
                              <?php
                              $numNights = round((strtotime($row["checkOut"]) - strtotime($row['checkIn'])) / 86400);
                              echo $numNights;
                              ?>
                            </li>
                          </ul>
                        </div>
                      </div>
                      <div class="col-lg-9 col-md-6 col-sm-12 col-12">
                        <div class="reservation-content">
                          <ul>
                            <li><span>Chosen Amenities:</span></li>
                            <?php if ($row['hasPaidWifi']) { ?>
                              <li>WiFi</li>
                            <?php }
                            if ($row['hasPaidParking']) { ?>
                              <li>Breakfast</li>
                            <?php }
                            if ($row['hasPaidBreakfast']) { ?>
                              <li>Parking</li>
                            <?php } ?>
                          </ul>
                        </div>
                      </div>
                      <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                        <div class="reservation-content">
                          <ul>
                            <li><span>Total Price:</span></li>
                            <li>$
                              <?php echo $row["reservTotal"]; ?>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php }
            } else
              echo "<br/><h4 class='text-center' style='color:red'>No Results matching Reservation ID</h4>"; ?>
          <?php } ?>
          <div class="current-reservation-heading">
            Current / Past Reservations
          </div>
          <?php
          getUserInfo($_SESSION['username'])['userID'];
          $results = getReservation('', getUserInfo($_SESSION['username'])['userID']);

          while ($row = mysqli_fetch_array($results)) {
            //print_r($row->reservationID);
          
            $hotel = getHotelInfowithID($row['hotelID']);

            $room = getRoomInfowithID($row['roomID']);

            ?>
            <div class="reservation-list mb-61">
              <div class="reservation-list-wrapper">
                <div class="mb-61">
                  <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                      <div class="hotel-heading">
                        <h2>
                          <?php echo $hotel["hotelName"]; ?> -
                          <?php echo $hotel["hotelCity"]; ?>
                        </h2>
                        <p>
                          <?php echo $hotel["hotelAddress"]; ?>
                          <?php echo $hotel["hotelCity"]; ?>,
                          <?php echo $hotel["hotelState"]; ?>
                          <?php echo $hotel["hotelZip"]; ?>
                        </p>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                      <div class="reservation-id">Reservation #:
                        <?php echo $row["reservationID"]; ?>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="reservation-content">
                  <ul>
                    <li><span>Booking Dates:</span></li>
                    <li>Check in Date :
                      <?php echo $row["checkIn"]; ?>
                    </li>
                    <li>Check out Date :
                      <?php echo $row["checkOut"]; ?>
                    </li>
                  </ul>
                </div>
                <div class="row">
                  <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="reservation-content">
                      <ul>
                        <li><span>Number of guests:</span></li>
                        <li>
                          <?php echo $row["numGuests"]; ?>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-lg-8 col-md-6 col-sm-12 col-12">
                    <div class="reservation-content">
                      <ul>
                        <li><span>Room Type:</span></li>
                        <li>
                          <?php echo $room["roomType"]; ?>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="reservation-content">
                      <ul>
                        <li><span>Number of Nights:</span></li>
                        <li>
                          <?php
                          $numNights = round((strtotime($row["checkOut"]) - strtotime($row['checkIn'])) / 86400);
                          echo $numNights;
                          ?>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-lg-9 col-md-6 col-sm-12 col-12">
                    <div class="reservation-content">
                      <ul>
                        <li><span>Chosen Amenities:</span></li>
                        <?php if ($row['hasPaidWifi']) { ?>
                          <li>WiFi</li>
                        <?php }
                        if ($row['hasPaidParking']) { ?>
                          <li>Breakfast</li>
                        <?php }
                        if ($row['hasPaidBreakfast']) { ?>
                          <li>Parking</li>
                        <?php } ?>
                      </ul>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="reservation-content">
                      <ul>
                        <li><span>Total Price:</span></li>
                        <li>$
                          <?php echo $row["reservTotal"]; ?>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>

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
  <script src="js/bootstrap.min.js" type="text/javascript"></script>
  <!-- <script src="js/rome.js" type="text/javascript"></script>
    <script src="js/main.js" type="text/javascript"></script>-->
</body>

</html>