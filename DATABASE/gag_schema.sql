-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 20, 2021 at 08:07 AM
-- Server version: 5.6.41-84.1
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myinv6dz_urdriver`
--
CREATE DATABASE IF NOT EXISTS `myinv6dz_urdriver` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `myinv6dz_urdriver`;

-- --------------------------------------------------------

--
-- Table structure for table `CabDetails`
--

DROP TABLE IF EXISTS `CabDetails`;
CREATE TABLE IF NOT EXISTS `CabDetails` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `CabBrand` text NOT NULL,
  `CabModel` text NOT NULL,
  `CabNumber` text NOT NULL,
  `CabImage` text NOT NULL,
  `CabSitting` int(2) NOT NULL,
  `CabDriver` text NOT NULL,
  `CabType` text NOT NULL,
  `CabLocation` text NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Driver`
--

DROP TABLE IF EXISTS `Driver`;
CREATE TABLE IF NOT EXISTS `Driver` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` text NOT NULL,
  `Email` text NOT NULL,
  `Phone` text NOT NULL,
  `Password` text NOT NULL,
  `driverImage` text NOT NULL,
  `AadharNumber` text NOT NULL,
  `AadharImage` text NOT NULL,
  `LicenseImage` text NOT NULL,
  `DriverStatus` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `LocalDatabase`
--

DROP TABLE IF EXISTS `LocalDatabase`;
CREATE TABLE IF NOT EXISTS `LocalDatabase` (
  `Phone` text NOT NULL,
  `UserDataOneWay` text NOT NULL,
  `CabOneWay` text NOT NULL,
  `UserDataRoundWay` text NOT NULL,
  `CabRoundWay` text NOT NULL,
  `NotificationDB` text NOT NULL,
  `DriverPhone` text,
  `MapStatus` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `OneWayBooking`
--

DROP TABLE IF EXISTS `OneWayBooking`;
CREATE TABLE IF NOT EXISTS `OneWayBooking` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `fullName` text NOT NULL,
  `phoneNumber` text NOT NULL,
  `email` text NOT NULL,
  `sourceAddress` text NOT NULL,
  `destinationAddress` text NOT NULL,
  `pickupDate` date NOT NULL,
  `pickupTime` time NOT NULL,
  `source` text NOT NULL,
  `destination` text NOT NULL,
  `Cabs` text NOT NULL,
  `BookAccount` text NOT NULL,
  `CabFare` text NOT NULL,
  `CabDriver` text NOT NULL,
  `CabStatus` int(1) NOT NULL,
  `CabModel` text NOT NULL,
  `CabTnxId` text NOT NULL,
  `RequestTime` datetime NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Rating`
--

DROP TABLE IF EXISTS `Rating`;
CREATE TABLE IF NOT EXISTS `Rating` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `CabDriver` text NOT NULL,
  `BookAccount` text NOT NULL,
  `Name` text NOT NULL,
  `Image` text NOT NULL,
  `Rating` text NOT NULL,
  `Review` text,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `RoundWayBooking`
--

DROP TABLE IF EXISTS `RoundWayBooking`;
CREATE TABLE IF NOT EXISTS `RoundWayBooking` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `fullName` text NOT NULL,
  `phoneNumber` text NOT NULL,
  `email` text NOT NULL,
  `sourceAddress` text NOT NULL,
  `destinationAddress` text NOT NULL,
  `pickupDate` date NOT NULL,
  `dropDate` date NOT NULL,
  `pickupTime` time NOT NULL,
  `source` text NOT NULL,
  `destination` text NOT NULL,
  `Cabs` text NOT NULL,
  `BookAccount` text NOT NULL,
  `CabFare` text NOT NULL,
  `CabDriver` text NOT NULL,
  `CabStatus` int(1) NOT NULL,
  `CabModel` text NOT NULL,
  `CabTnxId` text NOT NULL,
  `RequestTime` datetime NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Token`
--

DROP TABLE IF EXISTS `Token`;
CREATE TABLE IF NOT EXISTS `Token` (
  `phone` varchar(11) NOT NULL,
  `token` text NOT NULL,
  `isServerToken` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TripBooking`
--

DROP TABLE IF EXISTS `TripBooking`;
CREATE TABLE IF NOT EXISTS `TripBooking` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `fullName` text NOT NULL,
  `phoneNumber` text NOT NULL,
  `email` text NOT NULL,
  `sourceAddress` text NOT NULL,
  `destinationAddress` text NOT NULL,
  `pickupDate` date NOT NULL,
  `dropDate` date NOT NULL,
  `pickupTime` time NOT NULL,
  `source` text NOT NULL,
  `destination` text NOT NULL,
  `Cabs` text NOT NULL,
  `BookAccount` text NOT NULL,
  `CabFare` text NOT NULL,
  `CabDriver` text NOT NULL,
  `CabStatus` int(1) NOT NULL,
  `CabModel` text NOT NULL,
  `CabTnxId` text NOT NULL,
  `StartTrip` datetime NOT NULL,
  `DropTrip` datetime NOT NULL,
  `TripStatus` int(11) NOT NULL,
  `PickUpMeter` text NOT NULL,
  `DropMeter` text NOT NULL,
  `TripToll` text NOT NULL,
  `TripCode` int(11) NOT NULL,
  `NightStay` int(11) DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
CREATE TABLE IF NOT EXISTS `User` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` text NOT NULL,
  `Email` text NOT NULL,
  `userImage` text,
  `Phone` text NOT NULL,
  `Password` text NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
