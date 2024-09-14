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
-- Table structure for table `reminder`
--

CREATE TABLE `reminder` (
  `noteId` int(11) NOT NULL,
  `tutorId` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `Status` varchar(250) NOT NULL DEFAULT 'On'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reminder`
--

INSERT INTO `reminder` (`noteId`, `tutorId`, `description`, `Status`) VALUES
(1, 1, 'Making notes for Ayesha Rahman.', 'On'),
(2, 1, 'Taking test of Rahim Uddin.', 'On'),
(3, 2, 'Preparing science project for Karim Hossain.', 'On'),
(4, 3, 'Reviewing math homework for Nusrat Jahan.', 'On'),
(5, 4, 'Organizing English assignment for Taslima Begum.', 'On'),
(6, 4, 'Scheduling science quiz for Razia Sultana.', 'On'),
(7, 5, 'Planning history lesson for Farid Ahmed.', 'On'),
(8, 6, 'Checking English essay for Selina Akter.', 'On'),
(9, 7, 'Setting up math practice for Imran Khan.', 'On'),
(10, 8, 'Grading history exam for Jamil Chowdhury.', 'On'),
(11, 1, 'Take exam of Arijit', 'On'),
(12, 1, 'Important class tomorrow for Apurbo', 'On'),
(13, 1, 'Hello', 'Off'),
(14, 1, 'Nice', 'Off'),
(15, 1, 'Sorted?', 'Off'),
(16, 1, 'How', 'Off'),
(17, 1, 'Sorted?', 'Off'),
(18, 1, 'done?', 'Off');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reminder`
--
ALTER TABLE `reminder`
  ADD PRIMARY KEY (`noteId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
