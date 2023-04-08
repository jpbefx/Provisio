<?php
session_start();

include("connection.php");
include("functions.php");

$notice = "";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    //something was posted
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if(!empty($user_name) && !empty($password) && !is_numeric($user_name)){
        //read from database
        $query = "select * from users where user_name = '$user_name' limit 1";

        $result = mysqli_query($con,$query);
        if($result){

            if($result && mysqli_num_rows($result) > 0){
                $user_data = mysqli_fetch_assoc($result);
                
                if ($user_data['password'] === $password) {

                    $_SESSION['user_id'] = $user_data['user_id'];
                    header("Location: index.php");
                    die;

                }
            }
        }
    }else {
        $notice = "<h3>"."Wrong Username or Password!"."</h3>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <style type="text/css">
        #text{
            height: 25px;
            border-radius: 5px;
            padding: 4px;
            border: solid thin #aaa;
            width: 100%;
        }
        #button{
            padding: 10;
            width: 100px;
            color: white;
            background-color: rgba(20, 58, 47, 100%);
            border: none;
        }
        #box{
            background-color: rgba(217, 217, 217, 100%);
            margin: auto;
            width: 300px;
            padding: 20px;
        }
    </style>

    <div id="box">

        <form method="post">
            <div style="font-size:large;font-weight: 900; margin: 10px;color:rgb(20, 58, 47)">Login</div>

            <input id="text" type="text" name="user_name">User name<br><br>
            <input id="text" type="password" name="password">Password<br><br>

            <input id="button" type="submit" value="Login"><br><br>

            <a href="signup.php">Click To Signup</a><br><br>
        </form>
        <?php
            echo($notice);
        ?>
    </div>
</body>
</html>