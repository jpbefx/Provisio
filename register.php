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
  <title>Provisio | Register</title>
  <link rel="stylesheet" href="css/custom-style.css" type="text/css" />
  <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Tiro+Bangla&display=swap" rel="stylesheet">
  <?php
  //Global user check
  require("php/databaseMgmt.php");

  if (isset($_SESSION['username'])) {
    if (validateUser($_SESSION['username']) == false) {
      signOutUser();
    } else {
      header("Location: index.php");
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
                        <li><a class="dropdown-item" href="reservation-lookup.php">Manage Reservations</a></li>
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
  </header>

  <section>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2 col-md-12 col-sm-12 col-12">
          <div class="register">
            <div class="register-text">
              <h1>Register</h1>
              <p>Have an account already? Sign In <a href="login.php"> Here </a></p>
            </div>
            <div class="form-input">
              <form class="row g-3" method="post">
                <div class="col-md-6 custom-form">
                  <label for="inputfirstname" class="form-label">First Name</label>
                  <input type="text" name="firstName" class="form-control" placeholder="" aria-label="First name">
                </div>
                <div class="col-md-6 custom-form">
                  <label for="inputlastname" class="form-label">Last Name</label>
                  <input type="text" name="lastName" class="form-control" placeholder="" aria-label="Last name">
                </div>
                <div class="custom-form">
                  <label for="InputEmail1" class="form-label">Email address</label>
                  <input type="email" name="email" class="form-control" id="InputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="custom-form">
                  <label for="InputPassword1" class="form-label">Password</label>
                  <input type="password" name="password" class="form-control" id="InputPassword1">
                </div>
                <div class="response-text">
                  <ul>
                    <?php
                    // Create account functions
                    if (array_key_exists('createAccount', $_POST)) {
                      createAccount();
                    }
                    function createAccount()
                    {
                      $hasError = false;
                      if ($_POST["password"] == "") {
                        $hasError = true;
                        echo "<li>Password is blank</li>";
                      }
                      if (strlen($_POST["password"]) < 8) {
                        $hasError = true;
                        echo "<li>Password must be at least 8 characters</li>";
                      }
                      if (!preg_match('/[A-Z]/', $_POST["password"]) || !preg_match('/[a-z]/', $_POST["password"])) {
                        $hasError = true;
                        echo "<li>Password must contain at least one uppercase and one lowercase letter</li>";
                      }
                      if ($_POST["firstName"] == "") {
                        $hasError = true;
                        echo "<li>First Name is blank</li>";
                      }
                      if ($_POST["lastName"] == "") {
                        $hasError = true;
                        echo "<li>Last Name is blank</li>";
                      }
                      if ($_POST["email"] == "") {
                        $hasError = true;
                        echo "<li>Email is blank</li>";
                      }
                      if ($hasError == false) {
                        $ret = createUser(password_hash($_POST["password"], PASSWORD_DEFAULT), $_POST["firstName"], $_POST["lastName"], $_POST["email"]);
                        if ($ret == "") {
                          echo "<li>Account Created Successfully... Sign In <a href='login.php'> Here </a></li>";
                        } else {
                          echo $ret;
                        }
                      }
                    }
                    ?>
                  </ul>
                </div>
            </div>
            <div class="mb-3 mt-3 form-check custom-form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Sign me up for marketing emails (Promise we won’t sell
                your info)</label>
              <div class="response-text">Password must contain at least one uppercase and lowercase letter</div>
              <div class="response-text">Password length must be greater than 8 characters.</div>
            </div>
            <div class="create-account-btn text-center">
              <button type="submit" name="createAccount" class="btn">Create Account</button>
            </div>
            </form>
            <p>Copyright © 2023 - 2021 PROVISIO SHOP Operating Company, LLC. All Rights Reserved. The PROVISIO word mark
              is a registered trademark of PROVISIO Operating Company, LLC in the US and other countries.</p>
          </div>
        </div>
      </div>
    </div>
    <br><br><br><br>
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