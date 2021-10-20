-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 27, 2021 at 10:50 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elearning`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_batch`
--

DROP TABLE IF EXISTS `tbl_batch`;
CREATE TABLE IF NOT EXISTS `tbl_batch` (
  `ID` int(50) NOT NULL AUTO_INCREMENT,
  `Dep_ID` int(50) NOT NULL,
  `Prog_ID` int(50) NOT NULL,
  `sName` varchar(200) NOT NULL,
  `dFrom` date NOT NULL,
  `dTo` date NOT NULL,
  `iSem1` int(20) NOT NULL,
  `iSem2` int(20) NOT NULL,
  `iSem3` int(20) NOT NULL,
  `iSem4` int(20) NOT NULL,
  `iSem5` int(20) NOT NULL,
  `iSem6` int(20) NOT NULL,
  `iSem7` int(20) NOT NULL,
  `iSem8` int(20) NOT NULL,
  `iSem9` int(20) NOT NULL,
  `iSem10` int(20) NOT NULL,
  `iCurrentSem` varchar(200) NOT NULL,
  `iStatus` int(10) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_batch`
--

INSERT INTO `tbl_batch` (`ID`, `Dep_ID`, `Prog_ID`, `sName`, `dFrom`, `dTo`, `iSem1`, `iSem2`, `iSem3`, `iSem4`, `iSem5`, `iSem6`, `iSem7`, `iSem8`, `iSem9`, `iSem10`, `iCurrentSem`, `iStatus`) VALUES
(1, 34, 2, 'Batch-2', '2020-06-01', '2023-03-31', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1', 1),
(2, 34, 1, 'Batch-4', '2020-06-01', '2023-03-30', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1', 1),
(3, 40, 5, 'Batch-1', '2020-05-01', '2023-04-01', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1', 1),
(4, 34, 2, 'Batch-1', '2020-06-01', '2023-03-31', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1', 1),
(8, 40, 5, 'Batch-7', '2020-12-08', '2023-04-01', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1', 1),
(7, 34, 1, 'Batch-3', '2020-07-01', '2023-02-01', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1', 1),
(9, 34, 1, 'Batch-5', '2020-12-08', '2023-04-01', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1', 1),
(10, 40, 5, 'Batch-9', '2021-06-08', '2023-10-05', 2, 1, 0, 0, 0, 0, 0, 0, 0, 0, '2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comment`
--

DROP TABLE IF EXISTS `tbl_comment`;
CREATE TABLE IF NOT EXISTS `tbl_comment` (
  `ID` int(50) NOT NULL AUTO_INCREMENT,
  `Vid_ID` int(50) NOT NULL,
  `Stud_ID` int(50) NOT NULL,
  `sComment` text NOT NULL,
  `iStatus` int(10) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

DROP TABLE IF EXISTS `tbl_department`;
CREATE TABLE IF NOT EXISTS `tbl_department` (
  `ID` int(50) NOT NULL AUTO_INCREMENT,
  `sName` varchar(200) NOT NULL,
  `iStatus` int(10) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`ID`, `sName`, `iStatus`) VALUES
(34, 'Computer Applications', 1),
(40, 'MBA', 1),
(39, 'BA', 1),
(38, 'Barch', 0),
(33, 'Btech', 0),
(32, 'MBBS', 1),
(35, 'BDS', 0),
(42, 'Mtech', 0),
(43, 'Bsc', 0),
(45, 'Btech engineering', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_faculty`
--

DROP TABLE IF EXISTS `tbl_faculty`;
CREATE TABLE IF NOT EXISTS `tbl_faculty` (
  `ID` int(50) NOT NULL AUTO_INCREMENT,
  `Dep_ID` int(50) NOT NULL,
  `sName` varchar(200) NOT NULL,
  `sDesignation` varchar(200) NOT NULL,
  `sQualification` varchar(200) NOT NULL,
  `sEmail` varchar(200) NOT NULL,
  `sPassword` varchar(200) NOT NULL,
  `iPhone` bigint(20) NOT NULL,
  `sGender` varchar(200) NOT NULL,
  `iCommon_Dep` int(50) NOT NULL,
  `iStatus` int(10) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_faculty`
--

INSERT INTO `tbl_faculty` (`ID`, `Dep_ID`, `sName`, `sDesignation`, `sQualification`, `sEmail`, `sPassword`, `iPhone`, `sGender`, `iCommon_Dep`, `iStatus`) VALUES
(1, 34, 'Ranjith S', 'Asst Proffesor', 'BCA, MCA', 'ranjith@scmsgroup.org', 'e9bc67845328fb66badce018aa8c5c04', 7878896574, '0', 0, 1),
(4, 34, 'Bindu John', 'Asst Proffessor', 'B.ed,PHD', 'bindu@scmsgroup.org', '81dc9bdb52d04dc20036dbd8313ed055', 8281465929, '1', 1, 1),
(5, 34, 'Sudha D', 'Asst Proffessor', 'MCA, PHD', 'sudha@scmsgroup.org', '81dc9bdb52d04dc20036dbd8313ed055', 7898907896, '1', 0, 1),
(7, 34, 'Mariadas Ronnie', 'Asst Proffessor', 'MCA, PHD', 'mariadas@scmsgroup.org', '81dc9bdb52d04dc20036dbd8313ed055', 9881465934, '0', 0, 1),
(8, 34, 'Shoby Sunny', 'Asst Proffessor', 'B.ed,PHD', 'shoby@scmsgroup.org', '81dc9bdb52d04dc20036dbd8313ed055', 9881465929, '1', 0, 1),
(9, 34, 'Lakshmi Mahesh', 'HOD', 'MCA, PHD', 'lakshmi@scmsgroup.org', '81dc9bdb52d04dc20036dbd8313ed055', 8981465978, '1', 0, 1),
(10, 34, 'Anjana S Chandran', 'Asst Proffessor', 'MCA, PHD', 'anjana@scmsgroup.org', '81dc9bdb52d04dc20036dbd8313ed055', 7881465929, '1', 0, 1),
(11, 34, 'Vidhya Gopinath', 'Asst Proffessor', 'B.ed,PHD', 'vidhya@scmsgroup.org', '81dc9bdb52d04dc20036dbd8313ed055', 9876765435, '1', 0, 1),
(12, 34, 'Jismy Joseph', 'Asst Proffessor', 'B.ed,PHD', 'jismy@smsgroup.org', '81dc9bdb52d04dc20036dbd8313ed055', 8767554334, '1', 0, 1),
(13, 34, 'Sherin Mariam Alex', 'Vice Principal', 'MCA, PHD', 'sherin@scmsgroup.org', '81dc9bdb52d04dc20036dbd8313ed055', 9877654567, '1', 1, 1),
(14, 40, 'Praveena', 'Asst Proffessor', 'PHD', 'praveena@scmsgroup.org', '81dc9bdb52d04dc20036dbd8313ed055', 9881465976, '1', 0, 1),
(15, 34, 'Praveen Kammath', 'Asst Professor, System Administrator', 'MCA, Bed', 'praveen@scmsgroup.org', '81dc9bdb52d04dc20036dbd8313ed055', 9786543345, '0', 0, 1),
(16, 34, 'Jisha Liju', 'Asst Proffessor', 'B.ed MCA', 'jisha@scmsgroup.org', '81dc9bdb52d04dc20036dbd8313ed055', 9876543009, '1', 0, 1),
(17, 34, 'Anitha G Krishnan', 'Asst Proffessor', 'MCA', 'anitha@scmsgroup.org', '81dc9bdb52d04dc20036dbd8313ed055', 9878879988, '1', 0, 1),
(18, 34, 'Anjali', 'Asst Proffessor', 'B.ed,PHD', 'anjali@scmsgroup.org', '81dc9bdb52d04dc20036dbd8313ed055', 9999887766, '1', 0, 1),
(20, 34, 'Rajeshwari', 'Asst Proffessor', 'B.ed,PHD', 'rajeshwari@scmsgroup.org', '81dc9bdb52d04dc20036dbd8313ed055', 9999887773, '1', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_program`
--

DROP TABLE IF EXISTS `tbl_program`;
CREATE TABLE IF NOT EXISTS `tbl_program` (
  `ID` int(50) NOT NULL AUTO_INCREMENT,
  `sName` varchar(200) NOT NULL,
  `iStatus` int(10) NOT NULL,
  `Dep_ID` int(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_program`
--

INSERT INTO `tbl_program` (`ID`, `sName`, `iStatus`, `Dep_ID`) VALUES
(1, 'BCA', 1, 34),
(2, 'MCA', 1, 34),
(4, 'IMCA', 0, 34),
(5, 'PGDM', 1, 40);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pwdreset`
--

DROP TABLE IF EXISTS `tbl_pwdreset`;
CREATE TABLE IF NOT EXISTS `tbl_pwdreset` (
  `pwd_reset_id` int(11) NOT NULL AUTO_INCREMENT,
  `pwd_reset_email` text NOT NULL,
  `pwd_reset_selector` text NOT NULL,
  `pwd_reset_token` longtext NOT NULL,
  `pwd_reset_expires` text NOT NULL,
  PRIMARY KEY (`pwd_reset_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reply_comment`
--

DROP TABLE IF EXISTS `tbl_reply_comment`;
CREATE TABLE IF NOT EXISTS `tbl_reply_comment` (
  `ID` int(50) NOT NULL AUTO_INCREMENT,
  `Comment_ID` int(50) NOT NULL,
  `Faculty_ID` int(50) NOT NULL,
  `Stud_ID` int(50) NOT NULL,
  `sReply` text NOT NULL,
  `iStatus` int(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_semester`
--

DROP TABLE IF EXISTS `tbl_semester`;
CREATE TABLE IF NOT EXISTS `tbl_semester` (
  `ID` int(50) NOT NULL AUTO_INCREMENT,
  `sName` varchar(200) NOT NULL,
  `iStatus` int(10) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_semester`
--

INSERT INTO `tbl_semester` (`ID`, `sName`, `iStatus`) VALUES
(1, '1', 1),
(2, '2', 1),
(3, '3', 1),
(4, '4', 1),
(5, '5', 1),
(6, '6', 1),
(7, '7', 1),
(8, '8', 1),
(9, '9', 1),
(10, '10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student`
--

DROP TABLE IF EXISTS `tbl_student`;
CREATE TABLE IF NOT EXISTS `tbl_student` (
  `ID` int(50) NOT NULL AUTO_INCREMENT,
  `Dep_ID` int(50) NOT NULL,
  `Batch_ID` int(50) NOT NULL,
  `Prog_ID` int(50) NOT NULL,
  `sName` varchar(200) NOT NULL,
  `sEmail` varchar(200) NOT NULL,
  `sPassword` varchar(200) NOT NULL,
  `iPhone` bigint(20) NOT NULL,
  `iGender` int(20) NOT NULL,
  `iStatus` int(10) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_student`
--

INSERT INTO `tbl_student` (`ID`, `Dep_ID`, `Batch_ID`, `Prog_ID`, `sName`, `sEmail`, `sPassword`, `iPhone`, `iGender`, `iStatus`) VALUES
(3, 34, 4, 2, 'Arvind Menon', 'imca-159@scmsgroup.org', '81dc9bdb52d04dc20036dbd8313ed055', 8281465929, 0, 1),
(4, 34, 2, 1, 'Anuroop Vijayan', 'imca-134@scmsgroup.org', '81dc9bdb52d04dc20036dbd8313ed055', 9881465929, 0, 1),
(5, 34, 4, 2, 'Anjali Soorej', 'imca-133@scmsgroup.org', '81dc9bdb52d04dc20036dbd8313ed055', 9633275944, 1, 1),
(6, 34, 1, 2, 'Athul Dineshan', 'imca-149@scmsgroup.org', '81dc9bdb52d04dc20036dbd8313ed055', 9889465929, 0, 1),
(7, 34, 1, 2, 'Kavya Jagdish', 'imca-163@scmsgroup.org', '81dc9bdb52d04dc20036dbd8313ed055', 8981465929, 1, 0),
(8, 40, 3, 5, 'Pranav P', 'pgdm-162@scmsgroup.org', '81dc9bdb52d04dc20036dbd8313ed055', 8281464479, 0, 1),
(9, 34, 1, 2, 'Abida Shahana ', 'imca-142@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 9354465929, 1, 1),
(10, 34, 4, 2, 'Abhishek Arun', 'imca-127@scmsgroup.org', '81dc9bdb52d04dc20036dbd8313ed055', 9444465929, 0, 1),
(11, 34, 2, 1, 'Rahul P.T', 'imca-146@scmsgroup.org', '81dc9bdb52d04dc20036dbd8313ed055', 8984566929, 0, 1),
(12, 34, 1, 2, 'Safna Sadik', 'imca-125@scmsgroup.org', '81dc9bdb52d04dc20036dbd8313ed055', 8253535929, 1, 1),
(13, 40, 3, 5, 'Ann Mary Sajan', 'pgdm-126@scmsgroup.org', '81dc9bdb52d04dc20036dbd8313ed055', 8281321479, 1, 1),
(14, 34, 1, 2, 'Akhil S kumar', 'imca-155@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 8232211929, 0, 1),
(15, 34, 4, 2, 'Vipin Benny1', 'imca-121@scmsgroup.org', '81dc9bdb52d04dc20036dbd8313ed055', 9827663562, 0, 1),
(16, 34, 4, 2, 'Abhirami K.S', 'imca-131@scmsgroup.org', '81dc9bdb52d04dc20036dbd8313ed055', 7876453647, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subject`
--

DROP TABLE IF EXISTS `tbl_subject`;
CREATE TABLE IF NOT EXISTS `tbl_subject` (
  `ID` int(50) NOT NULL AUTO_INCREMENT,
  `Prog_ID` int(50) NOT NULL,
  `sCode` varchar(200) NOT NULL,
  `sName` varchar(200) NOT NULL,
  `iStatus` int(10) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_subject`
--

INSERT INTO `tbl_subject` (`ID`, `Prog_ID`, `sCode`, `sName`, `iStatus`) VALUES
(44, 1, 'BCA 302', 'Statistics- II', 1),
(39, 1, 'BCA 102', 'COA', 1),
(40, 1, 'BCA 103', 'Statistics-I', 1),
(41, 1, 'BCA 104', 'Introduction to Computers & PC hardware', 1),
(35, 2, 'MCA 101', 'System Software', 1),
(45, 1, 'BCA 303', 'Digital Systems & Logic Designs', 1),
(37, 2, 'MCA 105', 'Cloud & Grid Computing', 1),
(38, 1, 'BCA 101', 'English', 1),
(42, 1, 'BCA 105', 'Programming Methodology & C Programming', 1),
(43, 1, 'BCA 301', 'Technical Communication', 1),
(33, 2, 'MCA 103', 'TCP/IP Protocol', 1),
(34, 2, 'MCA 102', 'Data Mining', 1),
(36, 2, 'MCA 104', 'Linux & shell programming', 1),
(46, 1, 'BCA 304', 'Data Structures- C', 1),
(47, 1, 'BCA 305', 'Object Oriented Programming with C++', 1),
(48, 2, 'MCA 301', 'Principles of Management & Accounting', 1),
(49, 2, 'MCA 302', 'Analysis & Design of Algorithms', 1),
(50, 2, 'MCA 303', 'Object Oriented Programming through Java', 1),
(51, 2, 'MCA 304', 'SEPM', 1),
(52, 2, 'MCA 305', 'OOAD ', 1),
(53, 1, 'BCA 401', 'Compiler Design', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subject_allocation`
--

DROP TABLE IF EXISTS `tbl_subject_allocation`;
CREATE TABLE IF NOT EXISTS `tbl_subject_allocation` (
  `ID` int(50) NOT NULL AUTO_INCREMENT,
  `Dep_ID` int(50) NOT NULL,
  `Batch_ID` int(50) NOT NULL,
  `Prog_ID` int(50) NOT NULL,
  `Subject_ID` int(50) NOT NULL,
  `Sem_ID` int(50) NOT NULL,
  `Faculty_ID` int(200) NOT NULL,
  `iStatus` int(10) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_subject_allocation`
--

INSERT INTO `tbl_subject_allocation` (`ID`, `Dep_ID`, `Batch_ID`, `Prog_ID`, `Subject_ID`, `Sem_ID`, `Faculty_ID`, `iStatus`) VALUES
(7, 34, 4, 2, 37, 1, 1, 1),
(8, 34, 4, 2, 36, 1, 15, 1),
(9, 34, 4, 2, 33, 1, 10, 1),
(10, 34, 4, 2, 35, 1, 11, 1),
(11, 34, 4, 2, 34, 1, 16, 1),
(12, 34, 1, 2, 50, 1, 8, 1),
(13, 34, 1, 2, 52, 1, 12, 1),
(14, 34, 1, 2, 51, 1, 11, 1),
(15, 34, 1, 2, 49, 1, 18, 1),
(16, 34, 1, 2, 48, 1, 20, 1),
(17, 34, 2, 1, 53, 1, 1, 1),
(18, 34, 7, 1, 39, 1, 1, 1),
(19, 34, 9, 1, 47, 1, 1, 1),
(20, 34, 4, 2, 50, 1, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_usermaster`
--

DROP TABLE IF EXISTS `tbl_usermaster`;
CREATE TABLE IF NOT EXISTS `tbl_usermaster` (
  `ID` int(50) NOT NULL AUTO_INCREMENT,
  `sName` varchar(100) NOT NULL,
  `iPhone` bigint(50) NOT NULL,
  `sEmail` varchar(100) NOT NULL,
  `sPassword` varchar(100) NOT NULL,
  `iStatus` int(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_usermaster`
--

INSERT INTO `tbl_usermaster` (`ID`, `sName`, `iPhone`, `sEmail`, `sPassword`, `iStatus`) VALUES
(1, 'anjali', 78788, 'anjalisoorej@gmail.com', 'c25d306113d5eca9bcf5c59f07186c82', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_video`
--

DROP TABLE IF EXISTS `tbl_video`;
CREATE TABLE IF NOT EXISTS `tbl_video` (
  `ID` int(50) NOT NULL AUTO_INCREMENT,
  `Dep_ID` int(50) NOT NULL,
  `Batch_ID` int(50) NOT NULL,
  `Prog_ID` int(50) NOT NULL,
  `Subject_ID` int(50) NOT NULL,
  `Sem_ID` int(50) NOT NULL,
  `Faculty_ID` int(100) NOT NULL,
  `sTitle` varchar(200) NOT NULL,
  `sDescription` varchar(1000) NOT NULL,
  `sUrl` varchar(600) NOT NULL,
  `dtDate` date NOT NULL,
  `iStatus` int(10) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_video`
--

INSERT INTO `tbl_video` (`ID`, `Dep_ID`, `Batch_ID`, `Prog_ID`, `Subject_ID`, `Sem_ID`, `Faculty_ID`, `sTitle`, `sDescription`, `sUrl`, `dtDate`, `iStatus`) VALUES
(15, 34, 4, 2, 37, 1, 1, 'Cloud Computing Basics', 'Overview, Applications, Intranets and the Cloud, Hardware and Infrastructure', 'https://www.youtube.com/embed/M988_fsOSWo', '2021-06-01', 1),
(16, 34, 4, 2, 37, 1, 1, 'Software as a Service', 'in detail ', 'https://www.youtube.com/embed/20QUNgFIrK0', '2021-06-02', 1),
(17, 34, 4, 2, 37, 1, 1, 'Platform as a Service', 'Benefits of Paas Solutions, \r\nDisadvantages of Paas Solutions.', 'https://www.youtube.com/embed/QAbqJzd0PEE', '2021-06-03', 1),
(18, 34, 4, 2, 37, 1, 1, 'Infrastructure as a Service', 'Understanding IaaS', 'https://www.youtube.com/embed/XRdmfo4M_YA', '2021-06-04', 1),
(19, 34, 4, 2, 36, 1, 15, 'Introduction to Linux', 'History, Architecture, Comparison with UNIX, Features and Facilities of\r\nLinux, Basic commands in Linux,', 'https://www.youtube.com/embed/V1y-mbWM3B8', '2021-06-01', 1),
(20, 34, 4, 2, 36, 1, 15, 'File Commands in Linux', 'commands and explanation in detail', 'https://www.youtube.com/embed/tQ5s33tM21c', '2021-06-02', 1),
(21, 34, 4, 2, 36, 1, 15, 'Basics of shell programming', 'various types of shell available in Linux', 'https://www.youtube.com/embed/cQepf9fY6cE', '2021-06-03', 1),
(22, 34, 4, 2, 34, 1, 16, 'Data warehouse', 'introduction', 'https://www.youtube.com/embed/AHR_7jFCMeY', '2021-06-03', 1),
(23, 34, 4, 2, 34, 1, 16, 'Introduction to Data mining ', 'Introduction to Data mining & Data Warehouse', 'https://www.youtube.com/embed/mOfPG5ZIY-k', '2021-06-03', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
