-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 03, 2017 at 08:36 PM
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
CREATE TABLE `administrator` (
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`admin_id`) VALUES
(1),
(174);

-- --------------------------------------------------------

--
-- Table structure for table `building`
--

DROP TABLE IF EXISTS `building`;
CREATE TABLE `building` (
  `building_id` int(11) NOT NULL,
  `building_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `building`
--

INSERT INTO `building` (`building_id`, `building_name`) VALUES
(1, ''),
(2, 'New Academic Building');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `course_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `course_category` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `course_description` mediumtext COLLATE utf8_unicode_ci,
  `credits` int(11) NOT NULL,
  `is_archived` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `dept_id`, `course_name`, `course_category`, `course_description`, `credits`, `is_archived`) VALUES
(1, 2, 'System Design', 'Required', 'Students will learn and implement all system requirements to produce a completely finished product.', 4, 0),
(4, 2, 'Women in Computer Science', '', 'Study the impact of women in computer science.', 4, 0),
(5, 2, 'Test Course Update', 'General Education', 'Test 4/1', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `day`
--

DROP TABLE IF EXISTS `day`;
CREATE TABLE `day` (
  `day_id` int(11) NOT NULL,
  `day` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `day`
--

INSERT INTO `day` (`day_id`, `day`) VALUES
(1, 'Monday'),
(2, 'Tuesday'),
(3, 'Wednesday'),
(4, 'Thursday'),
(5, 'Friday'),
(6, 'Saturday'),
(7, 'Sunday');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE `department` (
  `dept_id` int(11) NOT NULL,
  `dept_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `chair_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `dept_name`, `chair_id`) VALUES
(2, 'Computer Science', 5);

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

DROP TABLE IF EXISTS `enrollment`;
CREATE TABLE `enrollment` (
  `student_id` int(11) NOT NULL,
  `crn` int(11) NOT NULL,
  `enroll_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

DROP TABLE IF EXISTS `faculty`;
CREATE TABLE `faculty` (
  `faculty_id` int(11) NOT NULL,
  `rank` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `faculty_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`faculty_id`, `rank`, `faculty_type`) VALUES
(5, 'Chair', 'Chair'),
(170, NULL, 'part_time');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_department`
--

DROP TABLE IF EXISTS `faculty_department`;
CREATE TABLE `faculty_department` (
  `faculty_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faculty_full_time`
--

DROP TABLE IF EXISTS `faculty_full_time`;
CREATE TABLE `faculty_full_time` (
  `faculty_id` int(11) NOT NULL,
  `yearly_salary` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `faculty_full_time`
--

INSERT INTO `faculty_full_time` (`faculty_id`, `yearly_salary`) VALUES
(5, 100000);

-- --------------------------------------------------------

--
-- Table structure for table `faculty_part_time`
--

DROP TABLE IF EXISTS `faculty_part_time`;
CREATE TABLE `faculty_part_time` (
  `faculty_id` int(11) NOT NULL,
  `hourly_rate` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `faculty_part_time`
--

INSERT INTO `faculty_part_time` (`faculty_id`, `hourly_rate`) VALUES
(170, 40);

-- --------------------------------------------------------

--
-- Table structure for table `hold`
--

DROP TABLE IF EXISTS `hold`;
CREATE TABLE `hold` (
  `hold_id` int(11) NOT NULL,
  `hold_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `hold_desc` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `major`
--

DROP TABLE IF EXISTS `major`;
CREATE TABLE `major` (
  `major_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `major_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `major_category` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `major_courses`
--

DROP TABLE IF EXISTS `major_courses`;
CREATE TABLE `major_courses` (
  `major_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meeting`
--

DROP TABLE IF EXISTS `meeting`;
CREATE TABLE `meeting` (
  `student_id` int(11) NOT NULL,
  `crn` int(11) NOT NULL,
  `date` date NOT NULL,
  `attendance` enum('A','P') COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `minor`
--

DROP TABLE IF EXISTS `minor`;
CREATE TABLE `minor` (
  `minor_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `minor_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `minor_category` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `period`
--

DROP TABLE IF EXISTS `period`;
CREATE TABLE `period` (
  `period_id` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `period`
--

INSERT INTO `period` (`period_id`, `start_time`, `end_time`) VALUES
(1, '08:30:00', '10:00:00'),
(2, '08:30:00', '10:00:00'),
(3, '10:30:00', '12:00:00'),
(4, '12:30:00', '14:00:00'),
(5, '14:30:00', '16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `prerequisites`
--

DROP TABLE IF EXISTS `prerequisites`;
CREATE TABLE `prerequisites` (
  `course_id` int(11) NOT NULL,
  `prereq_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `prerequisites`
--

INSERT INTO `prerequisites` (`course_id`, `prereq_id`) VALUES
(1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

DROP TABLE IF EXISTS `registration`;
CREATE TABLE `registration` (
  `student_id` int(11) NOT NULL,
  `crn` int(11) NOT NULL,
  `reg_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `research`
--

DROP TABLE IF EXISTS `research`;
CREATE TABLE `research` (
  `research_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `research`
--

INSERT INTO `research` (`research_id`) VALUES
(4);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

DROP TABLE IF EXISTS `room`;
CREATE TABLE `room` (
  `room_id` int(11) NOT NULL,
  `building_id` int(11) NOT NULL,
  `room_num` int(11) NOT NULL,
  `room_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `capacity` int(11) NOT NULL,
  `num_of_computers` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

DROP TABLE IF EXISTS `school`;
CREATE TABLE `school` (
  `school_id` int(11) NOT NULL,
  `school_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dean_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

DROP TABLE IF EXISTS `section`;
CREATE TABLE `section` (
  `crn` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `faculty_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `semester_id` int(11) NOT NULL,
  `timeslot_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

DROP TABLE IF EXISTS `semester`;
CREATE TABLE `semester` (
  `semester_id` int(11) NOT NULL,
  `sem_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sem_year` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sem_start_date` date NOT NULL,
  `sem_end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`semester_id`, `sem_name`, `sem_year`, `sem_start_date`, `sem_end_date`) VALUES
(1, '', '', '0000-00-00', '0000-00-00'),
(2, 'Fall 2017', '2017', '2017-08-28', '2017-12-22');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `gpa` int(11) NOT NULL,
  `student_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL
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
(155, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `student_advisor`
--

DROP TABLE IF EXISTS `student_advisor`;
CREATE TABLE `student_advisor` (
  `faculty_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `date_assigned` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_hold`
--

DROP TABLE IF EXISTS `student_hold`;
CREATE TABLE `student_hold` (
  `hold_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `hold_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_major`
--

DROP TABLE IF EXISTS `student_major`;
CREATE TABLE `student_major` (
  `major_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_minor`
--

DROP TABLE IF EXISTS `student_minor`;
CREATE TABLE `student_minor` (
  `minor_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teaching`
--

DROP TABLE IF EXISTS `teaching`;
CREATE TABLE `teaching` (
  `faculty_id` int(11) NOT NULL,
  `crn` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `timeslot`
--

DROP TABLE IF EXISTS `timeslot`;
CREATE TABLE `timeslot` (
  `timeslot_id` int(11) NOT NULL,
  `day_id` int(11) NOT NULL,
  `period_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transcript`
--

DROP TABLE IF EXISTS `transcript`;
CREATE TABLE `transcript` (
  `student_id` int(11) NOT NULL,
  `crn` int(11) NOT NULL,
  `grade` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `semester_id` int(11) DEFAULT NULL,
  `faculty_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tel_num` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_type` enum('F','S','A','R') COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `date_of_birth`, `email`, `tel_num`, `user_type`, `username`, `password`) VALUES
(1, 'admin', 'admin', '0000-00-00', 'admin@gupta.edu', '516', 'A', 'admin@gupta.edu', 'admin'),
(3, 'Student', 'Test', '2017-03-08', 'student@gupta.edu', '1111111111', 'S', 'student@gupta.edu', 'student'),
(4, 'Research', 'Test', '2016-02-16', 'research@gupta.edu', '1113215489', 'R', 'research@gupta.edu', 'research'),
(5, 'faculty', 'test', '1971-12-02', 'faculty@gupta.edu', '17777777777', 'F', 'faculty@gupta.edu', 'faculty'),
(6, 'Timothy', 'Olson', '1996-10-26', 'tolson0@wordpress.org', '51-(991)503', 'S', 'tolson0@wordpress.org', 'X1dAAp'),
(7, 'Gregory', 'Jenkins', '1929-01-30', 'gjenkins1@mashable.com', '55-(583)370', 'S', 'gjenkins1@mashable.com', '7jp1ObrIoez'),
(8, 'Ralph', 'Robertson', '1975-04-24', 'rrobertson2@nymag.com', '351-(622)67', 'S', 'rrobertson2@nymag.com', 'NWdokBT4OGMP'),
(9, 'Cynthia', 'Foster', '1946-11-15', 'cfoster3@plala.or.jp', '389-(715)14', 'S', 'cfoster3@plala.or.jp', 'bheqdprOMl4'),
(10, 'Dorothy', 'Cox', '1992-12-15', 'dcox4@ihg.com', '93-(258)109', 'S', 'dcox4@ihg.com', 'LnnrwqEG'),
(11, 'Henry', 'Mills', '1920-04-22', 'hmills5@sohu.com', '33-(328)683', 'S', 'hmills5@sohu.com', 'QVqT1pDpz5'),
(12, 'Deborah', 'Arnold', '1955-02-13', 'darnold6@example.com', '46-(910)846', 'S', 'darnold6@example.com', 'nxfPO7gO0ECV'),
(13, 'Doris', 'Kelley', '1924-08-14', 'dkelley7@mozilla.com', '66-(456)264', 'S', 'dkelley7@mozilla.com', '32tZQ2w'),
(14, 'Sandra', 'Bennett', '1953-08-11', 'sbennett8@behance.net', '86-(325)533', 'S', 'sbennett8@behance.net', 'U3FfB7PiH'),
(15, 'Jean', 'Stone', '1965-12-25', 'jstone9@a8.net', '86-(201)790', 'S', 'jstone9@a8.net', 'RF5xVtOoJDo'),
(16, 'Brenda', 'Coleman', '1952-07-10', 'bcolemana@netlog.com', '372-(647)53', 'S', 'bcolemana@netlog.com', '6c4txvQNOsT'),
(17, 'Ruby', 'Coleman', '1941-04-15', 'rcolemanb@adobe.com', '27-(554)783', 'S', 'rcolemanb@adobe.com', 'xIsfei'),
(18, 'Nancy', 'Moore', '1946-07-25', 'nmoorec@wikia.com', '62-(963)645', 'S', 'nmoorec@wikia.com', 'cQXa6iFzvGw'),
(19, 'Sarah', 'Russell', '1981-01-05', 'srusselld@amazon.co.uk', '62-(566)179', 'S', 'srusselld@amazon.co.uk', '1hoGbGdnojLn'),
(20, 'Judith', 'Bell', '1920-01-24', 'jbelle@opensource.org', '62-(598)767', 'S', 'jbelle@opensource.org', 'eOTAcZU29'),
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
(174, 'Anas', 'Alvi', '1993-05-19', 'anas_593@hotmail.com', '631-555-4343', 'A', 'anas007', 'Anas007');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `building`
--
ALTER TABLE `building`
  ADD PRIMARY KEY (`building_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `dept_id` (`dept_id`);

--
-- Indexes for table `day`
--
ALTER TABLE `day`
  ADD PRIMARY KEY (`day_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_id`),
  ADD KEY `chair_id` (`chair_id`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`student_id`,`crn`),
  ADD KEY `crn` (`crn`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`faculty_id`);

--
-- Indexes for table `faculty_department`
--
ALTER TABLE `faculty_department`
  ADD PRIMARY KEY (`faculty_id`,`dept_id`),
  ADD KEY `dept_id` (`dept_id`);

--
-- Indexes for table `faculty_full_time`
--
ALTER TABLE `faculty_full_time`
  ADD PRIMARY KEY (`faculty_id`);

--
-- Indexes for table `faculty_part_time`
--
ALTER TABLE `faculty_part_time`
  ADD PRIMARY KEY (`faculty_id`);

--
-- Indexes for table `hold`
--
ALTER TABLE `hold`
  ADD PRIMARY KEY (`hold_id`);

--
-- Indexes for table `major`
--
ALTER TABLE `major`
  ADD PRIMARY KEY (`major_id`),
  ADD KEY `dept_id` (`dept_id`);

--
-- Indexes for table `major_courses`
--
ALTER TABLE `major_courses`
  ADD PRIMARY KEY (`major_id`,`course_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `meeting`
--
ALTER TABLE `meeting`
  ADD PRIMARY KEY (`student_id`,`crn`,`date`),
  ADD KEY `crn` (`crn`);

--
-- Indexes for table `minor`
--
ALTER TABLE `minor`
  ADD PRIMARY KEY (`minor_id`),
  ADD KEY `dept_id` (`dept_id`);

--
-- Indexes for table `period`
--
ALTER TABLE `period`
  ADD PRIMARY KEY (`period_id`);

--
-- Indexes for table `prerequisites`
--
ALTER TABLE `prerequisites`
  ADD PRIMARY KEY (`course_id`,`prereq_id`),
  ADD KEY `prereq_id` (`prereq_id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`student_id`,`crn`),
  ADD KEY `crn` (`crn`);

--
-- Indexes for table `research`
--
ALTER TABLE `research`
  ADD PRIMARY KEY (`research_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `building_id` (`building_id`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`school_id`),
  ADD KEY `dean_id` (`dean_id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`crn`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `faculty_id` (`faculty_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `semester_id` (`semester_id`),
  ADD KEY `timeslot_id` (`timeslot_id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`semester_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `student_advisor`
--
ALTER TABLE `student_advisor`
  ADD PRIMARY KEY (`faculty_id`,`student_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `student_hold`
--
ALTER TABLE `student_hold`
  ADD PRIMARY KEY (`hold_id`,`student_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `student_major`
--
ALTER TABLE `student_major`
  ADD PRIMARY KEY (`major_id`,`student_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `student_minor`
--
ALTER TABLE `student_minor`
  ADD PRIMARY KEY (`minor_id`,`student_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `teaching`
--
ALTER TABLE `teaching`
  ADD PRIMARY KEY (`faculty_id`,`crn`),
  ADD KEY `crn` (`crn`);

--
-- Indexes for table `timeslot`
--
ALTER TABLE `timeslot`
  ADD PRIMARY KEY (`timeslot_id`),
  ADD KEY `day_id` (`day_id`),
  ADD KEY `period_id` (`period_id`);

--
-- Indexes for table `transcript`
--
ALTER TABLE `transcript`
  ADD PRIMARY KEY (`student_id`,`crn`),
  ADD KEY `crn` (`crn`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `building`
--
ALTER TABLE `building`
  MODIFY `building_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `day`
--
ALTER TABLE `day`
  MODIFY `day_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `hold`
--
ALTER TABLE `hold`
  MODIFY `hold_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `major`
--
ALTER TABLE `major`
  MODIFY `major_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `minor`
--
ALTER TABLE `minor`
  MODIFY `minor_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `period`
--
ALTER TABLE `period`
  MODIFY `period_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
  MODIFY `school_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `crn` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `semester_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `timeslot`
--
ALTER TABLE `timeslot`
  MODIFY `timeslot_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;
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
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`dept_id`) REFERENCES `department` (`dept_id`);

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `department_ibfk_1` FOREIGN KEY (`chair_id`) REFERENCES `faculty` (`faculty_id`);

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
  ADD CONSTRAINT `major_ibfk_1` FOREIGN KEY (`dept_id`) REFERENCES `department` (`dept_id`);

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
-- Constraints for table `minor`
--
ALTER TABLE `minor`
  ADD CONSTRAINT `minor_ibfk_1` FOREIGN KEY (`dept_id`) REFERENCES `department` (`dept_id`);

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
-- Constraints for table `school`
--
ALTER TABLE `school`
  ADD CONSTRAINT `school_ibfk_1` FOREIGN KEY (`dean_id`) REFERENCES `faculty` (`faculty_id`);

--
-- Constraints for table `section`
--
ALTER TABLE `section`
  ADD CONSTRAINT `section_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`),
  ADD CONSTRAINT `section_ibfk_2` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`faculty_id`),
  ADD CONSTRAINT `section_ibfk_3` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`),
  ADD CONSTRAINT `section_ibfk_4` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`semester_id`),
  ADD CONSTRAINT `section_ibfk_5` FOREIGN KEY (`timeslot_id`) REFERENCES `timeslot` (`timeslot_id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `user` (`user_id`);

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
