<?php
session_start();

include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST"){
    //something was posted
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(!empty($username) && !empty($password) && !is_numeric($username)){
        //read from database
        $query = "select * from users where username = '$username' limit 1";

        $result = mysqli_query($con,$query);
        if($result){

            if($result && mysqli_num_rows($result) > 0){
                $user_data = mysqli_fetch_assoc($result);
                
                if ($user_data['password'] === $password) {

                    $_SESSION['userID'] = $user_data['userID'];
                    header("Location: index.php");
                    die;

                }
            }
        }
    }else {
        echo "Wrong Username or Password!";
    }
}

?>



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
</head>
<body>
<header>
	<div class="container-fluid">
    	<div class="row">
        	<div class="col-12">
            	<nav class="navbar navbar-expand-lg bg-white">
  <div class="container-fluid">
    <a class="navbar-brand nav-bar" href="index.php"><img class="img-fluid" src="images/provisiologo.svg" /></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse navbar-nav-custom" id="navbarSupportedContent">
      <ul class="navbar-nav custom-nav">
	    <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link"  href="#">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link"  href="#">Location</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="register.php">Sign Up</a>
        </li>
        <!--<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>-->
        <div class="login-btn">
        	<a href="register.php">Register</a>
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
                	<div class="custom-form">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" aria-describedby="username">
                      </div>
                  <div class="custom-form">
                    <label for="InputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="InputPassword1">
                  </div>
                  <div class="create-account-btn mt-5 mb-61 text-center">
                    <!--<button type="submit" class="btn">Login</button>-->
                    <input id="button" type="submit" value="Login">
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
                    <button type="submit" class="btn"> Sign Up Here! </button>
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