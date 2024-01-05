-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 04. Jan 2024 um 18:35
-- Server-Version: 10.4.28-MariaDB
-- PHP-Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `hoteldb`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `AT_Bookings_Options`
--

CREATE TABLE `AT_Bookings_Options` (
  `id` int(11) NOT NULL,
  `bookings_id_fk` int(11) NOT NULL,
  `options_id_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `AT_Bookings_Options`
--

INSERT INTO `AT_Bookings_Options` (`id`, `bookings_id_fk`, `options_id_fk`) VALUES
(1, 4, 1),
(2, 4, 2),
(3, 5, 3),
(4, 7, 3),
(5, 8, 1),
(6, 8, 2),
(7, 8, 3),
(8, 9, 1),
(9, 9, 2),
(10, 9, 3),
(11, 10, 1),
(12, 10, 2),
(13, 11, 1),
(14, 11, 2),
(15, 11, 3);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Bookings`
--

CREATE TABLE `Bookings` (
  `id` int(11) NOT NULL,
  `room_id_fk` int(11) NOT NULL,
  `arrival_date` date NOT NULL,
  `departure_date` date NOT NULL,
  `booking_state` enum('neu','bestätigt','storniert','') NOT NULL,
  `booking_datetime` datetime NOT NULL,
  `user_id_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `Bookings`
--

INSERT INTO `Bookings` (`id`, `room_id_fk`, `arrival_date`, `departure_date`, `booking_state`, `booking_datetime`, `user_id_fk`) VALUES
(2, 1, '2024-01-09', '2024-01-17', 'neu', '0000-00-00 00:00:00', 28),
(3, 3, '2024-01-23', '2024-01-24', 'neu', '0000-00-00 00:00:00', 28),
(4, 2, '2024-01-09', '2024-01-12', 'neu', '0000-00-00 00:00:00', 29),
(5, 3, '2024-01-22', '2024-01-23', 'bestätigt', '0000-00-00 00:00:00', 29),
(6, 4, '2024-01-25', '2024-01-28', 'bestätigt', '0000-00-00 00:00:00', 29),
(7, 5, '2024-01-15', '2024-01-17', 'neu', '0000-00-00 00:00:00', 29),
(8, 5, '2024-01-16', '2024-01-18', 'neu', '0000-00-00 00:00:00', 29),
(9, 4, '2024-01-02', '2024-01-03', 'neu', '0000-00-00 00:00:00', 29),
(10, 5, '2024-01-16', '2024-01-17', 'neu', '0000-00-00 00:00:00', 29),
(11, 1, '2024-01-02', '2024-01-04', 'neu', '0000-00-00 00:00:00', 30);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Options`
--

CREATE TABLE `Options` (
  `id` int(11) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `price` decimal(5,2) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `Options`
--

INSERT INTO `Options` (`id`, `designation`, `price`, `quantity`) VALUES
(1, 'Frühstück', 25.00, 100),
(2, 'Parkplatz', 30.00, 100),
(3, 'Hund', 0.00, 100);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Posts`
--

CREATE TABLE `Posts` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `picture` varchar(250) NOT NULL,
  `picture_alt` varchar(100) NOT NULL COMMENT 'Accessibility',
  `date` varchar(50) NOT NULL,
  `user_id_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `Posts`
--

INSERT INTO `Posts` (`id`, `title`, `content`, `picture`, `picture_alt`, `date`, `user_id_fk`) VALUES
(9, 'Ein poem für die Welt', 'Hebstblätter die Erste!', './img/resized/pattern-wallpaper.png', 'Ein poem für die Welt', '', 31),
(10, 'Göthe die Zweite', 'Winterherbst', './img/resized/pexels-craig-adderley-1563356.jpg', 'Göthe die Zweite', '', 31),
(11, 'Das ist das schillernste Gedicht', 'Wenn du verstehst was ich meine', './img/resized/wp2193557.jpg', 'Das ist das schillernste Gedicht', '04.01.2024 17:33', 31),
(12, 'Der beste Post der Welt', 'Zwischen Post-Club-Atmosphäre und elektronischer Dekonstruktión verortet der in Wien lebende Vorarlberger Kenji Araki seinen Sound, der auch international Wellen schlägt. Mit seinem neuen Album „Hope Chess“ dringt er in neue Territorien vor. Im „Krone“-Talk spricht er über Selbstfindung, Spannungsbögen und Intuitionen.', './img/resized/pexels-pixabay-33109_1704387630.jpg', 'Der beste Post der Welt', '04.01.2024 18:00', 31),
(13, 'Das ist der erste post von Matthias', 'Zwischen Post-Club-Atmosphäre und elektronischer Dekonstruktión verortet der in Wien lebende Vorarlberger Kenji Araki seinen Sound, der auch international Wellen schlägt. Mit seinem neuen Album „Hope Chess“ dringt er in neue Territorien vor. Im „Krone“-Talk spricht er über Selbstfindung, Spannungsbögen und Intuitionen.', './img/resized/wallpaperflare.com_wallpaper.jpg', 'Das ist der erste post von Matthias', '04.01.2024 18:01', 33);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Rooms`
--

CREATE TABLE `Rooms` (
  `id` int(11) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `quantity` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `Rooms`
--

INSERT INTO `Rooms` (`id`, `designation`, `price`, `quantity`) VALUES
(1, 'Master Suite', 666.00, 10),
(2, 'Junior Suite', 368.00, 10),
(3, 'Superior Room', 278.00, 10),
(4, 'Luxury Room', 296.00, 10),
(5, 'Luxury Extended Room', 323.00, 10);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Users`
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
-- Daten für Tabelle `Users`
--

INSERT INTO `Users` (`id`, `sex`, `firstname`, `lastname`, `email`, `username`, `password`, `admin`, `active`) VALUES
(28, 'männlich', 'Luke', 'Skywalker', 'luke@skywalker.com', 'luke', '$2y$10$CRVWsm6wn8BggmmvlkZQdedMYlePOmjLC18Kv5aFB0HyLNHmTBwRi', 0, 1),
(29, 'weiblich', 'Leia', 'Skywalker', 'leia@skywalker.com', 'Leia', '$2y$10$76vKClfzxedJo9BPgLwFTuAVqQUVDLCPM4AuMgMw8zuMiczLPrXLC', 0, 1),
(30, 'divers', 'Meister', 'Joda', 'meister@joda.com', 'joda', '$2y$10$iAL203LLWmrxP.S2BRIX7OnQ1C1e2EcFKAkd.qcletycpV1Vfvj6e', 0, 1),
(31, 'divers', 'AdminVorname', 'AdminNachname', 'admin@admin.com', 'admin', '$2y$10$2oECNp2i74nNHnTZRw85iu9H.EdXz86NhMv0OJYGN2c38pkimKG5i', 1, 1),
(32, 'divers', 'Chewbacca', 'Wookie', 'chewi@gmail.com', 'chewi', '$2y$10$n0S0g.GkoTmZ/5abFzbY8ONBHv87daaoiCLkPciqDkvyMo5186ofS', 0, 1),
(33, 'männlich', 'Matthias', 'Teuschl', 'a@b.com', 'matthias', '$2y$10$Wv9rGkYL6/yyuccj4ACFx.NFnQfDZB4tu.sHvyc1H9JQCX9CjSAB2', 1, 1);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `AT_Bookings_Options`
--
ALTER TABLE `AT_Bookings_Options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_id_fk` (`bookings_id_fk`),
  ADD KEY `options_id_fk` (`options_id_fk`);

--
-- Indizes für die Tabelle `Bookings`
--
ALTER TABLE `Bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_fk` (`user_id_fk`),
  ADD KEY `room_id_fk` (`room_id_fk`);

--
-- Indizes für die Tabelle `Options`
--
ALTER TABLE `Options`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `Posts`
--
ALTER TABLE `Posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_fk2` (`user_id_fk`);

--
-- Indizes für die Tabelle `Rooms`
--
ALTER TABLE `Rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `AT_Bookings_Options`
--
ALTER TABLE `AT_Bookings_Options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT für Tabelle `Bookings`
--
ALTER TABLE `Bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT für Tabelle `Options`
--
ALTER TABLE `Options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `Posts`
--
ALTER TABLE `Posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT für Tabelle `Rooms`
--
ALTER TABLE `Rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `AT_Bookings_Options`
--
ALTER TABLE `AT_Bookings_Options`
  ADD CONSTRAINT `bookings_id_fk` FOREIGN KEY (`bookings_id_fk`) REFERENCES `Bookings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `options_id_fk` FOREIGN KEY (`options_id_fk`) REFERENCES `Options` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `Bookings`
--
ALTER TABLE `Bookings`
  ADD CONSTRAINT `room_id_fk` FOREIGN KEY (`room_id_fk`) REFERENCES `Rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id_fk` FOREIGN KEY (`user_id_fk`) REFERENCES `Users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `Posts`
--
ALTER TABLE `Posts`
  ADD CONSTRAINT `user_id_fk2` FOREIGN KEY (`user_id_fk`) REFERENCES `Users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
