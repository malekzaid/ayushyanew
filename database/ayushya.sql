-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2023 at 03:06 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ayushya`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `doc_id` int(11) NOT NULL,
  `complaint` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `p_id`, `doc_id`, `complaint`, `created_at`, `updated_at`) VALUES
(3, 2, 3, 'XYZ', '2023-04-25 22:59:25', '2023-04-25 22:59:25'),
(4, 8, 3, 'Headache', '2023-04-27 21:24:25', '2023-04-27 21:24:25'),
(7, 9, 3, 'Fever', '2023-04-28 23:27:54', '2023-04-28 23:27:54'),
(8, 3, 3, 'None', '2023-04-28 23:51:00', '2023-04-28 23:51:00'),
(9, 3, 3, 'Headache', '2023-04-29 06:04:36', '2023-04-29 06:04:36');

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `id` int(11) NOT NULL,
  `ap_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_mode` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `examine`
--

CREATE TABLE `examine` (
  `id` int(11) NOT NULL,
  `ap_id` int(11) NOT NULL,
  `parameter` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `doc_finding` varchar(255) DEFAULT NULL,
  `advice` varchar(255) DEFAULT NULL,
  `follow_up_date` date DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `examine`
--

INSERT INTO `examine` (`id`, `ap_id`, `parameter`, `doc_finding`, `advice`, `follow_up_date`, `created_at`, `updated_at`) VALUES
(1, 4, 'a:3:{s:2:\"bp\";s:3:\"110\";s:6:\"height\";s:6:\"5ft4in\";s:6:\"weight\";s:2:\"70\";}', 'Over Weight', 'dolo', '2023-05-12', '2023-04-28 23:09:18', '2023-04-28 23:09:18'),
(2, 7, 'a:3:{s:2:\"bp\";s:3:\"110\";s:6:\"height\";s:0:\"\";s:6:\"weight\";s:0:\"\";}', 'Fever\r\nnone\r\naa\r\na', 'MSakasdsa', '0000-00-00', '2023-04-28 23:31:07', '2023-04-28 23:31:07'),
(3, 8, 'a:3:{s:2:\"bp\";s:3:\"100\";s:6:\"height\";s:6:\"5ft9in\";s:6:\"weight\";s:4:\"60kg\";}', 'Nothing\r\nthis', 'med1\r\nmed2', '0000-00-00', '2023-04-28 23:52:21', '2023-04-28 23:52:21'),
(4, 9, 'a:3:{s:2:\"bp\";s:3:\"121\";s:6:\"height\";s:0:\"\";s:6:\"weight\";s:0:\"\";}', '\r\n\r\n', '\r\n\r\n\r\n\r\n\r\n', '2023-05-13', '2023-04-29 06:16:54', '2023-04-29 06:16:54');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(20) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `gender` enum('M','F','O') NOT NULL,
  `dob` date DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `bloodgroup` varchar(10) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `name`, `email`, `address`, `city`, `phone`, `gender`, `dob`, `image`, `bloodgroup`, `created_at`, `updated_at`) VALUES
(1, 'Zaid Malek', 'zaid@gmail.com', NULL, 'Anand', '9898', 'M', '2023-04-18', NULL, 'A+', '2023-04-18 07:13:23', '2023-04-18 07:13:23'),
(2, 'zaid', '', NULL, 'anand', '', 'M', '2023-04-18', NULL, '', '2023-04-18 07:14:31', '2023-04-18 07:14:31'),
(3, 'zaid', '', NULL, '12', '', 'M', '2023-04-18', NULL, '', '2023-04-18 07:14:55', '2023-04-18 07:14:55'),
(8, 'Denish', '', NULL, 'Anand', '', 'M', '2023-04-27', NULL, '', '2023-04-27 21:24:25', '2023-04-27 21:24:25'),
(9, 'Zaid Malek', '', NULL, 'Anand', '', 'M', '0000-00-00', NULL, '', '2023-04-28 23:27:54', '2023-04-28 23:27:54'),
(10, 'John Doe', '', NULL, 'Nadiad', '', 'F', '0000-00-00', NULL, '', '2023-04-28 23:51:00', '2023-04-28 23:51:00');

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `id` int(11) NOT NULL,
  `ap_id` int(11) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`id`, `ap_id`, `status`) VALUES
(5, 7, '2'),
(6, 8, '2'),
(7, 9, '2');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(30) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `phone`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Zaid', 'zaid@gmail.com', '9898987878', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', '2023-04-01 15:06:58', '2023-04-01 15:06:58'),
(3, 'Doctor X', 'dr@mbbs.co', '9898776656', '827ccb0eea8a706c4c34a16891f84e7b', 'doctor', '2023-04-01 16:22:37', '2023-04-02 11:43:45'),
(4, 'Receptionist', 'aa@gmail.com', '9876543211', 'e10adc3949ba59abbe56e057f20f883e', 'receptionist', '2023-04-01 16:25:51', '2023-04-01 16:25:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_p_id` (`p_id`),
  ADD KEY `fk_doc_id` (`doc_id`);

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_appoin_id` (`ap_id`);

--
-- Indexes for table `examine`
--
ALTER TABLE `examine`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_app_id` (`ap_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ap_id` (`ap_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `examine`
--
ALTER TABLE `examine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `fk_doc_id` FOREIGN KEY (`doc_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_p_id` FOREIGN KEY (`p_id`) REFERENCES `patient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `fk_appoin_id` FOREIGN KEY (`ap_id`) REFERENCES `appointments` (`id`);

--
-- Constraints for table `examine`
--
ALTER TABLE `examine`
  ADD CONSTRAINT `fk_app_id` FOREIGN KEY (`ap_id`) REFERENCES `appointments` (`id`);

--
-- Constraints for table `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `fk_ap_id` FOREIGN KEY (`ap_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `event1` ON SCHEDULE EVERY 1 DAY STARTS '2023-04-27 23:00:00' ON COMPLETION NOT PRESERVE ENABLE DO TRUNCATE TABLE token$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
