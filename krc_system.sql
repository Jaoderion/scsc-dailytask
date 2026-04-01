-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 01, 2026 at 01:07 PM
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
-- Database: `krc_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `accomplishments`
--

CREATE TABLE `accomplishments` (
  `id` int NOT NULL,
  `report_date` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `activity` text COLLATE utf8mb4_general_ci,
  `start_time` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `end_time` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `remarks` varchar(20) COLLATE utf8mb4_general_ci DEFAULT '-DONE',
  `username` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accomplishments`
--

INSERT INTO `accomplishments` (`id`, `report_date`, `activity`, `start_time`, `end_time`, `remarks`, `username`) VALUES
(13, '', '- Joined Fun Run', '08:00 AM', '05:00 PM', '-DONE', 'user'),
(14, '', '- Joined Wellness', '05:01 PM', '', '-DONE', 'user'),
(15, '', '- Joined Flag ceremony', '08:00 AM', '05:00 PM', '-DONE', 'admin'),
(16, '', '- Joined meeting', '05:01 PM', '', '-DONE', 'admin'),
(17, '', '', '08:00 AM', '05:00 PM', '-DONE', 'admin'),
(18, '', '', '08:00 AM', '05:00 PM', '-DONE', 'admin'),
(19, '', '', '08:00 AM', '05:00 PM', '-DONE', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `employee_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `employee_name`) VALUES
(1, 'admin', 'admin123', 'JEFFREY A. ODERIO'),
(2, 'user', 'user123', 'Jeff Abella');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accomplishments`
--
ALTER TABLE `accomplishments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accomplishments`
--
ALTER TABLE `accomplishments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
