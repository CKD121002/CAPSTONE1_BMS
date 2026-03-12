-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2026 at 01:34 PM
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
-- Database: `barangay_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department_name`) VALUES
(1, 'ADMIN'),
(2, 'BPSO'),
(3, 'CLEARANCE'),
(4, 'LUPON');

-- --------------------------------------------------------

--
-- Table structure for table `officials`
--

CREATE TABLE `officials` (
  `official_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `position` varchar(100) DEFAULT NULL,
  `department` enum('ADMIN','BPSO','CLEARANCE','LUPON') NOT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `proof_file` varchar(255) NOT NULL,
  `id_number` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `officials`
--

INSERT INTO `officials` (`official_id`, `name`, `position`, `department`, `contact_number`, `email`, `username`, `password`, `status`, `created_at`, `proof_file`, `id_number`) VALUES
(1, 'Jerome Dulla', NULL, 'BPSO', '09999999999', 'jbdulla@gmail.com', 'jbdulla', '12345', 'active', '2026-03-08 10:56:56', '1772967416_69ad55f801e0b.png', '12345678'),
(2, 'Cardo Dalisay', NULL, 'ADMIN', '09123456789', 'admin123@gmail.com', 'admin', '$2y$10$F81RDVj3ggUBEteR0JA5pOUb7PzwPm4BhwJmWl5ET2jZv1dZtjsvm', '', '2026-03-11 10:18:33', '1773224313_69b14179b4ccb.jpg', '1234567890'),
(3, 'Rowena', NULL, 'CLEARANCE', '09876543210', 'cabillo@gmail.com', 'wena', '$2y$10$7Lpj3Kf1xonzOHkOSAeDBut6hNJuZUJ5uM42S0m1S6TE0IeGhv9pC', '', '2026-03-11 10:27:42', '1773224862_69b1439e77140.jpg', '1231231234');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `reset_id` int(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `account_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`reset_id`, `email`, `token`, `expires_at`, `created_at`, `account_type`) VALUES
(2, 'couteau112.tfa@gmail.com', '5c21af6204d2fdaebd49c59735afb7e595834bb073fbef19a0e9af6ac28b0135', '2026-03-11 13:26:19', '2026-03-11 11:26:19', 'resident'),
(4, 'cabillo@gmail.com', '5a09c06332748081eeeb955cd314c2ba35c08fb6f4a2b0c93f9f5910d2f0ac71', '0000-00-00 00:00:00', '2026-03-11 11:34:26', 'official');

-- --------------------------------------------------------

--
-- Table structure for table `residents`
--

CREATE TABLE `residents` (
  `resident_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `sex` enum('Male','Female') DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `address` text DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `proof_file` varchar(255) NOT NULL,
  `id_number` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `residents`
--

INSERT INTO `residents` (`resident_id`, `name`, `sex`, `birthdate`, `contact_number`, `email`, `address`, `username`, `password`, `status`, `created_at`, `proof_file`, `id_number`) VALUES
(1, 'joshuaisla', NULL, NULL, '91995990881', 'joshuaisla@gmail.com', NULL, 'joshieee', '$2y$10$gqylUeMtS3Pz8KvsZAsGcOuSf5hZN.mxWDz2GOhvm4KTrPvWhuAay', 'pending', '2026-03-09 15:16:30', '1773069390_69aee44e7a52b.jpg', '1231231234'),
(2, 'chester kyle', NULL, NULL, '09123456789', 'couteau112.tfa@gmail.com', NULL, 'ckd', '123', 'pending', '2026-03-09 15:38:55', '1773070735_69aee98fc2a6a.jpg', '1234567890');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`),
  ADD UNIQUE KEY `department_name` (`department_name`);

--
-- Indexes for table `officials`
--
ALTER TABLE `officials`
  ADD PRIMARY KEY (`official_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`reset_id`);

--
-- Indexes for table `residents`
--
ALTER TABLE `residents`
  ADD PRIMARY KEY (`resident_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `officials`
--
ALTER TABLE `officials`
  MODIFY `official_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `reset_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `residents`
--
ALTER TABLE `residents`
  MODIFY `resident_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
