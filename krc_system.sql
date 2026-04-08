-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2026 at 10:26 AM
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
-- Database: `krc_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `accomplishments`
--

CREATE TABLE `accomplishments` (
  `id` int(11) NOT NULL,
  `report_date` varchar(50) DEFAULT NULL,
  `activity` text DEFAULT NULL,
  `start_time` varchar(20) DEFAULT NULL,
  `end_time` varchar(20) DEFAULT NULL,
  `remarks` varchar(20) DEFAULT '-DONE',
  `username` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accomplishments`
--

INSERT INTO `accomplishments` (`id`, `report_date`, `activity`, `start_time`, `end_time`, `remarks`, `username`) VALUES
(15, '', '- Joined Flag ceremony', '08:00 AM', '05:00 PM', '-DONE', 'admin'),
(16, '', '- Joined meeting', '05:01 PM', '', '-DONE', 'admin'),
(17, '', '', '08:00 AM', '05:00 PM', '-DONE', 'admin'),
(18, '', '', '08:00 AM', '05:00 PM', '-DONE', 'admin'),
(19, '', '', '08:00 AM', '05:00 PM', '-DONE', 'admin'),
(364, 'Apr 01, 2026', 'Joined meeting ', '01:00 AM', '04:00 PM', '-DONE', 'user'),
(365, 'Apr 01, 2026', 'Flag ceremony ', '08:00 AM', '05:00 PM', '-DONE', 'user'),
(366, 'Apr 02, 2026', 'Joined meeting ', '01:00 AM', '04:00 PM', '-DONE', 'user'),
(367, 'Apr 02, 2026', 'Flag ceremony ', '08:00 AM', '05:00 PM', '-DONE', 'user'),
(368, 'Apr 03, 2026', 'Joined meeting ', '01:00 AM', '04:00 PM', '-DONE', 'user'),
(369, 'Apr 03, 2026', 'Flag ceremony ', '08:00 AM', '05:00 PM', '-DONE', 'user'),
(370, 'Apr 04, 2026', 'Joined meeting ', '01:00 AM', '04:00 PM', '-DONE', 'user'),
(371, 'Apr 04, 2026', 'Flag ceremony ', '08:00 AM', '05:00 PM', '-DONE', 'user'),
(372, 'Apr 05, 2026', 'Joined meeting ', '01:00 AM', '04:00 PM', '-DONE', 'user'),
(373, 'Apr 05, 2026', 'Flag ceremony ', '08:00 AM', '05:00 PM', '-DONE', 'user'),
(374, 'Apr 06, 2026', 'Joined meeting ', '01:00 AM', '04:00 PM', '-DONE', 'user'),
(375, 'Apr 06, 2026', 'Flag ceremony ', '08:00 AM', '05:00 PM', '-DONE', 'user'),
(376, 'Apr 07, 2026', 'Joined meeting ', '01:00 AM', '04:00 PM', '-DONE', 'user'),
(377, 'Apr 07, 2026', 'Flag ceremony ', '08:00 AM', '05:00 PM', '-DONE', 'user'),
(378, 'Apr 08, 2026', 'Joined meeting ', '01:00 AM', '04:00 PM', '-DONE', 'user'),
(379, 'Apr 08, 2026', 'Flag ceremony ', '08:00 AM', '05:00 PM', '-DONE', 'user'),
(380, 'Apr 09, 2026', 'Joined meeting ', '01:00 AM', '04:00 PM', '-DONE', 'user'),
(381, 'Apr 09, 2026', 'Flag ceremony ', '08:00 AM', '05:00 PM', '-DONE', 'user'),
(382, 'Apr 10, 2026', 'Joined meeting ', '01:00 AM', '04:00 PM', '-DONE', 'user'),
(383, 'Apr 10, 2026', 'Flag ceremony ', '08:00 AM', '05:00 PM', '-DONE', 'user'),
(384, 'Apr 11, 2026', 'Joined meeting ', '01:00 AM', '04:00 PM', '-DONE', 'user'),
(385, 'Apr 11, 2026', 'Flag ceremony ', '08:00 AM', '05:00 PM', '-DONE', 'user'),
(386, 'Apr 12, 2026', 'Joined meeting ', '01:00 AM', '04:00 PM', '-DONE', 'user'),
(387, 'Apr 12, 2026', 'Flag ceremony ', '08:00 AM', '05:00 PM', '-DONE', 'user'),
(388, 'Apr 13, 2026', 'Joined meeting ', '01:00 AM', '04:00 PM', '-DONE', 'user'),
(389, 'Apr 13, 2026', 'Flag ceremony ', '08:00 AM', '05:00 PM', '-DONE', 'user'),
(390, 'Apr 14, 2026', 'Joined meeting ', '01:00 AM', '04:00 PM', '-DONE', 'user'),
(391, 'Apr 14, 2026', 'Flag ceremony ', '08:00 AM', '05:00 PM', '-DONE', 'user'),
(392, 'Apr 15, 2026', 'Joined meeting ', '01:00 AM', '04:00 PM', '-DONE', 'user'),
(393, 'Apr 15, 2026', 'Flag ceremony ', '08:00 AM', '05:00 PM', '-DONE', 'user'),
(394, 'Apr 16, 2026', 'Joined meeting ', '01:00 AM', '04:00 PM', '-DONE', 'user'),
(395, 'Apr 16, 2026', 'Flag ceremony ', '08:00 AM', '05:00 PM', '-DONE', 'user'),
(396, 'Apr 17, 2026', 'Joined meeting ', '01:00 AM', '04:00 PM', '-DONE', 'user'),
(397, 'Apr 17, 2026', 'Flag ceremony ', '08:00 AM', '05:00 PM', '-DONE', 'user'),
(398, 'Apr 18, 2026', 'Joined meeting ', '01:00 AM', '04:00 PM', '-DONE', 'user'),
(399, 'Apr 18, 2026', 'Flag ceremony ', '08:00 AM', '05:00 PM', '-DONE', 'user'),
(400, 'Apr 19, 2026', 'Joined meeting ', '01:00 AM', '04:00 PM', '-DONE', 'user'),
(401, 'Apr 19, 2026', 'Flag ceremony ', '08:00 AM', '05:00 PM', '-DONE', 'user'),
(402, 'Apr 20, 2026', 'Joined meeting ', '01:00 AM', '04:00 PM', '-DONE', 'user'),
(403, 'Apr 20, 2026', 'Flag ceremony ', '08:00 AM', '05:00 PM', '-DONE', 'user'),
(404, 'Apr 21, 2026', 'Joined meeting ', '01:00 AM', '04:00 PM', '-DONE', 'user'),
(405, 'Apr 21, 2026', 'Flag ceremony ', '08:00 AM', '05:00 PM', '-DONE', 'user'),
(406, 'Apr 22, 2026', 'Joined meeting ', '01:00 AM', '04:00 PM', '-DONE', 'user'),
(407, 'Apr 22, 2026', 'Flag ceremony ', '08:00 AM', '05:00 PM', '-DONE', 'user'),
(408, 'Apr 23, 2026', 'Joined meeting ', '01:00 AM', '04:00 PM', '-DONE', 'user'),
(409, 'Apr 23, 2026', 'Flag ceremony ', '08:00 AM', '05:00 PM', '-DONE', 'user'),
(410, 'Apr 24, 2026', 'Joined meeting ', '01:00 AM', '04:00 PM', '-DONE', 'user'),
(411, 'Apr 24, 2026', 'Flag ceremony ', '08:00 AM', '05:00 PM', '-DONE', 'user'),
(412, 'Apr 25, 2026', 'Joined meeting ', '01:00 AM', '04:00 PM', '-DONE', 'user'),
(413, 'Apr 25, 2026', 'Flag ceremony ', '08:00 AM', '05:00 PM', '-DONE', 'user'),
(414, 'Apr 26, 2026', 'Joined meeting ', '01:00 AM', '04:00 PM', '-DONE', 'user'),
(415, 'Apr 26, 2026', 'Flag ceremony ', '08:00 AM', '05:00 PM', '-DONE', 'user'),
(418, 'Apr 01, 2026', '', '07:00 AM', '08:00 PM', '-DONE', 'james'),
(419, 'Apr 01, 2026', 'Joined Flag ceremony ', '08:00 AM', '05:00 PM', '-DONE', 'james'),
(466, 'Apr 08, 2026', 'Joined Flag Ceremony', '08:00 AM', '05:00 PM', '-DONE', 'jmax40'),
(467, 'Apr 08, 2026', 'Joined Meeting ', '08:00 AM', '05:00 PM', '-DONE', 'jmax40'),
(468, 'Apr 08, 2026', 'Assist student ', '08:00 AM', '05:00 PM', '-DONE', 'jmax40'),
(469, 'Apr 08, 2026', 'Assist student ', '08:00 AM', '05:00 PM', '-DONE', 'jmax40'),
(470, 'Apr 09, 2026', '', '08:00 AM', '05:00 PM', '-DONE', 'jmax40'),
(471, 'Apr 09, 2026', '', '08:00 AM', '05:00 PM', '-DONE', 'jmax40'),
(472, 'Apr 09, 2026', '', '08:00 AM', '05:00 PM', '-DONE', 'jmax40'),
(473, 'Apr 09, 2026', '', '08:00 AM', '05:00 PM', '-DONE', 'jmax40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `employee_name` varchar(100) DEFAULT NULL,
  `staff_name` varchar(100) DEFAULT NULL,
  `staff_position` varchar(100) DEFAULT NULL,
  `head_name` varchar(100) DEFAULT NULL,
  `head_title` varchar(100) DEFAULT NULL,
  `administrative_name` varchar(100) DEFAULT NULL,
  `administrative_title` varchar(100) DEFAULT NULL,
  `department` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `employee_name`, `staff_name`, `staff_position`, `head_name`, `head_title`, `administrative_name`, `administrative_title`, `department`) VALUES
(4, 'jmax40', '$2y$10$5001ySPGgGTGEuuZcFK4U.xEkjstDUws3fEyTwAsf86KTBeyO59hm', 'Jeffrey A. Oderio', 'JEFFREY A. ODERIO', 'COS', 'ALGEAN B. TAGLE, RL,MLIS', 'College Librarian III', 'ELEN G. AVILA, MAED, LPT', 'Administrative Officer V (HRMO III)', 'Knowledge Resource Center');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=474;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
