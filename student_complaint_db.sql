-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2025 at 09:54 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_complaint_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminsee`
--

CREATE TABLE `adminsee` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(100) NOT NULL,
  `status` enum('Pending','Resolved','Rejected') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(100) NOT NULL,
  `status` enum('Pending','Resolved','Rejected') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `title`, `description`, `category`, `status`, `created_at`, `user_id`) VALUES
(5, 'Slow Wifi', 'Library Wifi is slow', 'student_services', 'Pending', '2025-05-02 14:19:52', NULL),
(6, 'More Buses needed', 'Need more Buses for Mohammadpur', 'facilities', 'Pending', '2025-05-02 14:55:42', NULL),
(8, 'Bring back BuX', 'It was helpful', 'academic', 'Pending', '2025-05-02 14:56:28', NULL),
(9, 'Cafe Food Quality', 'It needs improvement', 'others', 'Pending', '2025-05-02 14:56:55', NULL),
(12, 'We need more seats', 'More seats for important courses are needed.', 'academic', 'Pending', '2025-05-02 19:39:33', NULL),
(13, 'More seats needed', 'We need more seats in important courses.', 'academic', 'Pending', '2025-05-02 19:42:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_code` varchar(20) NOT NULL,
  `course_title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_code`, `course_title`) VALUES
(1, 'CSE110', 'Introduction to Programming'),
(2, 'CSE111', 'Structured Programming Language'),
(3, 'CSE220', 'Data Structures'),
(4, 'CSE230', 'Algorithms');

-- --------------------------------------------------------

--
-- Table structure for table `course_reviews`
--

CREATE TABLE `course_reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_code` varchar(20) NOT NULL,
  `course_title` varchar(255) DEFAULT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` >= 1 and `rating` <= 5),
  `comment` text DEFAULT NULL,
  `review_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_reviews`
--

INSERT INTO `course_reviews` (`id`, `user_id`, `course_code`, `course_title`, `rating`, `comment`, `review_date`) VALUES
(1, 1, 'CSE110', NULL, 4, 'Nice', '2025-05-02 17:51:33'),
(2, 1, 'CSE220', NULL, 3, 'Too hard!!!', '2025-05-02 19:17:24'),
(3, 1, 'CSE111', NULL, 3, 'It\'s okay', '2025-05-02 19:43:08');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `phone`) VALUES
(1, 'Atom Eve', 'zoye.amber@gmail.com', '$2y$10$U69BH8nAOCvl1Jyp5m.4Oep0YYoIeUyEPS4mKT6WqNGLvzli1.TVW', '2025-03-26 18:55:57', '01757467619'),
(2, 'Zoye Jahin', 'zoye.jahin@gmail.com', '$2y$10$5uA.xooG1FFeUL975Z3IPeGuJJcgkh9pOBAH/4Rs/.CWzI5Wf6PZO', '2025-03-26 20:13:59', '');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `complaint_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vote_type` enum('upvote','downvote') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `complaint_id`, `user_id`, `vote_type`) VALUES
(1, 1, 1, 'upvote'),
(2, 4, 1, 'downvote'),
(3, 3, 1, 'upvote'),
(4, 2, 1, 'upvote'),
(5, 5, 1, 'upvote'),
(6, 9, 1, 'upvote'),
(7, 8, 1, 'downvote'),
(8, 6, 1, 'upvote'),
(9, 11, 1, 'upvote'),
(10, 13, 1, 'upvote');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminsee`
--
ALTER TABLE `adminsee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_code` (`course_code`);

--
-- Indexes for table `course_reviews`
--
ALTER TABLE `course_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`course_code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `complaint_id` (`complaint_id`,`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminsee`
--
ALTER TABLE `adminsee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `course_reviews`
--
ALTER TABLE `course_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course_reviews`
--
ALTER TABLE `course_reviews`
  ADD CONSTRAINT `course_reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
