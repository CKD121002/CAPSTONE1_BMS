-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2026 at 09:58 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `clock_in` time DEFAULT NULL,
  `clock_out` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `username`, `date`, `clock_in`, `clock_out`) VALUES
(1, 'rlicup', '2026-03-11', '21:52:26', NULL),
(2, 'rlicup', '2026-03-11', '21:55:05', NULL),
(3, 'rlicup', '2026-03-11', '21:55:06', NULL),
(4, 'rlicup', '2026-03-11', '21:55:06', NULL),
(5, 'rlicup', '2026-03-11', '21:55:06', NULL),
(6, 'rlicup', '2026-03-11', '21:55:06', NULL),
(7, 'rlicup', '2026-03-11', '21:55:07', NULL),
(8, 'rlicup', '2026-03-11', '21:55:07', NULL),
(9, 'rlicup', '2026-03-11', '21:55:07', NULL),
(10, 'rlicup', '2026-03-11', '21:55:07', NULL),
(11, 'rlicup', '2026-03-11', '21:55:07', NULL),
(12, 'rlicup', '2026-03-11', '21:55:07', NULL),
(13, 'rlicup', '2026-03-11', '21:55:08', NULL),
(14, 'rlicup', '2026-03-11', '21:55:08', NULL);

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
  `id` int(11) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `name` varchar(150) NOT NULL,
  `position` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `date_added` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `officials`
--

INSERT INTO `officials` (`id`, `picture`, `name`, `position`, `description`, `date_added`) VALUES
(3, '', 'Jovita F. Nakpil', 'Kagawad', 'Barangay Councilor', '2026-03-04'),
(4, '', 'Jesus L. De Guzman', 'Kagawad', 'Barangay Councilor', '2026-03-04'),
(5, '', 'Edilberto F. Caidic, Jr.', 'Kagawad', 'Barangay Councilor', '2026-03-04'),
(6, '', 'Arturo A. Santos', 'Kagawad', 'Barangay Councilor', '2026-03-04'),
(7, '', 'Socorro C. Generalao', 'Kagawad', 'Barangay Councilor', '2026-03-04'),
(8, '', 'Roberto C. Santos', 'Kagawad', 'Barangay Councilor', '2026-03-04'),
(9, '', 'Ana Liza V. Francisco', 'Kagawad', 'Barangay Councilor', '2026-03-04'),
(10, '', 'Gerardo Angel T. Flores', 'Kalihim', 'Barangay Secretary', '2026-03-04'),
(11, '', 'Eric A. Olermo', 'Ingat-Yaman', 'Barangay Treasurer', '2026-03-04'),
(12, '', 'Lenin Karl V. Cope', 'Tagapangulo ng SK', 'SK Chairman', '2026-03-04'),
(13, '', 'Vennie B. Daus', 'SK Kagawad', 'SK Councilor', '2026-03-04'),
(14, '', 'Alyzzandra R. De Guzman', 'SK Kagawad', 'SK Councilor', '2026-03-04'),
(15, '', 'Jershey Villanueva', 'SK Kagawad', 'SK Councilor', '2026-03-04'),
(16, '', 'David Nikko Carcosia', 'SK Kagawad', 'SK Councilor', '2026-03-04'),
(17, '', 'Eliazar A. Sioscon', 'SK Kagawad', 'SK Councilor', '2026-03-04'),
(18, '', 'Camilo Neo F. Roxas', 'SK Kagawad', 'SK Councilor', '2026-03-04'),
(19, 'kap.jpg', 'Arch’t Ricardo S. Licup, Jr.', 'Punong Barangay', 'asdasd', '2026-03-04');

-- --------------------------------------------------------

--
-- Table structure for table `residents`
--

CREATE TABLE `residents` (
  `id` int(11) NOT NULL,
  `fullname` varchar(150) NOT NULL,
  `address` varchar(200) NOT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `civil_status` enum('Single','Married','Widowed','Separated') DEFAULT NULL,
  `satellite` enum('Balanti','Halang','Karangalan','Brookside','Greenpark') DEFAULT NULL,
  `maintenance_status` enum('Needs Maintenance','No Maintenance') DEFAULT 'No Maintenance',
  `status` enum('Pending','Approved','Declined') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `residents`
--

INSERT INTO `residents` (`id`, `fullname`, `address`, `gender`, `age`, `civil_status`, `satellite`, `maintenance_status`, `status`, `created_at`) VALUES
(1, 'Juan Dela Cruz', 'San Isidro, Satellite 1', NULL, NULL, NULL, 'Balanti', 'Needs Maintenance', 'Pending', '2026-03-11 10:26:20'),
(2, 'Maria Santos', 'San Isidro, Satellite 2', NULL, NULL, NULL, 'Halang', 'Needs Maintenance', 'Approved', '2026-03-11 10:26:20'),
(3, 'Pedro Reyes', 'San Isidro, Satellite 3', NULL, NULL, NULL, 'Karangalan', 'Needs Maintenance', 'Declined', '2026-03-11 10:26:20'),
(4, 'Ana Lopez', 'San Isidro, Satellite 4', NULL, NULL, NULL, 'Brookside', 'Needs Maintenance', 'Pending', '2026-03-11 10:26:20'),
(5, 'Jose Ramos', 'San Isidro, Satellite 5', NULL, NULL, NULL, 'Greenpark', 'Needs Maintenance', 'Approved', '2026-03-11 10:26:20'),
(6, 'Carlos Mendoza', 'San Isidro, Satellite 1', NULL, NULL, NULL, 'Balanti', 'Needs Maintenance', 'Pending', '2026-03-11 10:26:20'),
(7, 'Angela Cruz', 'San Isidro, Satellite 2', NULL, NULL, NULL, 'Halang', 'No Maintenance', 'Approved', '2026-03-11 10:26:20'),
(8, 'Mark Villanueva', 'San Isidro, Satellite 3', NULL, NULL, NULL, 'Karangalan', 'No Maintenance', 'Pending', '2026-03-11 10:26:20'),
(9, 'Liza Bautista', 'San Isidro, Satellite 4', NULL, NULL, NULL, 'Brookside', 'No Maintenance', 'Declined', '2026-03-11 10:26:20'),
(10, 'Rafael Torres', 'San Isidro, Satellite 5', NULL, NULL, NULL, 'Greenpark', 'No Maintenance', 'Pending', '2026-03-11 10:26:20'),
(11, 'Daniel Flores', 'San Isidro, Satellite 1', NULL, NULL, NULL, 'Balanti', 'No Maintenance', 'Approved', '2026-03-11 10:26:20'),
(12, 'Grace Navarro', 'San Isidro, Satellite 2', NULL, NULL, NULL, 'Halang', 'No Maintenance', 'Pending', '2026-03-11 10:26:20'),
(13, 'Kevin Castillo', 'San Isidro, Satellite 3', NULL, NULL, NULL, 'Karangalan', 'No Maintenance', 'Approved', '2026-03-11 10:26:20'),
(14, 'Janine Perez', 'San Isidro, Satellite 4', NULL, NULL, NULL, 'Brookside', 'No Maintenance', 'Pending', '2026-03-11 10:26:20'),
(15, 'Robert Garcia', 'San Isidro, Satellite 5', NULL, NULL, NULL, 'Greenpark', 'No Maintenance', 'Declined', '2026-03-11 10:26:20');

-- --------------------------------------------------------

--
-- Table structure for table `resident_medicine`
--

CREATE TABLE `resident_medicine` (
  `id` int(11) NOT NULL,
  `resident_id` int(11) NOT NULL,
  `medicine_name` varchar(150) NOT NULL,
  `dosage` varchar(100) DEFAULT NULL,
  `quantity_given` int(11) DEFAULT 0,
  `quantity_remaining` int(11) DEFAULT 0,
  `refill_threshold` int(11) DEFAULT 0,
  `last_given` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resident_medicine`
--

INSERT INTO `resident_medicine` (`id`, `resident_id`, `medicine_name`, `dosage`, `quantity_given`, `quantity_remaining`, `refill_threshold`, `last_given`) VALUES
(1, 7, 'Amlodipine 5mg', '100', 11, 1, 1, '2026-03-12'),
(2, 7, 'Amlodipine 5mg', '100', 11, 1, 1, '2026-03-12'),
(3, 11, 'Amlodipine 5mg', '100', 11, 1, 5, '2026-03-12'),
(4, 2, 'Amlodipine 5mg', '100', 100, 100, 1, '2026-03-10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('Admin','Staff') DEFAULT 'Staff'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `username`, `password`, `role`) VALUES
(1, 'Administrator', 'admin', '0192023a7bbd73250516f069df18b500', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `officials`
--
ALTER TABLE `officials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `residents`
--
ALTER TABLE `residents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resident_medicine`
--
ALTER TABLE `resident_medicine`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resident_id` (`resident_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `officials`
--
ALTER TABLE `officials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `residents`
--
ALTER TABLE `residents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `resident_medicine`
--
ALTER TABLE `resident_medicine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `resident_medicine`
--
ALTER TABLE `resident_medicine`
  ADD CONSTRAINT `resident_medicine_ibfk_1` FOREIGN KEY (`resident_id`) REFERENCES `residents` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
