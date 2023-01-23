-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2022 at 07:40 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `roadar`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_announcements`
--

CREATE TABLE `tbl_announcements` (
  `c_no` int(11) NOT NULL,
  `announcement_title` varchar(255) NOT NULL,
  `announcement_details` text NOT NULL,
  `announcement_date` date NOT NULL,
  `announcement_picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_announcements`
--

INSERT INTO `tbl_announcements` (`c_no`, `announcement_title`, `announcement_details`, `announcement_date`, `announcement_picture`) VALUES
(6, 'Heavy Traffic', 'two vehicles collided', '2022-10-13', 'announcement/studentportal-20221012011336.webp');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_enforcer`
--

CREATE TABLE `tbl_enforcer` (
  `c_no` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_enforcer`
--

INSERT INTO `tbl_enforcer` (`c_no`, `firstname`, `middlename`, `lastname`, `title`) VALUES
(3, 'Dingdong', 'Gonzales', 'Dantes', 'Dr.'),
(4, 'John Lloyd', 'Espidol', 'Cruz', 'Engr.'),
(5, 'Coco', 'Pacheco', 'Martin', 'Mr'),
(6, 'Paulo', 'Lingbanan', 'Avelino', 'Mr'),
(7, 'Bea', 'Ranollo', 'Alonzo', 'Ms.'),
(8, 'Fernando', 'Kelley', 'Poe', 'Dr'),
(9, 'Cesar', 'Manhilot', 'Montano', 'Engr.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE `tbl_login` (
  `c_no` int(11) NOT NULL,
  `student_number` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT '1',
  `user_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`c_no`, `student_number`, `password`, `status`, `user_type`) VALUES
(87, 'admin', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '1', 'administrator'),
(99, 'test@studentportal.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '1', 'student'),
(100, 'dave.123123@balagtas.sti.edu.ph', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', '1', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_announcements`
--
ALTER TABLE `tbl_announcements`
  ADD PRIMARY KEY (`c_no`);

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`c_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_announcements`
--
ALTER TABLE `tbl_announcements`
  MODIFY `c_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `c_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
