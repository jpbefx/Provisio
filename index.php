<!-- 
Nicholas Werner, James Bailey, Larissa Passamani Lima
CSD 460 - Red Team
 -->
<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Provisio - Red Team -Landing Page</title>
  <link rel="stylesheet" href="css/custom-style.css" type="text/css" />
  <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Tiro+Bangla&display=swap" rel="stylesheet" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
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
  <header>
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <nav class="navbar navbar-expand-lg bg-white">
            <div class="container-fluid">
              <a class="navbar-brand nav-bar" href="index.php"><img class="img-fluid"
                  src="images/provisiologo.svg" /></a>
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
                        <li><a class="dropdown-item" href="hotel-reservation.php">Start a Reservation</a></li>
                        <li><a class="dropdown-item" href="manageReservation.php">Manage Reservations</a></li>
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

  <section class="mt-4">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="">
            <img class="img-fluid" src="images/banner-img.png" />
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="">
    <div class="first-section"></div>
    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-5">
          <div class="book-stay-img">
            <a href="#">Book your stay
              <img class="img-fluid" src="images/book-stay-img-new.png" />
            </a>
          </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-7">
          <div class="book-stay-text">
            <p>
              Use our search filters to find your perfect travel destination
              based on your preferred travel dates, location, and other
              preferences. Once you find what you're looking for, you can
              confidently proceed with the booking process and secure your
              travel arrangements.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="">
    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-7">
          <div class="manage-reservation-bg"></div>
          <div class="manage-reservation">
            <p>
              Our platform provides you with the flexibility to make changes
              to your travel plans at your convenience. Making it easier for
              you to stay on top of your itinerary and adapt to any unexpected
              changes in your schedule.
            </p>
          </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-5">
          <div class="manage-reservation-img">
            <a href="#">Manage your Reservation
              <img class="img-fluid" src="images/manage-reservation-img-new.png" />
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="">
    <div class="propoints-bg"></div>
    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-12 col-md-11 col-lg-5">
          <div class="book-stay-img">
            <a href="#">ProPoints
              <img class="img-fluid" src="images/propoints-img-new.png" />
            </a>
          </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-7">
          <div class="book-stay-text">
            <p>
              Our website allows you to easily view your ProPoints balance and
              redeem them towards your next hotel booking, giving you the
              flexibility to use your points towards your travel expenses.
            </p>
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