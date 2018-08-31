-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas generowania: 31 Sie 2018, 23:49
-- Wersja serwera: 5.7.22-0ubuntu0.16.04.1
-- Wersja PHP: 5.6.37-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `quiz_app`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `qa_ratings`
--

CREATE TABLE `qa_ratings` (
  `id` int(11) NOT NULL,
  `suggestion_id` int(11) NOT NULL,
  `score_id` int(11) NOT NULL,
  `rating` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `qa_ratings`
--

INSERT INTO `qa_ratings` (`id`, `suggestion_id`, `score_id`, `rating`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 0),
(4, 1, 3, 0),
(6, 1, 12, 0),
(12, 1, 13, 1),
(5, 45, 12, 1),
(13, 45, 13, 0),
(7, 46, 12, 1),
(14, 46, 13, 0),
(8, 47, 12, 1),
(15, 47, 13, 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `qa_ratings`
--
ALTER TABLE `qa_ratings`
  ADD PRIMARY KEY (`suggestion_id`,`score_id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `qa_ratings`
--
ALTER TABLE `qa_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
