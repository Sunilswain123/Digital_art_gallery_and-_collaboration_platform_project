-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2024 at 12:23 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `RandomTableData` ()   BEGIN
    DECLARE random_table VARCHAR(255);

    
    SELECT table_name INTO random_table FROM info ORDER BY RAND() LIMIT 1;

    
    SET @query = CONCAT('SELECT * FROM ', random_table);
    PREPARE stmt FROM @query;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `6371447060`
--

CREATE TABLE `6371447060` (
  `img_vdo` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `flag` int(11) DEFAULT NULL,
  `sl` int(11) NOT NULL,
  `collaborate` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `6371447060`
--

INSERT INTO `6371447060` (`img_vdo`, `category`, `caption`, `flag`, `sl`, `collaborate`) VALUES
('istockphoto-1440149723-1024x1024.jpg', 'Sketch', 'Lets do it', 0, 1, 0),
('Prithviraj-in-Aadujeevitham.jpg', 'Paint', 'Hurray! We did it.', 0, 2, 0),
('images/images/riLo5BkdT.jpg', 'sketch', 'I want to collaborate with you on your elephant post ', 0, 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `6371447060cr`
--

CREATE TABLE `6371447060cr` (
  `sl_no` int(11) NOT NULL,
  `cr_mob` bigint(20) NOT NULL,
  `cr_status` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `details` varchar(255) DEFAULT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `6371447060cs`
--

CREATE TABLE `6371447060cs` (
  `sl_no` int(11) NOT NULL,
  `cs_mob` bigint(20) NOT NULL,
  `cs_status` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `details` varchar(255) DEFAULT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `6371447060cs`
--

INSERT INTO `6371447060cs` (`sl_no`, `cs_mob`, `cs_status`, `image`, `details`, `post_id`) VALUES
(8, 7205726916, 0, 'images/riLo5BkdT.jpg', 'I want to collaborate with you on your elephant post ', 4);

-- --------------------------------------------------------

--
-- Table structure for table `6371447060f`
--

CREATE TABLE `6371447060f` (
  `id` int(11) NOT NULL,
  `frnd_mob` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `6371447060f`
--

INSERT INTO `6371447060f` (`id`, `frnd_mob`) VALUES
(4, 7205726916);

-- --------------------------------------------------------

--
-- Table structure for table `6371447060r`
--

CREATE TABLE `6371447060r` (
  `id` int(11) NOT NULL,
  `req_mob` bigint(20) NOT NULL,
  `req_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `6371447060s`
--

CREATE TABLE `6371447060s` (
  `id` int(11) NOT NULL,
  `sent_mob` bigint(20) NOT NULL,
  `sent_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `6371447060vote`
--

CREATE TABLE `6371447060vote` (
  `post_id` int(11) NOT NULL,
  `vote` int(11) NOT NULL DEFAULT 0,
  `voted_to` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `7077033992`
--

CREATE TABLE `7077033992` (
  `img_vdo` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `flag` int(11) DEFAULT NULL,
  `sl` int(11) NOT NULL,
  `collaborate` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `7077033992`
--

INSERT INTO `7077033992` (`img_vdo`, `category`, `caption`, `flag`, `sl`, `collaborate`) VALUES
('c8e660d132d6476aa30b8034a3d05df5.webp', 'paint', 'This is my bus.', 0, 1, 0),
('images/images/HD-wallpaper-sci-fi-vehicle-bus-cyberpunk-neon.jpg', 'crafts', 'This is new bus', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `7077033992cr`
--

CREATE TABLE `7077033992cr` (
  `sl_no` int(11) NOT NULL,
  `cr_mob` bigint(20) NOT NULL,
  `cr_status` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `details` varchar(255) DEFAULT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `7077033992cs`
--

CREATE TABLE `7077033992cs` (
  `sl_no` int(11) NOT NULL,
  `cs_mob` bigint(20) NOT NULL,
  `cs_status` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `details` varchar(255) DEFAULT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `7077033992cs`
--

INSERT INTO `7077033992cs` (`sl_no`, `cs_mob`, `cs_status`, `image`, `details`, `post_id`) VALUES
(0, 7205726916, 0, 'images/HD-wallpaper-sci-fi-vehicle-bus-cyberpunk-neon.jpg', 'This is new bus', 3);

-- --------------------------------------------------------

--
-- Table structure for table `7077033992f`
--

CREATE TABLE `7077033992f` (
  `id` int(11) NOT NULL,
  `frnd_mob` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `7077033992f`
--

INSERT INTO `7077033992f` (`id`, `frnd_mob`) VALUES
(0, 7205726916);

-- --------------------------------------------------------

--
-- Table structure for table `7077033992r`
--

CREATE TABLE `7077033992r` (
  `id` int(11) NOT NULL,
  `req_mob` bigint(20) NOT NULL,
  `req_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `7077033992s`
--

CREATE TABLE `7077033992s` (
  `id` int(11) NOT NULL,
  `sent_mob` bigint(20) NOT NULL,
  `sent_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `7077033992vote`
--

CREATE TABLE `7077033992vote` (
  `post_id` int(11) NOT NULL,
  `vote` int(11) NOT NULL DEFAULT 0,
  `voted_to` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `7205726916`
--

CREATE TABLE `7205726916` (
  `img_vdo` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `flag` int(11) DEFAULT NULL,
  `sl` int(11) NOT NULL,
  `collaborate` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `7205726916`
--

INSERT INTO `7205726916` (`img_vdo`, `category`, `caption`, `flag`, `sl`, `collaborate`) VALUES
('Picsart_24-04-26_19-44-56-899.png', 'sand', 'Silicon Logo', 0, 1, 0),
('', 'pattachitra', 'Demo video', 0, 2, 0),
('Screenshot 2024-04-26 193401.png', 'crafts', 'Our first PPT', 0, 3, 1),
('elephant.png', 'sketch', 'My Color Sketch of an Elephant.', 0, 4, 0),
('0e851788b96f1527e1d509326a0c3ce5.jpg', 'crafts', 'Craft with ice-cream stick', 0, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `7205726916cr`
--

CREATE TABLE `7205726916cr` (
  `sl_no` int(11) NOT NULL,
  `cr_mob` bigint(20) NOT NULL,
  `cr_status` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `details` varchar(255) DEFAULT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `7205726916cs`
--

CREATE TABLE `7205726916cs` (
  `sl_no` int(11) NOT NULL,
  `cs_mob` bigint(20) NOT NULL,
  `cs_status` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `details` varchar(255) DEFAULT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `7205726916f`
--

CREATE TABLE `7205726916f` (
  `id` int(11) NOT NULL,
  `frnd_mob` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `7205726916f`
--

INSERT INTO `7205726916f` (`id`, `frnd_mob`) VALUES
(4, 6371447060),
(5, 7077033992);

-- --------------------------------------------------------

--
-- Table structure for table `7205726916r`
--

CREATE TABLE `7205726916r` (
  `id` int(11) NOT NULL,
  `req_mob` bigint(20) NOT NULL,
  `req_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `7205726916s`
--

CREATE TABLE `7205726916s` (
  `id` int(11) NOT NULL,
  `sent_mob` bigint(20) NOT NULL,
  `sent_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `7205726916vote`
--

CREATE TABLE `7205726916vote` (
  `post_id` int(11) NOT NULL,
  `vote` int(11) NOT NULL DEFAULT 0,
  `voted_to` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `7377560561`
--

CREATE TABLE `7377560561` (
  `img_vdo` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `flag` int(11) DEFAULT NULL,
  `sl` int(11) NOT NULL,
  `collaborate` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `7377560561`
--

INSERT INTO `7377560561` (`img_vdo`, `category`, `caption`, `flag`, `sl`, `collaborate`) VALUES
('108246685.jpeg', 'Singing', 'Listen to music', 1, 1, 0),
('pic2.jpg', 'Sketch', 'Draw the world', 1, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `7377560561cr`
--

CREATE TABLE `7377560561cr` (
  `sl_no` int(11) NOT NULL,
  `cr_mob` bigint(20) NOT NULL,
  `cr_status` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `details` varchar(255) DEFAULT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `7377560561cs`
--

CREATE TABLE `7377560561cs` (
  `sl_no` int(11) NOT NULL,
  `cs_mob` bigint(20) NOT NULL,
  `cs_status` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `details` varchar(255) DEFAULT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `7377560561f`
--

CREATE TABLE `7377560561f` (
  `id` int(11) NOT NULL,
  `frnd_mob` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `7377560561r`
--

CREATE TABLE `7377560561r` (
  `id` int(11) NOT NULL,
  `req_mob` int(11) NOT NULL,
  `req_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `7377560561s`
--

CREATE TABLE `7377560561s` (
  `id` int(11) NOT NULL,
  `sent_mob` bigint(20) NOT NULL,
  `sent_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `challenges`
--

CREATE TABLE `challenges` (
  `id` int(11) NOT NULL,
  `sender_id` bigint(11) NOT NULL,
  `receiver_id` bigint(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `status` enum('pending','accepted','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `support_image_uploaded` int(11) DEFAULT 0,
  `support_upload_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `collaborations`
--

CREATE TABLE `collaborations` (
  `post_id` int(11) NOT NULL,
  `table_name` bigint(20) NOT NULL,
  `user` bigint(20) NOT NULL,
  `your_post_img` varchar(255) NOT NULL,
  `col_post_img` varchar(255) NOT NULL,
  `your_caption` varchar(255) NOT NULL,
  `col_caption` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `collaborations`
--

INSERT INTO `collaborations` (`post_id`, `table_name`, `user`, `your_post_img`, `col_post_img`, `your_caption`, `col_caption`) VALUES
(3, 7077033992, 7205726916, 'images/Screenshot 2024-04-26 193401.png', 'images/HD-wallpaper-sci-fi-vehicle-bus-cyberpunk-neon.jpg', 'Our first PPT', 'This is new bus');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `event_description` text NOT NULL,
  `follow_up_date` date NOT NULL,
  `created_by` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_support`
--

CREATE TABLE `event_support` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `username` bigint(50) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `file` varchar(100) NOT NULL,
  `caption` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `file`, `caption`) VALUES
(17, 'United_States_Israel_Military_72160.jpg', 'This is my post'),
(19, 'PEOPLE-KEVIN-HART--60_1711360121097_1711360147731.jpeg', 'Beauty for purpose'),
(20, 'download.jpeg', 'Touch the sky with glory'),
(21, 'aattam-movie-review-new.jpg', 'silicon image'),
(28, '108246685.jpeg', 'AR rehman'),
(29, 'pexels-pixabay-65894.jpg', 'Jay jagannath');

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE `info` (
  `id` int(11) NOT NULL,
  `table_name` bigint(20) NOT NULL,
  `user_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`id`, `table_name`, `user_name`) VALUES
(1, 7205726916, 'Rock Bismaya'),
(2, 6371447060, 'Bismaya Patra'),
(3, 7377560561, 'Sunil Swain'),
(5, 7077033992, 'Satya Prakash');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender` bigint(20) NOT NULL,
  `receiver` bigint(20) NOT NULL,
  `message` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `seen` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender`, `receiver`, `message`, `timestamp`, `seen`) VALUES
(1, 6371447060, 7205726916, 'hiii', '2024-05-24 02:52:28', 1),
(2, 6371447060, 7205726916, 'hiii', '2024-05-24 02:52:28', 1),
(3, 6371447060, 7205726916, 'hiii', '2024-05-24 02:52:28', 1),
(4, 6371447060, 7205726916, 'hiii', '2024-05-24 02:52:28', 1),
(5, 6371447060, 7205726916, 'hiii', '2024-05-24 02:52:28', 1),
(6, 6371447060, 7205726916, 'hlo', '2024-05-24 02:52:28', 1),
(7, 6371447060, 7205726916, 'hlo', '2024-05-24 02:52:28', 1),
(8, 6371447060, 7205726916, 'hiii', '2024-05-24 02:52:28', 1),
(9, 6371447060, 7205726916, 'hiii', '2024-05-24 02:52:28', 1),
(10, 6371447060, 7205726916, 'hi', '2024-05-24 02:52:28', 1),
(11, 7205726916, 6371447060, 'hlo', '2024-05-24 02:51:57', 1),
(12, 7205726916, 6371447060, 'hlo', '2024-05-24 02:51:57', 1),
(13, 7205726916, 6371447060, 'hlo', '2024-05-24 02:51:57', 1),
(14, 7205726916, 6371447060, 'hi', '2024-05-24 02:51:57', 1),
(15, 6371447060, 7205726916, 'hi', '2024-05-24 02:52:28', 1),
(16, 6371447060, 7205726916, 'hiiiloooooo', '2024-05-24 02:52:28', 1),
(17, 7205726916, 6371447060, 'hm re kah', '2024-05-24 02:52:56', 1),
(18, 7077033992, 7205726916, 'Hi', '2024-05-25 10:16:01', 1),
(19, 7205726916, 7077033992, 'Hlo', '2024-05-25 10:16:53', 1);

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `name` varchar(100) NOT NULL,
  `phone` bigint(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(16) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `skill` varchar(255) DEFAULT NULL,
  `bio` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`name`, `phone`, `email`, `password`, `gender`, `dob`, `skill`, `bio`, `image`, `id`) VALUES
('Bismaya Patra', 6371447060, 'bismayapatra2001@gmail.com', 'Patra@123', 'Male', '2001-07-14', 'Dancer', 'abc defg hi jkl mn op qrs tuv w x yz', 'download.jpeg', '1'),
('Satya Prakash', 7077033992, 'prakashgun2001@gmail.com', 'Satya@123', 'Male', '2001-04-28', NULL, 'I am a Digital Creator', 'pic.jpg', NULL),
('Rock Bismaya', 7205726916, 'mca.22mmca99@silicon.ac.in', 'Patra@123', 'Male', '2001-07-14', 'Digital Creator', 'Hello world', 'DSC_8401.jpg', '3'),
('Sunil Swain', 7377560561, 'sunil@gmail.com', 'Sunil@123', NULL, NULL, NULL, NULL, NULL, '4');

-- --------------------------------------------------------

--
-- Table structure for table `support_photos`
--

CREATE TABLE `support_photos` (
  `id` int(11) NOT NULL,
  `challenge_id` int(11) NOT NULL,
  `sender_id` bigint(20) NOT NULL,
  `receiver_id` bigint(20) NOT NULL,
  `photo1` varchar(255) NOT NULL,
  `photo2` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `photo1_vote` int(11) NOT NULL DEFAULT 0,
  `photo2_vote` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `6371447060`
--
ALTER TABLE `6371447060`
  ADD PRIMARY KEY (`sl`);

--
-- Indexes for table `6371447060cr`
--
ALTER TABLE `6371447060cr`
  ADD PRIMARY KEY (`sl_no`);

--
-- Indexes for table `6371447060cs`
--
ALTER TABLE `6371447060cs`
  ADD PRIMARY KEY (`sl_no`);

--
-- Indexes for table `6371447060f`
--
ALTER TABLE `6371447060f`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `frnd_mob` (`frnd_mob`);

--
-- Indexes for table `6371447060r`
--
ALTER TABLE `6371447060r`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `6371447060s`
--
ALTER TABLE `6371447060s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `7205726916`
--
ALTER TABLE `7205726916`
  ADD PRIMARY KEY (`sl`);

--
-- Indexes for table `7205726916cr`
--
ALTER TABLE `7205726916cr`
  ADD PRIMARY KEY (`sl_no`);

--
-- Indexes for table `7205726916cs`
--
ALTER TABLE `7205726916cs`
  ADD PRIMARY KEY (`sl_no`);

--
-- Indexes for table `7205726916f`
--
ALTER TABLE `7205726916f`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `frnd_mob` (`frnd_mob`);

--
-- Indexes for table `7205726916r`
--
ALTER TABLE `7205726916r`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `7205726916s`
--
ALTER TABLE `7205726916s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `7377560561`
--
ALTER TABLE `7377560561`
  ADD PRIMARY KEY (`sl`);

--
-- Indexes for table `7377560561cr`
--
ALTER TABLE `7377560561cr`
  ADD PRIMARY KEY (`sl_no`);

--
-- Indexes for table `7377560561cs`
--
ALTER TABLE `7377560561cs`
  ADD PRIMARY KEY (`sl_no`);

--
-- Indexes for table `7377560561f`
--
ALTER TABLE `7377560561f`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `7377560561r`
--
ALTER TABLE `7377560561r`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `7377560561s`
--
ALTER TABLE `7377560561s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `challenges`
--
ALTER TABLE `challenges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_support`
--
ALTER TABLE `event_support`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`phone`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `support_photos`
--
ALTER TABLE `support_photos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `6371447060`
--
ALTER TABLE `6371447060`
  MODIFY `sl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `6371447060cr`
--
ALTER TABLE `6371447060cr`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `6371447060cs`
--
ALTER TABLE `6371447060cs`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `6371447060f`
--
ALTER TABLE `6371447060f`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `6371447060r`
--
ALTER TABLE `6371447060r`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `6371447060s`
--
ALTER TABLE `6371447060s`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `7205726916`
--
ALTER TABLE `7205726916`
  MODIFY `sl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `7205726916cr`
--
ALTER TABLE `7205726916cr`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `7205726916cs`
--
ALTER TABLE `7205726916cs`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `7205726916f`
--
ALTER TABLE `7205726916f`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `7205726916r`
--
ALTER TABLE `7205726916r`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `7205726916s`
--
ALTER TABLE `7205726916s`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `7377560561`
--
ALTER TABLE `7377560561`
  MODIFY `sl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `7377560561cr`
--
ALTER TABLE `7377560561cr`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `7377560561cs`
--
ALTER TABLE `7377560561cs`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `7377560561f`
--
ALTER TABLE `7377560561f`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `7377560561r`
--
ALTER TABLE `7377560561r`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `7377560561s`
--
ALTER TABLE `7377560561s`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `challenges`
--
ALTER TABLE `challenges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `event_support`
--
ALTER TABLE `event_support`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `info`
--
ALTER TABLE `info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `support_photos`
--
ALTER TABLE `support_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event_support`
--
ALTER TABLE `event_support`
  ADD CONSTRAINT `event_support_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
