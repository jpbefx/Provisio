<?php
session_start();

    include("connection.php");
    include("functions.php");

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        //something was posted
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];

        if(!empty($user_name) && !empty($password) && !is_numeric($user_name)){
            //save to database
            //random user id  ##NOT THE KEY ID##
            $user_id = random_num(20);
            //insert into the columns of the database in the order the tables are written. 
                //!!!!ORDER MATTERS!!!!!
            $query = "insert into users (user_id,user_name,password) values ('$user_id','$user_name','$password')";

            mysqli_query($con,$query);
            //Redirect user to login page
            header("Location: login.php");
            //Exit
            die;
        }else {
            echo "Please enter some valid information!";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
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
            <div style="font-size:large;font-weight: 900; margin: 10px;color:rgb(20, 58, 47)">Signup</div>

            <input id="text" type="text" name="user_name"><br><br>
            <input id="text" type="password" name="password"><br><br>

            <input id="button" type="submit" value="Signup"><br><br>

            <a href="login.php">Click To Login</a><br><br>
        </form>
    </div>
</body>
</html>