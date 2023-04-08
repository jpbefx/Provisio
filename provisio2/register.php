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
          <a class="nav-link" href="#">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Location</a>
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
        	<a href="#">Login</a>
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
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" id="username" aria-describedby="username">
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
                              <?php
                                require "php\databaseMgmt.php";
                                if(array_key_exists('createAccount', $_POST)) {
                                  createAccount();
                                }
                                function createAccount(){
                                  $hasError = false;
                                  if($_POST["username"] == ""){
                                    $hasError = true;
                                    echo "<br>Username is blank";
                                  }
                                  if($_POST["password"] == ""){
                                    $hasError = true;
                                    echo "<br>Password is blank";
                                  }
                                  if($_POST["firstName"] == ""){
                                    $hasError = true;
                                    echo "<br>First Name is blank";
                                  }
                                  if($_POST["lastName"] == ""){
                                    $hasError = true;
                                    echo "<br>Last Name is blank";
                                  }
                                  if($_POST["email"] == ""){
                                    $hasError = true;
                                    echo "<br>Email is blank";
                                  }
                                  if($hasError == false){
                                    $ret = createUser($_POST["username"],$_POST["password"],$_POST["email"],$_POST["firstName"],$_POST["lastName"]);
                                    if($ret == 0){
                                      echo "Success!!!!!!! Please login <a href='login.php'> Here </a>";
                                    } else {
                                      echo $ret;
                                    }
                                  }
                                }
                              ?>
                            </div>
                    </div>
                    <div class="mb-3 mt-3 form-check custom-form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Sign me up for marketing emails (Promise we won’t sell your info)</label>
                      </div>
                      <div class="create-account-btn text-center">
                        <button type="submit" name="createAccount" class="btn">Create Account</button>
                      </div>
                      </form>
                      <p>Copyright © 2023 - 2021 PROVISIO SHOP Operating Company, LLC. All Rights Reserved. The PROVISIO word mark is a registered trademark of PROVISIO Operating Company, LLC in the US and other countries.</p>   
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