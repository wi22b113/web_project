-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 21, 2023 at 07:56 PM
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
-- Table structure for table `AT_Bookings_Options`
--

CREATE TABLE `AT_Bookings_Options` (
  `id` int(11) NOT NULL,
  `bookings_id_fk` int(11) NOT NULL,
  `options_id_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Bookings`
--

CREATE TABLE `Bookings` (
  `id` int(11) NOT NULL,
  `room_id_fk` int(11) NOT NULL,
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
-- Table structure for table `Options`
--

CREATE TABLE `Options` (
  `id` int(11) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `price` decimal(5,2) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Options`
--

INSERT INTO `Options` (`id`, `designation`, `price`, `quantity`) VALUES
(1, 'Frühstück', 25.00, 100),
(2, 'Parkplatz', 30.00, 100),
(3, 'Dog', 0.00, 100);

-- --------------------------------------------------------

--
-- Table structure for table `Posts`
--

CREATE TABLE `Posts` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `picture` varchar(250) NOT NULL,
  `picture_alt` varchar(100) NOT NULL COMMENT 'Accessibility',
  `user_id_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Rooms`
--

CREATE TABLE `Rooms` (
  `id` int(11) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `quantity` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Rooms`
--

INSERT INTO `Rooms` (`id`, `designation`, `price`, `quantity`) VALUES
(1, 'Master Suite', 666.00, 10),
(2, 'Junior Suite', 368.00, 10),
(3, 'Superior Room', 278.00, 10),
(4, 'Luxury Room', 296.00, 10),
(5, 'Luxury Extended Room', 323.00, 10);

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
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`id`, `sex`, `firstname`, `lastname`, `email`, `username`, `password`, `admin`, `active`) VALUES
(28, 'männlich', 'Luke', 'Skywalker', 'luke@skywalker.com', 'luke', '$2y$10$CRVWsm6wn8BggmmvlkZQdedMYlePOmjLC18Kv5aFB0HyLNHmTBwRi', 0, 1),
(29, 'weiblich', 'Leia', 'Skywalker', 'leia@skywalker.com', 'Leia', '$2y$10$76vKClfzxedJo9BPgLwFTuAVqQUVDLCPM4AuMgMw8zuMiczLPrXLC', 0, 1),
(30, 'divers', 'Meister', 'Joda', 'meister@joda.com', 'joda', '$2y$10$iAL203LLWmrxP.S2BRIX7OnQ1C1e2EcFKAkd.qcletycpV1Vfvj6e', 0, 1),
(31, 'divers', 'AdminVorname', 'AdminNachname', 'admin@admin.com', 'admin', '$2y$10$2oECNp2i74nNHnTZRw85iu9H.EdXz86NhMv0OJYGN2c38pkimKG5i', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `AT_Bookings_Options`
--
ALTER TABLE `AT_Bookings_Options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_id_fk` (`bookings_id_fk`),
  ADD KEY `options_id_fk` (`options_id_fk`);

--
-- Indexes for table `Bookings`
--
ALTER TABLE `Bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_fk` (`user_id_fk`),
  ADD KEY `room_id_fk` (`room_id_fk`);

--
-- Indexes for table `Options`
--
ALTER TABLE `Options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Posts`
--
ALTER TABLE `Posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_fk2` (`user_id_fk`);

--
-- Indexes for table `Rooms`
--
ALTER TABLE `Rooms`
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
-- AUTO_INCREMENT for table `AT_Bookings_Options`
--
ALTER TABLE `AT_Bookings_Options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Bookings`
--
ALTER TABLE `Bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Options`
--
ALTER TABLE `Options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Posts`
--
ALTER TABLE `Posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Rooms`
--
ALTER TABLE `Rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `AT_Bookings_Options`
--
ALTER TABLE `AT_Bookings_Options`
  ADD CONSTRAINT `bookings_id_fk` FOREIGN KEY (`bookings_id_fk`) REFERENCES `Bookings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `options_id_fk` FOREIGN KEY (`options_id_fk`) REFERENCES `Options` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Bookings`
--
ALTER TABLE `Bookings`
  ADD CONSTRAINT `room_id_fk` FOREIGN KEY (`room_id_fk`) REFERENCES `Rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id_fk` FOREIGN KEY (`user_id_fk`) REFERENCES `Users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Posts`
--
ALTER TABLE `Posts`
  ADD CONSTRAINT `user_id_fk2` FOREIGN KEY (`user_id_fk`) REFERENCES `Users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
