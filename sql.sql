-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2025 at 10:58 AM
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
-- Database: `hms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `updationDate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `updationDate`) VALUES
(1, 'khan', 'khan', ''),
(2, 'khan', 'khan123', '');

-- --------------------------------------------------------

--
-- Table structure for table `ambulance_bookings`
--

CREATE TABLE `ambulance_bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `day` date DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `with_doctor` tinyint(1) DEFAULT 0,
  `with_paramedic` tinyint(1) DEFAULT 0,
  `oxygen` tinyint(1) DEFAULT 0,
  `ventilator` tinyint(1) DEFAULT 0,
  `fees` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ambulance_bookings`
--

INSERT INTO `ambulance_bookings` (`id`, `user_id`, `name`, `phone`, `address`, `latitude`, `longitude`, `created_at`, `day`, `type`, `with_doctor`, `with_paramedic`, `oxygen`, `ventilator`, `fees`) VALUES
(3, 5, 'awda', 'wdawd', 'awda', '24.936448', '67.12196666', '2025-07-08 13:58:31', NULL, NULL, 0, 0, 0, 0, 0),
(9, 2, 'awdaw', 'awda', 'wda', '24.9878849', '67.0646253', '2025-07-09 14:29:05', '2025-07-24', 'Neonatal', 1, 1, 1, 1, 11000),
(10, 9, 'wa', 'wda', 'awd', '24.9878952', '67.0646231', '2025-07-10 23:11:48', '2312-12-31', 'Road Advanced', 0, 0, 1, 0, 4500);

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `doctorSpecialization` varchar(255) DEFAULT NULL,
  `doctorId` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `consultancyFees` int(11) DEFAULT NULL,
  `appointmentDate` varchar(255) DEFAULT NULL,
  `appointmentTime` varchar(255) DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT current_timestamp(),
  `userStatus` int(11) DEFAULT NULL,
  `doctorStatus` int(11) DEFAULT NULL,
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `doctorSpecialization`, `doctorId`, `userId`, `consultancyFees`, `appointmentDate`, `appointmentTime`, `postingDate`, `userStatus`, `doctorStatus`, `updationDate`) VALUES
(1, 'ENT', 1, 1, 500, '2024-05-30', '9:15 AM', '2024-05-14 22:42:11', 1, 1, NULL),
(2, 'Endocrinologists', 2, 2, 800, '2024-05-31', '2:45 PM', '2024-05-16 04:08:54', 0, 1, '2025-07-05 09:26:53'),
(3, 'Internal Medicine', 0, 2, 0, '2025-08-05', '2:30 PM', '2025-07-05 09:26:34', 1, 1, NULL),
(4, 'ENT', 1, 1, 700, '2025-07-10', '10:00 AM', '2025-07-05 09:37:48', 1, 1, NULL),
(5, 'Pediatrics', 2, 2, 1000, '2025-07-11', '12:30 PM', '2025-07-05 09:37:48', 0, 1, '2025-07-05 09:38:27'),
(6, 'Internal Medicine', 13, 13, 2000, '2025-07-23', '8:30 PM', '2025-07-05 15:17:49', 1, 1, NULL),
(7, 'Obstetrics and Gynecology', 13, 13, 2000, '2025-07-06', '8:30 PM', '2025-07-05 15:20:20', 1, 1, NULL),
(8, 'Orthopedics', 4, 5, 1200, '2025-07-22', '8:30 PM', '2025-07-05 15:26:01', 0, 1, '2025-07-07 15:10:04'),
(9, 'Anesthesia', 12, 5, 5000, '2025-07-29', '9:00 PM', '2025-07-05 16:00:29', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `specilization` varchar(255) DEFAULT NULL,
  `doctorName` varchar(255) DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `docFees` varchar(255) DEFAULT NULL,
  `contactno` bigint(11) DEFAULT NULL,
  `docEmail` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `specilization`, `doctorName`, `address`, `docFees`, `contactno`, `docEmail`, `password`, `creationDate`, `updationDate`) VALUES
(1, 'ENT', 'Dr. Ahmed Khan', 'House #45, G-10/2, Islamabad', '600', 3001234567, 'ahmed.khan@clinic.pk', 'f925916e2754e5e03f75dd58a5733251', '2024-07-05 07:00:00', NULL),
(2, 'Endocrinologists', 'Dr. Saima Malik', 'Flat #12, PECHS Block 2, Karachi', '1000', 3219876543, 'saima.malik@healthcare.pk', 'f925916e2754e5e03f75dd58a5733251', '2024-07-05 07:05:00', NULL),
(3, 'Pediatrics', 'Dr. Hamza Yousaf', 'Street 22, Model Town, Lahore', '800', 3341122334, 'hamza.yousaf@kidsclinic.pk', 'f925916e2754e5e03f75dd58a5733251', '2024-07-05 07:10:00', NULL),
(4, 'Orthopedics', 'Dr. Asma Rehman', 'Main Boulevard, Faisal Town, Lahore', '1200', 3123344556, 'asma.rehman@bonespecialist.pk', 'f925916e2754e5e03f75dd58a5733251', '2024-07-05 07:15:00', NULL),
(5, 'Internal Medicine', 'Dr. Bilal Javed', 'Block D, North Nazimabad, Karachi', '1500', 3456677889, 'bilal.javed@medcare.pk', 'f925916e2754e5e03f75dd58a5733251', '2024-07-05 07:20:00', NULL),
(6, 'Obstetrics and Gynecology', 'Dr. Hira Zahid', 'Street 5, F-8 Markaz, Islamabad', '900', 3339988776, 'hira.zahid@womensclinic.pk', 'f925916e2754e5e03f75dd58a5733251', '2024-07-05 07:25:00', NULL),
(7, 'ENT', 'Dr. Ahmed Ali', 'Lahore Medical Complex', '700', 3001234567, 'ahmed.ali@clinic.pk', 'f925916e2754e5e03f75dd58a5733251', '2025-07-05 09:37:48', NULL),
(8, 'Pediatrics', 'Dr. Sara Khan', 'Children Hospital Karachi', '1000', 3217654321, 'sara.khan@clinic.pk', 'f925916e2754e5e03f75dd58a5733251', '2025-07-05 09:37:48', NULL),
(9, 'Orthopedics', 'Dr. Bilal Iqbal', 'Orthopedic Center Peshawar', '1200', 3334567890, 'bilal.iqbal@clinic.pk', 'f925916e2754e5e03f75dd58a5733251', '2025-07-05 09:37:48', NULL),
(10, 'Cardiology', 'Dr. Farah Mehmood', 'Punjab Heart Center', '1500', 3123456789, 'farah.mehmood@clinic.pk', 'f925916e2754e5e03f75dd58a5733251', '2025-07-05 09:37:48', NULL),
(11, 'Dermatology', 'Dr. Usman Tariq', 'Skin Care Islamabad', '900', 3098765432, 'usman.tariq@clinic.pk', 'f925916e2754e5e03f75dd58a5733251', '2025-07-05 09:37:48', NULL),
(12, 'Anesthesia', 'abdulrehman', 'hkadhw', '5000', 132123, 'wd@gamil.com', '9a09b4dfda82e3e665e31092d1c3ec8d', '2025-07-05 15:15:35', NULL),
(13, 'Obstetrics and Gynecology', 'abdulrehman', 'adwa', '2000', 87588, 'doctor@gmail.com', 'b3666d14ca079417ba6c2a99f079b2ac', '2025-07-05 15:17:18', '2025-07-05 15:18:05'),
(14, 'Neurologists', 'tt', 'tt', '2222', 312123, 'tt@gmail.com', 'ebec2ffdf966af2fece9895324cb4ec6', '2025-07-05 15:28:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `doctorslog`
--

CREATE TABLE `doctorslog` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `userip` binary(16) DEFAULT NULL,
  `loginTime` timestamp NULL DEFAULT current_timestamp(),
  `logout` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `doctorslog`
--

INSERT INTO `doctorslog` (`id`, `uid`, `username`, `userip`, `loginTime`, `logout`, `status`) VALUES
(1, 1, 'ahmed.ali@clinic.pk', 0x3a3a3100000000000000000000000000, '2025-07-05 09:37:48', '2025-07-05 01:30:00 PM', 1),
(2, 2, 'sara.khan@clinic.pk', 0x3a3a3100000000000000000000000000, '2025-07-05 09:37:48', NULL, 1),
(3, 13, 'doctor@gmail.com', 0x3a3a3100000000000000000000000000, '2025-07-05 15:17:29', '05-07-2025 08:53:38 PM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctorspecilization`
--

CREATE TABLE `doctorspecilization` (
  `id` int(11) NOT NULL,
  `specilization` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `doctorspecilization`
--

INSERT INTO `doctorspecilization` (`id`, `specilization`, `creationDate`, `updationDate`) VALUES
(1, 'Orthopedics', '2024-04-09 13:09:46', '2024-05-14 04:26:47'),
(2, 'Internal Medicine', '2024-04-09 13:09:46', '2024-05-14 04:26:56'),
(3, 'Obstetrics and Gynecology', '2024-04-09 13:09:46', '2024-05-14 04:26:56'),
(4, 'Dermatology', '2024-04-09 13:09:46', '2024-05-14 04:26:56'),
(5, 'Pediatrics', '2024-04-09 13:09:46', '2024-05-14 04:26:56'),
(6, 'Radiology', '2024-04-09 13:09:46', '2024-05-14 04:26:56'),
(7, 'General Surgery', '2024-04-09 13:09:46', '2024-05-14 04:26:56'),
(8, 'Ophthalmology', '2024-04-09 13:09:46', '2024-05-14 04:26:56'),
(9, 'Anesthesia', '2024-04-09 13:09:46', '2024-05-14 04:26:56'),
(10, 'Pathology', '2024-04-09 13:09:46', '2024-05-14 04:26:56'),
(11, 'ENT', '2024-04-09 13:09:46', '2024-05-14 04:26:56'),
(12, 'Dental Care', '2024-04-09 13:09:46', '2024-05-14 04:26:56'),
(13, 'Dermatologists', '2024-04-09 13:09:46', '2024-05-14 04:26:56'),
(14, 'Endocrinologists', '2024-04-09 13:09:46', '2024-05-14 04:26:56'),
(15, 'Neurologists', '2024-04-09 13:09:46', '2024-05-14 04:26:56'),
(16, 'Orthopedics', '2024-04-09 13:09:46', '2024-05-14 04:26:47'),
(17, 'Internal Medicine', '2024-04-09 13:09:46', '2024-05-14 04:26:56'),
(18, 'Obstetrics and Gynecology', '2024-04-09 13:09:46', '2024-05-14 04:26:56'),
(19, 'Dermatology', '2024-04-09 13:09:46', '2024-05-14 04:26:56'),
(20, 'Pediatrics', '2024-04-09 13:09:46', '2024-05-14 04:26:56'),
(21, 'Radiology', '2024-04-09 13:09:46', '2024-05-14 04:26:56'),
(22, 'General Surgery', '2024-04-09 13:09:46', '2024-05-14 04:26:56'),
(23, 'Ophthalmology', '2024-04-09 13:09:46', '2024-05-14 04:26:56'),
(24, 'Anesthesia', '2024-04-09 13:09:46', '2024-05-14 04:26:56'),
(25, 'Pathology', '2024-04-09 13:09:46', '2024-05-14 04:26:56'),
(26, 'ENT', '2024-04-09 13:09:46', '2024-05-14 04:26:56'),
(27, 'Dental Care', '2024-04-09 13:09:46', '2024-05-14 04:26:56'),
(28, 'Dermatologists', '2024-04-09 13:09:46', '2024-05-14 04:26:56'),
(29, 'Endocrinologists', '2024-04-09 13:09:46', '2024-05-14 04:26:56'),
(30, 'Neurologists', '2024-04-09 13:09:46', '2024-05-14 04:26:56'),
(31, 'ENT', '2025-07-05 09:37:48', NULL),
(32, 'Pediatrics', '2025-07-05 09:37:48', NULL),
(33, 'Orthopedics', '2025-07-05 09:37:48', NULL),
(34, 'Cardiology', '2025-07-05 09:37:48', NULL),
(35, 'Dermatology', '2025-07-05 09:37:48', NULL),
(36, 'Orthopedics', '2025-07-05 15:27:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblcontactus`
--

CREATE TABLE `tblcontactus` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contactno` bigint(12) DEFAULT NULL,
  `message` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `AdminRemark` mediumtext DEFAULT NULL,
  `LastupdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `IsRead` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblcontactus`
--

INSERT INTO `tblcontactus` (`id`, `fullname`, `email`, `contactno`, `message`, `PostingDate`, `AdminRemark`, `LastupdationDate`, `IsRead`) VALUES
(1, 'Ali Raza', 'ali.raza@mail.com', 3001112233, 'Interested in consulting services.', '2025-07-05 09:37:48', NULL, NULL, NULL),
(2, 'Fatima Noor', 'fatima.noor@mail.com', 3112223344, 'Need appointment for skin issue.', '2025-07-05 09:37:48', NULL, NULL, NULL),
(3, 'Abdulrehman', 'awda@gmail.com', 123123123, 'wda', '2025-07-05 15:05:51', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblmedicalhistory`
--

CREATE TABLE `tblmedicalhistory` (
  `ID` int(10) NOT NULL,
  `PatientID` int(10) DEFAULT NULL,
  `BloodPressure` varchar(200) DEFAULT NULL,
  `BloodSugar` varchar(200) NOT NULL,
  `Weight` varchar(100) DEFAULT NULL,
  `Temperature` varchar(200) DEFAULT NULL,
  `MedicalPres` mediumtext DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblmedicalhistory`
--

INSERT INTO `tblmedicalhistory` (`ID`, `PatientID`, `BloodPressure`, `BloodSugar`, `Weight`, `Temperature`, `MedicalPres`, `CreationDate`) VALUES
(1, 1, '120/80', '95', '58kg', '98.6', 'Panadol, ORS', '2025-07-05 09:37:48'),
(2, 2, '140/90', '110', '72kg', '99', 'Amlodipine 5mg', '2025-07-05 09:37:48');

-- --------------------------------------------------------

--
-- Table structure for table `tblpage`
--

CREATE TABLE `tblpage` (
  `ID` int(10) NOT NULL,
  `PageType` varchar(200) DEFAULT NULL,
  `PageTitle` varchar(200) DEFAULT NULL,
  `PageDescription` mediumtext DEFAULT NULL,
  `Email` varchar(120) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `UpdationDate` timestamp NULL DEFAULT current_timestamp(),
  `OpenningTime` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblpage`
--

INSERT INTO `tblpage` (`ID`, `PageType`, `PageTitle`, `PageDescription`, `Email`, `MobileNumber`, `UpdationDate`, `OpenningTime`) VALUES
(1, 'aboutus', 'About Us', 'This system manages hospital appointments, doctors, patients and their history.', 'support@hospital.pk', 3112233445, '2025-07-05 09:37:48', '9 AM to 6 PM'),
(2, 'contactus', 'Contact Us', 'Hospital Complex, Lahore', 'contact@hospital.pk', 3111122233, '2025-07-05 09:37:48', '9 AM to 8 PM');

-- --------------------------------------------------------

--
-- Table structure for table `tblpatient`
--

CREATE TABLE `tblpatient` (
  `ID` int(10) NOT NULL,
  `Docid` int(10) DEFAULT NULL,
  `PatientName` varchar(200) DEFAULT NULL,
  `PatientContno` bigint(10) DEFAULT NULL,
  `PatientEmail` varchar(200) DEFAULT NULL,
  `PatientGender` varchar(50) DEFAULT NULL,
  `PatientAdd` mediumtext DEFAULT NULL,
  `PatientAge` int(10) DEFAULT NULL,
  `PatientMedhis` mediumtext DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblpatient`
--

INSERT INTO `tblpatient` (`ID`, `Docid`, `PatientName`, `PatientContno`, `PatientEmail`, `PatientGender`, `PatientAdd`, `PatientAge`, `PatientMedhis`, `CreationDate`, `UpdationDate`) VALUES
(1, 1, 'Zainab Fatima', 3123456789, 'zainab.fatima@mail.com', 'female', 'Islamabad', 25, 'Frequent headaches and nausea', '2025-07-05 09:37:48', NULL),
(2, 2, 'Hamza Khan', 3344556677, 'hamza.khan@mail.com', 'male', 'Multan', 30, 'High blood pressure', '2025-07-05 09:37:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `userip` binary(16) DEFAULT NULL,
  `loginTime` timestamp NULL DEFAULT current_timestamp(),
  `logout` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `uid`, `username`, `userip`, `loginTime`, `logout`, `status`) VALUES
(1, NULL, 'abdulrehma@gmail.com', 0x3a3a3100000000000000000000000000, '2025-07-05 09:19:19', NULL, 0),
(2, 2, 'asma@gmail.com', 0x3a3a3100000000000000000000000000, '2025-07-05 09:20:11', NULL, 1),
(3, 1, 'ali.raza@gmail.com', 0x3a3a3100000000000000000000000000, '2025-07-05 09:37:48', NULL, 1),
(4, 2, 'fatima.noor@gmail.com', 0x3a3a3100000000000000000000000000, '2025-07-05 09:37:48', '2025-07-05 02:00:00 PM', 1),
(5, 2, 'asma@gmail.com', 0x3a3a3100000000000000000000000000, '2025-07-05 15:13:23', NULL, 1),
(6, NULL, 'asma@gamil.com', 0x3a3a3100000000000000000000000000, '2025-07-05 15:24:06', NULL, 0),
(7, NULL, 'asma@gamil.com', 0x3a3a3100000000000000000000000000, '2025-07-05 15:24:14', NULL, 0),
(8, 5, 'khan@gmail.com', 0x3a3a3100000000000000000000000000, '2025-07-05 15:24:55', NULL, 1),
(9, NULL, 'tt@gmail.com', 0x3a3a3100000000000000000000000000, '2025-07-05 15:28:12', NULL, 0),
(10, NULL, 'tt@gmail.com', 0x3a3a3100000000000000000000000000, '2025-07-05 15:28:23', NULL, 0),
(11, 5, 'khan@gmail.com', 0x3a3a3100000000000000000000000000, '2025-07-07 15:04:20', NULL, 1),
(12, 5, 'khan@gmail.com', 0x3a3a3100000000000000000000000000, '2025-07-07 15:09:49', NULL, 1),
(13, 5, 'khan@gmail.com', 0x3a3a3100000000000000000000000000, '2025-07-07 15:47:17', NULL, 1),
(14, 5, 'khan@gmail.com', 0x3a3a3100000000000000000000000000, '2025-07-08 08:50:54', '08-07-2025 02:38:27 PM', 1),
(15, 5, 'khan@gmail.com', 0x3a3a3100000000000000000000000000, '2025-07-08 09:24:55', NULL, 1),
(16, NULL, 'khan@gmail.com', 0x3a3a3100000000000000000000000000, '2025-07-09 08:54:02', NULL, 0),
(17, 5, 'khan@gmail.com', 0x3a3a3100000000000000000000000000, '2025-07-09 08:54:08', NULL, 1),
(18, 5, 'khan@gmail.com', 0x3a3a3100000000000000000000000000, '2025-07-09 11:09:05', NULL, 1),
(19, 5, 'khan@gmail.com', 0x3a3a3100000000000000000000000000, '2025-07-09 12:12:25', NULL, 1),
(20, NULL, 'asma@gamil.com', 0x3a3a3100000000000000000000000000, '2025-07-10 18:10:53', NULL, 0),
(21, NULL, 'asma@gamil.com', 0x3a3a3100000000000000000000000000, '2025-07-10 18:11:02', NULL, 0),
(22, 9, 'ss@gamil.com', 0x3a3a3100000000000000000000000000, '2025-07-10 18:11:28', NULL, 1),
(23, NULL, 'ss@gmail.com', 0x3a3a3100000000000000000000000000, '2025-07-10 18:17:07', NULL, 0),
(24, NULL, 'ss@gmail.com', 0x3a3a3100000000000000000000000000, '2025-07-10 18:20:50', NULL, 0),
(25, NULL, 'ss@gmail.com', 0x3a3a3100000000000000000000000000, '2025-07-10 18:20:58', NULL, 0),
(26, 5, 'khan@gmail.com', 0x3a3a3100000000000000000000000000, '2025-07-10 18:21:08', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullName` varchar(255) DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `regDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullName`, `address`, `city`, `gender`, `email`, `password`, `regDate`, `updationDate`) VALUES
(2, 'asma', 'asma', 'asma', 'female', 'asma@gmail.com', 'f93a40ec0518673f1242ab46b844d919', '2025-07-05 09:19:39', NULL),
(3, 'Ali Raza', 'House 12, Street 5, Lahore', 'Lahore', 'male', 'ali.raza@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2025-07-05 09:37:48', NULL),
(5, 'khan', 'khan', 'khan', 'male', 'khan@gmail.com', 'c40a2b3ee16734907faa99cb79effcc2', '2025-07-05 15:24:36', NULL),
(6, 'admin', 'ad', 'wad', 'male', 'admin@gmail.com', 'admin123', '2025-07-08 09:09:23', NULL),
(7, 'admin', 'ad', 'wad', 'male', 'admin@gmail.com', 'admin123', '2025-07-08 09:09:30', NULL),
(9, 'ss', 'ss', 'ss', 'male', 'ss@gamil.com', 'a3026b0a6849f749c489cd798654a809', '2025-07-10 18:11:18', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ambulance_bookings`
--
ALTER TABLE `ambulance_bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctorslog`
--
ALTER TABLE `doctorslog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctorspecilization`
--
ALTER TABLE `doctorspecilization`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcontactus`
--
ALTER TABLE `tblcontactus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblmedicalhistory`
--
ALTER TABLE `tblmedicalhistory`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblpage`
--
ALTER TABLE `tblpage`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblpatient`
--
ALTER TABLE `tblpatient`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ambulance_bookings`
--
ALTER TABLE `ambulance_bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `doctorslog`
--
ALTER TABLE `doctorslog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `doctorspecilization`
--
ALTER TABLE `doctorspecilization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tblcontactus`
--
ALTER TABLE `tblcontactus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblmedicalhistory`
--
ALTER TABLE `tblmedicalhistory`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblpage`
--
ALTER TABLE `tblpage`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblpatient`
--
ALTER TABLE `tblpatient`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ambulance_bookings`
--
ALTER TABLE `ambulance_bookings`
  ADD CONSTRAINT `ambulance_bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
