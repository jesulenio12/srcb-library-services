-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2024 at 01:55 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lib-system`
--

-- --------------------------------------------------------

--
-- Table structure for table `indivqrcard`
--

CREATE TABLE `indivqrcard` (
  `id` int(11) NOT NULL DEFAULT 0,
  `permission` int(11) NOT NULL,
  `permissionRole` tinyint(1) NOT NULL,
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `library_userID` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `userType` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `firstname` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `lastname` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `gender` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `age` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `strtzone` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `yearLevel` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `classSection` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `progtrack` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `departmentType` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `contactNum` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `libraryClass` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `dateQRfilter` timestamp NOT NULL DEFAULT current_timestamp(),
  `timeQRfilter` timestamp NOT NULL DEFAULT current_timestamp(),
  `login_id` varchar(36) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `qrcode` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `current_session` int(11) DEFAULT NULL,
  `online` tinyint(1) DEFAULT NULL,
  `archive` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `indivqrcard`
--

INSERT INTO `indivqrcard` (`id`, `permission`, `permissionRole`, `username`, `password`, `library_userID`, `userType`, `firstname`, `lastname`, `gender`, `age`, `address`, `strtzone`, `yearLevel`, `classSection`, `progtrack`, `departmentType`, `email`, `contactNum`, `libraryClass`, `dateQRfilter`, `timeQRfilter`, `login_id`, `qrcode`, `avatar`, `current_session`, `online`, `archive`) VALUES
(9477, 5, 5, 'ID-C210079', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'ID-C210079', 'Student', 'Sofia', 'Olis', 'Female', '', '', '', 'Third Year', '', 'BSIT', 'Higher Education Department', '', '', 'College Library', '2023-10-13 07:23:30', '2023-10-13 07:23:30', '', 'ID-C210079-Sofia Olis(Third Year-BSIT).png', '', 0, 0, 0),
(8593, 5, 5, 'ID-C210003', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'ID-C210003', 'Student', 'Kaye Rashell', 'Monton', 'Female', '', '', '', 'Third Year', '', 'BSIT', 'Higher Education Department', '', '', 'College Library', '2023-10-13 07:22:36', '2023-10-13 07:22:36', '', 'ID-C210003-Kaye Rashell Monton(Third Year-BSIT).png', '', 0, 0, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
