-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2024 at 04:01 AM
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
-- Database: `brgyhealthsched_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_access`
--

CREATE TABLE `tbl_admin_access` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin_access`
--

INSERT INTO `tbl_admin_access` (`id`, `fullname`, `username`, `password`) VALUES
(1, 'VasHCon', 'admin', 'admin'),
(5, 'Kristel', 'Pedrano', 'password');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_findings`
--

CREATE TABLE `tbl_findings` (
  `id` int(11) NOT NULL,
  `patient_id_fk` varchar(255) NOT NULL,
  `history_id_fk` varchar(255) NOT NULL,
  `cho_schedule` varchar(255) NOT NULL,
  `name_of_attending_provider` varchar(255) NOT NULL,
  `nature_of_visit` varchar(255) NOT NULL,
  `type_of_consultation` varchar(255) NOT NULL,
  `diagnosis` varchar(255) NOT NULL,
  `medication` varchar(255) NOT NULL,
  `laboratory_findings` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_history`
--

CREATE TABLE `tbl_history` (
  `id` int(11) NOT NULL,
  `patient_id_fk` varchar(255) NOT NULL,
  `history_ids` varchar(255) NOT NULL,
  `date` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `created_by` varchar(255) NOT NULL,
  `last_update` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_history`
--

INSERT INTO `tbl_history` (`id`, `patient_id_fk`, `history_ids`, `date`, `created_by`, `last_update`) VALUES
(12, 'PATIENTNUM-512DADA4F214', 'HISTORY-39772', '2024-10-03 11:58:47.000000', 'VasHCon', '2024-10-12 10:33:10.000000'),
(14, 'PATIENTNUM-232C6950446D', 'HISTORY-DB926', '2024-10-15 01:11:34.000000', 'VasHCon', '2024-10-15 01:11:34.000000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patient_info`
--

CREATE TABLE `tbl_patient_info` (
  `id` int(11) NOT NULL,
  `patient_id` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `birthdate` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `civil_status` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_patient_info`
--

INSERT INTO `tbl_patient_info` (`id`, `patient_id`, `fname`, `mname`, `lname`, `birthdate`, `age`, `address`, `phone_number`, `civil_status`, `sex`) VALUES
(14, 'PATIENTNUM-512DADA4F214', 'muzans', 'nezoko', 'tanjiro', '2003-10-10', '22', 'Dumaguete City, Negros Oriental', '092774523432', 'Divorced', 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vital_sign`
--

CREATE TABLE `tbl_vital_sign` (
  `id` int(11) NOT NULL,
  `patient_id_fk` varchar(255) NOT NULL,
  `history_id_fk` varchar(255) NOT NULL,
  `blood_pressure` varchar(10) NOT NULL,
  `temperature` float NOT NULL,
  `pulse_rate` int(10) NOT NULL,
  `respiratory_rate` int(10) NOT NULL,
  `weight` float NOT NULL,
  `height` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_vital_sign`
--

INSERT INTO `tbl_vital_sign` (`id`, `patient_id_fk`, `history_id_fk`, `blood_pressure`, `temperature`, `pulse_rate`, `respiratory_rate`, `weight`, `height`) VALUES
(12, 'PATIENTNUM-512DADA4F214', 'HISTORY-39772', '90/80', 45, 24, 45, 54, 5.7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin_access`
--
ALTER TABLE `tbl_admin_access`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fullname` (`fullname`);

--
-- Indexes for table `tbl_findings`
--
ALTER TABLE `tbl_findings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id_fk` (`patient_id_fk`),
  ADD KEY `history_id_fk` (`history_id_fk`);

--
-- Indexes for table `tbl_history`
--
ALTER TABLE `tbl_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id_fk` (`patient_id_fk`),
  ADD KEY `history_ids` (`history_ids`);

--
-- Indexes for table `tbl_patient_info`
--
ALTER TABLE `tbl_patient_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `patient_id` (`patient_id`);

--
-- Indexes for table `tbl_vital_sign`
--
ALTER TABLE `tbl_vital_sign`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pateint_id_fk` (`patient_id_fk`),
  ADD KEY `history_id_fk` (`history_id_fk`),
  ADD KEY `history_id_fk_2` (`history_id_fk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin_access`
--
ALTER TABLE `tbl_admin_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_findings`
--
ALTER TABLE `tbl_findings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_history`
--
ALTER TABLE `tbl_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_patient_info`
--
ALTER TABLE `tbl_patient_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_vital_sign`
--
ALTER TABLE `tbl_vital_sign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_findings`
--
ALTER TABLE `tbl_findings`
  ADD CONSTRAINT `findings_after_vitalsigns` FOREIGN KEY (`patient_id_fk`) REFERENCES `tbl_vital_sign` (`patient_id_fk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `history` FOREIGN KEY (`history_id_fk`) REFERENCES `tbl_history` (`history_ids`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_vital_sign`
--
ALTER TABLE `tbl_vital_sign`
  ADD CONSTRAINT `pateints_vitals` FOREIGN KEY (`patient_id_fk`) REFERENCES `tbl_patient_info` (`patient_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vital_history` FOREIGN KEY (`history_id_fk`) REFERENCES `tbl_history` (`history_ids`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
