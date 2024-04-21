-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2024 at 11:35 PM
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
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `flight_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `passenger_id` int(11) NOT NULL,
  `created_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `flight_id`, `user_id`, `passenger_id`, `created_on`) VALUES
(1, 2, 1001, 1, NULL),
(2, 3, 1001, 2, NULL),
(3, 10002, 1004, 3, NULL),
(4, 10001, 1004, 4, NULL),
(5, 10001, 1007, 5, NULL),
(6, 3, 1004, 6, NULL);

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
  `airline` varchar(100) NOT NULL,
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flight`
--

INSERT INTO `flight` (`id`, `source`, `destination`, `departure`, `arrival`, `price`, `airline`, `duration`) VALUES
(1, 'Shajalal Int. Airport', 'Chittagong Int. Airport', '2024-03-30 07:00:00', '2024-03-30 07:30:00', 7000, 'Biman Bangladesh Airlines', 30),
(2, 'Chittagong Int. Airport', 'Shajalal Int. Airport', '2024-03-31 20:00:00', '2024-03-31 21:50:00', 8650, 'Biman Bangladesh Airlines', 110),
(3, 'Sylhet Intl. Airport', 'Chittagong Int. Airport', '2024-03-31 09:00:00', '2024-02-01 10:00:00', 6000, 'Biman Bangladesh Airlines', 60),
(10001, 'Chittagong Int. Airport', 'Shajalal Int. Airport', '2024-03-31 07:00:00', '2024-03-31 08:40:00', 4500, 'Biman Bangladesh Airlines', 100),
(10002, 'Chittagong Int. Airport', 'Shajalal Int. Airport', '2024-03-31 22:00:00', '2024-03-31 23:30:00', 6800, 'Dubai Airways', 90),
(10003, 'Shajalal Int. Airport', 'Shajalal Int. Airport', '2024-03-30 06:45:00', '2024-03-30 07:50:00', 5485, 'Dubai Airways', 65),
(10004, 'Chittagong Int. Airport', 'Shajalal Int. Airport', '2024-04-26 00:00:00', '2024-04-26 01:20:00', 25650, 'Qatar Airways', 80),
(10005, 'Chittagong Int. Airport', 'Shajalal Int. Airport', '2024-03-31 00:00:00', '2024-03-31 01:30:00', 18000, 'Qatar Airways', 90);

-- --------------------------------------------------------

--
-- Table structure for table `passenger`
--

CREATE TABLE `passenger` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `nationality` varchar(50) NOT NULL,
  `passport` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `passenger`
--

INSERT INTO `passenger` (`id`, `user_id`, `first_name`, `last_name`, `nationality`, `passport`, `email`, `contact`) VALUES
(1, 1001, 'Md. Saifur', 'Rahman', 'Bangladeshi', '24236427', 'saifurcuet12@gmail.com', '+045373'),
(2, 1004, 'atanu', 'atana', 'Bangladeshi', '24236427', 'atn@gmaul.com', '57384889');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `method` varchar(30) NOT NULL,
  `account_no` varchar(30) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `ticket_id`, `method`, `account_no`, `contact`, `created_on`) VALUES
(1, 1, 'bKash', '01682104732', '01645299007', '2024-04-21 13:18:56'),
(2, 1, 'bKash', '01682104732', '01645299007', '2024-04-21 13:20:19');

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
  `created_on` datetime DEFAULT current_timestamp(),
  `paid` tinyint(1) NOT NULL DEFAULT 0,
  `payment_id` int(11) NOT NULL,
  `passenger_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `hold` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`id`, `flight_id`, `user_id`, `adult`, `child`, `class`, `seat_no`, `amount`, `created_on`, `paid`, `payment_id`, `passenger_id`, `active`, `hold`) VALUES
(1, 10001, 1001, 1, 1, 'Economy', '', 0, '2024-04-21 11:53:05', 1, 2, 1, 1, 0),
(2, 2, 1004, 1, 2, 'Business', '', 0, '2024-04-21 16:55:25', 0, 0, 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `role` varchar(20) DEFAULT NULL,
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
(1007, 'shimul', '1257', 'passenger.', '', '', '', '', '', ''),
(1009, 'admin', 'admin', NULL, '', '', 'admin@gmail.com', '', '', ''),
(1010, 'test', '326624786', NULL, '', '', 'tes@gmail', '', '', '');

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
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flight`
--
ALTER TABLE `flight`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `passenger`
--
ALTER TABLE `passenger`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
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
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `flight`
--
ALTER TABLE `flight`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10006;

--
-- AUTO_INCREMENT for table `passenger`
--
ALTER TABLE `passenger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1011;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
