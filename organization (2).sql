-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 10, 2026 at 04:51 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `organization`
--

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `project_id` int UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `name`, `user_id`) VALUES
(1, 'nnn', 1),
(2, 'nnn', 1),
(3, 'nnn', 1),
(4, 'nnn', 1),
(5, 'nnn', 1),
(6, 'nnn', 1),
(7, 'nnn', 1),
(8, 'nnn', 1),
(13, 'vv', 1),
(14, 'vv', 1),
(15, 'vv', 1),
(16, 'nnn', 1),
(17, 'nnn', 1),
(18, 'db', 1),
(19, 'db', 1),
(20, 'asd', 1),
(22, 'progg', 1),
(23, 'vdbk[oerk', 1),
(24, 'bmfodhmp', 1),
(25, 'defewkfp', 1),
(26, 'defewkfp', 1),
(27, 'vdsvsd', 1),
(28, 'kdfdkrp', 1),
(29, 'vefplkewf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` text,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `priority` enum('High','Medium','Low') NOT NULL DEFAULT 'Medium',
  `category` enum('Bug','Fix') NOT NULL,
  `status` enum('To Do','In Progress','Done') NOT NULL DEFAULT 'To Do',
  `is_archived` int NOT NULL DEFAULT '0',
  `project_id` int UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `description`, `start_date`, `end_date`, `priority`, `category`, `status`, `is_archived`, `project_id`, `created_at`) VALUES
(1, 'mhmy', 'vd', '2026-04-08', '2026-04-06', 'High', 'Fix', 'In Progress', 0, 8, '2026-04-30 23:31:05'),
(2, 'mohamed', 'egg', '2026-05-19', '2026-05-12', 'Low', 'Fix', 'In Progress', 1, 13, '2026-05-01 01:13:00'),
(3, 'mohamed', 'egg', '2026-05-19', '2026-05-12', 'Low', 'Fix', 'In Progress', 1, 14, '2026-05-01 01:14:29'),
(4, 'mohamed', 'egg', '2026-05-19', '2026-05-12', 'Low', 'Fix', 'In Progress', 1, 15, '2026-05-01 01:16:43'),
(5, 'mohamed', 'efwopf', '2026-04-30', '2026-05-06', 'Medium', 'Fix', 'In Progress', 1, 16, '2026-05-01 01:19:28'),
(6, 'mohamed', 'efwopf', '2026-04-30', '2026-05-06', 'Medium', 'Fix', 'In Progress', 1, 17, '2026-05-01 01:19:49'),
(7, 'erd', 'make erd', '2026-05-06', '2026-05-13', 'Low', 'Fix', 'To Do', 1, 18, '2026-05-02 22:12:50'),
(8, 'erd', 'make erd', '2026-05-06', '2026-05-13', 'High', 'Bug', 'To Do', 1, 19, '2026-05-03 01:31:31'),
(9, 'mhmy', 'kergred', '2026-06-02', '2026-05-25', 'Low', 'Bug', 'To Do', 0, 20, '2026-05-03 13:14:40'),
(10, 'js', 'vdmseso', '2026-05-25', '2026-05-13', 'Medium', 'Fix', 'Done', 1, 22, '2026-05-03 13:22:02'),
(11, 'bmfbo', 'vkdsove', '2026-05-27', '2026-05-18', 'Low', 'Bug', 'To Do', 0, 23, '2026-05-03 13:23:00'),
(12, 'vdkro[ge', 'ksegmwe', '2026-05-26', '2026-05-13', 'Low', 'Fix', 'To Do', 0, 24, '2026-05-03 13:23:35'),
(13, 'cmefle', 'fw[e]3', '2026-05-20', '2026-05-20', 'Low', 'Fix', 'In Progress', 0, 25, '2026-05-03 13:54:19'),
(14, 'cmefle', 'fw[e]3', '2026-05-20', '2026-05-20', 'Low', 'Fix', 'In Progress', 0, 26, '2026-05-03 13:57:10'),
(15, 'veefm', 'vegeww', '2026-05-26', '2026-05-19', 'High', 'Fix', 'Done', 0, 27, '2026-05-03 13:57:33'),
(16, 'psfew[f', 'dsegel,g', '2026-05-26', '2026-05-13', 'Medium', 'Bug', 'To Do', 0, 28, '2026-05-03 13:58:42'),
(17, 'e[lfewfw[', 'csdwefe', '2026-05-18', '2026-05-19', 'Medium', 'Fix', 'In Progress', 0, 29, '2026-05-03 13:59:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`) VALUES
(1, 'mm', 'mohand@gmail.com', '123455');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `fk_project_user` (`user_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_task_project` (`project_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `fk_project_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `fk_task_project` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
