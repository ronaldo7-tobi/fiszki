-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Lis 13, 2024 at 04:55 PM
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
-- Struktura tabeli dla tabeli `words`
--

CREATE TABLE `words` (
  `id` int(11) DEFAULT NULL,
  `polski` varchar(255) NOT NULL,
  `angielski` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `words`
--

INSERT INTO `words` (`id`, `polski`, `angielski`) VALUES
(1, 'dom', 'house'),
(2, 'samochód', 'car'),
(3, 'książka', 'book'),
(4, 'komputer', 'computer'),
(5, 'telefon', 'phone'),
(6, 'pies', 'dog'),
(7, 'kot', 'cat'),
(8, 'jedzenie', 'food'),
(9, 'woda', 'water'),
(10, 'miłość', 'love'),
(11, 'szkoła', 'school'),
(12, 'praca', 'work'),
(13, 'dziecko', 'child'),
(14, 'mężczyzna', 'man'),
(15, 'kobieta', 'woman'),
(16, 'miasto', 'city'),
(17, 'kraj', 'country'),
(18, 'rodzina', 'family'),
(19, 'przyjaciel', 'friend'),
(20, 'nauczyciel', 'teacher'),
(21, 'student', 'student'),
(22, 'komputerowy', 'computer (adj)'),
(23, 'ładny', 'pretty'),
(24, 'brzydki', 'ugly'),
(25, 'duży', 'big'),
(26, 'mały', 'small'),
(27, 'ciepły', 'warm'),
(28, 'zimny', 'cold'),
(29, 'gorący', 'hot'),
(30, 'zdrowy', 'healthy'),
(31, 'chory', 'sick'),
(32, 'szybki', 'fast'),
(33, 'wolny', 'slow'),
(34, 'silny', 'strong'),
(35, 'słaby', 'weak'),
(36, 'młody', 'young'),
(37, 'stary', 'old'),
(38, 'nowy', 'new'),
(39, 'stary', 'old'),
(40, 'dobry', 'good'),
(41, 'zły', 'bad'),
(42, 'prawda', 'truth'),
(43, 'kłamstwo', 'lie'),
(44, 'radość', 'joy'),
(45, 'smutek', 'sadness'),
(46, 'przyjemność', 'pleasure'),
(47, 'ból', 'pain'),
(48, 'sukces', 'success'),
(49, 'porażka', 'failure'),
(50, 'siła', 'strength'),
(51, 'odwaga', 'courage'),
(52, 'nadzieja', 'hope'),
(53, 'strach', 'fear'),
(54, 'niepokój', 'anxiety'),
(55, 'szczęście', 'happiness'),
(56, 'złość', 'anger'),
(57, 'pokój', 'peace'),
(58, 'wojna', 'war'),
(59, 'miłość', 'love'),
(60, 'nienawiść', 'hate'),
(61, 'marzenie', 'dream'),
(62, 'rzeczywistość', 'reality'),
(63, 'fantazja', 'fantasy'),
(64, 'historia', 'history'),
(65, 'literatura', 'literature'),
(66, 'muzyka', 'music'),
(67, 'sztuka', 'art'),
(68, 'film', 'movie'),
(69, 'teatr', 'theater'),
(70, 'język', 'language'),
(71, 'książka', 'book'),
(72, 'czas', 'time'),
(73, 'przestrzeń', 'space'),
(74, 'powietrze', 'air'),
(75, 'ziemia', 'earth'),
(76, 'słońce', 'sun'),
(77, 'księżyc', 'moon'),
(78, 'gwiazda', 'star'),
(79, 'chmura', 'cloud'),
(80, 'deszcz', 'rain'),
(81, 'śnieg', 'snow'),
(82, 'wiatr', 'wind'),
(83, 'góra', 'mountain'),
(84, 'rzeka', 'river'),
(85, 'jezioro', 'lake'),
(86, 'morze', 'sea'),
(87, 'ocean', 'ocean'),
(88, 'plaża', 'beach'),
(89, 'las', 'forest'),
(90, 'pole', 'field'),
(91, 'ogród', 'garden'),
(92, 'miasto', 'town'),
(93, 'wioska', 'village'),
(94, 'zamek', 'castle'),
(95, 'most', 'bridge'),
(96, 'ulica', 'street'),
(97, 'szkoła', 'school'),
(98, 'sklep', 'shop'),
(99, 'restauracja', 'restaurant'),
(100, 'szpital', 'hospital');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
