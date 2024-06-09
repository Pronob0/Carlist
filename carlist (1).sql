-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2024 at 10:40 AM
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
-- Database: `carlist`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `video_link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `abouts`
--

INSERT INTO `abouts` (`id`, `title`, `subtitle`, `image`, `video_link`) VALUES
(1, 'Outline the following three steps for Carlist.', 'With an unwavering passion for cars, we\'ve crafted more than just a platform – it\'s an immersive, thrilling adventure. Our commitment is to deliver a unique experience.', '9060908751713872935.png', 'https://www.youtube.com/watch?v=zE_W_3PkKVU');

-- --------------------------------------------------------

--
-- Table structure for table `about_tables`
--

CREATE TABLE `about_tables` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about_tables`
--

INSERT INTO `about_tables` (`id`, `title`, `subtitle`, `image`) VALUES
(2, 'Find Your Ideal Vehicleee', 'Discover your perfect ride effortlessly with a diverse selection tailored to your preferences.', '11141403531713936271.png'),
(3, 'Check Price With features', 'Effortlessly compare prices and features to make the perfect choice for your needs.', '3635122181713936829.png'),
(4, 'Get in touch with the seller', 'Contact the seller easily to discuss your inquiries or make a purchase.', '12603598401713936863.png');

-- --------------------------------------------------------

--
-- Table structure for table `addons`
--

CREATE TABLE `addons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `version` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verify_token` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `verify_code` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verify_token`, `phone`, `photo`, `status`, `password`, `remember_token`, `role`, `verify_code`, `created_at`, `updated_at`) VALUES
(1, 'adminssssss', 'admin@gmail.com', '', '09000000', '3041881451710753466.png', 1, '$2a$12$9JBkHY3ZufwePBl5pu.JgOEGsTS2V/RsJrd1w0/QX0/vWOi88GJBq', '3ifnBAoWJUSdOaW2aEsxp8L8bKQzkzAWu75KLDx2JGntmmftZHJ977jIEa7j', 'super-admin', 726094, NULL, '2024-03-18 03:17:46'),
(2, 'John', 'john@mail.com', NULL, NULL, NULL, 1, '$2y$10$by0NiJcmt2lHhfAI4lHQbuRWgUsRJO2EpsGXKFmU0Vt/PwJDre5Hu', NULL, 'moderator', NULL, '2022-01-17 22:36:49', '2022-01-19 05:48:28'),
(3, 'Miriam Mccoy', 'maccoy@mail.com', NULL, NULL, NULL, 1, '$2y$10$D0MH0g1qjTUoB824PeloK.XpjIAdJKZMbsqWZnHzLjFuvvQU8QMk.', NULL, 'moderator', NULL, '2022-01-19 05:05:33', '2022-01-19 05:05:33'),
(4, 'henry', 'henry@mail.com', NULL, NULL, NULL, 1, '$2y$10$DM9XXJb7KgQHESmlWTx6y.AhBZukZjH0DcW6BgWjvSavVMxnIEHfq', NULL, 'Ticket Handler', NULL, '2022-02-16 23:56:16', '2022-02-16 23:56:16');

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(191) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `description` longtext NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `category_id`, `title`, `slug`, `tags`, `photo`, `description`, `views`, `status`, `created_at`, `updated_at`) VALUES
(66, 8, 'What is Lorem Ipsum?', 'what-is-lorem-ipsum', NULL, '9222363811644728965.jpg', '<p><strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem Ipsum</strong><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p><p><strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem Ipsum</strong><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p><p><strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem Ipsum</strong><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p><p><strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem Ipsum</strong><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p><p><strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem Ipsum</strong><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p><p><strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem Ipsum</strong><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\"><br></span><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\"><br></span><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\"><br></span><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\"><br></span><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\"><br></span><br></p>', 5, 1, '2022-02-12 23:09:25', '2022-03-27 02:07:06'),
(67, 9, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry Need', 'lorem-ipsum-is-simply-dummy-text-of-the-printing-and-typesetting-industry-need', 'a,b,d', '16948648621645511038.jpg', '<p>Lorem Ipsum<span style=\"text-align:justify;\"> <b>is simply</b> dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>\r\n\r\n<p><strong>Lorem Ipsum</strong><span style=\"color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;text-align:justify;\"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>\r\n\r\n<p><strong>Lorem Ipsum</strong><span style=\"color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;text-align:justify;\"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>\r\n\r\n<p><span style=\"color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;text-align:justify;\"><br></span></p>\r\n\r\n<p><span style=\"color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;text-align:justify;\"><br></span></p>\r\n\r\n<p><strong>Lorem Ipsum</strong><span style=\"color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;text-align:justify;\"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>\r\n\r\n<p><strong>Lorem Ipsum</strong><span style=\"color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;text-align:justify;\"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>\r\n\r\n<p><span style=\"color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;text-align:justify;\"><br></span></p>\r\n\r\n<p><span style=\"color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;text-align:justify;\"><br></span></p>\r\n\r\n<p><strong>Lorem Ipsum</strong><span style=\"color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;text-align:justify;\"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>\r\n\r\n<p><span style=\"color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;text-align:justify;\"><br></span></p>\r\n\r\n<p><span style=\"color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;text-align:justify;\"><br></span></p>\r\n\r\n<p><span style=\"color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;text-align:justify;\"><br></span></p>\r\n\r\n<p><span style=\"color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;text-align:justify;\"><br></span><span style=\"color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;text-align:justify;\"><br></span><span style=\"color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;text-align:justify;\"><br></span><span style=\"color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;text-align:justify;\"><br></span><span style=\"color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;text-align:justify;\"><br></span><span style=\"color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;text-align:justify;\"><br></span><br></p>', 30, 1, '2022-02-12 23:11:32', '2024-02-18 05:58:48'),
(68, 10, 'Simply dummy text of the printing and typesetting industry.!!', 'simply-dummy-text-of-the-printing-and-typesetting-industry', 'sad,asdf,gwr,rt', '609659891645511084.jpg', '<p><span style=\"font-weight:bolder;color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;text-align:justify;\">Lorem Ipsum</span><span style=\"color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;text-align:justify;\"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>\r\n\r\n<p><span style=\"font-weight:bolder;color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;text-align:justify;\">Lorem Ipsum</span><span style=\"color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;text-align:justify;\"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>\r\n\r\n<p><span style=\"font-weight:bolder;color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;text-align:justify;\">Lorem Ipsum</span><span style=\"color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;text-align:justify;\"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>\r\n\r\n<p><span style=\"font-weight:bolder;color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;text-align:justify;\">Lorem Ipsum</span><span style=\"color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;text-align:justify;\"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>\r\n\r\n<p><span style=\"font-weight:bolder;color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;text-align:justify;\">Lorem Ipsum</span><span style=\"color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;text-align:justify;\"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>\r\n\r\n<p><span style=\"font-weight:bolder;color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;text-align:justify;\">Lorem Ipsum</span><span style=\"color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;text-align:justify;\"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><span style=\"color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;text-align:justify;\"><br></span><span style=\"color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;text-align:justify;\"><br></span></p>', 2, 1, '2022-02-22 00:24:44', '2024-01-24 02:52:31');

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` bigint(20) NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(8, 'News', 'news', 1, NULL, NULL),
(9, 'Announces', 'announces', 1, NULL, NULL),
(10, 'Statistics', 'statistics', 1, NULL, NULL),
(11, 'rtwert', 'rtwert', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blog_comments`
--

CREATE TABLE `blog_comments` (
  `id` int(11) NOT NULL,
  `blog_id` int(25) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog_comments`
--

INSERT INTO `blog_comments` (`id`, `blog_id`, `name`, `email`, `message`) VALUES
(1, 68, 'pronob', 'pronob@gmail.com', 'This is blog comment');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `image`, `status`, `created_at`, `updated_at`) VALUES
(11, 'Test Brand', 'test-brand', '4210532221711170720.jpg', 1, '2024-03-22 23:12:00', '2024-03-22 23:12:00');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `user_id` int(25) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category_id` int(5) NOT NULL,
  `image` varchar(255) NOT NULL,
  `current_price` double NOT NULL,
  `previous_price` double NOT NULL,
  `mileage` varchar(255) NOT NULL,
  `is_feature` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `condition_id` int(5) NOT NULL,
  `brand_id` int(5) NOT NULL,
  `model_id` int(5) NOT NULL,
  `fuel_id` int(5) NOT NULL,
  `transmission_id` int(5) NOT NULL,
  `description` text NOT NULL,
  `specification` varchar(1555) DEFAULT NULL,
  `video_image1` varchar(255) DEFAULT NULL,
  `video_image2` varchar(255) DEFAULT NULL,
  `video_link1` varchar(255) DEFAULT NULL,
  `video_link2` varchar(255) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `meta_tag` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `user_id`, `title`, `slug`, `category_id`, `image`, `current_price`, `previous_price`, `mileage`, `is_feature`, `status`, `condition_id`, `brand_id`, `model_id`, `fuel_id`, `transmission_id`, `description`, `specification`, `video_image1`, `video_image2`, `video_link1`, `video_link2`, `tags`, `meta_tag`, `meta_description`, `created_at`, `updated_at`, `type`) VALUES
(2, 17, 'Api test car listing five', 'api-test-car-listing-five', 9, '1797922221713681552.png', 20000, 30000, '320', 1, 1, 7, 11, 1, 2, 2, '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', '{\"model year\":\"2025\",\"speed\":\"400 km\\/h\"}', '4408231051713681552.png', '11658619231713681552.png', 'https://www.pexels.com/video/video-of-a-luxury-sports-car-5309351/', 'https://www.pexels.com/video/video-of-a-luxury-sports-car-5309351/', 'Car,new,carlist', 'Car,new,carlist', 'meta description', '2024-04-21 00:39:12', '2024-05-04 23:53:14', 1),
(3, 17, 'Api test car listing', 'api-test-car-listing', 9, '12777545421714472387.png', 20000, 30000, '320', 0, 1, 7, 11, 1, 2, 2, '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', '{\"model year\":\"2025\",\"speed\":\"400 km\\/h\"}', '9671616091714472388.png', '3000178021714472388.png', 'https://www.pexels.com/video/video-of-a-luxury-sports-car-5309351/', 'https://www.pexels.com/video/video-of-a-luxury-sports-car-5309351/', 'Car,new,carlist', 'Car,new,carlist', NULL, '2024-04-30 04:19:48', '2024-04-30 04:19:48', 1),
(4, 17, 'Api test car listing 2', 'api-test-car-listing-2', 9, '122998761714887908.png', 20000, 30000, '320', 0, 1, 7, 11, 1, 2, 2, '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', '{\"model year\":\"2025\",\"speed\":\"400 km\\/h\"}', '7980219191714887909.png', '19286427161714887909.png', 'https://www.pexels.com/video/video-of-a-luxury-sports-car-5309351/', 'https://www.pexels.com/video/video-of-a-luxury-sports-car-5309351/', 'Car,new,carlist', 'Car,new,carlist', 'meta description', '2024-05-04 23:45:09', '2024-05-04 23:45:09', 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(25) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(9, 'Test Category', 'test-category', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `conditions`
--

CREATE TABLE `conditions` (
  `id` int(25) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `conditions`
--

INSERT INTO `conditions` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(7, 'New Condition', 'new-condition', 1, '2024-03-22 23:13:47', '2024-03-22 23:14:09');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unique_key` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `dial_code` varchar(10) DEFAULT NULL,
  `currency_id` int(11) NOT NULL,
  `flag` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `unique_key`, `name`, `code`, `dial_code`, `currency_id`, `flag`, `created_at`, `updated_at`) VALUES
(2, 1, 'Ascension Island', 'AC', '+247', 4, 'https://cdn.jsdelivr.net/npm/country-flag-emoji-json@2.0.0/dist/images/AC.svg', '2021-12-20 23:25:41', '2021-12-20 23:55:28'),
(3, 240, 'United States', 'US', '+1', 1, 'https://cdn.jsdelivr.net/npm/country-flag-emoji-json@2.0.0/dist/images/US.svg', '2021-12-21 00:16:55', '2021-12-21 00:16:55'),
(4, 19, 'Bangladesh', 'BD', '+880', 6, 'https://cdn.jsdelivr.net/npm/country-flag-emoji-json@2.0.0/dist/images/BD.svg', '2021-12-21 00:50:56', '2021-12-21 00:50:56'),
(5, 81, 'United Kingdom', 'GB', '+44', 5, 'https://cdn.jsdelivr.net/npm/country-flag-emoji-json@2.0.0/dist/images/GB.svg', '2021-12-21 00:51:27', '2021-12-21 05:53:03'),
(6, 18, 'Belgium', 'BE', '+32', 4, 'https://cdn.jsdelivr.net/npm/country-flag-emoji-json@2.0.0/dist/images/BE.svg', '2022-01-29 23:47:16', '2022-01-29 23:47:16'),
(7, 11, 'Austria', 'AT', '+43', 4, 'https://cdn.jsdelivr.net/npm/country-flag-emoji-json@2.0.0/dist/images/AT.svg', '2022-02-06 05:55:48', '2022-02-06 05:55:48'),
(8, 0, 'Afghanistan', 'AF', '+93', 10, 'https://cdn.jsdelivr.net/npm/country-flag-emoji-json@2.0.0/dist/images/AF.svg', '2022-03-13 04:04:03', '2022-03-13 04:04:03'),
(9, 2, 'Algeria', 'DZ', '+213', 4, 'https://cdn.jsdelivr.net/npm/country-flag-emoji-json@2.0.0/dist/images/DZ.svg', '2022-03-13 04:04:18', '2022-03-13 04:04:18'),
(10, 5, 'Anguilla', 'AI', '+1264', 13, 'https://cdn.jsdelivr.net/npm/country-flag-emoji-json@2.0.0/dist/images/AI.svg', '2022-03-13 04:04:30', '2022-03-13 04:04:30'),
(11, 24, 'Brazil', 'BR', '+55', 1, 'https://cdn.jsdelivr.net/npm/country-flag-emoji-json@2.0.0/dist/images/BR.svg', '2022-03-13 04:04:57', '2022-03-13 04:04:57'),
(12, 31, 'Canada', 'CA', '+1', 1, 'https://cdn.jsdelivr.net/npm/country-flag-emoji-json@2.0.0/dist/images/CA.svg', '2022-03-13 04:07:58', '2022-03-13 04:07:58'),
(13, 52, 'Egypt', 'EG', '+20', 1, 'https://cdn.jsdelivr.net/npm/country-flag-emoji-json@2.0.0/dist/images/EG.svg', '2022-03-13 04:08:13', '2022-03-13 04:08:13');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `default` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '1 => default, 0 => not default',
  `symbol` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `curr_name` varchar(255) NOT NULL,
  `status` int(10) UNSIGNED NOT NULL COMMENT '1 => active, 0 => inactive',
  `rate` decimal(20,10) UNSIGNED NOT NULL,
  `charges` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `icon`, `default`, `symbol`, `code`, `curr_name`, `status`, `rate`, `charges`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, '$', 'USD', 'United State Dollar', 1, 1.0000000000, NULL, '2021-12-20 04:12:58', '2024-02-12 02:55:16'),
(4, NULL, 0, '€', 'EUR', 'European Currency', 1, 0.9300000000, NULL, '2021-12-20 04:12:58', '2024-03-10 04:38:00'),
(5, NULL, 0, '£', 'GBP', 'Greate British Pound', 1, 0.7376150000, NULL, '2021-12-21 00:45:51', '2022-02-16 03:02:35'),
(6, NULL, 0, '৳', 'BDT', 'Bangladeshi Taka', 1, 85.9261900000, NULL, '2021-12-21 00:48:53', '2022-02-16 03:02:35'),
(10, NULL, 0, '₹', 'INR', 'Indian Rupee', 1, 75.0096000000, NULL, '2022-01-26 02:28:23', '2022-02-16 03:02:35'),
(11, NULL, 0, '¥', 'JPY', 'Japanese Yen', 1, 115.6425010000, NULL, '2022-01-26 02:30:04', '2022-02-16 03:02:35'),
(13, NULL, 0, '₦', 'NGN', 'Nigerian naira', 1, 415.7594650000, NULL, '2022-02-06 05:41:35', '2022-02-16 03:02:35');

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` bigint(20) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `currency_id` int(11) NOT NULL,
  `method` varchar(191) DEFAULT NULL,
  `deposit_number` varchar(255) DEFAULT NULL,
  `txnid` varchar(255) DEFAULT NULL,
  `charge_id` varchar(191) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deposits`
--

INSERT INTO `deposits` (`id`, `user_id`, `currency_id`, `method`, `deposit_number`, `txnid`, `charge_id`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 17, 1, 'Paypal', 'J7swFMWqMnzF', '3UH26752SB121364L', NULL, 20, 'pending', '2023-12-30 02:54:06', '2023-12-30 02:54:31'),
(2, 17, 1, 'Paypal', '7msl7qewrhIb', '3HN76893GT252012K', NULL, 30, 'pending', '2023-12-30 02:58:55', '2023-12-30 02:59:57'),
(3, 17, 1, 'Paypal', 'm1RtXSTYxHaH', '37K72562VT673941M', NULL, 40, 'complete', '2023-12-30 03:02:58', '2023-12-30 03:03:11'),
(4, 17, 1, 'Stripe', 'OAiQeN5ZVm6V', 'pi_3OSyyLJlIV5dN9n71GkV7aKJ', 'cs_test_a1k06HSBwGEYzq7fiCSjlarPsE7GqIgMuB5kL13mfszTop013OmHSXNMa9', 30, 'complete', '2023-12-30 03:41:09', '2023-12-30 03:41:09'),
(14, 17, 1, 'Paypal', 'Bjnl5ciRo02h', '14P650823X203333R', NULL, 50, 'complete', '2024-02-24 23:56:25', '2024-02-24 23:56:53'),
(15, 16, 1, 'Paypal', 'ROPrFCxg82cY', '6K075042MN705043A', NULL, 5, 'complete', '2024-02-28 05:52:49', '2024-02-28 05:53:28'),
(16, 17, 10, 'Razorpay', 'h47JQgUa8H3I', 'order_NhpSCFmg7KkLmW', NULL, 0.0088866137701654, 'complete', '2024-03-03 03:14:03', '2024-03-03 03:14:03'),
(17, 17, 10, 'Razorpay', 'HhfMxaYN5THm', 'order_NhpXvwK3Tchi9s', NULL, 1.7773227540331, 'complete', '2024-03-03 03:19:21', '2024-03-03 03:19:21'),
(18, 17, 1, 'Stripe', 'N7gGP1LqPVqi', 'pi_3OqBEjJlIV5dN9n70xCNpvaM', 'cs_test_a1VsCL5bZfBNBuQMfsRwQpTtC7oJmvGFPUuZpez8n8J2lNddGbR6nufEKZ', 10, 'complete', '2024-03-03 03:21:53', '2024-03-03 03:21:53'),
(19, 17, 10, 'Razorpay', 'XxGq5Q6eOvFy', 'order_NhrInZSpTGAtnC', NULL, 0.6665813442546, 'complete', '2024-03-03 05:08:56', '2024-03-03 05:08:56'),
(20, 17, 10, 'Razorpay', 'fmt6fIZLF3fh', 'order_NhrVxcqET71ZxO', NULL, 0.6665813442546, 'complete', '2024-03-03 05:14:53', '2024-03-03 05:14:53'),
(21, 17, 10, 'Razorpay', 'IJdQtp4aP9Kb', 'order_NhrgoDZiRsYurq', NULL, 1.3331626885092, 'complete', '2024-03-03 05:25:10', '2024-03-03 05:25:10'),
(22, 17, 1, 'Paypal', 'mHPtEOmD6T3H', '4LP19315M5518463Y', NULL, 10, 'complete', '2024-03-04 02:14:09', '2024-03-04 02:15:00'),
(23, 17, 1, 'Stripe', 'HiD3AX4dbIrW', 'pi_3OqWluJlIV5dN9n70d9lkCP7', 'cs_test_a1N0hEbJVOhL0a77hCBxKs1c1izlrLWOqyZRidGhardCpNnnS6XOarHs4E', 10, 'complete', '2024-03-04 02:21:21', '2024-03-04 02:21:21');

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` int(11) NOT NULL,
  `email_type` varchar(255) DEFAULT NULL,
  `email_subject` mediumtext DEFAULT NULL,
  `email_body` longtext DEFAULT NULL,
  `sms` text DEFAULT NULL,
  `codes` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `email_type`, `email_subject`, `email_body`, `sms`, `codes`, `status`) VALUES
(12, 'add_balance', 'Balance added by system', '<p>Hello {name},\r\n</p><p>\r\nBalance added {amount} {curr} in your wallet ({curr}) by system successfully.\r\n</p><p>\r\nTransaction details:\r\n</p><ul><li>Amount  :  {amount} {curr}\r\n</li><li>Transaction ID : {trnx}\r\n</li><li>New balance : {after_balance}\r\n</li><li>Time : {date_time}</li></ul>', 'Hello {name},\r\n\r\nBalance added {amount} {curr} in your wallet ({curr}) from system successfully.\r\n\r\nTransaction details:\r\nAmount  :  {amount} {curr}\r\nTransaction ID : {trnx}\r\nNew balance : {after_balance}\r\nTime : {date_time}', '{\"amount\":\"payment amount\",\"trnx\":\"Transaction ID\",\"curr\":\"currency\",\"after_balance\":\"after geting payment remaining balance\",\"data_time\":\"date and time\"}', 1),
(13, 'subtract_balance', 'Balance subtracted by system', '<p>Hello {name},\r\n</p><p>\r\nBalance subtracted {amount} {curr} from your wallet ({curr}) by system successfully.\r\n</p><p>\r\nTransaction details:\r\n</p><ul><li>Amount  :  {amount} {curr}\r\n</li><li>Transaction ID : {trnx}\r\n</li><li>New balance : {after_balance}\r\n</li><li>Time : {date_time}</li></ul>', 'Hello {name},\r\n\r\nBalance subtracted {amount} {curr} from your wallet ({curr}) by system successfully.\r\n\r\nTransaction details:\r\nAmount  :  {amount} {curr}\r\nTransaction ID : {trnx}\r\nNew balance : {after_balance}\r\nTime : {date_time}', '{\"amount\":\"payment amount\",\"trnx\":\"Transaction ID\",\"curr\":\"currency\",\"after_balance\":\"after geting payment remaining balance\",\"data_time\":\"date and time\"}', 1),
(14, 'accept_withdraw', 'Withdraw request accepted', '<p>Hello <b>{name}</b>,\r\n</p><p>\r\nYour withdraw request <b>{amount} {curr}</b> is accepted.\r\n</p><p>\r\nWithdraw details:\r\n</p><ul><li>Amount  :  {amount} {curr}\r\n</li><li>Charge  : {charge} {curr}\r\n</li><li>Final Amount(after charge): {final_amount} {curr}\r\n</li><li>Transaction ID : {trnx}\r\n', 'Hello {name},\r\n\r\nYour withdraw request {amount} {curr} is accepted.\r\n\r\nWithdraw details:\r\nAmount  :  {amount} {curr}\r\nCharge  : {charge} {curr}\r\nFinal Amount(after charge): {final_amount} {curr}\r\nTransaction ID : {trnx}\r\n', '{\"amount\":\"payment amount\",\"trnx\":\"Transaction ID\",\"curr\":\"currency\",\"charge\":\"charge\",\"final_amount\":\"Final Amount afte charge\"}', 1),
(15, 'reject_withdraw', 'Withdraw request rejected', '<p>Hello {name},\n</p><p>\nYour withdraw request {amount} {curr} is rejected. The withdraw amount {amount} {curr} has been returned to your balance.</p><p>\nWithdraw details:\n</p><ul><li>Amount  :  {amount} {curr}\n</li><li>Transaction ID : {trnx}\n</li></ul><p><u>\nRejection reason </u>:\n</p><p>{reason}\n</p><p>\n\n</p>', 'Hello {name},\n\nYour withdraw request {amount} {curr} is rejected.\n\nWithdraw details:\nAmount  :  {amount} {curr}\nTransaction ID : {trnx}\n\nRejection reason :\n{reason}\n\n', '{\"amount\":\"payment amount\",\"trnx\":\"Transaction ID\",\"curr\":\"currency\",\"reason\":\"reject reason\"}', 1),
(20, 'deposit_reject', 'Reject Deposit', '<p>Hello {name},\r\n</p><p>\r\nYour deposit request {amount} {curr} via {method} is rejected.\r\n</p><p><b>\r\nTransaction details:\r\n</b></p><ul><li>\r\nAmount  :  {amount} {curr}\r\n</li><li>Transaction ID : {trnx}\r\n</li><li>Charge  : {charge}\r\n</li><li>\r\nReject Reason :\r\n{reject_reason}\r\n</li></ul><p>\r\nTime : {date_time}\r\n</p>', 'Hello {name},\r\n\r\nYour deposit request {amount} {curr} via {method} is rejected.\r\n\r\nTransaction details:\r\n\r\nAmount  :  {amount} {curr}\r\nTransaction ID : {trnx}\r\nCharge  : {charge}\r\n\r\nRject Reason :\r\n{reject_reason}\r\n\r\nTime : {date_time}\r\n', '{\"amount\":\"deposit amount\",\"trnx\":\"Transaction ID\",\"curr\":\"currency\",\"data_time\":\"date and time\",\"method\":\"deposit method name\",\"charge\":\"charge\",\"reject_reason\":\" reason of reject\"}', 1),
(21, 'accept_withdraw', 'Withdraw request accepted', '<p>Hello <b>{name}</b>,\r\n</p><p>\r\nYour withdraw request <b>{amount} {curr}</b> is accepted via <b>{method}</b>.\r\n</p><p>\r\nWithdraw details:\r\n</p><ul><li>Amount  :  {amount} {curr}\r\n</li><li>Charge  : {charge}\r\n</li><li>Transaction ID : {trnx}\r\n</li><li>Withdraw Method : {method}\r\n</li><li>Time : {date_time}</li></ul>', 'Hello {name},\r\n\r\nYour withdraw request {amount} {curr} is accepted via {method}.\r\n\r\nWithdraw details:\r\nAmount  :  {amount} {curr}\r\nCharge  : {charge}\r\nTransaction ID : {trnx}\r\nWithdraw Method : {method}\r\nTime : {date_time}', '{\"amount\":\"payment amount\",\"trnx\":\"Transaction ID\",\"curr\":\"currency\",\"data_time\":\"date and time\",\"charge\":\"charge\",\"method\":\"Withdraw method\"}', 1),
(24, 'bid_winner', 'Bidding Winner Selected', '<p>Hello <b>{user}</b>,\n</p>\n\n<p><b>Congratulations!! You have won the auction {auction}</b></p>\n\n<p>Trade details:\n</p>\n\n<p>Amount :  {amount} USD</p>\n\n<p>Auction<b> </b>:  {auction}</p>\n\n<p>Date : {date}</p>\n\n', 'Congratulations!! You have won the auction {auction}\n\nTrade details:\n\nAmount : {amount} USD\n\nAuction : {auction}\n\nDate : {date}', '{\"user\":\"User\",\"amount\":\"Amount\",\"auction\":\"Auction Title\",\"date\":\"Date\"}', 1),
(25, 'deposit_completed', 'Deposit has been completed successfully', '<p>Hello <b>{name}</b>,\r\n</p>\r\n\r\n<p>\r\nYour deposit has been completed successfully</b>.\r\n</p>\r\n\r\n<p>Deposit details:\r\n</p>\r\n\r\n<p><b>Crypto Amount</b> :  {crypto_amount} {cryp_curr}</p>\r\n<p><b>Charge</b> :  {charge} {cryp_curr}</p>\r\n<p><b>Transaction ID</b> :  {tnx} </p>\r\n<p><b>Coinpayment Transaction ID</b> :  {cp_tnx} </p>\r\n\r\n<p>\r\n\r\n\r\n', 'Hello {name},\r\n\r\nYour deposit has been completed successfully\r\n\r\nDeposit details:\r\n\r\nCrypto Amount :  {crypto_amount} {cryp_curr}\r\n\r\nCharge :  {charge} {cryp_curr}\r\n\r\nTransaction ID :  {tnx}\r\n\r\nCoinpayment Transaction ID :  {cp_tnx}\r\n\r\n', '{\"crypto_amount\":\" Fiat amount\",\"cryp_curr\":\"Crypto currency\",\"tnx\":\"Transaction ID\",\"cp_tnx\":\"Coinpayment Transaction ID\"}', 1),
(26, 'bid_return', 'Bidding amount Refunded', '<p>Hello <span style=\"font-weight:bolder;\">{user}</span>,</p>\n\n<p>Bid winner is selected. Your Bidding amount is refunded.</p>\n\n<p><span style=\"font-weight:bolder;\"><u> Details:</u></span></p>\n\n<ul><li>Refunded Amount :  <span style=\"font-weight:bolder;\"><span style=\"font-weight:bolder;\">{refunded_amount}<span style=\"font-weight:bolder;\"> USD</span><br></span></span></li><li>Highest Amount: <span style=\"font-weight:bolder;\">{highest_amount}</span></li><li>Auction Title :<span style=\"font-weight:bolder;\">  {auction}</span></li><li>Winner Name : <span style=\"font-weight:bolder;\">{winner_name}</span><br></li></ul>\n\n<p>Time : {date}</p>\n\n', 'Hello {user},\n\nBid winner is selected. Your Bidding amount is refunded.\n\n Details:\n\nRefunded Amount :  {refunded_amount} USD\nHighest Amount: {highest_amount}\nAuction Title :  {auction}\nWinner Name : {winner_name}\nTime : {date}', '{\"user\":\"User\",\"refunded_amount\":\"Refunded Amount\",\"highest_amount\":\"Highest Amount\",\"auction\":\"Auction\",\"winner_name\":\"Winner Name\",\"date\":\"Date\"}', 1),
(27, 'new_bid', 'New Bid Added Successfully', '<p>Hello <span style=\"font-weight:bolder;\">{auction_owner}</span>,</p>\n\n<p>Bid winner is selected. Your Bidding amount is refunded.</p>\n\n<p><span style=\"font-weight:bolder;\"><u> Details:</u></span></p>\n\n<ul><li>Amount : <b>{amount}</b></li><li>Auction Name:<b> {auction_name}</b></li></ul>\n\n<p>Time : {date}</p>\n\n<p><br></p>', 'Hello {auction_owner},\n\nA new Customer has bid in this auction.\n\n Details:\n\nAmount :  {amount} USD\nAuction Name: {auction_name}\nTime : {date}', '{\"amount\":\"amount\",\"auction_name\":\"Auction name\",\"auction_owner\":\"Auction Owner\",\"date\":\"Date\"}', 1),
(28, 'deposit_approve', 'Approve Deposit', '<p>Hello {name},\r\n</p><p>\r\nYour deposit request {amount} {curr} via {method} is approved.\r\n</p><p><b>\r\nTransaction details:\r\n</b></p><ul><li>\r\nAmount  :  {amount} {curr}\r\n</li><li>Charge  : {charge} {curr}\r\n</li><li>Transaction ID : {trnx}\r\n</li><li>New Balance  : {new_balance} {curr}</li></ul><p>Time : {date_time}\r\n</p>', 'Hello {name},\r\n\r\nYour deposit request {amount} {curr} via {method} is approved.\r\n\r\nTransaction details:\r\n\r\nAmount  :  {amount} {curr}\r\nCharge  : {charge} {curr}\r\nTransaction ID : {trnx}\r\nNew Balance  : {new_balance}\r\nTime : {date_time}', '{\"amount\":\"deposit amount\",\"trnx\":\"Transaction ID\",\"curr\":\"currency\",\"data_time\":\"date and time\",\"method\":\"deposit method name\",\"new_balance\":\"New balance\",\"charge\":\"Charge\"}', 1);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fuels`
--

CREATE TABLE `fuels` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fuels`
--

INSERT INTO `fuels` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Test Fuel', 'test-fuel', 1, '2024-03-22 23:51:18', '2024-03-22 23:51:18');

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` int(11) NOT NULL,
  `car_id` int(25) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `car_id`, `image`) VALUES
(4, 2, '1875228141713681552.png'),
(5, 2, '7641740991713681552.png'),
(6, 2, '16453226181713681552.png'),
(7, 3, '12894462451714472388.png'),
(8, 3, '7560205331714472389.png'),
(9, 3, '7932066661714472390.png'),
(10, 3, '13255200841714472390.png'),
(11, 4, '15441768521714887910.png'),
(12, 4, '4182473621714887910.png'),
(13, 4, '21115260281714887911.png');

-- --------------------------------------------------------

--
-- Table structure for table `generalsettings`
--

CREATE TABLE `generalsettings` (
  `id` int(11) NOT NULL,
  `curr_code` varchar(10) NOT NULL DEFAULT 'USD',
  `curr_sym` varchar(10) NOT NULL DEFAULT '$',
  `header_logo` varchar(255) DEFAULT NULL,
  `footer_logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(191) NOT NULL,
  `breadcumb_banner` varchar(255) DEFAULT NULL,
  `title` varchar(191) NOT NULL,
  `loader` varchar(191) NOT NULL,
  `smtp_host` varchar(255) DEFAULT NULL,
  `mail_type` varchar(255) DEFAULT NULL,
  `smtp_port` varchar(255) DEFAULT NULL,
  `smtp_user` varchar(255) DEFAULT NULL,
  `smtp_pass` varchar(255) DEFAULT NULL,
  `mail_encryption` varchar(255) DEFAULT NULL,
  `from_email` varchar(255) DEFAULT NULL,
  `from_name` varchar(255) DEFAULT NULL,
  `theme_color` varchar(255) DEFAULT NULL,
  `is_tawk` tinyint(4) NOT NULL DEFAULT 0,
  `tawk_id` varchar(222) DEFAULT NULL,
  `is_verify` tinyint(4) DEFAULT 0,
  `is_cookie` tinyint(4) NOT NULL DEFAULT 0,
  `cookie_btn_text` varchar(255) DEFAULT NULL,
  `cookie_text` text DEFAULT NULL,
  `is_maintenance` tinyint(4) DEFAULT 0,
  `maintenance` text DEFAULT NULL,
  `registration` tinyint(1) NOT NULL DEFAULT 1,
  `kyc` tinyint(1) NOT NULL DEFAULT 1,
  `kyc_offer_limit` int(11) NOT NULL DEFAULT 0,
  `kyc_trade_limit` int(11) NOT NULL DEFAULT 0,
  `sms_notify` tinyint(1) NOT NULL DEFAULT 1,
  `email_notify` tinyint(1) NOT NULL DEFAULT 1,
  `allowed_email` text DEFAULT NULL,
  `contact_no` varchar(20) DEFAULT NULL,
  `recaptcha` tinyint(1) NOT NULL DEFAULT 0,
  `recaptcha_key` varchar(255) DEFAULT NULL,
  `recaptcha_secret` varchar(255) DEFAULT NULL,
  `api_settings` text DEFAULT NULL,
  `cookie` text DEFAULT NULL,
  `menu` text DEFAULT NULL,
  `two_fa` int(11) NOT NULL,
  `charge_type` varchar(191) DEFAULT NULL,
  `charge_amount` varchar(191) DEFAULT NULL,
  `footer_text` varchar(255) DEFAULT NULL,
  `fron_domain` varchar(255) DEFAULT NULL,
  `back_domain` varchar(255) DEFAULT NULL,
  `copyright` text DEFAULT NULL,
  `homepage` int(5) DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `generalsettings`
--

INSERT INTO `generalsettings` (`id`, `curr_code`, `curr_sym`, `header_logo`, `footer_logo`, `favicon`, `breadcumb_banner`, `title`, `loader`, `smtp_host`, `mail_type`, `smtp_port`, `smtp_user`, `smtp_pass`, `mail_encryption`, `from_email`, `from_name`, `theme_color`, `is_tawk`, `tawk_id`, `is_verify`, `is_cookie`, `cookie_btn_text`, `cookie_text`, `is_maintenance`, `maintenance`, `registration`, `kyc`, `kyc_offer_limit`, `kyc_trade_limit`, `sms_notify`, `email_notify`, `allowed_email`, `contact_no`, `recaptcha`, `recaptcha_key`, `recaptcha_secret`, `api_settings`, `cookie`, `menu`, `two_fa`, `charge_type`, `charge_amount`, `footer_text`, `fron_domain`, `back_domain`, `copyright`, `homepage`) VALUES
(1, 'USD', '$', '2961577881713784753.png', NULL, '17854719881649489968.png', '{\"banner1\":\"17337977141710132984.png\",\"banner2\":\"1188315021709628838.png\"}', 'Auction', '1564224328loading3.gif', 'sandbox.smtp.mailtrap.io', 'php_mailer', '2525', '174ef2e8696f06', '50a07c1aca418f', 'tls', 'auction@cleantech.geniusocean.net', 'GeniusTest', 'FFC107', 1, '6124fa49d6e7610a49b1c136/1fds73c17', 0, 1, 'cookie_btn_text', NULL, 0, 'Site Down', 0, 1, 2, 2, 1, 1, NULL, '+88000000000', 0, '6LeMB00fAAAAABm___8W1d2ocsMjC7_8vdRXQ58b', '6LeMB00fAAAAAGB_3ya1UuIpAbikNOXyfPUr8Gey', '{\"public_key\":\"f9f6131239077d91a40ed48b0031dd50dc1f919cce169f3b2216a2ef6ff503ebb\",\"private_key\":\"Ccf6849b03299bc6C59195005bc570c96f76134d18E6Fd63d5bDA3C9B3AD0c7ee\",\"merchant_id\":\"2e90051d816228d86d4b25c683823468\"}', '{\"status\":\"0\",\"button_text\":\"Allow Cookie\",\"cookie_text\":\"Our site use cookies when you visit our website, including any other media form, mobile website, or mobile application related or connected to help customize the site and improve your experience.\"}', '{\"Home\":{\"title\":\"Home\",\"dropdown\":\"no\",\"href\":\"http:\\/\\/localhost:4000\",\"target\":\"self\"},\"About\":{\"title\":\"About\",\"dropdown\":\"yes\",\"href\":\"http:\\/\\/localhost:4000\\/about-us\",\"target\":\"self\"},\"Blogs\":{\"title\":\"Blogs\",\"dropdown\":\"yes\",\"href\":\"http:\\/\\/localhost:4000\\/all-blog\",\"target\":\"self\"},\"Contact\":{\"title\":\"Contact\",\"dropdown\":\"yes\",\"href\":\"http:\\/\\/localhost:4000\\/contact-us\",\"target\":\"self\"},\"Cars\":{\"title\":\"Cars\",\"dropdown\":\"yes\",\"href\":\"http:\\/\\/localhost:4000\\/all-cars\",\"target\":\"self\"}}', 1, '1', '5', 'Elevate your bidding game with our comprehensive guide. From bidding strategies to auction etiquette, Bidder\'s Digest is your go-to source for becoming a savvy and successful bidder.', 'http://localhost:4000', 'http://localhost/latest/auction/new', '&copy; Company 2024 | All Rights Reserved GeniusOcean', 1);

-- --------------------------------------------------------

--
-- Table structure for table `header_sections`
--

CREATE TABLE `header_sections` (
  `id` int(11) NOT NULL,
  `category_title` varchar(255) DEFAULT NULL,
  `category_subtitle` varchar(255) DEFAULT NULL,
  `featured_title` varchar(255) DEFAULT NULL,
  `featured_subtitle` varchar(255) DEFAULT NULL,
  `recentcars_title` varchar(255) DEFAULT NULL,
  `recentcars_subtitle` varchar(255) DEFAULT NULL,
  `blog_title` varchar(255) DEFAULT NULL,
  `blog_subtitle` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `header_sections`
--

INSERT INTO `header_sections` (`id`, `category_title`, `category_subtitle`, `featured_title`, `featured_subtitle`, `recentcars_title`, `recentcars_subtitle`, `blog_title`, `blog_subtitle`) VALUES
(1, 'Our Auction Categories', 'Our commitment to quality extends beyond our workmanship. We prioritize customer satisfaction, offering transparent pricing.', 'Featured Items', 'Our commitment to quality extends beyond our workmanship. We prioritize customer satisfaction, offering transparent pricing.', 'Live Auction', 'Our commitment to quality extends beyond our workmanship. We prioritize customer satisfaction, offering transparent pricing.', 'Your Auction Updates', 'As you bid boldly, remember that every auction is an opportunity. An opportunity to discover something extraordinary. to claim a coveted prize and to redefine');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kyc_forms`
--

CREATE TABLE `kyc_forms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` tinyint(4) NOT NULL,
  `label` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `required` int(11) NOT NULL COMMENT '1 = yes, 0 = no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kyc_forms`
--

INSERT INTO `kyc_forms` (`id`, `type`, `label`, `name`, `required`, `created_at`, `updated_at`) VALUES
(1, 1, 'NID', 'nid', 1, '2022-01-04 04:54:19', '2022-01-04 23:44:04'),
(2, 2, 'NID Screenshot', 'nid_screenshot', 0, '2022-01-04 04:56:07', '2022-01-04 04:56:07'),
(3, 3, 'Description of address', 'description_of_address', 1, '2022-01-04 04:58:14', '2022-01-04 04:58:14'),
(9, 2, 'NID Backside', 'nid_backside', 1, '2023-12-11 04:54:22', '2023-12-11 04:54:22');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `language` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(10) NOT NULL,
  `file` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `is_default`, `language`, `code`, `file`) VALUES
(17, 0, 'Spanish', 'es', 'es.json'),
(18, 1, 'English', 'en', 'en.json'),
(19, 0, 'Amharic ኣምሓሪኛ', 'Am', 'Am.json'),
(20, 0, 'Tigrinya ትግሪኛ', 'Tig', 'Tig.json');

-- --------------------------------------------------------

--
-- Table structure for table `login_logs`
--

CREATE TABLE `login_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `merchant_id` int(11) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT 'Unknown',
  `city` varchar(255) DEFAULT 'Unknown',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `login_logs`
--

INSERT INTO `login_logs` (`id`, `user_id`, `merchant_id`, `ip`, `country`, `city`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, '::1', NULL, NULL, '2023-05-07 22:33:48', '2023-05-07 22:33:48'),
(2, NULL, NULL, '::1', NULL, NULL, '2023-06-05 04:31:33', '2023-06-05 04:31:33'),
(3, 16, NULL, '::1', NULL, NULL, '2023-06-05 21:28:01', '2023-06-05 21:28:01'),
(4, 16, NULL, '103.168.90.13', 'Bangladesh', 'Dhaka', '2023-06-06 16:52:23', '2023-06-06 16:52:23'),
(5, NULL, NULL, '85.255.235.186', 'United Kingdom', '', '2023-07-23 11:12:10', '2023-07-23 11:12:10'),
(6, 17, NULL, '85.255.235.186', 'United Kingdom', '', '2023-07-23 11:14:05', '2023-07-23 11:14:05'),
(7, 16, NULL, '::1', NULL, NULL, '2023-11-19 02:33:57', '2023-11-19 02:33:57'),
(8, 16, NULL, '::1', NULL, NULL, '2023-11-19 22:49:18', '2023-11-19 22:49:18'),
(9, NULL, NULL, '::1', NULL, NULL, '2023-12-09 04:03:17', '2023-12-09 04:03:17'),
(10, NULL, NULL, '::1', NULL, NULL, '2023-12-09 04:06:32', '2023-12-09 04:06:32'),
(11, NULL, NULL, '::1', NULL, NULL, '2023-12-09 04:22:04', '2023-12-09 04:22:04'),
(12, NULL, NULL, '::1', NULL, NULL, '2024-02-27 23:08:04', '2024-02-27 23:08:04'),
(13, NULL, NULL, '::1', NULL, NULL, '2024-03-01 22:58:57', '2024-03-01 22:58:57'),
(14, NULL, NULL, '::1', NULL, NULL, '2024-03-01 23:04:00', '2024-03-01 23:04:00'),
(15, NULL, NULL, '::1', NULL, NULL, '2024-03-05 04:54:24', '2024-03-05 04:54:24'),
(16, NULL, NULL, '::1', NULL, NULL, '2024-03-05 05:02:03', '2024-03-05 05:02:03'),
(17, 1, NULL, '::1', NULL, NULL, '2024-04-02 00:16:40', '2024-04-02 00:16:40'),
(18, NULL, NULL, '::1', NULL, NULL, '2024-04-05 02:19:07', '2024-04-05 02:19:07'),
(19, NULL, NULL, '::1', NULL, NULL, '2024-04-05 02:20:36', '2024-04-05 02:20:36');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_09_25_053316_create_admins_table', 2),
(6, '2021_12_19_042602_create_site_contents_table', 3),
(7, '2021_12_20_032716_create_currencies_table', 4),
(8, '2021_12_20_041453_create_wallets_table', 5),
(9, '2021_12_20_061743_create_charges_table', 6),
(10, '2021_12_21_041624_create_countries_table', 7),
(11, '2021_12_21_095225_create_transactions_table', 8),
(12, '2021_12_22_044221_create_request_money_table', 9),
(13, '2021_12_23_053336_create_exchange_money_table', 10),
(14, '2021_12_28_083959_create_modules_table', 11),
(15, '2021_12_29_035701_create_vouchers_table', 12),
(16, '2021_12_30_050418_create_withdraws_table', 13),
(17, '2021_12_30_111614_create_withdrawals_table', 14),
(18, '2022_01_02_102323_create_payments_table', 15),
(19, '2022_01_03_032851_create_invoices_table', 16),
(20, '2022_01_03_034414_create_inv_items_table', 17),
(21, '2022_01_04_092638_create_k_y_c_s_table', 18),
(22, '2022_01_04_103906_create_kyc_forms_table', 18),
(23, '2022_01_09_035144_create_escrows_table', 19),
(24, '2022_01_09_064757_create_disputes_table', 20),
(25, '2022_01_16_053729_create_api_creds_table', 21),
(26, '2022_01_16_060854_create_merchant_payments_table', 22),
(27, '2022_01_17_100203_create_permission_tables', 23),
(28, '2022_01_20_050330_create_sms_gateways_table', 24),
(29, '2022_01_30_031517_create_login_logs_table', 25),
(30, '2022_02_02_091116_create_support_tickets_table', 26),
(31, '2022_02_02_091130_create_ticket_messages_table', 26),
(32, '2022_03_09_081733_create_trade_durations_table', 27),
(33, '2022_03_09_094834_create_offers_table', 28),
(34, '2022_03_10_111742_create_trades_table', 29),
(35, '2022_03_28_054845_create_wallets_table', 30),
(36, '2022_03_28_114819_create_trade_chats_table', 31),
(37, '2022_03_31_031220_create_deposit_addresses_table', 32),
(38, '2022_04_04_045506_create_offer_limits_table', 33),
(39, '2023_05_09_044402_create_exchanges_table', 34),
(40, '2022_04_13_051442_create_agents_table', 35),
(41, '2022_04_21_053042_create_fund_requests_table', 35),
(42, '2024_01_03_091352_create_jobs_table', 36);

-- --------------------------------------------------------

--
-- Table structure for table `modals`
--

CREATE TABLE `modals` (
  `id` int(11) NOT NULL,
  `brand_id` int(15) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modals`
--

INSERT INTO `modals` (`id`, `brand_id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 11, 'pronob', 'pronob', 1, '2024-03-22 23:25:40', '2024-03-22 23:25:56');

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\Admin', 1),
(3, 'App\\Models\\Admin', 2),
(3, 'App\\Models\\Admin', 3),
(4, 'App\\Models\\Admin', 4);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `price` double NOT NULL,
  `term` varchar(255) NOT NULL,
  `number_of_car_add` int(25) NOT NULL,
  `number_of_car_featured` int(25) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `header_title` varchar(255) DEFAULT NULL,
  `header_subtitle` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `type` varchar(155) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `details`, `header_title`, `header_subtitle`, `image`, `video`, `type`) VALUES
(22, 'WOW', 'wow', '<p><span style=\"font-family:\'Comic Sans MS\';\">﻿</span><span style=\"font-family:Tahoma;\">﻿</span><span style=\"font-size:24px;\"><span style=\"font-weight:bolder;\">About Birr Free Market:</span></span></p>\r\n\r\n<p><span style=\"font-size:24px;\"><span style=\"font-weight:bolder;\"><br></span></span></p>\r\n\r\n<p><span style=\"font-size:24px;\">Welcome to Birr Free Market, the innovative app that revolutionizes currency exchange and remittance services, focusing on the Ethiopian currency, Birr. We are a peer-to-peer platform designed to address the pressing need for free and decentralized currency exchange in Ethiopia.</span></p>\r\n\r\n<p><span style=\"font-size:24px;\"><br></span></p>\r\n\r\n<p><span style=\"font-size:24px;\"><span style=\"font-weight:bolder;\">The Need for Birr Free Market:</span></span></p>\r\n\r\n<p><span style=\"font-size:24px;\"><span style=\"font-weight:bolder;\"><br></span></span></p>\r\n\r\n<p><span style=\"font-size:24px;\">Birr Free Market was born out of popular demand and a real necessity to break free from the limitations imposed by the Ethiopian government\'s monopoly and stranglehold on the economy and financial system. Many Ethiopians face challenges when it comes to accessing foreign currency, hindering their ability to engage in international transactions and financial activities.</span></p>\r\n\r\n<p><span style=\"font-size:24px;\"><br></span></p>\r\n\r\n<p><span style=\"font-size:24px;\"><span style=\"font-weight:bolder;\">Our Mission:</span></span></p>\r\n\r\n<p><span style=\"font-size:24px;\"><span style=\"font-weight:bolder;\"><br></span></span></p>\r\n\r\n<p><span style=\"font-size:24px;\">At Birr Free Market, we are driven by a mission to empower individuals with the freedom to exchange currencies without barriers. By providing a secure and decentralized platform for currency exchange and remittance services, we aim to bridge the gap and enable seamless transactions that were once hindered by restrictive regulations.</span></p>\r\n\r\n<p><span style=\"font-size:24px;\"><br></span></p>\r\n\r\n<p><span style=\"font-size:24px;\"><span style=\"font-weight:bolder;\">How We Operate:</span></span></p>\r\n\r\n<p><span style=\"font-size:24px;\"><span style=\"font-weight:bolder;\"><br></span></span></p>\r\n\r\n<p><span style=\"font-size:24px;\">Our platform functions as a peer-to-peer marketplace, connecting users who wish to exchange foreign currencies. By facilitating direct transactions between users, we eliminate the need for intermediaries, ensuring more competitive exchange rates and cost-effective remittance services. Through this approach, we foster a community of individuals who can transact freely and conveniently, regardless of geographical boundaries.</span></p>\r\n\r\n<p><span style=\"font-size:24px;\"><br></span></p>\r\n\r\n<p><span style=\"font-size:24px;\"><span style=\"font-weight:bolder;\">Safety and Legitimacy:</span></span></p>\r\n\r\n<p><span style=\"font-size:24px;\"><span style=\"font-weight:bolder;\"><br></span></span></p>\r\n\r\n<p><span style=\"font-size:24px;\">Birr Free Market operates as a fully legal and safe currency exchange and remittance service. We comply with all relevant regulations and adhere to industry best practices to protect our users\' interests and maintain the utmost security of their transactions and personal information.</span></p>\r\n\r\n<p><span style=\"font-size:24px;\"><br></span></p>\r\n\r\n<p><span style=\"font-size:24px;\"><span style=\"font-weight:bolder;\">Supporting Financial Inclusion:</span></span></p>\r\n\r\n<p><span style=\"font-size:24px;\"><span style=\"font-weight:bolder;\"><br></span></span></p>\r\n\r\n<p><span style=\"font-size:24px;\">We believe in the power of financial inclusion to uplift communities and create opportunities for prosperity. Birr Free Market opens up new possibilities for those who were previously excluded from the formal financial system, empowering them with the tools to participate in global trade and investments.</span></p>\r\n\r\n<p><span style=\"font-size:24px;\"><br></span></p>\r\n\r\n<p><span style=\"font-size:24px;\">Sustainability:</span></p>\r\n\r\n<p><span style=\"font-size:24px;\"><br></span></p>\r\n\r\n<p><span style=\"font-size:24px;\">To sustain the platform and continuously improve our services, we charge a small transaction fee for every exchange conducted on Birr Free Market. These fees are reinvested back into the platform to enhance security, efficiency, and user experience, ensuring a seamless and reliable currency exchange ecosystem.</span></p>\r\n\r\n<p><span style=\"font-size:24px;\"><br></span></p>\r\n\r\n<p><span style=\"font-size:24px;\"><span style=\"font-weight:bolder;\">Join Birr Free Market:</span></span></p>\r\n\r\n<p><span style=\"font-size:24px;\"><span style=\"font-weight:bolder;\"><br></span></span></p>\r\n\r\n<p><span style=\"font-size:24px;\">Whether you are an individual in need of foreign currency for personal use or a business seeking an efficient and decentralized way to handle international transactions, Birr Free Market welcomes you. Embrace the freedom of currency exchange and remittance by joining our community today and be a part of a more inclusive financial future for Ethiopia.</span></p>', NULL, NULL, NULL, NULL, 'true'),
(24, 'Pro', 'pro', '<p>asdfsdgsfdgsdfg</p>', NULL, NULL, NULL, NULL, 'true');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateways`
--

CREATE TABLE `payment_gateways` (
  `id` int(11) NOT NULL,
  `subtitle` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fixed_charge` decimal(20,10) DEFAULT NULL,
  `percent_charge` decimal(5,2) DEFAULT NULL,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('manual','automatic') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'manual',
  `information` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keyword` varchar(191) DEFAULT NULL,
  `currency_id` varchar(191) NOT NULL DEFAULT '0',
  `checkout` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 1,
  `subscription` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payment_gateways`
--

INSERT INTO `payment_gateways` (`id`, `subtitle`, `title`, `fixed_charge`, `percent_charge`, `details`, `name`, `type`, `information`, `keyword`, `currency_id`, `checkout`, `status`, `subscription`) VALUES
(9, NULL, NULL, NULL, NULL, NULL, 'Razorpay', 'automatic', '{\"key\":\"rzp_test_xDH74d48cwl8DF\",\"secret\":\"cr0H1BiQ20hVzhpHfHuNbGri\",\"text\":\"Pay via your Razorpay account.\"}', 'razorpay', '[\"10\"]', 1, 1, 1),
(14, NULL, NULL, NULL, NULL, NULL, 'Stripe', 'automatic', '{\"key\":\"pk_test_UnU1Coi1p5qFGwtpjZMRMgJM\",\"secret\":\"sk_test_QQcg3vGsKRPlW6T3dXcNJsor\",\"text\":\"Pay via your Credit Card.\"}', 'stripe', '[\"1\",\"4\"]', 1, 1, 1),
(15, NULL, NULL, NULL, NULL, '', 'Paypal', 'automatic', '{\"client_id\":\"AcWYnysKa_elsQIAnlfsJXokR64Z31CeCbpis9G3msDC-BvgcbAwbacfDfEGSP-9Dp9fZaGgD05pX5Qi\",\"client_secret\":\"EGZXTq6d6vBPq8kysVx8WQA5NpavMpDzOLVOb9u75UfsJ-cFzn6aeBXIMyJW2lN1UZtJg5iDPNL9ocYE\",\"sandbox_check\":0,\"text\":\"Pay via your PayPal account.\"}', 'paypal', '[\"1\",\"4\"]', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(180, 'manage vendor', 'admin', '2024-04-03 08:05:34', '2024-04-03 08:05:34'),
(181, 'edit vendor', 'admin', '2024-04-03 08:05:34', '2024-04-03 08:05:34'),
(182, 'update vendor', 'admin', '2024-04-03 08:10:02', '2024-04-03 08:10:02'),
(183, 'vendor balance modify', 'admin', '2024-04-03 08:15:22', '2024-04-03 08:15:22'),
(184, 'vendor login logs', 'admin', '2024-04-03 08:20:28', '2024-04-03 08:20:28'),
(185, 'about us', 'admin', '2024-04-03 08:20:28', '2024-04-03 08:20:28'),
(190, 'manage user', 'admin', '2024-04-02 05:54:18', '2024-04-02 05:54:18'),
(191, 'edit user', 'admin', '2024-04-02 05:58:11', '2024-04-02 05:58:11'),
(192, 'update user', 'admin', '2024-04-02 05:58:11', '2024-04-02 05:58:11'),
(193, 'user balance modify', 'admin', '2024-04-02 05:59:31', '2024-04-02 05:59:31'),
(194, 'user login logs', 'admin', '2024-04-02 05:59:31', '2024-04-02 05:59:31'),
(195, 'manage package', 'admin', '2024-03-25 08:23:00', '2024-03-25 08:23:00'),
(196, 'manage userpackage', 'admin', '2024-03-25 08:23:32', '2024-03-25 08:23:32'),
(197, 'homepage', 'admin', '2024-03-25 08:23:32', '2024-03-25 08:23:32'),
(200, 'manage car', 'admin', '2024-03-23 06:39:36', '2024-03-23 06:39:36'),
(201, 'edit car', 'admin', '2024-03-23 06:39:36', '2024-03-23 06:39:36'),
(202, 'update car', 'admin', '2024-03-23 06:40:51', '2024-03-23 06:40:51'),
(203, 'delete car', 'admin', '2024-03-23 06:40:51', '2024-03-23 06:40:51'),
(204, 'featured car', 'admin', '2024-03-23 06:42:28', '2024-03-23 06:42:28'),
(205, 'pending car', 'admin', '2024-03-23 06:42:28', '2024-03-23 06:42:28'),
(206, 'publish car', 'admin', '2024-03-23 06:43:55', '2024-03-23 06:43:55'),
(207, 'rejected car', 'admin', '2024-03-23 06:43:55', '2024-03-23 06:43:55'),
(209, 'dashboard info', 'admin', '2022-02-16 23:31:25', '2022-02-16 23:31:25'),
(210, 'add car', 'admin', '2024-03-18 07:32:46', NULL),
(211, 'transactions', 'admin', '2022-02-16 23:31:25', '2022-02-16 23:31:25'),
(212, 'manage category', 'admin', '2022-02-16 23:31:25', '2022-02-16 23:31:25'),
(213, 'manage brand', 'admin', '2022-02-16 23:31:25', '2022-02-16 23:31:25'),
(214, 'manage condition', 'admin', '2022-02-16 23:31:25', '2022-02-16 23:31:25'),
(215, 'manage model', 'admin', '2022-02-16 23:31:25', '2022-02-16 23:31:25'),
(216, 'manage fuel type', 'admin', '2022-02-16 23:31:25', '2022-02-16 23:31:25'),
(217, 'manage transmission', 'admin', '2022-02-16 23:31:25', '2022-02-16 23:31:25'),
(224, 'manage currency', 'admin', '2022-02-16 23:31:25', '2022-02-16 23:31:25'),
(225, 'add currency', 'admin', '2022-02-16 23:31:25', '2022-02-16 23:31:25'),
(226, 'edit currency', 'admin', '2022-02-16 23:31:25', '2022-02-16 23:31:25'),
(227, 'update currency', 'admin', '2022-02-16 23:31:25', '2022-02-16 23:31:25'),
(228, 'delete currency', 'admin', '2022-02-16 23:31:25', '2022-02-16 23:31:25'),
(232, 'manage country', 'admin', '2022-02-16 23:31:25', '2022-02-16 23:31:25'),
(233, 'add country', 'admin', '2022-02-16 23:31:25', '2022-02-16 23:31:25'),
(234, 'update country', 'admin', '2022-02-16 23:31:25', '2022-02-16 23:31:25'),
(254, 'manage role', 'admin', '2022-02-16 23:31:25', '2022-02-16 23:31:25'),
(255, 'create role', 'admin', '2022-02-16 23:31:25', '2022-02-16 23:31:25'),
(256, 'edit permissions', 'admin', '2022-02-16 23:31:25', '2022-02-16 23:31:25'),
(257, 'update permissions', 'admin', '2022-02-16 23:31:25', '2022-02-16 23:31:25'),
(258, 'manage staff', 'admin', '2022-02-16 23:31:25', '2022-02-16 23:31:25'),
(259, 'add staff', 'admin', '2022-02-16 23:31:25', '2022-02-16 23:31:25'),
(260, 'update staff', 'admin', '2022-02-16 23:31:25', '2022-02-16 23:31:25'),
(261, 'general setting', 'admin', '2022-02-16 23:31:25', '2022-02-16 23:31:25'),
(262, 'general settings update', 'admin', '2022-02-16 23:31:25', '2022-02-16 23:31:25'),
(263, 'general settings logo favicon', 'admin', '2022-02-16 23:31:25', '2022-02-16 23:31:25'),
(264, 'general settings status update', 'admin', '2022-02-16 23:31:25', '2022-02-16 23:31:25'),
(265, 'menu builder', 'admin', '2022-02-16 23:31:25', '2022-02-16 23:31:25'),
(266, 'maintainance', 'admin', '2022-02-16 23:31:25', '2022-02-16 23:31:25'),
(267, 'email templates', 'admin', '2022-02-16 23:31:25', '2022-02-16 23:31:25'),
(268, 'template edit', 'admin', '2022-02-16 23:31:25', '2022-02-16 23:31:25'),
(269, 'template update', 'admin', '2022-02-16 23:31:25', '2022-02-16 23:31:25'),
(270, 'email config', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(271, 'group email', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(272, 'general settings breadcumb banner', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(278, 'site contents', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(279, 'edit site contents', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(280, 'site content update', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(281, 'site sub-content update', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(282, 'section status update', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(283, 'withdraw method', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(284, 'withdraw method search', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(285, 'withdraw method create', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(286, 'withdraw method edit', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(287, 'withdraw method update', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(288, 'pending withdraw', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(289, 'accepted withdraw', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(290, 'rejected withdraw', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(291, 'withdraw accept', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(292, 'withdraw reject', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(293, 'manage payment gateway', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(294, 'add payment gateway', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(295, 'store payment gateway', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(296, 'edit payment gateway', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(297, 'update payment gateway', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(298, 'manage deposit', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(299, 'approve deposit', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(300, 'reject deposit', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(301, 'manage page', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(302, 'page create', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(303, 'page store', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(304, 'page edit', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(305, 'page update', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(306, 'page remove', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(307, 'manage cookie', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(308, 'update cookie', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(309, 'manage blog-category', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(310, 'store blog-category', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(311, 'update blog-category', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(312, 'manage blog', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(313, 'blog create', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(314, 'blog store', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(315, 'blog edit', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(316, 'blog update', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(317, 'blog destroy', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(318, 'manage language', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(319, 'manage ticket', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(320, 'reply ticket', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(321, 'seo settings', 'admin', '2022-02-16 23:31:26', '2022-02-16 23:31:26'),
(322, 'manage kyc', 'admin', '2022-04-04 00:17:20', '2022-04-04 00:17:20'),
(323, 'manage kyc form', 'admin', '2022-04-04 00:17:20', '2022-04-04 00:17:20'),
(324, 'kyc form add', 'admin', '2022-04-04 00:17:20', '2022-04-04 00:17:20'),
(325, 'kyc form update', 'admin', '2022-04-04 00:17:20', '2022-04-04 00:17:20'),
(326, 'kyc form delete', 'admin', '2022-04-04 00:17:20', '2022-04-04 00:17:20'),
(327, 'kyc info', 'admin', '2022-04-04 00:17:20', '2022-04-04 00:17:20'),
(328, 'kyc details', 'admin', '2022-04-04 00:17:20', '2022-04-04 00:17:20'),
(329, 'kyc approve', 'admin', '2022-04-04 00:17:20', '2022-04-04 00:17:20'),
(330, 'kyc reject', 'admin', '2022-04-04 00:17:20', '2022-04-04 00:17:20'),
(331, 'manage offer', 'admin', '2022-04-04 23:35:45', '2022-04-04 23:35:45'),
(332, 'offer status change', 'admin', '2022-04-04 23:35:45', '2022-04-04 23:35:45'),
(333, 'offer limit', 'admin', '2022-04-04 23:35:45', '2022-04-04 23:35:45'),
(334, 'offer limit add', 'admin', '2022-04-04 23:35:45', '2022-04-04 23:35:45'),
(335, 'offer limit update', 'admin', '2022-04-04 23:35:45', '2022-04-04 23:35:45'),
(336, 'offer limit remove', 'admin', '2022-04-04 23:35:45', '2022-04-04 23:35:45'),
(337, 'subscriber', 'admin', '2022-04-04 23:35:45', '2022-04-04 23:35:45'),
(338, 'header section', 'admin', '2022-04-04 23:35:45', '2022-04-04 23:35:45'),
(339, 'subscriber remove', 'admin', '2022-04-04 23:35:45', '2022-04-04 23:35:45'),
(340, 'manage trades', 'admin', '2022-04-04 23:35:45', '2022-04-04 23:35:45'),
(341, 'api settings', 'admin', '2022-04-04 23:35:45', '2022-04-04 23:35:45'),
(342, 'charge settings', 'admin', '2022-04-04 23:35:45', '2022-04-04 23:35:45');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', '2022-01-17 04:25:50', '2022-01-17 04:25:50'),
(3, 'moderator', 'admin', '2022-01-17 05:23:47', '2022-01-17 05:23:47'),
(4, 'Ticket Handler', 'admin', '2022-02-16 23:55:38', '2022-02-16 23:55:38');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(180, 1),
(181, 1),
(182, 1),
(183, 1),
(184, 1),
(185, 1),
(190, 1),
(191, 1),
(192, 1),
(193, 1),
(194, 1),
(195, 1),
(196, 1),
(197, 1),
(200, 1),
(201, 1),
(202, 1),
(203, 1),
(204, 1),
(205, 1),
(206, 1),
(207, 1),
(209, 1),
(210, 1),
(211, 1),
(212, 1),
(213, 1),
(214, 1),
(215, 1),
(216, 1),
(217, 1),
(224, 1),
(225, 1),
(226, 1),
(227, 1),
(228, 1),
(232, 1),
(233, 1),
(234, 1),
(254, 1),
(255, 1),
(256, 1),
(257, 1),
(258, 1),
(259, 1),
(260, 1),
(261, 1),
(262, 1),
(263, 1),
(264, 1),
(265, 1),
(266, 1),
(267, 1),
(268, 1),
(269, 1),
(270, 1),
(271, 1),
(272, 1),
(278, 1),
(279, 1),
(280, 1),
(281, 1),
(282, 1),
(283, 1),
(284, 1),
(285, 1),
(286, 1),
(287, 1),
(288, 1),
(289, 1),
(290, 1),
(291, 1),
(292, 1),
(293, 1),
(294, 1),
(295, 1),
(296, 1),
(297, 1),
(298, 1),
(299, 1),
(300, 1),
(301, 1),
(302, 1),
(303, 1),
(304, 1),
(305, 1),
(306, 1),
(307, 1),
(308, 1),
(309, 1),
(310, 1),
(311, 1),
(312, 1),
(313, 1),
(314, 1),
(315, 1),
(316, 1),
(317, 1),
(318, 1),
(319, 1),
(319, 4),
(320, 1),
(320, 4),
(321, 1),
(322, 1),
(323, 1),
(324, 1),
(325, 1),
(326, 1),
(327, 1),
(328, 1),
(329, 1),
(330, 1),
(331, 1),
(332, 1),
(333, 1),
(334, 1),
(335, 1),
(336, 1),
(337, 1),
(338, 1),
(339, 1),
(340, 1),
(341, 1),
(342, 1);

-- --------------------------------------------------------

--
-- Table structure for table `seo_settings`
--

CREATE TABLE `seo_settings` (
  `id` bigint(20) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `meta_tag` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seo_settings`
--

INSERT INTO `seo_settings` (`id`, `title`, `meta_tag`, `meta_description`, `meta_image`) VALUES
(1, 'Exchange Genius', 'exchange,crypto', 'Exchange crypto currency', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `site_contents`
--

CREATE TABLE `site_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `sub_content` longtext DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_contents`
--

INSERT INTO `site_contents` (`id`, `name`, `slug`, `content`, `sub_content`, `status`, `created_at`, `updated_at`) VALUES
(1, 'hero', 'hero', '{\"title\":\"Uncover Top-notch Cars in\",\"color_title\":\"Our Collection\",\"sub_heading\":\"Explore automotive luxury as you uncover top-notch cars in our collection \\u2013 a fusion of unparalleled performance and style. From sleek sedans to powerful SUVs, find the perfect driving experience.\",\"background\":\"18938297581713330562.png\",\"image\":\"11575022951713330562.png\",\"background_size\":\"1920px x 699px\",\"image_size\":\"395x395\"}', '', 1, NULL, '2024-04-16 23:09:22'),
(2, 'FAQs', 'faq', '{\"title\":\"FAQ\'s\",\"heading\":\"Frequently Asked Questions....\",\"sub_heading\":\"Deserunt hic consequatur ex placeat! atque repellendus inventore quisquam, perferendis, eum reiciendis quia nesciunt fuga magni.\"}', '[{\"question\":\"Where are you from?\",\"answer\":\"Comilla\"},{\"question\":\"Dhaka\",\"answer\":\"Dhaka\"}]', 1, '2024-04-27 10:00:02', '2024-06-08 00:05:52'),
(3, 'vendor', 'vendor', '{\"heading\":\"Exploring the option to be a vendor with Carlist?\",\"description\":\"With an unwavering passion for cars, we\'ve crafted more than just a platform \\u2013 it\'s an immersive, thrilling adventure. Our commitment is to deliver a unique experience, where the fervor for automobiles meets your love for driving. Join us on this exhilarating road.\",\"image_size\":\"960x800\",\"image\":\"6723784581713345736.png\"}', NULL, 1, NULL, '2024-04-22 02:24:59'),
(4, 'about', 'about', '{\"heading\":\"Our About Us Story: Passionate Auto Experience\",\"sub_heading\":\"With an unwavering passion for cars, we\'ve crafted more than just a platform \\u2013 it\'s an immersive, thrilling adventure. Our commitment is to deliver a unique experience, where the fervor for automobiles meets your love for driving. Join us on this exhilarating road.\",\"image\":\"3890334631713344639.png\"}', '[{\"image\":\"3233713681713343146.png\",\"image_size\":\"270x254\",\"title\":\"Vehicles Available\",\"number\":\"5000\"},{\"image\":\"14605677801713343450.png\",\"image_size\":\"270x254\",\"title\":\"Happy Customer\",\"number\":\"90000\"},{\"image\":\"17505537301713343566.png\",\"image_size\":\"270x254\",\"title\":\"Awards Gains\",\"number\":\"65\"},{\"image\":\"2321120911713343587.png\",\"image_size\":\"270x254\",\"title\":\"Happy Dealers\",\"number\":\"90\"}]', 1, NULL, '2024-06-08 00:07:21'),
(6, 'Testimonial', 'testimonial', '{\"title\":\"Auction Success Stories\",\"heading\":\"What Clients Say About Us\",\"sub_heading\":\"Delve into the firsthand experiences of our users. From thrilling wins to exceptional service, our testimonials reveal the heart of our auction community.\"}', '[{\"image\":\"14001049501713347340.png\",\"image_size\":\"120x120\",\"name\":\"Sophia Lawson\",\"quote\":\"Carlist made my car-buying experience a breeze! The website is user-friendly, and the extensive collection of cars helped me find the perfect one. Kudos to the team for their excellent service and support!\",\"designation\":\"Automotive Journalist\",\"title\":\"Seamless Car Shopping Experience\",\"star\":\"5\"},{\"image_size\":\"120x120\",\"name\":\"Daniel Rodriguez\",\"quote\":\"Carlist is the ultimate one-stop-shop for car enthusiasts. The blog keeps me informed, the news section is up-to-date, and the testimonials instill confidence. A fantastic resource for anyone navigating the car market.\",\"designation\":\"Automotive Journalist\",\"title\":\"The Ultimate Car Enthusiast\'s Hub\",\"star\":\"5\",\"image\":\"7765375691713347412.png\"},{\"image\":\"13470928091713347522.png\",\"image_size\":\"120x120\",\"name\":\"Lisa Morgan\",\"quote\":\"I recently sold my car on Carlist, and the process was seamless. The listing options are comprehensive, and the responsive customer support made it easy to address any queries. Highly recommend for both buyers and sellers.\",\"designation\":\"Automotive Blogger\",\"title\":\"Visually Appealing & Trustworthy Platform\",\"star\":\"5\"}]', 1, NULL, '2024-06-08 00:05:13'),
(11, 'Social Links', 'social', NULL, '[{\"icon\":\"fab fa-facebook-f\",\"url\":\"https:\\/\\/facebook.com\"},{\"icon\":\"fab fa-twitter\",\"url\":\"https:\\/\\/twiiter.com\"},{\"icon\":\"fab fa-instagram\",\"url\":\"https:\\/\\/instagram.com\"},{\"icon\":\"fab fa-linkedin-in\",\"url\":\"https:\\/\\/linkedin.com\"},{\"icon\":\"fab fa-youtube\",\"url\":\"https:\\/\\/youtube.com\"}]', 9, NULL, '2022-02-13 02:49:01'),
(13, 'Contact Us', 'contact', '{\"title\":\"Contact Us\",\"heading\":\"Get In Touch\",\"sub_heading\":\"Porro illum impedit nemo hic, similique at, qui ducimus praesentium ullam voluptatem culpa temporibus eveniet, esse accusamus\",\"phone\":\"[\\\"+1 (631) 593-5927\\\",\\\"+1 (631) 593-59278\\\"]\",\"email\":\"[\\\"geniusocean@gmail.com\\\",\\\"geniousocean@gmail.com\\\"]\",\"address\":\"7058 Najrul Islam Road, Dhaka.\",\"map_link\":\"https:\\/\\/www.google.com\\/maps\\/embed?pb=!1m18!1m12!1m3!1d3648.4589123362307!2d90.39145547503162!3d23.873340378586732!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c1c1b79fa481%3A0x59dde35061261ea6!2sGeniusOcean!5e0!3m2!1sen!2sbd!4v1717836206139!5m2!1sen!2sbd\"}', NULL, 9, NULL, '2024-06-08 02:47:22'),
(18, 'Login Page', 'login', '{\"title\":\"Create a New Account\",\"image\":\"15372819791706419401.png\"}', NULL, 1, NULL, '2024-01-27 23:23:22'),
(19, 'Register Page', 'register', '{\"title\":\"Please Register Here\",\"image\":\"21455123681706423544.png\"}', NULL, 1, NULL, '2024-01-28 00:32:25'),
(20, 'Counter', 'counter', NULL, '[{\"image\":\"2220961661705488818.png\",\"image_size\":\"270x254\",\"title\":\"Total Product in our website for auction\",\"counter\":\"5000\"},{\"image\":\"14603207571705488866.png\",\"image_size\":\"270x254\",\"title\":\"Total happy customer take our service\",\"counter\":\"65000\"},{\"image\":\"5331011641705488894.png\",\"image_size\":\"270x254\",\"title\":\"Winner Customer those win the bid\",\"counter\":\"5500\"}]', 1, NULL, '2024-01-17 04:54:54'),
(21, 'categories', 'categories', '{\"title\":\"Explore Popular\",\"color_title\":\"Brand Categories\",\"sub_heading\":\"Explore automotive luxury as you uncover top-notch cars in our collection \\u2013 a fusion of unparalleled performance and style. From sleek sedans to powerful SUVs, find the.\"}', '', 1, NULL, '2024-04-17 00:02:37'),
(22, 'blog', 'blog', '{\"title\":\"Carlist Buzz:\",\"heading\":\"Latest Blogs & News\",\"sub_heading\":\"Explore automotive luxury as you uncover top-notch cars in our collection \\u2013 a fusion of unparalleled performance and style. From sleek sedans to powerful SUVs, find the.\"}', '', 1, NULL, '2024-04-17 00:28:18'),
(23, 'Partner', 'partner', '{\"title\":\"All partner\",\"heading\":\"What Clients Say About Us\",\"sub_heading\":\"Delve into the firsthand experiences of our users. From thrilling wins to exceptional service, our testimonials reveal the heart of our auction community.\"}', '[{\"image\":\"13295238961717826663.png\",\"image_size\":\"120x120\"}]', 1, NULL, '2024-06-08 00:22:21');

-- --------------------------------------------------------

--
-- Table structure for table `sms_gateways`
--

CREATE TABLE `sms_gateways` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `config` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_gateways`
--

INSERT INTO `sms_gateways` (`id`, `name`, `config`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Twilio', '{\r\n\"sid\":\"\",\"token\":\"\",\"from_number\":\"\"\r\n}', 0, NULL, '2022-01-19 23:56:26'),
(2, 'Nexmo', '{\"api_key\":\"f0842415\",\"api_secret\":\"5FqSGPgFIKbf8nDr\"}', 1, NULL, '2022-01-20 02:22:11');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `created_at`, `updated_at`) VALUES
(1, 'pronob@gmail.com', NULL, NULL),
(2, 'user@gmail.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

CREATE TABLE `support_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `guest_email` varchar(255) DEFAULT NULL,
  `guest_name` varchar(255) DEFAULT NULL,
  `ticket_num` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = pending, 1 = replied. ',
  `priority` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `support_tickets`
--

INSERT INTO `support_tickets` (`id`, `user_id`, `guest_email`, `guest_name`, `ticket_num`, `subject`, `status`, `priority`, `created_at`, `updated_at`) VALUES
(1, 16, NULL, NULL, 'TKT73738799', 'test new', 1, NULL, '2023-11-19 02:48:54', '2023-11-19 02:52:49'),
(2, 17, NULL, NULL, 'TKT95335577', 'New test', 0, NULL, '2023-12-31 00:04:42', '2023-12-31 00:04:42'),
(3, 17, NULL, NULL, 'TKT44145925', 'wow', 0, 'High', '2024-03-02 04:58:38', '2024-03-02 04:58:38'),
(4, 17, NULL, NULL, 'TKT53206954', 'subject', 0, 'Medium', '2024-03-02 05:03:37', '2024-03-02 05:03:37'),
(5, 17, NULL, NULL, 'TKT94404277', 'arekta', 0, 'Low', '2024-03-02 05:04:37', '2024-03-02 05:19:51');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_messages`
--

CREATE TABLE `ticket_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `ticket_num` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_messages`
--

INSERT INTO `ticket_messages` (`id`, `ticket_id`, `ticket_num`, `user_id`, `admin_id`, `message`, `file`, `created_at`, `updated_at`) VALUES
(1, 1, 'TKT85099556', 13, NULL, 'asldnalskdasjdlaksjd', NULL, '2022-02-02 04:09:34', '2022-02-02 04:09:34'),
(2, 1, 'TKT85099556', 13, 1, 'Hello there', NULL, '2022-02-02 04:09:34', '2022-02-02 04:09:34'),
(3, 1, 'TKT85099556', 13, NULL, 'i need money', NULL, '2022-02-02 04:26:45', '2022-02-02 04:26:45'),
(4, 2, 'TKT22679763', 13, NULL, 'Hello', NULL, '2022-02-02 04:37:53', '2022-02-02 04:37:53'),
(5, 1, 'TKT85099556', 13, NULL, 'asdasdasd', NULL, '2022-02-02 04:38:05', '2022-02-02 04:38:05'),
(6, 1, 'TKT85099556', 13, NULL, 'asdasdasd', NULL, '2022-02-02 04:38:08', '2022-02-02 04:38:08'),
(7, 1, 'TKT85099556', 13, NULL, 'asdasd', NULL, '2022-02-02 04:38:12', '2022-02-02 04:38:12'),
(8, 1, 'TKT85099556', 13, NULL, 'asdasdasdasd', '13598470421643801342.jpg', '2022-02-02 05:29:02', '2022-02-02 05:29:02'),
(9, 1, 'TKT85099556', 13, NULL, 'pdf', '17062225081643801885.pdf', '2022-02-02 05:38:05', '2022-02-02 05:38:05'),
(10, 3, 'TKT10770742', 1, NULL, 'Hello admin', NULL, '2022-02-02 21:30:17', '2022-02-02 21:30:17'),
(11, 3, 'TKT10770742', 1, NULL, 'hello', NULL, '2022-02-02 21:59:16', '2022-02-02 21:59:16'),
(12, 3, 'TKT10770742', 1, 1, 'hello', NULL, '2022-02-02 21:59:51', '2022-02-02 21:59:51'),
(13, 3, 'TKT10770742', 1, 1, 'Follow the pic', '15459167691643860837.png', '2022-02-02 22:00:37', '2022-02-02 22:00:37'),
(14, 5, 'TKT94219745', 1, NULL, 'hello', NULL, '2022-02-02 22:42:45', '2022-02-02 22:42:45'),
(15, 4, 'TKT71381999', 1, NULL, 'Hello', NULL, '2022-02-02 22:42:50', '2022-02-02 22:42:50'),
(16, 6, 'TKT43483176', 1, NULL, 'VBBBB', NULL, '2022-02-02 22:43:09', '2022-02-02 22:43:09'),
(17, 6, 'TKT43483176', 1, NULL, 'AAEASFASf', NULL, '2022-02-02 22:43:18', '2022-02-02 22:43:18'),
(18, 8, 'TKT10211164', 1, NULL, 'asdasd', NULL, '2022-02-02 22:43:36', '2022-02-02 22:43:36'),
(19, 8, 'TKT10211164', 1, NULL, 'cvbcvbcv', NULL, '2022-02-02 22:43:47', '2022-02-02 22:43:47'),
(20, 9, 'TKT62302556', 1, NULL, 'asdasdas', NULL, '2022-02-02 22:43:52', '2022-02-02 22:43:52'),
(21, 9, 'TKT62302556', 1, 1, 'assssssssssssssssssssssssssssssssssssss', NULL, '2022-02-02 22:47:16', '2022-02-02 22:47:16'),
(22, 10, 'TKT56470457', 1, NULL, 'asdasdasd', NULL, '2022-02-03 00:09:49', '2022-02-03 00:09:49'),
(23, 10, 'TKT56470457', 1, 1, 'asdasda', NULL, '2022-02-03 00:10:03', '2022-02-03 00:10:03'),
(24, 1, 'TKT85099556', 13, 1, 'ccc', '16638297981644308176.png', '2022-02-08 02:16:16', '2022-02-08 02:16:16'),
(25, 1, 'TKT85099556', 13, 1, 'asdasdasd', '20045371241644308378.png', '2022-02-08 02:19:38', '2022-02-08 02:19:38'),
(26, 2, 'TKT22679763', 13, 1, 'adsda', NULL, '2022-02-08 02:22:47', '2022-02-08 02:22:47'),
(27, 10, 'TKT56470457', 1, 1, 'dafjdflkadjfn asdlkfjadslf dsfja sdlkf jsdf asf sdf ads fad fasdmfsd mfasdfsdfs', '17878388621645087206.png', '2022-02-17 02:40:06', '2022-02-17 02:40:06'),
(28, 10, 'TKT56470457', 1, 1, 'aaaa', NULL, '2022-02-22 03:50:08', '2022-02-22 03:50:08'),
(29, 10, 'TKT56470457', 1, NULL, 'sdasd', NULL, '2022-03-07 23:22:31', '2022-03-07 23:22:31'),
(30, 10, 'TKT56470457', 1, NULL, 'sss', '12588003741646716966.jpg', '2022-03-07 23:22:46', '2022-03-07 23:22:46'),
(31, 6, 'TKT43483176', 1, 1, 'gggggg', NULL, '2022-03-08 22:57:58', '2022-03-08 22:57:58'),
(32, 8, 'TKT10211164', 1, 1, '', '20167496141647167039.jpg', '2022-03-13 04:23:59', '2022-03-13 04:23:59'),
(33, 8, 'TKT10211164', 1, 1, NULL, '10683441291647167109.jpg', '2022-03-13 04:25:09', '2022-03-13 04:25:09'),
(34, 8, 'TKT10211164', 1, 1, NULL, '6066440281647167201.jpg', '2022-03-13 04:26:41', '2022-03-13 04:26:41'),
(35, 8, 'TKT10211164', 1, NULL, NULL, NULL, '2022-03-13 04:33:32', '2022-03-13 04:33:32'),
(36, 6, 'TKT43483176', 1, 1, 'Aasjhdgasjd', NULL, '2022-03-22 03:34:58', '2022-03-22 03:34:58'),
(37, 12, 'TKT11111598', 11, NULL, 'asdasdas', NULL, '2022-03-23 04:27:42', '2022-03-23 04:27:42'),
(38, 5, 'TKT94219745', 1, 1, 'ssss', NULL, '2022-04-05 03:53:45', '2022-04-05 03:53:45'),
(39, 1, 'TKT73738799', 16, NULL, 'Hello', NULL, '2023-11-19 02:49:10', '2023-11-19 02:49:10'),
(40, 1, 'TKT73738799', 16, 1, 'This is Test', NULL, '2023-11-19 02:52:49', '2023-11-19 02:52:49'),
(41, 2, 'TKT95335577', 17, NULL, 'This is test support message', '5090827391704002682.jfif', '2023-12-31 00:04:42', '2023-12-31 00:04:42'),
(42, 2, 'TKT95335577', 17, NULL, 'my site is not working', '4686080051704003510.jpg', '2023-12-31 00:18:30', '2023-12-31 00:18:30'),
(43, 2, 'TKT95335577', 17, NULL, 'my site is not working', '17023099831704003575.jpg', '2023-12-31 00:19:35', '2023-12-31 00:19:35'),
(44, 2, 'TKT95335577', 17, NULL, 'my site is not working', '16937695801704003604.jpg', '2023-12-31 00:20:04', '2023-12-31 00:20:04'),
(45, 1, 'TKT73738799', 16, 1, 'ok', NULL, '2024-01-27 00:36:59', '2024-01-27 00:36:59'),
(46, 3, 'TKT44145925', 17, NULL, 'wow message', '8030126791709377118.png', '2024-03-02 04:58:38', '2024-03-02 04:58:38'),
(47, 4, 'TKT53206954', 17, NULL, 'asdfasf', '20402050601709377417.png', '2024-03-02 05:03:37', '2024-03-02 05:03:37'),
(48, 5, 'TKT94404277', 17, NULL, 'asdfasf', '17549907421709377477.png', '2024-03-02 05:04:37', '2024-03-02 05:04:37'),
(49, 5, 'TKT94404277', 17, NULL, 'arekta onek sundor', '317898101709377760.png', '2024-03-02 05:09:20', '2024-03-02 05:09:20'),
(50, 5, 'TKT94404277', 17, NULL, 'kaj kore', '16296665511709377907.png', '2024-03-02 05:11:47', '2024-03-02 05:11:47'),
(51, 5, 'TKT94404277', 17, NULL, 'thiks ase', '18097121661709378048.png', '2024-03-02 05:14:08', '2024-03-02 05:14:08'),
(52, 5, 'TKT94404277', 17, NULL, 'thiks ase dsafasfd', '642632151709378160.png', '2024-03-02 05:16:01', '2024-03-02 05:16:01'),
(53, 5, 'TKT94404277', 17, NULL, 'thiks ase dsafasfd sdfasf', '6937214111709378169.png', '2024-03-02 05:16:09', '2024-03-02 05:16:09'),
(54, 5, 'TKT94404277', 17, 1, 'askdhfkashfdas wowow', NULL, '2024-03-02 05:17:41', '2024-03-02 05:17:41'),
(55, 5, 'TKT94404277', 17, NULL, 'dsafasfas', '10189449581709378391.png', '2024-03-02 05:19:51', '2024-03-02 05:19:51'),
(56, 5, 'TKT94404277', 17, NULL, 'sgfdsg osthir', '9081503651709379073.png', '2024-03-02 05:31:13', '2024-03-02 05:31:13'),
(57, 5, 'TKT94404277', 17, NULL, 'sgfdsg osthir', '13584432421709379222.png', '2024-03-02 05:33:42', '2024-03-02 05:33:42'),
(58, 5, 'TKT94404277', 17, NULL, 'dgdfg', '9388416861709379488.png', '2024-03-02 05:38:08', '2024-03-02 05:38:08'),
(59, 5, 'TKT94404277', 17, NULL, 'ewrwe', '18237104531709379661.png', '2024-03-02 05:41:01', '2024-03-02 05:41:01'),
(60, 5, 'TKT94404277', 17, NULL, 'asdfas', '4370107291709379850.png', '2024-03-02 05:44:10', '2024-03-02 05:44:10');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trnx` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `plan_id` int(21) NOT NULL,
  `charge` decimal(20,10) NOT NULL DEFAULT 0.0000000000,
  `amount` decimal(20,10) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `gateway` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `type` varchar(5) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transmissions`
--

CREATE TABLE `transmissions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transmissions`
--

INSERT INTO `transmissions` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Test Transmission', 'test-transmission', 1, '2024-03-23 00:10:34', '2024-03-23 00:10:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `zip` varchar(25) DEFAULT NULL,
  `balance` decimal(20,10) NOT NULL DEFAULT 0.0000000000,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `email_verified` tinyint(1) DEFAULT 0,
  `verified` tinyint(4) NOT NULL DEFAULT 0,
  `verification_link` varchar(255) DEFAULT NULL,
  `verify_code` int(11) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `kyc_status` tinyint(1) DEFAULT 0,
  `kyc_info` text DEFAULT NULL,
  `kyc_reject_reason` varchar(255) DEFAULT NULL,
  `two_fa_status` tinyint(1) NOT NULL DEFAULT 0,
  `two_fa` tinyint(1) NOT NULL DEFAULT 0,
  `two_fa_code` varchar(191) DEFAULT NULL,
  `is_vendor` tinyint(4) NOT NULL DEFAULT 0,
  `is_plan` int(5) DEFAULT NULL,
  `social_link` varchar(555) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `photo`, `phone`, `country`, `city`, `address`, `zip`, `balance`, `status`, `email_verified`, `verified`, `verification_link`, `verify_code`, `password`, `remember_token`, `kyc_status`, `kyc_info`, `kyc_reject_reason`, `two_fa_status`, `two_fa`, `two_fa_code`, `is_vendor`, `is_plan`, `social_link`, `created_at`, `updated_at`) VALUES
(16, 'showrav Hasan', 'test', 'user@gmail.com', '6745793341709120533.png', '+88001728332009', 'Bangladesh', 'test', 'Dhaka,Bangladesh', 'test', 44758.7042857140, 1, 1, 0, NULL, 778461, '$2y$10$cq93VSdEkHdlUlbofZP6bebfCy3F9stC6BRtEQn.FohtaWjlICn/2', NULL, 1, '{\"nid\":\"22222222\",\"image\":{\"nid_screenshot\":\"945694871702292265.png\",\"nid_backside\":\"18296713251702292265.png\"},\"details\":{\"description_of_address\":\"aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa\"}}', NULL, 0, 0, NULL, 0, NULL, NULL, '2023-06-05 04:31:32', '2024-04-03 02:00:36'),
(17, 'John Doe', NULL, 'pronob@gmail.com', '5822237081709380161.png', '01777777777', 'Dhaka', 'dhaka', 'Uttara', '3500', 15436.5453918810, 1, 1, 1, NULL, 635326, '$2y$10$x0.1k9RaoOtzsj/.ZDWmpuXgR3LN4CAX2zomYE8BgdvWUo.mYkq8m', NULL, 1, '{\"nid\":\"test\",\"image\":{\"nid_screenshot\":\"17247892871709455087.png\",\"nid_backside\":\"16460053171709455087.png\"},\"details\":{\"description_of_address\":\"test\"}}', NULL, 0, 0, NULL, 1, NULL, '{\"facebook\":{\"status\":null,\"link\":null},\"twitter\":{\"status\":null,\"link\":null},\"linkedin\":{\"status\":null,\"link\":null},\"pinterest\":{\"status\":null,\"link\":null},\"instagram\":{\"status\":null,\"link\":null}}', '2023-07-23 11:12:10', '2024-05-06 00:09:23'),
(28, 'pronob', 'pronob sarker', 'pronobsarker16@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 0.0000000000, 1, 1, 0, 'f4c8144f78c212e588bbe22ba297f6e4', 683837, '$2y$10$D1gJtuyj92qV23xaYrBj8u6VBfpafrcuQ3yHuQjPbSyFCMI2R1KWC', NULL, 0, NULL, NULL, 0, 0, NULL, 0, NULL, NULL, '2024-04-05 02:20:34', '2024-04-05 02:20:36');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` int(11) NOT NULL,
  `product_id` int(25) NOT NULL,
  `user_id` int(25) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `product_id`, `user_id`, `created_at`, `updated_at`) VALUES
(15, 22, 17, '2024-02-12 05:08:21', '2024-02-12 05:08:21'),
(16, 32, 17, '2024-02-12 21:20:05', '2024-02-12 21:20:05'),
(21, 36, 16, '2024-02-28 05:33:48', '2024-02-28 05:33:48'),
(22, 37, 16, '2024-02-28 05:34:02', '2024-02-28 05:34:02'),
(23, 6, 16, '2024-02-28 06:04:18', '2024-02-28 06:04:18');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trx` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `method_id` int(11) DEFAULT NULL,
  `amount` decimal(20,10) NOT NULL,
  `charge` decimal(20,10) NOT NULL,
  `total_amount` decimal(20,10) NOT NULL,
  `wallet_address` varchar(255) DEFAULT NULL,
  `currency_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 => pending, 1 => accepted, 2 => rejected\r\n',
  `user_data` varchar(255) DEFAULT NULL,
  `reject_reason` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `withdrawals`
--

INSERT INTO `withdrawals` (`id`, `trx`, `user_id`, `method_id`, `amount`, `charge`, `total_amount`, `wallet_address`, `currency_id`, `status`, `user_data`, `reject_reason`, `created_at`, `updated_at`) VALUES
(1, 'E72WKL2JFLKU', 17, 1, 100.0000000000, 3.0000000000, 103.0000000000, NULL, 1, 1, NULL, NULL, '2023-12-30 05:02:10', '2023-12-30 05:03:22'),
(2, 'X58UYSYQILQT', 16, 1, 101.0000000000, 3.0100000000, 104.0100000000, NULL, 1, 0, NULL, NULL, '2024-02-28 05:44:44', '2024-02-28 05:44:44'),
(3, 'SKYM8TD6EF0B', 17, 1, 105.0000000000, 3.0500000000, 108.0500000000, NULL, 1, 0, NULL, NULL, '2024-03-02 00:35:07', '2024-03-02 00:35:07'),
(4, 'KZS4ZCQWTMPI', 17, 1, 105.0000000000, 3.0500000000, 108.0500000000, NULL, 1, 0, NULL, NULL, '2024-03-02 00:38:06', '2024-03-02 00:38:06'),
(5, 'QVYM5POQFZ7A', 17, 1, 105.0000000000, 3.0500000000, 108.0500000000, NULL, 1, 0, NULL, NULL, '2024-03-02 00:38:26', '2024-03-02 00:38:26'),
(6, 'ESJHTBUVY5ST', 17, 1, 120.0000000000, 3.2000000000, 123.2000000000, NULL, 1, 1, NULL, NULL, '2024-03-02 00:40:03', '2024-03-02 00:41:09'),
(7, 'VUFSVPTG554U', 17, 1, 120.0000000000, 3.2000000000, 123.2000000000, NULL, 1, 0, NULL, NULL, '2024-03-02 02:59:11', '2024-03-02 02:59:11'),
(8, 'SDHUOAQRTMXU', 17, 1, 200.0000000000, 4.0000000000, 204.0000000000, NULL, 1, 0, NULL, NULL, '2024-03-02 03:01:18', '2024-03-02 03:01:18'),
(9, 'PWCK9E4O9BZS', 17, 1, 200.0000000000, 4.0000000000, 204.0000000000, NULL, 1, 0, NULL, NULL, '2024-03-02 04:33:15', '2024-03-02 04:33:15'),
(10, 'FP2X95CNN6MX', 17, 1, 500.0000000000, 7.0000000000, 507.0000000000, NULL, 1, 2, NULL, 'ok', '2024-03-03 03:24:14', '2024-03-03 03:26:17'),
(11, 'OZJLKF2OQKMV', 17, 1, 5000.0000000000, 52.0000000000, 5052.0000000000, NULL, 1, 1, NULL, NULL, '2024-03-03 03:24:20', '2024-03-03 03:25:09'),
(12, 'Z785S2CUQBVH', 17, 1, 500.0000000000, 7.0000000000, 507.0000000000, NULL, 1, 1, NULL, NULL, '2024-03-04 02:52:27', '2024-03-04 02:52:41'),
(13, '5CXKWEFPN3YF', 17, 1, 500.0000000000, 7.0000000000, 507.0000000000, NULL, 1, 2, NULL, 'asdfadfasd', '2024-03-04 04:21:54', '2024-03-04 04:22:58');

-- --------------------------------------------------------

--
-- Table structure for table `withdraws`
--

CREATE TABLE `withdraws` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `currency_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `withdraw_instruction` text NOT NULL,
  `min_amount` decimal(20,10) NOT NULL,
  `max_amount` decimal(20,10) NOT NULL,
  `fixed_charge` decimal(20,10) NOT NULL,
  `percent_charge` decimal(5,2) NOT NULL,
  `user_data` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `withdraws`
--

INSERT INTO `withdraws` (`id`, `currency_id`, `name`, `withdraw_instruction`, `min_amount`, `max_amount`, `fixed_charge`, `percent_charge`, `user_data`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'paypal', '<p>sdfgsdfgsdfg</p>', 100.0000000000, 10000.0000000000, 2.0000000000, 1.00, NULL, 1, '2023-12-30 04:19:28', '2023-12-30 04:19:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `about_tables`
--
ALTER TABLE `about_tables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `addons`
--
ALTER TABLE `addons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conditions`
--
ALTER TABLE `conditions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `currencies_symbol_unique` (`symbol`),
  ADD UNIQUE KEY `currencies_code_unique` (`code`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fuels`
--
ALTER TABLE `fuels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `generalsettings`
--
ALTER TABLE `generalsettings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `header_sections`
--
ALTER TABLE `header_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `kyc_forms`
--
ALTER TABLE `kyc_forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_logs`
--
ALTER TABLE `login_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modals`
--
ALTER TABLE `modals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `seo_settings`
--
ALTER TABLE `seo_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_contents`
--
ALTER TABLE `site_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_gateways`
--
ALTER TABLE `sms_gateways`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_messages`
--
ALTER TABLE `ticket_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transmissions`
--
ALTER TABLE `transmissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraws`
--
ALTER TABLE `withdraws`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `about_tables`
--
ALTER TABLE `about_tables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `addons`
--
ALTER TABLE `addons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `blog_comments`
--
ALTER TABLE `blog_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `conditions`
--
ALTER TABLE `conditions`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `fuels`
--
ALTER TABLE `fuels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `generalsettings`
--
ALTER TABLE `generalsettings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `header_sections`
--
ALTER TABLE `header_sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `kyc_forms`
--
ALTER TABLE `kyc_forms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `login_logs`
--
ALTER TABLE `login_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `modals`
--
ALTER TABLE `modals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=345;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `seo_settings`
--
ALTER TABLE `seo_settings`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `site_contents`
--
ALTER TABLE `site_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `sms_gateways`
--
ALTER TABLE `sms_gateways`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ticket_messages`
--
ALTER TABLE `ticket_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transmissions`
--
ALTER TABLE `transmissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `withdraws`
--
ALTER TABLE `withdraws`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
