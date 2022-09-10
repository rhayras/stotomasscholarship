-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2022 at 05:46 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_stotomas`
--

-- --------------------------------------------------------

--
-- Table structure for table `highlights`
--

CREATE TABLE `highlights` (
  `id` int(11) NOT NULL,
  `report_date` date DEFAULT NULL,
  `highlights1` text DEFAULT NULL,
  `highlights2` text DEFAULT NULL,
  `highlights3` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `highlights`
--

INSERT INTO `highlights` (`id`, `report_date`, `highlights1`, `highlights2`, `highlights3`) VALUES
(1, '2021-06-29', '• The average demand, including the average reserve schedule, was recorded at 10,876 MW on 06 March 2021. The General Community Quarantine (GCQ) and the Modified General Community Quarantine (MGCQ) are in place to contain the spread of the coronavirus disease. Starting 01 March – the National Capital Region, Apayao, Kalinga, Mountain Province, Baguio City, Batangas, Tacloban City, Iligan City, Lanao del Sur  and Davao City are under the GCQ while the rest of the country is under the MGCQ.\r\n• The total WESM registered capacity stood at 20,871 MW.', '• The outage capacity averaged 3,705 MW. About 58% of which involved coal plants while about 22% involved natural gas plants. About 59% of the total outage capacity were from forced outages.\r\n• The average effective supply was 12,904 MW.\r\n• A supply margin averaging 2,027 MW was observed.', '• The secondary price cap was not imposed during the day.\r\n• The top 5 major participant groups accounted for 79% of the average offered capacity. The Herfindahl-Hirschman Index (HHI) by major participant grouping indicated a moderately concentrated market based on the registered capacity, registered capacity (net of outage) and the offered capacity.\r\n• No plant figured as a pivotal supplier, consistent with the wide supply margin of the day.\r\n• No IT-related issue was advised in IEMOP’s market systems on 06 March 2021.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account`
--

CREATE TABLE `tbl_account` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `priviledge` text NOT NULL,
  `studentId` text NOT NULL,
  `name` text DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `examstatus` int(1) NOT NULL DEFAULT 0,
  `renewstatus` int(1) NOT NULL DEFAULT 0,
  `activeStatus` int(1) NOT NULL DEFAULT 0 COMMENT '0-inactive;1-active',
  `todaySmsStatus` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_account`
--

INSERT INTO `tbl_account` (`id`, `username`, `password`, `priviledge`, `studentId`, `name`, `status`, `examstatus`, `renewstatus`, `activeStatus`, `todaySmsStatus`) VALUES
(43, 'admin', 'admin', 'admin', '', 'Cathy De Guzman', 0, 0, 0, 1, 0),
(44, 'angela', 'angel', 'student', '2', '', 0, 1, 0, 0, 1),
(45, 'jessa', 'jessa', 'student', '3', '', 0, 1, 0, 0, 1),
(46, 'LoveLita10', '12345678', 'student', '4', '', 0, 1, 0, 1, 1),
(47, 'ella', 'ella', 'student', '5', '', 0, 1, 0, 0, 1),
(48, 'jeremy', 'jeremy', 'student', '6', '', 0, 1, 0, 1, 1),
(49, 'killua', 'killue', 'student', '7', '', 0, 0, 0, 0, 0),
(50, 'joan', 'joan', 'student', '8', '', 0, 1, 0, 0, 1),
(51, 'joseph', 'joseph', 'student', '9', '', 0, 1, 0, 0, 1),
(52, 'mary', 'mary', 'student', '10', '', 0, 0, 0, 0, 0),
(53, 'vin@gmail.com', 'arvin', 'student', '11', '', 0, 1, 0, 1, 1),
(54, 'nathan', 'nathan', 'student', '12', '', 0, 1, 0, 0, 1),
(55, 'arge', 'aege', 'student', '13', '', 0, 1, 0, 0, 1),
(56, 'joy', 'joy', 'student', '14', '', 0, 1, 0, 1, 1),
(57, 'kim', 'kim', 'student', '15', '', 0, 1, 0, 1, 1),
(58, 'khiara', 'khiara', 'student', '16', '', 0, 0, 0, 0, 0),
(59, 'angela', 'angela', 'student', '17', '', 0, 1, 0, 1, 1),
(60, 'mar', 'mar', 'student', '18', '', 0, 1, 0, 0, 1),
(61, 'ayesha', 'khiara', 'student', '19', '', 0, 1, 0, 0, 1),
(62, 'kyrie', 'kyrie', 'student', '20', '', 0, 1, 0, 0, 1),
(63, 'kert', 'kert', 'student', '21', '', 0, 1, 0, 0, 1),
(64, 'joshua', 'joshua', 'student', '22', '', 0, 1, 0, 0, 1),
(65, 'gelo', 'gelo', 'student', '23', '', 0, 1, 0, 0, 1),
(66, 'vergel', 'vergel', 'student', '24', '', 0, 1, 0, 0, 1),
(67, 'sid', 'sid', 'student', '25', '', 0, 1, 0, 0, 1),
(68, 'gelay', 'gelay', 'student', '26', '', 0, 1, 0, 1, 1),
(69, 'aya', 'aya', 'student', '27', '', 0, 1, 0, 0, 1),
(70, 'kane', 'kane', 'student', '28', '', 0, 1, 0, 0, 1),
(71, 'carl', 'carl', 'student', '29', '', 0, 1, 0, 0, 1),
(72, 'daisy', 'daisy', 'student', '30', '', 0, 1, 0, 1, 1),
(73, 'mabel', 'mabel', 'student', '31', '', 0, 1, 0, 1, 1),
(74, 'ed123', 'ed123', 'student', '32', NULL, 0, 1, 0, 0, 0),
(75, 'rhayras', 'rhayras', 'student', '33', NULL, 0, 1, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_answer`
--

CREATE TABLE `tbl_answer` (
  `id` int(11) NOT NULL,
  `studentNumber` text NOT NULL,
  `question` int(11) NOT NULL,
  `answer` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0 COMMENT '0-notchecked;1checked'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_answer`
--

INSERT INTO `tbl_answer` (`id`, `studentNumber`, `question`, `answer`, `status`) VALUES
(1, '50', 41, '41600', 1),
(2, '50', 42, 'a', 1),
(3, '50', 43, 'c', 1),
(4, '50', 44, '10', 1),
(5, '50', 45, '17', 1),
(6, '50', 46, 'b', 1),
(7, '50', 47, 'c', 1),
(8, '50', 48, 'd', 1),
(9, '50', 49, 'a', 1),
(10, '50', 50, '41.31', 1),
(11, '50', 58, 'b', 1),
(12, '50', 59, 'c', 1),
(13, '50', 60, 'c', 1),
(14, '50', 61, 'c', 1),
(15, '50', 62, 'd', 1),
(16, '50', 64, 'c', 1),
(17, '50', 66, 'b', 1),
(18, '50', 68, 'c', 1),
(19, '50', 70, 'c', 1),
(20, '50', 72, 'd', 1),
(21, '49', 80, '202', 1),
(22, '49', 81, 'b', 1),
(23, '49', 82, 'b', 1),
(24, '49', 86, 'drives', 1),
(25, '49', 87, 'a', 1),
(26, '54', 41, '41600', 1),
(27, '54', 42, 'a', 1),
(28, '54', 43, 'c', 1),
(29, '54', 44, '10', 1),
(30, '54', 45, '17', 1),
(31, '54', 46, 'b', 1),
(32, '54', 47, 'c', 1),
(33, '54', 48, 'd', 1),
(34, '54', 49, 'c', 1),
(35, '54', 50, '41.31', 1),
(36, '54', 58, 'c', 1),
(37, '54', 59, 'b', 1),
(38, '54', 60, 'c', 1),
(39, '54', 61, 'c', 1),
(40, '54', 62, 'd', 1),
(41, '54', 64, 'c', 1),
(42, '54', 66, 'c', 1),
(43, '54', 68, 'c', 1),
(44, '54', 70, 'c', 1),
(45, '54', 72, 'c', 1),
(46, '1', 80, '202', 1),
(47, '1', 81, 'a', 1),
(48, '1', 82, 'b', 1),
(49, '1', 86, 'drived', 1),
(50, '1', 87, 'a', 1),
(51, '3', 80, '202', 1),
(52, '3', 81, 'a', 1),
(53, '3', 82, 'b', 1),
(54, '3', 86, 'drives', 1),
(55, '3', 87, 'a', 1),
(56, '5', 80, '202', 1),
(57, '6', 41, '41600', 1),
(58, '5', 81, 'a', 1),
(59, '6', 42, 'a', 1),
(60, '6', 43, 'c', 1),
(61, '5', 82, 'b', 1),
(62, '6', 44, '10', 1),
(63, '5', 86, 'drives', 1),
(64, '6', 45, '17', 1),
(65, '5', 87, 'a', 1),
(66, '6', 46, 'c', 1),
(67, '6', 47, 'b', 1),
(68, '6', 48, 'c', 1),
(69, '6', 49, 'b', 1),
(70, '6', 50, '10', 1),
(71, '6', 58, 'b', 1),
(72, '6', 59, 'b', 1),
(73, '6', 60, 'd', 1),
(74, '6', 61, 'c', 1),
(75, '6', 62, 'b', 1),
(76, '6', 64, 'b', 1),
(77, '6', 66, 'c', 1),
(78, '6', 68, 'c', 1),
(79, '6', 70, 'a', 1),
(80, '6', 72, 'c', 1),
(81, '8', 80, '202', 1),
(82, '8', 81, 'a', 1),
(83, '8', 82, 'b', 1),
(84, '8', 86, 'drives', 1),
(85, '8', 87, 'a', 1),
(86, '2', 41, '41600', 1),
(87, '2', 42, 'a', 1),
(88, '2', 43, 'c', 1),
(89, '2', 44, '10', 1),
(90, '2', 45, '17', 1),
(91, '2', 46, 'b', 1),
(92, '2', 47, 'c', 1),
(93, '2', 48, 'd', 1),
(94, '2', 49, 'a', 1),
(95, '2', 50, '41.31', 1),
(96, '2', 58, 'c', 1),
(97, '2', 59, 'c', 1),
(98, '2', 60, 'd', 1),
(99, '2', 61, 'c', 1),
(100, '2', 62, 'd', 1),
(101, '2', 64, 'c', 1),
(102, '2', 66, 'b', 1),
(103, '2', 68, 'c', 1),
(104, '2', 70, 'c', 1),
(105, '2', 72, 'd', 1),
(106, '9', 80, '202', 1),
(107, '9', 81, 'a', 1),
(108, '9', 82, 'b', 1),
(109, '9', 86, 'drives', 1),
(110, '9', 87, 'a', 1),
(111, '13', 41, '41600', 1),
(112, '13', 42, 'a', 1),
(113, '13', 43, 'c', 1),
(114, '13', 44, '10', 1),
(115, '13', 45, '17', 1),
(116, '13', 46, 'b', 1),
(117, '13', 47, 'c', 1),
(118, '13', 48, 'd', 1),
(119, '13', 49, 'a', 1),
(120, '13', 50, '41.31', 1),
(121, '13', 58, 'c', 1),
(122, '13', 59, 'c', 1),
(123, '13', 60, 'd', 1),
(124, '13', 61, 'c', 1),
(125, '13', 62, 'c', 1),
(126, '13', 64, 'c', 1),
(127, '13', 66, 'b', 1),
(128, '13', 68, 'c', 1),
(129, '13', 70, 'c', 1),
(130, '13', 72, 'd', 1),
(131, '12', 80, '102', 1),
(132, '12', 81, 'b', 1),
(133, '12', 82, 'b', 1),
(134, '12', 86, 'drive', 1),
(135, '12', 87, 'c', 1),
(136, '15', 80, '102\r\n', 1),
(137, '15', 81, 'a', 1),
(138, '15', 82, 'c', 1),
(139, '15', 86, 'drive', 1),
(140, '15', 87, 'c', 1),
(141, '14', 80, '102', 1),
(142, '14', 81, 'b', 1),
(143, '14', 82, 'd', 1),
(144, '14', 86, '', 1),
(145, '14', 87, 'a', 1),
(146, '11', 80, 'wd', 1),
(147, '11', 81, 'd', 1),
(148, '11', 82, 'c', 1),
(149, '11', 86, 'dfg', 1),
(150, '11', 87, 'c', 1),
(151, '4', 80, 'hufu1', 1),
(152, '4', 81, 'b', 1),
(153, '4', 82, 'b', 1),
(154, '4', 86, 'wdf', 1),
(155, '4', 87, 'd', 1),
(156, '17', 80, '102', 1),
(157, '17', 81, 'a', 1),
(158, '17', 82, 'b', 1),
(159, '17', 86, 'drives', 1),
(160, '17', 87, 'a', 1),
(161, '19', 49, 'a', 1),
(162, '19', 58, 'c', 1),
(163, '19', 59, 'c', 1),
(164, '19', 60, 'd', 1),
(165, '19', 61, 'c', 1),
(166, '18', 49, 'a', 1),
(167, '18', 58, 'c', 1),
(168, '18', 59, 'c', 1),
(169, '18', 60, 'c', 1),
(170, '18', 61, 'c', 1),
(171, '20', 49, 'a', 1),
(172, '20', 58, 'c', 1),
(173, '20', 59, 'c', 1),
(174, '20', 60, 'd', 1),
(175, '20', 61, 'c', 1),
(176, '21', 80, '202', 1),
(177, '21', 81, 'b', 1),
(178, '21', 82, 'a', 1),
(179, '21', 86, 'drives', 1),
(180, '21', 87, 'a', 1),
(181, '22', 49, 'a', 1),
(182, '22', 58, 'c', 1),
(183, '22', 59, 'c', 1),
(184, '22', 60, 'd', 1),
(185, '22', 61, 'c', 1),
(186, '23', 49, 'a', 1),
(187, '23', 58, 'c', 1),
(188, '23', 59, 'c', 1),
(189, '23', 60, 'd', 1),
(190, '23', 61, 'c', 1),
(191, '25', 49, 'a', 1),
(192, '25', 58, 'c', 1),
(193, '25', 59, 'c', 1),
(194, '25', 60, 'd', 1),
(195, '25', 61, 'c', 1),
(196, '26', 80, '202', 1),
(197, '26', 81, 'b', 1),
(198, '26', 82, 'a', 1),
(199, '26', 86, 'drives', 1),
(200, '26', 87, 'a', 1),
(201, '27', 49, 'a', 1),
(202, '27', 58, 'c', 1),
(203, '27', 59, 'c', 1),
(204, '27', 60, 'd', 1),
(205, '27', 61, 'c', 1),
(206, '28', 49, 'a', 1),
(207, '28', 58, 'c', 1),
(208, '28', 59, 'c', 1),
(209, '28', 60, 'd', 1),
(210, '28', 61, 'c', 1),
(211, '29', 80, '202', 1),
(212, '29', 81, 'a', 1),
(213, '29', 82, 'b', 1),
(214, '29', 86, 'drives', 1),
(215, '29', 87, 'a', 1),
(216, '30', 49, 'a', 1),
(217, '30', 58, 'c', 1),
(218, '30', 59, 'c', 1),
(219, '30', 60, 'd', 1),
(220, '30', 61, 'c', 1),
(221, '31', 80, '202', 1),
(222, '31', 81, 'a', 1),
(223, '31', 82, 'b', 1),
(224, '31', 86, 'drives', 1),
(225, '31', 87, 'a', 1),
(226, '33', 41, '123', 1),
(227, '33', 42, 'c', 1),
(228, '33', 43, ' ', 1),
(229, '33', 44, '', 1),
(230, '33', 45, '', 1),
(231, '33', 46, ' ', 1),
(232, '33', 47, ' ', 1),
(233, '33', 48, ' ', 1),
(234, '33', 49, ' ', 1),
(235, '33', 50, '', 1),
(236, '33', 58, ' ', 1),
(237, '33', 59, ' ', 1),
(238, '33', 60, ' ', 1),
(239, '33', 61, ' ', 1),
(240, '33', 62, ' ', 1),
(241, '33', 64, ' ', 1),
(242, '33', 66, ' ', 1),
(243, '33', 68, ' ', 1),
(244, '33', 70, ' ', 1),
(245, '33', 72, ' ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_apikey`
--

CREATE TABLE `tbl_apikey` (
  `id` int(11) NOT NULL,
  `apiKey` text NOT NULL COMMENT '10a2fb0f05b087fd7b4fd798836e06a7'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_apikey`
--

INSERT INTO `tbl_apikey` (`id`, `apiKey`) VALUES
(1, 'dfb36b2f7729d5b4c16f1875ffc71e34');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_applydate`
--

CREATE TABLE `tbl_applydate` (
  `id` int(11) NOT NULL,
  `fromdate` date NOT NULL,
  `todate` date NOT NULL,
  `scholartype` int(1) NOT NULL COMMENT '0-jhs;1-shs;2-college',
  `schyear` text NOT NULL,
  `semester` text NOT NULL,
  `year` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_applydate`
--

INSERT INTO `tbl_applydate` (`id`, `fromdate`, `todate`, `scholartype`, `schyear`, `semester`, `year`) VALUES
(27, '2018-08-06', '2018-09-08', 1, '2018-2019', '1st Semester', '2019'),
(28, '2018-08-06', '2018-09-06', 2, '2018-2019', '1st Semester', '2018'),
(29, '2019-01-07', '2019-02-07', 1, '2018-2019', '2nd Semester', '2019'),
(30, '2019-01-07', '2019-02-07', 2, '2018-2019', '2nd Semester', '2019'),
(31, '2019-11-04', '2019-12-04', 1, '2019-2020', '1st Semester', '2019'),
(32, '2021-07-01', '2021-11-30', 1, '2019-2020', '2nd Semester', '2021');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chat`
--

CREATE TABLE `tbl_chat` (
  `id` int(11) NOT NULL,
  `senderId` text NOT NULL,
  `senderName` text NOT NULL,
  `receiverId` text NOT NULL,
  `message` text NOT NULL,
  `dateTime` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0-read;1-unread'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_chat`
--

INSERT INTO `tbl_chat` (`id`, `senderId`, `senderName`, `receiverId`, `message`, `dateTime`, `status`) VALUES
(1, 'admin', '', '9', 'hey', '2019-07-31 09:32:50 PM', 0),
(4, 'admin', '', '9', 'yooop', '2019-07-31 10:17:25 PM', 0),
(5, 'admin', '', '8', 'Mag enroll kana', '2019-07-31 10:17:25 PM', 0),
(8, '8', '', 'admin', 'yaw q pa', '2019-07-31 11:07:14 PM', 0),
(9, '8', '', 'admin', 'Next week po mam. Sorry po', '2019-07-31 11:11:23 PM', 0),
(10, 'admin', '', '8', 'Okay', '2019-07-31 11:04:08 PM', 0),
(12, 'admin', '', '8', 'Sge ha', '2019-07-31 11:20:25 PM', 0),
(13, 'admin', '', '9', 'hahahaha', '2019-08-01 08:52:28 PM', 0),
(14, '9', '', 'admin', '???', '2019-08-01 08:52:44 PM', 0),
(15, 'admin', '', '7', 'Good Day! You need to submit your newest copy of registration form. Kindly read this information from your EPS Account. Thank you and Congratulatios', '2019-08-02 11:22:18 PM', 0),
(16, '7', '', 'admin', 'Thank you for information. Godbless', '2019-08-02 11:23:13 PM', 0),
(17, 'admin', '', '7', 'Okay. See you!', '2019-08-02 11:22:18 PM', 0),
(18, 'admin', '', '6', 'Good Day! You need to submit your newest copy of registration form. Kindly read this information from your EPS Account. Thank you and Congratulations', '2019-08-04 12:40:54 AM', 0),
(19, '6', '', 'admin', 'Thank you for information. I will submit it as soon as i can.', '2019-08-04 12:41:21 AM', 0),
(20, 'admin', '', '9', 'Wao', '2019-08-17 09:43:48 PM', 0),
(21, '12', '', 'admin', 'Hi po. Wala pa po ba sched ng releasing? Perang pera napo ako e. Thanks po', '2019-09-01 12:23:31 AM', 0),
(22, 'admin', '', '12', 'Nako ineng. Wala pa  e. Sensya kana. Chat nalag ako here if meron na ha.', '2019-09-01 12:24:00 AM', 0),
(23, '12', '', 'admin', 'Okay po. Salamat po. Sensya na po sadyang perang pera na ako', '2019-09-01 12:23:31 AM', 0),
(24, 'admin', '', '12', 'Sgesge. Matulog kana 12 na oh.', '2019-09-01 12:24:00 AM', 0),
(25, '12', '', 'admin', 'ok', '2019-09-01 07:26:03 PM', 0),
(26, '12', '', 'admin', 'Lol', '2019-09-01 07:43:17 PM', 0),
(27, '12', '', 'admin', 'asd', '2019-09-04 08:29:20 PM', 0),
(28, '12', '', 'admin', 'hekhek', '2019-09-04 08:34:39 PM', 0),
(29, 'admin', '', '12', 'asd', '2019-09-04 09:12:31 PM', 0),
(30, 'admin', '', '9', 'Welcome back po. ', '2019-09-12 07:12:07 PM', 0),
(31, '9', '', 'admin', 'Salamat po. Ganda na po ng system chat.', '2019-09-12 07:12:00 PM', 0),
(32, 'admin', '', '14', 'Welcome back John!', '2019-09-27 07:57:36 PM', 0),
(33, '14', '', 'admin', 'Salamat po.', '2019-09-27 07:57:27 PM', 0),
(34, '19', '', 'admin', 'Thanks po', '2019-10-02 09:12:11 PM', 0),
(35, 'admin', '', '19', 'Congrats po', '2019-10-02 09:12:03 PM', 0),
(36, '16', '', 'admin', 'Good afternoon po.', '2019-10-11 01:15:07 PM', 0),
(37, '30', '', 'admin', 'wewe', '2019-10-12 06:30:39 PM', 0),
(38, '30', '', 'admin', 'wwew', '2019-10-12 06:30:39 PM', 0),
(39, '44', '', 'admin', 'asd', '2019-05-19 09:41:25 AM', 0),
(40, '44', '', 'admin', 'Good evening', '2019-05-19 09:41:34 AM', 0),
(41, 'admin', '', '44', 'Hello', '2019-05-19 09:52:17 AM', 0),
(42, '46', '', 'admin', 'hahaha', '2019-06-26 09:26:48 AM', 0),
(43, 'admin', '', '50', 'Tulog na', '2019-10-17 12:34:23 AM', 0),
(44, '50', '', 'admin', 'Di po makatulog e', '2019-10-17 12:23:46 AM', 0),
(45, 'admin', '', '50', 'Di wao', '2019-10-17 12:34:47 AM', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_currentyear`
--

CREATE TABLE `tbl_currentyear` (
  `id` int(11) NOT NULL,
  `schyear` text NOT NULL,
  `semester` text NOT NULL,
  `year` text NOT NULL,
  `status` int(1) NOT NULL COMMENT '0-apply;1-active;2-finished',
  `jhsStatus` int(1) NOT NULL COMMENT '0- can;1-cannot'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_currentyear`
--

INSERT INTO `tbl_currentyear` (`id`, `schyear`, `semester`, `year`, `status`, `jhsStatus`) VALUES
(1, '2019-2020', '2nd Semester', '2021', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_currentyearjh`
--

CREATE TABLE `tbl_currentyearjh` (
  `id` int(11) NOT NULL,
  `schyear` text NOT NULL,
  `year` text NOT NULL,
  `status` int(11) NOT NULL COMMENT '0-apply;1-active;2-finished'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_currentyearjh`
--

INSERT INTO `tbl_currentyearjh` (`id`, `schyear`, `year`, `status`) VALUES
(1, '2018-2019', '2018', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_exam`
--

CREATE TABLE `tbl_exam` (
  `id` int(11) NOT NULL,
  `examtype` int(1) NOT NULL COMMENT '0-jhs;1-shs;2-college',
  `itemcount` int(11) NOT NULL,
  `passingscore` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `mathCount` int(11) NOT NULL,
  `engCount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_exam`
--

INSERT INTO `tbl_exam` (`id`, `examtype`, `itemcount`, `passingscore`, `status`, `mathCount`, `engCount`) VALUES
(9, 1, 20, 15, 1, 10, 10),
(11, 2, 5, 3, 0, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_examevaluation`
--

CREATE TABLE `tbl_examevaluation` (
  `id` int(11) NOT NULL,
  `studentId` int(11) NOT NULL,
  `examresult` text NOT NULL,
  `score` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `schoolyear` text NOT NULL,
  `semester` text NOT NULL,
  `studenttype` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_examevaluation`
--

INSERT INTO `tbl_examevaluation` (`id`, `studentId`, `examresult`, `score`, `remarks`, `schoolyear`, `semester`, `studenttype`) VALUES
(2, 6, 'FAILED', 8, 'not qualified', '2018-2019', '1st Semester', 'Senior High School'),
(3, 3, 'PASSED', 5, 'qualified', '2018-2019', '1st Semester', 'College'),
(4, 5, 'PASSED', 5, 'qualified', '2018-2019', '1st Semester', 'College'),
(5, 2, 'PASSED', 20, 'qualified', '2018-2019', '1st Semester', 'Senior High School'),
(6, 8, 'PASSED', 5, 'qualified', '2018-2019', '1st Semester', 'College'),
(7, 9, 'PASSED', 5, 'qualified', '2018-2019', '1st Semester', 'College'),
(8, 13, 'PASSED', 19, 'qualified', '2018-2019', '1st Semester', 'Senior High School'),
(9, 12, 'FAILED', 1, 'not qualified', '2018-2019', '1st Semester', 'College'),
(10, 14, 'FAILED', 1, 'not qualified', '2018-2019', '1st Semester', 'College'),
(11, 15, 'FAILED', 1, 'not qualified', '2018-2019', '1st Semester', 'College'),
(12, 11, 'FAILED', 0, 'not qualified', '2018-2019', '1st Semester', 'College'),
(13, 18, 'PASSED', 4, 'qualified', '2018-2019', '1st Semester', 'Senior High School'),
(14, 19, 'PASSED', 5, 'qualified', '2018-2019', '1st Semester', 'Senior High School'),
(15, 4, 'FAILED', 1, 'not qualified', '2018-2019', '1st Semester', 'College'),
(16, 17, 'PASSED', 4, 'qualified', '2018-2019', '1st Semester', 'College'),
(17, 20, 'PASSED', 5, 'qualified', '2018-2019', '1st Semester', 'Senior High School'),
(18, 21, 'PASSED', 3, 'qualified', '2018-2019', '1st Semester', 'College'),
(19, 22, 'PASSED', 5, 'qualified', '2018-2019', '1st Semester', 'Senior High School'),
(20, 23, 'PASSED', 5, 'qualified', '2018-2019', '1st Semester', 'Senior High School'),
(21, 24, 'PASSED', 0, 'qualified', '2018-2019', '1st Semester', 'Senior High School'),
(22, 25, 'PASSED', 5, 'qualified', '2018-2019', '1st Semester', 'Senior High School'),
(23, 26, 'PASSED', 3, 'qualified', '2018-2019', '1st Semester', 'College'),
(24, 27, 'PASSED', 5, 'qualified', '2018-2019', '1st Semester', 'Senior High School'),
(25, 28, 'PASSED', 5, 'qualified', '2018-2019', '1st Semester', 'Senior High School'),
(26, 29, 'PASSED', 5, 'qualified', '2018-2019', '1st Semester', 'College'),
(27, 30, 'PASSED', 5, 'qualified', '2018-2019', '2nd Semester', 'Senior High School'),
(28, 31, 'PASSED', 5, 'qualified', '2018-2019', '2nd Semester', 'College'),
(32, 32, 'PASSED', 17, 'qualified', '2019-2020', '1st Semester', 'Senior High School'),
(33, 33, 'FAILED', 0, 'not qualified', '2019-2020', '2nd Semester', 'Senior High School');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_memo`
--

CREATE TABLE `tbl_memo` (
  `id` int(11) NOT NULL,
  `who` text NOT NULL,
  `what` text NOT NULL,
  `whenDate` datetime NOT NULL,
  `wherePlace` text NOT NULL,
  `schyear` text NOT NULL,
  `semester` text NOT NULL,
  `dateAdded` datetime NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_memo`
--

INSERT INTO `tbl_memo` (`id`, `who`, `what`, `whenDate`, `wherePlace`, `schyear`, `semester`, `dateAdded`, `status`) VALUES
(1, 'All', 'EPS Clean N Green Meeting', '2019-11-11 09:00:00', 'Sto. Tomas City Hall', '2018-2019', '1st Semester', '2019-10-17 01:29:21', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_municipalrequirements`
--

CREATE TABLE `tbl_municipalrequirements` (
  `id` int(11) NOT NULL,
  `studentid` int(11) NOT NULL,
  `indigency` text DEFAULT NULL,
  `brgyclearance` text DEFAULT NULL,
  `applicationForm` text DEFAULT NULL,
  `bcert` text DEFAULT NULL,
  `form138` text DEFAULT NULL,
  `goodMoral` text DEFAULT NULL,
  `houseSketch` text DEFAULT NULL,
  `votersId` text DEFAULT NULL,
  `parentCert` text DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_municipalrequirements`
--

INSERT INTO `tbl_municipalrequirements` (`id`, `studentid`, `indigency`, `brgyclearance`, `applicationForm`, `bcert`, `form138`, `goodMoral`, `houseSketch`, `votersId`, `parentCert`, `status`) VALUES
(1, 1, '', 'doc (7).pdf', 'doc (7).pdf', 'doc (7).pdf', 'doc (7).pdf', 'doc (7).pdf', 'doc (7).pdf', 'doc (7).pdf', 'doc (7).pdf', 0),
(2, 2, '', 'SAMPLE.pdf', 'doc (8).pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(3, 3, '', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(4, 4, '', '55533_C_Sharp_Programming.pdf', '55533_C_Sharp_Programming.pdf', '55533_C_Sharp_Programming.pdf', '55533_C_Sharp_Programming.pdf', 'C# - Overview - Tutorialspoint.pdf', '55533_C_Sharp_Programming.pdf', 'C# - Overview - Tutorialspoint.pdf', '55533_C_Sharp_Programming.pdf', 0),
(5, 5, '', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(6, 6, '', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(7, 8, '', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(8, 9, '', 'SAMPLE.pdf', 'doc.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(9, 10, '', 'SAMPLE.pdf', 'doc (10).pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(10, 12, '', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(11, 11, '', 'C# - Overview - Tutorialspoint.pdf', '55533_C_Sharp_Programming.pdf', '55533_C_Sharp_Programming.pdf', 'C# - Overview - Tutorialspoint.pdf', '55533_C_Sharp_Programming.pdf', '55533_C_Sharp_Programming.pdf', '55533_C_Sharp_Programming.pdf', '55533_C_Sharp_Programming.pdf', 0),
(12, 13, '', 'SAMPLE.pdf', 'doc (11).pdf', 'doc (11).pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(13, 14, '', 'SAMPLE.pdf', 'doc (12).pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(14, 15, '', 'SAMPLE.pdf', 'doc.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(15, 16, '', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(16, 18, '', 'SAMPLE.pdf', 'doc (13).pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(17, 17, '', '55533_C_Sharp_Programming.pdf', 'C# - Overview - Tutorialspoint.pdf', '55533_C_Sharp_Programming.pdf', '55533_C_Sharp_Programming.pdf', '55533_C_Sharp_Programming.pdf', 'C# - Overview - Tutorialspoint.pdf', '55533_C_Sharp_Programming.pdf', 'C# - Overview - Tutorialspoint.pdf', 0),
(18, 19, '', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(19, 20, '', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(20, 21, '', 'SAMPLE.pdf', 'doc (14).pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(21, 22, '', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(22, 23, '', 'SAMPLE.pdf', 'doc (15).pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(23, 24, '', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(24, 25, '', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(25, 26, '', 'SAMPLE.pdf', 'doc (16).pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(26, 27, '', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(27, 28, '', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(28, 29, '', 'SAMPLE.pdf', 'doc (17).pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(29, 30, '', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'resume.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(30, 31, '', 'SAMPLE.pdf', 'doc (18).pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(31, 32, NULL, 'brgy clearance.pdf', 'doc (2).pdf', 'a.pdf', 'a.pdf', 'goodMoral.pdf', 'sketch.pdf', 'a.pdf', 'sketch.pdf', 0),
(32, 33, NULL, 'doc.pdf', 'doc.pdf', 'doc.pdf', 'doc.pdf', 'doc.pdf', 'doc.pdf', 'doc.pdf', 'doc.pdf', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_question`
--

CREATE TABLE `tbl_question` (
  `id` int(11) NOT NULL,
  `examtypeid` int(11) NOT NULL,
  `questionnumber` text NOT NULL,
  `question` text NOT NULL,
  `a` text NOT NULL,
  `b` text NOT NULL,
  `c` text NOT NULL,
  `d` text NOT NULL,
  `answer` text NOT NULL,
  `questionCategory` int(1) NOT NULL COMMENT '0-math;1-english',
  `questionType` int(1) NOT NULL COMMENT '0-multiple;1-qA'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_question`
--

INSERT INTO `tbl_question` (`id`, `examtypeid`, `questionnumber`, `question`, `a`, `b`, `c`, `d`, `answer`, `questionCategory`, `questionType`) VALUES
(41, 9, '1', 'Find the product of this equation. 320 * 130', '', '', '', '', '41600', 0, 1),
(42, 9, '2', 'What is the quotient of 3230 divided by 12?', '161.5', '350', '250.25', '163.5', 'A', 0, 0),
(43, 9, '3', 'Find the value of X in  this equation.  x = (320 / 20) * 34 + 36', '680', '496', '580', '583', 'C', 0, 0),
(44, 9, '4', 'The value of x + x(x*x) when x = 2 is:', '', '', '', '', '10', 0, 1),
(45, 9, '5', 'Evaluate this equation. 6x + 5; x=2', '', '', '', '', '17', 0, 1),
(46, 9, '6', 'âˆ’10 + âˆ’3 âˆ’ âˆ’4 + 5', '2', '-12', '-4', '16', 'B', 0, 0),
(47, 9, '7', 'What is 8% of $600?', '$580', '$480', '$48', '$58', 'C', 0, 0),
(48, 9, '8', 'Jo bought a used car for $6000 and paid 15% deposit. How much did he still have to pay?', '$900', '$5000', '$4500', '$5100', 'D', 0, 0),
(49, 9, '9', 'âˆ’ 96 Ã· âˆ’6 Ã· 8 =', '2', '12', '-12', '-2', 'A', 0, 0),
(50, 9, '10', 'What is the 9% of 459?', '', '', '', '', '41.31', 0, 1),
(58, 9, '11', 'I haven\'t got â€¦â€¦', 'no brothers or sisters', 'brothers or sisters', 'any brothers or sisters', 'some brothers and sisters', 'C', 1, 0),
(59, 9, '12', '..... Caviar in the fridge.', ' There isnâ€™t no', 'There is any', 'There isnâ€™t any', 'There arenâ€™t no', 'C', 1, 0),
(60, 9, '13', 'We havenâ€™t got ..... Champagne', 'a lot', ' little', 'too', 'much', 'd', 1, 0),
(61, 9, '14', 'George..... fly to Stockholm tomorrow.', 'to going', 'goes to', 'is going to', 'go to', 'c', 1, 0),
(62, 9, '15', 'We havenâ€™t got ..... mineral water.', 'a lot', ' little', 'too', 'much', 'd', 1, 0),
(64, 9, '16', 'Mark ..... fly to London tomorrow.', 'to going', 'goes to', 'is going to', 'go to', 'C', 1, 0),
(66, 9, '17', 'They â€¦â€¦.. time for lunch', 'hadnâ€™t', 'didn\'t have', 'didnâ€™t have got', 'had not', 'B', 1, 0),
(68, 9, '18', 'I havenâ€™t got â€¦.. ', 'no money.', 'money.', 'any money.', 'some money. ', 'C', 1, 0),
(70, 9, '19', 'I wanted a purple bike but they only had ..... ', 'a one green.', 'one green.', 'a green one.', ' a green.', 'C', 1, 0),
(72, 9, '20', 'He â€¦.. breakfast yesterday', 'hadnâ€™t', 'no had', 'didnâ€™t have got', 'didnâ€™t have', 'D', 1, 0),
(80, 11, '1', 'What is the difference between 300 and 98?', '', '', '', '', '202', 0, 1),
(81, 11, '2', 'Divide : 369 / 3 = ?', '123', '213', '231', '312', 'A', 0, 0),
(82, 11, '3', 'Find the value of N in the given equation. n=34*3.', '101', '102', '103', '104', 'B', 0, 0),
(86, 11, '4', 'What is the verb in this sentence. \"Teddy drives his car to go to church.\".', '', '', '', '', 'drives', 1, 1),
(87, 11, '5', 'What is the opposite word of Negative?', 'Positive', 'Alternative', 'Primitive', 'Quantitative', 'A', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reqstatus`
--

CREATE TABLE `tbl_reqstatus` (
  `id` int(11) NOT NULL,
  `studentId` int(11) NOT NULL,
  `requirements` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_reqstatus`
--

INSERT INTO `tbl_reqstatus` (`id`, `studentId`, `requirements`, `status`) VALUES
(1, 1, 'applicationForm', 0),
(2, 1, 'bcert', 0),
(3, 1, 'form138', 0),
(4, 1, 'goodMoral', 0),
(5, 1, 'brgyclearance', 0),
(6, 1, 'houseSketch', 0),
(7, 1, 'votersId', 0),
(8, 1, 'parentCert', 0),
(9, 1, 'regform', 0),
(10, 1, 'gradecard', 0),
(11, 1, 'schoolid', 0),
(12, 2, 'applicationForm', 1),
(13, 3, 'applicationForm', 1),
(14, 3, 'bcert', 1),
(15, 3, 'form138', 1),
(16, 3, 'goodMoral', 1),
(17, 3, 'brgyclearance', 1),
(18, 3, 'houseSketch', 1),
(19, 3, 'votersId', 1),
(20, 3, 'parentCert', 1),
(21, 3, 'regform', 1),
(22, 3, 'gradecard', 1),
(23, 3, 'schoolid', 1),
(24, 2, 'bcert', 1),
(25, 2, 'form138', 1),
(26, 2, 'goodMoral', 1),
(27, 2, 'brgyclearance', 1),
(28, 2, 'houseSketch', 1),
(29, 2, 'votersId', 1),
(30, 2, 'parentCert', 1),
(31, 2, 'regform', 0),
(32, 2, 'gradecard', 0),
(33, 2, 'schoolid', 0),
(34, 4, 'applicationForm', 1),
(35, 4, 'bcert', 1),
(36, 4, 'form138', 1),
(37, 4, 'goodMoral', 1),
(38, 4, 'brgyclearance', 1),
(39, 4, 'houseSketch', 1),
(40, 4, 'votersId', 1),
(41, 4, 'parentCert', 1),
(42, 4, 'regform', 1),
(43, 4, 'gradecard', 1),
(44, 5, 'applicationForm', 1),
(45, 4, 'schoolid', 1),
(46, 5, 'bcert', 1),
(47, 5, 'form138', 1),
(48, 5, 'goodMoral', 1),
(49, 5, 'brgyclearance', 1),
(50, 5, 'houseSketch', 1),
(51, 5, 'votersId', 1),
(52, 5, 'parentCert', 1),
(53, 5, 'regform', 0),
(54, 5, 'gradecard', 0),
(55, 5, 'schoolid', 0),
(56, 6, 'applicationForm', 1),
(57, 6, 'bcert', 1),
(58, 6, 'form138', 1),
(59, 6, 'goodMoral', 1),
(60, 6, 'brgyclearance', 1),
(61, 6, 'houseSketch', 1),
(62, 6, 'votersId', 1),
(63, 6, 'parentCert', 1),
(64, 6, 'regform', 1),
(65, 6, 'gradecard', 1),
(66, 6, 'schoolid', 1),
(67, 8, 'applicationForm', 1),
(68, 8, 'bcert', 1),
(69, 8, 'form138', 1),
(70, 8, 'goodMoral', 1),
(71, 8, 'brgyclearance', 1),
(72, 8, 'houseSketch', 1),
(73, 8, 'votersId', 1),
(74, 8, 'parentCert', 1),
(75, 8, 'regform', 0),
(76, 8, 'gradecard', 0),
(77, 8, 'schoolid', 0),
(78, 9, 'applicationForm', 1),
(79, 9, 'bcert', 1),
(80, 9, 'form138', 1),
(81, 9, 'goodMoral', 1),
(82, 9, 'brgyclearance', 1),
(83, 9, 'houseSketch', 1),
(84, 9, 'votersId', 1),
(85, 9, 'parentCert', 1),
(86, 9, 'regform', 0),
(87, 9, 'gradecard', 0),
(88, 9, 'schoolid', 0),
(89, 10, 'applicationForm', 1),
(90, 10, 'bcert', 1),
(91, 10, 'form138', 1),
(92, 10, 'goodMoral', 1),
(93, 10, 'brgyclearance', 1),
(94, 10, 'houseSketch', 1),
(95, 10, 'votersId', 1),
(96, 10, 'parentCert', 1),
(97, 10, 'regform', 1),
(98, 10, 'gradecard', 2),
(99, 10, 'schoolid', 1),
(100, 12, 'applicationForm', 1),
(101, 11, 'applicationForm', 1),
(102, 11, 'bcert', 1),
(103, 11, 'form138', 1),
(104, 11, 'goodMoral', 1),
(105, 11, 'brgyclearance', 1),
(106, 12, 'bcert', 1),
(107, 11, 'houseSketch', 1),
(108, 12, 'form138', 1),
(109, 13, 'applicationForm', 1),
(110, 13, 'bcert', 1),
(111, 13, 'form138', 1),
(112, 13, 'goodMoral', 1),
(113, 13, 'brgyclearance', 1),
(114, 13, 'houseSketch', 1),
(115, 13, 'votersId', 1),
(116, 13, 'parentCert', 1),
(117, 13, 'regform', 0),
(118, 13, 'gradecard', 0),
(119, 13, 'schoolid', 0),
(120, 12, 'goodMoral', 1),
(121, 12, 'brgyclearance', 1),
(122, 12, 'houseSketch', 1),
(123, 12, 'votersId', 1),
(124, 12, 'parentCert', 1),
(125, 12, 'regform', 1),
(126, 12, 'gradecard', 1),
(127, 12, 'schoolid', 1),
(128, 14, 'applicationForm', 1),
(129, 14, 'bcert', 1),
(130, 14, 'form138', 1),
(131, 14, 'goodMoral', 1),
(132, 14, 'brgyclearance', 1),
(133, 14, 'houseSketch', 1),
(134, 14, 'votersId', 1),
(135, 14, 'parentCert', 1),
(136, 14, 'regform', 1),
(137, 14, 'gradecard', 1),
(138, 14, 'schoolid', 1),
(139, 15, 'applicationForm', 1),
(140, 15, 'bcert', 1),
(141, 15, 'form138', 1),
(142, 15, 'goodMoral', 1),
(143, 15, 'brgyclearance', 1),
(144, 15, 'houseSketch', 1),
(145, 15, 'votersId', 1),
(146, 15, 'parentCert', 1),
(147, 15, 'regform', 1),
(148, 15, 'gradecard', 1),
(149, 15, 'schoolid', 1),
(150, 11, 'votersId', 1),
(151, 11, 'parentCert', 1),
(152, 11, 'regform', 1),
(153, 11, 'gradecard', 1),
(154, 11, 'schoolid', 1),
(155, 16, 'applicationForm', 1),
(156, 16, 'bcert', 1),
(157, 16, 'form138', 1),
(158, 16, 'goodMoral', 1),
(159, 16, 'brgyclearance', 1),
(160, 16, 'houseSketch', 1),
(161, 16, 'votersId', 1),
(162, 16, 'parentCert', 1),
(163, 16, 'regform', 1),
(164, 16, 'gradecard', 2),
(165, 18, 'applicationForm', 1),
(166, 16, 'schoolid', 1),
(167, 18, 'bcert', 1),
(168, 18, 'form138', 1),
(169, 18, 'goodMoral', 1),
(170, 17, 'goodMoral', 1),
(171, 17, 'applicationForm', 1),
(172, 17, 'bcert', 1),
(173, 18, 'brgyclearance', 1),
(174, 17, 'form138', 1),
(175, 17, 'brgyclearance', 1),
(176, 17, 'houseSketch', 1),
(177, 17, 'votersId', 1),
(178, 17, 'parentCert', 1),
(179, 17, 'regform', 1),
(180, 17, 'gradecard', 1),
(181, 18, 'houseSketch', 1),
(182, 17, 'schoolid', 1),
(183, 18, 'votersId', 1),
(184, 19, 'applicationForm', 1),
(185, 19, 'bcert', 1),
(186, 18, 'parentCert', 1),
(187, 19, 'form138', 1),
(188, 18, 'regform', 0),
(189, 19, 'goodMoral', 1),
(190, 19, 'brgyclearance', 1),
(191, 19, 'houseSketch', 1),
(192, 19, 'votersId', 1),
(193, 19, 'parentCert', 1),
(194, 19, 'regform', 0),
(195, 18, 'gradecard', 0),
(196, 19, 'gradecard', 0),
(197, 19, 'schoolid', 0),
(198, 18, 'schoolid', 0),
(199, 20, 'applicationForm', 1),
(200, 20, 'bcert', 1),
(201, 20, 'form138', 1),
(202, 20, 'goodMoral', 1),
(203, 20, 'brgyclearance', 1),
(204, 20, 'houseSketch', 1),
(205, 20, 'votersId', 1),
(206, 20, 'parentCert', 1),
(207, 20, 'regform', 0),
(208, 20, 'gradecard', 0),
(209, 20, 'schoolid', 0),
(210, 21, 'applicationForm', 1),
(211, 21, 'bcert', 1),
(212, 21, 'form138', 1),
(213, 21, 'goodMoral', 1),
(214, 21, 'brgyclearance', 1),
(215, 21, 'houseSketch', 1),
(216, 21, 'votersId', 1),
(217, 21, 'parentCert', 1),
(218, 21, 'regform', 0),
(219, 21, 'gradecard', 0),
(220, 21, 'schoolid', 0),
(221, 22, 'applicationForm', 1),
(222, 22, 'bcert', 1),
(223, 22, 'form138', 1),
(224, 22, 'goodMoral', 1),
(225, 22, 'brgyclearance', 1),
(226, 22, 'houseSketch', 1),
(227, 22, 'votersId', 1),
(228, 22, 'parentCert', 1),
(229, 22, 'regform', 0),
(230, 22, 'gradecard', 0),
(231, 22, 'schoolid', 0),
(232, 23, 'applicationForm', 1),
(233, 23, 'bcert', 1),
(234, 23, 'form138', 1),
(235, 23, 'goodMoral', 1),
(236, 24, 'applicationForm', 1),
(237, 24, 'bcert', 1),
(238, 23, 'brgyclearance', 1),
(239, 24, 'form138', 1),
(240, 23, 'houseSketch', 1),
(241, 24, 'goodMoral', 1),
(242, 23, 'votersId', 1),
(243, 24, 'brgyclearance', 1),
(244, 23, 'parentCert', 1),
(245, 24, 'houseSketch', 1),
(246, 23, 'regform', 0),
(247, 24, 'votersId', 1),
(248, 23, 'gradecard', 0),
(249, 23, 'schoolid', 0),
(250, 24, 'parentCert', 1),
(251, 24, 'regform', 0),
(252, 24, 'gradecard', 0),
(253, 24, 'schoolid', 0),
(254, 25, 'applicationForm', 0),
(255, 25, 'bcert', 0),
(256, 25, 'form138', 0),
(257, 25, 'goodMoral', 0),
(258, 25, 'brgyclearance', 0),
(259, 25, 'houseSketch', 0),
(260, 25, 'votersId', 0),
(261, 25, 'parentCert', 0),
(262, 25, 'regform', 0),
(263, 25, 'gradecard', 0),
(264, 25, 'schoolid', 0),
(265, 26, 'applicationForm', 1),
(266, 26, 'bcert', 1),
(267, 26, 'form138', 1),
(268, 26, 'goodMoral', 1),
(269, 26, 'brgyclearance', 1),
(270, 26, 'houseSketch', 1),
(271, 26, 'votersId', 1),
(272, 26, 'parentCert', 1),
(273, 26, 'regform', 1),
(274, 26, 'gradecard', 1),
(275, 26, 'schoolid', 1),
(276, 27, 'applicationForm', 1),
(277, 27, 'bcert', 1),
(278, 27, 'form138', 1),
(279, 27, 'goodMoral', 1),
(280, 27, 'brgyclearance', 1),
(281, 27, 'houseSketch', 1),
(282, 27, 'votersId', 1),
(283, 27, 'parentCert', 1),
(284, 27, 'regform', 0),
(285, 27, 'gradecard', 0),
(286, 27, 'schoolid', 0),
(287, 28, 'applicationForm', 1),
(288, 28, 'bcert', 1),
(289, 29, 'applicationForm', 1),
(290, 28, 'form138', 1),
(291, 29, 'bcert', 1),
(292, 28, 'goodMoral', 1),
(293, 28, 'brgyclearance', 1),
(294, 28, 'houseSketch', 1),
(295, 28, 'votersId', 1),
(296, 29, 'form138', 1),
(297, 28, 'parentCert', 1),
(298, 29, 'goodMoral', 1),
(299, 28, 'regform', 0),
(300, 29, 'brgyclearance', 1),
(301, 28, 'gradecard', 0),
(302, 29, 'houseSketch', 1),
(303, 28, 'schoolid', 0),
(304, 29, 'votersId', 1),
(305, 29, 'parentCert', 1),
(306, 29, 'regform', 0),
(307, 29, 'gradecard', 0),
(308, 29, 'schoolid', 0),
(309, 30, 'applicationForm', 1),
(310, 30, 'bcert', 1),
(311, 30, 'form138', 1),
(312, 30, 'goodMoral', 1),
(313, 30, 'brgyclearance', 1),
(314, 30, 'houseSketch', 1),
(315, 30, 'votersId', 1),
(316, 30, 'parentCert', 1),
(317, 30, 'regform', 1),
(318, 30, 'gradecard', 1),
(319, 30, 'schoolid', 1),
(320, 31, 'applicationForm', 1),
(321, 31, 'bcert', 1),
(322, 31, 'form138', 1),
(323, 31, 'goodMoral', 1),
(324, 31, 'brgyclearance', 1),
(325, 31, 'houseSketch', 1),
(326, 31, 'votersId', 1),
(327, 31, 'parentCert', 1),
(328, 31, 'regform', 1),
(329, 31, 'gradecard', 1),
(330, 31, 'schoolid', 1),
(331, 32, 'applicationForm', 1),
(332, 32, 'bcert', 1),
(333, 32, 'form138', 1),
(334, 32, 'goodMoral', 1),
(335, 32, 'brgyclearance', 1),
(336, 32, 'houseSketch', 1),
(337, 32, 'votersId', 1),
(338, 32, 'parentCert', 1),
(339, 32, 'regform', 1),
(340, 32, 'gradecard', 1),
(341, 32, 'schoolid', 1),
(342, 33, 'applicationForm', 0),
(343, 33, 'bcert', 0),
(344, 33, 'form138', 0),
(345, 33, 'goodMoral', 0),
(346, 33, 'brgyclearance', 0),
(347, 33, 'houseSketch', 0),
(348, 33, 'votersId', 0),
(349, 33, 'parentCert', 0),
(350, 33, 'regform', 0),
(351, 33, 'gradecard', 0),
(352, 33, 'schoolid', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schedule`
--

CREATE TABLE `tbl_schedule` (
  `id` int(11) NOT NULL,
  `studentlevel` int(1) NOT NULL,
  `forWhat` text NOT NULL,
  `schyear` text NOT NULL,
  `sem` text NOT NULL,
  `schedDate` date NOT NULL,
  `schedTime` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_schedule`
--

INSERT INTO `tbl_schedule` (`id`, `studentlevel`, `forWhat`, `schyear`, `sem`, `schedDate`, `schedTime`, `status`) VALUES
(6, 1, 'Examination', '2019-2020', '1st Semester', '2019-11-04', '10:00 AM', 1),
(7, 1, 'Examination', '2019-2020', '2nd Semester', '2021-03-11', '07:00 PM', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_scholarhistory`
--

CREATE TABLE `tbl_scholarhistory` (
  `id` int(11) NOT NULL,
  `studentId` int(11) NOT NULL,
  `studenttype` text NOT NULL,
  `schoolyear` text NOT NULL,
  `sem` text NOT NULL,
  `yearOrgrade` text NOT NULL,
  `schoolid` int(11) NOT NULL,
  `gwa` text NOT NULL,
  `scholartype` int(1) NOT NULL COMMENT '0-full; 1-assistance',
  `grantprice` text NOT NULL,
  `year` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_scholarhistory`
--

INSERT INTO `tbl_scholarhistory` (`id`, `studentId`, `studenttype`, `schoolyear`, `sem`, `yearOrgrade`, `schoolid`, `gwa`, `scholartype`, `grantprice`, `year`) VALUES
(2, 13, 'Senior High School', '2018-2019', '1st Semester', 'Grade 11', 17, '85', 0, '7000', '2018'),
(3, 9, 'College', '2018-2019', '1st Semester', '4th Year', 18, '85', 0, '7000', '2018'),
(4, 8, 'College', '2018-2019', '1st Semester', '3rd Year', 17, '89', 0, '7000', '2018'),
(5, 5, 'College', '2018-2019', '1st Semester', '2nd Year', 18, '90', 0, '7000', '2018'),
(6, 3, 'College', '2018-2019', '1st Semester', '1st Year', 18, '89', 0, '7000', '2018'),
(7, 2, 'Senior High School', '2018-2019', '1st Semester', 'Grade 12', 17, '89', 1, '5000', '2018'),
(8, 29, 'College', '2018-2019', '1st Semester', '3rd Year', 27, '90', 0, '7000', '2018'),
(9, 28, 'Senior High School', '2018-2019', '1st Semester', 'Grade 11', 17, '85', 1, '5000', '2018'),
(10, 27, 'Senior High School', '2018-2019', '1st Semester', 'Grade 11', 18, '90', 1, '5000', '2018'),
(11, 26, 'College', '2018-2019', '1st Semester', '3rd Year', 18, '90', 0, '7000', '2018'),
(12, 25, 'Senior High School', '2018-2019', '1st Semester', 'Grade 12', 34, '85', 1, '5000', '2018'),
(13, 24, 'Senior High School', '2018-2019', '1st Semester', 'Grade 11', 17, '89', 0, '', '2018'),
(14, 23, 'Senior High School', '2018-2019', '1st Semester', 'Grade 12', 17, '89', 1, '', '2018'),
(15, 22, 'Senior High School', '2018-2019', '1st Semester', 'Grade 12', 17, '85', 1, '5000', '2018'),
(16, 21, 'College', '2018-2019', '1st Semester', '4th Year', 18, '85', 0, '7000', '2018'),
(17, 20, 'Senior High School', '2018-2019', '1st Semester', 'Grade 12', 27, '85', 1, '5000', '2018'),
(18, 19, 'Senior High School', '2018-2019', '1st Semester', 'Grade 11', 34, '85', 1, '5000', '2018'),
(19, 18, 'Senior High School', '2018-2019', '1st Semester', 'Grade 12', 17, '89', 1, '5000', '2018'),
(20, 17, 'College', '2018-2019', '1st Semester', '4th Year', 27, '85', 0, '7000', '2018'),
(21, 29, 'College', '2018-2019', '2nd Semester', '3rd Year', 27, '85', 0, '7000', '2019'),
(22, 8, 'College', '2018-2019', '2nd Semester', '3rd Year', 17, '85', 0, '', '2019'),
(23, 2, 'Senior High School', '2018-2019', '2nd Semester', 'Grade 12', 17, '85', 1, '5000', '2019'),
(24, 9, 'College', '2018-2019', '2nd Semester', '4th year', 18, '88', 0, '', '2019'),
(25, 13, 'Senior High School', '2018-2019', '2nd Semester', 'Grade 11', 17, '85', 0, '7000', '2019'),
(26, 18, 'Senior High School', '2018-2019', '2nd Semester', 'Grade 12', 17, '85', 1, '5000', '2019'),
(27, 19, 'Senior High School', '2018-2019', '2nd Semester', 'Grade 11', 34, '82', 1, '5000', '2019'),
(28, 20, 'Senior High School', '2018-2019', '2nd Semester', 'Grade 12', 27, '82', 1, '5000', '2019'),
(29, 21, 'College', '2018-2019', '2nd Semester', '4th year', 18, '85', 0, '', '2019'),
(30, 22, 'Senior High School', '2018-2019', '2nd Semester', 'Grade 12', 17, '82', 1, '5000', '2019'),
(31, 23, 'Senior High School', '2018-2019', '2nd Semester', 'Grade 12', 17, '85', 1, '5000', '2019'),
(32, 24, 'Senior High School', '2018-2019', '2nd Semester', 'Grade 11', 17, '83', 0, '', '2019'),
(33, 25, 'Senior High School', '2018-2019', '2nd Semester', 'Grade 12', 34, '83', 1, '5000', '2019'),
(34, 27, 'Senior High School', '2018-2019', '2nd Semester', 'Grade 11', 18, '95', 1, '5000', '2019'),
(35, 28, 'Senior High School', '2018-2019', '2nd Semester', 'Grade 11', 17, '80', 1, '5000', '2019'),
(36, 31, 'College', '2018-2019', '2nd Semester', '2nd Year', 16, '85', 0, '7000', '2019'),
(37, 30, 'Senior High School', '2018-2019', '2nd Semester', 'Grade 11', 18, '85', 1, '5000', '2019');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_school`
--

CREATE TABLE `tbl_school` (
  `id` int(11) NOT NULL,
  `schoolname` text NOT NULL,
  `schoolalias` text NOT NULL,
  `class` int(1) NOT NULL COMMENT '0-public;1-semiprivate;2-private',
  `dateadded` date NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0 COMMENT '0 active;1 inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_school`
--

INSERT INTO `tbl_school` (`id`, `schoolname`, `schoolalias`, `class`, `dateadded`, `status`) VALUES
(15, 'Alaminos National High School', 'Alaminos NHS', 0, '2019-06-15', 0),
(16, 'Batangas State University Malvar Campus', 'BatStateU Malvar', 1, '2019-06-15', 0),
(17, 'Tanauan Institute', 'TI', 1, '2019-06-15', 0),
(18, 'Christian College of Tanauan', 'CCT', 2, '2019-06-15', 0),
(19, 'Almond Academy', 'Almond', 2, '2019-06-15', 0),
(20, 'Anihan Tech School', 'Anihan', 1, '2019-06-15', 0),
(21, 'APEC School', 'APEC', 0, '2019-06-15', 0),
(22, 'Bauan Tech School', 'BTS', 0, '2019-06-15', 0),
(23, 'Blue Isle Integrated School', 'BIIS', 1, '2019-06-15', 0),
(24, 'Card MRI Institute', 'Card MRI', 0, '2019-06-15', 0),
(25, 'De La Salle Lipa', 'La Salle', 2, '2019-06-15', 0),
(26, 'Don Bosco College', 'Don Bosco', 1, '2019-06-15', 0),
(27, 'First Asia Institute of Technology and Humanitites', 'FAITH', 2, '2019-06-15', 0),
(28, 'Jesus Is Lord Christian School', 'JIL', 2, '2019-06-15', 0),
(29, 'Greenville Academy', 'Greenville', 2, '2019-06-15', 0),
(30, 'National University', 'NU', 2, '2019-06-21', 0),
(31, 'Polytechnic University of the Philippines', 'PUP', 0, '2018-06-04', 0),
(32, 'San Pedro National High School', 'SPNHS', 0, '2019-10-16', 0),
(33, 'Sta Anastacia-San Rafael National High School', 'STSRNHS', 0, '2019-10-16', 0),
(34, 'Saint Thomas Academy', 'STA', 2, '2019-10-17', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schoolrequirements`
--

CREATE TABLE `tbl_schoolrequirements` (
  `id` int(11) NOT NULL,
  `studentId` int(11) NOT NULL,
  `schoolyear` text DEFAULT NULL,
  `semester` text DEFAULT NULL,
  `regform` text DEFAULT NULL,
  `gradecard` text DEFAULT NULL,
  `schoolid` text DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_schoolrequirements`
--

INSERT INTO `tbl_schoolrequirements` (`id`, `studentId`, `schoolyear`, `semester`, `regform`, `gradecard`, `schoolid`, `status`) VALUES
(1, 1, '2018-2019', '1st Semester', 'doc (7).pdf', 'doc (7).pdf', 'doc (7).pdf', 0),
(2, 3, '2018-2019', '1st Semester', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(3, 2, '2018-2019', '1st Semester', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(4, 4, '2018-2019', '1st Semester', '55533_C_Sharp_Programming.pdf', 'C# - Overview - Tutorialspoint.pdf', '55533_C_Sharp_Programming.pdf', 0),
(5, 5, '2018-2019', '1st Semester', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(6, 6, '2018-2019', '1st Semester', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(7, 8, '2018-2019', '1st Semester', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(8, 9, '2018-2019', '1st Semester', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(9, 10, '2018-2019', '1st Semester', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(10, 13, '2018-2019', '1st Semester', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(11, 12, '2018-2019', '1st Semester', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(12, 14, '2018-2019', '1st Semester', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(13, 15, '2018-2019', '1st Semester', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(14, 11, '2018-2019', '1st Semester', 'doc.pdf', '55533_C_Sharp_Programming.pdf', '55533_C_Sharp_Programming.pdf', 0),
(15, 16, '2018-2019', '1st Semester', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(16, 17, '2018-2019', '1st Semester', '55533_C_Sharp_Programming.pdf', '55533_C_Sharp_Programming.pdf', 'C# - Overview - Tutorialspoint.pdf', 0),
(17, 18, '2018-2019', '1st Semester', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(18, 19, '2018-2019', '1st Semester', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(19, 20, '2018-2019', '1st Semester', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(20, 21, '2018-2019', '1st Semester', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(21, 22, '2018-2019', '1st Semester', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(22, 23, '2018-2019', '1st Semester', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(23, 24, '2018-2019', '1st Semester', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(24, 25, '2018-2019', '1st Semester', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(25, 26, '2018-2019', '1st Semester', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(26, 27, '2018-2019', '1st Semester', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(27, 28, '2018-2019', '1st Semester', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(28, 29, '2018-2019', '1st Semester', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(29, 29, '2018-2019', '2nd Semester', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(30, 5, '2018-2019', '2nd Semester', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(31, 8, '2018-2019', '2nd Semester', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(32, 9, '2018-2019', '2nd Semester', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(33, 25, '2018-2019', '2nd Semester', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(34, 27, '2018-2019', '2nd Semester', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(35, 28, '2018-2019', '2nd Semester', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(36, 22, '2018-2019', '2nd Semester', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(37, 24, '2018-2019', '2nd Semester', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(38, 2, '2018-2019', '2nd Semester', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(39, 20, '2018-2019', '2nd Semester', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(40, 19, '2018-2019', '2nd Semester', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(41, 13, '2018-2019', '2nd Semester', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(42, 18, '2018-2019', '2nd Semester', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(43, 21, '2018-2019', '2nd Semester', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(44, 23, '2018-2019', '2nd Semester', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(45, 30, '2018-2019', '2nd Semester', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(46, 31, '2018-2019', '2nd Semester', 'SAMPLE.pdf', 'SAMPLE.pdf', 'SAMPLE.pdf', 0),
(47, 32, '2019-2020', '1st Semester', 'sample.pdf', 'dummy.pdf', 'regform.pdf', 0),
(48, 33, '2019-2020', '2nd Semester', 'doc.pdf', 'doc.pdf', 'doc.pdf', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_siblingscholar`
--

CREATE TABLE `tbl_siblingscholar` (
  `id` int(11) NOT NULL,
  `studentId` int(11) NOT NULL,
  `siblingName` text NOT NULL,
  `scholarship` text NOT NULL,
  `courseYear` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student`
--

CREATE TABLE `tbl_student` (
  `id` int(11) NOT NULL,
  `picture` text NOT NULL,
  `firstname` text NOT NULL,
  `middlename` text NOT NULL,
  `surname` text NOT NULL,
  `address` text NOT NULL,
  `bday` date NOT NULL,
  `age` int(11) NOT NULL,
  `bplace` text NOT NULL,
  `contactno` text NOT NULL,
  `email` text NOT NULL,
  `lastSchoolAttended` text NOT NULL,
  `lastSchoolAddress` text NOT NULL,
  `highestYear` text NOT NULL,
  `lastGwa` text NOT NULL,
  `schoolEntranceExam` text NOT NULL,
  `gender` text NOT NULL,
  `religion` text NOT NULL,
  `citizenship` text NOT NULL,
  `fathername` text NOT NULL,
  `fathereduc` text DEFAULT NULL,
  `fatherwork` text NOT NULL,
  `mothername` text NOT NULL,
  `mothereduc` text DEFAULT NULL,
  `motherwork` text DEFAULT NULL,
  `parentsAddress` text NOT NULL,
  `totalFamMember` int(11) NOT NULL,
  `brothers` int(11) NOT NULL,
  `sisters` int(11) NOT NULL,
  `grosspermonth` text NOT NULL,
  `otherScholarship` text NOT NULL,
  `studenttype` text NOT NULL,
  `semester` text NOT NULL,
  `schoolyear` text NOT NULL,
  `school` int(11) NOT NULL,
  `course` text NOT NULL,
  `yearOrgrade` text NOT NULL,
  `dateapplied` date NOT NULL,
  `examDate` text DEFAULT NULL,
  `interviewDate` text DEFAULT NULL,
  `year` text NOT NULL,
  `month` text NOT NULL,
  `gwa` text DEFAULT NULL,
  `declineReason` text DEFAULT NULL,
  `renewalDeclineReason` text DEFAULT NULL,
  `withBagsak` int(1) NOT NULL DEFAULT 0 COMMENT '0-wala;1-meron',
  `status` int(2) NOT NULL DEFAULT 0 COMMENT '0-pending;1-forExam;2-forInterview;3-decline;4-scholar;5-examFailed;6-forApproval;7-rescholar;8-forRenewal;9-declineRenewal',
  `scholarType` int(1) NOT NULL DEFAULT 0 COMMENT '0-full;1-assistance',
  `grantprice` text DEFAULT NULL,
  `sibling1` text NOT NULL,
  `sibling1Scholarship` text NOT NULL,
  `sibling1CourseYear` text NOT NULL,
  `sibling2` text NOT NULL,
  `sibling2Scholarship` text NOT NULL,
  `sibling2CourseYear` text NOT NULL,
  `sibling3` text NOT NULL,
  `sibling3Scholarship` text NOT NULL,
  `sibling3CourseYear` text NOT NULL,
  `fatherAge` text NOT NULL,
  `motherAge` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_student`
--

INSERT INTO `tbl_student` (`id`, `picture`, `firstname`, `middlename`, `surname`, `address`, `bday`, `age`, `bplace`, `contactno`, `email`, `lastSchoolAttended`, `lastSchoolAddress`, `highestYear`, `lastGwa`, `schoolEntranceExam`, `gender`, `religion`, `citizenship`, `fathername`, `fathereduc`, `fatherwork`, `mothername`, `mothereduc`, `motherwork`, `parentsAddress`, `totalFamMember`, `brothers`, `sisters`, `grosspermonth`, `otherScholarship`, `studenttype`, `semester`, `schoolyear`, `school`, `course`, `yearOrgrade`, `dateapplied`, `examDate`, `interviewDate`, `year`, `month`, `gwa`, `declineReason`, `renewalDeclineReason`, `withBagsak`, `status`, `scholarType`, `grantprice`, `sibling1`, `sibling1Scholarship`, `sibling1CourseYear`, `sibling2`, `sibling2Scholarship`, `sibling2CourseYear`, `sibling3`, `sibling3Scholarship`, `sibling3CourseYear`, `fatherAge`, `motherAge`) VALUES
(2, 'received_707924436386864.jpeg', 'Angela', 'Roxas', 'Domingo', 'San Jose', '1997-09-10', 20, 'Sto.Tomas Batangas', '09263465421', 'Angela@gmail.com', 'San Jose National High School', 'Sto.Tomas Batangas', 'Grade 11', '80', '85', 'Female', 'Catholic', 'Filipino', 'Benidict Domingo', '', 'Factory Worker', 'Jenny', '', 'House Wife', 'Brgy. San Jose Sto.Tomas Batangas', 5, 1, 2, '5000', 'n/a', 'Senior High School', '2nd Semester', '2018-2019', 17, ' STEM', 'Grade 12', '2018-08-06', '2018-08-07 10:00:00', '2018-08-08 10:00:00', '2018', '08', '85', '', '', 0, 10, 1, '5000', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', '50', '48'),
(3, 'download.jfif', 'Justin', 'Ocampo', 'Manset', 'San Antonio', '1998-06-12', 21, 'San Antonio Sto Tomas Batangas', '09125465547', 'jessa@gmail.com', 'San Pedro National High School', 'San Pedro National School', 'Grade 12 ', '80', '80', 'Female', 'Catholic', 'Filipino', 'Antonio Manset', '', 'Vendor', 'Maria', '', 'Vendor', 'San Antonio Sto Tomas Batangas', 5, 3, 2, '10000', 'n/a', 'College', '1st Semester', '2018-2019', 18, ' BS Computer Science', '1st Year', '2018-08-06', '2018-08-07 10:00:00', '2018-08-08 10:00:00', '2018', '08', '89', '', '', 0, 10, 0, '7000', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', '51', '49'),
(4, '2x2.JPG', 'Lovely Joy ', 'Navarette', 'Manaois', 'San Felix', '1997-09-03', 22, 'San felix', '0919957351', 'love.Joy@gmail.com', 'San Pedro National High School', 'San. Pedro Sto. Tomas', '4th year', '92', '80', 'Female', 'Roman Catholic', 'Filipino', 'Ronilo Manaois', '', 'none', 'Rodelyn Manaois', '', 'none', 'Bitin Bay Laguna', 2, 0, 0, '15000', 'n/a', 'College', '1st Semester', '2018-2019', 16, ' BS Information Technology', '4th Year', '2018-08-06', '2018-08-07 10:00:00', '', '2018', '08', '90', '', '', 0, 5, 0, '', ' none', 'none', 'none', 'none', 'none', 'none', 'none', 'none', 'none', '45', '42'),
(5, 'images.jfif', 'Ella', 'Morales', 'Ocampo', 'San Miguel', '1997-05-24', 22, 'San Miguel Sto Tomas Batangas', '09129667698', 'Ella@gmail.com', 'Saint Tomas Academy', 'Sto Tomas Batangas', '1st Year', '79', '75', 'Female', 'Catholic', 'Filipino', 'Luis Ocampo', '', 'Police', 'Leny Ocampo', '', 'Teacher', 'San Miguel', 6, 2, 2, '12000', 'n/a', 'College', '2nd Semester', '2018-2019', 18, ' BS Information Technology', '2nd Year', '2018-08-06', '2018-08-07 10:00:00', '2018-08-08 10:00:00', '2018', '08', '88', '', 'did not meet the maintaining grade!', 0, 9, 0, '7000', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '44', '42'),
(6, 'received_2459145837742712.jpeg', 'Jeremy', 'Mendoza', 'Manalo', 'San Felix', '1998-10-17', 19, 'San Pablo City', '0918323726', 'Jeremy@gmail.com', 'San Pedro', 'San Pedro Sto.Tomas Batangas', 'Grade 11', '80', '85', 'Male', 'Catholic', 'Filipino', 'Angelo Manalo', '', 'Manager', 'Angeline', '', 'Designer', 'San Felix Sto.Tomas Batangas', 6, 2, 1, '10000', 'n/a', 'Senior High School', '1st Semester', '2018-2019', 18, ' HUMSS', 'Grade 11', '2018-08-06', '2018-08-07 10:00:00', '', '2018', '08', '85', '', '', 0, 5, 0, '', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', '45', '40'),
(7, 'received_736319146779845.jpeg', 'Zoldyck', 'Killua', 'Jaeger', 'San Francisco', '2001-12-08', 17, 'Manila', '09395515814', 'Zoldyck.Killua@gmail.com', 'BLMCS', 'Darasa Tanauan Batangas', 'HighSchool', '87', '80', 'Male', 'Roman Catholic', 'Filipino', 'Frank jaeger', '', 'Engineer', 'Luna Jaeger', '', 'None', 'Tanauan City', 3, 0, 0, '10000', 'n/a', 'College', '1st Semester', '2018-2019', 28, 'BS Information Technology', '1st Year', '2018-08-06', '', '', '2018', '08', '', '', '', 0, 0, 0, '', ' none', ' none', ' none', ' none', ' none', ' none', ' none', ' none', ' none', '49', '39'),
(8, 'images (1).jfif', 'Joan ', 'Y', 'Perez', 'San Jose', '2000-06-05', 19, 'San Jose Sto Tomas Batangas', '09127687959', 'joan@gmail.com', 'San Jose National High School', 'San Jose Sto Tomas Batangas', '2nd Year', '80', '75', 'Female', 'Catholic', 'Filipino', 'Joseph Perez', '', 'Engineer', 'Jessy Perez', '', 'Accountant', 'San Jose Sto Tomas Batangas', 3, 0, 1, '20000', 'n/a', 'College', '2nd Semester', '2018-2019', 17, ' BS Computer Science', '3rd Year', '2018-08-06', '', '2018-08-08 10:00:00', '2018', '08', '85', '', '', 0, 10, 0, '', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', '31', '30'),
(9, 'tumblr_ogw26dCy7A1smd799o1_1280.jpg', 'Joseph', 'Mana', 'Ocampo', 'San Pedro', '1997-08-09', 22, 'San Pedro Sto Tomas Batangas', '091293012', 'joseph@gmail,com', 'San Pedro Sto National Hign School', 'San Pedro Sto Tomas Batangas', '3rd Year', '79', '75', 'Male', 'Catholic', 'Filipino', 'Felix Ocampo', '', 'Sewer', 'Patrici', '', 'Sewer', 'San Pedro Sto Tomas Batngas', 7, 3, 2, '14000', 'n/a', 'College', '2nd Semester', '2018-2019', 18, 'BS Information Technology', '4th year', '2018-08-07', '', '2018-08-08 10:00:00', '2018', '08', '88', '', '', 0, 10, 0, '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '36', '39'),
(10, 'received_2423500611234243.png', 'Mary jane', 'Meera', 'Marques', 'San Juan', '1995-08-24', 22, 'Tanauan City', '09243546712', 'mary@gmail.com', 'FAITH', 'Darasa,  Tanauan City', 'Grade 11', '80', '85', 'Female', 'Catholic', 'Filipino', 'Mike Marques', '', 'OFW', 'Melinda Marques', '', 'OFW', 'San Juan Sto,tomas Batangas', 7, 3, 2, '10000', 'n/a', 'Senior High School', '1st Semester', '2018-2019', 27, ' STEM', 'Grade 12', '2018-08-07', '', '', '2018', '08', '', 'didn\'t meet the passing grade! thank you!', '', 0, 3, 0, '', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', '49', '45'),
(11, 'IMG_2331.JPG', 'Arvin ', 'Hernandez', 'Valenzuela', 'Santa Elena', '1996-09-27', 23, 'Santa Elena', '09396133075', 'Arvin.valenzuela@gmail.com', 'Sn pedro National High School', 'Sn pedro Sto.Tomas', 'Highschool', '90', '80', 'Male', 'Catholic', 'Filipino', 'Ron Valenzuela', '', 'none', 'Linda Valenzuela', '', 'House wife', 'Santa Elena STB', 10, 4, 4, '15000', 'none', 'College', '1st Semester', '2018-2019', 17, ' BSBA', '4th Year', '2018-08-07', '', '', '2018', '08', '85', '', '', 0, 5, 0, '', ' none', 'none', 'none', ' none', 'none', 'none', 'none', 'none', 'none', '49', '49'),
(12, 'images.jfif', 'Nathan', 'Migo', 'Onse', 'San Vicente', '1999-12-12', 19, 'San Vicente Sto Tomas Batangas', '09126575431', 'nathan@gmail.com', 'San Pedro National High School', 'San Pedro Sto Tomas Batangas', '3rd Year', '85', '75', 'Male', 'Catholic', 'Filipino', 'Kim Onse', '', 'Decease', 'Gemma Onse', '', 'Decease', 'San Vicente Sto Tomas Batangas', 3, 0, 0, '12000', 'n/a', 'College', '1st Semester', '2018-2019', 27, ' BS Education', '4th Year', '2018-08-07', '', '', '2018', '08', '89', '', '', 0, 5, 0, '', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', '42', '39'),
(13, 'received_820632838395755.jpeg', 'Argellaine', 'Santiago', 'Mitra', 'San Pedro', '1999-03-08', 19, 'San Pablo City', '09823827323', 'arge@gmail.com', 'San Pedro National High School', 'San Pedro Sto.Tomas Batangas', 'Grade 11', '80', '88', 'Female', 'Catholic', 'Filipino', 'Berto Mitra', '', 'Scaffolder', 'Diana Mitra', '', 'House Wife', 'San Pedro Sto.Tomas Batangas', 8, 2, 4, '70000', 'n/a', 'Senior High School', '2nd Semester', '2018-2019', 17, ' BS Criminology', 'Grade 11', '2018-08-07', '', '2018-08-08 10:00:00', '2018', '08', '85', '', '', 0, 10, 0, '7000', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', '44', '40'),
(14, 'received_2491477514464959.jpeg', 'Joy', 'Angeles', 'Arcillas', 'San Miguel', '1997-11-30', 20, 'San Pablo City', '09878534523', 'joy@gmail.com', 'Batangas State University', 'Malvar Batangas', 'Grade 12', '85', '85', 'Female', 'Catholic', 'Filipino', 'Jericho Arcillas', '', 'First Aider', 'Janice Arcillas', '', 'OFW', 'San Miguel ', 6, 1, 3, '10000', 'n/a', 'College', '1st Semester', '2018-2019', 16, 'BS Computer Science', '4th Year', '2018-08-07', '', '', '2018', '08', '85', '', '', 0, 5, 0, '', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', '39', '35'),
(15, '1x1.jpg', 'Kim', 'Reyes', 'Villegas', 'San Isidro Sur', '1999-09-13', 20, 'Sto Tomas', '09121261112', 'kim@yahoo.com', 'Polytecnic University of the Philippines', 'Sto Tomas Batangas', '2nd Year', '80', '80', 'Female', 'INC', 'Filipino', 'Fred Villegas', '', 'House Wife', 'Alex Villegas', '', 'Domestic Helper', 'San Pedro Sto Tomas Batngas', 5, 2, 1, '18000', 'n/a', 'College', '1st Semester', '2018-2019', 31, ' BS Entrep', '3rd Year', '2018-08-07', '', '', '2018', '08', '85', '', '', 0, 5, 0, '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '53', '44'),
(16, 'download (1).jfif', 'Khiara', 'Ocfemia', 'Federico', 'San Miguel', '2000-01-08', 19, 'San Miguel Sto Tomas Batangas', '09121233122', 'Khiara@yahoo.com', 'San Pedro National High School', 'San Pedro Sto Tomas Batangas', 'Grade 10', '85', '80', 'Male', 'Born Again', 'Filipino', 'Ronald Federico', '', 'STL', 'Gemma Federico', '', 'House Wife', 'San Miguel Sto Tomas Batangas', 4, 1, 1, '12000', 'n/a', 'Senior High School', '1st Semester', '2018-2019', 34, ' STEM', 'Grade 11', '2018-08-07', '', '', '2018', '08', '', 'didn\'t the meet the Required GWA .', '', 0, 3, 0, '', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', '33', '30'),
(17, 'received_1891393844338780.jpeg', 'Angela', 'Navarette', 'floria', 'San Felix', '1997-01-24', 22, 'San Felix STB', '09563179244', 'angel.floria@gmail.com', 'Bitin National Highschool', 'Bitin Bay Laguna', 'Highschool', '90', '80', 'Female', 'Roman Catholic', 'Filipino', 'Jeffrey Floria', '', 'OFW', 'Analyn Floria', '', 'House wife', 'Bitin Bay Laguna', 5, 0, 1, '15000', 'none', 'College', '1st Semester', '2018-2019', 27, ' BSBA', '4th Year', '2018-08-07', '', '2018-08-10 10:00:00', '2018', '08', '85', '', '', 0, 10, 0, '', ' none', 'none', 'none', 'none', 'none', 'none', 'none', 'none', 'none', '42', '40'),
(18, 'received_793577971103173.jpeg', 'Marize', 'Dela Cruz', 'Malolos', 'Poblacion 4', '1995-10-25', 22, 'San Pablo City', '09087545677', 'marize@gmail.com', 'Tanauan Institute', 'Tanauan Batangas', 'Grade 11', '82', '80', 'Female', 'Catholic', 'Filipino', 'Joey Malolos', '', 'Manager', 'Janine Malolos', '', 'House Wife', 'Poblacion 4 Sto.Tomas Batangas', 8, 4, 2, '10000', 'n/a', 'Senior High School', '2nd Semester', '2018-2019', 17, ' AMB', 'Grade 12', '2018-08-07', '', '2018-08-10 10:00:00', '2018', '08', '85', '', '', 0, 10, 1, '5000', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', '42', '40'),
(19, 'images (6).jfif', 'Ayesha', 'Migo', 'Tolentino', 'San Antonio', '2000-09-21', 19, 'San Antonio Sto Tomas Batangas', '09125454545', 'ayesha@yahoo.com', 'Saint Thomas Academy', 'Sto Tomas Batangas', 'Grade 10', '80', '80', 'Female', 'Catholic', 'Filipino', 'Richard Tolentino', '', 'Production Operator', 'Collene Tolentino', '', 'House Wife', 'San Antonio Sto Tomas Batangas', 3, 0, 0, '15000', 'n/a', 'Senior High School', '2nd Semester', '2018-2019', 34, 'BEED', 'Grade 11', '2018-08-07', '', '2018-08-10 10:00:00', '2018', '08', '82', '', '', 0, 10, 1, '5000', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '29', '33'),
(20, 'images (7).jfif', 'Kyrie', 'Alvarez', 'Olgado', 'San Felix', '1999-01-01', 20, 'San Felix Sto Tomas Batangas', '09126654377', 'kyrie@yhaoo.com', 'FAITH', 'Tanauan Batangas', 'Grade 11', '89', '80', 'Male', 'Catholic', 'Filipino', 'Ronald Olgado', '', 'Police', 'Gemma Olgado', '', 'Police', 'San Felix Sto Tomas Batangas', 6, 2, 2, '15000', 'n/a', 'Senior High School', '2nd Semester', '2018-2019', 27, ' HUMSS', 'Grade 12', '2018-08-08', '', '2018-08-10 10:00:00', '2018', '08', '82', '', '', 0, 10, 1, '5000', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '33', '33'),
(21, 'received_483590638902203.jpeg', 'Kert', 'Bedia', 'Mercado', 'San Isidro Norte', '1999-04-13', 19, 'San Pablo City', '09123847327', 'kert@gmail.com', 'Christian College of Tanauan', 'Tanauan Batangas', '4th Year', '85', '85', 'Male', 'Catholic', 'Filipino', 'Russel James Mercado', '', 'Canteen', 'Glenda Mercado', '', 'OFW', 'Bitin Bay Laguna', 4, 0, 1, '10000', 'n/a', 'College', '2nd Semester', '2018-2019', 18, ' BS Accountancy', '4th year', '2018-08-08', '', '2018-08-10 10:00:00', '2018', '08', '85', '', '', 0, 10, 0, '', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', '45', '40'),
(22, 'images (8).jfif', 'Joshua', 'Malvar', 'Malvar', 'Poblacion 1', '1998-03-13', 21, 'Sto Tomas Batangas', '09123123112', 'joshua@gmail,com', 'Tanauan Institute', 'Tanauan Batangas', 'Grade 11', '87', '80', 'Male', 'Catholic', 'Filipino', 'Josua Malvar', '', 'Deceased', 'Jenny Malvar', '', 'Domestic Helper', 'Sto Tomas Batangas', 3, 0, 1, '12000', 'n/a', 'Senior High School', '2nd Semester', '2018-2019', 17, ' BEED', 'Grade 12', '2018-08-07', '', '2018-08-10 10:00:00', '2018', '08', '82', '', '', 0, 10, 1, '5000', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '54', '55'),
(23, 'received_544444809665849.jpeg', 'Gelo', 'Dela Fuente', 'Mangabat', 'San Agustin', '1997-11-15', 20, 'San Pablo City', '09987486373', 'gelo@gmail.com', 'Tanauan Institute', 'Tanauan Batangas', 'Grade 11', '85', '80', 'Female', 'Catholic', 'Filipino', 'Juanito Mangabat', '', 'None', 'Gema Mangabat', '', 'OFW', 'brgy. San Agustin Sto.tomas Batangas', 4, 1, 0, '40000', 'n/a', 'Senior High School', '2nd Semester', '2018-2019', 17, 'BAM', 'Grade 12', '2018-08-07', '', '2018-08-10 10:00:00', '2018', '08', '85', '', '', 0, 10, 1, '5000', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', '56', '54'),
(24, 'images (9).jfif', 'Vergel', 'Y ', 'Lanting', 'San Pedro', '1997-02-14', 22, 'San Pedro Sto Tomas Batangas', '09126655351', 'vergel@gmail.com', 'San Pedro National High School', 'Sa Pedro Sto Tomas Batangas', 'Grade 10', '85', '80', 'Male', 'Catholic', '15000', 'Jhon Lanting', '', 'Factory Worker ', 'Jessa Lanting', '', 'House Wife', 'San Pedro Sto Tomas Batangas', 7, 4, 1, '15000', 'n/a', 'Senior High School', '2nd Semester', '2018-2019', 17, ' STEM', 'Grade 11', '2018-08-07', '', '2018-08-10 10:00:00', '2018', '08', '83', '', '', 0, 10, 0, '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '55', '54'),
(25, 'images (10).jfif', 'Sid', 'y ', 'Aalad', 'San Pablo', '2000-12-25', 18, 'San Pablo Sto Tomas Batangas', '09125436541', 'sid@gmail.com', 'Saint Thomas Academy', 'Sto Tomas Batangas', 'Grade 11', '82', '80', 'Male', 'Catholic', 'Filipino', 'Sad Aala', '', 'Deceased', 'Sad Aala', '', 'Deceased', 'San Pedro Sto Tomas Batangas', 3, 0, 1, '12000', 'n/a', 'Senior High School', '2nd Semester', '2018-2019', 34, ' HUMSS', 'Grade 12', '2018-08-07', '', '2018-08-10 10:00:00', '2018', '08', '83', '', '', 0, 10, 1, '5000', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '56', '56'),
(26, 'received_2397849903788698.jpeg', 'Gelay', 'David', 'De Guzman', 'San Isidro Norte', '1997-08-15', 20, 'Sto.Tomas Batangas', '09283237365', 'gelay@gmail.com', 'Tanauan Institute', 'Tanauan', '2nd Year', '80', '88', 'Female', 'Catholic', 'Filipino', 'Franco De Guzman', '', 'None', 'Jena De Guzman', '', 'Housewife', 'San Isidro Norte', 7, 3, 2, '2000', 'n/a', 'College', '1st Semester', '2018-2019', 18, ' BS Criminology ', '3rd Year', '2018-08-07', '', '2018-08-10 10:00:00', '2018', '08', '90', '', '', 0, 10, 0, '', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', '64', '60'),
(27, 'images (11).jfif', 'Aya', 'Aya', 'Ayay', 'Poblacion 1', '1999-08-31', 20, 'Sto Tomas Batangas', '09127765599', 'aya@gmail.com', 'San Pedro National High School', 'San Pedro Sto Toas Batangas', 'Grade 10', '90', '80', 'Female', 'Catholic', 'Filipino', 'Ayo Aya', '', 'Sewer', 'Ayay Aya', '', 'Sewer', 'San Pedro', 5, 0, 3, '20000', 'n/a', 'Senior High School', '2nd Semester', '2018-2019', 18, ' STEM', 'Grade 11', '2018-08-07', '', '2018-08-10 10:00:00', '2018', '08', '95', '', '', 0, 10, 1, '5000', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '45', '45'),
(28, 'images (12).jfif', 'Kane', 'Pat', 'Robiego', 'San Vicente', '1999-07-14', 20, 'San Vicente', '09127614171', 'kane@gmail.com', 'San Jose National Hgh School', 'San Jose Sto Tomas Batangas', 'Grade 10', '89', '80', 'Male', 'Catholic', 'Filipino', 'Joey Robiego', '', 'Cook', 'Linda Robiego', '', 'Cook', 'San Vicente Sto Tomas Batangas', 5, 3, 2, '1000', 'n/a', 'Senior High School', '2nd Semester', '2018-2019', 17, ' BEED', 'Grade 11', '2018-08-07', '', '2018-08-10 10:00:00', '2018', '08', '80', '', '', 0, 10, 1, '5000', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '44', '45'),
(29, 'received_467720657176960.jpeg', 'Carl ', 'Manalo', 'Agustin', 'San Joaquin', '1997-08-13', 20, 'San Pablo City', '09887645541', 'carl@gmail.com', 'FAITH', 'Tanauan City', '2nd Year', '88', '85', 'Male', 'Catholic', 'Filipino', 'Frederic Agustin', '', 'OFW', 'Janine Agustin', '', 'House Wife', 'Sto,tomas Batangas', 8, 4, 2, '10000', 'n/a', 'College', '2nd Semester', '2018-2019', 27, 'Industrial Engineering', '3rd Year', '2018-08-07', '', '2018-08-10 10:00:00', '2018', '08', '85', '', '', 0, 10, 0, '7000', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', '45', '40'),
(30, 'images (13).jfif', 'Daisy', 'Ocampo ', 'Dela Rosa', 'San Pablo', '1997-12-11', 21, 'Sto Tomas Batangas', '09121435171', 'daisy@gmail.com', 'Christian College of Tanauan', 'Tanauan Batangas', 'Grade 11', '80', '80', 'Female', 'Catholic', 'Filipino', 'Jose Dela Rosa', '', 'Engineer', 'Isabel Dela Rosa', '', 'Engineer', 'San Pablo Sto Tomas Batangas', 10, 4, 4, '30000', 'n/a', 'Senior High School', '2nd Semester', '2018-2019', 18, ' BEED', 'Grade 11', '2019-01-07', '2019-01-08 10:00:00', '2019-01-09 10:00:00', '2019', '01', '85', '', '', 0, 10, 1, '5000', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '59', '47'),
(31, 'received_407028806653449.jpeg', 'Mabel', 'Micosa', 'Sablayan', 'San Juan', '1997-11-21', 21, 'San Pablo City', '09238762375', 'mabel@gmail.com', 'Tanauan Institute', 'Tanauan Batangas', '1st year', '85', '85', 'Female', 'Catholic', 'Filipino', 'Bruno Micosa', '', 'Manager', 'Lilia Micosa', '', 'House Wife', 'San Juan Sto.tomas Batangas', 4, 1, 1, '20000', 'n/a', 'College', '2nd Semester', '2018-2019', 16, 'Civil Engineer', '2nd Year', '2019-01-07', '2019-01-08 10:00:00', '2019-01-09 10:00:00', '2019', '01', '85', '', '', 0, 10, 0, '7000', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', ' n/a', '46', '44'),
(32, 'Koala.jpg', 'Edgar', 'Malabrigo', 'Gonzaga', 'San Miguel', '2000-10-10', 19, 'San Miguel Sto Tomas Batangas', '09195438297', 'ededed@gmail.com', 'Christian College of Tanauan', 'Brgy. 4 Tanauan Batangas', 'Grade 10', '85', '89', 'Male', 'Roman Catholic', 'Filipino', 'Hector  Gonzaga', NULL, 'Jeepney Driver', 'Loisa Gonzaga', NULL, 'House Wife', 'San Miguel Sto Tomas Batangas', 5, 1, 1, '155000', 'n/a', 'Senior High School', '1st Semester', '2019-2020', 18, ' STEM', 'Grade 11', '2019-11-04', '2019-11-04 10:00:00', NULL, '2019', '11', '86.90', NULL, NULL, 0, 2, 0, NULL, 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', '55', '55'),
(33, 'cv image.jpg', 'Rhay', 'cahapay', 'Ras', 'Poblacion 1', '1997-07-22', 23, 'Santo Tomas Batangas', '09098754211', 'rhayras22@gmail.com', 'San Pedro', 'San Pedro', '100', '90', '87', 'Male', 'Born Again', 'Filipino', 'asd', NULL, 'asd', 'asd', NULL, 'asd', 'asd', 12, 2, 2, '10000', 'N/a', 'Senior High School', '2nd Semester', '2019-2020', 16, ' ABM', 'Grade 11', '2021-03-11', '2021-03-11 07:00:00', NULL, '2021', '03', '90', NULL, NULL, 0, 5, 0, NULL, 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', '12', '12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_submission`
--

CREATE TABLE `tbl_submission` (
  `id` int(11) NOT NULL,
  `fromdate` date NOT NULL,
  `todate` date NOT NULL,
  `scholartype` int(1) NOT NULL COMMENT '0-jhs;1-shs;2-college',
  `schyear` text NOT NULL,
  `semester` text NOT NULL,
  `year` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_submission`
--

INSERT INTO `tbl_submission` (`id`, `fromdate`, `todate`, `scholartype`, `schyear`, `semester`, `year`) VALUES
(1, '2019-01-07', '2019-02-07', 1, '2018-2019', '2nd Semester', '2018'),
(2, '2019-01-07', '2019-02-07', 2, '2018-2019', '2nd Semester', '2018'),
(3, '2021-03-01', '2021-03-28', 1, '2019-2020', '2nd Semester', '2021');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `highlights`
--
ALTER TABLE `highlights`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_account`
--
ALTER TABLE `tbl_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_answer`
--
ALTER TABLE `tbl_answer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_apikey`
--
ALTER TABLE `tbl_apikey`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_applydate`
--
ALTER TABLE `tbl_applydate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_chat`
--
ALTER TABLE `tbl_chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_currentyear`
--
ALTER TABLE `tbl_currentyear`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_currentyearjh`
--
ALTER TABLE `tbl_currentyearjh`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_exam`
--
ALTER TABLE `tbl_exam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_examevaluation`
--
ALTER TABLE `tbl_examevaluation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_memo`
--
ALTER TABLE `tbl_memo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_municipalrequirements`
--
ALTER TABLE `tbl_municipalrequirements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_question`
--
ALTER TABLE `tbl_question`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_reqstatus`
--
ALTER TABLE `tbl_reqstatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_schedule`
--
ALTER TABLE `tbl_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_scholarhistory`
--
ALTER TABLE `tbl_scholarhistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_school`
--
ALTER TABLE `tbl_school`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_schoolrequirements`
--
ALTER TABLE `tbl_schoolrequirements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_siblingscholar`
--
ALTER TABLE `tbl_siblingscholar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_submission`
--
ALTER TABLE `tbl_submission`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `highlights`
--
ALTER TABLE `highlights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_account`
--
ALTER TABLE `tbl_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `tbl_answer`
--
ALTER TABLE `tbl_answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;

--
-- AUTO_INCREMENT for table `tbl_apikey`
--
ALTER TABLE `tbl_apikey`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_applydate`
--
ALTER TABLE `tbl_applydate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tbl_chat`
--
ALTER TABLE `tbl_chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tbl_currentyear`
--
ALTER TABLE `tbl_currentyear`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_currentyearjh`
--
ALTER TABLE `tbl_currentyearjh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_exam`
--
ALTER TABLE `tbl_exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_examevaluation`
--
ALTER TABLE `tbl_examevaluation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbl_memo`
--
ALTER TABLE `tbl_memo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_municipalrequirements`
--
ALTER TABLE `tbl_municipalrequirements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tbl_question`
--
ALTER TABLE `tbl_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `tbl_reqstatus`
--
ALTER TABLE `tbl_reqstatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=353;

--
-- AUTO_INCREMENT for table `tbl_schedule`
--
ALTER TABLE `tbl_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_scholarhistory`
--
ALTER TABLE `tbl_scholarhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbl_school`
--
ALTER TABLE `tbl_school`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbl_schoolrequirements`
--
ALTER TABLE `tbl_schoolrequirements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tbl_siblingscholar`
--
ALTER TABLE `tbl_siblingscholar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_student`
--
ALTER TABLE `tbl_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbl_submission`
--
ALTER TABLE `tbl_submission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
