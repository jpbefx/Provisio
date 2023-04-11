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
  <title>Provisio | Login</title>
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
                    <a class="nav-link" href="#">About Us</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Location</a>
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
                        <li><a class="dropdown-item" href="#">Start a Reservation</a></li>
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

  <section class="mt-4">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="register-text">
            <h1>Sign In</h1>
          </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12 col-12">
          <div class="register">
            <div class="login-text-heading">
              <h2>Existing Members</h2>
            </div>
            <form method="post">
              <div class="custom-form">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" id="username" aria-describedby="username">
              </div>
              <div class="custom-form">
                <label for="InputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="InputPassword1">
              </div>
              <div class="custom-form1">
                <style>
                  section .custom-form1 {
                    text-align: start;
                    padding: 10px;
                    size: 40px;
                    font-size: larger;
                  }
                </style>
                <input type="checkbox" onclick="passControl()"> Show Password
                </input>
                <script>
                  function passControl() {
                    var x = document.getElementById("InputPassword1");
                    if (x.type === "password") {
                      x.type = "text";
                    } else {
                      x.type = "password";
                    }
                  }
                </script>
              </div>
              <div class="create-account-btn mt-5 mb-61 text-center">

                <?php
                // Log In Functions
                if (array_key_exists('loginButton', $_POST)) {
                  loginButton();
                }
                function loginButton()
                {
                  $hasError = false;
                  if ($_POST["username"] == "") {
                    $hasError = true;
                    echo "<br>username is blank";
                  }
                  if ($_POST["password"] == "") {
                    $hasError = true;
                    echo "<br>password is blank";
                  }
                  if ($hasError == false) {
                    if (authUser($_POST["username"], $_POST["password"]) == true) {
                      header("Location: index.php");
                    } else {
                      echo "Entered username or password is incorrect!";
                    }
                  }
                }
                ?>
                <br>
                <button type="submit" name="loginButton" class="btn">Submit</button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-12 col-sm-12 col-12">
        <div class="login-account-box">
          <div class="login-text-heading">
            <h2>Don’t Have An Account?</h2>
            <p>Joining is easy and the benefits are worth it!</p>
          </div>
          <div class="join-text">
            <ul>
              <li>Exclusive Deals sent stright to your inbox!</li>
              <li>Quick and Easy Search of our available suites</li>
              <li>Manage Past and Upcoming Reservations</li>
              <li>Earn ProPoints for each visit, Use points to save on your vacations!</li>
            </ul>
          </div>
          <div class="create-account-btn mt-5 text-center">
            <button type="submit" class="btn" onclick="window.location.href='register.php'"> Sign Up Here! </button>
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