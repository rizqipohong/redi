-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2021 at 12:20 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dokans`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminmenus`
--

CREATE TABLE `adminmenus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `adminmenus`
--

INSERT INTO `adminmenus` (`id`, `name`, `position`, `data`, `lang`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Header', 'header', '[{\"text\":\"Home\",\"href\":\"/\",\"icon\":\"\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Login\",\"href\":\"/login\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"}]', 'en', 1, '2021-01-08 08:21:55', '2021-07-01 18:07:23'),
(2, 'Useful links', 'footer_left', '[{\"text\":\"Academy\",\"href\":\"/\",\"icon\":\"\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Help\",\"href\":\"/contact\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Community\",\"href\":\"/contact\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Tools\",\"href\":\"/contact\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"}]', 'en', 1, '2021-01-10 01:46:43', '2021-01-16 00:04:06'),
(3, 'Policy', 'footer_right', '[{\"text\":\"Policy\",\"href\":\"/page/terms-and-condition\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Service Policy\",\"href\":\"/page/terms-and-condition\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Refund Policy\",\"href\":\"/page/terms-and-condition\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"}]', 'en', 1, '2021-01-10 01:58:24', '2021-01-16 00:09:59'),
(4, 'Information', 'footer_center', '[{\"text\":\"About Us\",\"href\":\"#about_us\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Partners Program\",\"href\":\"/contact\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Priceing\",\"href\":\"#priceing\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Payment gateway\",\"href\":\"/contact\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"}]', 'en', 1, '2021-01-10 01:58:40', '2021-01-16 00:02:47'),
(5, 'Header Arabic', 'header', '[{\"text\":\"الصفحة الرئيسية\",\"icon\":\"\",\"href\":\"/\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"التسعير\",\"icon\":\"empty\",\"href\":\"/priceing\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"صالة عرض\",\"icon\":\"empty\",\"href\":\"/service\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"اتصل\",\"icon\":\"empty\",\"href\":\"/contact\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"تسجيل الدخول\",\"icon\":\"empty\",\"href\":\"/login\",\"target\":\"_self\",\"title\":\"\"}]', 'ar', 1, '2021-01-11 10:09:00', '2021-01-11 10:10:56'),
(6, 'معلومات', 'footer_center', '[{\"text\":\"معلومات عنا\",\"icon\":\"\",\"href\":\"#about_us\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"برنامج الشركاء\",\"icon\":\"empty\",\"href\":\"/contact\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"التسعير\",\"icon\":\"empty\",\"href\":\"#priceing\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"بوابة الدفع\",\"icon\":\"empty\",\"href\":\"/contact\",\"target\":\"_self\",\"title\":\"\"}]', 'ar', 1, '2021-01-16 00:05:58', '2021-01-16 00:08:26'),
(7, 'سياسات', 'footer_right', '[{\"text\":\"سياسات\",\"icon\":\"\",\"href\":\"/page/terms-and-condition\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"سياسة الخدمة\",\"icon\":\"empty\",\"href\":\"/page/terms-and-condition\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"سياسة الاسترجاع\",\"icon\":\"empty\",\"href\":\"/page/terms-and-condition\",\"target\":\"_self\",\"title\":\"\"}]', 'ar', 1, '2021-01-16 00:06:18', '2021-01-16 00:10:29'),
(8, 'روابط مفيدة', 'footer_left', '[{\"text\":\"الأكاديمية\",\"icon\":\"empty\",\"href\":\"/\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"مساعدة\",\"icon\":\"empty\",\"href\":\"/contact\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"تواصل اجتماعي\",\"icon\":\"empty\",\"href\":\"/contact\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"أدوات\",\"icon\":\"empty\",\"href\":\"/contact\",\"target\":\"_self\",\"title\":\"\"}]', 'ar', 1, '2021-01-16 00:06:35', '2021-01-16 00:24:25');

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `variation_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `term_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'category',
  `p_id` bigint(20) UNSIGNED DEFAULT NULL,
  `featured` int(11) NOT NULL DEFAULT 0,
  `menu_status` int(11) NOT NULL DEFAULT 0,
  `is_admin` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `type`, `p_id`, `featured`, `menu_status`, `is_admin`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'Default', 'default', 'parent_attribute', NULL, 0, 0, 0, '2020-12-12 07:49:38', '2020-12-12 07:49:38', 1),
(2, 'COD', 'cod', 'payment_getway', NULL, 1, 0, 0, '2020-12-12 07:49:38', '2020-12-12 07:49:38', 1),
(3, 'INSTAMOJO', 'instamojo', 'payment_getway', NULL, 0, 0, 0, '2020-12-12 07:49:39', '2020-12-12 07:49:39', 1),
(4, 'RAZORPAY', 'razorpay', 'payment_getway', NULL, 0, 0, 0, '2020-12-12 07:49:39', '2020-12-12 07:49:39', 1),
(5, 'PAYPAL', 'paypal', 'payment_getway', NULL, 0, 0, 0, '2020-12-12 07:49:39', '2021-07-02 02:58:36', 1),
(6, 'STRIPE', 'stripe', 'payment_getway', NULL, 0, 0, 0, '2020-12-12 07:49:40', '2020-12-12 07:49:40', 1),
(7, 'TOYYIBPAY', 'toyyibpay', 'payment_getway', NULL, 0, 0, 0, '2020-12-12 07:49:40', '2020-12-12 07:49:40', 1),
(8, 'Mollie', 'mollie', 'payment_getway', NULL, 0, 0, 0, '2020-12-12 07:54:58', '2020-12-13 23:28:00', 1),
(9, 'Paystack', 'paystack', 'payment_getway', NULL, 0, 0, 0, '2020-12-12 07:54:58', '2020-12-13 23:28:00', 1),
(73, 'James Curran', 'General Manager Spotify', 'testimonial', NULL, 0, 0, 1, '2020-12-18 10:36:54', '2020-12-18 10:36:54', 1),
(74, 'Jose Evans', 'Chief Engineer Apple', 'testimonial', NULL, 0, 0, 1, '2020-12-18 10:37:34', '2020-12-18 10:37:34', 1),
(75, '#', NULL, 'brand', NULL, 0, 0, 1, '2020-12-18 11:02:34', '2020-12-18 11:02:34', 1),
(76, '#', NULL, 'brand', NULL, 0, 0, 1, '2020-12-18 11:02:43', '2020-12-18 11:02:43', 1),
(77, '#', NULL, 'brand', NULL, 0, 0, 1, '2020-12-18 11:02:57', '2020-12-18 11:02:57', 1),
(78, '#', NULL, 'brand', NULL, 0, 0, 1, '2020-12-18 11:03:05', '2020-12-18 11:03:05', 1),
(79, '#', NULL, 'brand', NULL, 0, 0, 1, '2020-12-18 11:03:14', '2020-12-18 11:03:14', 1),
(81, 'Start an online business', 'start-an-online-business', 'features', NULL, 0, 0, 1, '2021-01-09 10:20:57', '2021-01-09 10:20:57', 1),
(82, 'Move your business online', 'move-your-business-online', 'features', NULL, 0, 0, 1, '2021-01-09 10:23:50', '2021-01-09 10:23:50', 1),
(83, 'Switch to dokans', 'switch-to-dokans', 'features', NULL, 0, 0, 1, '2021-01-09 10:27:48', '2021-01-09 10:27:48', 1),
(85, 'Hire a dokans expert', 'hire-a-dokans-expert', 'features', NULL, 0, 0, 1, '2021-01-09 10:34:21', '2021-01-09 10:34:21', 1),
(87, '#test', '', 'gallery', NULL, 0, 0, 1, '2021-01-09 11:19:05', '2021-01-09 11:19:05', 1),
(88, '#', '1', 'gallery', NULL, 0, 0, 1, '2021-01-09 11:19:17', '2021-01-09 11:19:17', 1),
(89, '#', '1', 'gallery', NULL, 0, 0, 1, '2021-01-09 11:19:27', '2021-01-09 11:19:27', 1),
(90, '#', '1', 'gallery', NULL, 0, 0, 1, '2021-01-09 11:32:18', '2021-01-09 11:32:18', 1),
(91, 'Product Inventors', 'start-an-online-business', 'features', NULL, 0, 0, 1, '2021-01-09 10:20:57', '2021-01-09 10:20:57', 1),
(92, 'Easy to customization', 'start-an-online-business', 'features', NULL, 0, 0, 1, '2021-01-09 10:20:57', '2021-01-09 10:20:57', 1),
(93, '#', NULL, 'brand', NULL, 0, 0, 1, '2020-12-18 11:03:14', '2020-12-18 11:03:14', 1),
(94, 'Ratapay', 'ratapay', 'payment_getway', NULL, 1, 0, 1, '2020-12-12 07:49:39', '2021-07-02 02:56:58', 1),
(95, 'Indonesia', 'indonesia', 'city', NULL, 0, 0, 0, '2021-07-02 03:04:28', '2021-07-02 03:04:28', 4),
(96, 'Indonesia', '0', 'method', NULL, 0, 0, 0, '2021-07-02 03:04:39', '2021-07-02 03:04:39', 4),
(97, 'Indonesia', 'indonesia', 'city', NULL, 0, 0, 0, '2021-07-04 02:30:19', '2021-07-04 02:30:19', 5),
(98, 'Indonesia', '0', 'method', NULL, 0, 0, 0, '2021-07-04 02:30:31', '2021-07-04 02:30:31', 5);

-- --------------------------------------------------------

--
-- Table structure for table `categorymedia`
--

CREATE TABLE `categorymedia` (
  `media_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categorymetas`
--

CREATE TABLE `categorymetas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categorymetas`
--

INSERT INTO `categorymetas` (`id`, `category_id`, `type`, `content`, `created_at`, `updated_at`) VALUES
(1, 2, 'description', 'description', '2020-12-12 07:49:38', '2020-12-12 07:49:38'),
(2, 2, 'preview', 'uploads/cod.png', '2020-12-12 07:49:39', '2020-12-12 07:49:39'),
(3, 3, 'description', 'description', '2020-12-12 07:49:39', '2020-12-12 07:49:39'),
(4, 3, 'preview', 'uploads/instamojo.png', '2020-12-12 07:49:39', '2020-12-12 07:49:39'),
(5, 4, 'description', 'description', '2020-12-12 07:49:39', '2020-12-12 07:49:39'),
(6, 4, 'preview', 'uploads/razorpay.png', '2020-12-12 07:49:39', '2020-12-12 07:49:39'),
(7, 5, 'description', 'Pay with Paypal', '2020-12-12 07:49:39', '2021-07-01 17:52:57'),
(8, 5, 'preview', 'uploads/paypal.png', '2020-12-12 07:49:39', '2020-12-12 07:49:39'),
(9, 6, 'description', 'description', '2020-12-12 07:49:40', '2020-12-12 07:49:40'),
(10, 6, 'preview', 'uploads/stripe.png', '2020-12-12 07:49:40', '2020-12-12 07:49:40'),
(11, 7, 'description', 'description', '2020-12-12 07:49:40', '2020-12-12 07:49:40'),
(12, 7, 'preview', 'uploads/toyyibpay.jpg', '2020-12-12 07:49:40', '2020-12-12 07:49:40'),
(35, 73, 'excerpt', 'We use Impact mainly for its site explorer, and it’s immensely improved how we find link targets. We use it both for getting quick analysis of a site, as well as utilizing its extensive index when we want to dive deep.', '2020-12-18 10:36:54', '2020-12-18 10:36:54'),
(36, 74, 'excerpt', 'We use Impact mainly for its site explorer, and it’s immensely improved how we find link targets. We use it both for getting quick analysis of a site, as well as utilizing its extensive index when we want to dive deep.', '2020-12-18 10:37:34', '2020-12-18 10:37:34'),
(37, 75, 'preview', 'uploads/1/2020/12/1608314554.png', '2020-12-18 11:02:34', '2020-12-18 11:02:34'),
(38, 76, 'preview', 'uploads/1/2020/12/1608314563.png', '2020-12-18 11:02:43', '2020-12-18 11:02:43'),
(39, 77, 'preview', 'uploads/1/2020/12/1608314577.png', '2020-12-18 11:02:57', '2020-12-18 11:02:57'),
(40, 78, 'preview', 'uploads/1/2020/12/1608314585.png', '2020-12-18 11:03:06', '2020-12-18 11:03:06'),
(41, 79, 'preview', 'uploads/1/2020/12/1608314594.png', '2020-12-18 11:03:14', '2020-12-18 11:03:14'),
(42, 8, 'description', 'description', '2020-12-12 07:49:38', '2020-12-12 07:49:38'),
(43, 8, 'preview', 'uploads/mollie.png', '2020-12-12 07:49:39', '2020-12-12 07:49:39'),
(44, 4, 'credentials', '{\"key_id\":\"\",\"key_secret\":\"\",\"currency\":\"USD\"}', '2020-12-29 00:42:37', '2020-12-29 00:51:10'),
(45, 3, 'credentials', '{\"x_api_Key\":\"\",\"x_api_token\":\"\"}', '2020-12-29 00:42:54', '2020-12-29 00:42:54'),
(46, 5, 'credentials', '{\"client_id\":\"10156\",\"client_secret\":\"sawadadddadadawd\",\"currency\":\"IDR\"}', '2020-12-29 00:43:08', '2021-07-01 17:52:57'),
(47, 6, 'credentials', '{\"publishable_key\":\"\",\"secret_key\":\"\",\"currency\":\"USD\"}', '2020-12-29 00:43:20', '2020-12-29 00:50:41'),
(48, 7, 'credentials', '{\"userSecretKey\":\"\",\"categoryCode\":\"\"}', '2020-12-29 00:43:32', '2020-12-29 00:43:32'),
(49, 8, 'credentials', '{\"api_key\":\"\",\"currency\":\"USD\"}', '2020-12-29 00:50:18', '2020-12-29 00:50:18'),
(50, 81, 'preview', 'uploads/1/2021/01/1610212857.svg', '2021-01-09 10:20:57', '2021-01-09 10:20:57'),
(51, 81, 'excerpt', 'Create a business, whether you’ve got a fresh idea or are looking for a new way to make money.', '2021-01-09 10:20:57', '2021-01-09 10:20:57'),
(52, 82, 'preview', 'uploads/1/2021/01/1610213030.svg', '2021-01-09 10:23:51', '2021-01-09 10:23:51'),
(53, 82, 'excerpt', 'Turn your retail store into an online store and keep serving customers without missing a beat.', '2021-01-09 10:23:51', '2021-01-09 10:23:51'),
(54, 83, 'preview', 'uploads/1/2021/01/1610213268.svg', '2021-01-09 10:27:48', '2021-01-09 10:27:48'),
(55, 83, 'excerpt', 'Bring your business to Shopify, no matter which ecommerce platform you’re currently using.', '2021-01-09 10:27:48', '2021-01-09 10:27:48'),
(58, 85, 'preview', 'uploads/1/2021/01/1610213661.svg', '2021-01-09 10:34:21', '2021-01-09 10:34:21'),
(59, 85, 'excerpt', 'Get set up with the help of a trusted freelancer or agency from the dokans Experts Marketplace.', '2021-01-09 10:34:21', '2021-01-09 10:34:21'),
(61, 87, 'preview', 'uploads/admin/1/2021/01/1610216345.webp', '2021-01-09 11:19:05', '2021-01-09 11:19:05'),
(62, 88, 'preview', 'uploads/admin/1/2021/01/1610216357.webp', '2021-01-09 11:19:17', '2021-01-09 11:19:17'),
(63, 89, 'preview', 'uploads/admin/1/2021/01/1610216367.webp', '2021-01-09 11:19:27', '2021-01-09 11:19:27'),
(64, 90, 'preview', 'uploads/admin/1/2021/01/1610217138.webp', '2021-01-09 11:32:18', '2021-01-09 11:32:18'),
(65, 9, 'credentials', '{\"public_key\":\"\",\"secret_key\":\"\",\"currency\":\"GHS\"}', '2020-12-29 00:50:18', '2020-12-29 00:50:18'),
(66, 9, 'preview', 'uploads/paystack.png', '2020-12-12 07:49:39', '2020-12-12 07:49:39'),
(67, 9, 'description', 'description', '2020-12-12 07:49:38', '2020-12-12 07:49:38'),
(68, 91, 'excerpt', 'Create a business, whether you’ve got a fresh idea or are looking for a new way to make money.', '2021-01-09 10:20:57', '2021-01-09 10:20:57'),
(69, 92, 'excerpt', 'Create a business, whether you’ve got a fresh idea or are looking for a new way to make money.', '2021-01-09 10:20:57', '2021-01-09 10:20:57'),
(70, 91, 'preview', 'uploads/1/2021/01/1610212859.svg', '2021-01-09 10:20:57', '2021-01-09 10:20:57'),
(71, 92, 'preview', 'uploads/1/2021/01/1610212858.svg', '2021-01-09 10:20:57', '2021-01-09 10:20:57'),
(72, 93, 'preview', 'uploads/1/2020/12/nginx-logo.svg', '2020-12-18 11:03:14', '2020-12-18 11:03:14'),
(73, 94, 'description', 'Pay via Ratapay', '2020-12-12 07:49:39', '2021-07-02 02:56:58'),
(74, 94, 'preview', 'uploads/admin/1/21/07/0207211625219890.png', '2020-12-12 07:49:39', '2021-07-02 02:58:10'),
(75, 94, 'credentials', '[\"\"]', '2021-07-02 02:58:10', '2021-07-02 02:58:10');

-- --------------------------------------------------------

--
-- Table structure for table `categoryrelations`
--

CREATE TABLE `categoryrelations` (
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `relation_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categoryrelations`
--

INSERT INTO `categoryrelations` (`category_id`, `relation_id`) VALUES
(96, 95),
(98, 97);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `domain_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `domains`
--

CREATE TABLE `domains` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `domain` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_domain` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `template_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `shop_type` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `domains`
--

INSERT INTO `domains` (`id`, `domain`, `full_domain`, `status`, `user_id`, `template_id`, `shop_type`, `created_at`, `updated_at`) VALUES
(1, 'me.multicommerce.test', 'http://me.multicommerce.test', 1, 2, 1, 1, '2021-07-01 17:49:48', '2021-07-01 17:56:40'),
(3, 'fifizz02.multicommerce.test', 'http://fifizz02.multicommerce.test', 1, 4, 1, 1, '2021-07-02 02:07:58', '2021-07-02 02:07:58'),
(4, 'saya.multicommerce.test', 'http://saya.multicommerce.test', 1, 5, 1, 0, '2021-07-04 02:27:47', '2021-07-04 02:30:02'),
(5, 'saya1.multicommerce.test', 'http://saya1.multicommerce.test', 1, 6, 1, 1, '2021-07-04 02:57:45', '2021-07-04 02:57:45');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `getways`
--

CREATE TABLE `getways` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `getways`
--

INSERT INTO `getways` (`id`, `user_id`, `category_id`, `content`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 94, '{\"title\":\"ratapay\",\"description\":\"\",\"currency\":\"\",\"key_id\":\"112\",\"key_secret\":\"7JLB77BglUe8aAvnP1RkbOhkFfdsbZrDVn97QvQ5\"}', 1, '2021-07-02 02:59:31', '2021-07-02 02:59:31'),
(2, 4, 6, '{\"title\":\"stripe\",\"description\":\"tes\",\"currency\":\"IDR\",\"stripe_key\":\"qeqeqeqe\",\"stripe_secret\":\"qdqdqwdqwd\",\"env\":\"sandbox\"}', 1, '2021-07-02 03:01:04', '2021-07-02 03:01:17'),
(3, 5, 94, '{\"title\":\"Ratapay\",\"description\":\"Pay via Ratapay\",\"currency\":\"IDR\",\"key_id\":null,\"key_secret\":null}', 1, '2021-07-04 02:27:48', '2021-07-04 02:27:48'),
(4, 6, 94, '{\"title\":\"Ratapay\",\"description\":\"Pay via Ratapay\",\"currency\":\"IDR\",\"key_id\":\"9117\",\"key_secret\":\"o9GkkcO3zAFFRwflGXRrXYqJAFSjxbvnGAgXdVq8\"}', 1, '2021-07-04 02:57:45', '2021-07-04 02:57:45');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `user_id`, `name`, `url`, `created_at`, `updated_at`) VALUES
(1, 4, 'uploads/4/21/07/020721162521778360dedaf727a92.webp', '//fifizz02.multicommerce.test/uploads/4/21/07/020721162521778360dedaf727a92.webp', '2021-07-02 02:23:04', '2021-07-02 02:23:04');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `metas`
--

CREATE TABLE `metas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `metas`
--

INSERT INTO `metas` (`id`, `term_id`, `key`, `value`) VALUES
(59, 34, 'excerpt', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960'),
(60, 34, 'content', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum'),
(61, 35, 'content', '{\"content\":\"<p>ini produk 1<\\/p>\",\"excerpt\":null}'),
(62, 35, 'seo', '{\"meta_title\":\"Produk 1\",\"meta_description\":\"\",\"meta_keyword\":\"\"}'),
(63, 36, 'content', '{\"content\":\"<p>awdawdawd<\\/p>\",\"excerpt\":\"adwad\"}'),
(64, 36, 'seo', '{\"meta_title\":\"TEs PRD\",\"meta_description\":\"\",\"meta_keyword\":\"\"}');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(5, '2020_08_18_193029_create_templates_table', 1),
(6, '2020_08_18_193030_create_domains_table', 1),
(7, '2020_08_18_193033_create_categories_table', 1),
(8, '2020_08_18_193343_create_terms_table', 1),
(9, '2020_08_18_193358_create_metas_table', 1),
(10, '2020_08_18_194203_create_postcategories_table', 1),
(11, '2020_08_18_201413_create_adminmenus_table', 1),
(12, '2020_08_18_201414_create_menus_table', 1),
(13, '2020_08_18_201436_create_options_table', 1),
(14, '2020_08_18_201617_create_usermetas_table', 1),
(15, '2020_08_25_165636_create_categorymetas_table', 1),
(16, '2020_09_14_162315_create_permission_tables', 1),
(17, '2020_09_20_052737_create_plans_table', 1),
(18, '2020_10_09_122906_create_attributes_table', 1),
(19, '2020_10_09_123652_create_stocks_table', 1),
(20, '2020_10_09_124238_create_media_table', 1),
(21, '2020_10_09_124646_create_postmedia_table', 1),
(22, '2020_10_15_182226_create_files_table', 1),
(23, '2020_10_17_152834_create_categoryrelations_table', 1),
(24, '2020_10_18_053526_create_useroptions_table', 1),
(25, '2020_10_19_180725_create_getways_table', 1),
(26, '2020_10_21_083527_create_categorymedia_table', 1),
(27, '2020_10_27_174958_create_trasections_table', 1),
(28, '2020_10_27_174959_create_orders_table', 1),
(29, '2020_11_05_065943_create_ordermetas_table', 1),
(30, '2020_11_05_072101_create_orderitems_table', 1),
(31, '2020_11_05_074430_create_ordershippings_table', 1),
(32, '2020_11_06_110926_create_jobs_table', 1),
(33, '2020_11_15_175403_create_userplans_table', 1),
(34, '2020_12_13_072447_create_reviews_table', 1),
(35, '2021_02_04_072932_create_prices_table', 1),
(36, '2021_02_04_074632_create_termoptions_table', 1),
(37, '2021_02_17_061654_create_userplanmetas_table', 1),
(38, '2020_10_27_174950_create_customers_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'langlist', '{\"English\":\"en\",\"Bengali\":\"bn\"}', '2020-12-12 07:49:37', '2020-12-12 07:49:37'),
(2, 'order_prefix', 'MRP', '2020-12-12 07:49:38', '2021-07-01 18:05:06'),
(3, 'company_info', '{\"name\":\"Ratapay\",\"site_description\":\"Ratapay Merchants Directory\",\"email1\":\"support@ratapay.co.id\",\"email2\":\"support@ratapay.co.id\",\"phone1\":\"+62811011514\",\"phone2\":\"+62811011514\",\"country\":\"Indonesia\",\"zip_code\":\"55165\",\"state\":\"DIY\",\"city\":\"Yogyakarta\",\"address\":\"MIliran UH II No.197, RT011\\/RW004, Muja-Muju, Umbulharjo\",\"facebook\":\"https:\\/\\/web.facebook.com\\/ratapay.id\",\"twitter\":\"#\",\"linkedin\":\"#\",\"instagram\":\"#\",\"youtube\":\"https:\\/\\/www.youtube.com\\/channel\\/UCKqYqJYsIeVpnzTLfhkLcsA\",\"site_color\":\"#33cc68\"}', '2020-12-12 07:49:38', '2021-07-01 18:05:06'),
(4, 'currency_info', '{\"currency_name\":\"IDR\",\"currency_icon\":\"Rp\",\"currency_possition\":\"left\"}', '2020-12-12 07:49:38', '2021-07-01 18:05:06'),
(5, 'cron_info', '{\"send_mail_to_will_expire_within_days\":\"7\",\"send_notification_expired_date\":\"on\",\"auto_assign_to_default\":\"on\",\"auto_approve\":\"on\"}', '2020-12-12 07:49:38', '2020-12-12 07:49:38'),
(6, 'header', '{\"title\":\"SELL EVERYWHERE\",\"highlight_title\":\"Increase your productivity\",\"ytb_video\":\"75TGjNieK84\",\"description\":\"Use one platform to sell products to anyone, anywhere\\u2014in person with Point of Sale and online through your website, social media, and online marketplaces.\",\"preview\":\"uploads\\/1\\/2021\\/01\\/1610213945.webp\"}', '2020-12-18 10:14:36', '2021-01-09 11:05:30'),
(7, 'faqs', '{\"description\":\"<h2>Site Audit<\\/h2>\\r\\n\\r\\n<p>Site Audit crawls all the pages it finds on your website &ndash; then provides an overall SEO health score, visualises key data in charts, flags all possible SEO issues and provides recommendations on how to fix them.<\\/p>\\r\\n\\r\\n<p>Have a huge website? Not an issue.<\\/p>\\r\\n\\r\\n<p><a href=\\\"https:\\/\\/demos.creative-tim.com\\/impact-design-system\\/front\\/pages\\/about.html\\\">Learn More&nbsp;<\\/a><\\/p>\",\"preview\":\"uploads\\/1\\/2020\\/12\\/1608311802.svg\"}', '2020-12-18 10:16:42', '2020-12-18 10:19:03'),
(8, 'marketing_tool', '{\"ga_measurement_id\":\"UA-180680025-1\",\"analytics_view_id\":\"231381168\",\"google_status\":\"on\",\"fb_pixel\":\"\",\"fb_pixel_status\":\"\"}', '2020-12-25 10:32:48', '2020-12-25 10:32:48'),
(9, 'languages', '{\"en\":\"English\",\"bn\":\"Bangla\",\"ar\":\"Arabic\",\"id\":\"Indonesia\"}', '2021-01-05 02:51:31', '2021-07-01 18:15:39'),
(10, 'active_languages', '{\"en\":\"English\",\"id\":\"Indonesia\"}', '2021-01-08 08:21:41', '2021-07-01 18:17:06'),
(11, 'about_1', '{\"title\":\"Upload your product\",\"description\":\"Enter the product along with other complete information such as photos, videos, variations, product descriptions, promotions and so on.\",\"btn_link\":\"\",\"btn_text\":\"\",\"preview\":\"icofont-cloud-upload\"}', '2021-01-09 11:51:25', '2021-07-01 18:11:01'),
(12, 'about_2', '{\"title\":\"Setup your store\",\"description\":\"Insert logo, banner and modify your store theme according to your own brand identity without having to create any code.\",\"btn_link\":\"\",\"btn_text\":\"\",\"preview\":\"icofont-shopping-cart\"}', '2021-01-09 11:55:31', '2021-01-15 23:18:44'),
(13, 'about_3', '{\"title\":\"The launch continues\",\"description\":\"Easily, your online store goes live and you can validate your business and get market share faster than your other competitors.\",\"btn_link\":\"\",\"btn_text\":\"\",\"preview\":\"icofont-rocket-alt-2\"}', '2021-01-09 11:56:22', '2021-01-15 23:56:08'),
(14, 'seo', '{\"title\":\"Ratapay\",\"description\":\"Ratapay merchants directory\",\"canonical\":\"http:\\/\\/localhost\\/dokans\",\"tags\":\"ratapay\",\"twitterTitle\":\"@ratapay\"}', '2021-01-16 01:30:26', '2021-07-01 18:15:15'),
(15, 'auto_order', 'yes', '2021-02-21 11:14:35', '2021-02-21 11:14:44'),
(16, 'ecom_features', '{\"top_image\":\"uploads\\/1\\/2021\\/03\\/1615392340.png\",\"center_image\":\"uploads\\/1\\/2021\\/03\\/1615392340.webp\",\"bottom_image\":\"uploads\\/1\\/2021\\/03\\/1615392340.webp\",\"area_title\":\"Market your business\",\"description\":\"Take the guesswork out of marketing with built-in tools that help you create, execute, and analyze digital marketing campaigns.\",\"btn_link\":null,\"btn_text\":null}', '2021-02-21 11:14:35', '2021-07-01 18:11:41'),
(17, 'counter_area', '{\"happy_customer\":\"1000\",\"total_reviews\":\"800\",\"total_domain\":\"1200\",\"community_member\":\"2000\"}', '2021-02-21 11:14:35', '2021-02-21 11:14:44');

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED NOT NULL,
  `info` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orderitems`
--

INSERT INTO `orderitems` (`id`, `order_id`, `term_id`, `info`, `qty`, `amount`) VALUES
(1, 1, 35, '{\"attribute\":[],\"options\":[]}', 2, 150000),
(2, 2, 35, '{\"attribute\":[],\"options\":[]}', 2, 150000),
(3, 3, 35, '{\"attribute\":[],\"options\":[]}', 2, 150000),
(4, 4, 35, '{\"attribute\":[],\"options\":[]}', 2, 150000),
(5, 5, 35, '{\"attribute\":[],\"options\":[]}', 1, 150000),
(6, 6, 35, '{\"attribute\":[],\"options\":[]}', 1, 150000),
(7, 7, 35, '{\"attribute\":[],\"options\":[]}', 1, 150000),
(8, 8, 35, '{\"attribute\":[],\"options\":[]}', 1, 150000),
(9, 9, 35, '{\"attribute\":[],\"options\":[]}', 1, 150000),
(10, 10, 35, '{\"attribute\":[],\"options\":[]}', 1, 150000),
(11, 11, 35, '{\"attribute\":[],\"options\":[]}', 1, 150000),
(12, 12, 35, '{\"attribute\":[],\"options\":[]}', 1, 150000),
(13, 13, 35, '{\"attribute\":[],\"options\":[]}', 1, 150000),
(14, 14, 35, '{\"attribute\":[],\"options\":[]}', 1, 150000),
(15, 15, 35, '{\"attribute\":[],\"options\":[]}', 1, 150000),
(16, 16, 35, '{\"attribute\":[],\"options\":[]}', 1, 150000),
(17, 17, 35, '{\"attribute\":[],\"options\":[]}', 1, 150000),
(18, 18, 35, '{\"attribute\":[],\"options\":[]}', 1, 150000),
(19, 19, 35, '{\"attribute\":[],\"options\":[]}', 1, 150000),
(20, 20, 35, '{\"attribute\":[],\"options\":[]}', 1, 150000),
(21, 21, 35, '{\"attribute\":[],\"options\":[]}', 1, 150000);

-- --------------------------------------------------------

--
-- Table structure for table `ordermetas`
--

CREATE TABLE `ordermetas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ordermetas`
--

INSERT INTO `ordermetas` (`id`, `order_id`, `key`, `value`) VALUES
(1, 1, 'content', '{\"name\":\"afif izzul\",\"email\":\"hans@localhost.com\",\"phone\":\"085743418963\",\"comment\":\"tes\",\"address\":\"street 1\",\"zip_code\":\"55282\",\"coupon_discount\":\"0.00\",\"sub_total\":\"300000.00\"}'),
(2, 2, 'content', '{\"name\":\"afif izzul\",\"email\":\"myfifizz02@gmail.com\",\"phone\":\"085743418963\",\"comment\":null,\"address\":\"street 1\",\"zip_code\":\"55282\",\"coupon_discount\":\"0.00\",\"sub_total\":\"300000.00\"}'),
(3, 3, 'content', '{\"name\":\"Afif Izzul F\",\"email\":\"aizzulf@live.com\",\"phone\":\"085743418963\",\"comment\":null,\"address\":\"Jogja\",\"zip_code\":\"55555\",\"coupon_discount\":\"0.00\",\"sub_total\":\"300000.00\"}'),
(4, 4, 'content', '{\"name\":\"Afif Izzul F\",\"email\":\"aizzulf@live.com\",\"phone\":\"085743418963\",\"comment\":null,\"address\":\"Jogja\",\"zip_code\":\"55555\",\"coupon_discount\":\"0.00\",\"sub_total\":\"300000.00\"}'),
(5, 5, 'content', '{\"name\":\"afif izzul\",\"email\":\"hans@localhost.com\",\"phone\":\"085743418963\",\"comment\":null,\"address\":\"street 1\",\"zip_code\":\"55282\",\"coupon_discount\":\"0.00\",\"sub_total\":\"150000.00\"}'),
(6, 6, 'content', '{\"name\":\"afif izzul\",\"email\":\"hans@localhost.com\",\"phone\":\"085743418963\",\"comment\":null,\"address\":\"street 1\",\"zip_code\":\"55282\",\"coupon_discount\":\"0.00\",\"sub_total\":\"150000.00\"}'),
(7, 7, 'content', '{\"name\":\"afif izzul\",\"email\":\"hans@localhost.com\",\"phone\":\"085743418963\",\"comment\":null,\"address\":\"street 1\",\"zip_code\":\"55282\",\"coupon_discount\":\"0.00\",\"sub_total\":\"150000.00\"}'),
(8, 8, 'content', '{\"name\":\"afif izzul\",\"email\":\"hans@localhost.com\",\"phone\":\"085743418963\",\"comment\":null,\"address\":\"street 1\",\"zip_code\":\"55282\",\"coupon_discount\":\"0.00\",\"sub_total\":\"150000.00\"}'),
(9, 9, 'content', '{\"name\":\"afif izzul\",\"email\":\"hans@localhost.com\",\"phone\":\"085743418963\",\"comment\":null,\"address\":\"street 1\",\"zip_code\":\"55282\",\"coupon_discount\":\"0.00\",\"sub_total\":\"150000.00\"}'),
(10, 10, 'content', '{\"name\":\"afif izzul\",\"email\":\"hans@localhost.com\",\"phone\":\"085743418963\",\"comment\":null,\"address\":\"street 1\",\"zip_code\":\"55282\",\"coupon_discount\":\"0.00\",\"sub_total\":\"150000.00\"}'),
(11, 11, 'content', '{\"name\":\"afif izzul\",\"email\":\"hans@localhost.com\",\"phone\":\"085743418963\",\"comment\":null,\"address\":\"street 1\",\"zip_code\":\"55282\",\"coupon_discount\":\"0.00\",\"sub_total\":\"150000.00\"}'),
(12, 12, 'content', '{\"name\":\"afif izzul\",\"email\":\"hans@localhost.com\",\"phone\":\"085743418963\",\"comment\":null,\"address\":\"street 1\",\"zip_code\":\"55282\",\"coupon_discount\":\"0.00\",\"sub_total\":\"150000.00\"}'),
(13, 13, 'content', '{\"name\":\"afif izzul\",\"email\":\"hans@localhost.com\",\"phone\":\"085743418963\",\"comment\":null,\"address\":\"street 1\",\"zip_code\":\"55282\",\"coupon_discount\":\"0.00\",\"sub_total\":\"150000.00\"}'),
(14, 14, 'content', '{\"name\":\"afif izzul\",\"email\":\"hans@localhost.com\",\"phone\":\"085743418963\",\"comment\":null,\"address\":\"street 1\",\"zip_code\":\"55282\",\"coupon_discount\":\"0.00\",\"sub_total\":\"150000.00\"}'),
(15, 15, 'content', '{\"name\":\"afif izzul\",\"email\":\"hans@localhost.com\",\"phone\":\"085743418963\",\"comment\":null,\"address\":\"street 1\",\"zip_code\":\"55282\",\"coupon_discount\":\"0.00\",\"sub_total\":\"150000.00\"}'),
(16, 16, 'content', '{\"name\":\"afif izzul\",\"email\":\"hans@localhost.com\",\"phone\":\"085743418963\",\"comment\":null,\"address\":\"street 1\",\"zip_code\":\"55282\",\"coupon_discount\":\"0.00\",\"sub_total\":\"150000.00\"}'),
(17, 17, 'content', '{\"name\":\"afif izzul\",\"email\":\"hans@localhost.com\",\"phone\":\"085743418963\",\"comment\":null,\"address\":\"street 1\",\"zip_code\":\"55282\",\"coupon_discount\":\"0.00\",\"sub_total\":\"150000.00\"}'),
(18, 18, 'content', '{\"name\":\"afif izzul\",\"email\":\"hans@localhost.com\",\"phone\":\"085743418963\",\"comment\":null,\"address\":\"street 1\",\"zip_code\":\"55282\",\"coupon_discount\":\"0.00\",\"sub_total\":\"150000.00\"}'),
(19, 19, 'content', '{\"name\":\"afif izzul\",\"email\":\"hans@localhost.com\",\"phone\":\"085743418963\",\"comment\":null,\"address\":\"street 1\",\"zip_code\":\"55282\",\"coupon_discount\":\"0.00\",\"sub_total\":\"150000.00\"}'),
(20, 20, 'content', '{\"name\":\"afif izzul\",\"email\":\"hans@localhost.com\",\"phone\":\"085743418963\",\"comment\":null,\"address\":\"street 1\",\"zip_code\":\"55282\",\"coupon_discount\":\"0.00\",\"sub_total\":\"150000.00\"}'),
(21, 21, 'content', '{\"name\":\"redisign\",\"email\":\"tokuncahyo@gmail.com\",\"phone\":\"081234567890\",\"comment\":\"12313123\",\"address\":\"123456\",\"zip_code\":\"12345\",\"coupon_discount\":\"0.00\",\"sub_total\":\"150000.00\",\"payment_link\":\"http:\\/\\/localhost:8081\\/payment\\/TRX227AB25752D3D4\"}');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_type` int(11) NOT NULL DEFAULT 0,
  `payment_status` int(11) NOT NULL DEFAULT 2,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `tax` double NOT NULL DEFAULT 0,
  `shipping` double NOT NULL DEFAULT 0,
  `total` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_no`, `transaction_id`, `category_id`, `customer_id`, `user_id`, `order_type`, `payment_status`, `status`, `tax`, `shipping`, `total`, `created_at`, `updated_at`) VALUES
(1, '#INV', NULL, 94, NULL, 4, 1, 2, 'pending', 0, 0, 300000, '2021-07-02 03:05:03', '2021-07-02 03:05:03'),
(2, '#INV1', NULL, 94, NULL, 4, 1, 2, 'pending', 0, 0, 300000, '2021-07-02 03:05:33', '2021-07-02 03:05:33'),
(3, '#INV2', NULL, 94, NULL, 4, 1, 2, 'pending', 0, 0, 300000, '2021-07-02 03:06:47', '2021-07-02 03:06:47'),
(4, '#INV3', NULL, 94, NULL, 4, 1, 2, 'pending', 0, 0, 300000, '2021-07-02 03:10:31', '2021-07-02 03:10:31'),
(5, '#INV4', NULL, 6, NULL, 4, 1, 2, 'pending', 0, 0, 150000, '2021-07-02 03:16:01', '2021-07-02 03:16:01'),
(6, '#INV5', NULL, 94, NULL, 4, 1, 2, 'pending', 0, 0, 150000, '2021-07-02 03:29:19', '2021-07-02 03:29:19'),
(7, '#INV6', NULL, 94, NULL, 4, 1, 2, 'pending', 0, 0, 150000, '2021-07-02 04:35:21', '2021-07-02 04:35:21'),
(8, '#INV7', NULL, 94, NULL, 4, 1, 2, 'pending', 0, 0, 150000, '2021-07-02 04:38:46', '2021-07-02 04:38:46'),
(9, '#INV8', NULL, 94, NULL, 4, 1, 2, 'pending', 0, 0, 150000, '2021-07-02 04:40:25', '2021-07-02 04:40:25'),
(10, '#INV9', NULL, 94, NULL, 4, 1, 2, 'pending', 0, 0, 150000, '2021-07-02 04:41:59', '2021-07-02 04:41:59'),
(11, '#INV10', NULL, 94, NULL, 4, 1, 2, 'pending', 0, 0, 150000, '2021-07-02 04:43:26', '2021-07-02 04:43:26'),
(12, '#INV11', NULL, 94, NULL, 4, 1, 2, 'pending', 0, 0, 150000, '2021-07-02 04:43:37', '2021-07-02 04:43:37'),
(13, '#INV12', NULL, 94, NULL, 4, 1, 2, 'pending', 0, 0, 150000, '2021-07-02 04:43:42', '2021-07-02 04:43:42'),
(14, '#INV13', NULL, 94, NULL, 4, 1, 2, 'pending', 0, 0, 150000, '2021-07-02 04:44:06', '2021-07-02 04:44:06'),
(15, '#INV14', NULL, 94, NULL, 4, 1, 2, 'pending', 0, 0, 150000, '2021-07-02 04:44:52', '2021-07-02 04:44:52'),
(16, '#INV15', NULL, 94, NULL, 4, 1, 2, 'pending', 0, 0, 150000, '2021-07-02 04:49:39', '2021-07-02 04:49:39'),
(17, '#INV16', NULL, 94, NULL, 4, 1, 2, 'pending', 0, 0, 150000, '2021-07-02 04:52:59', '2021-07-02 04:52:59'),
(18, '#INV17', NULL, 94, NULL, 4, 1, 2, 'pending', 0, 0, 150000, '2021-07-02 04:54:09', '2021-07-02 04:54:09'),
(19, '#INV18', NULL, 94, NULL, 4, 1, 2, 'pending', 0, 0, 150000, '2021-07-02 04:54:55', '2021-07-02 04:54:55'),
(20, '#INV19', 'TRXB55A74B25981CE', 94, NULL, 4, 1, 1, 'pending', 0, 0, 150000, '2021-07-02 04:55:58', '2021-07-02 06:33:09'),
(21, '#INV20', NULL, 94, NULL, 4, 1, 2, 'pending', 0, 0, 150000, '2021-07-07 19:36:18', '2021-07-07 19:36:18');

-- --------------------------------------------------------

--
-- Table structure for table `ordershippings`
--

CREATE TABLE `ordershippings` (
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `location_id` bigint(20) UNSIGNED NOT NULL,
  `shipping_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ordershippings`
--

INSERT INTO `ordershippings` (`order_id`, `location_id`, `shipping_id`) VALUES
(1, 95, 96),
(2, 95, 96),
(3, 95, 96),
(4, 95, 96),
(5, 95, 96),
(6, 95, 96),
(7, 95, 96),
(8, 95, 96),
(9, 95, 96),
(10, 95, 96),
(11, 95, 96),
(12, 95, 96),
(13, 95, 96),
(14, 95, 96),
(15, 95, 96),
(16, 95, 96),
(17, 95, 96),
(18, 95, 96),
(19, 95, 96),
(20, 95, 96),
(21, 95, 96);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `created_at`, `updated_at`) VALUES
(1, 'dashboard', 'web', 'dashboard', '2021-06-08 08:34:49', '2021-06-08 08:34:49'),
(2, 'plan.create', 'web', 'plan', '2021-06-08 08:34:49', '2021-06-08 08:34:49'),
(3, 'plan.edit', 'web', 'plan', '2021-06-08 08:34:49', '2021-06-08 08:34:49'),
(4, 'plan.show', 'web', 'plan', '2021-06-08 08:34:49', '2021-06-08 08:34:49'),
(5, 'plan.update', 'web', 'plan', '2021-06-08 08:34:50', '2021-06-08 08:34:50'),
(6, 'plan.delete', 'web', 'plan', '2021-06-08 08:34:50', '2021-06-08 08:34:50'),
(7, 'plan.list', 'web', 'plan', '2021-06-08 08:34:50', '2021-06-08 08:34:50'),
(8, 'admin.create', 'web', 'admin', '2021-06-08 08:34:50', '2021-06-08 08:34:50'),
(9, 'admin.edit', 'web', 'admin', '2021-06-08 08:34:50', '2021-06-08 08:34:50'),
(10, 'admin.update', 'web', 'admin', '2021-06-08 08:34:50', '2021-06-08 08:34:50'),
(11, 'admin.delete', 'web', 'admin', '2021-06-08 08:34:50', '2021-06-08 08:34:50'),
(12, 'admin.list', 'web', 'admin', '2021-06-08 08:34:50', '2021-06-08 08:34:50'),
(13, 'role.create', 'web', 'role', '2021-06-08 08:34:50', '2021-06-08 08:34:50'),
(14, 'role.edit', 'web', 'role', '2021-06-08 08:34:50', '2021-06-08 08:34:50'),
(15, 'role.update', 'web', 'role', '2021-06-08 08:34:50', '2021-06-08 08:34:50'),
(16, 'role.delete', 'web', 'role', '2021-06-08 08:34:50', '2021-06-08 08:34:50'),
(17, 'role.list', 'web', 'role', '2021-06-08 08:34:50', '2021-06-08 08:34:50'),
(18, 'page.create', 'web', 'Pages', '2021-06-08 08:34:50', '2021-06-08 08:34:50'),
(19, 'page.edit', 'web', 'Pages', '2021-06-08 08:34:50', '2021-06-08 08:34:50'),
(20, 'page.delete', 'web', 'Pages', '2021-06-08 08:34:50', '2021-06-08 08:34:50'),
(21, 'page.list', 'web', 'Pages', '2021-06-08 08:34:51', '2021-06-08 08:34:51'),
(22, 'payment_gateway.config', 'web', 'Payment Gateway', '2021-06-08 08:34:51', '2021-06-08 08:34:51'),
(23, 'seo', 'web', 'seo', '2021-06-08 08:34:51', '2021-06-08 08:34:51'),
(24, 'gallery.list', 'web', 'gallery', '2021-06-08 08:34:51', '2021-06-08 08:34:51'),
(25, 'gallery.create', 'web', 'gallery', '2021-06-08 08:34:51', '2021-06-08 08:34:51'),
(26, 'order.create', 'web', 'Orders', '2021-06-08 08:34:51', '2021-06-08 08:34:51'),
(27, 'order.edit', 'web', 'Orders', '2021-06-08 08:34:51', '2021-06-08 08:34:51'),
(28, 'order.delete', 'web', 'Orders', '2021-06-08 08:34:51', '2021-06-08 08:34:51'),
(29, 'order.list', 'web', 'Orders', '2021-06-08 08:34:51', '2021-06-08 08:34:51'),
(30, 'order.view', 'web', 'Orders', '2021-06-08 08:34:51', '2021-06-08 08:34:51'),
(31, 'report.view', 'web', 'Report', '2021-06-08 08:34:51', '2021-06-08 08:34:51'),
(32, 'customer.create', 'web', 'Customer', '2021-06-08 08:34:51', '2021-06-08 08:34:51'),
(33, 'customer.list', 'web', 'Customer', '2021-06-08 08:34:51', '2021-06-08 08:34:51'),
(34, 'customer.view', 'web', 'Customer', '2021-06-08 08:34:51', '2021-06-08 08:34:51'),
(35, 'customer.edit', 'web', 'Customer', '2021-06-08 08:34:51', '2021-06-08 08:34:51'),
(36, 'customer.delete', 'web', 'Customer', '2021-06-08 08:34:52', '2021-06-08 08:34:52'),
(37, 'customer.request', 'web', 'Customer', '2021-06-08 08:34:52', '2021-06-08 08:34:52'),
(38, 'customer.expired_subscription', 'web', 'Customer', '2021-06-08 08:34:52', '2021-06-08 08:34:52'),
(39, 'domain.create', 'web', 'Domain', '2021-06-08 08:34:52', '2021-06-08 08:34:52'),
(40, 'domain.edit', 'web', 'Domain', '2021-06-08 08:34:52', '2021-06-08 08:34:52'),
(41, 'domain.list', 'web', 'Domain', '2021-06-08 08:34:52', '2021-06-08 08:34:52'),
(42, 'domain.delete', 'web', 'Domain', '2021-06-08 08:34:52', '2021-06-08 08:34:52'),
(43, 'cron_job.control', 'web', 'Cron jobs', '2021-06-08 08:34:52', '2021-06-08 08:34:52'),
(44, 'menu', 'web', 'menu', '2021-06-08 08:34:52', '2021-06-08 08:34:52'),
(45, 'cron_job', 'web', 'Developer', '2021-06-08 08:34:52', '2021-06-08 08:34:52'),
(46, 'email_template.config', 'web', 'Developer', '2021-06-08 08:34:52', '2021-06-08 08:34:52'),
(47, 'template.upload', 'web', 'Developer', '2021-06-08 08:34:52', '2021-06-08 08:34:52'),
(48, 'template.delete', 'web', 'Developer', '2021-06-08 08:34:52', '2021-06-08 08:34:52'),
(49, 'template.list', 'web', 'Developer', '2021-06-08 08:34:52', '2021-06-08 08:34:52'),
(50, 'environment.settings', 'web', 'Developer', '2021-06-08 08:34:52', '2021-06-08 08:34:52'),
(51, 'payment_gateway.setup', 'web', 'Developer', '2021-06-08 08:34:52', '2021-06-08 08:34:52'),
(52, 'site.settings', 'web', 'Settings', '2021-06-08 08:34:52', '2021-06-08 08:34:52'),
(53, 'marketing.tools', 'web', 'Settings', '2021-06-08 08:34:52', '2021-06-08 08:34:52'),
(54, 'uploaded_files.control', 'web', 'Seller Activity', '2021-06-08 08:34:52', '2021-06-08 08:34:52'),
(55, 'uploaded_files_directory.control', 'web', 'Seller Activity', '2021-06-08 08:34:52', '2021-06-08 08:34:52'),
(56, 'product.control', 'web', 'Seller Activity', '2021-06-08 08:34:52', '2021-06-08 08:34:52'),
(57, 'invoices.control', 'web', 'Seller Activity', '2021-06-08 08:34:52', '2021-06-08 08:34:52'),
(58, 'language_edit', 'web', 'language', '2021-06-08 08:34:52', '2021-06-08 08:34:52');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `days` int(11) NOT NULL,
  `product_limit` int(11) NOT NULL,
  `storage` double NOT NULL,
  `customer_limit` int(11) NOT NULL DEFAULT 0,
  `category_limit` int(11) NOT NULL DEFAULT 0,
  `location_limit` int(11) NOT NULL DEFAULT 0,
  `brand_limit` int(11) NOT NULL DEFAULT 0,
  `variation_limit` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `custom_domain` int(11) NOT NULL DEFAULT 0,
  `featured` int(11) NOT NULL DEFAULT 0,
  `is_default` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `name`, `description`, `price`, `days`, `product_limit`, `storage`, `customer_limit`, `category_limit`, `location_limit`, `brand_limit`, `variation_limit`, `status`, `custom_domain`, `featured`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'Default', 'Default Plan for Ratapay Users', 0, 365, 50, 98, 0, 0, 1, 0, 0, 1, 0, 1, 1, '2020-12-12 07:51:30', '2021-07-02 03:03:57'),
(2, 'Starter Business', 'test', 19, 30, 100, 10000, 0, 0, 0, 0, 0, 0, 1, 0, 0, '2020-12-18 10:58:10', '2021-07-01 18:18:19'),
(3, 'Enterprise', 'for enterprise users', 1999, 365, 99999, 99999, 0, 0, 0, 0, 0, 0, 1, 0, 0, '2021-01-16 00:26:37', '2021-07-01 18:18:30');

-- --------------------------------------------------------

--
-- Table structure for table `postcategories`
--

CREATE TABLE `postcategories` (
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `postmedia`
--

CREATE TABLE `postmedia` (
  `media_id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `postmedia`
--

INSERT INTO `postmedia` (`media_id`, `term_id`) VALUES
(1, 35);

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED NOT NULL,
  `price` double NOT NULL,
  `regular_price` double NOT NULL,
  `special_price` double DEFAULT NULL,
  `price_type` int(11) NOT NULL DEFAULT 1,
  `starting_date` date DEFAULT NULL,
  `ending_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`id`, `term_id`, `price`, `regular_price`, `special_price`, `price_type`, `starting_date`, `ending_date`) VALUES
(1, 35, 150000, 150000, NULL, 1, NULL, NULL),
(2, 36, 1000000, 1000000, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) NOT NULL DEFAULT 1,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'web', '2021-06-08 08:34:49', '2021-06-08 08:34:49');

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
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
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
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1);

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED NOT NULL,
  `stock_manage` int(11) NOT NULL DEFAULT 1,
  `stock_status` int(11) NOT NULL DEFAULT 1,
  `stock_qty` int(11) NOT NULL DEFAULT 1,
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `term_id`, `stock_manage`, `stock_status`, `stock_qty`, `sku`) VALUES
(1, 35, 0, 1, 999, '#ABC-123'),
(2, 36, 0, 1, 999, '#abc-123');

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `src_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asset_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id`, `name`, `src_path`, `asset_path`, `created_at`, `updated_at`) VALUES
(1, 'Bigbag', 'frontend/bigbag', 'frontend/bigbag', '2021-06-08 08:34:49', '2021-06-08 08:34:49'),
(2, 'Arafa Cart', 'frontend/arafa-cart', 'frontend/arafa-cart', '2021-06-08 08:34:49', '2021-06-08 08:34:49'),
(3, 'Saka Cart', 'frontend/saka-cart', 'frontend/saka-cart', '2021-06-08 08:34:49', '2021-06-08 08:34:49'),
(4, 'Bazar', 'frontend/bazar', 'frontend/bazar', '2021-06-08 08:34:49', '2021-06-08 08:34:49');

-- --------------------------------------------------------

--
-- Table structure for table `termoptions`
--

CREATE TABLE `termoptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) NOT NULL DEFAULT 0,
  `amount` double DEFAULT NULL,
  `amount_type` int(11) NOT NULL DEFAULT 1,
  `is_required` int(11) NOT NULL DEFAULT 0,
  `select_type` int(11) NOT NULL DEFAULT 0,
  `p_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE `terms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL,
  `featured` int(11) NOT NULL DEFAULT 0,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'product',
  `is_admin` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`id`, `title`, `slug`, `user_id`, `status`, `featured`, `type`, `is_admin`, `created_at`, `updated_at`) VALUES
(34, 'terms and condition', 'terms-and-condition', 1, 1, 0, 'page', 1, '2021-01-11 03:52:34', '2021-01-11 03:52:34'),
(35, 'Produk 1', 'produk-1', 4, 1, 1, 'product', 0, '2021-07-02 02:22:30', '2021-07-02 02:22:47'),
(36, 'TEs PRD', 'tes-prd', 5, 1, 1, 'product', 0, '2021-07-04 02:30:53', '2021-07-04 02:31:12');

-- --------------------------------------------------------

--
-- Table structure for table `trasections`
--

CREATE TABLE `trasections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 3,
  `trasection_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trasections`
--

INSERT INTO `trasections` (`id`, `category_id`, `user_id`, `status`, `trasection_id`, `created_at`, `updated_at`) VALUES
(2, 2, 4, 1, 'JdqLNIZW16', '2021-07-02 02:07:58', '2021-07-02 02:07:58'),
(3, 2, 5, 1, 'd1mwz1cakU', '2021-07-04 02:27:48', '2021-07-04 02:27:48'),
(4, 2, 6, 1, 'RvuRHfLJDf', '2021-07-04 02:57:45', '2021-07-04 02:57:45');

-- --------------------------------------------------------

--
-- Table structure for table `usermetas`
--

CREATE TABLE `usermetas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'preview',
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `useroptions`
--

CREATE TABLE `useroptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `useroptions`
--

INSERT INTO `useroptions` (`id`, `key`, `value`, `status`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'shop_name', 'Fizz Shop', 1, '2021-07-02 02:21:47', '2021-07-02 02:21:47', 4),
(2, 'shop_description', 'oke', 1, '2021-07-02 02:21:47', '2021-07-02 02:21:47', 4),
(3, 'store_email', 'reply@gmail.com', 1, '2021-07-02 02:21:47', '2021-07-02 03:06:06', 4),
(4, 'order_prefix', '#INV', 1, '2021-07-02 02:21:47', '2021-07-02 02:21:47', 4),
(5, 'local', 'en', 1, '2021-07-02 02:21:47', '2021-07-02 03:06:06', 4),
(6, 'order_receive_method', 'email', 1, '2021-07-02 02:21:47', '2021-07-02 02:21:47', 4),
(7, 'currency', '{\"currency_position\":\"left\",\"currency_name\":\"IDR\",\"currency_icon\":\"Rp\"}', 1, '2021-07-02 02:21:47', '2021-07-02 02:21:47', 4),
(8, 'languages', '{\"Indonesia\":\"id\"}', 1, '2021-07-02 02:21:47', '2021-07-02 02:21:47', 4),
(9, 'tax', '0', 1, '2021-07-02 02:21:47', '2021-07-02 02:21:47', 4),
(10, 'location', '{\"company_name\":\"Home\",\"address\":\"Perum Gentan Citra Indah Blok H-6 RT. 03 RW. 14, Gentan\",\"city\":\"Sukoharjo\",\"state\":\"Jawa Tengah\",\"zip_code\":\"57556\",\"email\":\"myfifizz02@gmail.com\",\"phone\":\"08122969492\",\"invoice_description\":null}', 1, '2021-07-02 03:06:14', '2021-07-02 03:06:14', 4),
(11, 'theme_color', 'rgb(48, 26, 186)', 1, '2021-07-02 03:06:31', '2021-07-02 03:06:31', 4),
(12, 'socials', '[]', 1, '2021-07-02 03:06:31', '2021-07-02 03:06:31', 4),
(13, 'shop_name', 'Saya 1', 1, '2021-07-04 02:30:02', '2021-07-04 02:30:02', 5),
(14, 'shop_description', 'Desc', 1, '2021-07-04 02:30:02', '2021-07-04 02:30:02', 5),
(15, 'store_email', 'reply@tes.com', 1, '2021-07-04 02:30:02', '2021-07-04 02:30:02', 5),
(16, 'order_prefix', '#ABC', 1, '2021-07-04 02:30:02', '2021-07-04 02:30:02', 5),
(17, 'local', 'id', 1, '2021-07-04 02:30:02', '2021-07-04 02:30:02', 5),
(18, 'order_receive_method', 'email', 1, '2021-07-04 02:30:02', '2021-07-04 02:30:02', 5),
(19, 'currency', '{\"currency_position\":\"left\",\"currency_name\":\"IDR\",\"currency_icon\":\"Rp\"}', 1, '2021-07-04 02:30:02', '2021-07-04 02:30:02', 5),
(20, 'languages', '{\"Indonesia\":\"id\"}', 1, '2021-07-04 02:30:02', '2021-07-04 02:30:02', 5),
(21, 'tax', '0', 1, '2021-07-04 02:30:02', '2021-07-04 02:30:02', 5);

-- --------------------------------------------------------

--
-- Table structure for table `userplanmetas`
--

CREATE TABLE `userplanmetas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_limit` int(11) NOT NULL DEFAULT 0,
  `storage` double DEFAULT NULL,
  `customer_limit` int(11) NOT NULL DEFAULT 0,
  `category_limit` int(11) NOT NULL DEFAULT 0,
  `location_limit` int(11) NOT NULL DEFAULT 0,
  `brand_limit` int(11) NOT NULL DEFAULT 0,
  `variation_limit` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `userplanmetas`
--

INSERT INTO `userplanmetas` (`id`, `user_id`, `name`, `product_limit`, `storage`, `customer_limit`, `category_limit`, `location_limit`, `brand_limit`, `variation_limit`) VALUES
(1, 2, 'free', 0, 0, 0, 0, 0, 0, 0),
(3, 4, 'Default', 50, 98, 0, 0, 1, 0, 0),
(4, 5, 'Default', 50, 98, 0, 0, 1, 0, 0),
(5, 6, 'Default', 50, 98, 0, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `userplans`
--

CREATE TABLE `userplans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `plan_id` bigint(20) UNSIGNED NOT NULL,
  `trasection_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 2,
  `payment_status` int(11) NOT NULL DEFAULT 2,
  `will_expired` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `userplans`
--

INSERT INTO `userplans` (`id`, `order_no`, `amount`, `user_id`, `plan_id`, `trasection_id`, `status`, `payment_status`, `will_expired`, `created_at`, `updated_at`) VALUES
(2, 'MRP', 0, 4, 1, 2, 1, 2, '2022-07-01', '2021-07-02 02:07:58', '2021-07-02 02:07:58'),
(3, 'MRP2', 0, 5, 1, 3, 1, 2, '2022-07-03', '2021-07-04 02:27:48', '2021-07-04 02:27:48'),
(4, 'MRP3', 0, 6, 1, 4, 1, 2, '2022-07-03', '2021-07-04 02:57:45', '2021-07-04 02:57:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `shop_type` int(11) NOT NULL DEFAULT 1,
  `domain_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `status`, `shop_type`, `domain_id`, `name`, `email`, `email_verified_at`, `password`, `created_by`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 'Admin', 'admin@ratapay.co.id', NULL, '$2y$10$QcB..xohxZdYs5KbfRFcs.KeXNlg83gn7yuogvRlsXR14fsRxWYFy', NULL, NULL, '2021-06-08 08:34:49', '2021-06-08 08:34:49'),
(2, 3, 1, 1, 1, 'me', 'me@local.com', NULL, '$2y$10$66uC1mNJvHWyK.8Zu8qqWefloP6zfJUfs75Uyxe.LT3JBwURqLO0S', NULL, NULL, '2021-07-01 17:49:48', '2021-07-01 17:56:12'),
(4, 3, 1, 1, 3, 'Izzul F', 'myfifizz02@gmail.com', NULL, '$2y$10$K/pYtlnmp77MDStVnNQ/w.Qi4wQweP4N.3fD9zv2.nW9zDWQWvcPW', NULL, NULL, '2021-07-02 02:07:58', '2021-07-02 02:07:58'),
(5, 3, 1, 1, 4, 'saya', 'saya1@mail.comdeleted', NULL, '$2y$10$pee6zt2q3JUM67A2vjEjtuo3Y2Ab8Vhr9BF2r321nUqNpSLq/xsxS', NULL, NULL, '2021-07-04 02:27:47', '2021-07-04 02:27:48'),
(6, 3, 1, 1, 5, 'saya', 'saya1@mail.com', NULL, '$2y$10$wrQ4rimeVNKE00.PkpMC/egvGIA0K827F5wwPfqQjrnfZQr9AF1Jq', NULL, NULL, '2021-07-04 02:57:45', '2021-07-04 02:57:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminmenus`
--
ALTER TABLE `adminmenus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attributes_category_id_foreign` (`category_id`),
  ADD KEY `attributes_variation_id_foreign` (`variation_id`),
  ADD KEY `attributes_term_id_foreign` (`term_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_user_id_foreign` (`user_id`);

--
-- Indexes for table `categorymedia`
--
ALTER TABLE `categorymedia`
  ADD KEY `categorymedia_category_id_foreign` (`category_id`),
  ADD KEY `categorymedia_media_id_foreign` (`media_id`);

--
-- Indexes for table `categorymetas`
--
ALTER TABLE `categorymetas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categorymetas_category_id_foreign` (`category_id`);

--
-- Indexes for table `categoryrelations`
--
ALTER TABLE `categoryrelations`
  ADD KEY `categoryrelations_category_id_foreign` (`category_id`),
  ADD KEY `categoryrelations_relation_id_foreign` (`relation_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_created_by_foreign` (`created_by`),
  ADD KEY `customers_domain_id_foreign` (`domain_id`);

--
-- Indexes for table `domains`
--
ALTER TABLE `domains`
  ADD PRIMARY KEY (`id`),
  ADD KEY `domains_user_id_foreign` (`user_id`),
  ADD KEY `domains_template_id_foreign` (`template_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `files_term_id_foreign` (`term_id`);

--
-- Indexes for table `getways`
--
ALTER TABLE `getways`
  ADD PRIMARY KEY (`id`),
  ADD KEY `getways_user_id_foreign` (`user_id`),
  ADD KEY `getways_category_id_foreign` (`category_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_user_id_foreign` (`user_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menus_user_id_foreign` (`user_id`);

--
-- Indexes for table `metas`
--
ALTER TABLE `metas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `metas_term_id_foreign` (`term_id`);

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
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderitems_order_id_foreign` (`order_id`),
  ADD KEY `orderitems_term_id_foreign` (`term_id`);

--
-- Indexes for table `ordermetas`
--
ALTER TABLE `ordermetas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ordermetas_order_id_foreign` (`order_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_customer_id_foreign` (`customer_id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_category_id_foreign` (`category_id`);

--
-- Indexes for table `ordershippings`
--
ALTER TABLE `ordershippings`
  ADD KEY `ordershippings_order_id_foreign` (`order_id`),
  ADD KEY `ordershippings_location_id_foreign` (`location_id`),
  ADD KEY `ordershippings_shipping_id_foreign` (`shipping_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `postcategories`
--
ALTER TABLE `postcategories`
  ADD KEY `postcategories_category_id_foreign` (`category_id`),
  ADD KEY `postcategories_term_id_foreign` (`term_id`);

--
-- Indexes for table `postmedia`
--
ALTER TABLE `postmedia`
  ADD KEY `postmedia_term_id_foreign` (`term_id`),
  ADD KEY `postmedia_media_id_foreign` (`media_id`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prices_term_id_foreign` (`term_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_term_id_foreign` (`term_id`);

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
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stocks_term_id_foreign` (`term_id`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `termoptions`
--
ALTER TABLE `termoptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `termoptions_user_id_foreign` (`user_id`),
  ADD KEY `termoptions_term_id_foreign` (`term_id`);

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `terms_user_id_foreign` (`user_id`);

--
-- Indexes for table `trasections`
--
ALTER TABLE `trasections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trasections_category_id_foreign` (`category_id`),
  ADD KEY `trasections_user_id_foreign` (`user_id`);

--
-- Indexes for table `usermetas`
--
ALTER TABLE `usermetas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usermetas_user_id_foreign` (`user_id`);

--
-- Indexes for table `useroptions`
--
ALTER TABLE `useroptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `useroptions_user_id_foreign` (`user_id`);

--
-- Indexes for table `userplanmetas`
--
ALTER TABLE `userplanmetas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userplanmetas_user_id_foreign` (`user_id`);

--
-- Indexes for table `userplans`
--
ALTER TABLE `userplans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userplans_user_id_foreign` (`user_id`),
  ADD KEY `userplans_plan_id_foreign` (`plan_id`),
  ADD KEY `userplans_trasection_id_foreign` (`trasection_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_created_by_foreign` (`created_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminmenus`
--
ALTER TABLE `adminmenus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `categorymetas`
--
ALTER TABLE `categorymetas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `domains`
--
ALTER TABLE `domains`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `getways`
--
ALTER TABLE `getways`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `metas`
--
ALTER TABLE `metas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `ordermetas`
--
ALTER TABLE `ordermetas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `termoptions`
--
ALTER TABLE `termoptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `trasections`
--
ALTER TABLE `trasections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `usermetas`
--
ALTER TABLE `usermetas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `useroptions`
--
ALTER TABLE `useroptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `userplanmetas`
--
ALTER TABLE `userplanmetas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `userplans`
--
ALTER TABLE `userplans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attributes`
--
ALTER TABLE `attributes`
  ADD CONSTRAINT `attributes_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attributes_term_id_foreign` FOREIGN KEY (`term_id`) REFERENCES `terms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attributes_variation_id_foreign` FOREIGN KEY (`variation_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categorymedia`
--
ALTER TABLE `categorymedia`
  ADD CONSTRAINT `categorymedia_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `categorymedia_media_id_foreign` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categorymetas`
--
ALTER TABLE `categorymetas`
  ADD CONSTRAINT `categorymetas_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categoryrelations`
--
ALTER TABLE `categoryrelations`
  ADD CONSTRAINT `categoryrelations_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `categoryrelations_relation_id_foreign` FOREIGN KEY (`relation_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customers_domain_id_foreign` FOREIGN KEY (`domain_id`) REFERENCES `domains` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `domains`
--
ALTER TABLE `domains`
  ADD CONSTRAINT `domains_template_id_foreign` FOREIGN KEY (`template_id`) REFERENCES `templates` (`id`),
  ADD CONSTRAINT `domains_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_term_id_foreign` FOREIGN KEY (`term_id`) REFERENCES `terms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `getways`
--
ALTER TABLE `getways`
  ADD CONSTRAINT `getways_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `getways_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `metas`
--
ALTER TABLE `metas`
  ADD CONSTRAINT `metas_term_id_foreign` FOREIGN KEY (`term_id`) REFERENCES `terms` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD CONSTRAINT `orderitems_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orderitems_term_id_foreign` FOREIGN KEY (`term_id`) REFERENCES `terms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ordermetas`
--
ALTER TABLE `ordermetas`
  ADD CONSTRAINT `ordermetas_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ordershippings`
--
ALTER TABLE `ordershippings`
  ADD CONSTRAINT `ordershippings_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ordershippings_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ordershippings_shipping_id_foreign` FOREIGN KEY (`shipping_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `postcategories`
--
ALTER TABLE `postcategories`
  ADD CONSTRAINT `postcategories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `postcategories_term_id_foreign` FOREIGN KEY (`term_id`) REFERENCES `terms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `postmedia`
--
ALTER TABLE `postmedia`
  ADD CONSTRAINT `postmedia_media_id_foreign` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `postmedia_term_id_foreign` FOREIGN KEY (`term_id`) REFERENCES `terms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `prices`
--
ALTER TABLE `prices`
  ADD CONSTRAINT `prices_term_id_foreign` FOREIGN KEY (`term_id`) REFERENCES `terms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_term_id_foreign` FOREIGN KEY (`term_id`) REFERENCES `terms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_term_id_foreign` FOREIGN KEY (`term_id`) REFERENCES `terms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `termoptions`
--
ALTER TABLE `termoptions`
  ADD CONSTRAINT `termoptions_term_id_foreign` FOREIGN KEY (`term_id`) REFERENCES `terms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `termoptions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `terms`
--
ALTER TABLE `terms`
  ADD CONSTRAINT `terms_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `trasections`
--
ALTER TABLE `trasections`
  ADD CONSTRAINT `trasections_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `trasections_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `usermetas`
--
ALTER TABLE `usermetas`
  ADD CONSTRAINT `usermetas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `useroptions`
--
ALTER TABLE `useroptions`
  ADD CONSTRAINT `useroptions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `userplanmetas`
--
ALTER TABLE `userplanmetas`
  ADD CONSTRAINT `userplanmetas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `userplans`
--
ALTER TABLE `userplans`
  ADD CONSTRAINT `userplans_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `userplans_trasection_id_foreign` FOREIGN KEY (`trasection_id`) REFERENCES `trasections` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `userplans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
