-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 10 Sty 2025, 08:21
-- Wersja serwera: 10.4.24-MariaDB
-- Wersja PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `peppers_database`
--
CREATE DATABASE IF NOT EXISTS `peppers_database` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `peppers_database`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `startDate` datetime NOT NULL,
  `endDate` datetime NOT NULL,
  `clientId` int(11) NOT NULL,
  `barberId` int(11) NOT NULL,
  `service` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `bookings`
--

INSERT INTO `bookings` (`id`, `startDate`, `endDate`, `clientId`, `barberId`, `service`, `price`, `status`) VALUES
(87, '2025-01-10 09:00:00', '2025-01-10 09:30:00', 7, 23, 'Strzyżenie włosów', '100.00', 1),
(88, '2025-02-07 12:30:00', '2025-02-07 13:30:00', 7, 20, 'Strzyżenie włosów i zarostu', '130.00', 0),
(89, '2025-03-14 09:00:00', '2025-03-14 10:00:00', 7, 21, 'Repigmentacja zarostu i włosów', '60.00', 0),
(90, '2025-05-14 13:00:00', '2025-05-14 14:00:00', 7, 23, 'Farbowanie', '110.00', 0),
(91, '2025-01-14 14:00:00', '2025-01-14 14:30:00', 13, 20, 'Strzyżenie włosów', '100.00', 0),
(92, '2025-02-12 09:00:00', '2025-02-12 09:30:00', 13, 23, 'Strzyżenie włosów', '100.00', 0),
(93, '2025-06-10 09:00:00', '2025-06-10 09:30:00', 13, 22, 'Strzyżenie włosów', '100.00', 0),
(94, '2025-01-14 10:00:00', '2025-01-14 11:00:00', 5, 20, 'Strzyżenie włosów i zarostu', '130.00', 0),
(95, '2025-01-16 09:00:00', '2025-01-16 10:00:00', 5, 21, 'Farbowanie', '110.00', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `logged_in_users`
--

CREATE TABLE `logged_in_users` (
  `sessionId` varchar(100) NOT NULL,
  `userId` int(11) NOT NULL,
  `lastUpdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `logged_in_users`
--

INSERT INTO `logged_in_users` (`sessionId`, `userId`, `lastUpdate`) VALUES
('kfgnn4iq6e49jfjfaea3mp9gr8', 5, '2025-01-09 22:26:40');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `userName`, `fullName`, `email`, `passwd`, `status`, `date`) VALUES
(2, 'patryk97', 'Patryk Kot', 'patryk@op.pl', '$2y$10$ZrAta4hCCbq4uDy3tpIUoexYk5o2B8BwjuyLQTwjm0E82ppZc6Mmm', 1, '2024-12-10 12:39:38'),
(3, 'kamilx', 'Kamil Bieniek', 'kamil123@wp.com', '$2y$10$St8t5Lpn/lE3UBIvCjS32ue4o.jkaN9pVyQG1zlEs/UVeuQwMGKa.', 1, '2024-12-10 12:56:41'),
(4, 'artuur', 'Artur Kowalski', 'ak47@gmail.com', '$2y$10$pcQ1/lcQA4Ohh6krxUbF/.XghjHY7aTJ3oXowkYKyIkbslsXA2d16', 1, '2024-12-28 20:59:34'),
(5, 'jankoos', 'Jakub Jankowski', 'jankowski@op.pl', '$2y$10$MTUQOA1ZJISd10aXslCAi.afc9Eq9YV3qDtRgxqXKMe7xj1EQvAIW', 1, '2024-12-28 21:26:38'),
(7, 'klient1', 'Jan Kowalski', 'kowalski@gmail.com', '$2y$10$QEzVnbO8j2xL1ur.yVgiJOP4TcMGxydJmd6QmYnxcucD9YH2rIBt6', 1, '2024-12-28 23:06:28'),
(10, 'admin1', 'Admin aplikacji', 'admin@peppers.pl', '$2y$10$36U6dMWGRShNByxuJGdABObGNH3/81Mgw3NmJjrIIoAa3DBkeQRkS', 3, '2024-12-29 16:20:31'),
(13, 'hubert123', 'Hubert Jędruchniewicz', 'hubertj@interia.pl', '$2y$10$XmUgFY4ZMSO.TLaxGyeA0efQxv8ELxEKRhCWluaSw08T0haV4OhzK', 1, '2024-12-31 14:10:10'),
(20, 'barber1', 'Tomek', 'tomek@peppers.pl', '$2y$10$SZEP52kcEeSXaF3CxkfNz.j89pToL7V/xoHuu6mZ/T8qTY26Fo1t6', 2, '2025-01-01 23:13:27'),
(21, 'barber2', 'Louis', 'louis@peppers.pl', '$2y$10$LJ83/CARoqguM93TbJeH7eFkxQvZfj4tAOAj1qm147IxZ0aXJCygK', 2, '2025-01-01 23:16:54'),
(22, 'barber3', 'Bartek', 'bartek@peppers.pl', '$2y$10$Nwwi7eyDKLv.miz0mwfmyOXPsC6wsoz8xAT2umNJjfFa8QHfGm43O', 2, '2025-01-01 23:16:54'),
(23, 'barber4', 'Damian', 'damian@peppers.pl', '$2y$10$q8mg5ukbPZbTVOGnFfnthuADqI4vqnGIcQrVhkynqXVvzyRBSUu9q', 2, '2025-01-01 23:19:42'),
(89, 'olek667', 'Aleksander Pusch', 'olekolek@wp.pl', '$2y$10$5VjmZlIeujv/Id2yP2OnZet1gwybnnNJiOfkcqBm3W/DP.qnC5buq', 1, '2025-01-09 22:14:17');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clientId` (`clientId`),
  ADD KEY `barberId` (`barberId`);

--
-- Indeksy dla tabeli `logged_in_users`
--
ALTER TABLE `logged_in_users`
  ADD PRIMARY KEY (`sessionId`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userName` (`userName`,`email`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`clientId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`barberId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
