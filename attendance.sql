-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2023 at 11:05 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance_details`
--

CREATE TABLE `attendance_details` (
  `attendance_id` int(100) NOT NULL,
  `serial` int(100) NOT NULL,
  `student_roll` varchar(55) NOT NULL,
  `name` varchar(55) NOT NULL,
  `course_code` varchar(55) NOT NULL,
  `dept_name` varchar(55) NOT NULL,
  `session` varchar(55) NOT NULL,
  `semester` int(100) NOT NULL,
  `status` varchar(55) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance_details`
--

INSERT INTO `attendance_details` (`attendance_id`, `serial`, `student_roll`, `name`, `course_code`, `dept_name`, `session`, `semester`, `status`, `date`) VALUES
(78, 1, 'MUH2025001M', 'Fardin Alam Alif', 'CSE 502', 'Software Engineering', '2019-2020', 5, 'present', '2023-09-14'),
(79, 2, 'BFH2025002F', 'Fazilater Jahan', 'CSE 502', 'Software Engineering', '2019-2020', 5, 'present', '2023-09-14'),
(80, 3, 'MUH2025003M', 'Shoriful Habib', 'CSE 502', 'Software Engineering', '2019-2020', 5, 'present', '2023-09-14'),
(81, 4, 'MUH2025004M', 'Md. Asif Mahmud', 'CSE 502', 'Software Engineering', '2019-2020', 5, 'present', '2023-09-14'),
(82, 5, 'MUH2025005M', 'Md. Rabiul Islam Santo', 'CSE 502', 'Software Engineering', '2019-2020', 5, 'present', '2023-09-14'),
(83, 6, 'BKH2025006F', 'Nure Jannat', 'CSE 502', 'Software Engineering', '2019-2020', 5, 'present', '2023-09-14'),
(84, 7, 'MUH2025007M', 'Mir Mohammad Tahsin', 'CSE 502', 'Software Engineering', '2019-2020', 5, 'present', '2023-09-14'),
(85, 8, 'MUH2025008M', 'Kazi Ashikur Rahman', 'CSE 502', 'Software Engineering', '2019-2020', 5, 'present', '2023-09-14'),
(86, 9, 'BFH2025009F', 'Jannatun Nur Etu', 'CSE 502', 'Software Engineering', '2019-2020', 5, 'present', '2023-09-14'),
(87, 10, 'BFH2025010F', 'Sanjida Akter Samanta', 'CSE 502', 'Software Engineering', '2019-2020', 5, 'present', '2023-09-14'),
(88, 11, 'MUH2025011M', 'Md. Mahbub Hasan Talukder', 'CSE 502', 'Software Engineering', '2019-2020', 5, 'present', '2023-09-14');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_code` varchar(55) NOT NULL,
  `course_name` varchar(55) NOT NULL,
  `dept_name` varchar(55) NOT NULL,
  `session` varchar(55) NOT NULL,
  `semester` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_code`, `course_name`, `dept_name`, `session`, `semester`) VALUES
('BUS 503', 'Business Communications', 'Software Engineering', '2019-2020', 5),
('CSE 501', 'Professional Ethics for Information Systems', 'Software Engineering', '2019-2020', 5),
('CSE 502', 'Web Technology', 'Software Engineering', '2019-2020', 5),
('CSE 504', 'Data Science and Analytics – DBMS II', 'Software Engineering', '2019-2020', 5);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_code` varchar(55) NOT NULL,
  `dept_name` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_code`, `dept_name`) VALUES
('CSE', 'Computer Science And Engineering'),
('ICE', 'Information And Communication Engineering'),
('SE', 'Software Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `serial` int(100) NOT NULL,
  `roll_number` varchar(55) NOT NULL,
  `name` varchar(55) NOT NULL,
  `dept_name` varchar(55) NOT NULL,
  `session` varchar(55) NOT NULL,
  `semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`serial`, `roll_number`, `name`, `dept_name`, `session`, `semester`) VALUES
(1, 'MUH2025001M', 'Fardin Alam Alif', 'Software Engineering', '2019-2020', 5),
(2, 'BFH2025002F', 'Fazilater Jahan', 'Software Engineering', '2019-2020', 5),
(3, 'MUH2025003M', 'Shoriful Habib', 'Software Engineering', '2019-2020', 5),
(4, 'MUH2025004M', 'Md. Asif Mahmud', 'Software Engineering', '2019-2020', 5),
(5, 'MUH2025005M', 'Md. Rabiul Islam Santo', 'Software Engineering', '2019-2020', 5),
(6, 'BKH2025006F', 'Nure Jannat', 'Software Engineering', '2019-2020', 5),
(7, 'MUH2025007M', 'Mir Mohammad Tahsin', 'Software Engineering', '2019-2020', 5),
(8, 'MUH2025008M', 'Kazi Ashikur Rahman', 'Software Engineering', '2019-2020', 5),
(9, 'BFH2025009F', 'Jannatun Nur Etu', 'Software Engineering', '2019-2020', 5),
(10, 'BFH2025010F', 'Sanjida Akter Samanta', 'Software Engineering', '2019-2020', 5),
(11, 'MUH2025011M', 'Md. Mahbub Hasan Talukder', 'Software Engineering', '2019-2020', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance_details`
--
ALTER TABLE `attendance_details`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_code`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_code`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`serial`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance_details`
--
ALTER TABLE `attendance_details`
  MODIFY `attendance_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `serial` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
