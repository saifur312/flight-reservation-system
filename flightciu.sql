-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2024 at 05:26 AM
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
(4, 'Dubai Airways', '400', '+045373'),
(5, 'Emirates', '600', '+993729');

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
  `duration` int(11) NOT NULL,
  `class` varchar(20) NOT NULL DEFAULT 'Economy'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flight`
--

INSERT INTO `flight` (`id`, `source`, `destination`, `departure`, `arrival`, `price`, `airline`, `duration`, `class`) VALUES
(1, 'Shajalal Int. Airport', 'Chittagong Int. Airport', '2024-03-30 07:00:00', '2024-03-30 07:30:00', 7000, 'Biman Bangladesh Airlines', 30, 'Economy'),
(2, 'Chittagong Int. Airport', 'Shajalal Int. Airport', '2024-03-31 20:00:00', '2024-03-31 21:50:00', 8650, 'Biman Bangladesh Airlines', 110, 'Business'),
(3, 'Sylhet Intl. Airport', 'Chittagong Int. Airport', '2024-03-31 09:00:00', '2024-02-01 10:00:00', 6000, 'Biman Bangladesh Airlines', 60, 'Economy'),
(10001, 'Chittagong Int. Airport', 'Shajalal Int. Airport', '2024-03-31 07:00:00', '2024-03-31 08:40:00', 4500, 'Biman Bangladesh Airlines', 100, 'Economy'),
(10002, 'Chittagong Int. Airport', 'Shajalal Int. Airport', '2024-03-31 22:00:00', '2024-03-31 23:30:00', 6800, 'Dubai Airways', 90, 'Business'),
(10003, 'Shajalal Int. Airport', 'Shajalal Int. Airport', '2024-03-30 06:45:00', '2024-03-30 07:50:00', 5485, 'Dubai Airways', 65, 'Economy'),
(10004, 'Chittagong Int. Airport', 'Shajalal Int. Airport', '2024-04-26 00:00:00', '2024-04-26 01:20:00', 25650, 'Qatar Airways', 80, 'Business'),
(10005, 'Chittagong Int. Airport', 'Shajalal Int. Airport', '2024-03-31 00:00:00', '2024-03-31 01:30:00', 18000, 'Qatar Airways', 90, 'Economy'),
(10006, 'Sylhet Intl. Airport', 'Coxbazar Int. Arrport', '2024-05-12 09:00:00', '2024-05-12 11:30:00', 25000, 'Qatar Airways', 150, 'Business');

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
(2, 1004, 'atanu', 'atana', 'Bangladeshi', '24236427', 'atn@gmaul.com', '57384889'),
(3, 1001, 'kara', 'khan', 'usa', '12qwrqetwry4135426', 'masakonoor@gmail.com', '+880165378282'),
(4, 1001, 'kara', 'khan', 'usa', '12qwrqetwry4135426', 'masakonoor@gmail.com', '+880165378282'),
(5, 1001, 'kara', 'khan', 'usa', '12qwrqetwry4135426', 'masakonoor@gmail.com', '+880165378282'),
(6, 1001, 'kara', 'khan', 'usa', '12qwrqetwry4135426', 'masakonoor@gmail.com', '+880165378282'),
(7, 1001, 'kara', 'khan', 'usa', '12qwrqetwry4135426', 'masakonoor@gmail.com', '+880165378282'),
(8, 1001, 'gfgjcc', 'ggcgkh', 'ghfghc', 'hgfghfkf', 'fuyfuf@gmai.com', 'jhvjghcgc'),
(9, 1001, 'kara', 'khan', 'usa', '12qwrqetwry4135426', 'masakonoor@gmail.com', '+880165378282'),
(10, 1001, 'kara', 'khan', 'usa', '12qwrqetwry4135426', 'masakonoor@gmail.com', '+880165378282'),
(11, 1001, 'kara', 'khan', 'usa', '12qwrqetwry4135426', 'masakonoor@gmail.com', '9075324626'),
(12, 1001, 'kara', 'khan', 'usa', '12qwrqetwry4135426', 'masakonoor@gmail.com', '+880165378282'),
(13, 1001, 'kara', 'khan', 'usa', '12qwrqetwry4135426', 'masakonoor@gmail.com', '+880165378282'),
(14, 1001, 'kara', 'khan', 'usa', '12qwrqetwry4135426', 'masakonoor@gmail.com', '+880165378282'),
(15, 1001, 'kara', 'khan', 'usa', '12qwrqetwry4135426', 'masakonoor@gmail.com', '+880165378282'),
(16, 1001, 'kara', 'khan', 'usa', '12qwrqetwry4135426', 'masakonoor@gmail.com', '+880165378282'),
(17, 1001, 'kara', 'khan', 'usa', '12qwrqetwry4135426', 'masakonoor@gmail.com', '+880165378282'),
(18, 1001, 'kara', 'khan', 'usa', '12qwrqetwry4135426', 'masakonoor@gmail.com', '+880165378282'),
(19, 1001, 'kara', 'khan', 'usa', '12qwrqetwry4135426', 'masakonoor@gmail.com', '+880165378282'),
(20, 1001, 'kara', 'khan', 'usa', '12qwrqetwry4135426', 'masakonoor@gmail.com', '+880165378282'),
(21, 1001, 'kara', 'khan', 'usa', '12qwrqetwry4135426', 'masakonoor@gmail.com', '+880165378282'),
(22, 1001, 'kara', 'khan', 'usa', '12qwrqetwry4135426', 'masakonoor@gmail.com', '+880165378282'),
(23, 1001, 'kara', 'khan', 'usa', '12qwrqetwry4135426', 'masakonoor@gmail.com', '+880165378282'),
(24, 1001, 'kara', 'khan', 'usa', '12qwrqetwry4135426', 'masakonoor@gmail.com', '+880165378282'),
(25, 1001, 'kara', 'khan', 'usa', '12qwrqetwry4135426', 'masakonoor@gmail.com', '+880165378282'),
(26, 1001, 'kara', 'khan', 'usa', '12qwrqetwry4135426', 'masakonoor@gmail.com', '9075324626'),
(27, 1001, 'kara', 'khan', 'usa', '12qwrqetwry4135426', 'masakonoor@gmail.com', '9075324626'),
(28, 1001, 'sarah', 'khan', 'use', 'knahsdkjajkdbnhag', 'sarahkhan@gmail.com', '018000000'),
(29, 1001, 'sarah', 'khan', 'use', 'knahsdkjajkdbnhag', 'sarahkhan@gmail.com', '018000000'),
(30, 1001, 'sarah', 'khan', 'use', 'knahsdkjajkdbnhag', 'sarahkhan@gmail.com', '018000000'),
(31, 1001, 'sarah', 'khan', 'use', 'xbkjsdfnadj21038', 'sarahkhan@gmail.com', '01800000000'),
(32, 1001, 'sarah', 'khan', 'use', 'xbkjsdfnadj21038', 'sarahkhan@gmail.com', '01800000000'),
(33, 1001, 'sarah', 'khan', 'use', 'xbkjsdfnadj21038', 'sarahkhan@gmail.com', '01800000000'),
(34, 1001, 'sarah', 'khan', 'use', 'xbkjsdfnadj21038', 'sarahkhan@gmail.com', '01800000000'),
(35, 1001, 'ayesha', 'khan', 'usa', 'ajdsiua238719723', 'ayesha@gmail.com', '019000000'),
(36, 1001, 'ayesha', 'khan', 'usa', 'ajdsiua238719723', 'ayesha@gmail.com', '019000000'),
(37, 1001, 'sarah', 'khan', 'usa', 'dsedjyf32425436', 'sarah@gmail.com', '0180000000'),
(38, 1001, 'sarah', 'khan', 'usa', 'abcde893893', 'sarah@gmail.com', '01700000000'),
(39, 1001, 'sarah', 'khan', 'usa', 'fdswhgfhfshjgwj', 'sarah@gmail.com', '017000000'),
(40, 1001, 'sara', 'noor', 'usa', 'sadjhbasjlhbaslj', 'sarah@gmail.com', '01800000000'),
(41, 1001, 'sara', 'khan', 'usa', '12qwrqetwry4135426', 'sara@gmail.com', '9075324626'),
(42, 1004, 'Auvee', 'Auvee', 'BD', '78365723', 'ovi@gmail.com', '2378562'),
(43, 1011, 'Rabbi', 'Rahman', 'use', '78365723', 'sarahkhan@gmail.com', '2378562');

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
(2, 1, 'bKash', '01682104732', '01645299007', '2024-04-21 13:20:19'),
(3, 3, 'bKash', '', '', '2024-04-22 23:27:11'),
(4, 10, 'bKash', '', '', '2024-05-05 14:46:00'),
(5, 11, 'bKash', '23873287', '23yt2673', '2024-05-05 17:55:53'),
(6, 12, 'bKash', '156151', '551', '2024-05-08 22:41:46'),
(7, 17, 'bKash', '123456788', '57384889', '2024-05-10 22:49:49');

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
  `seat_no` varchar(50) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT current_timestamp(),
  `paid` tinyint(1) NOT NULL DEFAULT 0,
  `payment_id` int(11) DEFAULT NULL,
  `passenger_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `hold` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`id`, `flight_id`, `user_id`, `adult`, `child`, `class`, `seat_no`, `amount`, `created_on`, `paid`, `payment_id`, `passenger_id`, `active`, `hold`) VALUES
(1, 10001, 1001, 1, 1, 'Economy', '', 0, '2024-04-21 11:53:05', 1, 2, 1, 1, 0),
(2, 2, 1004, 1, 2, 'Business', '', 0, '2024-04-21 16:55:25', 0, 0, 2, 1, 1),
(3, 10001, 1001, 1, 0, 'Economy', NULL, 0, '2024-04-22 23:22:22', 1, 3, 25, 1, 0),
(4, 3, 1001, 1, 0, 'Economy', NULL, 0, '2024-04-22 23:25:58', 0, NULL, 26, 1, 1),
(5, 3, 1001, 1, 0, 'Economy', NULL, 0, '2024-04-22 23:26:01', 0, NULL, 27, 1, 1),
(6, 10001, 1001, 1, 0, 'Economy', NULL, 0, '2024-04-28 23:09:53', 0, NULL, 36, 1, 1),
(7, 10001, 1001, 1, 0, 'Economy', NULL, 0, '2024-05-03 17:43:57', 0, NULL, 37, 1, 1),
(8, 10005, 1001, 1, 0, 'Economy', NULL, 0, '2024-05-03 23:26:37', 0, NULL, 38, 1, 1),
(9, 10001, 1001, 1, 0, 'Economy', NULL, 0, '2024-05-04 13:03:23', 0, NULL, 39, 1, 1),
(10, 10002, 1001, 6, 4, 'Economy', NULL, 0, '2024-05-05 14:31:50', 1, 4, 40, 1, 0),
(11, 10001, 1001, 12, 6, 'Economy', NULL, 0, '2024-05-05 17:47:31', 1, 5, 41, 1, 0),
(12, 10002, 1004, 1, 0, 'Economy', NULL, 0, '2024-05-08 22:40:57', 1, 6, 42, 1, 0),
(13, 10002, 1011, 1, 0, 'Economy', NULL, 0, '2024-05-09 04:33:35', 0, NULL, 1, 1, 1),
(14, 10002, 1011, 1, 0, 'Economy', NULL, 0, '2024-05-09 04:34:21', 0, NULL, 1, 1, 1),
(15, 3, 1011, 1, 0, 'Economy', NULL, 0, '2024-05-09 04:36:02', 0, NULL, 43, 1, 1),
(16, 10001, 1011, 1, 0, 'Economy', NULL, 0, '2024-05-09 14:19:50', 0, NULL, 1, 1, 1),
(17, 10005, 1001, 2, 1, 'Economy', NULL, 48600, '2024-05-10 02:14:31', 1, 7, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `passport` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `passport`) VALUES
(1001, 'sana', 'sana123', '', ''),
(1002, 'saifur312', '12345678', '', ''),
(1003, 'maan23', '876543', '', ''),
(1005, 'Atanu', '12345', 'atn@gmaul.com', ''),
(1006, 'fara', 'f4566', 'fara@gmail.com', ''),
(1007, 'shimul', '1257', '', ''),
(1009, 'admin', 'admin', 'admin@gmail.com', ''),
(1011, 'ovi', 'ovi123456', 'ovi@gmail.com', '');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10007;

--
-- AUTO_INCREMENT for table `passenger`
--
ALTER TABLE `passenger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1013;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
