-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 03, 2023 at 10:24 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iips`
--

-- --------------------------------------------------------

--
-- Table structure for table `iips`
--

DROP TABLE IF EXISTS `iips`;
CREATE TABLE IF NOT EXISTS `iips` (
  `Application_ID` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(30) NOT NULL,
  `ClassRollNo` varchar(12) NOT NULL,
  `EnrollmentNo` varchar(10) NOT NULL,
  `CourseEnrolled` varchar(50) NOT NULL,
  `Fathers_Name` varchar(30) NOT NULL,
  `Mothers_Name` varchar(30) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `MobileNo` int NOT NULL,
  `AltNo` int NOT NULL,
  `PostalAddress` varchar(100) NOT NULL,
  `Pincode` int NOT NULL,
  `ReceiptNo` varchar(20) NOT NULL,
  `Date_Receipt` date NOT NULL,
  `Amount` int NOT NULL,
  `AccountNo` varchar(20) NOT NULL,
  `IFSC` varchar(20) NOT NULL,
  `Passbook` varchar(50) NOT NULL,
  `ReceiptFile` varchar(50) NOT NULL,
  `Fees_NoDues` varchar(3) NOT NULL,
  `Amount_Due` int NOT NULL,
  `Library_NoDues` varchar(3) NOT NULL,
  `Date_of_sub` date NOT NULL,
  `Time_of_sub` varchar(20) NOT NULL,
  `Amount_Refunded` varchar(3) NOT NULL,
  PRIMARY KEY (`Application_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
