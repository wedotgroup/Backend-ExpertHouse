-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2026 at 03:04 AM
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
-- Database: `experthouse`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `note` varchar(225) DEFAULT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `first_button` varchar(255) DEFAULT NULL,
  `second_button` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `video_url`, `note`, `heading`, `first_button`, `second_button`, `created_at`, `updated_at`) VALUES
(1, 'uploads/banner/1786147632.mp4', 'Decades of experience in helping startups, SMEs, and corporations navigate audits, taxes, and UAE laws.', 'Your Trusted Financial Partner', 'Request Parposel', 'Book a Meeting', '2026-08-07 18:05:09', '2026-08-07 18:37:12');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`images`)),
  `author_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `images`, `author_name`, `created_at`, `updated_at`) VALUES
(1, '\"[\\\"uploads\\\\\\/branding\\\\\\/1786150882_6a767fe298cc7.webp\\\",\\\"uploads\\\\\\/branding\\\\\\/1786150882_6a767fe299408.webp\\\",\\\"uploads\\\\\\/branding\\\\\\/1786150882_6a767fe299f28.webp\\\",\\\"uploads\\\\\\/branding\\\\\\/1786150882_6a767fe29aaf5.webp\\\",\\\"uploads\\\\\\/branding\\\\\\/1786150882_6a767fe29b429.webp\\\",\\\"uploads\\\\\\/branding\\\\\\/1786150882_6a767fe29ba17.webp\\\",\\\"uploads\\\\\\/branding\\\\\\/1786150882_6a767fe29c189.webp\\\",\\\"uploads\\\\\\/branding\\\\\\/1786150882_6a767fe29ccf8.webp\\\",\\\"uploads\\\\\\/branding\\\\\\/1786150882_6a767fe29d28e.webp\\\",\\\"uploads\\\\\\/branding\\\\\\/1786150882_6a767fe29db1e.webp\\\",\\\"uploads\\\\\\/branding\\\\\\/1786150882_6a767fe29e050.webp\\\"]\"', NULL, '2026-08-07 19:31:22', '2026-08-07 19:31:22');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `slug`, `created_at`, `updated_at`) VALUES
(2, 'Finance', 'finance', '2026-08-07 20:45:57', '2026-08-07 20:45:57'),
(3, 'Business', 'business', '2026-08-07 20:46:17', '2026-08-07 20:46:17'),
(4, 'Travel', 'travel', '2026-08-07 20:46:28', '2026-08-07 20:46:28'),
(5, 'Visa', 'visa', '2026-08-07 20:46:33', '2026-08-07 20:46:33'),
(6, 'Audit', 'audit', '2026-08-07 20:46:43', '2026-08-07 20:46:43'),
(7, 'UAE', 'uae', '2026-08-07 20:46:54', '2026-08-07 20:46:54');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `select_services` varchar(255) DEFAULT NULL,
  `enquiry` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `firstname`, `lastname`, `phone`, `email`, `select_services`, `enquiry`, `created_at`, `updated_at`) VALUES
(1, 'Developer', 'Abhishek', '+91764867686476', 'developerabhi2026@gmail.com', 'Compliance Services', 'test', '2026-08-19 03:27:03', '2026-08-19 03:27:03'),
(2, 'Developer', 'Abhishek', '+93764867686476', 'developerabhi2926@gmail.com', 'Advisory Services', 'test', '2026-08-19 03:34:04', '2026-08-19 03:34:04');

-- --------------------------------------------------------

--
-- Table structure for table `header_footers`
--

CREATE TABLE `header_footers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `whatsapp_no` varchar(255) DEFAULT NULL,
  `email` varchar(225) DEFAULT NULL,
  `phone_no` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `whatsappIcon` varchar(255) DEFAULT NULL,
  `phoneIcon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `header_footers`
--

INSERT INTO `header_footers` (`id`, `logo`, `whatsapp_no`, `email`, `phone_no`, `location`, `whatsappIcon`, `phoneIcon`, `created_at`, `updated_at`) VALUES
(3, 'uploads/settings/1786121762_Ud7miU3Pl0.svg', '+971 58 541 2200', 'info@expert-ca.ae', '+971- 43 300 240', 'Office 403, Al Owais Building, Port Saeed, Dubai, UAE. P.O. Box: 124751', NULL, NULL, '2026-08-05 18:50:28', '2026-08-09 02:06:59');

-- --------------------------------------------------------

--
-- Table structure for table `insight_pages`
--

CREATE TABLE `insight_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `paragraph` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `note` longtext DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `cat_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `insight_pages`
--

INSERT INTO `insight_pages` (`id`, `heading`, `slug`, `paragraph`, `image`, `description`, `created_by`, `note`, `date`, `cat_id`, `created_at`, `updated_at`) VALUES
(2, 'Benefits of Outsourcing Bookkeeping Services in the UAE', 'benefits-of-outsourcing-bookkeeping-services-in-the-uae', '<p>With the UAE\'s introduction of Corporate Tax, understanding economic substance requirements for Free Zone entities has become paramount for business owners and investors operating in Dubai and across the United Arab Emirates. Meeting these substance criteria is essential to qualify for Qualifying Free Zone Person (QFZP) status and benefit from the 0% Corporate Tax rate.</p>', 'uploads/posts/1786184055_0wPni5kNKH.jpeg', '<h2><strong>What Are Free Zone Substance Requirements in the UAE?</strong></h2><p>Economic substance rules require UAE Free Zone companies to demonstrate genuine commercial presence, physical operational capabilities, and management activities within their respective Free Zones.</p><p>Under UAE Federal Corporate Tax Law (Federal Decree-Law No. 47 of 2022), Free Zone entities can benefit from a 0% tax rate on Qualifying Income only if they maintain adequate substance and satisfy the Qualifying Free Zone Person (QFZP) requirements.</p><p>&nbsp;</p><h2><strong>1. Core Income-Generating Activities (CIGA) in the Free Zone</strong></h2><p><strong>To qualify for the 0% tax regime, your company must conduct its core revenue-generating operations physically within the UAE Free Zone:</strong></p><ul><li>Performing essential strategic and operational functions that generate gross income directly inside the Free Zone.</li><li>Ensuring senior management decisions and operational direction take place within the UAE.</li><li><p>Maintaining evidence that key commercial activities are not inappropriately outsourced to external non-qualifying jurisdictions.</p><p>&nbsp;</p></li></ul>', 'Johan', 'At Expert House, we guide business owners through every step of UAE Corporate Tax, Free Zone Substance assessment, and FTA compliance to ensure complete peace of mind.', '2026-08-08', 2, '2026-08-08 04:44:15', '2026-08-19 03:03:16'),
(3, 'Key methods and tips for Business Valuation in the UAE', 'key-methods-and-tips-for-business-valuation-in-the-uae', '<p>With the UAE\'s introduction of Corporate Tax, understanding economic substance requirements for Free Zone entities has become paramount for business owners and investors operating in Dubai and across the United Arab Emirates. Meeting these substance criteria is essential to qualify for Qualifying Free Zone Person (QFZP) status and benefit from the 0% Corporate Tax rate.</p>', 'uploads/posts/1786186706_UYdGfTw2yE.jpeg', NULL, 'Johan', 'At Expert House, we guide business owners through every step of UAE Corporate Tax, Free Zone Substance assessment, and FTA compliance to ensure complete peace of mind.', '2026-08-08', 2, '2026-08-08 05:28:26', '2026-08-19 03:03:01'),
(4, 'Types of Dubai Visas: Investor, Resident & Employment Guide', 'types-of-dubai-visas-investor-resident-employment-guide', '<p>A comprehensive overview of UAE Golden Visas, partner visas, green visas, and employment residence permits available for global professionals.</p>', 'uploads/posts/1786258579_anFoPwL7Sc.jpeg', '<h2><strong>What Are Free Zone Substance Requirements in the UAE?</strong></h2><p>&nbsp;</p><p>Economic substance rules require UAE Free Zone companies to demonstrate genuine commercial presence, physical operational capabilities, and management activities within their respective Free Zones.</p><p>&nbsp;</p><p>Under UAE Federal Corporate Tax Law (Federal Decree-Law No. 47 of 2022), Free Zone entities can benefit from a 0% tax rate on Qualifying Income only if they maintain adequate substance and satisfy the Qualifying Free Zone Person (QFZP) requirements.</p><p>&nbsp;</p><h2><strong>Core Income-Generating Activities (CIGA) in the Free Zone</strong></h2><p>&nbsp;</p><p>To qualify for the 0% tax regime, your company must conduct its core revenue-generating operations physically within the UAE Free Zone:</p><ol><li>Performing essential strategic and operational functions that generate gross income directly inside the Free Zone.</li><li>Ensuring senior management decisions and operational direction take place within the UAE.</li><li>aintaining evidence that key commercial activities are not inappropriately outsourced to external non-qualifying jurisdictions.</li></ol><p>&nbsp;</p><h2><strong>Adequate Staff and Physical Premises in the Free Zone</strong></h2><p>&nbsp;</p><p><strong>Substance requires physical assets and human resource capabilities proportionate to business turnover:</strong></p><p>&nbsp;</p><p>Employing an adequate number of full-time qualified staff located physically in the UAE Free Zone.</p><p>Leasing or owning adequate physical office space or commercial facilities suitable for operational scale.</p><p>Incurring adequate annual operating expenditure directly within the UAE.</p>', 'Johan', 'At Expert House, we guide business owners through every step of UAE Corporate Tax, Free Zone Substance assessment, and FTA compliance to ensure complete peace of mind.', '2026-08-09', 3, '2026-08-09 01:26:19', '2026-08-19 03:02:20');

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
(2, '2026_08_05_095923_create_header_footers_table', 1),
(3, '2026_08_05_112512_create_categories_table', 2),
(4, '2026_08_05_120102_create_insight_pages_table', 3),
(5, '2026_08_05_163823_create_brands_table', 4),
(6, '2026_08_05_163847_create_banners_table', 4),
(7, '2026_08_06_002715_create_personal_access_tokens_table', 5),
(8, '2026_08_06_150210_create_contacts_table', 6),
(11, '2026_08_12_020734_create_service_categories_table', 7),
(12, '2026_08_12_020749_create_services_table', 8),
(13, '2026_08_17_100851_add_login_session_id_to_users_table', 9);

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
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `paragraph` text DEFAULT NULL,
  `main_img` varchar(255) DEFAULT NULL,
  `small_pag` text DEFAULT NULL,
  `first_heading` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `sec_heading` varchar(255) DEFAULT NULL,
  `sec_imag` varchar(255) DEFAULT NULL,
  `sec_paragraph` text DEFAULT NULL,
  `third_heading` varchar(255) DEFAULT NULL,
  `list` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`list`)),
  `serviceCat_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `heading`, `paragraph`, `main_img`, `small_pag`, `first_heading`, `note`, `sec_heading`, `sec_imag`, `sec_paragraph`, `third_heading`, `list`, `serviceCat_id`, `created_at`, `updated_at`) VALUES
(1, 'External Audit', '<p>An external audit is an independent third-party examination of a company’s financial statements, records, and operations. Its primary purpose is to provide an unbiased opinion about the accuracy and fairness of financial reporting, ensuring compliance with relevant regulations, financial standards, and accounting practices while increasing confidence and value.</p><p>Our auditing process is systematic and dynamic enough to suit your needs. We begin with strategic planning, which involves understanding your business environment and internal controls to conduct a focused audit. Following this, we gather and evaluate evidence, testing financial transactions and analyzing system controls to assess accounting accuracy. Throughout the process, we continuously communicate findings, culminating in a comprehensive report on financial statements, offering valuable insights on internal controls and risk management.</p>', 'uploads/services/1786691584_main_service-about.webp', 'Elevate Your Business with Expert External Audit', 'About External Audit', '<p><strong>By choosing Expert House Chartered Accountants, you are partnering with a firm that combines local expertise with global standards, ensuring your external audit is not just a formality, but a strategic tool for success in Dubai’s dynamic market.</strong></p>', '<h2><strong>Objectives of External Audit</strong></h2>', 'uploads/services/1786691584_second_service-image2.png', '<p><strong>The primary purpose of an external audit is to provide an objective opinion on whether a company’s financial statements are prepared fairly and accurately, in accordance with applicable accounting standards and regulations.</strong></p><p>&nbsp;</p><p><strong>Expert team of auditors:</strong>Team Expert CA has highly qualified auditors providing audit services in UAE. We have the best of the professionals in the industry to ensure that you get real value for your audit investment.</p><p>&nbsp;</p><p><strong>Time bound Audit:</strong>We place strong emphasis on delivering timely and smooth completion of your audit. As a client of Expert CA, you get a dedicated manager who ensures the audit is completed within agreed deadlines.</p><p>&nbsp;</p><p><strong>Compliance with industry best practices and standards:</strong>Our audit procedures align with International Financial Reporting Standards (IFRS), International Standards on Auditing (ISA), and UAE regulatory frameworks to guarantee complete compliance.</p><p>&nbsp;</p><p><strong>Affordable Professional Charges:</strong>We always make sure the audit we deliver exceeds the price we charge. Providing top-notch service at the most affordable price has always been our priority.</p>', '<h2><strong>Why Expert House Chartered Accountants</strong></h2>', '[{\"heading\":\"Expert team of auditors:\",\"summary\":\"Team Expert CA has independent, objective and highly-qualified auditors providing audit services in UAE. We have the best of the professionals in the industry to ensure your financial statements are accurate and reliable.\"},{\"heading\":\"Time-bound Audit:\",\"summary\":\"We place strong emphasis on delivering timely and smooth completion of your audit. As a client of Expert CA, we always make sure your audit is delivered on time according to the audit agreement.\"},{\"heading\":\"Compliance with industry best practices and standards:\",\"summary\":\"Our audit procedures align with the latest procedures and standards. Our auditors maintain complete compliance with International Financial Reporting Standards (IFRS), International Standards on Auditing (ISA), and relevant UAE frameworks.\"},{\"heading\":\"Affordable Professional Charges:\",\"summary\":\"We always make sure the audit we deliver exceeds the price we charge. Providing top-notch service at the most affordable price has always been our priority.\"}]', 3, '2026-08-14 01:43:04', '2026-08-14 04:07:27');

-- --------------------------------------------------------

--
-- Table structure for table `service_categories`
--

CREATE TABLE `service_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_categories`
--

INSERT INTO `service_categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(3, 'Audit & Anssurance', 'audit-anssurance', '2026-08-14 01:33:11', '2026-08-14 01:33:11'),
(4, 'Accounting & CFO', 'accounting-cfo', '2026-08-14 01:33:43', '2026-08-14 01:33:43'),
(5, 'Tax & Complains', 'tax-complains', '2026-08-14 01:34:14', '2026-08-14 01:34:14'),
(6, 'Business Support', 'business-support', '2026-08-14 01:34:44', '2026-08-14 01:34:44'),
(7, 'Business Setup', 'business-setup', '2026-08-14 01:35:06', '2026-08-14 01:35:06');

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

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `pin_code` varchar(255) DEFAULT NULL,
  `doctor_strime` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('super_admin','doctor') NOT NULL,
  `login_session_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `city`, `phone`, `state`, `country`, `pin_code`, `doctor_strime`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `login_session_id`) VALUES
(1, 'Admin', NULL, NULL, NULL, NULL, NULL, NULL, 'admin@gmail.com', '2026-08-05 05:05:24', '$2y$12$GbVLUCoyfQJzNVpwdVZYZeR2dg6P9bopeIvG7WOnr.Fe5/QVWaYUa', 'SfnEQeCukra0RrfMbHsZJdqdPygePZWKpDDqRojCTNyJfYOPK4bXMXiy81Bm', '2026-08-05 05:05:25', '2026-08-19 02:51:57', 'super_admin', 'sBw7HuutEfAMRYMMOqdltytqOFFRpkibbDQfctHU');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `header_footers`
--
ALTER TABLE `header_footers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `insight_pages`
--
ALTER TABLE `insight_pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `insight_pages_cat_id_foreign` (`cat_id`);

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
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `services_servicecat_id_foreign` (`serviceCat_id`);

--
-- Indexes for table `service_categories`
--
ALTER TABLE `service_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `header_footers`
--
ALTER TABLE `header_footers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `insight_pages`
--
ALTER TABLE `insight_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `service_categories`
--
ALTER TABLE `service_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `insight_pages`
--
ALTER TABLE `insight_pages`
  ADD CONSTRAINT `insight_pages_cat_id_foreign` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_servicecat_id_foreign` FOREIGN KEY (`serviceCat_id`) REFERENCES `service_categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
