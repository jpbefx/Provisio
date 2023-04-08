<?php

function check_login($con){
    //check session value is set
    if(isset($_SESSION['userID'])){
        //check if userID is in database
        $id = $_SESSION['userID'];
        $query = "select * from users where userID = '$id' limit 1";
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

function random_num($length){

    $text = "";
    if($length < 5){
        $length = 5;
    }

    $len = rand(4,$length);

    for ($i=0; $i < $len; $i++) { 
        # code...
        $text .= rand(0,9);
    }
    return $text;
}

?>