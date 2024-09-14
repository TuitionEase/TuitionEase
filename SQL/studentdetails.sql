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
-- Table structure for table `studentdetails`
--

CREATE TABLE `studentdetails` (
  `studentid` int(11) NOT NULL,
  `tutorId` int(11) DEFAULT NULL,
  `student_name` varchar(50) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `class` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `subjects` varchar(100) DEFAULT NULL,
  `status` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studentdetails`
--

INSERT INTO `studentdetails` (`studentid`, `tutorId`, `student_name`, `phone_number`, `class`, `address`, `subjects`, `status`) VALUES
(1, 1, 'Arijit Saha', '0182737483', 'HSC 2nd Year', 'Enayet Bazar, Chattogram', 'Physics', 'Running'),
(2, 1, 'Rahim Uddin', '01712-234567', '6', '23 Banani Rd, Dhaka', 'Math, English', 'Running'),
(3, 1, 'Karim Hossain', '01713-345678', '7', '34 Dhanmondi, Dhaka', 'Science, History', 'Running'),
(4, 3, 'Nusrat Jahan', '01714-456789', '8', '45 Uttara, Dhaka', 'Math, Geography', 'Running'),
(5, 1, 'Taslima Begum', '01715-567890', '5', '56 Mirpur, Dhaka', 'English, Science', 'Canceled'),
(6, 4, 'Razia Sultana', '01716-678901', '6', '67 Mohammadpur, Dhaka', 'Math, Science', 'Running'),
(7, 4, 'Farid Ahmed', '01717-789012', '7', '78 Badda, Dhaka', 'History, Geography', 'Running'),
(8, 5, 'Selina Akter', '01718-890123', '8', '89 Gulshan 2, Dhaka', 'Math, English', 'Running'),
(9, 6, 'Imran Khan', '01719-901234', '9', '90 Bashundhara, Dhaka', 'Science, Math', 'Running'),
(10, 7, 'Jamil Chowdhury', '01710-012345', '10', '101 Tejgaon, Dhaka', 'History, English', 'Running'),
(11, 1, 'Apurbo Dhar', '01716133019', 'HSC 1st year', 'Ashkar Dighir Par', 'Physics, Math', 'Running'),
(12, 1, 'Dip Dhar', '01716133019', '10', 'Kotwali, Chittagong.', 'Physics, Math', 'Running'),
(13, 1, 'Sojib Bhattacharjee', '01716133019', '1', 'CUET', 'Bangla', 'Canceled');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `studentdetails`
--
ALTER TABLE `studentdetails`
  ADD PRIMARY KEY (`studentid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
