<!-- 
Nicholas Werner, James Bailey, Larissa Passamani Lima
CSD 460 - Red Team
 -->
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php

$dbConnection = null;

$dbhost = "localhost";
$dbuser = "serverUser";
$dbpass = "Redt3am";
$dbname = "provisio";

/*
Create a reservation inside the reservations table
@param $userID
@param $hotelID
@param $roomID
@param $checkIn - in format YYYY-MM-dd
@param $checkOut - in format YYYY-MM-dd
@param $numGuests - int
@param $hasPaidWifi - 0 or 1
@param $hasPaidParking - 0 or 1
@param $hasPaidBreakfast - 0 or 1
@param $reservTotal - double
@return reservationID - reservation was created successfully
false - reservation creation failed
*/
function addReservation($userID, $hotelID, $roomID, $checkIn, $checkOut, $numGuests, $hasPaidWifi, $hasPaidParking, $hasPaidBreakfast, $reservTotal): string|bool
{
    global $dbConnection;
    if ($dbConnection == null) {
        if (connectDB() == false) {
            return false;
        }
    }

    $insertStmt = "INSERT INTO `provisio`.`reservations` 
            (userID, hotelID , roomID, checkIn, checkOut, numGuests,
            hasPaidWifi, hasPaidParking, hasPaidBreakfast, reservTotal)
            VALUES ('$userID', '$hotelID', '$roomID', '$checkIn',
            '$checkOut', '$numGuests', '$hasPaidWifi', '$hasPaidParking',
            '$hasPaidBreakfast', '$reservTotal'
            );";

    $result = mysqli_query($dbConnection, $insertStmt);
    if ($result == false) {
        return false;
    }

    return $dbConnection->insert_id;
}

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
    $query = "select * from users where email = '$user' limit 1";
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
Unsets all hotel reservation variables if they exist or not
*/
function closeSessionVars()
{
    unset($_SESSION['hotel']);
    unset($_SESSION['room']);
    unset($_SESSION['checkIn']);
    unset($_SESSION['checkOut']);
    unset($_SESSION['numGuests']);
    unset($_SESSION['hasParking']);
    unset($_SESSION['hasBreakfest']);
    unset($_SESSION['hasWifi']);
    unset($_SESSION['reservTotal']);
    unset($_SESSION['isLocked']);
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

/*
Create a user inside of the users table
@param $pass - pre-hashed password
@param $fname - user's first name
@param $lname - user's last name
@param $email - user's email address
return true - user was created correctly
errorString - reason user creation failed to show end user
*/
function createUser($pass, $fname, $lname, $email): string
{
    global $dbConnection;
    if ($dbConnection == null) {
        if (connectDB() == false) {
            return "Unable to create account, try again later";
        }
    }
    $dupUserCheck = mysqli_fetch_assoc(mysqli_query($dbConnection, "select COUNT(*) from users where email = '$email';"))['COUNT(*)'];
    if ($dupUserCheck > 0) {
        return "Email is taken, try another one!";
    } else {
        $insertStmt = "INSERT INTO users (password,email,firstName,lastName,proPoints) VALUES ('$pass','$email','$fname','$lname',0)";
        $result = mysqli_query($dbConnection, $insertStmt);
        if ($result == false) {
            return "Unable to create account, try again later";
        }
        return "";
    }
}

/*
Returns all hotels in the hotel table
@return false if an error occurs
mysqli_result containing all records
*/
function getAllHotels(): bool|mysqli_result
{
    global $dbConnection;
    if ($dbConnection == null) {
        if (connectDB() == false) {
            return false;
        }
    }
    $query = "select * from hotel";
    $result = mysqli_query($dbConnection, $query);
    if ($result) {
        if ($result && mysqli_num_rows($result) > 0) {
            return $result;
        }
    }
    return false;
}

/*
Returns all rooms in the room table
@return false if an error occurs
mysqli_result containing all records
*/
function getAllRooms(): bool|mysqli_result
{
    global $dbConnection;
    if ($dbConnection == null) {
        if (connectDB() == false) {
            return false;
        }
    }
    $query = "select * from room";
    $result = mysqli_query($dbConnection, $query);
    if ($result) {
        if ($result && mysqli_num_rows($result) > 0) {
            return $result;
        }
    }
    return false;
}

/*
returns all attractions based on the hotelID passed to the function
@param hotelID - Hotel ID for attraction look up
@return array - Attractions returned in database key format
false - no records found or an error occured looking them up
*/
function getAttractionsByHotelID($hotelID): bool|mysqli_result
{
    global $dbConnection;
    if ($dbConnection == null) {
        if (connectDB() == false) {
            return false;
        }
    }
    $query = "select * from attractions where hotelID =" . $hotelID . " ;";
    $result = mysqli_query($dbConnection, $query);
    if ($result) {
        if ($result && mysqli_num_rows($result) > 0) {
            return $result;
        }
    }
    return false;
}

/*
return the global demand rate percent
@return the global demand rate modifier
*/
function getDemandRate(): string|bool
{
    global $dbConnection;
    if ($dbConnection == null) {
        if (connectDB() == false) {
            return false;
        }
    }
    $query = "select * from globalVariables where var = 'demandRate' limit 1;";
    $result = mysqli_query($dbConnection, $query);
    if ($result) {
        if ($result && mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result)['val'];
        }
    }
    return false;
}

/*
return the holiday demand rate percent
@return the holiday demand rate
*/
function getHolidayRate(): string|bool
{
    global $dbConnection;
    if ($dbConnection == null) {
        if (connectDB() == false) {
            return false;
        }
    }
    $query = "select * from globalVariables where var = 'holidayRate' limit 1;";
    $result = mysqli_query($dbConnection, $query);
    if ($result) {
        if ($result && mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result)['val'];
        }
    }
    return false;
}

/*
returns the array conatining the array keys of a hotel based on the hotels name
@param $name the name of a hotel to search
@return the array of the passed hotel
false - info not found
*/
function getHotelInfo(string $name): bool|array
{
    global $dbConnection;
    if ($dbConnection == null) {
        if (connectDB() == false) {
            return false;
        }
    }
    $query = "select * from hotel where hotelName = '$name' limit 1;";
    $result = mysqli_query($dbConnection, $query);
    if ($result) {
        if ($result && mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        }
    }
    return false;
}

/*
returns the array conatining the array keys of a hotel based on the hotels id
@param $id the id of a hotel to search
@return the array of the passed hotel
false - info not found
*/
function getHotelInfowithID(int $id): bool|array
{
    global $dbConnection;
    if ($dbConnection == null) {
        if (connectDB() == false) {
            return false;
        }
    }
    $query = "select * from hotel where hotelID = " . $id . " limit 1;";
    $result = mysqli_query($dbConnection, $query);
    if ($result) {
        if ($result && mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        }
    }
    return false;
}

/*
returns array of reservation information 
@param $searchtext - search with reservationnumber
@param $userid - userid
@return array - properties of reservation
false - unable to retrieve
*/
function getReservation($searchtext, $userid): bool|mysqli_result
{
    global $dbConnection;
    if ($dbConnection == null) {
        if (connectDB() == false) {
            return false;
        }
    }
    if ($searchtext != '')
        $query = "select * from reservations where userID = " . $userid . " and  reservationID=" . $searchtext . " limit 1";
    else
        $query = "select * from reservations where userID = " . $userid . "";

    $result = mysqli_query($dbConnection, $query);

    if ($result) {
        if ($result && mysqli_num_rows($result) > 0) {
            return $result;
        }
    }
    return false;
}

/*
returns the array conatining the array keys of a room based on the room type
@param $name the type of room to search
@return the array of the passed room
false - info not found
*/
function getRoomInfo($name): bool|array
{
    global $dbConnection;
    if ($dbConnection == null) {
        if (connectDB() == false) {
            return false;
        }
    }
    $query = "select * from room where roomType = '$name' limit 1;";
    $result = mysqli_query($dbConnection, $query);
    if ($result) {
        if ($result && mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        }
    }
    return false;
}

/*
returns the array conatining the array keys of a room based on the rooms id
@param $id the id of a room to search
@return the array of the passed room
false - info not found
*/
function getRoomInfowithID($roomId): bool|array
{
    global $dbConnection;
    if ($dbConnection == null) {
        if (connectDB() == false) {
            return false;
        }
    }
    $query = "select * from room where roomID =" . $roomId . " limit 1;";
    $result = mysqli_query($dbConnection, $query);
    if ($result) {
        if ($result && mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        }
    }
    return false;
}

/*
returns array of user information using username
@param $username - username of user to return
@return array - properties of user
false - unable to retrieve
*/
function getUserInfo($username): bool|array
{
    global $dbConnection;
    if ($dbConnection == null) {
        if (connectDB() == false) {
            return false;
        }
    }
    $query = "select * from users where email = '$username' limit 1;";
    $result = mysqli_query($dbConnection, $query);
    if ($result) {
        if ($result && mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
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
    closeSessionVars();
    session_destroy();
}

/*
Updates a users propoints balance
@param $username - username of user record to update
@param $points - Points to update (use negative to subtract points)
@return true if points are updated
false if operation failed
*/
function updateProPoints($username, $points): bool
{
    global $dbConnection;
    if ($dbConnection == null) {
        if (connectDB() == false) {
            return false;
        }
    }
    $currentPoints = getUserInfo($username)["proPoints"];
    $newPoints = $currentPoints + $points;
    $query = "update users set proPoints = $newPoints where email = '$username'";
    $result = mysqli_query($dbConnection, $query);
    if ($result) {
        return true;
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
    $query = "select * from users where email = '$user' limit 1";
    $result = mysqli_query($dbConnection, $query);
    if ($result) {
        if ($result && mysqli_num_rows($result) > 0) {
            return true;
        }
    }
    return false;
}

?>