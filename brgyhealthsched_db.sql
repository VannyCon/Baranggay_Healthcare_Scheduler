-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2024 at 01:21 PM
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
  `nature_of_visit` varchar(255) NOT NULL,
  `type_of_consultation` varchar(255) NOT NULL,
  `diagnosis` varchar(255) NOT NULL,
  `medication` varchar(255) NOT NULL,
  `laboratory_findings` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_findings`
--

INSERT INTO `tbl_findings` (`id`, `patient_id_fk`, `history_id_fk`, `refferal_for`, `cho_schedule`, `name_of_attending_provider`, `nature_of_visit`, `type_of_consultation`, `diagnosis`, `medication`, `laboratory_findings`) VALUES
(21, 'PATIENTNUM-E06D40E6DC68', 'HISTORY-D4E22', 'DP', '2024-11-19T15:42', 'asdsa', 'asdasd', 'sadsad', 'asdasd', 'asdasd', 'asdasd'),
(22, 'PATIENTNUM-E06D40E6DC68', 'HISTORY-57AF7', 'PR', '2024-11-19T15:47', 'asdfdasf', 'asdf', 'asdf', 'asdf', 'asdf', 'asdf'),
(23, 'PATIENTNUM-043F62213CC4', 'HISTORY-0486A', 'PR', '2024-11-21T09:31', 'John Doe', 'Consulattion', 'Heart Check-ups', 'Health be at peace', 'Biogesic', 'All Goods'),
(24, 'PATIENTNUM-043F62213CC4', 'HISTORY-2AB84', 'PR', '2024-11-21T09:34', 'Johnny Deep', 'Vaccination', 'Heart Check-ups', 'Rabies', 'Amoxceciline', 'Heart Issues\r\n'),
(25, 'PATIENTNUM-00D09899F0FD', 'HISTORY-5F417', 'PR', '2024-11-21T10:58', 'sd', 'sd', 'sd', ' sd', 'sd', 'sd'),
(26, 'PATIENTNUM-00D09899F0FD', 'HISTORY-B3F39', 'PR', '2024-11-21T11:15', 's', 's', 's', 's', 'sss', 's'),
(27, 'PATIENTNUM-E06D40E6DC68', 'HISTORY-3F171', 'PR', '2024-11-27T07:49', 'sad', 'asdasd', 'sdsds', '', '', ''),
(28, 'PATIENTNUM-E06D40E6DC68', 'HISTORY-0D4B1', 'CPS', '2024-11-28T20:10', '123', '123', '123', '', '', ''),
(29, 'PATIENTNUM-E06D40E6DC68', 'HISTORY-4506E', 'BMC', '2024-11-28T20:14', '23', '23', 'df', '', '', ''),
(30, 'PATIENTNUM-940674F8DFD5', 'HISTORY-DFAAA', 'TBC', '2024-11-28T21:10', 'asd', 'as', 'sss', '', '', '');

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
(25, 'PATIENTNUM-043F62213CC4', 'HISTORY-0486A', '2024-11-21 01:32:48.000000', 'VasHCon', '2024-11-28 11:39:55.213462'),
(26, 'PATIENTNUM-043F62213CC4', 'HISTORY-2AB84', '2024-11-21 01:35:06.000000', 'VasHCon', '2024-11-28 11:39:59.822754'),
(27, 'PATIENTNUM-00D09899F0FD', 'HISTORY-5F417', '2024-11-21 03:07:35.000000', 'VasHCon', '2024-11-28 11:40:07.525951'),
(28, 'PATIENTNUM-00D09899F0FD', 'HISTORY-B3F39', '2024-11-21 03:15:50.000000', 'VasHCon', '2024-11-28 11:40:12.126609'),
(29, 'PATIENTNUM-E06D40E6DC68', 'HISTORY-3F171', '2024-11-26 23:49:43.000000', 'VasHCon', '2024-11-28 11:40:14.175917'),
(30, 'PATIENTNUM-E06D40E6DC68', 'HISTORY-0D4B1', '2024-11-28 12:11:04.000000', 'VasHCon', '2024-11-28 12:13:28.000000'),
(31, 'PATIENTNUM-E06D40E6DC68', 'HISTORY-4506E', '2024-11-28 12:14:17.000000', 'VasHCon', '2024-11-28 12:14:17.000000'),
(32, 'PATIENTNUM-940674F8DFD5', 'HISTORY-DFAAA', '2024-11-28 13:10:23.000000', 'VasHCon', '2024-11-28 13:10:23.000000');

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
  `purok` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `civil_status` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_patient_info`
--

INSERT INTO `tbl_patient_info` (`id`, `patient_id`, `fname`, `mname`, `lname`, `birthdate`, `age`, `purok`, `address`, `phone_number`, `civil_status`, `sex`) VALUES
(17, 'PATIENTNUM-E06D40E6DC68', 'User2', 'M.', 'Lasr', '2001-11-19', '20', 'Prk. Napungalan 1 Brgy. JonobJonob Escalante City Negros Occidental', 'sdf', '09176358646', 'Married', 'Male'),
(18, 'PATIENTNUM-043F62213CC4', 'Kristels434', 'Bugasansss', 'Pedranosss', '2005-04-12', '18', 'Prk. Napungalan 1 Brgy. JonobJonob Escalante City Negros Occidental', 'Sagay City', '09054805560', 'Single', 'Male'),
(19, 'PATIENTNUM-00D09899F0FD', 'chaira', 'm', 'finals', '2014-06-28', '21', 'Prk. Napungalan 1 Brgy. JonobJonob Escalante City Negros Occidental', 'Sagay City, Negros Occidental', '09076518095', 'Single', 'Female'),
(20, 'PATIENTNUM-940674F8DFD5', 'Kudo', 'San', 'Dugo', '2000-09-02', '24', 'Prk. Mahogany Brgy. JonobJonob Escalante City Negros Occidental', 'bangga Streeet', '0923245123', 'Single', 'Female');

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
(23, 'PATIENTNUM-E06D40E6DC68', 'HISTORY-D4E22', 'asd', 243, 23, 23, 2, 3),
(24, 'PATIENTNUM-E06D40E6DC68', 'HISTORY-57AF7', '23', 232, 23, 23, 23, 23),
(25, 'PATIENTNUM-043F62213CC4', 'HISTORY-0486A', '90/100', 87, 110, 24, 45, 164),
(26, 'PATIENTNUM-043F62213CC4', 'HISTORY-2AB84', '80/110', 76, 90, 63, 58, 155),
(27, 'PATIENTNUM-00D09899F0FD', 'HISTORY-5F417', '120/80', 37, 80, 67, 45, 57),
(28, 'PATIENTNUM-00D09899F0FD', 'HISTORY-B3F39', '1', 1111, 111, 1, 111, 1),
(29, 'PATIENTNUM-E06D40E6DC68', 'HISTORY-3F171', '120/80', 23, 24, 42, 23, 43),
(30, 'PATIENTNUM-E06D40E6DC68', 'HISTORY-0D4B1', '123', 123, 123, 123, 123, 123),
(31, 'PATIENTNUM-E06D40E6DC68', 'HISTORY-4506E', '9', 9, 9, 9, 9, 9),
(32, 'PATIENTNUM-940674F8DFD5', 'HISTORY-DFAAA', '98/98', 98, 98, 98, 98, 98);

-- --------------------------------------------------------

--
-- Structure for view `referral_summary`
--
DROP TABLE IF EXISTS `referral_summary`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `referral_summary`  AS SELECT CASE `f`.`refferal_for` WHEN 'DP' THEN 'Dengue Prevention and Management' WHEN 'PR' THEN 'Prenatal Referral' WHEN 'IP' THEN 'Immunization Programs' WHEN 'MCH' THEN 'Maternal and Child Health Services' WHEN 'NP' THEN 'Nutrition Programs' WHEN 'HE' THEN 'Health Education' WHEN 'BMC' THEN 'Basic Medical Consultations' WHEN 'EHC' THEN 'Environmental Health Campaigns' WHEN 'TBC' THEN 'Tuberculosis Control' WHEN 'EFA' THEN 'Emergency and First Aid Services' WHEN 'LP' THEN 'Livelihood Programs' WHEN 'DPD' THEN 'Disaster Preparedness' WHEN 'CBR' THEN 'Community-Based Rehabilitation' WHEN 'SCP' THEN 'Senior Citizen and PWD Assistance' WHEN 'MHS' THEN 'Mental Health Support' WHEN 'CPS' THEN 'Child Protection Services' ELSE 'Unknown' END AS `service_name`, count(0) AS `total_count` FROM (`tbl_findings` `f` join `tbl_history` `h` on(`f`.`history_id_fk` = `h`.`history_ids`)) WHERE year(`h`.`date`) = year(curdate()) GROUP BY `f`.`refferal_for` ;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_history`
--
ALTER TABLE `tbl_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tbl_patient_info`
--
ALTER TABLE `tbl_patient_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_vital_sign`
--
ALTER TABLE `tbl_vital_sign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

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
