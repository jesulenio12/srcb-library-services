-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2024 at 01:54 AM
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
-- Table structure for table `bookimages`
--

CREATE TABLE `bookimages` (
  `id` int(10) NOT NULL,
  `bookImageTitle` varchar(255) NOT NULL,
  `bookImage` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `bookImageSection` varchar(255) NOT NULL,
  `bookImageLibClass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookimages`
--

INSERT INTO `bookimages` (`id`, `bookImageTitle`, `bookImage`, `bookImageSection`, `bookImageLibClass`) VALUES
(11, 'General Chemistry 2', 'GeneralChemistry2_65e3ebbe0e19b.png', 'General Reference', 'College Library'),
(12, 'Foundations of Education II', 'FoundationsofEducationII_65e3ebd7cd0a8.jpg', 'Education', 'College Library'),
(14, 'Introduction to FoxPro', 'IntroductiontoFoxPro_65e3fcc53f8b9.jpg', 'Information Technology', 'College Library'),
(15, 'Management Information Systems', 'ManagementInformationSystems_65e3fce8d3f0e.jpg', 'Information Technology', 'College Library'),
(16, 'Principles of Financial Accounting', 'PrinciplesofFinancialAccounting_65e3fd37600b9.jpg', 'Accounting', 'College Library'),
(17, 'Teaching Music in Elementary Schools', 'TeachingMusicinElementarySchools_65e3fda92ce33.jpg', 'Education', 'College Library');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookimages`
--
ALTER TABLE `bookimages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookimages`
--
ALTER TABLE `bookimages`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
