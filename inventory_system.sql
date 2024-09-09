-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2024 at 07:51 AM
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
-- Database: `inventory_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `application_forms`
--

CREATE TABLE `application_forms` (
  `id` int(11) NOT NULL,
  `case_number` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `date_of_birth` date NOT NULL,
  `place_of_birth` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `pensioner` enum('Y','N') DEFAULT NULL,
  `barangay_id` int(11) DEFAULT NULL,
  `educational_attainment` varchar(255) NOT NULL,
  `civil_status` varchar(50) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `religion` varchar(255) NOT NULL,
  `company_agency` varchar(255) NOT NULL,
  `monthly_income` decimal(10,2) NOT NULL,
  `employment_status` varchar(50) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `pantawid_beneficiary` char(1) NOT NULL,
  `lgbtq` char(1) NOT NULL,
  `date` datetime NOT NULL,
  `classification` text DEFAULT NULL,
  `problems` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `application_forms`
--

INSERT INTO `application_forms` (`id`, `case_number`, `full_name`, `age`, `sex`, `date_of_birth`, `place_of_birth`, `address`, `pensioner`, `barangay_id`, `educational_attainment`, `civil_status`, `occupation`, `religion`, `company_agency`, `monthly_income`, `employment_status`, `contact_number`, `email_address`, `pantawid_beneficiary`, `lgbtq`, `date`, `classification`, `problems`, `created_at`) VALUES
(42, '1234', 'Esgera, Bert 01', 23, 'Male', '2001-01-20', 'quezon', 'eubert@gmail.com', 'Y', 2, 'College', 'Single', 'IT', 'Christian', 'company name', 10000.00, 'Employed', '09568884009', 'eubert@gmail.com', 'Y', 'N', '2024-09-09 03:58:02', '', '', '2024-09-09 05:41:16'),
(43, '1234', 'Esgera, Bert 01', 23, 'Male', '2001-01-01', 'quezon', 'eubert@gmail.com', 'Y', 4, 'College', 'Single', 'IT', 'Christian', 'company name', 10000.00, 'Employed', '09568884009', 'eubert@gmail.com', 'Y', 'N', '2024-09-09 05:38:40', '', '', '2024-09-09 05:41:16'),
(44, '1234', 'Esgera, Bert 01', 23, 'Male', '2001-01-01', 'quezon', 'eubert@gmail.com', 'Y', 5, 'College', 'Single', 'IT', 'Christian', 'company name', 10000.00, 'Employed', '09568884009', 'eubert@gmail.com', 'Y', 'N', '2024-09-09 05:41:14', '', '', '2024-09-09 05:41:16'),
(45, '1234', 'Esgera, Bert 01', 23, 'Male', '2001-01-01', 'quezon', 'eubert@gmail.com', 'Y', 9, 'College', 'Single', 'IT', 'Christian', 'company name', 10000.00, 'Employed', '09568884009', 'eubert@gmail.com', 'Y', 'N', '2024-09-09 05:41:45', '', '', '2024-09-09 05:41:16'),
(46, '1234', 'Esgera, Bert 01', 23, 'Male', '2001-01-01', 'quezon', 'eubert@gmail.com', 'Y', 11, 'College', 'Single', 'IT', 'Christian', 'company name', 10000.00, 'Employed', '09568884009', 'eubert@gmail.com', 'Y', 'N', '2024-09-09 05:43:17', 'asdfasf', 'asdfasf', '2024-09-09 05:41:16'),
(47, '1234', 'Esgera, Bert 01', 23, 'Male', '2001-01-01', 'quezon', 'eubert@gmail.com', 'N', 2, 'College', 'Single', 'IT', 'Christian', 'company name', 10000.00, 'Employed', '09568884009', 'eubert@gmail.com', 'Y', 'N', '2024-09-09 05:48:54', '', '', '2024-09-09 05:41:16'),
(48, '1234', 'Esgera, Bert 01', 23, 'Male', '2001-01-01', 'quezon', 'eubert@gmail.com', 'Y', 3, 'College', 'Single', 'IT', 'Christian', 'company name', 10000.00, 'Employed', '09568884009', 'eubert@gmail.com', 'Y', 'N', '2024-09-09 05:51:44', '', '', '2024-09-09 05:41:16'),
(49, '1234', 'Esgera, Bert 01', 23, 'Male', '2001-01-01', 'quezon', 'eubert@gmail.com', 'Y', 3, 'College', 'Single', 'IT', 'Christian', 'company name', 10000.00, 'Employed', '09568884009', 'eubert@gmail.com', 'Y', 'N', '2024-09-09 05:54:14', '', '', '2024-09-09 05:41:16'),
(50, '1234', 'Esgera, Bert 01', 23, 'Male', '2001-01-02', 'quezon', 'eubert@gmail.com', 'N', 2, 'College', 'Single', 'IT', 'Christian', 'company name', 10000.00, 'Employed', '09568884009', 'eubert@gmail.com', 'Y', 'N', '2024-09-09 05:54:47', '', '', '2024-09-09 05:41:16'),
(51, '1234', 'Esgera, Bert 01', 23, 'Male', '2001-02-02', 'quezon', 'eubert@gmail.com', 'Y', 76, 'College', 'Single', 'IT', 'Christian', 'company name', 10000.00, 'Employed', '09568884009', 'eubert@gmail.com', 'Y', 'N', '2024-09-09 05:57:37', '', '', '2024-09-09 05:41:16'),
(52, '1234', 'Esgera, Bert 01', 23, 'Male', '2001-01-01', 'quezon', 'eubert@gmail.com', 'Y', 9, 'College', 'Single', 'IT', 'Christian', 'company name', 10000.00, 'Employed', '09568884009', 'eubert@gmail.com', 'Y', 'N', '2024-09-09 05:59:12', '', '', '2024-09-09 05:41:16'),
(53, '1234', 'Esgera, Bert 01', 23, 'Male', '2001-01-01', 'quezon', 'eubert@gmail.com', 'Y', 9, 'College', 'Single', 'IT', 'Christian', 'company name', 10000.00, 'Employed', '09568884009', 'eubert@gmail.com', 'Y', 'N', '2024-09-09 05:59:38', '', '', '2024-09-09 05:41:16'),
(54, '1234', 'Esgera, Bert 01', 23, 'Male', '2001-01-01', 'quezon', 'eubert@gmail.com', 'Y', 2, 'College', 'Single', 'IT', 'Christian', 'company name', 10000.00, 'Employed', '09568884009', 'eubert@gmail.com', 'Y', 'N', '2024-09-09 06:03:47', '', '', '2024-09-09 05:41:16'),
(56, '1234', 'Esgera, Bert 01', 23, 'Male', '2001-01-01', 'quezon', 'eubert@gmail.com', 'Y', 3, 'College', 'Single', 'IT', 'Christian', 'company name', 10000.00, 'Employed', '09568884009', 'eubert@gmail.com', 'Y', 'N', '2024-09-09 07:42:13', '', '', '2024-09-09 05:42:13'),
(57, '1234', 'Esgera, Bert 01', 44, 'Male', '1980-01-01', 'quezon', 'Cavite', 'Y', 8, 'College', 'Single', 'IT', 'Christian', 'company name', 10000.00, 'Employed', '09568884009', 'eubert@gmail.com', 'Y', 'N', '2024-09-09 07:49:22', '', '', '2024-09-09 05:49:22');

-- --------------------------------------------------------

--
-- Table structure for table `barangays`
--

CREATE TABLE `barangays` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barangays`
--

INSERT INTO `barangays` (`id`, `name`) VALUES
(1, 'Burol'),
(2, 'Burol I'),
(3, 'Burol II'),
(4, 'Burol III'),
(5, 'Datu Esmael (Bago-a-ingud)'),
(6, 'Emmanuel Bergado I'),
(7, 'Emmanuel Bergado II'),
(8, 'Fatima I'),
(9, 'Fatima II'),
(10, 'Fatima III'),
(11, 'H-2'),
(12, 'Langkaan I'),
(13, 'Langkaan II'),
(14, 'Luzviminda I'),
(15, 'Luzviminda II'),
(16, 'Paliparan I'),
(17, 'Paliparan II'),
(18, 'Paliparan III'),
(19, 'Sabang'),
(20, 'Saint Peter I'),
(21, 'Saint Peter II'),
(22, 'Salawag'),
(23, 'Salitran I'),
(24, 'Salitran II'),
(25, 'Salitran III'),
(26, 'Salitran IV'),
(27, 'Sampaloc I'),
(28, 'Sampaloc II'),
(29, 'Sampaloc III'),
(30, 'Sampaloc IV'),
(31, 'Sampaloc V'),
(32, 'San Agustin I'),
(33, 'San Agustin II'),
(34, 'San Agustin III'),
(35, 'San Andres I'),
(36, 'San Andres II'),
(37, 'San Antonio De Padua I'),
(38, 'San Antonio De Padua II'),
(39, 'San Dionisio (Barangay 1)'),
(40, 'San Esteban (Barangay 4)'),
(41, 'San Francisco I'),
(42, 'San Francisco II'),
(43, 'San Isidro Labrador I'),
(44, 'San Isidro Labrador II'),
(45, 'San Jose'),
(46, 'San Juan (San Juan I)'),
(47, 'San Lorenzo Ruiz I'),
(48, 'San Lorenzo Ruiz II'),
(49, 'San Luis I'),
(50, 'San Luis II'),
(51, 'San Manuel I'),
(52, 'San Manuel II'),
(53, 'San Mateo'),
(54, 'San Miguel'),
(55, 'San Miguel II'),
(56, 'San Nicolas I'),
(57, 'San Nicolas II'),
(58, 'San Roque (Sta. Cristina II)'),
(59, 'San Simon (Barangay 7)'),
(60, 'Santa Cristina I'),
(61, 'Santa Cristina II'),
(62, 'Santa Cruz I'),
(63, 'Santa Cruz II'),
(64, 'Santa Fe'),
(65, 'Santa Lucia (San Juan II)'),
(66, 'Santa Maria (Barangay 20)'),
(67, 'Santo Cristo (Barangay 3)'),
(68, 'Santo Niño I'),
(69, 'Santo Niño II'),
(70, 'Victoria Reyes'),
(71, 'Zone I'),
(72, 'Zone I-B'),
(73, 'Zone II'),
(74, 'Zone III'),
(75, 'Zone IV'),
(76, 'Dasmariñas (City)');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Demo Category'),
(3, 'Finished Goods'),
(5, 'Machinery'),
(4, 'Packing Materials'),
(2, 'Raw Materials'),
(9, 'Seniors'),
(8, 'Stationery Items'),
(6, 'Work in Progress');

-- --------------------------------------------------------

--
-- Table structure for table `emergency_contacts`
--

CREATE TABLE `emergency_contacts` (
  `id` int(11) NOT NULL,
  `application_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `relation` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `contact_number` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emergency_contacts`
--

INSERT INTO `emergency_contacts` (`id`, `application_id`, `name`, `relation`, `address`, `contact_number`) VALUES
(4, 46, 'asdfasdf', 'asdfasdf', 'eubert@gmail.com', 'asdfasdf');

-- --------------------------------------------------------

--
-- Table structure for table `family_members`
--

CREATE TABLE `family_members` (
  `id` int(11) NOT NULL,
  `application_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `relation` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `birthday` date NOT NULL,
  `civil_status` varchar(50) NOT NULL,
  `education` varchar(255) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `monthly_income` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `family_members`
--

INSERT INTO `family_members` (`id`, `application_id`, `name`, `relation`, `age`, `birthday`, `civil_status`, `education`, `occupation`, `monthly_income`) VALUES
(19, 47, 'bro1', 'alskdjfl', 23, '2001-01-01', 'Single', 'adsfasd', 'IT', 1234124.00),
(20, 47, 'asdfas', 'asdfasdf', 0, '0000-00-00', '', 'adfas', '', 0.00),
(21, 48, 'sis1', 'fasdfdasf', 22, '2002-01-02', 'Single', 'asdfad', 'IT', 12341.00),
(22, 49, 'sis1', 'fasdfdasf', 22, '2002-01-02', 'Single', 'asdfad', 'IT', 12341.00),
(23, 49, 'sis2', '', 0, '0000-00-00', '', '', '', 0.00),
(24, 50, 'asdfas', 'dfasdfaf', 0, '0000-00-00', 'Married', 'asdf', 'IT', 123421.00),
(25, 51, 'asdf', 'asdf', 0, '0000-00-00', '', 'asdf', 'IT', 123431.00),
(26, 53, 'asdfad', 'asdfa', 0, '0000-00-00', 'Single', 'asdf', 'IT', 1234.00),
(27, 54, '', '', 0, '0000-00-00', '', '', '', 0.00),
(29, 56, '', '', 0, '0000-00-00', '', '', 'IT', 0.00),
(30, 57, '', '', 0, '0000-00-00', '', '', 'IT', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(11) UNSIGNED NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` varchar(50) DEFAULT NULL,
  `buy_price` decimal(25,2) DEFAULT NULL,
  `sale_price` decimal(25,2) NOT NULL,
  `categorie_id` int(11) UNSIGNED NOT NULL,
  `media_id` int(11) DEFAULT 0,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `quantity`, `buy_price`, `sale_price`, `categorie_id`, `media_id`, `date`) VALUES
(1, 'Demo Product', '48', 100.00, 500.00, 1, 0, '2021-04-04 16:45:51'),
(2, 'Box Varieties', '12000', 55.00, 130.00, 4, 0, '2021-04-04 18:44:52'),
(3, 'Wheat', '69', 2.00, 5.00, 2, 0, '2021-04-04 18:48:53'),
(4, 'Timber', '1200', 780.00, 1069.00, 2, 0, '2021-04-04 19:03:23'),
(5, 'W1848 Oscillating Floor Drill Press', '26', 299.00, 494.00, 5, 0, '2021-04-04 19:11:30'),
(6, 'Portable Band Saw XBP02Z', '42', 280.00, 415.00, 5, 0, '2021-04-04 19:13:35'),
(7, 'Life Breakfast Cereal-3 Pk', '107', 3.00, 7.00, 3, 0, '2021-04-04 19:15:38'),
(8, 'Chicken of the Sea Sardines W', '110', 13.00, 20.00, 3, 0, '2021-04-04 19:17:11'),
(9, 'Disney Woody - Action Figure', '67', 29.00, 55.00, 3, 0, '2021-04-04 19:19:20'),
(10, 'Hasbro Marvel Legends Series Toys', '106', 219.00, 322.00, 3, 0, '2021-04-04 19:20:28'),
(11, 'Packing Chips', '78', 21.00, 31.00, 4, 0, '2021-04-04 19:25:22'),
(12, 'Classic Desktop Tape Dispenser 38', '160', 5.00, 10.00, 8, 0, '2021-04-04 19:48:01'),
(13, 'Small Bubble Cushioning Wrap', '199', 8.00, 19.00, 4, 0, '2021-04-04 19:49:00'),
(14, 'sadfas', '-11234', 1234.00, 134.00, 1, 0, '2024-08-15 08:36:17');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(25,2) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `product_id`, `qty`, `price`, `date`) VALUES
(1, 1, 2, 1000.00, '2021-04-04'),
(2, 3, 3, 15.00, '2021-04-04'),
(3, 10, 6, 1932.00, '2021-04-04'),
(4, 6, 2, 830.00, '2021-04-04'),
(5, 12, 5, 50.00, '2021-04-04'),
(6, 13, 21, 399.00, '2021-04-04'),
(7, 7, 5, 35.00, '2021-04-04'),
(8, 9, 2, 110.00, '2021-04-04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_level` int(11) NOT NULL,
  `image` varchar(255) DEFAULT 'no_image.jpg',
  `status` int(1) NOT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `user_level`, `image`, `status`, `last_login`) VALUES
(1, 'Harry Denn', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 'no_image.png', 1, '2024-09-09 02:48:22'),
(2, 'John Walker', 'special', 'ba36b97a41e7faf742ab09bf88405ac04f99599a', 2, 'no_image.png', 1, '2021-04-04 19:53:26'),
(3, 'Christopher', 'user', 'd033e22ae348aeb5660fc2140aec35850c4da997', 3, 'no_image.png', 1, '2024-08-30 03:17:35'),
(4, 'Natie Williams', 'natie', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 3, 'no_image.png', 1, NULL),
(5, 'Kevin', 'kevin', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 3, 'no_image.png', 1, '2021-04-04 19:54:29'),
(6, 'user', 'user', 'd033e22ae348aeb5660fc2140aec35850c4da997', 3, 'no_image.jpg', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(150) NOT NULL,
  `group_level` int(11) NOT NULL,
  `group_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `group_name`, `group_level`, `group_status`) VALUES
(1, 'Admin', 1, 1),
(2, 'special', 2, 1),
(3, 'User', 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `application_forms`
--
ALTER TABLE `application_forms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_barangay` (`barangay_id`);

--
-- Indexes for table `barangays`
--
ALTER TABLE `barangays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `emergency_contacts`
--
ALTER TABLE `emergency_contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `application_id` (`application_id`);

--
-- Indexes for table `family_members`
--
ALTER TABLE `family_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `application_id` (`application_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `categorie_id` (`categorie_id`),
  ADD KEY `media_id` (`media_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_level` (`user_level`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_level` (`group_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `application_forms`
--
ALTER TABLE `application_forms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `barangays`
--
ALTER TABLE `barangays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `emergency_contacts`
--
ALTER TABLE `emergency_contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `family_members`
--
ALTER TABLE `family_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `application_forms`
--
ALTER TABLE `application_forms`
  ADD CONSTRAINT `fk_barangay` FOREIGN KEY (`barangay_id`) REFERENCES `barangays` (`id`);

--
-- Constraints for table `emergency_contacts`
--
ALTER TABLE `emergency_contacts`
  ADD CONSTRAINT `emergency_contacts_ibfk_1` FOREIGN KEY (`application_id`) REFERENCES `application_forms` (`id`);

--
-- Constraints for table `family_members`
--
ALTER TABLE `family_members`
  ADD CONSTRAINT `family_members_ibfk_1` FOREIGN KEY (`application_id`) REFERENCES `application_forms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_products` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `SK` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_user` FOREIGN KEY (`user_level`) REFERENCES `user_groups` (`group_level`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
