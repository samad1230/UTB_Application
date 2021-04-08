-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2021 at 02:58 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `utb_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `autocat_products`
--

CREATE TABLE `autocat_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `autocad_file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_name` varchar(255) CHARACTER SET utf16 NOT NULL,
  `account_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `blanch` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(255) CHARACTER SET utf16 NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `account_name`, `account_no`, `blanch`, `bank_name`, `created_at`, `updated_at`) VALUES
(1, 'Doutsh Bangla', '112.129.23443', '9000', 'SHAHJALAL ISLAMI BANKs', '2021-03-18 12:59:25', '2021-03-23 07:18:14'),
(2, 'Samad', '117.112.15214', '3000', 'Bracbank', '2021-03-19 06:21:20', '2021-03-23 07:15:40');

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bank_id` int(11) NOT NULL,
  `deposit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `withdraw` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `blanch` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_accounts`
--

INSERT INTO `bank_accounts` (`id`, `bank_id`, `deposit`, `withdraw`, `blanch`, `status`, `user_id`, `date`, `created_at`, `updated_at`) VALUES
(1, 1, '10000', '0', '10000', 1, 1, '18-03-2021', '2021-03-18 12:59:25', '2021-03-18 12:59:25'),
(2, 1, '10000', '0', '20000', 1, 1, '18-03-2021', '2021-03-18 13:45:15', '2021-03-18 13:45:15'),
(3, 2, '10000', '0', '10000', 1, 1, '19-03-2021', '2021-03-19 06:21:20', '2021-03-19 06:21:20'),
(4, 2, '0', '5000', '5000', 1, 1, '19-03-2021', '2021-03-19 08:32:18', '2021-03-19 08:32:18'),
(5, 1, '0', '1000', '19000', 1, 1, '19-03-2021', '2021-03-19 08:32:58', '2021-03-19 08:32:58'),
(6, 2, '0', '1000', '4000', 1, 1, '19-03-2021', '2021-03-19 08:56:44', '2021-03-19 08:56:44'),
(7, 2, '0', '1000', '3000', 0, 1, '2021-03-23', '2021-03-23 07:15:40', '2021-03-23 07:15:40'),
(8, 1, '0', '10000', '9000', 0, 1, '2021-03-23', '2021-03-23 07:18:14', '2021-03-23 07:18:14');

-- --------------------------------------------------------

--
-- Table structure for table `bank_transactions`
--

CREATE TABLE `bank_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bank_account_id` int(11) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purpose` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_transactions`
--

INSERT INTO `bank_transactions` (`id`, `bank_account_id`, `bank_id`, `amount`, `purpose`, `details`, `date`, `created_at`, `updated_at`) VALUES
(1, 6, 2, '1000', 'Cash In Hand', 'Account Recipt', '19-03-2021', '2021-03-19 08:56:44', '2021-03-19 08:56:44'),
(2, 7, 2, '1000', 'Supplier Payment', 'Payment for bank', '2021-03-23', '2021-03-23 07:15:40', '2021-03-23 07:15:40'),
(3, 8, 1, '10000', 'Supplier Payment', NULL, '2021-03-23', '2021-03-23 07:18:14', '2021-03-23 07:18:14');

-- --------------------------------------------------------

--
-- Table structure for table `brandables`
--

CREATE TABLE `brandables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` int(11) NOT NULL,
  `brandable_id` int(11) NOT NULL,
  `brandable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brandables`
--

INSERT INTO `brandables` (`id`, `brand_id`, `brandable_id`, `brandable_type`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'App\\Admin_model\\Categorie', NULL, NULL),
(2, 1, 1, 'App\\Admin_model\\Subcategorie', NULL, NULL),
(3, 1, 1, 'App\\Admin_model\\Procategorie', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `brand_image`, `brand_url`, `slag`, `status`, `created_at`, `updated_at`) VALUES
(1, 'JFC', '', NULL, '1615974827,JFC,hwZzC', '1', '2021-03-17 03:53:47', '2021-03-17 03:53:47');

-- --------------------------------------------------------

--
-- Table structure for table `brand_product`
--

CREATE TABLE `brand_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brand_product`
--

INSERT INTO `brand_product` (`id`, `product_id`, `brand_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cash_blanches`
--

CREATE TABLE `cash_blanches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cash_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cash_details` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receipt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `decrypt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `blanch` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cash_blanches`
--

INSERT INTO `cash_blanches` (`id`, `date`, `cash_title`, `cash_details`, `receipt`, `decrypt`, `blanch`, `user_id`, `created_at`, `updated_at`) VALUES
(2, '19-03-2021', 'Bank Windrow', 'Test', '5000', '0', '5000', '1', '2021-03-19 08:32:18', '2021-03-19 08:32:18'),
(3, '19-03-2021', 'Investment', 'Test', '10000', '0', '15000', '1', '2021-03-19 08:32:46', '2021-03-19 08:32:46'),
(4, '19-03-2021', 'Bank Windrow', 'fsd', '1000', '0', '16000', '1', '2021-03-19 08:32:58', '2021-03-19 08:32:58'),
(5, '19-03-2021', 'Bank Windrow', 'rewr', '1000', '0', '17000', '1', '2021-03-19 08:56:44', '2021-03-19 08:56:44'),
(6, '2021-03-23', 'Supplier Payment', 'payment', '0', '2800', '14200', '1', '2021-03-23 07:09:33', '2021-03-23 07:09:33'),
(7, '2021-03-23', 'Supplier Payment', 'payment', '0', '2800', '14200', '1', '2021-03-23 07:11:49', '2021-03-23 07:11:49');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categorie_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `categorie_image`, `slag`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Fan', '', '1615974781,Fan,ja8dg', '1', '2021-03-17 03:53:01', '2021-03-17 03:53:01');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Purchase', '2021-03-17 02:48:42', '2021-03-17 02:48:42'),
(2, 'Hr Admin', '2021-03-17 02:48:42', '2021-03-17 02:48:42'),
(3, 'Accounts', '2021-03-17 02:48:42', '2021-03-17 02:48:42'),
(5, 'Store', '2021-03-17 02:48:42', '2021-03-17 02:48:42'),
(6, 'Sales', '2021-03-17 02:48:42', '2021-03-17 02:48:42');

-- --------------------------------------------------------

--
-- Table structure for table `department_user`
--

CREATE TABLE `department_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `docfile_products`
--

CREATE TABLE `docfile_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `doc_file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `feature_groups`
--

CREATE TABLE `feature_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `group_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feature_groups`
--

INSERT INTO `feature_groups` (`id`, `product_id`, `group_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Dimensions and weights', '2021-03-17 03:54:37', '2021-03-17 03:54:37'),
(2, 2, 'Dimensions and weights', '2021-03-17 07:12:08', '2021-03-17 07:12:08');

-- --------------------------------------------------------

--
-- Table structure for table `feature_products`
--

CREATE TABLE `feature_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `feature_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `material` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `feature_group_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feature_products`
--

INSERT INTO `feature_products` (`id`, `feature_name`, `material`, `feature_group_id`, `created_at`, `updated_at`) VALUES
(1, 'Height', '28mm', 1, '2021-03-17 03:54:37', '2021-03-17 03:54:37'),
(2, 'Height', '28mm', 2, '2021-03-17 07:12:08', '2021-03-17 07:12:08');

-- --------------------------------------------------------

--
-- Table structure for table `lcpurchases`
--

CREATE TABLE `lcpurchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `recognition_item_id` int(11) NOT NULL,
  `lc_no` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Offer_no` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expense` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `disburse_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lcpurchases`
--

INSERT INTO `lcpurchases` (`id`, `recognition_item_id`, `lc_no`, `Offer_no`, `supplier_id`, `amount`, `expense`, `discount`, `date`, `disburse_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, '4234535', 1, '10000', '200', '100', '17-03-2021', '2021-03-22', 1, '2021-03-17 07:13:07', '2021-03-17 07:32:03');

-- --------------------------------------------------------

--
-- Table structure for table `localpurchases`
--

CREATE TABLE `localpurchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `recognition_item_id` int(11) NOT NULL,
  `invoice_no` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expense` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `due` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `disburse_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `localpurchases`
--

INSERT INTO `localpurchases` (`id`, `recognition_item_id`, `invoice_no`, `supplier_id`, `amount`, `expense`, `discount`, `due`, `date`, `disburse_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, '1425', 1, '18000', '100', '300', NULL, '17-03-2021', '2021-03-30', 1, '2021-03-17 07:13:27', '2021-03-17 07:32:11'),
(2, 3, '32423345', 1, '125000', '100', '200', NULL, '19-03-2021', '2021-03-29', 1, '2021-03-18 23:52:24', '2021-03-19 00:02:54');

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
(4, '2020_12_06_122358_create_roles_table', 1),
(5, '2020_12_06_124105_create_user__profiles_table', 1),
(6, '2020_12_10_125947_create_departments_table', 1),
(7, '2020_12_13_071603_create_products_table', 1),
(8, '2020_12_13_094313_create_brands_table', 1),
(9, '2020_12_13_102727_create_categories_table', 1),
(10, '2020_12_13_103111_create_subcategories_table', 1),
(11, '2020_12_13_103246_create_procategories_table', 1),
(12, '2020_12_13_103547_create_prductimages_table', 1),
(13, '2020_12_13_113837_create_feature_products_table', 1),
(14, '2020_12_13_113908_create_product_videos_table', 1),
(15, '2020_12_13_113934_create_autocat_products_table', 1),
(16, '2020_12_13_113954_create_pdf_products_table', 1),
(17, '2020_12_13_114017_create_docfile_products_table', 1),
(19, '2020_12_13_114106_create_product_sells_table', 1),
(20, '2020_12_13_115339_create_brandables_table', 1),
(21, '2020_12_13_115955_create_department_user_table', 1),
(22, '2020_12_21_171516_create_productables_table', 1),
(23, '2020_12_24_071253_create_feature_groups_table', 1),
(24, '2020_12_24_072616_create_brand_product_table', 1),
(25, '2021_02_27_081245_create_suppliers_table', 1),
(26, '2021_02_27_081746_create_supplieraccounts_table', 1),
(27, '2021_02_27_081812_create_supplierpayments_table', 1),
(29, '2021_03_03_111342_create_recognitions_table', 1),
(30, '2021_03_03_111622_create_purchase__types_table', 1),
(31, '2021_03_03_111905_create_localpurchases_table', 1),
(32, '2021_03_03_111925_create_lcpurchases_table', 1),
(33, '2021_03_03_112231_create_recognition_items_table', 1),
(34, '2021_03_17_115755_create_warehouses_table', 2),
(35, '2021_03_18_184446_create_banks_table', 3),
(36, '2021_03_18_184506_create_bank_accounts_table', 3),
(37, '2021_03_19_065147_create_cash_blanches_table', 4),
(38, '2021_03_19_144126_create_bank_transactions_table', 5),
(39, '2021_03_23_125445_create_payment_documets_table', 6),
(40, '2020_12_13_114040_create_product_stocks_table', 7);

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
-- Table structure for table `payment_documets`
--

CREATE TABLE `payment_documets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `check_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_documets`
--

INSERT INTO `payment_documets` (`id`, `payment_id`, `supplier_id`, `check_no`, `check_date`, `details`, `document`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'payment', NULL, 'Payment for cash', '1616505109m4j0zh.DAC_ZS.jpg', '2021-03-23 07:11:49', '2021-03-23 07:11:49'),
(2, 2, 1, '253625', '2021-03-25', 'Payment for bank', '1616505340eqoin5.DAC_ZS.jpg', '2021-03-23 07:15:40', '2021-03-23 07:15:40'),
(3, 3, 1, '25362565476', '2021-03-25', NULL, '1616505494j9c4te.DAC_ZS.jpg', '2021-03-23 07:18:15', '2021-03-23 07:18:15');

-- --------------------------------------------------------

--
-- Table structure for table `pdf_products`
--

CREATE TABLE `pdf_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pdf_file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prductimages`
--

CREATE TABLE `prductimages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prductimages`
--

INSERT INTO `prductimages` (`id`, `product_id`, `product_image`, `created_at`, `updated_at`) VALUES
(1, 1, '1615974877bev765.DAC_ZS.png', NULL, NULL),
(2, 2, '1615986728vbxml6.DAC_ZS.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `procategories`
--

CREATE TABLE `procategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subcategorie_id` int(11) NOT NULL,
  `procat_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `procategories`
--

INSERT INTO `procategories` (`id`, `name`, `subcategorie_id`, `procat_image`, `slag`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Red Color', 1, '', '1615974810,Red_Color,KVcIS', '1', '2021-03-17 03:53:30', '2021-03-17 03:53:30');

-- --------------------------------------------------------

--
-- Table structure for table `productables`
--

CREATE TABLE `productables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `productable_id` int(11) NOT NULL,
  `productable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `productables`
--

INSERT INTO `productables` (`id`, `product_id`, `productable_id`, `productable_type`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'App\\Admin_model\\Categorie', NULL, NULL),
(2, 1, 1, 'App\\Admin_model\\Subcategorie', NULL, NULL),
(3, 1, 1, 'App\\Admin_model\\Procategorie', NULL, NULL),
(4, 2, 1, 'App\\Admin_model\\Categorie', NULL, NULL),
(5, 2, 1, 'App\\Admin_model\\Subcategorie', NULL, NULL),
(6, 2, 1, 'App\\Admin_model\\Procategorie', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_details` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_id` int(11) NOT NULL,
  `skvalue` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `warranty` int(11) DEFAULT 0,
  `Country_Of_Origin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `Made_in_Assemble` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `stoke_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `popular_product` int(11) NOT NULL DEFAULT 0,
  `feature_product` int(11) NOT NULL DEFAULT 0,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `slag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `product_details`, `brand_id`, `skvalue`, `warranty`, `Country_Of_Origin`, `Made_in_Assemble`, `stoke_status`, `popular_product`, `feature_product`, `status`, `slag`, `create_by`, `created_at`, `updated_at`) VALUES
(1, 'KFC Fan-25252', 'tesrree', 1, 'Solar Superior Model', 12, 'Bangladesh', 'China', 'good', 1, 1, '1', '1615974877,KFC_Fan-25252,Ky8Tq', 1, '2021-03-17 03:54:37', '2021-03-17 03:54:37'),
(2, 'Generator', 'test', 1, 'Solar Superior Model', 60, 'Bangladesh', 'China', 'good', 1, 0, '1', '1615986728,Generator,YzyqE', 1, '2021-03-17 07:12:08', '2021-03-24 01:49:20');

-- --------------------------------------------------------

--
-- Table structure for table `product_sells`
--

CREATE TABLE `product_sells` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_stocks`
--

CREATE TABLE `product_stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `buy_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buy_qty` int(11) NOT NULL,
  `buy_sub_total` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rest_qty` int(11) NOT NULL DEFAULT 0,
  `rest_qty_buy_total` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `sell_price` int(11) NOT NULL DEFAULT 0,
  `sell_discount_price` int(11) DEFAULT 0,
  `supplier_id` int(11) NOT NULL,
  `stoke_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `with_free` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_stocks`
--

INSERT INTO `product_stocks` (`id`, `warehouse_id`, `product_id`, `buy_price`, `buy_qty`, `buy_sub_total`, `rest_qty`, `rest_qty_buy_total`, `sell_price`, `sell_discount_price`, `supplier_id`, `stoke_date`, `with_free`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '1010', 10, '10100', 10, '10100', 1000, 0, 1, '2021-03-26', '0', 1, 1, '2021-03-23 23:41:46', '2021-03-24 01:01:16');

-- --------------------------------------------------------

--
-- Table structure for table `product_videos`
--

CREATE TABLE `product_videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `video_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase__types`
--

CREATE TABLE `purchase__types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase__types`
--

INSERT INTO `purchase__types` (`id`, `purchase_type`, `created_at`, `updated_at`) VALUES
(1, 'Local Purchase', '2021-03-17 02:48:42', '2021-03-17 02:48:42'),
(2, 'LC Purchase', '2021-03-17 02:48:42', '2021-03-17 02:48:42');

-- --------------------------------------------------------

--
-- Table structure for table `recognitions`
--

CREATE TABLE `recognitions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `recognition_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recognition_auth` int(11) NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recognitions`
--

INSERT INTO `recognitions` (`id`, `recognition_no`, `recognition_auth`, `date`, `approved_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'R30179', 1, '17-03-2021', 1, 3, '2021-03-17 07:12:30', '2021-03-17 07:15:16'),
(2, 'R63258', 1, '19-03-2021', 1, 3, '2021-03-18 23:45:25', '2021-03-19 00:02:54'),
(3, 'R82761', 1, '24-03-2021', NULL, 0, '2021-03-24 07:05:54', '2021-03-24 07:05:54');

-- --------------------------------------------------------

--
-- Table structure for table `recognition_items`
--

CREATE TABLE `recognition_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `recognition_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recognition_items`
--

INSERT INTO `recognition_items` (`id`, `recognition_id`, `product_id`, `quantity`, `price`, `product_status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '10', '1000', 3, '2021-03-17 07:12:30', '2021-03-17 07:32:03'),
(2, 1, 2, '15', '1200', 3, '2021-03-17 07:12:30', '2021-03-17 07:32:11'),
(3, 2, 1, '50', '2500', 3, '2021-03-18 23:45:25', '2021-03-19 00:02:54'),
(4, 3, 2, '5', NULL, 0, '2021-03-24 07:05:54', '2021-03-24 07:05:54'),
(5, 3, 1, '5', NULL, 0, '2021-03-24 07:05:54', '2021-03-24 07:05:54');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Owner', '2021-03-17 02:48:42', '2021-03-17 02:48:42'),
(2, 'Admin', '2021-03-17 02:48:42', '2021-03-17 02:48:42'),
(3, 'Staffs', '2021-03-17 02:48:42', '2021-03-17 02:48:42'),
(4, 'Customer', '2021-03-17 02:48:42', '2021-03-17 02:48:42');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `subcat_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `name`, `categorie_id`, `subcat_image`, `slag`, `status`, `created_at`, `updated_at`) VALUES
(1, 'JFC', 1, '', '1615974794,JFC,YZaED', '1', '2021-03-17 03:53:14', '2021-03-17 03:53:14');

-- --------------------------------------------------------

--
-- Table structure for table `supplieraccounts`
--

CREATE TABLE `supplieraccounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `purchase_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `payment` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `date` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplieraccounts`
--

INSERT INTO `supplieraccounts` (`id`, `supplier_id`, `warehouse_id`, `purchase_amount`, `payment`, `date`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, '0', '0', '17-03-2021', '2021-03-17 03:58:42', '2021-03-17 03:58:42'),
(2, 1, 1, '10100', '0', '17-03-2021', '2021-03-17 07:32:03', '2021-03-17 07:32:03'),
(3, 1, 2, '17800', '0', '17-03-2021', '2021-03-17 07:32:11', '2021-03-17 07:32:11'),
(6, 7, NULL, '100', '0', '18-03-2021', '2021-03-18 11:33:50', '2021-03-18 11:33:50'),
(7, 1, 3, '124900', '0', '19-03-2021', '2021-03-19 00:02:54', '2021-03-19 00:02:54'),
(8, 1, NULL, '0', '2800', '2021-03-23', '2021-03-23 07:09:33', '2021-03-23 07:09:33'),
(9, 1, NULL, '0', '2800', '2021-03-23', '2021-03-23 07:11:49', '2021-03-23 07:11:49'),
(10, 1, NULL, '0', '1000', '2021-03-23', '2021-03-23 07:15:40', '2021-03-23 07:15:40'),
(11, 1, NULL, '0', '10000', '2021-03-23', '2021-03-23 07:18:14', '2021-03-23 07:18:14');

-- --------------------------------------------------------

--
-- Table structure for table `supplierpayments`
--

CREATE TABLE `supplierpayments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `offer_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pay_amount` int(11) NOT NULL,
  `payment_details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `money_receipt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplierpayments`
--

INSERT INTO `supplierpayments` (`id`, `supplier_id`, `offer_id`, `payment_date`, `pay_amount`, `payment_details`, `money_receipt`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'R30179', '2021-03-23', 2800, 'Payment for cash', NULL, 1, 1, '2021-03-23 07:11:49', '2021-03-23 07:11:49'),
(2, 1, 'R30179', '2021-03-23', 1000, 'Payment for bank', '253625', 1, 1, '2021-03-23 07:15:40', '2021-03-23 07:15:40'),
(3, 1, 'R30179', '2021-03-23', 10000, NULL, '25362565476', 1, 1, '2021-03-23 07:18:14', '2021-03-23 07:18:14');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `person_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `company_name`, `person_name`, `designation`, `address`, `mobile`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Wallton', 'Samad', 'Manager', 'Uttara', '01', '1', '2021-03-17 03:58:42', '2021-03-17 03:58:42'),
(7, 'Aci', 'sa', 'fsd', 'fsd', '423', '1', '2021-03-18 11:33:50', '2021-03-18 11:33:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 4,
  `staf_id` int(11) DEFAULT 0,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creat_by` int(11) DEFAULT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role_id`, `staf_id`, `email`, `email_verified_at`, `password`, `creat_by`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'UTB Application', 1, NULL, 'samad1230@gmail.com', NULL, '$2y$10$R7L3AYru2Nf5ZT7fDNchJOA5gTGybQk72cEaOvnBwUGG8h4mrS4Yy', 1, '1', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user__profiles`
--

CREATE TABLE `user__profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `national_id` int(11) DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `national_id_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user__profiles`
--

INSERT INTO `user__profiles` (`id`, `user_id`, `national_id`, `address`, `national_id_image`, `user_image`, `phone`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, NULL, NULL, NULL, '2021-03-17 03:24:42', '2021-03-17 03:24:42');

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `recognition_item_id` int(11) NOT NULL,
  `purchase_type` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `single_buy_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_buy` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rest_quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rest_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stoke_in_date` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `recognition_item_id`, `purchase_type`, `product_id`, `single_buy_price`, `quantity`, `total_buy`, `rest_quantity`, `rest_amount`, `supplier_id`, `purchase_date`, `stoke_in_date`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, '1010', '10', '10100', '10', '10100', '1', '2021-03-22', '2021-03-26', 1, 1, '2021-03-17 07:32:03', '2021-03-23 23:36:20'),
(2, 2, 1, 2, '1186.6666666667', '15', '17800', '15', '17800', '1', '2021-03-30', '2021-03-27', 0, 1, '2021-03-17 07:32:11', '2021-03-23 23:25:46'),
(3, 3, 1, 1, '2498', '50', '124900', '50', '124900', '1', '2021-03-29', NULL, 0, 1, '2021-03-19 00:02:54', '2021-03-19 00:02:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `autocat_products`
--
ALTER TABLE `autocat_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_transactions`
--
ALTER TABLE `bank_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brandables`
--
ALTER TABLE `brandables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand_product`
--
ALTER TABLE `brand_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cash_blanches`
--
ALTER TABLE `cash_blanches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department_user`
--
ALTER TABLE `department_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `docfile_products`
--
ALTER TABLE `docfile_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feature_groups`
--
ALTER TABLE `feature_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feature_products`
--
ALTER TABLE `feature_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lcpurchases`
--
ALTER TABLE `lcpurchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `localpurchases`
--
ALTER TABLE `localpurchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_documets`
--
ALTER TABLE `payment_documets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdf_products`
--
ALTER TABLE `pdf_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prductimages`
--
ALTER TABLE `prductimages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `procategories`
--
ALTER TABLE `procategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productables`
--
ALTER TABLE `productables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_sells`
--
ALTER TABLE `product_sells`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_stocks`
--
ALTER TABLE `product_stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_videos`
--
ALTER TABLE `product_videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase__types`
--
ALTER TABLE `purchase__types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recognitions`
--
ALTER TABLE `recognitions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recognition_items`
--
ALTER TABLE `recognition_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplieraccounts`
--
ALTER TABLE `supplieraccounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplierpayments`
--
ALTER TABLE `supplierpayments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user__profiles`
--
ALTER TABLE `user__profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `autocat_products`
--
ALTER TABLE `autocat_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bank_transactions`
--
ALTER TABLE `bank_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `brandables`
--
ALTER TABLE `brandables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brand_product`
--
ALTER TABLE `brand_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cash_blanches`
--
ALTER TABLE `cash_blanches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `department_user`
--
ALTER TABLE `department_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `docfile_products`
--
ALTER TABLE `docfile_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feature_groups`
--
ALTER TABLE `feature_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feature_products`
--
ALTER TABLE `feature_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lcpurchases`
--
ALTER TABLE `lcpurchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `localpurchases`
--
ALTER TABLE `localpurchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `payment_documets`
--
ALTER TABLE `payment_documets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pdf_products`
--
ALTER TABLE `pdf_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prductimages`
--
ALTER TABLE `prductimages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `procategories`
--
ALTER TABLE `procategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `productables`
--
ALTER TABLE `productables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_sells`
--
ALTER TABLE `product_sells`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_stocks`
--
ALTER TABLE `product_stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_videos`
--
ALTER TABLE `product_videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase__types`
--
ALTER TABLE `purchase__types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `recognitions`
--
ALTER TABLE `recognitions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `recognition_items`
--
ALTER TABLE `recognition_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `supplieraccounts`
--
ALTER TABLE `supplieraccounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `supplierpayments`
--
ALTER TABLE `supplierpayments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user__profiles`
--
ALTER TABLE `user__profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
