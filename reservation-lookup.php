<!-- 
Nicholas Werner, James Bailey, Larissa Passamani Lima
CSD 460 - Red Team
 -->
<?php session_start(); ?>
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

    <div class="booking-text">
      <h2>My Bookings</h2>
      <div class="search-bar">
        <ul>
          <li>Search by Reservation Number:</li>
          <li>
            <input class="form-control" type="text" placeholder="" aria-label="default input" />
          </li>
          <li><button type="button" class="">Search</button></li>
        </ul>
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
          <div class="reservation-list mt-50 mb-61">
            <div class="reservation-list-wrapper">
              <div class="mb-61">
                <div class="row">
                  <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                    <div class="hotel-heading">
                      <h2>Provisio Hotel - New York City</h2>
                      <p>123 Imaginary Street, New York, NY 10001</p>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="reservation-id">Reservation #: 3675</div>
                  </div>
                </div>
              </div>
              <div class="reservation-content">
                <ul>
                  <li><span>Booking Dates:</span></li>
                  <li>Check in Date : 09/01/2023</li>
                  <li>Check out Date : 09/06/2023</li>
                </ul>
              </div>
              <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                  <div class="reservation-content">
                    <ul>
                      <li><span>Number of guests:</span></li>
                      <li>2</li>
                    </ul>
                  </div>
                </div>
                <div class="col-lg-8 col-md-6 col-sm-12 col-12">
                  <div class="reservation-content">
                    <ul>
                      <li><span>Room Type:</span></li>
                      <li>Double Queen Beds</li>
                    </ul>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                  <div class="reservation-content">
                    <ul>
                      <li><span>Number of Nights:</span></li>
                      <li>5</li>
                    </ul>
                  </div>
                </div>
                <div class="col-lg-9 col-md-6 col-sm-12 col-12">
                  <div class="reservation-content">
                    <ul>
                      <li><span>Chosen Amenities:</span></li>
                      <li>WiFi</li>
                      <li>Breakfast</li>
                      <li>Parking</li>
                    </ul>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                  <div class="reservation-content">
                    <ul>
                      <li><span>Total Price:</span></li>
                      <li>$784.85</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="current-reservation-heading">
            Current / Past Reservations
          </div>
          <div class="reservation-list mb-61">
            <div class="reservation-list-wrapper">
              <div class="mb-61">
                <div class="row">
                  <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                    <div class="hotel-heading">
                      <h2>Provisio Hotel - Las Vegas</h2>
                      <p>1234 Mirage Lane. Las Vegas, NV 89101</p>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="reservation-id">Reservation #: 1597</div>
                  </div>
                </div>
              </div>
              <div class="reservation-content">
                <ul>
                  <li><span>Booking Dates:</span></li>
                  <li>Check in Date : 09/01/2023</li>
                  <li>Check out Date : 09/06/2023</li>
                </ul>
              </div>
              <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                  <div class="reservation-content">
                    <ul>
                      <li><span>Number of guests:</span></li>
                      <li>2</li>
                    </ul>
                  </div>
                </div>
                <div class="col-lg-8 col-md-6 col-sm-12 col-12">
                  <div class="reservation-content">
                    <ul>
                      <li><span>Room Type:</span></li>
                      <li>Double Queen Beds</li>
                    </ul>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                  <div class="reservation-content">
                    <ul>
                      <li><span>Number of Nights:</span></li>
                      <li>5</li>
                    </ul>
                  </div>
                </div>
                <div class="col-lg-9 col-md-6 col-sm-12 col-12">
                  <div class="reservation-content">
                    <ul>
                      <li><span>Chosen Amenities:</span></li>
                      <li>WiFi</li>
                      <li>Breakfast</li>
                      <li>Parking</li>
                    </ul>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                  <div class="reservation-content">
                    <ul>
                      <li><span>Total Price:</span></li>
                      <li>$784.85</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="reservation-list mb-61">
            <div class="reservation-list-wrapper">
              <div class="mb-61">
                <div class="row">
                  <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                    <div class="hotel-heading">
                      <h2>Provisio Hotel - Hawaii</h2>
                      <p>1234 Aloha Lane, Honolulu, HI 96815</p>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="reservation-id">Reservation #: 2354</div>
                  </div>
                </div>
              </div>
              <div class="reservation-content">
                <ul>
                  <li><span>Booking Dates:</span></li>
                  <li>Check in Date : 09/01/2023</li>
                  <li>Check out Date : 09/06/2023</li>
                </ul>
              </div>
              <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                  <div class="reservation-content">
                    <ul>
                      <li><span>Number of guests:</span></li>
                      <li>2</li>
                    </ul>
                  </div>
                </div>
                <div class="col-lg-8 col-md-6 col-sm-12 col-12">
                  <div class="reservation-content">
                    <ul>
                      <li><span>Room Type:</span></li>
                      <li>Double Queen Beds</li>
                    </ul>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                  <div class="reservation-content">
                    <ul>
                      <li><span>Number of Nights:</span></li>
                      <li>5</li>
                    </ul>
                  </div>
                </div>
                <div class="col-lg-9 col-md-6 col-sm-12 col-12">
                  <div class="reservation-content">
                    <ul>
                      <li><span>Chosen Amenities:</span></li>
                      <li>WiFi</li>
                      <li>Breakfast</li>
                      <li>Parking</li>
                    </ul>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                  <div class="reservation-content">
                    <ul>
                      <li><span>Total Price:</span></li>
                      <li>$784.85</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="reservation-list">
            <div class="reservation-list-wrapper">
              <div class="mb-61">
                <div class="row">
                  <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                    <div class="hotel-heading">
                      <h2>Provisio Hotel - Hawaii</h2>
                      <p>1234 Aloha Lane, Honolulu, HI 96815</p>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="reservation-id">Reservation #: 2355</div>
                  </div>
                </div>
              </div>
              <div class="reservation-content">
                <ul>
                  <li><span>Booking Dates:</span></li>
                  <li>Check in Date : 09/01/2023</li>
                  <li>Check out Date : 09/06/2023</li>
                </ul>
              </div>
              <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                  <div class="reservation-content">
                    <ul>
                      <li><span>Number of guests:</span></li>
                      <li>2</li>
                    </ul>
                  </div>
                </div>
                <div class="col-lg-8 col-md-6 col-sm-12 col-12">
                  <div class="reservation-content">
                    <ul>
                      <li><span>Room Type:</span></li>
                      <li>Double Queen Beds</li>
                    </ul>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                  <div class="reservation-content">
                    <ul>
                      <li><span>Number of Nights:</span></li>
                      <li>5</li>
                    </ul>
                  </div>
                </div>
                <div class="col-lg-9 col-md-6 col-sm-12 col-12">
                  <div class="reservation-content">
                    <ul>
                      <li><span>Chosen Amenities:</span></li>
                      <li>WiFi</li>
                      <li>Breakfast</li>
                      <li>Parking</li>
                    </ul>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                  <div class="reservation-content">
                    <ul>
                      <li><span>Total Price:</span></li>
                      <li>$784.85</li>
                    </ul>
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

  <script src="js/jquery-3.3.1.min.js" type="text/javascript"></script>
  <script src="js/bootstrap.min.js" type="text/javascript"></script>
  <script src="js/rome.js" type="text/javascript"></script>
  <script src="js/main.js" type="text/javascript"></script>
</body>

</html>