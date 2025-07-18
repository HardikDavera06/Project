-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2025 at 12:23 PM
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
-- Database: `_empadmin`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `cu_name` varchar(100) NOT NULL,
  `cu_email` varchar(100) NOT NULL,
  `cu_number` int(15) NOT NULL,
  `admin` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `cu_name`, `cu_email`, `cu_number`, `admin`) VALUES
(1, 'snkdf', 'mndf@mnsdf', 1122334455, 'h3'),
(2, 'nsmkdfj', 'admf@mdnf.kc', 1122334455, 'h3'),
(3, 'nsmkdfj', 'admf@mdnf.kc', 1122334455, 'h3'),
(4, 'asnjbms', 'mns@nbsh', 1122334455, 'h3'),
(5, 'mnsbd', 'jsafv@ksb', 1111111111, 'h3');

-- --------------------------------------------------------

--
-- Table structure for table `_admin_regi`
--

CREATE TABLE `_admin_regi` (
  `id` int(11) NOT NULL,
  `name` varchar(110) NOT NULL,
  `password` varchar(255) NOT NULL,
  `Jdate` date DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `package` int(10) NOT NULL,
  `contact` int(15) NOT NULL,
  `email` varchar(150) NOT NULL,
  `dep` varchar(50) NOT NULL,
  `designation` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `_admin_regi`
--

INSERT INTO `_admin_regi` (`id`, `name`, `password`, `Jdate`, `dob`, `package`, `contact`, `email`, `dep`, `designation`) VALUES
(2, 'superadmin', '$2y$10$i8T1O8LmOIv7hmZz579hROpzjgcBtVJPuPXXW5nv6noXB//5LWSuy', NULL, NULL, 0, 1111111111, 'daverahardik5@gmailcom', '', 'superadmin'),
(4, 'first22', '1000000000', '2001-11-11', '2002-12-11', 1111111111, 0, 'jshfh@nbzdjf.comq', 'Administration', 'Admin'),
(5, 'sdsdsd', '11111111', '2001-11-11', '2002-12-22', 1111111111, 1111111111, '111@sfsfs', 'Administration', 'Admin'),
(6, 'firstSecond', '11111111', '2002-11-11', '2001-11-22', 1111111111, 1111111111, 'lsnfdj@kldf', 'Administration', 'Admin'),
(7, 'second', '11111111', '2001-11-22', '2003-11-22', 1111111111, 1111111111, 'jhbsf@kjf', 'Administration', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `_emp_regi`
--

CREATE TABLE `_emp_regi` (
  `id` int(11) NOT NULL,
  `Ename` varchar(150) NOT NULL,
  `contact` int(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `DOB` date DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `Jdate` date NOT NULL,
  `dep` varchar(100) NOT NULL,
  `package` int(10) NOT NULL,
  `admin` varchar(150) NOT NULL,
  `designation` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `_emp_regi`
--

INSERT INTO `_emp_regi` (`id`, `Ename`, `contact`, `email`, `DOB`, `password`, `Jdate`, `dep`, `package`, `admin`, `designation`) VALUES
(16, 'first10', 11111111, '1111111111111111@ksdnjb', '3001-11-11', '1111111110', '2001-11-11', 'Sales', 1111111111, 'superadmin', 'head');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_admin_regi`
--
ALTER TABLE `_admin_regi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_emp_regi`
--
ALTER TABLE `_emp_regi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `_admin_regi`
--
ALTER TABLE `_admin_regi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `_emp_regi`
--
ALTER TABLE `_emp_regi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
