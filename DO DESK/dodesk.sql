-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2024 at 11:17 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dodesk`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounttbl`
--

CREATE TABLE `accounttbl` (
  `userID` bigint(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `adminLevel` int(11) NOT NULL,
  `personID` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounttbl`
--

INSERT INTO `accounttbl` (`userID`, `email`, `password`, `adminLevel`, `personID`) VALUES
(1000101, 'martinDODESK@gmail.com', '12345678', 1, 1000101),
(1000102, 'garejoDODESK@gmail.com', '87654321', 1, 1000102),
(1000103, 'laurioDODESK@gmail.com', '12345678', 1, 1000103);

-- --------------------------------------------------------

--
-- Table structure for table `usertbl`
--

CREATE TABLE `usertbl` (
  `personID` bigint(20) NOT NULL,
  `firstName` varchar(99) NOT NULL,
  `lastName` varchar(99) NOT NULL,
  `middleName` varchar(99) DEFAULT NULL,
  `suffixName` varchar(50) DEFAULT NULL,
  `sex` varchar(10) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usertbl`
--

INSERT INTO `usertbl` (`personID`, `firstName`, `lastName`, `middleName`, `suffixName`, `sex`, `role`) VALUES
(1000101, 'James Caezar', 'Martin', 'Bayarcal', NULL, 'Male', 'Admin'),
(1000102, 'Gleenn Michael ', 'Garejo', 'Tomino', NULL, 'Male', 'Admin'),
(1000103, 'Eduardo', 'Laurio', NULL, NULL, 'Male', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounttbl`
--
ALTER TABLE `accounttbl`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `userTBL_pk-accountTBL_fk_personID` (`personID`);

--
-- Indexes for table `usertbl`
--
ALTER TABLE `usertbl`
  ADD PRIMARY KEY (`personID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounttbl`
--
ALTER TABLE `accounttbl`
  ADD CONSTRAINT `userTBL_pk-accountTBL_fk_personID` FOREIGN KEY (`personID`) REFERENCES `usertbl` (`personID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
