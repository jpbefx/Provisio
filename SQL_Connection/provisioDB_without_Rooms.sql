/*
    James Bailey CSD-460 mod4
*/


-- drop if exists, else create new table 'provisio'
/*
DROP DATABASE IF EXISTS `provisio`;
CREATE DATABASE `provisio`;

--user creation and permissions--
DROP USER IF EXISTS `reserv_mgmt`@`localhost`;
DROP USER IF EXISTS `sysAdmin`@`localhost`;

CREATE USER `reserv_mgmt`@`localhost` IDENTIFIED WITH mysql_native_password BY 'admin';
GRANT ALL PRIVILEGES ON `provisio`.* TO `reserv_mgmt`@`localhost`;

CREATE USER `sysAdmin`@`localhost` IDENTIFIED WITH mysql_native_password BY 'admin';
GRANT ALL PRIVILEGES ON `provisio`.* TO `sysAdmin`@`localhost`;
*/
/*
CREATE TABLE `provisio`.`users` (
    `userID` int NOT NULL AUTO_INCREMENT,
    `username` varchar(30) NOT NULL,
    `password` varchar(20) NOT NULL,
    `email` varchar(50) NOT NULL,
    `firstName` varchar(30) NOT NULL,
    `lastName` varchar(30) NOT NULL,
    `proPoints` int NOT NULL,
    PRIMARY KEY (`userID`),
    KEY `userID_key` (`userID`),
    CONSTRAINT `USERS_PASSWORD_CK` CHECK (LENGTH(`password`) >= 8)
);

CREATE TABLE `provisio`.`reservations` (
    `reservationID` int NOT NULL AUTO_INCREMENT,
    `userID` int NOT NULL,
    `hotelID` int NOT NULL,
    `roomID` int NOT NULL,
    `numGuests` int NOT NULL,
    `hasPaidWifi` boolean NOT NULL,
    `hasPaidParking` boolean NOT NULL,
    `hasPaidBreakfast` boolean NOT NULL,
    PRIMARY KEY (`reservationID`)
);
*/

CREATE TABLE `provisio`.`hotel` (
`hotelID` int NOT NULL AUTO_INCREMENT,
`hotelName`	 VARCHAR(30) NOT NULL,
`hotelAddress` VARCHAR(100),
`hotelEmail` VARCHAR(50),
`pictureAddress` VARCHAR(100),
PRIMARY KEY (`hotelID`)
);
