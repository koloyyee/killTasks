-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2024 at 04:03 PM
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
-- Database: `killtasks`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_description`) VALUES
(1, 'Budgeting', 'financial budgeting'),
(2, 'Procurement', 'shopping for the team'),
(3, 'Meeting', 'team meetings');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `role_description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='the role of the user ';

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`, `role_description`) VALUES
(1, 'admin', 'highest privilege'),
(2, 'lead', 'team leader'),
(3, 'member', 'team basic member');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(50) NOT NULL,
  `status_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `status_name`, `status_description`) VALUES
(1, 'completed', 'task has been completed'),
(2, 'working', 'task is ongoing'),
(3, 'overdue', 'unfinished and passed due date.');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `task_id` int(11) NOT NULL,
  `task_name` varchar(255) DEFAULT NULL,
  `task_description` varchar(255) DEFAULT NULL,
  `user_email` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'working',
  `team` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `start_date` timestamp NULL DEFAULT NULL,
  `due_date` timestamp NULL DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `task_name`, `task_description`, `user_email`, `category`, `status`, `team`, `created_at`, `updated_at`, `start_date`, `due_date`, `deleted`) VALUES
(4, 'First Task', 'First task description', 'ko000029@algonquinlive.com', 'budget', 'working', 'accounting', '2024-03-30 02:59:48', '2024-04-03 19:14:32', '2024-04-22 23:14:09', '2024-04-29 23:14:09', 0),
(8, 'Hello', 'First task now Update', 'test@killtasks.com', 'review', 'working', 'marketing', '2024-04-03 13:01:45', '2024-04-04 14:59:11', '2024-04-15 04:00:00', '2024-04-09 04:00:00', 1),
(25, 'HEllo', 'world', 'test@killtasks.com', 'budget', 'completed', 'development', '2024-04-03 17:14:39', '2024-04-03 13:23:54', '2024-04-15 04:00:00', '2024-04-30 04:00:00', 0),
(26, 'HEllo', 'world', 'test@killtasks.com', 'budget', 'working', 'marketing', '2024-04-03 17:14:40', '2024-04-03 14:23:17', '2024-04-15 04:00:00', '2024-04-30 04:00:00', 1),
(27, 'obstart?', 'obflush?', 'test@killtasks.com', 'budget', 'completed', 'marketing', '2024-04-03 17:23:28', '2024-04-04 14:59:07', '2024-04-24 04:00:00', '2024-04-29 04:00:00', 0),
(28, 'complet', 'completed', 'test@killtasks.com', 'budget', 'completed', 'marketing', '2024-04-03 17:24:22', '2024-04-03 13:24:22', '2024-04-23 04:00:00', '2024-04-28 04:00:00', 0),
(29, 'HIJV', 'Hi Name!!!', 'test@killtasks.com', 'budget', 'working', 'research', '2024-04-03 19:32:26', '2024-04-04 16:15:42', '2024-04-10 04:00:00', '2024-04-22 04:00:00', 0),
(30, 'ko000029@algo.com', 'ko000029@algo.com', 'ko000029@algo.com', 'budget', 'working', 'marketing', '2024-04-04 13:36:37', '2024-04-04 09:36:37', '2024-04-16 04:00:00', '2024-04-28 04:00:00', 0),
(31, 'Paulo', 'Paulo', 'test@killtasks.com', 'review', 'completed', 'marketing', '2024-04-04 18:59:52', '2024-04-04 16:15:30', '2024-04-17 04:00:00', '2024-04-29 04:00:00', 0),
(32, 'sddddd', 'ddd', 'test@killtasks.com', 'budget', 'overdue', 'marketing', '2024-04-04 20:16:17', '2024-04-04 16:16:17', '2024-04-16 04:00:00', '2024-05-06 04:00:00', 0),
(33, 'test backend', 'test', 'test@killtasks.com', 'budget', 'working', 'marketing', '2024-04-04 21:13:27', '2024-04-04 17:13:27', '2024-04-03 04:00:00', '2024-05-09 04:00:00', 0),
(34, 'Admin task', 'Admin task Desc', 'admin@admin.com', 'budget', 'working', 'marketing', '2024-04-06 14:02:07', '2024-04-06 10:02:07', '2024-04-06 04:00:00', '2024-04-15 04:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `task_s`
--

CREATE TABLE `task_s` (
  `task_id` int(11) NOT NULL,
  `task_name` varchar(255) DEFAULT NULL,
  `task_description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `start_date` timestamp NULL DEFAULT NULL,
  `due_date` timestamp NULL DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `team_id` int(11) NOT NULL,
  `team_name` varchar(255) NOT NULL,
  `team_description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='A team contains 0 to many users';

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`team_id`, `team_name`, `team_description`) VALUES
(1, 'Accounting', 'everything about money'),
(2, 'Software Development', 'creating products'),
(3, 'Marketing', 'showing off products');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL COMMENT 'pk user_id',
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL COMMENT 'hash with password_hash()',
  `role` varchar(50) NOT NULL DEFAULT 'member',
  `team` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='general user of the application ';

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `email`, `password`, `role`, `team`) VALUES
(1, 'SEcond', 'user', 'test@killtasks.com', '$2y$10$WGJJkj3U.hOnUQhSyBtiBOhQa7Q64FyW1tDmHu./4OI6kAI26qq2.', '0', '0'),
(29, 'admin', 'admin', 'admin@admin.com', '$2y$10$KElZEtEzYfbbFHovz2Lb8OMTok1QXDd1JhumAc6kQOKTmJO5AeISK', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `user_s`
--

CREATE TABLE `user_s` (
  `user_id` int(11) NOT NULL COMMENT 'pk user_id',
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL COMMENT 'hash with password_hash()',
  `role_id` int(11) DEFAULT 3,
  `team_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='general user of the application ';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `task_s`
--
ALTER TABLE `task_s`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`team_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_s`
--
ALTER TABLE `user_s`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_role_id` (`role_id`),
  ADD KEY `fk_team_id` (`team_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `task_s`
--
ALTER TABLE `task_s`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'pk user_id', AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `user_s`
--
ALTER TABLE `user_s`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'pk user_id';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
