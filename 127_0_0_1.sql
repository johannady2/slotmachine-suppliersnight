-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2015 at 04:04 PM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `slotmachine_suppliersnight`
--

-- --------------------------------------------------------

--
-- Table structure for table `lucky8_admin`
--

CREATE TABLE IF NOT EXISTS `lucky8_admin` (
  `id_lucky8_admin` int(11) NOT NULL,
  `username_lucky8_admin` varchar(200) NOT NULL,
  `password_lucky8_admin` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lucky8_admin`
--

INSERT INTO `lucky8_admin` (`id_lucky8_admin`, `username_lucky8_admin`, `password_lucky8_admin`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `lucky8_admin_preference`
--

CREATE TABLE IF NOT EXISTS `lucky8_admin_preference` (
  `id_preference` int(11) NOT NULL,
  `store_datetime_start` timestamp NULL DEFAULT NULL,
  `store_datetime_end` timestamp NULL DEFAULT NULL,
  `store_date_startend_always_current` int(10) NOT NULL DEFAULT '0',
  `playable_duration` int(11) DEFAULT NULL,
  `playable_times` int(11) DEFAULT NULL,
  `plays_left` int(12) NOT NULL,
  `max_win_times_per_duration` int(12) NOT NULL,
  `wins_left` int(12) NOT NULL,
  `last_refill_datetime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'last time front end plays_left and wins_left were refilled. applicable if store_date_startend_always_current == 1'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lucky8_admin_preference`
--

INSERT INTO `lucky8_admin_preference` (`id_preference`, `store_datetime_start`, `store_datetime_end`, `store_date_startend_always_current`, `playable_duration`, `playable_times`, `plays_left`, `max_win_times_per_duration`, `wins_left`, `last_refill_datetime`) VALUES
(1, '2015-09-14 09:30:00', '2015-09-14 15:30:10', 1, 21610, 500, 463, 180, 9, '2015-09-14 05:31:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lucky8_admin`
--
ALTER TABLE `lucky8_admin`
  ADD PRIMARY KEY (`id_lucky8_admin`),
  ADD UNIQUE KEY `username_lucky8_admin` (`username_lucky8_admin`);

--
-- Indexes for table `lucky8_admin_preference`
--
ALTER TABLE `lucky8_admin_preference`
  ADD PRIMARY KEY (`id_preference`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lucky8_admin`
--
ALTER TABLE `lucky8_admin`
  MODIFY `id_lucky8_admin` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `lucky8_admin_preference`
--
ALTER TABLE `lucky8_admin_preference`
  MODIFY `id_preference` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
