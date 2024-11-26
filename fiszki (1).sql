-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Lis 26, 2024 at 12:20 PM
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
-- Database: `fiszki`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorie`
--

CREATE TABLE `kategorie` (
  `id` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kategorie`
--

INSERT INTO `kategorie` (`id`, `id_users`, `name`) VALUES
(1, 1, 'Podstawowe S?owa'),
(2, 1, 'Zaawansowane Wyra?enia');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `paczki`
--

CREATE TABLE `paczki` (
  `id` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paczki`
--

INSERT INTO `paczki` (`id`, `id_users`, `name`) VALUES
(1, 1, '123'),
(2, 1, '6754');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `slowa`
--

CREATE TABLE `slowa` (
  `id` int(11) NOT NULL,
  `id_paczki` int(11) NOT NULL,
  `polski` varchar(255) NOT NULL,
  `angielski` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slowa`
--

INSERT INTO `slowa` (`id`, `id_paczki`, `polski`, `angielski`, `created_at`) VALUES
(1, 1, 'sad', 'fds', '2024-11-26 12:16:41'),
(2, 1, 'sad', 'fds', '2024-11-26 12:16:41'),
(3, 1, 'coś', 'something', '2024-11-26 12:16:47'),
(4, 1, 'coś', 'something', '2024-11-26 12:16:47'),
(5, 1, 'ok', 'okok', '2024-11-26 12:17:09'),
(6, 1, 'ok', 'okok', '2024-11-26 12:17:09'),
(7, 1, 'woda', 'water', '2024-11-26 12:18:02'),
(8, 2, '123', '543', '2024-11-26 12:18:23');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `szczegoly`
--

CREATE TABLE `szczegoly` (
  `id` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_kategorii` int(11) NOT NULL,
  `slowko_polskie` varchar(255) NOT NULL,
  `slowko_angielskie` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `szczegoly`
--

INSERT INTO `szczegoly` (`id`, `id_users`, `id_kategorii`, `slowko_polskie`, `slowko_angielskie`) VALUES
(1, 1, 1, 'kot', 'cat'),
(2, 1, 1, 'pies', 'dog'),
(3, 1, 2, 'przyjaciel', 'friend'),
(4, 1, 2, 'szko?a', 'school');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `is_admin`) VALUES
(1, 'ronaldo7', '202cb962ac59075b964b07152d234b70', 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_users` (`id_users`);

--
-- Indeksy dla tabeli `paczki`
--
ALTER TABLE `paczki`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_users` (`id_users`);

--
-- Indeksy dla tabeli `slowa`
--
ALTER TABLE `slowa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_paczki` (`id_paczki`);

--
-- Indeksy dla tabeli `szczegoly`
--
ALTER TABLE `szczegoly`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_users` (`id_users`),
  ADD KEY `id_kategorii` (`id_kategorii`);

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
-- AUTO_INCREMENT for table `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `paczki`
--
ALTER TABLE `paczki`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `slowa`
--
ALTER TABLE `slowa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `szczegoly`
--
ALTER TABLE `szczegoly`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kategorie`
--
ALTER TABLE `kategorie`
  ADD CONSTRAINT `kategorie_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `paczki`
--
ALTER TABLE `paczki`
  ADD CONSTRAINT `paczki_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `slowa`
--
ALTER TABLE `slowa`
  ADD CONSTRAINT `slowa_ibfk_1` FOREIGN KEY (`id_paczki`) REFERENCES `paczki` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `szczegoly`
--
ALTER TABLE `szczegoly`
  ADD CONSTRAINT `szczegoly_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `szczegoly_ibfk_2` FOREIGN KEY (`id_kategorii`) REFERENCES `kategorie` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
