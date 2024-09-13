-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2024 at 07:52 AM
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
  `last_name` varchar(255) NOT NULL,
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `extension_name` varchar(255) DEFAULT NULL,
  `Indigenous_Person` varchar(1) NOT NULL,
  `remarks` text DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `monthly_income_specified` varchar(255) DEFAULT NULL,
  `form_id_no` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `application_forms`
--

INSERT INTO `application_forms` (`id`, `case_number`, `last_name`, `age`, `sex`, `date_of_birth`, `place_of_birth`, `address`, `pensioner`, `barangay_id`, `educational_attainment`, `civil_status`, `occupation`, `religion`, `company_agency`, `monthly_income`, `employment_status`, `contact_number`, `email_address`, `pantawid_beneficiary`, `lgbtq`, `date`, `classification`, `problems`, `created_at`, `first_name`, `middle_name`, `extension_name`, `Indigenous_Person`, `remarks`, `status`, `monthly_income_specified`, `form_id_no`) VALUES
(93, '2024-09-00018', 'Smith', 30, 'Male', '1994-05-15', 'New York', '123 Main St', 'N', 2, 'High School', 'Married', 'Engineer', 'Christian', 'TechCorp', 50000.00, 'Employed', '09123456789', 'smith@example.com', 'N', 'N', '2024-09-13 03:00:00', '', '', '2024-09-12 17:00:00', 'John', 'A', '', 'N', '', 'active', NULL, NULL),
(94, '2024-09-00019', 'Johnson', 28, 'Female', '1996-07-20', 'Los Angeles', '456 Elm St', 'Y', 3, 'Bachelor', 'Single', 'Teacher', 'Catholic', 'EduCorp', 40000.00, 'Employed', '09234567890', 'johnson@example.com', 'Y', 'N', '2024-09-13 03:05:00', '', '', '2024-09-12 17:05:00', 'Emily', 'B', '', 'N', '', 'active', NULL, NULL),
(95, '2024-09-00020', 'Williams', 35, 'Male', '1989-03-10', 'Chicago', '789 Pine St', 'N', 4, 'Master', 'Divorced', 'Doctor', 'Muslim', 'HealthCorp', 70000.00, 'Employed', '09345678901', 'williams@example.com', 'N', 'Y', '2024-09-13 03:10:00', '', '', '2024-09-12 17:10:00', 'Michael', 'C', '', 'Y', '', 'active', NULL, NULL),
(96, '2024-09-00021', 'Brown', 40, 'Female', '1984-11-25', 'Houston', '101 Maple St', 'Y', 5, 'PhD', 'Widowed', 'Scientist', 'Hindu', 'ResearchCorp', 80000.00, 'Employed', '09456789012', 'brown@example.com', 'N', 'N', '2024-09-13 03:15:00', '', '', '2024-09-12 17:15:00', 'Sarah', 'D', '', 'N', '', 'renewal', NULL, NULL),
(97, '2024-09-00022', 'Jones', 32, 'Male', '1992-08-30', 'Phoenix', '202 Oak St', 'N', 6, 'Associate', 'Single', 'Lawyer', 'Jewish', 'LawCorp', 60000.00, 'Employed', '09567890123', 'jones@example.com', 'Y', 'N', '2024-09-13 03:20:00', '', '', '2024-09-12 17:20:00', 'David', 'E', '', 'N', '', 'active', NULL, NULL),
(98, '2024-09-00023', 'Garcia', 27, 'Female', '1997-12-05', 'Philadelphia', '303 Birch St', 'Y', 7, 'Bachelor', 'Married', 'Nurse', 'Buddhist', 'HealthCorp', 45000.00, 'Employed', '09678901234', 'garcia@example.com', 'N', 'Y', '2024-09-13 03:25:00', '', '', '2024-09-12 17:25:00', 'Maria', 'F', '', 'Y', '', 'renewal', NULL, NULL),
(99, '2024-09-00024', 'Martinez', 29, 'Male', '1995-04-18', 'San Antonio', '404 Cedar St', 'N', 8, 'High School', 'Single', 'Technician', 'Christian', 'TechCorp', 35000.00, 'Employed', '09789012345', 'martinez@example.com', 'Y', 'N', '2024-09-13 03:30:00', '', '', '2024-09-12 17:30:00', 'Carlos', 'G', '', 'N', '', 'active', NULL, NULL),
(100, '2024-09-00025', 'Rodriguez', 33, 'Female', '1991-06-22', 'San Diego', '505 Spruce St', 'Y', 9, 'Master', 'Divorced', 'Engineer', 'Catholic', 'BuildCorp', 55000.00, 'Employed', '09890123456', 'rodriguez@example.com', 'N', 'N', '2024-09-13 03:35:00', '', '', '2024-09-12 17:35:00', 'Laura', 'H', '', 'N', '', 'active', NULL, NULL),
(101, '2024-09-00026', 'Wilson', 31, 'Male', '1993-09-14', 'Dallas', '606 Fir St', 'N', 10, 'PhD', 'Widowed', 'Scientist', 'Muslim', 'ResearchCorp', 75000.00, 'Employed', '09901234567', 'wilson@example.com', 'Y', 'Y', '2024-09-13 03:40:00', '', '', '2024-09-12 17:40:00', 'James', 'I', '', 'Y', '', 'renewal', NULL, NULL),
(102, '2024-09-00027', 'Lopez', 26, 'Female', '1998-02-11', 'San Jose', '707 Willow St', 'Y', 11, 'Associate', 'Single', 'Teacher', 'Hindu', 'EduCorp', 40000.00, 'Employed', '09112345678', 'lopez@example.com', 'N', 'N', '2024-09-13 03:45:00', '', '', '2024-09-12 17:45:00', 'Sophia', 'J', '', 'N', '', 'active', NULL, NULL),
(103, '2024-09-00028', 'Gonzalez', 34, 'Male', '1990-10-08', 'Austin', '808 Ash St', 'N', 12, 'Bachelor', 'Married', 'Engineer', 'Jewish', 'BuildCorp', 60000.00, 'Employed', '09223456789', 'gonzalez@example.com', 'Y', 'N', '2024-09-13 03:50:00', '', '', '2024-09-12 17:50:00', 'Daniel', 'K', '', 'N', '', 'renewal', NULL, NULL),
(104, '2024-09-00029', 'Hernandez', 36, 'Female', '1988-01-29', 'Jacksonville', '909 Poplar St', 'Y', 13, 'Master', 'Divorced', 'Doctor', 'Buddhist', 'HealthCorp', 70000.00, 'Employed', '09334567890', 'hernandez@example.com', 'N', 'Y', '2024-09-13 03:55:00', '', '', '2024-09-12 17:55:00', 'Isabella', 'L', '', 'Y', '', 'active', NULL, NULL),
(105, '2024-09-00030', 'Moore', 38, 'Male', '1986-03-03', 'Fort Worth', '1010 Redwood St', 'N', 14, 'PhD', 'Widowed', 'Scientist', 'Christian', 'ResearchCorp', 80000.00, 'Employed', '09445678901', 'moore@example.com', 'Y', 'N', '2024-09-13 04:00:00', '', '', '2024-09-12 18:00:00', 'William', 'M', '', 'N', '', 'active', NULL, NULL),
(106, '2024-09-00031', 'Taylor', 25, 'Female', '1999-11-17', 'Columbus', '1111 Cedar St', 'Y', 15, 'High School', 'Single', 'Technician', 'Catholic', 'TechCorp', 35000.00, 'Employed', '09556789012', 'taylor@example.com', 'N', 'N', '2024-09-13 04:05:00', '', '', '2024-09-12 18:05:00', 'Olivia', 'N', '', 'N', '', 'renewal', NULL, NULL),
(107, '2024-09-00032', 'Anderson', 37, 'Male', '1987-07-04', 'Charlotte', '1212 Birch St', 'N', 16, 'Bachelor', 'Married', 'Lawyer', 'Muslim', 'LawCorp', 65000.00, 'Employed', '09667890123', 'anderson@example.com', 'Y', 'Y', '2024-09-13 04:10:00', '', '', '2024-09-12 18:10:00', 'Alexander', 'O', '', 'Y', '', 'active', NULL, NULL),
(108, '2024-09-00033', 'Thomas', 39, 'Female', '1985-05-21', 'San Francisco', '1313 Maple St', 'Y', 17, 'Master', 'Divorced', 'Nurse', 'Hindu', 'HealthCorp', 45000.00, 'Employed', '09778901234', 'thomas@example.com', 'N', 'N', '2024-09-13 04:15:00', '', '', '2024-09-12 18:15:00', 'Emma', 'P', '', 'N', '', 'active', NULL, NULL),
(109, '2024-09-00034', 'Jackson', 41, 'Male', '1983-09-09', 'Indianapolis', '1414 Oak St', 'N', 18, 'PhD', 'Widowed', 'Scientist', 'Jewish', 'ResearchCorp', 75000.00, 'Employed', '09889012345', 'jackson@example.com', 'Y', 'N', '2024-09-13 04:20:00', '', '', '2024-09-12 18:20:00', 'Benjamin', 'Q', '', 'N', '', 'active', NULL, NULL),
(110, '2024-09-00035', 'White', 24, 'Female', '2000-12-12', 'Seattle', '1515 Pine St', 'Y', 19, 'Associate', 'Single', 'Teacher', 'Buddhist', 'EduCorp', 40000.00, 'Employed', '09123456789', 'white@example.com', 'N', 'Y', '2024-09-13 04:25:00', '', '', '2024-09-12 18:25:00', 'Ava', 'R', '', 'Y', '', 'renewal', NULL, NULL),
(111, '2024-09-00036', 'Harris', 42, 'Male', '1982-06-06', 'Denver', '1616 Spruce St', 'N', 20, 'Bachelor', 'Married', 'Engineer', 'Christian', 'BuildCorp', 60000.00, 'Employed', '09234567890', 'harris@example.com', 'Y', 'N', '2024-09-13 04:30:00', '', '', '2024-09-12 18:30:00', 'Lucas', 'S', '', 'N', '', 'terminated', NULL, NULL),
(112, '2024-09-00037', 'Martin', 43, 'Female', '1981-04-27', 'Washington', '1717 Fir St', 'Y', 21, 'Master', 'Divorced', 'Doctor', 'Catholic', 'HealthCorp', 70000.00, 'Employed', '09345678901', 'martin@example.com', 'N', 'N', '2024-09-13 04:35:00', '', '', '2024-09-12 18:35:00', 'Mia', 'T', '', 'N', 'asdf', 'new', NULL, NULL),
(114, '2024-09-00038', 'Esgera', 23, 'Male', '2001-01-01', 'quezon', 'eubert@gmail.com', 'Y', 3, 'elementary level', 'Single', 'IT', 'Christian', 'company name', 0.00, 'Employed', '09568884009', 'eubert@gmail.com', 'Y', 'N', '2024-09-13 07:26:45', 'a1. Consequence of rape', 'language', '2024-09-13 05:26:45', 'Bert', '01', 'jr', 'Y', 'adfasdfasdf', 'new', '10000', '1234'),
(115, '2024-09-00039', 'Esgera', 23, 'Male', '2001-01-01', 'quezon', 'eubert@gmail.com', 'N', 4, 'elementary graduate', 'Single', 'IT', 'Christian', 'company name', 0.00, 'Employed', '09568884009', 'eubert@gmail.com', 'Y', 'N', '2024-09-13 07:31:48', 'a1. Consequence of rape', 'language', '2024-09-13 05:31:48', 'Bert', '01', '', 'Y', '', 'new', '10000', '1234'),
(116, '2024-09-00040', 'Esgera', 35, 'Male', '1989-02-02', 'quezon', 'eubert@gmail.com', 'Y', 8, 'elementary level', 'Single', 'IT', 'Christian', 'company name', 0.00, 'Employed', '09568884009', 'eubert@gmail.com', 'Y', 'N', '2024-09-13 07:48:01', 'a2. Widow/ widower', 'language', '2024-09-13 05:48:01', 'Bert', '01', 'sr', 'Y', 'reamrks', 'new', '10000', '09874');

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
(98, 114, 'brow', '', 10, '0000-00-00', '', '', '', 0.00),
(99, 115, 'andrea ', '', 10, '2014-01-01', '', '', 'IT', 0.00),
(100, 115, 'emman', '', 10, '2014-01-01', '', '', '', 0.00),
(101, 111, 'Emmanuel ', 'Brother', 21, '0000-00-00', '', '', '', 0.00),
(102, 116, 'bro1', '', 4, '2020-02-02', '', '', 'IT', 0.00),
(103, 116, 'bro2', '', 4, '2020-02-02', '', '', '', 0.00);

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
  `date` datetime NOT NULL,
  `Indigenous_Person` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `quantity`, `buy_price`, `sale_price`, `categorie_id`, `media_id`, `date`, `Indigenous_Person`) VALUES
(1, 'Demo Product', '48', 100.00, 500.00, 1, 0, '2021-04-04 16:45:51', ''),
(2, 'Box Varieties', '12000', 55.00, 130.00, 4, 0, '2021-04-04 18:44:52', ''),
(3, 'Wheat', '69', 2.00, 5.00, 2, 0, '2021-04-04 18:48:53', ''),
(4, 'Timber', '1200', 780.00, 1069.00, 2, 0, '2021-04-04 19:03:23', ''),
(5, 'W1848 Oscillating Floor Drill Press', '26', 299.00, 494.00, 5, 0, '2021-04-04 19:11:30', ''),
(6, 'Portable Band Saw XBP02Z', '42', 280.00, 415.00, 5, 0, '2021-04-04 19:13:35', ''),
(7, 'Life Breakfast Cereal-3 Pk', '107', 3.00, 7.00, 3, 0, '2021-04-04 19:15:38', ''),
(8, 'Chicken of the Sea Sardines W', '110', 13.00, 20.00, 3, 0, '2021-04-04 19:17:11', ''),
(9, 'Disney Woody - Action Figure', '67', 29.00, 55.00, 3, 0, '2021-04-04 19:19:20', ''),
(10, 'Hasbro Marvel Legends Series Toys', '106', 219.00, 322.00, 3, 0, '2021-04-04 19:20:28', ''),
(11, 'Packing Chips', '78', 21.00, 31.00, 4, 0, '2021-04-04 19:25:22', ''),
(12, 'Classic Desktop Tape Dispenser 38', '160', 5.00, 10.00, 8, 0, '2021-04-04 19:48:01', ''),
(13, 'Small Bubble Cushioning Wrap', '199', 8.00, 19.00, 4, 0, '2021-04-04 19:49:00', ''),
(14, 'sadfas', '-11234', 1234.00, 134.00, 1, 0, '2024-08-15 08:36:17', '');

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
(1, 'Harry Denn', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 'no_image.png', 1, '2024-09-13 04:18:34'),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `family_members`
--
ALTER TABLE `family_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

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
