-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2023 at 04:07 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `easy`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_school_classes`
--

CREATE TABLE `tbl_school_classes` (
  `Id` int(10) NOT NULL,
  `year` int(4) NOT NULL,
  `school_id` int(10) NOT NULL,
  `class_name` varchar(11) NOT NULL,
  `class_teacher` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_school_classes`
--

INSERT INTO `tbl_school_classes` (`Id`, `year`, `school_id`, `class_name`, `class_teacher`) VALUES
(7, 2022, 1, 'First', 1),
(8, 2022, 1, 'Second', 1),
(9, 2022, 1, 'Third', 2),
(10, 2022, 1, '4th', 1),
(11, 2022, 1, '5th', 1),
(13, 2023, 1, 'PP 3+', 3),
(18, 2023, 1, 'PP 4+', 3),
(19, 2023, 1, '1st', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_school_list`
--

CREATE TABLE `tbl_school_list` (
  `Id` int(11) NOT NULL,
  `nameofschool` varchar(200) NOT NULL,
  `address` varchar(150) NOT NULL,
  `name_of_hm` varchar(50) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `reg_date` date NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` int(1) NOT NULL,
  `added_by` int(2) NOT NULL COMMENT '0=Admin, <0=Agents'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_school_list`
--

INSERT INTO `tbl_school_list` (`Id`, `nameofschool`, `address`, `name_of_hm`, `mobile`, `reg_date`, `username`, `password`, `status`, `added_by`) VALUES
(1, 'Jawahar Navodaya Vidyalaya', 'Gajner, Bikaner', 'M.L. Verma', '9001881117', '2023-06-20', '9001881117', '123456', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_session_list`
--

CREATE TABLE `tbl_session_list` (
  `Id` int(10) NOT NULL,
  `school_username` varchar(10) NOT NULL,
  `purchased_session` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_session_list`
--

INSERT INTO `tbl_session_list` (`Id`, `school_username`, `purchased_session`) VALUES
(1, '9001881117', '2022'),
(2, '9001881117', '2023'),
(3, '9001881116', '2023');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student`
--

CREATE TABLE `tbl_student` (
  `Id` int(10) NOT NULL,
  `year` int(11) NOT NULL,
  `school_id` int(3) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `father_name` varchar(100) NOT NULL,
  `mother_name` varchar(100) NOT NULL,
  `dateofbirth` varchar(12) NOT NULL,
  `category` varchar(10) NOT NULL,
  `address` varchar(150) NOT NULL,
  `student_class` int(10) DEFAULT NULL,
  `admissionno` varchar(10) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `rollno` varchar(5) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `aadhar` varchar(12) NOT NULL,
  `photo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_student`
--

INSERT INTO `tbl_student` (`Id`, `year`, `school_id`, `student_name`, `father_name`, `mother_name`, `dateofbirth`, `category`, `address`, `student_class`, `admissionno`, `gender`, `rollno`, `mobile`, `aadhar`, `photo`) VALUES
(1, 2022, 1, 'jkuylkj', 'dfhfjh', 'dfgdfgdfg', '06/22/2023', 'OBC', 'ffgjghj', 8, '1536', 'Male', '111', '25436756', '', ''),
(2, 2022, 1, 'hjsgjkl', 'jhgjkl;', 'gvhjbknl;', '06/22/2023', '', 'jhkjll', 9, '79465132', 'Female', '78452', '5655', '', ''),
(3, 2022, 1, 'gfhjkl', 'ghjkbn', 'ghjbnm', '06/22/2023', '', 'fghjkl;', 10, 'hbjknlm,', 'Female', '87645', '465132', '8974651', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teachers`
--

CREATE TABLE `tbl_teachers` (
  `Id` int(10) NOT NULL,
  `year` int(4) NOT NULL,
  `school_id` varchar(10) NOT NULL,
  `teacher_name` varchar(50) NOT NULL,
  `designation` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_teachers`
--

INSERT INTO `tbl_teachers` (`Id`, `year`, `school_id`, `teacher_name`, `designation`) VALUES
(1, 2022, '1', 'Rajendra Kumar', ''),
(2, 2022, '1', 'Vinod Kumar', ''),
(3, 2023, '1', 'Suresh Kumar', ''),
(4, 2023, '1', 'Santosh Kumar', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_school_classes`
--
ALTER TABLE `tbl_school_classes`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `tbl_school_classes_ibfk_1` (`class_teacher`);

--
-- Indexes for table `tbl_school_list`
--
ALTER TABLE `tbl_school_list`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tbl_session_list`
--
ALTER TABLE `tbl_session_list`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `class_fk` (`student_class`);

--
-- Indexes for table `tbl_teachers`
--
ALTER TABLE `tbl_teachers`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_school_classes`
--
ALTER TABLE `tbl_school_classes`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_school_list`
--
ALTER TABLE `tbl_school_list`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_session_list`
--
ALTER TABLE `tbl_session_list`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_student`
--
ALTER TABLE `tbl_student`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_teachers`
--
ALTER TABLE `tbl_teachers`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_school_classes`
--
ALTER TABLE `tbl_school_classes`
  ADD CONSTRAINT `tbl_school_classes_ibfk_1` FOREIGN KEY (`class_teacher`) REFERENCES `tbl_teachers` (`Id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD CONSTRAINT `class_fk` FOREIGN KEY (`student_class`) REFERENCES `tbl_school_classes` (`Id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
