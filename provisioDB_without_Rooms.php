<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provisio Module 4 Red Team Module 5 Assignment. SQL Database with 3 elements each minimum.</title>
</head>
<body>
    <header>
        Red Team: Module 5 Assignment: SQL Database
    </header>
    <?php
// Connect to MySQL server
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'provisio';
/*<?php
    $conn= new mysqli("localhost","root","","provisio") or die("Unable to connect");
    if($conn)
        echo "YAY It has connected successfully";
?>
*/
$conn = mysqli_connect($host, $username, $password);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create the provisio database
$sql = "DROP DATABASE IF EXISTS `provisio`;
        CREATE DATABASE `provisio`";

if (mysqli_multi_query($conn, $sql)) {
    echo "Database created successfully\n";
} else {
    echo "Error creating database: " . mysqli_error($conn);
}

mysqli_select_db($conn, $database);

// Create users table
$sql = "CREATE TABLE `provisio`.`users` (
            `userID` int NOT NULL AUTO_INCREMENT,
            `username` varchar(30) NOT NULL,
            `password` varchar(20) NOT NULL,
            `email` varchar(50) NOT NULL,
            `firstName` varchar(30) NOT NULL,
            `lastName` varchar(30) NOT NULL,
            `proPoints` int NOT NULL,
            PRIMARY KEY (`userID`),
            KEY `userID_key` (`userID`),
            CONSTRAINT USERS_PASSWORD_CK CHECK (DATALENGTH(password) >= 8)
        )";

if (mysqli_query($conn, $sql)) {
    echo "Users table created successfully\n";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

// Create reservations table
$sql = "CREATE TABLE `provisio`.`reservations` (
            `reservationID` int NOT NULL AUTO_INCREMENT,
            `userID` int NOT NULL,
            `hotelID` int NOT NULL,
            `roomID` int NOT NULL,
            `numGuests` int NOT NULL,
            `hasPaidWifi` boolean NOT NULL,
            `hasPaidParking` boolean NOT NULL,
            `hasPaidBreakfast` boolean NOT NULL,
            PRIMARY KEY (`reservationID`)
        )";

if (mysqli_query($conn, $sql)) {
    echo "Reservations table created successfully\n";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

// Create users and sysAdmin users
$sql = "DROP USER IF EXISTS 'reserv_mgmt'@'localhost';
        DROP USER IF EXISTS 'sysAdmin'@'localhost';
        CREATE USER 'reserv_mgmt'@'localhost' IDENTIFIED WITH mysql_native_password BY 'admin';
        CREATE USER 'sysAdmin'@'localhost' IDENTIFIED WITH mysql_native_password BY 'admin';
        GRANT ALL PRIVILEGES ON provisio.* TO 'reserv_mgmt'@'localhost';
        GRANT ALL PRIVILEGES ON provisio.* TO 'sysAdmin'@'localhost'";

if (mysqli_multi_query($conn, $sql)) {
    echo "Users created successfully\n";
} else {
    echo "Error creating users: " . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
?>

    <footer>
        Bellevue University Prof. Sue CSD-460 Module 5 Assignment.
    </footer>
</body>
</html>