-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2024 at 07:29 AM
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
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `ScheduleID` int(11) NOT NULL,
  `Time` time NOT NULL,
  `StudentName` varchar(100) NOT NULL,
  `Location` varchar(255) NOT NULL,
  `TutorID` int(11) NOT NULL,
  `Date` date DEFAULT NULL,
  `DateTime` datetime NOT NULL DEFAULT current_timestamp(),
  `Status` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`ScheduleID`, `Time`, `StudentName`, `Location`, `TutorID`, `Date`, `DateTime`, `Status`) VALUES
(1, '16:38:38', 'Apurbo', 'Bahaddarhat', 1, '2024-06-21', '2024-06-21 16:38:38', 'Off'),
(2, '14:54:59', 'Arijit Saha', 'GEC, Chattogram', 1, '2024-06-21', '2024-06-21 14:54:59', 'Off'),
(3, '14:54:59', 'Rashfi', 'GEC', 2, '2024-06-21', '2024-06-21 14:54:59', 'Off'),
(4, '14:54:59', 'Lamia', 'CMC', 3, '2024-06-22', '2024-06-22 14:54:59', 'Off'),
(5, '11:30:00', 'Nabilah', 'Muradpur', 1, '2024-06-21', '2024-06-21 11:30:00', 'Off'),
(6, '18:00:00', 'Jabun', 'New Market', 4, '2024-06-21', '2024-06-21 18:00:00', 'Off'),
(7, '17:59:00', 'af', 'afa', 1, '2024-06-20', '2024-06-20 17:59:00', 'Off'),
(8, '18:19:00', 'Arijit', 'Enayet Bazar', 1, '2024-06-22', '2024-06-22 18:19:00', 'Off'),
(9, '00:23:00', 'Apurbo', 'Ashkar Dighir Par', 1, '2024-06-28', '2024-06-28 00:23:00', 'Off'),
(10, '18:30:00', 'Arijit', 'Enayet Bazar', 1, '2024-06-24', '2024-06-24 18:30:00', 'Off'),
(11, '20:50:00', 'Arijit', 'Enayet Bazar', 1, '2024-06-25', '2024-06-25 20:50:00', 'Off'),
(12, '18:45:00', 'Apurbo', 'Ashkar Dighir Par', 1, '2024-06-24', '2024-06-24 18:45:00', 'Off'),
(13, '10:45:00', 'Dip', 'Kotwali', 1, '2024-06-25', '2024-06-25 10:45:00', 'Off');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`ScheduleID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `ScheduleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
