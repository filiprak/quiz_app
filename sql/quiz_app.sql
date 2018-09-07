-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Czas generowania: 07 Wrz 2018, 11:38
-- Wersja serwera: 10.1.35-MariaDB
-- Wersja PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
(31, 1, 'This time it\'s buisness', 25, 25, 25, 25, 'group2', 1),
(32, 1, 'Live like a local', 25, 25, 25, 25, 'group3', 2),
(41, 4, 'Me is plenty', 25, 25, 25, 25, 'BA', 1),
(42, 4, 'My business partner', 25, 25, 25, 25, 'BA', 2),
(43, 4, 'Partners in crime', 25, 25, 25, 25, 'BA', 3),
(44, 4, 'The whole business crew', 25, 25, 25, 25, 'BA', 4),
(45, 5, 'Me and myself', 25, 25, 25, 25, 'AL', 1),
(46, 5, 'My partner in crime', 25, 25, 25, 25, 'FR', 2),
(47, 5, 'My better half', 25, 25, 25, 25, 'CO', 3),
(48, 5, 'Family Feud', 25, 25, 25, 25, 'FA', 4),
(49, 1, 'Break my normal routine', 25, 25, 25, 25, 'group4', 3),
(50, 1, 'Spend time with people I care about', 25, 25, 25, 25, 'group4', 4),
(51, 6, 'Fine Dining(C,I)', 0, 50, 120, 30, 'AL', 1),
(52, 6, 'Sightseeing(I,P)', 0, 120, 30, 50, 'AL', 2),
(53, 6, 'Relaxing(P,C)', 0, 30, 50, 120, 'AL', 3),
(54, 6, 'The unexpected(A,P)', 120, 30, 0, 50, 'AL', 4),
(59, 8, 'Sleeping Bag (A,P)', 120, 30, 0, 50, 'BA', 1),
(60, 8, 'Simple Backpack (P,A)', 50, 30, 0, 120, 'BA', 2),
(61, 8, 'The right size for the trip (I,C)', 0, 120, 50, 30, 'BA', 3),
(62, 8, 'One with wheels (C,I)', 0, 50, 120, 30, 'BA', 4),
(71, 12, 'Cocktail (P,I)', 0, 50, 30, 120, 'AL', 1),
(72, 12, 'Herbal Tea (I,C)', 0, 120, 50, 30, 'AL', 2),
(73, 12, 'Red Wine (C,I)', 0, 50, 120, 30, 'AL', 3),
(74, 12, 'Craft Brew (A,P)', 120, 30, 0, 50, 'AL', 4),
(75, 13, 'Dress Shoes (C,I)', 0, 50, 120, 30, 'AL', 1),
(76, 13, 'Runners (P,A)', 50, 30, 0, 120, 'AL', 2),
(77, 13, 'Need all kind (I,P)', 0, 120, 30, 50, 'AL', 3),
(78, 13, 'Flip Flops (A,P)', 120, 30, 0, 50, 'AL', 4),
(79, 14, 'Thailand (A,I)', 120, 50, 0, 30, 'BA', 1),
(80, 14, 'London (C,I)', 0, 50, 120, 30, 'BA', 2),
(81, 14, 'Paris (I,C)', 0, 120, 50, 30, 'BA', 3),
(82, 14, 'Mexico (P,A)', 50, 30, 0, 120, 'BA', 4),
(83, 15, 'My best friend (P,A)', 50, 30, 0, 120, 'FR', 1),
(84, 15, 'Ellen (I,C)', 0, 120, 50, 30, 'FR', 2),
(85, 15, 'Obama (C,I)', 0, 50, 120, 30, 'FR', 3),
(86, 15, 'Me is plenty (A,P)', 120, 30, 0, 50, 'FR', 4),
(91, 17, 'Relaxing and lay on the beach (P)', 20, 30, 30, 120, 'AL', 1),
(92, 17, 'Making new friends (A)', 120, 40, 0, 40, 'AL', 2),
(93, 17, 'Discovering  a city (I)', 30, 120, 20, 30, 'AL', 3),
(94, 17, 'Find new business ventures (C)', 15, 50, 120, 15, 'AL', 4),
(99, 38, 'Work out (I,C)', 0, 120, 50, 30, 'BA', 1),
(100, 38, 'Go home and relax (P,I)', 30, 50, 0, 120, 'BA', 2),
(101, 38, 'After work? Not sure what that means (C,I)', 0, 50, 120, 30, 'BA', 3),
(102, 38, 'A long walk (maybe with my dog) (A,P)', 120, 30, 0, 50, 'BA', 4),
(103, 40, 'Continue the party (A,P)', 120, 30, 0, 50, 'FR', 1),
(104, 40, 'Follow the flow (I,P)', 0, 120, 30, 50, 'FR', 2),
(105, 40, 'Go to bed (P,C)', 0, 30, 50, 120, 'FR', 3),
(106, 40, 'Shower, relax, and read a bit (C,I)', 0, 50, 120, 30, 'FR', 4),
(107, 41, 'Sleep all day (I,P)', 30, 120, 0, 50, 'AL', 1),
(108, 41, 'Work on my finances (C,I)', 0, 50, 120, 30, 'AL', 2),
(109, 41, 'Convince my friends to do the same (A,P)', 120, 30, 0, 50, 'AL', 3),
(110, 41, 'I have so much to do, it\'s not funny (P,A)', 50, 30, 0, 120, 'AL', 4),
(111, 42, 'A city where one of my old friends lives (P,A)', 50, 30, 0, 120, 'AL', 1),
(112, 42, 'Europe, obviously (I,C)', 0, 120, 50, 30, 'AL', 2),
(113, 42, 'Someplace new and unexpected (A,P)', 120, 30, 0, 50, 'AL', 3),
(114, 42, 'A luxury resort in South of France (C,I)', 0, 50, 120, 30, 'AL', 4),
(115, 43, 'Me is enough', 25, 25, 25, 25, 'AL', 1),
(116, 43, 'Riot with friends', 25, 25, 25, 25, 'FR', 2),
(117, 43, 'Partner in crime', 25, 25, 25, 50, 'FR', 3),
(118, 43, 'My better half', 50, 50, 50, 50, 'CO', 4),
(119, 44, 'Running shoes (P,I)', 30, 50, 0, 120, 'AL', 1),
(120, 44, 'Book (I,C)', 0, 120, 50, 30, 'AL', 2),
(121, 44, 'Laptop (C,I)', 0, 50, 120, 30, 'AL', 3),
(122, 44, 'Hiking boots (A,P)', 120, 30, 0, 50, 'AL', 4),
(123, 45, 'Steak (I,C)', 0, 120, 50, 30, 'AL', 1),
(124, 45, 'Burger & Fries (P,I)', 30, 50, 0, 120, 'AL', 2),
(125, 45, 'Local (A,I)', 120, 50, 0, 30, 'AL', 3),
(126, 45, '5 course meal (C,I)', 0, 50, 120, 30, 'AL', 4),
(127, 46, 'Comedy (P,A)', 50, 30, 0, 120, 'AL', 1),
(128, 46, 'Action (A,P)', 120, 30, 0, 50, 'AL', 2),
(129, 46, 'Documentary (C,I)', 0, 50, 120, 30, 'AL', 3),
(130, 46, 'Romance (I,C)', 0, 120, 50, 30, 'AL', 4),
(131, 47, 'Sweatpants (I,P)', 30, 120, 0, 50, 'BW', 1),
(132, 47, 'Workout clothes (P,A)', 50, 30, 0, 120, 'BW', 2),
(133, 47, 'Business suit, never know who you meat (C,I)', 0, 50, 120, 30, 'BW', 3),
(134, 47, 'Who cares as long as it\'s comfortable (A,P)', 120, 30, 0, 50, 'BW', 4),
(135, 48, 'Please. I don\'t wait. I have a Nexus Card (C,I)', 0, 50, 120, 30, 'BW', 1),
(136, 48, 'Chat with the people around me (A,P)', 120, 30, 0, 50, 'BW', 2),
(137, 48, 'Put my headphones on (P,I)', 0, 50, 30, 120, 'BW', 3),
(138, 48, 'Read my book (I,P)', 0, 120, 30, 50, 'BW', 4),
(139, 49, 'Europe (C,P)', 0, 30, 120, 50, 'CO', 1),
(140, 49, 'Asia (A,I)', 120, 50, 0, 30, 'CO', 2),
(141, 49, 'North America (I,C)', 0, 120, 30, 50, 'CO', 3),
(142, 49, 'South America (P,A)', 50, 30, 0, 120, 'CO', 4),
(143, 50, 'Snacks, obviously (P,A)', 50, 30, 0, 120, 'AL', 1),
(144, 50, 'My laptop (C,I)', 0, 50, 120, 30, 'AL', 2),
(145, 50, 'Several books (I,C)', 0, 120, 50, 30, 'AL', 3),
(146, 50, 'Nothing really, I sleep like a baby (A,P)', 120, 30, 0, 50, 'AL', 4),
(147, 51, 'My professional Camera (A,P)', 120, 30, 0, 50, 'AL', 1),
(148, 51, 'My wardrobe collection (C,I)', 0, 50, 120, 30, 'AL', 2),
(149, 51, 'My printed itinerary (I,P)', 0, 120, 30, 50, 'AL', 3),
(150, 51, 'Phone charger (P,I)', 0, 50, 30, 120, 'AL', 4),
(151, 52, 'My car (I,P)', 0, 120, 30, 50, 'AL', 1),
(152, 52, 'Motorcycle (A,P)', 120, 30, 0, 50, 'AL', 2),
(153, 52, 'Uber (C,P)', 50, 50, 120, 50, 'AL', 3),
(154, 52, 'Walk or bike (P,A)', 50, 30, 0, 120, 'AL', 4),
(155, 53, 'Morning (C,I)', 30, 50, 120, 0, 'FA', 1),
(156, 53, 'Evening (P,C)', 30, 0, 50, 120, 'FA', 2),
(157, 53, 'Anytime (A,P)', 120, 30, 0, 50, 'FA', 3),
(158, 53, 'Time to sleep (I,P)', 0, 120, 30, 50, 'FA', 4),
(159, 54, 'Backpack through Asia for months (A,I)', 120, 50, 0, 30, 'CO', 1),
(160, 54, 'Invest it (C,I)', 0, 50, 120, 30, 'CO', 2),
(161, 54, 'Buy every little thing I need (P,I)', 0, 50, 30, 120, 'CO', 3),
(162, 54, 'Pay my debts (I,C)', 0, 120, 50, 30, 'CO', 4),
(163, 55, 'at the best known spots (C,I)', 0, 50, 120, 30, 'BW', 1),
(164, 55, 'at local unknown spots (A,I)', 120, 50, 0, 30, 'BW', 2),
(165, 55, 'Following my pre-planned itinerary (I,A)', 50, 120, 0, 30, 'BW', 3),
(166, 55, 'doing whatever seems interesting at the time (P,A)', 50, 30, 0, 120, 'BW', 4),
(167, 56, 'Going on a Food Tour (I,C)', 0, 120, 50, 30, 'AL', 1),
(168, 56, 'A Spa day (C,I)', 0, 50, 120, 30, 'AL', 2),
(169, 56, 'At a park with a picnic basket (A,P)', 120, 30, 0, 50, 'AL', 3),
(170, 56, 'Staying at home and watch Netflix (P,I)', 0, 50, 30, 120, 'AL', 4),
(171, 57, 'Ted Talks (I,C)', 0, 120, 50, 30, 'BA', 1),
(172, 57, 'LinkedIn (C,I)', 0, 50, 120, 30, 'BA', 2),
(173, 57, 'Facebook (P,A)', 50, 30, 0, 120, 'BA', 3),
(174, 57, 'Snapchat (A,P)', 120, 30, 0, 50, 'BA', 4),
(175, 58, 'Best out of my wardrobe (C,I)', 0, 50, 120, 30, 'CO', 1),
(176, 58, 'First thing I see (A,P)', 120, 30, 0, 50, 'CO', 2),
(177, 58, 'Well, it depends (I,P)', 30, 120, 0, 50, 'CO', 3),
(178, 58, 'what we would wear regularly (P,A)', 50, 30, 0, 120, 'CO', 4),
(179, 59, 'Continue the party (A,P)', 120, 0, 30, 50, 'CO', 1),
(180, 59, 'Follow the flow (P,I)', 30, 50, 0, 120, 'CO', 2),
(181, 59, 'Go to bed (I,P)', 0, 120, 30, 50, 'CO', 3),
(182, 59, 'Shower, relax, and read a bit (C,I)', 0, 50, 120, 30, 'CO', 4),
(183, 60, 'Same as everyone around me(P,C)', 0, 30, 50, 120, 'AL', 1),
(184, 60, 'Always calm(C,I)', 0, 50, 120, 30, 'AL', 2),
(185, 60, 'Fire bomb(A,P)', 120, 30, 0, 50, 'AL', 3),
(186, 60, 'What\'s the occassion?(I,C)', 0, 120, 50, 30, 'AL', 4),
(187, 61, 'Classy vibe(C,I)', 0, 50, 120, 30, 'FR', 1),
(188, 61, 'Go with the flow(P,A)', 50, 30, 0, 120, 'FR', 2),
(189, 61, 'Extreme(A,I)', 120, 50, 0, 30, 'FR', 3),
(190, 61, 'Informed(I,C)', 0, 120, 50, 30, 'FR', 4),
(191, 62, 'Travelling around the world by myself(C,P)', 0, 30, 120, 50, 'CO', 1),
(192, 62, 'Backpacking through Asia(A,I)', 120, 50, 0, 30, 'CO', 2),
(193, 62, 'Private tour through Italy(C,I)', 0, 50, 120, 30, 'CO', 3),
(194, 62, 'Planning a trip on excel(I,C)', 0, 120, 50, 30, 'CO', 4),
(195, 63, 'My favorite place around the corner(P,I)', 0, 50, 30, 120, 'BA', 1),
(196, 63, 'The latest new restaurant(I,C)', 30, 120, 50, 0, 'BA', 2),
(197, 63, 'whatever my friends decide(A,P)', 120, 30, 0, 50, 'BA', 3),
(198, 63, '5 stars place with a reservation(C,I)', 0, 50, 120, 30, 'BA', 4),
(199, 64, 'All inclusive resort(P,I)', 0, 50, 30, 120, 'FR', 1),
(200, 64, 'Vegas baby(A,P)', 120, 30, 0, 50, 'FR', 2),
(201, 64, 'Could probably plan 10 trips with that money(I,P)', 0, 120, 30, 50, 'FR', 3),
(202, 64, 'I\'ll cancel on my friends and invest the money(C,I)', 0, 50, 120, 30, 'FR', 4),
(203, 65, 'take a nap on my backpack', 50, 30, 0, 120, 'CO', 1),
(204, 65, 'Put my headphones on', 0, 120, 50, 30, 'CO', 2),
(205, 65, 'Shop at duty free', 0, 50, 120, 30, 'CO', 3),
(206, 65, 'I am never that early, not sure', 120, 30, 0, 50, 'CO', 4),
(207, 66, 'Take a cab to my hotel(P,I)', 0, 50, 30, 120, 'FA', 1),
(208, 66, 'Shower, unpack and go out(C,I)', 0, 50, 120, 30, 'FA', 2),
(209, 66, 'Ask a local where to go(A,I)', 120, 50, 0, 30, 'FA', 3),
(210, 66, 'I\'ve reserved everything in advance(I,C)', 0, 120, 50, 30, 'FA', 4),
(211, 67, 'Travel agency(I,P)', 0, 120, 30, 50, 'FA', 1),
(212, 67, 'Inner Calling(C,A)', 50, 30, 120, 0, 'FA', 2),
(213, 67, 'Someone asked me(P,A)', 50, 30, 0, 120, 'FA', 3),
(214, 67, 'Spin the globe an decide(A,I)', 120, 50, 0, 30, 'FA', 4),
(215, 68, 'A hat(C,I)', 0, 50, 120, 30, 'AL', 1),
(216, 68, 'A notebook full of poetry and drawings(I,C)', 0, 120, 50, 30, 'AL', 2),
(217, 68, 'None needed, it\'s all in my mind(P,A)', 50, 30, 0, 120, 'AL', 3),
(218, 68, 'Local alcohol(A,P)', 120, 30, 0, 50, 'AL', 4),
(219, 69, 'Bunjee jump(A,I)', 120, 50, 0, 30, 'FA', 1),
(220, 69, 'Hot air balloon ride(C,I)', 30, 50, 120, 0, 'FA', 2),
(221, 69, 'A walk in the parc(P,C)', 0, 30, 50, 120, 'FA', 3),
(222, 69, 'A dinner with friends or family(I,C)', 0, 120, 50, 30, 'FA', 4),
(223, 70, 'An unplanned date(A,I)', 120, 50, 0, 30, 'CO', 1),
(224, 70, 'A 3 course dinner(C,I)', 0, 50, 120, 30, 'CO', 2),
(225, 70, 'BYO-Everything(P,A)', 50, 30, 0, 120, 'CO', 3),
(226, 70, 'Visit one of the top 10s(I,C)', 0, 120, 50, 30, 'CO', 4),
(227, 71, 'Going bowling with a group of friends(P,I)', 30, 50, 0, 120, 'CO', 1),
(228, 71, 'Netflix and chill(C,I)', 0, 50, 120, 30, 'CO', 2),
(229, 71, 'Work on a DYI project(I,A)', 50, 120, 0, 30, 'CO', 3),
(230, 71, 'Bar hopping(A,P)', 120, 30, 0, 50, 'CO', 4),
(231, 72, 'Relaxing(P,C)', 0, 30, 50, 120, 'CO', 1),
(232, 72, 'Making new friends(A,I)', 120, 50, 0, 30, 'CO', 2),
(233, 72, 'Food(C,I)', 0, 50, 120, 30, 'CO', 3),
(234, 72, 'Discovering a City(I,A)', 50, 120, 0, 30, 'CO', 4),
(235, 73, 'Exciting(I,A)', 50, 120, 30, 0, 'BW', 1),
(236, 73, 'Boring(P,A)', 50, 30, 0, 120, 'BW', 2),
(237, 73, 'Necessary(C,I)', 0, 50, 120, 30, 'BW', 3),
(238, 73, 'Never just a business trip(A,I)', 120, 50, 0, 30, 'BW', 4),
(239, 74, 'Monkeys(A,P)', 120, 30, 0, 50, 'FR', 1),
(240, 74, 'Money(I,C)', 0, 120, 50, 30, 'FR', 2),
(241, 74, 'Crazy(P,A)', 50, 30, 0, 120, 'FR', 3),
(242, 74, 'Foodies(C,I)', 30, 50, 120, 0, 'FR', 4),
(243, 75, 'Christmas(C,I)', 0, 50, 120, 30, 'FA', 1),
(244, 75, 'March Break(A,P)', 120, 30, 0, 50, 'FA', 2),
(245, 75, 'Summer(P,A)', 50, 30, 0, 120, 'FA', 3),
(246, 75, 'All Year(I,A)', 50, 120, 0, 30, 'FA', 4),
(247, 76, 'Forever(I,C)', 0, 120, 50, 30, 'AL', 1),
(248, 76, 'Just a stone(P,A)', 50, 30, 0, 120, 'AL', 2),
(249, 76, 'To impress(C,I)', 0, 50, 120, 30, 'AL', 3),
(250, 76, 'Don\'t care(A,P)', 120, 30, 0, 50, 'AL', 4),
(251, 77, 'Sleeping Bag(A,P)', 120, 30, 0, 50, 'AL', 1),
(252, 77, 'Simple Backpack(P,A)', 50, 30, 0, 120, 'AL', 2),
(253, 77, 'The right size for the trip(I,C)', 0, 120, 50, 30, 'AL', 3),
(254, 77, 'One with wheels(C,I)', 0, 50, 120, 30, 'AL', 4),
(255, 78, 'Go home and rest(P,I)', 0, 50, 30, 120, 'BW', 1),
(256, 78, 'Have a drink(A,P)', 120, 30, 0, 50, 'BW', 2),
(257, 78, 'Go back to work(C,I)', 0, 50, 120, 30, 'BW', 3),
(258, 78, 'Plan tomorrow(I,C)', 0, 120, 50, 30, 'BW', 4);

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
(1, 'Purpose of your trip?', 'group1'),
(4, 'Who are you traveling with?', 'group2'),
(5, 'Who are you traveling with?', 'group3'),
(6, 'What are you mainly looking forward on this trip?', 'AL'),
(8, 'Your suitcase is?', 'BA'),
(12, 'What drink describes you best?', 'AL'),
(13, 'What are your main travel shoes during this trip?', 'AL'),
(14, 'What city describes you best', 'BA'),
(15, 'Who would you rather travel with?', 'FR'),
(17, 'What\'s the best part about travelling', 'AL'),
(38, 'On a Wednesday after work, I love to?', 'BA'),
(40, 'After a party, I usually like to', 'FR'),
(41, 'If you call in sick at work if you\'re fine, what would you do with your free day?', 'AL'),
(42, 'If you have no restrictions and unlimited funds, where would you travel to right now?', 'AL'),
(43, 'Who are you travelling with?', 'group4'),
(44, 'What is the most important item you packed for this trip?', 'AL'),
(45, 'What is your perfect meal?', 'AL'),
(46, 'Setting in for a long flight, what type of movie do you choose?', 'AL'),
(47, 'You\'re heading to the airport for an early morning flight, what are you wearing?', 'BW'),
(48, 'You\'re waiting in a long security line, what would you do?', 'BW'),
(49, 'What is your ideal continent for a vacation?', 'CO'),
(50, 'What must you always bring along on a long flight?', 'AL'),
(51, 'What is the one thing you can not travel without?', 'AL'),
(52, 'What kind of transportation appeals to you most', 'AL'),
(53, 'What is the best part of the day?', 'FA'),
(54, 'What would you do if you won 10000$?', 'CO'),
(55, 'When I am in a City, I usually spend most of time', 'BW'),
(56, 'The perfect day off would be', 'AL'),
(57, 'Pick an App', 'BA'),
(58, 'The perfect outfit for a surprise date would be the', 'CO'),
(59, 'After a party, you usually like to', 'CO'),
(60, 'My usual energy level is?', 'AL'),
(61, 'What energy level describes this group best?', 'FR'),
(62, 'Which of those sounds like a nightmare?', 'CO'),
(63, 'When you go out to eat, you tend to choose?', 'BA'),
(64, 'You are given 20000$ to plan a trip, where would you and your friends go?', 'FR'),
(65, 'Got an hour to kill before you board the plane?', 'CO'),
(66, 'You\'ve arrived at your destination, what\'s the first thing you do?', 'FA'),
(67, 'How do you begin your trip?', 'FA'),
(68, 'Souvenirs you brought from your last trip?', 'AL'),
(69, 'Would you rather go for?', 'FA'),
(70, 'The perfect date?', 'CO'),
(71, 'What would be a perfect Saturday night together?', 'CO'),
(72, 'As a couple, what\'s the best part of travelling?', 'CO'),
(73, 'A business trip is?', 'BW'),
(74, 'If this group had a title it would be?', 'FR'),
(75, 'The best time of the year is?', 'FA'),
(76, 'Diamonds are?', 'AL'),
(77, 'Your suitcase is?', 'AL'),
(78, 'After a long day of work with my colleagues, it\'s best to?', 'BW');

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
(31, 49, 40, 1),
(37, 49, 43, 1),
(38, 49, 69, 1),
(26, 50, 38, 1),
(28, 51, 38, 0),
(32, 51, 40, 1),
(29, 52, 38, 0),
(33, 52, 40, 1),
(27, 53, 38, 1),
(40, 53, 69, 1),
(30, 54, 38, 0),
(34, 54, 40, 1),
(41, 56, 69, 0),
(35, 57, 40, 1),
(43, 57, 69, 1),
(45, 58, 69, 1),
(36, 63, 40, 1),
(42, 71, 69, 0),
(39, 76, 69, 1),
(44, 77, 69, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `qa_scores`
--

CREATE TABLE `qa_scores` (
  `id` int(11) NOT NULL,
  `name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `dob` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
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
(9, 'Tst', 'under 18', 'male', 'test@t.sp', '2018-08-30 06:53:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0),
(10, 'sddsd', 'under 18', 'male', 'email@w.sd', '2018-08-30 06:55:06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0),
(12, 'asd', '30-44', 'male', 'cxzx@d.ss', '2018-08-31 18:21:28', 6, 52, 38, 101, 7, 58, 4, 43, 23, 1, 25, 20, 31, 32, 34, 3910, 415, 5970, 420),
(13, 'T', '65+', 'male', 't@f.dd', '2018-08-31 20:59:06', 4, 43, 41, 110, 23, 2, 8, 61, 12, 74, 30, 38, 14, 31, 9, 610, 125, 800, 170),
(14, 'Jack', '18-29', 'male', 'jck@t.ok', '2018-08-31 22:10:30', 2, 34, 14, 80, 38, 101, 19, 97, 23, NULL, NULL, NULL, NULL, NULL, NULL, 230, 305, 30, 360),
(15, 'Filip', '', NULL, '', '2018-09-01 18:16:49', 11, 68, 13, 76, 14, 79, 9, 65, 12, 73, 14, 15, 16, 9, 23, 220, 100, 50, 20),
(16, 'Astdafa', 'under 18', 'male', '', '2018-09-01 18:24:03', 49, NULL, 103, NULL, 39, NULL, 41, NULL, 54, NULL, 13, 12, 15, 16, 22, 55, 80, 95, 115),
(17, 'Joe', '', NULL, '', '2018-09-02 12:09:19', 11, 67, 3, 38, 14, 80, 16, 87, 6, 51, 40, 30, 13, 39, 8, 290, 125, 0, 110),
(18, 'kk', '', NULL, '', '2018-09-04 15:09:17', 1, 50, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 55, 0, 0),
(19, 'marcos', '', NULL, '', '2018-09-04 15:18:06', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0),
(20, 'marcc', '', NULL, '', '2018-09-04 15:18:47', 1, 31, 23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 50, 50, 50, 50),
(21, 'Marc', '', NULL, '', '2018-09-04 15:19:33', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0),
(22, 'Marc', '', NULL, '', '2018-09-04 15:19:53', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0),
(23, 'Marc', '', NULL, 'Mam@gmail.com', '2018-09-04 15:20:17', 1, 31, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 50, 50, 50, 50),
(24, '3', '', NULL, '', '2018-09-04 17:08:26', 1, 32, 5, 45, 8, 59, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 105, 70, 145, 0),
(25, 'Filip Test', '', NULL, '', '2018-09-04 18:23:23', 1, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 50, 50, 50, 50),
(26, 'Test1', '', NULL, '', '2018-09-04 18:26:33', 1, 31, 4, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 50, 50, 50, 50),
(27, 'Marc', '', NULL, '', '2018-09-04 19:32:30', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0),
(28, 'Marc', '18-29', 'male', 'Marc@marc.com', '2018-09-04 19:33:25', 1, 32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, 25, 25, 25),
(29, 'Marc', '18-29', 'male', 'Marc@marc.com', '2018-09-04 19:34:00', 1, 32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, 25, 25, 25),
(30, 'Marc', '', 'male', '', '2018-09-04 19:34:56', 1, 32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, 25, 25, 25),
(31, 'fgdf', '', NULL, '', '2018-09-04 21:01:42', 1, 49, 43, 116, 40, 103, 15, 83, 74, 239, NULL, NULL, NULL, NULL, NULL, 1040, 1030, 885, 875),
(32, 'Marc', '', NULL, '', '2018-09-04 21:14:41', 1, 31, 4, 41, 57, 172, 51, 148, 53, 157, 47, 52, 50, 45, 44, 100, 100, 100, 100),
(33, 'm', '', NULL, '', '2018-09-04 21:15:20', 1, 32, 5, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 50, 50, 50, 50),
(34, 'Marc', '30-44', 'male', 'marc@marc.com', '2018-09-04 22:27:44', 1, 32, 5, 46, 15, 86, 74, 241, 40, 103, NULL, NULL, NULL, NULL, NULL, 460, 450, 460, 575),
(35, 'MARC TEST1', '', NULL, '', '2018-09-04 23:34:55', 1, 31, 4, 41, 14, 79, 57, 171, 38, 99, 51, 44, 45, 46, 47, 220, 250, 100, 130),
(36, 'FGFD', '', NULL, '', '2018-09-04 23:39:16', 1, 31, 4, 42, 8, 60, 63, 195, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 150, 130, 100, 220),
(37, 'GGG', '', NULL, '', '2018-09-04 23:45:07', 1, 31, 4, 44, 57, 172, 14, 80, 8, 62, 53, 45, 46, 43, 44, 100, 200, 340, 160),
(38, 'Vkb', '18-29', 'female', 'Hvh@live.ca', '2018-09-05 00:13:02', 1, 50, 43, 118, 58, 177, 65, 203, 70, 223, 45, 53, 51, 46, 44, 175, 175, 175, 175),
(39, 'Marc', '45-64', 'male', 'Marc@test1.com', '2018-09-05 01:13:36', 1, 49, 43, 118, 59, 181, 58, 178, 65, 206, 53, 45, 57, 54, 55, 125, 125, 125, 165),
(40, 'm', '', NULL, '', '2018-09-05 01:18:28', 1, 31, 4, 44, 14, 81, 57, 171, 38, 100, 54, 43, 45, 52, 55, 125, 405, 175, 195),
(41, 'Ra', '18-29', 'female', 'E@live.ca', '2018-09-05 01:22:14', 1, 50, 43, 118, 59, 181, 49, 139, 62, 194, 45, 44, 51, 55, 56, 215, 175, 175, 175),
(42, 'Has', '', NULL, '', '2018-09-05 03:10:28', 1, 31, 4, 43, 38, 99, 8, 61, 63, 195, 54, 52, 55, 45, 57, 100, 320, 150, 170),
(43, 'Hello', '', NULL, '', '2018-09-05 03:54:39', 1, 49, 43, 115, 52, 152, 44, 121, 50, 143, 45, 54, 57, 53, 56, 190, 150, 150, 150),
(44, 'T', '', NULL, '', '2018-09-05 04:45:52', 1, 31, 4, 41, 38, 100, 57, 172, 63, 196, 45, 46, 55, 56, 44, 150, 310, 150, 150),
(45, 'I', '', NULL, '', '2018-09-05 05:47:14', 1, 31, 4, 41, 14, 79, 57, 171, 38, 99, 44, 58, 47, 50, 46, 220, 250, 100, 130),
(46, 'marctest3', '', NULL, '', '2018-09-05 13:12:28', 1, 50, 43, 116, 61, 189, 64, 199, 40, 103, 55, 53, 44, 56, 57, 110, 100, 110, 140),
(47, 'MarcTestCO', '', NULL, '', '2018-09-05 13:14:38', 1, 49, 43, 118, 58, 176, 70, 223, 49, 139, 45, 43, 51, 54, 55, 175, 175, 175, 215),
(48, 'Hi', '', NULL, '', '2018-09-05 13:26:39', 1, 31, 4, 42, 14, 81, 63, 196, 8, 60, 49, 43, 44, 57, 54, 150, 250, 150, 290),
(49, 'SAM', '', NULL, '', '2018-09-05 16:59:00', 1, 49, 43, 118, 62, 193, 59, 179, 70, 225, 55, 46, 53, 44, 43, 175, 175, 175, 175),
(50, 'POL', '', NULL, '', '2018-09-05 17:00:01', 1, 32, 5, 45, 13, 78, 77, 252, 6, 51, 51, 53, 55, 58, 45, 220, 180, 220, 180),
(51, 'rrrr', '', NULL, '', '2018-09-05 17:06:41', 1, 49, 43, 116, 61, 190, 40, 103, 15, 85, NULL, NULL, NULL, NULL, NULL, 60, 50, 160, 50),
(52, 'gfdg', '', NULL, '', '2018-09-05 19:43:01', 1, 50, 43, 116, 40, 103, 74, 239, 15, 83, 45, 56, 44, 57, 53, 210, 100, 110, 100),
(53, 'MarcTest1', '', NULL, '', '2018-09-05 20:12:30', 1, 49, 43, 117, 74, 242, 64, 199, 40, 105, 51, 45, 48, 62, 43, 190, 270, 150, 185),
(54, 'sam', '', NULL, '', '2018-09-05 20:15:37', 1, 49, 43, 115, 41, 109, 12, 72, 56, 168, 58, 43, 51, 45, 50, 260, 410, 210, 315),
(55, 'ghdfh', '', NULL, '', '2018-09-05 20:17:20', 1, 32, 5, 48, 67, 211, 75, 243, 53, 156, 43, 44, 47, 46, 45, 190, 160, 150, 170),
(56, 'jay', '', NULL, '', '2018-09-05 20:43:56', 1, 49, 43, 116, 61, 187, 15, 83, 74, 241, 44, 58, 62, 46, 59, 380, 270, 160, 460),
(57, 'gfhg', '', NULL, '', '2018-09-05 21:06:20', 1, 49, 43, 117, 15, 86, 61, 188, 74, 241, 61, 47, 58, 45, 43, 675, 325, 125, 670),
(58, 'df', '', NULL, '', '2018-09-05 21:47:03', 1, 50, 43, 115, 52, 151, 13, 77, 60, 186, 56, 51, 49, 57, 54, 180, 610, 610, 270),
(59, 'MarcTest2', '', NULL, '', '2018-09-05 21:47:55', 1, 32, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, 25, 25, 25),
(60, 'ff', '', NULL, '', '2018-09-05 21:48:20', 1, 49, 43, 117, 74, 240, 61, 190, 15, 84, 56, 50, 48, 53, 52, 70, 450, 200, 175),
(61, 'MarcTest3', '', NULL, '', '2018-09-05 21:48:47', 1, 32, 5, 45, 76, 248, 44, 119, 42, 113, 60, 58, 61, 59, 62, 270, 170, 50, 380),
(62, 'f', '', NULL, '', '2018-09-05 21:49:49', 1, 50, 43, 116, 15, 83, 64, 200, 61, 188, 62, 44, 61, 43, 58, 280, 160, 50, 380),
(63, 'MarcTest4', '', NULL, '', '2018-09-05 21:56:17', 1, 50, 43, 117, 61, 188, 64, 199, 15, 83, 58, 60, 62, 59, 61, 170, 170, 80, 475),
(64, 'Marctest4', '', NULL, '', '2018-09-05 23:20:45', 1, 49, 43, 115, 44, 122, 52, 152, 6, 54, 46, 43, 52, 47, 45, 450, 150, 50, 220),
(65, 'test5', '18-29', 'female', '', '2018-09-05 23:49:51', 1, 32, 5, 47, 70, 223, 58, 178, 72, 234, 52, 55, 50, 56, 51, 280, 290, 60, 240),
(66, 'ghjg', '', NULL, '', '2018-09-06 16:18:41', 1, 49, 43, 116, 64, 200, 74, 239, 61, 188, 47, 61, 45, 60, 44, 380, 140, 60, 290),
(67, 'test6', '', NULL, '', '2018-09-06 16:46:33', 1, 50, 43, 118, 70, 224, 71, 228, 54, 160, 53, 57, 54, 55, 56, 75, 245, 475, 175),
(68, 'Dusia', '', NULL, '', '2018-09-06 19:46:36', 1, 31, 4, 42, 14, 81, 38, 102, 57, 171, 55, 43, 56, 62, 47, 210, 340, 150, 170),
(69, 'Dusia', '', NULL, '', '2018-09-06 19:47:47', 1, 32, 5, 48, 69, 220, 53, 156, 75, 246, 46, 61, 55, 44, 50, 170, 260, 230, 210),
(70, 'Iss', '', NULL, '', '2018-09-06 19:52:42', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0),
(71, 'h', '', NULL, '', '2018-09-06 20:47:41', 1, 49, 43, 116, 40, 106, 61, 187, 15, 85, 51, 55, 48, 52, 49, 60, 240, 420, 150),
(72, 'j', '', NULL, '', '2018-09-07 14:30:01', 1, 32, 5, 45, 60, 185, 46, 128, 52, 152, 44, 62, 45, 43, 46, 450, 150, 50, 220),
(73, 'sad', '', NULL, '', '2018-09-07 14:40:24', 1, 50, 43, 118, 54, 160, 58, 175, 62, 193, 51, 48, 60, 53, 62, 95, 235, 435, 205),
(74, '33', '', NULL, '', '2018-09-07 17:00:17', 1, 49, 43, 117, 40, 105, 74, 240, 15, 84, 45, 44, 62, 60, 56, 50, 340, 240, 265),
(75, 'fgfdg', '', NULL, '', '2018-09-07 17:00:47', 1, 49, 43, 117, 64, 200, 40, 104, 61, 188, 54, 51, 48, 55, 58, 230, 250, 80, 335);

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
(49, 'Tommy\'s', 'Cafe (I,P)', 0, 120, 30, 50, '6cb52c8294415a961ba571a9c03d892c.jpg'),
(50, 'Arts Café', 'Cafe (A,I)', 120, 50, 30, 0, ''),
(51, 'Perles et Paddock', 'Breakfast & Brunch (C,I)', 30, 120, 50, 0, ''),
(52, 'Lola Rosa', 'Breakfast & Brunch (I,C)', 0, 120, 50, 30, ''),
(53, 'Pavillon 67', 'Breakfast & Brunch (C,I)', 0, 50, 120, 30, ''),
(54, 'LOV', 'Breakfast & Brunch (I,C)', 0, 120, 50, 30, ''),
(55, 'Hof Kelsten', 'Breakfast & Brunch (A,I)', 120, 50, 0, 30, ''),
(56, 'La bête à Pain', 'Breakfast & Brunch (C,I)', 30, 50, 120, 0, ''),
(57, 'Le Vin Papillon', 'Lunch (I,C)', 0, 120, 50, 30, ''),
(58, 'Cacao 70', 'Dessert (P, I)', 0, 50, 30, 120, ''),
(59, 'Juliette et Chocolat', 'Dessert (P, I)', 0, 50, 30, 120, ''),
(60, 'Ca Lem', 'Dessert (A,I)', 120, 50, 0, 30, ''),
(61, 'YEH', 'Dessert (A,P)', 120, 30, 0, 50, ''),
(62, 'Dispensa', 'Dessert (C,I)', 0, 50, 120, 30, ''),
(63, 'BOTA BOTA', 'Attraction (I,P)', 0, 120, 30, 50, ''),
(64, 'BIXI along the Canal Lachine', 'Attraction (A,P)', 120, 30, 0, 50, ''),
(65, 'Atwater Market', 'Attraction (P,I)', 30, 50, 0, 120, ''),
(66, 'Basilique Notre-Dame', 'Attraction (P,I)', 0, 50, 30, 120, ''),
(67, 'Chinatown', 'Attraction (I,P)', 30, 120, 0, 50, ''),
(68, 'Barley', 'Cafe (C,I)', 30, 50, 120, 0, ''),
(69, 'Aloha Espresso Bar', 'Cafe (A,I)', 120, 50, 0, 30, ''),
(70, 'Noble', 'Cafe (P,I)', 0, 50, 30, 120, ''),
(71, 'Olive & Gourmando', 'Cafe (I,P)', 0, 120, 30, 50, ''),
(72, 'Humble Lion', 'Cafe (P,I)', 15, 50, 15, 120, ''),
(73, 'Joe Beef', 'Lunch (C,I)', 0, 50, 120, 30, ''),
(74, 'Patati Patata', 'Lunch (A,I)', 120, 50, 0, 30, ''),
(75, 'Romados', 'Lunch (P,A)', 50, 30, 0, 120, ''),
(76, 'Aux Vivres', 'Lunch (I,P)', 30, 120, 0, 50, ''),
(77, 'Satay Brothers', 'Dinner (I,A)', 50, 120, 0, 30, ''),
(78, 'Sumac', 'Dinner (I,P)', 30, 120, 0, 50, ''),
(79, 'Mon Lapin', 'Dinner (A,C)', 120, 30, 50, 0, ''),
(80, 'Park', 'Dinner (C,I)', 30, 50, 120, 0, ''),
(81, 'Casa Tapas', 'Lunch (I,A)', 50, 120, 30, 0, ''),
(82, 'Moose Bawr', 'Bar & Lounges (P,A)', 50, 30, 0, 120, ''),
(83, 'Les Torchés Taverne', 'Bar & Lounges (P,I)', 30, 50, 0, 120, ''),
(84, 'Soubois', 'Bar & Lounges (C,I)', 0, 50, 120, 30, ''),
(85, 'Mimi La Nuit', 'Bar & Lounges (C,I)', 30, 50, 120, 0, ''),
(86, 'Flygin', 'Bar & Lounges (C,I)', 0, 50, 120, 30, ''),
(87, 'Restaurant SU', 'Breakfast & Brunch (I,A)', 50, 120, 0, 30, ''),
(88, 'Cafe Melbourne', 'Breakfast & Brunch (I,P)', 30, 120, 0, 50, ''),
(89, 'Arthur', 'Breakfast & Brunch (I,A)', 50, 120, 0, 30, ''),
(90, 'Régine Café', 'Breakfast & Brunch (C,I)', 0, 50, 120, 30, ''),
(91, 'Hoogan et Beaufort', 'Breakfast & Brunch (I,P)', 0, 120, 30, 50, ''),
(92, 'Foiegwa', 'Breakfast & Brunch (C,I)', 0, 50, 120, 30, ''),
(93, 'Beauty Luncheonette', 'Breakfast & Brunch (P,A)', 50, 30, 0, 120, ''),
(94, 'Les Affamés', 'Breakfast & Brunch (P,A)', 50, 30, 0, 120, ''),
(95, 'O\'Thym', 'Breakfast & Brunch (P,I)', 30, 50, 0, 120, ''),
(96, 'Hotto Doggu', 'Dinner (A,I)', 120, 50, 0, 30, ''),
(97, 'SpeakEasy', 'Bar & Lounges (A,I)', 120, 50, 30, 0, ''),
(98, 'Atwater Cocktail Club', 'Bar & Lounges (A,P)', 120, 30, 0, 50, ''),
(99, 'Kem Coba', 'Desserts (A,I)', 120, 50, 0, 30, ''),
(100, 'MTL Bake House', 'Desserts (C,I)', 0, 50, 120, 30, '');

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
(43, 'Local (A)', 'Local (A)', 40, 20, 0, 10),
(44, 'Night Owl (A)', 'Night Owl (A)', 40, 0, 10, 20),
(45, 'Unknown (A)', 'Unknown (A)', 40, 10, 0, 20),
(46, 'Lone Traveler (A)', 'Lone traveler (A)', 40, 10, 0, 20),
(47, 'Hiking (A)', 'Hiking (A)', 40, 20, 0, 10),
(48, 'Live Music (I)', 'Live Music (I)', 10, 40, 0, 20),
(49, 'Healthy (I)', 'Healthy (I)', 10, 40, 10, 10),
(50, 'Romantic (I)', 'Romantic (I)', 10, 40, 10, 10),
(51, 'Foodies (I)', 'Foodies (I)', 10, 40, 10, 10),
(52, 'Bucket List (I)', 'Bucket List (I)', 20, 40, 0, 10),
(53, 'Upscale (C)', 'Upscale (C)', 0, 20, 40, 10),
(54, 'Valet (C)', 'Valet (C)', 0, 20, 40, 10),
(55, 'Creative Cuisine (C)', 'Creative Cuisine (C)', 0, 20, 40, 10),
(56, 'Shopping (C)', 'Shopping (C)', 0, 20, 40, 10),
(57, 'Fashion (C)', 'Fashion (C)', 0, 20, 40, 10),
(58, 'Casual (P)', 'Casual (P)', 10, 20, 0, 40),
(59, 'Cosy (P)', 'Cosy (P)', 10, 10, 10, 40),
(60, 'Trendy (P)', 'Trendy (P)', 10, 10, 10, 40),
(61, 'Free (P)', 'Free (P)', 20, 10, 0, 40),
(62, 'Good Value (P)', 'Good Value (P)', 20, 10, 0, 40);

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
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, 'IQxzR5somcYIccCJy6yVYu', 1268889823, 1536263337, 1, 'Admin', 'Istrator', 'ADMIN', '0'),
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
-- Indeksy dla tabeli `qa_answers`
--
ALTER TABLE `qa_answers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indeksy dla tabeli `qa_groups`
--
ALTER TABLE `qa_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `qa_login_attempts`
--
ALTER TABLE `qa_login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `qa_questions`
--
ALTER TABLE `qa_questions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indeksy dla tabeli `qa_ratings`
--
ALTER TABLE `qa_ratings`
  ADD PRIMARY KEY (`suggestion_id`,`score_id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indeksy dla tabeli `qa_scores`
--
ALTER TABLE `qa_scores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indeksy dla tabeli `qa_suggestions`
--
ALTER TABLE `qa_suggestions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indeksy dla tabeli `qa_tags`
--
ALTER TABLE `qa_tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indeksy dla tabeli `qa_users`
--
ALTER TABLE `qa_users`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `qa_users_groups`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=259;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT dla tabeli `qa_ratings`
--
ALTER TABLE `qa_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT dla tabeli `qa_scores`
--
ALTER TABLE `qa_scores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT dla tabeli `qa_suggestions`
--
ALTER TABLE `qa_suggestions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT dla tabeli `qa_tags`
--
ALTER TABLE `qa_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT dla tabeli `qa_users`
--
ALTER TABLE `qa_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT dla tabeli `qa_users_groups`
--
ALTER TABLE `qa_users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `qa_users_groups`
--
ALTER TABLE `qa_users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `qa_groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `qa_users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
