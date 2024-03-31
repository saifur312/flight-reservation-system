-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2024 at 09:28 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flightciu`
--

-- --------------------------------------------------------

--
-- Table structure for table `airline`
--

CREATE TABLE `airline` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `seats` varchar(20) NOT NULL,
  `contact` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `airline`
--

INSERT INTO `airline` (`id`, `name`, `seats`, `contact`) VALUES
(1, 'Biman Bangladesh Airlines', '249', '+988654'),
(3, 'Qatar Airways', '150', '+143678'),
(4, 'Dubai Airways', '400', '+045373');

-- --------------------------------------------------------

--
-- Table structure for table `airport`
--

CREATE TABLE `airport` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(10) NOT NULL,
  `country` varchar(50) NOT NULL,
  `city` varchar(20) NOT NULL,
  `contact` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `airport`
--

INSERT INTO `airport` (`id`, `name`, `code`, `country`, `city`, `contact`) VALUES
(1, 'Chittagong Int. Airport', 'CHI', 'Bangladesh', 'Chittagong', '+880142361'),
(2, 'Shajalal Int. Airport', 'DHA', 'Bangladesh', 'DHAKA', '+8802352'),
(3, 'Sylhet Intl. Airport', 'SYL', 'Bangladesh', 'Sylhet', '+88663235'),
(4, 'Coxbazar Int. Arrport', 'COX', 'Bangladesh', 'Coxbazar', '+8866328'),
(6, 'Kalkata Airport', 'KAL', 'India', 'Kalkata', '+045373'),
(7, 'Sayedpur Airport', 'SAY', 'Bangladesh', 'Sayedpur', '+880142388'),
(10, 'djxjx', 'kdttkd', 'dtd', 'stkdddd', 'stdo');

-- --------------------------------------------------------

--
-- Table structure for table `flight`
--

CREATE TABLE `flight` (
  `id` int(11) NOT NULL,
  `source` varchar(100) NOT NULL,
  `destination` varchar(100) NOT NULL,
  `departure` datetime NOT NULL,
  `arrival` datetime NOT NULL,
  `price` int(11) NOT NULL,
  `airline` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flight`
--

INSERT INTO `flight` (`id`, `source`, `destination`, `departure`, `arrival`, `price`, `airline`) VALUES
(1, 'Shajalal Int. Airport', 'Chittagong Int. Airport', '2024-03-30 07:00:00', '2024-03-30 07:30:00', 7000, 'Biman Bangladesh Airlines'),
(2, 'Chittagong Int. Airport', 'Shajalal Int. Airport', '2024-03-31 20:00:00', '0000-00-00 00:00:00', 4000, 'Biman Bangladesh Airlines'),
(3, 'Sylhet Intl. Airport', 'Chittagong Int. Airport', '2024-03-31 09:00:00', '2024-02-01 20:50:00', 6000, 'Biman Bangladesh Airlines'),
(10001, 'Chittagong Int. Airport', 'Shajalal Int. Airport', '2024-03-31 07:00:00', '2024-03-31 08:40:11', 4500, 'Biman Bangladesh Airlines'),
(10002, 'Chittagong Int. Airport', 'Shajalal Int. Airport', '2024-03-31 22:00:00', '2024-03-31 11:31:21', 5000, 'Dubai Airways'),
(10003, 'Shajalal Int. Airport', 'Shajalal Int. Airport', '2024-03-30 06:42:00', '2024-03-30 07:50:00', 5485, 'Dubai Airways');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `flight_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `adult` int(11) NOT NULL,
  `child` int(11) NOT NULL,
  `class` text NOT NULL,
  `seat_no` varchar(50) NOT NULL,
  `amount` int(11) NOT NULL,
  `created_on` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`id`, `flight_id`, `user_id`, `adult`, `child`, `class`, `seat_no`, `amount`, `created_on`) VALUES
(1000, 3, 1001, 2, 1, '', '', 6000, NULL),
(1001, 3, 1001, 1, 0, 'Economy', '', 6000, '2024-03-31 08:34:46'),
(1002, 10002, 1001, 1, 2, 'Economy', '2A, 3B, 3C', 5000, '2024-03-31 08:43:22');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `role` varchar(20) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `passport` varchar(30) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`, `first_name`, `last_name`, `email`, `passport`, `contact`, `address`) VALUES
(1001, 'sana', 'sana123', 'passenger', '', '', '', '', '', ''),
(1002, 'saifur312', '12345678', 'admin', '', '', '', '', '', ''),
(1003, 'maan23', '876543', 'passenger', '', '', '', '', '', ''),
(1004, 'shanto', '12345', 'admin', '', '', '', '', '', ''),
(1005, 'atanaaa', '123', 'pass..', '', '', '', '', '', ''),
(1006, 'fara', 'f4566', 'passenger', '', '', '', '', '', ''),
(1007, 'shimul', '1257', 'passenger.', '', '', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `airline`
--
ALTER TABLE `airline`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `airport`
--
ALTER TABLE `airport`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flight`
--
ALTER TABLE `flight`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `airline`
--
ALTER TABLE `airline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `airport`
--
ALTER TABLE `airport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `flight`
--
ALTER TABLE `flight`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10004;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1003;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1009;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
