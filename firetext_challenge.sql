-- phpMyAdmin SQL Dump
-- version 4.6.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 09, 2016 at 06:55 AM
-- Server version: 5.7.12
-- PHP Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `firetext_challenge`
--
CREATE DATABASE IF NOT EXISTS `firetext_challenge` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `firetext_challenge`;

-- --------------------------------------------------------

--
-- Table structure for table `contact_list`
--

CREATE TABLE `contact_list` (
  `id` int(11) UNSIGNED NOT NULL,
  `fileName` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_list`
--

INSERT INTO `contact_list` (`id`, `fileName`, `created_at`, `updated_at`) VALUES
(291, '57a97c1390c35.csv', '2016-08-09 05:45:39', '2016-08-09 05:45:39'),
(292, '57a97ccd7745a.csv', '2016-08-09 05:48:45', '2016-08-09 05:48:45'),
(293, '57a97d1fd033b.csv', '2016-08-09 05:50:07', '2016-08-09 05:50:07');

-- --------------------------------------------------------

--
-- Table structure for table `subscriber`
--

CREATE TABLE `subscriber` (
  `id` int(11) UNSIGNED NOT NULL,
  `contact_list_id` int(11) DEFAULT NULL,
  `response_id` varchar(255) DEFAULT NULL,
  `msisdn` bigint(13) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `networkCode` int(6) DEFAULT NULL,
  `errorCode` varchar(255) DEFAULT NULL,
  `errorDescription` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `countryName` varchar(255) DEFAULT NULL,
  `countryCode` varchar(255) DEFAULT NULL,
  `network` varchar(255) DEFAULT NULL,
  `networkType` varchar(255) DEFAULT NULL,
  `ported` varchar(255) DEFAULT NULL,
  `portedFrom` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscriber`
--

INSERT INTO `subscriber` (`id`, `contact_list_id`, `response_id`, `msisdn`, `status`, `networkCode`, `errorCode`, `errorDescription`, `location`, `countryName`, `countryCode`, `network`, `networkType`, `ported`, `portedFrom`, `created_at`, `updated_at`) VALUES
(1, 291, '28e381ba-b7f7-478f-8de6-57c9ca5281ed', 447540952032, 'Success', 23432, NULL, NULL, NULL, 'UK', 'GBR', 'O2', 'GSM', 'No', NULL, '2016-08-09 05:45:39', '2016-08-09 05:45:43'),
(2, 291, '6b81f22e-7a12-465b-acf9-600270a431b2', 447000000001, 'Success', 23401, NULL, NULL, NULL, 'UK', 'GBR', 'O2', 'GSM', 'No', NULL, '2016-08-09 05:45:39', '2016-08-09 05:45:44'),
(3, 291, 'fdd68e3f-8dd6-4542-8de4-9a86b8998188', 447000000001, 'Success', 23401, NULL, NULL, NULL, 'UK', 'GBR', 'O2', 'GSM', 'No', NULL, '2016-08-09 05:45:39', '2016-08-09 05:45:45'),
(4, 291, '5c738458-eb59-4384-bbfb-77134643d690', 447000000001, 'Success', 23401, NULL, NULL, NULL, 'UK', 'GBR', 'O2', 'GSM', 'No', NULL, '2016-08-09 05:45:39', '2016-08-09 05:45:48'),
(5, 291, '6aaaa244-384b-4a01-b529-5e7e711447a9', 447000000001, 'Success', 23401, NULL, NULL, NULL, 'UK', 'GBR', 'O2', 'GSM', 'No', NULL, '2016-08-09 05:45:39', '2016-08-09 05:45:49'),
(6, 292, '915b1922-4aab-4471-abf0-8ec5fbbb3791', 447540952032, 'Success', 23432, NULL, NULL, NULL, 'UK', 'GBR', 'O2', 'GSM', 'No', NULL, '2016-08-09 05:48:45', '2016-08-09 05:48:46'),
(7, 292, '95ea7810-3dfb-4cbd-9cee-6d564f0cd68b', 447000000001, 'Success', 23401, NULL, NULL, NULL, 'UK', 'GBR', 'O2', 'GSM', 'No', NULL, '2016-08-09 05:48:45', '2016-08-09 05:48:47'),
(8, 292, 'ae01a688-3bc2-4907-99da-771a93dae327', 447000000001, 'Success', 23401, NULL, NULL, NULL, 'UK', 'GBR', 'O2', 'GSM', 'No', NULL, '2016-08-09 05:48:45', '2016-08-09 05:48:48'),
(9, 292, 'c75032f1-817b-47f4-8582-898dac69ab75', 447000000001, 'Success', 23401, NULL, NULL, NULL, 'UK', 'GBR', 'O2', 'GSM', 'No', NULL, '2016-08-09 05:48:45', '2016-08-09 05:48:49'),
(10, 292, '91658205-75fb-479c-85f2-93ff8bf05af3', 447000000001, 'Success', 23401, NULL, NULL, NULL, 'UK', 'GBR', 'O2', 'GSM', 'No', NULL, '2016-08-09 05:48:45', '2016-08-09 05:48:51'),
(11, 293, '98b8de48-d11d-4a7c-9cf0-40fba08e8a72', 447540952032, 'Success', 23432, NULL, NULL, NULL, 'UK', 'GBR', 'O2', 'GSM', 'No', NULL, '2016-08-09 05:50:07', '2016-08-09 05:50:08'),
(12, 293, '268834ee-8143-43b8-92f7-f889703a4c0c', 447000000001, 'Unavailable', NULL, '1b', 'Absent Subscriber', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-08-09 05:50:07', '2016-08-09 05:50:09'),
(13, 293, 'db7daed9-607a-4b11-83bb-e905de070c24', 447000000001, 'Unavailable', NULL, '1b', 'Absent Subscriber', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-08-09 05:50:07', '2016-08-09 05:50:12'),
(14, 293, 'd704f477-a239-4d46-844f-816fe777b3ee', 447000000001, 'Unavailable', NULL, '1b', 'Absent Subscriber', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-08-09 05:50:07', '2016-08-09 05:50:16'),
(15, 293, '3a16778d-7824-4e98-871a-62c15524a2c4', 447000000001, 'Unavailable', NULL, '1b', 'Absent Subscriber', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-08-09 05:50:07', '2016-08-09 05:50:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_list`
--
ALTER TABLE `contact_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriber`
--
ALTER TABLE `subscriber`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_list`
--
ALTER TABLE `contact_list`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=294;
--
-- AUTO_INCREMENT for table `subscriber`
--
ALTER TABLE `subscriber`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
