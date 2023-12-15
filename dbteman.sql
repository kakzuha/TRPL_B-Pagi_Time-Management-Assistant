-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2023 at 04:10 PM
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
-- Database: `teman_baru`
--

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `task_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name_task` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `priority` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `user_id`, `name_task`, `description`, `end_date`, `status`, `priority`) VALUES
(728, 22, 'sas', '', '2023-12-15 18:44:00', 'Not Started', 'High'),
(729, 24, 'aaaaaa', 'aaaa', '2023-12-14 19:13:00', 'On Progress', 'Medium'),
(730, 24, 'tes', '', '2023-12-15 19:25:00', 'Not Started', 'High'),
(731, 24, 'akunnn', '', '2023-12-15 21:59:00', 'Not Started', 'High');

-- --------------------------------------------------------

--
-- Stand-in structure for view `task_history_view`
-- (See below for the actual view)
--
CREATE TABLE `task_history_view` (
`task_id` int(11)
,`user_id` int(11)
,`user_name` varchar(255)
,`name_task` varchar(255)
,`priority` varchar(50)
,`end_date` datetime
,`status` varchar(50)
,`description` text
);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `email`, `password`, `profile_picture`) VALUES
(22, '1234', '1234@gmail.com', '74b87337454200d4d33f80c4663dc5e5', NULL),
(24, '1111', '1111@gmail.com', '5e8667a439c68f5145dd2fcbecf02209', NULL),
(25, '1111', '1111@gmail.com', '5e8667a439c68f5145dd2fcbecf02209', NULL);

-- --------------------------------------------------------

--
-- Structure for view `task_history_view`
--
DROP TABLE IF EXISTS `task_history_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `task_history_view`  AS SELECT `t`.`task_id` AS `task_id`, `t`.`user_id` AS `user_id`, `u`.`name` AS `user_name`, `t`.`name_task` AS `name_task`, `t`.`priority` AS `priority`, `t`.`end_date` AS `end_date`, `t`.`status` AS `status`, `t`.`description` AS `description` FROM (`task` `t` join `user` `u` on(`t`.`user_id` = `u`.`user_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=732;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
