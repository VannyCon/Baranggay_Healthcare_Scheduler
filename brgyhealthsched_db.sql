-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2024 at 12:05 PM
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
-- Stand-in structure for view `referral_summary`
-- (See below for the actual view)
--
CREATE TABLE `referral_summary` (
`service_name` varchar(34)
,`total_count` bigint(21)
);

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
  `refferal_for` varchar(255) NOT NULL,
  `cho_schedule` varchar(255) NOT NULL,
  `name_of_attending_provider` varchar(255) NOT NULL,
  `type_of_consultation` varchar(255) NOT NULL,
  `diagnosis` varchar(255) NOT NULL,
  `medication` varchar(255) NOT NULL,
  `laboratory_findings` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_findings`
--

INSERT INTO `tbl_findings` (`id`, `patient_id_fk`, `history_id_fk`, `refferal_for`, `cho_schedule`, `name_of_attending_provider`, `type_of_consultation`, `diagnosis`, `medication`, `laboratory_findings`) VALUES
(40, 'PATIENTNUM-49FD510CB09D', 'HISTORY-15CD5', 'HE', '2024-12-11T06:54', 'Ms. Tessie Cuanan M.D', 'consulationsss', 'Tuberculosis', 'Mefenamic', 'TB'),
(41, 'PATIENTNUM-D725C3A35AC0', 'HISTORY-DC414', 'NP', '2024-12-11T07:20', 'Ms. Tessie Cuanan M.D', 'Walk In', 'Vomiting', 'Loperamide', 'Boomiting'),
(42, 'PATIENTNUM-D5841E679304', 'HISTORY-485B8', 'SCP', '2024-12-26T18:57', 'Ms. Tessie Cuanan M.D', 'Walking', 'Influenza', 'aaa', 'aaa'),
(43, 'PATIENTNUM-6F1792739ECB', 'HISTORY-45422', 'EFA', '2024-12-26T18:57', 'Ms. Tessie Cuanan M.D', 'Walking', 'Diabetes', 'aaa', 'aaa'),
(44, 'PATIENTNUM-04E81F886848', 'HISTORY-F1D8F', 'EFA', '2024-12-26T18:57', 'Ms. Tessie Cuanan M.D', 'Walking', 'Tuberculosis', 'aaa', 'aaa'),
(45, 'PATIENTNUM-40CF9FC99627', 'HISTORY-491F9', 'IP', '2024-12-26T18:57', 'Ms. Tessie Cuanan M.D', 'Walking', 'Hypertension', 'aaa', 'aaa'),
(46, 'PATIENTNUM-DD2823565EE2', 'HISTORY-5F7AD', 'IP', '2024-12-26T18:57', 'Ms. Tessie Cuanan M.D', 'Walking', 'Vomiting', 'aaa', 'aaa'),
(47, 'PATIENTNUM-ABBEDE1D2CF7', 'HISTORY-C78D2', 'IP', '2024-12-26T18:57', 'Ms. Tessie Cuanan M.D', 'Walking', 'Asthma', 'aaa', 'aaa'),
(48, 'PATIENTNUM-F2154F68EA2D', 'HISTORY-D86D3', 'IP', '2024-12-26T18:57', 'Ms. Tessie Cuanan M.D', 'Walking', 'Tuberculosis', 'aaa', 'aaa');

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
(14, 'PATIENTNUM-232C6950446D', 'HISTORY-DB926', '2024-10-15 01:11:34.000000', 'VasHCon', '2024-11-28 11:39:39.872467'),
(23, 'PATIENTNUM-E06D40E6DC68', 'HISTORY-D4E22', '2024-11-19 07:42:11.000000', 'VasHCon', '2024-11-28 11:39:44.631686'),
(24, 'PATIENTNUM-E06D40E6DC68', 'HISTORY-57AF7', '2024-11-19 07:47:22.000000', 'VasHCon', '2024-11-28 11:39:50.916050'),
(27, 'PATIENTNUM-00D09899F0FD', 'HISTORY-5F417', '2024-11-21 03:07:35.000000', 'VasHCon', '2024-11-28 11:40:07.525951'),
(28, 'PATIENTNUM-00D09899F0FD', 'HISTORY-B3F39', '2024-11-21 03:15:50.000000', 'VasHCon', '2024-11-28 11:40:12.126609'),
(29, 'PATIENTNUM-E06D40E6DC68', 'HISTORY-3F171', '2024-11-26 23:49:43.000000', 'VasHCon', '2024-11-28 11:40:14.175917'),
(30, 'PATIENTNUM-E06D40E6DC68', 'HISTORY-0D4B1', '2024-11-28 12:11:04.000000', 'VasHCon', '2024-11-28 12:13:28.000000'),
(31, 'PATIENTNUM-E06D40E6DC68', 'HISTORY-4506E', '2024-11-28 12:14:17.000000', 'VasHCon', '2024-11-28 12:14:17.000000'),
(32, 'PATIENTNUM-940674F8DFD5', 'HISTORY-DFAAA', '2024-11-28 13:10:23.000000', 'VasHCon', '2024-11-28 13:10:23.000000'),
(33, 'PATIENTNUM-3D40B6FE70E0', 'HISTORY-1F34F', '2024-12-06 02:03:22.000000', 'VasHCon', '2024-12-06 02:03:22.000000'),
(34, 'PATIENTNUM-C375DCB50147', 'HISTORY-9C910', '2024-12-06 02:23:07.000000', 'VasHCon', '2024-12-06 02:46:49.000000'),
(35, 'PATIENTNUM-67EB07E39549', 'HISTORY-8FF50', '2024-12-07 14:35:49.000000', 'VasHCon', '2024-12-07 14:35:49.000000'),
(36, 'PATIENTNUM-8365A6DE285F', 'HISTORY-CE6B0', '2024-12-07 14:36:15.000000', 'VasHCon', '2024-12-07 14:36:15.000000'),
(37, 'PATIENTNUM-2795A4FAFB36', 'HISTORY-C0581', '2024-12-07 14:39:24.000000', 'VasHCon', '2024-12-07 15:19:51.000000'),
(38, 'PATIENTNUM-F760B9572B05', 'HISTORY-1C616', '2024-12-07 15:23:07.000000', 'VasHCon', '2024-12-07 15:23:07.000000'),
(39, 'PATIENTNUM-D4FCA317D07F', 'HISTORY-C33FE', '2024-12-07 15:43:28.000000', 'VasHCon', '2024-12-07 15:43:28.000000'),
(40, 'PATIENTNUM-652A4B8068F8', 'HISTORY-8842B', '2024-12-10 13:57:52.000000', 'VasHCon', '2024-12-10 13:57:52.000000'),
(41, 'PATIENTNUM-2D0ECD619183', 'HISTORY-E26B4', '2024-12-10 22:31:02.000000', 'VasHCon', '2024-12-10 22:31:02.000000'),
(42, 'PATIENTNUM-49FD510CB09D', 'HISTORY-15CD5', '2024-12-10 23:01:01.000000', 'VasHCon', '2024-12-10 23:01:01.000000'),
(43, 'PATIENTNUM-D725C3A35AC0', 'HISTORY-DC414', '2024-12-10 23:21:22.000000', 'VasHCon', '2024-12-10 23:21:22.000000'),
(44, 'PATIENTNUM-D5841E679304', 'HISTORY-485B8', '2024-12-11 10:58:06.000000', 'VasHCon', '2024-12-11 10:58:06.000000'),
(45, 'PATIENTNUM-6F1792739ECB', 'HISTORY-45422', '2024-12-11 10:58:43.000000', 'VasHCon', '2024-12-11 10:58:43.000000'),
(46, 'PATIENTNUM-04E81F886848', 'HISTORY-F1D8F', '2024-12-11 10:59:12.000000', 'VasHCon', '2024-12-11 10:59:12.000000'),
(47, 'PATIENTNUM-40CF9FC99627', 'HISTORY-491F9', '2024-12-11 10:59:34.000000', 'VasHCon', '2024-12-11 10:59:34.000000'),
(48, 'PATIENTNUM-DD2823565EE2', 'HISTORY-5F7AD', '2024-12-11 11:00:27.000000', 'VasHCon', '2024-12-11 11:00:27.000000'),
(49, 'PATIENTNUM-ABBEDE1D2CF7', 'HISTORY-C78D2', '2024-12-11 11:00:50.000000', 'VasHCon', '2024-12-11 11:00:50.000000'),
(50, 'PATIENTNUM-F2154F68EA2D', 'HISTORY-D86D3', '2024-12-11 11:01:34.000000', 'VasHCon', '2024-12-11 11:01:34.000000');

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
  `purok` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `civil_status` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `religion` varchar(255) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `guardian` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_patient_info`
--

INSERT INTO `tbl_patient_info` (`id`, `patient_id`, `fname`, `mname`, `lname`, `birthdate`, `purok`, `address`, `phone_number`, `civil_status`, `sex`, `religion`, `occupation`, `guardian`) VALUES
(30, 'PATIENTNUM-49FD510CB09D', 'John', 'R.', 'Lorie', '2009-08-04', 'Prk. Napungalan 1', 'Negros Occidental,Escalante City,Brgy. JonobJonob', '09054805560', 'Single', 'Male', 'Catholics', 'Carpenters', 'Marie Theresitaxz'),
(31, 'PATIENTNUM-D725C3A35AC0', 'Jenny', 'V. ', 'Liza', '2000-09-20', 'Prk. Mahogany', 'Negros Occidental,Escalante City,Brgy. JonobJonob', '09054805560', 'Married', 'Female', 'Catholic', 'House Wifi', ''),
(32, 'PATIENTNUM-D5841E679304', 'Marlyn', 'd.', 'Escares', '2004-09-03', 'Prk. Napungalan 1', 'Negros Occidental,Escalante City,Brgy. JonobJonob', '09054805560', 'Single', 'Female', 'Catholic', 'Carpenter', ''),
(33, 'PATIENTNUM-6F1792739ECB', 'JOnas', 'd.', 'Escares', '2004-06-03', 'Habitat Homes', 'Negros Occidental,Escalante City,Brgy. JonobJonob', '09054805560', 'Single', 'Female', 'Catholic', 'Carpenter', ''),
(34, 'PATIENTNUM-04E81F886848', 'Liam', 'd.', 'Rebica', '2004-06-03', 'Habitat Homes', 'Negros Occidental,Escalante City,Brgy. JonobJonob', '09054805560', 'Single', 'Female', 'Catholic', 'Carpenter', ''),
(35, 'PATIENTNUM-40CF9FC99627', 'David Marj', 'd.', 'Mark', '2004-06-03', 'Habitat Homes', 'Negros Occidental,Escalante City,Brgy. JonobJonob', '09054805560', 'Single', 'Female', 'Catholic', 'Carpenter', ''),
(36, 'PATIENTNUM-DD2823565EE2', 'Jenny', 'd.', 'Sin', '2004-06-03', 'Prk. Napungalan 2', 'Negros Occidental,Escalante City,Brgy. JonobJonob', '09054805560', 'Single', 'Female', 'Catholic', 'Carpenter', ''),
(37, 'PATIENTNUM-ABBEDE1D2CF7', 'Andres', 'd.', 'Celiz', '2004-06-03', 'Prk. Mahogany', 'Negros Occidental,Escalante City,Brgy. JonobJonob', '09054805560', 'Single', 'Female', 'Catholic', 'Carpenter', ''),
(38, 'PATIENTNUM-F2154F68EA2D', 'Marica', 'd.', 'Zils', '2004-06-03', 'Habitat Homes', 'Negros Occidental,Escalante City,Brgy. JonobJonob', '09054805560', 'Single', 'Female', 'Catholic', 'Carpenter', '');

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
(42, 'PATIENTNUM-49FD510CB09D', 'HISTORY-15CD5', '100/100', 50, 60, 70, 80, 5.6),
(43, 'PATIENTNUM-D725C3A35AC0', 'HISTORY-DC414', '90/80', 56, 65, 75, 43, 56),
(44, 'PATIENTNUM-D5841E679304', 'HISTORY-485B8', '120/80', 20, 54, 23, 45, 56),
(45, 'PATIENTNUM-6F1792739ECB', 'HISTORY-45422', '120/80', 20, 54, 23, 45, 56),
(46, 'PATIENTNUM-04E81F886848', 'HISTORY-F1D8F', '120/80', 20, 54, 23, 45, 56),
(47, 'PATIENTNUM-40CF9FC99627', 'HISTORY-491F9', '120/80', 20, 54, 23, 45, 56),
(48, 'PATIENTNUM-DD2823565EE2', 'HISTORY-5F7AD', '120/80', 20, 54, 23, 45, 56),
(49, 'PATIENTNUM-ABBEDE1D2CF7', 'HISTORY-C78D2', '120/80', 20, 54, 23, 45, 56),
(50, 'PATIENTNUM-F2154F68EA2D', 'HISTORY-D86D3', '120/80', 20, 54, 23, 45, 56);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_diagnosis_count`
-- (See below for the actual view)
--
CREATE TABLE `view_diagnosis_count` (
`diagnosis` varchar(255)
,`diagnosis_count` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_patient_diagnosis`
-- (See below for the actual view)
--
CREATE TABLE `view_patient_diagnosis` (
`history_id` int(11)
,`patient_id` varchar(255)
,`history_ids` varchar(255)
,`history_date` timestamp(6)
,`created_by` varchar(255)
,`last_update` timestamp(6)
,`finding_id` int(11)
,`refferal_for` varchar(255)
,`diagnosis` varchar(255)
,`purok` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_purok_count`
-- (See below for the actual view)
--
CREATE TABLE `view_purok_count` (
`purok` varchar(255)
,`purok_count` bigint(21)
);

-- --------------------------------------------------------

--
-- Structure for view `referral_summary`
--
DROP TABLE IF EXISTS `referral_summary`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `referral_summary`  AS SELECT CASE `f`.`refferal_for` WHEN 'DP' THEN 'Dengue Prevention and Management' WHEN 'PR' THEN 'Prenatal Referral' WHEN 'IP' THEN 'Immunization Programs' WHEN 'MCH' THEN 'Maternal and Child Health Services' WHEN 'NP' THEN 'Nutrition Programs' WHEN 'HE' THEN 'Health Education' WHEN 'BMC' THEN 'Basic Medical Consultations' WHEN 'EHC' THEN 'Environmental Health Campaigns' WHEN 'TBC' THEN 'Tuberculosis Control' WHEN 'EFA' THEN 'Emergency and First Aid Services' WHEN 'LP' THEN 'Livelihood Programs' WHEN 'DPD' THEN 'Disaster Preparedness' WHEN 'CBR' THEN 'Community-Based Rehabilitation' WHEN 'SCP' THEN 'Senior Citizen and PWD Assistance' WHEN 'MHS' THEN 'Mental Health Support' WHEN 'CPS' THEN 'Child Protection Services' ELSE 'Unknown' END AS `service_name`, count(0) AS `total_count` FROM (`tbl_findings` `f` join `tbl_history` `h` on(`f`.`history_id_fk` = `h`.`history_ids`)) WHERE year(`h`.`date`) = year(curdate()) GROUP BY `f`.`refferal_for` ;

-- --------------------------------------------------------

--
-- Structure for view `view_diagnosis_count`
--
DROP TABLE IF EXISTS `view_diagnosis_count`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_diagnosis_count`  AS SELECT `f`.`diagnosis` AS `diagnosis`, count(0) AS `diagnosis_count` FROM ((`tbl_history` `h` join `tbl_findings` `f` on(`h`.`history_ids` = `f`.`history_id_fk`)) join `tbl_patient_info` `p` on(`h`.`patient_id_fk` = `p`.`patient_id`)) GROUP BY `f`.`diagnosis` ;

-- --------------------------------------------------------

--
-- Structure for view `view_patient_diagnosis`
--
DROP TABLE IF EXISTS `view_patient_diagnosis`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_patient_diagnosis`  AS SELECT `h`.`id` AS `history_id`, `h`.`patient_id_fk` AS `patient_id`, `h`.`history_ids` AS `history_ids`, `h`.`date` AS `history_date`, `h`.`created_by` AS `created_by`, `h`.`last_update` AS `last_update`, `f`.`id` AS `finding_id`, `f`.`refferal_for` AS `refferal_for`, `f`.`diagnosis` AS `diagnosis`, `p`.`purok` AS `purok` FROM ((`tbl_history` `h` join `tbl_findings` `f` on(`h`.`history_ids` = `f`.`history_id_fk`)) join `tbl_patient_info` `p` on(`h`.`patient_id_fk` = `p`.`patient_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_purok_count`
--
DROP TABLE IF EXISTS `view_purok_count`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_purok_count`  AS SELECT `p`.`purok` AS `purok`, count(0) AS `purok_count` FROM ((`tbl_history` `h` join `tbl_findings` `f` on(`h`.`history_ids` = `f`.`history_id_fk`)) join `tbl_patient_info` `p` on(`h`.`patient_id_fk` = `p`.`patient_id`)) GROUP BY `p`.`purok` ;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tbl_history`
--
ALTER TABLE `tbl_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tbl_patient_info`
--
ALTER TABLE `tbl_patient_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tbl_vital_sign`
--
ALTER TABLE `tbl_vital_sign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

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
