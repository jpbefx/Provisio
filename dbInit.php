<!-- 
Nicholas Werner, James Bailey, Larissa Passamani Lima
CSD 460 - Red Team
 -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provisio Database Init</title>
</head>

<body>
    <header>
        Red Team: Database Initialization
    </header>
    <?php
    // Connect to MySQL server using root default user
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'provisio';

    $conn = new mysqli($host, $username, $password) or die("Unable to connect");
    if ($conn)
        echo "<br><br>YAY It has connected successfully<br>";

    $conn = mysqli_connect($host, $username, $password);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Create the provisio database
    $sql = "DROP DATABASE IF EXISTS `provisio`;
        CREATE DATABASE `provisio`;";

    if (mysqli_multi_query($conn, $sql)) {
        echo "Database created successfully<br>";
    } else {
        echo "Error creating database: " . mysqli_error($conn);
    }

    mysqli_next_result($conn);

    mysqli_select_db($conn, $database);

    // Create users table
    $sql = "CREATE TABLE `provisio`.`users` (
            `userID` int NOT NULL AUTO_INCREMENT,
            `username` varchar(30) NOT NULL,
            `password` varchar(200) NOT NULL,
            `email` varchar(50) NOT NULL,
            `firstName` varchar(30) NOT NULL,
            `lastName` varchar(30) NOT NULL,
            `proPoints` int NOT NULL,
            PRIMARY KEY (`userID`)
        )";

    if (mysqli_query($conn, $sql)) {
        echo "Users table created successfully<br>";
    } else {
        echo "Error creating table: " . mysqli_error($conn);
    }

    //Insert 2 default users
    $hashPass = password_hash('redTeamRocks', PASSWORD_DEFAULT);
    $sql = "INSERT INTO `provisio`.`users`
        (username,password,email,firstName,lastName,proPoints)
        VALUES ('admin','$hashPass','admin@provisio.com','Admin','Admin',999999)";

    if (mysqli_query($conn, $sql)) {
        echo "Admin account created successfully in users table<br>";
    } else {
        echo "Error creating user account: " . mysqli_error($conn);
    }

    $hashPass = password_hash('default', PASSWORD_DEFAULT);
    $sql = "INSERT INTO `provisio`.`users`
        (username,password,email,firstName,lastName,proPoints)
        VALUES ('default','$hashPass','Default@email.com','Default','Default',0)";

    if (mysqli_query($conn, $sql)) {
        echo "Default account created successfully in users table<br>";
    } else {
        echo "Error creating user account: " . mysqli_error($conn);
    }

    //Create hotel table
    $sql = "CREATE TABLE `provisio`.`hotel` (
    `hotelID` int NOT NULL AUTO_INCREMENT,
    `hotelName`	 VARCHAR(30) NOT NULL,
    `hotelAddress` VARCHAR(100),
    `hotelEmail` VARCHAR(50),
    `pictureAddress` VARCHAR(100),
    PRIMARY KEY (`hotelID`)
    );";

    if (mysqli_query($conn, $sql)) {
        echo "Hotel table created successfully<br>";
    } else {
        echo "Error creating table: " . mysqli_error($conn);
    }

    // Create room table
    $sql = "CREATE TABLE `provisio`.`room` (
    `roomID` int NOT NULL AUTO_INCREMENT,
    `hotelID` int NOT NULL,
    `roomType`	 VARCHAR(30) NOT NULL,
    `roomCost` int NOT NULL,
    PRIMARY KEY (`roomID`),
    FOREIGN KEY (hotelID) REFERENCES `provisio`.`hotel`(hotelID)
    );";

    if (mysqli_query($conn, $sql)) {
        echo "Room table created successfully<br>";
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
            PRIMARY KEY (`reservationID`),
            FOREIGN KEY (userID) REFERENCES `provisio`.`users`(userID),
            FOREIGN KEY (hotelID) REFERENCES `provisio`.`hotel`(hotelID),
            FOREIGN KEY (roomID) REFERENCES `provisio`.`room`(roomID)
        )";

    if (mysqli_query($conn, $sql)) {
        echo "Reservations table created successfully<br>";
    } else {
        echo "Error creating table: " . mysqli_error($conn);
    }

    // Create sysAdmin user
    $sql = "DROP USER IF EXISTS 'serverUser'@'localhost';";

    if (mysqli_multi_query($conn, $sql)) {
        echo "Drop user ran successfully<br>";
    } else {
        echo "Error creating users: " . mysqli_error($conn);
    }

    $sql = "CREATE USER 'serverUser'@'localhost' IDENTIFIED BY 'Redt3am';";

    if (mysqli_multi_query($conn, $sql)) {
        echo "Create user ran successfully<br>";
    } else {
        echo "Error creating users: " . mysqli_error($conn);
    }
    $sql = "GRANT ALL PRIVILEGES ON provisio.* TO 'serverUser'@'localhost';";

    if (mysqli_multi_query($conn, $sql)) {
        echo "Grant new user permissions ran successfully<br>";
    } else {
        echo "Error creating users: " . mysqli_error($conn);
    }

    $sql = "REVOKE all on `provisio`.* from root@localhost;";

    try {
        if (mysqli_multi_query($conn, $sql)) {
            echo "Revoke root permissions ran successfully<br>";
        } else {
            echo "Error creating users: " . mysqli_error($conn);
        }
    } catch (mysqli_sql_exception $e) {
        echo "Unable to revoke permissions; Not found or error caused.<br>";
    }

    $sql = "FLUSH PRIVILEGES;";

    if (mysqli_multi_query($conn, $sql)) {
        echo "Successfully flushed all permissions<br>";
    } else {
        echo "Error creating users: " . mysqli_error($conn);
    }

    // Close connection
    mysqli_close($conn);
    ?>

    <footer>
        <br><br>Bellevue University CSD 460 Red Team
    </footer>
</body>

</html>