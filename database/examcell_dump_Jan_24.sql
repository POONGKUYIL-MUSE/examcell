-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2023 at 07:23 AM
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
(1, 1, 'BE 2021'),
(2, 1, 'ME 2021'),
(3, 2, 'BTECH 2017'),
(4, 3, 'BE 2021');

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
(1, 1, 'CS1'),
(2, 1, 'CS2'),
(3, 3, 'M1'),
(4, 3, 'M2'),
(5, 2, 'IT1'),
(6, 2, 'IT2');

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
(1, 'Computer Science', 'computer-science'),
(2, 'IT Department', 'it-department'),
(3, 'Mechanical', 'mechanical');

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
  `exam_start_time` varchar(64) NOT NULL,
  `exam_end_time` varchar(64) DEFAULT NULL,
  `exam_dept` int(11) NOT NULL,
  `exam_batch` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_exams`
--

INSERT INTO `tbl_exams` (`id`, `exam_name`, `exam_subject_name`, `exam_subject_code`, `exam_date`, `exam_start_time`, `exam_end_time`, `exam_dept`, `exam_batch`, `status`) VALUES
(1, 'CAT 1', 'DAPA', '18CGPF0', '2023-01-21', '09:30', '12:00', 1, 2, 1),
(2, 'CAT 2', 'OS', '18CGIT0', '2023-01-21', '09:00', '12:00', 2, 3, 1),
(3, 'CAT 1', 'Systems & Mechanics', 'ITPF023', '2023-01-22', '09:00', '12:00', 3, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_halls`
--

CREATE TABLE `tbl_halls` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `start_time` varchar(64) NOT NULL,
  `end_time` varchar(64) NOT NULL,
  `room` int(11) NOT NULL,
  `exam_details` longtext NOT NULL,
  `allocated` int(11) NOT NULL,
  `remaining` int(11) NOT NULL,
  `staff` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_halls`
--

INSERT INTO `tbl_halls` (`id`, `date`, `start_time`, `end_time`, `room`, `exam_details`, `allocated`, `remaining`, `staff`) VALUES
(1, '2023-01-21', '09:00', '12:00', 2, '[{\"exam_id\":\"1\",\"exam_dept\":\"1\",\"exam_batch\":\"2\",\"exam_capacity\":5},{\"exam_id\":\"2\",\"exam_dept\":\"2\",\"exam_batch\":\"3\",\"exam_capacity\":5}]', 5, 0, 4),
(2, '2023-01-21', '09:00', '12:00', 3, '[{\"exam_id\":\"1\",\"exam_dept\":\"1\",\"exam_batch\":\"2\",\"exam_capacity\":5},{\"exam_id\":\"2\",\"exam_dept\":\"2\",\"exam_batch\":\"3\",\"exam_capacity\":5}]', 4, 0, 2),
(3, '2023-01-21', '09:00', '12:00', 4, '[{\"exam_id\":\"1\",\"exam_dept\":\"1\",\"exam_batch\":\"2\",\"exam_capacity\":5},{\"exam_id\":\"2\",\"exam_dept\":\"2\",\"exam_batch\":\"3\",\"exam_capacity\":5}]', 1, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hall_student`
--

CREATE TABLE `tbl_hall_student` (
  `id` int(11) NOT NULL,
  `hall_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_hall_student`
--

INSERT INTO `tbl_hall_student` (`id`, `hall_id`, `exam_id`, `s_id`) VALUES
(1, 1, 1, 5),
(2, 1, 2, 7),
(3, 1, 1, 2),
(4, 1, 2, 9),
(5, 1, 1, 4),
(6, 2, 2, 6),
(7, 2, 1, 1),
(8, 2, 2, 10),
(9, 2, 1, 3),
(10, 3, 2, 8);

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
(1, 1, 1, 'C101', 5, 3, 2),
(2, 1, 1, 'C102', 5, 3, 2),
(3, 1, 2, 'C201', 4, 2, 2),
(4, 1, 2, 'C202', 4, 2, 2),
(5, 3, 3, 'M301', 5, 3, 2);

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

INSERT INTO `tbl_staff` (`id`, `email`, `firstname`, `lastname`, `phonenumber`, `password`, `profile_image`, `staff_department`, `admin`, `active`, `media_path_slug`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'admin@examcell.com', 'Admin', 'Examcell', '9876543210', '0e7517141fb53f21ee439b355b5a1d0a', NULL, 0, 1, 1, NULL, '2023-01-15 18:50:37', 1, '2023-01-15 18:50:37', 1),
(2, 'paavai@gmail.com', 'Senthamizh', 'Paavai', '8754219630', '1faddc7dda6207f62633f1575448e3d8', NULL, 1, 0, 1, NULL, '2023-01-15 19:12:05', 1, '2023-01-15 19:12:05', 1),
(3, 'gautam@gmail.com', 'Gautam', 'J', '7845962130', 'd41d8cd98f00b204e9800998ecf8427e', NULL, 1, 0, 1, NULL, '2023-01-15 19:12:41', 1, '2023-01-16 14:55:14', 1),
(4, 'rajesh@gmail.com', 'Rajesh', 'R', '8547123690', 'd41d8cd98f00b204e9800998ecf8427e', NULL, 2, 0, 1, NULL, '2023-01-18 10:47:37', 1, '2023-01-20 18:35:46', 1);

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

INSERT INTO `tbl_student` (`id`, `regno`, `email`, `firstname`, `lastname`, `phonenumber`, `password`, `profile_image`, `student_department`, `student_batch`, `active`, `media_path_slug`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, '21CS005', 'poongkuyilmuse@gmail.com', 'Poongkuyil', 'Muse', '7845120963', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, 1, 2, 1, NULL, '2023-01-16 14:47:20', 1, '2023-01-16 14:47:20', 1),
(2, '21CS014', 'sri@gmail.com', 'Srimadhi', 'J', '8956231470', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, 1, 2, 1, NULL, '2023-01-16 14:47:59', 1, '2023-01-16 14:47:59', 1),
(3, '21CS007', 'prasanna@gmail.com', 'Prasanna', 'S', '7845129630', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, 1, 2, 1, NULL, '2023-01-16 14:48:29', 1, '2023-01-16 14:48:29', 1),
(4, '21CS004', 'lece@gmail.com', 'Lece', 'Thomsan', '7845128520', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, 1, 2, 1, NULL, '2023-01-16 14:49:05', 1, '2023-01-16 14:49:05', 1),
(5, '21CS001', 'ani@gmail.com', 'Aninthitha', 'S', '8745961230', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, 1, 2, 1, NULL, '2023-01-16 14:49:43', 1, '2023-01-16 14:49:43', 1),
(6, '175032', 'revathi@gmail.com', 'Revathi', 'J K', '89567412450', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, 2, 3, 1, NULL, '2023-01-16 14:51:46', 1, '2023-01-16 14:51:46', 1),
(7, '175025', 'sandy@gmail.com', 'Sandhiya', 'K S', '8956457812', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, 2, 3, 1, NULL, '2023-01-16 14:52:10', 1, '2023-01-16 14:52:10', 1),
(8, '175301', 'sridevi@gmail.com', 'Sridevi', 'T R', '9658741245', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, 2, 3, 1, NULL, '2023-01-16 14:52:40', 1, '2023-01-16 14:52:40', 1),
(9, '175028', 'raji@gmail.com', 'Rajarajeswari', 'T', '89774512478', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, 2, 3, 1, NULL, '2023-01-16 14:53:31', 1, '2023-01-16 14:53:31', 1),
(10, '175042', 'nandhini@gmail.com', 'Nandhini', 'Selvi', '8574126985', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, 2, 3, 1, NULL, '2023-01-16 14:54:49', 1, '2023-01-16 14:54:49', 1),
(11, '21M001', 'vijay@gmail.com', 'Vijay', 'Karthick', '8547129632', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, 3, 4, 1, NULL, '2023-01-18 10:48:50', 1, '2023-01-18 10:48:50', 1),
(12, '21M002', 'ajith@gmail.com', 'Ajith', 'Kumar', '9854712630', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, 3, 4, 1, NULL, '2023-01-18 10:49:23', 1, '2023-01-18 10:49:23', 1),
(13, '21M004', 'sharan@gmail.com', 'Sharan', 'S', '9658741230', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, 3, 4, 1, NULL, '2023-01-18 10:49:58', 1, '2023-01-18 10:49:58', 1),
(14, '21M008', 'ezhil@gmail.com', 'Ezhil', 'Arasan', '9854712630', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, 3, 4, 1, NULL, '2023-01-18 10:50:28', 1, '2023-01-18 10:50:28', 1),
(18, '21M006', 'naveen@gmail.com', 'Naveen', 'S', '8547120369', 'cd41287b93a9317b6b2d1da8bec1def1', NULL, 3, 4, 1, NULL, '2023-01-24 11:34:52', 1, '2023-01-24 11:35:27', 1);

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
-- Indexes for table `tbl_exams`
--
ALTER TABLE `tbl_exams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_dept` (`exam_dept`),
  ADD KEY `exam_batch` (`exam_batch`);

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
  ADD KEY `hall_id` (`hall_id`),
  ADD KEY `exam_id` (`exam_id`),
  ADD KEY `s_id` (`s_id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_batch`
--
ALTER TABLE `tbl_batch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_block`
--
ALTER TABLE `tbl_block`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_department`
--
ALTER TABLE `tbl_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_exams`
--
ALTER TABLE `tbl_exams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_halls`
--
ALTER TABLE `tbl_halls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_hall_student`
--
ALTER TABLE `tbl_hall_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_room`
--
ALTER TABLE `tbl_room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_staff`
--
ALTER TABLE `tbl_staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_student`
--
ALTER TABLE `tbl_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
