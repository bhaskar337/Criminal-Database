-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2016 at 03:26 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `criminal_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `biometric_details`
--

CREATE TABLE `biometric_details` (
  `criminal_id` int(11) DEFAULT NULL,
  `height` double DEFAULT NULL,
  `weight` double DEFAULT NULL,
  `blood_group` varchar(3) DEFAULT NULL,
  `hand_print` varchar(30) DEFAULT NULL,
  `iris_scan` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `biometric_details`
--

INSERT INTO `biometric_details` (`criminal_id`, `height`, `weight`, `blood_group`, `hand_print`, `iris_scan`) VALUES
(100, 162, 52, 'O+', 'hand.jpg', 'eye.jpg'),
(101, 324, 54, 'O+', 'hand.jpg', 'eye.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `convict`
--

CREATE TABLE `convict` (
  `criminal_id` int(11) DEFAULT NULL,
  `conduct` varchar(10) DEFAULT NULL,
  `sentence` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `convict`
--

INSERT INTO `convict` (`criminal_id`, `conduct`, `sentence`) VALUES
(100, 'Good', 5);

-- --------------------------------------------------------

--
-- Table structure for table `crime_type`
--

CREATE TABLE `crime_type` (
  `criminal_id` int(11) DEFAULT NULL,
  `criminal_ctype` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `crime_type`
--

INSERT INTO `crime_type` (`criminal_id`, `criminal_ctype`) VALUES
(100, 'Robbery'),
(100, 'Sexual Assault'),
(100, 'Breaking and Entering'),
(101, 'Robbery'),
(101, 'Breaking and Entering'),
(101, 'Sexual Assault');

-- --------------------------------------------------------

--
-- Table structure for table `criminal`
--

CREATE TABLE `criminal` (
  `criminal_id` int(11) NOT NULL,
  `criminal_fname` varchar(20) NOT NULL,
  `criminal_lname` varchar(20) NOT NULL,
  `criminal_gender` varchar(10) NOT NULL,
  `criminal_dob` date NOT NULL,
  `criminal_image` varchar(50) NOT NULL,
  `criminal_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `criminal`
--

INSERT INTO `criminal` (`criminal_id`, `criminal_fname`, `criminal_lname`, `criminal_gender`, `criminal_dob`, `criminal_image`, `criminal_type`) VALUES
(100, 'Gaurav', 'Bhagchandani', 'Male', '2024-09-16', 'dtrump.jpg', 'convict'),
(101, 'Gaurav', 'Punjabi', 'Male', '2024-09-16', 'back.jpg', 'exconvict'),
(106, 'Clerance', 'Gomes', 'Male', '0000-00-00', 'dtrump.jpg', 'wanted');

-- --------------------------------------------------------

--
-- Table structure for table `criminal_address`
--

CREATE TABLE `criminal_address` (
  `Zip` int(11) NOT NULL,
  `City` varchar(30) NOT NULL,
  `State` varchar(30) NOT NULL,
  `Country` varchar(30) NOT NULL,
  `criminal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `criminal_address`
--

INSERT INTO `criminal_address` (`Zip`, `City`, `State`, `Country`, `criminal_id`) VALUES
(400005, 'Mumbai', 'Maharashtra', 'India', 100),
(400005, 'Mumbai', 'Maharashtra', 'India', 101),
(0, '', '', '', 106);

-- --------------------------------------------------------

--
-- Table structure for table `exconvict`
--

CREATE TABLE `exconvict` (
  `criminal_id` int(11) DEFAULT NULL,
  `previous_jailtime` int(11) DEFAULT NULL,
  `alive` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exconvict`
--

INSERT INTO `exconvict` (`criminal_id`, `previous_jailtime`, `alive`) VALUES
(101, 6, 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `officer`
--

CREATE TABLE `officer` (
  `officer_id` char(10) NOT NULL,
  `officer_fname` varchar(20) NOT NULL,
  `officer_lname` varchar(20) NOT NULL,
  `offier_rank` int(11) NOT NULL,
  `officer_email` varchar(30) NOT NULL,
  `officer_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `officer`
--

INSERT INTO `officer` (`officer_id`, `officer_fname`, `officer_lname`, `offier_rank`, `officer_email`, `officer_password`) VALUES
('007', 'Bhaskar', 'Barua', 1, 'bhaskar11.bb@gmail.com', '$2y$10$PUTZIeTdn.4to7frxUHi..junqFKfLAGCUuxj5kfy1d6g2eQDWT8O'),
('123', 'Gaurav', 'Bhagchandani', 10, 'gbolosta@gmail.com', '$2y$10$gqYzh2UM1JoQcuBdYYG6n.ihMlLRD0MUJLCNeDKDS1PpU3eiXLOp6');

-- --------------------------------------------------------

--
-- Table structure for table `wanted`
--

CREATE TABLE `wanted` (
  `criminal_id` int(11) DEFAULT NULL,
  `potential_penalty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `biometric_details`
--
ALTER TABLE `biometric_details`
  ADD UNIQUE KEY `criminal_id_2` (`criminal_id`),
  ADD KEY `criminal_id` (`criminal_id`);

--
-- Indexes for table `convict`
--
ALTER TABLE `convict`
  ADD KEY `criminal_id` (`criminal_id`);

--
-- Indexes for table `crime_type`
--
ALTER TABLE `crime_type`
  ADD KEY `criminal_id` (`criminal_id`);

--
-- Indexes for table `criminal`
--
ALTER TABLE `criminal`
  ADD PRIMARY KEY (`criminal_id`);

--
-- Indexes for table `criminal_address`
--
ALTER TABLE `criminal_address`
  ADD UNIQUE KEY `criminal_id` (`criminal_id`),
  ADD KEY `Zip` (`Zip`);

--
-- Indexes for table `exconvict`
--
ALTER TABLE `exconvict`
  ADD KEY `criminal_id` (`criminal_id`);

--
-- Indexes for table `officer`
--
ALTER TABLE `officer`
  ADD PRIMARY KEY (`officer_id`);

--
-- Indexes for table `wanted`
--
ALTER TABLE `wanted`
  ADD KEY `criminal_id` (`criminal_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `biometric_details`
--
ALTER TABLE `biometric_details`
  ADD CONSTRAINT `biometric_details_ibfk_1` FOREIGN KEY (`criminal_id`) REFERENCES `criminal` (`criminal_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `convict`
--
ALTER TABLE `convict`
  ADD CONSTRAINT `convict_ibfk_1` FOREIGN KEY (`criminal_id`) REFERENCES `criminal` (`criminal_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `crime_type`
--
ALTER TABLE `crime_type`
  ADD CONSTRAINT `crime_type_ibfk_1` FOREIGN KEY (`criminal_id`) REFERENCES `criminal` (`criminal_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `criminal_address`
--
ALTER TABLE `criminal_address`
  ADD CONSTRAINT `criminal_address_ibfk_1` FOREIGN KEY (`criminal_id`) REFERENCES `criminal` (`criminal_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `exconvict`
--
ALTER TABLE `exconvict`
  ADD CONSTRAINT `exconvict_ibfk_1` FOREIGN KEY (`criminal_id`) REFERENCES `criminal` (`criminal_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `wanted`
--
ALTER TABLE `wanted`
  ADD CONSTRAINT `wanted_ibfk_1` FOREIGN KEY (`criminal_id`) REFERENCES `criminal` (`criminal_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
