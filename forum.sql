-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2024 at 03:26 PM
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
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `adminname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `adminname`, `email`, `password`, `created_at`) VALUES
(1, 'Alok Chandra', 'alok@gmail.com', '$2y$10$e/qdlD4AzH5.bDXeoVRaNeV99zWK2lGJAlky8PozqcrI.E/DPKHh2', '2024-05-03 14:23:54'),
(2, 'Acqwin', 'acqwin@gmail.com', '$2y$10$lhbRWvazj4CoPia83hB68O1mzFJUaM88LoMvGUqauvmsToMkHD8p2', '2024-05-03 15:57:03');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(5) NOT NULL,
  `name` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`) VALUES
(1, 'Design', '2024-04-28 15:41:45'),
(2, 'Development', '2024-04-28 15:41:45'),
(3, 'Marketing', '2024-04-28 15:42:42'),
(4, 'SEO', '2024-04-28 15:42:42'),
(5, 'Hosting', '2024-04-28 15:42:42');

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `id` int(5) NOT NULL,
  `user_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `reply` varchar(200) NOT NULL,
  `user_id` int(5) NOT NULL,
  `user_image` varchar(250) NOT NULL,
  `topic_id` int(5) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`id`, `user_name`, `reply`, `user_id`, `user_image`, `topic_id`, `created_at`) VALUES
(21, 'Shaun', 'Vivamus posuere morbi consectetuer sem tristique id odio. Porttitor tempus eget congue vehicula praesent penatibus erat nisi dolor sem.', 2, 'gravatar.jpg', 15, '2024-05-04 13:37:44'),
(26, 'Alok', 'Id eros placerat maximus torquent vitae est primis facilisi vivamus. Maecenas aliquam ligula ante gravida rhoncus vitae.', 1, '9806510.jpg', 15, '2024-05-04 13:46:27'),
(27, 'Alok', 'Habitant nunc posuere dignissim dictumst sociosqu. Posuere mattis semper praesent sit fusce suscipit fermentum accumsan pede a.', 1, '9806510.jpg', 15, '2024-05-04 13:48:38'),
(28, 'Alok', 'Posmagnis per pretium id maximus nullam.  sedrffc', 1, '9806510.jpg', 17, '2024-05-04 13:52:59'),
(31, 'alok', 'hii', 6, '../img/rsz_wallpaperflarecom_wallpaper_1.jpg', 15, '2024-05-04 14:22:32'),
(32, 'alok', 'holaa', 6, '../img/rsz_wallpaperflarecom_wallpaper_1.jpg', 17, '2024-05-04 14:40:41');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `user_image` varchar(250) NOT NULL,
  `title` varchar(200) NOT NULL,
  `category` varchar(200) NOT NULL,
  `body` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `user_name`, `user_image`, `title`, `category`, `body`, `created_at`) VALUES
(15, 'Acqwin', '../img/wallpaperflare.com_wallpaper (1).jpg', 'First ', 'Design', 'Donec porta risus ipsum neque vitae rhoncus placerat. Mattis accumsan lectus purus semper vitae. Amet inceptos nisl venenatis id dignissim ac vestibulum elementum.', '2024-05-04 13:36:26'),
(17, 'Alok', '9806510.jpg', 'Full Stack Developer', 'Development', 'Habitasse sodales hac habitant interdum potenti mauris massa urna imperdiet suscipit class. Urna metus at semper diam feugiat.', '2024-05-04 13:52:44'),
(18, 'alok', '../img/rsz_wallpaperflarecom_wallpaper_1.jpg', 'Cloud Engineer', 'Hosting', 'Ullamcorper dis habitasse enim facilisi ridiculus. Fames parturient suspendisse aliquet class at viverra quam ac morbi ex facilisi.Aenean risus ipsum vitae sodales eros at consequat. Ultrices venenatis ut et viverra ligula semper duis lobortis aptent letius.', '2024-05-04 14:41:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(200) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `password` varchar(200) NOT NULL,
  `about` text NOT NULL,
  `avatar` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `about`, `avatar`, `created_at`) VALUES
(1, 'Alok', 'alok@gmail.com', 'Alok', '$2y$10$e/qdlD4AzH5.bDXeoVRaNeV99zWK2lGJAlky8PozqcrI.E/DPKHh2', 'FULL STACK DEVELOPER || FITNESS FREAK', '9806510.jpg', '2024-04-26 08:33:37'),
(2, 'Shaun Pinto', 'shaun@gmail.com', 'Shaun', '$2y$10$p8fYcj22OFG9OCL/uunXbu8Z5bj/wpN/yXWw8Eme8/gKot7LEsZ4e', 'Hello WORLD \r\nim the finance minister', 'gravatar.jpg', '2024-04-26 08:39:37'),
(3, 'Acqwin', 'acqwin@gmail.com', 'Acqwin', '$2y$10$ZToY0AlV5GbP8W4GlF1RIeMHeqAsfgQXZOU4QjX/oWgqqabMY/j66', 'CEO of Design MAYA', '../img/wallpaperflare.com_wallpaper (1).jpg', '2024-04-28 14:43:40'),
(5, 'Luv', 'dyyxkwhbd@laste.ml', 'Luv', '$2y$10$zjYhUKo56Dw6GN/QdBK2CeOkqfmsgIuQx9PBT61J1Ig0cVdj2PuqG', 'Molestie semper neque fermentum consectetuer nulla hendrerit placerat convallis. Suspendisse hac dapibus laoreet aliquam cubilia vestibulum feugiat purus dignissim viverra imperdiet. Pellentesque eu nec dictumst dis vehicula euismod consequat tortor eget id dolor. Vehicula fermentum sociosqu proin pharetra lorem. Orci amet sit feugiat augue ridiculus fermentum aliquet porttitor commodo vel.\n\nBibendum facilisis eros sodales montes fusce ex pellentesque ridiculus torquent. Pretium turpis pede tellus tempus luctus. Ante non himenaeos finibus eget ac. Aliquet blandit sollicitudin dui hac commodo. Velit vitae blandit cras euismod si justo mus. Lacus ridiculus lectus nulla bibendum hendrerit.', '', '2024-04-30 19:28:30'),
(6, 'Alok', 'alokkkk@gmail.com', 'alok', '$2y$10$FOsfLu61DMd.mxhk5iZF2elFdRUu63YJ9QjYZ3K1Pd54khWd/30Ke', '', '../img/rsz_wallpaperflarecom_wallpaper_1.jpg', '2024-05-04 08:50:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
