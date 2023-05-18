-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2023 at 08:38 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `course`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `name`, `email`, `password`) VALUES
(1, 'ACCOUNTS OFFICER', 'accounts@uni.bd', 'accounts');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(1, 'ADMIN', 'admin@uni.bd', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `advisor`
--

CREATE TABLE `advisor` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `batch` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `advisor`
--

INSERT INTO `advisor` (`id`, `name`, `batch`, `email`, `password`) VALUES
(1, 'KAMRUL SIR', 'CSE01', 'kamrul@uni.bd', 'kamrul'),
(2, 'BOSHIR SIR', 'CSE02', 'boshir@uni.bd', 'boshir'),
(3, 'NAZIM SIR', 'CSE03', 'nazim@uni.bd', 'nazim');

-- --------------------------------------------------------

--
-- Table structure for table `all_courses`
--

CREATE TABLE `all_courses` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `all_courses`
--

INSERT INTO `all_courses` (`id`, `title`, `code`) VALUES
(1, 'Machine Learning', 'CSE1203'),
(2, 'Structured Programming', 'CSE1205'),
(3, 'Basic Accounting', 'ACC3042'),
(4, 'Introduction to OOP', 'CSE1232'),
(5, 'Database Design', 'CSE4321'),
(6, 'Computer Graphics', 'CSE4532'),
(7, 'Software Quality Assurance', 'CSE3221'),
(8, 'Calculus', 'MAT1102'),
(9, 'Algorithm & Data structure', 'CSE3542'),
(10, 'Data Mining', 'CSE1245');

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE `batch` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `advisor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`id`, `name`, `advisor`) VALUES
(1, 'CSE01', 'KAMRUL SIR'),
(2, 'CSE02', 'BOSHIR SIR'),
(3, 'CSE03', 'NAZIM SIR');

-- --------------------------------------------------------

--
-- Table structure for table `confirmed_courses`
--

CREATE TABLE `confirmed_courses` (
  `id` int(11) NOT NULL,
  `course_title` varchar(255) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `confirm_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `confirmed_courses`
--

INSERT INTO `confirmed_courses` (`id`, `course_title`, `student_name`, `confirm_date`) VALUES
(1, 'Database Design', 'farin', '2023-05-13 18:16:38.204818'),
(2, 'Data Mining', 'farin', '2023-05-16 17:15:05.021624');

-- --------------------------------------------------------

--
-- Table structure for table `offered_courses`
--

CREATE TABLE `offered_courses` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `course_teacher` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `semester_name` varchar(255) NOT NULL,
  `year` int(255) NOT NULL,
  `course_credits` int(11) NOT NULL,
  `course_fees` int(11) NOT NULL,
  `approved` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offered_courses`
--

INSERT INTO `offered_courses` (`id`, `title`, `course_teacher`, `semester`, `semester_name`, `year`, `course_credits`, `course_fees`, `approved`) VALUES
(1, 'Database Design', 'KAMRUL SIR', 'Summer 2023', 'Summer', 2023, 3, 2400, 1),
(4, 'Algorithm & Data structure', 'KAMRUL SIR', 'Spring 2023', 'Spring', 2023, 4, 6000, 1),
(5, 'Data Mining', 'KAMRUL SIR', 'Summer 2023', 'Summer', 2023, 4, 5000, 1),
(14, 'Computer Graphics', 'KAMRUL SIR', 'Spring 2023', 'Spring', 2023, 4, 4500, 1);

--
-- Triggers `offered_courses`
--
DELIMITER $$
CREATE TRIGGER `update_semester_courses` AFTER INSERT ON `offered_courses` FOR EACH ROW BEGIN
    UPDATE semester
    SET semester_courses = semester_courses + 1
    WHERE semester_name = NEW.semester_name AND semester_year = NEW.year;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_semester_credits` AFTER INSERT ON `offered_courses` FOR EACH ROW BEGIN
    UPDATE semester
    SET semester_credits = semester_credits + NEW.course_credits
    WHERE semester_name = NEW.semester_name AND semester_year = NEW.year;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `payment_course` varchar(255) NOT NULL,
  `payment_complete` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `student_name`, `payment_course`, `payment_complete`) VALUES
(2, 'farin', 'Algorithm & Data structure', 1),
(3, 'farin', 'Data Mining', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pending_course_requests`
--

CREATE TABLE `pending_course_requests` (
  `id` int(11) NOT NULL,
  `course_title` varchar(255) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `apply_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `con_from_adv` int(11) DEFAULT NULL,
  `con_from_reg` int(11) DEFAULT NULL,
  `con_from_acc` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pending_course_requests`
--

INSERT INTO `pending_course_requests` (`id`, `course_title`, `student_name`, `apply_date`, `con_from_adv`, `con_from_reg`, `con_from_acc`) VALUES
(1, 'Database Design', 'farin', '2023-05-13 18:16:38.200452', 1, 1, 1),
(3, 'Algorithm & Data structure', 'farin', '2023-05-14 14:59:47.843211', 1, 1, 1),
(4, 'Data Mining', 'farin', '2023-05-16 17:15:05.018011', 1, 1, 1);

--
-- Triggers `pending_course_requests`
--
DELIMITER $$
CREATE TRIGGER `course_insert_trigger` AFTER INSERT ON `pending_course_requests` FOR EACH ROW BEGIN
    INSERT INTO payment (student_name, payment_course)
    VALUES (NEW.student_name, NEW.course_title);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `registrar`
--

CREATE TABLE `registrar` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registrar`
--

INSERT INTO `registrar` (`id`, `name`, `email`, `password`) VALUES
(1, 'REGISTRAR', 'registrar@uni.bd', 'registrar');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `id` int(11) NOT NULL,
  `semester_name` varchar(255) NOT NULL,
  `semester_year` int(11) NOT NULL,
  `semester_courses` int(255) NOT NULL,
  `semester_credits` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`id`, `semester_name`, `semester_year`, `semester_courses`, `semester_credits`) VALUES
(1, 'Summer', 2023, 2, 7),
(2, 'Spring', 2023, 2, 8);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `batch` varchar(255) NOT NULL,
  `student_id` int(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `advisor` varchar(255) DEFAULT NULL,
  `credits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `full_name`, `username`, `batch`, `student_id`, `email`, `password`, `advisor`, `credits`) VALUES
(1, 'MD FARIN AHMED', 'farin', 'CSE01', 1233217893, 'farin@gmail.com', 'farin', 'KAMRUL SIR', 50),
(2, 'LAMIA BINTE SARKER', 'lamia', 'CSE02', 439286404, 'lamia@gmail.com', 'lamia', 'BOSHIR SIR', 65),
(5, 'RASHID KHAN', 'rashid', 'CSE03', 765427657, 'rashid@gmail.com', 'rashid', 'NAZIM SIR', 43),
(7, 'MD BALA', 'bala', 'CSE03', 1326543, 'bala@gmail.com', 'bala', 'NAZIM SIR', 45);

--
-- Triggers `students`
--
DELIMITER $$
CREATE TRIGGER `fetch_advisor` BEFORE INSERT ON `students` FOR EACH ROW SET NEW.advisor = (
    SELECT advisor FROM batch WHERE name = NEW.batch LIMIT 1
)
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advisor`
--
ALTER TABLE `advisor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `all_courses`
--
ALTER TABLE `all_courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `batch`
--
ALTER TABLE `batch`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `confirmed_courses`
--
ALTER TABLE `confirmed_courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `confirmed_courses_fk0` (`course_title`),
  ADD KEY `confirmed_courses_fk1` (`student_name`);

--
-- Indexes for table `offered_courses`
--
ALTER TABLE `offered_courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`),
  ADD KEY `courses_fk0` (`course_teacher`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pending_student_fk0` (`student_name`);

--
-- Indexes for table `pending_course_requests`
--
ALTER TABLE `pending_course_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pending_course_requests_fk0` (`course_title`),
  ADD KEY `pending_course_requests_fk1` (`student_name`);

--
-- Indexes for table `registrar`
--
ALTER TABLE `registrar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `student_id` (`student_id`),
  ADD KEY `students_fk0` (`batch`),
  ADD KEY `students_fk1` (`advisor`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `advisor`
--
ALTER TABLE `advisor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `all_courses`
--
ALTER TABLE `all_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `batch`
--
ALTER TABLE `batch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `confirmed_courses`
--
ALTER TABLE `confirmed_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `offered_courses`
--
ALTER TABLE `offered_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pending_course_requests`
--
ALTER TABLE `pending_course_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `registrar`
--
ALTER TABLE `registrar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `confirmed_courses`
--
ALTER TABLE `confirmed_courses`
  ADD CONSTRAINT `confirmed_courses_fk0` FOREIGN KEY (`course_title`) REFERENCES `offered_courses` (`title`),
  ADD CONSTRAINT `confirmed_courses_fk1` FOREIGN KEY (`student_name`) REFERENCES `students` (`username`);

--
-- Constraints for table `offered_courses`
--
ALTER TABLE `offered_courses`
  ADD CONSTRAINT `courses_fk0` FOREIGN KEY (`course_teacher`) REFERENCES `advisor` (`name`),
  ADD CONSTRAINT `offered_courses_fk0` FOREIGN KEY (`title`) REFERENCES `all_courses` (`title`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `pending_student_fk0` FOREIGN KEY (`student_name`) REFERENCES `pending_course_requests` (`student_name`);

--
-- Constraints for table `pending_course_requests`
--
ALTER TABLE `pending_course_requests`
  ADD CONSTRAINT `pending_course_requests_fk0` FOREIGN KEY (`course_title`) REFERENCES `offered_courses` (`title`),
  ADD CONSTRAINT `pending_course_requests_fk1` FOREIGN KEY (`student_name`) REFERENCES `students` (`username`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_fk0` FOREIGN KEY (`batch`) REFERENCES `batch` (`name`),
  ADD CONSTRAINT `students_fk1` FOREIGN KEY (`advisor`) REFERENCES `advisor` (`name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
