-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2020 at 04:12 AM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wh`
--

-- --------------------------------------------------------

--
-- Table structure for table `m_booking_room`
--

CREATE TABLE `m_booking_room` (
  `m_booking_id` int(1) NOT NULL,
  `m_booking_start` datetime NOT NULL,
  `m_booking_end` datetime NOT NULL,
  `m_booking_agenda` varchar(50) NOT NULL,
  `m_booking_PIC` varchar(50) NOT NULL,
  `m_booking_room_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_booking_room`
--

INSERT INTO `m_booking_room` (`m_booking_id`, `m_booking_start`, `m_booking_end`, `m_booking_agenda`, `m_booking_PIC`, `m_booking_room_name`) VALUES
(1, '2020-04-30 03:04:00', '2020-04-21 04:04:00', 'ff', 'ff', 'Room I'),
(2, '2020-04-13 08:54:00', '2020-04-13 08:55:00', 'makan', 'raka', 'Room II'),
(3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'meeting', 'Nama PIC', 'Room III'),
(4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Room IV');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_booking_room`
--
ALTER TABLE `m_booking_room`
  ADD PRIMARY KEY (`m_booking_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_booking_room`
--
ALTER TABLE `m_booking_room`
  MODIFY `m_booking_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
