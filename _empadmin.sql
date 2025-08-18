-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2025 at 03:30 PM
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

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `cu_name`, `cu_email`, `cu_number`, `created_by`) VALUES
(7, 'hardik11', 'hardik@gmail.com', 2147483647, 'superadmin'),
(8, 'hardik11', 'dfdf@gmail.com', 1122334454, ''),
(9, 'hardik11', 'dfdf@gmail.com', 1122334454, 'fourth');

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
  `created_by` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `_admin_regi`
--

INSERT INTO `_admin_regi` (`id`, `name`, `password`, `Jdate`, `dob`, `package`, `contact`, `email`, `dep`, `designation`, `created_by`) VALUES
(2, 'superadmin', '$2y$10$i8T1O8LmOIv7hmZz579hROpzjgcBtVJPuPXXW5nv6noXB//5LWSuy', NULL, NULL, 0, '1111111111', 'daverahardik5@gmail.com', 'Administration', 'superadmin', NULL);

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
  `designation` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `_emp_regi`
--

INSERT INTO `_emp_regi` (`id`, `Ename`, `contact`, `email`, `DOB`, `password`, `Jdate`, `dep`, `package`, `created_by`, `designation`) VALUES
(29, 'sdsdsd', '1111111110', 'third2@gmail.com', '2006-02-22', '$2y$10$EAPNtLeRdTW23lqrobVYkOq/vHshFdDmJ9mrE6lIlTO3XqUlkmYq.', '2002-11-11', 'Sales', 1000000000, 'superadmin', 'head');

-- --------------------------------------------------------

--
-- Table structure for table `_leave_application`
--

CREATE TABLE `_leave_application` (
  `id` int(11) NOT NULL,
  `applicant` varchar(100) NOT NULL,
  `leave_type` varchar(100) NOT NULL,
  `reason` varchar(300) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `status` varchar(50) DEFAULT '0',
  `accepted_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `_leave_application`
--

INSERT INTO `_leave_application` (`id`, `applicant`, `leave_type`, `reason`, `from_date`, `to_date`, `status`, `accepted_by`) VALUES
(8, 'fourth', 'Sick Leave', 'snbdkfa', '2025-08-04', '2025-08-20', '0', ''),
(9, 'EMP_fourth', 'Casual Leave', 'jakhfjasg', '2025-08-21', '2025-08-21', '0', NULL),
(10, 'ADM_superadmin', 'Earned Leave', 'nsmf ', '2025-08-12', '2025-08-20', '0', NULL);

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
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `_admin_regi`
--
ALTER TABLE `_admin_regi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `_emp_regi`
--
ALTER TABLE `_emp_regi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `_leave_application`
--
ALTER TABLE `_leave_application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;


ALTER TABLE `_emp_regi` ADD `updated_by` VARCHAR(40) NULL DEFAULT NULL AFTER `created_by`;

ALTER TABLE `_admin_regi` ADD `updated_by` VARCHAR(40) NULL DEFAULT NULL AFTER `created_by`;

ALTER TABLE `_leave_application` ADD `designation` VARCHAR(40) NULL DEFAULT NULL AFTER `applicant`, ADD `department` VARCHAR(40) NULL DEFAULT NULL AFTER `designation`;

ALTER TABLE `_leave_application` CHANGE `status` `status` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0' COMMENT '1:accepted , 0:pending , 2:rejected';
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
