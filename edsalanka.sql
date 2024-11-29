-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2024 at 04:36 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edsalanka`
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `username`, `password`, `email`, `full_name`, `created_at`) VALUES
(1, 'admin', 'admin123', 'admin@123.com', 'Tharusha Nemantha', '2024-08-14 06:37:48');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL,
  `provider_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `appointment_date` datetime DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Scheduled',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `username`, `password`, `email`, `full_name`, `phone`, `address`, `created_at`) VALUES
(1, 'tharu', 'tharusha@123', 'tharu@gmail.com', 'Tharusha Nemantha', '0711850441', 'kalutara', '2024-09-11 12:59:25'),
(2, 'Tamasha', 'tamasha@123', 'tamasha@gmail.com', 'Tamasha Sipsandi', '0762878056', 'Kalutara Bombuwala', '2024-09-11 12:59:25'),
(3, 'akila', 'akila@123', 'akila@gmail.com', 'Akila Udantha', '0711850341', 'Bombuwala Kalutara', '2024-09-11 13:01:58'),
(4, 'thehasa', 'thehasa@123', 'thehasa@gmail.com', 'Thehasa Damsandi', '0762878085', 'Kiwlawatta Bombuwala', '2024-09-11 13:01:58'),
(5, 'jennifer52', 'eC^ukZJv%3', 'kowens@stuart.info', 'Ronald Anderson', '+1-475-815-0866x238', '050 Lori Pass Apt. 986, Neilchester, NH 56105', '2024-11-11 13:12:18'),
(6, 'john57', '%%B6mnCf35', 'adamsmichael@gmail.com', 'Lisa Cantrell', '297-689-6963', '3783 Alicia Mews, Lake Zacharystad, NM 99376', '2024-11-11 13:12:18'),
(7, 'lestrada', '*85ZPmsAey', 'randalljackson@gmail.com', 'Ryan Jenkins', '1687391021', '9704 Rachel Knolls Suite 424, West Sandra, NY 12345', '2024-11-11 13:12:18'),
(8, 'jeremycrawford', 'Jj8H6WETt%', 'ntorres@yahoo.com', 'William Oconnell', '(711)204-6675', '32019 Sharon Creek Apt. 732, Deborahmouth, KY 12345', '2024-11-11 13:12:18'),
(9, 'janice39', '%2Yqj2uNx9', 'bperry@yahoo.com', 'Tammy Elliott', '796.378.8616x952', '38718 Catherine Mount Apt. 811, Morrisville, SC 12345', '2024-11-11 13:12:18'),
(10, 'victormccarthy', '5At17HNjA@', 'reyeskelly@larson.com', 'Elizabeth Baker', '108-829-8363', '4562 Douglas Island Apt. 173, Margaretfort, TN 12345', '2024-11-11 13:12:18'),
(11, 'umitchell', 'D5rJOOIc*%', 'katherinemurphy@contreras.com', 'Brandon Miller', '905.651.7837', '084 Phillip Burgs Suite 556, West Sheila, WI 12345', '2024-11-11 13:12:18'),
(12, 'johnsonyvonne', '#i00cC0cMq', 'rharding@hotmail.com', 'Margaret Dixon', '(751)125-6989x182', '46361 James Ports Suite 337, Shahfort, NY 12345', '2024-11-11 13:12:18'),
(13, 'walter02', 'y^eRNhKn&1', 'bmurphy@davila.net', 'Danny Taylor', '001-543-998-5712x881', '247 Carolyn Lights, New Hannahside, NY 12345', '2024-11-11 13:12:18'),
(14, 'zbell', 'yX5HvmlSL!', 'amyberry@campbell.com', 'Anthony Cook', '(382)354-7290x157', '8512 Rodriguez Mount Suite 856, Calebton, RI 12345', '2024-11-11 13:12:18'),
(15, 'daniellawrence', '%5(HeH9Mfb', 'johncox@hotmail.com', 'Miss Mary Fisher', '8474476336', '5237 Joy Trace, Port Laura, WA 98829', '2024-11-11 13:12:18'),
(16, 'hmaddox', '5@@99UygE2', 'crichards@reynolds.biz', 'Miss Victoria Evans', '351.796.7460x790', 'PSC 0342, Box 7835, APO AA 18298', '2024-11-11 13:12:18'),
(17, 'angela66', 'o3R1L0RmR(', 'marquezlynn@hotmail.com', 'Mr. David West', '001-008-834-7525x968', '655 Thomas Lakes Apt. 784, Williamsborough, NY 12345', '2024-11-11 13:12:18'),
(18, 'christine30', '!0Ab5dDC(8', 'brenda09@joseph.com', 'Julie Frank', '001-891-453-5744x384', '38473 Tate Streets Apt. 419, North Kathryn, MN 12345', '2024-11-11 13:12:18'),
(19, 'gwilliams', 'E4NWwbg6^I', 'matthewsmartin@hotmail.com', 'Marissa Parker', '385-232-5570', '5614 Wilson Fort Suite 049, Cantrellville, WA 12345', '2024-11-11 13:12:18'),
(20, 'mark20', 'a)7mE)_o@&', 'ghowell@williams-green.net', 'Eric Jones', '+1-408-908-5645x2282', '942 Scott Streets Apt. 087, Port Michael, KY 12345', '2024-11-11 13:12:18'),
(21, 'fpatton', '0cSS1ze#!9', 'richard41@gmail.com', 'Joseph Burton', '439-863-9145', '9190 Mariah Ramp, North Rebeccastad, CO 12345', '2024-11-11 13:12:18'),
(22, 'davidgarcia', '%8HOJ83ltT', 'derek40@bishop.org', 'Todd Roberts', '371-281-4027', '8721 Wilson Key Suite 436, Nicoleborough, NJ 12345', '2024-11-11 13:12:18'),
(23, 'iangonzalez', 'R1sb9PTg&e', 'peggybeck@gmail.com', 'Joseph Mendez', '851-664-4364x929', '6460 Sparks Lake Suite 178, Fosterfurt, IL 12345', '2024-11-11 13:12:18'),
(24, 'gpratt', '(P2Ds(fQ(K', 'susanstone@yahoo.com', 'Theresa Morrison', '+1-166-036-5008', '0753 Warren Manors, Cynthiaside, MI 12345', '2024-11-11 13:12:18'),
(25, 'victoria05', '&1SY9tGnx4', 'danieldunn@francis.net', 'Vernon Reed', '001-137-153-0356x134', '3111 Emily Summit, Paulachester, MN 12345', '2024-11-11 13:12:18'),
(26, 'shannonbradley', 'of9GTX7o%3', 'shawallen@henderson-simon.com', 'Sandra Rojas', '001-905-191-0168', '569 Gonzalez Street, Dianaburgh, NH 77836', '2024-11-11 13:12:18'),
(27, 'christinehoover', 'O(9rTe(_tG', 'jameswhite@richard-flores.info', 'Kayla Graves', '(011)952-4731x554', '0845 Shaw River Apt. 701, East Robertland, CO 12345', '2024-11-11 13:12:18'),
(28, 'khanwilliam', 'F%29$VY9ux', 'jbailey@marshall-thompson.com', 'Steven Hamilton', '001-795-612-7154x282', 'USNV Patel, FPO AP 33099', '2024-11-11 13:12:18'),
(29, 'ritahughes', '_1uOqHfOQy', 'nicholasglass@deleon.net', 'Jodi Alexander', '+1-638-206-5662x691', '0689 Mercado Stream, Christopherview, MS 74418', '2024-11-11 13:12:18'),
(30, 'kpeterson', 'Itu%^8Fucm', 'camachomanuel@peterson.com', 'Kara Crane', '9676147796', '2068 Stephanie Junctions Apt. 663, East Miguelfurt, NM 12345', '2024-11-11 13:12:18'),
(31, 'allen86', 'f7N22YRi#&', 'megan87@hotmail.com', 'James Peterson', '001-943-720-9848x610', 'USCGC Jones, FPO AE 76020', '2024-11-11 13:12:18'),
(32, 'gparker', '!7XdEAJt@Y', 'harrisonphillip@yahoo.com', 'Hailey Nelson', '001-996-513-0484', '44962 Corey Branch Suite 249, South Karenside, IL 12345', '2024-11-11 13:12:18'),
(33, 'kellykaren', 'R^Ms@8Efvy', 'smithvictoria@gmail.com', 'Michele Webb', '940.560.9302x935', '778 Matthew Freeway Apt. 958, Nathanville, OK 12345', '2024-11-11 13:12:18'),
(34, 'austin47', '+U2tG4UyQ8', 'katherine38@gmail.com', 'Dale Cole', '001-096-432-0252', '0274 Nathan Islands Apt. 973, Lake Andrea, CO 12345', '2024-11-11 13:12:18');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `companyworkers`
--

INSERT INTO `companyworkers` (`worker_id`, `username`, `password`, `email`, `full_name`, `role`, `created_at`) VALUES
(3, 'c3', 'c123', 'c3@gmail.com', 'cthree', ' SE ', '2024-10-15 12:24:49'),
(4, 'c4', 'c123', 'c4@gmail.com', 'cfour', 'Executive', '2024-10-15 12:24:49'),
(5, 'johnsmith', 'p@ssword123', 'johnsmith@example.com', 'John Smith', ' HR ', '2024-11-11 13:25:19'),
(6, 'janedoe', 'Pa$$w0rd!', 'janedoe@example.com', 'Jane Doe', 'Developer', '2024-11-11 13:25:19'),
(7, 'bobmartin', 'Qwerty!234', 'bobmartin@example.com', 'Bob Martin', ' HR Manager ', '2024-11-11 13:25:19'),
(8, 'lisajones', 'Secure*456', 'lisajones@example.com', 'Lisa Jones', 'Support', '2024-11-11 13:25:19'),
(9, 'mikebrown', 'Admin#789', 'mikebrown@example.com', 'Mike Brown', 'Manager', '2024-11-11 13:25:19'),
(10, 'susantaylor', 'MyPass$123', 'susantaylor@example.com', 'Susan Taylor', 'Developer', '2024-11-11 13:25:19'),
(11, 'peterparker', 'Spider@456', 'peterparker@example.com', 'Peter Parker', 'Analyst', '2024-11-11 13:25:19'),
(12, 'nancywilson', 'Nancy!123', 'nancywilson@example.com', 'Nancy Wilson', 'Support', '2024-11-11 13:25:19'),
(13, 'kevinwhite', 'White@789', 'kevinwhite@example.com', 'Kevin White', 'Manager', '2024-11-11 13:25:19'),
(14, 'andreagreen', 'Green#456', 'andreagreen@example.com', 'Andrea Green', 'Developer', '2024-11-11 13:25:19'),
(15, 'paulwalker', 'Walker@123', 'paulwalker@example.com', 'Paul Walker', 'Analyst', '2024-11-11 13:25:19'),
(16, 'stevesmith', 'Steve!789', 'stevesmith@example.com', 'Steve Smith', 'Support', '2024-11-11 13:25:19'),
(17, 'sarahmiller', 'Miller@456', 'sarahmiller@example.com', 'Sarah Miller', 'Manager', '2024-11-11 13:25:19'),
(18, 'davidmoore', 'Moore$123', 'davidmoore@example.com', 'David Moore', 'Developer', '2024-11-11 13:25:19'),
(19, 'chloejames', 'Chloe@789', 'chloejames@example.com', 'Chloe James', 'Analyst', '2024-11-11 13:25:19'),
(20, 'rachelhall', 'Rachel!123', 'rachelhall@example.com', 'Rachel Hall', 'Support', '2024-11-11 13:25:19'),
(21, 'dannysmith', 'Danny#456', 'dannysmith@example.com', 'Danny Smith', 'Manager', '2024-11-11 13:25:19'),
(22, 'emilyclark', 'Emily$789', 'emilyclark@example.com', 'Emily Clark', 'Developer', '2024-11-11 13:25:19'),
(23, 'jacklewis', 'Jack@456', 'jacklewis@example.com', 'Jack Lewis', 'Analyst', '2024-11-11 13:25:19'),
(24, 'daniellebrown', 'Danielle!123', 'daniellebrown@example.com', 'Danielle Brown', 'Support', '2024-11-11 13:25:19'),
(25, 'brandonlee', 'Brandon$789', 'brandonlee@example.com', 'Brandon Lee', 'Manager', '2024-11-11 13:25:19'),
(26, 'laurabaker', 'Laura@456', 'laurabaker@example.com', 'Laura Baker', 'Developer', '2024-11-11 13:25:19'),
(27, 'ryanturner', 'Ryan#123', 'ryanturner@example.com', 'Ryan Turner', 'Analyst', '2024-11-11 13:25:19'),
(28, 'jessicawood', 'Jessica@789', 'jessicawood@example.com', 'Jessica Wood', 'Support', '2024-11-11 13:25:19'),
(29, 'tonyking', 'Tony!456', 'tonyking@example.com', 'Tony King', 'Manager', '2024-11-11 13:25:19'),
(30, 'michellerogers', 'Michelle$123', 'michellerogers@example.com', 'Michelle Rogers', 'Developer', '2024-11-11 13:25:19'),
(31, 'samuelbell', 'Samuel#789', 'samuelbell@example.com', 'Samuel Bell', 'Analyst', '2024-11-11 13:25:19'),
(32, 'oliviaward', 'Olivia@456', 'oliviaward@example.com', 'Olivia Ward', 'Support', '2024-11-11 13:25:19'),
(33, 'frankthomas', 'Frank!123', 'frankthomas@example.com', 'Frank Thomas', 'Manager', '2024-11-11 13:25:19'),
(34, 'nataliegray', 'Natalie$789', 'nataliegray@example.com', 'Natalie Gray', 'Developer', '2024-11-11 13:25:19'),
(35, 'hannahscott', 'Hannah@456', 'hannahscott@example.com', 'Hannah Scott', 'Analyst', '2024-11-11 13:25:19');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forums`
--

INSERT INTO `forums` (`forum_id`, `title`, `content`, `created_by`, `user_id`, `created_at`) VALUES
(6, 'Starting a Business with Limited Capital', 'Tips and tricks for starting a business on a tight budget.', 'ServiceProvider', 6, '2024-11-11 13:44:28'),
(7, 'E-commerce Trends', 'What are the latest trends in e-commerce? How can businesses adapt?', 'Client', 7, '2024-11-11 13:44:28'),
(8, 'Understanding Customer Behavior', 'Strategies to understand and predict customer needs.', 'ServiceProvider', 8, '2024-11-11 13:44:28'),
(9, 'Effective Business Communication', 'How to communicate effectively within teams and with clients.', 'Client', 9, '2024-11-11 13:44:28'),
(10, 'SEO for Beginners', 'A guide to basic SEO practices for small businesses.', 'ServiceProvider', 10, '2024-11-11 13:44:28'),
(11, 'Building Brand Loyalty', 'How to keep customers coming back and create a loyal customer base.', 'Client', 11, '2024-11-11 13:44:28'),
(12, 'Remote Team Management', 'Tips for effectively managing remote teams in a business setting.', 'ServiceProvider', 12, '2024-11-11 13:44:28'),
(13, 'Financial Planning for Startups', 'Discussing financial planning tips and tools for new businesses.', 'Client', 13, '2024-11-11 13:44:28'),
(14, 'Business Risk Management', 'How to identify and mitigate risks in business operations.', 'ServiceProvider', 14, '2024-11-11 13:44:28'),
(15, 'Social Media Strategies', 'Best social media practices for promoting your business.', 'Client', 15, '2024-11-11 13:44:28'),
(16, 'Market Research Basics', 'Understanding the basics of market research for business growth.', 'ServiceProvider', 16, '2024-11-11 13:44:28'),
(17, 'Developing a Business Plan', 'Key elements to include in a successful business plan.', 'Client', 17, '2024-11-11 13:44:28'),
(18, 'Customer Retention Techniques', 'Strategies for retaining customers in a competitive market.', 'ServiceProvider', 18, '2024-11-11 13:44:28'),
(19, 'Adapting to Market Changes', 'How businesses can stay flexible and adapt to changing markets.', 'Client', 19, '2024-11-11 13:44:28'),
(20, 'Leadership in Small Business', 'Discussing essential leadership qualities for small business success.', 'ServiceProvider', 20, '2024-11-11 13:44:28'),
(21, 'Pricing Strategy Development', 'How to develop a competitive and profitable pricing strategy.', 'Client', 21, '2024-11-11 13:44:28'),
(22, 'Employee Motivation Techniques', 'Ideas to keep your team motivated and productive.', 'ServiceProvider', 22, '2024-11-11 13:44:28'),
(23, 'Budgeting for Business Growth', 'Effective budgeting tips to support business expansion.', 'Client', 23, '2024-11-11 13:44:28'),
(24, 'Data-Driven Decision Making', 'Using data analytics for better business decisions.', 'ServiceProvider', 24, '2024-11-11 13:44:28'),
(25, 'Creating a Unique Value Proposition', 'How to define and communicate your business’s unique value.', 'Client', 25, '2024-11-11 13:44:28'),
(26, 'Importance of Customer Feedback', 'Discussing ways to collect and use customer feedback.', 'ServiceProvider', 26, '2024-11-11 13:44:28'),
(27, 'Innovative Product Development', 'Ideas for innovating and improving your product offerings.', 'Client', 27, '2024-11-11 13:44:28'),
(28, 'Sales Techniques for Small Businesses', 'Effective sales techniques for increasing revenue.', 'ServiceProvider', 28, '2024-11-11 13:44:28'),
(29, 'Legal Considerations for Startups', 'Basic legal issues every startup should be aware of.', 'Client', 29, '2024-11-11 13:44:28'),
(30, 'Utilizing AI in Business Operations', 'Exploring how AI can streamline business processes.', 'ServiceProvider', 30, '2024-11-11 13:44:28');

-- --------------------------------------------------------

--
-- Table structure for table `knowledgebase`
--

CREATE TABLE `knowledgebase` (
  `kb_id` int(11) NOT NULL,
  `worker_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `worker_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `providerrequests`
--

CREATE TABLE `providerrequests` (
  `reqId` int(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `field` varchar(255) NOT NULL,
  `specialty` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `providerrequests`
--

INSERT INTO `providerrequests` (`reqId`, `full_name`, `email`, `phone`, `address`, `field`, `specialty`) VALUES
(8, 'Henry Adams', 'henryadams@example.com', '1234567897', '107 Birch St, Concord, NH 03301', 'Institutional Development', 'Researcher'),
(10, 'Jackie Wilson', 'jackiewilson@example.com', '3456789019', '109 Oak St, Lincoln, NE 68501', 'Organizational Development', 'Consultant'),
(11, 'Kevin Morgan', 'kevinmorgan@example.com', '4567890120', '110 Cedar St, Trenton, NJ 08608', 'Development Finance', 'Researcher'),
(12, 'Laura Phillips', 'lauraphillips@example.com', '5678901231', '111 Elm St, Raleigh, NC 27601', 'Micro Finance', 'Trainer'),
(13, 'Michael Evans', 'michaelevans@example.com', '6789012342', '112 Maple St, Providence, RI 02903', 'Gender Finance', 'Consultant'),
(14, 'Nina Turner', 'ninaturner@example.com', '7890123453', '113 Walnut St, Cheyenne, WY 82001', 'SME Development', 'Researcher'),
(15, 'Oscar Long', 'oscarlong@example.com', '8901234564', '114 Fir St, Charleston, WV 25301', 'Strategic and Operations Planning', 'Trainer'),
(16, 'Peter Grant', 'petergrant@example.com', '2345678910', '202 Pine St, Hartford, CT 06101', 'Institutional Development', 'Consultant'),
(17, 'Quincy Hall', 'quincyhall@example.com', '3456789021', '203 Cedar St, Richmond, VA 23218', 'Community Development', 'Researcher'),
(18, 'Rachel Ingram', 'rachelingram@example.com', '4567890132', '204 Elm St, Frankfort, KY 40601', 'Organizational Development', 'Trainer'),
(19, 'Samuel Jennings', 'samueljennings@example.com', '5678901243', '205 Maple St, Columbus, OH 43201', 'Development Finance', 'Consultant'),
(20, 'Tina Keller', 'tinakeller@example.com', '6789012354', '206 Walnut St, Raleigh, NC 27601', 'Micro Finance', 'Researcher'),
(21, 'Ursula Lewis', 'ursulalewis@example.com', '7890123465', '207 Fir St, Charleston, WV 25301', 'Gender Finance', 'Trainer'),
(22, 'Victor Martin', 'victormartin@example.com', '8901234576', '208 Poplar St, Albany, NY 12207', 'SME Development', 'Consultant'),
(23, 'Wendy Nelson', 'wendynelson@example.com', '9012345687', '209 Birch St, Madison, WI 53703', 'Strategic and Operations Planning', 'Researcher'),
(24, 'Xander Ortiz', 'xanderortiz@example.com', '1234567898', '210 Spruce St, Lincoln, NE 68501', 'Institutional Development', 'Trainer'),
(25, 'Yara Price', 'yaraprice@example.com', '2345678909', '211 Oak St, Concord, NH 03301', 'Community Development', 'Consultant'),
(26, 'Zane Quinn', 'zanequinn@example.com', '3456789010', '212 Cedar St, Springfield, IL 62701', 'Organizational Development', 'Researcher'),
(27, 'Alice Rose', 'alicerose@example.com', '4567890121', '213 Maple St, Salem, OR 97301', 'Development Finance', 'Trainer'),
(28, 'Ben Stark', 'benstark@example.com', '5678901232', '214 Fir St, Helena, MT 59601', 'Micro Finance', 'Consultant'),
(29, 'Cathy Taylor', 'cathytaylor@example.com', '6789012343', '215 Elm St, Boise, ID 83702', 'Gender Finance', 'Researcher'),
(30, 'Daniel Urban', 'danielurban@example.com', '7890123454', '216 Walnut St, Austin, TX 73301', 'SME Development', 'Trainer');

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

-- --------------------------------------------------------

--
-- Table structure for table `serviceproviders`
--

CREATE TABLE `serviceproviders` (
  `provider_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `field` varchar(255) NOT NULL,
  `speciality` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `serviceproviders`
--

INSERT INTO `serviceproviders` (`provider_id`, `username`, `password`, `email`, `full_name`, `phone`, `address`, `field`, `speciality`, `created_at`) VALUES
(1, 'serv1', 'serv1@123', 'serv1@gmail.com', 'Serv One', '0711850441', 'Colombo', '', 'Research', '2024-09-11 13:41:44'),
(2, 'serv2', 'serv2@123', 'serv2@gmail.com', 'Serv Two', '0762878056', 'Maharagama', '', 'Consultant', '2024-09-11 13:41:44'),
(3, 'serv3', 'saada', 'serv3@gmail.com', 'Serv three', '04557412574', 'Kalutara', '', 'Research', '2024-11-11 13:21:23'),
(4, 'serv4', 'serv4123', 'serv4@gmail.com', 'Serv four', NULL, 'Mathugama', '', 'Training', '2024-11-11 13:21:23'),
(5, 'john34', '^_Vh0CCycE', 'courtneyedwards@hotmail.com', 'Michael Elliott', '2025628403', '813 Ashley Roads, West Virginia, MD 79874', '', 'Consultant', '2024-11-11 13:21:52'),
(6, 'zstephens', '(5G%oTzC%+', 'rebeccaarmstrong@alvarez.com', 'Charles Brooks', '8431540366', '4980 Elizabeth Trace Apt. 055, Tranmouth, OR 69110', '', 'Consultant', '2024-11-11 13:21:52'),
(7, 'marksutton', 'LQW4El3zz!', 'glorialewis@miller.org', 'Joel Snyder', '7129304418', 'PSC 4640, Box 5916, APO AE 72890', '', 'Researcher', '2024-11-11 13:21:52'),
(8, 'matthewmckinney', '0OWODzib#c', 'newtoncynthia@williams.com', 'Bailey Suarez', '3734585636', '1088 Rodriguez Highway, Andradeberg, CA 74634', '', 'Consultant', '2024-11-11 13:21:52'),
(9, 'melissamitchell', 'zQAKEnLM^5', 'hramos@hotmail.com', 'Andrea Nguyen', '7613228676', '63788 John Crescent Apt. 379, Davidburgh, WV 49512', '', 'Training', '2024-11-11 13:21:52'),
(10, 'michaelhernandez', 'L9MN_XJh&i', 'brownjohn@yahoo.com', 'Brian Page', '7199545475', '741 Melissa Square, West Joe, WA 53747', '', 'Training', '2024-11-11 13:21:52'),
(11, 'ujones', 'P83BA0BG@i', 'qthompson@brown.com', 'April Jackson', '2630158350', '21049 Hill Junctions Apt. 769, West Joe, GA 14634', '', 'Researcher', '2024-11-11 13:21:52'),
(12, 'kristen03', 'i+7RB6sqrQ', 'ysanders@hotmail.com', 'Tracy Thompson', '7484203810', '750 Ochoa Throughway Suite 891, Danielport, NJ 55840', '', 'Training', '2024-11-11 13:21:52'),
(13, 'beckersandy', ')(1ieNa4h2', 'qcline@gmail.com', 'Darren Torres', '6877089823', '265 Judy Extension Suite 476, Jonathanshire, SD 05413', '', 'Researcher', '2024-11-11 13:21:52'),
(14, 'jeremiah37', ')jKpRQW1!3', 'raymondwoods@powell.net', 'Scott Johnson', '4279101928', '3850 Castaneda Cove Apt. 965, West Bryan, KS 80821', '', 'Training', '2024-11-11 13:21:52'),
(15, 'candacecampos', '(bpsEtr^6w', 'lwilliams@scott.com', 'Theresa Conrad', '5702311072', '6083 Rebecca Land Suite 719, Jenniferfort, AR 38591', '', 'Researcher', '2024-11-11 13:21:52'),
(16, 'shepherdedward', '23K3+(z*)k', 'vmiles@atkins.biz', 'Teresa Ford', '1797694729', 'PSC 8370, Box 4487, APO AP 12793', '', 'Researcher', '2024-11-11 13:21:52'),
(17, 'egriffin', '_BpGNEgFD4', 'david22@hotmail.com', 'William Davis', '1649378091', '122 Valencia Garden, Port Christina, ME 40384', '', 'Consultant', '2024-11-11 13:21:52'),
(18, 'gjohnson', 'Ek&4MraHl$', 'leelaura@long-mueller.com', 'Bradley Knapp', '4111826741', '6041 Rodriguez Ports Suite 799, Schroederburgh, VA 80992', '', 'Consultant', '2024-11-11 13:21:52'),
(19, 'andreahenry', '+LIJdrL76u', 'fwalters@jackson.biz', 'Philip Hull', '4546924432', 'USCGC Mata, FPO AA 76880', '', 'Researcher', '2024-11-11 13:21:52'),
(20, 'howelltimothy', '3^Ri&^$P)5', 'sandra21@warren.com', 'Tina Clark', '8077561183', '970 Sanders Turnpike, Johnsonberg, OK 16303', '', 'Training', '2024-11-11 13:21:52'),
(21, 'matthew07', '0a9TR0i0o+', 'jessica49@yahoo.com', 'Felicia Dennis', '1873911557', '949 Andrea Parkway Apt. 738, Mariashire, MI 96601', '', 'Consultant', '2024-11-11 13:21:52'),
(22, 'angela34', 'E_kNswJ^!8', 'barkerbonnie@hotmail.com', 'Ivan Lee', '1621373853', '88629 Bell Via, Joshuaport, VT 57292', '', 'Researcher', '2024-11-11 13:21:52'),
(23, 'nhawkins', '#I7ZIQKrh7', 'leslie01@hotmail.com', 'Erin Schwartz', '1476297302', '816 Desiree Crossing Apt. 285, Martinezfort, LA 23359', '', 'Training', '2024-11-11 13:21:52'),
(24, 'yhill', '^!lEul)O$9', 'hannah58@shaw.biz', 'Anita Warren', '3299100598', '836 Schmidt Way Apt. 939, Carolland, NY 02863', '', 'Training', '2024-11-11 13:21:52'),
(25, 'gomezrandy', '31c&%BEp$8', 'imarshall@glass.net', 'George Meyers', '7204137074', '84942 Joseph Forge Suite 866, East Christianland, HI 89129', '', 'Researcher', '2024-11-11 13:21:52'),
(26, 'daniellezavala', '$Y@B0iKN2h', 'ckirby@gmail.com', 'Chase Watts', '9468078992', '839 Andrea Junctions, Gonzalesfurt, IA 02925', '', 'Consultant', '2024-11-11 13:21:52'),
(27, 'kari46', '+Wfr9B6u!)', 'matthew85@hotmail.com', 'Amanda Nelson', '6562779694', '5819 Simpson Plaza Apt. 810, West Philipburgh, RI 76592', '', 'Training', '2024-11-11 13:21:52'),
(28, 'davisderek', '9$Ui0iUh!+', 'georgecoleman@yahoo.com', 'Tracy Robertson', '4065946180', '65950 Roger Way Apt. 610, Port Hannah, MD 25584', '', 'Consultant', '2024-11-11 13:21:52'),
(29, 'karenbarber', '+zp39wWq(k', 'leebrad@yahoo.com', 'Casey Chen', '6550867049', '919 Kayla Mission Apt. 295, Port Paigetown, AK 72546', '', 'Training', '2024-11-11 13:21:52'),
(30, 'patriciamartinez', '@6!9RKcwH2', 'peter98@yahoo.com', 'Judy Carter', '9499620843', '1403 Sara Extension Apt. 307, Archerport, PA 40615', '', 'Researcher', '2024-11-11 13:21:52'),
(31, 'matthew13', 'z@K6Fu6U^n', 'zmendoza@gmail.com', 'Bruce Mcdonald', '2859894883', '943 Anthony Falls, West Jaime, FL 02285', '', 'Consultant', '2024-11-11 13:21:52'),
(32, 'mercerlee', '@pZKp5@p*4', 'tjacobs@gmail.com', 'Jimmy Blevins', '4016145015', '91487 Cummings Meadows, Brianafurt, MS 11355', '', 'Consultant', '2024-11-11 13:21:52'),
(33, 'jessicasmith', '%65WMg7BQc', 'aaronlloyd@hotmail.com', 'Olivia Morgan', '7565104041', '1731 Kim Street Apt. 205, Lake Briannachester, TX 12456', '', 'Researcher', '2024-11-11 13:21:52'),
(34, 'velezjonathan', 'o7ZRF6Se#H', 'james64@hotmail.com', 'Oscar Bell', '2395835183', '32655 Hill Hollow, Grantfurt, WY 45613', '', 'Consultant', '2024-11-11 13:21:52'),
(35, 'Carla Green', '726737', 'carlagreen@example.com', 'Carla Green', '5678901232', '102 Elm St, Nashville, TN 37201', 'Development Finance', NULL, '2024-11-20 05:29:17'),
(36, 'David Brooks', '419073', 'davidbrooks@example.com', 'David Brooks', '6789012343', '103 Maple St, Salem, OR 97301', 'Micro Finance', 'Consultant', '2024-11-20 05:31:29'),
(37, 'Evelyn Harris', '413752', 'evelynharris@example.com', 'Evelyn Harris', '7890123454', '104 Walnut St, Boise, ID 83702', 'Gender Finance', 'Researcher', '2024-11-20 06:21:17'),
(38, 'Frank Miller', '851368', 'frankmiller@example.com', 'Frank Miller', '8901234565', '105 Fir St, Helena, MT 59601', 'SME Development', 'Trainer', '2024-11-20 06:26:08'),
(39, 'Irene Scott', '181649', 'irenescott@example.com', 'Irene Scott', '2345678908', '108 Spruce St, Madison, WI 53703', 'Community Development', 'Trainer', '2024-11-22 09:59:18'),
(40, 'Grace Lee', '865503', 'gracelee@example.com', 'Grace Lee', '9012345676', '106 Poplar St, Albany, NY 12207', 'Strategic and Operations Planning', 'Consultant', '2024-11-22 11:17:58'),
(41, 'nemanthaT', '$2y$10$00MgtwFyopqsdhMwqj2kc.BS67ChVVbFhNEGqP3wIk4daNH6Pfh4i', 'tharusha1@gmail.com', 'Tharusha Nemantha', '0711850441', 'Kalutara', '', 'Consultant', '2024-11-28 07:23:02');

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
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

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
  ADD PRIMARY KEY (`kb_id`),
  ADD KEY `worker_id` (`worker_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`),
  ADD KEY `worker_id` (`worker_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `service_request_id` (`service_request_id`);

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
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `companyworkers`
--
ALTER TABLE `companyworkers`
  MODIFY `worker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `contactforms`
--
ALTER TABLE `contactforms`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forumreplies`
--
ALTER TABLE `forumreplies`
  MODIFY `reply_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forums`
--
ALTER TABLE `forums`
  MODIFY `forum_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `knowledgebase`
--
ALTER TABLE `knowledgebase`
  MODIFY `kb_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `providerrequests`
--
ALTER TABLE `providerrequests`
  MODIFY `reqId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `researchpapers`
--
ALTER TABLE `researchpapers`
  MODIFY `paper_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `serviceproviders`
--
ALTER TABLE `serviceproviders`
  MODIFY `provider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

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
-- Constraints for table `contactforms`
--
ALTER TABLE `contactforms`
  ADD CONSTRAINT `contactforms_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`);

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
  ADD CONSTRAINT `knowledgebase_ibfk_1` FOREIGN KEY (`worker_id`) REFERENCES `companyworkers` (`worker_id`);

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
