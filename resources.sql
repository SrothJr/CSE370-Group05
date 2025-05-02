-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2025 at 03:17 PM
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
-- Database: `group5`
--

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `course_code` char(6) NOT NULL,
  `course_title` varchar(50) NOT NULL,
  `books` varchar(100) NOT NULL,
  `lectures` varchar(100) NOT NULL,
  `videos` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`course_code`, `course_title`, `books`, `lectures`, `videos`) VALUES
('CSE110', 'Programming Language I', 'drive.com/CSE110/books', 'drive.com/CSE110/lectures', 'drive.com/CSE110/videos'),
('CSE111', 'Programming Language II', 'drive.com/CSE111/books', 'drive.com/CSE111/lectures', 'drive.com/CSE111/lectures'),
('CSE220', 'Data Structures', 'drive.com/CSE220/books', 'drive.com/CSE220/lectures', 'drive.com/CSE220/videos'),
('CSE230', 'Discrete Mathematics', 'drive.com/CSE230/books', 'drive.com/CSE230/lectures', 'drive.com/CSE230/video');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD UNIQUE KEY `course_code` (`course_code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
