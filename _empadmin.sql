-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2025 at 03:24 AM
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
  `created_by` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `contact` varchar(15) NOT NULL,
  `email` varchar(150) NOT NULL,
  `dep` varchar(50) NOT NULL,
  `designation` varchar(20) NOT NULL,
  `created_by` varchar(40) DEFAULT NULL,
  `updated_by` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `_admin_regi`
--

INSERT INTO `_admin_regi` (`id`, `name`, `password`, `Jdate`, `dob`, `package`, `contact`, `email`, `dep`, `designation`, `created_by`, `updated_by`) VALUES
(2, 'superadmin', '$2y$10$i8T1O8LmOIv7hmZz579hROpzjgcBtVJPuPXXW5nv6noXB//5LWSuy', '2025-10-01', '2006-10-01', 1111111110, '1111011111', 'second@gmail.com', 'Administration', 'superadmin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `_emp_regi`
--

CREATE TABLE `_emp_regi` (
  `id` int(11) NOT NULL,
  `Ename` varchar(150) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `DOB` date DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `Jdate` date NOT NULL,
  `dep` varchar(100) NOT NULL,
  `package` int(10) NOT NULL,
  `created_by` varchar(40) DEFAULT NULL,
  `updated_by` varchar(40) DEFAULT NULL,
  `designation` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `_leave_application`
--

CREATE TABLE `_leave_application` (
  `leave_id` int(11) NOT NULL,
  `applicant` varchar(100) NOT NULL,
  `designation` varchar(40) DEFAULT NULL,
  `department` varchar(40) DEFAULT NULL,
  `leave_type` varchar(100) NOT NULL,
  `reason` varchar(300) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `status` varchar(50) DEFAULT '0' COMMENT '1:accepted , 0:pending , 2:rejected',
  `accepted_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(121) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indexes for table `_leave_application`
--
ALTER TABLE `_leave_application`
  ADD PRIMARY KEY (`leave_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `_admin_regi`
--
ALTER TABLE `_admin_regi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `_emp_regi`
--
ALTER TABLE `_emp_regi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `_leave_application`
--
ALTER TABLE `_leave_application`
  MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
