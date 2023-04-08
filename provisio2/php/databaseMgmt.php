<?php
    
    $dbConnection = null;

    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "provisio";
    
    function authUser($pass,$user) : bool  {
        global $dbConnection;
        if($dbConnection == null){
            if(connectDB() == false){
                die();
            }
        }
        $query = "select * from users where username = '$user' limit 1";
        $result = mysqli_query($dbConnection,$query);
        if($result){
            if($result && mysqli_num_rows($result) > 0){
                $user_data = mysqli_fetch_assoc($result);
                $stored_hash = $user_data['password'];
                /*$hashPass = password_hash($pass,PASSWORD_DEFAULT);*/
                //$hashPass = $pass;
                //if($hashPass === $user_data['password']){
                //if($user_data['username'] === $user & sha1($pass) === $stored_hash){
                    //$_session['username'] = $user;
                if(password_verify($pass,$stored_hash)) {
                    // set session variable to indicate user is logged in 
                    $_SESSION['user_id'] = $user_data['id']; 
                    
                    //$_session[$user] = $user_data['username'];
                    //grant access
                    return true;
                }
            }
        }
        //deny access
        return false;
    }

    /*
function check_login($con){
    //check session value is set
    if(isset($_SESSION['user_id'])){
        //check if user_id is in database
        $id = $_SESSION['user_id'];
        $query = "select * from users where user_id = '$id' limit 1";
        //read from database
        $result = mysqli_query($con,$query);
        // if the result is positive and number of rows greater than 0
        if($result && mysqli_num_rows($result) > 0){
            // collect user data from database
            $user_data = mysqli_fetch_assoc($result);
            // parse user_data
            return $user_data;
        }
    }
    //redirect to login
    header("Location: login.php");
    //exit 
    die;
}
    */

    
        
    function createUser($user,$pass,$fname,$lname,$email) : string {
        global $dbConnection;
        if($dbConnection == null){
            if(connectDB() == false){
                die();
            }
        }
        $dupUserCheck = mysqli_query($dbConnection,"select * from users where username = '$user' limit 1");
        if($dupUserCheck && mysqli_num_rows($dupUserCheck) > 0){
            return "Username is taken, try another one!";
        }
        if($pass < 8){
            return "Password needs to be atleast 8 characters";
        }
        $hashPass = password_hash($pass,PASSWORD_DEFAULT);
        //$hashPass = sha1($pass);
        //$hashPass = $pass;
        $insertStmt = "INSERT INTO users (username,password,email,firstName,lastName,proPoints) VALUES ('$user','$hashPass','$email','$fname','$lname',0)";
        $result = mysqli_query($dbConnection,$insertStmt);
        if($result == false){
            return "Unable to create account, try again later";
        }
        return 0;
    }
            
    function connectDB() : bool{
        global $dbhost,$dbuser,$dbpass,$dbname,$dbConnection;
        $dbConnection = mysqli_connect($dbhost,$dbuser, $dbpass,$dbname);
        if(mysqli_ping($dbConnection) == false){
            $dbConnection = null;
            return false;
        }
        return true;
    }

?>