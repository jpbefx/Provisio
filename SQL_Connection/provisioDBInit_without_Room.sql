/*
Nicholas Werner
CSD 460 Provisio DB Init
*/

--drop and create database--
DROP DATABASE IF EXISTS 'provisio';
CREATE DATABASE 'provisio';

--user creation and permissions--
DROP USER IF EXISTS 'reserv_mgmt'@'localhost';
DROP USER IF EXISTS 'sysAdmin'@'localhost';

CREATE USER 'reserv_mgmt'@'localhost' IDENTIFIED WITH mysql_native_password BY 'admin';
GRANT ALL PRIVILEGES ON provisio.* TO 'reserv_mgmt'@'localhost';

CREATE USER 'sysAdmin'@'localhost' IDENTIFIED WITH mysql_native_password BY 'admin';
GRANT ALL PRIVILEGES ON provisio.* TO 'sysAdmin'@'localhost';

--table creation--
CREATE TABLE 'provisio'.'users' {
    'userID' int NOT NULL AUTO_INCREMENT,
    'username' varchar(30) NOT NULL,
    'password' varchar(20) NOT NULL,
    'email' varchar(50) NOT NULL,
    'firstName' varchar(30) NOT NULL,
    'lastName' varchar(30) NOT NULL,
    'proPoints' int NOT NULL,
    PRIMARY KEY 'userID',
    KEY 'userID_key' ('userID'),
    CONSTRAINT USERS_PASSWORD_CK CHECK (DATALENGTH(password) >= 8)
};

CREATE TABLE 'provisio'.'reservations' {
    'reservationID' int NOT NULL AUTO_INCREMENT,
    'userID' int NOT NULL,
    'hotelID' int NOT NULL,
    'roomID' int NOT NULL,
    'numGuests' int NOT NULL,
    'roomType' varchar(15) NOT NULL,
    'hasPaidWifi' boolean NOT NULL,
    'hasPaidParking' boolean NOT NULL,
    'hasPaidBreakfest' boolean NOT NULL,
    'checkInDate' date NOT NULL,
    'checkOutDate' date NOT NULL,
    'bookingDate' date NOT NULL,
    PRIMARY KEY 'reservationID',
    KEY 'reservationID_key' ('reservationID'),
    CONSTRAINT 'userID' FOREIGN KEY 'userID' REFERENCES 'users' ('userID'),
    CONSTRAINT 'hotelID' FOREIGN KEY 'hotelID' REFERENCES 'hotel' ('hotelID'),
    CONSTRAINT 'roomID' FOREIGN KEY 'roomID' REFERENCES 'room' ('roomID')
};

CREATE TABLE 'provisio'.'hotel' {
    'hotelID' int NOT NULL AUTO_INCREMENT,
    'hotelName' varchar(30) NOT NULL,
    'hotelAddress' varchar(100) NOT NULL,
    'hotelEmail' varchar(50) NOT NULL,
    'pictureAddress' varchar(100) NOT NULL,
    PRIMARY KEY 'hotelID',
    KEY 'hotelID_key' ('hotelID')
};

CREATE TABLE 'provisio'.'attractions'{
    'attractionID' int NOT NULL AUTO_INCREMENT,
    'hotelID' int NOT NULL,
    'attractionType' varchar(20) NOT NULL
    PRIMARY KEY 'attractionID',
    KEY 'attractionID_key' ('attractionID'),
    CONSTRAINT 'hotelID' FOREIGN KEY 'hotelID' REFERENCES 'hotel' ('hotelID')
};

-- Default values go below --