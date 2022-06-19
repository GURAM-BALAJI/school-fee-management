-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2022 at 08:58 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school_fee`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` bigint(20) NOT NULL,
  `admin_email` varchar(1100) NOT NULL,
  `admin_password` varchar(2000) NOT NULL,
  `admin_name` varchar(1100) NOT NULL,
  `admin_phone` bigint(50) NOT NULL,
  `admin_photo` varchar(5000) NOT NULL,
  `admin_status` tinyint(1) NOT NULL,
  `students_view` tinyint(1) NOT NULL,
  `students_create` tinyint(1) NOT NULL,
  `students_edit` tinyint(1) NOT NULL,
  `students_del` tinyint(1) NOT NULL,
  `admin_view` tinyint(1) NOT NULL,
  `admin_create` tinyint(1) NOT NULL,
  `admin_edit` tinyint(1) NOT NULL,
  `admin_del` tinyint(1) NOT NULL,
  `classes_and_fee_view` tinyint(1) NOT NULL,
  `classes_and_fee_create` tinyint(1) NOT NULL,
  `classes_and_fee_edit` tinyint(1) NOT NULL,
  `classes_and_fee_del` tinyint(1) NOT NULL,
  `admin_special` tinyint(1) NOT NULL,
  `admin_delete` tinyint(1) NOT NULL,
  `admin_added_date` varchar(50) NOT NULL,
  `admin_updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `admin_req` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_email`, `admin_password`, `admin_name`, `admin_phone`, `admin_photo`, `admin_status`, `students_view`, `students_create`, `students_edit`, `students_del`, `admin_view`, `admin_create`, `admin_edit`, `admin_del`, `classes_and_fee_view`, `classes_and_fee_create`, `classes_and_fee_edit`, `classes_and_fee_del`, `admin_special`, `admin_delete`, `admin_added_date`, `admin_updated_date`, `admin_req`) VALUES
(6, 'admin@admin.com', '$2y$10$tlJ7HiO6SfJcqzd0sztEgePf0Pl1GNHxcxkv36kppNjnesT8og7M.', 'wedding', 12345678, '2022-06-19_1655664059.jpeg', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, '18-11-2021 11:13:30 pm', '2022-06-19 18:53:50', 0);

-- --------------------------------------------------------

--
-- Table structure for table `classes_and_fee`
--

CREATE TABLE `classes_and_fee` (
  `classes_and_fee_id` int(11) NOT NULL,
  `classes_and_fee_value` int(11) NOT NULL,
  `classes_and_fee_class` varchar(10) NOT NULL,
  `classes_and_fee_fee` bigint(20) NOT NULL,
  `classes_and_fee_updated_date` varchar(20) NOT NULL,
  `classes_and_fee_created_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classes_and_fee`
--

INSERT INTO `classes_and_fee` (`classes_and_fee_id`, `classes_and_fee_value`, `classes_and_fee_class`, `classes_and_fee_fee`, `classes_and_fee_updated_date`, `classes_and_fee_created_date`) VALUES
(1, 5, 'LKG', 2000, '19-06-2022 02:48:28 ', '19-06-2022 02:29:55 '),
(3, 1, 'UKG', 1000, '19-06-2022 11:18:29 ', '19-06-2022 11:18:29 ');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `students_id` bigint(20) NOT NULL,
  `students_name` varchar(500) NOT NULL,
  `students_class` int(11) NOT NULL,
  `students_photo` varchar(250) DEFAULT NULL,
  `students_DOB` date DEFAULT NULL,
  `students_gender` set('0','1','2') NOT NULL,
  `students_cast` varchar(20) DEFAULT NULL,
  `students_mother_tongue` varchar(20) NOT NULL,
  `students_blood_group` varchar(5) DEFAULT NULL,
  `students_adher` varchar(30) DEFAULT NULL,
  `students_father_name` varchar(500) NOT NULL,
  `students_mother_name` varchar(500) DEFAULT NULL,
  `students_father_phone` bigint(25) DEFAULT NULL,
  `students_mother_phone` bigint(25) NOT NULL,
  `students_father_occupation` varchar(20) DEFAULT NULL,
  `students_mother_occupation` varchar(20) DEFAULT NULL,
  `students_address` varchar(2000) NOT NULL,
  `students_updated_date` varchar(20) NOT NULL,
  `students_created_date` varchar(20) NOT NULL,
  `students_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`students_id`, `students_name`, `students_class`, `students_photo`, `students_DOB`, `students_gender`, `students_cast`, `students_mother_tongue`, `students_blood_group`, `students_adher`, `students_father_name`, `students_mother_name`, `students_father_phone`, `students_mother_phone`, `students_father_occupation`, `students_mother_occupation`, `students_address`, `students_updated_date`, `students_created_date`, `students_deleted`) VALUES
(10003, 'ROOPA', 1, '2022-06-19_1655663602.png', '2000-05-28', '1', 'OB', 'KANNADA', 'B+', '1111111111111111111111111111', 'SRIDER', 'RAJESHWARI', 2222222222222222, 3333333333333333333, 'army', 'House wife3333', 'ragavendra collony 2nd stage,  2nd cross, beside auto nager,ballari1111', '19-06-2022 11:39:34 ', '19-06-2022', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `classes_and_fee`
--
ALTER TABLE `classes_and_fee`
  ADD PRIMARY KEY (`classes_and_fee_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`students_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `classes_and_fee`
--
ALTER TABLE `classes_and_fee`
  MODIFY `classes_and_fee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `students_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10004;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
