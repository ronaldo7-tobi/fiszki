-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2024 at 02:24 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quizlet`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `paczki`
--

CREATE TABLE `paczki` (
  `id_paczki` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nazwa_paczki` varchar(255) NOT NULL,
  `is_archived` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paczki`
--

INSERT INTO `paczki` (`id_paczki`, `user_id`, `nazwa_paczki`, `is_archived`) VALUES
(1, 1, '123', 0),
(2, 1, '6754', 0),
(3, 1, 'jkhsejkdfh', 0),
(4, 1, 'Moje placki', 0),
(21, 1, 'pakiet', 0),
(22, 9, 'test', 0),
(23, 10, 'gyat', 0),
(24, 10, 'testieren', 0),
(25, 11, 'pakiet2', 0),
(26, 11, 'pakiet2', 0),
(27, 11, 'drop database quizlet;', 0),
(28, 11, '2', 0),
(29, 1, 'pakiet2', 0),
(30, 1, 'pakiet2', 0),
(31, 1, 'pakiet2', 0),
(32, 1, 'pakiet2', 0),
(33, 1, 'pakiet2', 0),
(34, 1, 'pakiet2', 0),
(35, 1, 'pakiet2', 0),
(36, 1, 'KKK', 0),
(37, 1, 'KKK', 0),
(38, 1, 'KKK', 0),
(39, 1, 'KKK', 0),
(40, 1, 'KKK', 0),
(41, 1, 'KKK', 0),
(42, 1, 'KKK', 0),
(43, 1, 'KKK', 0),
(44, 1, 'KKK', 0),
(45, 1, 'KKK', 0),
(46, 1, 'KKK', 0),
(47, 1, 'KKK', 0),
(48, 1, 'KKK', 0),
(49, 1, 'KKK', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `slowa`
--

CREATE TABLE `slowa` (
  `id_slowa` int(11) NOT NULL,
  `id_paczki` int(11) NOT NULL,
  `polski` varchar(255) NOT NULL,
  `angielski` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slowa`
--

INSERT INTO `slowa` (`id_slowa`, `id_paczki`, `polski`, `angielski`) VALUES
(1, 1, 'sad', 'fds'),
(2, 1, 'sad', 'fds'),
(3, 1, 'coś', 'something'),
(4, 1, 'coś', 'something'),
(5, 1, 'ok', 'okok'),
(6, 1, 'ok', 'okok'),
(7, 1, 'woda', 'water'),
(8, 2, '123', '543'),
(9, 3, 'coś', 'something'),
(10, 4, 'placek', 'cake'),
(11, 1, 'woter', 'water'),
(12, 1, 'wuda', 'vodka'),
(13, 1, 'wiski', 'whiskey'),
(14, 4, 'czemó', 'why'),
(15, 21, 'pies', 'dog'),
(16, 21, 'kot', 'cat'),
(17, 22, 'A', 'A'),
(18, 22, 'A', 'A'),
(19, 22, 'A', 'A'),
(20, 22, 'A', 'A'),
(21, 22, 'A', 'A'),
(22, 23, '123', '123'),
(23, 23, '123', '123'),
(24, 23, '123', '123'),
(25, 23, '123', '123'),
(26, 23, '123', '123'),
(27, 23, '123', '123'),
(28, 23, '123', '123'),
(29, 23, '123', '123'),
(30, 23, '123', '123'),
(31, 23, '123', '123'),
(32, 23, '123', '123'),
(33, 23, '123', '123'),
(34, 24, 'pozdto', 'greeting'),
(35, 26, 'pies', 'dog'),
(36, 26, 'kasa', 'hajs'),
(37, 27, 'najs', 'as');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `login`, `password`, `is_admin`) VALUES
(1, 'ronaldo@gmail,com', 'ronaldo7', '123', 1),
(2, '', '', '', 0),
(4, 'danielteslak@gmail.com', 'teslak', '123', 0),
(6, 'bartosz@gmail.com', 'bartek', '123', 0),
(9, 'Å‚ukaszorsperminator@gmail.com', 'Character.Ai', '123', 0),
(10, 'dfgh@dfg', 'zimowyarc', '123', 0),
(11, 'tobiaszszerszesz@gmail.com', 'SzyrszeÅ„', 'Makapaka', 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `paczki`
--
ALTER TABLE `paczki`
  ADD PRIMARY KEY (`id_paczki`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `slowa`
--
ALTER TABLE `slowa`
  ADD PRIMARY KEY (`id_slowa`),
  ADD KEY `id_paczki` (`id_paczki`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `paczki`
--
ALTER TABLE `paczki`
  MODIFY `id_paczki` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `slowa`
--
ALTER TABLE `slowa`
  MODIFY `id_slowa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `paczki`
--
ALTER TABLE `paczki`
  ADD CONSTRAINT `paczki_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `slowa`
--
ALTER TABLE `slowa`
  ADD CONSTRAINT `slowa_ibfk_1` FOREIGN KEY (`id_paczki`) REFERENCES `paczki` (`id_paczki`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
