-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2025 at 07:37 AM
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
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `_admin_regi`
--

INSERT INTO `_admin_regi` (`id`, `name`, `password`, `Jdate`, `dob`, `package`, `contact`, `email`, `dep`, `designation`, `created_by`, `updated_by`) VALUES
(2, 'superadmin', '$2y$10$i8T1O8LmOIv7hmZz579hROpzjgcBtVJPuPXXW5nv6noXB//5LWSuy', '2025-10-01', '2006-10-01', 1111111110, '1111011111', 'second@gmail.com', 'Administration', 'superadmin', NULL, NULL),
(50, 'third0', '$2y$10$mryiEcIg8cGCclRs872VEui5E/ZqQkXXyD8DpQDH9CXOtFJCAi4Ea', '2025-10-24', '2006-06-29', 1111111111, '9999999999', 'third10@gmail.com', 'Administration', 'Head', NULL, NULL),
(60, 'sdsdsd10', '$2y$10$ILAmLO2LcE4lEBcqL03CsuhrvGtVdErRyCuwoxAODGc4ETlMxuYJa', '2025-10-24', '2006-06-02', 1111111110, '1111111770', 'second20@gmailc.com', 'Administration', 'Head-A', NULL, NULL),
(67, 'first10', '$2y$10$unkFEbGeeZYkZHOcTR5rZebR7GefR7KxWmkpI.6OqyRM9IjFJc2OG', '2025-10-21', '2006-06-21', 1111111111, '1111111110', 'fist10@gmail.com', 'Administration', 'Head-c', 2, 2);

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
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `designation` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `_emp_regi`
--

INSERT INTO `_emp_regi` (`id`, `Ename`, `contact`, `email`, `DOB`, `password`, `Jdate`, `dep`, `package`, `created_by`, `updated_by`, `designation`) VALUES
(82, 'twelve1', '9991000000', 'twelve1@gmail.com', '2006-06-20', '$2y$10$MOaogXTo/dBohE/CKfHqMOK/gDBfIGnR0IPnpCGVphLneSr3p5Pl2', '2025-10-25', 'Marketing', 1111111111, 2, 2, 'Assistance-B'),
(83, 'third12', '5555478410', 'third@gmail.com', '2006-06-29', '$2y$10$M.s17LC2CCjYzaIpBpH92OAqQAhRiL5KJKNWWiAjWfvK130mb21Qa', '2025-10-26', 'Sales', 1111111110, 67, 67, 'Assitant');

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
-- Dumping data for table `_leave_application`
--

INSERT INTO `_leave_application` (`leave_id`, `applicant`, `designation`, `department`, `leave_type`, `reason`, `from_date`, `to_date`, `status`, `accepted_by`, `updated_by`) VALUES
(2, 'first10', 'Head-c', 'Administration', 'Casual Leave', 'For some Resons', '2025-10-25', '2025-10-25', '2', 'superadmin', 'superadmin'),
(4, 'twelve10', 'Assistance-A', 'Product', 'Earned Leave', 'Because it\'s my choice', '2025-10-25', '2025-10-25', '1', '', 'superadmin'),
(5, 'twelve10', 'Assistance-A', 'Product', 'Maternity Leave', 'GIve me leave\'a', '2025-10-25', '2025-10-25', '1', 'superadmin', 'superadmin'),
(6, 'twelve10', 'Assistance-A', 'Product', 'Casual Leave', 'I want a leaev', '2025-10-25', '2025-10-25', '2', 'superadmin', 'superadmin'),
(7, 'superadmin', 'superadmin', 'Administration', 'Casual Leave', 'THIs is my leave', '2025-10-25', '2025-10-26', '0', NULL, NULL),
(8, 'twelve10', 'Assistance-A', 'Human Resource', 'Casual Leave', 'THis is testing purpose alos', '2025-10-25', '2025-10-25', '1', 'superadmin', 'superadmin'),
(9, 'first10', 'Head-c', 'Administration', 'Casual Leave', 'This is testing from admin', '2025-10-25', '2025-10-25', '1', 'superadmin', 'superadmin'),
(10, 'first10', 'Head-c', 'Administration', 'Maternity Leave', 'i want', '2025-10-25', '2025-10-25', '1', 'superadmin', 'superadmin'),
(11, 'twelve1', 'Assistance-B', 'Marketing', 'Casual Leave', 'This is testing', '2025-10-26', '2025-10-27', '2', 'superadmin', 'superadmin'),
(12, 'third12', 'Assitant', 'Sales', 'Sick Leave', 'I am very sick\'s', '2025-10-26', '2025-10-26', '1', 'first10', 'first10');

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_admin_updatedby_admin` (`updated_by`),
  ADD KEY `fk_admin_createdby_admin` (`created_by`);

--
-- Indexes for table `_emp_regi`
--
ALTER TABLE `_emp_regi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_emp_updatedby_admin` (`updated_by`),
  ADD KEY `fk_emp_created_by_admin` (`created_by`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `_emp_regi`
--
ALTER TABLE `_emp_regi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `_leave_application`
--
ALTER TABLE `_leave_application`
  MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `_admin_regi`
--
ALTER TABLE `_admin_regi`
  ADD CONSTRAINT `fk_admin_createdby_admin` FOREIGN KEY (`created_by`) REFERENCES `_admin_regi` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_admin_updatedby_admin` FOREIGN KEY (`updated_by`) REFERENCES `_admin_regi` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `_emp_regi`
--
ALTER TABLE `_emp_regi`
  ADD CONSTRAINT `fk_emp_created_by_admin` FOREIGN KEY (`created_by`) REFERENCES `_admin_regi` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_emp_updatedby_admin` FOREIGN KEY (`updated_by`) REFERENCES `_admin_regi` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
