-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2026 at 04:31 PM
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
-- Database: `barangay_documents`
--

-- --------------------------------------------------------

--
-- Table structure for table `barangay_staff`
--

CREATE TABLE `barangay_staff` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `daily_rate` decimal(10,2) NOT NULL,
  `status` varchar(50) DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barangay_staff`
--

INSERT INTO `barangay_staff` (`id`, `fullname`, `position`, `daily_rate`, `status`) VALUES
(1, 'Camilo Neo F. Roxas', 'sk councilor', 1500.00, 'Active'),
(2, 'Arch’t Ricardo S. Licup, Jr.', 'Punong Barangay', 5000.00, 'Active');

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
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `certifications`
--

INSERT INTO `certifications` (`id`, `fullname`, `birthdate`, `cert_type`, `purpose`, `phone`, `email`, `address`, `attachment`, `status`, `submitted_at`) VALUES
(1, 'Christian C Morales', '2026-03-11', 'good_moral', 'Business', '09574857959', 'christianmorales602@gmail.com', 'cainta', '../uploads/641036686_122127711027031022_2444491109043114238_n.jpg', 'Pending', '2026-03-11 13:47:59'),
(2, 'Christian C Morales', '2026-03-11', 'good_moral', 'Business', '09574857959', 'christianmorales602@gmail.com', 'cainta', '../uploads/641036686_122127711027031022_2444491109043114238_n.jpg', 'Pending', '2026-03-11 14:00:54'),
(3, 'Christian C Morales', '2026-03-11', 'first_time_jobseeker', 'Business', '09574857959', 'christianmorales602@gmail.com', 'cainta', '../uploads/641036686_122127711027031022_2444491109043114238_n.jpg', 'Pending', '2026-03-11 14:01:03'),
(4, 'Christian C Morales', '2026-03-11', 'cedula', 'Business', '09574857959', 'christianmorales602@gmail.com', 'cainta', '1773237751_641036686_122127711027031022_2444491109043114238_n.jpg', 'Pending', '2026-03-11 14:02:31'),
(5, 'Christian C Morales', '2026-03-11', 'indigency', 'Business', '09574857959', 'christianmorales602@gmail.com', 'jan lang', '1773237968_png.png', 'Pending', '2026-03-11 14:06:08');

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
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clearance_permits`
--

INSERT INTO `clearance_permits` (`id`, `fullname`, `birthdate`, `purpose`, `phone`, `email`, `address`, `attachment`, `status`, `submitted_at`) VALUES
(1, 'Victor', '2026-03-11', 'Business', '912345678', 'shyyiieee@gmail.com', 'jan lang', '../uploads/641036686_122127711027031022_2444491109043114238_n.jpg', 'Pending', '2026-03-11 13:35:05'),
(2, 'Victor', '2026-03-11', 'Business', '912345678', 'shyyiieee@gmail.com', 'jan lang', '../uploads/643844916_1323813506450311_2001420156542579866_n.jpg', 'Pending', '2026-03-11 14:03:50');

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
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ids`
--

INSERT INTO `ids` (`id`, `fullname`, `birthdate`, `id_type`, `purpose`, `phone`, `email`, `address`, `attachment`, `status`, `submitted_at`) VALUES
(1, 'morales, abigail c.', '2026-03-11', 'pwd', 'Business', '912345678', 'moralesabigail038@gmail.com', 'Blk 3 Lakas Bisig', '../uploads/png.png', 'Pending', '2026-03-11 14:05:14');

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
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'Jerome Dulla', NULL, 'BPSO', '09999999999', 'jbdulla@gmail.com', 'jbdulla', '12345', 'active', '2026-03-08 10:56:56', '1772967416_69ad55f801e0b.png', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `reset_id` int(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `profile_pic` varchar(255) DEFAULT 'UserIcon.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `residents`
--

INSERT INTO `residents` (`resident_id`, `name`, `sex`, `birthdate`, `contact_number`, `email`, `address`, `username`, `password`, `status`, `created_at`, `proof_file`, `id_number`, `profile_pic`) VALUES
(1, 'joshuaisla', 'Male', '2026-03-01', '91995990881', 'joshuaisla@gmail.com', 'jan lang', 'joshieee', '123', 'pending', '2026-03-09 15:16:30', '1773069390_69aee44e7a52b.jpg', '1231231234', '1773235879_2966c5eb-0a23-4c86-959e-cd7b8c222210.jpg'),
(2, 'chester kyle', 'Male', '2026-03-03', '09123456789', 'ckd@gmail.com', 'jan lang', 'ckd', '123', 'pending', '2026-03-09 15:38:55', '1773070735_69aee98fc2a6a.jpg', '1234567890', '1773235663_the-biography-of-francisco-balagtas.jpg');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `clearance_permits`
--
ALTER TABLE `clearance_permits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ids`
--
ALTER TABLE `ids`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `legal_reports`
--
ALTER TABLE `legal_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `officials`
--
ALTER TABLE `officials`
  MODIFY `official_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `reset_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `residents`
--
ALTER TABLE `residents`
  MODIFY `resident_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
