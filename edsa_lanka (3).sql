-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql-edsa.alwaysdata.net
-- Generation Time: Apr 27, 2025 at 08:32 PM
-- Server version: 10.11.11-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edsa_lanka`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_login` datetime DEFAULT NULL,
  `last_logout` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `username`, `password`, `email`, `full_name`, `created_at`, `last_login`, `last_logout`) VALUES
(1, 'admin', 'admin123', 'admin@123.com', 'Tharusha Nemantha', '2024-08-14 06:37:48', '2025-04-27 20:24:09', '2025-04-27 20:25:39'),
(2, 'NemanthaT', 'admin', 'admin@gmail.com', 'Tharusha Nemantha', '2024-12-02 06:33:55', '2025-04-27 12:12:00', '2025-04-26 22:59:13');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL,
  `provider_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `appointment_date` datetime DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `service_type` varchar(100) NOT NULL,
  `message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `provider_id`, `client_id`, `appointment_date`, `status`, `created_at`, `service_type`, `message`) VALUES
(1, 1, 1, '2024-11-25 10:00:00', 'Scheduled', '2024-11-21 17:01:05', 'Consulting', 'Looking forward to discussing the new project requirements. as jnoidnaonviofndalkm lmsovkndoabvjobbofaonvj  jdnasjovnofnao jofoanvjonf oajnjonofnaonijv jfbaobvobfrao'),
(2, 1, 2, '2024-11-26 14:00:00', 'Completed', '2024-11-21 17:01:05', 'Teaching', 'Feedback on the recent session will be shared.'),
(3, 1, 3, '2024-11-28 16:30:00', 'Pending', '2024-11-21 17:01:05', 'Researching', 'The appointment was canceled due to unforeseen circumstances.'),
(5, 1, 1, '2024-12-02 00:00:00', 'Rejected', '2024-11-24 08:19:46', 'Researching', 'Feedback on the recent session will be shared.'),
(8, 1, 1, '2024-11-27 00:00:00', 'Cancelled', '2024-11-25 14:30:02', 'Consulting', 'Feedback on the recent session will be shared.'),
(27, 1, 1, '2024-12-04 00:00:00', 'Cancelled', '2024-11-30 07:30:46', 'Training', ' i need to meet to discuss about consultency in finance '),
(28, NULL, 1, '2024-12-06 00:00:00', 'Scheduled', '2024-11-30 10:21:29', 'Consulting', ' Feedback on the recent session will be shared.'),
(29, NULL, 1, '2024-12-19 00:00:00', 'Rejected', '2024-12-02 09:45:15', 'Training', ' '),
(30, 10, 1, '2025-04-25 00:00:00', 'Scheduled', '2025-04-09 18:56:38', 'Training', ' arranging a awareness session \r\n'),
(31, 11, 1, '2025-05-03 00:00:00', 'Assigned', '2025-04-21 05:14:39', 'Training', ' resurch discussion '),
(32, 1, 1, '2025-04-29 00:00:00', 'Cancelled', '2025-04-21 06:00:53', 'Training', ' '),
(33, 17, 1, '2025-05-01 00:00:00', 'Assigned', '2025-04-22 16:51:58', 'Training', 'need a training for the system\r\n'),
(34, 41, 1, '2025-05-01 00:00:00', 'Assigned', '2025-04-22 16:52:03', 'Training', 'need a training for the system\r\n'),
(35, 36, 1, '2025-05-09 00:00:00', 'Assigned', '2025-04-23 08:52:07', 'Consulting', 'i need a training'),
(36, 1, 1, '2025-04-24 00:00:00', 'Scheduled', '2025-04-23 17:54:32', 'Consulting', 'New consulting service'),
(37, 1, 1, '2025-04-25 00:00:00', 'Rejected', '2025-04-24 05:12:52', 'Researching', 'Research appointment'),
(38, 36, 1, '2025-05-02 00:00:00', 'Assigned', '2025-04-26 12:30:27', 'Consulting', 'booking conformed'),
(39, NULL, 1, '2025-05-09 00:00:00', 'Pending', '2025-04-27 18:15:48', 'Consulting', 'i need a training'),
(40, NULL, 1, '2025-05-09 00:00:00', 'Pending', '2025-04-27 18:15:51', 'Consulting', 'i need a training');

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `bill_id` int(255) NOT NULL,
  `project_id` int(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Bill_Date` date NOT NULL,
  `Amount` int(8) NOT NULL,
  `status` varchar(255) NOT NULL,
  `paid_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`bill_id`, `project_id`, `Description`, `Bill_Date`, `Amount`, `status`, `paid_on`) VALUES
(1, 1, 'fd', '2025-04-15', 100, 'paid', '2025-01-08 15:33:55'),
(2, 3, 'safdsfas', '2025-04-21', 100000, 'paid', '2025-02-11 15:35:16'),
(3, 3, '21123', '2025-04-23', 213231, 'unpaid', '0000-00-00 00:00:00'),
(4, 3, 'saxs', '2025-04-27', 2121, 'paid', '2025-04-24 18:51:38'),
(5, 38, 'jnfdks', '2025-12-31', 1000, 'unpaid', '0000-00-00 00:00:00'),
(6, 38, 'sdcs', '2025-04-21', 1000, 'paid', '2025-03-05 15:35:45'),
(7, 38, 'dsjff', '2025-04-16', 21323, 'unpaid', '0000-00-00 00:00:00'),
(8, 1, 'jdbsjhbdwbkdbwb', '2025-09-09', 1200, 'paid', '2025-04-25 11:43:14'),
(9, 1, 'dasdsa', '2025-04-26', 1000, 'paid', '2025-04-25 11:54:48'),
(10, 1, 'mcpoewcd', '2025-04-22', 200000, 'paid', '2025-04-01 15:36:29');

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `message_id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `sender_type` enum('provider','client') NOT NULL,
  `message_text` text NOT NULL,
  `status` enum('unseen','seen','replied') DEFAULT 'unseen',
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat_messages`
--

INSERT INTO `chat_messages` (`message_id`, `thread_id`, `sender_id`, `sender_type`, `message_text`, `status`, `sent_at`) VALUES
(34, 7, 1, 'provider', 'Hi safran....', 'seen', '2025-04-23 11:59:14'),
(35, 7, 1, 'client', 'Hi Ajay...', 'seen', '2025-04-23 12:11:25'),
(36, 7, 1, 'provider', 'hi', 'seen', '2025-04-24 05:30:00'),
(37, 7, 1, 'provider', 'hi', 'seen', '2025-04-24 05:30:13'),
(38, 7, 1, 'provider', 'hi', 'seen', '2025-04-24 05:30:57'),
(39, 7, 1, 'provider', 'hi', 'seen', '2025-04-24 05:31:07'),
(40, 7, 1, 'client', 'hellow\ni am safran', 'seen', '2025-04-25 10:46:35'),
(41, 7, 1, 'client', 'hellow\ni am safran', 'seen', '2025-04-25 10:47:31'),
(42, 8, 1, 'client', 'hi', 'unseen', '2025-04-25 12:08:47'),
(44, 10, 1, 'provider', 'Hi Tamasha...', 'unseen', '2025-04-26 03:24:42'),
(45, 11, 1, 'client', 'Hi..', 'unseen', '2025-04-26 04:47:57'),
(46, 7, 1, 'provider', 'Hi.....', 'unseen', '2025-04-26 17:57:29'),
(47, 7, 1, 'provider', 'Hi.....', 'unseen', '2025-04-26 17:57:41'),
(48, 7, 1, 'provider', 'Hi.....', 'unseen', '2025-04-26 17:57:43'),
(49, 7, 1, 'provider', 'Hi.....', 'unseen', '2025-04-26 17:57:46'),
(50, 7, 1, 'provider', 'Hi.....', 'unseen', '2025-04-26 17:57:52'),
(51, 7, 1, 'provider', 'Hi.....', 'unseen', '2025-04-26 17:57:55'),
(52, 7, 1, 'provider', 'Hi.....', 'unseen', '2025-04-26 17:57:58'),
(53, 7, 1, 'provider', 'Hi.....', 'unseen', '2025-04-26 17:58:00'),
(54, 7, 1, 'provider', 'Hi.....', 'unseen', '2025-04-26 17:58:03'),
(55, 7, 1, 'provider', 'Hi.....', 'unseen', '2025-04-26 17:58:05'),
(56, 7, 1, 'provider', 'Hi.....', 'unseen', '2025-04-26 17:58:08'),
(57, 7, 1, 'provider', 'Hi.....', 'unseen', '2025-04-26 17:58:11'),
(58, 7, 1, 'provider', 'Hi.....', 'unseen', '2025-04-26 17:58:18'),
(59, 7, 1, 'provider', 'Hi.....', 'unseen', '2025-04-26 17:58:21'),
(60, 7, 1, 'provider', 'Hi.....', 'unseen', '2025-04-26 17:58:27'),
(61, 7, 1, 'provider', 'Hi.....', 'unseen', '2025-04-26 17:58:30'),
(62, 7, 1, 'provider', 'Hi.....', 'unseen', '2025-04-26 17:58:33'),
(63, 7, 1, 'provider', 'Hi.....', 'unseen', '2025-04-26 17:58:35'),
(64, 7, 1, 'provider', 'Hi.....', 'unseen', '2025-04-26 17:58:42'),
(65, 7, 1, 'provider', 'Hi.....', 'unseen', '2025-04-26 17:58:44'),
(66, 7, 1, 'provider', 'Hi.....', 'unseen', '2025-04-26 17:58:47'),
(67, 7, 1, 'provider', 'Hi.....', 'unseen', '2025-04-26 17:58:54'),
(68, 7, 1, 'provider', 'Hi.....', 'unseen', '2025-04-26 17:58:57'),
(69, 7, 1, 'provider', 'Hi.....', 'unseen', '2025-04-26 17:59:06'),
(70, 7, 1, 'provider', 'Hi.....', 'unseen', '2025-04-26 17:59:11'),
(71, 7, 1, 'provider', 'Hi.....', 'unseen', '2025-04-26 17:59:17'),
(72, 7, 1, 'provider', 'Hi.....', 'unseen', '2025-04-26 17:59:23'),
(73, 7, 1, 'provider', 'Hi.....', 'unseen', '2025-04-26 17:59:27'),
(74, 7, 1, 'provider', 'Hi.....', 'unseen', '2025-04-26 17:59:32'),
(75, 10, 1, 'provider', 'Hello......', 'unseen', '2025-04-26 18:03:51'),
(76, 10, 1, 'provider', 'Hello......', 'unseen', '2025-04-26 18:04:58');

-- --------------------------------------------------------

--
-- Table structure for table `chat_threads`
--

CREATE TABLE `chat_threads` (
  `thread_id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat_threads`
--

INSERT INTO `chat_threads` (`thread_id`, `provider_id`, `client_id`, `topic`, `created_at`) VALUES
(7, 1, 1, 'training', '2025-04-23 11:59:14'),
(8, 4, 1, 'teaching', '2025-04-25 12:08:46'),
(10, 1, 2, 'Consulting', '2025-04-26 03:24:41'),
(11, 10, 1, 'consulting', '2025-04-26 04:47:56');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) NOT NULL DEFAULT 'set',
  `last_login` datetime DEFAULT NULL,
  `last_logout` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `username`, `password`, `email`, `full_name`, `phone`, `address`, `created_at`, `status`, `last_login`, `last_logout`) VALUES
(1, 'tharu', 'client@123', 'client@gmail.com', 'Tharusha Nemantha', '0711850441', 'kalutara', '2024-09-11 12:59:25', 'set', '2025-04-27 20:15:18', '2025-04-27 17:19:06.000000'),
(2, 'Tamasha', 'tamasha@123', 'tamasha@gmail.com', 'Tamasha Sipsandi', '0762878056', 'Kalutara Bombuwala', '2024-09-11 12:59:25', 'set', NULL, NULL),
(3, 'akila', 'akila@123', 'akila@gmail.com', 'Akila Udantha', '0711850341', 'Bombuwala Kalutara', '2024-09-11 13:01:58', 'set', '2025-04-26 05:38:48', '2025-04-26 05:39:07.000000'),
(4, 'thehasa', 'thehasa@123', 'thehasa@gmail.com', 'Thehasa Damsandi', '0762878085', 'Kiwlawatta Bombuwala', '2024-09-11 13:01:58', 'set', NULL, NULL),
(5, 'jennifer52', 'eC^ukZJv%3', 'kowens@stuart.info', 'Ronald Anderson', '+1-475-815-0866x238', '050 Lori Pass Apt. 986, Neilchester, NH 56105', '2024-11-11 13:12:18', 'set', NULL, NULL),
(6, 'john57', '%%B6mnCf35', 'adamsmichael@gmail.com', 'Lisa Cantrell', '297-689-6963', '3783 Alicia Mews, Lake Zacharystad, NM 99376', '2024-11-11 13:12:18', 'set', NULL, NULL),
(7, 'lestrada', '*85ZPmsAey', 'randalljackson@gmail.com', 'Ryan Jenkins', '1687391021', '9704 Rachel Knolls Suite 424, West Sandra, NY 12345', '2024-11-11 13:12:18', 'set', NULL, NULL),
(8, 'jeremycrawford', 'Jj8H6WETt%', 'ntorres@yahoo.com', 'William Oconnell', '(711)204-6675', '32019 Sharon Creek Apt. 732, Deborahmouth, KY 12345', '2024-11-11 13:12:18', 'set', NULL, NULL),
(9, 'janice39', '%2Yqj2uNx9', 'bperry@yahoo.com', 'Tammy Elliott', '796.378.8616x952', '38718 Catherine Mount Apt. 811, Morrisville, SC 12345', '2024-11-11 13:12:18', 'set', NULL, NULL),
(10, 'victormccarthy', '5At17HNjA@', 'reyeskelly@larson.com', 'Elizabeth Baker', '108-829-8363', '4562 Douglas Island Apt. 173, Margaretfort, TN 12345', '2024-11-11 13:12:18', 'set', NULL, NULL),
(11, 'umitchell', 'D5rJOOIc*%', 'katherinemurphy@contreras.com', 'Brandon Miller', '905.651.7837', '084 Phillip Burgs Suite 556, West Sheila, WI 12345', '2024-11-11 13:12:18', 'set', NULL, NULL),
(12, 'johnsonyvonne', '#i00cC0cMq', 'rharding@hotmail.com', 'Margaret Dixon', '(751)125-6989x182', '46361 James Ports Suite 337, Shahfort, NY 12345', '2024-11-11 13:12:18', 'set', NULL, NULL),
(13, 'walter02', 'y^eRNhKn&1', 'bmurphy@davila.net', 'Danny Taylor', '001-543-998-5712x881', '247 Carolyn Lights, New Hannahside, NY 12345', '2024-11-11 13:12:18', 'set', NULL, NULL),
(14, 'zbell', 'yX5HvmlSL!', 'amyberry@campbell.com', 'Anthony Cook', '(382)354-7290x157', '8512 Rodriguez Mount Suite 856, Calebton, RI 12345', '2024-11-11 13:12:18', 'set', NULL, NULL),
(15, 'daniellawrence', '%5(HeH9Mfb', 'johncox@hotmail.com', 'Miss Mary Fisher', '8474476336', '5237 Joy Trace, Port Laura, WA 98829', '2024-11-11 13:12:18', 'set', NULL, NULL),
(16, 'hmaddox', '5@@99UygE2', 'crichards@reynolds.biz', 'Miss Victoria Evans', '351.796.7460x790', 'PSC 0342, Box 7835, APO AA 18298', '2024-11-11 13:12:18', 'set', NULL, NULL),
(17, 'angela66', 'o3R1L0RmR(', 'marquezlynn@hotmail.com', 'Mr. David West', '001-008-834-7525x968', '655 Thomas Lakes Apt. 784, Williamsborough, NY 12345', '2024-11-11 13:12:18', 'set', NULL, NULL),
(18, 'christine30', '!0Ab5dDC(8', 'brenda09@joseph.com', 'Julie Frank', '001-891-453-5744x384', '38473 Tate Streets Apt. 419, North Kathryn, MN 12345', '2024-11-11 13:12:18', 'set', NULL, NULL),
(19, 'gwilliams', 'E4NWwbg6^I', 'matthewsmartin@hotmail.com', 'Marissa Parker', '385-232-5570', '5614 Wilson Fort Suite 049, Cantrellville, WA 12345', '2024-11-11 13:12:18', 'set', NULL, NULL),
(20, 'mark20', 'a)7mE)_o@&', 'ghowell@williams-green.net', 'Eric Jones', '+1-408-908-5645x2282', '942 Scott Streets Apt. 087, Port Michael, KY 12345', '2024-11-11 13:12:18', 'set', NULL, NULL),
(21, 'fpatton', '0cSS1ze#!9', 'richard41@gmail.com', 'Joseph Burton', '439-863-9145', '9190 Mariah Ramp, North Rebeccastad, CO 12345', '2024-11-11 13:12:18', 'set', NULL, NULL),
(22, 'davidgarcia', '%8HOJ83ltT', 'derek40@bishop.org', 'Todd Roberts', '371-281-4027', '8721 Wilson Key Suite 436, Nicoleborough, NJ 12345', '2024-11-11 13:12:18', 'set', NULL, NULL),
(23, 'iangonzalez', 'R1sb9PTg&e', 'peggybeck@gmail.com', 'Joseph Mendez', '851-664-4364x929', '6460 Sparks Lake Suite 178, Fosterfurt, IL 12345', '2024-11-11 13:12:18', 'set', NULL, NULL),
(24, 'gpratt', '(P2Ds(fQ(K', 'susanstone@yahoo.com', 'Theresa Morrison', '+1-166-036-5008', '0753 Warren Manors, Cynthiaside, MI 12345', '2024-11-11 13:12:18', 'set', NULL, NULL),
(25, 'victoria05', '&1SY9tGnx4', 'danieldunn@francis.net', 'Vernon Reed', '001-137-153-0356x134', '3111 Emily Summit, Paulachester, MN 12345', '2024-11-11 13:12:18', 'set', NULL, NULL),
(26, 'shannonbradley', 'of9GTX7o%3', 'shawallen@henderson-simon.com', 'Sandra Rojas', '001-905-191-0168', '569 Gonzalez Street, Dianaburgh, NH 77836', '2024-11-11 13:12:18', 'set', NULL, NULL),
(27, 'christinehoover', 'O(9rTe(_tG', 'jameswhite@richard-flores.info', 'Kayla Graves', '(011)952-4731x554', '0845 Shaw River Apt. 701, East Robertland, CO 12345', '2024-11-11 13:12:18', 'set', NULL, NULL),
(28, 'khanwilliam', 'F%29$VY9ux', 'jbailey@marshall-thompson.com', 'Steven Hamilton', '001-795-612-7154x282', 'USNV Patel, FPO AP 33099', '2024-11-11 13:12:18', 'set', NULL, NULL),
(29, 'ritahughes', '_1uOqHfOQy', 'nicholasglass@deleon.net', 'Jodi Alexander', '+1-638-206-5662x691', '0689 Mercado Stream, Christopherview, MS 74418', '2024-11-11 13:12:18', 'set', NULL, NULL),
(30, 'kpeterson', 'Itu%^8Fucm', 'camachomanuel@peterson.com', 'Kara Crane', '9676147796', '2068 Stephanie Junctions Apt. 663, East Miguelfurt, NM 12345', '2024-11-11 13:12:18', 'set', NULL, NULL),
(31, 'allen86', 'f7N22YRi#&', 'megan87@hotmail.com', 'James Peterson', '001-943-720-9848x610', 'USCGC Jones, FPO AE 76020', '2024-11-11 13:12:18', 'set', NULL, NULL),
(32, 'gparker', '!7XdEAJt@Y', 'harrisonphillip@yahoo.com', 'Hailey Nelson', '001-996-513-0484', '44962 Corey Branch Suite 249, South Karenside, IL 12345', '2024-11-11 13:12:18', 'set', NULL, NULL),
(33, 'kellykaren', 'R^Ms@8Efvy', 'smithvictoria@gmail.com', 'Michele Webb', '940.560.9302x935', '778 Matthew Freeway Apt. 958, Nathanville, OK 12345', '2024-11-11 13:12:18', 'set', NULL, NULL),
(34, 'austin47', '+U2tG4UyQ8', 'katherine38@gmail.com', 'Dale Cole', '001-096-432-0252', '0274 Nathan Islands Apt. 973, Lake Andrea, CO 12345', '2024-11-11 13:12:18', 'set', NULL, NULL),
(35, '', '', 'nemanth@gmail.com', 'Tharusha Nemantha', '0713954167', 'Kalutara', '2024-12-02 07:01:07', 'set', NULL, NULL),
(44, NULL, '306080', 'nemanthatharu@gmail.com', 'Tharusha Nemantha', '0713954167', 'Kalutara', '2024-12-02 08:24:23', 'set', NULL, NULL),
(45, NULL, '367996', 'safran16000014@gmail.com', 'safran  zahim', '0705083388', 'galle', '2024-12-02 09:43:21', 'set', NULL, NULL),
(46, 'dm', '276972', 'oshadha.dw@gmail.com', 'dasun madushan', '081-2389194', '451/1 Pahala Eriyagama Peradeniya', '2025-04-25 04:42:50', 'set', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `companyworkers`
--

CREATE TABLE `companyworkers` (
  `worker_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `phoneNo` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) NOT NULL DEFAULT 'set',
  `last_login` datetime DEFAULT NULL,
  `last_logout` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `companyworkers`
--

INSERT INTO `companyworkers` (`worker_id`, `username`, `password`, `email`, `full_name`, `role`, `address`, `phoneNo`, `created_at`, `status`, `last_login`, `last_logout`) VALUES
(3, 'c3', 'worker', 'worker@gmail.com', 'cthreehelo', ' Data Entry ', '25, Galle Road, Colombo', '0771234567', '2024-10-15 12:24:49', 'set', '2025-04-27 20:25:55', '2025-04-27 20:27:29.000000'),
(4, 'c4', 'c123', 'c4@gmail.com', 'cfour', 'Executive', '102, Kandy Road, Peradeniya', '0719876543', '2024-10-15 12:24:49', 'set', '2025-04-24 13:39:59', '2025-04-24 13:45:57.000000'),
(5, 'johnsmith', 'p@ssword123', 'johnsmith@example.com', 'John Smith', ' Data Entry ', '56, Main Street, Gampaha', '0751122334', '2024-11-11 13:25:19', 'set', '2025-04-21 19:35:29', NULL),
(6, 'janedoe', 'Pa$$w0rd!', 'janedoe@example.com', 'Jane Doe', ' HR ', '78, Lake View Avenue, Nuwara Eliya', '0762233445', '2024-11-11 13:25:19', 'set', '2025-04-23 08:53:58', NULL),
(7, 'bobmartin', 'Qwerty!234', 'bobmartin@example.com', 'Bob Martin', ' HR Manager ', '90, Beach Road, Negombo', '0773344556', '2024-11-11 13:25:19', 'set', '2025-04-21 19:35:29', NULL),
(8, 'lisajones', 'Secure*456', 'lisajones@example.com', 'Lisa Jones', 'Support', '33, Temple Road, Anuradhapura', '0714455667', '2024-11-11 13:25:19', 'set', '2025-04-21 19:35:29', NULL),
(9, 'mikebrown', 'Admin#789', 'mikebrown@example.com', 'Mike Brown', 'Manager', '45, Hospital Lane, Matara', '0755566778', '2024-11-11 13:25:19', 'set', '2025-04-21 19:35:29', NULL),
(10, 'susantaylor', 'MyPass$123', 'susantaylor@example.com', 'Susan Taylor', 'Developer', '120, Railway Avenue, Jaffna', '0766677889', '2024-11-11 13:25:19', 'set', '2025-04-21 19:35:29', NULL),
(11, 'peterparker', 'Spider@456', 'peterparker@example.com', 'Peter Parker', 'Analyst', '15, Station Road, Batticaloa', '0777788990', '2024-11-11 13:25:19', 'set', '2025-04-21 19:35:29', NULL),
(12, 'nancywilson', 'Nancy!123', 'nancywilson@example.com', 'Nancy Wilson', 'Support', '200, Church Street, Kegalle', '0718899001', '2024-11-11 13:25:19', 'set', '2025-04-21 19:35:29', NULL),
(13, 'kevinwhite', 'White@789', 'kevinwhite@example.com', 'Kevin White', 'Manager', '89, Market Road, Trincomalee', '0759900112', '2024-11-11 13:25:19', 'set', '2025-04-21 19:35:29', NULL),
(14, 'andreagreen', 'Green#456', 'andreagreen@example.com', 'Andrea Green', 'Developer', '77, University Road, Moratuwa', '0760112233', '2024-11-11 13:25:19', 'set', '2025-04-21 19:35:29', NULL),
(15, 'paulwalker', 'Walker@123', 'paulwalker@example.com', 'Paul Walker', 'Analyst', '19, Station Lane, Badulla', '0771223344', '2024-11-11 13:25:19', 'set', '2025-04-21 19:35:29', NULL),
(16, 'stevesmith', 'Steve!789', 'stevesmith@example.com', 'Steve Smith', 'Support', '60, Court Road, Ratnapura', '0712334455', '2024-11-11 13:25:19', 'unset', '2025-04-21 19:35:29', NULL),
(17, 'sarahmiller', 'Miller@456', 'sarahmiller@example.com', 'Sarah Miller', 'Manager', '82, Kings Road, Kurunegala', '0753445566', '2024-11-11 13:25:19', 'set', '2025-04-21 19:35:29', NULL),
(18, 'davidmoore', 'Moore$123', 'davidmoore@example.com', 'David Moore', 'Developer', '39, New Bazaar Street, Kalutara', '0764556677', '2024-11-11 13:25:19', 'set', '2025-04-21 19:35:29', NULL),
(19, 'chloejames', 'Chloe@789', 'chloejames@example.com', 'Chloe James', 'Analyst', '58, Park Road, Polonnaruwa', '0775667788', '2024-11-11 13:25:19', 'set', '2025-04-21 19:35:29', NULL),
(20, 'rachelhall', 'Rachel!123', 'rachelhall@example.com', 'Rachel Hall', 'Support', '97, High Level Road, Maharagama', '0716778899', '2024-11-11 13:25:19', 'set', '2025-04-21 19:35:29', NULL),
(21, 'dannysmith', 'Danny#456', 'dannysmith@example.com', 'Danny Smith', 'Manager', '23, Town Hall Road, Hambantota', '0757889900', '2024-11-11 13:25:19', 'set', '2025-04-21 19:35:29', NULL),
(22, 'emilyclark', 'Emily$789', 'emilyclark@example.com', 'Emily Clark', 'Developer', '111, Cinnamon Gardens, Colombo 7', '0768990011', '2024-11-11 13:25:19', 'set', '2025-04-21 19:35:29', NULL),
(23, 'jacklewis', 'Jack@456', 'jacklewis@example.com', 'Jack Lewis', 'Analyst', '66, Green Path, Colombo 3', '0779001122', '2024-11-11 13:25:19', 'set', '2025-04-21 19:35:29', NULL),
(24, 'daniellebrown', 'Danielle!123', 'daniellebrown@example.com', 'Danielle Brown', 'Support', '150, Hospital Road, Kandy', '0710112233', '2024-11-11 13:25:19', 'set', '2025-04-21 19:35:29', NULL),
(25, 'brandonlee', 'Brandon$789', 'brandonlee@example.com', 'Brandon Lee', 'Manager', '48, College Avenue, Jaffna', '0751223344', '2024-11-11 13:25:19', 'set', '2025-04-21 19:35:29', NULL),
(26, 'laurabaker', 'Laura@456', 'laurabaker@example.com', 'Laura Baker', 'Developer', '77, Circular Road, Battaramulla', '0762334455', '2024-11-11 13:25:19', 'set', '2025-04-21 19:35:29', NULL),
(27, 'ryanturner', 'Ryan#123', 'ryanturner@example.com', 'Ryan Turner', 'Analyst', '99, Dharmapala Mawatha, Galle', '0773445566', '2024-11-11 13:25:19', 'set', '2025-04-21 19:35:29', NULL),
(28, 'jessicawood', 'Jessica@789', 'jessicawood@example.com', 'Jessica Wood', 'Support', '34, Thurstan Road, Colombo 7', '0714556677', '2024-11-11 13:25:19', 'set', '2025-04-21 19:35:29', NULL),
(29, 'tonyking', 'Tony!456', 'tonyking@example.com', 'Tony King', 'Manager', '81, Palm Grove, Matale', '0755667788', '2024-11-11 13:25:19', 'set', '2025-04-21 19:35:29', NULL),
(30, 'michellerogers', 'Michelle$123', 'michellerogers@example.com', 'Michelle Rogers', 'Developer', '42, Templers Road, Mount Lavinia', '0766778899', '2024-11-11 13:25:19', 'set', '2025-04-21 19:35:29', NULL),
(31, 'samuelbell', 'Samuel#789', 'samuelbell@example.com', 'Samuel Bell', 'Analyst', '135, Union Place, Colombo 2', '0777889900', '2024-11-11 13:25:19', 'set', '2025-04-21 19:35:29', NULL),
(32, 'oliviaward', 'Olivia@456', 'oliviaward@example.com', 'Olivia Ward', 'Support', '69, Sir James Peiris Mawatha, Colombo 2', '0718990011', '2024-11-11 13:25:19', 'set', '2025-04-21 19:35:29', NULL),
(33, 'frankthomas', 'Frank!123', 'frankthomas@example.com', 'Frank Thomas', 'Manager', '101, Queens Road, Nugegoda', '0759001122', '2024-11-11 13:25:19', 'set', '2025-04-21 19:35:29', NULL),
(34, 'nataliegray', 'Natalie$789', 'nataliegray@example.com', 'Natalie Gray', 'Developer', '56, Rose Street, Hatton', '0760112233', '2024-11-11 13:25:19', 'set', '2025-04-21 19:35:29', NULL),
(35, 'hannahscott', 'Hannah@456', 'hannahscott@example.com', 'Hannah Scott', 'Analyst', '145, Land Side, Puttalam', '0771223344', '2024-11-11 13:25:19', 'set', '2025-04-21 19:35:29', NULL),
(36, 'nemanthaT', '781163', 'ajaya@gmail.com', 'Ajay Ajay', 'hr', '75, Hill Street, Dehiwala', '0712334455', '2024-12-02 09:38:46', 'set', '2025-04-21 19:35:29', NULL),
(37, 'TamaS', '907572', 'tamashaS@gmail.com', 'Tamasha Sipsandi', 'Executive', 'Kalutara South', '0711960431', '2025-01-31 09:39:22', 'set', '2025-04-21 19:35:29', NULL),
(38, 'neman', '161778', 'nemanthatharusha@gmail.com', 'Tharusha Nemantha', 'Data Entry', 'Saumya Darshana Galwalawatta Road Bombuwala Kalutara South', '0711850441', '2025-04-15 13:08:33', 'set', '2025-04-21 19:35:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contactforms`
--

CREATE TABLE `contactforms` (
  `contact_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contactforms`
--

INSERT INTO `contactforms` (`contact_id`, `client_id`, `subject`, `message`, `created_at`) VALUES
(1, 1, 'Request for Consultation', 'I would like to schedule a consultation regarding business expansion.', '2025-04-01 08:15:00'),
(2, 2, 'Follow-up on Proposal', 'Could you please provide an update on the proposal sent last week?', '2025-04-02 12:30:00'),
(3, 3, 'Service Inquiry', 'What services do you offer for new startups?', '2025-04-03 07:45:00'),
(4, 6, 'Job Opportunities', 'I am interested in joining your team. Do you have any openings?', '2025-04-04 14:20:00'),
(5, 4, 'Technical Issue', 'I am facing issues with the dashboard loading. Please assist.', '2025-04-05 06:55:00'),
(6, 5, 'Request for Invoice', 'Can you resend the invoice for last month’s services?', '2025-04-06 10:10:00'),
(7, 8, 'Partnership Inquiry', 'Would you be open to a strategic partnership with our firm?', '2025-04-07 09:05:00'),
(8, 6, 'Event Registration', 'I would like to register for the upcoming webinar.', '2025-04-08 13:45:00'),
(9, 7, 'General Feedback', 'Great experience with your support team. Keep it up!', '2025-04-09 15:30:00'),
(10, 9, 'Schedule a Meeting', 'Can we schedule a meeting to discuss further collaboration?', '2025-04-10 11:25:00');

-- --------------------------------------------------------

--
-- Table structure for table `contactforums`
--

CREATE TABLE `contactforums` (
  `cf_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `reason` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contactforums`
--

INSERT INTO `contactforums` (`cf_id`, `full_name`, `email`, `phone_number`, `reason`, `created_at`, `status`) VALUES
(1, 'oshadha', 'oshadha.dw@gmail.com', '0755490025', 'aDFSGDHJKGJHFGDSFDA', '2025-04-22 17:24:10', NULL),
(2, 'tharusha', 'tharu@gmail.com', '12345', 'helo', '2025-04-23 08:47:00', NULL),
(3, 'sdavf', 'afsdvx@gmail.com', 'edasz', 'edsaf', '2025-04-23 09:19:23', NULL),
(4, 'asdf', 'helooa@gmail.com', '2134567u', 'wfdsvdad', '2025-04-23 09:22:27', NULL),
(5, 'asdcz', 'helooa@gmail.com', 'dwsawedfsc', 'dwsac', '2025-04-23 09:22:45', NULL),
(6, 'Oshadha Weerakoon', 'oshadha.dw@gmail.com', '1234567', 'adsfg', '2025-04-23 10:50:29', NULL),
(7, 'Tharusha Nemantha', 'nemanthatharusha@gmail.com', '0711850441', 'How can I get service from you. What\'s the process', '2025-04-25 09:55:12', NULL),
(8, 'Oshadha Weerakoon', 'oshadha.dw@gmail.com', '0755490025', 'heloo 123', '2025-04-25 11:18:25', NULL),
(9, 'Tamasha Sipsandi', 'Kalutara@k', 'ddydytdy', 'ssds', '2025-04-25 11:42:43', NULL),
(10, 'dasun', 'dasun@gmail.com', '0755490025', 'helo', '2025-04-26 18:04:13', NULL),
(11, 'Oshadha Weerakoon', 'oshadha.dw@gmail.com', '12345', 'we', '2025-04-26 18:05:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contactforum_replies`
--

CREATE TABLE `contactforum_replies` (
  `cfr_id` int(11) NOT NULL,
  `worker_id` int(11) NOT NULL,
  `cf_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `worker_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `event_date` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `worker_id`, `title`, `description`, `event_date`, `created_at`) VALUES
(3, 6, 'Product Launch Event', 'The official launch event for our new product line.', '2024-12-20 14:00:00', '2024-11-28 23:40:00'),
(4, 7, 'Holiday Party', 'Celebrate the festive season with fun activities and good food.', '2024-12-22 18:00:00', '2024-11-28 23:45:00'),
(5, 8, 'Leadership Training', 'A training session for employees aspiring to leadership roles.', '2025-01-05 11:00:00', '2024-11-28 23:50:00'),
(7, 4, 'Safety Awareness Seminar', 'A seminar to promote safety measures in the workplace.', '2025-01-15 13:00:00', '2024-11-29 00:00:00'),
(8, 5, 'Quarterly Review Meeting', 'Review the progress of projects and discuss future plans.', '2025-01-20 09:00:00', '2024-11-29 00:05:00'),
(9, 6, 'Marketing Strategy Discussion', 'Brainstorming session for the upcoming marketing campaigns.', '2025-01-25 16:00:00', '2024-11-29 00:10:00'),
(10, 7, 'Customer Appreciation Gala', 'An event to honor our most loyal customers.', '2025-01-30 19:00:00', '2024-11-29 00:15:00'),
(11, 8, 'Innovation Day', 'Presentations and discussions on innovative ideas.', '2025-02-05 10:00:00', '2024-11-29 00:20:00'),
(12, 9, 'Wellness Retreat', 'A retreat focused on employee wellness and mindfulness.', '2025-02-10 08:00:00', '2024-11-29 00:25:00'),
(13, 4, 'Cybersecurity Workshop', 'Learn about the latest cybersecurity practices.', '2025-02-15 14:00:00', '2024-11-29 00:30:00'),
(14, 5, 'Annual Sports Day', 'A day of fun and friendly competition.', '2025-02-20 09:00:00', '2024-11-29 00:35:00'),
(15, 6, 'Cultural Festival', 'Showcasing the diverse cultures within our company.', '2025-02-25 17:00:00', '2024-11-29 00:40:00'),
(16, 7, 'Board of Directors Meeting', 'Quarterly meeting for the board of directors.', '2025-03-01 11:00:00', '2024-11-29 00:45:00'),
(17, 8, 'Hackathon', 'An internal event to develop innovative tech solutions.', '2025-03-05 08:00:00', '2024-11-29 00:50:00'),
(18, 9, 'Employee Recognition Ceremony', 'Recognizing employees for their outstanding contributions.', '2025-03-10 18:00:00', '2024-11-29 00:55:00'),
(19, 4, 'Budget Planning Session', 'Planning the budget for the next fiscal year.', '2025-03-15 10:00:00', '2024-11-29 01:00:00'),
(20, 5, 'Earth Day Initiative', 'Activities and programs to support environmental sustainability.', '2025-04-22 09:30:00', '2024-11-29 01:05:00');

-- --------------------------------------------------------

--
-- Table structure for table `forumreplies`
--

CREATE TABLE `forumreplies` (
  `reply_id` int(11) NOT NULL,
  `forum_id` int(11) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `created_by` enum('Client','ServiceProvider','Admin') NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forums`
--

CREATE TABLE `forums` (
  `forum_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `created_by` enum('Client','ServiceProvider','Admin') NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forums`
--

INSERT INTO `forums` (`forum_id`, `title`, `content`, `created_by`, `user_id`, `created_at`, `category`) VALUES
(7, 'E-commerce Trends', 'What are the latest trends in e-commerce? How can businesses adapt?', 'ServiceProvider', 1, '2025-04-24 08:29:41', 'General Discussions'),
(8, 'Understanding Customer Behavior', 'Strategies to understand and predict customer needs.', 'ServiceProvider', 8, '2025-04-24 08:29:41', ''),
(9, 'Effective Business Communication', 'How to communicate effectively within teams and with clients.', 'Client', 9, '2025-04-24 08:29:41', ''),
(10, 'SEO for Beginners', 'A guide to basic SEO practices for small businesses.', 'ServiceProvider', 1, '2025-04-24 08:29:41', ''),
(11, 'Building Brand Loyalty', 'How to keep customers coming back and create a loyal customer base.', 'Client', 11, '2025-04-24 08:29:41', ''),
(12, 'Remote Team Management', 'Tips for effectively managing remote teams in a business setting.', 'ServiceProvider', 1, '2025-04-24 08:29:41', ''),
(13, 'Financial Planning for Startups', 'Discussing financial planning tips and tools for new businesses.', 'Client', 13, '2025-04-24 08:29:41', ''),
(14, 'Business Risk Management', 'How to identify and mitigate risks in business operations.', 'ServiceProvider', 1, '2025-04-24 08:29:41', ''),
(15, 'Social Media Strategies', 'Best social media practices for promoting your business.', 'Client', 15, '2025-04-24 08:29:41', ''),
(16, 'Market Research Basics', 'Understanding the basics of market research for business growth.', 'ServiceProvider', 16, '2025-04-24 08:29:41', ''),
(17, 'Developing a Business Plan', 'Key elements to include in a successful business plan.', 'Client', 17, '2025-04-24 08:29:41', ''),
(18, 'Customer Retention Techniques', 'Strategies for retaining customers in a competitive market.', 'ServiceProvider', 18, '2025-04-24 08:29:41', ''),
(19, 'Adapting to Market Changes', 'How businesses can stay flexible and adapt to changing markets.', 'Client', 19, '2025-04-24 08:29:41', ''),
(20, 'Leadership in Small Business', 'Discussing essential leadership qualities for small business success.', 'ServiceProvider', 20, '2025-04-24 08:29:41', ''),
(21, 'Pricing Strategy Development', 'How to develop a competitive and profitable pricing strategy.', 'Client', 21, '2025-04-24 08:29:41', ''),
(22, 'Employee Motivation Techniques', 'Ideas to keep your team motivated and productive.', 'ServiceProvider', 22, '2025-04-24 08:29:41', ''),
(23, 'Budgeting for Business Growth', 'Effective budgeting tips to support business expansion.', 'Client', 23, '2025-04-24 08:29:41', ''),
(24, 'Data-Driven Decision Making', 'Using data analytics for better business decisions.', 'ServiceProvider', 24, '2025-04-24 08:29:41', ''),
(25, 'Creating a Unique Value Proposition', 'How to define and communicate your business’s unique value.', 'Client', 25, '2025-04-24 08:29:41', ''),
(26, 'Importance of Customer Feedback', 'Discussing ways to collect and use customer feedback.', 'ServiceProvider', 26, '2025-04-24 08:29:41', ''),
(27, 'Innovative Product Development', 'Ideas for innovating and improving your product offerings.', 'Client', 27, '2025-04-24 08:29:41', ''),
(28, 'Sales Techniques for Small Businesses', 'Effective sales techniques for increasing revenue.', 'ServiceProvider', 28, '2025-04-24 08:29:41', ''),
(29, 'Legal Considerations for Startups', 'Basic legal issues every startup should be aware of.', 'Client', 29, '2025-04-24 08:29:41', ''),
(30, 'Utilizing AI in Business Operations', 'Exploring how AI can streamline business processes.', 'ServiceProvider', 30, '2025-04-24 08:29:41', '');

-- --------------------------------------------------------

--
-- Table structure for table `knowledgebase`
--

CREATE TABLE `knowledgebase` (
  `id` int(11) NOT NULL,
  `section` enum('consultant','training') NOT NULL,
  `title` enum('development finance','micro finance','organizational development','sme development','gender finance','institutional development','community development','strategic and operational planning') NOT NULL,
  `content` text NOT NULL,
  `worker_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `knowledgebase`
--

INSERT INTO `knowledgebase` (`id`, `section`, `title`, `content`, `worker_id`, `created_at`) VALUES
(1, 'consultant', 'micro finance', 'dsafdgfdvfdbgncbxv', 3, '2025-04-23 06:00:57'),
(3, 'training', 'gender finance', 'qwERYGDFSAD', 3, '2025-04-23 06:32:32'),
(4, 'training', 'organizational development', 'sadvcx', 6, '2025-04-23 06:54:15');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `worker_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `worker_id`, `title`, `content`, `created_at`, `image_path`) VALUES
(2, 5, 'New Product Launch hloo', 'We are excited to announce the launch of our new product ncxzext month.neww', '2025-04-23 00:19:17', NULL),
(3, 6, 'Office Renovation Completed', 'Our main office has undergone a renovation to enhance workspaces.', '2024-11-29 04:00:00', NULL),
(4, 7, 'Employee of the Month', 'Congratulations to Sarah Johnson for being awarded Employee of the Month.', '2024-11-29 04:15:00', NULL),
(5, 8, 'Upcoming Holiday Notice', 'The office will be closed on December 25th for the holidays.', '2024-11-29 04:30:00', NULL),
(6, 9, 'New Partnership Announcement', 'We have partnered with TechCorp to enhance our services.', '2024-11-29 04:45:00', NULL),
(7, 4, 'Safety Training Scheduled', 'A mandatory safety training will be held on December 5th.', '2024-11-29 05:00:00', NULL),
(8, 5, 'Community Outreach Program', 'Join us for our annual community outreach event this weekend.', '2024-11-29 05:15:00', NULL),
(9, 6, 'Internal Software Update', 'The IT department has updated the internal software for better performance.', '2024-11-29 05:30:00', NULL),
(10, 7, 'Market Expansion Plans', 'We are planning to expand into three new international markets.', '2024-11-29 05:45:00', NULL),
(11, 8, 'Upcoming Webinar', 'Register for our webinar on modern workplace strategies.', '2024-11-29 06:00:00', NULL),
(12, 9, 'Customer Appreciation Event', 'A special event to thank our loyal customers will be held on December 10th.', '2024-11-29 06:15:00', NULL),
(13, 4, 'Health and Wellness Workshop', 'A workshop on maintaining health and wellness at work is scheduled for next week. okay', '2025-04-26 15:10:16', NULL),
(14, 5, 'Quarterly Financial Results', 'The financial results for Q3 will be published tomorrow.', '2024-11-29 06:45:00', NULL),
(15, 6, 'IT Security Best Practices', 'A guide to enhance cybersecurity awareness among employees.', '2024-11-29 07:00:00', NULL),
(16, 7, 'New CEO Announcement', 'We are pleased to welcome Jane Doe as our new CEO.', '2024-11-29 07:15:00', NULL),
(17, 8, 'Annual Picnic', 'The annual company picnic will be held on December 20th at Central Park.', '2024-11-29 07:30:00', NULL),
(18, 9, 'CSR Initiative', 'Details about our latest corporate social responsibility project.', '2024-11-29 07:45:00', NULL),
(19, 4, 'Employee Survey Results', 'The results of the recent employee survey are now available.aDsfgdhfgjhncbvxcdsfdvzDSADetrhfdgnbxvczDAsfgr', '2024-12-02 02:36:30', NULL),
(20, 5, 'Holiday Gift Distributiondsfg', 'Holiday gifts will be distributed to all employees on December 22nd.dfsdgvcxz', '2024-11-29 08:15:00', NULL),
(21, 3, 'heloo', 'news news news', '2025-04-23 05:10:03', NULL),
(23, 3, 'news', 'qwertyuio yuiopq', '2025-04-26 15:10:48', 'uploads/news/680c5563c90e6.png');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `not_id` int(255) NOT NULL,
  `sender_id` int(255) NOT NULL,
  `sender_type` varchar(255) NOT NULL DEFAULT '',
  `reciever_id` int(255) NOT NULL,
  `reciever_type` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'unseen'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`not_id`, `sender_id`, `sender_type`, `reciever_id`, `reciever_type`, `description`, `status`) VALUES
(1, 1, 'clients', 2, 'service providers', 'hello', 'unseen');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `service_request_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `client_id`, `amount`, `payment_date`, `service_request_id`) VALUES
(3, 3, 800.00, '2024-08-02 18:30:00', 3),
(4, 24, 1500.00, '2024-08-03 18:30:00', 4),
(5, 31, 1800.00, '2024-08-04 18:30:00', 5),
(6, 6, 1100.00, '2024-08-05 18:30:00', 6),
(7, 7, 700.00, '2024-08-06 18:30:00', 7),
(8, 18, 1600.00, '2024-08-07 18:30:00', 8);

-- --------------------------------------------------------

--
-- Table structure for table `pending_clients`
--

CREATE TABLE `pending_clients` (
  `client_id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','rejected') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pending_clients`
--

INSERT INTO `pending_clients` (`client_id`, `username`, `password`, `email`, `full_name`, `phone`, `address`, `created_at`, `status`) VALUES
(0, NULL, '501626', 'safran1600014@gmail.com', 'safran zahim', '0705083388', '24/2,Steel road,galle', '2025-04-25 12:40:48', 'pending'),
(0, NULL, '301392', 'worker@gmail.com', 'Tharusha Nemantha', '0711850441', 'Saumya Darshana Galwalawatta Road Bombuwala Kalutara South', '2025-04-26 11:46:41', 'pending'),
(0, NULL, '152737', 'worker@gmail.com', 'Tharusha Nemantha', '0711850441', 'Saumya Darshana Galwalawatta Road Bombuwala Kalutara South', '2025-04-26 13:31:12', 'pending'),
(0, NULL, '190496', 'worker@gmail.com', 'Tharusha Nemantha', '0711850441', 'Saumya Darshana Galwalawatta Road Bombuwala Kalutara South', '2025-04-26 13:35:59', 'pending'),
(0, NULL, '224161', 'worker@gmail.com', 'Tharusha Nemantha', '0711850441', 'Saumya Darshana Galwalawatta Road Bombuwala Kalutara South', '2025-04-26 13:39:06', 'pending'),
(0, NULL, '755225', 'worker@gmail.com', 'Tharusha Nemantha', '0711850441', 'Saumya Darshana Galwalawatta Road Bombuwala Kalutara South', '2025-04-26 14:02:20', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `projectdocuments`
--

CREATE TABLE `projectdocuments` (
  `document_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projectdocuments`
--

INSERT INTO `projectdocuments` (`document_id`, `project_id`, `file_name`, `file_path`, `created_date`) VALUES
(1, 31, 'saxz', 'edsalanka (3).sql', '2025-04-13 11:56:47'),
(2, 32, 'cdsxzsax', 'edsalanka (3).sql', '2025-04-13 11:58:56'),
(3, 33, 'sa', 'edsalanka (3).sql', '2025-04-13 12:08:02'),
(6, 36, 'proposal', 'projectstatuslogs (1).sql', '2025-04-13 12:54:07'),
(34, 40, 'proposal', '../../uploads/40/Your paragraph text (4).jpg', '2025-04-16 05:01:43'),
(37, 37, 'proposal', '../../uploads/37/Your paragraph text (12).jpg', '2025-04-27 15:21:25');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `project_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `project_name` varchar(30) NOT NULL,
  `project_description` varchar(100) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `project_status` varchar(10) NOT NULL DEFAULT 'ongoing',
  `project_phase` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `client_id`, `provider_id`, `project_name`, `project_description`, `created_date`, `project_status`, `project_phase`) VALUES
(1, 1, 1, 'j', 'kjn', '2025-04-26 08:25:12', 'ongoing', 'Execution'),
(2, 1, 0, 'xsaa', 'xdsa', '2025-04-26 18:23:49', 'Completed', 'Planning'),
(3, 1, 1, 'xsaa', 'xdsa', '2025-04-25 18:47:03', 'ongoing', 'requirement-gatherin'),
(4, 1, 1, 'dszxs', 'csaxcz', '2025-04-26 08:25:52', 'ongoing', 'Execution'),
(5, 1, 0, 'dszxs', 'csaxcz', '2025-04-26 08:25:12', 'ongoing', 'Execution'),
(6, 1, 0, 'dszxs', 'csaxcz', '2025-04-26 08:25:12', 'ongoing', 'Execution'),
(7, 1, 0, 'dszxs', 'csaxcz', '2025-04-26 08:25:12', 'ongoing', 'Execution'),
(8, 1, 0, 'dszxs', 'csaxcz', '2025-04-26 08:25:12', 'ongoing', 'Execution'),
(9, 1, 0, 'dszxs', 'csaxcz', '2025-04-26 08:25:12', 'ongoing', 'Execution'),
(10, 1, 0, 'dszxs', 'csaxcz', '2025-04-26 08:25:12', 'ongoing', 'Execution'),
(11, 1, 0, 'dszxs', 'csaxcz', '2025-04-26 08:25:12', 'ongoing', 'Execution'),
(12, 1, 0, 'dszxs', 'csaxcz', '2025-04-26 08:25:12', 'ongoing', 'Execution'),
(13, 1, 0, 'dszxs', 'csaxcz', '2025-04-26 08:25:12', 'ongoing', 'Execution'),
(14, 1, 0, 'dszxs', 'csaxcz', '2025-04-26 08:25:12', 'ongoing', 'Execution'),
(15, 1, 0, 'dszxs', 'csaxcz', '2025-04-26 08:25:12', 'ongoing', 'Execution'),
(16, 1, 0, 'dszxs', 'csaxcz', '2025-04-26 08:25:12', 'ongoing', 'Execution'),
(17, 1, 0, 'dszxs', 'csaxcz', '2025-04-26 08:25:12', 'ongoing', 'Execution'),
(18, 1, 0, 'dszxs', 'csaxcz', '2025-04-26 08:25:12', 'ongoing', 'Execution'),
(19, 1, 0, 'dszxs', 'csaxcz', '2025-04-26 08:25:12', 'ongoing', 'Execution'),
(20, 1, 0, 'dszxs', 'csaxcz', '2025-04-26 08:25:12', 'ongoing', 'Execution'),
(21, 1, 0, 'dszxs', 'csaxcz', '2025-04-26 08:25:12', 'ongoing', 'Execution'),
(22, 1, 0, 'dszxs', 'csaxcz', '2025-04-26 08:25:12', 'ongoing', 'Execution'),
(23, 1, 0, 'dszxs', 'csaxcz', '2025-04-26 08:25:12', 'ongoing', 'Execution'),
(24, 1, 0, 'dszxs', 'csaxcz', '2025-04-26 08:25:12', 'ongoing', 'Execution'),
(25, 1, 0, 'dszxs', 'csaxcz', '2025-04-26 08:25:12', 'ongoing', 'Execution'),
(26, 1, 0, 'dszxs', 'csaxcz', '2025-04-26 08:25:12', 'ongoing', 'Execution'),
(27, 1, 0, 'dszxs', 'csaxcz', '2025-04-26 08:25:12', 'ongoing', 'Execution'),
(28, 1, 0, 'dszxs', 'csaxcz', '2025-04-26 08:25:12', 'ongoing', 'Execution'),
(29, 1, 0, 'dszxs', 'csaxcz', '2025-04-26 08:25:12', 'ongoing', 'Execution'),
(30, 1, 0, 'dszxs', 'csaxcz', '2025-04-26 08:25:12', 'ongoing', 'Execution'),
(31, 1, 0, 'das', 'dsa', '2025-04-26 08:25:12', 'ongoing', 'Planning'),
(32, 1, 0, 'cds', 'cxs', '2025-04-26 08:25:12', 'ongoing', 'Execution'),
(33, 1, 1, 'dasd', 'das', '2025-04-26 08:25:12', 'ongoing', ''),
(34, 1, 1, 'dasd', 'das', '2025-04-26 08:25:12', 'ongoing', 'design'),
(35, 1, 1, 'cvds', 'saxz', '2025-04-26 08:25:12', 'ongoing', 'development'),
(36, 1, 1, 'sadafra', 'cxzcxzc', '2025-04-14 14:30:12', 'ongoing', 'development'),
(37, 2, 1, 'getting consulting ', 'metting clents of stuff', '2025-04-27 15:22:03', 'ongoing', 'Planning'),
(38, 4, 4, '1213', 'fsd', '2025-04-26 08:25:12', 'ongoing', 'requirement-gatherin'),
(40, 1, 1, 'research on planting', 'research on planting for the tea cultivation', '2025-04-26 18:26:15', 'Completed', 'Planning'),
(41, 1, 1, 'finacial consultation', 'finance training', '2025-04-26 18:39:05', 'cancelled', 'Execution');

-- --------------------------------------------------------

--
-- Table structure for table `projectstatuslogs`
--

CREATE TABLE `projectstatuslogs` (
  `log_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `message` varchar(100) NOT NULL,
  `changed_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projectstatuslogs`
--

INSERT INTO `projectstatuslogs` (`log_id`, `project_id`, `message`, `changed_at`) VALUES
(1, 36, 'creating the project ', '2025-04-13 12:54:07'),
(2, 37, 'creating the project ', '2025-04-14 07:56:51'),
(3, 38, 'creating the project ', '2025-04-14 07:58:23'),
(4, 38, 'Project phase updated to ', '2025-04-14 08:01:30'),
(5, 38, 'Project phase updated to ', '2025-04-14 08:01:30'),
(6, 38, 'Project phase updated to ', '2025-04-14 08:01:42'),
(7, 38, 'Project phase updated to ', '2025-04-14 08:01:42'),
(8, 38, 'Project phase updated to ', '2025-04-14 08:02:31'),
(9, 38, 'Project phase updated to ', '2025-04-14 08:02:31'),
(10, 38, 'Project phase updated to ', '2025-04-14 08:03:51'),
(11, 38, 'Project phase updated to ', '2025-04-14 08:03:51'),
(12, 38, 'Project phase updated to ', '2025-04-14 08:03:51'),
(13, 38, 'Project phase updated to ', '2025-04-14 08:03:51'),
(14, 38, 'Project phase updated to ', '2025-04-14 08:03:51'),
(15, 38, 'Project phase updated to ', '2025-04-14 08:03:52'),
(16, 38, 'Project phase updated to ', '2025-04-14 08:03:52'),
(17, 38, 'Project phase updated to ', '2025-04-14 08:03:52'),
(18, 38, 'Project phase updated to ', '2025-04-14 08:03:52'),
(19, 38, 'Project phase updated to ', '2025-04-14 08:03:52'),
(20, 33, 'Project phase updated to ', '2025-04-14 08:15:04'),
(21, 33, 'Project phase updated to ', '2025-04-14 08:16:47'),
(22, 33, 'Project phase updated to ', '2025-04-14 08:20:35'),
(23, 33, 'Project phase updated to development', '2025-04-14 08:20:38'),
(24, 33, 'Project phase updated to development', '2025-04-14 08:22:05'),
(25, 33, 'Project phase updated to development', '2025-04-14 08:22:09'),
(26, 33, 'Project phase updated to deployment', '2025-04-14 08:22:22'),
(27, 33, 'Project phase updated to maintenance', '2025-04-14 08:22:43'),
(28, 33, 'Project phase updated to testing', '2025-04-14 08:23:04'),
(29, 33, 'Project phase updated to testing', '2025-04-14 08:23:07'),
(30, 33, 'Project phase updated to design', '2025-04-14 08:23:10'),
(31, 33, 'Project phase updated to design', '2025-04-14 08:23:57'),
(32, 33, 'Project phase updated to requirement-gat', '2025-04-14 08:24:00'),
(33, 33, 'Project phase updated to maintenance', '2025-04-14 08:24:12'),
(34, 33, 'Project phase updated to design', '2025-04-14 08:24:34'),
(35, 33, 'Project phase updated to design', '2025-04-14 08:26:13'),
(36, 33, 'Project phase updated to requirement-gat', '2025-04-14 08:26:19'),
(37, 33, 'Project phase updated to requirement-gat', '2025-04-14 09:31:27'),
(38, 33, 'Project phase updated to requirement-gat', '2025-04-14 09:33:16'),
(39, 33, 'Project phase updated to requirement-gat', '2025-04-14 09:33:19'),
(40, 33, 'Project phase updated to requirement-gat', '2025-04-14 09:34:17'),
(41, 33, 'Project phase updated to requirement-gat', '2025-04-14 09:34:36'),
(42, 33, 'Project phase updated to requirement-gat', '2025-04-14 09:34:41'),
(43, 33, 'Project phase updated to requirement-gat', '2025-04-14 09:35:01'),
(44, 33, 'Project phase updated to requirement-gat', '2025-04-14 09:35:59'),
(45, 33, 'Project phase updated to requirement-gat', '2025-04-14 09:53:03'),
(46, 33, 'Project phase updated to requirement-gat', '2025-04-14 09:53:20'),
(47, 33, 'Project phase updated to requirement-gat', '2025-04-14 09:53:30'),
(48, 33, 'Project phase updated to requirement-gat', '2025-04-14 09:55:36'),
(49, 33, 'Project phase updated to requirement-gat', '2025-04-14 09:55:40'),
(50, 33, 'Project phase updated to ', '2025-04-14 09:55:55'),
(51, 33, 'Project phase updated to ', '2025-04-14 09:56:38'),
(52, 33, 'Project phase updated to ', '2025-04-14 09:56:45'),
(53, 33, 'Project phase updated to ', '2025-04-14 09:57:53'),
(54, 33, 'Project phase updated to ', '2025-04-14 09:57:55'),
(55, 33, 'Project phase updated to ', '2025-04-14 09:57:56'),
(56, 33, 'Project phase updated to ', '2025-04-14 09:57:56'),
(57, 33, 'Project phase updated to ', '2025-04-14 09:57:56'),
(58, 33, 'Project phase updated to ', '2025-04-14 09:58:03'),
(59, 33, 'Project phase updated to ', '2025-04-14 10:01:22'),
(60, 33, 'Project phase updated to ', '2025-04-14 10:02:10'),
(61, 33, 'Project phase updated to ', '2025-04-14 10:02:13'),
(62, 34, 'Project phase updated to ', '2025-04-14 10:03:07'),
(63, 34, 'Project phase updated to ', '2025-04-14 10:03:12'),
(64, 34, 'Project phase updated to ', '2025-04-14 10:03:49'),
(65, 34, 'Project phase updated to ', '2025-04-14 10:03:52'),
(66, 34, 'Project phase updated to ', '2025-04-14 10:03:53'),
(67, 34, 'Project phase updated to ', '2025-04-14 10:03:53'),
(68, 34, 'Project phase updated to ', '2025-04-14 10:03:53'),
(69, 34, 'Project phase updated to ', '2025-04-14 10:03:54'),
(70, 34, 'Project phase updated to ', '2025-04-14 10:03:54'),
(71, 34, 'Project phase updated to ', '2025-04-14 10:03:54'),
(72, 34, 'Project phase updated to design', '2025-04-14 10:05:03'),
(73, 34, 'Project phase updated to development', '2025-04-14 10:05:16'),
(74, 34, 'Project phase updated to requirement-gat', '2025-04-14 10:05:21'),
(75, 34, 'Project phase updated to deployment', '2025-04-14 10:05:25'),
(76, 34, 'Project phase updated to maintenance', '2025-04-14 10:05:30'),
(77, 34, 'Project phase updated to maintenance', '2025-04-14 10:13:50'),
(78, 34, 'Project phase updated to design', '2025-04-14 11:31:53'),
(79, 34, 'Project phase updated to development', '2025-04-14 11:32:00'),
(80, 34, 'Project phase updated to testing', '2025-04-14 11:32:06'),
(81, 34, 'Project phase updated to development', '2025-04-14 11:32:31'),
(82, 34, 'Project phase updated to development', '2025-04-14 11:32:36'),
(83, 34, 'Project phase updated to development', '2025-04-14 11:32:40'),
(84, 34, 'Project phase updated to deployment', '2025-04-14 11:32:47'),
(85, 34, 'Project phase updated to deployment', '2025-04-14 11:32:51'),
(86, 34, 'Project status updated to completed', '2025-04-14 11:46:33'),
(87, 34, 'Project phase updated to development', '2025-04-14 11:47:33'),
(88, 34, 'Project phase updated to design', '2025-04-14 11:47:37'),
(89, 34, 'Project status updated to on-hold', '2025-04-14 11:47:41'),
(90, 34, 'Project status updated to ongoing', '2025-04-14 11:47:45'),
(91, 34, 'Project status updated to on-hold', '2025-04-14 11:48:12'),
(92, 38, 'Project status updated to completed', '2025-04-14 11:51:40'),
(93, 38, 'Project status updated to on-hold', '2025-04-14 11:51:44'),
(94, 38, 'Project status updated to ongoing', '2025-04-14 11:53:19'),
(95, 38, 'Project status updated to completed', '2025-04-14 11:54:55'),
(96, 38, 'Project status updated to completed', '2025-04-14 11:55:18'),
(97, 38, 'Project phase updated to requirement-gathering', '2025-04-14 12:07:50'),
(98, 38, 'Project status updated to completed', '2025-04-14 12:07:54'),
(99, 38, 'Project status updated to cancelled', '2025-04-14 12:07:58'),
(100, 35, 'Deleted document id = 35', '2025-04-14 14:09:52'),
(101, 39, 'creating the project ', '2025-04-14 14:14:01'),
(102, 39, 'Deleted document id 39', '2025-04-14 14:16:14'),
(103, 36, 'Project status updated to completed', '2025-04-14 14:29:38'),
(104, 36, 'Project status updated to completed', '2025-04-14 14:29:42'),
(105, 36, 'Project status updated to completed', '2025-04-14 14:29:46'),
(106, 36, 'Project status updated to ongoing', '2025-04-14 14:30:12'),
(107, 39, 'Document uploaded: proposal', '2025-04-14 16:19:06'),
(108, 39, 'Document uploaded: proposal', '2025-04-14 16:20:35'),
(109, 39, 'Document uploaded: proposal', '2025-04-14 16:20:37'),
(110, 39, 'Document uploaded: proposal', '2025-04-14 16:20:38'),
(111, 39, 'Document uploaded: proposal', '2025-04-14 16:21:34'),
(112, 39, 'Deleted document id 39', '2025-04-14 16:21:46'),
(113, 39, 'Deleted document id 39', '2025-04-14 16:21:50'),
(114, 39, 'Deleted document id 39', '2025-04-14 16:21:54'),
(115, 39, 'Deleted document id 39', '2025-04-14 16:21:58'),
(116, 39, 'Deleted document id 13', '2025-04-14 16:23:02'),
(117, 39, 'Document uploaded: proposal', '2025-04-14 16:23:13'),
(118, 39, 'Document uploaded: proposal', '2025-04-14 16:23:21'),
(119, 39, 'Document uploaded: proposal', '2025-04-14 16:23:25'),
(120, 39, 'Deleted document id 15', '2025-04-14 16:23:28'),
(121, 39, 'Deleted document id 16', '2025-04-14 16:23:38'),
(122, 39, 'Project status updated to ongoing', '2025-04-14 16:24:58'),
(123, 39, 'Project status updated to completed', '2025-04-14 16:25:44'),
(124, 39, 'Project phase updated to design', '2025-04-14 16:26:02'),
(125, 39, 'Document uploaded: proposal', '2025-04-14 16:29:04'),
(126, 39, 'Document uploaded: proposal', '2025-04-14 16:29:16'),
(127, 39, 'Document uploaded: proposal', '2025-04-14 16:29:22'),
(128, 39, 'Document uploaded: proposal12', '2025-04-14 16:29:59'),
(129, 39, 'Document uploaded: proposal12', '2025-04-14 16:30:04'),
(130, 39, 'Deleted document id 18', '2025-04-14 16:30:13'),
(131, 39, 'Deleted document id 21', '2025-04-14 16:30:19'),
(132, 39, 'Deleted document id 17', '2025-04-14 16:30:29'),
(133, 39, 'Deleted document id 22', '2025-04-14 16:30:32'),
(134, 39, 'Deleted document id 19', '2025-04-14 16:30:35'),
(135, 39, 'Deleted document id 20', '2025-04-14 16:30:37'),
(136, 39, 'Document uploaded: proposal12', '2025-04-14 16:30:50'),
(137, 39, 'Document uploaded: proposal12', '2025-04-14 16:30:54'),
(138, 39, 'Document uploaded: proposal', '2025-04-14 16:32:04'),
(139, 39, 'Deleted document id 23', '2025-04-14 16:32:08'),
(140, 39, 'Document uploaded: proposal12', '2025-04-14 16:32:19'),
(141, 39, 'Document uploaded: fds', '2025-04-14 16:34:07'),
(142, 39, 'Document uploaded: fds', '2025-04-14 16:35:37'),
(143, 39, 'Document uploaded: proposal', '2025-04-14 16:38:38'),
(144, 39, 'Deleted document id 24', '2025-04-14 16:39:05'),
(145, 39, 'Deleted document id 25', '2025-04-14 16:39:08'),
(146, 39, 'Deleted document id 26', '2025-04-14 16:39:10'),
(147, 39, 'Deleted document id 28', '2025-04-14 16:39:12'),
(148, 39, 'Deleted document id 29', '2025-04-14 16:39:15'),
(149, 39, 'Deleted document id 27', '2025-04-14 16:39:18'),
(150, 39, 'Document uploaded: fds', '2025-04-14 16:39:30'),
(151, 39, 'Document uploaded: sdc', '2025-04-14 16:46:22'),
(152, 39, 'Document uploaded: proposal12', '2025-04-14 16:46:38'),
(153, 39, 'Document uploaded: proposal', '2025-04-14 16:47:08'),
(154, 39, 'Deleted document id 30', '2025-04-14 16:47:26'),
(155, 39, 'Deleted document id 31', '2025-04-14 16:47:30'),
(156, 39, 'Deleted document id 32', '2025-04-14 16:47:32'),
(157, 39, 'Deleted document id 33', '2025-04-14 16:47:34'),
(158, 40, 'creating the project', '2025-04-16 05:01:43'),
(159, 3, 'Project status updated to ongoing', '2025-04-25 18:32:30'),
(160, 3, 'Document uploaded: proposal', '2025-04-25 18:42:01'),
(161, 3, 'Project phase updated to requirement-gathering', '2025-04-25 18:47:03'),
(162, 3, 'Deleted document id 35', '2025-04-25 18:52:00'),
(163, 41, 'creating the project', '2025-04-26 05:16:04'),
(164, 41, 'Project status updated to cancelled', '2025-04-26 18:39:05'),
(165, 41, 'Project status updated to cancelled', '2025-04-26 18:39:39'),
(166, 37, 'Project phase updated to Execution', '2025-04-26 18:43:40'),
(167, 37, 'Document uploaded: consult', '2025-04-26 18:46:05'),
(168, 37, 'Deleted document id 36', '2025-04-26 18:52:57'),
(169, 37, 'Document uploaded: proposal', '2025-04-27 15:21:26'),
(170, 37, 'Project status updated to ongoing', '2025-04-27 15:21:54'),
(171, 37, 'Project phase updated to Planning', '2025-04-27 15:22:04');

-- --------------------------------------------------------

--
-- Table structure for table `providerrequests`
--

CREATE TABLE `providerrequests` (
  `reqId` int(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `field` varchar(255) NOT NULL,
  `specialty` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'set',
  `createdAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `providerrequests`
--

INSERT INTO `providerrequests` (`reqId`, `full_name`, `email`, `phone`, `address`, `field`, `specialty`, `status`, `createdAt`) VALUES
(10, 'Jackie Wilson', 'jackiewilson@example.com', '3456789019', '109 Oak St, Lincoln, NE 68501', 'Organizational Development', 'Consultant', 'unset', '2025-04-24 07:32:42'),
(11, 'Kevin Morgan', 'kevinmorgan@example.com', '4567890120', '110 Cedar St, Trenton, NJ 08608', 'Development Finance', 'Researcher', 'unset', '2025-04-24 07:32:42'),
(12, 'Laura Phillips', 'lauraphillips@example.com', '5678901231', '111 Elm St, Raleigh, NC 27601', 'Micro Finance', 'Trainer', 'set', '2025-04-24 07:32:42'),
(13, 'Michael Evans', 'michaelevans@example.com', '6789012342', '112 Maple St, Providence, RI 02903', 'Gender Finance', 'Consultant', 'set', '2025-04-24 07:32:42'),
(14, 'Nina Turner', 'ninaturner@example.com', '7890123453', '113 Walnut St, Cheyenne, WY 82001', 'SME Development', 'Researcher', 'set', '2025-04-24 07:32:42'),
(15, 'Oscar Long', 'oscarlong@example.com', '8901234564', '114 Fir St, Charleston, WV 25301', 'Strategic and Operations Planning', 'Trainer', 'set', '2025-04-24 07:32:42'),
(16, 'Peter Grant', 'petergrant@example.com', '2345678910', '202 Pine St, Hartford, CT 06101', 'Institutional Development', 'Consultant', 'set', '2025-04-24 07:32:42'),
(18, 'Rachel Ingram', 'rachelingram@example.com', '4567890132', '204 Elm St, Frankfort, KY 40601', 'Organizational Development', 'Trainer', 'set', '2025-04-24 07:32:42'),
(19, 'Samuel Jennings', 'samueljennings@example.com', '5678901243', '205 Maple St, Columbus, OH 43201', 'Development Finance', 'Consultant', 'set', '2025-04-24 07:32:42'),
(20, 'Tina Keller', 'tinakeller@example.com', '6789012354', '206 Walnut St, Raleigh, NC 27601', 'Micro Finance', 'Researcher', 'unset', '2025-04-24 07:32:42'),
(21, 'Ursula Lewis', 'ursulalewis@example.com', '7890123465', '207 Fir St, Charleston, WV 25301', 'Gender Finance', 'Trainer', 'unset', '2025-04-24 07:32:42'),
(22, 'Victor Martin', 'victormartin@example.com', '8901234576', '208 Poplar St, Albany, NY 12207', 'SME Development', 'Consultant', 'unset', '2025-04-24 07:32:42'),
(23, 'Wendy Nelson', 'wendynelson@example.com', '9012345687', '209 Birch St, Madison, WI 53703', 'Strategic and Operations Planning', 'Researcher', 'unset', '2025-04-24 07:32:42'),
(24, 'Xander Ortiz', 'xanderortiz@example.com', '1234567898', '210 Spruce St, Lincoln, NE 68501', 'Institutional Development', 'Trainer', 'unset', '2025-04-24 07:32:42'),
(25, 'Yara Price', 'yaraprice@example.com', '2345678909', '211 Oak St, Concord, NH 03301', 'Community Development', 'Consultant', 'set', '2025-04-24 07:32:42'),
(26, 'Zane Quinn', 'zanequinn@example.com', '3456789010', '212 Cedar St, Springfield, IL 62701', 'Organizational Development', 'Researcher', 'unset', '2025-04-24 07:32:42'),
(27, 'Alice Rose', 'alicerose@example.com', '4567890121', '213 Maple St, Salem, OR 97301', 'Development Finance', 'Trainer', 'unset', '2025-04-24 07:32:42'),
(28, 'Ben Stark', 'benstark@example.com', '5678901232', '214 Fir St, Helena, MT 59601', 'Micro Finance', 'Consultant', 'unset', '2025-04-24 07:32:42'),
(29, 'Cathy Taylor', 'cathytaylor@example.com', '6789012343', '215 Elm St, Boise, ID 83702', 'Gender Finance', 'Researcher', 'unset', '2025-04-24 07:32:42'),
(30, 'Daniel Urban', 'danielurban@example.com', '7890123454', '216 Walnut St, Austin, TX 73301', 'SME Development', 'Trainer', 'unset', '2025-04-24 07:32:42'),
(40, 'Tharusha Nemantha', 'nemanathatharusha@gmail.com', '0711850441', 'Saumya Darshana Galwalawatta Road Bombuwala Kalutara South', 'Development Finance', 'Researcher', 'unset', '2025-04-24 07:32:42'),
(41, 'Tharusha Nemantha', 'nemanatha@gmail.com', '0711850441', 'Saumya Darshana Galwalawatta Road Bombuwala Kalutara South', 'Development Finance', 'Researcher', 'unset', '2025-04-24 07:32:42'),
(42, 'Tharusha Nemantha', 'nemana@gmail.com', '0711850441', 'Saumya Darshana Galwalawatta Road Bombuwala Kalutara South', 'Development Finance', 'Researcher', 'unset', '2025-04-24 07:32:42'),
(43, 'Tharusha Nemantha', 'nemanthatharusha@gmail.com', '0711850441', 'Saumya Darshana Galwalawatta Road Bombuwala Kalutara South', 'Micro Finance', 'Consultant', 'unset', '2025-04-24 07:32:42'),
(44, 'safran zahim', 'ivteam0123@gmail.com', '0705083388', '24/2,Steel road,galle', 'Community Development', 'Researcher', 'unset', '2025-04-25 21:04:35'),
(45, 'Tharusha Nemantha', 'worker@gmail.com', '0711850441', 'Saumya Darshana Galwalawatta Road Bombuwala Kalutara South', 'Gender Finance', 'Researcher', 'set', '2025-04-26 13:47:13'),
(46, 'Tharusha Nemantha', 'providerNema@gmail.com', '0711850441', 'Saumya Darshana Galwalawatta Road Bombuwala Kalutara South', 'Institutional Development', 'Researcher', 'set', '2025-04-27 11:49:39');

-- --------------------------------------------------------

--
-- Table structure for table `researchpapers`
--

CREATE TABLE `researchpapers` (
  `paper_id` int(11) NOT NULL,
  `provider_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `published_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `researchpapers`
--

INSERT INTO `researchpapers` (`paper_id`, `provider_id`, `title`, `content`, `published_at`) VALUES
(1, 1, 'Developing Data-Driven Investment Strategies', 'A research-based case study on how a consultancy firm collaborated with an asset management company to leverage big data in investment decision-making. The project involved analyzing historical market trends and training the company’s investment team on advanced analytics tools. The result was a portfolio that outperformed benchmarks by 15% over a fiscal year.', '2024-11-30 12:46:59'),
(3, 1, 'Launching a Start-Up Incubation Training Program in FinTech', 'A consultancy firm designed and implemented a specialized training program for budding entrepreneurs in the FinTech sector. The program included modules on raising capital, financial modeling, and market analysis. Over a year, 60% of the participants successfully launched their start-ups, with several securing venture capital funding.', '2024-11-30 13:00:03'),
(4, 1, 'Improving Financial Governance in Public Sector Projects', 'This case study examines how a consultancy firm collaborated with a government agency to enhance financial governance in infrastructure projects. The initiative involved researching governance gaps, implementing monitoring frameworks, and training officials on financial accountability. The result was improved project delivery times and significant reductions in budget overruns.', '2024-11-30 13:00:35'),
(5, 1, 'Empowering Rural Entrepreneurs through Development Finance', 'This case study explores how a consultancy partnered with a development bank to design loan programs targeting rural entrepreneurs. The initiative provided low-interest loans alongside financial literacy training. Over two years, 500 entrepreneurs accessed funding, with a 95% repayment rate, contributing to local economic growth and employment generation.', '2024-11-30 13:13:21'),
(6, 1, 'Promoting Financial Inclusion through Gender-Focused Investment', 'This case study highlights a consultancy\'s effort to design gender-sensitive financial products for a commercial bank. Through market research and workshops, the bank developed flexible savings and loan packages for women. Within a year, 25,000 women enrolled, with 60% using the funds for education and business expansion.\r\n\r\n', '2024-11-30 13:13:44'),
(7, 1, 'Supporting SMEs with Customized Development Plans', 'A consultancy firm worked with regional SMEs to enhance their growth potential. Services included market analysis, funding access, and operational training. The case study documents the growth of a local textile SME, which doubled its production capacity and expanded its market reach by 30% in two years.', '2024-11-30 13:14:29'),
(8, 1, 'Developing a Strategic Plan for a National Nonprofit Organization', 'A nonprofit organization enlisted a consultancy to create a strategic plan focused on expanding its services. The plan included setting measurable goals, optimizing resource allocation, and enhancing stakeholder engagement. Over three years, the nonprofit increased its outreach by 50% and secured consistent donor funding.', '2024-11-30 13:14:47'),
(9, 1, 'Empowering Local Communities through Sustainable Development Project', 'This case study examines how a consultancy helped a rural community design and implement a clean water project. By facilitating stakeholder meetings and securing funding, the project benefited over 2,000 residents. Training on water resource management ensured long-term sustainability.', '2024-11-30 13:15:04'),
(14, 1, 'Boosting Finance', 'i want to do this in three years or four years', '2025-04-23 07:31:09');

-- --------------------------------------------------------

--
-- Table structure for table `serviceproviders`
--

CREATE TABLE `serviceproviders` (
  `provider_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `gender` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `field` varchar(255) NOT NULL,
  `speciality` varchar(255) DEFAULT NULL,
  `introduction` text DEFAULT NULL,
  `service_description` text DEFAULT NULL,
  `certifications` text DEFAULT NULL,
  `awards` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) NOT NULL DEFAULT 'set',
  `last_login` datetime DEFAULT NULL,
  `last_logout` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `serviceproviders`
--

INSERT INTO `serviceproviders` (`provider_id`, `username`, `password`, `profile_image`, `full_name`, `gender`, `email`, `phone`, `address`, `field`, `speciality`, `introduction`, `service_description`, `certifications`, `awards`, `created_at`, `status`, `last_login`, `last_logout`) VALUES
(1, 'serv1', 'provider', '../images/1745765242_icons8-phone-number-50.png', 'Provider one', 'Male', 'provider@gmail.com', '0771234567', '32, nelson place', 'Finance', 'Consulting', 'Name and Title: Safran, Financial Consultant & Corporate TrainerExperience:\"With over 10 years of experience in financial consulting, strategic planning, and corporate training, I help businesses strengthen their financial foundation and achieve long-term success.\"Mission Statement:\"My mission is to empower organizations and professionals with practical financial strategies and skills through tailored consultation and impactful training programs.\"', 'Focus Areas:Financial planning and analysis,Investment strategy development, Corporate training on financial literacy and compliance Budgeting and cost control Regulatory and risk management \r\nTarget Audience:\"I collaborate with startups, SMEs, and nonprofit organizations seeking expert financial guidance and staff training to improve their decision-making and profitability.\"\r\nApproach:\"My approach is results-driven and client-centric. I combine data analysis, industry best practices, and personalized mentoring to create sustainable financial strategies.\"Services Offered:Financial consultation and risk assessment Cash flow and budget optimization Corporate finance training sessions (in-person/virtual)Financial reporting and KPI analysis Customized workshops for finance teams', 'Certified Financial Consultant (CFC)Professional Trainer – Certified Corporate Trainer (CCT)\r\nMBA in Finance and Strategic Management\r\nLicensed Business Advisor – National Finance Board', 'Financial Consultant of the Year – Global Finance Awards, 2022\r\nBest Training Delivery – National Training Summit, 2021\r\nExcellence in SME Financial Strategy – Business Innovators Forum, 2020                                                                               ', '2024-09-11 13:41:44', 'set', '2025-04-27 20:27:40', '2025-04-27 20:23:33'),
(2, 'serv2', 'serv2@123', NULL, 'Serv Two', '', 'serv2@gmail.com', '0762878056', 'Maharagama', '', 'Consultant', NULL, NULL, NULL, NULL, '2024-09-11 13:41:44', 'set', '2025-04-21 19:35:57', NULL),
(3, 'serv3', 'saada', NULL, 'Serv three', '', 'serv3@gmail.com', '04557412574', 'Kalutara', '', 'Research', NULL, NULL, NULL, NULL, '2024-11-11 13:21:23', 'set', '2025-04-21 19:35:57', NULL),
(4, 'serv4', 'serv4123', NULL, 'Serv four', '', 'serv4@gmail.com', NULL, 'Mathugama', '', 'Training', NULL, NULL, NULL, NULL, '2024-11-11 13:21:23', 'set', '2025-04-21 19:35:57', NULL),
(5, 'john34', '^_Vh0CCycE', NULL, 'Michael Elliott', '', 'courtneyedwards@hotmail.com', '2025628403', '813 Ashley Roads, West Virginia, MD 79874', '', 'Consultant', NULL, NULL, NULL, NULL, '2024-11-11 13:21:52', 'set', '2025-04-21 19:35:57', NULL),
(6, 'zstephens', '(5G%oTzC%+', NULL, 'Charles Brooks', '', 'rebeccaarmstrong@alvarez.com', '8431540366', '4980 Elizabeth Trace Apt. 055, Tranmouth, OR 69110', '', 'Consultant', NULL, NULL, NULL, NULL, '2024-11-11 13:21:52', 'set', '2025-04-21 19:35:57', NULL),
(7, 'marksutton', 'LQW4El3zz!', NULL, 'Joel Snyder', '', 'glorialewis@miller.org', '7129304418', 'PSC 4640, Box 5916, APO AE 72890', '', 'Researcher', NULL, NULL, NULL, NULL, '2024-11-11 13:21:52', 'set', '2025-04-21 19:35:57', NULL),
(8, 'matthewmckinney', '0OWODzib#c', NULL, 'Bailey Suarez', '', 'newtoncynthia@williams.com', '3734585636', '1088 Rodriguez Highway, Andradeberg, CA 74634', '', 'Consultant', NULL, NULL, NULL, NULL, '2024-11-11 13:21:52', 'set', '2025-04-21 19:35:57', NULL),
(9, 'melissamitchell', 'zQAKEnLM^5', NULL, 'Andrea Nguyen', '', 'hramos@hotmail.com', '7613228676', '63788 John Crescent Apt. 379, Davidburgh, WV 49512', '', 'Training', NULL, NULL, NULL, NULL, '2024-11-11 13:21:52', 'set', '2025-04-21 19:35:57', NULL),
(10, 'michaelhernandez', 'L9MN_XJh&i', NULL, 'Brian Page', '', 'brownjohn@yahoo.com', '7199545475', '741 Melissa Square, West Joe, WA 53747', '', 'Training', NULL, NULL, NULL, NULL, '2024-11-11 13:21:52', 'set', '2025-04-21 19:35:57', NULL),
(11, 'ujones', 'P83BA0BG@i', NULL, 'April Jackson', '', 'qthompson@brown.com', '2630158350', '21049 Hill Junctions Apt. 769, West Joe, GA 14634', '', 'Researcher', NULL, NULL, NULL, NULL, '2024-11-11 13:21:52', 'set', '2025-04-21 19:35:57', NULL),
(12, 'kristen03', 'i+7RB6sqrQ', NULL, 'Tracy Thompson', '', 'ysanders@hotmail.com', '7484203810', '750 Ochoa Throughway Suite 891, Danielport, NJ 55840', '', 'Training', NULL, NULL, NULL, NULL, '2024-11-11 13:21:52', 'set', '2025-04-21 19:35:57', NULL),
(13, 'beckersandy', ')(1ieNa4h2', NULL, 'Darren Torres', '', 'qcline@gmail.com', '6877089823', '265 Judy Extension Suite 476, Jonathanshire, SD 05413', '', 'Researcher', NULL, NULL, NULL, NULL, '2024-11-11 13:21:52', 'set', '2025-04-21 19:35:57', NULL),
(14, 'jeremiah37', ')jKpRQW1!3', NULL, 'Scott Johnson', '', 'raymondwoods@powell.net', '4279101928', '3850 Castaneda Cove Apt. 965, West Bryan, KS 80821', '', 'Training', NULL, NULL, NULL, NULL, '2024-11-11 13:21:52', 'set', '2025-04-21 19:35:57', NULL),
(15, 'candacecampos', '(bpsEtr^6w', NULL, 'Theresa Conrad', '', 'lwilliams@scott.com', '5702311072', '6083 Rebecca Land Suite 719, Jenniferfort, AR 38591', '', 'Researcher', NULL, NULL, NULL, NULL, '2024-11-11 13:21:52', 'set', '2025-04-21 19:35:57', NULL),
(16, 'shepherdedward', '23K3+(z*)k', NULL, 'Teresa Ford', '', 'vmiles@atkins.biz', '1797694729', 'PSC 8370, Box 4487, APO AP 12793', '', 'Researcher', NULL, NULL, NULL, NULL, '2024-11-11 13:21:52', 'set', '2025-04-21 19:35:57', NULL),
(17, 'egriffin', '_BpGNEgFD4', NULL, 'William Davis', '', 'david22@hotmail.com', '1649378091', '122 Valencia Garden, Port Christina, ME 40384', '', 'Consultant', NULL, NULL, NULL, NULL, '2024-11-11 13:21:52', 'set', '2025-04-21 19:35:57', NULL),
(18, 'gjohnson', 'Ek&4MraHl$', NULL, 'Bradley Knapp', '', 'leelaura@long-mueller.com', '4111826741', '6041 Rodriguez Ports Suite 799, Schroederburgh, VA 80992', '', 'Consultant', NULL, NULL, NULL, NULL, '2024-11-11 13:21:52', 'set', '2025-04-21 19:35:57', NULL),
(19, 'andreahenry', '+LIJdrL76u', NULL, 'Philip Hull', '', 'fwalters@jackson.biz', '4546924432', 'USCGC Mata, FPO AA 76880', '', 'Researcher', NULL, NULL, NULL, NULL, '2024-11-11 13:21:52', 'set', '2025-04-21 19:35:57', NULL),
(20, 'howelltimothy', '3^Ri&^$P)5', NULL, 'Tina Clark', '', 'sandra21@warren.com', '8077561183', '970 Sanders Turnpike, Johnsonberg, OK 16303', '', 'Training', NULL, NULL, NULL, NULL, '2024-11-11 13:21:52', 'set', '2025-04-21 19:35:57', NULL),
(21, 'matthew07', '0a9TR0i0o+', NULL, 'Felicia Dennis', '', 'jessica49@yahoo.com', '1873911557', '949 Andrea Parkway Apt. 738, Mariashire, MI 96601', '', 'Consultant', NULL, NULL, NULL, NULL, '2024-11-11 13:21:52', 'set', '2025-04-21 19:35:57', NULL),
(22, 'angela34', 'E_kNswJ^!8', NULL, 'Ivan Lee', '', 'barkerbonnie@hotmail.com', '1621373853', '88629 Bell Via, Joshuaport, VT 57292', '', 'Researcher', NULL, NULL, NULL, NULL, '2024-11-11 13:21:52', 'set', '2025-04-21 19:35:57', NULL),
(23, 'nhawkins', '#I7ZIQKrh7', NULL, 'Erin Schwartz', '', 'leslie01@hotmail.com', '1476297302', '816 Desiree Crossing Apt. 285, Martinezfort, LA 23359', '', 'Training', NULL, NULL, NULL, NULL, '2024-11-11 13:21:52', 'set', '2025-04-21 19:35:57', NULL),
(24, 'yhill', '^!lEul)O$9', NULL, 'Anita Warren', '', 'hannah58@shaw.biz', '3299100598', '836 Schmidt Way Apt. 939, Carolland, NY 02863', '', 'Training', NULL, NULL, NULL, NULL, '2024-11-11 13:21:52', 'set', '2025-04-21 19:35:57', NULL),
(25, 'gomezrandy', '31c&%BEp$8', NULL, 'George Meyers', '', 'imarshall@glass.net', '7204137074', '84942 Joseph Forge Suite 866, East Christianland, HI 89129', '', 'Researcher', NULL, NULL, NULL, NULL, '2024-11-11 13:21:52', 'set', '2025-04-21 19:35:57', NULL),
(26, 'daniellezavala', '$Y@B0iKN2h', NULL, 'Chase Watts', '', 'ckirby@gmail.com', '9468078992', '839 Andrea Junctions, Gonzalesfurt, IA 02925', '', 'Consultant', NULL, NULL, NULL, NULL, '2024-11-11 13:21:52', 'set', '2025-04-21 19:35:57', NULL),
(27, 'kari46', '+Wfr9B6u!)', NULL, 'Amanda Nelson', '', 'matthew85@hotmail.com', '6562779694', '5819 Simpson Plaza Apt. 810, West Philipburgh, RI 76592', '', 'Training', NULL, NULL, NULL, NULL, '2024-11-11 13:21:52', 'set', '2025-04-21 19:35:57', NULL),
(28, 'davisderek', '9$Ui0iUh!+', NULL, 'Tracy Robertson', '', 'georgecoleman@yahoo.com', '4065946180', '65950 Roger Way Apt. 610, Port Hannah, MD 25584', '', 'Consultant', NULL, NULL, NULL, NULL, '2024-11-11 13:21:52', 'set', '2025-04-21 19:35:57', NULL),
(29, 'karenbarber', '+zp39wWq(k', NULL, 'Casey Chen', '', 'leebrad@yahoo.com', '6550867049', '919 Kayla Mission Apt. 295, Port Paigetown, AK 72546', '', 'Training', NULL, NULL, NULL, NULL, '2024-11-11 13:21:52', 'set', '2025-04-21 19:35:57', NULL),
(30, 'patriciamartinez', '@6!9RKcwH2', NULL, 'Judy Carter', '', 'peter98@yahoo.com', '9499620843', '1403 Sara Extension Apt. 307, Archerport, PA 40615', '', 'Researcher', NULL, NULL, NULL, NULL, '2024-11-11 13:21:52', 'set', '2025-04-21 19:35:57', NULL),
(31, 'matthew13', 'z@K6Fu6U^n', NULL, 'Bruce Mcdonald', '', 'zmendoza@gmail.com', '2859894883', '943 Anthony Falls, West Jaime, FL 02285', '', 'Consultant', NULL, NULL, NULL, NULL, '2024-11-11 13:21:52', 'set', '2025-04-21 19:35:57', NULL),
(32, 'mercerlee', '@pZKp5@p*4', NULL, 'Jimmy Blevins', '', 'tjacobs@gmail.com', '4016145015', '91487 Cummings Meadows, Brianafurt, MS 11355', '', 'Consultant', NULL, NULL, NULL, NULL, '2024-11-11 13:21:52', 'set', '2025-04-21 19:35:57', NULL),
(33, 'jessicasmith', '%65WMg7BQc', NULL, 'Olivia Morgan', '', 'aaronlloyd@hotmail.com', '7565104041', '1731 Kim Street Apt. 205, Lake Briannachester, TX 12456', '', 'Researcher', NULL, NULL, NULL, NULL, '2024-11-11 13:21:52', 'set', '2025-04-21 19:35:57', NULL),
(34, 'velezjonathan', 'o7ZRF6Se#H', NULL, 'Oscar Bell', '', 'james64@hotmail.com', '2395835183', '32655 Hill Hollow, Grantfurt, WY 45613', '', 'Consultant', NULL, NULL, NULL, NULL, '2024-11-11 13:21:52', 'set', '2025-04-21 19:35:57', NULL),
(35, 'Carla Green', '726737', NULL, 'Carla Green', '', 'carlagreen@example.com', '5678901232', '102 Elm St, Nashville, TN 37201', 'Development Finance', NULL, NULL, NULL, NULL, NULL, '2024-11-20 05:29:17', 'set', '2025-04-21 19:35:57', NULL),
(36, 'David Brooks', '419073', NULL, 'David Brooks', '', 'davidbrooks@example.com', '6789012343', '103 Maple St, Salem, OR 97301', 'Micro Finance', 'Consultant', NULL, NULL, NULL, NULL, '2024-11-20 05:31:29', 'set', '2025-04-21 19:35:57', NULL),
(37, 'Evelyn Harris', '413752', NULL, 'Evelyn Harris', '', 'evelynharris@example.com', '7890123454', '104 Walnut St, Boise, ID 83702', 'Gender Finance', 'Researcher', NULL, NULL, NULL, NULL, '2024-11-20 06:21:17', 'set', '2025-04-21 19:35:57', NULL),
(38, 'Frank Miller', '851368', NULL, 'Frank Miller', '', 'frankmiller@example.com', '8901234565', '105 Fir St, Helena, MT 59601', 'SME Development', 'Trainer', NULL, NULL, NULL, NULL, '2024-11-20 06:26:08', 'set', '2025-04-21 19:35:57', NULL),
(39, 'Irene Scott', '181649', NULL, 'Irene Scott', '', 'irenescott@example.com', '2345678908', '108 Spruce St, Madison, WI 53703', 'Community Development', 'Trainer', NULL, NULL, NULL, NULL, '2024-11-22 09:59:18', 'set', '2025-04-21 19:35:57', NULL),
(41, 'nemanthaT', '$2y$10$00MgtwFyopqsdhMwqj2kc.BS67ChVVbFhNEGqP3wIk4daNH6Pfh4i', NULL, 'Tharusha Nemantha', '', 'tharusha1@gmail.com', '0711850441', 'Kalutara', '', 'Consultant', NULL, NULL, NULL, NULL, '2024-11-28 07:23:02', 'set', '2025-04-21 19:35:57', NULL),
(42, 'Navindu Thila', '155231', NULL, 'Navindu Thila', '', 'navindu@gmail.com', '07123456789', 'Mathugama', 'Development Finance', 'Researcher', NULL, NULL, NULL, NULL, '2024-11-30 04:15:38', 'set', '2025-04-23 19:54:49', NULL),
(43, 'Daniel Urban', '651786', NULL, 'Daniel Urban', '', 'danielurban@example.com', '7890123454', '216 Walnut St, Austin, TX 73301', 'SME Development', 'Trainer', NULL, NULL, NULL, NULL, '2025-04-22 06:14:48', 'set', NULL, NULL),
(44, 'Xander Ortiz', '978348', NULL, 'Xander Ortiz', '', 'xanderortiz@example.com', '1234567898', '210 Spruce St, Lincoln, NE 68501', 'Institutional Development', 'Trainer', NULL, NULL, NULL, NULL, '2025-04-24 18:02:47', 'set', NULL, NULL),
(45, 'Zane Quinn', '165237', NULL, 'Zane Quinn', '', 'zanequinn@example.com', '3456789010', '212 Cedar St, Springfield, IL 62701', 'Organizational Development', 'Researcher', NULL, NULL, NULL, NULL, '2025-04-24 18:27:00', 'set', NULL, NULL),
(46, 'Kevin Morgan', '188569', NULL, 'Kevin Morgan', '', 'kevinmorgan@example.com', '4567890120', '110 Cedar St, Trenton, NJ 08608', 'Development Finance', 'Researcher', NULL, NULL, NULL, NULL, '2025-04-24 18:38:18', 'set', NULL, NULL),
(48, 'Ben Stark', '341880', NULL, 'Ben Stark', '', 'benstark@example.com', '5678901232', '214 Fir St, Helena, MT 59601', 'Micro Finance', 'Consultant', NULL, NULL, NULL, NULL, '2025-04-24 18:39:22', 'set', NULL, NULL),
(49, 'Wendy Nelson', '360127', NULL, 'Wendy Nelson', '', 'wendynelson@example.com', '9012345687', '209 Birch St, Madison, WI 53703', 'Strategic and Operations Planning', 'Researcher', NULL, NULL, NULL, NULL, '2025-04-24 18:41:28', 'set', NULL, NULL),
(50, 'Alice Rose', '558017', NULL, 'Alice Rose', '', 'alicerose@example.com', '4567890121', '213 Maple St, Salem, OR 97301', 'Development Finance', 'Trainer', NULL, NULL, NULL, NULL, '2025-04-24 18:53:20', 'set', NULL, NULL),
(51, 'Tina Keller', '706379', NULL, 'Tina Keller', '', 'tinakeller@example.com', '6789012354', '206 Walnut St, Raleigh, NC 27601', 'Micro Finance', 'Researcher', NULL, NULL, NULL, NULL, '2025-04-24 18:57:02', 'set', NULL, NULL),
(52, 'Jackie Wilson', '885922', NULL, 'Jackie Wilson', '', 'jackiewilson@example.com', '3456789019', '109 Oak St, Lincoln, NE 68501', 'Organizational Development', 'Consultant', NULL, NULL, NULL, NULL, '2025-04-24 19:02:20', 'set', NULL, NULL),
(53, 'safran zahim', '122216', NULL, 'safran zahim', '', 'ivteam0123@gmail.com', '0705083388', '24/2,Steel road,galle', 'Community Development', 'Researcher', NULL, NULL, NULL, NULL, '2025-04-25 19:05:08', 'set', '2025-04-25 21:07:14', '2025-04-25 21:13:22'),
(54, 'Ursula Lewis', '316027', NULL, 'Ursula Lewis', '', 'ursulalewis@example.com', '7890123465', '207 Fir St, Charleston, WV 25301', 'Gender Finance', 'Trainer', NULL, NULL, NULL, NULL, '2025-04-26 18:18:56', 'set', NULL, NULL),
(55, 'Victor Martin', '233244', NULL, 'Victor Martin', '', 'victormartin@example.com', '8901234576', '208 Poplar St, Albany, NY 12207', 'SME Development', 'Consultant', NULL, NULL, NULL, NULL, '2025-04-26 18:48:11', 'set', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `servicerequests`
--

CREATE TABLE `servicerequests` (
  `request_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `provider_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Pending',
  `requested_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `servicerequests`
--

INSERT INTO `servicerequests` (`request_id`, `client_id`, `service_id`, `provider_id`, `status`, `requested_at`) VALUES
(3, 2, 1, 2, 'Pending', '2024-11-02 12:57:45'),
(4, 3, 2, 1, 'Pending', '2024-11-02 12:57:45'),
(5, 15, 5, 2, 'Pending', '2024-07-18 18:30:00'),
(6, 26, 6, 6, 'Pending', '2024-07-19 18:30:00'),
(7, 14, 7, 27, 'Pending', '2024-07-20 18:30:00'),
(8, 19, 8, 8, 'Pending', '2024-07-21 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `name`, `description`, `price`, `created_at`) VALUES
(1, 'Gender finance', 'Gender finance advices', 20000.00, '2024-11-02 12:57:10'),
(2, 'Micro business', 'Micro business advices', 25000.00, '2024-11-02 12:57:10'),
(3, 'Gender Finance Training', 'Training on gender-responsive finance practices to promote equality in financial services.', 800.00, '2024-03-04 18:30:00'),
(4, 'SME Development Consultancy', 'Guidance for small and medium enterprises to achieve sustainable growth.', 1500.00, '2024-04-17 18:30:00'),
(5, 'Strategic and Operations Planning', 'Consultancy on strategic planning and operational efficiency.', 1800.00, '2024-05-24 18:30:00'),
(6, 'Institutional Development Research', 'Research on institutional growth, structure, and process optimization.', 1100.00, '2024-06-13 18:30:00'),
(7, 'Community Development Training', 'Training programs to enhance community-driven development projects.', 700.00, '2024-07-19 18:30:00'),
(8, 'Organizational Development Consultancy', 'Consultancy to improve organizational structures and culture.', 1600.00, '2024-08-29 18:30:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `provider_id` (`provider_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `thread_id` (`thread_id`);

--
-- Indexes for table `chat_threads`
--
ALTER TABLE `chat_threads`
  ADD PRIMARY KEY (`thread_id`),
  ADD UNIQUE KEY `provider_id` (`provider_id`,`client_id`,`topic`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `companyworkers`
--
ALTER TABLE `companyworkers`
  ADD PRIMARY KEY (`worker_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `contactforms`
--
ALTER TABLE `contactforms`
  ADD PRIMARY KEY (`contact_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `contactforums`
--
ALTER TABLE `contactforums`
  ADD PRIMARY KEY (`cf_id`);

--
-- Indexes for table `contactforum_replies`
--
ALTER TABLE `contactforum_replies`
  ADD PRIMARY KEY (`cfr_id`),
  ADD KEY `worker_id` (`worker_id`),
  ADD KEY `cf_id` (`cf_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `worker_id` (`worker_id`);

--
-- Indexes for table `forumreplies`
--
ALTER TABLE `forumreplies`
  ADD PRIMARY KEY (`reply_id`),
  ADD KEY `forum_id` (`forum_id`);

--
-- Indexes for table `forums`
--
ALTER TABLE `forums`
  ADD PRIMARY KEY (`forum_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `knowledgebase`
--
ALTER TABLE `knowledgebase`
  ADD PRIMARY KEY (`id`),
  ADD KEY `worker_id` (`worker_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`),
  ADD KEY `worker_id` (`worker_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`not_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `service_request_id` (`service_request_id`);

--
-- Indexes for table `projectdocuments`
--
ALTER TABLE `projectdocuments`
  ADD PRIMARY KEY (`document_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `projectstatuslogs`
--
ALTER TABLE `projectstatuslogs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `providerrequests`
--
ALTER TABLE `providerrequests`
  ADD PRIMARY KEY (`reqId`);

--
-- Indexes for table `researchpapers`
--
ALTER TABLE `researchpapers`
  ADD PRIMARY KEY (`paper_id`),
  ADD KEY `provider_id` (`provider_id`);

--
-- Indexes for table `serviceproviders`
--
ALTER TABLE `serviceproviders`
  ADD PRIMARY KEY (`provider_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `servicerequests`
--
ALTER TABLE `servicerequests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `provider_id` (`provider_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `bill_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `chat_threads`
--
ALTER TABLE `chat_threads`
  MODIFY `thread_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `companyworkers`
--
ALTER TABLE `companyworkers`
  MODIFY `worker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `contactforms`
--
ALTER TABLE `contactforms`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contactforums`
--
ALTER TABLE `contactforums`
  MODIFY `cf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `contactforum_replies`
--
ALTER TABLE `contactforum_replies`
  MODIFY `cfr_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `forumreplies`
--
ALTER TABLE `forumreplies`
  MODIFY `reply_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forums`
--
ALTER TABLE `forums`
  MODIFY `forum_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `knowledgebase`
--
ALTER TABLE `knowledgebase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `not_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `projectdocuments`
--
ALTER TABLE `projectdocuments`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `projectstatuslogs`
--
ALTER TABLE `projectstatuslogs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT for table `providerrequests`
--
ALTER TABLE `providerrequests`
  MODIFY `reqId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `researchpapers`
--
ALTER TABLE `researchpapers`
  MODIFY `paper_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `serviceproviders`
--
ALTER TABLE `serviceproviders`
  MODIFY `provider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `servicerequests`
--
ALTER TABLE `servicerequests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`provider_id`) REFERENCES `serviceproviders` (`provider_id`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`);

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`);

--
-- Constraints for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD CONSTRAINT `chat_messages_ibfk_1` FOREIGN KEY (`thread_id`) REFERENCES `chat_threads` (`thread_id`);

--
-- Constraints for table `chat_threads`
--
ALTER TABLE `chat_threads`
  ADD CONSTRAINT `chat_threads_ibfk_1` FOREIGN KEY (`provider_id`) REFERENCES `serviceproviders` (`provider_id`),
  ADD CONSTRAINT `chat_threads_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`);

--
-- Constraints for table `contactforms`
--
ALTER TABLE `contactforms`
  ADD CONSTRAINT `contactforms_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`);

--
-- Constraints for table `contactforum_replies`
--
ALTER TABLE `contactforum_replies`
  ADD CONSTRAINT `contactforum_replies_ibfk_1` FOREIGN KEY (`worker_id`) REFERENCES `companyworkers` (`worker_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contactforum_replies_ibfk_2` FOREIGN KEY (`cf_id`) REFERENCES `contactforums` (`cf_id`) ON DELETE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`worker_id`) REFERENCES `companyworkers` (`worker_id`);

--
-- Constraints for table `forumreplies`
--
ALTER TABLE `forumreplies`
  ADD CONSTRAINT `forumreplies_ibfk_1` FOREIGN KEY (`forum_id`) REFERENCES `forums` (`forum_id`);

--
-- Constraints for table `forums`
--
ALTER TABLE `forums`
  ADD CONSTRAINT `forums_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `clients` (`client_id`);

--
-- Constraints for table `knowledgebase`
--
ALTER TABLE `knowledgebase`
  ADD CONSTRAINT `knowledgebase_ibfk_1` FOREIGN KEY (`worker_id`) REFERENCES `companyworkers` (`worker_id`) ON DELETE CASCADE;

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`worker_id`) REFERENCES `companyworkers` (`worker_id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`),
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`service_request_id`) REFERENCES `servicerequests` (`request_id`);

--
-- Constraints for table `researchpapers`
--
ALTER TABLE `researchpapers`
  ADD CONSTRAINT `researchpapers_ibfk_1` FOREIGN KEY (`provider_id`) REFERENCES `serviceproviders` (`provider_id`);

--
-- Constraints for table `servicerequests`
--
ALTER TABLE `servicerequests`
  ADD CONSTRAINT `servicerequests_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`),
  ADD CONSTRAINT `servicerequests_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`),
  ADD CONSTRAINT `servicerequests_ibfk_3` FOREIGN KEY (`provider_id`) REFERENCES `serviceproviders` (`provider_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
