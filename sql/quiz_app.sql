-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas generowania: 27 Sie 2018, 23:16
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
  `next_question_group_id` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `qa_answers`
--

INSERT INTO `qa_answers` (`id`, `question_id`, `answer`, `score_A`, `score_I`, `score_C`, `score_P`, `next_question_group_id`, `position`) VALUES
(1, 23, 'red', 0, 0, 0, 0, 'group3', 1),
(2, 23, 'blue', 0, 0, 0, 0, 'group4', 2),
(3, 23, 'green', 0, 0, 0, 0, 'group2', 3),
(4, 23, 'black', 0, 0, 0, 0, 'group1', 4),
(9, 25, '3', 0, 0, 0, 0, 'group3', 1),
(10, 25, '5', 0, 0, 0, 0, 'group2', 3),
(12, 26, 'blue', 0, 0, 0, 0, 'group4', 2),
(13, 26, 'green', 0, 0, 0, 0, 'group2', 3),
(14, 26, 'black', 0, 0, 0, 0, 'group1', 4),
(31, 1, 'no', 0, 0, 0, 0, 'group3', 1),
(32, 1, 'yes', 0, 0, 0, 0, 'group4', 2);

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

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `qa_questions`
--

CREATE TABLE `qa_questions` (
  `id` int(11) NOT NULL,
  `question` varchar(2048) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The Question',
  `group_id` varchar(512) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ID of the group the question belongs to'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `qa_questions`
--

INSERT INTO `qa_questions` (`id`, `question`, `group_id`) VALUES
(1, 'Do you like pancakes ?', 'group1'),
(2, 'The actor John Gielgud believed that of all Shakespeare\'s characters Hamlet is probably the one most like Shakespeare himself–since, of all Shakespeare\'s characters, only Hamlet can be imagined to have written all the Shakespearean plays. How good an understanding of Hamlet\'s character does Gielgud\'s belief reflect?', 'group1'),
(3, 'What is meant by the phrase "the rise of religious fundamentalism"? Is it an actual current phenomenon? If so, what accounts for its occurrence at this point in history?', 'group1'),
(4, 'Your summer vacation–what was it really like?\r\n', 'group2'),
(5, 'What is time?\r\n', 'group3'),
(6, 'What determines what dreams a person has when he or she sleeps?\r\n', 'group3'),
(7, 'Is there intelligent life elsewhere in the universe?\r\n', 'group1'),
(8, 'Arm on the left, arm on the right.  Eye on the left, eye on the right. Nose in the middle. Mouth in the middle. –Why is the outward appearance of the human body so symmetrical?\r\n', 'group4'),
(9, 'What, exactly, is it about good jokes that makes people laugh?\r\n', 'group1'),
(11, '	What is meant by the phrase "the rise of religious fundamentalism"? Is it an actual current phenomenon? If so, what accounts for its occurrence at this point in history?', 'group1'),
(12, 'According to Lord Acton, "Power corrupts and absolute power corrupts absolutely." Comment, taking a historical perspective.\r\n', 'group2'),
(13, 'How does your generation differ from that of the 1960\'s?*\r\n', 'group3'),
(14, 'Walter Kerr has argued that comedy, at bottom, is pessimistic, tragedy optimistic. Is he right?\r\n', 'group3'),
(15, 'Various countries–the United Kingdom, India, Pakistan, Israel, the Philippines–have already elected female chief executives. Why has the U.S., which is arguably the world\'s leading democracy, not yet done so?\r\n', 'group5'),
(16, 'Do human beings have free will?\r\n', 'group4'),
(17, 'How many kilometers length have the earth radius ?', 'group_test'),
(18, 'd', 'group2'),
(19, 'test', 'group_test'),
(21, 'wqeqwewqe', 'qweqweqwe'),
(23, 'What color do you like ?', 'group2'),
(25, 'dqwewqe', 'group_test'),
(26, 'What color do you like ?', 'group2'),
(27, 'How many years old are you ?', 'group9');

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
(4, 1, 3, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `qa_scores`
--

CREATE TABLE `qa_scores` (
  `id` int(11) NOT NULL,
  `name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `dob` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Time and Date',
  `question1_id` int(11) DEFAULT NULL COMMENT 'ID of the question shown',
  `question1_answer_id` int(11) DEFAULT NULL COMMENT 'ID of answer that was chosen',
  `question2_id` int(11) DEFAULT NULL COMMENT 'ID of the question shown',
  `question2_answer_id` int(11) DEFAULT NULL COMMENT 'ID of answer that was chosen',
  `question3_id` int(11) DEFAULT NULL COMMENT 'ID of the question shown',
  `question3_answer_id` int(11) DEFAULT NULL COMMENT 'ID of answer that was chosen',
  `question4_id` int(11) DEFAULT NULL COMMENT 'ID of the question shown',
  `question4_answer_id` int(11) DEFAULT NULL COMMENT 'ID of answer that was chosen',
  `question5_id` int(11) DEFAULT NULL COMMENT 'ID of the question shown',
  `question5_answer_id` int(11) DEFAULT NULL COMMENT 'ID of answer that was chosen',
  `tag1_id` int(11) DEFAULT NULL COMMENT 'ID of tag chosen',
  `tag2_id` int(11) DEFAULT NULL COMMENT 'ID of tag chosen',
  `tag3_id` int(11) DEFAULT NULL COMMENT 'ID of tag chosen',
  `tag4_id` int(11) DEFAULT NULL COMMENT 'ID of tag chosen',
  `tag5_id` int(11) DEFAULT NULL COMMENT 'ID of tag chosen',
  `total_score_A` int(16) NOT NULL COMMENT 'Total addition of the A Score of all Questions and Tags',
  `total_score_I` int(16) NOT NULL COMMENT 'Total addition of the I Score of all Questions and Tags',
  `total_score_C` int(16) NOT NULL COMMENT 'Total addition of the C Score of all Questions and Tags',
  `total_score_P` int(16) NOT NULL COMMENT 'Total addition of the P Score of all Questions and Tags'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `qa_scores`
--

INSERT INTO `qa_scores` (`id`, `name`, `dob`, `gender`, `email`, `timestamp`, `question1_id`, `question1_answer_id`, `question2_id`, `question2_answer_id`, `question3_id`, `question3_answer_id`, `question4_id`, `question4_answer_id`, `question5_id`, `question5_answer_id`, `tag1_id`, `tag2_id`, `tag3_id`, `tag4_id`, `tag5_id`, `total_score_A`, `total_score_I`, `total_score_C`, `total_score_P`) VALUES
(1, 'Test User', '2017-12-11', 'male', 'test@user.com', '2018-08-27 17:54:52', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 1, 2, 3, 4, 5, 200, 175, 140, 60),
(2, 'Test User', '2018-08-14', 'female', 'asdsad@i.ll', '2018-08-27 19:47:04', 1, 31, 1, 31, 1, 31, 1, 31, 1, 31, 3, 3, 3, 3, 3, 0, 0, 0, 0),
(4, 'John', '45-64', 'female', 'test@t.t', '2018-08-27 21:14:41', 9, NULL, 17, NULL, 11, NULL, 4, NULL, 2, NULL, 3, 4, 3, 3, 3, 400, 200, 90, 100);

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
  `image` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `qa_suggestions`
--

INSERT INTO `qa_suggestions` (`id`, `name`, `description`, `score_A`, `score_I`, `score_C`, `score_P`, `image`) VALUES
(1, 'Suggestion 1', 'This is suggestion description.', 22, 7, 5, 0, NULL),
(45, 'Suggestion 2', 'Suggestion text', 25, 100, 30, 45, '0c0c268bf31499b54c027443fb394103.png');

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

--
-- Zrzut danych tabeli `qa_tags`
--

INSERT INTO `qa_tags` (`id`, `name`, `description`, `score_A`, `score_I`, `score_C`, `score_P`) VALUES
(3, 'tag1', 'tag1', 0, 0, 0, 0),
(4, 'tag2', 'TAG2', 0, 0, 0, 0);

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
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1535390422, 1, 'Admin', 'Istrator', 'ADMIN', '0'),
(2, '::1', 'test@test.com', '$2y$08$IrlbOvTg5A7inOIskAKqK.HpqlgDBVqs/Gs6dTG1Xn0M4tos3SY1.', NULL, 'test@test.com', NULL, NULL, NULL, NULL, 1535143031, NULL, 1, 'Test', 'Test', '', '2325345436'),
(3, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', '1admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1268889823, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(5, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', '3admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1268889823, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(6, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', '4admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1268889823, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(7, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', '5admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1268889823, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(8, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin1@admin.com', '', NULL, NULL, NULL, 1268889823, 1268889823, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(9, '::1', 'test1@test.com', '$2y$08$KSHkcBHzjfdb876M7Lakme8kyqrTX4vj9JZ4HLbob6BW.hz2YyAPu', NULL, 'test@test.com', NULL, NULL, NULL, NULL, 1535143031, NULL, 1, 'Test', 'User', '', ''),
(10, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', '6admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1268889823, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(11, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', '7admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1268889823, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(12, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', '8admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1268889823, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(13, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', '9admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1268889823, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(14, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', '10admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1268889823, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(15, '::1', 'j.kowals@gmail.com', '$2y$08$Wz5LsS5RRHjyp9byGEl.lewU27Rv4cAYMhExti2040P0RlevMxN92', NULL, 'j.kowals@gmail.com', NULL, NULL, NULL, NULL, 1535150163, NULL, 1, 'John', 'Kowalski', '', '');

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
(2, 1, 2),
(24, 2, 2),
(29, 3, 1),
(27, 5, 1),
(28, 5, 2),
(30, 6, 1),
(14, 8, 1),
(18, 14, 1),
(19, 14, 2),
(25, 15, 2);

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
-- Indexes for table `qa_ratings`
--
ALTER TABLE `qa_ratings`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT dla tabeli `qa_groups`
--
ALTER TABLE `qa_groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `qa_login_attempts`
--
ALTER TABLE `qa_login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `qa_questions`
--
ALTER TABLE `qa_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT dla tabeli `qa_ratings`
--
ALTER TABLE `qa_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT dla tabeli `qa_scores`
--
ALTER TABLE `qa_scores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT dla tabeli `qa_suggestions`
--
ALTER TABLE `qa_suggestions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT dla tabeli `qa_tags`
--
ALTER TABLE `qa_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT dla tabeli `qa_users`
--
ALTER TABLE `qa_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT dla tabeli `qa_users_groups`
--
ALTER TABLE `qa_users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `qa_users_groups`
--
ALTER TABLE `qa_users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `qa_groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `qa_users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
