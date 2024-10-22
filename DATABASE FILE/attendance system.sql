-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2023 at 07:28 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `att_mgmt_sys`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(3) NOT NULL,
  `admin_name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendanceDate` date DEFAULT curdate(),
  `teacherID` int(11) DEFAULT NULL,
  `registrationNO` int(11) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL,
  `section` varchar(20) DEFAULT NULL,
  `attendance` varchar(50) DEFAULT 'absent',
  `bookName` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendanceDate`, `teacherID`, `registrationNO`, `semester`, `section`, `attendance`, `bookName`) VALUES
('2023-09-01', 1, 207, 1, 'computer', 'present', 'physics'),
('2023-09-02', 1, 207, 1, 'computer', 'present', 'physics'),
('2023-09-03', 1, 207, 1, 'computer', 'absent', 'physics'),
('2023-09-30', 1, 207, 1, 'computer', 'absent', 'physics'),
('2023-09-01', 1, 207, 1, 'computer', 'present', 'chemistry'),
('2023-09-02', 1, 207, 1, 'computer', 'absent', 'chemistry'),
('2023-09-01', 1, 207, 1, 'computer', 'present', 'C'),
('2023-09-02', 1, 207, 1, 'computer', 'present', 'C'),
('2023-08-01', 1, 207, 1, 'computer', 'present', 'physics'),
('2023-08-02', 1, 207, 1, 'computer', 'present', 'physics'),
('2023-08-03', 1, 207, 1, 'computer', 'absent', 'physics'),
('2023-08-04', 1, 207, 1, 'computer', 'present', 'physics'),
('2023-08-05', 1, 207, 1, 'computer', 'present', 'physics'),
('2023-08-06', 1, 207, 1, 'computer', 'absent', 'physics'),
('2023-08-07', 1, 207, 1, 'computer', 'present', 'physics'),
('2023-08-08', 1, 207, 1, 'computer', 'present', 'physics'),
('2023-08-09', 1, 207, 1, 'computer', 'absent', 'physics'),
('2023-08-10', 1, 207, 1, 'computer', 'absent', 'physics'),
('2023-09-01', 1, 208, 1, 'computer', 'present', 'physics'),
('2023-09-02', 1, 208, 1, 'computer', 'present', 'physics'),
('2023-09-03', 1, 208, 1, 'computer', 'absent', 'physics'),
('2023-09-30', 1, 208, 1, 'computer', 'absent', 'physics'),
('2023-09-01', 1, 208, 1, 'computer', 'present', 'chemistry'),
('2023-09-02', 1, 208, 1, 'computer', 'absent', 'chemistry'),
('2023-09-01', 1, 208, 1, 'computer', 'present', 'C'),
('2023-09-02', 1, 208, 1, 'computer', 'present', 'C'),
('2023-09-01', 1, 209, 1, 'computer', 'present', 'physics'),
('2023-09-02', 1, 209, 1, 'computer', 'present', 'physics'),
('2023-09-03', 1, 209, 1, 'computer', 'absent', 'physics'),
('2023-09-30', 1, 209, 1, 'computer', 'absent', 'physics'),
('2023-09-01', 1, 209, 1, 'computer', 'present', 'chemistry'),
('2023-09-02', 1, 209, 1, 'computer', 'absent', 'chemistry'),
('2023-09-01', 1, 208, 1, 'computer', 'present', 'C'),
('2023-09-02', 1, 208, 1, 'computer', 'present', 'C'),
('2023-09-22', 1, 207, 1, 'computer', 'present', 'Physics'),
('2023-09-22', 1, 208, 1, 'computer', 'present', 'Physics'),
('2023-09-22', 1, 209, 1, 'computer', 'absent', 'Physics'),
('2023-09-22', 1, 210, 1, 'computer', 'absent', 'Physics'),
('2023-09-22', 1, 207, 1, 'computer', 'absent', 'C'),
('2023-09-22', 1, 208, 1, 'computer', 'absent', 'C'),
('2023-09-22', 1, 209, 1, 'computer', 'present', 'C'),
('2023-09-22', 1, 210, 1, 'computer', 'present', 'C');

-- --------------------------------------------------------

--
-- Table structure for table `attendancepercentage`
--

CREATE TABLE `attendancepercentage` (
  `registration` varchar(25) DEFAULT NULL,
  `subject` varchar(300) DEFAULT NULL,
  `percentage` float DEFAULT 0,
  `teacherID` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendancepercentage`
--

INSERT INTO `attendancepercentage` (`registration`, `subject`, `percentage`, `teacherID`) VALUES
('207', 'Chemistry', 50, '1'),
('208', 'Chemistry', 50, '1'),
('209', 'Chemistry', 50, '1'),
('210', 'Chemistry', 0, '1'),
('207', 'Physics', 60, '1'),
('208', 'Physics', 60, '1'),
('209', 'Physics', 40, '1'),
('210', 'Physics', 0, '1'),
('207', 'C', 66.6667, '1'),
('208', 'C', 80, '1'),
('209', 'C', 100, '1'),
('210', 'C', 100, '1'),
('301', 'Physics', 0, '1'),
('302', 'Physics', 0, '1'),
('303', 'Physics', 0, '1'),
('304', 'Physics', 0, '1'),
('305', 'Physics', 0, '1'),
('306', 'Physics', 0, '1'),
('307', 'Physics', 0, '1'),
('308', 'Physics', 0, '1'),
('42342', 'Physics', 0, '1'),
('5353', 'Physics', 0, '1'),
('423', 'Physics', 0, '1'),
('7835', 'Physics', 0, '1'),
('77685', 'Physics', 0, '1'),
('3201', 'Physics', 0, '1'),
('3202', 'Physics', 0, '1'),
('3203', 'Physics', 0, '1'),
('3204', 'Physics', 0, '1'),
('3205', 'Physics', 0, '1'),
('3206', 'Physics', 0, '1'),
('3207', 'Physics', 0, '1'),
('3208', 'Physics', 0, '1'),
('3209', 'Physics', 0, '1'),
('3210', 'Physics', 0, '1'),
('3211', 'Physics', 0, '1'),
('3212', 'Physics', 0, '1'),
('3213', 'Physics', 0, '1'),
('3214', 'Physics', 0, '1'),
('3215', 'Physics', 0, '1'),
('3216', 'Physics', 0, '1'),
('3217', 'Physics', 0, '1'),
('3218', 'Physics', 0, '1'),
('3219', 'Physics', 0, '1'),
('3220', 'Physics', 0, '1'),
('742542', 'Physics', 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `semester` int(11) DEFAULT NULL,
  `bookName` varchar(25) DEFAULT NULL,
  `faculty` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`semester`, `bookName`, `faculty`) VALUES
(1, 'Engineering Mathematics-I', 'civil'),
(1, 'Physics', 'civil'),
(1, 'Thermal Science', 'civil'),
(1, 'Engineering Drawing', 'civil'),
(1, 'Programming in C', 'civil'),
(1, 'Basic Electrical Engineer', 'civil'),
(1, 'Engineering Mathematics-I', 'computer'),
(1, 'Chemistry', 'computer'),
(1, 'Communication Technique', 'computer'),
(1, 'Mechanical Workshop', 'computer'),
(1, 'Programming in C', 'computer'),
(1, 'Basic Electrical Engineer', 'computer'),
(1, 'Engineering Mathematics-I', 'electrical'),
(1, 'Chemistry', 'electrical'),
(1, 'Communication Technique', 'electrical'),
(1, 'Mechanical Workshop', 'electrical'),
(1, 'Programming in C', 'electrical'),
(1, 'Basic Electrical Engineer', 'electrical');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `faculty_id` int(3) NOT NULL,
  `faculty_name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`faculty_id`, `faculty_name`) VALUES
(1, 'Computer'),
(2, 'Elec. & Elex.'),
(3, 'Civil');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `section_name` varchar(10) NOT NULL,
  `faculty_id` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`section_name`, `faculty_id`) VALUES
('computer', 1),
('electrical', 2),
('civil ab', 3),
('civil cd', 3);

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `semester` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`semester`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `registration` varchar(25) NOT NULL,
  `fname` varchar(25) DEFAULT NULL,
  `lname` varchar(25) DEFAULT NULL,
  `roll_no` int(11) DEFAULT NULL,
  `semester` int(3) DEFAULT NULL,
  `section` varchar(10) DEFAULT NULL,
  `attendancePercentage` float DEFAULT 0,
  `active` char(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`registration`, `fname`, `lname`, `roll_no`, `semester`, `section`, `attendancePercentage`, `active`) VALUES
('207', 'Pranit', 'Poudel', 7, 1, 'computer', 58.8889, '1'),
('208', 'Riya', 'Shakya', 8, 1, 'computer', 63.3333, '1'),
('209', 'Sujan', 'Adhikari', 9, 1, 'computer', 63.3333, '1'),
('210', 'Urmila', 'Magar', 10, 1, 'computer', 33.3333, '1'),
('301', 'John', 'Doe', 1, 2, 'computer', 0, '1'),
('302', 'Jane', 'Smith', 2, 2, 'computer', 0, '1'),
('303', 'Alex', 'Johnson', 3, 2, 'computer', 0, '1'),
('304', 'Emily', 'Williams', 4, 2, 'computer', 0, '1'),
('305', 'Michael', 'Brown', 5, 2, 'computer', 0, '1'),
('306', 'Olivia', 'Jones', 6, 2, 'computer', 0, '1'),
('307', 'William', 'Davis', 7, 2, 'computer', 0, '1'),
('308', 'Sophia', 'Miller', 8, 2, 'computer', 0, '1'),
('42342', 'fsdfsd', 'hfhf', 45, 8, 'COMPUTER', 0, '1'),
('5353', 'sgsg', 'kjfskd', 32, 5, 'electrical', 0, '1'),
('423', 'dfsdf', 'dfgd', 654, 1, 'civil', 0, '1'),
('7835', 'ljireter', 'mdhgd', 54, 6, 'civil', 0, '1'),
('77685', 'ajsdhjkasdh', 'jhajksda', 87, 6, 'civil', 0, '1'),
('3201', 'Sara', 'Johnson', 1, 4, 'electrical', 0, '1'),
('3202', 'Ryan', 'Davis', 2, 4, 'electrical', 0, '1'),
('3203', 'Ella', 'Anderson', 3, 4, 'electrical', 0, '1'),
('3204', 'Daniel', 'Wilson', 4, 4, 'electrical', 0, '1'),
('3205', 'Sophia', 'Miller', 5, 4, 'electrical', 0, '1'),
('3206', 'Henry', 'Taylor', 6, 4, 'electrical', 0, '1'),
('3207', 'Amelia', 'Brown', 7, 4, 'electrical', 0, '1'),
('3208', 'Jack', 'Lee', 8, 4, 'electrical', 0, '1'),
('3209', 'Ava', 'Clark', 9, 4, 'electrical', 0, '1'),
('3210', 'Benjamin', 'Martin', 10, 4, 'electrical', 0, '1'),
('3211', 'Lily', 'Walker', 11, 4, 'electrical', 0, '1'),
('3212', 'Owen', 'Harris', 12, 4, 'electrical', 0, '1'),
('3213', 'Chloe', 'Turner', 13, 4, 'electrical', 0, '1'),
('3214', 'Samuel', 'Phillips', 14, 4, 'civil', 0, '1'),
('3215', 'Mia', 'Parker', 15, 4, 'electrical', 0, '1'),
('3216', 'Noah', 'Bennett', 16, 4, 'electrical', 0, '1'),
('3217', 'Grace', 'Hill', 17, 4, 'electrical', 0, '1'),
('3218', 'Logan', 'Carter', 18, 4, 'electrical', 0, '1'),
('3219', 'Abigail', 'Foster', 19, 4, 'electrical', 0, '1'),
('3220', 'Ethan', 'Thompson', 20, 4, 'electrical', 0, '1'),
('742542', 'jhfkjwehfw', 'fwegfwhef', 53, 7, 'civil', 0, '0');

--
-- Triggers `student`
--
DELIMITER $$
CREATE TRIGGER `username_password_trigger` AFTER INSERT ON `student` FOR EACH ROW BEGIN
        -- Insert the record into the salary_changes table
        INSERT INTO user(id,username,pass,userType)
        VALUES (NEW.registration,NEW.registration,NEW.registration,'student');
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacher_id` int(11) DEFAULT NULL,
  `fname` varchar(10) DEFAULT NULL,
  `lname` varchar(10) DEFAULT NULL,
  `date_created` datetime DEFAULT current_timestamp(),
  `active` char(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `fname`, `lname`, `date_created`, `active`) VALUES
(1, 'John', 'Smith', '2023-07-14 00:45:22', '1'),
(2, 'Emma', 'Johnson', '2023-07-14 00:45:22', '1'),
(3, 'Michael', 'Williams', '2023-07-14 00:45:22', '1'),
(4, 'Olivia', 'Brown', '2023-07-14 00:45:22', '1'),
(5, 'William', 'Jones', '2023-07-14 00:45:22', '1'),
(6, 'Sophia', 'Davis', '2023-07-14 00:45:22', '1'),
(7, 'James', 'Miller', '2023-07-14 00:45:22', '1'),
(8, 'Isabella', 'Anderson', '2023-07-14 00:45:22', '1'),
(9, 'Benjamin', 'Taylor', '2023-07-14 00:45:22', '1'),
(10, 'Ava', 'Thomas', '2023-07-14 00:45:22', '1'),
(11, 'Lucas', 'Clark', '2023-07-14 00:45:22', '1'),
(12, 'Mia', 'Lee', '2023-07-14 00:45:22', '1'),
(13, 'Henry', 'Martin', '2023-07-14 00:45:22', '1'),
(14, 'Emily', 'Walker', '2023-07-14 00:45:22', '1'),
(15, 'Alexander', 'Wilson', '2023-07-14 00:45:22', '1'),
(7342, 'jjadjsda', 'dahdha', '2023-07-14 01:00:09', '1');

-- --------------------------------------------------------

--
-- Table structure for table `teachersubject`
--

CREATE TABLE `teachersubject` (
  `teacher_id` int(11) DEFAULT NULL,
  `bookName` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachersubject`
--

INSERT INTO `teachersubject` (`teacher_id`, `bookName`) VALUES
(1, 'Physics'),
(1, 'Chemistry'),
(1, 'C');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` varchar(25) NOT NULL,
  `username` varchar(30) NOT NULL,
  `pass` varchar(300) DEFAULT NULL,
  `userType` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `pass`, `userType`) VALUES
('1', 'admin', '$2y$10$9Y4ws4VzEomij4aUf6Mfkuq92cuE3q8D.GFkOUViP.u4joIDMuyJ6', 'admin'),
('1313', 'teacher', '$2y$10$p2/qcUQbre0qF3kDP.D3ye2ckPF4IfaNmQpAsmMTVb0DyfiJ1bNLS', 'teacher'),
('1994821', '1994821', '1994821', 'student'),
('200', '200', '$2y$10$b3LioQt1FbIWzBWZpidRN.aM0RW0GoekOylNqF1j0J/', 'student'),
('202', '202', '$2y$10$KgqdYnKEt6fS3tKUszkweOr0qMrWxUV5Ic4GPoV5rMf', 'student'),
('202001', '202001', '202001', 'student'),
('204', '204', '$2y$10$jJ5SvOxNiNUfyuCVPEP/G.hK9zx8PkiDdm/Uqco3g51', 'student'),
('205', '205', '$2y$10$A.gOjaoZ3T.u/qxz1Vo/keWQ1uFKAnCRHk6SDwjQV5f17b1NMn7zu', 'student'),
('206', '206', '206', 'student'),
('207', '207', '207', 'student'),
('208', '208', '208', 'student'),
('209', '209', '209', 'student'),
('210', '210', '210', 'student'),
('301', '301', '301', 'student'),
('302', '302', '302', 'student'),
('303', '303', '303', 'student'),
('304', '304', '304', 'student'),
('305', '305', '305', 'student'),
('306', '306', '306', 'student'),
('307', '307', '307', 'student'),
('308', '308', '308', 'student'),
('309', '309', '309', 'student'),
('310', '310', '310', 'student'),
('3201', '3201', '3201', 'student'),
('3202', '3202', '3202', 'student'),
('3203', '3203', '3203', 'student'),
('3204', '3204', '3204', 'student'),
('3205', '3205', '3205', 'student'),
('3206', '3206', '3206', 'student'),
('3207', '3207', '3207', 'student'),
('3208', '3208', '3208', 'student'),
('3209', '3209', '3209', 'student'),
('3210', '3210', '3210', 'student'),
('3211', '3211', '3211', 'student'),
('3212', '3212', '3212', 'student'),
('3213', '3213', '3213', 'student'),
('3214', '3214', '3214', 'student'),
('3215', '3215', '3215', 'student'),
('3216', '3216', '3216', 'student'),
('3217', '3217', '3217', 'student'),
('3218', '3218', '3218', 'student'),
('3219', '3219', '3219', 'student'),
('3220', '3220', '3220', 'student'),
('423', '423', '423', 'student'),
('42342', '42342', '42342', 'student'),
('5353', '5353', '5353', 'student'),
('742542', '742542', '742542', 'student'),
('77685', '77685', '77685', 'student'),
('7835', '7835', '7835', 'student'),
('Banne', 'Banne', 'Banne', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`faculty_id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`section_name`),
  ADD KEY `faculty_id` (`faculty_id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`semester`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
