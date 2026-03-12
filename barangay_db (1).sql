-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2026 at 05:25 PM
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
-- Table structure for table `certifications`
--

CREATE TABLE `certifications` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `cert_type` varchar(100) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `approved_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clearance_permits`
--

CREATE TABLE `clearance_permits` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `approved_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `document_requests`
--

CREATE TABLE `document_requests` (
  `id` int(11) NOT NULL,
  `resident_name` varchar(150) NOT NULL,
  `document_type` varchar(150) NOT NULL,
  `purpose` text NOT NULL,
  `status` enum('Pending','Approved','Disapproved') DEFAULT 'Pending',
  `request_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `document_requests`
--

INSERT INTO `document_requests` (`id`, `resident_name`, `document_type`, `purpose`, `status`, `request_date`) VALUES
(1, 'Juan Dela Cruz', 'Barangay Clearance', 'Job Application', 'Disapproved', '2026-03-03 19:59:16'),
(2, 'Maria Santos', 'Barangay Clearance', 'School Requirement', 'Disapproved', '2026-03-03 19:59:16'),
(3, 'Pedro Reyes', 'Barangay Indigency Certificate', 'Medical Assistance', 'Pending', '2026-03-03 19:59:16'),
(4, 'Ana Cruz', 'Barangay Business Permit Certificate', 'Business Renewal', 'Pending', '2026-03-03 19:59:16');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `question` text DEFAULT NULL,
  `answer` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `question`, `answer`) VALUES
(1, 'What are the barangay office hours', 'Barangay office hours are 8 AM to 5 PM Monday to Friday.'),
(2, 'How can I request barangay clearance', 'You can request a Barangay Clearance in the E-Certificate section.'),
(3, 'How do I report an incident', 'You can submit an incident report in the Incident Report page.'),
(4, 'How can I contact the barangay', 'You may contact the barangay office at 09123456789.'),
(5, 'What are the steps to request barangay clearance', '1. Login to your account.<br>\r\n2. Go to the E-Certificate section.<br>\r\n3. Select Barangay Clearance.<br>\r\n4. Fill out the required form.<br>\r\n5. Submit your request and wait for confirmation.');

-- --------------------------------------------------------

--
-- Table structure for table `ids`
--

CREATE TABLE `ids` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `id_type` varchar(100) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `approved_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `legal_reports`
--

CREATE TABLE `legal_reports` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `report_type` varchar(100) NOT NULL,
  `purpose` text NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `approved_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `legal_reports`
--

INSERT INTO `legal_reports` (`id`, `fullname`, `birthdate`, `report_type`, `purpose`, `phone`, `email`, `address`, `attachment`, `status`, `submitted_at`, `approved_at`) VALUES
(1, 'Victor', '2026-03-19', 'blotter_record', 'Utang ni Sibal', '1234567890', 'chesterkyle.d@gmail.com', '2605 Clinton St. Brookside Hills', '../uploads/received_910098943976533.jpeg', 'Rejected', '2026-03-12 11:17:14', NULL);

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
(2, 'Cardo Dalisay', NULL, 'ADMIN', '09123456789', 'admin123@gmail.com', 'admin', '$2y$10$F81RDVj3ggUBEteR0JA5pOUb7PzwPm4BhwJmWl5ET2jZv1dZtjsvm', 'active', '2026-03-11 10:18:33', '1773224313_69b14179b4ccb.jpg', '1234567890'),
(3, 'Rowena', NULL, 'CLEARANCE', '09876543210', 'cabillo@gmail.com', 'wena', '$2y$10$7Lpj3Kf1xonzOHkOSAeDBut6hNJuZUJ5uM42S0m1S6TE0IeGhv9pC', '', '2026-03-11 10:27:42', '1773224862_69b1439e77140.jpg', '1231231234'),
(4, 'Ricardo S. Licup, Jr', NULL, 'ADMIN', '09213243452', 'rlicup@gmail.com', 'rlicup', '$2y$10$7o88ZFlq5QejlTe/Xz8CMeg4TTKmrLPkSFAbSxVpoi/r0MW6hGpJu', 'active', '2026-03-12 06:43:04', '1773297784_69b260788bd27.png', '231');

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
(4, 'cabillo@gmail.com', '5a09c06332748081eeeb955cd314c2ba35c08fb6f4a2b0c93f9f5910d2f0ac71', '0000-00-00 00:00:00', '2026-03-11 11:34:26', 'official'),
(6, 'joshuaisla@gmail.com', '5fd413db9826b4a2a0a14dc9f706dba0fc7ba84cfff92f1d84e388482ebe3389', '0000-00-00 00:00:00', '2026-03-11 12:36:41', 'resident'),
(8, 'rlicup@gmail.com', 'd3cc2b063697b81ed067c90e9d330ff1e1b7bfccb9de2a591373c397151fb47e', '0000-00-00 00:00:00', '2026-03-12 07:27:00', 'official');

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
  `id_number` varchar(100) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `residents`
--

INSERT INTO `residents` (`resident_id`, `name`, `sex`, `birthdate`, `contact_number`, `email`, `address`, `username`, `password`, `status`, `created_at`, `proof_file`, `id_number`, `profile_picture`) VALUES
(1, 'joshuaisla', NULL, NULL, '91995990881', 'joshuaisla@gmail.com', NULL, 'joshieee', '$2y$10$gqylUeMtS3Pz8KvsZAsGcOuSf5hZN.mxWDz2GOhvm4KTrPvWhuAay', 'approved', '2026-03-09 15:16:30', '1773069390_69aee44e7a52b.jpg', '1231231234', NULL),
(2, 'chester kyle', 'Male', '2002-12-10', '09914250881', 'couteau112.tfa@gmail.com', '167 Riverside Dr.', 'ckd', '$2y$10$yNOOChl0e6TocEWO9.cfoO/3UYVE4i1Osz15O/WlunUYnpCErMsLq', 'approved', '2026-03-09 15:38:55', '1773070735_69aee98fc2a6a.jpg', '1234567890', NULL),
(3, 'Ian', 'Male', '2026-03-12', '09876543212', 'chesterkyle.d@gmail.com', 'jan lng', 'Ian', '$2y$10$Tnez8H7Y8HHrAWoKhWgz3ev1GNDsCd4aJEMQajo.MScoi2FsTcwsW', 'approved', '2026-03-12 10:01:48', '1773309708_69b28f0c41f77.jpg', '123456742', '1773313712_San Isidro.jpg'),
(4, 'victor', NULL, NULL, '12345', 'victor@gmail.com', NULL, 'victor', '$2y$10$RoPnP9rCJ2kc9lLuKBckDOlNAOCYPJCjApvwygcHI/CEVUbncfS.K', 'approved', '2026-03-12 11:14:44', '1773314084_69b2a024ad1c8.jpeg', '12345', NULL),
(5, 'Marie', NULL, NULL, '1234567890', 'marie@gmail.com', NULL, 'kahitano', '$2y$10$jCJiN5dfZWWvRgbBhDOM6u2hbtkWlbeLYZnfKo/MiiHZb.Gj8xV.K', 'approved', '2026-03-12 12:47:58', '1773319678_69b2b5fe93620.jpg', '1111', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `certifications`
--
ALTER TABLE `certifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clearance_permits`
--
ALTER TABLE `clearance_permits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`),
  ADD UNIQUE KEY `department_name` (`department_name`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ids`
--
ALTER TABLE `ids`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `legal_reports`
--
ALTER TABLE `legal_reports`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `certifications`
--
ALTER TABLE `certifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clearance_permits`
--
ALTER TABLE `clearance_permits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ids`
--
ALTER TABLE `ids`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `legal_reports`
--
ALTER TABLE `legal_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `officials`
--
ALTER TABLE `officials`
  MODIFY `official_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `reset_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `residents`
--
ALTER TABLE `residents`
  MODIFY `resident_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
