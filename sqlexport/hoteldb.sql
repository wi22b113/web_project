-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 02, 2023 at 10:18 AM
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
-- Database: `hoteldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `Bookings`
--

CREATE TABLE `Bookings` (
  `id` int(11) NOT NULL,
  `room_category` varchar(50) NOT NULL,
  `arrival_date` date NOT NULL,
  `departure_date` date NOT NULL,
  `booking_state` enum('new','confirmed','cancelled','') NOT NULL,
  `breakfast` tinyint(1) NOT NULL,
  `parking` tinyint(1) NOT NULL,
  `dog` tinyint(1) NOT NULL,
  `user_id_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Posts`
--

CREATE TABLE `Posts` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `picture` varchar(250) NOT NULL,
  `user_id_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `sex` enum('männlich','weiblich','divers','') DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(500) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`id`, `sex`, `firstname`, `lastname`, `email`, `username`, `password`, `admin`) VALUES
(1, '', 'john', 'doe', 'john@gmail.com', 'jonny07', '123456789', 0),
(2, '', 'Thomas', 'Mueller', 'thomas@mueller.com', 'thommi09', '$2y$10$oYjswsUwz8KiQnZpQN.R8..kGL8cp1XVX3.CVszi04tUYNiPwkPDK', 0),
(3, '', 'Julia', 'Berger', 'julia@gmail.com', 'july', '$2y$10$GkSrXxxTW6Z72LA.6.dg5uXZOhI2TXhm8q.NdvC0nEFwKwGjEUKya', 0),
(4, '', 'Paul', 'Peterson', 'paul@peterson.com', 'pauli07', '$2y$10$RoSW/ITNz52Ah/LH9uYY5eFSS5K7DSoAeB/TcqYSq3J49d8dI8FIS', 0),
(5, 'männlich', 'harry', 'potter', 'harry@potter.com', 'harry09', '$2y$10$e7hsQBl56w408yIV78Eq2.lInu1emCeo31oAnYP3O9AIpdFEdFn/C', 0),
(6, 'männlich', 'adminVorname', 'adminNachname', 'admin@gmail.com', 'admin', '$2y$10$ZD5eXkrEM5NkbcoXMqHbf./nGwlvXYvpCL4J0XMj2STFxK8z6pjBe', 1),
(11, '', '', '', 'sdfsdf@sdfsdf.com', '', '$2y$10$5cWuhgvdStVzNLLXZ7xBDucEqSdFU0qPBxDoQhplOvrjegmn0B8uq', 0),
(12, 'männlich', '', '', 'sdfsdf@sdfsdf.com', 'harry10', '$2y$10$gBzHqGNGpQ1kOAHAjibWu.UY.wCZdxO9CnBuUQyMxrEfUknh2ymwy', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Bookings`
--
ALTER TABLE `Bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Posts`
--
ALTER TABLE `Posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Bookings`
--
ALTER TABLE `Bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Posts`
--
ALTER TABLE `Posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
