<?php

$dbConnection = null;

$dbhost = "localhost";
$dbuser = "serverUser";
$dbpass = "Redt3am";
$dbname = "provisio";

/*
Authenticate the user by validating the entry within the users table
@param $user - username of user
@param $pass - plain text password
@return true - user was authenticated correctly
false - user authentication failed 
*/
function authUser($user, $pass): bool
{
    global $dbConnection;
    if ($dbConnection == null) {
        if (connectDB() == false) {
            return false;
        }
    }
    $query = "select * from users where username = '$user' limit 1";
    $result = mysqli_query($dbConnection, $query);
    if ($result) {
        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            if (password_verify($pass, $user_data['password']) == true) {
                $_SESSION['username'] = $user;
                return true;
            }
        }
    }
    return false;
}

/*
Validate the username of an account exists in the database    
@param $username of the user to validate account
@return true if account exists in database
false if account does not exist
*/
function validateUser($user): bool
{
    global $dbConnection;
    if ($dbConnection == null) {
        if (connectDB() == false) {
            return false;
        }
    }
    $query = "select * from users where username = '$user' limit 1";
    $result = mysqli_query($dbConnection, $query);
    if ($result) {
        if ($result && mysqli_num_rows($result) > 0) {
            return true;
        }
    }
    return false;
}

/*
Calls the session destroy function to clear all session related data. Can be used if
another method is required to be ran after signing out the user. Can be removed if 
nothing else is added to this.
*/
function signOutUser()
{
    session_destroy();
}

/*
Create a user inside of the users table
@param $user - username of user
@param $pass - pre-hashed password
@param $fname - user's first name
@param $lname - user's last name
@param $email - user's email address
return true - user was created correctly
errorString - reason user creation failed to show end user
*/
function createUser($user, $pass, $fname, $lname, $email): string|bool
{
    global $dbConnection;
    if ($dbConnection == null) {
        if (connectDB() == false) {
            return "Unable to create account, try again later";
        }
    }
    $dupUserCheck = mysqli_query($dbConnection, "select * from users where username = '$user' limit 1");
    if ($dupUserCheck && mysqli_num_rows($dupUserCheck) > 0) {
        return "Username is taken, try another one!";
    }
    $insertStmt = "INSERT INTO users (username,password,email,firstName,lastName,proPoints) VALUES ('$user','$pass','$email','$fname','$lname',0)";
    $result = mysqli_query($dbConnection, $insertStmt);
    if ($result == false) {
        return "Unable to create account, try again later";
    }
    return true;
}

/*
global function to connect to the provisio database using global variables
@return true - connection is successful
false - unable to connect
*/
function connectDB(): bool
{
    global $dbhost, $dbuser, $dbpass, $dbname, $dbConnection;
    $dbConnection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    try {
    } catch (Exception $e) {
        return false;
    }
    if (mysqli_ping($dbConnection) == false) {
        $dbConnection = null;
        return false;
    }
    return true;
}

?>