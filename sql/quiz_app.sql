-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas generowania: 23 Sie 2018, 20:19
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
-- Struktura tabeli dla tabeli `qa_answers`
--

CREATE TABLE `qa_answers` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer` varchar(2048) COLLATE utf8_unicode_ci NOT NULL,
  `score_A` int(16) NOT NULL,
  `score_I` int(16) NOT NULL,
  `score_C` int(16) NOT NULL,
  `score_P` int(16) NOT NULL,
  `next_question_group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `qa_groups`
--

CREATE TABLE `qa_groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `qa_groups`
--

INSERT INTO `qa_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `qa_login_attempts`
--

CREATE TABLE `qa_login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `qa_login_attempts`
--

INSERT INTO `qa_login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES
(1, '::1', 'admin', 1535047024),
(2, '::1', 'admin', 1535047030),
(3, '::1', 'asd', 1535047036),
(4, '::1', 'sadasdasdas', 1535047046),
(5, '::1', 'admin', 1535047110),
(6, '::1', 'asdas', 1535047114);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `qa_questions`
--

CREATE TABLE `qa_questions` (
  `id` int(11) NOT NULL,
  `question` varchar(2048) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The Question',
  `group_id` int(11) NOT NULL COMMENT 'ID of the group the question belongs to'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `qa_rating`
--

CREATE TABLE `qa_rating` (
  `id` int(11) NOT NULL,
  `suggestion_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `qa_scores`
--

CREATE TABLE `qa_scores` (
  `id` int(11) NOT NULL,
  `name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Time and Date',
  `question1_id` int(11) NOT NULL COMMENT 'ID of the question shown',
  `question1_answer_id` int(11) NOT NULL COMMENT 'ID of answer that was chosen',
  `question2_id` int(11) NOT NULL COMMENT 'ID of the question shown',
  `question2_answer_id` int(11) NOT NULL COMMENT 'ID of answer that was chosen',
  `question3_id` int(11) NOT NULL COMMENT 'ID of the question shown',
  `question3_answer_id` int(11) NOT NULL COMMENT 'ID of answer that was chosen',
  `question4_id` int(11) NOT NULL COMMENT 'ID of the question shown',
  `question4_answer_id` int(11) NOT NULL COMMENT 'ID of answer that was chosen',
  `question5_id` int(11) NOT NULL COMMENT 'ID of the question shown',
  `question5_answer_id` int(11) NOT NULL COMMENT 'ID of answer that was chosen',
  `tag1_id` int(11) NOT NULL COMMENT 'ID of tag chosen',
  `tag2_id` int(11) NOT NULL COMMENT 'ID of tag chosen',
  `tag3_id` int(11) NOT NULL COMMENT 'ID of tag chosen',
  `tag4_id` int(11) NOT NULL COMMENT 'ID of tag chosen',
  `tag5_id` int(11) NOT NULL COMMENT 'ID of tag chosen',
  `total_score_A` int(16) NOT NULL COMMENT 'Total addition of the A Score of all Questions and Tags',
  `total_score_I` int(16) NOT NULL COMMENT 'Total addition of the I Score of all Questions and Tags',
  `total_score_C` int(16) NOT NULL COMMENT 'Total addition of the C Score of all Questions and Tags',
  `total_score_P` int(16) NOT NULL COMMENT 'Total addition of the P Score of all Questions and Tags'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `qa_suggestions`
--

CREATE TABLE `qa_suggestions` (
  `id` int(11) NOT NULL,
  `name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(2048) COLLATE utf8_unicode_ci NOT NULL,
  `score_A` int(16) NOT NULL,
  `score_I` int(16) NOT NULL,
  `score_C` int(16) NOT NULL,
  `score_P` int(16) NOT NULL,
  `image` varchar(512) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `qa_tags`
--

CREATE TABLE `qa_tags` (
  `id` int(11) NOT NULL,
  `name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(2048) COLLATE utf8_unicode_ci NOT NULL,
  `score_A` int(16) NOT NULL,
  `score_I` int(16) NOT NULL,
  `score_C` int(16) NOT NULL,
  `score_P` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `qa_users`
--

CREATE TABLE `qa_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(254) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `qa_users`
--

INSERT INTO `qa_users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1535047360, 1, 'Admin', 'istrator', 'ADMIN', '0');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `qa_users_groups`
--

CREATE TABLE `qa_users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `qa_users_groups`
--

INSERT INTO `qa_users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `qa_answers`
--
ALTER TABLE `qa_answers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `qa_groups`
--
ALTER TABLE `qa_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qa_login_attempts`
--
ALTER TABLE `qa_login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qa_questions`
--
ALTER TABLE `qa_questions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `qa_scores`
--
ALTER TABLE `qa_scores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `qa_suggestions`
--
ALTER TABLE `qa_suggestions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `qa_tags`
--
ALTER TABLE `qa_tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `qa_users`
--
ALTER TABLE `qa_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qa_users_groups`
--
ALTER TABLE `qa_users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `qa_answers`
--
ALTER TABLE `qa_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `qa_groups`
--
ALTER TABLE `qa_groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `qa_login_attempts`
--
ALTER TABLE `qa_login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT dla tabeli `qa_questions`
--
ALTER TABLE `qa_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `qa_scores`
--
ALTER TABLE `qa_scores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `qa_suggestions`
--
ALTER TABLE `qa_suggestions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `qa_tags`
--
ALTER TABLE `qa_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `qa_users`
--
ALTER TABLE `qa_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT dla tabeli `qa_users_groups`
--
ALTER TABLE `qa_users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `qa_users_groups`
--
ALTER TABLE `qa_users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
