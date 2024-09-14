-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2024 at 07:27 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tuitionease`
--

-- --------------------------------------------------------

--
-- Table structure for table `guardianprofile`
--

CREATE TABLE `guardianprofile` (
  `GuardianID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(32) NOT NULL,
  `PhoneNumber` varchar(15) NOT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Gender` char(255) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `Status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guardianprofile`
--

INSERT INTO `guardianprofile` (`GuardianID`, `Name`, `Email`, `Password`, `PhoneNumber`, `Address`, `Gender`, `DOB`, `Status`) VALUES
(1, 'Rohim Miah', 'rm@gmail.com', '', '123456', 'CUET', 'Male', '1989-01-01', 'Accepted'),
(2, 'Sumaiya Rahman', 'sumaiya@gmail.com', '', '789012', 'GEC,Chittagong', 'Female', '1990-02-15', 'Accepted'),
(3, 'Farhana Islam', 'farhana@gmail.com', '', '901234', 'Muradpur,Chittagong', 'Female', '1992-07-30', 'Accepted'),
(4, 'Mohammad Ali', 'ali@gmail.com', '', '567890', 'Pahartoli,Chittagong', 'Male', '1988-03-10', 'Accepted'),
(5, 'Nusrat Jahan', 'nusrat@gmail.com', '', '234567', 'Chadgaon,Chittagong', 'Female', '1991-11-25', 'Accepted'),
(6, 'Ratnajit Dhar', 'rdpratnajit@gmail.com', 'nice2meetU', '01837603873', 'Feeringi Bazar, Chattogram', 'Male', '2002-10-16', 'Accepted'),
(7, 'Lucky Rani Dhar', 'lucky@gmail.com', 'abc', '01811804420', 'Kotwali, Chittagong.', 'Female', '2024-06-13', 'Rejected');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guardianprofile`
--
ALTER TABLE `guardianprofile`
  ADD PRIMARY KEY (`GuardianID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guardianprofile`
--
ALTER TABLE `guardianprofile`
  MODIFY `GuardianID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
