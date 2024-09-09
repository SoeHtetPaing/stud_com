-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2024 at 06:04 PM
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
-- Database: `stud_com`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `announcer_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `content`, `announcer_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 'ကွန်ပျူတာတက္ကသိုလ်ပြည် ပထမနှစ်မှ စတုတ္ထနှစ်အထိ သင်တန်းများ စတင်ဖွင့်လှစ်မည်ဖြစ်ကြောင်း', '6.6.2024 မှစ၍ ကွန်ပျူတာတက္ကသိုလ်ပြည် ပထမနှစ်မှ စတုတ္ထနှစ်အထိ သင်တန်းများ စတင်ဖွင့်လှစ်မည်ဖြစ်ကြောင်း ကြေငြာအပ်ပါသည်။ နည်းပညာတက္ကသိုလ်များနှင့် ကွန်ပျူတာတက္ကသိုလ်များ၏ ကိုပါပူးတွဲကြေငြာအပ်ပါသည်။', 1, '6089411796730494565_121.jpg', '2024-08-23 17:51:21', '2024-08-23 17:51:21'),
(2, 'ကွန်ပျူတာတက္ကသိုလ်ပြည် ကျောင်းအပ်လက်ခံမည့်ရက်များ', 'ပတမနှစ်(ဝင်ခွင့်) - ၁၆.၁၁.၂၀၂၃\r\nဒုတိယနှစ်မှ ပဥ္စမနှစ်အထိ - ၁၄.၁၁.၂၀၂၃', 2, '6089411796730494569_121.jpg', '2024-08-23 18:08:42', '2024-08-23 18:08:42'),
(3, 'IT Business Plan ပြိုင်ပွဲ Result', '၂၀၂၃-၂၀၂၄ ပညာသင်နှစ်၊ ကွန်ပျူတာတက္ကသိုလ်(ပြည်)တွင် (၁.၃.၂၀၂၄) ရက်နေ့၌ ကျင်းပခဲ့သော IT Business Plan ပြိုင်ပွဲတွင် ဆုရရှိသောအဖွဲ့များကို အောက်ပါအတိုင်း\r\nထုတ်ပြန်ကြေညာလိုက်သည်။', 2, '6089411796730494570_121.jpg', '2024-08-23 18:13:18', '2024-08-23 18:13:18'),
(4, 'Midterm exam များကို 21-3-2024 မှ 3.4.2024 အထိ ပြုလုပ်သွားမည်ဖြစ်ကြောင်း', '2023-2024 ပညာသင်နှစ် ကွန်ပျူတာတက္ကသိုလ်ပြည် midterm exam များကို 21-3-2024 မှ 3.4.2024 အထိ ပြုလုပ်သွားမည်ဖြစ်ကြောင်း ကြေငြာအပ်ပါသည်။ Fifth Year Bc.Sc Exam Timetable မှာ အောက်ပါအတိုင်းဖြစ်ပါသည်။', 1, '6089411796730494571_121.jpg', '2024-08-23 18:18:22', '2024-08-23 18:18:22');

-- --------------------------------------------------------

--
-- Table structure for table `announcement_notis`
--

CREATE TABLE `announcement_notis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `announce_id` int(11) NOT NULL,
  `audience_id` int(11) NOT NULL,
  `is_seen` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announcement_notis`
--

INSERT INTO `announcement_notis` (`id`, `announce_id`, `audience_id`, `is_seen`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 0, '2024-08-23 17:51:21', '2024-08-23 17:51:21'),
(2, 1, 3, 1, '2024-08-23 17:51:21', '2024-08-23 23:08:18'),
(3, 1, 4, 0, '2024-08-23 17:51:21', '2024-08-23 17:51:21'),
(4, 1, 5, 0, '2024-08-23 17:51:21', '2024-08-23 17:51:21'),
(5, 1, 6, 0, '2024-08-23 17:51:21', '2024-08-23 17:51:21'),
(6, 1, 7, 0, '2024-08-23 17:51:21', '2024-08-23 17:51:21'),
(7, 1, 8, 0, '2024-08-23 17:51:21', '2024-08-23 17:51:21'),
(8, 1, 9, 0, '2024-08-23 17:51:21', '2024-08-23 17:51:21'),
(9, 1, 10, 0, '2024-08-23 17:51:21', '2024-08-23 17:51:21'),
(10, 1, 11, 0, '2024-08-23 17:51:21', '2024-08-23 17:51:21'),
(11, 2, 3, 0, '2024-08-23 18:08:42', '2024-08-23 18:08:42'),
(12, 2, 4, 0, '2024-08-23 18:08:42', '2024-08-23 18:08:42'),
(13, 2, 5, 0, '2024-08-23 18:08:42', '2024-08-23 18:08:42'),
(14, 2, 6, 0, '2024-08-23 18:08:42', '2024-08-23 18:08:42'),
(15, 2, 7, 0, '2024-08-23 18:08:42', '2024-08-23 18:08:42'),
(16, 2, 8, 0, '2024-08-23 18:08:42', '2024-08-23 18:08:42'),
(17, 2, 9, 0, '2024-08-23 18:08:42', '2024-08-23 18:08:42'),
(18, 2, 10, 0, '2024-08-23 18:08:42', '2024-08-23 18:08:42'),
(19, 2, 11, 0, '2024-08-23 18:08:42', '2024-08-23 18:08:42'),
(20, 3, 3, 1, '2024-08-23 18:13:18', '2024-09-08 15:05:40'),
(21, 3, 4, 0, '2024-08-23 18:13:18', '2024-08-23 18:13:18'),
(22, 3, 5, 0, '2024-08-23 18:13:18', '2024-08-23 18:13:18'),
(23, 3, 6, 0, '2024-08-23 18:13:18', '2024-08-23 18:13:18'),
(24, 3, 7, 0, '2024-08-23 18:13:18', '2024-08-23 18:13:18'),
(25, 3, 8, 0, '2024-08-23 18:13:18', '2024-08-23 18:13:18'),
(26, 3, 9, 0, '2024-08-23 18:13:18', '2024-08-23 18:13:18'),
(27, 3, 10, 0, '2024-08-23 18:13:18', '2024-08-23 18:13:18'),
(28, 3, 11, 1, '2024-08-23 18:13:18', '2024-08-23 23:32:39'),
(29, 4, 3, 0, '2024-08-23 18:18:22', '2024-08-23 18:18:22'),
(30, 4, 4, 1, '2024-08-23 18:18:22', '2024-08-30 07:35:25'),
(31, 4, 5, 0, '2024-08-23 18:18:22', '2024-08-23 18:18:22'),
(32, 4, 6, 0, '2024-08-23 18:18:22', '2024-08-23 18:18:22'),
(33, 4, 7, 0, '2024-08-23 18:18:22', '2024-08-23 18:18:22'),
(34, 4, 8, 0, '2024-08-23 18:18:22', '2024-08-23 18:18:22'),
(35, 4, 9, 0, '2024-08-23 18:18:22', '2024-08-23 18:18:22'),
(36, 4, 10, 0, '2024-08-23 18:18:22', '2024-08-23 18:18:22'),
(37, 4, 11, 0, '2024-08-23 18:18:22', '2024-08-23 18:18:22');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('0048883cae3d3d5ec8e36a81443fae11', 'i:2;', 1725029440),
('0048883cae3d3d5ec8e36a81443fae11:timer', 'i:1725029440;', 1725029440),
('00741798cd1dac114821eb11d5522861', 'i:1;', 1725801628),
('00741798cd1dac114821eb11d5522861:timer', 'i:1725801628;', 1725801628),
('570931452d891f2805504568daf6ef1d', 'i:3;', 1725027998),
('570931452d891f2805504568daf6ef1d:timer', 'i:1725027998;', 1725027998),
('6229789564b8cae58224fc7b243f8941', 'i:2;', 1725015168),
('6229789564b8cae58224fc7b243f8941:timer', 'i:1725015168;', 1725015168),
('c864c277111a8ac78063a92260d5f4f6', 'i:2;', 1725026975),
('c864c277111a8ac78063a92260d5f4f6:timer', 'i:1725026975;', 1725026975),
('da4b9237bacccdf19c0760cab7aec4a8359010b0', 'i:1;', 1725765156),
('da4b9237bacccdf19c0760cab7aec4a8359010b0:timer', 'i:1725765156;', 1725765156),
('e1b3f82d72fd8e2c379313aa51c38399', 'i:1;', 1725800957),
('e1b3f82d72fd8e2c379313aa51c38399:timer', 'i:1725800957;', 1725800957),
('e7b3fca6f9364134a92b766de5238187', 'i:2;', 1725028386),
('e7b3fca6f9364134a92b766de5238187:timer', 'i:1725028386;', 1725028386),
('e920b7acb29e201da240a6bfce622024', 'i:1;', 1725801459),
('e920b7acb29e201da240a6bfce622024:timer', 'i:1725801459;', 1725801459),
('f286c893676532e73054b12d0f080d95', 'i:1;', 1725014145),
('f286c893676532e73054b12d0f080d95:timer', 'i:1725014145;', 1725014145);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat_configs`
--

CREATE TABLE `chat_configs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `mynew` int(11) NOT NULL DEFAULT 0,
  `yrnew` int(11) NOT NULL DEFAULT 0,
  `is_active` int(11) NOT NULL,
  `lat` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `creater_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chat_configs`
--

INSERT INTO `chat_configs` (`id`, `user_id`, `mynew`, `yrnew`, `is_active`, `lat`, `creater_id`, `group_id`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 3, 1, '2024-08-30 08:20:12', 1, 1, '2024-08-30 07:20:37', '2024-08-30 08:20:12'),
(2, 3, 0, 0, 0, '2024-09-08 14:41:09', 1, 1, '2024-08-30 07:20:37', '2024-09-08 14:41:09'),
(3, 9, 0, 3, 1, '2024-08-30 08:20:12', 1, 1, '2024-08-30 07:20:37', '2024-08-30 08:20:12'),
(4, 7, 0, 3, 1, '2024-08-30 08:20:12', 1, 1, '2024-08-30 07:20:37', '2024-08-30 08:20:12'),
(6, 8, 0, 4, 1, '2024-08-30 08:20:12', 1, 1, '2024-08-30 07:23:14', '2024-08-30 08:20:12'),
(7, 1, 0, 0, 0, '2024-08-30 13:59:11', 1, 2, '2024-08-30 07:25:50', '2024-08-30 07:29:11'),
(8, 5, 0, 1, 1, '2024-08-30 07:25:50', 1, 2, '2024-08-30 07:25:50', '2024-08-30 07:25:50'),
(9, 6, 0, 1, 1, '2024-08-30 07:25:50', 1, 2, '2024-08-30 07:25:50', '2024-08-30 07:25:50'),
(10, 2, 0, 0, 0, '2024-09-08 03:16:08', 2, 3, '2024-08-30 07:26:28', '2024-09-07 20:46:08'),
(11, 3, 0, 1, 0, '2024-08-30 13:59:11', 2, 3, '2024-08-30 07:26:28', '2024-08-30 07:29:11'),
(12, 11, 0, 1, 1, '2024-08-30 07:26:28', 2, 3, '2024-08-30 07:26:28', '2024-08-30 07:26:28'),
(13, 2, 0, 0, 0, '2024-09-08 03:21:13', 2, 4, '2024-08-30 07:27:43', '2024-09-07 20:51:13'),
(14, 9, 0, 1, 0, '2024-08-30 13:59:48', 2, 4, '2024-08-30 07:27:43', '2024-08-30 07:29:48'),
(15, 1, 0, 3, 0, '2024-08-30 14:30:26', 1, 5, '2024-08-30 07:29:11', '2024-08-30 08:00:26'),
(16, 3, 0, 4, 0, '2024-08-30 14:31:11', 1, 5, '2024-08-30 07:29:11', '2024-08-30 08:01:11'),
(17, 1, 0, 1, 0, '2024-08-30 14:45:11', 1, 6, '2024-08-30 07:29:48', '2024-08-30 08:15:11'),
(18, 9, 0, 1, 0, '2024-08-30 14:32:46', 1, 6, '2024-08-30 07:29:48', '2024-08-30 08:02:46'),
(19, 4, 0, 0, 1, '2024-08-30 07:41:35', 4, 7, '2024-08-30 07:41:35', '2024-08-30 07:41:35'),
(20, 3, 0, 1, 0, '2024-08-30 14:20:50', 4, 7, '2024-08-30 07:41:35', '2024-08-30 07:50:50'),
(21, 9, 0, 1, 0, '2024-08-30 14:16:54', 4, 7, '2024-08-30 07:41:35', '2024-08-30 07:46:54'),
(22, 7, 0, 1, 0, '2024-08-30 14:16:54', 4, 7, '2024-08-30 07:41:35', '2024-08-30 07:46:54'),
(23, 8, 0, 1, 0, '2024-08-30 14:16:54', 4, 7, '2024-08-30 07:41:35', '2024-08-30 07:46:54'),
(24, 3, 0, 0, 0, '2024-09-08 14:22:31', 3, 8, '2024-08-30 07:46:54', '2024-09-08 14:22:31'),
(25, 7, 0, 1, 0, '2024-08-30 14:45:11', 3, 8, '2024-08-30 07:46:54', '2024-08-30 08:15:11'),
(26, 9, 0, 1, 0, '2024-08-30 14:30:03', 3, 8, '2024-08-30 07:46:54', '2024-08-30 08:00:03'),
(27, 8, 0, 1, 0, '2024-08-30 14:45:11', 3, 8, '2024-08-30 07:46:54', '2024-08-30 08:15:11'),
(28, 9, 0, 3, 0, '2024-08-30 14:45:11', 9, 9, '2024-08-30 08:02:46', '2024-08-30 08:15:11'),
(29, 3, 0, 2, 0, '2024-08-30 14:43:25', 9, 9, '2024-08-30 08:02:46', '2024-08-30 08:13:25'),
(30, 2, 0, 0, 0, '2024-09-08 15:13:53', 2, 10, '2024-09-07 20:46:08', '2024-09-08 15:13:53'),
(31, 14, 0, 0, 0, '2024-09-08 15:12:14', 2, 10, '2024-09-07 20:46:09', '2024-09-08 15:12:14'),
(32, 14, 0, 1, 1, '2024-09-08 15:12:14', 14, 11, '2024-09-08 13:18:05', '2024-09-08 15:12:14'),
(33, 3, 0, 0, 0, '2024-09-08 15:13:53', 14, 11, '2024-09-08 13:18:05', '2024-09-08 15:13:53'),
(34, 3, 0, 0, 1, '2024-09-08 15:25:43', 3, 12, '2024-09-08 15:13:53', '2024-09-08 15:25:43'),
(35, 2, 0, 1, 1, '2024-09-08 15:13:53', 3, 12, '2024-09-08 15:13:53', '2024-09-08 15:13:53');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'First Year', '2024-07-01 02:30:00', '2024-07-01 02:30:00'),
(2, 'Second Year', '2024-07-11 12:50:34', '2024-07-11 12:50:34'),
(3, 'Third Year', '2024-07-11 12:50:47', '2024-07-11 12:50:47'),
(4, 'Fourth Year', '2024-07-11 12:51:06', '2024-07-11 12:51:06'),
(5, 'Final Year', '2024-07-11 12:51:18', '2024-07-11 12:51:18'),
(6, 'Department of Student\'s Affairs', '2024-07-11 12:53:54', '2024-07-11 12:53:54'),
(7, 'Department of Budget', '2024-07-11 12:55:12', '2024-07-11 12:55:12'),
(8, 'Department of Administration', '2024-07-11 12:55:32', '2024-07-11 12:55:32'),
(9, 'Faculty of Computer Systems and Technologies (FCST)', '2024-07-11 12:56:30', '2024-07-11 12:56:30'),
(10, 'Faculty of Computer Science (FCS)', '2024-07-11 12:56:52', '2024-07-11 12:56:52'),
(11, 'Faculty of Information Science (FIS)', '2024-07-11 12:57:14', '2024-07-11 12:57:14'),
(12, 'Faculty of Information Technology Supporting and Maintenance (ITSM)', '2024-07-11 12:57:46', '2024-07-11 12:57:46'),
(13, 'Myanmar Department', '2024-07-11 12:58:17', '2024-07-11 12:58:17'),
(14, 'English Department', '2024-07-11 12:58:35', '2024-07-11 12:58:35'),
(15, 'Physics Department', '2024-07-11 12:58:58', '2024-07-11 12:58:58'),
(16, 'Faculty of Computing', '2024-07-11 12:59:17', '2024-07-11 12:59:17'),
(17, 'Granduate', '2024-08-23 18:27:31', '2024-08-23 18:27:31');

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
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `mygn` varchar(255) DEFAULT NULL,
  `yrgn` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `creater_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `mygimg` varchar(255) DEFAULT NULL,
  `yrgimg` varchar(255) DEFAULT NULL,
  `myid` int(11) DEFAULT NULL,
  `yrid` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `mygn`, `yrgn`, `type`, `creater_id`, `image`, `mygimg`, `yrgimg`, `myid`, `yrid`, `created_at`, `updated_at`) VALUES
(1, 'Final Year', NULL, NULL, 'mul2mul', 1, 'stud_com.png', NULL, NULL, NULL, NULL, '2024-08-30 07:20:37', '2024-08-30 07:20:37'),
(2, 'Faculty of Computing', NULL, NULL, 'mul2mul', 1, NULL, NULL, NULL, NULL, NULL, '2024-08-30 07:25:50', '2024-08-30 07:25:50'),
(3, 'Final Year ECs & Instructor', NULL, NULL, 'mul2mul', 2, NULL, NULL, NULL, NULL, NULL, '2024-08-30 07:26:28', '2024-08-30 07:26:28'),
(4, 'gStu2bless9', 'Chan Myae Thu', 'Daw Khin Soe Han', 'grade2announce', 2, NULL, 'profile-photos/66cf4d0e82957iQpp-v4.jpg', NULL, 2, 9, '2024-08-30 07:27:43', '2024-08-30 07:27:43'),
(5, 'gStu1bless3', 'Soe Htet Paing', 'Genius iQ', 'grade2announce', 1, NULL, 'profile-photos/66cf4a0f00cf2iQpp-v3.jpg', 'profile-photos/AlK7aCSULyboOgO1Vup8tW6g3f6yvV3IA9969Mzv.jpg', 1, 3, '2024-08-30 07:29:11', '2024-08-30 07:29:11'),
(6, 'gStu1bless9', 'Chan Myae Thu', 'Genius iQ', 'grade2announce', 1, NULL, 'profile-photos/66cf4d0e82957iQpp-v4.jpg', 'profile-photos/AlK7aCSULyboOgO1Vup8tW6g3f6yvV3IA9969Mzv.jpg', 1, 9, '2024-08-30 07:29:48', '2024-08-30 07:29:48'),
(7, '5CS-B IELTS', NULL, NULL, 'mul2mul', 4, 'viber_image_2024-08-25_15-17-38-585.jpg', NULL, NULL, NULL, NULL, '2024-08-30 07:41:35', '2024-08-30 07:41:35'),
(8, '5CS-B Activity Servery', NULL, NULL, 'mul2mul', 3, 'viber_image_2024-08-25_15-20-53-291.jpg', NULL, NULL, NULL, NULL, '2024-08-30 07:46:54', '2024-08-30 07:46:54'),
(9, 'gStu9bless3', 'Soe Htet Paing', 'Chan Myae Thu', 'sig2sig', 9, NULL, 'profile-photos/66cf4a0f00cf2iQpp-v3.jpg', 'profile-photos/66cf4d0e82957iQpp-v4.jpg', 9, 3, '2024-08-30 08:02:46', '2024-08-30 08:02:46'),
(10, 'gStu2bless14', 'Daw Hnin Nandar Zaw', 'Daw Khin Soe Han', 'sig2sig', 2, NULL, NULL, NULL, 2, 14, '2024-09-07 20:46:08', '2024-09-07 20:46:08'),
(11, 'gStu14bless3', 'Soe Htet Paing', 'Daw Hnin Nandar Zaw', 'sig2sig', 14, NULL, 'profile-photos/66cf4a0f00cf2iQpp-v3.jpg', NULL, 14, 3, '2024-09-08 13:18:05', '2024-09-08 13:18:05'),
(12, 'gStu3bless2', 'Daw Khin Soe Han', 'Soe Htet Paing', 'sig2sig', 3, NULL, NULL, 'profile-photos/66cf4a0f00cf2iQpp-v3.jpg', 3, 2, '2024-09-08 15:13:53', '2024-09-08 15:13:53');

-- --------------------------------------------------------

--
-- Table structure for table `group_conversations`
--

CREATE TABLE `group_conversations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `message` text DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `grade_announce` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `group_conversations`
--

INSERT INTO `group_conversations` (`id`, `group_id`, `member_id`, `message`, `attachment`, `grade_announce`, `created_at`, `updated_at`) VALUES
(1, 4, 13, '4CS-92@1sem2023', '66d1cfd79999b-iQ-6089411796730494570_121.jpg', 1, '2024-08-30 07:27:43', '2024-08-30 07:27:43'),
(2, 5, 15, '4CS-62@1sem2023', '66d1d02f2c3f6-iQ-1stSemGrade4CS-62.pdf', 1, '2024-08-30 07:29:11', '2024-08-30 07:29:11'),
(3, 6, 17, '5CS-42@1sem2024', '66d1d0543ca9c-iQ-6089411796730494565_121.jpg', 1, '2024-08-30 07:29:48', '2024-08-30 07:29:48'),
(4, 5, 15, '5CS-13@1sem2024', '66d1d07f55172-iQ-5CS-13.pdf', 1, '2024-08-30 07:30:31', '2024-08-30 07:30:31'),
(5, 5, 16, 'မင်္ဂလာပါဗျ', NULL, 0, '2024-08-30 07:55:23', '2024-08-30 07:55:23'),
(6, 5, 15, 'Congratulation Bro!', NULL, 0, '2024-08-30 07:57:32', '2024-08-30 07:57:32'),
(7, 5, 16, 'Why?', NULL, 0, '2024-08-30 07:58:03', '2024-08-30 07:58:03'),
(8, 5, 15, 'Your grade', NULL, 0, '2024-08-30 07:58:17', '2024-08-30 07:58:17'),
(9, 5, 16, 'Aww thanks!', NULL, 0, '2024-08-30 07:58:51', '2024-08-30 07:58:51'),
(10, 6, 18, 'ရှဲရှဲ', NULL, 0, '2024-08-30 08:00:26', '2024-08-30 08:00:26'),
(11, 9, 28, 'Hey!', NULL, 0, '2024-08-30 08:03:22', '2024-08-30 08:03:22'),
(12, 9, 29, 'What up!', NULL, 0, '2024-08-30 08:03:47', '2024-08-30 08:03:47'),
(13, 9, 29, NULL, '66d1d8fd183fb-iQ-Job  Acceptance Letter MIT@5-7-24.pdf', 0, '2024-08-30 08:06:45', '2024-08-30 08:06:45'),
(14, 9, 29, 'IU ပုံလေး', '66d1d99d7a19a-iQ-1706725352219.jpg', 0, '2024-08-30 08:09:25', '2024-08-30 08:09:25'),
(15, 1, 2, 'မနက်ဖြန် ဟောပြောပွဲ ရှိပါတယ်. ကျောင်းသား အားလုံး uniform ဝတ်လာကြပါ.', NULL, 0, '2024-08-30 08:15:11', '2024-08-30 08:15:11'),
(16, 1, 3, 'Okay!', NULL, 0, '2024-08-30 08:17:49', '2024-08-30 08:17:49'),
(17, 1, 4, 'Okay!', NULL, 0, '2024-08-30 08:20:12', '2024-08-30 08:20:12'),
(18, 10, 30, 'Hi', NULL, 0, '2024-09-07 20:47:39', '2024-09-07 20:47:39'),
(19, 10, 31, 'Hello', NULL, 0, '2024-09-07 20:51:40', '2024-09-07 20:51:40'),
(20, 10, 31, 'Hi', NULL, 0, '2024-09-08 13:17:14', '2024-09-08 13:17:14'),
(21, 11, 32, 'Hi', NULL, 0, '2024-09-08 13:18:10', '2024-09-08 13:18:10'),
(22, 11, 33, 'မင်္ဂလာပါဗျ', NULL, 0, '2024-09-08 13:19:46', '2024-09-08 13:19:46'),
(23, 11, 33, 'presentation date သိချင်လို့ပါ တီချယ်', NULL, 0, '2024-09-08 14:20:06', '2024-09-08 14:20:06'),
(24, 11, 33, 'Aww thanks!', NULL, 0, '2024-09-08 15:12:14', '2024-09-08 15:12:14');

-- --------------------------------------------------------

--
-- Table structure for table `group_conversation_notis`
--

CREATE TABLE `group_conversation_notis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `conversation_id` int(11) NOT NULL,
  `audience_id` int(11) NOT NULL,
  `is_seen` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `group_conversation_notis`
--

INSERT INTO `group_conversation_notis` (`id`, `conversation_id`, `audience_id`, `is_seen`, `created_at`, `updated_at`) VALUES
(1, 1, 9, 0, '2024-08-30 07:27:43', '2024-08-30 07:27:43'),
(2, 2, 3, 0, '2024-08-30 07:29:11', '2024-08-30 07:29:11'),
(3, 3, 9, 0, '2024-08-30 07:29:48', '2024-08-30 07:29:48'),
(4, 4, 3, 0, '2024-08-30 07:30:31', '2024-08-30 07:30:31'),
(5, 5, 1, 0, '2024-08-30 07:55:23', '2024-08-30 07:55:23'),
(6, 6, 3, 0, '2024-08-30 07:57:32', '2024-08-30 07:57:32'),
(7, 7, 1, 0, '2024-08-30 07:58:03', '2024-08-30 07:58:03'),
(8, 8, 3, 0, '2024-08-30 07:58:17', '2024-08-30 07:58:17'),
(9, 9, 1, 0, '2024-08-30 07:58:51', '2024-08-30 07:58:51'),
(10, 10, 1, 0, '2024-08-30 08:00:26', '2024-08-30 08:00:26'),
(11, 11, 3, 0, '2024-08-30 08:03:22', '2024-08-30 08:03:22'),
(12, 12, 9, 0, '2024-08-30 08:03:47', '2024-08-30 08:03:47'),
(13, 13, 9, 0, '2024-08-30 08:06:45', '2024-08-30 08:06:45'),
(14, 14, 9, 0, '2024-08-30 08:09:25', '2024-08-30 08:09:25'),
(15, 15, 1, 0, '2024-08-30 08:15:11', '2024-08-30 08:15:11'),
(16, 15, 9, 0, '2024-08-30 08:15:11', '2024-08-30 08:15:11'),
(17, 15, 7, 0, '2024-08-30 08:15:11', '2024-08-30 08:15:11'),
(18, 15, 8, 0, '2024-08-30 08:15:11', '2024-08-30 08:15:11'),
(19, 16, 1, 0, '2024-08-30 08:17:49', '2024-08-30 08:17:49'),
(20, 16, 3, 0, '2024-08-30 08:17:49', '2024-08-30 08:17:49'),
(21, 16, 7, 0, '2024-08-30 08:17:49', '2024-08-30 08:17:49'),
(22, 16, 8, 0, '2024-08-30 08:17:49', '2024-08-30 08:17:49'),
(23, 17, 1, 0, '2024-08-30 08:20:12', '2024-08-30 08:20:12'),
(24, 17, 3, 0, '2024-08-30 08:20:12', '2024-08-30 08:20:12'),
(25, 17, 9, 0, '2024-08-30 08:20:12', '2024-08-30 08:20:12'),
(26, 17, 8, 0, '2024-08-30 08:20:12', '2024-08-30 08:20:12'),
(27, 18, 14, 0, '2024-09-07 20:47:39', '2024-09-07 20:47:39'),
(28, 19, 2, 0, '2024-09-07 20:51:40', '2024-09-07 20:51:40'),
(29, 20, 2, 0, '2024-09-08 13:17:14', '2024-09-08 13:17:14'),
(30, 21, 3, 0, '2024-09-08 13:18:10', '2024-09-08 13:18:10'),
(31, 22, 14, 0, '2024-09-08 13:19:46', '2024-09-08 13:19:46'),
(32, 23, 14, 0, '2024-09-08 14:20:06', '2024-09-08 14:20:06'),
(33, 24, 14, 0, '2024-09-08 15:12:14', '2024-09-08 15:12:14');

-- --------------------------------------------------------

--
-- Table structure for table `group_members`
--

CREATE TABLE `group_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `group_members`
--

INSERT INTO `group_members` (`id`, `group_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2024-08-30 07:20:37', '2024-08-30 07:20:37'),
(2, 1, 3, '2024-08-30 07:20:37', '2024-08-30 07:20:37'),
(3, 1, 9, '2024-08-30 07:20:37', '2024-08-30 07:20:37'),
(4, 1, 7, '2024-08-30 07:20:37', '2024-08-30 07:20:37'),
(6, 1, 8, '2024-08-30 07:23:14', '2024-08-30 07:23:14'),
(7, 2, 1, '2024-08-30 07:25:50', '2024-08-30 07:25:50'),
(8, 2, 5, '2024-08-30 07:25:50', '2024-08-30 07:25:50'),
(9, 2, 6, '2024-08-30 07:25:50', '2024-08-30 07:25:50'),
(10, 3, 2, '2024-08-30 07:26:28', '2024-08-30 07:26:28'),
(11, 3, 3, '2024-08-30 07:26:28', '2024-08-30 07:26:28'),
(12, 3, 11, '2024-08-30 07:26:28', '2024-08-30 07:26:28'),
(13, 4, 2, '2024-08-30 07:27:43', '2024-08-30 07:27:43'),
(14, 4, 9, '2024-08-30 07:27:43', '2024-08-30 07:27:43'),
(15, 5, 1, '2024-08-30 07:29:11', '2024-08-30 07:29:11'),
(16, 5, 3, '2024-08-30 07:29:11', '2024-08-30 07:29:11'),
(17, 6, 1, '2024-08-30 07:29:48', '2024-08-30 07:29:48'),
(18, 6, 9, '2024-08-30 07:29:48', '2024-08-30 07:29:48'),
(19, 7, 4, '2024-08-30 07:41:35', '2024-08-30 07:41:35'),
(20, 7, 3, '2024-08-30 07:41:35', '2024-08-30 07:41:35'),
(21, 7, 9, '2024-08-30 07:41:35', '2024-08-30 07:41:35'),
(22, 7, 7, '2024-08-30 07:41:35', '2024-08-30 07:41:35'),
(23, 7, 8, '2024-08-30 07:41:35', '2024-08-30 07:41:35'),
(24, 8, 3, '2024-08-30 07:46:54', '2024-08-30 07:46:54'),
(25, 8, 7, '2024-08-30 07:46:54', '2024-08-30 07:46:54'),
(26, 8, 9, '2024-08-30 07:46:54', '2024-08-30 07:46:54'),
(27, 8, 8, '2024-08-30 07:46:54', '2024-08-30 07:46:54'),
(28, 9, 9, '2024-08-30 08:02:46', '2024-08-30 08:02:46'),
(29, 9, 3, '2024-08-30 08:02:46', '2024-08-30 08:02:46'),
(30, 10, 2, '2024-09-07 20:46:08', '2024-09-07 20:46:08'),
(31, 10, 14, '2024-09-07 20:46:09', '2024-09-07 20:46:09'),
(32, 11, 14, '2024-09-08 13:18:05', '2024-09-08 13:18:05'),
(33, 11, 3, '2024-09-08 13:18:05', '2024-09-08 13:18:05'),
(34, 12, 3, '2024-09-08 15:13:53', '2024-09-08 15:13:53'),
(35, 12, 2, '2024-09-08 15:13:53', '2024-09-08 15:13:53');

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
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_06_03_030731_create_personal_access_tokens_table', 1),
(5, '2024_06_20_051448_add_two_factor_columns_to_users_table', 1),
(6, '2024_06_23_035053_create_departments_table', 1),
(7, '2024_07_08_232729_create_announcements_table', 1),
(8, '2024_07_08_233427_create_announcement_notis_table', 1),
(9, '2024_07_08_233958_create_groups_table', 1),
(10, '2024_07_08_234348_create_group_members_table', 1),
(11, '2024_07_08_234625_create_group_conversations_table', 1),
(12, '2024_07_08_235012_create_group_conversation_notis_table', 1),
(13, '2024_07_11_161358_create_timetables_table', 1),
(14, '2024_07_17_014301_create_subjects_table', 1),
(15, '2024_08_28_145927_create_chat_configs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('soehtetpaing.bless@gmail.com', '$2y$12$qzejHKOYlhXwIFF1jVlJq.p1X5ukoDWoYJ.7YlmAyUzjil/zya4NC', '2024-08-30 03:57:11'),
('soehtetpaing@ucspyay.edu.mm', '$2y$12$U6mmxUm7vbJ5razeQgoMr.MFNieuyeFAkYRIeL3rJK3K5rEGYN7hm', '2024-08-30 03:35:00');

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
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('CS995HSlCL0Brd1thzp8UfmATWhst4wdSvN2T5jo', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 Edg/128.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoieWdpOE5sYmxuRTdneXI5THkxSkpCOEVEOVY1VnFERkZXY1FMQ09lZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zdHVkZW50L3RpbWV0YWJsZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7czoyMToicGFzc3dvcmRfaGFzaF9zYW5jdHVtIjtzOjYwOiIkMnkkMTIkbVU5Qi5UdHIzZ3hnTkREUk1WWWZndXFGcVV5eC9OMkc5eWdqNm5MV1V0RldJYlVKMW5vOUMiO30=', 1725810665),
('cziiD267shBtbWJYLhPjeCI7wD47K7XiH5tRfO7V', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoibEhMOTkxZVlHSFJJS0VCdldVeUtGV1dEZDBheFYxR3RuUkhXeHFHOSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEyJFUwb0ZiSDhSdHdRc2haeGRrZ2x4aU84Qi44V0lQTWM1TzdGQlF1UGMwTy9oWnFubGhqeGFxIjt9', 1725811454),
('tZ5eWAAZVMRTbastSYpt1UuhsXB0te2XyV5uyBYN', 14, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:130.0) Gecko/20100101 Firefox/130.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoidFA5UVdqdmZBSVM3MGJOd0V2N3AzOUN3akNsSjc0ekoyZjJGOUc3MCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxNDtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMiRIMGFySlF5djZPRURoekRFYU9vSG4uWWFVYVQ2NUdIdTBSTVJLRS4vZ3BmWUVrNVA1c0FKTyI7fQ==', 1725809837);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject_code` varchar(255) NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `department_id` int(11) NOT NULL,
  `term` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_code`, `subject_name`, `department_id`, `term`, `created_at`, `updated_at`) VALUES
(1, 'M-1101', 'Myanmar', 1, 'First Term CS', '2024-07-16 19:50:05', '2024-07-16 19:50:05'),
(2, 'E-1101', 'English', 1, 'First Term CS', '2024-07-16 19:51:16', '2024-07-16 19:51:16'),
(3, 'P-1101', 'Physics', 1, 'First Term CS', '2024-07-16 19:52:47', '2024-07-16 19:52:47'),
(4, 'CST-1142', 'Calculus', 1, 'First Term CS', '2024-07-16 20:55:30', '2024-07-16 20:55:30'),
(5, 'CST-1111', 'Principle of IT', 1, 'First Term CS', '2024-07-16 21:02:06', '2024-07-16 21:02:06'),
(6, 'CST-1101', 'Supporting Skill I (Office 365)', 1, 'First Term CS', '2024-07-16 21:02:49', '2024-07-16 21:02:49'),
(7, 'E-2101', 'English', 2, 'First Term CS', '2024-07-16 21:04:24', '2024-07-16 21:04:24'),
(8, 'CST-2142', 'Calculus II', 2, 'First Term CS', '2024-07-16 21:05:25', '2024-07-16 21:05:25'),
(9, 'CST-2111', 'Java Programming', 2, 'First Term CS', '2024-07-16 21:06:02', '2024-07-16 21:06:02'),
(10, 'CST-2124', 'Database Management System', 2, 'First Term CS', '2024-07-16 21:06:44', '2024-07-16 21:06:44'),
(11, 'CST-2133', 'Digital Fundamental', 2, 'First Term CS', '2024-07-16 21:07:43', '2024-07-16 21:07:43'),
(12, 'SK-2155', 'Web platform-based Development (HTML+CSS)', 2, 'First Term CS', '2024-07-16 21:09:34', '2024-07-16 21:09:34'),
(13, 'E-2101', 'English', 2, 'First Term CT', '2024-07-16 21:14:57', '2024-07-16 21:14:57'),
(14, 'CST-2142', 'Calculus II', 2, 'First Term CT', '2024-07-16 21:17:48', '2024-07-16 21:17:48'),
(15, 'CST-2111', 'Java Programming', 2, 'First Term CT', '2024-07-16 21:18:58', '2024-07-16 21:18:58'),
(16, 'CST-2124', 'Database Management System', 2, 'First Term CT', '2024-07-16 21:20:56', '2024-07-16 21:20:56'),
(17, 'CST-2133', 'Digital Fundamental', 2, 'First Term CT', '2024-07-16 21:21:48', '2024-07-16 21:21:48'),
(18, 'SK-2155', 'Web platform-based Development (HTML+CSS)', 2, 'First Term CT', '2024-07-16 21:23:21', '2024-07-16 21:23:21'),
(19, 'CST-3142', 'Numerical Analysis', 3, 'First Term CS', '2024-07-16 21:27:08', '2024-07-16 21:27:08'),
(20, 'CS-3124', 'Software Analysis and Design', 3, 'First Term CS', '2024-07-16 21:31:41', '2024-07-16 21:31:41'),
(21, 'CST-3131', 'Computer Architecture and Organization', 3, 'First Term CS', '2024-07-16 21:39:45', '2024-07-16 21:39:45'),
(22, 'CS-3125', 'Database System Structure', 3, 'First Term CS', '2024-07-16 21:41:38', '2024-07-16 21:41:38'),
(23, 'CST-3113', 'Artificial Intelligence + Prolog', 3, 'First Term CS', '2024-07-16 21:43:09', '2024-07-16 21:43:09'),
(24, 'CST-3157', 'Financial Management Accounting', 3, 'First Term CS', '2024-07-16 21:44:15', '2024-07-16 21:44:15'),
(25, 'CS-3156', 'Web Development PHP', 3, 'First Term CS', '2024-07-16 21:45:12', '2024-07-16 21:45:12'),
(26, 'CST-3142', 'Numerical Analysis', 3, 'First Term CT', '2024-07-16 21:53:27', '2024-07-16 21:53:27'),
(27, 'CST-3157', 'Financial Management Accounting', 3, 'First Term CT', '2024-07-16 21:54:08', '2024-07-16 21:54:08'),
(28, 'CST-3131', 'Computer Architecture and Organization', 3, 'First Term CT', '2024-07-16 21:56:16', '2024-07-16 21:56:16'),
(29, 'CST-3113', 'Artificial Intelligence + Prolog', 3, 'First Term CT', '2024-07-16 21:56:49', '2024-07-16 21:56:49'),
(30, 'CT-3134', 'Electronics I', 3, 'First Term CT', '2024-07-16 21:57:39', '2024-07-16 21:57:39'),
(31, 'CT-3135', 'Control Systems', 3, 'First Term CT', '2024-07-16 21:58:27', '2024-07-16 21:58:27'),
(32, 'CT(SK)-3136', 'Linux Fundamental and Administration OR Raspberry PI', 3, 'First Term CT', '2024-07-16 21:59:54', '2024-07-16 21:59:54'),
(33, 'CS-4126', 'Information Assurance & Security', 4, 'First Term CS', '2024-07-16 22:02:32', '2024-07-16 22:02:32'),
(34, 'CS-4113', 'Computer Graphics', 4, 'First Term CS', '2024-07-16 22:03:35', '2024-07-16 22:03:35'),
(35, 'E-4101', 'English', 4, 'First Term CS', '2024-07-16 22:04:57', '2024-07-16 22:04:57'),
(36, 'CST-4111', 'Analysis of Algorithms', 4, 'First Term CS', '2024-07-16 22:05:59', '2024-07-16 22:05:59'),
(37, 'CS-4142', 'Introduction to Operations Research', 4, 'First Term CS', '2024-07-16 22:08:20', '2024-07-16 22:08:20'),
(38, 'CST-4124', 'Software Project Management', 4, 'First Term CS', '2024-07-16 22:09:12', '2024-07-16 22:09:12'),
(39, 'CT-4134', 'Embedded System', 4, 'First Term CT', '2024-07-16 22:10:58', '2024-07-16 22:10:58'),
(40, 'CT-4133', 'Computer Networks', 4, 'First Term CT', '2024-07-16 22:12:20', '2024-07-16 22:12:20'),
(41, 'CT-4132', 'Digital System Design', 4, 'First Term CT', '2024-07-16 22:13:11', '2024-07-16 22:13:11'),
(42, 'CST-4124', 'Software Project Management', 4, 'First Term CT', '2024-07-16 22:14:49', '2024-07-16 22:14:49'),
(43, 'CST-4111', 'Analysis of Algorithms', 4, 'First Term CT', '2024-07-16 22:15:32', '2024-07-16 22:15:32'),
(44, 'E-4101', 'English', 4, 'First Term CT', '2024-07-16 22:17:37', '2024-07-16 22:17:37'),
(45, 'CT-403', 'Introduction to Microcontroller', 4, 'First Term CT', '2024-07-16 22:18:24', '2024-07-16 22:18:24'),
(46, 'CT-405', 'Control Systems', 4, 'First Term CT', '2024-07-16 22:19:08', '2024-07-16 22:19:08'),
(47, 'CS-5114', 'Parallel Analysis Algorithm', 5, 'First Term CS', '2024-07-16 22:23:24', '2024-07-16 22:23:24'),
(48, 'CS-5105', 'Elective - Enterprise Resource Planning', 5, 'First Term CS', '2024-07-16 22:24:48', '2024-07-16 22:24:48'),
(49, 'CS-5105', 'Elective - Data Mining', 5, 'First Term CS', '2024-07-16 22:27:32', '2024-07-16 22:27:32'),
(50, 'CS-5104', 'Elective - Computing Applied Algorithms', 5, 'First Term CS', '2024-07-16 22:28:52', '2024-07-16 22:28:52'),
(52, 'CS-5104', 'Elective - Artifical Intelligence + Natural Language Processing', 5, 'First Term CS', '2024-07-16 22:36:56', '2024-07-16 22:36:56'),
(53, 'CS-5103', 'Information Security and IT Risk Management', 5, 'First Term CS', '2024-07-16 22:38:07', '2024-07-16 22:38:07'),
(54, 'CST-5102', 'Distributed Computing System + Advanced Networking', 5, 'First Term CS', '2024-07-16 22:39:34', '2024-07-16 22:39:34'),
(55, 'CST-501', 'Mathematics of Computing V', 5, 'First Term CS', '2024-07-16 22:40:15', '2024-07-16 22:40:15'),
(56, 'E-5101', 'English', 5, 'First Term CS', '2024-07-16 22:40:45', '2024-07-16 22:40:45'),
(57, 'CT-5134', 'Network Security', 5, 'First Term CT', '2024-07-16 22:44:14', '2024-07-16 22:44:14'),
(58, 'E-5101', 'English', 5, 'First Term CT', '2024-07-16 22:44:47', '2024-07-16 22:44:47'),
(59, 'CST-501', 'Mathematics of Computing V', 5, 'First Term CT', '2024-07-16 22:45:37', '2024-07-16 22:45:37'),
(60, 'CST-5102', 'Distributed Computing System + Advanced Networking', 5, 'First Term CT', '2024-07-16 22:46:24', '2024-07-16 22:46:24'),
(61, 'CT-5103', 'Fuzzy Logic Control System', 5, 'First Term CT', '2024-07-16 22:47:42', '2024-07-16 22:47:42'),
(62, 'CT-5104', 'Embedded System', 5, 'First Term CT', '2024-07-16 22:48:20', '2024-07-16 22:48:20'),
(63, 'CT-5105', 'Image Processing and Computer Vision', 5, 'First Term CT', '2024-07-16 22:49:38', '2024-07-16 22:49:38'),
(64, 'E-1201', 'English', 1, 'Second Term CS', '2024-07-16 22:52:18', '2024-07-16 22:52:18'),
(65, 'P-1201', 'Physics', 1, 'Second Term CS', '2024-07-16 22:52:56', '2024-07-16 22:52:56'),
(66, 'M-1201', 'Myanmar', 1, 'Second Term CS', '2024-07-16 22:53:23', '2024-07-16 22:53:23'),
(67, 'CST-1242', 'Discrete Mathematics', 1, 'Second Term CS', '2024-07-16 22:54:23', '2024-07-16 22:54:23'),
(68, 'CST-1201', 'Supporting Skill II (Advanced Office 365)', 1, 'Second Term CS', '2024-07-16 22:55:21', '2024-07-16 22:55:21'),
(69, 'CST-1211', 'Programming Logic and Design (Programming in C++)', 1, 'Second Term CS', '2024-07-16 22:56:36', '2024-07-16 22:56:36'),
(70, 'CST-2223', 'Software Engineering', 2, 'Second Term CS', '2024-07-16 22:58:41', '2024-07-16 22:58:41'),
(71, 'CS-2254', 'Web Technology (JavaScript Programming)', 2, 'Second Term CS', '2024-07-16 23:01:09', '2024-07-16 23:01:09'),
(72, 'CST-2211', 'Advanced Data Structure', 2, 'Second Term CS', '2024-07-16 23:02:30', '2024-07-16 23:02:30'),
(73, 'CST-2242', 'Introduction to Linear Algebra', 2, 'Second Term CS', '2024-07-16 23:03:40', '2024-07-16 23:03:40'),
(74, 'CST-2215', 'Advanced Java Programming', 2, 'Second Term CS', '2024-07-16 23:04:43', '2024-07-16 23:04:43'),
(75, 'E-2201', 'English', 2, 'Second Term CS', '2024-07-16 23:05:07', '2024-07-16 23:05:07'),
(76, 'E-2201', 'English', 2, 'Second Term CT', '2024-07-17 01:19:59', '2024-07-17 01:19:59'),
(77, 'SS-2231', 'Ardunio Fundamental', 2, 'Second Term CT', '2024-07-17 01:37:56', '2024-07-17 01:37:56'),
(78, 'CST-2215', 'Advanced Java Programming', 2, 'Second Term CT', '2024-07-17 02:00:05', '2024-07-17 02:00:05'),
(79, 'CST-2242', 'Introduction to Linear Algebra', 2, 'Second Term CT', '2024-07-17 02:02:08', '2024-07-17 02:02:08'),
(80, 'CST-2211', 'Advanced Data Structure', 2, 'Second Term CT', '2024-07-17 02:05:47', '2024-07-17 02:05:47'),
(81, 'CST-2223', 'Software Engineering', 2, 'Second Term CT', '2024-07-17 02:06:40', '2024-07-17 02:06:40'),
(82, 'CT-2234', 'Electrical Circuits I', 2, 'Second Term CT', '2024-07-17 02:07:30', '2024-07-17 02:07:30'),
(83, 'E-3201', 'English', 3, 'Second Term CS', '2024-07-17 02:16:59', '2024-07-17 02:16:59'),
(84, 'CST-3213', 'Professional Ethics', 3, 'Second Term CS', '2024-07-17 02:17:50', '2024-07-17 02:17:50'),
(85, 'CST-3242', 'Probability and Statistics with Python', 3, 'Second Term CS', '2024-07-17 02:20:00', '2024-07-17 02:20:00'),
(86, 'CST-3211', 'Operating System', 3, 'Second Term CS', '2024-07-17 02:20:59', '2024-07-17 02:20:59'),
(87, 'CST-3257', 'C# Programming & Business Application Area', 3, 'Second Term CS', '2024-07-17 02:21:58', '2024-07-17 02:21:58'),
(88, 'CST-3256', 'Human Computer Interaction', 3, 'Second Term CS', '2024-07-17 02:23:14', '2024-07-17 02:23:14'),
(89, 'CS-3224', 'Software Quality Assurance & Testing', 3, 'Second Term CS', '2024-07-17 02:24:16', '2024-07-17 02:24:16'),
(90, 'CST-3235', 'Computer Networks I', 3, 'Second Term CS', '2024-07-17 02:25:22', '2024-07-17 02:25:22'),
(91, 'E-3201', 'English', 3, 'Second Term CT', '2024-07-17 02:27:59', '2024-07-17 02:27:59'),
(92, 'CST-3256', 'Human Computer Interaction', 3, 'Second Term CT', '2024-07-17 02:28:32', '2024-07-17 02:28:32'),
(93, 'CT-3234', 'Computer Architecture and Organization II', 3, 'Second Term CT', '2024-07-17 02:29:17', '2024-07-17 02:29:17'),
(94, 'CST-3257', 'C# Programming & Business Application Area', 3, 'Second Term CT', '2024-07-17 02:29:47', '2024-07-17 02:29:47'),
(95, 'CST-3213', 'Professional Ethics', 3, 'Second Term CT', '2024-07-17 02:30:20', '2024-07-17 02:30:20'),
(96, 'CST-3211', 'Operating System', 3, 'Second Term CT', '2024-07-17 02:32:25', '2024-07-17 02:32:25'),
(97, 'CST-3242', 'Probability and Statistics with Python', 3, 'Second Term CT', '2024-07-17 02:33:04', '2024-07-17 02:33:04'),
(98, 'CST-3235', 'Computer Networks I', 3, 'Second Term CT', '2024-07-17 02:33:38', '2024-07-17 02:33:38'),
(99, 'CS-4214', 'Advanced Artificial Intelligence', 4, 'Second Term CS', '2024-07-17 02:37:18', '2024-07-17 02:37:18'),
(100, 'CS-4225', 'Advanced Database System', 4, 'Second Term CS', '2024-07-17 02:37:58', '2024-07-17 02:37:58'),
(101, 'CS-4223', 'Object Oriented Design', 4, 'Second Term CS', '2024-07-17 02:38:42', '2024-07-17 02:38:42'),
(102, 'CST-4242', 'Modeling and Simulation', 4, 'Second Term CS', '2024-07-17 02:40:13', '2024-07-17 02:40:13'),
(103, 'CST-4211', 'Parallel & Distributed Computing', 4, 'Second Term CS', '2024-07-17 02:41:17', '2024-07-17 02:41:17'),
(104, 'CS-4257', 'Digital Business and E-commerce Management', 4, 'Second Term CS', '2024-07-17 02:42:09', '2024-07-17 02:42:09');

-- --------------------------------------------------------

--
-- Table structure for table `timetables`
--

CREATE TABLE `timetables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department_id` int(11) NOT NULL,
  `section` varchar(255) NOT NULL,
  `day` varchar(255) NOT NULL,
  `start_hour` varchar(255) NOT NULL,
  `end_hour` varchar(255) NOT NULL,
  `subject_code` varchar(255) NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `lecturer_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `timetables`
--

INSERT INTO `timetables` (`id`, `department_id`, `section`, `day`, `start_hour`, `end_hour`, `subject_code`, `subject_name`, `lecturer_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Section A', 'Monday', '9:00 AM', '10:00 AM', 'E-1101', 'English', 'Daw Nilar Win', '2024-08-10 04:33:15', '2024-08-10 04:33:15'),
(2, 5, 'Section B', 'Monday', '9:00 AM', '11:00 AM', 'CST-5102', 'Distributed Computing System + Advanced Networking', 'Daw Mya Ei Nyein', '2024-08-11 12:24:17', '2024-08-11 12:24:17'),
(3, 5, 'Section B', 'Monday', '11:00 AM', '12:00 PM', 'CS-5105', 'Elective - Data Mining', 'Dr Kae Kae', '2024-08-11 12:29:25', '2024-08-11 12:29:25'),
(4, 5, 'Section B', 'Monday', '1:00 PM', '2:00 PM', 'CST-5102', 'Distributed Computing System + Advanced Networking', 'Daw Mya Ei Nyein', '2024-08-11 12:30:33', '2024-08-11 12:30:33'),
(5, 5, 'Section B', 'Monday', '2:00 PM', '4:00 AM', 'CS-5114', 'Parallel Analysis Algorithm', 'Daw Khin Mar Cho', '2024-08-11 12:36:23', '2024-08-11 12:36:23'),
(6, 5, 'Section B', 'Tuesday', '9:00 AM', '10:00 AM', 'E-5101', 'English', 'Daw Nilar Win', '2024-08-11 12:40:16', '2024-08-24 07:35:43'),
(7, 5, 'Section B', 'Tuesday', '10:00 AM', '12:00 PM', 'CS-5105', 'Elective - Data Mining', 'Dr Kae Kae', '2024-08-11 12:41:04', '2024-08-11 12:41:04'),
(8, 5, 'Section B', 'Tuesday', '1:00 PM', '3:00 PM', 'CS-5103', 'Information Security and IT Risk Management', 'U Htun Tin', '2024-08-11 12:41:56', '2024-08-11 12:41:56'),
(9, 5, 'Section B', 'Tuesday', '3:00 PM', '4:00 AM', 'FREE-5', 'Social Science', 'Daw Khin Soe Han', '2024-08-11 12:46:30', '2024-08-11 12:46:30'),
(10, 5, 'Section B', 'Wednesday', '9:00 AM', '10:00 AM', 'SS-5', 'Self Study', 'Daw Khin Soe Han', '2024-08-11 13:12:15', '2024-08-11 13:12:15'),
(11, 5, 'Section B', 'Wednesday', '10:00 AM', '12:00 PM', 'CST-501', 'Mathematics of Computing V', 'Daw Sandar Pa Pa Thein', '2024-08-11 13:13:36', '2024-08-11 13:13:36'),
(12, 5, 'Section B', 'Wednesday', '1:00 PM', '3:00 PM', 'E-5101', 'English', 'Daw Nilar Win', '2024-08-11 13:15:06', '2024-08-24 01:41:25'),
(13, 5, 'Section B', 'Wednesday', '3:00 PM', '4:00 AM', 'CST-5102', 'Distributed Computing System + Advanced Networking', 'Daw Mya Ei Nyein', '2024-08-11 13:15:43', '2024-08-11 13:15:43'),
(14, 5, 'Section B', 'Thursday', '9:00 AM', '11:00 AM', 'CST-501', 'Mathematics of Computing V', 'Daw Sandar Pa Pa Thein', '2024-08-11 13:16:17', '2024-08-11 13:16:17'),
(15, 5, 'Section B', 'Thursday', '11:00 AM', '12:00 PM', 'CST-5102', 'Distributed Computing System + Advanced Networking', 'Daw Mya Ei Nyein', '2024-08-11 13:17:06', '2024-08-11 13:17:06'),
(16, 5, 'Section B', 'Thursday', '1:00 PM', '2:00 PM', 'CS-5103', 'Information Security and IT Risk Management', 'U Htun Tin', '2024-08-11 13:17:45', '2024-08-11 13:17:45'),
(17, 5, 'Section B', 'Thursday', '2:00 PM', '4:00 AM', 'CS-5114', 'Parallel Analysis Algorithm', 'Daw Khin Mar Cho', '2024-08-11 13:18:37', '2024-08-11 13:18:37'),
(18, 5, 'Section B', 'Friday', '9:00 AM', '11:00 AM', 'E-5101', 'English', 'Daw Nilar Win', '2024-08-11 13:19:12', '2024-08-24 07:38:10'),
(19, 5, 'Section B', 'Friday', '11:00 AM', '12:00 PM', 'CS-5103', 'Information Security and IT Risk Management', 'U Htun Tin', '2024-08-11 13:20:03', '2024-08-11 13:20:03'),
(20, 5, 'Section B', 'Friday', '1:00 PM', '3:00 PM', 'CS-5105', 'Elective - Data Mining', 'Dr Kae Kae', '2024-08-11 13:20:34', '2024-08-11 13:20:34'),
(21, 5, 'Section B', 'Friday', '3:00 PM', '4:00 AM', 'CST-501', 'Mathematics of Computing V', 'Daw Sandar Pa Pa Thein', '2024-08-11 13:22:20', '2024-08-11 13:22:20'),
(22, 1, 'Section B', 'Monday', '9:00 AM', '11:00 AM', 'CST-1142', 'Calculus', 'Daw May Thandar Oo', '2024-08-15 07:23:05', '2024-08-15 07:23:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `section` varchar(255) DEFAULT NULL,
  `gendar` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Offline',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `phone`, `role`, `department`, `section`, `gendar`, `address`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Genius iQ', 'geniusiq@ucspyay.edu.mm', NULL, '09784440048', 'Admin', '17', 'Studcom Founder, CEO, CFO, Developer', 'Male', 'Yangon', '$2y$12$9VHjcTFJLzuN6xSpS0BJzue4Mhupc4/ja0oLIrmV8clXt49vXo8d2', NULL, NULL, NULL, NULL, NULL, 'profile-photos/AlK7aCSULyboOgO1Vup8tW6g3f6yvV3IA9969Mzv.jpg', 'Offline', '2024-08-28 08:54:54', '2024-08-30 08:01:36'),
(2, 'Daw Khin Soe Han', 'khinsoehan@ucspyay.edu.mm', NULL, '09952440287', 'Admin', '6', 'NA', 'Female', 'Pyay', '$2y$12$U0oFbH8RtwQshZxdkglxiO8B.8WIPMc5O7FBQuPc0O/hZqnlhjxaq', NULL, NULL, NULL, NULL, NULL, NULL, 'Busy', '2024-08-28 09:30:48', '2024-09-08 16:04:14'),
(3, 'Soe Htet Paing', 'soehtetpaing@ucspyay.edu.mm', NULL, '09784440048', 'EC Student', '5', 'Section B', 'Male', 'Yangon', '$2y$12$mU9B.Ttr3gxgNDDRMVYfguqFqUyx/N2G9ygj6nLWUtFWIbUJ1no9C', NULL, NULL, NULL, NULL, NULL, 'profile-photos/66cf4a0f00cf2iQpp-v3.jpg', 'Busy', '2024-08-28 09:32:23', '2024-09-08 15:51:05'),
(4, 'Daw Nilar Win', 'nilarwin@ucspyay.edu.mm', NULL, '09452336932', 'Lecturer', '14', 'NA', 'Female', 'Pyay', '$2y$12$w6c9HPxo2z0oIpPk7EhTHea5fWdMVN2vx4geIt46J8UQOD4XuJmfS', NULL, NULL, NULL, NULL, NULL, 'profile-photos/66cf4ab9d1d7ciQpp-v8.jpg', 'Offline', '2024-08-28 09:35:14', '2024-08-30 07:49:27'),
(5, 'Daw May Thandar Oo', 'maythandaroo@ucspyay.edu.mm', NULL, '09425027401', 'Lecturer', '16', 'NA', 'Female', 'Magway', '$2y$12$3j5j/WMVlv0iACao2VjiD.KKQ9oWXv3kuvYHNAYTNl9MWgmR37h3e', NULL, NULL, NULL, NULL, NULL, 'profile-photos/66cf4b6feeeb9iQpp-v2.jpg', 'Offline', '2024-08-28 09:38:16', '2024-08-28 09:38:16'),
(6, 'Daw Sandar Pa Pa Thein', 'sandarpapathein@ucspyay.edu.mm', NULL, '0944123455', 'Lecturer', '16', 'NA', 'Female', 'Yangon', '$2y$12$SLTw3Y3Bg2NqSgjHdvJ3luXarU5/y3jKOgRF4o.PiTbfwiee0tkqa', NULL, NULL, NULL, NULL, NULL, NULL, 'Offline', '2024-08-28 09:39:58', '2024-08-28 09:39:58'),
(7, 'Wai Hin Kyaw', 'waihinkyaw@ucspyay.edu.mm', NULL, '09679679692', 'Student', '5', 'Section B', 'Male', 'Gyo Pin Kyuk', '$2y$12$E0dvaofEzGdkujFAVPPN9O3WUr89r5GI.HZQG.TbhDe4lgUS6AZMG', NULL, NULL, NULL, NULL, NULL, 'profile-photos/66cf4c4c5ac22iQpp-v9.jpg', 'Offline', '2024-08-28 09:41:56', '2024-08-30 08:20:58'),
(8, 'Wai Yan Hein', 'waiyanhein@ucspyay.edu.mm', NULL, '09445088092', 'Student', '5', 'Section B', 'Male', 'Poung Dalae', '$2y$12$y0lniejAiazct9r5dgqwLuKDyitFWefeL1qdLLpZd6nhwa61KXUYe', NULL, NULL, NULL, NULL, NULL, 'profile-photos/66cf4cc6ad6c4iQpp-v5.jpg', 'Offline', '2024-08-28 09:43:59', '2024-08-28 09:43:59'),
(9, 'Chan Myae Thu', 'chanmyaethu1@ucspyay.edu.mm', NULL, '09777769110', 'Student', '5', 'Section B', 'Female', 'Pyay', '$2y$12$VbZZ7CUI.Q3PLGVkS4eDquDFpSF1YZASrEpynfx3ICoovOXKlxwzy', NULL, NULL, NULL, NULL, NULL, 'profile-photos/66cf4d0e82957iQpp-v4.jpg', 'Offline', '2024-08-28 09:45:11', '2024-08-30 08:18:04'),
(10, 'Thae Thae Su', 'thaethaesu@ucspyay.edu.mm', NULL, '09109109109', 'Student', '1', 'Section A', 'Female', 'Shwe Daung', '$2y$12$EFKcwoo5nWWWDEmisvGb7.FqhAsBgluefb7OQsF06CqIh//qF5gsS', NULL, NULL, NULL, NULL, NULL, 'profile-photos/66cf4d685e0d5iQpp-v6.jpg', 'Offline', '2024-08-28 09:46:40', '2024-08-30 04:23:44'),
(11, 'Daw Khin Mar Cho', 'khinmarcho@ucspyay.edu.mm', NULL, '09448009311', 'Lecturer', '10', 'NA', 'Female', 'Pyay', '$2y$12$BVam7QL7/KK0mlsWmR7jleoN.Y2d36M0jlKLLGM.xGLf9kc2SKboO', NULL, NULL, NULL, NULL, NULL, NULL, 'Offline', '2024-08-28 09:48:36', '2024-08-30 04:32:13'),
(12, 'Test Student', 'teststudent@ucspyay.edu.mm', NULL, '09110110110', 'Student', '2', 'Section CT', 'Female', 'Gyo Pin Kyuk', '$2y$12$PDuf/u0h/R5.O9WfuXbUqOahqohtLBztBySRog1Qd4.vKL2ci/THG', NULL, NULL, NULL, NULL, NULL, 'profile-photos/66cf4e11e5ffciQpp-v10.jpg', 'Offline', '2024-08-28 09:49:30', '2024-08-28 09:49:30'),
(14, 'Daw Hnin Nandar Zaw', 'hninnandarzaw@ucspyay.edu.mm', NULL, '09784440048', 'Lecturer', '10', 'NA', 'Female', 'Pyay', '$2y$12$H0arJQyv6OEDhzDEaOoHn.YaUaT65GHu0RMRKE./gpfYEk5P5sAJO', NULL, NULL, NULL, NULL, NULL, NULL, 'Busy', '2024-09-07 19:59:15', '2024-09-08 15:37:17'),
(15, 'U Htun Tin', 'htuntin@ucspyay.edu.mm', NULL, '09250404995', 'Lecturer', '11', 'NA', 'Male', 'Pyay', '$2y$12$vUgYa4Nt16OTyXnPskWBTu5/16NrmQJDeJ2n.VJjQxxEvo6rnLAuy', NULL, NULL, NULL, NULL, NULL, NULL, 'Offline', '2024-09-08 15:54:20', '2024-09-08 15:54:20'),
(16, 'Daw Kae Kae', 'kaekae@ucspyay.edu.mm', NULL, '09750812100', 'Lecturer', '11', 'NA', 'Female', 'Magway', '$2y$12$KaOxH3QsJ96pFotXRuGhu.qpyyLSqSUdefNhfq4JtxSnxIIe7HJc.', NULL, NULL, NULL, NULL, NULL, NULL, 'Offline', '2024-09-08 15:57:08', '2024-09-08 15:57:08'),
(17, 'Daw Mya Ei Nyein', 'myaeinyein@ucspyay.edu.mm', NULL, '09445487919', 'Lecturer', '10', 'NA', 'Female', 'Bago', '$2y$12$hbPD9PUm1ynMgn305V661eUIavhHIZXdyG9D.ZAcUeemfjvOVLnzK', NULL, NULL, NULL, NULL, NULL, NULL, 'Offline', '2024-09-08 16:00:43', '2024-09-08 16:00:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcement_notis`
--
ALTER TABLE `announcement_notis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `chat_configs`
--
ALTER TABLE `chat_configs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_conversations`
--
ALTER TABLE `group_conversations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_conversation_notis`
--
ALTER TABLE `group_conversation_notis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_members`
--
ALTER TABLE `group_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timetables`
--
ALTER TABLE `timetables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `announcement_notis`
--
ALTER TABLE `announcement_notis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `chat_configs`
--
ALTER TABLE `chat_configs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `group_conversations`
--
ALTER TABLE `group_conversations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `group_conversation_notis`
--
ALTER TABLE `group_conversation_notis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `group_members`
--
ALTER TABLE `group_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `timetables`
--
ALTER TABLE `timetables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
