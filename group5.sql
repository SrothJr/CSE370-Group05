-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2025 at 04:53 PM
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
(17, 'There is no service', 'service kothay?\r\n', 'student_services', 'Pending', '2025-05-08 22:56:21', 6);

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
(4, 'CSE230', 'Algorithms'),
(5, 'CSE221', 'Algorithms'),
(10, 'CSE470', 'Software Engineering'),
(11, 'CSE421', 'Computer Networks'),
(12, 'CSE423', 'Graphics Design');

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
(3, 1, 'CSE111', NULL, 3, 'It\'s okay', '2025-05-02 19:43:08'),
(5, 4, 'CSE110', NULL, 2, 'afa', '2025-05-08 20:20:24');

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

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `created_at`) VALUES
(4, 'How do I submit a complaint?', 'You can submit a complaint by clicking on the &#34;Create Complaints&#34; option in the sidebar and filling out the complaint form.', '2025-05-09 14:09:08'),
(5, 'Can I edit my complaint after submission?', 'No, currently, complaints cannot be edited after submission. Please make sure to review your complaint before submitting.', '2025-05-09 14:10:17'),
(6, 'How does the voting system work?', 'Users can upvote or downvote complaints. This helps in prioritizing issues that require urgent attention.', '2025-05-09 14:10:49'),
(7, 'Is my complaint anonymous?', 'No, complaints are linked to your student ID. However, your identity is only visible to the administrative staff.', '2025-05-09 14:11:34');

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
('CSE220', 'Data Structures', 'drive.com/CSE220/books', 'drive.com/CSE220/lectures', 'drive.com/CSE220/videos'),
('cse221', 'Algorithms', 'drive.com/CSE221/books', 'drive.com/CSE221/lectures', 'drive.com/CSE221/videos'),
('CSE230', 'Discrete Mathematics', 'drive.com/CSE230/books', 'drive.com/CSE230/lectures', 'drive.com/CSE230/video'),
('cse251', 'Electronic Devices and Circuits', 'drive.com/CSE251/books', 'drive.com/CSE251/lectures', 'drive.com/CSE251/videos');

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
  `phone` varchar(20) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `phone`, `admin`) VALUES
(1, 'Atom Eve', 'zoye.amber@gmail.com', '$2y$10$U69BH8nAOCvl1Jyp5m.4Oep0YYoIeUyEPS4mKT6WqNGLvzli1.TVW', '2025-03-26 18:55:57', '01757467619', 0),
(2, 'Zoye Jahin', 'zoye.jahin@gmail.com', '$2y$10$5uA.xooG1FFeUL975Z3IPeGuJJcgkh9pOBAH/4Rs/.CWzI5Wf6PZO', '2025-03-26 20:13:59', '', 0),
(4, 'Sroth', 'abc@xyz.com', '$2y$10$AGP647MzBf7Vs5tZJukhUuZtUwFynLdPMOCVOLrVAFYmKVc9JTguG', '2025-05-08 19:40:54', '', 1),
(5, 'user', 'user@xyz.com', '$2y$10$f0s9FKmlpKyZONEmldUiCOMummwsldjlyJY5m3MmzG8CpvQxzI4iK', '2025-05-08 21:16:28', '', 0),
(6, 'user2', 'user2@xyz.com', '$2y$10$zUXxD1cOye1d6./C919XYe/jn2X9hJG6iXH1fp6q5na6EBGUZmSRW', '2025-05-08 21:18:48', '', 0),
(7, 'admin', 'admin@xyz.com', '$2y$10$KJ4OKrUxCtbYPvQLIRiQZ.hhzT4mvappsZcMf2bkAR5kFz.zzSjtq', '2025-05-08 21:23:26', '', 1);

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
(10, 13, 1, 'upvote'),
(11, 9, 4, 'upvote'),
(12, 14, 5, 'downvote'),
(13, 17, 5, 'upvote'),
(14, 16, 5, 'downvote');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `course_reviews`
--
ALTER TABLE `course_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
