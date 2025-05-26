-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2025 at 12:49 PM
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
-- Database: `hrms_in`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `date_time` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `name`, `email`, `description`, `date_time`, `created_at`, `updated_at`) VALUES
(1, 'harsh@gmail.com', 'harsh@gmail.com', 'has log in', 'Tue, Apr 29, 2025 7:34 PM', NULL, NULL),
(2, 'Harsh Tyagi', 'harsh@gmail.com', 'has logged out', 'Tue, Apr 29, 2025 7:36 PM', NULL, NULL),
(3, 'sankavi@gmail.com', 'sankavi@gmail.com', 'has log in', 'Tue, Apr 29, 2025 7:36 PM', NULL, NULL),
(4, 'Sankavi Ravi', 'sankavi@gmail.com', 'has logged out', 'Tue, Apr 29, 2025 7:36 PM', NULL, NULL),
(5, 'anuj@gmail.com', 'anuj@gmail.com', 'has log in', 'Tue, Apr 29, 2025 7:36 PM', NULL, NULL),
(6, 'Anuj Bisht', 'anuj@gmail.com', 'has logged out', 'Tue, Apr 29, 2025 7:40 PM', NULL, NULL),
(7, 'sankavi@gmail.com', 'sankavi@gmail.com', 'has log in', 'Tue, Apr 29, 2025 7:40 PM', NULL, NULL),
(8, 'Sankavi Ravi', 'sankavi@gmail.com', 'has logged out', 'Tue, Apr 29, 2025 7:40 PM', NULL, NULL),
(9, 'harsh@gmail.com', 'harsh@gmail.com', 'has log in', 'Tue, Apr 29, 2025 7:40 PM', NULL, NULL),
(10, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Wed, Apr 30, 2025 12:31 PM', NULL, NULL),
(11, 'Admin', 'admin@gmail.com', 'has logged out', 'Wed, Apr 30, 2025 12:31 PM', NULL, NULL),
(12, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Wed, Apr 30, 2025 12:31 PM', NULL, NULL),
(13, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Thu, May 1, 2025 4:41 PM', NULL, NULL),
(14, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Mon, May 5, 2025 12:45 PM', NULL, NULL),
(15, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Tue, May 6, 2025 2:28 PM', NULL, NULL),
(16, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Wed, May 7, 2025 12:43 PM', NULL, NULL),
(17, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Fri, May 9, 2025 1:32 PM', NULL, NULL),
(18, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Fri, May 9, 2025 4:06 PM', NULL, NULL),
(19, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Mon, May 12, 2025 12:05 PM', NULL, NULL),
(20, 'Admin', 'admin@gmail.com', 'has logged out', 'Mon, May 12, 2025 12:42 PM', NULL, NULL),
(21, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Mon, May 12, 2025 12:42 PM', NULL, NULL),
(22, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Mon, May 12, 2025 4:41 PM', NULL, NULL),
(23, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Mon, May 12, 2025 4:59 PM', NULL, NULL),
(24, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Tue, May 13, 2025 12:01 PM', NULL, NULL),
(25, 'Admin', 'admin@gmail.com', 'has logged out', 'Tue, May 13, 2025 1:12 PM', NULL, NULL),
(26, 'vishal556@rediansoftware.com', 'vishal556@rediansoftware.com', 'has log in', 'Tue, May 13, 2025 1:13 PM', NULL, NULL),
(27, 'sarthak Kaul', 'vishal556@rediansoftware.com', 'has logged out', 'Tue, May 13, 2025 1:14 PM', NULL, NULL),
(28, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Tue, May 13, 2025 1:14 PM', NULL, NULL),
(29, 'Admin', 'admin@gmail.com', 'has logged out', 'Tue, May 13, 2025 1:17 PM', NULL, NULL),
(30, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Tue, May 13, 2025 1:18 PM', NULL, NULL),
(31, 'Admin', 'admin@gmail.com', 'has logged out', 'Tue, May 13, 2025 1:18 PM', NULL, NULL),
(32, 'vishal556@rediansoftware.com', 'vishal556@rediansoftware.com', 'has log in', 'Tue, May 13, 2025 1:18 PM', NULL, NULL),
(33, 'anuj@gmail.com', 'anuj@gmail.com', 'has log in', 'Tue, May 13, 2025 1:27 PM', NULL, NULL),
(34, 'sarthak Kaul', 'vishal556@rediansoftware.com', 'has logged out', 'Tue, May 13, 2025 1:48 PM', NULL, NULL),
(35, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Tue, May 13, 2025 1:48 PM', NULL, NULL),
(36, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Wed, May 14, 2025 11:38 AM', NULL, NULL),
(37, 'vishal556@rediansoftware.com', 'vishal556@rediansoftware.com', 'has log in', 'Wed, May 14, 2025 12:01 PM', NULL, NULL),
(38, 'Admin', 'admin@gmail.com', 'has logged out', 'Wed, May 14, 2025 12:15 PM', NULL, NULL),
(39, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Wed, May 14, 2025 12:16 PM', NULL, NULL),
(40, 'Admin', 'admin@gmail.com', 'has logged out', 'Wed, May 14, 2025 12:20 PM', NULL, NULL),
(41, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Wed, May 14, 2025 12:20 PM', NULL, NULL),
(42, 'sarthak Kaul', 'vishal556@rediansoftware.com', 'has logged out', 'Wed, May 14, 2025 1:09 PM', NULL, NULL),
(43, 'sankavi@gmail.com', 'sankavi@gmail.com', 'has log in', 'Wed, May 14, 2025 1:09 PM', NULL, NULL),
(44, 'Admin', 'admin@gmail.com', 'has logged out', 'Wed, May 14, 2025 1:11 PM', NULL, NULL),
(45, 'anuj@gmail.com', 'anuj@gmail.com', 'has log in', 'Wed, May 14, 2025 1:11 PM', NULL, NULL),
(46, 'Anuj Bisht', 'anuj@gmail.com', 'has logged out', 'Wed, May 14, 2025 1:21 PM', NULL, NULL),
(47, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Wed, May 14, 2025 1:21 PM', NULL, NULL),
(48, 'Admin', 'admin@gmail.com', 'has logged out', 'Wed, May 14, 2025 1:32 PM', NULL, NULL),
(49, 'anuj@gmail.com', 'anuj@gmail.com', 'has log in', 'Wed, May 14, 2025 1:32 PM', NULL, NULL),
(50, 'Anuj Bisht', 'anuj@gmail.com', 'has logged out', 'Wed, May 14, 2025 1:36 PM', NULL, NULL),
(51, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Wed, May 14, 2025 1:36 PM', NULL, NULL),
(52, 'Admin', 'admin@gmail.com', 'has logged out', 'Wed, May 14, 2025 1:38 PM', NULL, NULL),
(53, 'anuj@gmail.com', 'anuj@gmail.com', 'has log in', 'Wed, May 14, 2025 1:38 PM', NULL, NULL),
(54, 'Anuj Bisht', 'anuj@gmail.com', 'has logged out', 'Wed, May 14, 2025 1:39 PM', NULL, NULL),
(55, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Wed, May 14, 2025 1:39 PM', NULL, NULL),
(56, 'Admin', 'admin@gmail.com', 'has logged out', 'Wed, May 14, 2025 1:40 PM', NULL, NULL),
(57, 'anuj@gmail.com', 'anuj@gmail.com', 'has log in', 'Wed, May 14, 2025 1:40 PM', NULL, NULL),
(58, 'Anuj Bisht', 'anuj@gmail.com', 'has logged out', 'Wed, May 14, 2025 1:57 PM', NULL, NULL),
(59, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Wed, May 14, 2025 1:58 PM', NULL, NULL),
(60, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Wed, May 14, 2025 4:11 PM', NULL, NULL),
(61, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Wed, May 14, 2025 5:25 PM', NULL, NULL),
(62, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Thu, May 15, 2025 1:48 PM', NULL, NULL),
(63, 'anuj@gmail.com', 'anuj@gmail.com', 'has log in', 'Thu, May 15, 2025 1:58 PM', NULL, NULL),
(64, 'Anuj Bisht', 'anuj@gmail.com', 'has logged out', 'Thu, May 15, 2025 3:25 PM', NULL, NULL),
(65, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Thu, May 15, 2025 3:25 PM', NULL, NULL),
(66, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Thu, May 15, 2025 5:48 PM', NULL, NULL),
(67, 'Admin', 'admin@gmail.com', 'has logged out', 'Thu, May 15, 2025 5:48 PM', NULL, NULL),
(68, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Thu, May 15, 2025 5:48 PM', NULL, NULL),
(69, 'Admin', 'admin@gmail.com', 'has logged out', 'Thu, May 15, 2025 6:30 PM', NULL, NULL),
(70, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Thu, May 15, 2025 6:30 PM', NULL, NULL),
(71, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Fri, May 16, 2025 1:20 PM', NULL, NULL),
(72, 'Admin', 'admin@gmail.com', 'has logged out', 'Fri, May 16, 2025 1:20 PM', NULL, NULL),
(73, 'sankavi@gmail.com', 'sankavi@gmail.com', 'has log in', 'Fri, May 16, 2025 1:20 PM', NULL, NULL),
(74, 'Sankavi Ravi', 'sankavi@gmail.com', 'has logged out', 'Fri, May 16, 2025 1:21 PM', NULL, NULL),
(75, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Fri, May 16, 2025 1:21 PM', NULL, NULL),
(76, 'Admin', 'admin@gmail.com', 'has logged out', 'Fri, May 16, 2025 1:36 PM', NULL, NULL),
(77, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Fri, May 16, 2025 1:42 PM', NULL, NULL),
(78, 'Admin', 'admin@gmail.com', 'has logged out', 'Fri, May 16, 2025 1:43 PM', NULL, NULL),
(79, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Fri, May 16, 2025 1:47 PM', NULL, NULL),
(80, 'Admin', 'admin@gmail.com', 'has logged out', 'Fri, May 16, 2025 3:25 PM', NULL, NULL),
(81, 'sankavi@gmail.com', 'sankavi@gmail.com', 'has log in', 'Fri, May 16, 2025 3:25 PM', NULL, NULL),
(82, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Mon, May 19, 2025 4:34 PM', NULL, NULL),
(83, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Mon, May 19, 2025 4:35 PM', NULL, NULL),
(84, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Tue, May 20, 2025 12:08 PM', NULL, NULL),
(85, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Tue, May 20, 2025 4:52 PM', NULL, NULL),
(86, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Tue, May 20, 2025 8:04 PM', NULL, NULL),
(87, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Wed, May 21, 2025 11:57 AM', NULL, NULL),
(88, 'anuj@gmail.com', 'anuj@gmail.com', 'has log in', 'Wed, May 21, 2025 1:12 PM', NULL, NULL),
(89, 'Anuj Bisht', 'anuj@gmail.com', 'has logged out', 'Wed, May 21, 2025 1:45 PM', NULL, NULL),
(90, 'Admin', 'admin@gmail.com', 'has logged out', 'Wed, May 21, 2025 1:52 PM', NULL, NULL),
(91, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Wed, May 21, 2025 1:53 PM', NULL, NULL),
(92, 'Admin', 'admin@gmail.com', 'has logged out', 'Wed, May 21, 2025 1:53 PM', NULL, NULL),
(93, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Wed, May 21, 2025 1:53 PM', NULL, NULL),
(94, 'Admin', 'admin@gmail.com', 'has logged out', 'Wed, May 21, 2025 1:53 PM', NULL, NULL),
(95, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Wed, May 21, 2025 1:53 PM', NULL, NULL),
(96, 'Admin', 'admin@gmail.com', 'has logged out', 'Wed, May 21, 2025 1:54 PM', NULL, NULL),
(97, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Wed, May 21, 2025 1:54 PM', NULL, NULL),
(98, 'Admin', 'admin@gmail.com', 'has logged out', 'Wed, May 21, 2025 1:54 PM', NULL, NULL),
(99, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Wed, May 21, 2025 1:54 PM', NULL, NULL),
(100, 'Admin', 'admin@gmail.com', 'has logged out', 'Wed, May 21, 2025 2:17 PM', NULL, NULL),
(101, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Wed, May 21, 2025 2:18 PM', NULL, NULL),
(102, 'Admin', 'admin@gmail.com', 'has logged out', 'Wed, May 21, 2025 2:18 PM', NULL, NULL),
(103, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Wed, May 21, 2025 2:18 PM', NULL, NULL),
(104, 'Admin', 'admin@gmail.com', 'has logged out', 'Wed, May 21, 2025 2:18 PM', NULL, NULL),
(105, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Wed, May 21, 2025 2:18 PM', NULL, NULL),
(106, 'Admin', 'admin@gmail.com', 'has logged out', 'Wed, May 21, 2025 2:22 PM', NULL, NULL),
(107, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Wed, May 21, 2025 2:22 PM', NULL, NULL),
(108, 'Admin', 'admin@gmail.com', 'has logged out', 'Wed, May 21, 2025 3:51 PM', NULL, NULL),
(109, 'neha@gmail.com', 'neha@gmail.com', 'has log in', 'Wed, May 21, 2025 3:51 PM', NULL, NULL),
(110, 'Neha Rawat', 'neha@gmail.com', 'has logged out', 'Wed, May 21, 2025 4:15 PM', NULL, NULL),
(111, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Wed, May 21, 2025 4:15 PM', NULL, NULL),
(112, 'kumar@gmail.com', 'kumar@gmail.com', 'has log in', 'Wed, May 21, 2025 4:40 PM', NULL, NULL),
(113, 'Vishnu Kumar', 'kumar@gmail.com', 'has logged out', 'Wed, May 21, 2025 4:49 PM', NULL, NULL),
(114, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Thu, May 22, 2025 11:50 AM', NULL, NULL),
(115, 'neha@gmail.com', 'neha@gmail.com', 'has log in', 'Thu, May 22, 2025 11:54 AM', NULL, NULL),
(116, 'Admin', 'admin@gmail.com', 'has logged out', 'Thu, May 22, 2025 12:15 PM', NULL, NULL),
(117, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Thu, May 22, 2025 12:16 PM', NULL, NULL),
(118, 'Admin', 'admin@gmail.com', 'has logged out', 'Thu, May 22, 2025 12:16 PM', NULL, NULL),
(119, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Thu, May 22, 2025 12:17 PM', NULL, NULL),
(120, 'Admin', 'admin@gmail.com', 'has logged out', 'Thu, May 22, 2025 12:18 PM', NULL, NULL),
(121, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Thu, May 22, 2025 12:18 PM', NULL, NULL),
(122, 'Admin', 'admin@gmail.com', 'has logged out', 'Thu, May 22, 2025 12:28 PM', NULL, NULL),
(123, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Thu, May 22, 2025 12:28 PM', NULL, NULL),
(124, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Thu, May 22, 2025 3:59 PM', NULL, NULL),
(125, 'Admin', 'admin@gmail.com', 'has logged out', 'Thu, May 22, 2025 4:08 PM', NULL, NULL),
(126, 'harsh@gmail.com', 'harsh@gmail.com', 'has log in', 'Thu, May 22, 2025 4:08 PM', NULL, NULL),
(127, 'Harsh Tyagi', 'harsh@gmail.com', 'has logged out', 'Thu, May 22, 2025 4:09 PM', NULL, NULL),
(128, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Thu, May 22, 2025 4:09 PM', NULL, NULL),
(129, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Thu, May 22, 2025 4:33 PM', NULL, NULL),
(130, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Thu, May 22, 2025 6:00 PM', NULL, NULL),
(131, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Thu, May 22, 2025 6:09 PM', NULL, NULL),
(132, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Fri, May 23, 2025 11:02 AM', NULL, NULL),
(133, 'Admin', 'admin@gmail.com', 'has logged out', 'Fri, May 23, 2025 11:48 AM', NULL, NULL),
(134, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Fri, May 23, 2025 11:49 AM', NULL, NULL),
(135, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Mon, May 26, 2025 11:33 AM', NULL, NULL),
(136, 'Admin', 'admin@gmail.com', 'has logged out', 'Mon, May 26, 2025 11:35 AM', NULL, NULL),
(137, 'admin@gmail.com', 'admin@gmail.com', 'has log in', 'Mon, May 26, 2025 11:36 AM', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `annual_leaves`
--

CREATE TABLE `annual_leaves` (
  `id` int(11) NOT NULL,
  `year` int(255) NOT NULL,
  `annual_leave` int(10) NOT NULL DEFAULT 0,
  `annual_leave_available` enum('active','inactive') NOT NULL DEFAULT 'active',
  `work_from_home` int(10) NOT NULL DEFAULT 0,
  `work_from_home_available` enum('active','inactive') NOT NULL DEFAULT 'active',
  `sick_leave` int(10) NOT NULL DEFAULT 0,
  `sick_leave_available` enum('active','inactive') NOT NULL DEFAULT 'active',
  `restrict_leave` int(10) NOT NULL DEFAULT 0,
  `restrict_leave_available` enum('active','inactive') NOT NULL DEFAULT 'active',
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `annual_leaves`
--

INSERT INTO `annual_leaves` (`id`, `year`, `annual_leave`, `annual_leave_available`, `work_from_home`, `work_from_home_available`, `sick_leave`, `sick_leave_available`, `restrict_leave`, `restrict_leave_available`, `is_delete`, `created_at`, `updated_at`) VALUES
(3, 2025, 3, 'active', 10, 'active', 1, 'active', 2, 'active', '0', '2025-02-12 13:55:51', '2025-04-02 09:48:12'),
(6, 2026, 1, 'active', 2, 'active', 2, 'active', 0, 'active', '0', '2025-02-14 07:10:23', '2025-02-14 07:10:23');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `finish_time` datetime NOT NULL,
  `title` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `asset_type_id` bigint(20) UNSIGNED NOT NULL,
  `location_id` bigint(20) UNSIGNED DEFAULT NULL,
  `serial_number` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('Working','Not Working') DEFAULT 'Working',
  `lent_status` enum('lent','returned') DEFAULT 'lent',
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `lent_to_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`id`, `name`, `asset_type_id`, `location_id`, `serial_number`, `description`, `status`, `lent_status`, `image`, `created_at`, `updated_at`, `lent_to_id`) VALUES
(11, 'Keyboard Acer', 7, 1, '9899JUIJMSERTTE453', 'test', 'Working', 'lent', NULL, '2025-04-30 10:56:01', '2025-04-30 10:56:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `asset_returns`
--

CREATE TABLE `asset_returns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `asset_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `return_by` bigint(20) UNSIGNED DEFAULT NULL,
  `lend_date` date NOT NULL,
  `return_date` date NOT NULL,
  `is_broken` tinyint(1) DEFAULT 0,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `asset_types`
--

CREATE TABLE `asset_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asset_types`
--

INSERT INTO `asset_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Laptops', '2025-03-31 10:37:01', '2025-03-31 10:37:46'),
(2, 'Mobiles', '2025-03-31 10:37:09', '2025-03-31 10:37:49'),
(3, 'CPUS', '2025-03-31 10:37:21', '2025-03-31 10:37:21'),
(4, 'Desktops', '2025-03-31 10:37:26', '2025-03-31 10:37:53'),
(5, 'Cables', '2025-03-31 10:37:34', '2025-03-31 10:37:34'),
(6, 'Chargers', '2025-03-31 10:37:41', '2025-03-31 10:37:41'),
(7, 'Keyboards', '2025-04-30 10:55:38', '2025-04-30 10:55:38');

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE `attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contract_id` bigint(20) UNSIGNED NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_type` text CHARACTER SET utf8mb4 COLLATE utf8mb4_german2_ci NOT NULL,
  `file_size` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee` bigint(20) UNSIGNED NOT NULL,
  `in_time` datetime NOT NULL,
  `out_time` datetime DEFAULT NULL,
  `note` varchar(500) DEFAULT NULL,
  `image_in` longtext DEFAULT NULL,
  `image_out` longtext DEFAULT NULL,
  `map_lat` decimal(10,8) DEFAULT NULL,
  `map_lng` decimal(10,8) DEFAULT NULL,
  `map_snapshot` longtext DEFAULT NULL,
  `map_out_lat` decimal(10,8) DEFAULT NULL,
  `map_out_lng` decimal(10,8) DEFAULT NULL,
  `map_out_snapshot` longtext DEFAULT NULL,
  `in_ip` varchar(25) DEFAULT NULL,
  `out_ip` varchar(25) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'III - V'),
(2, 'VI-VIII'),
(3, 'VIII - IX'),
(4, 'X - XII');

-- --------------------------------------------------------

--
-- Table structure for table `cc_employees`
--

CREATE TABLE `cc_employees` (
  `id` bigint(20) NOT NULL,
  `cc_employee_id` bigint(20) NOT NULL,
  `help_request_id` bigint(20) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `certifications`
--

CREATE TABLE `certifications` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `certifications`
--

INSERT INTO `certifications` (`id`, `name`, `description`) VALUES
(1, 'Red Hat Certified Architect (RHCA)', 'Red Hat Certified Architect (RHCA)'),
(2, 'GIAC Secure Software Programmer -Java', 'GIAC Secure Software Programmer -Java'),
(3, 'Risk Management Professional (PMI)', 'Risk Management Professional (PMI)'),
(4, 'IT Infrastructure Library (ITIL) Expert Certification', 'IT Infrastructure Library (ITIL) Expert Certification'),
(5, 'Microsoft Certified Architect', 'Microsoft Certified Architect'),
(6, 'Oracle Exadata 11g Certified Implementation Specialist', 'Oracle Exadata 11g Certified Implementation Specialist'),
(7, 'Cisco Certified Design Professional (CCDP)', 'Cisco Certified Design Professional (CCDP)'),
(8, 'Cisco Certified Internetwork Expert (CCIE)', 'Cisco Certified Internetwork Expert (CCIE)'),
(9, 'Cisco Certified Network Associate', 'Cisco Certified Network Associate'),
(10, 'HP/Master Accredited Solutions Expert (MASE)', 'HP/Master Accredited Solutions Expert (MASE)'),
(11, 'HP/Master Accredited Systems Engineer (Master ASE)', 'HP/Master Accredited Systems Engineer (Master ASE)'),
(12, 'Certified Information Security Manager (CISM)', 'Certified Information Security Manager (CISM)'),
(13, 'Certified Information Systems Auditor (CISA)', 'Certified Information Systems Auditor (CISA)'),
(14, 'CyberSecurity Forensic Analyst (CSFA)', 'CyberSecurity Forensic Analyst (CSFA)'),
(15, 'Open Group Certified Architect (OpenCA)', 'Open Group Certified Architect (OpenCA)'),
(16, 'Oracle DBA Administrator Certified Master OCM', 'Oracle DBA Administrator Certified Master OCM'),
(17, 'Project Management Professional', 'Project Management Professional'),
(18, 'Apple Certified Support Professional', 'Apple Certified Support Professional'),
(19, 'Certified Public Accountant (CPA)', 'Certified Public Accountant (CPA)'),
(20, 'Chartered Financial Analyst', 'Chartered Financial Analyst'),
(21, 'Professional in Human Resources (PHR)', 'Professional in Human Resources (PHR)');

-- --------------------------------------------------------

--
-- Table structure for table `client_details`
--

CREATE TABLE `client_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `details` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `first_contact_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `content` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_settings`
--

CREATE TABLE `company_settings` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `country` bigint(20) UNSIGNED DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state_province` varchar(100) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_number` varchar(50) DEFAULT NULL,
  `mobile_number` varchar(50) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `website_url` varchar(255) DEFAULT NULL,
  `logo_image_url` varchar(255) DEFAULT NULL,
  `dashboard_image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company_settings`
--

INSERT INTO `company_settings` (`id`, `company_name`, `contact_person`, `address`, `country`, `city`, `state_province`, `postal_code`, `email`, `phone_number`, `mobile_number`, `fax`, `website_url`, `logo_image_url`, `dashboard_image_url`, `created_at`, `updated_at`) VALUES
(8, 'Redian Software', 'Arunesh Beri', 'Noida , Sector - 63', 99, 'noida', 'UP', '201301', 'arunesh@rediansoftware.com', '8908765433', '9891261971', '98765', 'https://meta.stackexchange.com/questions/190344/replacing-urls-with-dummy-urls', NULL, 'a-vibrant-3d-animated-illustration-depic_VnALXK0VRN26XX_3eNZIMg_UA7C7sBwTAKlehlnBPHNDw (1).jpeg', '2025-05-15 12:42:51', '2025-05-15 12:43:25');

-- --------------------------------------------------------

--
-- Table structure for table `company_structures`
--

CREATE TABLE `company_structures` (
  `id` bigint(20) NOT NULL,
  `title` tinytext NOT NULL,
  `description` text NOT NULL,
  `address` text DEFAULT NULL,
  `type` enum('Company','Head Office','Regional Office','Department','Unit','Sub Unit','Other') DEFAULT NULL,
  `country` bigint(20) UNSIGNED NOT NULL,
  `parent` bigint(20) DEFAULT NULL,
  `timezone` varchar(100) NOT NULL DEFAULT 'Europe/London',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `company_structures`
--

INSERT INTO `company_structures` (`id`, `title`, `description`, `address`, `type`, `country`, `parent`, `timezone`, `updated_at`, `created_at`) VALUES
(1, 'Your Company', 'Please update your company name here. You can update, delete or add units according to your needs', '', 'Company', 1, NULL, '453', '2025-01-15 12:40:57', '2025-01-15 12:38:41'),
(2, 'Head Office', 'US Head office', 'PO Box 001002\nSample Road, Sample Town', 'Head Office', 1, 1, '453', '2025-01-15 12:41:00', '2025-01-15 12:38:41'),
(3, 'Marketing Department', 'Marketing Department', 'PO Box 001002\nSample Road, Sample Town', 'Department', 1, 2, '453', '2025-01-15 12:41:03', '2025-01-15 12:38:41'),
(4, 'XYZ Company', 'XYZ Details', 'XYZ Details', 'Company', 1, 2, '129', '2025-01-15 12:41:17', '2025-01-15 12:38:41'),
(6, 'TEST C', 'TEST Det', 'TEST Add', 'Company', 8, NULL, '88', '2025-01-15 14:19:36', '2025-01-15 14:19:36');

-- --------------------------------------------------------

--
-- Table structure for table `company_structure_heads`
--

CREATE TABLE `company_structure_heads` (
  `id` int(11) NOT NULL,
  `company_structure_id` bigint(20) NOT NULL,
  `head_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contracts`
--

CREATE TABLE `contracts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Vendor_name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `type` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `due_date` date NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` char(2) NOT NULL DEFAULT '',
  `namecap` varchar(80) DEFAULT '',
  `name` varchar(80) NOT NULL DEFAULT '',
  `iso3` char(3) DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `code`, `namecap`, `name`, `iso3`, `numcode`) VALUES
(1, 'AF', 'AFGHANISTAN', 'Afghanistan', 'AFG', 4),
(2, 'AL', 'ALBANIA', 'Albania', 'ALB', 8),
(3, 'DZ', 'ALGERIA', 'Algeria', 'DZA', 12),
(4, 'AS', 'AMERICAN SAMOA', 'American Samoa', 'ASM', 16),
(5, 'AD', 'ANDORRA', 'Andorra', 'AND', 20),
(6, 'AO', 'ANGOLA', 'Angola', 'AGO', 24),
(7, 'AI', 'ANGUILLA', 'Anguilla', 'AIA', 660),
(8, 'AQ', 'ANTARCTICA', 'Antarctica', NULL, NULL),
(9, 'AG', 'ANTIGUA AND BARBUDA', 'Antigua and Barbuda', 'ATG', 28),
(10, 'AR', 'ARGENTINA', 'Argentina', 'ARG', 32),
(11, 'AM', 'ARMENIA', 'Armenia', 'ARM', 51),
(12, 'AW', 'ARUBA', 'Aruba', 'ABW', 533),
(13, 'AU', 'AUSTRALIA', 'Australia', 'AUS', 36),
(14, 'AT', 'AUSTRIA', 'Austria', 'AUT', 40),
(15, 'AZ', 'AZERBAIJAN', 'Azerbaijan', 'AZE', 31),
(16, 'BS', 'BAHAMAS', 'Bahamas', 'BHS', 44),
(17, 'BH', 'BAHRAIN', 'Bahrain', 'BHR', 48),
(18, 'BD', 'BANGLADESH', 'Bangladesh', 'BGD', 50),
(19, 'BB', 'BARBADOS', 'Barbados', 'BRB', 52),
(20, 'BY', 'BELARUS', 'Belarus', 'BLR', 112),
(21, 'BE', 'BELGIUM', 'Belgium', 'BEL', 56),
(22, 'BZ', 'BELIZE', 'Belize', 'BLZ', 84),
(23, 'BJ', 'BENIN', 'Benin', 'BEN', 204),
(24, 'BM', 'BERMUDA', 'Bermuda', 'BMU', 60),
(25, 'BT', 'BHUTAN', 'Bhutan', 'BTN', 64),
(26, 'BO', 'BOLIVIA', 'Bolivia', 'BOL', 68),
(27, 'BA', 'BOSNIA AND HERZEGOVINA', 'Bosnia and Herzegovina', 'BIH', 70),
(28, 'BW', 'BOTSWANA', 'Botswana', 'BWA', 72),
(29, 'BV', 'BOUVET ISLAND', 'Bouvet Island', NULL, NULL),
(30, 'BR', 'BRAZIL', 'Brazil', 'BRA', 76),
(31, 'IO', 'BRITISH INDIAN OCEAN TERRITORY', 'British Indian Ocean Territory', NULL, NULL),
(32, 'BN', 'BRUNEI DARUSSALAM', 'Brunei Darussalam', 'BRN', 96),
(33, 'BG', 'BULGARIA', 'Bulgaria', 'BGR', 100),
(34, 'BF', 'BURKINA FASO', 'Burkina Faso', 'BFA', 854),
(35, 'BI', 'BURUNDI', 'Burundi', 'BDI', 108),
(36, 'KH', 'CAMBODIA', 'Cambodia', 'KHM', 116),
(37, 'CM', 'CAMEROON', 'Cameroon', 'CMR', 120),
(38, 'CA', 'CANADA', 'Canada', 'CAN', 124),
(39, 'CV', 'CAPE VERDE', 'Cape Verde', 'CPV', 132),
(40, 'KY', 'CAYMAN ISLANDS', 'Cayman Islands', 'CYM', 136),
(41, 'CF', 'CENTRAL AFRICAN REPUBLIC', 'Central African Republic', 'CAF', 140),
(42, 'TD', 'CHAD', 'Chad', 'TCD', 148),
(43, 'CL', 'CHILE', 'Chile', 'CHL', 152),
(44, 'CN', 'CHINA', 'China', 'CHN', 156),
(45, 'CX', 'CHRISTMAS ISLAND', 'Christmas Island', NULL, NULL),
(46, 'CC', 'COCOS (KEELING) ISLANDS', 'Cocos (Keeling) Islands', NULL, NULL),
(47, 'CO', 'COLOMBIA', 'Colombia', 'COL', 170),
(48, 'KM', 'COMOROS', 'Comoros', 'COM', 174),
(49, 'CG', 'CONGO', 'Congo', 'COG', 178),
(50, 'CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congo, the Democratic Republic of the', 'COD', 180),
(51, 'CK', 'COOK ISLANDS', 'Cook Islands', 'COK', 184),
(52, 'CR', 'COSTA RICA', 'Costa Rica', 'CRI', 188),
(53, 'CI', 'COTE D\'IVOIRE', 'Cote D\'Ivoire', 'CIV', 384),
(54, 'HR', 'CROATIA', 'Croatia', 'HRV', 191),
(55, 'CU', 'CUBA', 'Cuba', 'CUB', 192),
(56, 'CY', 'CYPRUS', 'Cyprus', 'CYP', 196),
(57, 'CZ', 'CZECH REPUBLIC', 'Czech Republic', 'CZE', 203),
(58, 'DK', 'DENMARK', 'Denmark', 'DNK', 208),
(59, 'DJ', 'DJIBOUTI', 'Djibouti', 'DJI', 262),
(60, 'DM', 'DOMINICA', 'Dominica', 'DMA', 212),
(61, 'DO', 'DOMINICAN REPUBLIC', 'Dominican Republic', 'DOM', 214),
(62, 'EC', 'ECUADOR', 'Ecuador', 'ECU', 218),
(63, 'EG', 'EGYPT', 'Egypt', 'EGY', 818),
(64, 'SV', 'EL SALVADOR', 'El Salvador', 'SLV', 222),
(65, 'GQ', 'EQUATORIAL GUINEA', 'Equatorial Guinea', 'GNQ', 226),
(66, 'ER', 'ERITREA', 'Eritrea', 'ERI', 232),
(67, 'EE', 'ESTONIA', 'Estonia', 'EST', 233),
(68, 'ET', 'ETHIOPIA', 'Ethiopia', 'ETH', 231),
(69, 'FK', 'FALKLAND ISLANDS (MALVINAS)', 'Falkland Islands (Malvinas)', 'FLK', 238),
(70, 'FO', 'FAROE ISLANDS', 'Faroe Islands', 'FRO', 234),
(71, 'FJ', 'FIJI', 'Fiji', 'FJI', 242),
(72, 'FI', 'FINLAND', 'Finland', 'FIN', 246),
(73, 'FR', 'FRANCE', 'France', 'FRA', 250),
(74, 'GF', 'FRENCH GUIANA', 'French Guiana', 'GUF', 254),
(75, 'PF', 'FRENCH POLYNESIA', 'French Polynesia', 'PYF', 258),
(76, 'TF', 'FRENCH SOUTHERN TERRITORIES', 'French Southern Territories', NULL, NULL),
(77, 'GA', 'GABON', 'Gabon', 'GAB', 266),
(78, 'GM', 'GAMBIA', 'Gambia', 'GMB', 270),
(79, 'GE', 'GEORGIA', 'Georgia', 'GEO', 268),
(80, 'DE', 'GERMANY', 'Germany', 'DEU', 276),
(81, 'GH', 'GHANA', 'Ghana', 'GHA', 288),
(82, 'GI', 'GIBRALTAR', 'Gibraltar', 'GIB', 292),
(83, 'GR', 'GREECE', 'Greece', 'GRC', 300),
(84, 'GL', 'GREENLAND', 'Greenland', 'GRL', 304),
(85, 'GD', 'GRENADA', 'Grenada', 'GRD', 308),
(86, 'GP', 'GUADELOUPE', 'Guadeloupe', 'GLP', 312),
(87, 'GU', 'GUAM', 'Guam', 'GUM', 316),
(88, 'GT', 'GUATEMALA', 'Guatemala', 'GTM', 320),
(89, 'GN', 'GUINEA', 'Guinea', 'GIN', 324),
(90, 'GW', 'GUINEA-BISSAU', 'Guinea-Bissau', 'GNB', 624),
(91, 'GY', 'GUYANA', 'Guyana', 'GUY', 328),
(92, 'HT', 'HAITI', 'Haiti', 'HTI', 332),
(93, 'HM', 'HEARD ISLAND AND MCDONALD ISLANDS', 'Heard Island and Mcdonald Islands', NULL, NULL),
(94, 'VA', 'HOLY SEE (VATICAN CITY STATE)', 'Holy See (Vatican City State)', 'VAT', 336),
(95, 'HN', 'HONDURAS', 'Honduras', 'HND', 340),
(96, 'HK', 'HONG KONG', 'Hong Kong', 'HKG', 344),
(97, 'HU', 'HUNGARY', 'Hungary', 'HUN', 348),
(98, 'IS', 'ICELAND', 'Iceland', 'ISL', 352),
(99, 'IN', 'INDIA', 'India', 'IND', 356),
(100, 'ID', 'INDONESIA', 'Indonesia', 'IDN', 360),
(101, 'IR', 'IRAN, ISLAMIC REPUBLIC OF', 'Iran, Islamic Republic of', 'IRN', 364),
(102, 'IQ', 'IRAQ', 'Iraq', 'IRQ', 368),
(103, 'IE', 'IRELAND', 'Ireland', 'IRL', 372),
(104, 'IL', 'ISRAEL', 'Israel', 'ISR', 376),
(105, 'IT', 'ITALY', 'Italy', 'ITA', 380),
(106, 'JM', 'JAMAICA', 'Jamaica', 'JAM', 388),
(107, 'JP', 'JAPAN', 'Japan', 'JPN', 392),
(108, 'JO', 'JORDAN', 'Jordan', 'JOR', 400),
(109, 'KZ', 'KAZAKHSTAN', 'Kazakhstan', 'KAZ', 398),
(110, 'KE', 'KENYA', 'Kenya', 'KEN', 404),
(111, 'KI', 'KIRIBATI', 'Kiribati', 'KIR', 296),
(112, 'KP', 'KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF', 'Korea, Democratic People\'s Republic of', 'PRK', 408),
(113, 'KR', 'KOREA, REPUBLIC OF', 'Korea, Republic of', 'KOR', 410),
(114, 'KW', 'KUWAIT', 'Kuwait', 'KWT', 414),
(115, 'KG', 'KYRGYZSTAN', 'Kyrgyzstan', 'KGZ', 417),
(116, 'LA', 'LAO PEOPLE\'S DEMOCRATIC REPUBLIC', 'Lao People\'s Democratic Republic', 'LAO', 418),
(117, 'LV', 'LATVIA', 'Latvia', 'LVA', 428),
(118, 'LB', 'LEBANON', 'Lebanon', 'LBN', 422),
(119, 'LS', 'LESOTHO', 'Lesotho', 'LSO', 426),
(120, 'LR', 'LIBERIA', 'Liberia', 'LBR', 430),
(121, 'LY', 'LIBYAN ARAB JAMAHIRIYA', 'Libyan Arab Jamahiriya', 'LBY', 434),
(122, 'LI', 'LIECHTENSTEIN', 'Liechtenstein', 'LIE', 438),
(123, 'LT', 'LITHUANIA', 'Lithuania', 'LTU', 440),
(124, 'LU', 'LUXEMBOURG', 'Luxembourg', 'LUX', 442),
(125, 'MO', 'MACAO', 'Macao', 'MAC', 446),
(126, 'MK', 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'Macedonia, the Former Yugoslav Republic of', 'MKD', 807),
(127, 'MG', 'MADAGASCAR', 'Madagascar', 'MDG', 450),
(128, 'MW', 'MALAWI', 'Malawi', 'MWI', 454),
(129, 'MY', 'MALAYSIA', 'Malaysia', 'MYS', 458),
(130, 'MV', 'MALDIVES', 'Maldives', 'MDV', 462),
(131, 'ML', 'MALI', 'Mali', 'MLI', 466),
(132, 'MT', 'MALTA', 'Malta', 'MLT', 470),
(133, 'MH', 'MARSHALL ISLANDS', 'Marshall Islands', 'MHL', 584),
(134, 'MQ', 'MARTINIQUE', 'Martinique', 'MTQ', 474),
(135, 'MR', 'MAURITANIA', 'Mauritania', 'MRT', 478),
(136, 'MU', 'MAURITIUS', 'Mauritius', 'MUS', 480),
(137, 'YT', 'MAYOTTE', 'Mayotte', NULL, NULL),
(138, 'MX', 'MEXICO', 'Mexico', 'MEX', 484),
(139, 'FM', 'MICRONESIA, FEDERATED STATES OF', 'Micronesia, Federated States of', 'FSM', 583),
(140, 'MD', 'MOLDOVA, REPUBLIC OF', 'Moldova, Republic of', 'MDA', 498),
(141, 'MC', 'MONACO', 'Monaco', 'MCO', 492),
(142, 'MN', 'MONGOLIA', 'Mongolia', 'MNG', 496),
(143, 'MS', 'MONTSERRAT', 'Montserrat', 'MSR', 500),
(144, 'MA', 'MOROCCO', 'Morocco', 'MAR', 504),
(145, 'MZ', 'MOZAMBIQUE', 'Mozambique', 'MOZ', 508),
(146, 'MM', 'MYANMAR', 'Myanmar', 'MMR', 104),
(147, 'NA', 'NAMIBIA', 'Namibia', 'NAM', 516),
(148, 'NR', 'NAURU', 'Nauru', 'NRU', 520),
(149, 'NP', 'NEPAL', 'Nepal', 'NPL', 524),
(150, 'NL', 'NETHERLANDS', 'Netherlands', 'NLD', 528),
(151, 'AN', 'NETHERLANDS ANTILLES', 'Netherlands Antilles', 'ANT', 530),
(152, 'NC', 'NEW CALEDONIA', 'New Caledonia', 'NCL', 540),
(153, 'NZ', 'NEW ZEALAND', 'New Zealand', 'NZL', 554),
(154, 'NI', 'NICARAGUA', 'Nicaragua', 'NIC', 558),
(155, 'NE', 'NIGER', 'Niger', 'NER', 562),
(156, 'NG', 'NIGERIA', 'Nigeria', 'NGA', 566),
(157, 'NU', 'NIUE', 'Niue', 'NIU', 570),
(158, 'NF', 'NORFOLK ISLAND', 'Norfolk Island', 'NFK', 574),
(159, 'MP', 'NORTHERN MARIANA ISLANDS', 'Northern Mariana Islands', 'MNP', 580),
(160, 'NO', 'NORWAY', 'Norway', 'NOR', 578),
(161, 'OM', 'OMAN', 'Oman', 'OMN', 512),
(162, 'PK', 'PAKISTAN', 'Pakistan', 'PAK', 586),
(163, 'PW', 'PALAU', 'Palau', 'PLW', 585),
(164, 'PS', 'PALESTINIAN TERRITORY, OCCUPIED', 'Palestinian Territory, Occupied', NULL, NULL),
(165, 'PA', 'PANAMA', 'Panama', 'PAN', 591),
(166, 'PG', 'PAPUA NEW GUINEA', 'Papua New Guinea', 'PNG', 598),
(167, 'PY', 'PARAGUAY', 'Paraguay', 'PRY', 600),
(168, 'PE', 'PERU', 'Peru', 'PER', 604),
(169, 'PH', 'PHILIPPINES', 'Philippines', 'PHL', 608),
(170, 'PN', 'PITCAIRN', 'Pitcairn', 'PCN', 612),
(171, 'PL', 'POLAND', 'Poland', 'POL', 616),
(172, 'PT', 'PORTUGAL', 'Portugal', 'PRT', 620),
(173, 'PR', 'PUERTO RICO', 'Puerto Rico', 'PRI', 630),
(174, 'QA', 'QATAR', 'Qatar', 'QAT', 634),
(175, 'RE', 'REUNION', 'Reunion', 'REU', 638),
(176, 'RO', 'ROMANIA', 'Romania', 'ROM', 642),
(177, 'RU', 'RUSSIAN FEDERATION', 'Russian Federation', 'RUS', 643),
(178, 'RW', 'RWANDA', 'Rwanda', 'RWA', 646),
(179, 'SH', 'SAINT HELENA', 'Saint Helena', 'SHN', 654),
(180, 'KN', 'SAINT KITTS AND NEVIS', 'Saint Kitts and Nevis', 'KNA', 659),
(181, 'LC', 'SAINT LUCIA', 'Saint Lucia', 'LCA', 662),
(182, 'PM', 'SAINT PIERRE AND MIQUELON', 'Saint Pierre and Miquelon', 'SPM', 666),
(183, 'VC', 'SAINT VINCENT AND THE GRENADINES', 'Saint Vincent and the Grenadines', 'VCT', 670),
(184, 'WS', 'SAMOA', 'Samoa', 'WSM', 882),
(185, 'SM', 'SAN MARINO', 'San Marino', 'SMR', 674),
(186, 'ST', 'SAO TOME AND PRINCIPE', 'Sao Tome and Principe', 'STP', 678),
(187, 'SA', 'SAUDI ARABIA', 'Saudi Arabia', 'SAU', 682),
(188, 'SN', 'SENEGAL', 'Senegal', 'SEN', 686),
(189, 'CS', 'SERBIA AND MONTENEGRO', 'Serbia and Montenegro', NULL, NULL),
(190, 'SC', 'SEYCHELLES', 'Seychelles', 'SYC', 690),
(191, 'SL', 'SIERRA LEONE', 'Sierra Leone', 'SLE', 694),
(192, 'SG', 'SINGAPORE', 'Singapore', 'SGP', 702),
(193, 'SK', 'SLOVAKIA', 'Slovakia', 'SVK', 703),
(194, 'SI', 'SLOVENIA', 'Slovenia', 'SVN', 705),
(195, 'SB', 'SOLOMON ISLANDS', 'Solomon Islands', 'SLB', 90),
(196, 'SO', 'SOMALIA', 'Somalia', 'SOM', 706),
(197, 'ZA', 'SOUTH AFRICA', 'South Africa', 'ZAF', 710),
(198, 'GS', 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'South Georgia and the South Sandwich Islands', NULL, NULL),
(199, 'ES', 'SPAIN', 'Spain', 'ESP', 724),
(200, 'LK', 'SRI LANKA', 'Sri Lanka', 'LKA', 144),
(201, 'SD', 'SUDAN', 'Sudan', 'SDN', 736),
(202, 'SR', 'SURINAME', 'Suriname', 'SUR', 740),
(203, 'SJ', 'SVALBARD AND JAN MAYEN', 'Svalbard and Jan Mayen', 'SJM', 744),
(204, 'SZ', 'SWAZILAND', 'Swaziland', 'SWZ', 748),
(205, 'SE', 'SWEDEN', 'Sweden', 'SWE', 752),
(206, 'CH', 'SWITZERLAND', 'Switzerland', 'CHE', 756),
(207, 'SY', 'SYRIAN ARAB REPUBLIC', 'Syrian Arab Republic', 'SYR', 760),
(208, 'TW', 'TAIWAN, PROVINCE OF CHINA', 'Taiwan', 'TWN', 158),
(209, 'TJ', 'TAJIKISTAN', 'Tajikistan', 'TJK', 762),
(210, 'TZ', 'TANZANIA, UNITED REPUBLIC OF', 'Tanzania, United Republic of', 'TZA', 834),
(211, 'TH', 'THAILAND', 'Thailand', 'THA', 764),
(212, 'TL', 'TIMOR-LESTE', 'Timor-Leste', NULL, NULL),
(213, 'TG', 'TOGO', 'Togo', 'TGO', 768),
(214, 'TK', 'TOKELAU', 'Tokelau', 'TKL', 772),
(215, 'TO', 'TONGA', 'Tonga', 'TON', 776),
(216, 'TT', 'TRINIDAD AND TOBAGO', 'Trinidad and Tobago', 'TTO', 780),
(217, 'TN', 'TUNISIA', 'Tunisia', 'TUN', 788),
(218, 'TR', 'TURKEY', 'Turkey', 'TUR', 792),
(219, 'TM', 'TURKMENISTAN', 'Turkmenistan', 'TKM', 795),
(220, 'TC', 'TURKS AND CAICOS ISLANDS', 'Turks and Caicos Islands', 'TCA', 796),
(221, 'TV', 'TUVALU', 'Tuvalu', 'TUV', 798),
(222, 'UG', 'UGANDA', 'Uganda', 'UGA', 800),
(223, 'UA', 'UKRAINE', 'Ukraine', 'UKR', 804),
(224, 'AE', 'UNITED ARAB EMIRATES', 'United Arab Emirates', 'ARE', 784),
(225, 'GB', 'UNITED KINGDOM', 'United Kingdom', 'GBR', 826),
(226, 'US', 'UNITED STATES', 'United States', 'USA', 840),
(227, 'UM', 'UNITED STATES MINOR OUTLYING ISLANDS', 'United States Minor Outlying Islands', NULL, NULL),
(228, 'UY', 'URUGUAY', 'Uruguay', 'URY', 858),
(229, 'UZ', 'UZBEKISTAN', 'Uzbekistan', 'UZB', 860),
(230, 'VU', 'VANUATU', 'Vanuatu', 'VUT', 548),
(231, 'VE', 'VENEZUELA', 'Venezuela', 'VEN', 862),
(232, 'VN', 'VIET NAM', 'Viet Nam', 'VNM', 704),
(233, 'VG', 'VIRGIN ISLANDS, BRITISH', 'Virgin Islands, British', 'VGB', 92),
(234, 'VI', 'VIRGIN ISLANDS, U.S.', 'Virgin Islands, U.s.', 'VIR', 850),
(235, 'WF', 'WALLIS AND FUTUNA', 'Wallis and Futuna', 'WLF', 876),
(236, 'EH', 'WESTERN SAHARA', 'Western Sahara', 'ESH', 732),
(237, 'YE', 'YEMEN', 'Yemen', 'YEM', 887),
(238, 'ZM', 'ZAMBIA', 'Zambia', 'ZMB', 894),
(239, 'ZW', 'ZIMBABWE', 'Zimbabwe', 'ZWE', 716);

-- --------------------------------------------------------

--
-- Table structure for table `currency_types`
--

CREATE TABLE `currency_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(3) NOT NULL DEFAULT '',
  `name` varchar(70) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `currency_types`
--

INSERT INTO `currency_types` (`id`, `code`, `name`) VALUES
(3, 'AED', 'Utd. Arab Emir. Dirham'),
(4, 'AFN', 'Afghanistan Afghani'),
(5, 'ALL', 'Albanian Lek'),
(6, 'ANG', 'NL Antillian Guilder'),
(7, 'AOR', 'Angolan New Kwanza'),
(8, 'ARS', 'Argentine Peso'),
(10, 'AUD', 'Australian Dollar'),
(11, 'AWG', 'Aruban Florin'),
(12, 'BBD', 'Barbados Dollar'),
(13, 'BDT', 'Bangladeshi Taka'),
(15, 'BGL', 'Bulgarian Lev'),
(16, 'BHD', 'Bahraini Dinar'),
(17, 'BIF', 'Burundi Franc'),
(18, 'BMD', 'Bermudian Dollar'),
(19, 'BND', 'Brunei Dollar'),
(20, 'BOB', 'Bolivian Boliviano'),
(21, 'BRL', 'Brazilian Real'),
(22, 'BSD', 'Bahamian Dollar'),
(23, 'BTN', 'Bhutan Ngultrum'),
(24, 'BWP', 'Botswana Pula'),
(25, 'BZD', 'Belize Dollar'),
(26, 'CAD', 'Canadian Dollar'),
(27, 'CHF', 'Swiss Franc'),
(28, 'CLP', 'Chilean Peso'),
(29, 'CNY', 'Chinese Yuan Renminbi'),
(30, 'COP', 'Colombian Peso'),
(31, 'CRC', 'Costa Rican Colon'),
(32, 'CUP', 'Cuban Peso'),
(33, 'CVE', 'Cape Verde Escudo'),
(34, 'CYP', 'Cyprus Pound'),
(37, 'DJF', 'Djibouti Franc'),
(38, 'DKK', 'Danish Krona'),
(39, 'DOP', 'Dominican Peso'),
(40, 'DZD', 'Algerian Dinar'),
(41, 'ECS', 'Ecuador Sucre'),
(42, 'EUR', 'Euro'),
(43, 'EEK', 'Estonian Krona'),
(44, 'EGP', 'Egyptian Pound'),
(46, 'ETB', 'Ethiopian Birr'),
(48, 'FJD', 'Fiji Dollar'),
(49, 'FKP', 'Falkland Islands Pound'),
(51, 'GBP', 'Pound Sterling'),
(52, 'GHC', 'Ghanaian Cedi'),
(53, 'GIP', 'Gibraltar Pound'),
(54, 'GMD', 'Gambian Dalasi'),
(55, 'GNF', 'Guinea Franc'),
(57, 'GTQ', 'Guatemalan Quetzal'),
(58, 'GYD', 'Guyanan Dollar'),
(59, 'HKD', 'Hong Kong Dollar'),
(60, 'HNL', 'Honduran Lempira'),
(61, 'HRK', 'Croatian Kuna'),
(62, 'HTG', 'Haitian Gourde'),
(63, 'HUF', 'Hungarian Forint'),
(64, 'IDR', 'Indonesian Rupiah'),
(66, 'ILS', 'Israeli New Shekel'),
(67, 'INR', 'Indian Rupee'),
(68, 'IQD', 'Iraqi Dinar'),
(69, 'IRR', 'Iranian Rial'),
(70, 'ISK', 'Iceland Krona'),
(72, 'JMD', 'Jamaican Dollar'),
(73, 'JOD', 'Jordanian Dinar'),
(74, 'JPY', 'Japanese Yen'),
(75, 'KES', 'Kenyan Shilling'),
(76, 'KHR', 'Kampuchean Riel'),
(77, 'KMF', 'Comoros Franc'),
(78, 'KPW', 'North Korean Won'),
(79, 'KRW', 'Korean Won'),
(80, 'KWD', 'Kuwaiti Dinar'),
(81, 'KYD', 'Cayman Islands Dollar'),
(82, 'KZT', 'Kazakhstan Tenge'),
(83, 'LAK', 'Lao Kip'),
(84, 'LBP', 'Lebanese Pound'),
(85, 'LKR', 'Sri Lanka Rupee'),
(86, 'LRD', 'Liberian Dollar'),
(87, 'LSL', 'Lesotho Loti'),
(88, 'LTL', 'Lithuanian Litas'),
(90, 'LVL', 'Latvian Lats'),
(91, 'LYD', 'Libyan Dinar'),
(92, 'MAD', 'Moroccan Dirham'),
(93, 'MGF', 'Malagasy Franc'),
(94, 'MMK', 'Myanmar Kyat'),
(95, 'MNT', 'Mongolian Tugrik'),
(96, 'MOP', 'Macau Pataca'),
(97, 'MRO', 'Mauritanian Ouguiya'),
(98, 'MTL', 'Maltese Lira'),
(99, 'MUR', 'Mauritius Rupee'),
(100, 'MVR', 'Maldive Rufiyaa'),
(101, 'MWK', 'Malawi Kwacha'),
(102, 'MXN', 'Mexican New Peso'),
(103, 'MYR', 'Malaysian Ringgit'),
(104, 'MZM', 'Mozambique Metical'),
(105, 'NAD', 'Namibia Dollar'),
(106, 'NGN', 'Nigerian Naira'),
(107, 'NIO', 'Nicaraguan Cordoba Oro'),
(109, 'NOK', 'Norwegian Krona'),
(110, 'NPR', 'Nepalese Rupee'),
(111, 'NZD', 'New Zealand Dollar'),
(112, 'OMR', 'Omani Rial'),
(113, 'PAB', 'Panamanian Balboa'),
(114, 'PEN', 'Peruvian Nuevo Sol'),
(115, 'PGK', 'Papua New Guinea Kina'),
(116, 'PHP', 'Philippine Peso'),
(117, 'PKR', 'Pakistan Rupee'),
(118, 'PLN', 'Polish Zloty'),
(120, 'PYG', 'Paraguay Guarani'),
(121, 'QAR', 'Qatari Rial'),
(122, 'ROL', 'Romanian Leu'),
(123, 'RUB', 'Russian Rouble'),
(125, 'SBD', 'Solomon Islands Dollar'),
(126, 'SCR', 'Seychelles Rupee'),
(127, 'SDD', 'Sudanese Dinar'),
(128, 'SDP', 'Sudanese Pound'),
(129, 'SEK', 'Swedish Krona'),
(130, 'SKK', 'Slovak Koruna'),
(131, 'SGD', 'Singapore Dollar'),
(132, 'SHP', 'St. Helena Pound'),
(135, 'SLL', 'Sierra Leone Leone'),
(136, 'SOS', 'Somali Shilling'),
(137, 'SRD', 'Surinamese Dollar'),
(138, 'STD', 'Sao Tome/Principe Dobra'),
(139, 'SVC', 'El Salvador Colon'),
(140, 'SYP', 'Syrian Pound'),
(141, 'SZL', 'Swaziland Lilangeni'),
(142, 'THB', 'Thai Baht'),
(143, 'TND', 'Tunisian Dinar'),
(144, 'TOP', 'Tongan Pa\'anga'),
(145, 'TRL', 'Turkish Lira'),
(146, 'TTD', 'Trinidad/Tobago Dollar'),
(147, 'TWD', 'Taiwan Dollar'),
(148, 'TZS', 'Tanzanian Shilling'),
(149, 'UAH', 'Ukraine Hryvnia'),
(150, 'UGX', 'Uganda Shilling'),
(151, 'USD', 'United States Dollar'),
(152, 'UYP', 'Uruguayan Peso'),
(153, 'VEB', 'Venezuelan Bolivar'),
(154, 'VND', 'Vietnamese Dong'),
(155, 'VUV', 'Vanuatu Vatu'),
(156, 'WST', 'Samoan Tala'),
(158, 'XAF', 'CFA Franc BEAC'),
(159, 'XAG', 'Silver (oz.)'),
(160, 'XAU', 'Gold (oz.)'),
(161, 'XCD', 'Eastern Caribbean Dollars'),
(162, 'XOF', 'CFA Franc BCEAO'),
(163, 'XPD', 'Palladium (oz.)'),
(164, 'XPF', 'CFP Franc'),
(165, 'XPT', 'Platinum (oz.)'),
(166, 'YER', 'Yemeni Riyal'),
(167, 'YUM', 'Yugoslavian Dinar'),
(168, 'ZAR', 'South African Rand'),
(169, 'ZRN', 'New Zaire'),
(170, 'ZWD', 'Zimbabwe Dollar'),
(171, 'CZK', 'Czech Koruna'),
(172, 'MXP', 'Mexican Peso'),
(173, 'SAR', 'Saudi Arabia Riyal'),
(175, 'YUN', 'Yugoslav Dinar'),
(176, 'ZMK', 'Zambian Kwacha'),
(177, 'ARP', 'Argentina Pesos'),
(179, 'XDR', 'IMF Special Drawing Right'),
(180, 'RUR', 'Russia Rubles');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department`, `created_at`, `updated_at`) VALUES
(1, 'Web Department', NULL, NULL),
(2, 'IT Management', NULL, NULL),
(3, 'Marketing', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `name`) VALUES
(1, 'AU CAMEROUN'),
(2, 'EN AFRIQUE'),
(3, 'ABROAD (OUTSIDE AFRICA)');

-- --------------------------------------------------------

--
-- Table structure for table `document_logs`
--

CREATE TABLE `document_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `policy_id` bigint(20) UNSIGNED NOT NULL,
  `policy_name` varchar(255) NOT NULL,
  `uploaded_file_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `educations`
--

CREATE TABLE `educations` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `educations`
--

INSERT INTO `educations` (`id`, `name`, `description`) VALUES
(1, 'Bachelors Degree', 'Bachelors Degree'),
(2, 'Diploma', 'Diploma'),
(3, 'Masters Degree', 'Masters Degree'),
(4, 'Doctorate', 'Doctorate');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `salary_group_id` bigint(20) DEFAULT 2,
  `olm_id` varchar(255) DEFAULT NULL,
  `workstation_id` varchar(255) DEFAULT NULL,
  `registration_no` varchar(255) DEFAULT NULL,
  `cnps_no` varchar(255) DEFAULT NULL,
  `niu` varchar(255) DEFAULT NULL,
  `first_name` varchar(100) NOT NULL DEFAULT '',
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `nationality` bigint(20) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `employee_number` varchar(200) DEFAULT NULL,
  `aadhaar_number` bigint(20) DEFAULT NULL,
  `fathers_name` varchar(255) DEFAULT NULL,
  `mothers_name` varchar(255) DEFAULT NULL,
  `spouse_name` varchar(255) DEFAULT NULL,
  `emergency_contact_name` varchar(200) DEFAULT NULL,
  `emergency_contact_number` varchar(50) DEFAULT NULL,
  `employee_ctc` bigint(20) DEFAULT NULL,
  `for_country` enum('in','ca') NOT NULL DEFAULT 'ca',
  `marital_status` enum('Married','Single','Divorced','Widowed','Other') DEFAULT NULL,
  `ssn_num` varchar(100) DEFAULT NULL,
  `nic_num` varchar(100) DEFAULT NULL,
  `other_id` varchar(100) DEFAULT NULL,
  `driving_license` varchar(100) DEFAULT NULL,
  `driving_license_exp_date` date DEFAULT NULL,
  `employment_status` bigint(20) DEFAULT NULL,
  `job_title` bigint(20) DEFAULT NULL,
  `work_station_id` varchar(100) DEFAULT NULL,
  `address1` varchar(100) DEFAULT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `city` varchar(150) DEFAULT NULL,
  `country` int(10) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `home_phone` varchar(50) DEFAULT NULL,
  `mobile_phone` varchar(50) DEFAULT NULL,
  `work_phone` varchar(50) DEFAULT NULL,
  `work_email` varchar(100) DEFAULT NULL,
  `private_email` varchar(100) DEFAULT NULL,
  `joined_date` date DEFAULT NULL,
  `confirmation_date` date DEFAULT NULL,
  `supervisor` bigint(20) UNSIGNED DEFAULT NULL,
  `indirect_supervisors` varchar(250) DEFAULT NULL,
  `department` bigint(20) UNSIGNED DEFAULT NULL,
  `termination_date` date DEFAULT NULL,
  `contract_type` varchar(100) DEFAULT NULL,
  `probation_period` varchar(100) DEFAULT NULL,
  `salary_on_contract` varchar(100) DEFAULT NULL,
  `role_id` int(10) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `status` enum('Active','Terminated') DEFAULT 'Active',
  `ethnicity` bigint(20) DEFAULT NULL,
  `immigration_status` bigint(20) DEFAULT NULL,
  `approver1` bigint(20) UNSIGNED DEFAULT NULL,
  `approver2` bigint(20) UNSIGNED DEFAULT NULL,
  `approver3` bigint(20) UNSIGNED DEFAULT NULL,
  `division_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `travel_category_allowance_id` bigint(20) UNSIGNED DEFAULT NULL,
  `basic_salary` int(255) DEFAULT NULL,
  `airtel_employee_id` varchar(255) DEFAULT NULL,
  `airtel_employee_email_id` varchar(255) DEFAULT NULL,
  `airtel_employee_mobile_number` varchar(255) DEFAULT NULL,
  `airtel_employee_circle` varchar(255) DEFAULT NULL,
  `vendor_name` varchar(255) DEFAULT NULL,
  `partner_type` varchar(255) DEFAULT NULL,
  `registered_corporate_address` varchar(255) DEFAULT NULL,
  `current_location` varchar(255) DEFAULT NULL,
  `airtel_partner_code` varchar(255) DEFAULT NULL,
  `circle_id` int(10) DEFAULT NULL,
  `function_id` int(10) DEFAULT NULL,
  `name_of_airtel_employee` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_id`, `salary_group_id`, `olm_id`, `workstation_id`, `registration_no`, `cnps_no`, `niu`, `first_name`, `middle_name`, `last_name`, `nationality`, `birthday`, `gender`, `employee_number`, `aadhaar_number`, `fathers_name`, `mothers_name`, `spouse_name`, `emergency_contact_name`, `emergency_contact_number`, `employee_ctc`, `for_country`, `marital_status`, `ssn_num`, `nic_num`, `other_id`, `driving_license`, `driving_license_exp_date`, `employment_status`, `job_title`, `work_station_id`, `address1`, `address2`, `city`, `country`, `postal_code`, `home_phone`, `mobile_phone`, `work_phone`, `work_email`, `private_email`, `joined_date`, `confirmation_date`, `supervisor`, `indirect_supervisors`, `department`, `termination_date`, `contract_type`, `probation_period`, `salary_on_contract`, `role_id`, `notes`, `status`, `ethnicity`, `immigration_status`, `approver1`, `approver2`, `approver3`, `division_id`, `category_id`, `travel_category_allowance_id`, `basic_salary`, `airtel_employee_id`, `airtel_employee_email_id`, `airtel_employee_mobile_number`, `airtel_employee_circle`, `vendor_name`, `partner_type`, `registered_corporate_address`, `current_location`, `airtel_partner_code`, `circle_id`, `function_id`, `name_of_airtel_employee`) VALUES
(4, 60, 3, '89IJYHS6', 'OPUI98', '2322', '23de', 'rewwe', 'Admin', 'null', 'one', 1, '2025-01-21', 'Male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ca', 'Married', NULL, 'fd', 'df', 'sedrf', '2025-01-21', 2, 2, 'nil', 'null', 'null', 'null', 3, NULL, 'null', 'null', 'null', 'admin@gmail.com', 'null', '2025-01-21', '2025-01-23', NULL, NULL, 2, '2025-01-21', NULL, NULL, NULL, 1, NULL, 'Active', 4, 1, 60, NULL, NULL, 2, 1, 67, 676343, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 96, 3, 'RS289', 'null', 'RS289', 'CNPS289', 'NIU289', 'Anuj', 'null', 'Bisht', 1, '2025-02-28', 'Male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ca', 'Married', NULL, 'null', 'null', 'null', '2025-04-29', 2, 1, 'nil', 'null', 'null', 'null', 2, 'null', 'null', 'null', '9876543211', 'anuj@gmail.com', 'null', '2025-04-01', '2025-04-15', NULL, NULL, 1, NULL, NULL, NULL, NULL, 4, NULL, 'Active', 1, 1, 60, NULL, NULL, 1, 1, 1, 64928, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 97, 3, 'RS2899', 'null', 'RS2899', 'CNPS2899', 'NIU2899', 'Steve', 'null', 'Leurt', 1, '2025-04-15', 'Female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ca', 'Married', NULL, 'null', 'null', 'null', '2025-04-29', 1, 1, 'nil', 'null', 'null', 'null', 99, NULL, 'null', 'null', '9898978787', 'sankavi@gmail.com', 'null', '2025-04-01', '2025-04-29', NULL, NULL, 1, NULL, NULL, NULL, NULL, 5, NULL, 'Active', 4, 1, 96, NULL, NULL, 1, 4, 61, 560394, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 98, 3, 'RS909', 'null', 'RS9099', 'CNPS2999', 'NIU299', 'Harsh', 'null', 'Tyagi', 1, '2025-04-01', 'Male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ca', 'Single', NULL, 'null', 'null', 'null', '2025-04-29', 2, 1, 'nil', 'null', 'null', 'null', 4, 'null', 'null', 'null', '7878754542', 'harsh@gmail.com', 'null', '2025-04-30', '2025-04-30', NULL, NULL, 1, NULL, NULL, NULL, NULL, 3, NULL, 'Active', 1, 4, 96, NULL, NULL, 1, 1, 9, 86967, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 99, 3, 'RS782', 'null', 'RS8u82', 'cnps28', 'niu72', 'Prabhat', 'null', 'Mehra', 1, '2025-04-01', 'Male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ca', 'Married', NULL, 'null', 'null', 'null', '2025-04-29', 6, 1, 'nil', 'null', 'null', 'null', 99, 'null', 'null', 'null', '8654312345', 'prabhat@gmail.com', 'null', '2025-04-01', '2025-04-23', NULL, NULL, 1, NULL, NULL, NULL, NULL, 6, NULL, 'Active', 1, 1, 96, NULL, NULL, 1, 4, 63, 606943, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 100, 3, 'YUY7882', 'null', '9899GH', 'CNPS8822', 'NIU911', 'Sankavi', 'null', 'Ravi', 1, '2024-11-08', 'Female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ca', 'Married', NULL, 'null', 'null', 'null', '2025-04-29', 1, 3, 'nil', 'null', 'null', 'null', 110, 'null', 'null', 'null', '7821212121', 'sankavi@gmail.com', 'null', '2025-04-03', '2025-06-11', NULL, NULL, 1, NULL, NULL, NULL, NULL, 3, NULL, 'Active', 4, 1, 96, NULL, NULL, 1, 1, 68, 699537, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(44, 106, 3, '89IJYHS6sss', 'null', '98765e', '4567890', '98765', 'sarthak', 'null', 'Kaul', 1, '2025-05-14', 'Male', 'RS999', 23456789, NULL, NULL, NULL, NULL, NULL, 12000, 'ca', 'Married', NULL, 'null', 'null', 'null', NULL, 1, 2, 'nil', 'null', 'null', 'null', 2, 'null', 'null', 'null', '987654321', 'vishal556@rediansoftware.com', 'null', '2025-05-13', '2025-05-14', 96, NULL, 1, NULL, NULL, NULL, NULL, 3, NULL, 'Active', NULL, 1, 60, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 111, 3, 'jhgfd', 'null', 'hgfds', 'sdfghj', 'fghjkl', 'gfds', 'null', 'vcxxdf', 1, '2025-05-09', 'Male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ca', 'Married', NULL, 'null', 'null', 'null', '2025-05-09', 1, 1, 'nil', 'null', 'null', 'null', 99, 'null', 'null', 'null', '9876543331', 'nnnnxn@gmail.com', 'null', '2025-05-16', '2025-05-16', NULL, NULL, 1, NULL, NULL, NULL, NULL, 3, NULL, 'Active', NULL, 1, 60, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 112, 3, 'mnbvcxz', 'null', 'zxcvbnm', 'poiuytrewq', 'asdfghjkl', 'lplpl', 'null', 'awserr', 1, '2025-05-09', 'Male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ca', 'Married', NULL, 'null', 'null', 'null', '2025-05-09', 1, 1, 'nil', 'null', 'null', 'null', 2, 'null', 'null', 'null', '6767454523', 'plpl@gmail.com', 'null', '2025-05-08', '2025-05-16', NULL, NULL, 1, NULL, NULL, NULL, NULL, 2, NULL, 'Active', NULL, 1, 96, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(53, 120, 3, 'parhbat9992', 'null', '8889993SS', 'HGGS332', '9002', 'Neha', 'null', 'Rawat', 1, '2025-05-21', 'Female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ca', 'Married', NULL, 'null', 'null', 'null', '2025-05-21', 3, 1, 'nil', 'null', 'null', 'null', 99, 'null', 'null', 'null', '9876543456', 'neha@gmail.com', 'null', '2025-05-01', '2025-05-21', NULL, NULL, 1, NULL, NULL, NULL, NULL, 3, NULL, 'Active', NULL, 1, 99, NULL, NULL, 2, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(54, 121, 3, 'NHHHS77882', 'null', 'HHHJJSU', 'BGHS77', 'KJJJS882', 'Vishnu', 'null', 'Kumar', 1, '2025-05-01', 'Male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ca', 'Married', NULL, 'null', 'null', 'null', '2025-05-21', 2, 2, 'nil', 'null', 'null', 'null', 1, 'null', 'null', 'null', '987654321', 'kumar@gmail.com', 'null', '2025-05-01', '2025-05-09', NULL, NULL, 2, NULL, NULL, NULL, NULL, 3, NULL, 'Active', NULL, 1, 96, NULL, NULL, 1, 2, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(55, 122, 3, 'test11', 'null', 'test11', 'testcnpp', 'testniutestt', 'testt', 'null', 'onee', 1, '2025-05-22', 'Female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ca', 'Married', NULL, 'null', 'null', 'null', '2025-05-22', 6, 14, 'nil', 'null', 'null', 'null', 2, NULL, 'null', 'null', '876543222', 'testt@gmail.com', 'null', '2025-05-23', '2025-05-24', NULL, NULL, 3, NULL, NULL, NULL, NULL, 3, NULL, 'Active', NULL, 3, 60, NULL, NULL, 2, 3, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees_training`
--

CREATE TABLE `employees_training` (
  `id` bigint(20) NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `training_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees_training`
--

INSERT INTO `employees_training` (`id`, `employee_id`, `training_id`) VALUES
(10, 37, 35),
(11, 39, 35);

-- --------------------------------------------------------

--
-- Table structure for table `employee_annual_leaves`
--

CREATE TABLE `employee_annual_leaves` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `year` int(255) NOT NULL,
  `loss_of_pay` int(10) NOT NULL DEFAULT 0,
  `comp_off` int(10) NOT NULL DEFAULT 0,
  `annual_leave` int(10) NOT NULL DEFAULT 0,
  `work_from_home` int(10) NOT NULL DEFAULT 0,
  `sick_leave` int(10) NOT NULL DEFAULT 0,
  `restrict_leave` int(10) DEFAULT 0,
  `total_annual_leave` int(10) NOT NULL DEFAULT 0,
  `total_wfh` int(10) NOT NULL DEFAULT 0,
  `total_sick_leave` int(10) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_annual_leaves`
--

INSERT INTO `employee_annual_leaves` (`id`, `user_id`, `year`, `loss_of_pay`, `comp_off`, `annual_leave`, `work_from_home`, `sick_leave`, `restrict_leave`, `total_annual_leave`, `total_wfh`, `total_sick_leave`, `created_at`, `updated_at`) VALUES
(4, 60, 2025, 0, 0, 0, 0, 0, 2, 3, 10, 0, '2025-02-13 06:53:52', '2025-05-13 05:57:41'),
(17, 96, 2025, 0, 0, 0, 0, 0, 2, 3, 10, 1, '2025-04-29 13:56:08', '2025-04-29 13:56:08'),
(18, 97, 2025, 0, 0, 0, 0, 0, 2, 3, 10, 1, '2025-04-29 13:57:54', '2025-04-29 13:57:54'),
(19, 98, 2025, 0, 0, 0, 0, 0, 2, 3, 10, 1, '2025-04-29 13:59:34', '2025-05-13 05:57:25'),
(20, 99, 2025, 0, 0, 0, 0, 0, 2, 3, 10, 1, '2025-04-29 14:17:09', '2025-04-29 14:17:09'),
(21, 100, 2025, 0, 0, 0, 4, 1, 0, 3, 6, 0, '2025-04-29 14:24:57', '2025-05-14 08:04:39'),
(23, 106, 2025, 0, 0, 0, 0, 0, 2, 3, 10, 1, '2025-04-30 08:50:24', '2025-05-14 04:39:45'),
(24, 111, 2025, 0, 0, 0, 0, 0, 2, 3, 10, 1, '2025-05-09 06:50:50', '2025-05-09 06:50:50'),
(26, 120, 2025, 0, 0, 0, 0, 0, 2, 3, 10, 1, '2025-05-21 10:20:15', '2025-05-21 10:20:15'),
(27, 121, 2025, 0, 0, 0, 0, 0, 2, 3, 10, 1, '2025-05-21 11:10:00', '2025-05-21 11:10:00'),
(28, 122, 2025, 0, 0, 0, 0, 0, 2, 3, 10, 1, '2025-05-22 09:58:39', '2025-05-22 09:58:39');

-- --------------------------------------------------------

--
-- Table structure for table `employee_leave_logs`
--

CREATE TABLE `employee_leave_logs` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `year` int(255) NOT NULL,
  `loss_of_pay` int(10) NOT NULL DEFAULT 0,
  `comp_off` int(10) NOT NULL DEFAULT 0,
  `annual_leave` int(10) NOT NULL DEFAULT 0,
  `work_from_home` int(10) NOT NULL DEFAULT 0,
  `sick_leave` int(10) NOT NULL DEFAULT 0,
  `total_annual_leave` int(10) NOT NULL DEFAULT 0,
  `total_wfh` int(10) NOT NULL DEFAULT 0,
  `total_sick_leave` int(10) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_loans`
--

CREATE TABLE `employee_loans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `loan_id` bigint(20) UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `last_installment_date` date NOT NULL,
  `period_months` bigint(20) NOT NULL,
  `currency_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `monthly_installment` decimal(10,2) NOT NULL,
  `status` varchar(255) DEFAULT 'Approved',
  `details` varchar(255) DEFAULT NULL,
  `approver1` bigint(20) UNSIGNED NOT NULL,
  `approver2` bigint(20) UNSIGNED NOT NULL,
  `approver3` bigint(20) UNSIGNED NOT NULL,
  `approve1` int(2) DEFAULT NULL,
  `approve2` int(2) DEFAULT NULL,
  `approve3` int(2) DEFAULT NULL,
  `reject_reason` longtext DEFAULT NULL,
  `loan_status` varchar(255) DEFAULT NULL,
  `who_reject` bigint(20) DEFAULT NULL,
  `is_reject` tinyint(2) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_payslip`
--

CREATE TABLE `employee_payslip` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `year` int(255) NOT NULL,
  `current_month` varchar(255) NOT NULL,
  `released_date` date NOT NULL,
  `total_deduction` float DEFAULT NULL,
  `gross_salary` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_payslip`
--

INSERT INTO `employee_payslip` (`id`, `employee_id`, `year`, `current_month`, `released_date`, `total_deduction`, `gross_salary`) VALUES
(43, 4, 2025, '3', '2025-05-13', 3787, 95833),
(44, 45, 2025, '4', '2025-05-13', 3787, 95833),
(45, 41, 2025, '2', '2025-05-13', 3787, 90000),
(47, 54, 2025, '5', '2025-05-21', 3787, 50000),
(48, 39, 2025, '1', '2025-05-05', 124, 9670),
(49, 44, 2025, '2', '2025-05-11', 1200, 9000),
(50, 39, 2024, '12', '2025-05-05', 124, 9635),
(51, 44, 2024, '11', '2025-05-11', 1200, 12000),
(52, 4, 2024, '11', '2025-05-05', 80, 8000);

-- --------------------------------------------------------

--
-- Table structure for table `employee_payslip_categories`
--

CREATE TABLE `employee_payslip_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `basic_salary` int(255) NOT NULL,
  `overpayment` int(20) NOT NULL DEFAULT 0,
  `good_seperation_bonus` int(20) NOT NULL DEFAULT 0,
  `pes_separation_allowance` int(20) NOT NULL DEFAULT 0,
  `absence` int(20) NOT NULL DEFAULT 0,
  `responsibility_bonus` int(20) NOT NULL DEFAULT 0,
  `seniority_bonus` int(20) NOT NULL DEFAULT 0,
  `attendance_bonus` int(20) NOT NULL DEFAULT 0,
  `performance_bonus` int(20) NOT NULL DEFAULT 0,
  `cash_bonus` int(20) NOT NULL DEFAULT 0,
  `housing_allowance` int(20) NOT NULL DEFAULT 0,
  `transport_allowance` int(20) NOT NULL DEFAULT 0,
  `electricity` int(20) NOT NULL DEFAULT 0,
  `water` int(20) NOT NULL DEFAULT 0,
  `cost_of_representation` int(20) NOT NULL DEFAULT 0,
  `milk_bonus` int(20) NOT NULL DEFAULT 0,
  `dirt_premium` int(20) NOT NULL DEFAULT 0,
  `domestic` int(20) NOT NULL DEFAULT 0,
  `benefit_water` int(20) NOT NULL DEFAULT 0,
  `food` int(20) NOT NULL DEFAULT 0,
  `thirteen_month` int(20) NOT NULL DEFAULT 0,
  `leave_1` int(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_payslip_categories`
--

INSERT INTO `employee_payslip_categories` (`id`, `category_name`, `basic_salary`, `overpayment`, `good_seperation_bonus`, `pes_separation_allowance`, `absence`, `responsibility_bonus`, `seniority_bonus`, `attendance_bonus`, `performance_bonus`, `cash_bonus`, `housing_allowance`, `transport_allowance`, `electricity`, `water`, `cost_of_representation`, `milk_bonus`, `dirt_premium`, `domestic`, `benefit_water`, `food`, `thirteen_month`, `leave_1`) VALUES
(1, '1A', 64928, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, '1B', 67338, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, '1C', 69749, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, '1D', 72168, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, '1E', 74588, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6, '1F', 76999, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(7, '2A', 76999, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(8, '2B', 81977, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(9, '2C', 86967, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(10, '2D', 91944, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(11, '2E', 96934, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(12, '2F', 101910, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(13, '3A', 100123, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(14, '3B', 108876, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(15, '3C', 117626, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(16, '3D', 126379, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(17, '3E', 135131, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(18, '3F', 143881, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(19, '4A', 136533, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(20, '4B', 146541, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 30000, 0, 0, 0, 0, 3055, 0, 0, 0, 0, 0),
(21, '4C', 156535, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(22, '4D', 166541, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(23, '4E', 177527, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(24, '4F', 186536, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(25, '5A', 176805, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 30000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(26, '5B', 187068, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(27, '5C', 197332, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(28, '5D', 207604, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(29, '5E', 217860, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(30, '5F', 228133, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(31, '6A', 220238, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 7325, 0, 0, 0, 0, 0, 0),
(32, '6B', 231570, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(33, '6C', 242909, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(34, '6D', 254237, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(35, '6E', 265578, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(36, '6F', 276909, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(37, '7A', 219265, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(38, '7B', 236612, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(39, '7C', 253941, 0, 0, 0, 0, 0, 0, 0, 0, 0, 30000, 30000, 15000, 10000, 0, 0, 0, 0, 0, 0, 0, 0),
(40, '7D', 271290, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(41, '7E', 288619, 0, 0, 0, 0, 0, 0, 14250, 0, 12000, 0, 30000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(42, '7F', 305966, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(43, '8A', 305966, 0, 0, 0, 0, 0, 0, 0, 0, 0, 14250, 30000, 7000, 5000, 0, 0, 0, 0, 0, 0, 0, 0),
(44, '8B', 326360, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(45, '8C', 346755, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(46, '8D', 367151, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(47, '8E', 387545, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(48, '8F', 407932, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(49, '9A', 386410, 0, 0, 0, 0, 0, 0, 0, 0, 0, 26262, 30000, 15000, 10000, 0, 0, 0, 0, 0, 0, 0, 0),
(50, '9B', 420218, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(51, '9C', 454032, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(52, '9D', 487838, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(53, '9E', 521654, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(54, '9F', 555468, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(55, '10A', 444450, 0, 0, 0, 0, 100000, 0, 30000, 0, 0, 91670, 30000, 25000, 15000, 0, 0, 0, 0, 0, 0, 0, 0),
(56, '10B', 467644, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(57, '10C', 490821, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(58, '10D', 514015, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(59, '10E', 537200, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(60, '10F', 560394, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(61, '11A', 560394, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(62, '11B', 583590, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(63, '11C', 606943, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(64, '11D', 629961, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(65, '11E', 653147, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(66, '11F', 676343, 0, 0, 0, 0, 150000, 0, 0, 0, 0, 114520, 30000, 30000, 20000, 0, 0, 0, 0, 0, 0, 0, 0),
(67, '12A', 676343, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(68, '12B', 699537, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(69, '12C', 722732, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(70, '12D', 745917, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(71, '12E', 769102, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(72, '12F', 792296, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `employee_payslip_components`
--

CREATE TABLE `employee_payslip_components` (
  `id` bigint(20) NOT NULL,
  `employee_payslip_id` bigint(20) UNSIGNED DEFAULT NULL,
  `component_id` bigint(20) NOT NULL,
  `amount` float NOT NULL,
  `type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_payslip_components`
--

INSERT INTO `employee_payslip_components` (`id`, `employee_payslip_id`, `component_id`, `amount`, `type`) VALUES
(9, 43, 4, 33541.6, 'earning'),
(10, 43, 7, 4024.99, 'earning'),
(11, 43, 6, 6708.31, 'earning'),
(12, 43, 8, 31433.2, 'earning'),
(13, 43, 5, 20124.9, 'earning'),
(14, 43, 9, 187, 'deduction'),
(15, 43, 10, 1800, 'deduction'),
(16, 43, 11, 1800, 'deduction'),
(17, 44, 4, 33541.6, 'earning'),
(18, 44, 7, 4024.99, 'earning'),
(19, 44, 6, 6708.31, 'earning'),
(20, 44, 8, 31433.2, 'earning'),
(21, 44, 5, 20124.9, 'earning'),
(22, 44, 9, 187, 'deduction'),
(23, 44, 10, 1800, 'deduction'),
(24, 44, 11, 1800, 'deduction'),
(33, 45, 4, 31500, 'earning'),
(34, 45, 7, 3780, 'earning'),
(35, 45, 6, 6300, 'earning'),
(36, 45, 8, 29520, 'earning'),
(37, 45, 5, 18900, 'earning'),
(38, 45, 9, 187, 'deduction'),
(39, 45, 10, 1800, 'deduction'),
(40, 45, 11, 1800, 'deduction'),
(49, 47, 4, 17500, 'earning'),
(50, 47, 7, 2100, 'earning'),
(51, 47, 6, 3500, 'earning'),
(52, 47, 8, 16400, 'earning'),
(53, 47, 5, 10500, 'earning'),
(54, 47, 9, 187, 'deduction'),
(55, 47, 10, 1800, 'deduction'),
(56, 47, 11, 1800, 'deduction');

-- --------------------------------------------------------

--
-- Table structure for table `employee_projects`
--

CREATE TABLE `employee_projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `details` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employment_status`
--

CREATE TABLE `employment_status` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `employment_status`
--

INSERT INTO `employment_status` (`id`, `name`, `description`) VALUES
(1, 'Full Time Contract', 'Full Time Contract'),
(2, 'Full Time Internship', 'Full Time Internship'),
(3, 'Full Time Permanent', 'Full Time Permanent'),
(4, 'Part Time Contract', 'Part Time Contract'),
(5, 'Part Time Internship', 'Part Time Internship'),
(6, 'Part Time Permanent', 'Part Time Permanent');

-- --------------------------------------------------------

--
-- Table structure for table `ethnicities`
--

CREATE TABLE `ethnicities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `event_start_date` datetime NOT NULL,
  `event_end_date` datetime NOT NULL,
  `event_title` longtext NOT NULL,
  `event_color` varchar(255) NOT NULL DEFAULT '#000000',
  `event_description` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `department_id`, `event_start_date`, `event_end_date`, `event_title`, `event_color`, `event_description`) VALUES
(11, 1, '2025-05-21 11:40:00', '2025-05-24 11:40:00', 'Laravel Job', '#97b597', 'Laravel Description'),
(12, 2, '2025-05-21 15:12:00', '2025-05-23 15:12:00', 'Angular & node event', '#2d3cae', 'Test Description');

-- --------------------------------------------------------

--
-- Table structure for table `event_users`
--

CREATE TABLE `event_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_users`
--

INSERT INTO `event_users` (`id`, `event_id`, `user_id`) VALUES
(16, 11, 97),
(17, 11, 96),
(18, 12, 121);

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
-- Table structure for table `help_desk_request`
--

CREATE TABLE `help_desk_request` (
  `id` bigint(20) NOT NULL,
  `request_category` varchar(100) NOT NULL,
  `request_subject` varchar(255) NOT NULL,
  `request_description` varchar(400) NOT NULL,
  `request_priority` varchar(100) NOT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_mime` varchar(255) DEFAULT NULL,
  `file` longtext DEFAULT NULL,
  `req_resolved_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=active,1=closed',
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_holiday` varchar(255) DEFAULT NULL,
  `date_holiday` varchar(255) DEFAULT NULL,
  `import_from` int(11) DEFAULT NULL,
  `import_to` int(11) DEFAULT NULL,
  `is_restrict` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`id`, `name_holiday`, `date_holiday`, `import_from`, `import_to`, `is_restrict`, `created_at`, `updated_at`) VALUES
(41, 'Pongal', '2025-04-12', NULL, NULL, 0, '2025-04-01 11:41:27', '2025-04-01 11:41:27'),
(42, 'Holi', '2025-05-03', NULL, NULL, 0, '2025-04-01 11:42:23', '2025-04-01 11:42:23'),
(43, 'id ul juha', '2025-04-12', NULL, NULL, 1, '2025-04-01 11:45:24', '2025-04-01 11:45:24'),
(44, 'Navratri', '2025-04-10', NULL, NULL, 1, '2025-04-01 11:45:24', '2025-04-01 11:45:24'),
(45, 'Gandhi jayanti', '2025-10-02', NULL, NULL, 0, '2025-04-01 11:45:24', '2025-04-01 11:45:24'),
(46, 'christmas', '2025-12-25', NULL, NULL, 0, '2025-04-01 11:45:24', '2025-04-01 11:45:24'),
(47, 'Dhanteras', '2025-10-17', NULL, NULL, 1, '2025-04-01 11:45:24', '2025-04-01 11:45:24'),
(48, 'Choti Diwali', '2025-10-24', NULL, NULL, 1, '2025-04-01 11:45:24', '2025-04-01 11:45:24'),
(49, 'Diwali', '2025-10-11', NULL, NULL, 0, '2025-04-01 11:45:24', '2025-04-01 11:45:24'),
(50, 'diwali', '2025-04-30', NULL, NULL, 1, '2025-04-02 14:16:26', '2025-04-02 14:16:26'),
(51, 'republic day', '2025-01-26', NULL, NULL, 0, '2025-04-02 14:17:44', '2025-04-02 14:17:44');

-- --------------------------------------------------------

--
-- Table structure for table `immigration_status`
--

CREATE TABLE `immigration_status` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `immigration_status`
--

INSERT INTO `immigration_status` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Citizen', '2025-01-11 11:21:34', '2025-01-11 11:21:34'),
(2, 'Permanent Residence', '2025-01-11 11:21:47', '2025-01-11 11:21:47'),
(3, 'Work Permit Holder', '2025-01-11 11:22:06', '2025-01-11 11:22:06'),
(4, 'dependent Pass Holder', '2025-01-11 11:24:44', '2025-01-11 11:24:44');

-- --------------------------------------------------------

--
-- Table structure for table `indicator_form`
--

CREATE TABLE `indicator_form` (
  `id` bigint(20) NOT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `job_title_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `indicator_form`
--

INSERT INTO `indicator_form` (`id`, `department_id`, `job_title_id`, `created_at`, `updated_at`) VALUES
(2, 1, 1, '2025-05-22 06:22:44', '2025-05-22 06:22:44');

-- --------------------------------------------------------

--
-- Table structure for table `indicator_sub_title`
--

CREATE TABLE `indicator_sub_title` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_title` varchar(255) NOT NULL,
  `title_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `indicator_sub_title`
--

INSERT INTO `indicator_sub_title` (`id`, `sub_title`, `title_id`, `created_at`, `updated_at`) VALUES
(4, 'Skills (livewire)', 2, '2025-05-22 06:22:44', '2025-05-22 06:22:44'),
(5, 'Skills (pinia)', 3, '2025-05-22 06:22:44', '2025-05-22 06:22:44');

-- --------------------------------------------------------

--
-- Table structure for table `indicator_title`
--

CREATE TABLE `indicator_title` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `indicator_form_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `indicator_title`
--

INSERT INTO `indicator_title` (`id`, `title`, `indicator_form_id`, `created_at`, `updated_at`) VALUES
(2, 'Training on Laravel', 2, '2025-05-22 06:22:44', '2025-05-22 06:22:44'),
(3, 'Training on vuejs3', 2, '2025-05-22 06:22:44', '2025-05-22 06:22:44');

-- --------------------------------------------------------

--
-- Table structure for table `job_titles`
--

CREATE TABLE `job_titles` (
  `id` bigint(20) NOT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `code` varchar(10) NOT NULL DEFAULT '',
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `specification` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `job_titles`
--

INSERT INTO `job_titles` (`id`, `department_id`, `code`, `name`, `description`, `specification`) VALUES
(1, 1, 'SE', 'Software Engineer', 'The work of a software engineer typically includes designing and programming system-level software: operating systems, database systems, embedded systems and so on. They understand how both software a', 'Software Engineer'),
(2, 1, 'ASE', 'Assistant Software Engineer', 'Assistant Software Engineer', 'Assistant Software Engineer'),
(3, 2, 'PM', 'Project Manager', 'Project Manager', 'Project Manager'),
(4, 2, 'QAE', 'QA Engineer', 'Quality Assurance Engineer ', 'Quality Assurance Engineer '),
(5, 2, 'PRM', 'Product Manager', 'Product Manager', 'Product Manager'),
(6, 2, 'AQAE', 'Assistant QA Engineer ', 'Assistant QA Engineer ', 'Assistant QA Engineer '),
(7, 2, 'TPM', 'Technical Project Manager', 'Technical Project Manager', 'Technical Project Manager'),
(9, 2, 'ME', 'Marketing Executive', 'Marketing Executive', 'Marketing Executive'),
(10, 1, 'DH', 'Department Head', 'Department Head', 'Department Head'),
(11, 2, 'CEO', 'Chief Executive Officer', 'Chief Executive Officer', 'Chief Executive Officer'),
(12, 1, 'DBE', 'Database Engineer', 'Database Engineer', 'Database Engineer'),
(13, 3, 'SA', 'Server Admin', 'Server Admin', 'Server Admin'),
(14, 1, 'SD', 'Senior Developer', 'Senior Developer Description', 'Senior Developer Description');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `description`) VALUES
(1, 'en', 'English'),
(2, 'fr', 'French'),
(3, 'de', 'German'),
(4, 'zh', 'Chinese'),
(5, 'aa', 'Afar'),
(6, 'ab', 'Abkhaz'),
(7, 'ae', 'Avestan'),
(8, 'af', 'Afrikaans'),
(9, 'ak', 'Akan'),
(10, 'am', 'Amharic'),
(11, 'an', 'Aragonese'),
(12, 'ar', 'Arabic'),
(13, 'as', 'Assamese'),
(14, 'av', 'Avaric'),
(15, 'ay', 'Aymara'),
(16, 'az', 'Azerbaijani'),
(17, 'ba', 'Bashkir'),
(18, 'be', 'Belarusian'),
(19, 'bg', 'Bulgarian'),
(20, 'bh', 'Bihari'),
(21, 'bi', 'Bislama'),
(22, 'bm', 'Bambara'),
(23, 'bn', 'Bengali'),
(24, 'bo', 'Tibetan Standard, Tibetan, Central'),
(25, 'br', 'Breton'),
(26, 'bs', 'Bosnian'),
(27, 'ca', 'Catalan Valencian'),
(28, 'ce', 'Chechen'),
(29, 'ch', 'Chamorro'),
(30, 'co', 'Corsican'),
(31, 'cr', 'Cree'),
(32, 'cs', 'Czech'),
(33, 'cu', 'Old Church Slavonic, Church Slavic, Church Slavonic, Old Bulgarian, Old Slavonic'),
(34, 'cv', 'Chuvash'),
(35, 'cy', 'Welsh'),
(36, 'da', 'Danish'),
(37, 'dv', 'Divehi Dhivehi Maldivian'),
(38, 'dz', 'Dzongkha'),
(39, 'ee', 'Ewe'),
(40, 'el', 'Greek, Modern'),
(41, 'eo', 'Esperanto'),
(42, 'es', 'Spanish'),
(43, 'et', 'Estonian'),
(44, 'eu', 'Basque'),
(45, 'fa', 'Persian'),
(46, 'ff', 'Fula Fulah Pulaar Pular'),
(47, 'fi', 'Finnish'),
(48, 'fj', 'Fijian'),
(49, 'fo', 'Faroese'),
(50, 'fy', 'Western Frisian'),
(51, 'ga', 'Irish'),
(52, 'gd', 'Scottish Gaelic'),
(53, 'gl', 'Galician'),
(54, 'gn', 'GuaranÃ­'),
(55, 'gu', 'Gujarati'),
(56, 'gv', 'Manx'),
(57, 'ha', 'Hausa'),
(58, 'he', 'Hebrew (modern)'),
(59, 'hi', 'Hindi'),
(60, 'ho', 'Hiri Motu'),
(61, 'hr', 'Croatian'),
(62, 'ht', 'Haitian Creole'),
(63, 'hu', 'Hungarian'),
(64, 'hy', 'Armenian'),
(65, 'hz', 'Herero'),
(66, 'ia', 'Interlingua'),
(67, 'id', 'Indonesian'),
(68, 'ie', 'Interlingue'),
(69, 'ig', 'Igbo'),
(70, 'ii', 'Nuosu'),
(71, 'ik', 'Inupiaq'),
(72, 'io', 'Ido'),
(73, 'is', 'Icelandic'),
(74, 'it', 'Italian'),
(75, 'iu', 'Inuktitut'),
(76, 'ja', 'Japanese (ja)'),
(77, 'jv', 'Javanese (jv)'),
(78, 'ka', 'Georgian'),
(79, 'kg', 'Kongo'),
(80, 'ki', 'Kikuyu, Gikuyu'),
(81, 'kj', 'Kwanyama, Kuanyama'),
(82, 'kk', 'Kazakh'),
(83, 'kl', 'Kalaallisut, Greenlandic'),
(84, 'km', 'Khmer'),
(85, 'kn', 'Kannada'),
(86, 'ko', 'Korean'),
(87, 'kr', 'Kanuri'),
(88, 'ks', 'Kashmiri'),
(89, 'ku', 'Kurdish'),
(90, 'kv', 'Komi'),
(91, 'kw', 'Cornish'),
(92, 'ky', 'Kirghiz, Kyrgyz'),
(93, 'la', 'Latin'),
(94, 'lb', 'Luxembourgish, Letzeburgesch'),
(95, 'lg', 'Luganda'),
(96, 'li', 'Limburgish, Limburgan, Limburger'),
(97, 'ln', 'Lingala'),
(98, 'lo', 'Lao'),
(99, 'lt', 'Lithuanian'),
(100, 'lu', 'Luba-Katanga'),
(101, 'lv', 'Latvian'),
(102, 'mg', 'Malagasy'),
(103, 'mh', 'Marshallese'),
(104, 'mi', 'Maori'),
(105, 'mk', 'Macedonian'),
(106, 'ml', 'Malayalam'),
(107, 'mn', 'Mongolian'),
(108, 'mr', 'Marathi (Mara?hi)'),
(109, 'ms', 'Malay'),
(110, 'mt', 'Maltese'),
(111, 'my', 'Burmese'),
(112, 'na', 'Nauru'),
(113, 'nb', 'Norwegian BokmÃ¥l'),
(114, 'nd', 'North Ndebele'),
(115, 'ne', 'Nepali'),
(116, 'ng', 'Ndonga'),
(117, 'nl', 'Dutch'),
(118, 'nn', 'Norwegian Nynorsk'),
(119, 'no', 'Norwegian'),
(120, 'nr', 'South Ndebele'),
(121, 'nv', 'Navajo, Navaho'),
(122, 'ny', 'Nyanja'),
(123, 'oc', 'Occitan'),
(124, 'oj', 'Ojibwe, Ojibwa'),
(125, 'om', 'Oromo'),
(126, 'or', 'Oriya'),
(127, 'os', 'Ossetian, Ossetic'),
(128, 'pa', 'Panjabi, Punjabi'),
(129, 'pi', 'Pali'),
(130, 'pl', 'Polish'),
(131, 'ps', 'Pashto, Pushto'),
(132, 'pt', 'Portuguese'),
(133, 'qu', 'Quechua'),
(134, 'rm', 'Romansh'),
(135, 'rn', 'Kirundi'),
(136, 'ro', 'Romanian, Moldavian, Moldovan'),
(137, 'ru', 'Russian'),
(138, 'rw', 'Kinyarwanda'),
(139, 'sa', 'Sanskrit (Sa?sk?ta)'),
(140, 'sc', 'Sardinian'),
(141, 'sd', 'Sindhi'),
(142, 'se', 'Northern Sami'),
(143, 'sg', 'Sango'),
(144, 'si', 'Sinhala, Sinhalese'),
(145, 'sk', 'Slovak'),
(146, 'sl', 'Slovene'),
(147, 'sm', 'Samoan'),
(148, 'sn', 'Shona'),
(149, 'so', 'Somali'),
(150, 'sq', 'Albanian'),
(151, 'sr', 'Serbian'),
(152, 'ss', 'Swati'),
(153, 'st', 'Southern Sotho'),
(154, 'su', 'Sundanese'),
(155, 'sv', 'Swedish'),
(156, 'sw', 'Swahili'),
(157, 'ta', 'Tamil'),
(158, 'te', 'Telugu'),
(159, 'tg', 'Tajik'),
(160, 'th', 'Thai'),
(161, 'ti', 'Tigrinya'),
(162, 'tk', 'Turkmen'),
(163, 'tl', 'Tagalog'),
(164, 'tn', 'Tswana'),
(165, 'to', 'Tonga (Tonga Islands)'),
(166, 'tr', 'Turkish'),
(167, 'ts', 'Tsonga'),
(168, 'tt', 'Tatar'),
(169, 'tw', 'Twi'),
(170, 'ty', 'Tahitian'),
(171, 'ug', 'Uighur, Uyghur'),
(172, 'uk', 'Ukrainian'),
(173, 'ur', 'Urdu'),
(174, 'uz', 'Uzbek'),
(175, 've', 'Venda'),
(176, 'vi', 'Vietnamese'),
(177, 'vo', 'VolapÃ¼k'),
(178, 'wa', 'Walloon'),
(179, 'wo', 'Wolof'),
(180, 'xh', 'Xhosa'),
(181, 'yi', 'Yiddish'),
(182, 'yo', 'Yoruba'),
(183, 'za', 'Zhuang, Chuang');

-- --------------------------------------------------------

--
-- Table structure for table `leaves_admins`
--

CREATE TABLE `leaves_admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rec_id` varchar(255) DEFAULT NULL,
  `leave_type` varchar(255) DEFAULT NULL,
  `from_date` varchar(255) DEFAULT NULL,
  `to_date` varchar(255) DEFAULT NULL,
  `day` varchar(255) DEFAULT NULL,
  `leave_reason` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leave_details`
--

CREATE TABLE `leave_details` (
  `id` bigint(20) NOT NULL,
  `employee_for` enum('true','false') NOT NULL DEFAULT 'false',
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `leave_type` varchar(255) NOT NULL,
  `restrict_leave_id` bigint(10) UNSIGNED DEFAULT NULL,
  `from_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `to_date` datetime DEFAULT NULL,
  `total_days` int(20) NOT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `user_reason` longtext DEFAULT NULL,
  `approver1` bigint(20) UNSIGNED DEFAULT NULL,
  `approver2` bigint(20) UNSIGNED DEFAULT NULL,
  `approver3` bigint(20) UNSIGNED DEFAULT NULL,
  `approve1` int(2) DEFAULT NULL,
  `approve2` int(2) DEFAULT NULL,
  `approve3` int(2) DEFAULT NULL,
  `reject_reason` longtext DEFAULT NULL,
  `leave_status` enum('pending','inprogress','complete','reject') DEFAULT 'pending',
  `who_reject` bigint(20) UNSIGNED DEFAULT NULL,
  `is_reject` tinyint(2) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_details`
--

INSERT INTO `leave_details` (`id`, `employee_for`, `user_id`, `leave_type`, `restrict_leave_id`, `from_date`, `to_date`, `total_days`, `contact_number`, `user_reason`, `approver1`, `approver2`, `approver3`, `approve1`, `approve2`, `approve3`, `reject_reason`, `leave_status`, `who_reject`, `is_reject`, `created_at`, `updated_at`) VALUES
(57, 'false', 100, 'Work From Home', NULL, '2025-05-14 11:43:10', '2025-05-17 11:39:00', 4, NULL, NULL, 96, NULL, NULL, 1, NULL, NULL, '', 'complete', NULL, 0, '2025-05-14 07:40:22', '2025-05-14 07:43:10'),
(58, 'false', 100, 'Sick Leave', NULL, '2025-05-14 11:45:33', '2025-06-12 11:44:00', 1, NULL, NULL, 96, NULL, NULL, NULL, NULL, NULL, 'nio', 'reject', 96, 1, '2025-05-14 07:45:05', '2025-05-14 07:45:33'),
(59, 'false', 100, 'Sick Leave', NULL, '2025-05-14 11:46:53', '2025-06-12 11:46:00', 1, NULL, NULL, 96, NULL, NULL, NULL, NULL, NULL, 'no', 'reject', 96, 1, '2025-05-14 07:46:34', '2025-05-14 07:46:53'),
(60, 'false', 100, 'Sick Leave', NULL, '2025-05-14 11:49:12', '2025-06-12 11:47:00', 1, NULL, NULL, 96, NULL, NULL, 1, NULL, NULL, NULL, 'complete', NULL, 0, '2025-05-14 07:47:44', '2025-05-14 07:49:12'),
(61, 'true', 100, 'Annual Leave', NULL, '2025-09-08 11:58:00', '2025-09-10 11:58:00', 3, NULL, NULL, 96, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', NULL, 0, '2025-05-14 08:00:37', '2025-05-14 08:00:37'),
(62, 'false', 100, 'Restrict Leave', 48, '2025-10-24 00:00:00', '2025-10-24 00:00:00', 1, NULL, 'test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'complete', NULL, 0, '2025-05-14 08:04:15', '2025-05-14 08:04:15'),
(63, 'false', 100, 'Restrict Leave', 44, '2025-04-10 00:00:00', '2025-04-10 00:00:00', 1, NULL, 'test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'complete', NULL, 0, '2025-05-14 08:04:39', '2025-05-14 08:04:39'),
(64, 'true', 121, 'Comp Off', NULL, '2025-05-21 18:29:00', '2025-05-22 21:29:00', 2, NULL, NULL, 96, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', NULL, 0, '2025-05-21 14:30:34', '2025-05-21 14:30:34');

-- --------------------------------------------------------

--
-- Table structure for table `lent_assets`
--

CREATE TABLE `lent_assets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `asset_id` bigint(20) UNSIGNED NOT NULL,
  `lend_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lent_assets`
--

INSERT INTO `lent_assets` (`id`, `user_id`, `asset_id`, `lend_date`, `return_date`, `notes`, `created_at`, `updated_at`) VALUES
(7, 96, 11, '2025-04-30', '2025-04-30', 'test', '2025-04-30 10:56:13', '2025-04-30 10:56:13');

-- --------------------------------------------------------

--
-- Table structure for table `loan_types`
--

CREATE TABLE `loan_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `details` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loan_types`
--

INSERT INTO `loan_types` (`id`, `name`, `details`, `created_at`, `updated_at`) VALUES
(1, 'Personal Loan', 'Personal Loan', NULL, NULL),
(2, 'Education Loan', 'Education Loan', NULL, NULL),
(3, 'Home Loan', 'Home Loan', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `address`, `created_at`, `updated_at`) VALUES
(1, 'noida', 'b49 noida sector 63', '2025-03-26 13:48:16', '2025-03-26 13:48:16'),
(2, 'Dublin', 'Housecamp, street 9/12', '2025-03-26 13:49:42', '2025-03-26 13:49:42'),
(3, 'Australia', 'Canbarra, city 20', '2025-03-26 13:55:16', '2025-03-26 13:55:16');

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
(4, '2021_04_25_224042_create_user_activity_logs_table', 1),
(5, '2021_04_30_224320_create_activity_logs_table', 1),
(6, '2021_05_03_061844_create_user_types_table', 1),
(7, '2021_05_03_061918_create_role_type_users_table', 1),
(8, '2021_06_04_053627_create_sequence_tbls_table', 1),
(9, '2021_06_04_053741_create_generate_id_tbls_table', 1),
(10, '2021_07_03_161410_create_position_types_table', 1),
(11, '2021_07_03_171244_create_departments_table', 1),
(12, '2021_07_14_054840_create_employees_table', 1),
(13, '2021_07_16_143215_create_module_permissions_table', 1),
(14, '2021_07_27_053429_create_holidays_table', 1),
(15, '2021_08_01_052433_create_permission_lists_table', 1),
(16, '2021_08_08_054847_create_roles_permissions_table', 1),
(17, '2021_08_13_054414_create_profile_information_table', 1),
(18, '2021_08_23_053914_create_leaves_admins_table', 1),
(19, '2021_09_21_054658_create_staff_salaries_table', 1),
(20, '2021_11_06_201850_create_performance_indicator_lists_table', 1),
(21, '2021_11_09_070649_create_performance_indicators_table', 1),
(22, '2021_11_18_055032_create_performance_appraisals_table', 1),
(23, '2021_12_04_055348_create_trainings_table', 1),
(24, '2022_01_07_060821_create_trainers_table', 1),
(25, '2022_02_02_060242_create_training_types_table', 1),
(26, '2025_01_19_235906_create_permission_tables', 2);

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
(1, 'App\\Models\\User', 60),
(2, 'App\\Models\\User', 112),
(3, 'App\\Models\\User', 98),
(3, 'App\\Models\\User', 100),
(3, 'App\\Models\\User', 101),
(3, 'App\\Models\\User', 102),
(3, 'App\\Models\\User', 103),
(3, 'App\\Models\\User', 104),
(3, 'App\\Models\\User', 105),
(3, 'App\\Models\\User', 106),
(3, 'App\\Models\\User', 107),
(3, 'App\\Models\\User', 109),
(3, 'App\\Models\\User', 111),
(3, 'App\\Models\\User', 113),
(3, 'App\\Models\\User', 114),
(3, 'App\\Models\\User', 115),
(3, 'App\\Models\\User', 116),
(3, 'App\\Models\\User', 117),
(3, 'App\\Models\\User', 118),
(3, 'App\\Models\\User', 120),
(3, 'App\\Models\\User', 121),
(3, 'App\\Models\\User', 122),
(4, 'App\\Models\\User', 96),
(5, 'App\\Models\\User', 97),
(6, 'App\\Models\\User', 99);

-- --------------------------------------------------------

--
-- Table structure for table `module_permissions`
--

CREATE TABLE `module_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` varchar(255) DEFAULT NULL,
  `module_permission` varchar(255) DEFAULT NULL,
  `id_count` varchar(255) DEFAULT NULL,
  `read` varchar(255) DEFAULT NULL,
  `write` varchar(255) DEFAULT NULL,
  `create` varchar(255) DEFAULT NULL,
  `delete` varchar(255) DEFAULT NULL,
  `import` varchar(255) DEFAULT NULL,
  `export` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nationalities`
--

CREATE TABLE `nationalities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nationalities`
--

INSERT INTO `nationalities` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Indian', '2025-01-11 11:01:59', '2025-01-11 11:01:59'),
(2, 'American', '2025-01-11 11:02:14', '2025-01-11 11:02:14'),
(4, 'Algerian', '2025-01-11 11:02:36', '2025-01-11 11:02:36'),
(5, 'Bahraini', '2025-01-11 11:02:52', '2025-01-11 11:02:52');

-- --------------------------------------------------------

--
-- Table structure for table `overtime_categories`
--

CREATE TABLE `overtime_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `overtime_categories`
--

INSERT INTO `overtime_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Extra Work', '2025-01-15 12:49:35', '2025-01-15 12:49:35'),
(2, 'Production', '2025-01-15 12:49:46', '2025-01-15 12:49:46'),
(3, 'Testing', '2025-01-15 12:49:55', '2025-01-15 12:49:55'),
(6, 'Testing 2', '2025-01-20 13:48:57', '2025-01-20 13:48:57');

-- --------------------------------------------------------

--
-- Table structure for table `overtime_requests`
--

CREATE TABLE `overtime_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED DEFAULT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `performance_appraisal`
--

CREATE TABLE `performance_appraisal` (
  `id` bigint(20) NOT NULL,
  `performance_indicator_id` bigint(20) DEFAULT NULL,
  `supervisor_emp_id` bigint(20) UNSIGNED NOT NULL,
  `rated_employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `supervisor_dept_id` bigint(20) UNSIGNED NOT NULL,
  `job_title_id` bigint(20) NOT NULL,
  `supervisor_job_title` bigint(20) NOT NULL,
  `appraisal_year` year(4) NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `performance_appraisal`
--

INSERT INTO `performance_appraisal` (`id`, `performance_indicator_id`, `supervisor_emp_id`, `rated_employee_id`, `department_id`, `supervisor_dept_id`, `job_title_id`, `supervisor_job_title`, `appraisal_year`, `remarks`, `created_at`, `updated_at`) VALUES
(3, 11, 4, 53, 1, 2, 1, 2, '2025', NULL, '2025-05-22 08:53:21', '2025-05-22 08:53:21');

-- --------------------------------------------------------

--
-- Table structure for table `performance_appraisals`
--

CREATE TABLE `performance_appraisals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `rec_id` varchar(255) DEFAULT NULL,
  `customer_experience` varchar(255) DEFAULT NULL,
  `marketing` varchar(255) DEFAULT NULL,
  `management` varchar(255) DEFAULT NULL,
  `administration` varchar(255) DEFAULT NULL,
  `presentation_skill` varchar(255) DEFAULT NULL,
  `quality_of_Work` varchar(255) DEFAULT NULL,
  `efficiency` varchar(255) DEFAULT NULL,
  `integrity` varchar(255) DEFAULT NULL,
  `professionalism` varchar(255) DEFAULT NULL,
  `team_work` varchar(255) DEFAULT NULL,
  `critical_thinking` varchar(255) DEFAULT NULL,
  `conflict_management` varchar(255) DEFAULT NULL,
  `attendance` varchar(255) DEFAULT NULL,
  `ability_to_meet_deadline` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `performance_appraisal_rating`
--

CREATE TABLE `performance_appraisal_rating` (
  `id` bigint(20) NOT NULL,
  `performance_appraisal_id` bigint(20) NOT NULL,
  `title_id` bigint(20) UNSIGNED NOT NULL,
  `sub_title_id` bigint(20) UNSIGNED NOT NULL,
  `rating` bigint(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `performance_appraisal_rating`
--

INSERT INTO `performance_appraisal_rating` (`id`, `performance_appraisal_id`, `title_id`, `sub_title_id`, `rating`, `created_at`, `updated_at`) VALUES
(5, 3, 2, 4, 2, '2025-05-22 08:53:21', '2025-05-22 08:53:21'),
(6, 3, 3, 5, 4, '2025-05-22 08:53:21', '2025-05-22 08:53:21');

-- --------------------------------------------------------

--
-- Table structure for table `performance_goals`
--

CREATE TABLE `performance_goals` (
  `id` bigint(20) NOT NULL,
  `goal_type` enum('0','1','2') NOT NULL COMMENT '0=Long Term Goal,1=Invoice Goal,2=Short Term Goal',
  `start_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `end_date` datetime DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `target_achievement` int(10) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `rating` bigint(20) NOT NULL DEFAULT 0,
  `status` enum('0','1','2') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0=Not Started, 1=In Progress, 2=Completed',
  `progress` int(20) NOT NULL DEFAULT 0,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `job_title_id` bigint(20) DEFAULT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `performance_indicator`
--

CREATE TABLE `performance_indicator` (
  `id` bigint(20) NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `job_title_id` bigint(20) NOT NULL,
  `appraisal_year` year(4) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `performance_indicator`
--

INSERT INTO `performance_indicator` (`id`, `employee_id`, `department_id`, `job_title_id`, `appraisal_year`, `created_at`, `updated_at`) VALUES
(11, 53, 1, 1, '2025', '2025-05-22 06:35:01', '2025-05-22 06:35:01');

-- --------------------------------------------------------

--
-- Table structure for table `performance_indicators`
--

CREATE TABLE `performance_indicators` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rec_id` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `customer_eperience` varchar(255) DEFAULT NULL,
  `marketing` varchar(255) DEFAULT NULL,
  `management` varchar(255) DEFAULT NULL,
  `administration` varchar(255) DEFAULT NULL,
  `presentation_skill` varchar(255) DEFAULT NULL,
  `quality_of_Work` varchar(255) DEFAULT NULL,
  `efficiency` varchar(255) DEFAULT NULL,
  `integrity` varchar(255) DEFAULT NULL,
  `professionalism` varchar(255) DEFAULT NULL,
  `team_work` varchar(255) DEFAULT NULL,
  `critical_thinking` varchar(255) DEFAULT NULL,
  `conflict_management` varchar(255) DEFAULT NULL,
  `attendance` varchar(255) DEFAULT NULL,
  `ability_to_meet_deadline` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `performance_indicator_lists`
--

CREATE TABLE `performance_indicator_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `per_name_list` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `performance_indicator_lists`
--

INSERT INTO `performance_indicator_lists` (`id`, `per_name_list`, `created_at`, `updated_at`) VALUES
(1, 'None', NULL, NULL),
(2, 'Beginner', NULL, NULL),
(3, 'Intermediate', NULL, NULL),
(4, 'Advanced', NULL, NULL),
(5, 'Expert / Leader', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `performance_indicator_rating`
--

CREATE TABLE `performance_indicator_rating` (
  `id` bigint(20) NOT NULL,
  `performance_indicator_id` bigint(20) NOT NULL,
  `title_id` bigint(20) UNSIGNED NOT NULL,
  `sub_title_id` bigint(20) UNSIGNED NOT NULL,
  `rating` bigint(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `performance_indicator_rating`
--

INSERT INTO `performance_indicator_rating` (`id`, `performance_indicator_id`, `title_id`, `sub_title_id`, `rating`, `created_at`, `updated_at`) VALUES
(4, 11, 2, 4, 5, '2025-05-22 06:35:01', '2025-05-22 06:36:25'),
(5, 11, 3, 5, 5, '2025-05-22 06:35:01', '2025-05-22 06:35:01');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `module_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `module_name`, `created_at`, `updated_at`) VALUES
(1, 'qualification-setup', 'web', 'Qualification Management', NULL, NULL),
(2, 'travel-request', 'web', 'Travel Management', NULL, NULL),
(3, 'leave-request', 'web', 'Leave Management', NULL, NULL),
(4, 'system-management', 'web', 'System Management', NULL, NULL),
(5, 'user-report', 'web', 'Report Management', NULL, NULL),
(6, 'employee-management', 'web', 'Employee Management', NULL, NULL),
(7, 'admin-management', 'web', 'Admin Management', NULL, NULL),
(8, 'payroll-manage', 'web', 'Salary Management', NULL, NULL),
(9, 'loan-request', 'web', 'Loan Management', NULL, NULL),
(10, 'annual-leaves', 'web', 'Leave Management', NULL, NULL),
(11, 'payslip-categories', 'web', 'Salary Management', NULL, NULL),
(12, 'manage-division', 'web', 'Division Management', NULL, NULL),
(13, 'travel-category', 'web', 'Travel Management', NULL, NULL),
(14, 'manage-travel-categories', 'web', 'Travel Management', NULL, NULL),
(15, 'asset-type-manage', 'web', 'Asset Management', NULL, NULL),
(16, 'asset-manage', 'web', 'Asset Management', NULL, NULL),
(17, 'policy-manage', 'web', 'Document Management', NULL, NULL),
(18, 'view-policies', 'web', 'Document Management', NULL, NULL),
(19, 'add-event', 'web', 'Event Management', NULL, NULL),
(20, 'holiday-manage', 'web', 'Holiday Management', NULL, NULL),
(21, 'training-manage', 'web', 'Training Management', NULL, NULL),
(22, 'engage-manage', 'web', 'Engage Management', NULL, NULL),
(23, 'indicator-manage', 'web', 'Performance Management', NULL, NULL),
(24, 'appraisel-manage', 'web', 'Performance Management', NULL, NULL),
(25, 'kpi-manage', 'web', 'Performance Management', NULL, NULL),
(26, '', '', NULL, NULL, NULL),
(27, 'trainer-manage', 'web', 'Training Management', NULL, NULL),
(28, 'training-list-manage', 'web', 'Training Management', NULL, NULL),
(29, 'employee-training', 'web', 'Training Management', NULL, NULL),
(30, '', 'web', 'Training Management', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission_lists`
--

CREATE TABLE `permission_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `permission_name` varchar(255) DEFAULT NULL,
  `read` varchar(255) DEFAULT NULL,
  `write` varchar(255) DEFAULT NULL,
  `create` varchar(255) DEFAULT NULL,
  `delete` varchar(255) DEFAULT NULL,
  `import` varchar(255) DEFAULT NULL,
  `export` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_lists`
--

INSERT INTO `permission_lists` (`id`, `permission_name`, `read`, `write`, `create`, `delete`, `import`, `export`) VALUES
(1, 'Holidays', 'Y', 'Y', 'Y', 'Y', 'Y', 'N'),
(2, 'Leaves', 'Y', 'Y', 'Y', 'N', 'N', 'N'),
(3, 'Clients', 'Y', 'Y', 'Y', 'N', 'N', 'N'),
(4, 'Projects', 'Y', 'N', 'Y', 'N', 'N', 'N'),
(5, 'Tasks', 'Y', 'Y', 'Y', 'Y', 'N', 'N'),
(6, 'Chats', 'Y', 'Y', 'Y', 'Y', 'N', 'N'),
(7, 'Assets', 'Y', 'Y', 'Y', 'Y', 'N', 'N'),
(8, 'Timing Sheets', 'Y', 'Y', 'Y', 'Y', 'N', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `policies`
--

CREATE TABLE `policies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `relative_to` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `last_modified` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `policy_category` varchar(20) NOT NULL,
  `upload_file` text DEFAULT NULL,
  `status` varchar(20) DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `policies`
--

INSERT INTO `policies` (`id`, `name`, `relative_to`, `description`, `last_modified`, `created_at`, `updated_at`, `policy_category`, `upload_file`, `status`) VALUES
(1, 'Leave Policy', NULL, 'A leave policy is a document that outlines the rules and procedures for employees to take time off from work, encompassing different types of leave, eligibility criteria, and the process for requesting and approving leave.', NULL, '2025-03-31 12:31:46', '2025-03-31 12:31:46', 'General Policy', 'uploads/policies/1743418906_1743417629_dummy.pdf', 'active'),
(2, 'Attendance Policy', NULL, 'An attendance policy outlines an organization\'s guidelines for managing employee attendance, including expectations for punctuality, working hours, reporting absences, and potential consequences for violations.', NULL, '2025-03-31 12:43:01', '2025-03-31 12:44:14', 'Internal Policy', 'uploads/policies/1743419581_dummy.pdf', 'inactive'),
(122436345770, 'Grievance policy', NULL, 'A grievance policy is a formal document that outlines how employees can raise complaints or concerns about their workplace, ensuring a structured and fair process for addressing issues and promoting a positive work environment.', NULL, '2025-03-31 12:53:32', '2025-03-31 12:53:32', 'Internal Policy', 'uploads/policies/1743420212_dummy.pdf', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `position_types`
--

CREATE TABLE `position_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `position` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `position_types`
--

INSERT INTO `position_types` (`id`, `position`, `created_at`, `updated_at`) VALUES
(1, 'CEO', NULL, NULL),
(2, 'CFO', NULL, NULL),
(3, 'Manager', NULL, NULL),
(4, 'Web Designer', NULL, NULL),
(5, 'Web Developer', NULL, NULL),
(6, 'Android Developer', NULL, NULL),
(7, 'IOS Developer', NULL, NULL),
(8, 'Team Leader', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `content` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile_information`
--

CREATE TABLE `profile_information` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `rec_id` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `birth_date` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `pin_code` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `reports_to` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `details` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

CREATE TABLE `province` (
  `id` bigint(20) NOT NULL,
  `name` varchar(40) NOT NULL DEFAULT '',
  `code` char(2) NOT NULL DEFAULT '',
  `country` char(2) NOT NULL DEFAULT 'US'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `province`
--

INSERT INTO `province` (`id`, `name`, `code`, `country`) VALUES
(1, 'Alaska', 'AK', 'US'),
(2, 'Alabama', 'AL', 'US'),
(3, 'American Samoa', 'AS', 'US'),
(4, 'Arizona', 'AZ', 'US'),
(5, 'Arkansas', 'AR', 'US'),
(6, 'California', 'CA', 'US'),
(7, 'Colorado', 'CO', 'US'),
(8, 'Connecticut', 'CT', 'US'),
(9, 'Delaware', 'DE', 'US'),
(10, 'District of Columbia', 'DC', 'US'),
(11, 'Federated States of Micronesia', 'FM', 'US'),
(12, 'Florida', 'FL', 'US'),
(13, 'Georgia', 'GA', 'US'),
(14, 'Guam', 'GU', 'US'),
(15, 'Hawaii', 'HI', 'US'),
(16, 'Idaho', 'ID', 'US'),
(17, 'Illinois', 'IL', 'US'),
(18, 'Indiana', 'IN', 'US'),
(19, 'Iowa', 'IA', 'US'),
(20, 'Kansas', 'KS', 'US'),
(21, 'Kentucky', 'KY', 'US'),
(22, 'Louisiana', 'LA', 'US'),
(23, 'Maine', 'ME', 'US'),
(24, 'Marshall Islands', 'MH', 'US'),
(25, 'Maryland', 'MD', 'US'),
(26, 'Massachusetts', 'MA', 'US'),
(27, 'Michigan', 'MI', 'US'),
(28, 'Minnesota', 'MN', 'US'),
(29, 'Mississippi', 'MS', 'US'),
(30, 'Missouri', 'MO', 'US'),
(31, 'Montana', 'MT', 'US'),
(32, 'Nebraska', 'NE', 'US'),
(33, 'Nevada', 'NV', 'US'),
(34, 'New Hampshire', 'NH', 'US'),
(35, 'New Jersey', 'NJ', 'US'),
(36, 'New Mexico', 'NM', 'US'),
(37, 'New York', 'NY', 'US'),
(38, 'North Carolina', 'NC', 'US'),
(39, 'North Dakota', 'ND', 'US'),
(40, 'Northern Mariana Islands', 'MP', 'US'),
(41, 'Ohio', 'OH', 'US'),
(42, 'Oklahoma', 'OK', 'US'),
(43, 'Oregon', 'OR', 'US'),
(44, 'Palau', 'PW', 'US'),
(45, 'Pennsylvania', 'PA', 'US'),
(46, 'Puerto Rico', 'PR', 'US'),
(47, 'Rhode Island', 'RI', 'US'),
(48, 'South Carolina', 'SC', 'US'),
(49, 'South Dakota', 'SD', 'US'),
(50, 'Tennessee', 'TN', 'US'),
(51, 'Texas', 'TX', 'US'),
(52, 'Utah', 'UT', 'US'),
(53, 'Vermont', 'VT', 'US'),
(54, 'Virgin Islands', 'VI', 'US'),
(55, 'Virginia', 'VA', 'US'),
(56, 'Washington', 'WA', 'US'),
(57, 'West Virginia', 'WV', 'US'),
(58, 'Wisconsin', 'WI', 'US'),
(59, 'Wyoming', 'WY', 'US'),
(60, 'Armed Forces Africa', 'AE', 'US'),
(61, 'Armed Forces Americas (except Canada)', 'AA', 'US'),
(62, 'Armed Forces Canada', 'AE', 'US'),
(63, 'Armed Forces Europe', 'AE', 'US'),
(64, 'Armed Forces Middle East', 'AE', 'US'),
(65, 'Armed Forces Pacific', 'AP', 'US'),
(66, 'Andaman and Nicobar Islands', 'AN', 'IN'),
(67, 'Andhra Pradesh', 'AP', 'IN'),
(68, 'Arunachal Pradesh', 'AR', 'IN'),
(69, 'Assam', 'AS', 'IN'),
(70, 'Bihar', 'BR', 'IN'),
(71, 'Chandigarh', 'CH', 'IN'),
(72, 'Chhattisgarh', 'CG', 'IN'),
(73, 'Dadra and Nagar Haveli', 'DN', 'IN'),
(74, 'Daman and Diu', 'DD', 'IN'),
(75, 'Delhi', 'DL', 'IN'),
(76, 'Goa', 'GA', 'IN'),
(77, 'Gujarat', 'GJ', 'IN'),
(78, 'Haryana', 'HR', 'IN'),
(79, 'Himachal Pradesh', 'HP', 'IN'),
(80, 'Jammu and Kashmir', 'JK', 'IN'),
(81, 'Karnataka', 'KA', 'IN'),
(82, 'Kerala', 'KL', 'IN'),
(83, 'Lakshadweep Islands', 'LD', 'IN'),
(84, 'Madhya Pradesh', 'MP', 'IN'),
(85, 'Maharashtra', 'MH', 'IN'),
(86, 'Manipur', 'MN', 'IN'),
(87, 'Meghalaya', 'ML', 'IN'),
(88, 'Mizoram', 'MZ', 'IN'),
(89, 'Nagaland', 'NL', 'IN'),
(90, 'Nagaland', 'NL', 'IN'),
(91, 'Odisha', 'OR', 'IN'),
(92, 'Puducherry', 'PY', 'IN'),
(93, 'Punjab', 'PB', 'IN'),
(94, 'Rajasthan', 'RJ', 'IN'),
(95, 'Sikkim', 'SK', 'IN'),
(96, 'Tamil Nadu', 'TN', 'IN'),
(97, 'Telangana', 'TS', 'IN'),
(98, 'Tripura', 'TR', 'IN'),
(99, 'Uttar Pradesh', 'UP', 'IN'),
(100, 'Uttarakhand', 'UK', 'IN'),
(101, 'West Bengal', 'WB', 'IN');

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `countary_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`id`, `countary_id`, `code`, `name`, `created_at`, `updated_at`) VALUES
(2, 1, 'DL', 'Delhi', '2025-01-11 10:22:02', '2025-01-11 10:22:02'),
(3, 1, 'BR', 'Bihar', '2025-01-11 10:22:16', '2025-01-11 10:22:16'),
(4, 1, 'CH', 'Chandigarh', '2025-01-11 10:22:38', '2025-01-11 10:22:38'),
(5, 1, 'GA', 'Goa', '2025-01-11 10:22:58', '2025-01-11 10:22:58'),
(6, 1, 'Gj', 'Gujarat', '2025-01-11 10:23:14', '2025-01-11 10:23:14'),
(7, 1, 'HP', 'Himachal Pradesh', '2025-01-11 10:23:34', '2025-01-11 10:23:34');

-- --------------------------------------------------------

--
-- Table structure for table `reactions`
--

CREATE TABLE `reactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` varchar(255) DEFAULT 'like',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reimbursements`
--

CREATE TABLE `reimbursements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `from_location` varchar(255) DEFAULT NULL,
  `to_location` varchar(255) DEFAULT NULL,
  `date_of_visit` date DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reimbursements`
--

INSERT INTO `reimbursements` (`id`, `employee_id`, `from_location`, `to_location`, `date_of_visit`, `amount`, `description`, `created_at`, `updated_at`) VALUES
(7, 44, 'Noida', 'Delhi', '2025-05-28', 20000.00, 'Testt', '2025-05-13 06:43:58', '2025-05-26 10:51:06'),
(8, 53, 'Canbera', 'perth', '2025-05-15', 900.00, 'test', '2025-05-14 06:30:42', '2025-05-26 10:50:29'),
(9, 39, 'Canbera', 'perth', '2025-05-15', 9000.00, 'test', '2025-05-14 06:31:03', '2025-05-26 10:50:40'),
(10, 37, 'Delhi', 'Mysore', '2025-05-24', 200.00, 'testtest', '2025-05-14 06:32:28', '2025-05-26 10:50:56');

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
(1, 'Admin', 'web', NULL, NULL),
(2, 'Manager', 'web', NULL, NULL),
(3, 'Employee', 'web', '2025-01-19 18:58:57', '2025-01-20 08:59:19'),
(4, 'HR', 'web', NULL, NULL),
(5, 'Direct superior', 'web', NULL, NULL),
(6, 'DGA', 'web', NULL, NULL);

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
(1, 1),
(2, 1),
(2, 2),
(2, 4),
(3, 1),
(3, 4),
(3, 5),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(10, 1),
(10, 4),
(10, 5),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(22, 3),
(22, 4),
(22, 5),
(22, 6),
(23, 1),
(23, 3),
(24, 1),
(24, 3),
(25, 1);

-- --------------------------------------------------------

--
-- Table structure for table `role_type_users`
--

CREATE TABLE `role_type_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_type_users`
--

INSERT INTO `role_type_users` (`id`, `role_type`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, NULL),
(2, 'Super Admin', NULL, NULL),
(3, 'Normal User', NULL, NULL),
(4, 'Client', NULL, NULL),
(5, 'Employee', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `salary_component`
--

CREATE TABLE `salary_component` (
  `id` bigint(20) NOT NULL,
  `component_name` varchar(255) NOT NULL,
  `component_type` enum('earning','deduction') NOT NULL,
  `component_value_type` enum('1','2','3','4') NOT NULL COMMENT '1=fixed,2=variable,3=basic_percent,4=ctc_percent',
  `monthly_percentage` float DEFAULT NULL,
  `monthly_amount` bigint(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salary_component`
--

INSERT INTO `salary_component` (`id`, `component_name`, `component_type`, `component_value_type`, `monthly_percentage`, `monthly_amount`, `created_at`, `updated_at`) VALUES
(4, 'Basic', 'earning', '4', 35, NULL, '2025-05-09 08:12:36', '2025-05-09 08:12:36'),
(5, 'HRA', 'earning', '4', 21, NULL, '2025-05-09 08:12:51', '2025-05-09 08:12:51'),
(6, 'Convience Allowance', 'earning', '4', 7, NULL, '2025-05-09 08:13:04', '2025-05-09 08:13:04'),
(7, 'Bonus', 'earning', '4', 4.2, NULL, '2025-05-09 08:14:25', '2025-05-09 06:47:08'),
(8, 'Fixed Allowance', 'earning', '4', 32.8, NULL, '2025-05-09 08:14:54', '2025-05-12 06:07:55'),
(9, 'Medical insurance', 'deduction', '1', NULL, 187, '2025-05-09 08:15:23', '2025-05-09 08:15:23'),
(10, 'PF Employee', 'deduction', '1', NULL, 1800, '2025-05-09 08:16:02', '2025-05-12 06:32:23'),
(11, 'PF Employer', 'deduction', '1', NULL, 1800, '2025-05-09 08:16:18', '2025-05-09 08:16:18');

-- --------------------------------------------------------

--
-- Table structure for table `salary_group`
--

CREATE TABLE `salary_group` (
  `id` bigint(20) NOT NULL,
  `salary_group_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salary_group`
--

INSERT INTO `salary_group` (`id`, `salary_group_name`, `created_at`, `updated_at`) VALUES
(3, 'Group', '2025-05-09 08:19:18', '2025-05-09 08:19:34');

-- --------------------------------------------------------

--
-- Table structure for table `salary_group_components`
--

CREATE TABLE `salary_group_components` (
  `id` bigint(20) NOT NULL,
  `salary_component_id` bigint(20) NOT NULL,
  `salary_group_id` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salary_group_components`
--

INSERT INTO `salary_group_components` (`id`, `salary_component_id`, `salary_group_id`, `created_at`, `updated_at`) VALUES
(12, 4, 3, '2025-05-09 08:19:34', '2025-05-09 08:19:34'),
(13, 7, 3, '2025-05-09 08:19:34', '2025-05-09 08:19:34'),
(14, 6, 3, '2025-05-09 08:19:34', '2025-05-09 08:19:34'),
(15, 8, 3, '2025-05-09 08:19:34', '2025-05-09 08:19:34'),
(16, 5, 3, '2025-05-09 08:19:34', '2025-05-09 08:19:34'),
(17, 9, 3, '2025-05-09 08:19:34', '2025-05-09 08:19:34'),
(18, 10, 3, '2025-05-09 08:19:34', '2025-05-09 08:19:34'),
(19, 11, 3, '2025-05-09 08:19:34', '2025-05-09 08:19:34');

-- --------------------------------------------------------

--
-- Table structure for table `sequence_tbls`
--

CREATE TABLE `sequence_tbls` (
  `id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sequence_tbls`
--

INSERT INTO `sequence_tbls` (`id`) VALUES
(1),
(2),
(3),
(4),
(7),
(9),
(10),
(11),
(12),
(13),
(14),
(15),
(16),
(17),
(18),
(19),
(21),
(23),
(25),
(26),
(27),
(28),
(29),
(30),
(31),
(32),
(33),
(36),
(37),
(38),
(39),
(40),
(41),
(42),
(43),
(44),
(45),
(46),
(49),
(50),
(51),
(52),
(53),
(55),
(56),
(58),
(59),
(60),
(61),
(62),
(63),
(64),
(65),
(66),
(68),
(69),
(70),
(71),
(72),
(73),
(74),
(75),
(76),
(77),
(78),
(79),
(80),
(81),
(82),
(85),
(86),
(88),
(89),
(90),
(92),
(93),
(94),
(95),
(96),
(97),
(98),
(99),
(100),
(101),
(102),
(103),
(104),
(105),
(107),
(108),
(110),
(112),
(113),
(114),
(115),
(116),
(117),
(118),
(119),
(121),
(122),
(123);

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `name`, `description`) VALUES
(1, 'Programming and Application Development', 'Programming and Application Development'),
(2, 'Project Management', 'Project Management'),
(3, 'Help Desk/Technical Support', 'Help Desk/Technical Support'),
(4, 'Networking', 'Networking'),
(5, 'Databases', 'Databases'),
(6, 'Business Intelligence', 'Business Intelligence'),
(7, 'Cloud Computing', 'Cloud Computing'),
(8, 'Information Security', 'Information Security'),
(9, 'HTML Skills', 'HTML Skills'),
(10, 'Graphic Designing', 'Graphic Designing'),
(11, 'Coding', 'Coding Description');

-- --------------------------------------------------------

--
-- Table structure for table `staff_salaries`
--

CREATE TABLE `staff_salaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `rec_id` varchar(255) DEFAULT NULL,
  `salary` varchar(255) DEFAULT NULL,
  `basic` varchar(255) DEFAULT NULL,
  `da` varchar(255) DEFAULT NULL,
  `hra` varchar(255) DEFAULT NULL,
  `conveyance` varchar(255) DEFAULT NULL,
  `allowance` varchar(255) DEFAULT NULL,
  `medical_allowance` varchar(255) DEFAULT NULL,
  `tds` varchar(255) DEFAULT NULL,
  `esi` varchar(255) DEFAULT NULL,
  `pf` varchar(255) DEFAULT NULL,
  `leave` varchar(255) DEFAULT NULL,
  `prof_tax` varchar(255) DEFAULT NULL,
  `labour_welfare` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `timesheets`
--

CREATE TABLE `timesheets` (
  `id` int(11) NOT NULL,
  `month` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `uploaded_by` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timesheets`
--

INSERT INTO `timesheets` (`id`, `month`, `year`, `file_name`, `file_path`, `uploaded_by`) VALUES
(1, 'April', '2025', '1744021043_holidays.xlsx', 'storage/timesheets/1744021043_holidays.xlsx', '60');

-- --------------------------------------------------------

--
-- Table structure for table `timezones`
--

CREATE TABLE `timezones` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `details` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `timezones`
--

INSERT INTO `timezones` (`id`, `name`, `details`) VALUES
(2, 'US/Samoa', '(GMT-11:00) Samoa'),
(3, 'US/Hawaii', '(GMT-10:00) Hawaii'),
(4, 'US/Alaska', '(GMT-09:00) Alaska'),
(5, 'US/Pacific', '(GMT-08:00) Pacific Time (US, Canada)'),
(7, 'US/Arizona', '(GMT-07:00) Arizona'),
(8, 'US/Mountain', '(GMT-07:00) Mountain Time (US, Canada)'),
(13, 'Canada/Saskatchewan', '(GMT-06:00) Saskatchewan'),
(14, 'US/Central', '(GMT-06:00) Central Time (US , Canada)'),
(15, 'US/Eastern', '(GMT-05:00) Eastern Time (US , Canada)'),
(16, 'US/East-Indiana', '(GMT-05:00) Indiana (East)'),
(20, 'Canada/Atlantic', '(GMT-04:00) Atlantic Time (Canada)'),
(23, 'Canada/Newfoundland', '(GMT-03:30) Newfoundland'),
(24, 'America/Buenos_Aires', '(GMT-03:00) Buenos Aires'),
(88, 'Asia/Chongqing', '(GMT+08:00) Chongqing'),
(103, 'Australia/Canberra', '(GMT+10:00) Canberra'),
(113, 'Africa/Abidjan', 'Africa/Abidjan'),
(114, 'Africa/Accra', 'Africa/Accra'),
(115, 'Africa/Addis_Ababa', 'Africa/Addis_Ababa'),
(116, 'Africa/Algiers', 'Africa/Algiers'),
(117, 'Africa/Asmara', 'Africa/Asmara'),
(118, 'Africa/Bamako', 'Africa/Bamako'),
(119, 'Africa/Bangui', 'Africa/Bangui'),
(120, 'Africa/Banjul', 'Africa/Banjul'),
(121, 'Africa/Bissau', 'Africa/Bissau'),
(122, 'Africa/Blantyre', 'Africa/Blantyre'),
(123, 'Africa/Brazzaville', 'Africa/Brazzaville'),
(124, 'Africa/Bujumbura', 'Africa/Bujumbura'),
(125, 'Africa/Cairo', 'Africa/Cairo'),
(126, 'Africa/Casablanca', 'Africa/Casablanca'),
(127, 'Africa/Ceuta', 'Africa/Ceuta'),
(128, 'Africa/Conakry', 'Africa/Conakry'),
(129, 'Africa/Dakar', 'Africa/Dakar'),
(130, 'Africa/Dar_es_Salaam', 'Africa/Dar_es_Salaam'),
(131, 'Africa/Djibouti', 'Africa/Djibouti'),
(132, 'Africa/Douala', 'Africa/Douala'),
(133, 'Africa/El_Aaiun', 'Africa/El_Aaiun'),
(134, 'Africa/Freetown', 'Africa/Freetown'),
(135, 'Africa/Gaborone', 'Africa/Gaborone'),
(136, 'Africa/Harare', 'Africa/Harare'),
(137, 'Africa/Johannesburg', 'Africa/Johannesburg'),
(138, 'Africa/Juba', 'Africa/Juba'),
(139, 'Africa/Kampala', 'Africa/Kampala'),
(140, 'Africa/Khartoum', 'Africa/Khartoum'),
(141, 'Africa/Kigali', 'Africa/Kigali'),
(142, 'Africa/Kinshasa', 'Africa/Kinshasa'),
(143, 'Africa/Lagos', 'Africa/Lagos'),
(144, 'Africa/Libreville', 'Africa/Libreville'),
(145, 'Africa/Lome', 'Africa/Lome'),
(146, 'Africa/Luanda', 'Africa/Luanda'),
(147, 'Africa/Lubumbashi', 'Africa/Lubumbashi'),
(148, 'Africa/Lusaka', 'Africa/Lusaka'),
(149, 'Africa/Malabo', 'Africa/Malabo'),
(150, 'Africa/Maputo', 'Africa/Maputo'),
(151, 'Africa/Maseru', 'Africa/Maseru'),
(152, 'Africa/Mbabane', 'Africa/Mbabane'),
(153, 'Africa/Mogadishu', 'Africa/Mogadishu'),
(154, 'Africa/Monrovia', 'Africa/Monrovia'),
(155, 'Africa/Nairobi', 'Africa/Nairobi'),
(156, 'Africa/Ndjamena', 'Africa/Ndjamena'),
(157, 'Africa/Niamey', 'Africa/Niamey'),
(158, 'Africa/Nouakchott', 'Africa/Nouakchott'),
(159, 'Africa/Ouagadougou', 'Africa/Ouagadougou'),
(160, 'Africa/Porto-Novo', 'Africa/Porto-Novo'),
(161, 'Africa/Sao_Tome', 'Africa/Sao_Tome'),
(162, 'Africa/Tripoli', 'Africa/Tripoli'),
(163, 'Africa/Tunis', 'Africa/Tunis'),
(164, 'Africa/Windhoek', 'Africa/Windhoek'),
(165, 'America/Adak', 'America/Adak'),
(166, 'America/Anchorage', 'America/Anchorage'),
(167, 'America/Anguilla', 'America/Anguilla'),
(168, 'America/Antigua', 'America/Antigua'),
(169, 'America/Araguaina', 'America/Araguaina'),
(170, 'America/Argentina/Buenos_Aires', 'America/Argentina/Buenos_Aires'),
(171, 'America/Argentina/Catamarca', 'America/Argentina/Catamarca'),
(172, 'America/Argentina/Cordoba', 'America/Argentina/Cordoba'),
(173, 'America/Argentina/Jujuy', 'America/Argentina/Jujuy'),
(174, 'America/Argentina/La_Rioja', 'America/Argentina/La_Rioja'),
(175, 'America/Argentina/Mendoza', 'America/Argentina/Mendoza'),
(176, 'America/Argentina/Rio_Gallegos', 'America/Argentina/Rio_Gallegos'),
(177, 'America/Argentina/Salta', 'America/Argentina/Salta'),
(178, 'America/Argentina/San_Juan', 'America/Argentina/San_Juan'),
(179, 'America/Argentina/San_Luis', 'America/Argentina/San_Luis'),
(180, 'America/Argentina/Tucuman', 'America/Argentina/Tucuman'),
(181, 'America/Argentina/Ushuaia', 'America/Argentina/Ushuaia'),
(182, 'America/Aruba', 'America/Aruba'),
(183, 'America/Asuncion', 'America/Asuncion'),
(184, 'America/Atikokan', 'America/Atikokan'),
(185, 'America/Bahia', 'America/Bahia'),
(186, 'America/Bahia_Banderas', 'America/Bahia_Banderas'),
(187, 'America/Barbados', 'America/Barbados'),
(188, 'America/Belem', 'America/Belem'),
(189, 'America/Belize', 'America/Belize'),
(190, 'America/Blanc-Sablon', 'America/Blanc-Sablon'),
(191, 'America/Boa_Vista', 'America/Boa_Vista'),
(192, 'America/Bogota', 'America/Bogota'),
(193, 'America/Boise', 'America/Boise'),
(194, 'America/Cambridge_Bay', 'America/Cambridge_Bay'),
(195, 'America/Campo_Grande', 'America/Campo_Grande'),
(196, 'America/Cancun', 'America/Cancun'),
(197, 'America/Caracas', 'America/Caracas'),
(198, 'America/Cayenne', 'America/Cayenne'),
(199, 'America/Cayman', 'America/Cayman'),
(200, 'America/Chicago', 'America/Chicago'),
(201, 'America/Chihuahua', 'America/Chihuahua'),
(202, 'America/Costa_Rica', 'America/Costa_Rica'),
(203, 'America/Creston', 'America/Creston'),
(204, 'America/Cuiaba', 'America/Cuiaba'),
(205, 'America/Curacao', 'America/Curacao'),
(206, 'America/Danmarkshavn', 'America/Danmarkshavn'),
(207, 'America/Dawson', 'America/Dawson'),
(208, 'America/Dawson_Creek', 'America/Dawson_Creek'),
(209, 'America/Denver', 'America/Denver'),
(210, 'America/Detroit', 'America/Detroit'),
(211, 'America/Dominica', 'America/Dominica'),
(212, 'America/Edmonton', 'America/Edmonton'),
(213, 'America/Eirunepe', 'America/Eirunepe'),
(214, 'America/El_Salvador', 'America/El_Salvador'),
(215, 'America/Fort_Nelson', 'America/Fort_Nelson'),
(216, 'America/Fortaleza', 'America/Fortaleza'),
(217, 'America/Glace_Bay', 'America/Glace_Bay'),
(218, 'America/Godthab', 'America/Godthab'),
(219, 'America/Goose_Bay', 'America/Goose_Bay'),
(220, 'America/Grand_Turk', 'America/Grand_Turk'),
(221, 'America/Grenada', 'America/Grenada'),
(222, 'America/Guadeloupe', 'America/Guadeloupe'),
(223, 'America/Guatemala', 'America/Guatemala'),
(224, 'America/Guayaquil', 'America/Guayaquil'),
(225, 'America/Guyana', 'America/Guyana'),
(226, 'America/Halifax', 'America/Halifax'),
(227, 'America/Havana', 'America/Havana'),
(228, 'America/Hermosillo', 'America/Hermosillo'),
(229, 'America/Indiana/Indianapolis', 'America/Indiana/Indianapolis'),
(230, 'America/Indiana/Knox', 'America/Indiana/Knox'),
(231, 'America/Indiana/Marengo', 'America/Indiana/Marengo'),
(232, 'America/Indiana/Petersburg', 'America/Indiana/Petersburg'),
(233, 'America/Indiana/Tell_City', 'America/Indiana/Tell_City'),
(234, 'America/Indiana/Vevay', 'America/Indiana/Vevay'),
(235, 'America/Indiana/Vincennes', 'America/Indiana/Vincennes'),
(236, 'America/Indiana/Winamac', 'America/Indiana/Winamac'),
(237, 'America/Inuvik', 'America/Inuvik'),
(238, 'America/Iqaluit', 'America/Iqaluit'),
(239, 'America/Jamaica', 'America/Jamaica'),
(240, 'America/Juneau', 'America/Juneau'),
(241, 'America/Kentucky/Louisville', 'America/Kentucky/Louisville'),
(242, 'America/Kentucky/Monticello', 'America/Kentucky/Monticello'),
(243, 'America/Kralendijk', 'America/Kralendijk'),
(244, 'America/La_Paz', 'America/La_Paz'),
(245, 'America/Lima', 'America/Lima'),
(246, 'America/Los_Angeles', 'America/Los_Angeles'),
(247, 'America/Lower_Princes', 'America/Lower_Princes'),
(248, 'America/Maceio', 'America/Maceio'),
(249, 'America/Managua', 'America/Managua'),
(250, 'America/Manaus', 'America/Manaus'),
(251, 'America/Marigot', 'America/Marigot'),
(252, 'America/Martinique', 'America/Martinique'),
(253, 'America/Matamoros', 'America/Matamoros'),
(254, 'America/Mazatlan', 'America/Mazatlan'),
(255, 'America/Menominee', 'America/Menominee'),
(256, 'America/Merida', 'America/Merida'),
(257, 'America/Metlakatla', 'America/Metlakatla'),
(258, 'America/Mexico_City', 'America/Mexico_City'),
(259, 'America/Miquelon', 'America/Miquelon'),
(260, 'America/Moncton', 'America/Moncton'),
(261, 'America/Monterrey', 'America/Monterrey'),
(262, 'America/Montevideo', 'America/Montevideo'),
(263, 'America/Montserrat', 'America/Montserrat'),
(264, 'America/Nassau', 'America/Nassau'),
(265, 'America/New_York', 'America/New_York'),
(266, 'America/Nipigon', 'America/Nipigon'),
(267, 'America/Nome', 'America/Nome'),
(268, 'America/Noronha', 'America/Noronha'),
(269, 'America/North_Dakota/Beulah', 'America/North_Dakota/Beulah'),
(270, 'America/North_Dakota/Center', 'America/North_Dakota/Center'),
(271, 'America/North_Dakota/New_Salem', 'America/North_Dakota/New_Salem'),
(272, 'America/Ojinaga', 'America/Ojinaga'),
(273, 'America/Panama', 'America/Panama'),
(274, 'America/Pangnirtung', 'America/Pangnirtung'),
(275, 'America/Paramaribo', 'America/Paramaribo'),
(276, 'America/Phoenix', 'America/Phoenix'),
(277, 'America/Port-au-Prince', 'America/Port-au-Prince'),
(278, 'America/Port_of_Spain', 'America/Port_of_Spain'),
(279, 'America/Porto_Velho', 'America/Porto_Velho'),
(280, 'America/Puerto_Rico', 'America/Puerto_Rico'),
(281, 'America/Punta_Arenas', 'America/Punta_Arenas'),
(282, 'America/Rainy_River', 'America/Rainy_River'),
(283, 'America/Rankin_Inlet', 'America/Rankin_Inlet'),
(284, 'America/Recife', 'America/Recife'),
(285, 'America/Regina', 'America/Regina'),
(286, 'America/Resolute', 'America/Resolute'),
(287, 'America/Rio_Branco', 'America/Rio_Branco'),
(288, 'America/Santarem', 'America/Santarem'),
(289, 'America/Santiago', 'America/Santiago'),
(290, 'America/Santo_Domingo', 'America/Santo_Domingo'),
(291, 'America/Sao_Paulo', 'America/Sao_Paulo'),
(292, 'America/Scoresbysund', 'America/Scoresbysund'),
(293, 'America/Sitka', 'America/Sitka'),
(294, 'America/St_Barthelemy', 'America/St_Barthelemy'),
(295, 'America/St_Johns', 'America/St_Johns'),
(296, 'America/St_Kitts', 'America/St_Kitts'),
(297, 'America/St_Lucia', 'America/St_Lucia'),
(298, 'America/St_Thomas', 'America/St_Thomas'),
(299, 'America/St_Vincent', 'America/St_Vincent'),
(300, 'America/Swift_Current', 'America/Swift_Current'),
(301, 'America/Tegucigalpa', 'America/Tegucigalpa'),
(302, 'America/Thule', 'America/Thule'),
(303, 'America/Thunder_Bay', 'America/Thunder_Bay'),
(304, 'America/Tijuana', 'America/Tijuana'),
(305, 'America/Toronto', 'America/Toronto'),
(306, 'America/Tortola', 'America/Tortola'),
(307, 'America/Vancouver', 'America/Vancouver'),
(308, 'America/Whitehorse', 'America/Whitehorse'),
(309, 'America/Winnipeg', 'America/Winnipeg'),
(310, 'America/Yakutat', 'America/Yakutat'),
(311, 'America/Yellowknife', 'America/Yellowknife'),
(312, 'Antarctica/Casey', 'Antarctica/Casey'),
(313, 'Antarctica/Davis', 'Antarctica/Davis'),
(314, 'Antarctica/DumontDUrville', 'Antarctica/DumontDUrville'),
(315, 'Antarctica/Macquarie', 'Antarctica/Macquarie'),
(316, 'Antarctica/Mawson', 'Antarctica/Mawson'),
(317, 'Antarctica/McMurdo', 'Antarctica/McMurdo'),
(318, 'Antarctica/Palmer', 'Antarctica/Palmer'),
(319, 'Antarctica/Rothera', 'Antarctica/Rothera'),
(320, 'Antarctica/Syowa', 'Antarctica/Syowa'),
(321, 'Antarctica/Troll', 'Antarctica/Troll'),
(322, 'Antarctica/Vostok', 'Antarctica/Vostok'),
(323, 'Arctic/Longyearbyen', 'Arctic/Longyearbyen'),
(324, 'Asia/Aden', 'Asia/Aden'),
(325, 'Asia/Almaty', 'Asia/Almaty'),
(326, 'Asia/Amman', 'Asia/Amman'),
(327, 'Asia/Anadyr', 'Asia/Anadyr'),
(328, 'Asia/Aqtau', 'Asia/Aqtau'),
(329, 'Asia/Aqtobe', 'Asia/Aqtobe'),
(330, 'Asia/Ashgabat', 'Asia/Ashgabat'),
(331, 'Asia/Atyrau', 'Asia/Atyrau'),
(332, 'Asia/Baghdad', 'Asia/Baghdad'),
(333, 'Asia/Bahrain', 'Asia/Bahrain'),
(334, 'Asia/Baku', 'Asia/Baku'),
(335, 'Asia/Bangkok', 'Asia/Bangkok'),
(336, 'Asia/Barnaul', 'Asia/Barnaul'),
(337, 'Asia/Beirut', 'Asia/Beirut'),
(338, 'Asia/Bishkek', 'Asia/Bishkek'),
(339, 'Asia/Brunei', 'Asia/Brunei'),
(340, 'Asia/Chita', 'Asia/Chita'),
(341, 'Asia/Choibalsan', 'Asia/Choibalsan'),
(342, 'Asia/Colombo', 'Asia/Colombo'),
(343, 'Asia/Damascus', 'Asia/Damascus'),
(344, 'Asia/Dhaka', 'Asia/Dhaka'),
(345, 'Asia/Dili', 'Asia/Dili'),
(346, 'Asia/Dubai', 'Asia/Dubai'),
(347, 'Asia/Dushanbe', 'Asia/Dushanbe'),
(348, 'Asia/Famagusta', 'Asia/Famagusta'),
(349, 'Asia/Gaza', 'Asia/Gaza'),
(350, 'Asia/Hebron', 'Asia/Hebron'),
(351, 'Asia/Ho_Chi_Minh', 'Asia/Ho_Chi_Minh'),
(352, 'Asia/Hong_Kong', 'Asia/Hong_Kong'),
(353, 'Asia/Hovd', 'Asia/Hovd'),
(354, 'Asia/Irkutsk', 'Asia/Irkutsk'),
(355, 'Asia/Jakarta', 'Asia/Jakarta'),
(356, 'Asia/Jayapura', 'Asia/Jayapura'),
(357, 'Asia/Jerusalem', 'Asia/Jerusalem'),
(358, 'Asia/Kabul', 'Asia/Kabul'),
(359, 'Asia/Kamchatka', 'Asia/Kamchatka'),
(360, 'Asia/Karachi', 'Asia/Karachi'),
(361, 'Asia/Kathmandu', 'Asia/Kathmandu'),
(362, 'Asia/Khandyga', 'Asia/Khandyga'),
(363, 'Asia/Kolkata', 'Asia/Kolkata'),
(364, 'Asia/Krasnoyarsk', 'Asia/Krasnoyarsk'),
(365, 'Asia/Kuala_Lumpur', 'Asia/Kuala_Lumpur'),
(366, 'Asia/Kuching', 'Asia/Kuching'),
(367, 'Asia/Kuwait', 'Asia/Kuwait'),
(368, 'Asia/Macau', 'Asia/Macau'),
(369, 'Asia/Magadan', 'Asia/Magadan'),
(370, 'Asia/Makassar', 'Asia/Makassar'),
(371, 'Asia/Manila', 'Asia/Manila'),
(372, 'Asia/Muscat', 'Asia/Muscat'),
(373, 'Asia/Nicosia', 'Asia/Nicosia'),
(374, 'Asia/Novokuznetsk', 'Asia/Novokuznetsk'),
(375, 'Asia/Novosibirsk', 'Asia/Novosibirsk'),
(376, 'Asia/Omsk', 'Asia/Omsk'),
(377, 'Asia/Oral', 'Asia/Oral'),
(378, 'Asia/Phnom_Penh', 'Asia/Phnom_Penh'),
(379, 'Asia/Pontianak', 'Asia/Pontianak'),
(380, 'Asia/Pyongyang', 'Asia/Pyongyang'),
(381, 'Asia/Qatar', 'Asia/Qatar'),
(382, 'Asia/Qyzylorda', 'Asia/Qyzylorda'),
(383, 'Asia/Riyadh', 'Asia/Riyadh'),
(384, 'Asia/Sakhalin', 'Asia/Sakhalin'),
(385, 'Asia/Samarkand', 'Asia/Samarkand'),
(386, 'Asia/Seoul', 'Asia/Seoul'),
(387, 'Asia/Shanghai', 'Asia/Shanghai'),
(388, 'Asia/Singapore', 'Asia/Singapore'),
(389, 'Asia/Srednekolymsk', 'Asia/Srednekolymsk'),
(390, 'Asia/Taipei', 'Asia/Taipei'),
(391, 'Asia/Tashkent', 'Asia/Tashkent'),
(392, 'Asia/Tbilisi', 'Asia/Tbilisi'),
(393, 'Asia/Tehran', 'Asia/Tehran'),
(394, 'Asia/Thimphu', 'Asia/Thimphu'),
(395, 'Asia/Tokyo', 'Asia/Tokyo'),
(396, 'Asia/Tomsk', 'Asia/Tomsk'),
(397, 'Asia/Ulaanbaatar', 'Asia/Ulaanbaatar'),
(398, 'Asia/Urumqi', 'Asia/Urumqi'),
(399, 'Asia/Ust-Nera', 'Asia/Ust-Nera'),
(400, 'Asia/Vientiane', 'Asia/Vientiane'),
(401, 'Asia/Vladivostok', 'Asia/Vladivostok'),
(402, 'Asia/Yakutsk', 'Asia/Yakutsk'),
(403, 'Asia/Yangon', 'Asia/Yangon'),
(404, 'Asia/Yekaterinburg', 'Asia/Yekaterinburg'),
(405, 'Asia/Yerevan', 'Asia/Yerevan'),
(406, 'Atlantic/Azores', 'Atlantic/Azores'),
(407, 'Atlantic/Bermuda', 'Atlantic/Bermuda'),
(408, 'Atlantic/Canary', 'Atlantic/Canary'),
(409, 'Atlantic/Cape_Verde', 'Atlantic/Cape_Verde'),
(410, 'Atlantic/Faroe', 'Atlantic/Faroe'),
(411, 'Atlantic/Madeira', 'Atlantic/Madeira'),
(412, 'Atlantic/Reykjavik', 'Atlantic/Reykjavik'),
(413, 'Atlantic/South_Georgia', 'Atlantic/South_Georgia'),
(414, 'Atlantic/St_Helena', 'Atlantic/St_Helena'),
(415, 'Atlantic/Stanley', 'Atlantic/Stanley'),
(416, 'Australia/Adelaide', 'Australia/Adelaide'),
(417, 'Australia/Brisbane', 'Australia/Brisbane'),
(418, 'Australia/Broken_Hill', 'Australia/Broken_Hill'),
(419, 'Australia/Currie', 'Australia/Currie'),
(420, 'Australia/Darwin', 'Australia/Darwin'),
(421, 'Australia/Eucla', 'Australia/Eucla'),
(422, 'Australia/Hobart', 'Australia/Hobart'),
(423, 'Australia/Lindeman', 'Australia/Lindeman'),
(424, 'Australia/Lord_Howe', 'Australia/Lord_Howe'),
(425, 'Australia/Melbourne', 'Australia/Melbourne'),
(426, 'Australia/Perth', 'Australia/Perth'),
(427, 'Australia/Sydney', 'Australia/Sydney'),
(428, 'Europe/Amsterdam', 'Europe/Amsterdam'),
(429, 'Europe/Andorra', 'Europe/Andorra'),
(430, 'Europe/Astrakhan', 'Europe/Astrakhan'),
(431, 'Europe/Athens', 'Europe/Athens'),
(432, 'Europe/Belgrade', 'Europe/Belgrade'),
(433, 'Europe/Berlin', 'Europe/Berlin'),
(434, 'Europe/Bratislava', 'Europe/Bratislava'),
(435, 'Europe/Brussels', 'Europe/Brussels'),
(436, 'Europe/Bucharest', 'Europe/Bucharest'),
(437, 'Europe/Budapest', 'Europe/Budapest'),
(438, 'Europe/Busingen', 'Europe/Busingen'),
(439, 'Europe/Chisinau', 'Europe/Chisinau'),
(440, 'Europe/Copenhagen', 'Europe/Copenhagen'),
(441, 'Europe/Dublin', 'Europe/Dublin'),
(442, 'Europe/Gibraltar', 'Europe/Gibraltar'),
(443, 'Europe/Guernsey', 'Europe/Guernsey'),
(444, 'Europe/Helsinki', 'Europe/Helsinki'),
(445, 'Europe/Isle_of_Man', 'Europe/Isle_of_Man'),
(446, 'Europe/Istanbul', 'Europe/Istanbul'),
(447, 'Europe/Jersey', 'Europe/Jersey'),
(448, 'Europe/Kaliningrad', 'Europe/Kaliningrad'),
(449, 'Europe/Kiev', 'Europe/Kiev'),
(450, 'Europe/Kirov', 'Europe/Kirov'),
(451, 'Europe/Lisbon', 'Europe/Lisbon'),
(452, 'Europe/Ljubljana', 'Europe/Ljubljana'),
(453, 'Europe/London', 'Europe/London'),
(454, 'Europe/Luxembourg', 'Europe/Luxembourg'),
(455, 'Europe/Madrid', 'Europe/Madrid'),
(456, 'Europe/Malta', 'Europe/Malta'),
(457, 'Europe/Mariehamn', 'Europe/Mariehamn'),
(458, 'Europe/Minsk', 'Europe/Minsk'),
(459, 'Europe/Monaco', 'Europe/Monaco'),
(460, 'Europe/Moscow', 'Europe/Moscow'),
(461, 'Europe/Oslo', 'Europe/Oslo'),
(462, 'Europe/Paris', 'Europe/Paris'),
(463, 'Europe/Podgorica', 'Europe/Podgorica'),
(464, 'Europe/Prague', 'Europe/Prague'),
(465, 'Europe/Riga', 'Europe/Riga'),
(466, 'Europe/Rome', 'Europe/Rome'),
(467, 'Europe/Samara', 'Europe/Samara'),
(468, 'Europe/San_Marino', 'Europe/San_Marino'),
(469, 'Europe/Sarajevo', 'Europe/Sarajevo'),
(470, 'Europe/Saratov', 'Europe/Saratov'),
(471, 'Europe/Simferopol', 'Europe/Simferopol'),
(472, 'Europe/Skopje', 'Europe/Skopje'),
(473, 'Europe/Sofia', 'Europe/Sofia'),
(474, 'Europe/Stockholm', 'Europe/Stockholm'),
(475, 'Europe/Tallinn', 'Europe/Tallinn'),
(476, 'Europe/Tirane', 'Europe/Tirane'),
(477, 'Europe/Ulyanovsk', 'Europe/Ulyanovsk'),
(478, 'Europe/Uzhgorod', 'Europe/Uzhgorod'),
(479, 'Europe/Vaduz', 'Europe/Vaduz'),
(480, 'Europe/Vatican', 'Europe/Vatican'),
(481, 'Europe/Vienna', 'Europe/Vienna'),
(482, 'Europe/Vilnius', 'Europe/Vilnius'),
(483, 'Europe/Volgograd', 'Europe/Volgograd'),
(484, 'Europe/Warsaw', 'Europe/Warsaw'),
(485, 'Europe/Zagreb', 'Europe/Zagreb'),
(486, 'Europe/Zaporozhye', 'Europe/Zaporozhye'),
(487, 'Europe/Zurich', 'Europe/Zurich'),
(488, 'Indian/Antananarivo', 'Indian/Antananarivo'),
(489, 'Indian/Chagos', 'Indian/Chagos'),
(490, 'Indian/Christmas', 'Indian/Christmas'),
(491, 'Indian/Cocos', 'Indian/Cocos'),
(492, 'Indian/Comoro', 'Indian/Comoro'),
(493, 'Indian/Kerguelen', 'Indian/Kerguelen'),
(494, 'Indian/Mahe', 'Indian/Mahe'),
(495, 'Indian/Maldives', 'Indian/Maldives'),
(496, 'Indian/Mauritius', 'Indian/Mauritius'),
(497, 'Indian/Mayotte', 'Indian/Mayotte'),
(498, 'Indian/Reunion', 'Indian/Reunion'),
(499, 'Pacific/Apia', 'Pacific/Apia'),
(500, 'Pacific/Auckland', 'Pacific/Auckland'),
(501, 'Pacific/Bougainville', 'Pacific/Bougainville'),
(502, 'Pacific/Chatham', 'Pacific/Chatham'),
(503, 'Pacific/Chuuk', 'Pacific/Chuuk'),
(504, 'Pacific/Easter', 'Pacific/Easter'),
(505, 'Pacific/Efate', 'Pacific/Efate'),
(506, 'Pacific/Enderbury', 'Pacific/Enderbury'),
(507, 'Pacific/Fakaofo', 'Pacific/Fakaofo'),
(508, 'Pacific/Fiji', 'Pacific/Fiji'),
(509, 'Pacific/Funafuti', 'Pacific/Funafuti'),
(510, 'Pacific/Galapagos', 'Pacific/Galapagos'),
(511, 'Pacific/Gambier', 'Pacific/Gambier'),
(512, 'Pacific/Guadalcanal', 'Pacific/Guadalcanal'),
(513, 'Pacific/Guam', 'Pacific/Guam'),
(514, 'Pacific/Honolulu', 'Pacific/Honolulu'),
(515, 'Pacific/Kiritimati', 'Pacific/Kiritimati'),
(516, 'Pacific/Kosrae', 'Pacific/Kosrae'),
(517, 'Pacific/Kwajalein', 'Pacific/Kwajalein'),
(518, 'Pacific/Majuro', 'Pacific/Majuro'),
(519, 'Pacific/Marquesas', 'Pacific/Marquesas'),
(520, 'Pacific/Midway', 'Pacific/Midway'),
(521, 'Pacific/Nauru', 'Pacific/Nauru'),
(522, 'Pacific/Niue', 'Pacific/Niue'),
(523, 'Pacific/Norfolk', 'Pacific/Norfolk'),
(524, 'Pacific/Noumea', 'Pacific/Noumea'),
(525, 'Pacific/Pago_Pago', 'Pacific/Pago_Pago'),
(526, 'Pacific/Palau', 'Pacific/Palau'),
(527, 'Pacific/Pitcairn', 'Pacific/Pitcairn'),
(528, 'Pacific/Pohnpei', 'Pacific/Pohnpei'),
(529, 'Pacific/Port_Moresby', 'Pacific/Port_Moresby'),
(530, 'Pacific/Rarotonga', 'Pacific/Rarotonga'),
(531, 'Pacific/Saipan', 'Pacific/Saipan'),
(532, 'Pacific/Tahiti', 'Pacific/Tahiti'),
(533, 'Pacific/Tarawa', 'Pacific/Tarawa'),
(534, 'Pacific/Tongatapu', 'Pacific/Tongatapu'),
(535, 'Pacific/Wake', 'Pacific/Wake'),
(536, 'Pacific/Wallis', 'Pacific/Wallis'),
(537, 'UTC', 'UTC');

-- --------------------------------------------------------

--
-- Table structure for table `trainers`
--

CREATE TABLE `trainers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `expertise` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trainers`
--

INSERT INTO `trainers` (`id`, `first_name`, `last_name`, `contact_number`, `email`, `expertise`, `address`, `created_at`, `updated_at`) VALUES
(5, 'Meenakshi', 'Rawat', '98765432', 'dfghn@gmail.com', 'dfvg', 'dcfv', '2025-04-30 11:44:35', '2025-05-21 06:19:00');

-- --------------------------------------------------------

--
-- Table structure for table `trainings`
--

CREATE TABLE `trainings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `training_type` varchar(255) NOT NULL,
  `trainer_id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `department_name` varchar(255) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('Completed','Terminated','Started','Pending') DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `performance` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trainings`
--

INSERT INTO `trainings` (`id`, `training_type`, `trainer_id`, `employee_id`, `department_id`, `department_name`, `start_date`, `end_date`, `description`, `status`, `created_at`, `updated_at`, `remarks`, `performance`) VALUES
(35, 'External', 5, 37, 1, NULL, '2025-05-15', '2025-05-30', 'cfvgbsdfghnm', 'Pending', '2025-04-30 11:44:52', '2025-04-30 11:46:46', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `training_types`
--

CREATE TABLE `training_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `travel_allowances`
--

CREATE TABLE `travel_allowances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `travel_allowances`
--

INSERT INTO `travel_allowances` (`id`, `name`) VALUES
(1, 'BREAKFAST'),
(2, 'LUNCH'),
(3, 'DINNER'),
(4, 'SURPLUS(TAXI)'),
(5, 'TOTAL PERDIEM(for each day)'),
(6, 'HOUSING'),
(7, 'HOTEL');

-- --------------------------------------------------------

--
-- Table structure for table `travel_categories`
--

CREATE TABLE `travel_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `division_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `travel_category_allowances`
--

CREATE TABLE `travel_category_allowances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `division_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `travel_allowance_id` bigint(20) UNSIGNED NOT NULL,
  `amount` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `travel_category_allowances`
--

INSERT INTO `travel_category_allowances` (`id`, `division_id`, `category_id`, `travel_allowance_id`, `amount`) VALUES
(2, 1, 1, 1, 25000),
(3, 1, 1, 2, 3000),
(4, 1, 1, 3, 4000),
(5, 1, 1, 4, 2500),
(7, 1, 1, 7, 2000),
(8, 1, 2, 1, 3500),
(9, 1, 2, 2, 5000),
(10, 1, 2, 3, 5000),
(11, 1, 2, 4, 5000),
(12, 1, 2, 5, 16500),
(13, 1, 2, 7, 2000),
(14, 1, 3, 1, 4000),
(15, 1, 3, 2, 7000),
(16, 1, 3, 3, 7000),
(17, 1, 3, 4, 3500),
(18, 1, 3, 5, 21500),
(19, 1, 3, 7, 30000),
(20, 1, 4, 1, 5000),
(21, 1, 4, 2, 9000),
(22, 1, 4, 3, 9000),
(23, 1, 4, 4, 4500),
(24, 1, 4, 5, 27500),
(25, 1, 4, 7, 40000),
(26, 2, 1, 1, 7500),
(27, 2, 1, 2, 15000),
(28, 2, 1, 3, 20000),
(29, 2, 1, 4, 7500),
(30, 2, 1, 5, 32500);

-- --------------------------------------------------------

--
-- Table structure for table `travel_records`
--

CREATE TABLE `travel_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `for_employee` enum('true','false') NOT NULL DEFAULT 'false',
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `travel_from` varchar(255) NOT NULL,
  `travel_to` varchar(255) NOT NULL,
  `travel_date` date NOT NULL,
  `return_date` date NOT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `currency_id` bigint(20) UNSIGNED NOT NULL,
  `funding` decimal(10,2) NOT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `status` enum('pending','inprogress','complete','reject') DEFAULT 'pending',
  `approver1` bigint(20) UNSIGNED DEFAULT NULL,
  `approver2` bigint(20) UNSIGNED DEFAULT NULL,
  `approver3` bigint(20) UNSIGNED DEFAULT NULL,
  `approve1` tinyint(2) DEFAULT NULL,
  `approve2` tinyint(2) DEFAULT NULL,
  `approve3` tinyint(2) DEFAULT NULL,
  `reject_reason` longtext DEFAULT NULL,
  `who_reject` bigint(20) UNSIGNED DEFAULT NULL,
  `is_reject` tinyint(2) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `travel_records`
--

INSERT INTO `travel_records` (`id`, `for_employee`, `employee_id`, `type`, `purpose`, `travel_from`, `travel_to`, `travel_date`, `return_date`, `notes`, `currency_id`, `funding`, `attachment`, `status`, `approver1`, `approver2`, `approver3`, `approve1`, `approve2`, `approve3`, `reject_reason`, `who_reject`, `is_reject`, `created_at`, `updated_at`) VALUES
(31, 'true', 100, 'Taxi', 'meeting', 'dublin', 'kolkata', '2025-05-15', '2025-05-16', 'test', 3, 36500.00, NULL, 'complete', 60, NULL, NULL, 1, NULL, NULL, '', NULL, 0, '2025-05-14 08:07:42', '2025-05-21 11:25:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `rec_id` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `join_date` varchar(255) NOT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `role_name` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `rec_id`, `email`, `join_date`, `phone_number`, `status`, `role_name`, `avatar`, `position`, `department`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(60, 'Admin', 'KHM_0000000060', 'admin@gmail.com', '2025-01-27 15:47:01', NULL, 'Active', 'Admin', NULL, NULL, NULL, NULL, '$2y$10$tWPNZyMidF5r3E9LdhuIQOUx2ckG4sNZg4a89AzwUkposnArZQWFC', NULL, '2025-01-27 10:17:02', '2025-01-27 10:17:02'),
(96, 'Anuj Bisht', 'KHM_0000000096', 'anuj@gmail.com', '2025-04-29 19:26:08', NULL, 'Active', 'HR', NULL, NULL, NULL, NULL, '$2y$10$yVjoXzdyOwQCV.zB1hkaju5P1stAgJKCf1JmO7a7n2ItZ7wNsW3o2', NULL, '2025-04-29 13:56:08', '2025-04-29 13:56:08'),
(97, 'Steve laurnt', 'KHM_0000000097', 'steve@gmail.com', '2025-04-29 19:27:54', NULL, 'Active', 'Direct superior', NULL, NULL, NULL, NULL, '$2y$10$PMfyyFA2uP8UAIOCq12uxO2Ck/yWDdXTe5VmCYlQZUFx0Y9IO3V4y', NULL, '2025-04-29 13:57:54', '2025-04-29 13:57:54'),
(98, 'Harsh Tyagi', 'KHM_0000000098', 'harsh@gmail.com', '2025-04-29 19:29:34', NULL, 'Active', 'Employee', NULL, NULL, NULL, NULL, '$2y$10$zQiXFj6uDQV1MB88xylGAuE29YI4Ck5ftymy0P.Opanwx7i9nfPPi', NULL, '2025-04-29 13:59:34', '2025-04-29 13:59:34'),
(99, 'Prabhat Mehra', 'KHM_0000000099', 'prabhat@gmail.com', '2025-04-29 19:47:09', NULL, 'Active', 'DGA', NULL, NULL, NULL, NULL, '$2y$10$Pz4hJSb2nFe/mXX9Qcr0UeIOKIxOAgKEstPyk0gHfW9J3qSyCJG7W', NULL, '2025-04-29 14:17:09', '2025-04-29 14:17:09'),
(100, 'Sankavi Ravi', 'KHM_0000000100', 'sankavi@gmail.com', '2025-04-29 19:54:57', NULL, 'Active', 'Employee', NULL, NULL, NULL, NULL, '$2y$10$TDzZrI/qmxUbtkBo5JSaUe/HFxhR1osSz68dkjmR6z3wDJ7s2i9T6', NULL, '2025-04-29 14:24:57', '2025-04-29 14:24:57'),
(106, 'sarthak Kaul', 'KHM_0000000107', 'vishal556@rediansoftware.com', '2025-04-30 14:20:24', NULL, 'Active', 'Employee', NULL, NULL, NULL, NULL, '$2y$10$j/q1nwZw.Ep6jVvbZVdLdeHG9OjGNLhXRpXhV5IenZX0PR6nlk2L2', NULL, '2025-04-30 08:50:24', '2025-04-30 08:50:24'),
(111, 'gfds vcxxdf', 'KHM_0000000112', 'nnnnxn@gmail.com', '2025-05-09 12:20:50', NULL, 'Active', 'Employee', NULL, NULL, NULL, NULL, '$2y$10$ulnh1MiU3Ns6URkWzUlCHerXIXAo0rSxyIcMP4MwBbyipqoF9pQxW', NULL, '2025-05-09 06:50:50', '2025-05-09 06:50:50'),
(112, 'lplpl awserr', 'KHM_0000000113', 'plpl@gmail.com', '2025-05-09 12:38:52', NULL, 'Active', 'Manager', NULL, NULL, NULL, NULL, '$2y$10$XpJC2wi6YrJD3gjBt7mQUu4tiC0Ba7PhNB0uzZNGJWCG0B6tymEPW', NULL, '2025-05-09 07:08:52', '2025-05-09 07:08:52'),
(120, 'Neha Rawat', 'KHM_0000000121', 'neha@gmail.com', '2025-05-21 15:50:15', NULL, 'Active', 'Employee', NULL, NULL, NULL, NULL, '$2y$10$Re29OcNv8MYacezHShP8zOtWrIJfzW37y3fXtAPzO5mJtw7MDadbi', NULL, '2025-05-21 10:20:15', '2025-05-21 10:20:15'),
(121, 'Vishnu Kumar', 'KHM_0000000122', 'kumar@gmail.com', '2025-05-21 16:40:00', NULL, 'Active', 'Employee', NULL, NULL, NULL, NULL, '$2y$10$ipL/HzNRPbNT1.WBdsRmfOxY8KYdXppl5nxDSGy7DIwU9VxBx5F.i', NULL, '2025-05-21 11:10:00', '2025-05-21 11:10:00'),
(122, 'test one', 'KHM_0000000123', 'test@gmail.com', '2025-05-22 15:28:39', NULL, 'Active', 'Employee', NULL, NULL, NULL, NULL, '$2y$10$KgbiKB18kjC1Y5wNPLjE5ucKOhzIz37JvUKqk7nXcdTLGooE6v0Vi', NULL, '2025-05-22 09:58:39', '2025-05-22 09:58:39');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `id_store` BEFORE INSERT ON `users` FOR EACH ROW BEGIN
                INSERT INTO sequence_tbls VALUES (NULL);
                SET NEW.rec_id = CONCAT("KHM_", LPAD(LAST_INSERT_ID(), 10, "0"));
            END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user_activity_logs`
--

CREATE TABLE `user_activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `role_name` varchar(255) DEFAULT NULL,
  `modify_user` varchar(255) DEFAULT NULL,
  `date_time` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_exit_qas`
--

CREATE TABLE `user_exit_qas` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `question` longtext NOT NULL,
  `answer` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `type_name`, `created_at`, `updated_at`) VALUES
(1, 'Active', NULL, NULL),
(2, 'Inactive', NULL, NULL),
(3, 'Disable', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `annual_leaves`
--
ALTER TABLE `annual_leaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asset_type_id` (`asset_type_id`),
  ADD KEY `location_id` (`location_id`),
  ADD KEY `fk_lent_to_user` (`lent_to_id`);

--
-- Indexes for table `asset_returns`
--
ALTER TABLE `asset_returns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asset_id` (`asset_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `return_by` (`return_by`);

--
-- Indexes for table `asset_types`
--
ALTER TABLE `asset_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contract_id` (`contract_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendance_employee_foreign` (`employee`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cc_employees`
--
ALTER TABLE `cc_employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `help_request_id` (`help_request_id`),
  ADD KEY `employee_id` (`user_id`);

--
-- Indexes for table `certifications`
--
ALTER TABLE `certifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_details`
--
ALTER TABLE `client_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `company_settings`
--
ALTER TABLE `company_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country` (`country`);

--
-- Indexes for table `company_structures`
--
ALTER TABLE `company_structures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Fk_CompanyStructures_Own` (`parent`),
  ADD KEY `country` (`country`);

--
-- Indexes for table `company_structure_heads`
--
ALTER TABLE `company_structure_heads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contracts`
--
ALTER TABLE `contracts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `currency_types`
--
ALTER TABLE `currency_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `CurrencyTypes_code` (`code`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document_logs`
--
ALTER TABLE `document_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `document_logs_policy_id_foreign` (`policy_id`);

--
-- Indexes for table `educations`
--
ALTER TABLE `educations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Fk_Employee_Nationality` (`nationality`),
  ADD KEY `Fk_Employee_JobTitle` (`job_title`),
  ADD KEY `Fk_Employee_EmploymentStatus` (`employment_status`),
  ADD KEY `Fk_Employee_Country` (`country`),
  ADD KEY `Fk_Employee_CompanyStructures` (`department`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `supervisor` (`supervisor`),
  ADD KEY `approver1` (`approver1`),
  ADD KEY `approver2` (`approver2`),
  ADD KEY `approver3` (`approver3`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `division_id` (`division_id`),
  ADD KEY `travel_category_allowance_id` (`travel_category_allowance_id`),
  ADD KEY `salary_group_id` (`salary_group_id`);

--
-- Indexes for table `employees_training`
--
ALTER TABLE `employees_training`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`,`training_id`),
  ADD KEY `training_id` (`training_id`);

--
-- Indexes for table `employee_annual_leaves`
--
ALTER TABLE `employee_annual_leaves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `employee_leave_logs`
--
ALTER TABLE `employee_leave_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `employee_loans`
--
ALTER TABLE `employee_loans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_loans_employee_id_foreign` (`employee_id`),
  ADD KEY `employee_loans_loan_id_foreign` (`loan_id`),
  ADD KEY `employee_loans_currency_id_foreign` (`currency_id`),
  ADD KEY `approver1` (`approver1`),
  ADD KEY `approver2` (`approver2`),
  ADD KEY `approver3` (`approver3`);

--
-- Indexes for table `employee_payslip`
--
ALTER TABLE `employee_payslip`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `employee_payslip_categories`
--
ALTER TABLE `employee_payslip_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_payslip_components`
--
ALTER TABLE `employee_payslip_components`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_payslip_id` (`employee_payslip_id`),
  ADD KEY `component_id` (`component_id`);

--
-- Indexes for table `employee_projects`
--
ALTER TABLE `employee_projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `employment_status`
--
ALTER TABLE `employment_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ethnicities`
--
ALTER TABLE `ethnicities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `event_users`
--
ALTER TABLE `event_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `help_desk_request`
--
ALTER TABLE `help_desk_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `help_desk_request_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `immigration_status`
--
ALTER TABLE `immigration_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `indicator_form`
--
ALTER TABLE `indicator_form`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`,`job_title_id`),
  ADD KEY `job_title_id` (`job_title_id`);

--
-- Indexes for table `indicator_sub_title`
--
ALTER TABLE `indicator_sub_title`
  ADD PRIMARY KEY (`id`),
  ADD KEY `title_id` (`title_id`);

--
-- Indexes for table `indicator_title`
--
ALTER TABLE `indicator_title`
  ADD PRIMARY KEY (`id`),
  ADD KEY `indicator_title_indicator_form_id_foreign` (`indicator_form_id`);

--
-- Indexes for table `job_titles`
--
ALTER TABLE `job_titles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaves_admins`
--
ALTER TABLE `leaves_admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_details`
--
ALTER TABLE `leave_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `approver1` (`approver1`),
  ADD KEY `approver2` (`approver2`),
  ADD KEY `approver3` (`approver3`),
  ADD KEY `who_reject` (`who_reject`);

--
-- Indexes for table `lent_assets`
--
ALTER TABLE `lent_assets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `asset_id` (`asset_id`);

--
-- Indexes for table `loan_types`
--
ALTER TABLE `loan_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
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
-- Indexes for table `module_permissions`
--
ALTER TABLE `module_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nationalities`
--
ALTER TABLE `nationalities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `overtime_categories`
--
ALTER TABLE `overtime_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `overtime_requests`
--
ALTER TABLE `overtime_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `overtime_requests_employee_id_foreign` (`employee_id`),
  ADD KEY `overtime_requests_category_id_foreign` (`category_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `performance_appraisal`
--
ALTER TABLE `performance_appraisal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`supervisor_emp_id`,`department_id`,`job_title_id`),
  ADD KEY `performance_appraisal_department_id_foreign` (`department_id`),
  ADD KEY `performance_appraisal_job_title_id_foreign` (`job_title_id`),
  ADD KEY `rated_employee_id` (`rated_employee_id`),
  ADD KEY `supervisor_dept_id` (`supervisor_dept_id`,`supervisor_job_title`),
  ADD KEY `supervisor_job_title` (`supervisor_job_title`),
  ADD KEY `performance_appraisal_performance_indicator_id_foreign` (`performance_indicator_id`);

--
-- Indexes for table `performance_appraisals`
--
ALTER TABLE `performance_appraisals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `performance_appraisal_rating`
--
ALTER TABLE `performance_appraisal_rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `performance_appraisal_rating_performance_appraisal_id` (`performance_appraisal_id`),
  ADD KEY `performance_appraisal_rating_title_id` (`title_id`),
  ADD KEY `performance_appraisal_rating_sub_title_id` (`sub_title_id`);

--
-- Indexes for table `performance_goals`
--
ALTER TABLE `performance_goals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`,`job_title_id`,`employee_id`),
  ADD KEY `performance_goals_employee_Id` (`employee_id`),
  ADD KEY `performance_goals_job_title_id` (`job_title_id`);

--
-- Indexes for table `performance_indicator`
--
ALTER TABLE `performance_indicator`
  ADD PRIMARY KEY (`id`),
  ADD KEY `performance_indicator_department_id_foreign` (`department_id`),
  ADD KEY `performance_indicator_employee_id_foreign` (`employee_id`),
  ADD KEY `performance_indicator_job_title_id` (`job_title_id`);

--
-- Indexes for table `performance_indicators`
--
ALTER TABLE `performance_indicators`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `performance_indicator_lists`
--
ALTER TABLE `performance_indicator_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `performance_indicator_rating`
--
ALTER TABLE `performance_indicator_rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `performance_indicator_rating_title_id` (`title_id`),
  ADD KEY `performance_indicator_rating_sub_title_id` (`sub_title_id`),
  ADD KEY `performance_indicator_rating_performance_indicator_id_foreign` (`performance_indicator_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_lists`
--
ALTER TABLE `permission_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `policies`
--
ALTER TABLE `policies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position_types`
--
ALTER TABLE `position_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `profile_information`
--
ALTER TABLE `profile_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_client_id_foreign` (`client_id`);

--
-- Indexes for table `province`
--
ALTER TABLE `province`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Fk_Province_Country` (`country`);

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`),
  ADD KEY `countary_id` (`countary_id`);

--
-- Indexes for table `reactions`
--
ALTER TABLE `reactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`post_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `reimbursements`
--
ALTER TABLE `reimbursements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `role_type_users`
--
ALTER TABLE `role_type_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary_component`
--
ALTER TABLE `salary_component`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `component_name` (`component_name`);

--
-- Indexes for table `salary_group`
--
ALTER TABLE `salary_group`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `salary_group_name` (`salary_group_name`);

--
-- Indexes for table `salary_group_components`
--
ALTER TABLE `salary_group_components`
  ADD PRIMARY KEY (`id`),
  ADD KEY `salary_component_id` (`salary_component_id`,`salary_group_id`),
  ADD KEY `salary_group_components_salary_group_id_foreign` (`salary_group_id`);

--
-- Indexes for table `sequence_tbls`
--
ALTER TABLE `sequence_tbls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_salaries`
--
ALTER TABLE `staff_salaries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timesheets`
--
ALTER TABLE `timesheets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timezones`
--
ALTER TABLE `timezones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `TimezoneNameKey` (`name`);

--
-- Indexes for table `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_email` (`email`),
  ADD UNIQUE KEY `unique_contact_number` (`contact_number`);

--
-- Indexes for table `trainings`
--
ALTER TABLE `trainings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_department` (`department_id`),
  ADD KEY `trainer_id` (`trainer_id`);

--
-- Indexes for table `training_types`
--
ALTER TABLE `training_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `travel_allowances`
--
ALTER TABLE `travel_allowances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `travel_categories`
--
ALTER TABLE `travel_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `division_id` (`division_id`);

--
-- Indexes for table `travel_category_allowances`
--
ALTER TABLE `travel_category_allowances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `division_id` (`division_id`),
  ADD KEY `travel_category_allowances_ibfk_3` (`travel_allowance_id`);

--
-- Indexes for table `travel_records`
--
ALTER TABLE `travel_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `travel_records_currency_id_foreign` (`currency_id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `approver1` (`approver1`),
  ADD KEY `approver2` (`approver2`),
  ADD KEY `approver3` (`approver3`),
  ADD KEY `who_reject` (`who_reject`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_join_date_unique` (`join_date`);

--
-- Indexes for table `user_activity_logs`
--
ALTER TABLE `user_activity_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_exit_qas`
--
ALTER TABLE `user_exit_qas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `annual_leaves`
--
ALTER TABLE `annual_leaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `asset_returns`
--
ALTER TABLE `asset_returns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `asset_types`
--
ALTER TABLE `asset_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cc_employees`
--
ALTER TABLE `cc_employees`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `certifications`
--
ALTER TABLE `certifications`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `client_details`
--
ALTER TABLE `client_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `company_settings`
--
ALTER TABLE `company_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `company_structures`
--
ALTER TABLE `company_structures`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `company_structure_heads`
--
ALTER TABLE `company_structure_heads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contracts`
--
ALTER TABLE `contracts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `currency_types`
--
ALTER TABLE `currency_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `document_logs`
--
ALTER TABLE `document_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `educations`
--
ALTER TABLE `educations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `employees_training`
--
ALTER TABLE `employees_training`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `employee_annual_leaves`
--
ALTER TABLE `employee_annual_leaves`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `employee_leave_logs`
--
ALTER TABLE `employee_leave_logs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_loans`
--
ALTER TABLE `employee_loans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `employee_payslip`
--
ALTER TABLE `employee_payslip`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `employee_payslip_categories`
--
ALTER TABLE `employee_payslip_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `employee_payslip_components`
--
ALTER TABLE `employee_payslip_components`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `employee_projects`
--
ALTER TABLE `employee_projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employment_status`
--
ALTER TABLE `employment_status`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ethnicities`
--
ALTER TABLE `ethnicities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `event_users`
--
ALTER TABLE `event_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `help_desk_request`
--
ALTER TABLE `help_desk_request`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `immigration_status`
--
ALTER TABLE `immigration_status`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `indicator_form`
--
ALTER TABLE `indicator_form`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `indicator_sub_title`
--
ALTER TABLE `indicator_sub_title`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `indicator_title`
--
ALTER TABLE `indicator_title`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `job_titles`
--
ALTER TABLE `job_titles`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT for table `leaves_admins`
--
ALTER TABLE `leaves_admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leave_details`
--
ALTER TABLE `leave_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `lent_assets`
--
ALTER TABLE `lent_assets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `loan_types`
--
ALTER TABLE `loan_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `module_permissions`
--
ALTER TABLE `module_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nationalities`
--
ALTER TABLE `nationalities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `overtime_categories`
--
ALTER TABLE `overtime_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `overtime_requests`
--
ALTER TABLE `overtime_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `performance_appraisal`
--
ALTER TABLE `performance_appraisal`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `performance_appraisals`
--
ALTER TABLE `performance_appraisals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `performance_appraisal_rating`
--
ALTER TABLE `performance_appraisal_rating`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `performance_goals`
--
ALTER TABLE `performance_goals`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `performance_indicator`
--
ALTER TABLE `performance_indicator`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `performance_indicators`
--
ALTER TABLE `performance_indicators`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `performance_indicator_lists`
--
ALTER TABLE `performance_indicator_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `performance_indicator_rating`
--
ALTER TABLE `performance_indicator_rating`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `permission_lists`
--
ALTER TABLE `permission_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `policies`
--
ALTER TABLE `policies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122436345771;

--
-- AUTO_INCREMENT for table `position_types`
--
ALTER TABLE `position_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `profile_information`
--
ALTER TABLE `profile_information`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `province`
--
ALTER TABLE `province`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reactions`
--
ALTER TABLE `reactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reimbursements`
--
ALTER TABLE `reimbursements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `role_type_users`
--
ALTER TABLE `role_type_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `salary_component`
--
ALTER TABLE `salary_component`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `salary_group`
--
ALTER TABLE `salary_group`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `salary_group_components`
--
ALTER TABLE `salary_group_components`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `sequence_tbls`
--
ALTER TABLE `sequence_tbls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `staff_salaries`
--
ALTER TABLE `staff_salaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `timesheets`
--
ALTER TABLE `timesheets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `timezones`
--
ALTER TABLE `timezones`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=538;

--
-- AUTO_INCREMENT for table `trainers`
--
ALTER TABLE `trainers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `trainings`
--
ALTER TABLE `trainings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `training_types`
--
ALTER TABLE `training_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `travel_allowances`
--
ALTER TABLE `travel_allowances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `travel_categories`
--
ALTER TABLE `travel_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `travel_category_allowances`
--
ALTER TABLE `travel_category_allowances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `travel_records`
--
ALTER TABLE `travel_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `user_activity_logs`
--
ALTER TABLE `user_activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_exit_qas`
--
ALTER TABLE `user_exit_qas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assets`
--
ALTER TABLE `assets`
  ADD CONSTRAINT `assets_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`),
  ADD CONSTRAINT `assets_ibfk_2` FOREIGN KEY (`asset_type_id`) REFERENCES `asset_types` (`id`);

--
-- Constraints for table `asset_returns`
--
ALTER TABLE `asset_returns`
  ADD CONSTRAINT `asset_returns_ibfk_1` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`),
  ADD CONSTRAINT `asset_returns_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `attachments`
--
ALTER TABLE `attachments`
  ADD CONSTRAINT `attachments_ibfk_1` FOREIGN KEY (`contract_id`) REFERENCES `contracts` (`id`);

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_employee_foreign` FOREIGN KEY (`employee`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cc_employees`
--
ALTER TABLE `cc_employees`
  ADD CONSTRAINT `cc_employees_help_request_id_foreign` FOREIGN KEY (`help_request_id`) REFERENCES `help_desk_request` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cc_employees_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

--
-- Constraints for table `company_settings`
--
ALTER TABLE `company_settings`
  ADD CONSTRAINT `company_settings_ibfk_1` FOREIGN KEY (`country`) REFERENCES `countries` (`id`);

--
-- Constraints for table `company_structures`
--
ALTER TABLE `company_structures`
  ADD CONSTRAINT `Fk_CompanyStructures_Own` FOREIGN KEY (`parent`) REFERENCES `company_structures` (`id`),
  ADD CONSTRAINT `company_structures_ibfk_1` FOREIGN KEY (`country`) REFERENCES `countries` (`id`);

--
-- Constraints for table `document_logs`
--
ALTER TABLE `document_logs`
  ADD CONSTRAINT `document_logs_policy_id_foreign` FOREIGN KEY (`policy_id`) REFERENCES `policies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `employees_ibfk_10` FOREIGN KEY (`salary_group_id`) REFERENCES `salary_group` (`id`),
  ADD CONSTRAINT `employees_ibfk_11` FOREIGN KEY (`job_title`) REFERENCES `job_titles` (`id`),
  ADD CONSTRAINT `employees_ibfk_2` FOREIGN KEY (`department`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `employees_ibfk_3` FOREIGN KEY (`supervisor`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `employees_ibfk_4` FOREIGN KEY (`approver1`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `employees_ibfk_5` FOREIGN KEY (`approver2`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `employees_ibfk_6` FOREIGN KEY (`approver3`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `employees_ibfk_7` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `employees_ibfk_8` FOREIGN KEY (`division_id`) REFERENCES `divisions` (`id`),
  ADD CONSTRAINT `employees_ibfk_9` FOREIGN KEY (`travel_category_allowance_id`) REFERENCES `employee_payslip_categories` (`id`);

--
-- Constraints for table `employees_training`
--
ALTER TABLE `employees_training`
  ADD CONSTRAINT `employees_training_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `employees_training_ibfk_2` FOREIGN KEY (`training_id`) REFERENCES `trainings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employee_annual_leaves`
--
ALTER TABLE `employee_annual_leaves`
  ADD CONSTRAINT `employee_annual_leaves_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `employee_loans`
--
ALTER TABLE `employee_loans`
  ADD CONSTRAINT `employee_loans_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currency_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `employee_loans_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `employee_loans_ibfk_1` FOREIGN KEY (`approver1`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `employee_loans_ibfk_2` FOREIGN KEY (`approver2`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `employee_loans_ibfk_3` FOREIGN KEY (`approver3`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `employee_loans_loan_id_foreign` FOREIGN KEY (`loan_id`) REFERENCES `loan_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employee_payslip`
--
ALTER TABLE `employee_payslip`
  ADD CONSTRAINT `employee_payslip_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`);

--
-- Constraints for table `employee_payslip_components`
--
ALTER TABLE `employee_payslip_components`
  ADD CONSTRAINT `employee_payslip_components_ibfk_1` FOREIGN KEY (`employee_payslip_id`) REFERENCES `employee_payslip` (`id`),
  ADD CONSTRAINT `employee_payslip_components_ibfk_2` FOREIGN KEY (`component_id`) REFERENCES `salary_component` (`id`);

--
-- Constraints for table `employee_projects`
--
ALTER TABLE `employee_projects`
  ADD CONSTRAINT `employee_projects_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `employee_projects_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`);

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);

--
-- Constraints for table `event_users`
--
ALTER TABLE `event_users`
  ADD CONSTRAINT `event_users_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`),
  ADD CONSTRAINT `event_users_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `help_desk_request`
--
ALTER TABLE `help_desk_request`
  ADD CONSTRAINT `help_desk_request_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `indicator_form`
--
ALTER TABLE `indicator_form`
  ADD CONSTRAINT `indicator_form_department_id` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `indicator_form_ibfk_1` FOREIGN KEY (`job_title_id`) REFERENCES `job_titles` (`id`);

--
-- Constraints for table `indicator_sub_title`
--
ALTER TABLE `indicator_sub_title`
  ADD CONSTRAINT `indicator_sub_title_ibfk_1` FOREIGN KEY (`title_id`) REFERENCES `indicator_title` (`id`);

--
-- Constraints for table `indicator_title`
--
ALTER TABLE `indicator_title`
  ADD CONSTRAINT `indicator_title_ibfk_1` FOREIGN KEY (`indicator_form_id`) REFERENCES `indicator_form` (`id`);

--
-- Constraints for table `job_titles`
--
ALTER TABLE `job_titles`
  ADD CONSTRAINT `job_titles_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);

--
-- Constraints for table `leave_details`
--
ALTER TABLE `leave_details`
  ADD CONSTRAINT `leave_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `leave_details_ibfk_2` FOREIGN KEY (`approver1`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `leave_details_ibfk_3` FOREIGN KEY (`approver2`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `leave_details_ibfk_4` FOREIGN KEY (`approver3`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `leave_details_ibfk_5` FOREIGN KEY (`who_reject`) REFERENCES `users` (`id`);

--
-- Constraints for table `lent_assets`
--
ALTER TABLE `lent_assets`
  ADD CONSTRAINT `lent_assets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lent_assets_ibfk_2` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `overtime_requests`
--
ALTER TABLE `overtime_requests`
  ADD CONSTRAINT `overtime_requests_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `overtime_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `overtime_requests_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `performance_appraisal`
--
ALTER TABLE `performance_appraisal`
  ADD CONSTRAINT `performance_appraisal_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `performance_appraisal_ibfk_2` FOREIGN KEY (`supervisor_emp_id`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `performance_appraisal_ibfk_3` FOREIGN KEY (`job_title_id`) REFERENCES `job_titles` (`id`),
  ADD CONSTRAINT `performance_appraisal_ibfk_4` FOREIGN KEY (`performance_indicator_id`) REFERENCES `performance_indicator` (`id`),
  ADD CONSTRAINT `performance_appraisal_ibfk_5` FOREIGN KEY (`rated_employee_id`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `performance_appraisal_ibfk_6` FOREIGN KEY (`supervisor_dept_id`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `performance_appraisal_ibfk_7` FOREIGN KEY (`supervisor_job_title`) REFERENCES `job_titles` (`id`);

--
-- Constraints for table `performance_appraisal_rating`
--
ALTER TABLE `performance_appraisal_rating`
  ADD CONSTRAINT `performance_appraisal_rating_ibfk_1` FOREIGN KEY (`performance_appraisal_id`) REFERENCES `performance_appraisal` (`id`),
  ADD CONSTRAINT `performance_appraisal_rating_ibfk_2` FOREIGN KEY (`sub_title_id`) REFERENCES `indicator_sub_title` (`id`),
  ADD CONSTRAINT `performance_appraisal_rating_ibfk_3` FOREIGN KEY (`title_id`) REFERENCES `indicator_title` (`id`);

--
-- Constraints for table `performance_goals`
--
ALTER TABLE `performance_goals`
  ADD CONSTRAINT `performance_goals_department_id` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `performance_goals_employee_Id` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `performance_goals_job_title_id` FOREIGN KEY (`job_title_id`) REFERENCES `job_titles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `performance_indicator`
--
ALTER TABLE `performance_indicator`
  ADD CONSTRAINT `performance_indicator_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `performance_indicator_ibfk_2` FOREIGN KEY (`job_title_id`) REFERENCES `job_titles` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `provinces`
--
ALTER TABLE `provinces`
  ADD CONSTRAINT `provinces_ibfk_1` FOREIGN KEY (`countary_id`) REFERENCES `countries` (`id`);

--
-- Constraints for table `reactions`
--
ALTER TABLE `reactions`
  ADD CONSTRAINT `reactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reactions_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reimbursements`
--
ALTER TABLE `reimbursements`
  ADD CONSTRAINT `reimbursements_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `salary_group_components`
--
ALTER TABLE `salary_group_components`
  ADD CONSTRAINT `salary_group_components_salary_component_id` FOREIGN KEY (`salary_component_id`) REFERENCES `salary_component` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `salary_group_components_salary_group_id_foreign` FOREIGN KEY (`salary_group_id`) REFERENCES `salary_group` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `trainings`
--
ALTER TABLE `trainings`
  ADD CONSTRAINT `fk_department` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `trainings_ibfk_1` FOREIGN KEY (`trainer_id`) REFERENCES `trainers` (`id`);

--
-- Constraints for table `travel_categories`
--
ALTER TABLE `travel_categories`
  ADD CONSTRAINT `travel_categories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `travel_categories_ibfk_2` FOREIGN KEY (`division_id`) REFERENCES `divisions` (`id`);

--
-- Constraints for table `travel_category_allowances`
--
ALTER TABLE `travel_category_allowances`
  ADD CONSTRAINT `travel_category_allowances_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `travel_category_allowances_ibfk_2` FOREIGN KEY (`division_id`) REFERENCES `divisions` (`id`),
  ADD CONSTRAINT `travel_category_allowances_ibfk_3` FOREIGN KEY (`travel_allowance_id`) REFERENCES `travel_allowances` (`id`);

--
-- Constraints for table `travel_records`
--
ALTER TABLE `travel_records`
  ADD CONSTRAINT `travel_records_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `travel_records_ibfk_2` FOREIGN KEY (`currency_id`) REFERENCES `currency_types` (`id`),
  ADD CONSTRAINT `travel_records_ibfk_3` FOREIGN KEY (`approver1`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `travel_records_ibfk_4` FOREIGN KEY (`approver2`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `travel_records_ibfk_5` FOREIGN KEY (`approver3`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `travel_records_ibfk_6` FOREIGN KEY (`who_reject`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
