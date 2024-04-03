-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 03, 2024 at 10:00 AM
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
-- Database: `tapz`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) DEFAULT '',
  `loginWith` varchar(255) DEFAULT '',
  `platform` varchar(255) DEFAULT '',
  `fcmToken` varchar(255) DEFAULT '',
  `googleId` varchar(255) DEFAULT '',
  `facebookId` varchar(255) DEFAULT '',
  `appleId` varchar(255) DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `otp` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `fullName`, `email`, `password`, `loginWith`, `platform`, `fcmToken`, `googleId`, `facebookId`, `appleId`, `created_at`, `updated_at`, `otp`) VALUES
(1, 'Umer Farooq', 'umer@gmail.com', '$2y$12$ybNHfF3/uXRvCtByZfPBquvoaPVDziwlY5wWzCnf3dpvxtOsulH62', 'email', '', '', '', '', '', '2024-04-02 00:44:17', '2024-04-02 04:23:25', '606070'),
(3, 'sehar batool', 'bsehar912@gmail.com', '$2y$12$Lyme8RFPGUee.KjA5xE9yeR1NG274s75LHu8Y/z..ibVeExoAI2wy', 'email', '', '', '', '', '', '2024-04-02 01:29:13', '2024-04-02 01:29:13', ''),
(4, 'Test User', 'user@gmail.com', '$2y$12$DUjMwiVEKo0kQsSxkOkg7ejwh1I141b0v1pWNTAkuK2MUZQkk8GJm', 'email', '', '', '', '', '', '2024-04-02 01:36:57', '2024-04-02 01:36:57', '');

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
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `path` varchar(255) NOT NULL,
  `tagId` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `path`, `tagId`, `created_at`, `updated_at`) VALUES
(13, 'uploads/bGPZPoM1_1712054045.jpg', '31', '2024-04-02 05:34:06', '2024-04-02 05:34:06'),
(14, 'uploads/V1obzpjE_1712054046.jpg', '31', '2024-04-02 05:34:06', '2024-04-02 05:34:06'),
(15, 'uploads/mlSg6SVC_1712054250.png', '32', '2024-04-02 05:37:31', '2024-04-02 05:37:31'),
(16, 'uploads/VhLWnhGm_1712054251.png', '32', '2024-04-02 05:37:31', '2024-04-02 05:37:31'),
(17, 'uploads/PoUGSfh7_1712056720.jpg', '41', '2024-04-02 06:18:47', '2024-04-02 06:18:47'),
(18, 'uploads/4672OXOJ_1712056727.jpg', '41', '2024-04-02 06:18:47', '2024-04-02 06:18:47'),
(19, 'uploads/GIyZMRn7_1712056858.jpg', '42', '2024-04-02 06:20:58', '2024-04-02 06:20:58'),
(20, 'uploads/GhuqB5sQ_1712056858.jpg', '42', '2024-04-02 06:20:58', '2024-04-02 06:20:58'),
(21, 'uploads/iLOxsJZV_1712125854.jpg', '25', '2024-04-03 01:30:54', '2024-04-03 01:30:54'),
(22, 'uploads/jk3RgGqf_1712125854.jpg', '25', '2024-04-03 01:30:54', '2024-04-03 01:30:54'),
(23, 'uploads/ab7P5HkQ_1712126471.png', '44', '2024-04-03 01:41:11', '2024-04-03 01:41:11'),
(24, 'uploads/NBOlJVuo_1712126471.png', '44', '2024-04-03 01:41:11', '2024-04-03 01:41:11'),
(25, 'uploads/sSpMBHkH_1712130430.jpg', '47', '2024-04-03 02:47:10', '2024-04-03 02:47:10'),
(26, 'uploads/GFUS2Olf_1712130430.jpg', '47', '2024-04-03 02:47:10', '2024-04-03 02:47:10'),
(27, 'uploads/f5XWoz93_1712130430.jpg', '47', '2024-04-03 02:47:11', '2024-04-03 02:47:11'),
(28, 'uploads/Pr6vUAVa_1712130462.jpg', '48', '2024-04-03 02:47:42', '2024-04-03 02:47:42'),
(29, 'uploads/sccvW1ic_1712130462.jpg', '48', '2024-04-03 02:47:42', '2024-04-03 02:47:42'),
(30, 'uploads/o8et0Y1q_1712130462.jpg', '48', '2024-04-03 02:47:42', '2024-04-03 02:47:42');

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
(80, '2014_10_12_000000_create_users_table', 1),
(81, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(82, '2019_08_19_000000_create_failed_jobs_table', 1),
(83, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(84, '2024_03_29_062637_create_accounts_table', 1),
(85, '2024_03_29_105434_add_tag_category_table', 1),
(86, '2024_04_01_085719_add_images_table', 1),
(87, '2024_04_02_053000_add_otp_column_to_accounts_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\Account', 1, 'auth-token', '711bf0050dc123e30d7147f9de18e73c04f606992e9b7d0467faf0679ffb7b0c', '[\"*\"]', NULL, NULL, '2024-04-02 00:44:18', '2024-04-02 00:44:18'),
(2, 'App\\Models\\Account', 2, 'auth-token', '751a9c49c59ad239fb8c090736a0ef3224cdb576a8b3c255e3baf34fbe073f49', '[\"*\"]', '2024-04-02 01:02:14', NULL, '2024-04-02 00:44:50', '2024-04-02 01:02:14'),
(3, 'App\\Models\\Account', 2, 'auth-token', '78eee432cc22560abff5b67817cf586a1ce46e7853a59a4bc8522928d3976bc3', '[\"*\"]', '2024-04-02 01:23:49', NULL, '2024-04-02 01:05:26', '2024-04-02 01:23:49'),
(4, 'App\\Models\\Account', 3, 'auth-token', '6f37077278d9059fbabdd38612b9445d0ab4e122629d9f82c3a5a69e2cb8606d', '[\"*\"]', NULL, NULL, '2024-04-02 01:29:13', '2024-04-02 01:29:13'),
(5, 'App\\Models\\Account', 4, 'auth-token', 'c5a7969efe150cc1651f6aaf6eb5c64da31604b7088a47c64c5cb9469e4217c1', '[\"*\"]', NULL, NULL, '2024-04-02 01:36:57', '2024-04-02 01:36:57'),
(6, 'App\\Models\\Account', 4, 'auth-token', '138bfe765ea4d37378741bb1fd72265aa6cce8f7bf270a1cd3d4a8f6ad290afa', '[\"*\"]', '2024-04-03 02:33:28', NULL, '2024-04-02 01:39:19', '2024-04-03 02:33:28'),
(7, 'App\\Models\\Account', 3, 'auth-token', 'eaaa2e3dcfdf2e3752068554c1e8484bf627da1479638061b3249ab4d7644b04', '[\"*\"]', NULL, NULL, '2024-04-02 01:47:30', '2024-04-02 01:47:30'),
(8, 'App\\Models\\Account', 3, 'auth-token', '039e66b2ad9e04af5a428c12d9503f3506312a2888a2d74c3830af2550879dac', '[\"*\"]', '2024-04-02 03:26:06', NULL, '2024-04-02 02:12:13', '2024-04-02 03:26:06'),
(9, 'App\\Models\\Account', 3, 'auth-token', 'c88e45a0dd23b4d267db059a6002daecdd986f0c94f7423040450834d6892e76', '[\"*\"]', '2024-04-03 02:59:47', NULL, '2024-04-02 03:26:45', '2024-04-03 02:59:47'),
(10, 'App\\Models\\Account', 5, 'auth-token', '16459da621e0849c69a04ed8a3eb455cb7cf0c27c67b992e4ebbb992dd811b3a', '[\"*\"]', NULL, NULL, '2024-04-02 04:36:46', '2024-04-02 04:36:46'),
(11, 'App\\Models\\Account', 5, 'auth-token', '00e9f8ac678ad37c5be2bb23c3de1a13aed36d84ee631486a3cf171662cfc5f8', '[\"*\"]', NULL, NULL, '2024-04-02 04:53:31', '2024-04-02 04:53:31'),
(12, 'App\\Models\\Account', 5, 'auth-token', '6c197b72b1bf180c6edc6397c80b8fae66c30aa93fd0c7c77984c1affb925534', '[\"*\"]', NULL, NULL, '2024-04-02 04:55:30', '2024-04-02 04:55:30'),
(13, 'App\\Models\\Account', 5, 'auth-token', '2eb09426037eb8b39a7bd3e7819c1cb7d5463492164a2681103cf349db59afe0', '[\"*\"]', NULL, NULL, '2024-04-02 04:57:58', '2024-04-02 04:57:58'),
(14, 'App\\Models\\Account', 5, 'auth-token', 'd64d58490fc3415ec753570c8a243d8ea8c4e9e51ab6380ce5e4d72f05819b5d', '[\"*\"]', NULL, NULL, '2024-04-02 04:58:58', '2024-04-02 04:58:58'),
(15, 'App\\Models\\Account', 5, 'auth-token', '69982a924fdf98bb1d9a5eba94b301ef1413be4734403aee38a4256aa061b6e8', '[\"*\"]', '2024-04-02 06:11:36', NULL, '2024-04-02 06:08:55', '2024-04-02 06:11:36'),
(16, 'App\\Models\\Account', 4, 'auth-token', '9f9af0256c4ba97736cb7327da7fcb1bb8066c2a6b9f5b76e8c9f74c612899d5', '[\"*\"]', '2024-04-02 06:20:57', NULL, '2024-04-02 06:14:06', '2024-04-02 06:20:57'),
(17, 'App\\Models\\Account', 6, 'auth-token', '196a8b89ad1f8309ef3738c2c53f9958fb540efe09dc3347196e107ff221a1ba', '[\"*\"]', NULL, NULL, '2024-04-02 06:24:58', '2024-04-02 06:24:58'),
(18, 'App\\Models\\Account', 6, 'auth-token', 'c7c3b51bea9d04b1e425e19ae9f98d670fca56c6e2b3b35e8e82770b9d8f5013', '[\"*\"]', '2024-04-02 06:33:56', NULL, '2024-04-02 06:32:04', '2024-04-02 06:33:56'),
(19, 'App\\Models\\Account', 7, 'auth-token', '48a4eec9c8d06c0582940fe23026b9715bf4bfa448340ae2dec2cd4a60b21526', '[\"*\"]', NULL, NULL, '2024-04-03 00:24:14', '2024-04-03 00:24:14'),
(20, 'App\\Models\\Account', 7, 'auth-token', '2556e032a6b8c4be73944144a5fed91ed9c9dbead83821db3ab3dee5e3ca5730', '[\"*\"]', NULL, NULL, '2024-04-03 00:29:51', '2024-04-03 00:29:51'),
(21, 'App\\Models\\Account', 2, 'auth-token', '5f921842319cd631af64e581e9f84981003e6186b583c9f645d1911f33c509fc', '[\"*\"]', '2024-04-03 00:32:14', NULL, '2024-04-03 00:31:19', '2024-04-03 00:32:14'),
(22, 'App\\Models\\Account', 7, 'auth-token', '67b42bc0bb661fe5c376a5d685a674de937ad06e1b8fe5917b124881624ef94e', '[\"*\"]', '2024-04-03 01:53:45', NULL, '2024-04-03 00:43:12', '2024-04-03 01:53:45'),
(23, 'App\\Models\\Account', 8, 'auth-token', '7db8919ae8fedc1832b4039412859048614d375a0b120208864d8950c454fddd', '[\"*\"]', NULL, NULL, '2024-04-03 02:39:42', '2024-04-03 02:39:42'),
(24, 'App\\Models\\Account', 8, 'auth-token', '2f2593edab830f4086e06fc0247eb619e7d6544f3a6b51a94efc6c4f8a4638c8', '[\"*\"]', '2024-04-03 02:52:09', NULL, '2024-04-03 02:40:21', '2024-04-03 02:52:09'),
(25, 'App\\Models\\Account', 7, 'auth-token', '40eb46e4728e007073baf5442ae7be1862d0c1c3088c9fd41115ec4144013339', '[\"*\"]', '2024-04-03 02:56:48', NULL, '2024-04-03 02:56:39', '2024-04-03 02:56:48');

-- --------------------------------------------------------

--
-- Table structure for table `tags_category`
--

CREATE TABLE `tags_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT '',
  `ownerName` varchar(255) DEFAULT '',
  `fatherName` varchar(255) DEFAULT '',
  `brand` varchar(255) DEFAULT '',
  `luggageType` varchar(255) DEFAULT '',
  `gender` varchar(255) DEFAULT '',
  `age` varchar(255) DEFAULT '',
  `weight` varchar(255) DEFAULT '',
  `height` varchar(255) DEFAULT '',
  `dressColor` varchar(255) DEFAULT '',
  `address` varchar(255) DEFAULT '',
  `color` varchar(255) DEFAULT '',
  `mobileNumber` varchar(255) DEFAULT '',
  `mobileNumber2` varchar(255) DEFAULT '',
  `contactEmail` varchar(255) DEFAULT '',
  `reward` varchar(255) DEFAULT '',
  `vetDetail` varchar(255) DEFAULT '',
  `doctorDetail` varchar(255) DEFAULT '',
  `medicalIssue` varchar(255) DEFAULT '',
  `note` varchar(255) DEFAULT '',
  `category` varchar(255) DEFAULT '',
  `userId` varchar(255) NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags_category`
--

INSERT INTO `tags_category` (`id`, `name`, `ownerName`, `fatherName`, `brand`, `luggageType`, `gender`, `age`, `weight`, `height`, `dressColor`, `address`, `color`, `mobileNumber`, `mobileNumber2`, `contactEmail`, `reward`, `vetDetail`, `doctorDetail`, `medicalIssue`, `note`, `category`, `userId`, `created_at`, `updated_at`) VALUES
(7, 'Name 1', 'petName', NULL, NULL, NULL, 'male', '4', '10', NULL, NULL, 'address', 'Orange', 'mobileNumber', 'mobileNumber2', 'email@gmail.com', '100', 'Dr Doctor', NULL, 'medicalIssues', NULL, 'pet', '4', '2024-04-02 02:27:25', '2024-04-02 02:27:25'),
(8, 'Name 1', 'petName', NULL, NULL, NULL, 'male', '4', '10', NULL, NULL, 'address', 'Orange', 'mobileNumber', 'mobileNumber2', 'email@gmail.com', '100', 'Dr Doctor', NULL, 'medicalIssues', NULL, 'pet', '4', '2024-04-02 02:29:52', '2024-04-02 02:29:52'),
(9, 'Name 1', 'petName', NULL, NULL, NULL, 'male', '4', '10', NULL, NULL, 'address', 'Orange', 'mobileNumber', 'mobileNumber2', 'email@gmail.com', '100', 'Dr Doctor', NULL, 'medicalIssues', NULL, 'pet', '4', '2024-04-02 02:30:51', '2024-04-02 02:30:51'),
(10, 'Name 1', 'petName', NULL, NULL, NULL, 'male', '4', '10', NULL, NULL, 'address', 'Orange', 'mobileNumber', '', 'email@gmail.com', '100', 'Dr Doctor', NULL, 'medicalIssues', NULL, 'pet', '4', '2024-04-02 02:39:17', '2024-04-02 02:39:17'),
(11, 'Name 1', 'petName', NULL, NULL, NULL, 'male', '4', '10', NULL, NULL, 'address', 'Orange', 'mobileNumber', '', 'email@gmail.com', '100', 'Dr Doctor', '', 'medicalIssues', NULL, 'pet', '4', '2024-04-02 02:45:11', '2024-04-02 02:45:11'),
(12, 'Name 1', 'petName', NULL, NULL, NULL, 'male', '4', '10', NULL, NULL, 'address', 'Orange', 'mobileNumber', '', 'email@gmail.com', '100', 'Dr Doctor', '', 'medicalIssues', NULL, 'pet', '4', '2024-04-02 02:47:26', '2024-04-02 02:47:26'),
(13, 'Name 1', 'petName', NULL, NULL, NULL, 'male', '4', '10', NULL, NULL, 'address', 'Orange', 'mobileNumber', 'mobileNumber2', 'email@gmail.com', '100', 'Dr Doctor', '', 'medicalIssues', NULL, 'pet', '4', '2024-04-02 02:48:01', '2024-04-02 02:48:01'),
(14, 'Name 14', 'petName 14', '', '', '', 'male', '4', '10', '', '', 'address', 'Orange', 'mobileNumber', '', 'email@gmail.com', '100', 'Dr Doctor', '', 'medicalIssues', '', 'pet', '4', '2024-04-02 02:51:59', '2024-04-02 02:51:59'),
(15, 'Name 15', 'petName 15', '', '', '', 'male', '4', '10', '', '', 'address', 'Orange', 'mobileNumber', '', 'email@gmail.com', '100', 'Dr Doctor', '', 'medicalIssues', NULL, 'pet', '4', '2024-04-02 02:55:33', '2024-04-02 02:55:33'),
(16, 'test', 'test', NULL, NULL, NULL, 'male', '3', '20', NULL, NULL, 'hdisjdi', 'blackbird', '618479274', '728374883', 'bsehar912@gmail.co', '20', 'hdisbid', NULL, 'hfiehf', 'hdkshe', 'pet', '3', '2024-04-02 03:31:09', '2024-04-02 03:31:09'),
(17, 'test', 'test', NULL, NULL, NULL, 'male', '3', '20', NULL, NULL, 'hdisjdi', 'blackbird', '618479274', '728374883', 'bsehar912@gmail.co', '20', 'hdisbid', NULL, 'hfiehf', 'hdkshe', 'pet', '3', '2024-04-02 03:31:57', '2024-04-02 03:31:57'),
(18, 'test kid', NULL, 'sehar', NULL, NULL, 'female', '3', NULL, '20', 'white', 'hsishd', NULL, '628374848', '728374884', 'bsehar912@gmail.co', '20', NULL, 'hejxhxj', 'hsishd', 'hdishdid', 'kid', '3', '2024-04-02 03:34:06', '2024-04-02 03:34:06'),
(19, NULL, 'gsjs', NULL, 'bdjjd', NULL, NULL, NULL, NULL, NULL, NULL, 'bxks', 'bxjs', '828384738', '7283748', 'bsehar912@gmail.com', '6134', NULL, NULL, NULL, 'jdksnxj', 'luggage', '3', '2024-04-02 04:30:09', '2024-04-02 04:30:09'),
(20, NULL, 'fugfu', NULL, 't to g', NULL, NULL, NULL, NULL, NULL, NULL, 'gtuj', 'really GG', '346646465', '354646576', 'bsehar912@gmail.com', '25', NULL, NULL, NULL, 'ghvh', 'luggage', '3', '2024-04-02 04:31:07', '2024-04-02 04:31:07'),
(21, NULL, 'fugfu', NULL, 't to g', NULL, NULL, NULL, NULL, NULL, NULL, 'gtuj', 'really GG', '346646465', '354646576', 'bsehar912@gmail.com', '25', NULL, NULL, NULL, 'ghvh', 'luggage', '3', '2024-04-02 04:31:10', '2024-04-02 04:31:10'),
(22, NULL, 'fugfu', NULL, 't to g', NULL, NULL, NULL, NULL, NULL, NULL, 'gtuj', 'really GG', '346646465', '354646576', 'bsehar912@gmail.com', '25', NULL, NULL, NULL, 'ghvh', 'luggage', '3', '2024-04-02 04:31:11', '2024-04-02 04:31:11'),
(23, 'hello', NULL, 'hello', NULL, NULL, 'male', '3', NULL, '30', 'black', 'hsjsjx', NULL, '728374728', '628478492', 'bsehar912@gmail.co', '20', NULL, 'bwkxjjd', 'bdksbdi', 'bsixbdje', 'kid', '3', '2024-04-02 04:37:04', '2024-04-02 04:37:04'),
(24, 'hello', NULL, 'hello', NULL, NULL, 'male', '3', NULL, '30', 'black', 'hsjsjx', NULL, '728374728', '628478492', 'bsehar912@gmail.co', '20', NULL, 'bwkxjjd', 'bdksbdi', 'bsixbdje', 'kid', '3', '2024-04-02 04:37:06', '2024-04-02 04:37:06'),
(25, 'hello', NULL, 'hello', NULL, NULL, 'male', '3', NULL, '30', 'black', 'hsjsjx', NULL, '728374728', '628478492', 'bsehar912@gmail.co', '20', NULL, 'bwkxjjd', 'bdksbdi', 'bsixbdje', 'kid', '3', '2024-04-02 04:37:07', '2024-04-02 04:37:07'),
(26, 'hello', NULL, 'hello', NULL, NULL, 'male', '3', NULL, '30', 'black', 'hsjsjx', NULL, '728374728', '628478492', 'bsehar912@gmail.co', '20', NULL, 'bwkxjjd', 'bdksbdi', 'bsixbdje', 'kid', '3', '2024-04-02 04:37:09', '2024-04-02 04:37:09'),
(27, 'Peter', NULL, 'Mike', NULL, NULL, 'male', '6', NULL, '50', 'blue', 'vajdh', NULL, '718373828', '728373828', 'test@test.con', '635', NULL, 'jdkdhfie', 'hdjiddjkd', 'jdksjifhe', 'kid', '3', '2024-04-02 04:39:44', '2024-04-02 04:39:44'),
(28, 'kid', NULL, 'kid father', NULL, NULL, 'male', '6', NULL, '20', 'black', 'hsishf', NULL, '928384737284', '72837382847', 'bsehar912@gmail.co', '30', NULL, 'hsjzhdi', 'hsidhdi', 'bdusbdj', 'kid', '3', '2024-04-02 05:05:56', '2024-04-02 05:05:56'),
(29, 'kid', NULL, 'kid father', NULL, NULL, 'male', '6', NULL, '20', 'black', 'hsishf', NULL, '928384737284', '72837382847', 'bsehar912@gmail.co', '30', NULL, 'hsjzhdi', 'hsidhdi', 'bdusbdj', 'kid', '3', '2024-04-02 05:11:29', '2024-04-02 05:11:29'),
(30, 'kid', NULL, 'kid father', NULL, NULL, 'male', '6', NULL, '20', 'black', 'hsishf', NULL, '928384737284', '72837382847', 'bsehar912@gmail.co', '30', NULL, 'hsjzhdi', 'hsidhdi', 'bdusbdj', 'kid', '3', '2024-04-02 05:13:04', '2024-04-02 05:13:04'),
(31, 'the lost kid', '', 'lost kid father', '', '', 'male', '4', '', '3.5', 'black', 'address', '', 'mobilenumber 1', 'mobileNumber2', 'email12@gmail.com', '120', '', '', 'None', 'None', 'kid', '4', '2024-04-02 05:34:05', '2024-04-02 05:34:05'),
(32, 'the lost kid', '', 'lost kid father', '', '', 'male', '4', '', '3.5', 'black', 'address', '', 'mobilenumber 1', 'mobileNumber2', 'email12@gmail.com', '120', '', '', 'None', 'None', 'kid', '4', '2024-04-02 05:37:30', '2024-04-02 05:37:30'),
(33, 'kid', NULL, 'kid', NULL, NULL, 'male', '4', NULL, '100', 'blacl', 'bsjshheksh', NULL, '817387482', '7283782774', 'test@test.com', '6434', NULL, 'hdkshfe', 'hi idhxd', 'jdkhjf', 'kid', '3', '2024-04-02 05:40:46', '2024-04-02 05:40:46'),
(34, 'kid', NULL, 'kid', NULL, NULL, 'male', '4', NULL, '100', 'blacl', 'bsjshheksh', NULL, '817387482', '7283782774', 'test@test.com', '6434', NULL, 'hdkshfe', 'hi idhxd', 'jdkhjf', 'kid', '3', '2024-04-02 05:43:50', '2024-04-02 05:43:50'),
(35, 'kid', NULL, 'kid', NULL, NULL, 'male', '4', NULL, '100', 'black', 'bsjshheksh', NULL, '817387482', '7283782774', 'test@test.com', '6434', NULL, 'hdkshfe', 'hi idhxd', 'jdkhjf', 'kid', '3', '2024-04-02 05:45:54', '2024-04-02 05:45:54'),
(36, 'kid', NULL, 'kid', NULL, NULL, 'male', '4', NULL, '100', 'black', 'bsjshheksh', NULL, '817387482', '7283782774', 'test@test.com', '6434', NULL, 'hdkshfe', 'hi idhxd', 'jdkhjf', 'kid', '3', '2024-04-02 05:46:58', '2024-04-02 05:46:58'),
(37, 'kid', NULL, 'kid', NULL, NULL, 'male', '4', NULL, '100', 'black', 'bsjshheksh', NULL, '817387482', '7283782774', 'test@test.com', '6434', NULL, 'hdkshfe', 'hi idhxd', 'jdkhjf', 'kid', '3', '2024-04-02 05:47:39', '2024-04-02 05:47:39'),
(38, 'hellox', NULL, 'bfjrv', NULL, NULL, 'male', '6', NULL, '200', 'dbkd', 'hsjdu', NULL, '63748373', '627462837', 'seharbatool@test.com', '25', NULL, 'heidh', 'hejdh', 'hejdh', 'kid', '3', '2024-04-02 05:54:44', '2024-04-02 05:54:44'),
(39, 'Authticated user', 'User1', '', '', '', 'male', '4', '10', '', '', 'address', 'Orange', 'mobileNumber', '', 'email@gmail.com', '100', 'Dr Doctor', '', 'medicalIssues', NULL, 'pet', '4', '2024-04-02 06:15:14', '2024-04-02 06:15:14'),
(40, '', 'lost kid father', '', 'Brand', 'Suit Case', '', '', '', '', '', 'address', '', 'mobilenumber 1', 'mobileNumber2', 'email12@gmail.com', '120', '', '', '', 'None', 'luggage', '4', '2024-04-02 06:17:58', '2024-04-02 06:17:58'),
(41, '', 'lost kid father', '', 'Brand', 'Suit Case', '', '', '', '', '', 'address', '', 'mobilenumber 1', 'mobileNumber2', 'email12@gmail.com', '120', '', '', '', 'None', 'luggage', '4', '2024-04-02 06:18:40', '2024-04-02 06:18:40'),
(42, '', 'Authentication User', '', 'Brand', 'Suit Case', '', '', '', '', '', 'address', '', 'mobilenumber 1', 'mobileNumber2', 'email12@gmail.com', '120', '', '', '', 'None', 'luggage', '4', '2024-04-02 06:20:58', '2024-04-02 06:20:58'),
(43, NULL, 'test', NULL, 'test', NULL, NULL, NULL, NULL, NULL, NULL, 'test', 'test', '356754331', '2345675432', 'bsehar912@gmail.com', '122', NULL, NULL, NULL, 'test', 'luggage', '3', '2024-04-03 00:59:19', '2024-04-03 00:59:19'),
(44, 'the lost kid', '', 'lost kid father', '', '', 'male', '4', '', '3.5', 'black', 'address', '', 'mobilenumber 1', 'mobileNumber2', 'email12@gmail.com', '120', '', '', 'None', 'None', 'kid', '4', '2024-04-03 01:41:11', '2024-04-03 01:41:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `accounts_email_unique` (`email`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
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
-- Indexes for table `tags_category`
--
ALTER TABLE `tags_category`
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
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tags_category`
--
ALTER TABLE `tags_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
