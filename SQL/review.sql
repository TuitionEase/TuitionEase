-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2024 at 07:28 AM
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
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `des` varchar(1000) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `dp` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `name`, `des`, `user_type`, `dp`) VALUES
(1, 'Jannatul Mawa', 'TuitionEase provides an excellent platform for tutors to connect with students. I\'ve been tutoring here for over a year, and the experience has been fantastic. The platform is user-friendly, the scheduling system is convenient, and the support team is always available to assist. Highly recommended for tutors looking for flexible and rewarding work!', 'Tutor', ''),
(2, 'Bikash Mallik', 'My daughter was struggling with her science homework, but thanks to TuitionEase, she\'s now much more confident in her abilities. The tutor was knowledgeable and supportive, and the online platform made it easy to schedule sessions. Great service!', 'Guardian', ''),
(3, 'Mili Roy', 'I\'ve been using TuitionEase for a few months now, and I\'m impressed with the quality of tutoring I\'ve received. The tutors are knowledgeable and easy to work with. The online platform is user-friendly and convenient. Overall, I\'m very satisfied with the service!', 'Guardian', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
