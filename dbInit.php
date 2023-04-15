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

    echo "<br>";

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

    echo "<br>";

    //Create hotel table
    $sql = "CREATE TABLE `provisio`.`hotel` (
            `hotelID` int NOT NULL AUTO_INCREMENT,
            `hotelName`	 VARCHAR(30) NOT NULL,
            `hotelAddress` VARCHAR(20),
            `hotelCity` VARCHAR(20),
            `hotelState` VARCHAR(2),
            `hotelZip` VARCHAR(5),
            `hotelEmail` VARCHAR(50),
            `hotelPhone` VARCHAR(20),
            `pictureAddress` VARCHAR(100),
            PRIMARY KEY (`hotelID`)
    );";

    if (mysqli_query($conn, $sql)) {
        echo "Hotel table created successfully<br>";
    } else {
        echo "Error creating table: " . mysqli_error($conn);
    }

    //Create all hotel locations
    $sql = "INSERT INTO `provisio`.`hotel`
        (hotelName,hotelAddress,hotelCity,hotelState,hotelZip,hotelEmail,hotelPhone,pictureAddress)
        VALUES ('New York City','123 Imaginary Street','New York','NY', '10001','info@provisiohotel-nyc.com','(555) 123-4567','images/location-newyork-img.png')";

    if (mysqli_query($conn, $sql)) {
        echo "Hotel New York added successfully<br>";
    } else {
        echo "Error adding record: " . mysqli_error($conn);
    }

    $sql = "INSERT INTO `provisio`.`hotel`
        (hotelName,hotelAddress,hotelCity,hotelState,hotelZip,hotelEmail,hotelPhone,pictureAddress)
        VALUES ('Las Vegas','1234 Mirage Lane','Las Vegas','NV', '89101','info@provisiohotelvegas.com','(555) 123-4568','images/location-lasvegas-img.png')";

    if (mysqli_query($conn, $sql)) {
        echo "Hotel Las Vegas added successfully<br>";
    } else {
        echo "Error adding record: " . mysqli_error($conn);
    }

    $sql = "INSERT INTO `provisio`.`hotel`
        (hotelName,hotelAddress,hotelCity,hotelState,hotelZip,hotelEmail,hotelPhone,pictureAddress)
        VALUES ('Honolulu','1234 Aloha Lane','Honolulu','HI', '96815','info@provisiohawaii.com','(555) 123-4569','images/location-honolulu-img.png')";

    if (mysqli_query($conn, $sql)) {
        echo "Hotel Honolulu added successfully<br>";
    } else {
        echo "Error adding record: " . mysqli_error($conn);
    }

    echo "<br>";

    // Create room table
    $sql = "CREATE TABLE `provisio`.`room` (
            `roomID` int NOT NULL AUTO_INCREMENT,
            `roomType` VARCHAR(30) NOT NULL,
            `roomCost` int NOT NULL,
            `pictureAddress` VARCHAR(100) NOT NULL,
            PRIMARY KEY (`roomID`)
    );";

    if (mysqli_query($conn, $sql)) {
        echo "Room table created successfully<br>";
    } else {
        echo "Error creating table: " . mysqli_error($conn);
    }

    // Creating all rooms
    $sql = "INSERT INTO `provisio`.`room`
        (roomType,roomCost,pictureAddress)
        VALUES ('Double Full Beds',110,'images/double-full-bed.png')";

    if (mysqli_query($conn, $sql)) {
        echo "Double Full Beds added successfully<br>";
    } else {
        echo "Error creating record: " . mysqli_error($conn);
    }

    $sql = "INSERT INTO `provisio`.`room`
    (roomType,roomCost,pictureAddress)
    VALUES ('Double Queen Beds',125,'images/double-queen-bed.png')";

    if (mysqli_query($conn, $sql)) {
        echo "Double Queen Beds added successfully<br>";
    } else {
        echo "Error creating record: " . mysqli_error($conn);
    }

    $sql = "INSERT INTO `provisio`.`room`
        (roomType,roomCost,pictureAddress)
        VALUES ('Queen Bed',150,'images/queen-bed.png')";

    if (mysqli_query($conn, $sql)) {
        echo "Queen Bed added successfully<br>";
    } else {
        echo "Error creating record: " . mysqli_error($conn);
    }

    $sql = "INSERT INTO `provisio`.`room`
        (roomType,roomCost,pictureAddress)
        VALUES ('King Bed',165,'images/king-bed.png')";

    if (mysqli_query($conn, $sql)) {
        echo "King Bed added successfully<br>";
    } else {
        echo "Error creating record: " . mysqli_error($conn);
    }

    echo "<br>";

    // Create reservations table
    $sql = "CREATE TABLE `provisio`.`reservations` (
            `reservationID` int NOT NULL AUTO_INCREMENT,
            `userID` int NOT NULL,
            `hotelID` int NOT NULL,
            `roomID` int NOT NULL,
            `checkIn` date NOT NULL,
            `checkOut` date NOT NULL,
            `numGuests` int NOT NULL,
            `hasPaidWifi` boolean NOT NULL,
            `hasPaidParking` boolean NOT NULL,
            `hasPaidBreakfast` boolean NOT NULL,
            `reservTotal` double NOT NULL,
            PRIMARY KEY (reservationID),
            FOREIGN KEY (userID) REFERENCES provisio.users(userID),
            FOREIGN KEY (hotelID) REFERENCES provisio.hotel(hotelID),
            FOREIGN KEY (roomID) REFERENCES provisio.room(roomID)
    )";

    if (mysqli_query($conn, $sql)) {
        echo "Reservations table created successfully<br>";
    } else {
        echo "Error creating table: " . mysqli_error($conn);
    }

    echo "<br>";


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