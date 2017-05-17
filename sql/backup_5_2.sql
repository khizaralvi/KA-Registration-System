-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 02, 2017 at 11:33 PM
-- Server version: 10.1.20-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id763455_registration_system`
--
CREATE DATABASE IF NOT EXISTS `id763455_registration_system` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `id763455_registration_system`;

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

DROP TABLE IF EXISTS `administrator`;
CREATE TABLE IF NOT EXISTS `administrator` (
  `admin_id` int(11) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`admin_id`) VALUES
(1),
(174),
(179),
(180);

-- --------------------------------------------------------

--
-- Table structure for table `building`
--

DROP TABLE IF EXISTS `building`;
CREATE TABLE IF NOT EXISTS `building` (
  `building_id` int(11) NOT NULL AUTO_INCREMENT,
  `building_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`building_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `building`
--

INSERT INTO `building` (`building_id`, `building_name`) VALUES
(30, 'Science Building'),
(31, 'Math Building'),
(32, 'Madison Building'),
(33, 'Campus Center'),
(34, 'Twin Lakes Building'),
(35, 'Lunalilo Building'),
(36, 'Miner Hall'),
(37, 'Pacemaker Hall'),
(38, 'Stratton Hall'),
(39, 'Leahy Hall'),
(40, 'Allen Center for Business');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_id` int(11) NOT NULL,
  `course_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `course_category` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `course_description` mediumtext COLLATE utf8_unicode_ci,
  `credits` int(11) NOT NULL,
  `is_archived` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`course_id`),
  KEY `course_ibfk1` (`dept_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `dept_id`, `course_name`, `course_category`, `course_description`, `credits`, `is_archived`) VALUES
(1, 1, 'System Design', 'CS 5910', 'Students will learn and implement all system requirements to produce a completely finished product.', 4, 0),
(4, 2, 'Women in Computer Science', 'CS 2010', 'Study the impact of women in computer science.', 4, 0),
(7, 6, 'College Algebra', 'MA 1010', 'College level algebra implementation for math lovers ', 4, 0),
(8, 4, 'English Comp I', 'ES 1010', 'Designed to develop and refine students’ ability to read, write and think critically. Selected essays will be read and studied as models of rhetorical style, enabling students to detect for themselves the effective use of language and to develop an appreciation for masterpieces of non fiction prose. Students will learn to develop the extended essay with particular attention to discovery and organization. Oral communication skills will be sharpened by directed discussion and by presentation and criticism of class papers.', 4, 0),
(9, 6, 'Programming 101', 'CS 1011', 'Introduction to program design and analysis: algorithmic processes, basic programming techniques, program specification & structure, program development, debugging, and testing. Emphasis on programming methodology and style.', 4, 0),
(10, 6, 'Programming 102', 'CS 1012', 'Discussion of storage classes, pointers, recursion, files and string manipulation. Basic data structures and algorithms, data abstractions, and object-oriented programming. Students write intermediate to advance level programs in C++/Java.', 4, 0),
(11, 6, 'Database Management Systems', 'CS 1014', 'Basic concepts: data, information systems, data independence and need for DBMS facilities. The relational model: schema, subschema, relational algebra, relational calculus, SQL, ODBC, JDBC, and SQLJ. Database design: entity-relationship model and normalization. Performance considerations, integrity, security and transaction processing.', 4, 0),
(12, 6, 'Internet And Web', 'CS 1015', 'Survey of Internet technologies and a comprehensive introduction to the programming tools and skills required to build and maintain server sites on the Web.', 4, 0),
(13, 6, 'Computer Networks', 'CS 1016', 'Basic system support for process to process communications across a computer network. The TCP/IP protocol suite and the socket application programmers interface. Development of network application programs based on the client server model.', 4, 0),
(14, 7, 'Spanish II', 'MS 2111', 'Learn advance spanish grammar and spelling', 3, 0),
(15, 19, 'The Art of the study', 'GS 1001', 'how to study like a boss!', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `day`
--

DROP TABLE IF EXISTS `day`;
CREATE TABLE IF NOT EXISTS `day` (
  `day_id` int(11) NOT NULL AUTO_INCREMENT,
  `day` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`day_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `day`
--

INSERT INTO `day` (`day_id`, `day`) VALUES
(1, 'Monday/Wednesday'),
(2, 'Tuesday/Thursday'),
(3, 'Friday/Saturday');

-- --------------------------------------------------------

--
-- Table structure for table `degree`
--

DROP TABLE IF EXISTS `degree`;
CREATE TABLE IF NOT EXISTS `degree` (
  `degree_id` int(11) NOT NULL AUTO_INCREMENT,
  `degree_name` varchar(255) DEFAULT NULL,
  `degree_short` varchar(10) DEFAULT NULL,
  `degree_type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`degree_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `degree`
--

INSERT INTO `degree` (`degree_id`, `degree_name`, `degree_short`, `degree_type`) VALUES
(1, 'Associate of Arts', 'A.A.', 'Associate'),
(2, 'Associate of Science', 'A.S.', 'Associate'),
(3, 'Associate of Science', 'A.A.S.', 'Associate'),
(4, 'Associate of Engineering', 'A.E.', 'Associate'),
(5, 'Associate of Applied Arts', 'A.A.A.', 'Associate'),
(6, 'Associate of Political Science', 'A.P.S.', 'Associate'),
(7, 'Bachelor of Arts', 'B.A.', 'Bachelor'),
(8, 'Bachelor of Science', 'B.S.', 'Bachelor'),
(9, 'Bachelor of Fine Arts', 'B.F.A.', 'Bachelor'),
(10, 'Bachelor of Business Administration', 'B.B.A.', 'Bachelor'),
(11, 'Bachelor of Architecture', 'B.Arch.', 'Bachelor'),
(12, 'Master of Arts', 'M.A.', 'Master'),
(13, 'Master of Research', 'M.Res.', 'Master'),
(14, 'Master of Philosophy', 'M.Phil.', 'Master'),
(15, 'Master of Laws', 'LL.M.', 'Master'),
(16, 'Master of Business Administration', 'M.B.A.', 'Master'),
(17, 'Master of Science', 'M.S.', 'Master'),
(18, 'Master of Fine Arts', 'M.F.A.', 'Master'),
(19, 'Doctor of Philosophy', 'PhD', 'Doctorate'),
(20, 'Doctor of Medicine', 'M.D.', 'Doctorate'),
(21, 'Doctor of Education', 'Ed.D.', 'Doctorate'),
(22, 'Juris Doctor', 'J.D.', 'Doctorate'),
(23, 'Doctor of Osteopathic Medicine', 'D.O.', 'Doctorate'),
(24, 'Master of Arts in Teaching', 'M.A.T.', 'Master'),
(25, 'Bachelor of Professional Studies', 'B.P.S.', 'Bachelor'),
(26, 'Masters of Medicine', 'M.M.M', 'Masters');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `dept_id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_name` varchar(255) DEFAULT NULL,
  `chair_id` int(11) DEFAULT NULL,
  `school_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`dept_id`),
  KEY `chair_id` (`chair_id`),
  KEY `school_id` (`school_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `dept_name`, `chair_id`, `school_id`) VALUES
(1, 'American Studies', 5, 1),
(2, 'Biological Sciences', NULL, 1),
(3, 'Chemistry and Physics', NULL, 1),
(4, 'English', 170, 1),
(5, 'History & Philosophy', NULL, 1),
(6, 'Mathematics, Computers & Information Science', NULL, 1),
(7, 'Modern Languages', 5, 1),
(8, 'Politics, Economics & Law', NULL, 1),
(9, 'Psychology', NULL, 1),
(10, 'Public Health', 7, 1),
(11, 'Sociology', NULL, 1),
(12, 'Visual Arts', NULL, 1),
(13, 'Accounting, Taxation & Business Law', NULL, 2),
(14, 'Management, Marketing & Finance', 5, 2),
(15, 'Adolescence Education', NULL, 3),
(16, 'Childhood Education and Literacy', NULL, 3),
(17, 'Exceptional Education and Learning', 170, 3),
(18, 'School of Professional Studies', NULL, 4),
(19, 'Study Studies', 7, 3);

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

DROP TABLE IF EXISTS `enrollment`;
CREATE TABLE IF NOT EXISTS `enrollment` (
  `student_id` int(11) NOT NULL,
  `crn` int(11) NOT NULL,
  `enroll_date` date NOT NULL,
  PRIMARY KEY (`student_id`,`crn`),
  KEY `crn` (`crn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

DROP TABLE IF EXISTS `faculty`;
CREATE TABLE IF NOT EXISTS `faculty` (
  `faculty_id` int(11) NOT NULL,
  `rank` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `faculty_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`faculty_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`faculty_id`, `rank`, `faculty_type`) VALUES
(5, 'Chair', 'Chair'),
(6, NULL, ''),
(7, NULL, ''),
(8, NULL, ''),
(9, NULL, ''),
(10, NULL, ''),
(11, NULL, ''),
(12, NULL, ''),
(13, NULL, ''),
(14, NULL, ''),
(170, NULL, 'part_time'),
(175, NULL, 'full_time'),
(176, NULL, 'part_time');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_department`
--

DROP TABLE IF EXISTS `faculty_department`;
CREATE TABLE IF NOT EXISTS `faculty_department` (
  `faculty_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  PRIMARY KEY (`faculty_id`,`dept_id`),
  KEY `faculty_department_ibfk_2` (`dept_id`),
  KEY `faculty_id` (`faculty_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `faculty_department`
--

INSERT INTO `faculty_department` (`faculty_id`, `dept_id`) VALUES
(5, 1),
(6, 10),
(7, 19),
(8, 1),
(10, 10),
(11, 1),
(13, 10),
(170, 1),
(175, 8),
(176, 8);

-- --------------------------------------------------------

--
-- Table structure for table `faculty_full_time`
--

DROP TABLE IF EXISTS `faculty_full_time`;
CREATE TABLE IF NOT EXISTS `faculty_full_time` (
  `faculty_id` int(11) NOT NULL,
  `yearly_salary` float NOT NULL,
  PRIMARY KEY (`faculty_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `faculty_full_time`
--

INSERT INTO `faculty_full_time` (`faculty_id`, `yearly_salary`) VALUES
(5, 100000),
(175, 50000);

-- --------------------------------------------------------

--
-- Table structure for table `faculty_part_time`
--

DROP TABLE IF EXISTS `faculty_part_time`;
CREATE TABLE IF NOT EXISTS `faculty_part_time` (
  `faculty_id` int(11) NOT NULL,
  `hourly_rate` float NOT NULL,
  PRIMARY KEY (`faculty_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `faculty_part_time`
--

INSERT INTO `faculty_part_time` (`faculty_id`, `hourly_rate`) VALUES
(170, 40),
(176, 30);

-- --------------------------------------------------------

--
-- Table structure for table `hold`
--

DROP TABLE IF EXISTS `hold`;
CREATE TABLE IF NOT EXISTS `hold` (
  `hold_id` int(11) NOT NULL AUTO_INCREMENT,
  `hold_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `hold_desc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`hold_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hold`
--

INSERT INTO `hold` (`hold_id`, `hold_name`, `hold_desc`) VALUES
(1, 'Academic Hold', 'You have a GPA less than 2.0. Please speak with your advisor or chair of the deparment.'),
(2, 'Financial', 'You have an overdue bill. Please contact the Bursar office.'),
(3, 'Disciplinary', 'Disciplinary proceedings are under investigation. You cannot register at this time.'),
(4, 'Vaccination', 'You are proof of vaccination. Please contact the nurses office.');

-- --------------------------------------------------------

--
-- Table structure for table `major`
--

DROP TABLE IF EXISTS `major`;
CREATE TABLE IF NOT EXISTS `major` (
  `major_id` int(11) NOT NULL AUTO_INCREMENT,
  `major_name` varchar(255) DEFAULT NULL,
  `dept_id` int(11) DEFAULT '0',
  `degree_id` int(11) DEFAULT '0',
  PRIMARY KEY (`major_id`),
  KEY `degree_id` (`degree_id`),
  KEY `dept_id` (`dept_id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `major`
--

INSERT INTO `major` (`major_id`, `major_name`, `dept_id`, `degree_id`) VALUES
(1, 'American Studies, B.A.', 1, 7),
(2, 'Media and Communications, B.A.', 1, 7),
(3, 'Liberal Studies, M.A.', 1, 12),
(4, 'Biological Sciences, B.A.', 2, 7),
(5, 'Adolescence Education: Biology (7-12), B.S.', 2, 8),
(6, 'Biological Sciences, B.S.', 2, 8),
(7, 'Adolescence Education: Biology (7-12), M.A.T.', 2, 24),
(8, 'Adolescence Education: Biology (7-12), M.S.', 2, 17),
(9, 'Adolescence Education: Chemistry (7-12), B.A.', 3, 7),
(10, 'Chemistry, B.A.', 3, 7),
(11, 'Adolescence Education: Chemistry (7-12), B.S.', 3, 8),
(12, 'Biochemistry, B.S.', 3, 8),
(13, 'Chemistry, B.S.', 3, 8),
(14, 'Middle Childhood Education: Chemistry (5-9), B.S.', 3, 8),
(15, 'Adolescence Education: Chemistry (7-12), M.A.T.', 3, 24),
(16, 'Adolescence Education: Chemistry (7-12), M.S.', 3, 17),
(17, 'English, B.A.', 4, 7),
(18, 'Adolescence Education: English Language Arts (7-12), M.A.T.', 4, 24),
(19, 'Adolescence Education: English Language Arts (7-12), M.S.', 4, 17),
(20, 'Adolescence Education: Social Studies (7-12), B.A.', 5, 7),
(21, 'History, B.A.', 5, 7),
(22, 'Philosophy and Religion, B.A.', 5, 7),
(23, 'Adolescence Education: Social Studies (7-12), M.A.T.', 5, 24),
(24, 'Adolescence Education: Social Studies (7-12), M.S.', 5, 17),
(25, 'Adolescence Education: Mathematics (7-12), B.S.', 6, 8),
(26, 'Computer & Information Science, B.S.', 6, 8),
(27, 'Management Information Systems, B.S.', 6, 8),
(28, 'Mathematics, B.S.', 6, 8),
(29, 'Middle Childhood Education: Mathematics (5-9), B.S.', 6, 8),
(30, 'Adolescence Education: Mathematics (7-12), M.A.T.', 6, 24),
(31, 'Adolescence Education: Mathematics (7-12), M.S.', 6, 17),
(32, 'Adolescence Education: Spanish (7-12), B.A.', 7, 7),
(33, 'Spanish Language, Hispanic Literature & Culture, B.A.', 7, 7),
(34, 'Middle Childhood Education: Spanish (5-9), B.S.', 7, 8),
(35, 'Adolescence Education: Spanish (7-12), M.A.T.', 7, 24),
(36, 'Adolescence Education: Spanish (7-12), M.S.', 7, 17),
(37, 'Industrial and Labor Relations, B.A.', 8, 7),
(38, 'Politics, Economics & Law, B.A.', 8, 7),
(39, 'Industrial and Labor Relations, B.S.', 8, 8),
(40, 'Psychology, B.A.', 9, 7),
(41, 'Psychology, B.S.', 9, 8),
(42, 'Mental Health Counseling, M.S.', 9, 17),
(43, 'Health and Society, B.S.', 10, 8),
(44, 'Sociology, B.A.', 11, 7),
(45, 'Criminology, B.S.', 11, 8),
(46, 'Sociology, B.S.', 11, 8),
(47, 'Visual Arts, B.A.', 12, 7),
(48, 'Visual Arts, B.F.A.', 12, 9),
(49, 'Visual Arts: Electronic Media, B.S.', 12, 8),
(50, 'Accounting, B.S.', 13, 8),
(51, 'Accounting, M.S.', 13, 17),
(52, 'Taxation, M.S.', 13, 17),
(53, 'Business Administration, B.S.', 14, 8),
(54, 'Finance, B.S.', 14, 8),
(55, 'Marketing, B.S.', 14, 8),
(56, 'Adolescence Education: Chemistry (7-12), B.A.', 15, 7),
(57, 'Adolescence Education: Social Studies (7-12), B.A.', 15, 7),
(58, 'Adolescence Education: Spanish (7-12), B.A.', 15, 7),
(59, 'Adolescence Education: Biology (7-12), B.S.', 15, 8),
(60, 'Adolescence Education: Chemistry (7-12), B.S.', 15, 8),
(61, 'Adolescence Education: Mathematics (7-12), B.S.', 15, 8),
(62, 'Middle Childhood Education: Biology (5-9), B.S.', 15, 8),
(63, 'Middle Childhood Education: Chemistry (5-9), B.S.', 15, 8),
(64, 'Middle Childhood Education: Mathematics (5-9), B.S.', 15, 8),
(65, 'Middle Childhood Education: Spanish (5-9), B.S.', 15, 8),
(66, 'Adolescence Education: Biology (7-12), M.A.T.', 15, 24),
(67, 'Adolescence Education: Chemistry (7-12), M.A.T.', 15, 24),
(68, 'Adolescence Education: English Language Arts (7-12), M.A.T.', 15, 24),
(69, 'Adolescence Education: Mathematics (7-12), M.A.T.', 15, 24),
(70, 'Adolescence Education: Social Studies (7-12), M.A.T.', 15, 24),
(71, 'Adolescence Education: Spanish (7-12), M.A.T.', 15, 24),
(72, 'Adolescence Education: Biology (7-12), M.S.', 15, 17),
(73, 'Adolescence Education: Chemistry (7-12), M.S.', 15, 17),
(74, 'Adolescence Education: English Language Arts (7-12), M.S.', 15, 17),
(75, 'Adolescence Education: Mathematics (7-12), M.S.', 15, 17),
(76, 'Adolescence Education: Social Studies (7-12), M.S.', 15, 17),
(77, 'Adolescence Education: Spanish (7-12), M.S.', 15, 17),
(78, 'Childhood Education (1-6), B.S.', 16, 8),
(79, 'Childhood Education with Bilingual Extension (1-6), B.S.', 16, 8),
(80, 'Special Education and Childhood Education (1-6), B.S.', 16, 8),
(81, 'Literacy Education, M.S.', 16, 17),
(82, 'Special Education and Childhood Education (1-6), B.S.', 17, 8),
(83, 'Special Education with Bilingual Extension (1-6), B.S.', 17, 8),
(84, 'Business and Management, B.P.S.', 18, 25),
(85, 'Bachelor of Science (BS) in Liberal Arts and General Studies', 18, 8),
(86, 'Data Mining', 6, 17),
(88, 'Security Systems/Law Enforcement Tech', 6, 17);

-- --------------------------------------------------------

--
-- Table structure for table `major_courses`
--

DROP TABLE IF EXISTS `major_courses`;
CREATE TABLE IF NOT EXISTS `major_courses` (
  `major_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  PRIMARY KEY (`major_id`,`course_id`),
  KEY `course_id` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `major_courses`
--

INSERT INTO `major_courses` (`major_id`, `course_id`) VALUES
(17, 9),
(17, 11),
(26, 9),
(26, 10),
(26, 11),
(26, 12),
(26, 13),
(27, 9),
(27, 10),
(27, 11),
(27, 12),
(86, 9),
(86, 10),
(86, 11),
(86, 12),
(86, 13),
(88, 10),
(88, 11),
(88, 12),
(88, 13),
(88, 15);

-- --------------------------------------------------------

--
-- Table structure for table `meeting`
--

DROP TABLE IF EXISTS `meeting`;
CREATE TABLE IF NOT EXISTS `meeting` (
  `student_id` int(11) NOT NULL,
  `crn` int(11) NOT NULL,
  `date` date NOT NULL,
  `attendance` enum('A','P') COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`student_id`,`crn`,`date`),
  KEY `crn` (`crn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `minor`
--

DROP TABLE IF EXISTS `minor`;
CREATE TABLE IF NOT EXISTS `minor` (
  `minor_id` int(11) NOT NULL AUTO_INCREMENT,
  `minor_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`minor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `minor`
--

INSERT INTO `minor` (`minor_id`, `minor_name`) VALUES
(1, 'Women & Gender Studies Minor');

-- --------------------------------------------------------

--
-- Table structure for table `minor_department`
--

DROP TABLE IF EXISTS `minor_department`;
CREATE TABLE IF NOT EXISTS `minor_department` (
  `minor_id` int(11) NOT NULL DEFAULT '0',
  `dept_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`minor_id`,`dept_id`),
  KEY `dept_id` (`dept_id`),
  KEY `minor_id` (`minor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `minor_department`
--

INSERT INTO `minor_department` (`minor_id`, `dept_id`) VALUES
(1, 1),
(1, 4),
(1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `period`
--

DROP TABLE IF EXISTS `period`;
CREATE TABLE IF NOT EXISTS `period` (
  `period_id` int(11) NOT NULL AUTO_INCREMENT,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  PRIMARY KEY (`period_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `period`
--

INSERT INTO `period` (`period_id`, `start_time`, `end_time`) VALUES
(1, '08:30:00', '10:00:00'),
(2, '10:10:00', '11:40:00'),
(3, '11:50:00', '13:20:00'),
(4, '13:30:00', '15:00:00'),
(5, '15:10:00', '16:40:00'),
(6, '16:50:00', '18:20:00'),
(7, '18:30:00', '20:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `prerequisites`
--

DROP TABLE IF EXISTS `prerequisites`;
CREATE TABLE IF NOT EXISTS `prerequisites` (
  `course_id` int(11) NOT NULL,
  `prereq_id` int(11) NOT NULL,
  PRIMARY KEY (`course_id`,`prereq_id`),
  KEY `prereq_id` (`prereq_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `prerequisites`
--

INSERT INTO `prerequisites` (`course_id`, `prereq_id`) VALUES
(1, 4),
(1, 7),
(7, 14),
(11, 7),
(11, 10);

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

DROP TABLE IF EXISTS `registration`;
CREATE TABLE IF NOT EXISTS `registration` (
  `student_id` int(11) NOT NULL,
  `crn` int(11) NOT NULL,
  `reg_date` date NOT NULL,
  PRIMARY KEY (`student_id`,`crn`),
  KEY `crn` (`crn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `research`
--

DROP TABLE IF EXISTS `research`;
CREATE TABLE IF NOT EXISTS `research` (
  `research_id` int(11) NOT NULL,
  PRIMARY KEY (`research_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `research`
--

INSERT INTO `research` (`research_id`) VALUES
(4),
(177);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

DROP TABLE IF EXISTS `room`;
CREATE TABLE IF NOT EXISTS `room` (
  `room_id` int(11) NOT NULL AUTO_INCREMENT,
  `building_id` int(11) NOT NULL,
  `room_num` int(11) NOT NULL,
  `room_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `capacity` int(11) NOT NULL,
  PRIMARY KEY (`room_id`),
  KEY `building_id` (`building_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1001 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `building_id`, `room_num`, `room_type`, `capacity`) VALUES
(1, 36, 136, 'Computer Lab', 34),
(2, 35, 247, 'Computer Lab', 35),
(3, 34, 178, 'Computer Lab', 20),
(4, 38, 202, 'Computer Lab', 31),
(5, 40, 498, 'Computer Lab', 29),
(6, 38, 390, 'Computer Lab', 33),
(7, 38, 590, 'Computer Lab', 23),
(8, 34, 390, 'Computer Lab', 32),
(9, 30, 600, 'Computer Lab', 34),
(10, 39, 307, 'Computer Lab', 31),
(11, 40, 444, 'Computer Lab', 28),
(12, 37, 417, 'Computer Lab', 34),
(13, 35, 466, 'Computer Lab', 33),
(14, 32, 100, 'Computer Lab', 22),
(15, 36, 293, 'Computer Lab', 29),
(16, 31, 285, 'Computer Lab', 35),
(17, 37, 223, 'Computer Lab', 34),
(18, 39, 111, 'Computer Lab', 28),
(19, 37, 599, 'Computer Lab', 31),
(20, 38, 212, 'Computer Lab', 21),
(21, 37, 148, 'Computer Lab', 30),
(22, 37, 571, 'Computer Lab', 27),
(23, 32, 547, 'Computer Lab', 28),
(24, 36, 112, 'Computer Lab', 24),
(25, 34, 347, 'Computer Lab', 20),
(26, 35, 599, 'Computer Lab', 29),
(27, 39, 461, 'Computer Lab', 25),
(28, 40, 399, 'Computer Lab', 34),
(29, 36, 381, 'Computer Lab', 33),
(30, 30, 425, 'Computer Lab', 20),
(31, 40, 558, 'Computer Lab', 29),
(32, 35, 424, 'Computer Lab', 30),
(33, 32, 509, 'Computer Lab', 24),
(34, 38, 221, 'Computer Lab', 21),
(35, 31, 165, 'Computer Lab', 31),
(36, 37, 533, 'Computer Lab', 29),
(37, 39, 471, 'Computer Lab', 29),
(38, 36, 363, 'Computer Lab', 30),
(39, 38, 287, 'Computer Lab', 23),
(40, 36, 419, 'Computer Lab', 30),
(41, 36, 114, 'Computer Lab', 25),
(42, 31, 504, 'Computer Lab', 34),
(43, 40, 316, 'Computer Lab', 26),
(44, 31, 271, 'Computer Lab', 23),
(45, 40, 336, 'Computer Lab', 20),
(46, 32, 256, 'Computer Lab', 33),
(47, 30, 445, 'Computer Lab', 25),
(48, 30, 550, 'Computer Lab', 33),
(49, 31, 184, 'Computer Lab', 29),
(50, 31, 600, 'Computer Lab', 33),
(51, 33, 363, 'Computer Lab', 32),
(52, 36, 200, 'Computer Lab', 32),
(53, 38, 134, 'Computer Lab', 26),
(54, 33, 289, 'Computer Lab', 35),
(55, 30, 350, 'Computer Lab', 24),
(56, 31, 169, 'Computer Lab', 28),
(57, 31, 372, 'Computer Lab', 28),
(58, 39, 152, 'Computer Lab', 27),
(59, 35, 268, 'Computer Lab', 30),
(60, 35, 177, 'Computer Lab', 20),
(61, 35, 159, 'Computer Lab', 31),
(62, 30, 372, 'Computer Lab', 30),
(63, 32, 408, 'Computer Lab', 32),
(64, 30, 190, 'Computer Lab', 22),
(65, 38, 501, 'Computer Lab', 26),
(66, 38, 112, 'Computer Lab', 33),
(67, 39, 470, 'Computer Lab', 21),
(68, 30, 542, 'Computer Lab', 20),
(69, 39, 256, 'Computer Lab', 30),
(70, 32, 387, 'Computer Lab', 26),
(71, 32, 369, 'Computer Lab', 25),
(72, 36, 274, 'Computer Lab', 33),
(73, 37, 506, 'Computer Lab', 23),
(74, 32, 214, 'Computer Lab', 33),
(75, 40, 249, 'Computer Lab', 33),
(76, 31, 156, 'Computer Lab', 21),
(77, 33, 141, 'Computer Lab', 31),
(78, 31, 320, 'Computer Lab', 32),
(79, 34, 394, 'Computer Lab', 30),
(80, 33, 239, 'Computer Lab', 20),
(81, 32, 319, 'Computer Lab', 27),
(82, 32, 260, 'Computer Lab', 25),
(83, 36, 539, 'Computer Lab', 20),
(84, 37, 570, 'Computer Lab', 20),
(85, 30, 569, 'Computer Lab', 28),
(86, 39, 333, 'Computer Lab', 35),
(87, 36, 593, 'Computer Lab', 25),
(88, 32, 399, 'Computer Lab', 21),
(89, 37, 330, 'Computer Lab', 33),
(90, 39, 530, 'Computer Lab', 24),
(91, 30, 392, 'Computer Lab', 21),
(92, 38, 519, 'Computer Lab', 35),
(93, 34, 480, 'Computer Lab', 31),
(94, 33, 231, 'Computer Lab', 33),
(95, 36, 318, 'Computer Lab', 35),
(96, 36, 219, 'Computer Lab', 31),
(97, 40, 113, 'Computer Lab', 24),
(98, 40, 588, 'Computer Lab', 27),
(99, 35, 208, 'Computer Lab', 24),
(100, 37, 443, 'Computer Lab', 21),
(101, 30, 576, 'Computer Lab', 30),
(102, 30, 465, 'Computer Lab', 22),
(103, 34, 269, 'Computer Lab', 31),
(104, 36, 215, 'Computer Lab', 31),
(105, 30, 462, 'Computer Lab', 30),
(106, 30, 134, 'Computer Lab', 27),
(107, 31, 345, 'Computer Lab', 22),
(108, 34, 316, 'Computer Lab', 28),
(109, 30, 204, 'Computer Lab', 29),
(110, 30, 312, 'Computer Lab', 33),
(111, 32, 574, 'Computer Lab', 26),
(112, 40, 385, 'Computer Lab', 33),
(113, 33, 237, 'Computer Lab', 20),
(114, 40, 285, 'Computer Lab', 24),
(115, 40, 272, 'Computer Lab', 22),
(116, 39, 455, 'Computer Lab', 31),
(117, 40, 541, 'Computer Lab', 34),
(118, 34, 230, 'Computer Lab', 33),
(119, 38, 600, 'Computer Lab', 26),
(120, 30, 215, 'Computer Lab', 25),
(121, 30, 305, 'Computer Lab', 27),
(122, 31, 346, 'Computer Lab', 24),
(123, 32, 351, 'Computer Lab', 33),
(124, 32, 225, 'Computer Lab', 21),
(125, 31, 568, 'Computer Lab', 23),
(126, 39, 244, 'Computer Lab', 26),
(127, 34, 274, 'Computer Lab', 25),
(128, 39, 167, 'Computer Lab', 25),
(129, 40, 487, 'Computer Lab', 31),
(130, 34, 123, 'Computer Lab', 30),
(131, 35, 159, 'Computer Lab', 21),
(132, 38, 292, 'Computer Lab', 30),
(133, 34, 360, 'Computer Lab', 25),
(134, 30, 286, 'Computer Lab', 30),
(135, 36, 239, 'Computer Lab', 20),
(136, 30, 410, 'Computer Lab', 30),
(137, 32, 390, 'Computer Lab', 20),
(138, 32, 358, 'Computer Lab', 34),
(139, 30, 350, 'Computer Lab', 23),
(140, 36, 431, 'Computer Lab', 23),
(141, 33, 275, 'Computer Lab', 26),
(142, 30, 100, 'Computer Lab', 31),
(143, 32, 144, 'Computer Lab', 24),
(144, 30, 144, 'Computer Lab', 23),
(145, 36, 313, 'Computer Lab', 30),
(146, 33, 337, 'Computer Lab', 24),
(147, 39, 153, 'Computer Lab', 23),
(148, 38, 314, 'Computer Lab', 23),
(149, 40, 279, 'Computer Lab', 34),
(150, 33, 269, 'Computer Lab', 20),
(151, 33, 501, 'Computer Lab', 24),
(152, 39, 513, 'Computer Lab', 24),
(153, 34, 452, 'Computer Lab', 21),
(154, 37, 393, 'Computer Lab', 34),
(155, 40, 297, 'Computer Lab', 28),
(156, 38, 411, 'Computer Lab', 21),
(157, 39, 583, 'Computer Lab', 22),
(158, 34, 520, 'Computer Lab', 23),
(159, 37, 524, 'Computer Lab', 31),
(160, 32, 410, 'Computer Lab', 35),
(161, 30, 481, 'Computer Lab', 32),
(162, 31, 104, 'Computer Lab', 20),
(163, 40, 476, 'Computer Lab', 22),
(164, 39, 239, 'Computer Lab', 21),
(165, 39, 283, 'Computer Lab', 28),
(166, 31, 600, 'Computer Lab', 24),
(167, 36, 209, 'Computer Lab', 30),
(168, 37, 578, 'Computer Lab', 27),
(169, 40, 435, 'Computer Lab', 26),
(170, 35, 112, 'Computer Lab', 25),
(171, 36, 234, 'Computer Lab', 23),
(172, 32, 449, 'Computer Lab', 20),
(173, 36, 305, 'Computer Lab', 32),
(174, 39, 489, 'Computer Lab', 25),
(175, 39, 308, 'Computer Lab', 21),
(176, 37, 144, 'Computer Lab', 30),
(177, 35, 471, 'Computer Lab', 28),
(178, 38, 190, 'Computer Lab', 23),
(179, 33, 304, 'Computer Lab', 32),
(180, 30, 112, 'Computer Lab', 24),
(181, 37, 409, 'Computer Lab', 33),
(182, 40, 239, 'Computer Lab', 33),
(183, 38, 198, 'Computer Lab', 21),
(184, 33, 134, 'Computer Lab', 31),
(185, 32, 429, 'Computer Lab', 35),
(186, 37, 106, 'Computer Lab', 28),
(187, 34, 130, 'Computer Lab', 30),
(188, 35, 477, 'Computer Lab', 26),
(189, 36, 244, 'Computer Lab', 26),
(190, 36, 218, 'Computer Lab', 29),
(191, 34, 435, 'Computer Lab', 35),
(192, 33, 243, 'Computer Lab', 29),
(193, 34, 532, 'Computer Lab', 22),
(194, 36, 204, 'Computer Lab', 30),
(195, 35, 308, 'Computer Lab', 23),
(196, 33, 229, 'Computer Lab', 31),
(197, 34, 339, 'Computer Lab', 33),
(198, 38, 163, 'Computer Lab', 31),
(199, 40, 559, 'Computer Lab', 33),
(200, 38, 171, 'Computer Lab', 31),
(201, 34, 152, 'Computer Lab', 31),
(202, 40, 203, 'Computer Lab', 30),
(203, 31, 538, 'Computer Lab', 30),
(204, 33, 558, 'Computer Lab', 33),
(205, 38, 276, 'Computer Lab', 20),
(206, 35, 158, 'Computer Lab', 32),
(207, 35, 541, 'Computer Lab', 20),
(208, 39, 141, 'Computer Lab', 20),
(209, 36, 427, 'Computer Lab', 32),
(210, 40, 335, 'Computer Lab', 27),
(211, 32, 553, 'Computer Lab', 21),
(212, 36, 305, 'Computer Lab', 30),
(213, 34, 354, 'Computer Lab', 32),
(214, 31, 514, 'Computer Lab', 24),
(215, 32, 512, 'Computer Lab', 21),
(216, 35, 422, 'Computer Lab', 28),
(217, 34, 174, 'Computer Lab', 35),
(218, 34, 438, 'Computer Lab', 20),
(219, 31, 314, 'Computer Lab', 35),
(220, 33, 228, 'Computer Lab', 25),
(221, 34, 533, 'Computer Lab', 35),
(222, 39, 230, 'Computer Lab', 20),
(223, 35, 534, 'Computer Lab', 27),
(224, 34, 475, 'Computer Lab', 27),
(225, 32, 260, 'Computer Lab', 26),
(226, 35, 152, 'Computer Lab', 29),
(227, 30, 107, 'Computer Lab', 31),
(228, 33, 135, 'Computer Lab', 23),
(229, 33, 244, 'Computer Lab', 22),
(230, 38, 478, 'Computer Lab', 26),
(231, 37, 134, 'Computer Lab', 20),
(232, 30, 497, 'Computer Lab', 30),
(233, 40, 485, 'Computer Lab', 28),
(234, 39, 547, 'Computer Lab', 33),
(235, 35, 116, 'Computer Lab', 23),
(236, 34, 516, 'Computer Lab', 20),
(237, 30, 495, 'Computer Lab', 31),
(238, 32, 116, 'Computer Lab', 20),
(239, 36, 186, 'Computer Lab', 25),
(240, 31, 265, 'Computer Lab', 34),
(241, 33, 200, 'Computer Lab', 21),
(242, 37, 169, 'Computer Lab', 28),
(243, 30, 324, 'Computer Lab', 21),
(244, 35, 271, 'Computer Lab', 31),
(245, 38, 125, 'Computer Lab', 32),
(246, 30, 271, 'Computer Lab', 27),
(247, 40, 531, 'Computer Lab', 30),
(248, 38, 283, 'Computer Lab', 29),
(249, 33, 432, 'Computer Lab', 35),
(250, 37, 152, 'Computer Lab', 25),
(251, 40, 260, 'Computer Lab', 34),
(252, 39, 499, 'Computer Lab', 35),
(253, 39, 384, 'Computer Lab', 24),
(254, 40, 598, 'Computer Lab', 27),
(255, 32, 535, 'Computer Lab', 31),
(256, 34, 230, 'Computer Lab', 22),
(257, 37, 526, 'Computer Lab', 24),
(258, 37, 522, 'Computer Lab', 24),
(259, 33, 257, 'Computer Lab', 20),
(260, 38, 574, 'Computer Lab', 24),
(261, 34, 339, 'Computer Lab', 24),
(262, 39, 406, 'Computer Lab', 20),
(263, 40, 349, 'Computer Lab', 33),
(264, 38, 332, 'Computer Lab', 24),
(265, 38, 594, 'Computer Lab', 33),
(266, 39, 430, 'Computer Lab', 34),
(267, 32, 518, 'Computer Lab', 29),
(268, 33, 338, 'Computer Lab', 26),
(269, 38, 327, 'Computer Lab', 35),
(270, 40, 535, 'Computer Lab', 35),
(271, 35, 112, 'Computer Lab', 24),
(272, 31, 281, 'Computer Lab', 27),
(273, 31, 363, 'Computer Lab', 35),
(274, 31, 514, 'Computer Lab', 22),
(275, 31, 561, 'Computer Lab', 32),
(276, 34, 441, 'Computer Lab', 21),
(277, 36, 371, 'Computer Lab', 32),
(278, 40, 461, 'Computer Lab', 22),
(279, 35, 281, 'Computer Lab', 31),
(280, 38, 579, 'Computer Lab', 27),
(281, 30, 201, 'Computer Lab', 32),
(282, 34, 308, 'Computer Lab', 26),
(283, 38, 412, 'Computer Lab', 33),
(284, 30, 196, 'Computer Lab', 20),
(285, 37, 530, 'Computer Lab', 26),
(286, 40, 426, 'Computer Lab', 22),
(287, 32, 217, 'Computer Lab', 20),
(288, 32, 379, 'Computer Lab', 20),
(289, 38, 203, 'Computer Lab', 29),
(290, 33, 320, 'Computer Lab', 20),
(291, 38, 228, 'Computer Lab', 35),
(292, 35, 523, 'Computer Lab', 25),
(293, 38, 116, 'Computer Lab', 26),
(294, 38, 399, 'Computer Lab', 23),
(295, 37, 365, 'Computer Lab', 20),
(296, 35, 494, 'Computer Lab', 25),
(297, 40, 163, 'Computer Lab', 22),
(298, 32, 406, 'Computer Lab', 25),
(299, 30, 277, 'Computer Lab', 25),
(300, 30, 521, 'Computer Lab', 34),
(301, 30, 287, 'Computer Lab', 20),
(302, 31, 463, 'Computer Lab', 30),
(303, 37, 572, 'Computer Lab', 33),
(304, 40, 328, 'Computer Lab', 28),
(305, 34, 537, 'Computer Lab', 20),
(306, 38, 177, 'Computer Lab', 30),
(307, 34, 567, 'Computer Lab', 31),
(308, 33, 524, 'Computer Lab', 21),
(309, 31, 157, 'Computer Lab', 33),
(310, 33, 476, 'Computer Lab', 23),
(311, 34, 550, 'Computer Lab', 26),
(312, 33, 340, 'Computer Lab', 20),
(313, 37, 376, 'Computer Lab', 23),
(314, 38, 200, 'Computer Lab', 30),
(315, 30, 435, 'Computer Lab', 34),
(316, 30, 253, 'Computer Lab', 35),
(317, 37, 294, 'Computer Lab', 23),
(318, 31, 157, 'Computer Lab', 26),
(319, 31, 245, 'Computer Lab', 27),
(320, 33, 440, 'Computer Lab', 23),
(321, 31, 553, 'Computer Lab', 29),
(322, 39, 453, 'Computer Lab', 34),
(323, 32, 438, 'Computer Lab', 21),
(324, 31, 213, 'Computer Lab', 26),
(325, 32, 107, 'Computer Lab', 30),
(326, 31, 403, 'Computer Lab', 31),
(327, 36, 347, 'Computer Lab', 34),
(328, 38, 583, 'Computer Lab', 31),
(329, 31, 235, 'Computer Lab', 21),
(330, 36, 310, 'Computer Lab', 28),
(331, 37, 567, 'Computer Lab', 23),
(332, 39, 404, 'Computer Lab', 24),
(333, 32, 482, 'Computer Lab', 28),
(334, 31, 311, 'Computer Lab', 22),
(335, 35, 261, 'Computer Lab', 34),
(336, 30, 217, 'Computer Lab', 23),
(337, 33, 557, 'Computer Lab', 35),
(338, 31, 382, 'Computer Lab', 22),
(339, 32, 557, 'Computer Lab', 28),
(340, 33, 239, 'Computer Lab', 24),
(341, 40, 468, 'Computer Lab', 22),
(342, 33, 422, 'Computer Lab', 20),
(343, 40, 437, 'Computer Lab', 30),
(344, 38, 289, 'Computer Lab', 29),
(345, 38, 276, 'Computer Lab', 24),
(346, 30, 515, 'Computer Lab', 22),
(347, 36, 164, 'Computer Lab', 34),
(348, 33, 227, 'Computer Lab', 27),
(349, 39, 108, 'Computer Lab', 20),
(350, 37, 169, 'Computer Lab', 35),
(351, 33, 272, 'Computer Lab', 29),
(352, 37, 344, 'Computer Lab', 25),
(353, 32, 114, 'Computer Lab', 23),
(354, 32, 500, 'Computer Lab', 27),
(355, 31, 181, 'Computer Lab', 25),
(356, 34, 102, 'Computer Lab', 29),
(357, 39, 404, 'Computer Lab', 31),
(358, 40, 172, 'Computer Lab', 34),
(359, 35, 204, 'Computer Lab', 32),
(360, 33, 407, 'Computer Lab', 22),
(361, 34, 245, 'Computer Lab', 32),
(362, 38, 155, 'Computer Lab', 24),
(363, 38, 356, 'Computer Lab', 23),
(364, 33, 156, 'Computer Lab', 35),
(365, 31, 384, 'Computer Lab', 26),
(366, 37, 359, 'Computer Lab', 32),
(367, 33, 393, 'Computer Lab', 20),
(368, 40, 461, 'Computer Lab', 35),
(369, 30, 528, 'Computer Lab', 23),
(370, 38, 135, 'Computer Lab', 27),
(371, 34, 527, 'Computer Lab', 27),
(372, 38, 280, 'Computer Lab', 28),
(373, 35, 265, 'Computer Lab', 31),
(374, 37, 176, 'Computer Lab', 22),
(375, 39, 284, 'Computer Lab', 28),
(376, 31, 355, 'Computer Lab', 22),
(377, 32, 568, 'Computer Lab', 35),
(378, 31, 155, 'Computer Lab', 33),
(379, 39, 387, 'Computer Lab', 31),
(380, 32, 121, 'Computer Lab', 21),
(381, 37, 374, 'Computer Lab', 25),
(382, 34, 142, 'Computer Lab', 26),
(383, 39, 472, 'Computer Lab', 34),
(384, 36, 580, 'Computer Lab', 33),
(385, 32, 360, 'Computer Lab', 35),
(386, 33, 253, 'Computer Lab', 34),
(387, 38, 107, 'Computer Lab', 35),
(388, 31, 529, 'Computer Lab', 27),
(389, 38, 329, 'Computer Lab', 29),
(390, 37, 321, 'Computer Lab', 32),
(391, 37, 322, 'Computer Lab', 20),
(392, 39, 553, 'Computer Lab', 33),
(393, 39, 172, 'Computer Lab', 21),
(394, 36, 312, 'Computer Lab', 34),
(395, 31, 220, 'Computer Lab', 28),
(396, 31, 375, 'Computer Lab', 29),
(397, 35, 353, 'Computer Lab', 24),
(398, 38, 303, 'Computer Lab', 22),
(399, 31, 294, 'Computer Lab', 24),
(400, 38, 429, 'Computer Lab', 30),
(401, 35, 587, 'Computer Lab', 21),
(402, 40, 486, 'Computer Lab', 28),
(403, 39, 425, 'Computer Lab', 32),
(404, 30, 190, 'Computer Lab', 23),
(405, 39, 232, 'Computer Lab', 24),
(406, 36, 488, 'Computer Lab', 27),
(407, 39, 218, 'Computer Lab', 31),
(408, 36, 555, 'Computer Lab', 22),
(409, 35, 169, 'Computer Lab', 26),
(410, 37, 187, 'Computer Lab', 24),
(411, 39, 203, 'Computer Lab', 21),
(412, 39, 195, 'Computer Lab', 35),
(413, 40, 364, 'Computer Lab', 33),
(414, 33, 426, 'Computer Lab', 27),
(415, 32, 212, 'Computer Lab', 30),
(416, 36, 357, 'Computer Lab', 34),
(417, 31, 447, 'Computer Lab', 26),
(418, 40, 296, 'Computer Lab', 29),
(419, 34, 256, 'Computer Lab', 28),
(420, 40, 494, 'Computer Lab', 25),
(421, 38, 588, 'Computer Lab', 25),
(422, 30, 463, 'Computer Lab', 35),
(423, 31, 338, 'Computer Lab', 20),
(424, 31, 488, 'Computer Lab', 24),
(425, 34, 211, 'Computer Lab', 31),
(426, 37, 190, 'Computer Lab', 30),
(427, 37, 407, 'Computer Lab', 34),
(428, 33, 318, 'Computer Lab', 29),
(429, 34, 391, 'Computer Lab', 31),
(430, 40, 265, 'Computer Lab', 21),
(431, 39, 446, 'Computer Lab', 26),
(432, 38, 518, 'Computer Lab', 30),
(433, 32, 278, 'Computer Lab', 32),
(434, 32, 170, 'Computer Lab', 23),
(435, 32, 241, 'Computer Lab', 23),
(436, 38, 431, 'Computer Lab', 35),
(437, 35, 130, 'Computer Lab', 20),
(438, 36, 244, 'Computer Lab', 21),
(439, 31, 201, 'Computer Lab', 32),
(440, 32, 279, 'Computer Lab', 20),
(441, 30, 262, 'Computer Lab', 35),
(442, 33, 552, 'Computer Lab', 30),
(443, 30, 447, 'Computer Lab', 29),
(444, 30, 174, 'Computer Lab', 27),
(445, 39, 131, 'Computer Lab', 22),
(446, 35, 348, 'Computer Lab', 35),
(447, 40, 117, 'Computer Lab', 33),
(448, 38, 168, 'Computer Lab', 20),
(449, 30, 207, 'Computer Lab', 26),
(450, 34, 163, 'Computer Lab', 32),
(451, 40, 201, 'Computer Lab', 33),
(452, 38, 213, 'Computer Lab', 35),
(453, 30, 187, 'Computer Lab', 33),
(454, 36, 471, 'Computer Lab', 33),
(455, 32, 181, 'Computer Lab', 31),
(456, 35, 130, 'Computer Lab', 29),
(457, 36, 416, 'Computer Lab', 20),
(458, 32, 371, 'Computer Lab', 35),
(459, 32, 397, 'Computer Lab', 34),
(460, 36, 344, 'Computer Lab', 24),
(461, 31, 329, 'Computer Lab', 32),
(462, 36, 467, 'Computer Lab', 29),
(463, 39, 333, 'Computer Lab', 31),
(464, 40, 239, 'Computer Lab', 21),
(465, 40, 155, 'Computer Lab', 35),
(466, 31, 519, 'Computer Lab', 21),
(467, 34, 291, 'Computer Lab', 35),
(468, 31, 589, 'Computer Lab', 21),
(469, 33, 109, 'Computer Lab', 22),
(470, 30, 398, 'Computer Lab', 30),
(471, 39, 202, 'Computer Lab', 28),
(472, 40, 142, 'Computer Lab', 27),
(473, 40, 359, 'Computer Lab', 34),
(474, 39, 434, 'Computer Lab', 33),
(475, 33, 586, 'Computer Lab', 23),
(476, 34, 149, 'Computer Lab', 35),
(477, 40, 313, 'Computer Lab', 23),
(478, 33, 323, 'Computer Lab', 20),
(479, 33, 113, 'Computer Lab', 32),
(480, 33, 241, 'Computer Lab', 25),
(481, 30, 268, 'Computer Lab', 30),
(482, 32, 556, 'Computer Lab', 20),
(483, 39, 161, 'Computer Lab', 33),
(484, 36, 583, 'Computer Lab', 24),
(485, 34, 300, 'Computer Lab', 33),
(486, 37, 407, 'Computer Lab', 33),
(487, 32, 107, 'Computer Lab', 22),
(488, 37, 454, 'Computer Lab', 21),
(489, 30, 494, 'Computer Lab', 24),
(490, 32, 570, 'Computer Lab', 26),
(491, 30, 462, 'Computer Lab', 22),
(492, 30, 256, 'Computer Lab', 31),
(493, 33, 329, 'Computer Lab', 35),
(494, 30, 244, 'Computer Lab', 29),
(495, 33, 240, 'Computer Lab', 26),
(496, 38, 178, 'Computer Lab', 35),
(497, 40, 103, 'Computer Lab', 32),
(498, 34, 345, 'Computer Lab', 26),
(499, 36, 515, 'Computer Lab', 33),
(500, 37, 263, 'Computer Lab', 20),
(501, 35, 228, 'Computer Lab', 20),
(502, 40, 452, 'Computer Lab', 30),
(503, 34, 593, 'Computer Lab', 26),
(504, 35, 414, 'Computer Lab', 21),
(505, 40, 173, 'Computer Lab', 26),
(506, 34, 197, 'Computer Lab', 27),
(507, 35, 417, 'Computer Lab', 28),
(508, 37, 128, 'Computer Lab', 32),
(509, 34, 499, 'Computer Lab', 34),
(510, 30, 390, 'Computer Lab', 27),
(511, 38, 490, 'Computer Lab', 34),
(512, 40, 284, 'Computer Lab', 34),
(513, 38, 379, 'Computer Lab', 20),
(514, 30, 376, 'Computer Lab', 29),
(515, 30, 161, 'Computer Lab', 25),
(516, 38, 274, 'Computer Lab', 32),
(517, 35, 130, 'Computer Lab', 30),
(518, 38, 440, 'Computer Lab', 35),
(519, 36, 511, 'Computer Lab', 29),
(520, 33, 106, 'Computer Lab', 22),
(521, 39, 598, 'Computer Lab', 35),
(522, 34, 515, 'Computer Lab', 20),
(523, 39, 142, 'Computer Lab', 32),
(524, 39, 230, 'Computer Lab', 27),
(525, 32, 470, 'Computer Lab', 30),
(526, 34, 294, 'Computer Lab', 32),
(527, 32, 351, 'Computer Lab', 33),
(528, 38, 518, 'Computer Lab', 35),
(529, 38, 408, 'Computer Lab', 30),
(530, 30, 137, 'Computer Lab', 29),
(531, 37, 477, 'Computer Lab', 34),
(532, 40, 327, 'Computer Lab', 27),
(533, 36, 430, 'Computer Lab', 23),
(534, 30, 382, 'Computer Lab', 21),
(535, 33, 578, 'Computer Lab', 28),
(536, 32, 229, 'Computer Lab', 30),
(537, 32, 391, 'Computer Lab', 26),
(538, 32, 173, 'Computer Lab', 20),
(539, 40, 218, 'Computer Lab', 23),
(540, 35, 551, 'Computer Lab', 25),
(541, 35, 532, 'Computer Lab', 22),
(542, 35, 183, 'Computer Lab', 31),
(543, 31, 484, 'Computer Lab', 20),
(544, 36, 173, 'Computer Lab', 20),
(545, 34, 466, 'Computer Lab', 30),
(546, 31, 339, 'Computer Lab', 34),
(547, 32, 359, 'Computer Lab', 33),
(548, 32, 231, 'Computer Lab', 25),
(549, 36, 272, 'Computer Lab', 32),
(550, 35, 215, 'Computer Lab', 27),
(551, 33, 193, 'Computer Lab', 34),
(552, 33, 104, 'Computer Lab', 23),
(553, 38, 297, 'Computer Lab', 24),
(554, 34, 101, 'Computer Lab', 20),
(555, 38, 324, 'Computer Lab', 20),
(556, 33, 124, 'Computer Lab', 35),
(557, 34, 208, 'Computer Lab', 35),
(558, 38, 120, 'Computer Lab', 26),
(559, 30, 318, 'Computer Lab', 27),
(560, 39, 285, 'Computer Lab', 24),
(561, 30, 438, 'Computer Lab', 21),
(562, 34, 282, 'Computer Lab', 25),
(563, 32, 465, 'Computer Lab', 25),
(564, 33, 436, 'Computer Lab', 35),
(565, 34, 368, 'Computer Lab', 34),
(566, 40, 461, 'Computer Lab', 29),
(567, 32, 152, 'Computer Lab', 27),
(568, 30, 559, 'Computer Lab', 33),
(569, 35, 127, 'Computer Lab', 29),
(570, 30, 267, 'Computer Lab', 27),
(571, 33, 403, 'Computer Lab', 34),
(572, 32, 266, 'Computer Lab', 20),
(573, 31, 540, 'Computer Lab', 33),
(574, 38, 489, 'Computer Lab', 27),
(575, 31, 168, 'Computer Lab', 26),
(576, 34, 572, 'Computer Lab', 23),
(577, 36, 543, 'Computer Lab', 20),
(578, 35, 334, 'Computer Lab', 24),
(579, 34, 373, 'Computer Lab', 32),
(580, 32, 502, 'Computer Lab', 20),
(581, 36, 384, 'Computer Lab', 33),
(582, 33, 453, 'Computer Lab', 26),
(583, 38, 526, 'Computer Lab', 22),
(584, 37, 203, 'Computer Lab', 23),
(585, 32, 229, 'Computer Lab', 33),
(586, 34, 572, 'Computer Lab', 24),
(587, 34, 120, 'Computer Lab', 32),
(588, 35, 408, 'Computer Lab', 29),
(589, 36, 566, 'Computer Lab', 20),
(590, 37, 558, 'Computer Lab', 30),
(591, 30, 506, 'Computer Lab', 32),
(592, 33, 181, 'Computer Lab', 30),
(593, 34, 232, 'Computer Lab', 31),
(594, 30, 497, 'Computer Lab', 30),
(595, 40, 514, 'Computer Lab', 28),
(596, 32, 114, 'Computer Lab', 24),
(597, 39, 524, 'Computer Lab', 20),
(598, 34, 447, 'Computer Lab', 35),
(599, 37, 332, 'Computer Lab', 22),
(600, 34, 263, 'Computer Lab', 26),
(601, 34, 243, 'Computer Lab', 32),
(602, 30, 560, 'Computer Lab', 35),
(603, 30, 321, 'Computer Lab', 22),
(604, 36, 420, 'Computer Lab', 30),
(605, 32, 522, 'Computer Lab', 25),
(606, 36, 566, 'Computer Lab', 30),
(607, 35, 480, 'Computer Lab', 33),
(608, 34, 515, 'Computer Lab', 23),
(609, 38, 326, 'Computer Lab', 34),
(610, 38, 263, 'Computer Lab', 30),
(611, 32, 365, 'Computer Lab', 34),
(612, 37, 516, 'Computer Lab', 20),
(613, 37, 518, 'Computer Lab', 20),
(614, 33, 360, 'Computer Lab', 27),
(615, 31, 167, 'Computer Lab', 21),
(616, 35, 250, 'Computer Lab', 33),
(617, 31, 259, 'Computer Lab', 21),
(618, 36, 298, 'Computer Lab', 25),
(619, 35, 268, 'Computer Lab', 32),
(620, 31, 380, 'Computer Lab', 30),
(621, 32, 586, 'Computer Lab', 25),
(622, 37, 349, 'Computer Lab', 29),
(623, 32, 556, 'Computer Lab', 26),
(624, 32, 172, 'Computer Lab', 32),
(625, 38, 503, 'Computer Lab', 22),
(626, 30, 241, 'Computer Lab', 26),
(627, 30, 461, 'Computer Lab', 35),
(628, 39, 278, 'Computer Lab', 28),
(629, 30, 111, 'Computer Lab', 24),
(630, 40, 572, 'Computer Lab', 34),
(631, 38, 430, 'Computer Lab', 34),
(632, 34, 141, 'Computer Lab', 26),
(633, 35, 599, 'Computer Lab', 33),
(634, 32, 427, 'Computer Lab', 33),
(635, 35, 555, 'Computer Lab', 20),
(636, 37, 560, 'Computer Lab', 26),
(637, 38, 429, 'Computer Lab', 24),
(638, 34, 428, 'Computer Lab', 34),
(639, 40, 395, 'Computer Lab', 25),
(640, 36, 406, 'Computer Lab', 26),
(641, 32, 572, 'Computer Lab', 26),
(642, 31, 266, 'Computer Lab', 21),
(643, 39, 339, 'Computer Lab', 28),
(644, 37, 531, 'Computer Lab', 34),
(645, 38, 133, 'Computer Lab', 32),
(646, 35, 569, 'Computer Lab', 35),
(647, 35, 132, 'Computer Lab', 34),
(648, 35, 466, 'Computer Lab', 34),
(649, 35, 173, 'Computer Lab', 35),
(650, 37, 442, 'Computer Lab', 27),
(651, 38, 226, 'Computer Lab', 34),
(652, 38, 588, 'Computer Lab', 28),
(653, 33, 357, 'Computer Lab', 21),
(654, 35, 294, 'Computer Lab', 35),
(655, 33, 419, 'Computer Lab', 32),
(656, 38, 586, 'Computer Lab', 23),
(657, 39, 226, 'Computer Lab', 28),
(658, 36, 521, 'Computer Lab', 29),
(659, 37, 139, 'Computer Lab', 27),
(660, 37, 261, 'Computer Lab', 21),
(661, 39, 440, 'Computer Lab', 20),
(662, 32, 104, 'Computer Lab', 25),
(663, 30, 515, 'Computer Lab', 20),
(664, 37, 593, 'Computer Lab', 23),
(665, 38, 537, 'Computer Lab', 29),
(666, 32, 230, 'Computer Lab', 29),
(667, 40, 450, 'Computer Lab', 35),
(668, 40, 468, 'Computer Lab', 24),
(669, 38, 281, 'Computer Lab', 35),
(670, 37, 146, 'Computer Lab', 29),
(671, 40, 102, 'Computer Lab', 28),
(672, 37, 343, 'Computer Lab', 35),
(673, 31, 103, 'Computer Lab', 20),
(674, 31, 464, 'Computer Lab', 23),
(675, 34, 280, 'Computer Lab', 28),
(676, 39, 286, 'Computer Lab', 21),
(677, 39, 441, 'Computer Lab', 29),
(678, 36, 514, 'Computer Lab', 30),
(679, 36, 225, 'Computer Lab', 26),
(680, 36, 148, 'Computer Lab', 33),
(681, 39, 594, 'Computer Lab', 35),
(682, 35, 581, 'Computer Lab', 32),
(683, 35, 282, 'Computer Lab', 28),
(684, 34, 176, 'Computer Lab', 34),
(685, 31, 130, 'Computer Lab', 21),
(686, 32, 287, 'Computer Lab', 22),
(687, 40, 469, 'Computer Lab', 29),
(688, 33, 538, 'Computer Lab', 32),
(689, 33, 124, 'Computer Lab', 20),
(690, 36, 196, 'Computer Lab', 24),
(691, 30, 159, 'Computer Lab', 35),
(692, 33, 188, 'Computer Lab', 35),
(693, 34, 441, 'Computer Lab', 20),
(694, 35, 208, 'Computer Lab', 23),
(695, 33, 180, 'Computer Lab', 34),
(696, 30, 258, 'Computer Lab', 35),
(697, 39, 127, 'Computer Lab', 32),
(698, 34, 434, 'Computer Lab', 20),
(699, 35, 179, 'Computer Lab', 34),
(700, 31, 115, 'Computer Lab', 28),
(701, 39, 427, 'Computer Lab', 20),
(702, 33, 578, 'Computer Lab', 33),
(703, 34, 530, 'Computer Lab', 28),
(704, 33, 343, 'Computer Lab', 22),
(705, 34, 386, 'Computer Lab', 29),
(706, 39, 566, 'Computer Lab', 30),
(707, 34, 221, 'Computer Lab', 27),
(708, 31, 418, 'Computer Lab', 24),
(709, 31, 461, 'Computer Lab', 26),
(710, 40, 444, 'Computer Lab', 26),
(711, 34, 515, 'Computer Lab', 27),
(712, 40, 308, 'Computer Lab', 26),
(713, 32, 571, 'Computer Lab', 23),
(714, 40, 412, 'Computer Lab', 30),
(715, 36, 170, 'Computer Lab', 28),
(716, 30, 325, 'Computer Lab', 25),
(717, 32, 123, 'Computer Lab', 22),
(718, 35, 188, 'Computer Lab', 26),
(719, 37, 257, 'Computer Lab', 31),
(720, 32, 542, 'Computer Lab', 31),
(721, 31, 279, 'Computer Lab', 20),
(722, 39, 375, 'Computer Lab', 20),
(723, 35, 310, 'Computer Lab', 24),
(724, 34, 172, 'Computer Lab', 30),
(725, 39, 540, 'Computer Lab', 33),
(726, 34, 340, 'Computer Lab', 21),
(727, 40, 354, 'Computer Lab', 24),
(728, 31, 599, 'Computer Lab', 34),
(729, 40, 467, 'Computer Lab', 22),
(730, 36, 369, 'Computer Lab', 23),
(731, 31, 218, 'Computer Lab', 31),
(732, 30, 363, 'Computer Lab', 24),
(733, 39, 264, 'Computer Lab', 35),
(734, 36, 436, 'Computer Lab', 34),
(735, 35, 253, 'Computer Lab', 21),
(736, 34, 205, 'Computer Lab', 31),
(737, 31, 512, 'Computer Lab', 35),
(738, 40, 247, 'Computer Lab', 35),
(739, 34, 345, 'Computer Lab', 30),
(740, 37, 192, 'Computer Lab', 29),
(741, 34, 339, 'Computer Lab', 21),
(742, 39, 182, 'Computer Lab', 33),
(743, 39, 372, 'Computer Lab', 29),
(744, 38, 430, 'Computer Lab', 34),
(745, 40, 161, 'Computer Lab', 34),
(746, 35, 105, 'Computer Lab', 23),
(747, 30, 471, 'Computer Lab', 26),
(748, 36, 261, 'Computer Lab', 24),
(749, 33, 388, 'Computer Lab', 35),
(750, 32, 166, 'Computer Lab', 28),
(751, 36, 427, 'Computer Lab', 31),
(752, 32, 492, 'Computer Lab', 33),
(753, 38, 392, 'Computer Lab', 29),
(754, 31, 240, 'Computer Lab', 27),
(755, 36, 523, 'Computer Lab', 20),
(756, 37, 329, 'Computer Lab', 33),
(757, 38, 298, 'Computer Lab', 27),
(758, 31, 410, 'Computer Lab', 32),
(759, 36, 343, 'Computer Lab', 22),
(760, 36, 115, 'Computer Lab', 31),
(761, 35, 394, 'Computer Lab', 31),
(762, 33, 554, 'Computer Lab', 25),
(763, 38, 337, 'Computer Lab', 22),
(764, 38, 325, 'Computer Lab', 21),
(765, 38, 259, 'Computer Lab', 20),
(766, 32, 299, 'Computer Lab', 35),
(767, 32, 244, 'Computer Lab', 24),
(768, 38, 296, 'Computer Lab', 30),
(769, 33, 252, 'Computer Lab', 27),
(770, 36, 118, 'Computer Lab', 30),
(771, 30, 231, 'Computer Lab', 29),
(772, 38, 289, 'Computer Lab', 30),
(773, 39, 547, 'Computer Lab', 20),
(774, 39, 262, 'Computer Lab', 35),
(775, 39, 490, 'Computer Lab', 28),
(776, 32, 538, 'Computer Lab', 29),
(777, 30, 112, 'Computer Lab', 23),
(778, 38, 585, 'Computer Lab', 35),
(779, 39, 202, 'Computer Lab', 23),
(780, 37, 285, 'Computer Lab', 23),
(781, 34, 358, 'Computer Lab', 26),
(782, 39, 457, 'Computer Lab', 32),
(783, 32, 328, 'Computer Lab', 33),
(784, 37, 230, 'Computer Lab', 21),
(785, 36, 272, 'Computer Lab', 32),
(786, 37, 480, 'Computer Lab', 23),
(787, 38, 199, 'Computer Lab', 30),
(788, 31, 300, 'Computer Lab', 26),
(789, 39, 446, 'Computer Lab', 25),
(790, 40, 489, 'Computer Lab', 22),
(791, 33, 296, 'Computer Lab', 26),
(792, 36, 422, 'Computer Lab', 35),
(793, 35, 113, 'Computer Lab', 32),
(794, 36, 210, 'Computer Lab', 33),
(795, 33, 515, 'Computer Lab', 34),
(796, 33, 594, 'Computer Lab', 20),
(797, 35, 227, 'Computer Lab', 23),
(798, 36, 328, 'Computer Lab', 35),
(799, 40, 293, 'Computer Lab', 20),
(800, 40, 207, 'Computer Lab', 30),
(801, 37, 573, 'Computer Lab', 26),
(802, 30, 432, 'Computer Lab', 31),
(803, 39, 272, 'Computer Lab', 29),
(804, 40, 132, 'Computer Lab', 31),
(805, 32, 589, 'Computer Lab', 26),
(806, 31, 124, 'Computer Lab', 32),
(807, 34, 497, 'Computer Lab', 24),
(808, 37, 598, 'Computer Lab', 24),
(809, 37, 241, 'Computer Lab', 31),
(810, 32, 331, 'Computer Lab', 28),
(811, 37, 287, 'Computer Lab', 31),
(812, 30, 340, 'Computer Lab', 21),
(813, 36, 241, 'Computer Lab', 27),
(814, 32, 520, 'Computer Lab', 22),
(815, 35, 150, 'Computer Lab', 34),
(816, 40, 115, 'Computer Lab', 20),
(817, 40, 465, 'Computer Lab', 22),
(818, 37, 423, 'Computer Lab', 25),
(819, 36, 180, 'Computer Lab', 22),
(820, 30, 108, 'Computer Lab', 27),
(821, 30, 489, 'Computer Lab', 33),
(822, 36, 407, 'Computer Lab', 22),
(823, 32, 409, 'Computer Lab', 35),
(824, 39, 285, 'Computer Lab', 30),
(825, 32, 359, 'Computer Lab', 20),
(826, 30, 318, 'Computer Lab', 22),
(827, 36, 291, 'Computer Lab', 29),
(828, 38, 320, 'Computer Lab', 35),
(829, 36, 187, 'Computer Lab', 34),
(830, 36, 309, 'Computer Lab', 26),
(831, 38, 494, 'Computer Lab', 26),
(832, 30, 570, 'Computer Lab', 25),
(833, 40, 178, 'Computer Lab', 24),
(834, 34, 516, 'Computer Lab', 27),
(835, 40, 276, 'Computer Lab', 23),
(836, 30, 549, 'Computer Lab', 32),
(837, 37, 582, 'Computer Lab', 35),
(838, 31, 163, 'Computer Lab', 26),
(839, 36, 533, 'Computer Lab', 30),
(840, 31, 383, 'Computer Lab', 25),
(841, 38, 359, 'Computer Lab', 24),
(842, 40, 478, 'Computer Lab', 35),
(843, 39, 154, 'Computer Lab', 27),
(844, 33, 166, 'Computer Lab', 23),
(845, 31, 525, 'Computer Lab', 22),
(846, 31, 403, 'Computer Lab', 20),
(847, 36, 563, 'Computer Lab', 25),
(848, 39, 254, 'Computer Lab', 21),
(849, 40, 440, 'Computer Lab', 30),
(850, 32, 110, 'Computer Lab', 28),
(851, 39, 493, 'Computer Lab', 29),
(852, 35, 527, 'Computer Lab', 22),
(853, 40, 540, 'Computer Lab', 34),
(854, 33, 560, 'Computer Lab', 21),
(855, 31, 105, 'Computer Lab', 20),
(856, 30, 445, 'Computer Lab', 27),
(857, 32, 436, 'Computer Lab', 23),
(858, 31, 386, 'Computer Lab', 35),
(859, 31, 293, 'Computer Lab', 24),
(860, 31, 273, 'Computer Lab', 22),
(861, 37, 191, 'Computer Lab', 32),
(862, 37, 295, 'Computer Lab', 34),
(863, 40, 395, 'Computer Lab', 31),
(864, 39, 463, 'Computer Lab', 28),
(865, 38, 213, 'Computer Lab', 34),
(866, 33, 517, 'Computer Lab', 25),
(867, 34, 151, 'Computer Lab', 34),
(868, 37, 295, 'Computer Lab', 23),
(869, 37, 499, 'Computer Lab', 29),
(870, 36, 360, 'Computer Lab', 35),
(871, 31, 219, 'Computer Lab', 29),
(872, 36, 172, 'Computer Lab', 24),
(873, 34, 466, 'Computer Lab', 25),
(874, 30, 209, 'Computer Lab', 25),
(875, 39, 188, 'Computer Lab', 20),
(876, 31, 248, 'Computer Lab', 32),
(877, 38, 341, 'Computer Lab', 29),
(878, 30, 137, 'Computer Lab', 25),
(879, 39, 244, 'Computer Lab', 21),
(880, 30, 411, 'Computer Lab', 35),
(881, 32, 310, 'Computer Lab', 29),
(882, 34, 597, 'Computer Lab', 33),
(883, 40, 558, 'Computer Lab', 27),
(884, 33, 462, 'Computer Lab', 35),
(885, 37, 399, 'Computer Lab', 31),
(886, 30, 448, 'Computer Lab', 33),
(887, 36, 281, 'Computer Lab', 28),
(888, 38, 426, 'Computer Lab', 21),
(889, 32, 569, 'Computer Lab', 28),
(890, 37, 427, 'Computer Lab', 35),
(891, 30, 343, 'Computer Lab', 33),
(892, 34, 190, 'Computer Lab', 25),
(893, 30, 336, 'Computer Lab', 20),
(894, 30, 211, 'Computer Lab', 23),
(895, 30, 263, 'Computer Lab', 28),
(896, 39, 298, 'Computer Lab', 26),
(897, 30, 106, 'Computer Lab', 32),
(898, 38, 234, 'Computer Lab', 27),
(899, 39, 491, 'Computer Lab', 22),
(900, 38, 135, 'Computer Lab', 24),
(901, 36, 240, 'Computer Lab', 21),
(902, 34, 559, 'Computer Lab', 24),
(903, 33, 474, 'Computer Lab', 33),
(904, 36, 423, 'Computer Lab', 23),
(905, 39, 211, 'Computer Lab', 23),
(906, 39, 123, 'Computer Lab', 26),
(907, 30, 109, 'Computer Lab', 27),
(908, 31, 506, 'Computer Lab', 26),
(909, 33, 164, 'Computer Lab', 27),
(910, 30, 359, 'Computer Lab', 23),
(911, 33, 160, 'Computer Lab', 20),
(912, 30, 111, 'Computer Lab', 23),
(913, 30, 299, 'Computer Lab', 26),
(914, 36, 254, 'Computer Lab', 25),
(915, 35, 345, 'Computer Lab', 35),
(916, 38, 564, 'Computer Lab', 34),
(917, 32, 372, 'Computer Lab', 31),
(918, 38, 456, 'Computer Lab', 23),
(919, 33, 394, 'Computer Lab', 22),
(920, 34, 452, 'Computer Lab', 33),
(921, 36, 231, 'Computer Lab', 27),
(922, 40, 408, 'Computer Lab', 33),
(923, 36, 346, 'Computer Lab', 27),
(924, 34, 475, 'Computer Lab', 29),
(925, 32, 584, 'Computer Lab', 22),
(926, 40, 544, 'Computer Lab', 33),
(927, 31, 528, 'Computer Lab', 26),
(928, 35, 533, 'Computer Lab', 35),
(929, 35, 395, 'Computer Lab', 22),
(930, 39, 364, 'Computer Lab', 26),
(931, 32, 275, 'Computer Lab', 32),
(932, 35, 378, 'Computer Lab', 35),
(933, 34, 365, 'Computer Lab', 32),
(934, 35, 150, 'Computer Lab', 24),
(935, 33, 279, 'Computer Lab', 21),
(936, 40, 373, 'Computer Lab', 28),
(937, 38, 458, 'Computer Lab', 33),
(938, 37, 579, 'Computer Lab', 30),
(939, 39, 264, 'Computer Lab', 27),
(940, 37, 100, 'Computer Lab', 33),
(941, 32, 446, 'Computer Lab', 29),
(942, 34, 301, 'Computer Lab', 30),
(943, 39, 122, 'Computer Lab', 26),
(944, 35, 542, 'Computer Lab', 27),
(945, 40, 287, 'Computer Lab', 24),
(946, 39, 574, 'Computer Lab', 20),
(947, 38, 477, 'Computer Lab', 22),
(948, 39, 144, 'Computer Lab', 21),
(949, 30, 251, 'Computer Lab', 20),
(950, 31, 474, 'Computer Lab', 28),
(951, 35, 506, 'Computer Lab', 30),
(952, 40, 241, 'Computer Lab', 27),
(953, 38, 165, 'Computer Lab', 22),
(954, 40, 188, 'Computer Lab', 21),
(955, 33, 384, 'Computer Lab', 34),
(956, 36, 470, 'Computer Lab', 21),
(957, 37, 551, 'Computer Lab', 30),
(958, 36, 334, 'Computer Lab', 20),
(959, 35, 502, 'Computer Lab', 35),
(960, 30, 153, 'Computer Lab', 27),
(961, 35, 402, 'Computer Lab', 34),
(962, 37, 473, 'Computer Lab', 29),
(963, 37, 446, 'Computer Lab', 31),
(964, 36, 165, 'Computer Lab', 33),
(965, 40, 380, 'Computer Lab', 25),
(966, 37, 582, 'Computer Lab', 26),
(967, 36, 344, 'Computer Lab', 30),
(968, 39, 450, 'Computer Lab', 31),
(969, 33, 464, 'Computer Lab', 21),
(970, 34, 480, 'Computer Lab', 25),
(971, 40, 160, 'Computer Lab', 26),
(972, 36, 513, 'Computer Lab', 32),
(973, 39, 209, 'Computer Lab', 26),
(974, 33, 431, 'Computer Lab', 21),
(975, 30, 298, 'Computer Lab', 28),
(976, 33, 469, 'Computer Lab', 35),
(977, 39, 441, 'Computer Lab', 33),
(978, 38, 217, 'Computer Lab', 20),
(979, 36, 491, 'Computer Lab', 27),
(980, 31, 288, 'Computer Lab', 20),
(981, 30, 459, 'Computer Lab', 23),
(982, 38, 526, 'Computer Lab', 24),
(983, 30, 553, 'Computer Lab', 31),
(984, 31, 158, 'Computer Lab', 33),
(985, 34, 355, 'Computer Lab', 25),
(986, 37, 580, 'Computer Lab', 33),
(987, 32, 108, 'Computer Lab', 20),
(988, 39, 297, 'Computer Lab', 24),
(989, 32, 158, 'Computer Lab', 30),
(990, 38, 116, 'Computer Lab', 23),
(991, 30, 357, 'Computer Lab', 22),
(992, 39, 486, 'Computer Lab', 32),
(993, 37, 339, 'Computer Lab', 33),
(994, 38, 125, 'Computer Lab', 20),
(995, 39, 497, 'Computer Lab', 33),
(996, 30, 138, 'Computer Lab', 20),
(997, 40, 472, 'Computer Lab', 33),
(998, 32, 406, 'Computer Lab', 24),
(999, 36, 125, 'Computer Lab', 30),
(1000, 40, 392, 'Computer Lab', 32);

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

DROP TABLE IF EXISTS `school`;
CREATE TABLE IF NOT EXISTS `school` (
  `school_id` int(11) NOT NULL AUTO_INCREMENT,
  `school_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`school_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`school_id`, `school_name`) VALUES
(1, 'School of Arts and Sciences'),
(2, 'School of Business'),
(3, 'School of Education'),
(4, 'School of Professional Studies');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

DROP TABLE IF EXISTS `section`;
CREATE TABLE IF NOT EXISTS `section` (
  `crn` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `room_id` int(11) DEFAULT NULL,
  `semester_id` int(11) NOT NULL,
  `timeslot_id` int(11) NOT NULL,
  PRIMARY KEY (`crn`),
  KEY `course_id` (`course_id`),
  KEY `room_id` (`room_id`),
  KEY `semester_id` (`semester_id`),
  KEY `timeslot_id` (`timeslot_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`crn`, `course_id`, `room_id`, `semester_id`, `timeslot_id`) VALUES
(20, 1, 9, 1, 1),
(21, 4, 55, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

DROP TABLE IF EXISTS `semester`;
CREATE TABLE IF NOT EXISTS `semester` (
  `semester_id` int(11) NOT NULL AUTO_INCREMENT,
  `sem_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sem_year` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sem_start_date` date NOT NULL,
  `sem_end_date` date NOT NULL,
  PRIMARY KEY (`semester_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`semester_id`, `sem_name`, `sem_year`, `sem_start_date`, `sem_end_date`) VALUES
(1, 'Fall 2017', '2017', '2017-08-28', '2017-12-22');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `student_id` int(11) NOT NULL,
  `gpa` int(11) NOT NULL,
  `student_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `gpa`, `student_type`) VALUES
(3, 0, ''),
(6, 0, ''),
(7, 0, ''),
(8, 0, ''),
(9, 0, ''),
(10, 0, ''),
(11, 0, ''),
(12, 0, ''),
(13, 0, ''),
(14, 0, ''),
(15, 0, ''),
(16, 0, ''),
(17, 0, ''),
(18, 0, ''),
(19, 0, ''),
(20, 0, ''),
(21, 0, ''),
(22, 0, ''),
(23, 0, ''),
(24, 0, ''),
(25, 0, ''),
(26, 0, ''),
(27, 0, ''),
(28, 0, ''),
(29, 0, ''),
(30, 0, ''),
(31, 0, ''),
(32, 0, ''),
(33, 0, ''),
(34, 0, ''),
(35, 0, ''),
(36, 0, ''),
(37, 0, ''),
(38, 0, ''),
(39, 0, ''),
(40, 0, ''),
(41, 0, ''),
(42, 0, ''),
(43, 0, ''),
(44, 0, ''),
(45, 0, ''),
(46, 0, ''),
(47, 0, ''),
(48, 0, ''),
(49, 0, ''),
(50, 0, ''),
(51, 0, ''),
(52, 0, ''),
(53, 0, ''),
(54, 0, ''),
(55, 0, ''),
(56, 0, ''),
(57, 0, ''),
(58, 0, ''),
(59, 0, ''),
(60, 0, ''),
(61, 0, ''),
(62, 0, ''),
(63, 0, ''),
(64, 0, ''),
(65, 0, ''),
(66, 0, ''),
(67, 0, ''),
(68, 0, ''),
(69, 0, ''),
(70, 0, ''),
(71, 0, ''),
(72, 0, ''),
(73, 0, ''),
(74, 0, ''),
(75, 0, ''),
(76, 0, ''),
(77, 0, ''),
(78, 0, ''),
(79, 0, ''),
(80, 0, ''),
(81, 0, ''),
(82, 0, ''),
(83, 0, ''),
(84, 0, ''),
(85, 0, ''),
(86, 0, ''),
(87, 0, ''),
(88, 0, ''),
(89, 0, ''),
(90, 0, ''),
(91, 0, ''),
(92, 0, ''),
(93, 0, ''),
(94, 0, ''),
(95, 0, ''),
(96, 0, ''),
(97, 0, ''),
(98, 0, ''),
(99, 0, ''),
(100, 0, ''),
(101, 0, ''),
(102, 0, ''),
(103, 0, ''),
(104, 0, ''),
(105, 0, ''),
(106, 0, ''),
(107, 0, ''),
(108, 0, ''),
(109, 0, ''),
(110, 0, ''),
(111, 0, ''),
(112, 0, ''),
(113, 0, ''),
(114, 0, ''),
(115, 0, ''),
(116, 0, ''),
(117, 0, ''),
(118, 0, ''),
(119, 0, ''),
(120, 0, ''),
(121, 0, ''),
(122, 0, ''),
(123, 0, ''),
(124, 0, ''),
(125, 0, ''),
(126, 0, ''),
(127, 0, ''),
(128, 0, ''),
(129, 0, ''),
(130, 0, ''),
(131, 0, ''),
(132, 0, ''),
(133, 0, ''),
(134, 0, ''),
(135, 0, ''),
(136, 0, ''),
(137, 0, ''),
(138, 0, ''),
(139, 0, ''),
(140, 0, ''),
(141, 0, ''),
(142, 0, ''),
(143, 0, ''),
(144, 0, ''),
(145, 0, ''),
(146, 0, ''),
(147, 0, ''),
(148, 0, ''),
(149, 0, ''),
(150, 0, ''),
(151, 0, ''),
(152, 0, ''),
(153, 0, ''),
(154, 0, ''),
(155, 0, ''),
(178, 0, 'part_time');

-- --------------------------------------------------------

--
-- Table structure for table `student_advisor`
--

DROP TABLE IF EXISTS `student_advisor`;
CREATE TABLE IF NOT EXISTS `student_advisor` (
  `faculty_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `date_assigned` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`faculty_id`,`student_id`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `student_advisor`
--

INSERT INTO `student_advisor` (`faculty_id`, `student_id`, `date_assigned`) VALUES
(6, 6, '2017-01-01 00:00:00'),
(6, 7, '2017-01-01 00:00:00'),
(6, 8, '2017-01-01 00:00:00'),
(7, 9, '2017-01-01 00:00:00'),
(7, 10, '2017-01-01 00:00:00'),
(7, 11, '2017-01-01 00:00:00'),
(8, 12, '2017-01-01 00:00:00'),
(8, 13, '2017-01-01 00:00:00'),
(8, 14, '2017-01-01 00:00:00'),
(9, 15, '2017-02-01 00:00:00'),
(9, 16, '2017-02-01 00:00:00'),
(9, 17, '2017-02-01 00:00:00'),
(10, 18, '2017-02-01 00:00:00'),
(10, 19, '2017-02-01 00:00:00'),
(10, 20, '2017-02-01 00:00:00'),
(11, 21, '2017-03-01 00:00:00'),
(11, 22, '2017-03-01 00:00:00'),
(11, 23, '2017-03-01 00:00:00'),
(12, 24, '2017-03-01 00:00:00'),
(12, 25, '2017-03-01 00:00:00'),
(12, 26, '2017-03-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `student_hold`
--

DROP TABLE IF EXISTS `student_hold`;
CREATE TABLE IF NOT EXISTS `student_hold` (
  `hold_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `hold_date` date DEFAULT NULL,
  PRIMARY KEY (`hold_id`,`student_id`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_major`
--

DROP TABLE IF EXISTS `student_major`;
CREATE TABLE IF NOT EXISTS `student_major` (
  `major_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  PRIMARY KEY (`major_id`,`student_id`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `student_major`
--

INSERT INTO `student_major` (`major_id`, `student_id`) VALUES
(5, 25),
(17, 20),
(17, 21),
(17, 23),
(17, 24),
(17, 25),
(27, 20),
(27, 21),
(27, 23),
(27, 25),
(27, 30),
(27, 88),
(28, 20),
(28, 21),
(28, 22),
(28, 23),
(28, 88);

-- --------------------------------------------------------

--
-- Table structure for table `student_minor`
--

DROP TABLE IF EXISTS `student_minor`;
CREATE TABLE IF NOT EXISTS `student_minor` (
  `minor_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  PRIMARY KEY (`minor_id`,`student_id`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teaching`
--

DROP TABLE IF EXISTS `teaching`;
CREATE TABLE IF NOT EXISTS `teaching` (
  `faculty_id` int(11) NOT NULL,
  `crn` int(11) NOT NULL,
  PRIMARY KEY (`faculty_id`,`crn`),
  KEY `crn` (`crn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `timeslot`
--

DROP TABLE IF EXISTS `timeslot`;
CREATE TABLE IF NOT EXISTS `timeslot` (
  `timeslot_id` int(11) NOT NULL AUTO_INCREMENT,
  `day_id` int(11) NOT NULL,
  `period_id` int(11) NOT NULL,
  PRIMARY KEY (`timeslot_id`),
  KEY `day_id` (`day_id`),
  KEY `period_id` (`period_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `timeslot`
--

INSERT INTO `timeslot` (`timeslot_id`, `day_id`, `period_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 2, 1),
(9, 2, 2),
(10, 2, 3),
(11, 2, 4),
(12, 2, 5),
(13, 2, 6),
(14, 2, 7),
(15, 3, 1),
(16, 3, 2),
(17, 3, 3),
(18, 3, 4),
(19, 3, 5),
(20, 3, 6),
(21, 3, 7);

-- --------------------------------------------------------

--
-- Table structure for table `transcript`
--

DROP TABLE IF EXISTS `transcript`;
CREATE TABLE IF NOT EXISTS `transcript` (
  `student_id` int(11) NOT NULL,
  `crn` int(11) NOT NULL,
  `grade` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `semester_id` int(11) DEFAULT NULL,
  `faculty_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`student_id`,`crn`),
  KEY `crn` (`crn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tel_num` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_type` enum('F','S','A','R') COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=182 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `date_of_birth`, `email`, `tel_num`, `user_type`, `username`, `password`) VALUES
(1, 'admin', 'admin', '1970-01-01', 'admin@gupta.edu', '516-516-5140', 'A', 'admin@gupta.edu', 'admin'),
(3, 'Student', 'Test', '2017-03-08', 'student@gupta.edu', '1111111111', 'S', 'student@gupta.edu', 'student'),
(4, 'Research', 'Test', '2016-02-16', 'research@gupta.edu', '1113215489', 'R', 'research@gupta.edu', 'research'),
(5, 'faculty', 'test', '1971-12-02', 'faculty@gupta.edu', '17777777777', 'F', 'faculty@gupta.edu', 'faculty'),
(6, 'Timothy', 'Olson', '1996-10-26', 'tolson0@wordpress.org', '51-(991)503', 'F', 'tolson0@wordpress.org', 'X1dAAp'),
(7, 'Gregory', 'Jenkins', '1929-01-30', 'gjenkins1@mashable.com', '55-(583)370', 'F', 'gjenkins1@mashable.com', '7jp1ObrIoez'),
(8, 'Ralph', 'Robertson', '1975-04-24', 'rrobertson2@nymag.com', '351-(622)67', 'F', 'rrobertson2@nymag.com', 'NWdokBT4OGMP'),
(9, 'Cynthia', 'Foster', '1946-11-15', 'cfoster3@plala.or.jp', '389-(715)14', 'F', 'cfoster3@plala.or.jp', 'bheqdprOMl4'),
(10, 'Dorothy', 'Cox', '1992-12-15', 'dcox4@ihg.com', '93-(258)109', 'F', 'dcox4@ihg.com', 'LnnrwqEG'),
(11, 'Henry', 'Mills', '1920-04-22', 'hmills5@sohu.com', '33-(328)683', 'F', 'hmills5@sohu.com', 'QVqT1pDpz5'),
(12, 'Deborah', 'Arnold', '1955-02-13', 'darnold6@example.com', '46-(910)846', 'F', 'darnold6@example.com', 'nxfPO7gO0ECV'),
(13, 'Doris', 'Kelley', '1924-08-14', 'dkelley7@mozilla.com', '66-(456)264', 'F', 'dkelley7@mozilla.com', '32tZQ2w'),
(14, 'Sandra', 'Bennett', '1953-08-11', 'sbennett8@behance.net', '86-(325)533', 'F', 'sbennett8@behance.net', 'U3FfB7PiH'),
(15, 'Jean', 'Stone', '1965-12-25', 'jstone9@a8.net', '86-(201)790', 'S', 'jstone9@a8.net', 'RF5xVtOoJDo'),
(16, 'Brenda', 'Coleman', '1952-07-10', 'bcolemana@netlog.com', '372-(647)53', 'S', 'bcolemana@netlog.com', '6c4txvQNOsT'),
(17, 'Ruby', 'Coleman', '1941-04-15', 'rcolemanb@adobe.com', '27-(554)783', 'S', 'rcolemanb@adobe.com', 'xIsfei'),
(18, 'Nancy', 'Moore', '1946-07-25', 'nmoorec@wikia.com', '62-(963)645', 'S', 'nmoorec@wikia.com', 'cQXa6iFzvGw'),
(19, 'Sarah', 'Russell', '1981-01-05', 'srusselld@amazon.co.uk', '62-(566)179', 'S', 'srusselld@amazon.co.uk', '1hoGbGdnojLn'),
(20, 'Judith', 'Bell', '1920-03-24', 'jbelle@opensource.org', '543-666-7898', 'S', 'jbelle@opensource.org', 'eOTAcZU29'),
(21, 'Irene', 'Graham', '1906-07-14', 'igrahamf@myspace.com', '86-(104)305', 'S', 'igrahamf@myspace.com', 'XxaGK1'),
(22, 'Daniel', 'Crawford', '1991-09-01', 'dcrawfordg@washington.edu', '62-(149)424', 'S', 'dcrawfordg@washington.edu', 'iDc62huHtHLA'),
(23, 'Andrea', 'Parker', '1929-12-14', 'aparkerh@buzzfeed.com', '39-(337)498', 'S', 'aparkerh@buzzfeed.com', 'mrABnmFDZ6w'),
(24, 'Paula', 'Baker', '1983-12-25', 'pbakeri@google.com.br', '46-(531)352', 'S', 'pbakeri@google.com.br', 'xnyUR6qtF'),
(25, 'Louis', 'Snyder', '1964-12-25', 'lsnyderj@cpanel.net', '351-(484)54', 'S', 'lsnyderj@cpanel.net', '37KMHG'),
(26, 'Barbara', 'Cruz', '1973-04-19', 'bcruzk@bizjournals.com', '212-(764)24', 'S', 'bcruzk@bizjournals.com', '2eiLhwueQ'),
(27, 'Brandon', 'Woods', '1962-01-31', 'bwoodsl@mlb.com', '46-(744)776', 'S', 'bwoodsl@mlb.com', 'imy28fZ7AJn'),
(28, 'Jessica', 'Boyd', '1955-05-05', 'jboydm@twitpic.com', '62-(154)581', 'S', 'jboydm@twitpic.com', 'X4pUKvmH0hVc'),
(29, 'Teresa', 'Mendoza', '1937-05-19', 'tmendozan@amazon.de', '55-(915)892', 'S', 'tmendozan@amazon.de', '3TZSBlh8g1'),
(30, 'Patrick', 'Porter', '1961-02-05', 'pportero@npr.org', '98-(560)600', 'S', 'pportero@npr.org', '00ES8MWVEBUG'),
(31, 'Janice', 'Thomas', '1917-03-09', 'jthomasp@umn.edu', '62-(163)863', 'S', 'jthomasp@umn.edu', 'solK583yjb5n'),
(32, 'Denise', 'Ruiz', '1996-01-12', 'druizq@home.pl', '62-(101)883', 'S', 'druizq@home.pl', 'vqj3IzVpN'),
(33, 'Brian', 'Carpenter', '1980-09-13', 'bcarpenterr@jugem.jp', '7-(752)183-', 'S', 'bcarpenterr@jugem.jp', '7lNvWrtIma'),
(34, 'Cynthia', 'Hansen', '1951-03-31', 'chansens@army.mil', '66-(782)863', 'S', 'chansens@army.mil', '3nKN6WJ6ShC'),
(35, 'Irene', 'Powell', '1928-09-18', 'ipowellt@cnbc.com', '46-(673)617', 'S', 'ipowellt@cnbc.com', 'IcslSIDu4'),
(36, 'Earl', 'Richards', '1957-02-20', 'erichardsu@google.it', '7-(617)736-', 'S', 'erichardsu@google.it', 'XCagg6x0cfhk'),
(37, 'Lois', 'Vasquez', '1994-12-15', 'lvasquezv@dropbox.com', '57-(352)135', 'S', 'lvasquezv@dropbox.com', 'J6rDTKG'),
(38, 'Samuel', 'Simpson', '1900-10-12', 'ssimpsonw@forbes.com', '86-(742)475', 'S', 'ssimpsonw@forbes.com', 'NVGh886'),
(39, 'Virginia', 'Nelson', '1909-09-02', 'vnelsonx@furl.net', '66-(185)508', 'S', 'vnelsonx@furl.net', 'nB1dnUZ1'),
(40, 'Beverly', 'Foster', '1978-10-05', 'bfostery@weebly.com', '86-(796)137', 'S', 'bfostery@weebly.com', '7JhClgzR'),
(41, 'Beverly', 'Scott', '1964-10-24', 'bscottz@ihg.com', '7-(801)646-', 'S', 'bscottz@ihg.com', 'qULGJpwrpR9'),
(42, 'Wanda', 'Murray', '1931-02-09', 'wmurray10@google.it', '86-(270)352', 'S', 'wmurray10@google.it', 'CtwJzqgdyc'),
(43, 'Aaron', 'Oliver', '1986-04-06', 'aoliver11@hc360.com', '380-(353)21', 'S', 'aoliver11@hc360.com', 'Upi34glRGJ'),
(44, 'Steve', 'Holmes', '1935-09-20', 'sholmes12@netscape.com', '505-(474)74', 'S', 'sholmes12@netscape.com', 'GhCfvTwX'),
(45, 'Amanda', 'Rivera', '1987-06-29', 'arivera13@linkedin.com', '380-(919)64', 'S', 'arivera13@linkedin.com', 'T8Z9PZGKB3yw'),
(46, 'Gregory', 'Fernandez', '1949-12-29', 'gfernandez14@scientificamerican.com', '48-(215)478', 'S', 'gfernandez14@scientificamerican.com', 'eh8THpMV'),
(47, 'Randy', 'Butler', '1900-08-25', 'rbutler15@phoca.cz', '55-(860)178', 'S', 'rbutler15@phoca.cz', 'qgeErrkft48'),
(48, 'Andrew', 'Campbell', '1921-09-28', 'acampbell16@purevolume.com', '63-(974)343', 'S', 'acampbell16@purevolume.com', 'nhNTw5XnAQ'),
(49, 'Jonathan', 'Fernandez', '1987-03-06', 'jfernandez17@odnoklassniki.ru', '86-(535)611', 'S', 'jfernandez17@odnoklassniki.ru', 'Vk7SaCw44kF'),
(50, 'Ronald', 'Diaz', '1927-05-22', 'rdiaz18@technorati.com', '48-(829)318', 'S', 'rdiaz18@technorati.com', 'NkBcTxu17s'),
(51, 'Dorothy', 'Pierce', '1967-10-26', 'dpierce19@cnn.com', '63-(360)194', 'S', 'dpierce19@cnn.com', 'B1Dae9r'),
(52, 'Stephen', 'Gutierrez', '1927-10-09', 'sgutierrez1a@free.fr', '358-(750)32', 'S', 'sgutierrez1a@free.fr', 'nFiHSYOeJoE5'),
(53, 'Ronald', 'Hansen', '1993-11-07', 'rhansen1b@cyberchimps.com', '33-(958)928', 'S', 'rhansen1b@cyberchimps.com', 'rAJgYDVebz4'),
(54, 'Jack', 'Greene', '1932-04-29', 'jgreene1c@msu.edu', '44-(457)818', 'S', 'jgreene1c@msu.edu', 'tnz0w3P7'),
(55, 'Donna', 'Mcdonald', '1929-09-24', 'dmcdonald1d@ft.com', '7-(351)859-', 'S', 'dmcdonald1d@ft.com', 'BDlzpMUT'),
(56, 'Ruth', 'Scott', '1964-07-31', 'rscott1e@vk.com', '86-(633)673', 'S', 'rscott1e@vk.com', 'rqFuJDuD6R'),
(57, 'Laura', 'Pierce', '1969-01-07', 'lpierce1f@reference.com', '86-(211)495', 'S', 'lpierce1f@reference.com', 'x9t5XcZJl'),
(58, 'David', 'Gilbert', '1971-02-24', 'dgilbert1g@redcross.org', '33-(865)505', 'S', 'dgilbert1g@redcross.org', 'TjbKkvh8pU'),
(59, 'Carl', 'Wilson', '1934-01-17', 'cwilson1h@amazon.de', '48-(549)709', 'S', 'cwilson1h@amazon.de', '98ju65zU7'),
(60, 'Michelle', 'Barnes', '1929-03-19', 'mbarnes1i@epa.gov', '41-(851)679', 'S', 'mbarnes1i@epa.gov', '2zk0EvN2GwGe'),
(61, 'Jerry', 'Ross', '1977-11-23', 'jross1j@msn.com', '1-(138)563-', 'S', 'jross1j@msn.com', 'fY3iDtc'),
(62, 'Timothy', 'Garrett', '1950-01-03', 'tgarrett1k@cnbc.com', '381-(611)33', 'S', 'tgarrett1k@cnbc.com', 'qtVyZ5Ngej0'),
(63, 'Sharon', 'Gilbert', '1964-02-21', 'sgilbert1l@scribd.com', '63-(390)264', 'S', 'sgilbert1l@scribd.com', 'ZRHrGQmq'),
(64, 'Ruby', 'Washington', '1974-10-31', 'rwashington1m@com.com', '86-(984)239', 'S', 'rwashington1m@com.com', 'c0871ZFNCpsI'),
(65, 'Norma', 'Morrison', '1921-08-23', 'nmorrison1n@sogou.com', '380-(692)44', 'S', 'nmorrison1n@sogou.com', 'Xtw6VCG'),
(66, 'Gloria', 'Moreno', '1924-02-09', 'gmoreno1o@amazon.co.uk', '86-(337)279', 'S', 'gmoreno1o@amazon.co.uk', 'Ps6ssVB24L'),
(67, 'Diane', 'Peterson', '1932-04-17', 'dpeterson1p@weather.com', '237-(123)46', 'S', 'dpeterson1p@weather.com', 'kBONkcWMIp'),
(68, 'Paula', 'Martin', '1950-03-28', 'pmartin1q@berkeley.edu', '86-(990)969', 'S', 'pmartin1q@berkeley.edu', 'Gno1KS'),
(69, 'Paul', 'Rivera', '1970-06-30', 'privera1r@alexa.com', '49-(988)778', 'S', 'privera1r@alexa.com', 'lvpWbQ'),
(70, 'Raymond', 'Moreno', '1916-08-08', 'rmoreno1s@paypal.com', '57-(564)225', 'S', 'rmoreno1s@paypal.com', 'Toi3gt'),
(71, 'Mildred', 'Palmer', '1932-06-30', 'mpalmer1t@jugem.jp', '62-(155)592', 'S', 'mpalmer1t@jugem.jp', 'cPggoIwEqmhB'),
(72, 'Tina', 'Day', '1998-02-10', 'tday1u@oaic.gov.au', '62-(508)185', 'S', 'tday1u@oaic.gov.au', 'd1zbnnf'),
(73, 'Albert', 'Gray', '1915-02-08', 'agray1v@google.com.hk', '86-(520)219', 'S', 'agray1v@google.com.hk', 'ZNbBVY'),
(74, 'Douglas', 'Snyder', '1922-11-08', 'dsnyder1w@earthlink.net', '63-(328)904', 'S', 'dsnyder1w@earthlink.net', 'Gn5xgMg9X'),
(75, 'Jonathan', 'Ray', '1952-04-05', 'jray1x@clickbank.net', '7-(779)879-', 'S', 'jray1x@clickbank.net', 'XkU8X1LStpD'),
(76, 'Christine', 'Burton', '1936-12-08', 'cburton1y@issuu.com', '86-(853)232', 'S', 'cburton1y@issuu.com', 'dsIxB4A'),
(77, 'Robin', 'Stephens', '1947-11-30', 'rstephens1z@clickbank.net', '48-(395)928', 'S', 'rstephens1z@clickbank.net', '4JRcNb'),
(78, 'Andrew', 'Hawkins', '1917-09-04', 'ahawkins20@smugmug.com', '220-(226)35', 'S', 'ahawkins20@smugmug.com', 'SdTqeWg'),
(79, 'Louise', 'Rose', '1900-07-16', 'lrose21@army.mil', '254-(942)94', 'S', 'lrose21@army.mil', 'hwY9JayPFfv'),
(80, 'James', 'Willis', '1995-02-26', 'jwillis22@berkeley.edu', '968-(848)54', 'S', 'jwillis22@berkeley.edu', 'eybDF5uJoj6'),
(81, 'Sandra', 'Nguyen', '1913-06-14', 'snguyen23@csmonitor.com', '63-(431)459', 'S', 'snguyen23@csmonitor.com', '4gCtfc'),
(82, 'Samuel', 'Willis', '1996-10-27', 'swillis24@sbwire.com', '1-(489)845-', 'S', 'swillis24@sbwire.com', 'C0JLO8wC'),
(83, 'Teresa', 'Sanders', '1925-01-31', 'tsanders25@oracle.com', '86-(281)658', 'S', 'tsanders25@oracle.com', 'GL0DKHv'),
(84, 'Edward', 'Thompson', '1957-04-08', 'ethompson26@yandex.ru', '60-(557)277', 'S', 'ethompson26@yandex.ru', 'a866pvgc'),
(85, 'Tammy', 'Brown', '1912-02-09', 'tbrown27@amazon.co.jp', '33-(739)403', 'S', 'tbrown27@amazon.co.jp', 'HjDDNknJ'),
(86, 'Heather', 'Hansen', '1956-02-04', 'hhansen28@digg.com', '380-(465)91', 'S', 'hhansen28@digg.com', 'F48TjPlFQG'),
(87, 'Clarence', 'Porter', '1912-05-08', 'cporter29@alexa.com', '66-(420)484', 'S', 'cporter29@alexa.com', 'aAtdbXb0dK'),
(88, 'Judith', 'Patterson', '1941-07-05', 'jpatterson2a@admin.ch', '47-(761)798', 'S', 'jpatterson2a@admin.ch', '9Q6gWvciwGv'),
(89, 'Jesse', 'Alvarez', '1987-05-02', 'jalvarez2b@facebook.com', '55-(482)464', 'S', 'jalvarez2b@facebook.com', 'gSFJ1apAUUb'),
(90, 'Andrea', 'Perkins', '1994-10-26', 'aperkins2c@1688.com', '48-(485)783', 'S', 'aperkins2c@1688.com', 'FBns77O'),
(91, 'Linda', 'Sanchez', '1964-05-02', 'lsanchez2d@vkontakte.ru', '351-(234)57', 'S', 'lsanchez2d@vkontakte.ru', 'jtlvTazza'),
(92, 'Susan', 'Collins', '1991-04-21', 'scollins2e@last.fm', '852-(679)68', 'S', 'scollins2e@last.fm', 'HuE4nw3B18'),
(93, 'William', 'Ramirez', '1952-03-27', 'wramirez2f@who.int', '46-(705)199', 'S', 'wramirez2f@who.int', '3aYrIkfw'),
(94, 'Lawrence', 'Burns', '1918-07-24', 'lburns2g@time.com', '998-(136)89', 'S', 'lburns2g@time.com', 'YCmMqiipck'),
(95, 'Joan', 'Castillo', '1936-06-27', 'jcastillo2h@harvard.edu', '33-(803)904', 'S', 'jcastillo2h@harvard.edu', 'PBhTfbv'),
(96, 'Craig', 'Day', '1972-04-14', 'cday2i@topsy.com', '51-(180)117', 'S', 'cday2i@topsy.com', 'iH55DSHSgj0'),
(97, 'Timothy', 'Schmidt', '1942-04-29', 'tschmidt2j@wufoo.com', '86-(405)861', 'S', 'tschmidt2j@wufoo.com', '0NvoMX7iOpl'),
(98, 'Andrew', 'Franklin', '1978-03-14', 'afranklin2k@tmall.com', '55-(259)975', 'S', 'afranklin2k@tmall.com', 'R8WVEsEif7cl'),
(99, 'Bruce', 'Nguyen', '1921-11-07', 'bnguyen2l@bloglovin.com', '7-(981)620-', 'S', 'bnguyen2l@bloglovin.com', 'lfxtVT13'),
(100, 'Jack', 'Thomas', '1905-10-03', 'jthomas2m@pcworld.com', '372-(900)76', 'S', 'jthomas2m@pcworld.com', 'vOZpMuNQlLw'),
(101, 'Janet', 'Harper', '1912-01-14', 'jharper2n@arizona.edu', '420-(711)17', 'S', 'jharper2n@arizona.edu', 'ZkrJoe1r'),
(102, 'Theresa', 'Walker', '1965-09-21', 'twalker2o@harvard.edu', '7-(870)594-', 'S', 'twalker2o@harvard.edu', 'lCV7LHf2'),
(103, 'Russell', 'Simmons', '1965-09-27', 'rsimmons2p@ezinearticles.com', '212-(291)38', 'S', 'rsimmons2p@ezinearticles.com', 'Usz2jqKsv'),
(104, 'Evelyn', 'Berry', '1972-10-14', 'eberry2q@dailymotion.com', '33-(287)535', 'S', 'eberry2q@dailymotion.com', 'O3Q94yzQ'),
(105, 'Ryan', 'Wells', '1979-09-24', 'rwells2r@walmart.com', '504-(765)59', 'S', 'rwells2r@walmart.com', '7GIJHnsTVDM5'),
(106, 'Katherine', 'Jacobs', '1927-04-12', 'kjacobs2s@illinois.edu', '86-(171)209', 'S', 'kjacobs2s@illinois.edu', 'wKTGZEKH'),
(107, 'Keith', 'Jacobs', '1909-05-27', 'kjacobs2t@bloglovin.com', '33-(843)453', 'S', 'kjacobs2t@bloglovin.com', 'lgp58G'),
(108, 'Andrea', 'Patterson', '1992-12-11', 'apatterson2u@nationalgeographic.com', '380-(172)62', 'S', 'apatterson2u@nationalgeographic.com', 'jCmC8YbhMcB'),
(109, 'Sandra', 'Lane', '1902-02-27', 'slane2v@howstuffworks.com', '7-(489)213-', 'S', 'slane2v@howstuffworks.com', 'b3eVMXJH'),
(110, 'Kathryn', 'Peterson', '1999-03-13', 'kpeterson2w@phpbb.com', '86-(648)801', 'S', 'kpeterson2w@phpbb.com', 'DZXjEUCwwe'),
(111, 'Mildred', 'Bradley', '1915-09-25', 'mbradley2x@gmpg.org', '351-(534)42', 'S', 'mbradley2x@gmpg.org', '7WANucL4jnB'),
(112, 'Jimmy', 'Stanley', '1926-05-15', 'jstanley2y@ebay.com', '62-(822)116', 'S', 'jstanley2y@ebay.com', 'pfE3LCQh'),
(113, 'Denise', 'Anderson', '1914-01-17', 'danderson2z@theatlantic.com', '62-(298)257', 'S', 'danderson2z@theatlantic.com', 'KuipMzBHbId'),
(114, 'Nicholas', 'Henderson', '1962-12-01', 'nhenderson30@csmonitor.com', '92-(890)491', 'S', 'nhenderson30@csmonitor.com', '3tvyn7AhpHGa'),
(115, 'Rose', 'Howell', '1958-04-24', 'rhowell31@ihg.com', '63-(767)862', 'S', 'rhowell31@ihg.com', 'EZMaoVbvYMQ'),
(116, 'Mark', 'Reid', '1979-08-08', 'mreid32@whitehouse.gov', '46-(400)730', 'S', 'mreid32@whitehouse.gov', 'VmNKT0zvgEbb'),
(117, 'Gregory', 'Webb', '1998-11-19', 'gwebb33@oracle.com', '55-(280)798', 'S', 'gwebb33@oracle.com', 'OxCDClp'),
(118, 'Ashley', 'Day', '1952-11-14', 'aday34@businessweek.com', '31-(448)370', 'S', 'aday34@businessweek.com', '3tmUHoMiEj'),
(119, 'Ashley', 'Stanley', '1921-11-28', 'astanley35@ft.com', '880-(813)28', 'S', 'astanley35@ft.com', '23X9Pwd9szd'),
(120, 'Aaron', 'Kelley', '1979-09-15', 'akelley36@prnewswire.com', '46-(193)113', 'S', 'akelley36@prnewswire.com', 'SJAHYaBY'),
(121, 'Terry', 'Chapman', '1976-01-04', 'tchapman37@ebay.co.uk', '46-(684)750', 'S', 'tchapman37@ebay.co.uk', 'vkJXFpnuh'),
(122, 'Billy', 'Owens', '1908-12-19', 'bowens38@parallels.com', '351-(620)90', 'S', 'bowens38@parallels.com', 'ghDw5Zi7V'),
(123, 'Judy', 'Gonzales', '1995-12-10', 'jgonzales39@github.com', '81-(727)636', 'S', 'jgonzales39@github.com', 'x6cOSkn'),
(124, 'Juan', 'Kennedy', '1946-10-14', 'jkennedy3a@squidoo.com', '1-(602)546-', 'S', 'jkennedy3a@squidoo.com', 'V4FXsjLIp1aM'),
(125, 'Helen', 'Chapman', '1908-10-09', 'hchapman3b@columbia.edu', '358-(965)72', 'S', 'hchapman3b@columbia.edu', 'p9pwsYacj'),
(126, 'Virginia', 'Bennett', '1961-11-01', 'vbennett3c@imdb.com', '86-(741)292', 'S', 'vbennett3c@imdb.com', 'g8Y8KsCwTJF'),
(127, 'Justin', 'Mcdonald', '1948-05-16', 'jmcdonald3d@vk.com', '380-(527)99', 'S', 'jmcdonald3d@vk.com', 'HmfDRweOO73U'),
(128, 'Pamela', 'Henry', '1995-09-29', 'phenry3e@t.co', '62-(594)619', 'S', 'phenry3e@t.co', 'a6UqubyGi'),
(129, 'Martin', 'Oliver', '1970-11-03', 'moliver3f@nasa.gov', '86-(588)115', 'S', 'moliver3f@nasa.gov', 'SyZWNnkwe4'),
(130, 'Joe', 'Garza', '1979-07-16', 'jgarza3g@opera.com', '850-(255)49', 'S', 'jgarza3g@opera.com', 'o5a2geh'),
(131, 'Jeremy', 'Mitchell', '1942-09-20', 'jmitchell3h@youku.com', '48-(978)125', 'S', 'jmitchell3h@youku.com', 'U7VNuiVq'),
(132, 'Shirley', 'Carr', '1985-10-16', 'scarr3i@irs.gov', '1-(117)410-', 'S', 'scarr3i@irs.gov', 'W5XwJAu1WbW'),
(133, 'Anna', 'Gonzalez', '1986-06-21', 'agonzalez3j@stumbleupon.com', '86-(341)830', 'S', 'agonzalez3j@stumbleupon.com', 'SRLoh4B9V'),
(134, 'Ralph', 'Sanders', '1933-11-05', 'rsanders3k@google.ca', '355-(375)59', 'S', 'rsanders3k@google.ca', '8MguaYa6Irkt'),
(135, 'Sharon', 'Green', '1932-08-15', 'sgreen3l@smh.com.au', '86-(272)986', 'S', 'sgreen3l@smh.com.au', 'sipN3jpP'),
(136, 'Adam', 'Sullivan', '1992-03-08', 'asullivan3m@paypal.com', '48-(926)873', 'S', 'asullivan3m@paypal.com', '6OhtVvCO'),
(137, 'Shirley', 'Fuller', '1974-10-25', 'sfuller3n@msn.com', '86-(112)837', 'S', 'sfuller3n@msn.com', 'B8TmNwM3biVD'),
(138, 'Charles', 'Henry', '1978-05-08', 'chenry3o@admin.ch', '51-(282)738', 'S', 'chenry3o@admin.ch', 'w2Ec2pN6A5ig'),
(139, 'Shawn', 'Palmer', '1987-06-03', 'spalmer3p@yolasite.com', '381-(329)80', 'S', 'spalmer3p@yolasite.com', 'U6swsf'),
(140, 'Helen', 'Baker', '1917-06-15', 'hbaker3q@prnewswire.com', '62-(229)469', 'S', 'hbaker3q@prnewswire.com', 'z8NDzaFjqwSH'),
(141, 'Katherine', 'Berry', '1957-01-14', 'kberry3r@smugmug.com', '7-(913)253-', 'S', 'kberry3r@smugmug.com', 'S1DJQmGI9'),
(142, 'Aaron', 'Bradley', '1966-02-16', 'abradley3s@ocn.ne.jp', '62-(882)525', 'S', 'abradley3s@ocn.ne.jp', 'xav9WL'),
(143, 'Antonio', 'Gibson', '1963-05-31', 'agibson3t@abc.net.au', '7-(830)647-', 'S', 'agibson3t@abc.net.au', 'oUkHIDFqu'),
(144, 'Fred', 'Fowler', '1925-07-01', 'ffowler3u@blogs.com', '86-(361)769', 'S', 'ffowler3u@blogs.com', '61XSuo9Jj'),
(145, 'Russell', 'King', '1909-11-01', 'rking3v@adobe.com', '1-(837)220-', 'S', 'rking3v@adobe.com', 'phbP9xRQ'),
(146, 'Frances', 'Hill', '1943-01-16', 'fhill3w@stumbleupon.com', '86-(223)252', 'S', 'fhill3w@stumbleupon.com', '0Ul7DH1'),
(147, 'Heather', 'Sims', '1972-05-05', 'hsims3x@prlog.org', '54-(368)661', 'S', 'hsims3x@prlog.org', 'l54LfwX'),
(148, 'Laura', 'Berry', '1990-06-26', 'lberry3y@newsvine.com', '62-(798)980', 'S', 'lberry3y@newsvine.com', 'N5gZ0d'),
(149, 'Earl', 'Stewart', '1968-07-28', 'estewart3z@nydailynews.com', '62-(208)198', 'S', 'estewart3z@nydailynews.com', 'NKzP2kGG'),
(150, 'Stephanie', 'Hart', '1972-04-14', 'shart40@about.com', '86-(514)810', 'S', 'shart40@about.com', 'IF4O7CPF'),
(151, 'Victor', 'Henry', '1903-03-09', 'vhenry41@meetup.com', '62-(420)985', 'S', 'vhenry41@meetup.com', 'EkrRCTIb'),
(152, 'Albert', 'Reed', '1936-04-22', 'areed42@51.la', '351-(915)15', 'S', 'areed42@51.la', 'gxTfIXqxRM'),
(153, 'Judy', 'Garcia', '1970-03-10', 'jgarcia43@seesaa.net', '46-(612)246', 'S', 'jgarcia43@seesaa.net', 'mUUdkTe'),
(154, 'Deborah', 'Gibson', '1979-01-05', 'dgibson44@independent.co.uk', '86-(512)854', 'S', 'dgibson44@independent.co.uk', 'GtdfONDQ4G'),
(155, 'Jimmy', 'Weaver', '1935-04-09', 'jweaver45@ebay.co.uk', '52-(762)926', 'S', 'jweaver45@ebay.co.uk', 'qhgfN9rAy'),
(160, 'Khizar', 'Alvi', '2017-03-02', 'khizar@gmail.com', '633-333-3333', 'A', 'khizar009', 'Khizar889'),
(167, 'Jesus', 'Trnas', '0000-00-00', 'tests@gupta.edu', '1000000', 'A', '$tests@gupta.edu', 'test1'),
(168, 'Bill', 'Gates', '2017-03-01', 'Bill@gmail.com', '555-555-5555', 'A', 'bill005', 'Jgjfh77ff'),
(170, 'Susan', 'Elizabeth', '2017-03-01', 'susan@gmail.com', '555-333-2323', 'F', 'susan007', 'Susan998'),
(171, 'admin', 'rand', '1995-02-01', 'admin@gmail.com', '666-666-6666', 'A', 'admin007', 'Kdkdk00'),
(174, 'Anas', 'Alvi', '1994-02-16', 'anas_593@hotmail.com', '777-777-7777', 'A', 'anas007', 'Alvi007'),
(175, 'Lili', 'Hai', '1975-07-10', 'Hail@gupta.edu', '7184578956', 'F', 'lilihai', 'Cs1111'),
(176, 'Forest', 'Trumb', '1965-07-10', 'Trumbf@gupta.edu', '1784581845', 'F', 'trumbf', 'Cs11111'),
(177, 'Benny', 'Pena', '1995-07-12', 'bpena@gupta.edu', '3475551471', 'R', 'bpena', 'Admin1'),
(178, 'Jesse', 'Blake', '1995-06-08', 'blakej@gupta.edu', '1471478529', 'S', 'blakej', 'Student1'),
(179, 'Glen', 'Dodd', '1995-07-12', 'doddg@email.com', '1111111112', 'A', 'dodd2', 'Test123'),
(180, 'Jeff', 'Godoy', '2017-03-10', 'jeff@gmail.com', '666-666-6666', 'A', 'jeff@gmail.com', 'Kdkdkdk8');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `administrator`
--
ALTER TABLE `administrator`
  ADD CONSTRAINT `administrator_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk1` FOREIGN KEY (`dept_id`) REFERENCES `department` (`dept_id`);

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `department_ibfk1` FOREIGN KEY (`chair_id`) REFERENCES `faculty` (`faculty_id`),
  ADD CONSTRAINT `department_ibfk2` FOREIGN KEY (`school_id`) REFERENCES `school` (`school_id`);

--
-- Constraints for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD CONSTRAINT `enrollment_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`),
  ADD CONSTRAINT `enrollment_ibfk_2` FOREIGN KEY (`crn`) REFERENCES `section` (`crn`);

--
-- Constraints for table `faculty`
--
ALTER TABLE `faculty`
  ADD CONSTRAINT `faculty_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `faculty_department`
--
ALTER TABLE `faculty_department`
  ADD CONSTRAINT `faculty_department_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`faculty_id`),
  ADD CONSTRAINT `faculty_department_ibfk_2` FOREIGN KEY (`dept_id`) REFERENCES `department` (`dept_id`);

--
-- Constraints for table `faculty_full_time`
--
ALTER TABLE `faculty_full_time`
  ADD CONSTRAINT `faculty_full_time_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`faculty_id`);

--
-- Constraints for table `faculty_part_time`
--
ALTER TABLE `faculty_part_time`
  ADD CONSTRAINT `faculty_part_time_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`faculty_id`);

--
-- Constraints for table `major`
--
ALTER TABLE `major`
  ADD CONSTRAINT `major_ibfk_1` FOREIGN KEY (`dept_id`) REFERENCES `department` (`dept_id`),
  ADD CONSTRAINT `major_ibfk_2` FOREIGN KEY (`degree_id`) REFERENCES `degree` (`degree_id`);

--
-- Constraints for table `major_courses`
--
ALTER TABLE `major_courses`
  ADD CONSTRAINT `major_courses_ibfk_1` FOREIGN KEY (`major_id`) REFERENCES `major` (`major_id`),
  ADD CONSTRAINT `major_courses_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`);

--
-- Constraints for table `meeting`
--
ALTER TABLE `meeting`
  ADD CONSTRAINT `meeting_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`),
  ADD CONSTRAINT `meeting_ibfk_2` FOREIGN KEY (`crn`) REFERENCES `section` (`crn`);

--
-- Constraints for table `minor_department`
--
ALTER TABLE `minor_department`
  ADD CONSTRAINT `minor_department_ibfk_1` FOREIGN KEY (`minor_id`) REFERENCES `minor` (`minor_id`),
  ADD CONSTRAINT `minor_department_ibfk_2` FOREIGN KEY (`dept_id`) REFERENCES `department` (`dept_id`);

--
-- Constraints for table `prerequisites`
--
ALTER TABLE `prerequisites`
  ADD CONSTRAINT `prerequisites_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`),
  ADD CONSTRAINT `prerequisites_ibfk_2` FOREIGN KEY (`prereq_id`) REFERENCES `course` (`course_id`);

--
-- Constraints for table `registration`
--
ALTER TABLE `registration`
  ADD CONSTRAINT `registration_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`),
  ADD CONSTRAINT `registration_ibfk_2` FOREIGN KEY (`crn`) REFERENCES `section` (`crn`);

--
-- Constraints for table `research`
--
ALTER TABLE `research`
  ADD CONSTRAINT `research_ibfk_1` FOREIGN KEY (`research_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`building_id`) REFERENCES `building` (`building_id`);

--
-- Constraints for table `section`
--
ALTER TABLE `section`
  ADD CONSTRAINT `section_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`),
  ADD CONSTRAINT `section_ibfk_3` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`),
  ADD CONSTRAINT `section_ibfk_4` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`semester_id`),
  ADD CONSTRAINT `section_ibfk_5` FOREIGN KEY (`timeslot_id`) REFERENCES `timeslot` (`timeslot_id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_advisor`
--
ALTER TABLE `student_advisor`
  ADD CONSTRAINT `student_advisor_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`faculty_id`),
  ADD CONSTRAINT `student_advisor_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`);

--
-- Constraints for table `student_hold`
--
ALTER TABLE `student_hold`
  ADD CONSTRAINT `student_hold_ibfk_1` FOREIGN KEY (`hold_id`) REFERENCES `hold` (`hold_id`),
  ADD CONSTRAINT `student_hold_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`);

--
-- Constraints for table `student_major`
--
ALTER TABLE `student_major`
  ADD CONSTRAINT `student_major_ibfk_1` FOREIGN KEY (`major_id`) REFERENCES `major` (`major_id`),
  ADD CONSTRAINT `student_major_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`);

--
-- Constraints for table `student_minor`
--
ALTER TABLE `student_minor`
  ADD CONSTRAINT `student_minor_ibfk_1` FOREIGN KEY (`minor_id`) REFERENCES `minor` (`minor_id`),
  ADD CONSTRAINT `student_minor_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`);

--
-- Constraints for table `teaching`
--
ALTER TABLE `teaching`
  ADD CONSTRAINT `teaching_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`faculty_id`),
  ADD CONSTRAINT `teaching_ibfk_2` FOREIGN KEY (`crn`) REFERENCES `section` (`crn`);

--
-- Constraints for table `timeslot`
--
ALTER TABLE `timeslot`
  ADD CONSTRAINT `timeslot_ibfk_1` FOREIGN KEY (`day_id`) REFERENCES `day` (`day_id`),
  ADD CONSTRAINT `timeslot_ibfk_2` FOREIGN KEY (`period_id`) REFERENCES `period` (`period_id`);

--
-- Constraints for table `transcript`
--
ALTER TABLE `transcript`
  ADD CONSTRAINT `transcript_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`),
  ADD CONSTRAINT `transcript_ibfk_2` FOREIGN KEY (`crn`) REFERENCES `section` (`crn`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
