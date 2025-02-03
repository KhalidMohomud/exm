-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2025 at 06:33 AM
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
-- Database: `examination`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `allresult` (IN `_student_id` VARCHAR(10) CHARSET utf8, IN `_semester_id` INT)   BEGIN
  
  SELECT 
    sub.subject_name AS `Subject Name`,
    CONCAT(COALESCE(er.midterm, 0), ' (30)') AS `Midterm`,
    CONCAT(COALESCE(er.coursework, 0), ' (10)') AS `CourseWork`,
    CONCAT(COALESCE(er.final, 0), ' (60)') AS `Final`,
    CONCAT(COALESCE(er.reexam, 0), ' (69)') AS `ReExam`,
    (COALESCE(er.midterm, 0) + 
     COALESCE(er.coursework, 0) + 
     COALESCE(er.final, 0) + 
     COALESCE(er.reexam, 0)) AS `Total`,
    CASE 
        WHEN (COALESCE(er.midterm, 0) + 
              COALESCE(er.coursework, 0) + 
              COALESCE(er.final, 0) + 
              COALESCE(er.reexam, 0)) >= 90 THEN 'A+'
        WHEN (COALESCE(er.midterm, 0) + 
              COALESCE(er.coursework, 0) + 
              COALESCE(er.final, 0) + 
              COALESCE(er.reexam, 0)) >= 80 THEN 'B'
        WHEN (COALESCE(er.midterm, 0) + 
              COALESCE(er.coursework, 0) + 
              COALESCE(er.final, 0) + 
              COALESCE(er.reexam, 0)) >= 70 THEN 'C'
        WHEN (COALESCE(er.midterm, 0) + 
              COALESCE(er.coursework, 0) + 
              COALESCE(er.final, 0) + 
              COALESCE(er.reexam, 0)) >= 60 THEN 'D'
        WHEN (COALESCE(er.midterm, 0) + 
              COALESCE(er.coursework, 0) + 
              COALESCE(er.final, 0) + 
              COALESCE(er.reexam, 0)) >= 50 THEN 'E'
        ELSE 'F'
    END AS `Grade`
    
FROM 
    Exam_Results er
LEFT JOIN 
    Subjects sub 
    ON er.subject_id = sub.subject_id
LEFT JOIN 
    semester_subject sb 
    ON sub.subject_id = sb.subject_id
LEFT JOIN 
    students s 
    ON er.student_id = s.student_id
WHERE 
    s.student_id = _student_id
     OR (_semester_id IS NULL OR sb.semester_id = _semester_id)
   
ORDER BY 
    s.first_name, sub.subject_name;
    
    
   SELECT 
    SUM(er.total_marks) AS Total  
FROM 
    exam_results er
JOIN 
    Subjects sub ON er.subject_id = sub.subject_id
JOIN 
    students s ON s.student_id = er.student_id
JOIN 
    semester_subject sb ON sub.subject_id = sb.subject_id
WHERE    
    s.student_id = _student_id
    AND (_semester_id IS NULL OR sb.semester_id = _semester_id);

   

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `login` (IN `_user_name` VARCHAR(10), IN `_password` VARCHAR(10))   BEGIN

IF EXISTS (SELECT * FROM users WHERE users.user_name = _user_name AND
           users.password = _password) THEN
  
  IF EXISTS (SELECT* FROM users WHERE users.user_name = _user_name AND
             users.status = 'active')THEN
  
  SELECT * FROM users WHERE users.user_name = _user_name;
  
  ELSE
 
  SELECT 'locked' msg;
  
  END IF;
  ELSE
  
  SELECT 'deny'msg;
  END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_login` (IN `studentCode` VARCHAR(20), IN `_password` VARCHAR(20))   BEGIN


IF EXISTS (SELECT * FROM students WHERE students.student_code = studentCode AND
           students.password = _password) THEN  
       
         
       
        SELECT 
            s.student_code,
            s.first_name,
            c.class_name,
            d.department_name
           
        FROM 
            students s
        JOIN 
            departments d ON s.department_id = d.department_id
        JOIN 
            class c ON c.class_id = s.class_id
        WHERE  
            s.student_code = studentCode
            AND s.password = _password;
  
   
  ELSE
  
  SELECT 'deny'msg;
  END IF;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Result` (IN `studentCode` VARCHAR(20), IN `_password` VARCHAR(20) CHARSET utf8)   BEGIN


SELECT 
        s.first_name AS "Student Name",
        s.last_name AS "Last Name",
        c.class_name as "Class Name",
        
        d.department_name AS "Department"
    
    FROM 
        Students s
    JOIN 
        Departments d 
    ON 
        s.department_id = d.department_id
          JOIN  class c ON  c.class_id = s.class_id
       #JOIN semester_subject sb ON  sb.department_id = d.department_id
    WHERE  
     s.password = _password  AND
        s.student_id = studentCode;

     
       SELECT 
        sub.subject_name AS "Subject Name",
        CONCAT(COALESCE(er.midterm, 0), ' (30)') AS "Midterm",
        CONCAT(COALESCE(er.coursework, 0), ' (10)') AS "CourseWork",
        CONCAT(COALESCE(er.final, 0), ' (60)') AS "Final",
        CONCAT(COALESCE(er.reexam, 0), ' (69)') AS "ReExam",
        (COALESCE(er.midterm, 0) + 
         COALESCE(er.coursework, 0) + 
         COALESCE(er.final, 0) + 
         COALESCE(er.reexam, 0)) AS "Total",
        CASE 
            WHEN (COALESCE(er.midterm, 0) + 
                  COALESCE(er.coursework, 0) + 
                  COALESCE(er.final, 0) + 
                  COALESCE(er.reexam, 0)) >= 90 THEN 'A+'
            WHEN (COALESCE(er.midterm, 0) + 
                  COALESCE(er.coursework, 0) + 
                  COALESCE(er.final, 0) + 
                  COALESCE(er.reexam, 0)) >= 80 THEN 'B'
            WHEN (COALESCE(er.midterm, 0) + 
                  COALESCE(er.coursework, 0) + 
                  COALESCE(er.final, 0) + 
                  COALESCE(er.reexam, 0)) >= 70 THEN 'C'
            WHEN (COALESCE(er.midterm, 0) + 
                  COALESCE(er.coursework, 0) + 
                  COALESCE(er.final, 0) + 
                  COALESCE(er.reexam, 0)) >= 60 THEN 'D'
            WHEN (COALESCE(er.midterm, 0) + 
                  COALESCE(er.coursework, 0) + 
                  COALESCE(er.final, 0) + 
                  COALESCE(er.reexam, 0)) >= 50 THEN 'E'
            ELSE 'F'
        END AS "Grade"
    FROM 
        Exam_Results er
    JOIN 
        Subjects sub ON er.subject_id = sub.subject_id
       JOIN  students s ON   s.student_id = er.student_id
    WHERE 
        s.student_code = studentCode 
        AND s.password = _password 
           
        
    ORDER BY 
         sub.subject_name;

SELECT   SUM(total_marks) as Total  from exam_results er JOIN 
        Subjects sub ON er.subject_id = sub.subject_id
       JOIN  students s ON   s.student_id = er.student_id
    WHERE 
        er.student_id = studentCode
        AND s.password = _password;
        



END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `view_result` (IN `studentCode` VARCHAR(20) CHARSET utf8, IN `_semester_id` VARCHAR(20) CHARSET utf8)   BEGIN



       
       SELECT 
        sub.subject_name AS "Subject Name",
        CONCAT(COALESCE(er.midterm, 0), ' (30)') AS "Midterm",
        CONCAT(COALESCE(er.coursework, 0), ' (10)') AS "CourseWork",
        CONCAT(COALESCE(er.final, 0), ' (60)') AS "Final",
        CONCAT(COALESCE(er.reexam, 0), ' (69)') AS "ReExam",
        (COALESCE(er.midterm, 0) + 
         COALESCE(er.coursework, 0) + 
         COALESCE(er.final, 0) + 
         COALESCE(er.reexam, 0)) AS "Total",
        CASE 
            WHEN (COALESCE(er.midterm, 0) + 
                  COALESCE(er.coursework, 0) + 
                  COALESCE(er.final, 0) + 
                  COALESCE(er.reexam, 0)) >= 90 THEN 'A+'
            WHEN (COALESCE(er.midterm, 0) + 
                  COALESCE(er.coursework, 0) + 
                  COALESCE(er.final, 0) + 
                  COALESCE(er.reexam, 0)) >= 80 THEN 'B'
            WHEN (COALESCE(er.midterm, 0) + 
                  COALESCE(er.coursework, 0) + 
                  COALESCE(er.final, 0) + 
                  COALESCE(er.reexam, 0)) >= 70 THEN 'C'
            WHEN (COALESCE(er.midterm, 0) + 
                  COALESCE(er.coursework, 0) + 
                  COALESCE(er.final, 0) + 
                  COALESCE(er.reexam, 0)) >= 60 THEN 'D'
            WHEN (COALESCE(er.midterm, 0) + 
                  COALESCE(er.coursework, 0) + 
                  COALESCE(er.final, 0) + 
                  COALESCE(er.reexam, 0)) >= 50 THEN 'E'
            ELSE 'F'
        END AS "Grade"
    FROM 
        Exam_Results er
    LEFT JOIN 
        Subjects sub ON er.subject_id = sub.subject_id
       LEFT JOIN  students s ON   s.student_id = er.student_id
       LEFT JOIN semester_subject sb ON sb.subject_id= sub.subject_id
    WHERE 
        s.student_code = studentCode 
        AND sb.semester_id = _semester_id
           
        
    ORDER BY 
         sub.subject_name;


        



END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `class_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `class_name` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_id`, `department_id`, `class_name`, `date`) VALUES
(56, 3, 'BIT1', '2024-12-30 14:01:41'),
(57, 3, 'BIT2', '2024-12-30 14:01:49'),
(58, 3, 'BIT3', '2024-12-30 14:01:55'),
(59, 3, 'BIT4', '2024-12-30 14:02:00'),
(60, 3, 'BIT5', '2024-12-30 14:02:05'),
(61, 2, 'BSE1', '2024-12-30 14:02:15'),
(62, 2, 'BSE2', '2024-12-30 14:02:19'),
(63, 2, 'BSE3', '2024-12-30 14:02:31'),
(64, 1, 'BCS1', '2024-12-30 14:02:46'),
(65, 1, 'BCS2', '2024-12-30 14:03:01'),
(66, 43, 'DB1', '2024-12-31 13:24:43'),
(67, 2, 'BSE5', '2025-01-28 19:50:40');

-- --------------------------------------------------------

--
-- Table structure for table `class_semester`
--

CREATE TABLE `class_semester` (
  `class_semester_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_semester`
--

INSERT INTO `class_semester` (`class_semester_id`, `semester_id`, `class_id`) VALUES
(48, 1, 56),
(49, 1, 66),
(50, 5, 62),
(51, 1, 61),
(52, 2, 61),
(53, 3, 61),
(54, 4, 61),
(55, 5, 61),
(56, 6, 61),
(57, 7, 61),
(58, 8, 61),
(59, 26, 61),
(60, 1, 67);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `course_name` varchar(100) NOT NULL,
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department_name`, `date`) VALUES
(1, 'Computer Science', '2024-11-29 13:34:33'),
(2, 'Software Engineerings', '2024-12-11 15:50:06'),
(3, 'IT', '2024-11-25 18:30:10'),
(43, 'Date', '2025-01-28 19:27:48');

-- --------------------------------------------------------

--
-- Table structure for table `exam_results`
--

CREATE TABLE `exam_results` (
  `result_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `midterm` int(11) DEFAULT 0,
  `coursework` int(11) DEFAULT 0,
  `final` int(11) DEFAULT 0,
  `reexam` int(11) DEFAULT 0,
  `total_marks` int(11) GENERATED ALWAYS AS (`midterm` + `coursework` + `final` + `reexam`) STORED,
  `grade` varchar(2) GENERATED ALWAYS AS (case when `midterm` + `coursework` + `final` + `reexam` >= 90 then 'A+' when `midterm` + `coursework` + `final` + `reexam` >= 80 then 'B' when `midterm` + `coursework` + `final` + `reexam` >= 70 then 'C' when `midterm` + `coursework` + `final` + `reexam` >= 60 then 'D' when `midterm` + `coursework` + `final` + `reexam` >= 50 then 'E' else 'F' end) STORED,
  `subject_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam_results`
--

INSERT INTO `exam_results` (`result_id`, `student_id`, `midterm`, `coursework`, `final`, `reexam`, `subject_id`) VALUES
(674, 28, 25, 10, 56, 0, 8),
(675, 29, 25, 10, 56, 0, 8),
(676, 30, 25, 10, 56, 0, 8),
(677, 31, 25, 10, 56, 0, 8),
(678, 32, 25, 10, 56, 0, 8),
(679, 33, 25, 10, 56, 0, 8),
(680, 37, 25, 10, 56, 0, 8),
(681, 28, 25, 10, 56, 0, 45),
(682, 29, 25, 10, 56, 0, 45),
(683, 30, 25, 10, 56, 0, 45),
(684, 31, 25, 10, 56, 0, 45),
(685, 32, 25, 10, 56, 0, 45),
(686, 33, 25, 10, 56, 0, 45),
(687, 37, 25, 10, 56, 0, 45),
(688, 28, 25, 10, 26, 0, 47),
(689, 29, 25, 10, 56, 0, 47),
(690, 30, 25, 10, 56, 0, 47),
(691, 31, 25, 10, 56, 0, 47),
(692, 32, 25, 10, 56, 0, 47),
(693, 33, 25, 10, 56, 0, 47),
(694, 37, 25, 10, 56, 0, 47);

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `faculty_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `department_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`faculty_id`, `name`, `department_id`) VALUES
(1, 'stw', 1),
(2, 'Dts', 2),
(73, 'software enginering', 1),
(75, 'stw', 3),
(87, 'Dts', 3),
(88, 'BT2', 3),
(89, 'a', 43);

-- --------------------------------------------------------

--
-- Table structure for table `faculty_subjects`
--

CREATE TABLE `faculty_subjects` (
  `faculty_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `foreign_key_mappings`
--

CREATE TABLE `foreign_key_mappings` (
  `id` int(11) NOT NULL,
  `table_name` varchar(100) NOT NULL,
  `column_name` varchar(100) NOT NULL,
  `referenced_table` varchar(100) NOT NULL,
  `reference_column` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `foreign_key_mappings`
--

INSERT INTO `foreign_key_mappings` (`id`, `table_name`, `column_name`, `referenced_table`, `reference_column`) VALUES
(1, 'exam_results', 'student_id', 'students', 'first_name'),
(2, 'exam_results', 'subject_id', 'subjects', 'subject_name'),
(4, 'exam_results', 'student_id', 'students', 'student_code');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `semester_id` int(11) NOT NULL,
  `semester_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`semester_id`, `semester_name`) VALUES
(1, 'semesters1'),
(2, 'semester2'),
(3, 'semester3'),
(4, 'semester4'),
(5, 'semester5'),
(6, 'semester6'),
(7, 'semester7'),
(8, 'semester8'),
(26, 'semester 9');

-- --------------------------------------------------------

--
-- Table structure for table `semester_student`
--

CREATE TABLE `semester_student` (
  `semester_student_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `semester_subject`
--

CREATE TABLE `semester_subject` (
  `subject_semester_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semester_subject`
--

INSERT INTO `semester_subject` (`subject_semester_id`, `subject_id`, `semester_id`, `class_id`) VALUES
(47, 47, 1, 56),
(48, 45, 5, 62),
(49, 46, 1, 57),
(50, 45, 5, 61),
(51, 56, 1, 61),
(52, 49, 2, 61),
(53, 7, 3, 61),
(54, 12, 3, 61),
(55, 48, 4, 61),
(56, 44, 5, 61),
(57, 41, 5, 61),
(58, 43, 5, 61),
(59, 11, 2, 61),
(60, 56, 2, 61),
(61, 8, 2, 61),
(62, 57, 2, 61),
(63, 12, 1, 67);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `student_code` varchar(100) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `Gender` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact_number` varchar(15) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `image` varchar(20) NOT NULL,
  `password` varchar(20) DEFAULT '123'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `student_code`, `first_name`, `last_name`, `Gender`, `email`, `contact_number`, `department_id`, `class_id`, `date_of_birth`, `image`, `password`) VALUES
(28, 'HR0001', 'khalid', 'mohomud', 'Male', 'khm@gmail.com', '252619006007', 2, 61, '2014-06-20', '6772a898a7230.png', '123'),
(29, 'HR0002', 'Abiweli', 'Ali', 'Male', 'abdu@example.com', '2526189309', 2, 61, '2024-12-04', '6772a8e87d712.png', '123'),
(30, 'HR0003', 'Abdifitaax', 'Ciise', 'Male', 'abd@example.com', '25289584', 2, 61, '2005-03-16', '6772a932cb159.png', '123'),
(31, 'HR0004', 'Jaabir', 'm', 'Male', 'jaabir@gmail.com', '25278439', 2, 61, '2006-06-07', '6772aa086c06f.png', '123'),
(32, 'HR0005', 'ayaan xuseen', 'abdi', 'Female', 'ayann@gmail.com', '7783', 1, 64, '2024-12-03', '6772aa4302890.png', '123'),
(33, 'HR0006', 'ayuub', 'abdi', 'Male', 'ayuub@gmail.com', '3275748943', 2, 61, '2024-12-26', '6772aa83cc4f7.png', '123'),
(34, 'HR0007', 'xasan', 'ali', 'Male', 'a@gmail.com', '67393', 3, 56, '0000-00-00', '6773edec0d906.png', '123'),
(35, 'HR0008', 'xuseen', 'xasan', 'Male', 'xasan@gmail.com', '2526189493', 2, 61, '2024-12-25', '6773f05484e86.png', '123'),
(36, 'HR0009', 'abdisamad', 'a', 'Male', 'abdisa@gmail.com', '437829', 2, 61, '2025-01-24', '6779f243a5146.png', '123'),
(37, 'HR0010', 'abdi', 'xasan', 'Male', 'd@gmail.com', '78457845', 2, 61, '2025-01-02', '6782acce1d2e5.png', '123'),
(38, 'HR0011', 'abdi mohomes', 'xasan', 'Male', 'abdi3@gmail.com', '34245', 2, 61, '2017-02-01', '67992d8984242.png', '123'),
(39, 'HR0012', 'xaliimo', 'abdi', 'Female', 'xaliimo@gmail.com', '6153984', 3, 56, '2025-06-05', '67992ff3a19b5.png', '123'),
(40, 'HR0013', 'faarah', 'abdi', 'Male', 'far@gmail.com', '647839843', 2, 67, '2024-12-05', '679935c66f34d.png', '123');

-- --------------------------------------------------------

--
-- Table structure for table `student_courses`
--

CREATE TABLE `student_courses` (
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `student_results_view`
-- (See below for the actual view)
--
CREATE TABLE `student_results_view` (
`Subject Name` varchar(100)
,`Midterm` varchar(16)
,`CourseWork` varchar(16)
,`Final` varchar(16)
,`ReExam` varchar(16)
,`Total` bigint(14)
,`Grade` varchar(2)
);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject_name`) VALUES
(7, 'Data Structures'),
(8, 'C'),
(9, 'math'),
(10, 'accounting'),
(11, 'caaqiido'),
(12, 'sql'),
(41, 'SAD'),
(42, 'php'),
(43, 'safware req'),
(44, 'Linux'),
(45, 'os'),
(46, 'c_computer'),
(47, 'java'),
(48, 'sofware engineering'),
(49, 'statistics'),
(50, 'English'),
(51, 'oop phyton'),
(52, 'computer engineering'),
(55, 'Instruction computer application '),
(56, 'English'),
(57, 'Arabic'),
(58, 'PLD'),
(60, 'C++'),
(61, 'Enlish11'),
(62, 'HTML CSS'),
(63, 'sql server'),
(64, 'Arabic11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `Type` enum('Admin','user','exam') NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Active',
  `image` varchar(20) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `password`, `Type`, `status`, `image`, `Date`) VALUES
(2, 'Abdi', '123', 'user', 'Active', 'Abdi.png', '2025-01-09 13:51:38'),
(4, 'xuseen', '123', 'exam', 'Active', '', '2025-01-09 14:05:42'),
(6, 'Qalid', '123', 'Admin', 'Active', 'Qalid.png', '2025-01-28 15:58:12'),
(8, 'khalid', '12', 'user', 'Active', 'khalid.png', '2025-01-28 16:31:12');

-- --------------------------------------------------------

--
-- Structure for view `student_results_view`
--
DROP TABLE IF EXISTS `student_results_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `student_results_view`  AS SELECT `sub`.`subject_name` AS `Subject Name`, concat(coalesce(`er`.`midterm`,0),' (30)') AS `Midterm`, concat(coalesce(`er`.`coursework`,0),' (10)') AS `CourseWork`, concat(coalesce(`er`.`final`,0),' (60)') AS `Final`, concat(coalesce(`er`.`reexam`,0),' (69)') AS `ReExam`, coalesce(`er`.`midterm`,0) + coalesce(`er`.`coursework`,0) + coalesce(`er`.`final`,0) + coalesce(`er`.`reexam`,0) AS `Total`, CASE WHEN coalesce(`er`.`midterm`,0) + coalesce(`er`.`coursework`,0) + coalesce(`er`.`final`,0) + coalesce(`er`.`reexam`,0) >= 90 THEN 'A+' WHEN coalesce(`er`.`midterm`,0) + coalesce(`er`.`coursework`,0) + coalesce(`er`.`final`,0) + coalesce(`er`.`reexam`,0) >= 80 THEN 'B' WHEN coalesce(`er`.`midterm`,0) + coalesce(`er`.`coursework`,0) + coalesce(`er`.`final`,0) + coalesce(`er`.`reexam`,0) >= 70 THEN 'C' WHEN coalesce(`er`.`midterm`,0) + coalesce(`er`.`coursework`,0) + coalesce(`er`.`final`,0) + coalesce(`er`.`reexam`,0) >= 60 THEN 'D' WHEN coalesce(`er`.`midterm`,0) + coalesce(`er`.`coursework`,0) + coalesce(`er`.`final`,0) + coalesce(`er`.`reexam`,0) >= 50 THEN 'E' ELSE 'F' END AS `Grade` FROM (((`exam_results` `er` left join `subjects` `sub` on(`er`.`subject_id` = `sub`.`subject_id`)) left join `semester_subject` `sb` on(`sub`.`subject_id` = `sb`.`subject_id`)) left join `students` `s` on(`er`.`student_id` = `s`.`student_id`)) ORDER BY `s`.`first_name` ASC, `sub`.`subject_name` ASC ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`class_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `class_semester`
--
ALTER TABLE `class_semester`
  ADD PRIMARY KEY (`class_semester_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `semester_id` (`semester_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `fr_d` (`department_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `exam_results`
--
ALTER TABLE `exam_results`
  ADD PRIMARY KEY (`result_id`),
  ADD KEY `fk_subject_id` (`subject_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`faculty_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `faculty_subjects`
--
ALTER TABLE `faculty_subjects`
  ADD PRIMARY KEY (`faculty_id`,`subject_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `foreign_key_mappings`
--
ALTER TABLE `foreign_key_mappings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`semester_id`);

--
-- Indexes for table `semester_student`
--
ALTER TABLE `semester_student`
  ADD PRIMARY KEY (`semester_student_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `semester_id` (`semester_id`);

--
-- Indexes for table `semester_subject`
--
ALTER TABLE `semester_subject`
  ADD PRIMARY KEY (`subject_semester_id`),
  ADD KEY `semester_id` (`semester_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `class_id_fk` (`class_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `student_courses`
--
ALTER TABLE `student_courses`
  ADD PRIMARY KEY (`student_id`,`course_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `class_semester`
--
ALTER TABLE `class_semester`
  MODIFY `class_semester_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `exam_results`
--
ALTER TABLE `exam_results`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=695;

--
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `faculty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `foreign_key_mappings`
--
ALTER TABLE `foreign_key_mappings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `semester_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `semester_student`
--
ALTER TABLE `semester_student`
  MODIFY `semester_student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `semester_subject`
--
ALTER TABLE `semester_subject`
  MODIFY `subject_semester_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `class_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`);

--
-- Constraints for table `class_semester`
--
ALTER TABLE `class_semester`
  ADD CONSTRAINT `class_semester_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`),
  ADD CONSTRAINT `class_semester_ibfk_2` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`semester_id`);

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `fr_d` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`);

--
-- Constraints for table `exam_results`
--
ALTER TABLE `exam_results`
  ADD CONSTRAINT `exam_results_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`),
  ADD CONSTRAINT `fk_subject_id` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`);

--
-- Constraints for table `faculties`
--
ALTER TABLE `faculties`
  ADD CONSTRAINT `faculties_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`);

--
-- Constraints for table `faculty_subjects`
--
ALTER TABLE `faculty_subjects`
  ADD CONSTRAINT `faculty_subjects_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`faculty_id`),
  ADD CONSTRAINT `faculty_subjects_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`);

--
-- Constraints for table `semester_student`
--
ALTER TABLE `semester_student`
  ADD CONSTRAINT `semester_student_ibfk_2` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`semester_id`);

--
-- Constraints for table `semester_subject`
--
ALTER TABLE `semester_subject`
  ADD CONSTRAINT `class_id_fk` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`),
  ADD CONSTRAINT `semester_subject_ibfk_1` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`semester_id`),
  ADD CONSTRAINT `semester_subject_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`),
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`);

--
-- Constraints for table `student_courses`
--
ALTER TABLE `student_courses`
  ADD CONSTRAINT `student_courses_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`),
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
