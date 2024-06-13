-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2024 at 01:26 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `leave_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_rank`
--

CREATE TABLE `academic_rank` (
  `rank_id` int(11) NOT NULL,
  `rank_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `academic_rank`
--

INSERT INTO `academic_rank` (`rank_id`, `rank_name`) VALUES
(1, 'Instructor'),
(2, 'Assistant Professor'),
(3, 'Associate Professor'),
(4, 'Professor'),
(5, 'University Professor');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `acc_status` varchar(20) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `address` varchar(100) NOT NULL,
  `contact` bigint(11) NOT NULL,
  `department` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`, `acc_status`, `fname`, `mname`, `lname`, `birthdate`, `address`, `contact`, `department`) VALUES
('1', 'admin', 'admin123', 'Accepted', 'Marvin', 'test mname', 'Lagasca', '2024-04-03', 'test address', 918273656, 6),
('adminId', 'test', 'test', 'Accepted', 'a', 'a', 'a', '2024-04-24', 'a', 12312321, 2),
('test', 'test', 'test123', 'Pending', 'test', 'test', 'test', '2024-04-16', 'test', 1343, 1);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_id` int(11) NOT NULL,
  `dept_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `dept_name`) VALUES
(1, 'AB English Language'),
(2, 'BS Architecture'),
(3, 'BS Civil Engineering'),
(4, 'BS Computer Engineering'),
(5, 'BS Electrical Engineering'),
(6, 'BS Information Technology'),
(7, 'BS Mathematics'),
(8, 'BS Mechanical Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `designation_id` int(11) NOT NULL,
  `designation_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`designation_id`, `designation_name`) VALUES
(1, 'Dean'),
(2, 'Chair'),
(3, 'VP'),
(4, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `acc_status` varchar(50) NOT NULL,
  `fname` varchar(25) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `sick_credits` float DEFAULT NULL,
  `vacation_credits` float DEFAULT NULL,
  `service_credits` float NOT NULL,
  `birthdate` date NOT NULL,
  `contact` bigint(11) NOT NULL,
  `date_hired` date DEFAULT NULL,
  `address` varchar(100) NOT NULL,
  `department` int(11) NOT NULL,
  `employee_type` int(11) DEFAULT NULL,
  `working_status` int(11) DEFAULT NULL,
  `academic_rank` int(11) DEFAULT NULL,
  `designation` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `username`, `password`, `acc_status`, `fname`, `mname`, `lname`, `sick_credits`, `vacation_credits`, `service_credits`, `birthdate`, `contact`, `date_hired`, `address`, `department`, `employee_type`, `working_status`, `academic_rank`, `designation`) VALUES
('17-UR-0104', '', '', 'Accepted', 'Jericho', 'Debil', 'Marquez', 6.3, 4.3, 6.21, '2007-02-28', 9099501718, '2024-01-01', 'Mangatarem, Pangasinan', 6, NULL, NULL, NULL, 2),
('18-UR-0099', '', '', 'Accepted', 'Kurt', 'Russel', 'Solayao', 5.01, 4.51, 4.93, '2024-05-09', 9099501718, '2024-02-01', 'Mangatarem, Pangasinan', 6, NULL, NULL, NULL, 2),
('18-UR-0175', '', '', 'Disabled', 'Isaiah', 'Gomez', 'Diaz', 6.21, 4.21, 6.21, '2006-02-28', 9099501718, '2024-01-01', 'Mangatarem, Pangasinan', 6, NULL, NULL, NULL, 3),
('19-UR-0072', '', '', 'Disabled', 'Christopherson', 'Callo', 'Carpio', 6.21, 6.21, 6.21, '2003-03-31', 9099501718, '2024-01-01', 'Mangatarem, Pangasinan', 6, NULL, NULL, NULL, 4),
('21-UR-0111', 'leng', 'leng123', 'Disabled', 'Justin Gerald', 'G', 'Loleng', 15.98, -3.52, 0, '2024-04-14', 2147483647, '2023-04-13', 'urda', 6, 2, NULL, NULL, NULL),
('21-UR-0183', 'ced', 'ced123', 'Accepted', 'Cedric Joel', 'F', 'Cayaban', 21.41, 17.41, 0, '2024-03-11', 9099501718, '2023-01-01', 'Macarang', 6, 2, 3, 3, 4),
('21-UR-0186', 'a', 'a', 'Accepted', 'Christopherson', 'Callo', 'Carpio', 4.006, -4.494, 0, '2024-03-10', 2147483647, NULL, 'Mangats', 3, 1, NULL, 1, 2),
('22-UR-0001', '', '', 'Disabled', 'mak', 'a', 'cayaban', 3.73, 3.73, 3.73, '2024-05-27', 9099501718, '2024-02-27', 'a', 6, 2, NULL, NULL, NULL),
('22-UR-0002', '', '', 'Disabled', 'mak', 'F', 'biag', 5.14, 5.14, 5.01, '2024-05-28', 9099501718, '2024-01-27', 'a', 6, 1, NULL, NULL, NULL),
('23-UR-009', '', '', 'Disabled', 'Joreson', 'Banga', 'Biag', 4.93, 4.93, 4.93, '2006-10-17', 9099501718, '2024-02-01', 'Aguilar, Mangatarem, Pangasinan', 6, NULL, NULL, NULL, 3),
('a', 'a', 'a', 'Pending', 'a', 'a', 'a', 0, 0, 0, '2024-04-14', 1, '2024-04-22', 'a', 3, 2, 1, 1, 1),
('sdade', '', '', 'Disabled', 'Christopherson', 'a', 'Carpio', 3.85, 3.85, 3.73, '2024-05-13', 9099501718, '2024-02-27', 'ko', 6, NULL, NULL, NULL, 4),
('test', 'test', 'test123', 'Pending', 'test', 'test', 'test', 0, 0, 0, '2024-04-16', 12324, '2024-04-15', 'test', 3, 2, 3, 2, 2),
('test ID', 'test', 'test123', 'Pending', 'test name', 'test name', 'test lname', 0, 10, 0, '2024-01-16', 918273656, NULL, 'a', 4, 1, 3, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `employee_credits`
--

CREATE TABLE `employee_credits` (
  `credit_id` int(11) NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `date` varchar(100) NOT NULL,
  `service_credits` float NOT NULL,
  `vacation_credits` float NOT NULL,
  `sick_credits` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employee_credits`
--

INSERT INTO `employee_credits` (`credit_id`, `employee_id`, `date`, `service_credits`, `vacation_credits`, `sick_credits`) VALUES
(1, '21-UR-0183', '2023-01-31', 1.5, 1.5, 1.5),
(2, '21-UR-0183', '2023-02-28', 3, 3, 3),
(3, '21-UR-0183', '2023-03-31', 4.5, 4.5, 4.5),
(4, '21-UR-0183', '2023-04-30', 6, 6, 6),
(5, '21-UR-0183', '2023-05-31', 7.5, 7.5, 7.5),
(6, '21-UR-0183', '2023-06-30', 9, 9, 9),
(7, '21-UR-0183', '2023-07-31', 10.5, 10.5, 10.5),
(8, '21-UR-0183', '2023-08-31', 12, 12, 12),
(9, '21-UR-0183', '2023-09-30', 13.5, 13.5, 13.5),
(10, '21-UR-0183', '2023-10-31', 15, 15, 15),
(11, '21-UR-0183', '2023-11-30', 16.5, 16.5, 16.5),
(12, '21-UR-0183', '2023-12-31', 18, 18, 18),
(13, '21-UR-0183', '2024-01-31', 19.5, 19.5, 19.5),
(14, '21-UR-0183', '2024-02-29', 21, 21, 21),
(15, '21-UR-0183', '2024-03-31', 22.5, 22.5, 22.5),
(16, '21-UR-0183', '2024-04-30', 24, 24, 24),
(17, 'sdade', '2024-02-29', 1.5, 1.5, 1.5),
(18, 'sdade', '2024-03-31', 3, 3, 3),
(19, 'sdade', '2024-04-30', 4.5, 4.5, 4.5),
(20, '22-UR-0002', '2024-01-31', 1.5, 1.5, 1.5),
(21, '22-UR-0002', '2024-02-29', 3, 3, 3),
(22, '22-UR-0002', '2024-03-31', 4.5, 4.5, 4.5),
(23, '22-UR-0002', '2024-04-30', 6, 6, 6);

-- --------------------------------------------------------

--
-- Table structure for table `employee_leave`
--

CREATE TABLE `employee_leave` (
  `leave_id` int(11) NOT NULL,
  `employee_id` varchar(20) NOT NULL,
  `leave_type` int(11) DEFAULT NULL,
  `special_leave` varchar(10) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `reason` varchar(150) DEFAULT NULL,
  `leave_form` text DEFAULT NULL,
  `med_cert` text DEFAULT NULL,
  `days` float DEFAULT NULL,
  `credit_cost` float NOT NULL,
  `credit_balance` float NOT NULL,
  `reject_reason` varchar(255) NOT NULL,
  `date_earned` date DEFAULT NULL,
  `earned_service` float DEFAULT NULL,
  `earned_vacation` float DEFAULT NULL,
  `earned_sick` float DEFAULT NULL,
  `event_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employee_leave`
--

INSERT INTO `employee_leave` (`leave_id`, `employee_id`, `leave_type`, `special_leave`, `start_date`, `end_date`, `status`, `reason`, `leave_form`, `med_cert`, `days`, `credit_cost`, `credit_balance`, `reject_reason`, `date_earned`, `earned_service`, `earned_vacation`, `earned_sick`, `event_type`) VALUES
(324, '18-UR-0175', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 0, 0, '', '2024-01-31', 1.5, 1.5, 1.5, 'earn'),
(325, '18-UR-0175', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 0, 0, '', '2024-02-29', 3, 3, 3, 'earn'),
(326, '18-UR-0175', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 0, 0, '', '2024-03-31', 4.5, 4.5, 4.5, 'earn'),
(327, '18-UR-0175', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 0, 0, '', '2024-04-30', 6, 6, 6, 'earn'),
(328, '18-UR-0175', 1, 'false', '2024-06-01', '2024-06-01', 'Pending', 'nilagnat', NULL, NULL, 0, 0.5, 5.71, '', NULL, NULL, NULL, NULL, 'leave'),
(329, '18-UR-0175', 1, 'false', '2024-06-01', '2024-06-01', 'Pending', 'sinipon employee', NULL, NULL, 0, 0.5, 5.21, '', NULL, NULL, NULL, NULL, 'leave'),
(330, '18-UR-0175', 1, 'false', '2024-06-01', '2024-06-01', 'Pending', 'as', NULL, NULL, 1, 1, 4.21, '', NULL, NULL, NULL, NULL, 'leave'),
(331, '21-UR-0183', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 0, 0, '', '2023-01-31', 1.5, 1.5, 1.5, 'earn'),
(332, '21-UR-0183', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 0, 0, '', '2023-02-28', 3, 3, 3, 'earn'),
(333, '21-UR-0183', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 0, 0, '', '2023-03-31', 4.5, 4.5, 4.5, 'earn'),
(334, '21-UR-0183', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 0, 0, '', '2023-04-30', 6, 6, 6, 'earn'),
(335, '21-UR-0183', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 0, 0, '', '2023-05-31', 7.5, 7.5, 7.5, 'earn'),
(336, '21-UR-0183', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 0, 0, '', '2023-06-30', 9, 9, 9, 'earn'),
(337, '21-UR-0183', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 0, 0, '', '2023-07-31', 10.5, 10.5, 10.5, 'earn'),
(338, '21-UR-0183', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 0, 0, '', '2023-08-31', 12, 12, 12, 'earn'),
(339, '21-UR-0183', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 0, 0, '', '2023-09-30', 13.5, 13.5, 13.5, 'earn'),
(340, '21-UR-0183', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 0, 0, '', '2023-10-31', 15, 15, 15, 'earn'),
(341, '21-UR-0183', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 0, 0, '', '2023-11-30', 16.5, 16.5, 16.5, 'earn'),
(342, '21-UR-0183', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 0, 0, '', '2023-12-31', 18, 18, 18, 'earn'),
(343, '21-UR-0183', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 0, 0, '', '2024-01-31', 19.5, 19.5, 19.5, 'earn'),
(344, '21-UR-0183', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 0, 0, '', '2024-02-29', 21, 21, 21, 'earn'),
(345, '21-UR-0183', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 0, 0, '', '2024-03-31', 22.5, 22.5, 22.5, 'earn'),
(346, '21-UR-0183', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 0, 0, '', '2024-04-30', 24, 24, 24, 'earn'),
(347, '21-UR-0183', 1, 'false', '2024-06-01', '2024-06-01', 'Pending', 'as', NULL, NULL, 0, 0.5, 20.83, '', NULL, NULL, NULL, NULL, 'leave'),
(348, '17-UR-0104', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 0, 0, '', '2024-01-31', 1.5, 1.5, 1.5, 'earn'),
(349, '17-UR-0104', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 0, 0, '', '2024-02-29', 3, 3, 3, 'earn'),
(350, '17-UR-0104', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 0, 0, '', '2024-03-31', 4.5, 4.5, 4.5, 'earn'),
(351, '17-UR-0104', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 0, 0, '', '2024-04-30', 6, 6, 6, 'earn'),
(352, '17-UR-0104', 1, 'true', '2024-06-01', '2024-06-01', 'Pending', 'going to america', NULL, NULL, 1, 1, 5.21, '', NULL, NULL, NULL, NULL, 'leave'),
(353, '17-UR-0104', 1, 'false', '2024-06-01', '2024-06-01', 'Pending', 'Employee needs to rest', NULL, NULL, 0, 0.5, 4.71, '', NULL, NULL, NULL, NULL, 'leave'),
(354, '18-UR-0099', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 0, 0, '', '2024-02-29', 1.5, 1.5, 1.5, 'earn'),
(355, '18-UR-0099', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 0, 0, '', '2024-03-31', 3, 3, 3, 'earn'),
(356, '18-UR-0099', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 0, 0, '', '2024-04-30', 4.5, 4.5, 4.5, 'earn'),
(357, '18-UR-0099', 1, 'true', '2024-06-01', '2024-06-01', 'Pending', 'Employee will travel to america', NULL, NULL, 0, 0.5, 4.43, '', NULL, NULL, NULL, NULL, 'leave'),
(358, '21-UR-0183', 1, 'false', '2024-06-13', '2024-06-15', 'Pending', 'sample reason', NULL, NULL, 3, 3, 17.83, '', NULL, NULL, NULL, NULL, 'leave'),
(359, '21-UR-0183', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 0, 0, '', '2024-05-31', 25.5, 25.5, 25.5, 'earn'),
(360, '21-UR-0183', 1, 'false', '2024-06-02', '2024-06-02', 'Pending', 'need some rest', NULL, NULL, 0, 0.5, 17.41, '', NULL, NULL, NULL, NULL, 'leave'),
(361, '17-UR-0104', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 0, 0, '', '2024-05-31', 7.5, 7.5, 7.5, 'earn'),
(362, '17-UR-0104', 1, 'false', '2024-06-02', '2024-06-02', 'Pending', 'need vacation', NULL, NULL, 0, 0.5, 4.3, '', NULL, NULL, NULL, NULL, 'leave');

-- --------------------------------------------------------

--
-- Table structure for table `employee_type`
--

CREATE TABLE `employee_type` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employee_type`
--

INSERT INTO `employee_type` (`type_id`, `type_name`) VALUES
(1, 'Teaching'),
(2, 'Non-teaching');

-- --------------------------------------------------------

--
-- Table structure for table `leave_type`
--

CREATE TABLE `leave_type` (
  `type_id` int(11) NOT NULL,
  `leave_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `leave_type`
--

INSERT INTO `leave_type` (`type_id`, `leave_name`) VALUES
(1, 'Vacation leave'),
(2, 'Sick leave');

-- --------------------------------------------------------

--
-- Table structure for table `super_admin`
--

CREATE TABLE `super_admin` (
  `super_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `super_admin`
--

INSERT INTO `super_admin` (`super_id`, `username`, `password`) VALUES
(1, 'super-admin', 'super123');

-- --------------------------------------------------------

--
-- Table structure for table `working_status`
--

CREATE TABLE `working_status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `working_status`
--

INSERT INTO `working_status` (`status_id`, `status_name`) VALUES
(1, 'Casual'),
(2, 'Contractual'),
(3, 'Regular');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_rank`
--
ALTER TABLE `academic_rank`
  ADD PRIMARY KEY (`rank_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `FK7` (`department`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`designation_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `FK1` (`department`),
  ADD KEY `FK2` (`employee_type`),
  ADD KEY `FK3` (`academic_rank`),
  ADD KEY `FK4` (`designation`),
  ADD KEY `FK8` (`working_status`);

--
-- Indexes for table `employee_credits`
--
ALTER TABLE `employee_credits`
  ADD PRIMARY KEY (`credit_id`),
  ADD KEY `Employee-reference` (`employee_id`);

--
-- Indexes for table `employee_leave`
--
ALTER TABLE `employee_leave`
  ADD PRIMARY KEY (`leave_id`),
  ADD KEY `Fk6` (`leave_type`),
  ADD KEY `FK5` (`employee_id`);

--
-- Indexes for table `employee_type`
--
ALTER TABLE `employee_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `leave_type`
--
ALTER TABLE `leave_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `super_admin`
--
ALTER TABLE `super_admin`
  ADD PRIMARY KEY (`super_id`);

--
-- Indexes for table `working_status`
--
ALTER TABLE `working_status`
  ADD PRIMARY KEY (`status_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_rank`
--
ALTER TABLE `academic_rank`
  MODIFY `rank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `designation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employee_credits`
--
ALTER TABLE `employee_credits`
  MODIFY `credit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `employee_leave`
--
ALTER TABLE `employee_leave`
  MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=363;

--
-- AUTO_INCREMENT for table `employee_type`
--
ALTER TABLE `employee_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `leave_type`
--
ALTER TABLE `leave_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `super_admin`
--
ALTER TABLE `super_admin`
  MODIFY `super_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `working_status`
--
ALTER TABLE `working_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `FK7` FOREIGN KEY (`department`) REFERENCES `department` (`dept_id`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `FK1` FOREIGN KEY (`department`) REFERENCES `department` (`dept_id`),
  ADD CONSTRAINT `FK2` FOREIGN KEY (`employee_type`) REFERENCES `employee_type` (`type_id`),
  ADD CONSTRAINT `FK3` FOREIGN KEY (`academic_rank`) REFERENCES `academic_rank` (`rank_id`),
  ADD CONSTRAINT `FK4` FOREIGN KEY (`designation`) REFERENCES `designation` (`designation_id`),
  ADD CONSTRAINT `FK8` FOREIGN KEY (`working_status`) REFERENCES `working_status` (`status_id`);

--
-- Constraints for table `employee_credits`
--
ALTER TABLE `employee_credits`
  ADD CONSTRAINT `Employee-reference` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`);

--
-- Constraints for table `employee_leave`
--
ALTER TABLE `employee_leave`
  ADD CONSTRAINT `FK5` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`),
  ADD CONSTRAINT `Fk6` FOREIGN KEY (`leave_type`) REFERENCES `leave_type` (`type_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
