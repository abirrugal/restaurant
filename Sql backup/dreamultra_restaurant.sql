-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 23, 2022 at 08:57 AM
-- Server version: 10.2.44-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dreamultra_restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_ons`
--

CREATE TABLE `add_ons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `add_ons`
--

INSERT INTO `add_ons` (`id`, `name`, `price`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Red Sos', '100.00', 'Active', '2021-12-18 00:13:54', '2021-12-18 00:13:54'),
(2, 'White Sos', '200.00', 'Active', '2021-12-18 00:14:06', '2021-12-18 00:14:06');

-- --------------------------------------------------------

--
-- Table structure for table `add_ons_material_amounts`
--

CREATE TABLE `add_ons_material_amounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `material_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `add_ons_mat_setting_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `add_ons_material_settings`
--

CREATE TABLE `add_ons_material_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `serial` varchar(260) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(260) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(260) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `serial`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Pizza', 'Active', '2021-10-30 22:50:11', '2021-11-11 04:27:26'),
(2, '2', 'Bamboo Foods', 'Active', '2021-10-30 22:50:24', '2021-10-30 22:50:24'),
(3, NULL, 'Lasagna', 'Active', '2021-10-30 22:50:37', '2021-11-11 04:28:29'),
(4, NULL, 'Potato', 'Active', '2021-10-30 22:51:00', '2021-11-11 04:29:55');

-- --------------------------------------------------------

--
-- Table structure for table `chocolate_flavors`
--

CREATE TABLE `chocolate_flavors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `counters`
--

CREATE TABLE `counters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(260) COLLATE utf8mb4_unicode_ci NOT NULL,
  `head_type` varchar(260) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fund` varchar(260) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenses__types`
--

CREATE TABLE `expenses__types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expense__heads`
--

CREATE TABLE `expense__heads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `factories`
--

CREATE TABLE `factories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `factories`
--

INSERT INTO `factories` (`id`, `name`, `address`, `balance`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Sumon', 'Dhaka', '600.00', 'Active', '2021-11-04 03:20:06', '2021-11-04 03:20:06'),
(2, 'Sobuj', 'Mirpur', '400.00', 'Active', '2021-11-04 03:20:30', '2021-11-04 03:20:30');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `flavors`
--

CREATE TABLE `flavors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `flavors`
--

INSERT INTO `flavors` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Crispy Wings', 'Active', '2021-11-07 00:45:31', '2021-11-07 00:45:31'),
(2, 'Fried Chicken', 'Active', '2021-11-07 00:45:38', '2021-11-07 00:45:38');

-- --------------------------------------------------------

--
-- Table structure for table `funds`
--

CREATE TABLE `funds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `funds`
--

INSERT INTO `funds` (`id`, `name`, `details`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Bkash', 'Bkash', 'Active', '2021-11-04 03:52:06', '2021-11-04 03:52:06'),
(2, 'Nogad', 'Nogad', 'Active', '2021-11-04 03:52:17', '2021-11-04 03:52:17');

-- --------------------------------------------------------

--
-- Table structure for table `kitchens`
--

CREATE TABLE `kitchens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kitchens`
--

INSERT INTO `kitchens` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Kitchen 1', '2021-12-12 22:53:34', '2021-12-12 23:04:38'),
(2, 'Kitchen 2', '2021-12-12 23:00:45', '2021-12-12 23:05:13'),
(3, 'Kitchen 3', '2021-12-12 23:05:05', '2021-12-12 23:05:22');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(5, '2021_10_13_090438_create_categories_table', 1),
(6, '2021_10_13_092718_create_flavors_table', 1),
(7, '2021_10_13_092749_create_add_ons_table', 1),
(8, '2021_10_13_092827_create_chocolate_flavors_table', 1),
(9, '2021_10_14_040245_create_raw__materials_table', 1),
(10, '2021_10_14_040318_create_counters_table', 1),
(11, '2021_10_14_062419_create_funds_table', 1),
(12, '2021_10_14_082200_create_expenses__types_table', 1),
(13, '2021_10_14_090225_create_expense__heads_table', 1),
(14, '2021_10_16_051412_create_vats_table', 1),
(15, '2021_10_16_051650_create_other_incomes_table', 1),
(16, '2021_10_16_094500_create_expenses_table', 1),
(17, '2021_10_16_111605_create_other_income_saves_table', 1),
(18, '2021_10_18_041425_create_products_table', 1),
(19, '2021_10_19_091702_create_suppliers_table', 1),
(20, '2021_10_19_091802_create_factories_table', 1),
(21, '2021_10_21_040357_create_product_mat_settings_table', 1),
(22, '2021_10_21_041851_create_product_mat_amounts_table', 1),
(23, '2021_10_23_054636_create_add_ons_material_settings_table', 1),
(24, '2021_10_23_055213_create_add_ons_material_amounts_table', 1),
(25, '2021_10_23_114417_create_orders_table', 1),
(26, '2021_10_23_114632_create_order_products_table', 1),
(27, '2021_10_23_114759_create_order_add_ons_table', 1),
(28, '2021_10_23_114414_create_orders_table', 2),
(29, '2021_10_31_053929_create_purchases_table', 2),
(30, '2021_10_23_114413_create_orders_table', 3),
(31, '2021_10_23_114412_create_orders_table', 4),
(32, '2021_10_23_114418_create_orders_table', 5),
(33, '2021_10_23_114631_create_order_products_table', 5),
(34, '2021_10_31_053928_create_purchases_table', 6),
(35, '2021_11_04_033012_order_purchase', 6),
(36, '2021_10_31_053926_create_purchases_table', 7),
(37, '2021_10_31_053927_create_purchases_table', 8),
(38, '2021_11_04_033019_order_purchase', 8),
(39, '2021_10_31_053925_create_purchases_table', 9),
(40, '2021_10_31_053924_create_purchases_table', 10),
(41, '2021_10_31_053923_create_purchases_table', 11),
(42, '2021_11_04_033018_order_purchase', 12),
(43, '2014_10_12_000001_create_users_table', 13),
(44, '2021_12_11_104553_create_kitchens_table', 14),
(45, '2021_12_13_032454_create_waiters_table', 14),
(46, '2021_12_14_114312_create_table_nos_table', 15),
(47, '2021_12_18_055345_create_order_add_ones_table', 16);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `parcel_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fund` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `table_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_address` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_with_discount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_rate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_vat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_discount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `percent_discount` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_payment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kitchen_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `waiter_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `parcel_status`, `fund`, `token`, `table_no`, `sale_status`, `note`, `delivery_date`, `customer_name`, `customer_number`, `customer_address`, `total`, `total_with_discount`, `total_rate`, `total_vat`, `total_discount`, `percent_discount`, `total_payment`, `order_status`, `order_type`, `kitchen_id`, `waiter_id`, `created_at`, `updated_at`) VALUES
(81, 'yes', 'Bkash', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'normal', NULL, NULL, '2021-12-18 01:51:31', '2021-12-18 01:51:31'),
(82, 'yes', 'Bkash', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2392', '2392', '2199', '193', NULL, NULL, NULL, 'waiter', 'normal', '1', '2', '2021-12-18 01:51:54', '2021-12-18 04:01:16'),
(83, 'yes', 'Bkash', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1883', '1883', '1705', '178', NULL, NULL, NULL, 'review', 'normal', NULL, NULL, '2021-12-18 01:56:50', '2021-12-18 01:57:07'),
(84, 'yes', 'Bkash', NULL, '13', NULL, NULL, NULL, NULL, NULL, NULL, '2002', '2002', '1897', '105', NULL, NULL, NULL, 'review', 'normal', NULL, NULL, '2021-12-18 01:59:36', '2021-12-18 03:07:36'),
(86, 'yes', 'Bkash', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2157', '2157', '1955', '202', NULL, NULL, NULL, 'review', 'normal', NULL, NULL, '2021-12-18 03:21:16', '2021-12-18 03:21:27'),
(87, 'yes', 'Bkash', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3766', '3766', '3410', '356', NULL, NULL, NULL, 'review', 'normal', NULL, NULL, '2021-12-18 03:24:04', '2021-12-18 03:24:17'),
(88, 'yes', 'Bkash', NULL, '13', NULL, NULL, NULL, NULL, NULL, NULL, '3766', '3766', '3410', '356', NULL, NULL, NULL, 'review', 'normal', NULL, NULL, '2021-12-18 03:27:26', '2021-12-18 03:27:46'),
(89, 'yes', 'Bkash', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3766', '3766', '3410', '356', NULL, NULL, NULL, 'review', 'normal', NULL, NULL, '2021-12-18 03:33:20', '2021-12-18 03:33:42'),
(90, 'yes', 'Bkash', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5494', '5494', '5057', '437', NULL, NULL, NULL, 'review', 'normal', NULL, NULL, '2021-12-18 03:36:42', '2021-12-18 03:37:01'),
(92, 'yes', 'Bkash', NULL, '452', NULL, NULL, NULL, NULL, NULL, NULL, '5494', '5494', '5057', '437', NULL, NULL, NULL, 'waiter', 'normal', '1', '2', '2021-12-18 03:41:24', '2021-12-18 04:00:48'),
(94, 'yes', 'Nogad', NULL, '13', NULL, NULL, NULL, NULL, NULL, NULL, '1700', '1700', '1598', '102', NULL, NULL, '1700', 'completed', 'normal', NULL, NULL, '2021-12-18 04:06:31', '2021-12-18 04:06:57'),
(96, 'yes', 'Bkash', 'ddddd', NULL, NULL, 'New order', '2021-12-18 00:00:00', 'Rohim', '01760333', 'Dhaka', '6527', '6527', '5963', '564', '0', NULL, NULL, 'kitchen', 'normal', '1', NULL, '2021-12-18 04:37:29', '2021-12-21 15:37:34'),
(99, 'yes', 'Bkash', NULL, NULL, NULL, 'New ad', '2021-12-18 11:19:05', 'Abir 2', '555444', 'Dhaka Bd', '3766', '3766', '3410', '356', '0', NULL, NULL, 'adreview', 'normal', NULL, NULL, '2021-12-18 05:18:35', '2021-12-18 05:19:05'),
(100, NULL, 'Bkash', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '274', '274', '250', '24', NULL, NULL, NULL, 'review', 'normal', NULL, NULL, '2021-12-27 16:48:19', '2021-12-27 16:48:30'),
(101, 'yes', 'Bkash', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '890', '962', NULL, '72', NULL, NULL, NULL, NULL, 'normal', NULL, NULL, '2022-02-06 11:56:23', '2022-02-06 11:56:40'),
(103, NULL, 'Bkash', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4365', '4827', NULL, '462', NULL, NULL, NULL, NULL, 'normal', NULL, NULL, '2022-06-08 01:06:29', '2022-06-08 01:06:45');

-- --------------------------------------------------------

--
-- Table structure for table `order_add_ones`
--

CREATE TABLE `order_add_ones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_add_ones`
--

INSERT INTO `order_add_ones` (`id`, `name`, `price`, `order_id`, `created_at`, `updated_at`) VALUES
(1, 'Red Sos', '100.00', 84, '2021-12-18 03:07:36', '2021-12-18 03:07:36'),
(2, 'White Sos', '200.00', 84, '2021-12-18 03:07:36', '2021-12-18 03:07:36'),
(5, 'Red Sos', '100.00', 86, '2021-12-18 03:21:27', '2021-12-18 03:21:27'),
(6, 'White Sos', '200.00', 86, '2021-12-18 03:21:27', '2021-12-18 03:21:27'),
(7, 'Red Sos', '100.00', 87, '2021-12-18 03:24:17', '2021-12-18 03:24:17'),
(8, 'White Sos', '200.00', 87, '2021-12-18 03:24:17', '2021-12-18 03:24:17'),
(9, 'Red Sos', '100.00', 88, '2021-12-18 03:27:46', '2021-12-18 03:27:46'),
(10, 'White Sos', '200.00', 88, '2021-12-18 03:27:46', '2021-12-18 03:27:46'),
(11, 'Red Sos', '100.00', 89, '2021-12-18 03:33:42', '2021-12-18 03:33:42'),
(12, 'White Sos', '200.00', 89, '2021-12-18 03:33:42', '2021-12-18 03:33:42'),
(13, 'Red Sos', '100.00', 90, '2021-12-18 03:37:01', '2021-12-18 03:37:01'),
(15, 'Red Sos', '100.00', 92, '2021-12-18 03:41:52', '2021-12-18 03:41:52'),
(16, 'White Sos', '200.00', 92, '2021-12-18 03:41:52', '2021-12-18 03:41:52'),
(18, 'White Sos', '200.00', 94, '2021-12-18 04:06:57', '2021-12-18 04:06:57'),
(19, 'Red Sos', '100.00', 96, '2021-12-18 04:38:36', '2021-12-18 04:38:36'),
(20, 'White Sos', '200.00', 96, '2021-12-18 04:38:36', '2021-12-18 04:38:36'),
(21, 'Red Sos', '100.00', 99, '2021-12-18 05:19:05', '2021-12-18 05:19:05'),
(22, 'White Sos', '200.00', 99, '2021-12-18 05:19:05', '2021-12-18 05:19:05');

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payable` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_sts` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'panding',
  `discount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flavor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cflavor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`id`, `name`, `qty`, `rate`, `vat`, `payable`, `order_sts`, `discount`, `flavor`, `cflavor`, `order_id`, `created_at`, `updated_at`) VALUES
(216, 'Pizza spicy', '2', '500', '48', '548', 'panding', '0.00', 'Crispy Wings', NULL, 81, NULL, NULL),
(217, 'Pizza Special Large', '1', '1455', '154', '1609', 'review', '0.00', 'Crispy Wings', NULL, 82, NULL, NULL),
(218, 'Lasagna', '1', '549', '27', '576', 'review', NULL, 'Crispy Wings', NULL, 82, NULL, NULL),
(220, 'Hot Wings', '1', '195', '12', '207', 'review', NULL, 'Crispy Wings', NULL, 82, NULL, NULL),
(221, 'Pizza spicy', '1', '250', '24', '274', 'review', '0.00', 'Crispy Wings', NULL, 83, NULL, NULL),
(222, 'Pizza Special Large', '1', '1455', '154', '1609', 'review', NULL, 'Fried Chicken', NULL, 83, NULL, NULL),
(223, 'Pizza spicy', '1', '250', '24', '274', 'review', '0.00', 'Crispy Wings', NULL, 84, NULL, NULL),
(224, 'Lasagna', '3', '1647', '81', '1728', 'review', NULL, 'Crispy Wings', NULL, 84, NULL, NULL),
(228, 'Pizza spicy', '2', '500', '48', '548', 'review', '0.00', 'Crispy Wings', NULL, 86, NULL, NULL),
(229, 'Pizza Special Large', '1', '1455', '154', '1609', 'review', NULL, 'Crispy Wings', NULL, 86, NULL, NULL),
(230, 'Pizza spicy', '2', '500', '48', '548', 'review', '0.00', 'Crispy Wings', NULL, 87, NULL, NULL),
(231, 'Pizza Special Large', '2', '2910', '308', '3218', 'review', NULL, 'Crispy Wings', NULL, 87, NULL, NULL),
(232, 'Pizza spicy', '2', '500', '48', '548', 'review', '0.00', 'Crispy Wings', NULL, 88, NULL, NULL),
(233, 'Pizza Special Large', '2', '2910', '308', '3218', 'review', NULL, 'Crispy Wings', NULL, 88, NULL, NULL),
(234, 'Pizza spicy', '2', '500', '48', '548', 'review', '0.00', 'Crispy Wings', NULL, 89, NULL, NULL),
(235, 'Pizza Special Large', '2', '2910', '308', '3218', 'review', NULL, 'Fried Chicken', NULL, 89, NULL, NULL),
(236, 'Pizza spicy', '2', '500', '48', '548', 'review', '0.00', 'Crispy Wings', NULL, 90, NULL, NULL),
(237, 'Pizza Special Large', '2', '2910', '308', '3218', 'review', NULL, 'Fried Chicken', NULL, 90, NULL, NULL),
(238, 'Lasagna', '3', '1647', '81', '1728', 'review', NULL, 'Crispy Wings', NULL, 90, NULL, NULL),
(241, 'Pizza spicy', '2', '500', '48', '548', 'review', '0.00', 'Crispy Wings', NULL, 92, NULL, NULL),
(242, 'Pizza Special Large', '2', '2910', '308', '3218', 'review', NULL, 'Crispy Wings', NULL, 92, NULL, NULL),
(243, 'Lasagna', '3', '1647', '81', '1728', 'review', NULL, 'Fried Chicken', NULL, 92, NULL, NULL),
(248, 'Pizza spicy', '2', '500', '48', '548', 'completed', '0.00', 'Crispy Wings', NULL, 94, NULL, NULL),
(249, 'Lasagna', '2', '1098', '54', '1152', 'completed', NULL, 'Fried Chicken', NULL, 94, NULL, NULL),
(251, 'Pizza spicy', '2', '500', '48', '548', 'review', '0.00', 'Crispy Wings', NULL, 96, NULL, NULL),
(252, 'Pizza Special Large', '3', '4365', '462', '4827', 'review', NULL, 'Fried Chicken', NULL, 96, NULL, NULL),
(253, 'Lasagna', '2', '1098', '54', '1152', 'review', NULL, 'Crispy Wings', NULL, 96, NULL, NULL),
(258, 'Pizza spicy', '2', '500', '48', '548', 'adreview', '0.00', 'Crispy Wings', NULL, 99, NULL, NULL),
(259, 'Pizza Special Large', '2', '2910', '308', '3218', 'adreview', NULL, 'Fried Chicken', NULL, 99, NULL, NULL),
(260, 'Pizza spicy', '1', '250', '24', '274', 'review', '0.00', 'Crispy Wings', NULL, 100, NULL, NULL),
(261, 'Pizza spicy', '2', '500', '48', '548', 'panding', '0.00', 'Crispy Wings', NULL, 101, NULL, NULL),
(262, 'Hot Wings', '2', '390', '24', '414', 'panding', NULL, 'Fried Chicken', NULL, 101, NULL, NULL),
(264, 'Pizza Special Large', '1', '1455', '154', '1609', 'panding', '0.00', 'Crispy Wings', NULL, 103, NULL, NULL),
(265, 'Pizza Special Large', '1', '1455', '154', '1609', 'panding', NULL, 'Crispy Wings', NULL, 103, NULL, NULL),
(266, 'Pizza Special Large', '1', '1455', '154', '1609', 'panding', NULL, 'Crispy Wings', NULL, 103, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_purchases`
--

CREATE TABLE `order_purchases` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payable` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_sts` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'panding',
  `purchase_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_purchases`
--

INSERT INTO `order_purchases` (`id`, `name`, `qty`, `rate`, `payable`, `purchase_sts`, `purchase_id`, `created_at`, `updated_at`) VALUES
(111, 'Cheese', '4', '5', '20', 'completed', 22, '2021-11-06 22:32:30', '2021-11-06 22:33:37'),
(112, 'Biscute', '6', '6', '36', 'completed', 22, '2021-11-06 22:32:36', '2021-11-06 22:33:37'),
(113, 'Cheese', '4', '40', '160', 'completed', 23, '2021-11-07 00:56:03', '2021-11-07 00:59:09'),
(116, 'Cheese', '1', '80', '80', 'completed', 23, '2021-11-07 00:56:38', '2021-11-07 00:59:09'),
(117, 'Biscute', '6', '100', '600', 'completed', 23, '2021-11-07 00:56:40', '2021-11-07 00:59:09'),
(120, 'Cheese', '3', '5', '15', 'review', 25, '2021-11-07 01:08:27', '2021-11-07 01:08:32'),
(121, 'Cheese', '1', '0', '0', 'review', 26, '2021-11-11 04:18:41', '2021-11-11 04:18:48'),
(123, 'Cheese', '1', '50', '50', 'review', 27, '2021-12-21 17:14:19', '2021-12-21 17:15:08'),
(124, 'Cheese', '1', '0', '0', 'panding', 28, '2022-01-26 18:38:02', '2022-01-26 18:38:02'),
(125, 'Cheese', '1', '0', '0', 'panding', 28, '2022-01-26 18:38:03', '2022-01-26 18:38:03'),
(126, 'Cheese', '1', '0', '0', 'panding', 28, '2022-01-26 18:38:05', '2022-01-26 18:38:05');

-- --------------------------------------------------------

--
-- Table structure for table `other_incomes`
--

CREATE TABLE `other_incomes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `other_income_saves`
--

CREATE TABLE `other_income_saves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fund` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `serial` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `flavor` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT 'no',
  `cflavor` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT 'no',
  `add_ons` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT 'no',
  `sd_paid` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `vat` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `sd_drink` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `rate` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `serial`, `name`, `details`, `image`, `flavor`, `cflavor`, `add_ons`, `sd_paid`, `vat`, `sd_drink`, `rate`, `status`, `category_id`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Lasagna', 'Our own specialty baked lasagna cooked in a casserole and layered with ground meat marinara sauce and a blend of fresh mozzarella cheese with 2 pcs of garlic bread', 'image/product/1715109559264348.png', 'yes', 'yes', 'no', '25', '0', '2', '549', 'Active', 3, '2021-10-30 22:52:16', '2021-11-11 04:31:46'),
(2, NULL, 'Hot Wings', 'Delicious potato wedges in assorted sauce', 'image/product/1715109619769220.png', 'yes', 'yes', 'no', '4', '0', '8', '195', 'Active', 4, '2021-10-30 22:53:14', '2021-11-11 04:30:55'),
(3, NULL, 'Pizza Special Large', 'With generous portions of pepperoni,beef,sausage,fresh onions and green peppers,mushrooms,black olives, over a delicious base of pizza inn special sauce, topped with 100% real mozzarella chees', 'image/product/1715109657963992.png', 'yes', 'yes', 'no', '66', '0', '88', '1455', 'Active', 1, '2021-10-30 22:53:50', '2021-11-11 04:26:49'),
(4, NULL, 'Pizza spicy', 'ddd', 'image/product/1716379227733720.png', 'yes', 'yes', 'yes', '12', '0', '12', '250', 'Active', 1, '2021-11-14 13:13:06', '2021-11-14 13:13:06');

-- --------------------------------------------------------

--
-- Table structure for table `product_mat_amounts`
--

CREATE TABLE `product_mat_amounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `material_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_mat_setting_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_mat_settings`
--

CREATE TABLE `product_mat_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(10) UNSIGNED NOT NULL,
  `fund` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_rate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_discount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_with_discount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_payment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_company` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_address` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_invoice` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `fund`, `date`, `total_rate`, `total_discount`, `total_with_discount`, `total_payment`, `purchase_status`, `purchase_type`, `supplier_company`, `supplier_name`, `supplier_address`, `supplier_invoice`, `created_at`, `updated_at`) VALUES
(22, 'Bkash', '2021-11-07 04:33:37', '56', NULL, '56', '54', 'completed', NULL, 'Supplier 2', 'Abir', 'Dhaka.', '2222', '2021-11-06 22:32:30', '2021-11-06 22:33:37'),
(23, 'Nogad', '2021-11-07 06:59:09', '840', '20', '820', '840', 'completed', NULL, 'Supplier 1', 'Abir', 'Dhaka.', '2222', '2021-11-07 00:56:03', '2021-11-07 00:59:09'),
(25, NULL, '2021-11-07 07:08:32', '15', NULL, '15', NULL, 'review', NULL, NULL, NULL, NULL, NULL, '2021-11-07 01:08:27', '2021-11-07 01:08:32'),
(26, NULL, '2021-11-10 20:18:47', '0', NULL, '0', NULL, 'review', NULL, NULL, NULL, NULL, NULL, '2021-11-11 04:18:41', '2021-11-11 04:18:47'),
(27, NULL, '2021-12-21 09:15:08', '50', NULL, '50', NULL, 'review', NULL, NULL, NULL, NULL, NULL, '2021-12-21 17:13:58', '2021-12-21 17:15:08'),
(28, NULL, '2022-01-26 10:38:02', '0', NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-01-26 18:38:02', '2022-01-26 18:38:02');

-- --------------------------------------------------------

--
-- Table structure for table `raw__materials`
--

CREATE TABLE `raw__materials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `use_unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_use_unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `alert_qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `raw__materials`
--

INSERT INTO `raw__materials` (`id`, `name`, `unit`, `use_unit`, `unit_use_unit`, `rate`, `alert_qty`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Cheese', 'Box', 'Piece', '12', '30.00', '15', 'Active', '2021-10-30 23:44:44', '2021-10-30 23:44:44'),
(2, 'Biscute', 'Box', 'Piece', '12', '30.00', '15', 'Active', '2021-11-06 02:04:49', '2021-11-06 02:04:49');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `number`, `address`, `balance`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Supplier 1', '01760', 'Dhaka', '5566.00', 'Active', '2021-11-04 04:02:22', '2021-11-04 04:02:22'),
(2, 'Supplier 2', '00123', 'Mirpur 12', '6655.00', 'Active', '2021-11-04 04:02:47', '2021-11-04 04:02:47');

-- --------------------------------------------------------

--
-- Table structure for table `table_nos`
--

CREATE TABLE `table_nos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `table_nos`
--

INSERT INTO `table_nos` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, '452', '2021-12-14 05:55:13', '2021-12-14 05:55:13'),
(2, '13', '2021-12-14 05:56:20', '2021-12-14 05:56:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_as` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `branch` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `waiter_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kitchen_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role_as`, `branch`, `remember_token`, `image`, `waiter_id`, `kitchen_id`, `created_at`, `updated_at`) VALUES
(1, 'Abir Husain.', 'abir.rugal@gmail.com', NULL, '$2y$10$4sgPn9E1sz/gUPcMAbBDj.xIWXdMMFidfzFKw.JRjyoex/ho7oJf.', 'superadmin', NULL, 'lplJoaAHYHmm9wM1SIbVE3A67OooeqLEF25Bu9HmAT4ig9jI57s59tFsfFhR', 'auth/profile_img/1715761699741314.png', NULL, NULL, '2021-11-07 03:37:46', '2021-11-07 03:49:12'),
(5, 'Rohim', 'rohim@gmail.com', NULL, '$2y$10$n/6WTrUXiV99j.cgO1DcE.QPhmWe6mgEXcHl3soWxJQsssZI8sVBa', 'waiter', NULL, NULL, 'auth/profile_img/1719006914261125.png', '3', '2', '2021-12-12 23:19:03', '2021-12-14 05:28:48'),
(6, 'Sanji', 'sanji@gmail.com', NULL, '$2y$10$cLMFgtStPKKtATrMOYsO0O40G2eTQXgwl6sxLQpkou8zS3zolnQn.', 'kitchen', NULL, NULL, 'auth/profile_img/1719010398268117.png', NULL, '1', '2021-12-13 00:14:26', '2021-12-14 05:28:17'),
(7, 'demo', 'demo@gmail.com', NULL, '$2y$10$brHYH3fD9SXujEO7JMaMfejjhRB716cm5UUTLAKgMTU7r6DxZA9gu', 'superadmin', NULL, 'qgb7hQCg8KFTJOGml0vPcPLLlQ0dsN5aGPNjnPaD6MbflAdFTJ42BHBo56N5', 'auth/profile_img/1720204271010202.jpg', NULL, NULL, '2021-12-26 18:30:32', '2021-12-26 18:30:49');

-- --------------------------------------------------------

--
-- Table structure for table `vats`
--

CREATE TABLE `vats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `waiters`
--

CREATE TABLE `waiters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `waiters`
--

INSERT INTO `waiters` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Waiter 2', '2021-12-12 23:14:27', '2021-12-12 23:14:27'),
(3, 'Waiter 1', '2021-12-12 23:14:42', '2021-12-12 23:14:42'),
(4, 'Waiter 3', '2021-12-12 23:15:01', '2021-12-12 23:15:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_ons`
--
ALTER TABLE `add_ons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `add_ons_material_amounts`
--
ALTER TABLE `add_ons_material_amounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `add_ons_material_amounts_add_ons_mat_setting_id_foreign` (`add_ons_mat_setting_id`);

--
-- Indexes for table `add_ons_material_settings`
--
ALTER TABLE `add_ons_material_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chocolate_flavors`
--
ALTER TABLE `chocolate_flavors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `counters`
--
ALTER TABLE `counters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses__types`
--
ALTER TABLE `expenses__types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense__heads`
--
ALTER TABLE `expense__heads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `factories`
--
ALTER TABLE `factories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `flavors`
--
ALTER TABLE `flavors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `funds`
--
ALTER TABLE `funds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kitchens`
--
ALTER TABLE `kitchens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_add_ones`
--
ALTER TABLE `order_add_ones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_add_ones_order_id_foreign` (`order_id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_products_order_id_foreign` (`order_id`);

--
-- Indexes for table `order_purchases`
--
ALTER TABLE `order_purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_purchases_purchase_id_foreign` (`purchase_id`);

--
-- Indexes for table `other_incomes`
--
ALTER TABLE `other_incomes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `other_income_saves`
--
ALTER TABLE `other_income_saves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_mat_amounts`
--
ALTER TABLE `product_mat_amounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_mat_amounts_product_mat_setting_id_foreign` (`product_mat_setting_id`);

--
-- Indexes for table `product_mat_settings`
--
ALTER TABLE `product_mat_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `raw__materials`
--
ALTER TABLE `raw__materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_nos`
--
ALTER TABLE `table_nos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vats`
--
ALTER TABLE `vats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `waiters`
--
ALTER TABLE `waiters`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_ons`
--
ALTER TABLE `add_ons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `add_ons_material_amounts`
--
ALTER TABLE `add_ons_material_amounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `add_ons_material_settings`
--
ALTER TABLE `add_ons_material_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `chocolate_flavors`
--
ALTER TABLE `chocolate_flavors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `counters`
--
ALTER TABLE `counters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses__types`
--
ALTER TABLE `expenses__types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense__heads`
--
ALTER TABLE `expense__heads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `factories`
--
ALTER TABLE `factories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `flavors`
--
ALTER TABLE `flavors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `funds`
--
ALTER TABLE `funds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kitchens`
--
ALTER TABLE `kitchens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `order_add_ones`
--
ALTER TABLE `order_add_ones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=267;

--
-- AUTO_INCREMENT for table `order_purchases`
--
ALTER TABLE `order_purchases`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `other_incomes`
--
ALTER TABLE `other_incomes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `other_income_saves`
--
ALTER TABLE `other_income_saves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_mat_amounts`
--
ALTER TABLE `product_mat_amounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_mat_settings`
--
ALTER TABLE `product_mat_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `raw__materials`
--
ALTER TABLE `raw__materials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `table_nos`
--
ALTER TABLE `table_nos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vats`
--
ALTER TABLE `vats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `waiters`
--
ALTER TABLE `waiters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `add_ons_material_amounts`
--
ALTER TABLE `add_ons_material_amounts`
  ADD CONSTRAINT `add_ons_material_amounts_add_ons_mat_setting_id_foreign` FOREIGN KEY (`add_ons_mat_setting_id`) REFERENCES `add_ons_material_settings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_add_ones`
--
ALTER TABLE `order_add_ones`
  ADD CONSTRAINT `order_add_ones_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `order_products_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_purchases`
--
ALTER TABLE `order_purchases`
  ADD CONSTRAINT `order_purchases_purchase_id_foreign` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_mat_amounts`
--
ALTER TABLE `product_mat_amounts`
  ADD CONSTRAINT `product_mat_amounts_product_mat_setting_id_foreign` FOREIGN KEY (`product_mat_setting_id`) REFERENCES `product_mat_settings` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
