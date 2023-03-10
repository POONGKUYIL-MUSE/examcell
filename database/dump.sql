-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2023 at 03:42 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `examcell`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

CREATE TABLE `tbl_department` (
  `id` int(11) NOT NULL,
  `deptname` varchar(100) NOT NULL,
  `deptslug` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`id`, `deptname`, `deptslug`) VALUES
(4, 'Computer Science', 'computer-science');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_batch`
--

CREATE TABLE `tbl_batch` (
  `id` int(11) NOT NULL,
  `dept` int(11) NOT NULL,
  `batchyear` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_batch`
--

INSERT INTO `tbl_batch` (`id`, `dept`, `batchyear`) VALUES
(5, 4, '2022-2025'),
(6, 4, '2021-2024'),
(7, 4, '2020-2023'),
(8, 4, '2021-2023'),
(9, 4, '2022-2024');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_block`
--

CREATE TABLE `tbl_block` (
  `id` int(11) NOT NULL,
  `dept` int(11) NOT NULL,
  `block` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_block`
--

INSERT INTO `tbl_block` (`id`, `dept`, `block`) VALUES
(7, 4, 'A1');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--
	CREATE TABLE `events` (
 `id` int(11) NOT NULL,
 `title` varchar(255) NOT NULL,
 `description` text NOT NULL,
 `location` varchar(255) DEFAULT NULL,
 `date` date NOT NULL,
 `time_from` time NOT NULL,
 `time_to` time NOT NULL,
 `attendees` longtext DEFAULT NULL,
 `google_calendar_event_id` varchar(255) DEFAULT NULL,
 `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_email_service`
--
CREATE TABLE `tbl_email_service` (
 `id` int(11) NOT NULL,
 `email` varchar(255) NOT NULL,
 `properties` longtext DEFAULT NULL,
 `status`  int(11) NOT NULL,
 `reset_datetime` datetime DEFAULT NULL,
 `created_at` datetime NOT NULL,
 `created_by` int(11) NOT NULL,
 `updated_at` datetime NOT NULL,
 `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_email_service`
--

INSERT INTO `tbl_email_service` (`id`, `email`, `properties`, `status`, `reset_datetime`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'ngpasc.examcell@gmail.com', '{\"email_username\":\"ngpasc.examcell@gmail.com\",\"email_host\":\"smtp.gmail.com\",\"email_secure\":\"ssl\",\"email_port\":\"465\",\"password\":\"ujkonoytgshagfbv\"}', 1, '2023-02-26 00:00:00', '2023-02-25 11:26:22', 1, '2023-02-25 11:54:16', 1),
(2, 'examcell.ngpasc@gmail.com', '{\"email_username\":\"examcell.ngpasc@gmail.com\",\"email_host\":\"smtp.gmail.com\",\"email_secure\":\"ssl\",\"email_port\":\"465\",\"password\":\"grceenxkzbksghaj\"}', 0, '2023-02-26 00:00:00', '2023-02-25 12:03:57', 1, '2023-02-25 12:03:57', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_exams`
--

CREATE TABLE `tbl_exams` (
  `id` int(11) NOT NULL,
  `exam_name` varchar(100) NOT NULL,
  `exam_subject_name` varchar(100) NOT NULL,
  `exam_subject_code` varchar(100) NOT NULL,
  `exam_date` date NOT NULL,
  `notify_date` date NOT NULL,
  `batched` int(11) DEFAULT -1,
  `is_notified` datetime DEFAULT NULL,
  `exam_start_time` varchar(64) NOT NULL,
  `exam_end_time` varchar(64) DEFAULT NULL,
  `exam_dept` int(11) NOT NULL,
  `exam_batch` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `event_id` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_exams`
--

INSERT INTO `tbl_exams` (`id`, `exam_name`, `exam_subject_name`, `exam_subject_code`, `exam_date`, `notify_date`, `is_notified`, `exam_start_time`, `exam_end_time`, `exam_dept`, `exam_batch`, `status`, `event_id`) VALUES
(11, 'CIA 1', 'Professional English ??? II', '221EL1A2EA', '2023-02-25', '2023-02-24', NULL, '09:15', '11:15', 4, 5, 0, 0),
(12, 'CIA 1', 'Discrete Mathematics', '224CA1A2CA', '2023-02-27', '2023-02-26', NULL, '09:15', '11:15', 4, 5, 0, 0),
(13, 'CIA 1', 'Data Structures', '224CS1A2CA', '2023-02-28', '2023-02-27', NULL, '09:15', '11:15', 4, 5, 0, 0),
(14, 'CIA 1', 'Object Oriented Programming  with C++', '222MT1A2IC', '2023-03-01', '2023-02-28', NULL, '09:15', '11:15', 4, 5, 0, 0),
(15, 'CIA 1', 'RDBMS', '194IT1A4CA', '2023-02-25', '2023-02-24', NULL, '09:15', '11:15', 4, 6, 0, 0),
(16, 'CIA 1', 'Python Programming', '194CS1A4SA', '2023-02-27', '2023-02-26', NULL, '09:15', '11:15', 4, 6, 0, 0),
(17, 'CIA 1', 'Fundamentals of Accounting', '195CI1A4IB', '2023-02-28', '2023-02-27', NULL, '09:15', '11:15', 4, 6, 0, 0),
(18, 'CIA 1', 'Data Mining', '194CA1A6CB', '2023-02-25', '2023-02-24', NULL, '09:15', '11:15', 4, 7, 0, 0),
(19, 'CIA 1', 'Business Intelligence/ Semantic Web/ Multimedia Systems', '194CS1A6DA/ 194CS1A6DB/ 194CS1A6DC', '2023-02-27', '2023-02-26', NULL, '09:15', '11:15', 4, 7, 0, 0),
(20, 'CIA 1', 'Middleware Technologies/ Mobile Ad-Hoc Networks/ Social Network Data Analytics', '194CS1A6DD/ 194CS1A6DE/ 194CS1A6DF', '2023-02-28', '2023-02-27', NULL, '09:15', '11:15', 4, 7, 0, 0),
(21, 'CIA 1', 'Web Intelligence', '194CS2A4CB', '2023-02-25', '2023-02-24', NULL, '09:15', '11:15', 4, 8, 0, 0),
(22, 'CIA 1', 'Advanced RDBMS', '224CS2A2CB', '2023-02-25', '2023-02-24', NULL, '09:15', '11:15', 4, 9, 0, 0),
(23, 'CIA 1', 'Neural Networks and Fuzzy  Logic', '224CS2A2CC', '2023-02-27', '2023-02-26', NULL, '09:15', '11:15', 4, 9, 0, 0),
(24, 'CIA 1', 'Advanced Operations Research', '222MT2A2ED', '2023-02-28', '2023-02-27', NULL, '09:15', '11:15', 4, 9, 0, 0),
(25, 'CIA 1', 'Predictive Analytics', '224CS2A2DB', '2023-03-01', '2023-02-28', NULL, '09:15', '11:15', 4, 9, 0, 0),
(26, 'CIA 1', 'Tamil-II/French-II/Hindi-II', '221TL1A2TA/221FL1A2FA/221TI1A2HA', '2023-02-24', '2023-02-23', NULL, '09:15', '11:15', 4, 5, 0, 0),
(27, 'CIA 1', 'Agile Methodology', '194CS1A4CA', '2023-02-24', '2023-02-23', NULL, '09:15', '11:15', 4, 6, 0, 0),
(28, 'CIA 1', 'PHP', '194CS1A6CA', '2023-02-24', '2023-02-23', NULL, '09:15', '11:15', 4, 7, 0, 0),
(29, 'CIA 1', 'Advanced Python Programming', '224CS2A2CA', '2023-02-24', '2023-02-23', NULL, '09:15', '11:15', 4, 9, 0, 0),
(30, 'CIA 1', 'Android Programming', '194CS2A4CA', '2023-02-24', '2023-02-23', NULL, '09:15', '11:15', 4, 8, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_room`
--

CREATE TABLE `tbl_room` (
  `id` int(11) NOT NULL,
  `dept` int(11) NOT NULL,
  `block` int(11) NOT NULL,
  `room` varchar(100) NOT NULL,
  `capacity` int(11) NOT NULL,
  `row_dim` int(11) NOT NULL,
  `col_dim` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_room`
--

INSERT INTO `tbl_room` (`id`, `dept`, `block`, `room`, `capacity`, `row_dim`, `col_dim`) VALUES
(15, 4, 7, '403', 66, 11, 6),
(16, 4, 7, '419', 66, 11, 6),
(17, 4, 7, '422', 50, 10, 5),
(18, 4, 7, '423', 50, 9, 6),
(23, 4, 7, '425', 34, 9, 4),
(24, 0, 0, '402', 51, 8, 7),
(27, 4, 7, '402', 51, 9, 6),
(28, 4, 7, '421', 56, 10, 6),
(29, 4, 7, '420', 58, 10, 6);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staff`
--

CREATE TABLE `tbl_staff` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `phonenumber` varchar(30) DEFAULT NULL,
  `password` varchar(250) NOT NULL,
  `pass_code` varchar(250) DEFAULT NULL,
  `profile_image` varchar(191) DEFAULT NULL,
  `staff_department` int(11) NOT NULL DEFAULT 0,
  `admin` int(11) NOT NULL DEFAULT 0,
  `active` int(11) NOT NULL DEFAULT 1,
  `media_path_slug` varchar(191) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_staff`
--

INSERT INTO `tbl_staff` (`id`, `email`, `firstname`, `lastname`, `phonenumber`, `password`, `pass_code`, `profile_image`, `staff_department`, `admin`, `active`, `media_path_slug`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'ngpasc.examcell@gmail.com', 'Admin', 'Examcell', '9876543210', '0e7517141fb53f21ee439b355b5a1d0a', NULL, NULL, 0, 1, 1, NULL, '2023-01-15 18:50:37', 1, '2023-01-15 18:50:37', 1),
(5, 'drrosilinejeetha@drngpasc.ac.in', 'Rosiline Jeetha', 'B', '1234567890', 'd41d8cd98f00b204e9800998ecf8427e', NULL, NULL, 4, 0, 1, NULL, '2023-02-15 21:56:34', 1, '2023-02-20 14:17:47', 1),
(6, 'savithri@drngpasc.ac.in', 'Savithri', 'M', '1234567890', 'd41d8cd98f00b204e9800998ecf8427e', NULL, NULL, 4, 0, 1, NULL, '2023-02-15 22:07:02', 1, '2023-02-20 14:17:53', 1),
(7, 'vinodhini@drngpasc.ac.in', 'Vinodhini', 'V', '1234567890', 'd41d8cd98f00b204e9800998ecf8427e', NULL, NULL, 4, 0, 1, NULL, '2023-02-15 22:07:32', 1, '2023-02-20 14:18:02', 1),
(8, 'ramkumar.j@drngpasc.ac.in', 'Ramkumar', 'J', '1234567890', 'd41d8cd98f00b204e9800998ecf8427e', NULL, NULL, 4, 0, 1, NULL, '2023-02-15 22:08:18', 1, '2023-02-20 14:18:11', 1),
(9, 'sangeetha.m@drngpasc.ac.in', 'Sangeetha', 'M', '1234567890', 'd41d8cd98f00b204e9800998ecf8427e', NULL, NULL, 4, 0, 1, NULL, '2023-02-15 22:08:57', 1, '2023-02-20 14:18:22', 1),
(10, 'jagadeeswaran@drngpasc.ac.in', 'Jagadeeswaran', 'V S', '1234567890', 'd41d8cd98f00b204e9800998ecf8427e', NULL, NULL, 4, 0, 1, NULL, '2023-02-15 22:09:20', 1, '2023-02-20 14:18:35', 1),
(11, 'kumar@drngpasc.ac.in', 'kumar', 'N', '1234567890', 'd41d8cd98f00b204e9800998ecf8427e', NULL, NULL, 4, 0, 1, NULL, '2023-02-15 22:09:48', 1, '2023-02-20 14:18:42', 1),
(12, 'revathis@drngpasc.ac.in', 'Revathi', 'S', '1234567890', 'd41d8cd98f00b204e9800998ecf8427e', NULL, NULL, 4, 0, 1, NULL, '2023-02-15 22:10:10', 1, '2023-02-20 14:18:51', 1),
(13, 'maheshwaris@drngpasc.ac.in', 'Maheshwari', 'S', '1234567890', 'd41d8cd98f00b204e9800998ecf8427e', NULL, NULL, 4, 0, 1, NULL, '2023-02-15 22:10:40', 1, '2023-02-20 14:19:12', 1),
(14, 'usha@drngpasc.ac.in', 'Usha', 'P', '1234567890', 'd41d8cd98f00b204e9800998ecf8427e', NULL, NULL, 4, 0, 1, NULL, '2023-02-15 22:11:06', 1, '2023-02-20 14:19:19', 1),
(15, 'kalaiselvi@drngpasc.ac.in', 'Kalaiselvi', 'S R', '1234567890', 'd41d8cd98f00b204e9800998ecf8427e', NULL, NULL, 4, 0, 1, NULL, '2023-02-15 22:11:33', 1, '2023-02-20 14:19:47', 1),
(16, 'shobana@drngpasc.ac.in', 'Shobana', 'V', '1234567890', 'd41d8cd98f00b204e9800998ecf8427e', NULL, NULL, 4, 0, 1, NULL, '2023-02-15 22:12:01', 1, '2023-02-20 14:19:39', 1),
(17, 'saranyas@drngpasc.ac.in', 'Saranya', 'S', '1234567890', 'd41d8cd98f00b204e9800998ecf8427e', NULL, NULL, 4, 0, 1, NULL, '2023-02-15 22:12:25', 1, '2023-02-20 14:19:07', 1),
(18, 'kavitha.r@drngpasc.ac.in', 'Kavitha', 'R', '1234567890', 'd41d8cd98f00b204e9800998ecf8427e', NULL, NULL, 4, 0, 1, NULL, '2023-02-15 22:12:52', 1, '2023-02-20 14:17:18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student`
--

CREATE TABLE `tbl_student` (
  `id` int(11) NOT NULL,
  `regno` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `phonenumber` varchar(30) DEFAULT NULL,
  `password` varchar(250) NOT NULL,
  `pass_code` varchar(250) DEFAULT NULL,
  `profile_image` varchar(191) DEFAULT NULL,
  `student_department` int(11) NOT NULL DEFAULT 0,
  `student_batch` int(11) NOT NULL DEFAULT 0,
  `active` int(11) NOT NULL DEFAULT 1,
  `media_path_slug` varchar(191) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_student`
--

INSERT INTO `tbl_student` (`id`, `regno`, `email`, `firstname`, `lastname`, `phonenumber`, `password`, `pass_code`, `profile_image`, `student_department`, `student_batch`, `active`, `media_path_slug`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(23, '212CS001', '212cs001@drngpasc.ac.in', 'ABINASHA ', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 8, 1, NULL, '2023-02-15 22:19:32', 1, '2023-02-15 22:19:32', 1),
(24, '212CS002', '212cs002@drngpasc.ac.in', 'ABINAYA', 'M', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 8, 1, NULL, '2023-02-15 22:21:46', 1, '2023-02-15 22:21:46', 1),
(25, '212CS003', '212cs003@drngpasc.ac.in', 'ABINAYAA', 'V', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 8, 1, NULL, '2023-02-15 22:22:36', 1, '2023-02-15 22:22:36', 1),
(26, '212CS004', '212cs004@drngpasc.ac.in', 'AKILA', 'V', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 8, 1, NULL, '2023-02-15 22:23:27', 1, '2023-02-15 22:23:45', 1),
(27, '212CS005', '212cs005@drngpasc.ac.in', 'CHARAN', 'C S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 8, 1, NULL, '2023-02-15 22:26:13', 1, '2023-02-15 22:26:13', 1),
(28, '212CS006', '212cs006@drngpasc.ac.in', 'DEEPA', 'A', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 8, 1, NULL, '2023-02-15 22:27:55', 1, '2023-02-15 22:27:55', 1),
(29, '212CS007', '212cs007@drngpasc.ac.in', 'DEEPIKA', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 8, 1, NULL, '2023-02-15 22:28:42', 1, '2023-02-15 22:28:42', 1),
(30, '212CS008', '212cs008@drngpasc.ac.in', 'DHANUSH', 'B', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 8, 1, NULL, '2023-02-15 22:30:26', 1, '2023-02-15 22:30:26', 1),
(31, '212CS009', '212cs009@drngpasc.ac.in', 'DHIVYA', 'G', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 8, 1, NULL, '2023-02-15 22:33:04', 1, '2023-02-15 22:33:04', 1),
(32, '212CS010', '212cs010@drngpasc.ac.in', 'GOKUL', 'A G', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 8, 1, NULL, '2023-02-15 22:35:53', 1, '2023-02-15 22:35:53', 1),
(33, '212CS011', '212cs011@drngpasc.ac.in', 'HARI PRAKASH', 'J', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 8, 1, NULL, '2023-02-15 22:37:07', 1, '2023-02-15 22:37:07', 1),
(34, '212CS012', '212cs012@drngpasc.ac.in', 'HARIRAM', 'C', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 8, 1, NULL, '2023-02-15 22:38:40', 1, '2023-02-15 22:38:40', 1),
(35, '212CS013', '212cs013@drngpasc.ac.in', 'JEEVAN KUMAR', 'T', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 8, 1, NULL, '2023-02-15 22:39:55', 1, '2023-02-15 22:39:55', 1),
(36, '212CS014', '212cs014@drngpasc.ac.in', 'KAVITHA', 'G', '1234567890', '3d385adf48524c8b157815309df20d81', NULL, NULL, 4, 8, 1, NULL, '2023-02-15 22:41:17', 1, '2023-02-15 22:41:17', 1),
(37, '212CS015', '212cs015@drngpasc.ac.in', 'MOHAMMED RAFEEK', 'A', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 8, 1, NULL, '2023-02-15 22:42:04', 1, '2023-02-15 22:42:04', 1),
(38, '212CS016', '212cs016@drngpasc.ac.in', 'MONIKA', 'M', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 8, 1, NULL, '2023-02-15 22:42:49', 1, '2023-02-15 22:42:49', 1),
(39, '212CS017', '212cs017@drngpasc.ac.in', 'NANDHINI', 'J', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 8, 1, NULL, '2023-02-15 22:44:15', 1, '2023-02-15 22:44:15', 1),
(40, '212CS018', '212cs018@drngpasc.ac.in', 'PRASANTH', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 8, 1, NULL, '2023-02-15 22:44:59', 1, '2023-02-15 22:44:59', 1),
(41, '212CS019', '212cs019@drngpasc.ac.in', 'RAMYA', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 8, 1, NULL, '2023-02-15 22:45:53', 1, '2023-02-15 22:45:53', 1),
(42, '212CS020', '212cs020@drngpasc.ac.in', 'RAMYA', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 8, 1, NULL, '2023-02-15 22:46:38', 1, '2023-02-15 22:46:38', 1),
(43, '212CS021', '212cs021@drngpasc.ac.in', 'RUBAN PRASATH', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 8, 1, NULL, '2023-02-15 22:47:25', 1, '2023-02-15 22:47:25', 1),
(44, '212CS023', '212cs023@drngpasc.ac.in', 'SAKTHI SHRUTHI', 'V', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 8, 1, NULL, '2023-02-15 22:48:28', 1, '2023-02-15 22:48:28', 1),
(45, '212CS024', '212cs024@drngpasc.ac.in', 'SELVA VIGNESHWARAN ', 'M', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 8, 1, NULL, '2023-02-15 22:49:15', 1, '2023-02-15 22:49:15', 1),
(46, '212CS025', '212cs025@drngpasc.ac.in', 'SHALINI', 'M', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 8, 1, NULL, '2023-02-15 22:50:16', 1, '2023-02-15 22:50:16', 1),
(47, '212CS026', '212cs026@drngpasc.ac.in', 'SOUNDARYA', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 8, 1, NULL, '2023-02-15 22:51:09', 1, '2023-02-15 22:51:09', 1),
(48, '212CS027', '212cs027@drngpasc.ac.in', 'SOWMIYA', 'P S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 8, 1, NULL, '2023-02-15 22:51:58', 1, '2023-02-15 22:51:58', 1),
(49, '212CS029', '212cs029@drngpasc.ac.in', 'SRI MANIKANDAN', 'T K', '1234567890', 'd41d8cd98f00b204e9800998ecf8427e', NULL, NULL, 4, 8, 1, NULL, '2023-02-15 22:52:47', 1, '2023-02-15 22:53:59', 1),
(50, '212CS030', '212cs030@drngpasc.ac.in', 'SRIBAL', 'P', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 8, 1, NULL, '2023-02-15 22:53:43', 1, '2023-02-15 22:53:43', 1),
(51, '212CS031', '212cs031@drngpasc.ac.in', 'SWEATHA', 'D', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 8, 1, NULL, '2023-02-15 22:54:46', 1, '2023-02-15 22:54:46', 1),
(52, '212CS032', '212cs032@drngpasc.ac.in', 'VEERAPPAN', 'R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 8, 1, NULL, '2023-02-15 22:55:54', 1, '2023-02-15 22:55:54', 1),
(53, '212CS033', '212cs033@drngpasc.ac.in', 'VIGNESH', 'B', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 8, 1, NULL, '2023-02-15 22:56:42', 1, '2023-02-15 22:56:42', 1),
(54, '212CS034', '212cs034@drngpasc.ac.in', 'BHUVANESVARAN', 'R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 8, 1, NULL, '2023-02-15 22:57:30', 1, '2023-02-15 22:57:30', 1),
(55, '212CS035', '212cs035@drngpasc.ac.in', 'PRASANTH', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 8, 1, NULL, '2023-02-15 22:58:22', 1, '2023-02-15 22:58:22', 1),
(56, '212CS036', '212cs036@drngpasc.ac.in', 'SURJITH BHARATHI ', 'P', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 8, 1, NULL, '2023-02-15 22:59:11', 1, '2023-02-15 22:59:11', 1),
(57, '222CS001', '222cs001@drngpasc.ac.in', 'ABINESH ', 'R', '1234567890', 'd41d8cd98f00b204e9800998ecf8427e', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:05:19', 1, '2023-02-16 17:05:35', 1),
(58, '222CS002', '222cs002@drngpasc.ac.in', 'ABINIVESH ', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:06:36', 1, '2023-02-16 17:06:36', 1),
(59, '222CS003', '222cs003@drngpasc.ac.in', 'AKILA ', 'S D', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:07:21', 1, '2023-02-16 17:07:21', 1),
(60, '222CS004', '222cs004@drngpasc.ac.in', 'BALA KRISHNAN ', 'N', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:08:08', 1, '2023-02-16 17:08:08', 1),
(61, '222CS005', '222cs005@drngpasc.ac.in', 'BEENA ', 'C', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:08:52', 1, '2023-02-16 17:08:52', 1),
(62, '222CS006', '222cs006@drngpasc.ac.in', 'BHAKYALASHMI ', 'E', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:09:33', 1, '2023-02-16 17:09:33', 1),
(63, '222CS007', '222cs007@drngpasc.ac.in', 'DHANISWARAN ', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:10:35', 1, '2023-02-16 17:10:35', 1),
(64, '222CS008', '222cs008@drngpasc.ac.in', 'DHANUSHREE ', 'R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:11:22', 1, '2023-02-16 17:11:22', 1),
(65, '222CS009', '222cs009@drngpasc.ac.in', 'GOBIKRISHNAN', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:12:09', 1, '2023-02-16 17:12:09', 1),
(66, '222CS010', '222cs010@drngpasc.ac.in', 'GOKILA DEVI ', 'R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:12:52', 1, '2023-02-16 17:12:52', 1),
(67, '222CS011', '222cs011@drngpasc.ac.in', 'GOPALAKRISHNAN', 'N', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:14:45', 1, '2023-02-16 17:14:45', 1),
(68, '222CS012', '222cs012@drngpasc.ac.in', 'HEMALATHA', 'C', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:15:37', 1, '2023-02-16 17:15:37', 1),
(69, '222CS013', '222cs013@drngpasc.ac.in', 'JAGADEESH', 'J', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:16:52', 1, '2023-02-16 17:16:52', 1),
(70, '222CS014', '222cs014@drngpasc.ac.in', 'KAVIN', 'M', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:18:27', 1, '2023-02-16 17:18:27', 1),
(71, '222CS015', '222cs015@drngpasc.ac.in', 'LEENA SYLVIYA', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:19:29', 1, '2023-02-16 17:19:29', 1),
(72, '222CS016', '222cs016@drngpasc.ac.in', 'MATHAN RAJ', 'A', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:20:13', 1, '2023-02-16 17:20:13', 1),
(73, '222CS017', '222cs017@drngpasc.ac.in', 'MOHANA PRASATH ', 'R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:20:51', 1, '2023-02-16 17:20:51', 1),
(74, '222CS019', '222cs019@drngpasc.ac.in', 'PAVANA ', 'A B', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:21:58', 1, '2023-02-16 17:21:58', 1),
(75, '222CS020', '222cs020@drngpasc.ac.in', 'PRASANTH', 'K', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:22:42', 1, '2023-02-16 17:22:42', 1),
(76, '222CS021', '222cs021@drngpasc.ac.in', 'SIVARAMA HARISH ', 'N', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:23:20', 1, '2023-02-16 17:23:20', 1),
(77, '222CS022', '222cs022@drngpasc.ac.in', 'SOUMYA ', 'R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:24:10', 1, '2023-02-16 17:24:10', 1),
(78, '222CS023', '222cs023@drngpasc.ac.in', 'SUBA ', 'R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:24:54', 1, '2023-02-16 17:24:54', 1),
(79, '222CS024', '222cs024@drngpasc.ac.in', 'SUBASH CHANDRA BOSE', 'G', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:25:53', 1, '2023-02-16 17:25:53', 1),
(80, '222CS025', '222cs025@drngpasc.ac.in', 'SURESHKUMAR', 'R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:26:57', 1, '2023-02-16 17:26:57', 1),
(81, '222CS026', '222cs026@drngpasc.ac.in', 'SWATHIKA', 'T', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:27:46', 1, '2023-02-16 17:27:46', 1),
(82, '222CS027', '222cs027@drngpasc.ac.in', 'VINOD', 'M', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:28:43', 1, '2023-02-16 17:28:43', 1),
(83, '222CS028', '222cs028@drngpasc.ac.in', 'VISHNU VARMA', 'R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:29:43', 1, '2023-02-16 17:29:43', 1),
(84, '222CS029', '222cs029@drngpasc.ac.in', 'KAPILAN', 'D', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:30:25', 1, '2023-02-16 17:30:25', 1),
(85, '222CS030', '222cs030@drngpasc.ac.in', 'NISHA', 'M', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:31:18', 1, '2023-02-16 17:31:18', 1),
(86, '222CS031', '222cs031@drngpasc.ac.in', 'PRATHEESH', 'P', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:31:55', 1, '2023-02-16 17:31:55', 1),
(87, '222CS032', '222cs032@drngpasc.ac.in', 'SARATH', 'M S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:32:39', 1, '2023-02-16 17:32:39', 1),
(88, '222CS033', '222cs033@drngpasc.ac.in', 'SIVAPRAKASH', 'P', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:33:47', 1, '2023-02-16 17:33:47', 1),
(89, '222CS035', '222cs035@drngpasc.ac.in', 'INBASAHARAN', 'R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:34:29', 1, '2023-02-16 17:34:29', 1),
(90, '222CS036', '222cs036@drngpasc.ac.in', 'PRADEESH', 'P', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:35:29', 1, '2023-02-16 17:35:29', 1),
(91, '222CS037', '222cs037@drngpasc.ac.in', 'RAHUL', 'K', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:36:13', 1, '2023-02-16 17:36:13', 1),
(92, '222CS038', '222cs038@drngpasc.ac.in', 'SATHISHKUMAR', 'R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:37:56', 1, '2023-02-16 17:37:56', 1),
(93, '222CS039', '222cs039@drngpasc.ac.in', 'SHALINI', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:39:14', 1, '2023-02-16 17:39:14', 1),
(94, '222CS040', '222cs040@drngpasc.ac.in', 'HEMALATHA', 'R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:40:04', 1, '2023-02-16 17:40:04', 1),
(95, '222CS041', '222cs041@drngpasc.ac.in', 'SUSMITHA', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:41:04', 1, '2023-02-16 17:41:04', 1),
(96, '222CS042', '222cs042@drngpasc.ac.in', 'AJITH', 'P', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:41:58', 1, '2023-02-16 17:41:58', 1),
(97, '222CS043', '222cs043@drngpasc.ac.in', 'GOKULKRISHNAN', 'G', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:42:47', 1, '2023-02-16 17:42:47', 1),
(98, '222CS045', '222cs045@drngpasc.ac.in', 'RICHARD WILSON', 'A', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:43:33', 1, '2023-02-16 17:43:33', 1),
(99, '222CS046', '222cs046@drngpasc.ac.in', 'SHONA', 'R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:44:27', 1, '2023-02-16 17:44:27', 1),
(100, '222CS047', '222cs047@drngpasc.ac.in', 'SIVANANDHAN', 'A', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:45:56', 1, '2023-02-16 17:45:56', 1),
(101, '222CS048', '222cs048@drngpasc.ac.in', 'SWATHI', 'P', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:46:51', 1, '2023-02-16 17:46:51', 1),
(102, '222CS049', '222cs049@drngpasc.ac.in', 'KARTHIK KANNAN', 'M', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:48:16', 1, '2023-02-16 17:48:16', 1),
(103, '222CS050', '222cs050@drngpasc.ac.in', 'MAHESHKUMAR', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:49:04', 1, '2023-02-16 17:49:04', 1),
(104, '222CS051', '222cs051@drngpasc.ac.in', 'ASHOK CHAKRAVARTHI', 'R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:49:51', 1, '2023-02-16 17:49:51', 1),
(105, '222CS052', '222cs052@drngpasc.ac.in', 'NAVIN', ' ', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:50:55', 1, '2023-02-16 17:50:55', 1),
(106, '222CS053', '222cs053@drngpasc.ac.in', 'SUKUMAR', 'V', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:51:42', 1, '2023-02-16 17:51:42', 1),
(107, '222CS054', '222cs054@drngpasc.ac.in', 'DEVADHARSHINI', ' ', '1234567890', 'd41d8cd98f00b204e9800998ecf8427e', NULL, NULL, 4, 9, 1, NULL, '2023-02-16 17:52:19', 1, '2023-02-17 09:51:44', 1),
(108, '211CS001', '211cs001@drngpasc.ac.in', 'ABINAYA', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 17:55:36', 1, '2023-02-16 17:55:36', 1),
(109, '211CS002', '211cs002@drngpasc.ac.in', 'ADITH PRANAO', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 17:56:30', 1, '2023-02-16 17:56:30', 1),
(110, '211CS003', '211cs003@drngpasc.ac.in', 'AJAI KRISHNA', 'E', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 17:57:20', 1, '2023-02-16 17:57:20', 1),
(111, '211CS004', '211cs004@drngpasc.ac.in', 'AJITH', 'M', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 17:58:03', 1, '2023-02-16 17:58:03', 1),
(112, '211CS005', '211cs005@drngpasc.ac.in', 'AKILESH', 'P', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 17:59:07', 1, '2023-02-16 17:59:07', 1),
(113, '211CS006', '211cs006@drngpasc.ac.in', 'ANU', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 18:00:25', 1, '2023-02-16 18:00:25', 1),
(114, '211CS007', '211cs007@drngpasc.ac.in', 'CHANDRAVASA', 'R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 18:01:18', 1, '2023-02-16 18:01:18', 1),
(115, '211CS008', '211cs008@drngpasc.ac.in', 'DARSSHAN', 'N S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 18:02:23', 1, '2023-02-16 18:02:23', 1),
(116, '211CS009', '211cs009@drngpasc.ac.in', 'DEEPA', 'T', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 18:04:22', 1, '2023-02-16 18:04:22', 1),
(117, '211CS010', '211cs010@drngpasc.ac.in', 'DHANYA', 'P', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 18:05:49', 1, '2023-02-16 18:05:49', 1),
(118, '211CS011', '211cs011@drngpasc.ac.in', 'DHARSHANA DEVI', 'R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 18:06:47', 1, '2023-02-16 18:06:47', 1),
(119, '211CS012', '211cs012@drngpasc.ac.in', 'DINESHKUMAR', 'R V', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 18:09:01', 1, '2023-02-16 18:09:01', 1),
(120, '211CS013', '211cs013@drngpasc.ac.in', 'GOKILAVANI', 'J', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 18:09:55', 1, '2023-02-16 18:09:55', 1),
(121, '211CS014', '211cs014@drngpasc.ac.in', 'HARI PRAKASH', 'K', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 18:11:37', 1, '2023-02-16 18:11:37', 1),
(122, '211CS016', '211cs016@drngpasc.ac.in', 'JENIFER SELVARANI', 'A', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 18:13:25', 1, '2023-02-16 18:13:25', 1),
(123, '211CS017', '211cs017@drngpasc.ac.in', 'KABILESH', 'M', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 18:14:36', 1, '2023-02-16 18:14:36', 1),
(125, '211CS019', '211cs019@drngpasc.ac.in', 'KARTHIYAYENI', 'G', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 18:18:56', 1, '2023-02-16 18:18:56', 1),
(126, '211CS020', '211cs020@drngpasc.ac.in', 'KAVIYA', 'M', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 18:19:41', 1, '2023-02-16 18:19:41', 1),
(127, '211CS021', '211cs021@drngpasc.ac.in', 'LINGARAJAN', 'T', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 18:20:23', 1, '2023-02-16 18:20:23', 1),
(128, '211CS022', '211cs022@drngpasc.ac.in', 'MYVIZHI', 'K R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 18:21:26', 1, '2023-02-16 18:21:26', 1),
(129, '211CS023', '211cs023@drngpasc.ac.in', 'NIVETHITHAN', 'B', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 18:22:06', 1, '2023-02-16 18:22:06', 1),
(130, '211CS024', '211cs024@drngpasc.ac.in', 'POUTHIRA', 'C', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 18:22:53', 1, '2023-02-16 18:22:53', 1),
(131, '211CS025', '211cs025@drngpasc.ac.in', 'PRINCE HARRISON', 'V', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 18:24:38', 1, '2023-02-16 18:24:38', 1),
(132, '211CS026', '211cs026@drngpasc.ac.in', 'RAMPRASATH', 'M', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 18:27:52', 1, '2023-02-16 18:27:52', 1),
(133, '211CS027', '211cs027@drngpasc.ac.in', 'RANJITHA', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 18:28:34', 1, '2023-02-16 18:28:34', 1),
(134, '211CS028', '211cs028@drngpasc.ac.in', 'SAKTHIVEL', 'A', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 18:29:19', 1, '2023-02-16 18:29:19', 1),
(135, '211CS029', '211cs029@drngpasc.ac.in', 'SAMIDURAI', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 18:30:09', 1, '2023-02-16 18:30:09', 1),
(136, '211CS030', '211cs030@drngpasc.ac.in', 'SANJAY', 'R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 18:31:14', 1, '2023-02-16 18:31:14', 1),
(137, '211CS031', '211cs031@drngpasc.ac.in', 'SANJAYKUMAR', 'I', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 18:32:48', 1, '2023-02-16 18:32:48', 1),
(138, '211CS032', '211cs032@drngpasc.ac.in', 'SANTHANAKUMAR', 'A', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 18:33:28', 1, '2023-02-16 18:33:28', 1),
(139, '211CS033', '211cs033@drngpasc.ac.in', 'SARANRAJ', 'B', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 18:34:09', 1, '2023-02-16 18:34:09', 1),
(140, '211CS034', '211cs034@drngpasc.ac.in', 'SATHISH', 'R', '1234567890', 'd41d8cd98f00b204e9800998ecf8427e', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 18:40:58', 1, '2023-02-19 17:50:06', 1),
(141, '211CS035', '211cs035@drngpasc.ac.in', 'SHARMADA', 'G', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 18:41:43', 1, '2023-02-16 18:41:43', 1),
(142, '211CS036', '211cs036@drngpasc.ac.in', 'SINDHU', 'P', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 18:42:28', 1, '2023-02-16 18:42:28', 1),
(143, '211CS037', '211cs037@drngpasc.ac.in', 'SIVA SAKTHI KUMAR', 'M', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 18:43:10', 1, '2023-02-16 18:43:10', 1),
(144, '211CS038', '211cs038@drngpasc.ac.in', 'SIVARAM', 'T', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 18:43:54', 1, '2023-02-16 18:43:54', 1),
(145, '211CS039', '211cs039@drngpasc.ac.in', 'SOWMIYA', 'K', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 18:44:33', 1, '2023-02-16 18:44:33', 1),
(147, '211CS041', '211cs041@drngpasc.ac.in', 'SRINIVASAN', 'M', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 18:45:53', 1, '2023-02-16 18:45:53', 1),
(148, '211CS042', '211cs042@drngpasc.ac.in', 'SURENDRAN', 'G', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 18:46:32', 1, '2023-02-16 18:46:32', 1),
(149, '211CS043', '211cs043@drngpasc.ac.in', 'SWATHI', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 18:47:22', 1, '2023-02-16 18:47:22', 1),
(150, '211CS044', '211cs044@drngpasc.ac.in', 'SWETHA', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 18:48:20', 1, '2023-02-16 18:48:20', 1),
(151, '211CS045', '211cs045@drngpasc.ac.in', 'VAIKUNTH', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 18:48:55', 1, '2023-02-16 18:48:55', 1),
(152, '211CS046', '211cs046@drngpasc.ac.in', 'VAISHNAVIDEVI', 'V', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 18:49:34', 1, '2023-02-16 18:49:34', 1),
(153, '211CS047', '211cs047@drngpasc.ac.in', 'VEERAMANIKANDAN', 'M', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 18:50:11', 1, '2023-02-16 18:50:11', 1),
(154, '211CS048', '211cs048@drngpasc.ac.in', 'VIGNESHWARAN', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 18:50:49', 1, '2023-02-16 18:50:49', 1),
(155, '211CS049', '211cs049@drngpasc.ac.in', 'VIJAY', 'M', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 18:51:28', 1, '2023-02-16 18:51:28', 1),
(156, '211CS050', '211cs050@drngpasc.ac.in', 'VIJAYARAGAVENDRA', 'T', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 18:52:09', 1, '2023-02-16 18:52:09', 1),
(157, '211CS051', '211cs051@drngpasc.ac.in', 'YUVANISHA', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 18:52:51', 1, '2023-02-16 18:52:51', 1),
(158, '211CS052', '211cs052@drngpasc.ac.in', 'MANEESHA', 'K B', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 18:53:29', 1, '2023-02-16 18:53:29', 1),
(159, '211CS053', '211cs053@drngpasc.ac.in', 'PON GOWTHAM KRISHNAN', ' ', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-16 18:54:07', 1, '2023-02-16 18:54:07', 1),
(160, '211CS101', '211cs101@drngpasc.ac.in', 'ABI MATHEW', 'P V', '1234567890', 'd41d8cd98f00b204e9800998ecf8427e', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 06:46:30', 1, '2023-02-17 06:49:24', 1),
(161, '211CS102', '211cs102@drngpasc.ac.in', 'ABIRAMI ', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 06:48:22', 1, '2023-02-17 06:48:22', 1),
(162, '211CS103', '211cs103@drngpasc.ac.in', 'ADITHYA', 'K', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 06:50:19', 1, '2023-02-17 06:50:19', 1),
(163, '211CS104', '211cs104@drngpasc.ac.in', 'AJAY', 'K', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 06:51:21', 1, '2023-02-17 06:51:21', 1),
(164, '211CS105', '211cs105@drngpasc.ac.in', 'ARUN', 'K', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 06:52:06', 1, '2023-02-17 06:52:06', 1),
(165, '211CS106', '211cs006@drngpasc.ac.in', 'ARUNADEVI', 'V', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 06:53:04', 1, '2023-02-17 06:53:04', 1),
(166, '211CS107', '211cs107@drngpasc.ac.in', 'BOOSHIDHA', 'R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 06:54:17', 1, '2023-02-17 06:54:17', 1),
(167, '211CS108', '211cs108@drngpasc.ac.in', 'DHARSHINI', 'K N', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 06:55:07', 1, '2023-02-17 06:55:07', 1),
(168, '211CS110', '211cs110@drngpasc.ac.in', 'GUHAN', 'S', '1234567890', 'd41d8cd98f00b204e9800998ecf8427e', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 06:56:01', 1, '2023-02-17 06:57:19', 1),
(169, '211CS111', '211cs111@drngpasc.ac.in', 'HARENI', 'V', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 06:56:56', 1, '2023-02-17 06:56:56', 1),
(170, '211CS112', '211cs112@drngpasc.ac.in', 'HARIHARAN', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 06:58:06', 1, '2023-02-17 06:58:06', 1),
(171, '211CS113', '211cs113@drngpasc.ac.in', 'HARSAN', 'V', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 06:59:02', 1, '2023-02-17 06:59:02', 1),
(172, '211CS115', '211cs115@drngpasc.ac.in', 'JEYASHREE', 'B', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 07:00:07', 1, '2023-02-17 07:00:07', 1),
(173, '211CS116', '211cs116@drngpasc.ac.in', 'KANISKA', 'P', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 07:01:01', 1, '2023-02-17 07:01:01', 1),
(175, '211CS117', '211cs117@drngpasc.ac.in', 'KATHIRESAN', 'S M', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 07:20:46', 1, '2023-02-17 07:20:46', 1),
(176, '211CS118', '211cs118@drngpasc.ac.in', 'KOWSALYA', 'S', '1234567890', 'd41d8cd98f00b204e9800998ecf8427e', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 07:23:18', 1, '2023-02-17 07:23:35', 1),
(177, '211CS119', '211cs119@drngpasc.ac.in', 'MATHAN ARYHA ', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 07:24:24', 1, '2023-02-17 07:24:24', 1),
(178, '211CS120', '211cs120@drngpasc.ac.in', 'MAYUKHA DEIVAM ', 'A S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 07:25:22', 1, '2023-02-17 07:25:22', 1),
(179, '211CS121', '211cs121@drngpasc.ac.in', 'MOHANRAJ', 'C', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 07:26:20', 1, '2023-02-17 07:26:20', 1),
(180, '211CS122', '211cs122@drngpasc.ac.in', 'NAVANEETHA', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 07:27:31', 1, '2023-02-17 07:27:31', 1),
(181, '211CS123', '211cs123@drngpasc.ac.in', 'NIVASH', 'H', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 07:30:30', 1, '2023-02-17 07:30:30', 1),
(182, '211CS124', '211cs124@drngpasc.ac.in', 'PRAVEENKUMAR', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 07:32:28', 1, '2023-02-17 07:32:28', 1),
(183, '211CS125', '211cs125@drngpasc.ac.in', 'RAGUL', 'K R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 07:40:27', 1, '2023-02-17 07:40:27', 1),
(184, '211CS126', '211cs126@drngpasc.ac.in', 'RAHUL', 'M K', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 07:41:29', 1, '2023-02-17 07:41:29', 1),
(185, '211CS128', '211cs128@drngpasc.ac.in', 'RAMYA', 'P', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 07:42:28', 1, '2023-02-17 07:42:28', 1),
(186, '211CS129', '211cs129@drngpasc.ac.in', 'RANJITHKUMAR', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 07:43:29', 1, '2023-02-17 07:43:29', 1),
(187, '211CS130', '211cs130@drngpasc.ac.in', 'RISHI KESAVAN ', 'G S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 07:44:41', 1, '2023-02-17 07:44:41', 1),
(188, '211CS131', '211cs131@drngpasc.ac.in', 'SAARULATHA', 's', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 07:45:21', 1, '2023-02-17 07:45:21', 1),
(189, '211CS132', '211cs132@drngpasc.ac.in', 'SABAREESH', 'R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 07:46:50', 1, '2023-02-17 07:46:50', 1),
(190, '211CS133', '211cs133@drngpasc.ac.in', 'SANJAY', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 07:47:39', 1, '2023-02-17 07:47:39', 1),
(191, '211CS134', '211cs134@drngpasc.ac.in', 'SANJEEV', 'M', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 07:49:52', 1, '2023-02-17 07:49:52', 1),
(192, '211CS135', '211cs135@drngpasc.ac.in', 'SATHISH', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 07:51:54', 1, '2023-02-17 07:51:54', 1),
(193, '211CS136', '211cs136@drngpasc.ac.in', 'SHREENITHI', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 07:52:57', 1, '2023-02-17 07:52:57', 1),
(194, '211CS137', '211cs137@drngpasc.ac.in', 'SHRUTHI', 'M', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 07:53:49', 1, '2023-02-17 07:53:49', 1),
(195, '211CS138', '211cs138@drngpasc.ac.in', 'SIVAGIRI', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 07:55:38', 1, '2023-02-17 07:55:38', 1),
(196, '211CS139', '211cs139@drngpasc.ac.in', 'SIVARANJINI', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 07:56:40', 1, '2023-02-17 07:56:40', 1),
(197, '211CS140', '211cs140@drngpasc.ac.in', 'SRI BAVAHARINI ', 'S P', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 07:57:44', 1, '2023-02-17 07:57:44', 1),
(198, '211CS141', '211cs141@drngpasc.ac.in', 'SURYA', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 07:58:26', 1, '2023-02-17 07:58:26', 1),
(199, '211CS142', '211cs142@drngpasc.ac.in', 'SURYA SAKTHIVEL', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 07:59:15', 1, '2023-02-17 07:59:15', 1),
(200, '211CS143', '211cs143@drngpasc.ac.in', 'THARUN KUMAR ', 'R M', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 08:00:17', 1, '2023-02-17 08:00:17', 1),
(201, '211CS144', '211cs144@drngpasc.ac.in', 'VENKATESH', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 08:01:04', 1, '2023-02-17 08:01:04', 1),
(202, '211CS145', '211cs145@drngpasc.ac.in', 'VIGNESH', 'M', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 08:01:53', 1, '2023-02-17 08:01:53', 1),
(203, '211CS146', '211cs146@drngpasc.ac.in', 'VIJAYAN', 'N', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 08:03:22', 1, '2023-02-17 08:03:22', 1),
(204, '211CS147', '211cs147@drngpasc.ac.in', 'VIMAL ANANTH', 'K', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 08:04:49', 1, '2023-02-17 08:04:49', 1),
(205, '211CS148', '211cs148@drngpasc.ac.in', 'VISMITA', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 08:05:48', 1, '2023-02-17 08:05:48', 1),
(206, '211CS149', '211cs149@drngpasc.ac.in', 'YOGASRI', 'S A', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 08:06:49', 1, '2023-02-17 08:06:49', 1),
(207, '211CS150', '211cs150@drngpasc.ac.in', 'YUVARAJ', 'K', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 08:07:57', 1, '2023-02-17 08:07:57', 1),
(208, '211CS151', '211cs151@drngpasc.ac.in', 'SUJI PRASANTH', 'A', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 08:09:02', 1, '2023-02-17 08:09:02', 1),
(209, '211CS152', '211cs152@drngpasc.ac.in', 'JANAPRANESH ', 'K R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-17 08:09:46', 1, '2023-02-17 08:09:46', 1),
(210, '221CS101', '221cs101@drngpasc.ac.in', 'AARTHIK BALA ', 'A P', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 08:17:35', 1, '2023-02-17 08:17:35', 1),
(211, '221CS102', '221cs102@drngpasc.ac.in', 'ACSHAYA', 'D', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 08:18:24', 1, '2023-02-17 08:18:24', 1),
(212, '221CS103', '221cs103@drngpasc.ac.in', 'ADHITHYAN', 'B', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 08:21:23', 1, '2023-02-17 08:21:23', 1),
(213, '221CS104', '221cs104@drngpasc.ac.in', 'AJAY', 'P R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 08:22:20', 1, '2023-02-17 08:22:20', 1),
(214, '221CS105', '221cs105@drngpasc.ac.in', 'ARUNESHWARAN', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 08:23:07', 1, '2023-02-17 08:23:07', 1),
(215, '221CS106', '221cs106@drngpasc.ac.in', 'ATHISRI', 'K', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 08:24:00', 1, '2023-02-17 08:24:00', 1),
(216, '221CS107', '221cs107@drngpasc.ac.in', 'BALAJI', 'P', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 08:24:44', 1, '2023-02-17 08:24:44', 1),
(217, '221CS108', '221cs108@drngpasc.ac.in', 'BHARATHIKANNAN', 'A', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 08:29:32', 1, '2023-02-17 08:29:32', 1),
(218, '221CS109', '221cs109@drngpasc.ac.in', 'BOOMIKA', 'J', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 08:30:24', 1, '2023-02-17 08:30:24', 1),
(219, '221CS110', '221cs110@drngpasc.ac.in', 'DEEPADHARANI', 'R V', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 08:31:29', 1, '2023-02-17 08:31:29', 1),
(220, '221CS111', '221cs111@drngpasc.ac.in', 'DEEPIKA RAJA LAKSHAYA', 'G', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 08:32:21', 1, '2023-02-17 08:32:21', 1),
(221, '221CS112', '221cs112@drngpasc.ac.in', 'DEVADHARSHINI', 'J', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 08:33:16', 1, '2023-02-17 08:33:16', 1),
(222, '221CS113', '221cs113@drngpasc.ac.in', 'DHARANI', 'M', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 08:36:38', 1, '2023-02-17 08:36:38', 1),
(223, '221CS114', '221cs114@drngpasc.ac.in', 'DHARANIDHARAN', 'C', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 08:37:40', 1, '2023-02-17 08:37:40', 1),
(226, '201CS001', '201cs001@drngpasc.ac.in', 'ABINASH', 'V', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(227, '201CS002', '201cs002@drngpasc.ac.in', 'AKASH', 'V', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(228, '201CS003', '201cs003@drngpasc.ac.in', 'AKASHKIRUTHIC R', 'T', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(229, '201CS004', '201cs004@drngpasc.ac.in', 'AMARNATH', 'R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(230, '201CS005', '201cs005@drngpasc.ac.in', 'ANUSIYABANU', 'D', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(231, '201CS006', '201cs006@drngpasc.ac.in', 'ARAVINDHAN', 'B', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(232, '201CS007', '201cs007@drngpasc.ac.in', 'ASWINI', 'V', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(233, '201CS008', '201cs008@drngpasc.ac.in', 'BASAVESH', ' L G R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(234, '201CS009', '201cs009@drngpasc.ac.in', 'CHANDHURU', 'K B', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(235, '201CS010', '201cs010@drngpasc.ac.in', 'CHIBHIRAJ', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(236, '201CS011', '201cs011@drngpasc.ac.in', 'DEEKSHA', 'S K', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(237, '201CS012', '201cs012@drngpasc.ac.in', 'DHEENADHAYALAN', 'R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(238, '201CS013', '201cs013@drngpasc.ac.in', 'DINESH', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(239, '201CS014', '201cs014@drngpasc.ac.in', 'DINESH', 'T', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(240, '201CS015', '201cs015@drngpasc.ac.in', 'GANESH MANIKANDAN', 'D', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(241, '201CS017', '201cs017@drngpasc.ac.in', 'GUHAN GANESH', 'M', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(242, '201CS018', '201cs018@drngpasc.ac.in', 'HRISHIKESH', 'R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(243, '201CS019', '201cs019@drngpasc.ac.in', 'ILAYA BHARATHI', 'A S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(244, '201CS020', '201cs020@drngpasc.ac.in', 'INBARASAN', 'S', '123567890', '0e7517141fb53f21ee439b355b5a1d0a', NULL, NULL, 1, 1, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(245, '201CS021', '201cs021@drngpasc.ac.in', 'ISHWARYA', 'A', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(246, '201CS022', '201cs022@drngpasc.ac.in', 'JERCY ANGELIN', 'J', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(247, '201CS023', '201cs023@drngpasc.ac.in', 'KAVISRI', 'B', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(248, '201CS024', '201cs024@drngpasc.ac.in', 'KISHORE KUMAR', 'R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(249, '201CS025', '201cs025@drngpasc.ac.in', 'MADHANA GOPAL', 'R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(250, '201CS027', '201cs027@drngpasc.ac.in', 'MAHANANDHAN', 'K', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(251, '201CS028', '201cs028@drngpasc.ac.in', 'MAHESWARI', 'R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(252, '201CS029', '201cs029@drngpasc.ac.in', 'MATHIALAGAN', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(253, '201CS030', '201cs030@drngpasc.ac.in', 'MITHILESH', 'B', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(254, '201CS031', '201cs031@drngpasc.ac.in', 'MITHUN PRANESH', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(255, '201CS032', '201cs032@drngpasc.ac.in', 'NAVI NARMADHA', 'J', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(256, '201CS033', '201cs033@drngpasc.ac.in', 'NIVETHITHA', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(257, '201CS034', '201cs034@drngpasc.ac.in', 'PAVITHRA', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(258, '201CS035', '201cs035@drngpasc.ac.in', 'PRAKASH', 'M', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(259, '201CS036', '201cs036@drngpasc.ac.in', 'RAJESH', 'R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(260, '201CS037', '201cs037@drngpasc.ac.in', 'RAMAJAYAM', 'A', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(261, '201CS039', '201cs039@drngpasc.ac.in', 'SACHITHANANTHAM', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(262, '201CS041', '201cs041@drngpasc.ac.in', 'SANGEERTH', 'P', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(263, '201CS042', '201cs042@drngpasc.ac.in', 'SANJAY', 'R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(264, '201CS043', '201cs043@drngpasc.ac.in', 'SANJAY', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(265, '201CS044', '201cs044@drngpasc.ac.in', 'SANTHOSHKUMAR', 'M', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(266, '201CS045', '201cs045@drngpasc.ac.in', 'SARAN', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(267, '201CS046', '201cs046@drngpasc.ac.in', 'SHYAM RAGHUL', 'P', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(268, '201CS047', '201cs047@drngpasc.ac.in', 'SNEHA', 'M', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(269, '201CS048', '201cs048@drngpasc.ac.in', 'SOLOMONRAJA DANIEL', 'A', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(270, '201CS049', '201cs049@drngpasc.ac.in', 'SREEJA', 'K', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(271, '201CS050', '201cs050@drngpasc.ac.in', 'SUREKAA', 'B', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(272, '201CS051', '201cs051@drngpasc.ac.in', 'THARANI KUMAR', 'B', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(273, '201CS052', '201cs052@drngpasc.ac.in', 'VAISHNAVI', 'K', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(274, '201CS053', '201cs053@drngpasc.ac.in', 'VASHIGARAN', 'T', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(275, '201CS054', '201cs054@drngpasc.ac.in', 'VASUKI', 'G', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(276, '201CS055', '201cs055@drngpasc.ac.in', 'VEERA HARINI', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(277, '201CS056', '201cs056@drngpasc.ac.in', 'VIJAYA RAGAVAN', 'A', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(278, '201CS057', '201cs057@drngpasc.ac.in', 'VIKRAM', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(279, '201CS058', '201cs058@drngpasc.ac.in', 'PAVITHRA', 'M', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(280, '201CS059', '201cs059@drngpasc.ac.in', 'HARISH', 'R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(281, '201CS060', '201cs060@drngpasc.ac.in', 'ASHWIN', 'G', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:43:18', 1, '2023-02-17 09:43:18', 1),
(282, '201CS101', '201cs101@drngpasc.ac.in', 'AFWAN MUFASHAL', 'K S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(283, '201CS102', '201cs102@drngpasc.ac.in', 'AMIRTHAM', 'B', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(284, '201CS103', '201cs103@drngpasc.ac.in', 'ARUNA DEVI', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(285, '201CS104', '201cs104@drngpasc.ac.in', 'ARUNPANDIAN', 'J', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(286, '201CS105', '201cs105@drngpasc.ac.in', 'BHARATHI KANNAN', 'K', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(287, '201CS106', '201cs106@drngpasc.ac.in', 'CHANDRAKUMAR', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1);
INSERT INTO `tbl_student` (`id`, `regno`, `email`, `firstname`, `lastname`, `phonenumber`, `password`, `pass_code`, `profile_image`, `student_department`, `student_batch`, `active`, `media_path_slug`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(288, '201CS107', '201cs107@drngpasc.ac.in', 'CHANDRU', 'N', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(289, '201CS108', '201cs108@drngpasc.ac.in', 'DEEPIKA SHREE', 'A', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(290, '201CS109', '201cs109@drngpasc.ac.in', 'DEEPSHIKA', 'B', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(291, '201CS110', '201cs110@drngpasc.ac.in', 'DHARANI', 'V', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(292, '201CS111', '201cs111@drngpasc.ac.in', 'DINESH', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(293, '201CS112', '201cs112@drngpasc.ac.in', 'DINESH KUMAR', 'M', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(294, '201CS113', '201cs113@drngpasc.ac.in', 'DIVAKAR', 'T G', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(295, '201CS114', '201cs114@drngpasc.ac.in', 'ELAYAVARMAN', 'R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(296, '201CS115', '201cs115@drngpasc.ac.in', 'GAJALAKSHMI', 'C', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(297, '201CS116', '201cs116@drngpasc.ac.in', 'GOWREESH', 'A K S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(298, '201CS117', '201cs117@drngpasc.ac.in', 'GOWTHAM', 'R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(299, '201CS118', '201cs118@drngpasc.ac.in', 'GUNASEELAN', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(300, '201CS119', '201cs119@drngpasc.ac.in', 'HARIKISHORE', 'G', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(301, '201CS120', '201cs120@drngpasc.ac.in', 'HARIKRISHNA', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(302, '201CS121', '201cs121@drngpasc.ac.in', 'HARIKRISHNAN', 'S S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(303, '201CS122', '201cs122@drngpasc.ac.in', 'HARIVARDHANARAJULU', 'P', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(304, '201CS123', '201cs123@drngpasc.ac.in', 'JAGADESH', 'P', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(305, '201CS124', '201cs124@drngpasc.ac.in', 'KARTHIKEYAN', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(306, '201CS125', '201cs125@drngpasc.ac.in', 'KAVIN', 'V', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(307, '201CS126', '201cs126@drngpasc.ac.in', 'KAVIYASRI', 'P', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(308, '201CS127', '201cs127@drngpasc.ac.in', 'KEERTHANA', 'P', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(309, '201CS128', '201cs128@drngpasc.ac.in', 'LINGESHWARAN', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(310, '201CS129', '201cs129@drngpasc.ac.in', 'LOGESH', 'T', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(311, '201CS130', '201cs130@drngpasc.ac.in', 'MONISHA', 'E', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(312, '201CS131', '201cs131@drngpasc.ac.in', 'MUKHILAN', 'V P', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(313, '201CS132', '201cs132@drngpasc.ac.in', 'NARMATHA', 'R G', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(314, '201CS133', '201cs133@drngpasc.ac.in', 'NAVANEETHA KRISHNAN', 'T', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(315, '201CS134', '201cs134@drngpasc.ac.in', 'NAVEEN RAJ', 'R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(316, '201CS135', '201cs135@drngpasc.ac.in', 'NEHA', 'K S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(317, '201CS136', '201cs136@drngpasc.ac.in', 'PRADEEP KUMAR', 'P', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(318, '201CS137', '201cs137@drngpasc.ac.in', 'PRAVEEN', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(319, '201CS138', '201cs138@drngpasc.ac.in', 'PRIYADHARSAN', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(320, '201CS139', '201cs139@drngpasc.ac.in', 'RAGHUL', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(321, '201CS140', '201cs140@drngpasc.ac.in', 'RAMKUMAR', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(322, '201CS141', '201cs141@drngpasc.ac.in', 'RUBAN RAAJ', 'K', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(323, '201CS142', '201cs142@drngpasc.ac.in', 'SANDHIYA', 'M', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(324, '201CS143', '201cs143@drngpasc.ac.in', 'SANJAYKUMAR', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(325, '201CS144', '201cs144@drngpasc.ac.in', 'SANJITH ROHAN', 'R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(326, '201CS145', '201cs145@drngpasc.ac.in', 'SATHESHKUMAR', 'B', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(327, '201CS146', '201cs146@drngpasc.ac.in', 'SHARMILA', 'A', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(328, '201CS148', '201cs148@drngpasc.ac.in', 'SOWMIYA', 'T', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(329, '201CS149', '201cs149@drngpasc.ac.in', 'SRICHARAN', 'D', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(330, '201CS150', '201cs150@drngpasc.ac.in', 'SRIVIGNESH', 'G', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(331, '201CS151', '201cs151@drngpasc.ac.in', 'SUBANESH', 'K', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(332, '201CS152', '201cs152@drngpasc.ac.in', 'SURESH', 'J S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(333, '201CS153', '201cs153@drngpasc.ac.in', 'SWETHA', 'B S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(334, '201CS154', '201cs154@drngpasc.ac.in', 'THEPAAK RAAJHAN', 'D', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(335, '201CS155', '201cs155@drngpasc.ac.in', 'VASANTHBALA', 'K S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(336, '201CS156', '201cs156@drngpasc.ac.in', 'VIDHARSHNA', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(337, '201CS157', '201cs157@drngpasc.ac.in', 'NADHIYA', 'P', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(338, '201CS158', '201cs158@drngpasc.ac.in', 'BHARANIDHARAN', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(339, '201CS159', '201cs159@drngpasc.ac.in', 'ASWIN KUMAR', 'M', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-17 09:45:29', 1, '2023-02-17 09:45:29', 1),
(340, '221CS115', '221cs115@drngpasc.ac.in', 'DIVYADHARSHINI', 'M', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 09:50:32', 1, '2023-02-17 09:50:32', 1),
(341, '221CS116', '221cs116@drngpasc.ac.in', 'GIRI RAMA CHANDRA', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 09:53:04', 1, '2023-02-17 09:53:04', 1),
(342, '221CS117', '221cs117@drngpasc.ac.in', 'GLORY', 'L', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 09:55:50', 1, '2023-02-17 09:55:50', 1),
(343, '221CS120', '221cs120@drngpasc.ac.in', 'HARI KRISHNA', 'P', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 09:56:40', 1, '2023-02-17 09:56:40', 1),
(344, '221CS119', '221cs119@drngpasc.ac.in', 'GOWTHAM', 'E', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 09:57:26', 1, '2023-02-17 09:57:26', 1),
(345, '221CS121', '221cs121@drngpasc.ac.in', 'HARINI', 'S N', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(346, '221CS122', '221cs122@drngpasc.ac.in', 'HARIPRASATH', 'M', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(347, '221CS123', '221cs123@drngpasc.ac.in', 'JANARANJANI', 'D', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(348, '221CS124', '221cs124@drngpasc.ac.in', 'JANARTHAN', 'J', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(349, '221CS125', '221cs125@drngpasc.ac.in', 'JAYA SHREE', 'B', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(350, '221CS126', '221cs126@drngpasc.ac.in', 'KAAVIYA', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(351, '221CS127', '221cs127@drngpasc.ac.in', 'KAVINESH', 'S R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(352, '221CS128', '221cs128@drngpasc.ac.in', 'KAVIYA SRI', 'V', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(353, '221CS129', '221cs129@drngpasc.ac.in', 'KEVIN COSTER', 'A', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(354, '221CS130', '221cs130@drngpasc.ac.in', 'LOGESHWARAN', 'C K', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(355, '221CS131', '221cs131@drngpasc.ac.in', 'MAHARAJA', 'A', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(356, '221CS132', '221cs132@drngpasc.ac.in', 'MOHAMMAD SALMAAN', 'M', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(357, '221CS133', '221cs133@drngpasc.ac.in', 'MURALIDHARAN', 'M', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(358, '221CS134', '221cs134@drngpasc.ac.in', 'NIFRAS', 'A', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(359, '221CS135', '221cs135@drngpasc.ac.in', 'NIMMY', 'A', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(360, '221CS136', '221cs136@drngpasc.ac.in', 'PRAGATHI', 'V P', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(361, '221CS137', '221cs137@drngpasc.ac.in', 'PREETHIKA', 'A', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(362, '221CS138', '221cs138@drngpasc.ac.in', 'RAHUL', 'D', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(363, '221CS139', '221cs139@drngpasc.ac.in', 'RINESH', 'A R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(364, '221CS140', '221cs140@drngpasc.ac.in', 'RITHIK', 'R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(365, '221CS141', '221cs141@drngpasc.ac.in', 'SANJAI PRASAATH', 'R B', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(366, '221CS142', '221cs142@drngpasc.ac.in', 'SANJEEV', 'R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(367, '221CS143', '221cs143@drngpasc.ac.in', 'SANTHOSH', 'M', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(368, '221CS144', '221cs144@drngpasc.ac.in', 'SASIDHARAN', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(369, '221CS145', '221cs145@drngpasc.ac.in', 'SATHANANTHAVATHI', 'P T', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(370, '221CS146', '221cs146@drngpasc.ac.in', 'SHALINI', 'R R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(371, '221CS147', '221cs147@drngpasc.ac.in', 'SHOBANA', 'A', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(372, '221CS148', '221cs148@drngpasc.ac.in', 'SHRI HARI', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(373, '221CS149', '221cs149@drngpasc.ac.in', 'SHRIMIKA', 'P', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(374, '221CS150', '221cs150@drngpasc.ac.in', 'SIRAJDHEEN', 'M', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(375, '221CS151', '221cs151@drngpasc.ac.in', 'SIVANYA', 'N', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(376, '221CS152', '221cs152@drngpasc.ac.in', 'SOWMIYA', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(377, '221CS153', '221cs153@drngpasc.ac.in', 'SRI DHARANI', 'N', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(378, '221CS154', '221cs154@drngpasc.ac.in', 'SRIDHAR IYAN', 'R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(379, '221CS155', '221cs155@drngpasc.ac.in', 'SRIKANTH', 'K', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(380, '221CS156', '221cs156@drngpasc.ac.in', 'SUBHASRI', 'J', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(381, '221CS157', '221cs157@drngpasc.ac.in', 'SURYANAATH', 'P M', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(382, '221CS158', '221cs158@drngpasc.ac.in', 'SWETHA', 'M', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(383, '221CS159', '221cs159@drngpasc.ac.in', 'VARSHA', 'G', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(384, '221CS160', '221cs160@drngpasc.ac.in', 'VIGNESH', 'G', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(385, '221CS161', '221cs161@drngpasc.ac.in', 'VISALENI', 'R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(386, '221CS162', '221cs162@drngpasc.ac.in', 'VIVIN', 'R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(387, '221CS163', '221cs163@drngpasc.ac.in', 'KARTHICK', 'R S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(388, '221CS164', '221cs164@drngpasc.ac.in', 'ANBU SELVA KUMAR', 'M', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(389, '221CS165', '221cs165@drngpasc.ac.in', 'KRISHNA PRASAD', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(390, '221CS167', '221cs167@drngpasc.ac.in', 'NIKITHA', 'V', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(391, '221CS168', '221cs168@drngpasc.ac.in', 'EMAYA KEERTHI', 'J', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-17 17:15:37', 1, '2023-02-17 17:15:37', 1),
(392, '221CS001', '221cs001@drngpasc.ac.in', 'AJAY', 'K', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(393, '221CS002', '221cs002@drngpasc.ac.in', 'ARUN', 'M V', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(394, '221CS003', '221cs003@drngpasc.ac.in', 'AVANTIKA', 'G', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(395, '221CS004', '221cs004@drngpasc.ac.in', 'DHARSHINI', 'G', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(396, '221CS005', '221cs005@drngpasc.ac.in', 'FINNY', 'J', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(397, '221CS006', '221cs006@drngpasc.ac.in', 'GNANADEEPIKA', 'M R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(398, '221CS007', '221cs007@drngpasc.ac.in', 'GOMATHI', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(399, '221CS008', '221cs008@drngpasc.ac.in', 'GOWTHAM', 'C', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(400, '221CS009', '221cs009@drngpasc.ac.in', 'GUHAN', 'R', '1234567890', 'd41d8cd98f00b204e9800998ecf8427e', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:49:31', 1),
(401, '221CS010', '221cs010@drngpasc.ac.in', 'HARI KRISHNA', 'D', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(402, '221CS011', '221cs011@drngpasc.ac.in', 'HARI PRAKASH', 'K N', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(403, '221CS012', '221cs012@drngpasc.ac.in', 'HARIHARAN', 'K', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(404, '221CS013', '221cs013@drngpasc.ac.in', 'HARSHAVARDHINI', 'R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(405, '221CS014', '221cs014@drngpasc.ac.in', 'HEMALATHA', 'R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(406, '221CS015', '221cs015@drngpasc.ac.in', 'JAGAN', 'T', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(407, '221CS016', '221cs016@drngpasc.ac.in', 'JAYASREE', 'R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(408, '221CS017', '221cs017@drngpasc.ac.in', 'JEFFRY EMMANUEL', 'F', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(409, '221CS018', '221cs018@drngpasc.ac.in', 'JUSTIN SAM EBINEZAR', 'B', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(410, '221CS019', '221cs019@drngpasc.ac.in', 'KARTHICK', 'G', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(411, '221CS020', '221cs020@drngpasc.ac.in', 'KAVINDRA', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(412, '221CS021', '221cs021@drngpasc.ac.in', 'KAVIYA', 'K', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(413, '221CS022', '221cs022@drngpasc.ac.in', 'KIRAN LAKSHUMA CHANDRA', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(414, '221CS023', '221cs023@drngpasc.ac.in', 'KOWSALYA', 'A', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(415, '221CS024', '221cs024@drngpasc.ac.in', 'KRISHNAA', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(416, '221CS025', '221cs025@drngpasc.ac.in', 'MADHUMITHA', 'V', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(417, '221CS026', '221cs026@drngpasc.ac.in', 'MAHALINGAM', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(418, '221CS027', '221cs027@drngpasc.ac.in', 'MARTINA EVANGELIN', 'M', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(419, '221CS029', '221cs029@drngpasc.ac.in', 'MIRTHIKA', 'P', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(420, '221CS030', '221cs030@drngpasc.ac.in', 'MITHUN', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(421, '221CS031', '221cs031@drngpasc.ac.in', 'MOHAMED SHAHEER', 'M', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(422, '221CS032', '221cs032@drngpasc.ac.in', 'MOHAMMAD IRFAN', 'I', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(423, '221CS033', '221cs033@drngpasc.ac.in', 'MONIKA', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(424, '221CS034', '221cs034@drngpasc.ac.in', 'NEEBAPRIYA', 'V', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(425, '221CS035', '221cs035@drngpasc.ac.in', 'NISHA', 'K K', '1234567890', 'd41d8cd98f00b204e9800998ecf8427e', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-20 10:47:42', 1),
(426, '221CS036', '221cs036@drngpasc.ac.in', 'NISHANTH', 'M', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(427, '221CS037', '221cs037@drngpasc.ac.in', 'NISHANTHINI', 'K', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(428, '221CS038', '221cs038@drngpasc.ac.in', 'NITHESH KUMAR', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(429, '221CS039', '221cs039@drngpasc.ac.in', 'NITHISH KUMAR', 'N', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(430, '221CS040', '221cs040@drngpasc.ac.in', 'NITHYA SHREE', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(431, '221CS041', '221cs041@drngpasc.ac.in', 'PRAVEENA', 'S J', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(432, '221CS042', '221cs042@drngpasc.ac.in', 'PREETHIKA', 'T', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(433, '221CS043', '221cs043@drngpasc.ac.in', 'PRIYADHARSHINI', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(434, '221CS044', '221cs044@drngpasc.ac.in', 'RAHUL', 'L M', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(435, '221CS045', '221cs045@drngpasc.ac.in', 'SAAGAR', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(436, '221CS046', '221cs046@drngpasc.ac.in', 'SANJEEV', 'J', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(437, '221CS047', '221cs047@drngpasc.ac.in', 'SANTHOSH', 'M', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(438, '221CS048', '221cs048@drngpasc.ac.in', 'SARAVANA MURUGAN', 'R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(439, '221CS049', '221cs049@drngpasc.ac.in', 'SENTHIL PRABHU', 'V', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(440, '221CS050', '221cs050@drngpasc.ac.in', 'SHARMISHTA', 'V R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(441, '221CS051', '221cs051@drngpasc.ac.in', 'SHRIVATHSAN', 'V R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(442, '221CS052', '221cs052@drngpasc.ac.in', 'SHYAM SUNTHAR', 'A', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(443, '221CS054', '221cs054@drngpasc.ac.in', 'SOWMIYA', 'A', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(444, '221CS055', '221cs055@drngpasc.ac.in', 'SRIRAM', 'K', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(445, '221CS056', '221cs056@drngpasc.ac.in', 'SUTHICKSAN', 'S S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(446, '221CS057', '221cs057@drngpasc.ac.in', 'SWATHI', 'V', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(447, '221CS058', '221cs058@drngpasc.ac.in', 'SWETHA', 'N', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(448, '221CS059', '221cs059@drngpasc.ac.in', 'VAISHNAVI', 'P', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(449, '221CS060', '221cs060@drngpasc.ac.in', 'YOGESH', 'G P', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(450, '221CS061', '221cs061@drngpasc.ac.in', 'YOGESHWARAN', 'R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(451, '221CS062', '221cs062@drngpasc.ac.in', 'GOVINDARAJ', 'A', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(452, '221CS064', '221cs064@drngpasc.ac.in', 'ROJ DANIEL', 'J', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(453, '221CS065', '221cs065@drngpasc.ac.in', 'ABINASRI', 'K', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(454, '221CS066', '221cs066@drngpasc.ac.in', 'RAMYA', 'V', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(455, '221CS067', '221cs067@drngpasc.ac.in', 'BOOBALAN', 'R', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(456, '221CS068', '221cs068@drngpasc.ac.in', 'KAIF', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(457, '221CS069', '221cs069@drngpasc.ac.in', 'SOORYA', 'B', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 5, 1, NULL, '2023-02-19 17:48:20', 1, '2023-02-19 17:48:20', 1),
(458, '201CS020', '201cs020@drngpasc.ac.in', 'ILAYA BHARATHI', 'A S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 7, 1, NULL, '2023-02-19 18:14:00', 1, '2023-02-19 18:14:00', 1),
(459, '211CS153', '211cs153@drngpasc.ac.in', 'BHARATH KUMAR', 'S', '1234567890', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, NULL, 4, 6, 1, NULL, '2023-02-20 10:56:15', 1, '2023-02-20 10:56:15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_halls`
--

CREATE TABLE `tbl_halls`(
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `start_time` varchar(64) NOT NULL,
  `end_time` varchar(64) NOT NULL,
  `room` int(11) NOT NULL,
  `exam_details` longtext NOT NULL,
  `allocated` int(11) NOT NULL,
  `remaining` int(11) NOT NULL,
  `staff` int(11) NOT NULL,
  `notify_date` date NOT NULL,
  `is_notified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Table structure for table `tbl_hall_student`
--

CREATE TABLE `tbl_hall_student`(
  `id` int(11) NOT NULL,
  `hall_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `is_notified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_batch`
--
ALTER TABLE `tbl_batch`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dept` (`dept`);

--
-- Indexes for table `tbl_block`
--
ALTER TABLE `tbl_block`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dept` (`dept`);

--
-- Indexes for table `tbl_department`
--
ALTER TABLE `tbl_department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_email_service`
--
ALTER TABLE `tbl_email_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_exams`
--
ALTER TABLE `tbl_exams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_dept` (`exam_dept`),
  ADD KEY `exam_batch` (`exam_batch`);

--
-- Indexes for table `tbl_room`
--
ALTER TABLE `tbl_room`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dept` (`dept`),
  ADD KEY `block` (`block`);

--
-- Indexes for table `tbl_staff`
--
ALTER TABLE `tbl_staff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `firstname` (`firstname`),
  ADD KEY `lastname` (`lastname`),
  ADD KEY `staff_department` (`staff_department`);

--
-- Indexes for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_department` (`student_department`),
  ADD KEY `student_batch` (`student_batch`);

--
-- Indexes for table `tbl_halls`
--
ALTER TABLE `tbl_halls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room` (`room`),
  ADD KEY `staff` (`staff`);

--
-- Indexes for table `tbl_hall_student`
--
ALTER TABLE `tbl_hall_student`
  ADD PRIMARY KEY (`id`),
  ADD KEY (`hall_id`),
  ADD KEY (`exam_id`),
  ADD KEY (`s_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_department`
--
ALTER TABLE `tbl_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_batch`
--
ALTER TABLE `tbl_batch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_block`
--
ALTER TABLE `tbl_block`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_email_service`
--
ALTER TABLE `tbl_email_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_exams`
--
ALTER TABLE `tbl_exams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_room`
--
ALTER TABLE `tbl_room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_staff`
--
ALTER TABLE `tbl_staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_student`
--
ALTER TABLE `tbl_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=460;

--
-- AUTO_INCREMENT for table `tbl_halls`
--
ALTER TABLE `tbl_halls` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_hall_student`
--
ALTER TABLE `tbl_hall_student` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
