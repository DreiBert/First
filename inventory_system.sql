-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2024 at 05:34 AM
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
  `problems` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `application_forms`
--

INSERT INTO `application_forms` (`id`, `case_number`, `full_name`, `age`, `sex`, `date_of_birth`, `place_of_birth`, `address`, `pensioner`, `barangay_id`, `educational_attainment`, `civil_status`, `occupation`, `religion`, `company_agency`, `monthly_income`, `employment_status`, `contact_number`, `email_address`, `pantawid_beneficiary`, `lgbtq`, `date`, `classification`, `problems`) VALUES
(1, NULL, 'user', 21, 'Male', '1970-01-01', '', 'asdfas', NULL, NULL, 'asdfasd', 'Married', 'asdf', 'adfas', 'sdfasdf', 123431.00, 'Employed', 'asdfa', 'asdfa@fasdf.com', 'Y', 'Y', '2024-08-30 04:14:00', NULL, NULL),
(2, NULL, 'Eubert ', 22, 'Male', '1970-01-01', '', 'alsdjflajk', NULL, NULL, 'lasjdflasjk', 'Single', 'lasjdflj', 'lajsdfl', 'lasdjflajk', 1242134.00, 'Employed', '123413', 'asdfasd@asdfas.com', 'Y', 'N', '2024-08-30 04:48:53', NULL, NULL),
(3, NULL, 'Andrei ', 23, 'Male', '1970-01-01', '', 'Cavite', NULL, NULL, 'College', 'Single', 'Student', 'Born Again ', 'CSWD', 10000.00, 'Employed', '09267033282', 'eubert@gmail.com', 'Y', 'N', '2024-08-30 04:50:15', NULL, NULL),
(4, NULL, 'Hello ', 123, 'Male', '1970-01-01', '', 'lasjkdflsdjk', NULL, NULL, 'lasdjflajk', 'Married', 'alsdkjflkj', 'lasdjflj', 'jalsdkjfl', 12341.00, 'Employed', '123413', 'asdfn@gmail.com', 'N', 'N', '2024-08-30 05:02:04', NULL, NULL),
(5, NULL, 'Eubert ', 22, 'Male', '2001-10-07', 'Quezon ', 'Cavite ', NULL, NULL, 'College', 'Single', 'IT ', 'Born Again ', 'CSWD', 100000.00, 'Employed', '09324123413', 'eubert@gmail.com', 'N', 'N', '2024-08-30 05:22:22', NULL, NULL),
(6, '1234', 'Eubert ', 21, 'Male', '2001-09-09', 'Quezon ', 'Cavite ', NULL, NULL, 'College', 'Single', 'Student', 'Born Again ', 'CSWD', 99999999.99, 'Employed', '1234', 'eubert@gmail.com', 'Y', 'Y', '2024-08-30 08:26:54', NULL, NULL),
(7, '1234', 'Andrea ', 19, 'Female', '2002-02-02', 'Quezon City ', 'Cavite ', NULL, NULL, 'College ', 'Single', 'None ', 'Catholic ', 'eac ', 20000.00, 'Employed', '09521341234', 'andrea@gmail.com', 'Y', 'N', '2024-09-04 07:42:08', NULL, NULL),
(8, '1234', 'Eubert ', 22, 'Male', '2014-02-01', 'Quezon City ', 'Cavite ', NULL, NULL, 'College', 'Single', 'Student', 'asdf', 'asdfadfs', 21341.00, 'Employed', '09267033282', 'eubert@gmail.com', 'Y', 'Y', '2024-09-04 08:04:54', NULL, NULL),
(9, '1234', 'eric ', 22, 'Male', '2001-01-01', 'cavite ', 'cavite ', NULL, NULL, 'college ', 'Single', 'student ', 'sldfjk', 'lskjflsdkj', 1234.00, 'Employed', '092134', 'eric@gmail.com', 'Y', 'N', '2024-09-04 08:09:57', NULL, NULL),
(10, '1234', 'Eubert ', 21, 'Male', '2001-10-10', 'quezon ', 'cavite ', NULL, NULL, 'college ', 'Single', 'student ', 'catholic ', 'it ', 200.00, 'Employed', '032142134', 'eubert@gmail.com', 'Y', 'N', '2024-09-05 02:44:31', NULL, NULL),
(11, '1234', 'user', 21, 'Male', '2001-01-01', 'cavite ', 'cavite ', NULL, NULL, 'college ', 'Single', 'pres ', 'pres ', 'pres ', 1234.00, 'Employed', '01923412934', 'user@gmail.com', 'Y', 'Y', '2024-09-05 02:53:07', NULL, NULL),
(12, '1234', 'user', 21, 'Male', '2001-01-01', 'cavite ', 'cavite ', NULL, NULL, 'college ', 'Single', 'pres ', 'pres ', 'pres ', 1234.00, 'Employed', '01923412934', 'user@gmail.com', 'Y', 'Y', '2024-09-05 02:54:59', NULL, NULL),
(13, '1234', 'user', 21, 'Male', '2001-01-01', 'cavite ', 'cavite ', NULL, NULL, 'college ', 'Single', 'pres ', 'pres ', 'pres ', 1234.00, 'Employed', '01923412934', 'user@gmail.com', 'Y', 'Y', '2024-09-05 02:55:01', NULL, NULL),
(14, '1234', 'user', 21, 'Male', '2001-01-01', 'cavite ', 'cavite ', NULL, NULL, 'college ', 'Single', 'pres ', 'pres ', 'pres ', 1234.00, 'Employed', '01923412934', 'user@gmail.com', 'Y', 'Y', '2024-09-05 02:55:03', NULL, NULL),
(15, '1234', 'user', 21, 'Male', '2001-01-01', 'cavite ', 'cavite ', NULL, NULL, 'college ', 'Single', 'pres ', 'pres ', 'pres ', 1234.00, 'Employed', '01923412934', 'user@gmail.com', 'Y', 'Y', '2024-09-05 02:55:09', NULL, NULL),
(16, '1234', 'user', 21, 'Male', '2001-01-01', 'cavite ', 'cavite ', NULL, NULL, 'college ', 'Single', 'pres ', 'pres ', 'pres ', 1234.00, 'Employed', '01923412934', 'user@gmail.com', 'Y', 'Y', '2024-09-05 02:55:34', NULL, NULL),
(17, '1234', 'asdf', 12, 'Male', '2001-01-01', 'quezon ', 'aldksfj', NULL, NULL, 'alsdkfj', 'Single', 'sldkfj', 'lskdfj', 'lskdfj', 134234.00, 'Employed', '1234', '234@gmail.com', 'Y', 'Y', '2024-09-05 03:24:46', NULL, NULL),
(18, '1234', 'asdf', 12, 'Male', '2001-01-01', 'sadf', 'sdfsdf', NULL, NULL, 'sfasdf', 'Single', 'asdf', 'asdf', 'sdafas', 1234.00, 'Self-employed', 'asdf', 'asdfa@gmadfl.com', 'Y', 'Y', '2024-09-05 03:26:28', NULL, NULL),
(19, '134', 'Bertee', 23, 'Male', '2001-01-01', 'asdf', 'asdfasd', NULL, NULL, 'asdfs', 'Single', 'as,dmfn', 'asdfn', 'sadnf,n', 1234.00, 'Self-employed', '123412', 'eubert@gmail.com', 'N', 'N', '2024-09-05 03:30:20', NULL, NULL),
(20, '1234', 'fasdf', 2134, 'Male', '2001-01-01', 'ewalkrj', 'lksafjl', NULL, NULL, 'ladjsflak', 'Single', 'asdfdas', 'asdf', 'asdf', 1234.00, 'Employed', '2134', 'eubert@gmail.com', 'Y', 'Y', '2024-09-05 03:47:03', NULL, NULL),
(21, '1234', 'Eubert ', 21, 'Male', '2001-12-07', 'Quezon ', 'Cavite ', NULL, NULL, 'colelge ', 'Single', 'IT ', 'Catholic ', 'IT ', 2000.00, 'Employed', '01923413', 'eubert@gmail.com', 'Y', 'Y', '2024-09-06 08:21:38', NULL, NULL),
(22, '1234', 'Eubert', 30, 'Male', '2001-01-01', 'quezon', 'Cavite ', NULL, NULL, 'College', 'Single', 'IT', 'Christian', 'company name', 10000.00, 'Employed', '09568884009', 'Cavite@gmail.com', 'Y', 'N', '2024-09-06 09:00:52', NULL, NULL),
(23, '1234', 'Eubert', 30, 'Male', '2001-01-01', 'quezon', 'eubert@gmail.com', NULL, NULL, 'College', 'Single', 'IT', 'Christian', 'company name', 10000.00, 'Employed', '09568884009', 'eubert@gmail.com', 'Y', 'N', '2024-09-06 09:02:21', NULL, NULL),
(24, '1234', 'Eubert', 30, 'Male', '2001-01-01', 'quezon', 'eubert@gmail.com', NULL, NULL, 'College', 'Single', 'IT', 'Christian', 'company name', 10000.00, 'Employed', '09568884009', 'eubert@gmail.com', 'Y', 'N', '2024-09-06 09:41:57', NULL, NULL),
(25, '1234', 'eubert', 21, 'Male', '2001-01-01', 'queonz', 'asldjkf', NULL, NULL, 'laksjdflj', 'Single', 'adsf', 'afda', 'adfads', 23.00, 'Employed', '1234123', 'asdfsd@gmail.com', 'N', 'Y', '2024-09-07 12:42:24', NULL, NULL),
(26, '1234', 'asdfasdf', 22, 'Male', '2001-10-07', 'Quezon', 'alsdfkjdas', NULL, NULL, 'laf', 'Single', 'asdfas', 'asdfad', 'asdfasd', 1234.00, 'Employed', '12341', 'eubert@gmail.com', 'Y', 'Y', '2024-09-08 08:30:01', NULL, NULL),
(27, '1234', 'Esguerra', 22, 'Male', '2001-10-07', 'Quezon', 'Cavite ', NULL, NULL, 'College', 'Single', 'asdf', 'asfd', 'asdfadsf', 134.00, 'Employed', '0132412', 'me@mydomain.com', 'Y', 'Y', '2024-09-08 08:34:57', NULL, NULL),
(28, '1234', 'eubert', 23, 'Male', '2001-01-01', 'Quezon', 'adsfadsf', NULL, NULL, 'asdfasdf', 'Single', 'adsfasdf', 'asdfsaf', 'asdfasdf', 1234.00, 'Employed', '12342', 'asdf@gmail.com', 'Y', 'Y', '2024-09-08 08:39:35', NULL, NULL),
(29, '1234', 'company name', 23, 'Male', '2001-01-01', 'adfas', 'country nameasdfadf', NULL, NULL, 'asdfasd', 'Single', 'asdfasdf', 'afsdasdf', 'asdfasd', 3214.00, 'Employed', '12342', 'FASDF@GMAIL.COM', 'Y', 'Y', '2024-09-08 18:52:36', 'asdfasdf asdf asdf asdf asdf asd fasdf asdf asdfasdf asdf asdf asdf asdf asd fasdf asdf asdfasdf asdf asdf asdf asdf asd fasdf asdf ', 'asfdasdfasdf asdf asdf asdf asdf asd fasdf asdf asdfasdf asdf asdf asdf asdf asd fasdf asdf asdfasdf asdf asdf asdf asdf asd fasdf asdf '),
(30, '1234', 'Eubert', 17, 'Male', '2007-01-01', 'Quezon', 'Cavite', NULL, NULL, 'College', 'Single', 'IT', 'Christian', 'CSWD', 12341324.00, 'Employed', '0913241234', 'Bert@gmail.com', 'Y', 'Y', '2024-09-08 19:18:44', 'asdfasdf', 'adfasdfas'),
(31, '1234', 'Eubert', 23, 'Male', '2001-01-01', 'Quezon', 'Cavite', NULL, NULL, 'College', 'Single', 'IT', 'Christian', 'CSWD', 12341324.00, 'Employed', '0913241234', 'Bert@gmail.com', 'Y', 'Y', '2024-09-08 19:33:03', '', ''),
(32, '1234', 'Eubert', 23, 'Male', '2001-01-01', 'Quezon', 'Cavite', NULL, NULL, 'College', 'Single', 'IT', 'Christian', 'CSWD', 12341324.00, 'Employed', '0913241234', 'Bert@gmail.com', 'Y', 'Y', '2024-09-08 19:35:08', '', ''),
(33, '1234', 'Eubert ey', 23, 'Male', '2001-01-01', 'Quezon', 'Cavite', NULL, NULL, 'College', 'Single', 'IT', 'Christian', 'CSWD', 12341324.00, 'Employed', '0913241234', 'Bert@gmail.com', 'Y', 'Y', '2024-09-08 19:37:43', '', ''),
(34, '1234', 'Eubert', 26, 'Male', '1998-01-01', 'Quezon', 'Cavite', NULL, NULL, 'College', 'Single', 'IT', 'Christian', 'CSWD', 12341324.00, 'Employed', '0913241234', 'Bert@gmail.com', 'Y', 'N', '2024-09-08 19:40:56', 'asdfasdf', 'asdasdfasd'),
(35, '1234', 'Eubert', 23, 'Male', '2001-01-01', 'Quezon', 'Cavite', NULL, NULL, 'College', 'Single', 'IT', 'Christian', 'CSWD', 12341324.00, 'Employed', '0913241234', 'Bert@gmail.com', 'Y', 'Y', '2024-09-08 19:43:25', '', ''),
(36, '1234', 'Eubertfdf', 23, 'Male', '2001-01-01', 'Quezon', 'Cavite', NULL, NULL, 'College', 'Single', 'IT', 'Christian', 'CSWD', 12341324.00, 'Employed', '0913241234', 'Bert@gmail.com', 'Y', 'Y', '2024-09-08 19:45:16', '', ''),
(37, '1234', 'Esguerra, Eubert Andrei', 24, 'Male', '2000-01-01', 'Quezon', 'Cavite', NULL, NULL, 'College', 'Single', 'IT', 'Christian', 'CSWD', 12341324.00, 'Employed', '0913241234', 'Bert@gmail.com', 'Y', 'Y', '2024-09-08 20:06:56', '', ''),
(38, '1234', 'my last name, my first name 01', 17, 'Male', '2007-01-01', 'quezon', 'eubert@gmail.com', NULL, 1, 'College', 'Single', 'IT', 'Christian', 'company name', 10000.00, 'Employed', '09568884009', 'eubert@gmail.com', 'Y', 'N', '2024-09-09 03:33:46', '', ''),
(39, '1234', 'my last name, my first name 01', 23, 'Male', '2001-01-01', 'quezon', 'eubert@gmail.com', NULL, 1, 'College', 'Single', 'IT', 'Christian', 'company name', 10000.00, 'Employed', '09568884009', 'eubert@gmail.com', 'Y', 'N', '2024-09-09 03:37:32', '', ''),
(40, '1234', 'my last name, my first name 01', 22, 'Male', '2002-02-02', 'quezon', 'eubert@gmail.com', NULL, 31, 'College', 'Single', 'IT', 'Christian', 'company name', 10000.00, 'Employed', '09568884009', 'eubert@gmail.com', 'Y', 'N', '2024-09-09 03:38:25', '', ''),
(41, '1234', 'my last name, my first name 01', 21, 'Male', '2003-01-01', 'quezon', 'eubert@gmail.com', 'Y', 38, 'College', 'Single', 'IT', 'Christian', 'company name', 10000.00, 'Employed', '09568884009', 'eubert@gmail.com', 'Y', 'N', '2024-09-09 03:54:16', '', ''),
(42, '1234', 'Esgera, Bert 01', 23, 'Male', '2001-01-20', 'quezon', 'eubert@gmail.com', 'Y', 2, 'College', 'Single', 'IT', 'Christian', 'company name', 10000.00, 'Employed', '09568884009', 'eubert@gmail.com', 'Y', 'N', '2024-09-09 03:58:02', '', '');

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
(1, 'Salawag'),
(2, 'Burol I'),
(3, 'Burol II'),
(4, 'Burol III'),
(5, 'Burol Main'),
(6, 'San Dionisio'),
(7, 'San Esteban'),
(8, 'Sto. Cristo'),
(9, 'Sto. Niño I'),
(10, 'Sto. Niño II'),
(11, 'San Manuel I'),
(12, 'San Manuel II'),
(13, 'San Miguel I'),
(14, 'San Miguel II'),
(15, 'St. Peter I'),
(16, 'St. Peter II'),
(17, 'Parts of Burol III'),
(18, 'San Andres I'),
(19, 'San Andres II'),
(20, 'San Roque'),
(21, 'San Simon'),
(22, 'Sta. Cristina I'),
(23, 'Victoria Reyes'),
(24, 'Bautista Property (part of Sampaloc IV)'),
(25, 'Luzviminda I'),
(26, 'Luzviminda II'),
(27, 'San Nicolas I'),
(28, 'San Nicolas II'),
(29, 'San Mateo'),
(30, 'Emmanuel Bergado I'),
(31, 'Emmanuel Bergado II'),
(32, 'San Luis I'),
(33, 'San Luis II'),
(34, 'San Francisco I'),
(35, 'San Francisco II'),
(36, 'Sta. Fe'),
(37, 'Langkaan I'),
(38, 'Langkaan II (Humayao)'),
(39, 'Paliparan I'),
(40, 'Paliparan II'),
(41, 'Paliparan III'),
(42, 'Salitran I'),
(43, 'Salitran II'),
(44, 'Salitran III'),
(45, 'Salitran IV'),
(46, 'Sampaloc I (Pala-Pala)'),
(47, 'Sampaloc II'),
(48, 'Sampaloc III'),
(49, 'Sampaloc IV'),
(50, 'Sampaloc V'),
(51, 'San Agustin I'),
(52, 'San Agustin II'),
(53, 'San Agustin III'),
(54, 'San Antonio de Padua I'),
(55, 'San Antonio de Padua II'),
(56, 'Sta. Cruz I'),
(57, 'Sta. Cruz II'),
(58, 'Sta. Maria'),
(59, 'Zone I'),
(60, 'Zone I-A'),
(61, 'Zone II'),
(62, 'Zone III'),
(63, 'Zone IV');

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
(1, 30, 'Bhea ', 'Mom', 'Cavite', '1341234'),
(2, 32, '', '', '', ''),
(3, 34, 'asdfasdf', 'asdfasdf', 'adfasdf', '12341234');

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
(1, 24, 'andrea ', 'sis', 19, '2001-09-09', 'Single', 'asdf', 'IT', 1234.00),
(2, 24, 'emman', 'bro', 23, '2001-01-01', 'Single', 'asdf', 'asdf', 1234.00),
(3, 25, 'asdf', 'asdfa', 212, '0001-01-01', 'Single', 'asdf', 'asfd', 1234.00),
(4, 25, 'asdf', 'asdf', 2, '2001-01-01', 'Single', 'asdf', 'adsf', 1243.00),
(5, 26, 'asdf', 'asdf', 23, '2001-01-01', 'Single', 'asdf', 'asdfsadf', 1234.00),
(6, 27, 'my full name', 'sis', 20, '2004-01-01', 'Single', 'asdf', 'occupation', 1234.00),
(7, 28, 'emman1', 'asdfasdf', 19, '2005-01-01', 'Single', 'adfa', 'adsfadf', 1234.00),
(8, 28, 'emman2', 'asdfasdf', 10, '2014-01-01', 'Single', 'asdfa', 'asdfas', 3214.00),
(9, 28, 'emman2', 'asdfasdf', 4, '2020-01-01', 'Single', 'asdf', 'asdfas', 1234.00),
(10, 29, 'company namea', 'adfasd', 23, '2001-01-01', 'Single', 'asdfads', 'sadfafsd', 234.00),
(11, 30, 'Andrea', 'sis', 22, '2002-02-02', 'Single', 'asdfads', 'asdfasd', 112341.00),
(12, 30, 'Emman', 'bro', 21, '2002-12-01', 'Single', 'fasdf', 'fasdf', 12341.00),
(13, 34, 'brobro', 'asdf', 22, '2002-02-20', 'Single', 'adfasd', 'adsf', 1234.00),
(14, 34, 'brobrobro', 'adfaf', 24, '1999-10-10', 'Single', 'asdf', 'asdf', 124.00),
(15, 35, 'bro1', 'asdfa', 23, '2001-01-01', 'Single', 'asdfa', 'asdfdas', 123412.00),
(16, 35, 'bro2', 'asdfas', 23, '2001-01-01', 'Single', 'asdfasd', 'asdfasd', 1234123.00),
(17, 35, 'bro3', 'asdfasdf', 23, '2001-01-01', 'Single', 'asdfas', 'asdfadsf', 31241.00),
(18, 36, 'asdfa', 'asdfasdf', 23, '2001-01-01', 'Single', 'adfasd', 'asdfas', 12312.00);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `barangays`
--
ALTER TABLE `barangays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `emergency_contacts`
--
ALTER TABLE `emergency_contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `family_members`
--
ALTER TABLE `family_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
