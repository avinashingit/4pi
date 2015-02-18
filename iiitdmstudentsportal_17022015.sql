-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2015 at 08:12 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `iiitdmstudentsportal`
--
CREATE DATABASE IF NOT EXISTS `iiitdmstudentsportal` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `iiitdmstudentsportal`;

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE IF NOT EXISTS `about` (
  `userId` char(9) NOT NULL,
  `dob` char(10) NOT NULL,
  `description` text,
  `work` int(11) NOT NULL,
  `mailid` varchar(50) DEFAULT '',
  `showMailId` tinyint(1) NOT NULL DEFAULT '1',
  `address` text NOT NULL,
  `phone` varchar(40) DEFAULT '',
  `showPhone` varchar(3) NOT NULL DEFAULT '0',
  `facebookId` varchar(128) NOT NULL DEFAULT '',
  `twitterId` varchar(128) NOT NULL DEFAULT '',
  `googleId` varchar(128) NOT NULL DEFAULT '',
  `linkedinId` varchar(128) NOT NULL DEFAULT '',
  `pinterestId` varchar(128) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `academics`
--

CREATE TABLE IF NOT EXISTS `academics` (
`degreeId` int(11) NOT NULL,
  `userId` char(9) NOT NULL,
  `degree` varchar(20) NOT NULL,
  `schoolName` tinytext NOT NULL,
  `location` tinytext NOT NULL,
  `start` bigint(20) NOT NULL,
  `end` bigint(20) NOT NULL,
  `score` varchar(7) NOT NULL,
  `scoreType` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `achievements`
--

CREATE TABLE IF NOT EXISTS `achievements` (
`achievementId` int(11) NOT NULL,
  `userId` char(9) NOT NULL,
  `competition` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `position` varchar(10) NOT NULL,
  `achieveddate` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `certifiedcourses`
--

CREATE TABLE IF NOT EXISTS `certifiedcourses` (
`courseId` int(11) NOT NULL,
  `userId` varchar(9) NOT NULL,
  `courseName` varchar(100) NOT NULL,
  `instituteName` varchar(200) NOT NULL,
  `start` bigint(20) NOT NULL,
  `end` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `eventId` int(11) NOT NULL,
  `eventIdHash` varchar(128) NOT NULL,
  `userId` varchar(9) NOT NULL,
  `eventName` tinytext NOT NULL,
  `organisedBy` varchar(100) NOT NULL,
  `sharedWith` text NOT NULL,
  `eventVenue` varchar(100) NOT NULL,
  `eventDate` int(8) NOT NULL,
  `eventTime` int(4) NOT NULL,
  `eventDurationHrs` int(4) NOT NULL,
  `eventDurationMin` int(4) NOT NULL,
  `type` varchar(30) NOT NULL,
  `tagLine` varchar(200) NOT NULL,
  `content` longtext NOT NULL,
  `timestamp` bigint(20) NOT NULL,
  `lastUpdated` bigint(20) NOT NULL,
  `displayStatus` tinyint(1) NOT NULL DEFAULT '0',
  `approvalStatus` tinyint(1) NOT NULL DEFAULT '0',
  `seenCount` int(11) NOT NULL DEFAULT '0',
  `seenBy` longtext,
  `eventStatus` varchar(50) NOT NULL DEFAULT 'As Scheduled',
  `attenders` longtext,
  `attendCount` int(11) NOT NULL DEFAULT '0',
  `winners` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `experience`
--

CREATE TABLE IF NOT EXISTS `experience` (
`experienceId` int(11) NOT NULL,
  `userId` varchar(9) NOT NULL,
  `organisation` varchar(70) NOT NULL,
  `startDate` bigint(20) NOT NULL,
  `endDate` bigint(20) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `featuring` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `userId` varchar(9) NOT NULL,
`feedbackId` int(11) NOT NULL,
  `feedback` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`userId`, `feedbackId`, `feedback`, `timestamp`) VALUES
('COE12B006', 1, 'I Liked the site very much', '2015-01-19 17:35:27'),
('COE12B009', 2, 'gkjhgk', '2015-02-15 18:38:15');

-- --------------------------------------------------------

--
-- Table structure for table `ideaposttable`
--

CREATE TABLE IF NOT EXISTS `ideaposttable` (
  `userIdHash` text NOT NULL,
  `userId` varchar(9) NOT NULL,
  `name` varchar(100) NOT NULL,
  `ideaPostId` int(100) NOT NULL,
  `ideaPostIdHash` text NOT NULL,
  `appreciaters` text NOT NULL,
  `appreciateCount` int(11) NOT NULL DEFAULT '0',
  `depreciaters` text NOT NULL,
  `depreciateCount` int(11) NOT NULL,
  `ideaPostDate` varchar(15) NOT NULL,
  `ideaDescription` text NOT NULL,
  `timeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `postOwner` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ideaposttable`
--

INSERT INTO `ideaposttable` (`userIdHash`, `userId`, `name`, `ideaPostId`, `ideaPostIdHash`, `appreciaters`, `appreciateCount`, `depreciaters`, `depreciateCount`, `ideaPostDate`, `ideaDescription`, `timeStamp`, `postOwner`) VALUES
('dfgbulsdhfvuhahuv', 'COE12B020', 'Krishna Teja', 13, 'sdbjghsdliuniusdhg', 'COE13B004', 2, 'COE13B004', 1, '14-12-02', 'Strongly refuting the charge of being against growth, Reserve Bank of India (RBI) Governor Raghuram Rajan said on Tuesday the way to sustainable growth was through moderating inflation.\r\n"There is a major misconception in the industry that the RBI is not concerned about growth. The central bank is concerned about growth and the way to sustainable growth is to have a moderate inflation," Rajan told reporters in Mumbai after announcing the central bank''s fifth bi-monthly policy review for the current fiscal.\r\n"RBI wants the strongest growth for India that is possible. We''re talking of years of sustainable growth for which you need to fight inflation," he added.\r\nIn line with expectations, the RBI on Tuesday decided to keep key interest rates unchanged. The apex bank kept the repo rate, or the interest that banks pay when they borrow money from the RBI to meet their short-term fund requirements, unchanged at 8 per cent.\r\nRajan said a change in the monetary policy at the current juncture is premature.\r\n"There is still some uncertainty about the evolution of base effects in inflation, the strength of the on-going disinflationary impulses, the pace of change of the public''s inflationary expectations, as well as the success of the government''s efforts to hit deficit targets, the governor said.\r\nWhen asked about a missed opportunity for a rate cut, Rajan said if the RBI were to cut rates now it would risk inflation down the line and the associated loss of credibility.', '2014-12-02 10:24:14', 0),
('shfdbasnfvbafiu', 'COE12B021', 'Kishore Pidugu', 14, 'dfnbfgbjhsntsfgvbafkdsjnv', '', 1, 'COE13B004', 1, '14-12-02', 'Strongly refuting the charge of being against growth, Reserve Bank of India (RBI) Governor Raghuram Rajan said on Tuesday the way to sustainable growth was through moderating inflation.\r\n"There is a major misconception in the industry that the RBI is not concerned about growth. The central bank is concerned about growth and the way to sustainable growth is to have a moderate inflation," Rajan told reporters in Mumbai after announcing the central bank''s fifth bi-monthly policy review for the current fiscal.\r\n"RBI wants the strongest growth for India that is possible. We''re talking of years of sustainable growth for which you need to fight inflation," he added.\r\nIn line with expectations, the RBI on Tuesday decided to keep key interest rates unchanged. The apex bank kept the repo rate, or the interest that banks pay when they borrow money from the RBI to meet their short-term fund requirements, unchanged at 8 per cent.\r\nRajan said a change in the monetary policy at the current juncture is premature.\r\n"There is still some uncertainty about the evolution of base effects in inflation, the strength of the on-going disinflationary impulses, the pace of change of the public''s inflationary expectations, as well as the success of the government''s efforts to hit deficit targets, the governor said.\r\nWhen asked about a missed opportunity for a rate cut, Rajan said if the RBI were to cut rates now it would risk inflation down the line and the associated loss of credibility.', '2014-12-02 10:26:06', 0),
('ndfsbgvsmndfkjbngios', 'COE12B025', 'Roopesh Reddy', 15, 'jhfgvbsdfgvdfjkbn', '', 1, 'COE13B004', 1, '14-12-02', 'Strongly refuting the charge of being against growth, Reserve Bank of India (RBI) Governor Raghuram Rajan said on Tuesday the way to sustainable growth was through moderating inflation.\r\n"There is a major misconception in the industry that the RBI is not concerned about growth. The central bank is concerned about growth and the way to sustainable growth is to have a moderate inflation," Rajan told reporters in Mumbai after announcing the central bank''s fifth bi-monthly policy review for the current fiscal.\r\n"RBI wants the strongest growth for India that is possible. We''re talking of years of sustainable growth for which you need to fight inflation," he added.\r\nIn line with expectations, the RBI on Tuesday decided to keep key interest rates unchanged. The apex bank kept the repo rate, or the interest that banks pay when they borrow money from the RBI to meet their short-term fund requirements, unchanged at 8 per cent.\r\nRajan said a change in the monetary policy at the current juncture is premature.\r\n"There is still some uncertainty about the evolution of base effects in inflation, the strength of the on-going disinflationary impulses, the pace of change of the public''s inflationary expectations, as well as the success of the government''s efforts to hit deficit targets, the governor said.\r\nWhen asked about a missed opportunity for a rate cut, Rajan said if the RBI were to cut rates now it would risk inflation down the line and the associated loss of credibility.', '2014-12-02 10:28:24', 0),
('0a806b877dee1e24a717de81ced1c7a4453d3f6f5a289110a1107ed0815c3302095f67c06174d3b244f7e169df9dde115babc9f0bef5765d40c547159b9d1c22', 'COE13B004', 'CHAGAM YAMUNA', 16, 'aff19574c3b98d6252a17d11b925a7d07bfc60acafa1605daa1493464aa3a0b891030ef0732d570e66e081fa2ce88dc062e41e12076fd1426e8c19b390ca8ec3', 'COE13B004', 1, '', 0, '15-01-19', 'fdfadfafdasf', '2015-01-19 17:21:12', 0),
('0a806b877dee1e24a717de81ced1c7a4453d3f6f5a289110a1107ed0815c3302095f67c06174d3b244f7e169df9dde115babc9f0bef5765d40c547159b9d1c22', 'COE13B004', 'CHAGAM YAMUNA', 17, '65d3245ab8ec5257f484a5469a6acfdcfef5510f4e15a30ff83d85485fdc9ab509a86dfc2aab71ce189bddc01506abcd226de6b47a751ab5a4020915d4e9d09c', '', 0, '', 0, '15-01-28', '', '2015-01-28 13:51:08', 0),
('0a806b877dee1e24a717de81ced1c7a4453d3f6f5a289110a1107ed0815c3302095f67c06174d3b244f7e169df9dde115babc9f0bef5765d40c547159b9d1c22', 'COE13B004', 'CHAGAM YAMUNA', 23, '2a60f9849979167cbdc259f2029d61cb226a687a542cdbd81ddf51c8f3c9df923e117b3fe36b6b491337d5075871b6a45c82a65dbbc2a53adc73d2d2b7ec253b', '', 0, '', 0, '15-01-29', 'fdfsdfads', '2015-01-29 15:04:46', 0),
('4dbb5a2f9314875d41855940f194da51e2bf06b8bfbbd53257fcfbb3115e468e6c6862485992163e22a7ba03b41bac72e128532b70032bbb5cdf6bf7d20de668', 'COE12B005', 'GANTASALA SAI HEMANTH', 24, 'b03458415984ce1d632bd42d90b5eb27e70fc6d475e9162f42eaf0bc8ab8a7023415900205e74b81143186e9f3c80c32db28637d38297f6979cdda6e4073521d', '', 0, '', 0, '15-02-01', 'hgvljskdgvkadflbjhadlfj\nafdbj''iarjbgvpaodfkbh\ndafibhjadfijkgb\nhbjoidfjgbopdiafkgb\ndjbihgaotbprpgvbkrbhipotdgb\nidfaibjutgaibhtoigb\ndrgvjibaipo', '2015-02-01 12:07:16', 0),
('05f6a1cb30f4d02dd3d82878c53d364d34f6fc4ab4c7ded096d3bfde7defc38344cdaa36ce02795ec010a1d60a2e6ba5279404c64368575f6862c8af20bb0e28', 'COE12B009', 'KADIMISETTY AVINASH', 25, 'b207c367131ae4a8def74fe9fbee3288263d0319c3af5c36a7f7d2ecea0580ad1dd314fb8568906ef3ccc9825e99760c06f24421b0bd3cbda6783a9c9ee0890f', '', 0, '', 0, '15-02-14', 'That idea is this.', '2015-02-14 13:47:24', 0),
('05f6a1cb30f4d02dd3d82878c53d364d34f6fc4ab4c7ded096d3bfde7defc38344cdaa36ce02795ec010a1d60a2e6ba5279404c64368575f6862c8af20bb0e28', 'COE12B009', 'KADIMISETTY AVINASH', 26, '8d923a0d9aa377c5f476961680c615674c38d1ff423af9dfcb83f43080ee73f0e8098d549fb8f6ad825f7bd70daf4fb1a6fb850b84c6e8d2ba5c293485f43253', '', 0, '', 0, '15-02-16', 'fdasads', '2015-02-16 14:36:47', 0);

-- --------------------------------------------------------

--
-- Table structure for table `interests`
--

CREATE TABLE IF NOT EXISTS `interests` (
  `userId` char(9) NOT NULL,
  `interests` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `interests`
--

INSERT INTO `interests` (`userId`, `interests`) VALUES
('COE11B005', 'asdfadsf'),
('COE12B009', 'fadsfads,fadsfadsfadsfadsfas,aa'),
('COE12B024', ',fadsfdas'),
('COE12B025', 'sad,fads,fadsfadsfadsfa,fadsfadsfadsfaa,fadsfadsfadsfaaf,fadsfadsfadsfaafd,fadsfadsfadsfaafdas');

-- --------------------------------------------------------

--
-- Table structure for table `leavemessage`
--

CREATE TABLE IF NOT EXISTS `leavemessage` (
  `userId` char(9) NOT NULL,
  `fromName` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `extHash` varchar(128) NOT NULL,
  `isValid` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `leavemessage`
--

INSERT INTO `leavemessage` (`userId`, `fromName`, `email`, `message`, `extHash`, `isValid`) VALUES
('', 'hari', 'harikrishnam@gmail.com', 'Hi well done', '', 1),
('COE12B009', 'Avinash', 'kavinash366@gmail.com', 'fjadklsf', '280457b176e926725d102634c896c1001564765b34076e726212572199ebfe7cf4067fb1841ca7a8b534f0e4ac328088229973c512645f4647d76a6d3e891520', 1),
('', 'fadsf', 'kavinash366@gmail.com', 'fadsfads', '2d05cf6387c134dc81e87f7b1a7a3b6bced8727d0d623bc037567ee96a58f681135f933dea0b954777d437341de7d4c0b316c0cce8c12e222b1a8ff52aeb1b92', 1),
('COE12B009', 'fadsf', 'kavinash366@gmail.com', 'fadsfads', 'c5a169e14e0466e1ec279c78f4d7fd83bbc6ad58e685934677b4388430b97ad991c133d5c94c1aca7a3cf084ca7abcf454056c95e1c245dcaf8bda6756d8308a', 1),
('COE12B009', 'Avinash', 'kavinash366@gmail.com', 'Avinash', 'ca20720a67bed119a9d1f36d48a93bdddf9bd32012e43f0f0482caeeab7e665948675a5c4bdd7a652a5d8d89c9012dca57ee8a0ae01b185e5cd5b0ab823e5121', 0);

-- --------------------------------------------------------

--
-- Table structure for table `loginlog`
--

CREATE TABLE IF NOT EXISTS `loginlog` (
`logId` int(11) NOT NULL,
  `userId` varchar(9) NOT NULL,
  `osbrowser` text NOT NULL,
  `ipaddress` varchar(18) NOT NULL,
  `loginTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `logoutTime` varchar(40) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=120 ;

--
-- Dumping data for table `loginlog`
--

INSERT INTO `loginlog` (`logId`, `userId`, `osbrowser`, `ipaddress`, `loginTime`, `logoutTime`) VALUES
(1, 'COE12B009', 'Firefox On Windows 8.1', '', '2015-01-19 17:32:54', '2015-01-19T23:04:28+0530'),
(2, 'COE12B006', 'Firefox On Windows 8.1', '', '2015-01-19 17:35:14', '2015-01-19T23:14:24+0530'),
(3, 'COE11B005', 'Chrome On Windows 7', '', '2015-01-19 17:35:37', ''),
(4, 'COE12B006', 'Firefox On Windows 8.1', '', '2015-01-19 17:49:24', '2015-01-19T23:36:23+0530'),
(5, 'COE12B009', 'Firefox On Windows 8.1', '', '2015-01-19 18:06:29', '2015-01-19T23:38:54+0530'),
(6, 'EDM11B021', 'Firefox On Windows 8.1', '', '2015-01-19 18:09:18', ''),
(7, 'EDM11B021', 'Firefox On Windows 8.1', '', '2015-01-19 18:15:48', ''),
(8, 'COE12B009', 'Firefox On Windows 8.1', '', '2015-01-19 19:07:53', '2015-01-20T00:39:18+0530'),
(9, 'COE12B009', 'Firefox On Windows 8.1', '', '2015-01-19 19:17:56', ''),
(10, 'COE12B009', 'Firefox On Windows 8.1', '', '2015-01-20 08:06:29', ''),
(11, 'COE12B009', 'Firefox On Windows 8.1', '', '2015-01-21 07:37:27', ''),
(12, 'COE12B009', 'Firefox On Windows 8.1', '', '2015-01-21 07:37:56', ''),
(13, 'COE12B009', 'Firefox On Windows 8.1', '', '2015-01-25 15:30:53', ''),
(14, 'COE12B025', 'Firefox On Windows 8.1', '', '2015-01-28 16:44:25', ''),
(15, 'COE12B025', 'Firefox On Windows 8.1', '', '2015-01-29 06:12:24', ''),
(16, 'COE12B025', 'Firefox On Windows 8.1', '', '2015-01-29 10:21:05', ''),
(17, 'COE12B025', 'Firefox On Windows 8.1', '', '2015-01-29 12:15:28', ''),
(18, 'COE12B025', 'Firefox On Windows 8.1', '', '2015-01-29 21:00:58', ''),
(19, 'COE12B009', 'Firefox On Windows 8.1', '', '2015-01-29 21:08:49', '2015-01-30T02:44:52+0530'),
(20, 'COE12B025', 'Firefox On Windows 8.1', '', '2015-01-29 21:15:01', ''),
(21, 'COE12B025', 'Firefox On Windows 8.1', '::1', '2015-01-30 04:40:19', ''),
(22, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-01-30 06:04:11', '2015-01-30T11:57:26+0530'),
(23, 'COE12B025', 'Firefox On Windows 8.1', '::1', '2015-01-30 06:28:07', ''),
(24, 'COE12B025', 'Firefox On Windows 8.1', '::1', '2015-01-30 12:58:48', ''),
(25, 'COE12B025', 'Firefox On Windows 8.1', '::1', '2015-01-30 20:58:41', ''),
(26, 'COE12B013', 'Firefox On Ubuntu', '172.17.3.72', '2015-01-31 21:01:52', ''),
(27, 'COE12B025', 'Firefox On Windows 8.1', '127.0.0.1', '2015-02-01 09:11:01', ''),
(28, 'COE12B005', 'Chrome On Windows 7', '172.17.2.239', '2015-02-01 11:24:40', '2015-02-01T17:37:58+0530'),
(29, 'COE12B025', 'Firefox On Windows 8.1', '::1', '2015-02-02 14:53:13', ''),
(30, 'COE12B025', 'Firefox On Windows 8.1', '::1', '2015-02-06 05:29:50', ''),
(31, 'COE12B025', 'Firefox On Windows 8.1', '::1', '2015-02-06 13:56:36', ''),
(32, 'COE12B025', 'Firefox On Windows 8.1', '::1', '2015-02-06 15:44:17', ''),
(33, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-07 13:24:33', '2015-02-07T18:58:20+0530'),
(34, 'COE12B013', 'Firefox On Windows 8.1', '::1', '2015-02-07 13:28:27', ''),
(35, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-08 13:11:08', '2015-02-08T19:44:25+0530'),
(36, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-08 14:14:30', '2015-02-08T19:50:24+0530'),
(37, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-08 17:40:53', ''),
(38, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-10 12:46:07', ''),
(39, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-10 12:46:10', ''),
(40, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-10 12:46:10', ''),
(41, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-10 12:46:11', ''),
(42, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-10 12:46:11', ''),
(43, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-10 12:49:41', ''),
(44, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-10 12:49:41', ''),
(45, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-10 12:49:41', ''),
(46, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-10 12:49:41', ''),
(47, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-10 12:49:41', ''),
(48, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-10 12:51:49', '2015-02-10T18:23:33+0530'),
(49, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-10 12:54:23', ''),
(50, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-10 12:54:25', ''),
(51, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-10 12:54:26', ''),
(52, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-10 12:54:26', '2015-02-10T18:24:35+0530'),
(53, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-10 12:54:43', ''),
(54, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-10 12:54:44', ''),
(55, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-10 12:54:44', ''),
(56, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-10 12:54:44', ''),
(57, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-10 12:54:44', ''),
(58, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-10 12:54:44', ''),
(59, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-10 12:54:45', ''),
(60, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-10 12:54:45', ''),
(61, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-10 12:54:45', ''),
(62, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-10 12:54:47', ''),
(63, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-10 12:54:47', ''),
(64, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-10 12:54:47', ''),
(65, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-10 12:54:48', ''),
(66, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-10 12:54:48', ''),
(67, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-10 12:54:48', ''),
(68, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-10 12:54:48', ''),
(69, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-10 12:54:48', ''),
(70, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-10 12:54:48', ''),
(71, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-10 12:55:05', ''),
(72, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-10 13:08:48', ''),
(73, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-10 13:49:27', ''),
(74, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-10 16:46:02', '2015-02-10T22:25:43+0530'),
(75, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-10 16:55:50', ''),
(76, 'COE11B005', 'Chrome On Windows 7', '172.17.2.57', '2015-02-10 19:53:35', ''),
(77, 'COE11B005', 'Firefox On Windows 8.1', '::1', '2015-02-13 06:06:06', ''),
(78, 'COE11B005', 'Chrome On Windows 7', '172.17.2.239', '2015-02-13 06:11:17', ''),
(79, 'COE11B005', 'Firefox On Windows 8.1', '::1', '2015-02-13 08:52:42', ''),
(80, 'COE11B005', 'Firefox On Windows 8.1', '::1', '2015-02-13 16:22:41', '2015-02-13T22:24:27+0530'),
(81, 'COE11B005', 'Firefox On Windows 8.1', '::1', '2015-02-13 16:57:01', ''),
(82, 'COE11B005', 'Firefox On Windows 8.1', '::1', '2015-02-13 17:49:49', ''),
(83, 'COE11B005', 'Firefox On Windows 8.1', '::1', '2015-02-14 03:40:04', '2015-02-14T11:47:23+0530'),
(84, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-14 09:53:16', ''),
(85, 'COE12B009', 'Firefox On Windows 8.1', '127.0.0.1', '2015-02-14 13:44:29', ''),
(86, 'COE12B009', 'Firefox On Windows 8.1', '127.0.0.1', '2015-02-14 14:21:01', ''),
(87, 'COE12B009', 'Firefox On Windows 8.1', '127.0.0.1', '2015-02-14 14:21:07', ''),
(88, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-14 14:21:25', ''),
(89, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-14 16:40:23', ''),
(90, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-14 16:44:13', ''),
(91, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-14 17:54:38', ''),
(92, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-14 17:59:22', ''),
(93, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-14 18:01:44', ''),
(94, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-14 18:05:46', ''),
(95, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-14 18:08:09', '2015-02-14T23:42:05+0530'),
(96, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-14 18:12:56', '2015-02-15T00:12:42+0530'),
(97, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-14 18:42:57', '2015-02-15T00:15:18+0530'),
(98, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-14 18:46:33', ''),
(99, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-15 06:13:10', ''),
(100, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-15 06:16:16', ''),
(101, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-15 08:08:28', ''),
(102, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-15 08:11:39', ''),
(103, 'COE11B005', 'Chrome On Windows 7', '172.17.2.239', '2015-02-15 09:09:55', ''),
(104, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-15 13:43:01', ''),
(105, 'COE11B005', 'Chrome On Windows 7', '172.17.2.239', '2015-02-15 15:45:44', ''),
(106, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-15 16:54:55', '2015-02-15T23:41:09+0530'),
(107, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-15 18:12:09', '2015-02-16T00:54:57+0530'),
(108, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-15 18:26:30', ''),
(109, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-15 19:32:57', '2015-02-16T01:20:29+0530'),
(110, 'COE12B013', 'Firefox On Windows 8.1', '::1', '2015-02-15 19:58:43', '2015-02-16T01:42:20+0530'),
(111, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-15 20:14:04', ''),
(112, 'COE12B013', 'Firefox On Windows 8.1', '::1', '2015-02-15 20:43:38', ''),
(113, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-16 04:17:16', ''),
(114, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-16 04:17:16', ''),
(115, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-16 04:19:57', ''),
(116, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-16 04:22:06', ''),
(117, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-16 08:02:03', ''),
(118, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-16 14:01:20', ''),
(119, 'COE12B009', 'Firefox On Windows 8.1', '::1', '2015-02-16 14:33:18', '');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `notificationId` int(20) NOT NULL,
  `notificationIdHash` varchar(128) NOT NULL,
  `type` int(11) NOT NULL,
  `userId` varchar(9) NOT NULL,
  `othersInvolved` text NOT NULL,
  `objectId` int(11) NOT NULL,
  `objectType` varchar(20) NOT NULL,
  `timestamp` bigint(20) NOT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  `actionCount` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notificationId`, `notificationIdHash`, `type`, `userId`, `othersInvolved`, `objectId`, `objectType`, `timestamp`, `seen`, `actionCount`) VALUES
(172, '493154124535726a9e30c94f80e6e15ab98b0b0716b650e71c0010816d97b470d6237ce5410af57e8019f13d2bc9017a77de71ee14d414296dabcb5252945d13', 1, 'COE11B001', '', 18, '500', 1421667458, 0, 2),
(176, '31a6934187d99eb372fdc809d64aebf8c903d41c7435d79b5562f521d9a5ead0b35f13fda0ad8d837c05a3d94f6913497f8ffb188a438dcaa9486223199e251a', 2, 'COE11B001', '', 18, '500', 1421683588, 0, 1),
(175, '043e0fdff76c3541c2b0288eedc81bd8110853452320e48cefa8499ed96d81a8130415616f2713eaa58f7ea90cce7d49d10c7769a9a8bd300552aabd78683638', 3, 'COE11B001', '', 18, '500', 1421683588, 0, 1),
(181, '36652f08cb80c5827ffe9010bbca87e992d08a5d416a718e8a50294a01e3b9df9a97f70ba4a768d6930a42a0e487426d08128fe34de953bc874cb51ce6cad46e', 10, 'COE11B001', '', 9, '700', 1421689035, 0, 1),
(179, 'ea57cff74220595400a1014f7327088759126d4de6290bfdf8af0eae5662baa2d58e7b9ec3106e784f458af7ed08d8d150e81d91762bc17e60ed0091f319156e', 10, 'COE11B001', '', 10, '700', 1421689023, 0, 1),
(177, 'd66759cf5b08028069552a33a44c55886b6086ff99f6cc4fdd121a9c1425ed1f62364d6c162016e934805427c0171c982f56397130441fb63e613a1f1b302a56', 10, 'COE11B001', '', 17, '700', 1421688992, 0, 2),
(178, '57756e29674091bf789b8e6d05a2348b4d45963d8d07787ae23cec39de15ff68ad278e7c1996f0d917f43ae70329efa3d88dd46028ab041a556ce51806a87c7d', 10, 'COE11B001', '', 18, '700', 1421689018, 0, 1),
(205, 'dfc9bc352a18cff436e852128ac3f23e52e75ec38110a062469aa6c321a4c18ea273c55fc4f764d10256e91de3fcbd91b5b0c603838737d19a67c583f9308a30', 1, 'COE11B005', '', 22, '500', 1423896055, 0, 1),
(204, 'a2b66f474598762cfb4e8eb4c67a3bf5b8dfb30735d97edc82ddab7e09d3e924151c756849ae417c6d2f11e1e997a9c2024aaf2241b9db0ee7095faf83e33b23', 1, 'COE11B005', '', 23, '500', 1423896052, 0, 1),
(135, '7d427fecf280669b73f7c4bc5379e552a95a5b3d10160786f200049bdf504408d37a8a733d05a98e3fc3b1f3bc41592c424c3d651333c4e1f5c933bfd01a9bc3', 3, 'COE11B005', '', 17, '500', 1421613552, 0, 1),
(207, 'c4a7b8b2a9b13dd0bf90ea567d3b767246fb73c7a7e287258ed203ed99ba49c62c2aa474ca93f52c5c2db36676e9ce8f970a7bec68a194680a93e2dbc289e7bc', 7, 'COE11B005', '', 8, '600', 1423921520, 1, 1),
(206, 'a09579bb58a5995f8c5f7224d61d105c12941f129140df63c2a72525eb6a97e683d417dc2a10fb563a14be49174c2906ee040d2ca98ddd91109133f4d1cc0c8e', 7, 'COE11B005', '', 9, '600', 1423914537, 0, 1),
(214, '83d2c18a88f49be2134d6c1dde21b9eb75e07a55adb433406284a7b6f9c6b63951946f5360a6fa887a6c869a877e827deb73e3f9a8cc93b4287f1715edc21ca4', 8, 'COE11B005', '', 6, '600', 1423940355, 1, 1),
(208, '0de27665a09cc9de906678b669b4f637df8bd2a034a5f6d25e5bc94ae715811dbbd07b953f94927a8c147d87f8a2db7d6a829aa8a275fa68fb06e967576209e1', 8, 'COE11B005', '', 8, '600', 1423921521, 1, 1),
(188, '5f1b938f7d8193fb1f4f2484fbcbf299a15ce6768b63140ac052e297860a1777ae008ddf6a8128c557af23b140a081121989d2de10fb64479ae5bcfd24511867', 9, 'COE11B005', '', 19, '700', 1421691162, 1, 4),
(212, 'ae6d52a86cb8faf7fd74e931b7dbb71781dce58867f219b75b009fe34d1df85c975328e9707c57a8e4a5687484ddff38323690e5bc9d50f9c2ee13cab6d3f3f9', 9, 'COE11B005', '', 20, '700', 1423921551, 1, 1),
(218, 'df1605a8c6ab51ed06865bbbbf4ce9f70fac7b0671af2e70cd9e0d8646b029e9355dc3982ae2e772d6a25aa4466271d264e0dcb91db3dc7c18eddb55efe5497b', 9, 'COE11B005', '', 22, '700', 1424026585, 0, 1),
(210, 'eeea88af3523d7ffd426c7db097f61801ee8f581125ad1b4a3b7430af0c7fa6c386266bd7ee4c6d013e240da44a98b7ece267e559e6ad15a374ce7282dc78f9e', 9, 'COE11B005', '', 23, '700', 1423921539, 1, 1),
(216, '2d393cb7cc1c587d3b4f7c84e4da352f906de124125ccc19c44f8290d1c380c864ce761ca1321334ec43f8be1c6f01cf9044e8601f391f161ee69739532e73a6', 9, 'COE11B005', '', 24, '700', 1424026562, 0, 1),
(20, 'dd7f6139b8953409ed5c41ea343a4373ba62c3a67bc36da1dea4795a882680a6cfb153c7a4721815169405059e8c295d23cca6a6032c232ff034b7ebeef4a888', 10, 'COE11B005', '', 1, '700', 1421559732, 0, 3),
(107, 'd824077861f2d313bf5bb74bf5fb33b4418bd2bb48af0b4f3da03617468c52bd086d51136584f889d142d441b773dc60a9f891885e3f48b8d17c276877c03f6d', 10, 'COE11B005', '', 11, '700', 1421605144, 1, 2),
(117, 'e102768002c7559ee7b873de88dec39479eb8ac3bebe7bf96628a554c7550638ed043cc2d062901da5213fc714d2f5d04fa8089557d6f3db127121a720f8a98a', 10, 'COE11B005', '', 12, '700', 1421605454, 1, 2),
(130, '4b776e1b5bd90573470d7ef01d896ea06979709c1721dd1ab20534697aa43241eb3f2fa2b16407e4e68ed25de7df95494e4d8a0c072a213fd39b10851f1a3c3a', 10, 'COE11B005', '', 13, '700', 1421607597, 1, 2),
(128, 'a70d28686241d7a698931adf9c766d638402bd54f02bc22dc9e5f04214d18cb79c6f710b0d235a1ea850c2bae1baadb57efcdde398f3510046af2e81b9748e8b', 10, 'COE11B005', '', 14, '700', 1421607593, 1, 2),
(119, '4b61995129d995ba37a5c1563762f590962f7a116ca72b971510d96006aee841e15850633ef4c54c16ed14f04d184324dfff25b68a259a7a914bc685e7695022', 10, 'COE11B005', '', 15, '700', 1421605471, 1, 2),
(123, '09f55a81e5d27fd715c353e466b494edd476654de10863eb3be36486a747ed820d1ea91b6b3762ddf2151c0544cd4b08a7203e4142d306739c2e07675270db50', 10, 'COE11B005', '', 16, '700', 1421605482, 1, 2),
(190, '1c7dc8d910c8f5720a13fe14127ca257f88175719a115007f7e4f357d8d4b447cdb0033bf0299802bbb065a88f9e153d7b1dc594f2069a5d7c14aa41f74023ae', 10, 'COE11B005', '', 17, '700', 1421691182, 1, 1),
(189, '081e702b3d9298a065c608a0655c481d1beac73512b54a42470316c905d07db2dbe51e3fa65c303e0d36fd5acec26ddc4cd63ee5eb2ab9916333a56f92cae4b9', 10, 'COE11B005', '', 19, '700', 1421691162, 1, 4),
(213, 'a914a307eef417e9203aa8083abd56f7473e4d1a61f2d5807290bf990767b85870979622bbd0cf8c5e4d06df6c000ebc94440230ce2c184e264869de86b7ecd5', 10, 'COE11B005', '', 20, '700', 1423921551, 1, 1),
(219, '2ebf4424fc1c331e6a49edc0684bbfb07f5c80043289e1e47753ae630e6e61b36ef543e19edabf20f548cbef4020f18593372c4ed0a6051419587ab1be0a91e6', 10, 'COE11B005', '', 22, '700', 1424026585, 0, 1),
(211, '7186ea7970ea7a98f8b1802271a08f3e179d757ec2ba30384cf89bc7a5600f924be12472ac693f9ac9455f7515020bffc45ac86f839cf7ebb39ba8760511ec0d', 10, 'COE11B005', '', 23, '700', 1423921539, 1, 1),
(217, 'bfbc1353fc7fc979b52adf8f9960dacf35eefd56b5045a322dcf43158fe2427ab35eccbf35c944777a06e465a0dcfa00c4493fa68cfd6f245a6181c78a60a568', 10, 'COE11B005', '', 24, '700', 1424026562, 0, 1),
(136, '6786b4f1cf8fca9e34edeb47095bd57117440ec080157364f36445a408f7b2d42380684a8650402e7ea17f21d317d7e17cd15485e6b6d2069b5228f02815db98', 9, 'COE11B008', '', 17, '700', 1421614713, 0, 4),
(182, '7edf799af8e1e48f927a0c906764a42f489e7d2e2d2c51beb026eac3c4cd63df49932427606764bdad0eae4f2b97efd22eeff396d22885f7cf1b63da5b4f5501', 10, 'COE11B008', '', 7, '700', 1421689046, 0, 1),
(180, 'cdb4718ac6333c9d19ddbfc9e296d399e0520d49e30620310c3f2a2222a9cb80e537f24992fef58f93a68e06fffdf3b1e3c5ebe11ebcbe630e2749781b41de4b', 10, 'COE11B008', '', 8, '700', 1421689027, 0, 1),
(158, '9ccbfc48df6fd5036ce5e6d7e768ebfc9deeff9dbfc0e864b3c82b12f6914dc59da59a24a14855e5895cf3fee966f5b6b4f1cb01988e31570f893519c1e385a6', 10, 'COE11B008', '', 9, '700', 1421616140, 0, 2),
(163, 'a7c501df591de8bbb50455055d429602057879ddeecb4007160e1d9def607720f6a1a2965473793f4aa64eddfce211bea326dcbdd10ccaca4e0b2245ab177217', 10, 'COE11B008', '', 10, '700', 1421616145, 0, 2),
(168, '7c3991294deaf2f11817b6ada12079e49471f1e6970cdda42611d21e41df0add0069287dcb7913243cd60faa0ad64ce0a46f2f25d6aab53a34e5a9d2f8a7d11d', 10, 'COE11B008', '', 11, '700', 1421616150, 0, 1),
(171, '14c8857db576acf2ccb16d083a7489a3faa71c2cb39cb2b30e109623cca4662b61b36a79b41b62c45fd63d2b4254c63eade4715cee9d8857c167ea3cda4f9f8d', 10, 'COE11B008', '', 12, '700', 1421616287, 0, 1),
(155, 'b16d250f3e8ba5f2c6848e4b2cde8f6fd9c1c36182278f0e22c53c34403042efaf3d9e7b68e3739b009754d6a368e8b7fdc247c4d193953f3b416be189e5e0a3', 10, 'COE11B008', '', 13, '700', 1421616122, 0, 1),
(152, 'f0007ab3a675a0f2ddbf63fee13080507ace3ecc57b790cfa37918a7f618e0254c39b762644095d5a998ef91bed6c5e80ff2b9a97c81e9ca845d3dadb2d873d5', 10, 'COE11B008', '', 14, '700', 1421616116, 0, 1),
(149, '6b885620fbb2fb55e6c66f967d41a0726e0fa8778427e0c94f80ecfede3082812cfeb716c50a500ce8432529294d652d18bb9fa0cb984a7fd6c6393262095052', 10, 'COE11B008', '', 15, '700', 1421615550, 0, 1),
(146, '197a719392f5f322795aad8d6920a8c3b2d5d08a7ab3af2e5565c0b4038167c087ddec5826a02f14979291f7814ab0b265f460e4d126472515144e69392012fa', 10, 'COE11B008', '', 16, '700', 1421615539, 0, 1),
(137, 'b8cb9ce9d1f36996ba4902b8037235a874107c940877246d056874ebc99df1759b75ee53f02e1771ada1d0474b8031a9fee110c9dce2ae0fbdac78acf4fc65bc', 10, 'COE11B008', '', 17, '700', 1421614713, 0, 4),
(91, 'f4d37ba06270f08902ddda7de6c83cbf7acc3e6c743d4ce6321e229a81b2bfe6e06621700f4f38447b8e1c8b148de3a32f100764efe0d9833032e0379416456a', 3, 'COE12B001', '', 17, '500', 1421603972, 0, 4),
(174, '51c97c70b424206c70ac19ebc836093550ea922edc0467114e49f06f0651e39008478f4ce2df3533bd8ce918dd4e92c39fb849562d760098852315c49316e40e', 8, 'COE12B001', '', 1, '600', 1421683241, 0, 1),
(173, '57de9684997e71de1050911d170f564086dea40095fcf86647d640ccc5b26603f969f0f2f92bdd089182045d9d845d04357339f71e150e04785a75d9b78ea908', 8, 'COE12B001', '', 2, '600', 1421683240, 0, 2),
(88, '2663be3725f3855eda22832f1f5ac47bea7137899b62ff299a4fa672f9ed305335b6650cd38dda60f49bec8bc2c3990b603dec99445399296d0d0a05fe2c310a', 10, 'COE12B001', '', 16, '700', 1421600021, 0, 4),
(203, '45330e7588da43f4102b0e32442f9272a628cfb66ebfcff943c0da144631d05b7f2abfad4f21227a86d3242d802e47c06dc7381e417a649c24a4c586f8b03994', 10, 'COE12B004', '', 2, '700', 1423893752, 0, 1),
(186, 'b5a23e4350bd19519bf9833e2b660a2d7127114320f931a88876066f2c884a27754172a960551dcccb39a4b345cd5781704ac38f8128e5bbbdcf9cd7545fbfc8', 10, 'COE12B004', '', 3, '700', 1421689068, 0, 1),
(185, '72cdde2af154984a501074a74d7bb944abec13014461a4caa2ede949e69741f7c1bfb87aa69608c81c6c0a9cfd8bcb4e1fb3ba9bb776ce99030ecbdcd1e85422', 10, 'COE12B004', '', 4, '700', 1421689064, 0, 1),
(183, 'b7e8008944795a1e870cad9d6453d0165325e780c8c5042d63a4fecf848b6786f47abd39ecf62c46861a92c66e206a10e3585d5f97a14fe0ca16b3c62dbd33f4', 10, 'COE12B004', '', 5, '700', 1421689055, 0, 1),
(184, '4cf8fc7ac3fb1fa7d604250d70f1d8a60ce693f464ba9e00ab3a565c9cdb0bd65aeba1026adc9f2217464703cdaac92a46422f2dbd9003773d705711985a51f4', 10, 'COE12B004', '', 6, '700', 1421689059, 0, 1),
(115, '7425ff84a01f4ad635093d44af2ed38a676df773131e396a83daaf93275cd6b44918cb6b39bcbd4c90f7e5f7e1c44147852a51566f28b8f069aea31d5cecaa9a', 10, 'COE12B004', '', 7, '700', 1421605276, 0, 2),
(132, 'ef6c89c68f7d95c4041e3c8f36e0519995a1dbc2b9db0c87e31baa6499c41a7e3c0614a0af6e7f4424a5c8ec27755381b03119e278aa832a21cac04a4611c8d6', 10, 'COE12B004', '', 8, '700', 1421607613, 0, 2),
(113, 'd62cc6457c2c554c48c7372fa4f4588f141ccb8e82858b761f9d56c0c53bf53868b4f35d0d213193b1396ad7b02040be8e7890739220e5922d5ff71863a46e8b', 10, 'COE12B004', '', 9, '700', 1421605178, 0, 3),
(111, 'f3ce8dad269c608952f8e5f659e3325cd35da873df00e3c1ac0e337597c4d011acf3163c6cb16bfff7a8db2c77b81efea68a1eef9d3304c7dcb6898a1e440a27', 10, 'COE12B004', '', 10, '700', 1421605171, 0, 3),
(76, '07ee526f20ae5f36aa45277fa1688740acba68964a702ad941bc89105e95c210db8f34072f74f22e4517355450343cf0c77f8768fcb80b79ba2e863daeab3f89', 10, 'COE12B004', '', 11, '700', 1421589236, 0, 4),
(80, '0bcaa2929755378098f8bbdc6c690b101fec292f2509432695970ec005c6033e3800e37bd2440e4465abf7ea36cade9eb8041b6a50f3ccff0c6204ebb8617371', 10, 'COE12B005', '', 16, '700', 1421591121, 0, 1),
(199, 'd39c0cceaef8e22c785f9b401f6608a99a5c94a139e6e305c3192173a24df00878d6e9e7a05c3c1d283638fe4c3db94c9db1116212138c594cbc4c1b236cfc2e', 7, 'COE12B006', '', 1, '600', 1423592706, 0, 1),
(81, 'fb6a00e2f84b5c555128323720fe91fdfe48f3f265c48603b184f9ff53af5e967e91a1f714a5ddf30f8d4d2961d8265ab99090d525b2bc030dec44b9043bbb47', 9, 'COE12B006', '', 16, '700', 1421596008, 0, 5),
(82, 'a318111f59df139b1494513a30989675888d826bf36f566b5372d59f5508a41ed5ff85346170e666c870c714fdb63afa9cc77ada96b01acfe4fc15bc10c4dbf2', 10, 'COE12B006', '', 16, '700', 1421596008, 0, 5),
(2, '17077654b04d85cc3be5a1553ff0cf739594fdf6cc31b35d6e350aa4d7b8736933dc580559f585c3e2c6c3d3aa1cefe560c595d6718f94a0fc02dfa510e8a1de', 1, 'COE12B009', '', 3, '500', 1421500636, 0, 3),
(202, '149133f230b3747b52209fb6333080ad021710a65a05c51e410e24a0adc010698140a3e27db39d7c071844c6d8675fd4535d2423f511c1149b7cb35d1de91d0c', 1, 'COE12B009', '', 6, '500', 1423844667, 1, 1),
(196, '85d56ce419b3fa8dcdb1363b8e92792827bb952c77f708cf4ff4f6dd680da0efd5b3467990224fae6f30277f7963437182563a071fd97f1beecf7ac737d199b8', 1, 'COE12B009', '', 7, '500', 1423590136, 1, 1),
(194, '608c5ee1b3cff70d6d4cb2423167aba408c79fd1102c939e562912cb601b69833e75119f0fb535666a730277052afa7af3411cbe191f087196fc1b92538f0811', 1, 'COE12B009', '', 8, '500', 1423590115, 1, 1),
(195, 'be0e66d7692a1ebd2455aa6964fcab5177d1b11b2db89e2abfa99ba2ef99c98e3ae87b8e6a22b2ae66f09f1e97c7ae8d0b0b19b7d5c269ec2e51fa4671e005be', 1, 'COE12B009', '', 9, '500', 1423590117, 1, 1),
(201, 'da25bf0c4e5c2979d70c50f89155a6720392942c6acf7d0e1b659258e24ae448008c61788fe6482e0d87de04cf634ba1a6869e1a8707facb3254bcff4346f810', 1, 'COE12B009', '', 10, '500', 1423844610, 1, 1),
(200, 'dc0b0c391ef4dbf02e9947509a5e2a9b4c4f7dd9987fbe1e948afb903047bd6a06e37a5a5f351601aabcbb92ae360aff4a550d1d50dcea385f977cfb6f46580a', 1, 'COE12B009', '', 11, '500', 1423819636, 1, 1),
(92, 'c4afcd7da9e6d3245667ca41ab8468130c2be9314b2f119229dce6038451fa7003b4a0c97b6536366f0e80772ac8c8efe122ae9dd1f6ef9d51c59a2268dfe855', 1, 'COE12B009', '', 17, '500', 1421603996, 0, 2),
(6, 'd42763bcc8acf74322d496e56a1b24a9091df366abf1f4173c6dcfc722c07df29033d485f252112a9898b399f5bd2fb256c254bff3c150aca7f33be2dcddeb62', 2, 'COE12B009', '', 4, '500', 1421514717, 0, 1),
(4, '3caab898d1a69e237424c07c2fcca29e1b79b1ab56afe447b870fe882b834893060de642a62074bd67c8a404fce70e13c65e898e12f09c5c1f2c4258300eafbd', 2, 'COE12B009', '', 6, '500', 1421514648, 0, 1),
(126, 'bf7d010d019c5f944ff6748ffa8f0c25672d187247154923be41b269b9e1a2ac6f368da6bb32e746fe03f746451293df04019e511e964a6f3cacc292f69801b2', 2, 'COE12B009', '', 10, '500', 1421605919, 1, 1),
(12, 'd2732bb9e8b7129ec59ac0ce8554bc9a9f54accf98a57c28f03c2bc3cc659ee7bfcb801cefe815783abb6b203f9994e5a8c6441a72cba63e37e285f60295d021', 2, 'COE12B009', '', 11, '500', 1421557090, 0, 3),
(22, '1bd7c747194769d119665e6e5567706def17eb28d37dcc7a28def27614a5757c45b053dde89e06c1149255007a9e3f0bd65cd758db02c57e0d238db2b245cc7d', 2, 'COE12B009', '', 17, '500', 1421560685, 0, 4),
(1, '4703b990c16af860e82f0323cfce186ab13e849364bebf262aefaa7ac4c0cb583d46e56c8161dc7922292b399cf9534f78dd5c4c102fc2421ac7b8d237d822b5', 3, 'COE12B009', '', 3, '500', 1421498702, 0, 1),
(5, '0c31c05b1c883d295ea15512eb2e1aabc9ced03645e7c6e94d0b5edf69e61867f2dca3256bed3a2c1305eeac03693bcf4b76ffe17fb1da437926591ab380bbe8', 3, 'COE12B009', '', 4, '500', 1421514717, 0, 1),
(3, '828f8c9092de750020411bfa4f8120f4a98f0a6279620ad75f5cea5b34297028090cd9e76dd4c5121fe2b7a10eeb1167d55cc59e709f73f6e7a4d5eb7a66631f', 3, 'COE12B009', '', 6, '500', 1421514648, 0, 1),
(124, 'c1567e9b224825a99d26cceefa81c78b2a0bb420c047c705fed2c0d03ceda61808b9fa42382f12c9b31e8c87a13f6c3a8ec5cdc0939aaf6c5b16191f176217c3', 3, 'COE12B009', '', 10, '500', 1421605918, 1, 1),
(10, '42624acdb17884aa134ab15aced4b299a827336d09d544c2aad5797c3b8a301e2ce6a79b9f769888cb9554179bcef3b0001a1d56dc0db5412e32a87e02cfbb31', 3, 'COE12B009', '', 11, '500', 1421557090, 0, 1),
(21, '0ca234c27ff7c8e1a85dd7d1056c010efc43d747ac915bd38a2bd7a41baa2307160520fe654cf58a9b153cd5258d31923ba5c2d88cfce051f2811994ff9cf1fe', 3, 'COE12B009', '', 17, '500', 1421560685, 0, 4),
(85, '65842149d174012fa63e0e8bbcf1d95f899e2d6fee06be778e48a591ef0973cca12ee6b1d74d6356746daf94bc6fdccb0d7183528663d88ac065c6e1db58fe1d', 7, 'COE12B009', '', 3, '600', 1421597193, 0, 1),
(198, 'd9cfaa4ff2647270f7c4b035dd7d1a0558c8c5cb48dcaaca967e1960d4499df684978df90aba43b81a9e2e972dda2836ec047809bfd3d2a77ed68b3257ce492a', 7, 'COE12B009', '', 6, '600', 1423592703, 1, 1),
(187, '46e95b83cceea3f15ce1cb7d1d1846de9f7b4c561afc82997a06bbe13902b649d746100697c13259fd58a6be113f52011f777f729e7db4d36fb8b3d45b4962e9', 8, 'COE12B009', '', 2, '600', 1421691127, 1, 1),
(86, '4d7770a26d8983ce78ec801a3a42dc2d3c86c8b398eb6278aa82b34aae4af0947c8978dcf9dc69e51187e417e6d15fe232f62087890697ec725090195e0d3fff', 8, 'COE12B009', '', 3, '600', 1421597193, 0, 1),
(17, '402e9d5eef69a371ef92d609b19753131b720db3b90ac19d41b8ec0a53655dc250ebd02d33cd53256017da93e1fa5491a7749c557e63504f7db30594a788e698', 9, 'COE12B009', '', 1, '700', 1421559732, 0, 3),
(15, '8448dd4497de7c4460fe568e68970a5a4da8917b1b5dc16cd759d8b372473834aa7d1134f444fa289997dbacae376a977745734c37ace5b6bf620f3d96ddf131', 9, 'COE12B009', '', 2, '700', 1421559720, 0, 6),
(45, '4c07714fef7bf1de6e3d8f7a145ef9602e837dc8f095eb2d7910a555dee2fbddc1e2b9209b4bd1c2af6075f66a97e868291fddbd3209d17df05200d5d9dd3926', 9, 'COE12B009', '', 3, '700', 1421587931, 0, 3),
(43, '6f753dcd39313beab45ed92d2932d34d8ff8ce3fd54028c257ca0b26daafbcaef1bf877fbed8f00f45bc01b5876c5639cd34e5a5f869770f5772a7890336cead', 9, 'COE12B009', '', 4, '700', 1421587808, 0, 3),
(47, '0138acac86fdd2e82f6d4af942477d30e61891f7a773faa864986b0446d3497d9684c7e0c1672d43fe75268a6fbcb934ebf1f5d91dcffb772fe31f7432d40570', 9, 'COE12B009', '', 5, '700', 1421587935, 0, 3),
(62, 'ada172e5ad76767dd680e52fd3bb4fd485a9cf6b576d3058714269a876943221da9b3dd8ce3f574fb3da4635cec9fedaa8af217a86d5fa47ed835e70936bfb51', 9, 'COE12B009', '', 6, '700', 1421589037, 0, 2),
(60, 'aafc3bc64a5bdc2efe4114399744e6364be18905708b1259f72b9abe24022f352a094b9b5cb6729ccccb018760477f8d2d302a2dbc905a47c3e2d548e7f6b0a5', 9, 'COE12B009', '', 7, '700', 1421589032, 0, 3),
(58, '3023c4620b6bc575efe7466fe0964d5b089366403ccaa936cf96a21e553e48431891cccde97c67b37ca1ad66b00beee39de292009a84ecd1384385d4bfbdd396', 9, 'COE12B009', '', 8, '700', 1421589029, 0, 3),
(56, '51c41d98a7d526a98bb424711a0a800d29de2af993d76ad977565138bab57423abcedde97ea7ef266bb6ab53769e1a941636bd9fc02aac8894f46d4843aa241f', 9, 'COE12B009', '', 9, '700', 1421589026, 0, 4),
(25, '135e8684d6e8d108e5124be909afc5d844468451f5a48ad8aca65c6ee668c532c093e6a93bea8b2039eec7bcff4cc960b057e40f32ca895d5e5f0c9905f93ac6', 9, 'COE12B009', '', 10, '700', 1421585691, 0, 6),
(93, 'b5cbf6c0146b0bdc66abdff105ad8dd0453479d4eee800356d3dae2fe42e30113f073dadcf3fe19ed2846208888352938bbf58333c700cac9fe9730395a2f3d3', 9, 'COE12B009', '', 12, '700', 1421604987, 0, 3),
(95, '3c446229f5cf3c16d7dbfbc0f0db4d6b9c1e16d9e3d55fb86d6a3bd8b623afa3125dfeda03a2435272996e29d4d8cef8613109226db6dfa460a2b2a169ac8dda', 9, 'COE12B009', '', 13, '700', 1421605013, 0, 3),
(97, '164dd2d2564a3d1f7300a34ef2cd1e43c031879a6273ed26412366ff72bb248e6caf92f09f3f670466d4857dc14049f2f8be6927e218a54900b99677486a6d40', 9, 'COE12B009', '', 14, '700', 1421605017, 0, 3),
(99, 'edd9c30b579cd24912576de8ffa09fd158cc300ebf3c87ab1176814138afe4b9419443265edc31d44ee931a5c5a6b47adac1e84a00c17dafc8b7c144f2ffd8f0', 9, 'COE12B009', '', 15, '700', 1421605020, 1, 3),
(77, '1c35309d995a4c4828e7492b0583f6f3b0829ff85b31a2fe39b1effd63c42110d09b866d44c9a71468685e9cf14eacd654ce5eb9deddaba1224c33ac82c9cf8f', 9, 'COE12B009', '', 16, '700', 1421590975, 0, 8),
(138, 'c3de4ce683c258b4b911b912efe59c99378d779cc07d0a4bb6b99ab7f9bc5d762aeef4357ac54850f191539d3e6f191d8ac060ce06ee2f434d6614f0e5af37c0', 9, 'COE12B009', '', 18, '700', 1421615515, 1, 1),
(18, '3b06dbc59b65e4ed93099ce42f77e3b2684759bcea72031e24598c1480a15faf84211de041074a65f2912d60f55469779f8fe39098d28f95481bc3fd898603c5', 10, 'COE12B009', '', 1, '700', 1421559732, 0, 3),
(16, '661497d57a655c2645a9a888b6ddaf3ad86e8f21e99ef98cacf99442a6d1ca16194a0e5841435d04f2e456c4e8ba5e3f24fbe09f13b102ac59303ff7a054567f', 10, 'COE12B009', '', 2, '700', 1421559720, 0, 6),
(46, 'c1e98b6a47a302503cc3caa99f5a703b7df28db54ff85af17096d79eebd12a24be47864eee0f79d46c0f0beaeabb5fce5ccc4b914fb08295188291c8219e15ab', 10, 'COE12B009', '', 3, '700', 1421587931, 0, 3),
(44, '885736c537f8f2d747506e6e2b9fe2c2f473c9c7a19482faef3c0e623e21f1a271a87d4265d5dbbba1a9eadcd4cc98c7190224282b46ddd42e29805d4b7f7cfb', 10, 'COE12B009', '', 4, '700', 1421587809, 0, 3),
(48, '91ace54d21c7b281ac98346bd8689006de7bc46508bc6da6bb6ddf55f4e69501b51d7ea7eaeddf5df81f6b9a9460e71f248412d25a1479cdf16a72bbe07b553b', 10, 'COE12B009', '', 5, '700', 1421587935, 0, 3),
(63, 'a9ae6236bfd1c8fdfc1ef06942d722cec649d1ea211a3985022a3ef2c545b55cfda262f595ca3e077b3ffd038d87f6ee345f52dceec002e7255d134c933a5104', 10, 'COE12B009', '', 6, '700', 1421589037, 0, 2),
(61, 'eeeb7b24dfb4b59f480595dc3e5808e73e3281318416d3a59a29bb9a86889aeb8251e40d9d77d5eaa70d56eb930c755d82e03731a483183c0b181a95a0e04f76', 10, 'COE12B009', '', 7, '700', 1421589032, 0, 3),
(59, '567ad01826300ec2eb295474c704f500933d11db0dadb6d11da50e0f26d877e5887088abb389d5f8cba1a21a544ecb9a1a939631a05ec6c4394004d2b1750309', 10, 'COE12B009', '', 8, '700', 1421589029, 0, 3),
(57, 'f6523501cfeef3386e0d5d6171c4e10e349b92a94b07fce021457bf96c99472879364d1a654d96c2d0f53b06c9995d49dae0509cd281915e9dcf975b873b67f7', 10, 'COE12B009', '', 9, '700', 1421589026, 0, 4),
(26, '2c91f457e04757ea36f1b09f800ab9789d2e2e85c58dd3bba8e83919178adb674faac8f7977c84f16d8d43fd92e4bf3274ba5b9c92214ac913f3b644a2a8a591', 10, 'COE12B009', '', 10, '700', 1421585691, 0, 6),
(103, '57e673b360e918ff5f20f0ca7a622b19748a4797326241cb9335b6f4cf820205fbd25dcb7900989aaeb244ede3c1d3672d05238ed50eebded955eb73ee344c66', 10, 'COE12B009', '', 11, '700', 1421605028, 1, 3),
(94, 'f577d518dff4689ceeb2e9c2a7134bf9233fe6c1b921bd2cc465031a9671711f2a9d2ea9f4bcdf94524b32cd729b986c8a5b62b99fd90e451b562e99bf11c11a', 10, 'COE12B009', '', 12, '700', 1421604987, 0, 3),
(96, '7d650f6041740611f31c4992cb9b9f298819fb9023dae818c10cc7c7f83b53513b3d62f6b22df8fa9914513ef0002590aacaa58b471df4c66ebdc67312dfcf54', 10, 'COE12B009', '', 13, '700', 1421605013, 0, 3),
(98, 'f88eeea0d302494e53a3f2359e10d6dfd28f3559a2fadd5b9adbaeada4f60bb54a51be42fbdb5ad72875798f174958f437ea0e2460cc4db45cc1a94903b4eafc', 10, 'COE12B009', '', 14, '700', 1421605017, 0, 3),
(100, '7d39b556e44c7f20f547a4c43363ba386cd07ef17d6a37cdf24e25286605f8a12dae01ae94b538cdbff2c7c1e128392652569ebd522310536c8adf0a63409938', 10, 'COE12B009', '', 15, '700', 1421605020, 0, 3),
(78, '2ffac4e6d1341a63c7377d7743a287ac16081cc4aa0396af084bddf9ad235b0114ccbb39135ad89c32f67340fcf4af9aa76b5c35bf96bc621980ef129c678a2e', 10, 'COE12B009', '', 16, '700', 1421590975, 0, 5),
(141, '055ed1c354a3b10d0d7d76a55333153ce3ee7b1d0a94b1af21b24b261e90ee008b4b9969aca135be7db26f5f30a8a841f52c3860f451d0ba79cebfa43681ebf2', 10, 'COE12B009', '', 17, '700', 1421615530, 1, 2),
(139, '4be09c38833f8de0c8563fa4d1dd9e2df578c09c5d06bd841791885a0bf2130c3122bf451891aa84fac634ab90b542dd8f8236e13b368464a398151ed3b6498c', 10, 'COE12B009', '', 18, '700', 1421615515, 1, 1),
(192, 'fd1a170a7545720c776545ab624535525028fe26bb2c5fb03cddfa705c8582b6362eee76f1438531f04a90b85fa77dbb4f0bb8fa5a93923df72e8e12b2d7fbaf', 10, 'COE12B009', '', 19, '700', 1422565398, 0, 2),
(221, 'cd0b7ba704b2a10bdd4c0447be12239afa90c73ef96a3028a1901085efe142bf0bc37821e35ac303d93762ca08deef52470849ec92a83f1673024b6ee02a0fba', 11, 'COE12B009', '', 0, '600', 1424033535, 1, 1),
(222, 'a8f47dd401db885029650746bdae05b6f3c2a6de57f38de41194e4877cda8f64f01e2d2e47c80eb6aade2abad07cebb57924956599ba4ba656d701eb90329598', 12, 'COE12B009', '', 0, '600', 1424033607, 1, 1),
(19, '4a967e899f237e64dbe7b195b61b3fc37d49d74ff7db5226f046e91615236c03210c4f0644b8a2ceff98e97f2500d945734bb8fa44c96a6a0d91b767696df8c9', 10, 'COE12B012', '', 1, '700', 1421559732, 0, 3),
(7, 'c914ed0546548a34389c6d0a6aea1bc595de08d7c4c3dd0ad4cf28c8641a1a5d93dfe231eaebd998647bab1bbc427e63d21b05d1ea3dad8ff7cb80f345e8fdb5', 1, 'COE12B013', '', 17, '500', 1421556297, 1, 1),
(9, '6dcc6132875ef53fba860636c33cefc33eadb38725e61c7ddb256cb22b97cd1e7391f3c52599d328dcd12ff0bc45d77181be3b83ce2864058269e1265ba704bf', 2, 'COE12B013', '', 17, '500', 1421556303, 1, 1),
(125, '1e927f1550eac198c1f76076925d5d422ff0e6a633127fa5f34c338cccd86f555b1b1debce8acb9f2834d5be552bb3590d3c20e3135956a51978e9d5442bbb32', 3, 'COE12B013', '', 10, '500', 1421605918, 1, 1),
(11, '8b6fc8520707131ee385f03b75606b8a07fa026e876ac4f7708e580f5123ce185a0063175e13628278003cdb0c11c6e879d80bd7d50934005dac91ad625b121d', 3, 'COE12B013', '', 11, '500', 1421557090, 1, 1),
(8, 'ad7f3143d4f68228a38a303280a386db67512fa352b55ae58ab6a580bd92778efd1173ba4c1b99ed28c59ab1475aae056bf11c59403692fdfd20cba444f581f7', 3, 'COE12B013', '', 17, '500', 1421556303, 1, 9),
(30, '972b20b59d7b1b61bd7cd715a53e03e4f3e109df56ebe0844de0e686a64df0635e655813ba306356b92d454f0e49456c2a9e13148a5ab77a93a6b96f1da67911', 10, 'COE12B013', '', 1, '700', 1421587464, 1, 2),
(24, '4efefcd93fcfa8f3b9d88935659b4d33712126f982698c000812562402430a860490c2af3b3b8ceb0353e478cd96bf266e9a9101346030bf281d7cc70cdef5c6', 10, 'COE12B013', '', 2, '700', 1421579166, 1, 5),
(223, 'f6bbd7fd55fc39b3a4182f3fcd1c89a3ea7ba2dddd6302d60ce7b5d138582b85cbbe232234d7e637e5ddbae57c210ddee08112cef9ca3ed1e1c8140d0ce73cd0', 16, 'COE12B013', '', 25, '700', 1424103822, 0, 1),
(224, '0bf1a8fda3d29f8261c461549bf798f98b88ae9e508cecf54b2365ce4e795273b9cdd79328f2233fdbf7489ff8b8fec9d78b387c9ed90747a7339043f6d612c7', 16, 'COE12B013', '', 26, '700', 1424103844, 0, 1),
(225, '2b3549edbe658b1be09fd6005f579995fbf469966d050653fbc6f6b2883c69f7859d8bc67ccd3ff2578eb9feae56b721404b28466b819566efa103af22ae1ec2', 16, 'COE12B013', '', 27, '700', 1424103857, 0, 1),
(226, 'd423af47150ea917f52aadc6fd9d9da7fce5049904d2584adac210fc581a736bb50507759bac8d489ab410307f96454f45c420ec7ddbaeebe465e8724fddff55', 16, 'COE12B013', '', 28, '700', 1424103885, 0, 1),
(227, '54093002ba75db2622842d89a10460b1fd73790245611bf53fbad174d7b36b7aa7a489b9c7ff92bb190c11bc16ea1d2491a3e367aacc36294aafaea2a231e2fc', 16, 'COE12B013', '', 29, '700', 1424105855, 0, 1),
(84, 'dea54caf275911241ccefaa7630c4dc3dfb79e18f918505fec60da43114ecc0479c673f2dc57354901d23a08b242d2d2ce2eb102b2fa9e2d58321fda67bb18dc', 7, 'COE12B017', '', 1, '600', 1421597188, 0, 2),
(83, '0d4e992e4c4f9ed2c9fe469612286d5bb8bc7dfaa5908d3511c55ebbc0769ab4cf00b617c41c9df138fe460ba5cf8674787dd547b1a51a3adbdbbd4cec55f026', 7, 'COE12B017', '', 2, '600', 1421597187, 0, 3),
(38, '187758a18bf6478267f0718200c829c8fbe6dc00b6d8ecfedee9aef59f3c3a4b7c4901240beca21387f96caf0553d095c4ac5bf19f2d8fd16cda825f0354358f', 10, 'COE12B020', '', 1, '700', 1421587536, 0, 1),
(42, '802c543f0f5810caca3e5b21a75d714eab41636e5be502c445f4411643d75bb63884e2fefb619a0fd0e37309364428258514dcad11c9d2269bee42b31f63e8a6', 10, 'COE12B020', '', 2, '700', 1421587594, 0, 3),
(50, '81a6030874f202a5905580b2405d2cd5bfc615c1a01faa4774224b4ec8a0887d26c88714d83e0f15ba7ab01699c1b59a293cf8fad0775df7c824b913d182d471', 10, 'COE12B020', '', 10, '700', 1421588306, 0, 5),
(220, 'b72f561ad98da670f0ce8f5464f3bbc7d55efbddcbf90c9472bbda65f8f0443ca7d5d7acaee96132135b82609705ab23bf43fdb7fb143592fd648953270d46a5', 7, 'COE12B021', '', 2, '600', 1424027034, 0, 1),
(197, '9fc838dd47cd45a222c1782a450e6e4cbcb77e0ada91efcc8f5acf953bc5f2f6b14ec2f1300d47d1658c3d6f58f9829718a43623ecf35f019d84bc814c4ef348', 7, 'COE12B021', '', 5, '600', 1423592671, 0, 1),
(215, 'e0f45147946f9d85bd5c221cd7223071f07c9f32dbad8287eb104cee6dad1f931ce80711838097a46bb92f6663c4f89da91ecc45a511f34c0f16c279a42aafb1', 3, 'COE12B025', '', 17, '500', 1424008978, 0, 1),
(209, '0a13baa42855eafa8368b34c4b5247a3ebef3b2938b424215e30ec2a50595cdbe8c8b22b194ddfc775eebdc046deb606cd007df8fa71c4f7144aa539f3a7a19b', 7, 'COE12B025', '', 7, '600', 1423921526, 0, 1),
(193, 'fe58709c04abc4e1804ce8896ae0d479394baeeca27e79239d3d6929a5cd54e4fe1b6062d38e4a302fafb7b2114115aab92f365ee18eb203413b27c305d0c546', 10, 'COE12B025', '', 19, '700', 1422792406, 0, 1),
(51, '560cd2869bffcfdb52f660bed3706a86fbbdba34c5c90fae1c0ae3568bc27a11fa2c0f28189324f47bd7b451a080b64b55122c2555009ec18c7fd1a7057bdebb', 9, 'COE12B030', '', 11, '700', 1421588803, 0, 5),
(74, 'cb032d2b944f2858ffaea23928b12e317cb963aafb38875e9661c403ae0d9a55f5c40b9d318c8321bc236b2aa96ee6ce2d6e5fa807588a1e5a7e149d3255f46b', 10, 'COE12B030', '', 2, '700', 1421589051, 0, 2),
(69, '5e9073acdf554bcb5af5463c329837f7023cee7caba8c7a65b8f5f782528f7ef7a1b1818443bed130a518a41972ac27cd6ee4538406604c1fcdbba9ea37b7cee', 10, 'COE12B030', '', 3, '700', 1421589047, 0, 2),
(67, 'c27f8e2fe7111d2758a099b8562d3e1bdf074e2bdd55b895ffabca9d102ddf88c7157d6686cfe839a0eb8df6337b256bcba0ba021cf2c035da334acfd6e09da8', 10, 'COE12B030', '', 4, '700', 1421589044, 0, 2),
(65, '681cdc58739cd826ef1adcdd6274e0095baf99f5654001a06d9fcffbb4d6f9a1f2d5c66db217860ebc68c26f367e518d5f9360684e92edf08953f7a5cd9ece4a', 10, 'COE12B030', '', 5, '700', 1421589040, 0, 2),
(55, '0ce0ca5954de6515d7befa9f3a422736269d94e8de7fab536b10d6c829d450ee3c1b118d7860df9bcab9d9dfaedb0091425c0ee2bdf6ccb6c38780a856c12c17', 10, 'COE12B030', '', 10, '700', 1421589023, 0, 4),
(52, 'db3da247d2b1bb5f3a265397259ba5a4b4360ff9c112eb9e2ed64736b712d4869efeaeb4f2606d0ab8345c4ec48106e9e3b5fe58aa474c3eea15868e7c82db52', 10, 'COE12B030', '', 11, '700', 1421588804, 0, 5),
(14, 'b22bb2edbb559adc56c998b4b86c8e48a65cfdac5521bcd26c52a0422700d1819e366e52afe9d842269b28b1b9c6b0941f8e8a1a73b9858191522d4d2ac37a14', 2, 'COE13B004', '', 16, '500', 1421557130, 0, 1),
(13, '2773d51ea2292de9d494f7837ded7c79542b25819e1afe81fed2ccb9e377bcfc91fbc4b9ab6508aefbd085791f44db7ff6b84f897e8f0fa20d7727adbbc35b55', 3, 'COE13B004', '', 16, '500', 1421557130, 0, 1),
(191, '36c97779560a5e4c631e260d34f432259d76b99b646bb1e35039f0e06a34b34056b556b0db4f36cee539905c0b317c99875e568f586d2c1fe4f1f94ba358954e', 10, 'EDM11B021', '', 19, '700', 1421694499, 0, 3),
(33, '66f75ce2b8e093f405868cdbbdc9f7746092d127b8bdedcfe427b7b0507a77ccbf35e53df50926316b31b6b93b1d463f5576c709502e8067b02cb90640411867', 10, 'EDM12B002', '', 2, '700', 1421587508, 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `p1c`
--

CREATE TABLE IF NOT EXISTS `p1c` (
`commentId` int(11) NOT NULL,
  `content` text NOT NULL,
  `userId` text NOT NULL,
  `personTags` longtext,
  `timestamp` bigint(20) NOT NULL,
  `commentIdHash` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `p2c`
--

CREATE TABLE IF NOT EXISTS `p2c` (
`commentId` int(11) NOT NULL,
  `content` text NOT NULL,
  `userId` text NOT NULL,
  `personTags` longtext,
  `timestamp` bigint(20) NOT NULL,
  `commentIdHash` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `p3c`
--

CREATE TABLE IF NOT EXISTS `p3c` (
`commentId` int(11) NOT NULL,
  `content` text NOT NULL,
  `userId` text NOT NULL,
  `personTags` longtext,
  `timestamp` bigint(20) NOT NULL,
  `commentIdHash` varchar(128) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `p3c`
--

INSERT INTO `p3c` (`commentId`, `content`, `userId`, `personTags`, `timestamp`, `commentIdHash`) VALUES
(1, 'This is a new comment tested for sure.\nNew comment for sure. New comment.', 'COE12B009', '', 1418140940, '8122b703cb14aa7fe4370e91dc2757ebd3dc7ace4be8a20642ef42e9f362d10ed57f29cfba40975fa15457fcf2fbab764bb19fb8e9f92e8cab7fa04a19fa47a5');

-- --------------------------------------------------------

--
-- Table structure for table `p4c`
--

CREATE TABLE IF NOT EXISTS `p4c` (
`commentId` int(11) NOT NULL,
  `content` text NOT NULL,
  `userId` text NOT NULL,
  `personTags` longtext,
  `timestamp` bigint(20) NOT NULL,
  `commentIdHash` varchar(128) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `p4c`
--

INSERT INTO `p4c` (`commentId`, `content`, `userId`, `personTags`, `timestamp`, `commentIdHash`) VALUES
(1, 'This is a new comment', 'COE12B011', '', 1421514716, '8122b703cb14aa7fe4370e91dc2757ebd3dc7ace4be8a20642ef42e9f362d10ed57f29cfba40975fa15457fcf2fbab764bb19fb8e9f92e8cab7fa04a19fa47a5');

-- --------------------------------------------------------

--
-- Table structure for table `p5c`
--

CREATE TABLE IF NOT EXISTS `p5c` (
`commentId` int(11) NOT NULL,
  `content` text NOT NULL,
  `userId` text NOT NULL,
  `personTags` longtext,
  `timestamp` bigint(20) NOT NULL,
  `commentIdHash` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `p6c`
--

CREATE TABLE IF NOT EXISTS `p6c` (
`commentId` int(11) NOT NULL,
  `content` text NOT NULL,
  `userId` text NOT NULL,
  `personTags` longtext,
  `timestamp` bigint(20) NOT NULL,
  `commentIdHash` varchar(128) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `p6c`
--

INSERT INTO `p6c` (`commentId`, `content`, `userId`, `personTags`, `timestamp`, `commentIdHash`) VALUES
(1, 'This is a new comment', 'COE12B011', '', 1421514647, '8122b703cb14aa7fe4370e91dc2757ebd3dc7ace4be8a20642ef42e9f362d10ed57f29cfba40975fa15457fcf2fbab764bb19fb8e9f92e8cab7fa04a19fa47a5');

-- --------------------------------------------------------

--
-- Table structure for table `p7c`
--

CREATE TABLE IF NOT EXISTS `p7c` (
`commentId` int(11) NOT NULL,
  `content` text NOT NULL,
  `userId` text NOT NULL,
  `personTags` longtext,
  `timestamp` bigint(20) NOT NULL,
  `commentIdHash` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `p8c`
--

CREATE TABLE IF NOT EXISTS `p8c` (
`commentId` int(11) NOT NULL,
  `content` text NOT NULL,
  `userId` text NOT NULL,
  `personTags` longtext,
  `timestamp` bigint(20) NOT NULL,
  `commentIdHash` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `p9c`
--

CREATE TABLE IF NOT EXISTS `p9c` (
`commentId` int(11) NOT NULL,
  `content` text NOT NULL,
  `userId` text NOT NULL,
  `personTags` longtext,
  `timestamp` bigint(20) NOT NULL,
  `commentIdHash` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `p10c`
--

CREATE TABLE IF NOT EXISTS `p10c` (
`commentId` int(11) NOT NULL,
  `content` text NOT NULL,
  `userId` text NOT NULL,
  `personTags` longtext,
  `timestamp` bigint(20) NOT NULL,
  `commentIdHash` varchar(128) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `p10c`
--

INSERT INTO `p10c` (`commentId`, `content`, `userId`, `personTags`, `timestamp`, `commentIdHash`) VALUES
(1, 'ASDF', 'COE11B008', '', 1421605918, '8122b703cb14aa7fe4370e91dc2757ebd3dc7ace4be8a20642ef42e9f362d10ed57f29cfba40975fa15457fcf2fbab764bb19fb8e9f92e8cab7fa04a19fa47a5');

-- --------------------------------------------------------

--
-- Table structure for table `p11c`
--

CREATE TABLE IF NOT EXISTS `p11c` (
`commentId` int(11) NOT NULL,
  `content` text NOT NULL,
  `userId` text NOT NULL,
  `personTags` longtext,
  `timestamp` bigint(20) NOT NULL,
  `commentIdHash` varchar(128) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `p11c`
--

INSERT INTO `p11c` (`commentId`, `content`, `userId`, `personTags`, `timestamp`, `commentIdHash`) VALUES
(1, 'This is a new comment', 'COE12B009', '', 1421556328, '8122b703cb14aa7fe4370e91dc2757ebd3dc7ace4be8a20642ef42e9f362d10ed57f29cfba40975fa15457fcf2fbab764bb19fb8e9f92e8cab7fa04a19fa47a5'),
(2, 'This is a comment by me', 'COE12B012', '', 1421557090, '3ade034661698c76b1e1d166e9cdb24a50e36acebdf072ddf0c8c578cc6ee7a26ed3c6ea68ac1f744f9fa443810a675bd2467ab7f1c8c2922d03a4b5a8795f9a'),
(3, 'A new comment added! and I edited it!', 'COE11B005', '', 1423589233, '002c5f4230c72e4696a68f63591abc7c0678fc73e4ded86e5fba21d7204b416a4e6c139fd1a0635af9b005afefd6effc7b6bab5f01a2bbad72ce32fde69eedf0'),
(4, 'One more new comment!', 'COE11B005', '', 1423589964, '16462edf7108a40bc1639284722e6c662964c1d527ce89113d63264cc20841c0f297f6d1044894d581e3196b3d9ca89eb201f469edde1f5e2ae62a8e95b107e1');

-- --------------------------------------------------------

--
-- Table structure for table `p14c`
--

CREATE TABLE IF NOT EXISTS `p14c` (
`commentId` int(11) NOT NULL,
  `content` text NOT NULL,
  `userId` text NOT NULL,
  `personTags` longtext,
  `timestamp` bigint(20) NOT NULL,
  `commentIdHash` varchar(128) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `p14c`
--

INSERT INTO `p14c` (`commentId`, `content`, `userId`, `personTags`, `timestamp`, `commentIdHash`) VALUES
(1, 'fdfklds', 'COE12B013', '', 1421563861, '8122b703cb14aa7fe4370e91dc2757ebd3dc7ace4be8a20642ef42e9f362d10ed57f29cfba40975fa15457fcf2fbab764bb19fb8e9f92e8cab7fa04a19fa47a5');

-- --------------------------------------------------------

--
-- Table structure for table `p16c`
--

CREATE TABLE IF NOT EXISTS `p16c` (
`commentId` int(11) NOT NULL,
  `content` text NOT NULL,
  `userId` text NOT NULL,
  `personTags` longtext,
  `timestamp` bigint(20) NOT NULL,
  `commentIdHash` varchar(128) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `p16c`
--

INSERT INTO `p16c` (`commentId`, `content`, `userId`, `personTags`, `timestamp`, `commentIdHash`) VALUES
(1, 'jdlfa', 'COE12B012', '', 1421557130, '8122b703cb14aa7fe4370e91dc2757ebd3dc7ace4be8a20642ef42e9f362d10ed57f29cfba40975fa15457fcf2fbab764bb19fb8e9f92e8cab7fa04a19fa47a5');

-- --------------------------------------------------------

--
-- Table structure for table `p17c`
--

CREATE TABLE IF NOT EXISTS `p17c` (
`commentId` int(11) NOT NULL,
  `content` text NOT NULL,
  `userId` text NOT NULL,
  `personTags` longtext,
  `timestamp` bigint(20) NOT NULL,
  `commentIdHash` varchar(128) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `p17c`
--

INSERT INTO `p17c` (`commentId`, `content`, `userId`, `personTags`, `timestamp`, `commentIdHash`) VALUES
(1, 'This is a comment by me', 'COE12B013', '', 1421560685, '8122b703cb14aa7fe4370e91dc2757ebd3dc7ace4be8a20642ef42e9f362d10ed57f29cfba40975fa15457fcf2fbab764bb19fb8e9f92e8cab7fa04a19fa47a5'),
(2, 'This is a new comment', 'COE12B009', '', 1421566162, '3ade034661698c76b1e1d166e9cdb24a50e36acebdf072ddf0c8c578cc6ee7a26ed3c6ea68ac1f744f9fa443810a675bd2467ab7f1c8c2922d03a4b5a8795f9a'),
(4, 'fdsfds', 'COE12B009', '', 1421566169, '16462edf7108a40bc1639284722e6c662964c1d527ce89113d63264cc20841c0f297f6d1044894d581e3196b3d9ca89eb201f469edde1f5e2ae62a8e95b107e1'),
(5, 'This is a new comment', 'COE12B001', '', 1421598827, '18d6f9b5a48789e88d055af1ca6e547874dfd4092d7648ce24f6ad2e123bab8c92ca2b566ee87e6335c7073d499c81a47dec69632126d12eb2159ef209a4d343'),
(6, 'My first comment before release. Lemme edit it once', 'COE12B025', '', 1422568738, 'b5609506aef9376108347f9ef0044d7b4254b86c99568a86ae3761b46e4ba405d160ef15637e30646924b6a53e7447bbcf40c4862e94723197b7ff1dfffa2676');

-- --------------------------------------------------------

--
-- Table structure for table `p18c`
--

CREATE TABLE IF NOT EXISTS `p18c` (
`commentId` int(11) NOT NULL,
  `content` text NOT NULL,
  `userId` text NOT NULL,
  `personTags` longtext,
  `timestamp` bigint(20) NOT NULL,
  `commentIdHash` varchar(128) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `p18c`
--

INSERT INTO `p18c` (`commentId`, `content`, `userId`, `personTags`, `timestamp`, `commentIdHash`) VALUES
(1, 'fadsf is byme', 'COE12B009', '', 1421683588, '8122b703cb14aa7fe4370e91dc2757ebd3dc7ace4be8a20642ef42e9f362d10ed57f29cfba40975fa15457fcf2fbab764bb19fb8e9f92e8cab7fa04a19fa47a5');

-- --------------------------------------------------------

--
-- Table structure for table `p19c`
--

CREATE TABLE IF NOT EXISTS `p19c` (
`commentId` int(11) NOT NULL,
  `content` text NOT NULL,
  `userId` text NOT NULL,
  `personTags` longtext,
  `timestamp` bigint(20) NOT NULL,
  `commentIdHash` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `p20c`
--

CREATE TABLE IF NOT EXISTS `p20c` (
`commentId` int(11) NOT NULL,
  `content` text NOT NULL,
  `userId` text NOT NULL,
  `personTags` longtext,
  `timestamp` bigint(20) NOT NULL,
  `commentIdHash` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `p21c`
--

CREATE TABLE IF NOT EXISTS `p21c` (
`commentId` int(11) NOT NULL,
  `content` text NOT NULL,
  `userId` text NOT NULL,
  `personTags` longtext,
  `timestamp` bigint(20) NOT NULL,
  `commentIdHash` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `p22c`
--

CREATE TABLE IF NOT EXISTS `p22c` (
`commentId` int(11) NOT NULL,
  `content` text NOT NULL,
  `userId` text NOT NULL,
  `personTags` longtext,
  `timestamp` bigint(20) NOT NULL,
  `commentIdHash` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `p23c`
--

CREATE TABLE IF NOT EXISTS `p23c` (
`commentId` int(11) NOT NULL,
  `content` text NOT NULL,
  `userId` text NOT NULL,
  `personTags` longtext,
  `timestamp` bigint(20) NOT NULL,
  `commentIdHash` varchar(128) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `p23c`
--

INSERT INTO `p23c` (`commentId`, `content`, `userId`, `personTags`, `timestamp`, `commentIdHash`) VALUES
(1, 'fdasfasdfads', 'COE11B005', '', 1423817636, '8122b703cb14aa7fe4370e91dc2757ebd3dc7ace4be8a20642ef42e9f362d10ed57f29cfba40975fa15457fcf2fbab764bb19fb8e9f92e8cab7fa04a19fa47a5'),
(2, 'fadsf', 'COE11B005', '', 1423817770, '3ade034661698c76b1e1d166e9cdb24a50e36acebdf072ddf0c8c578cc6ee7a26ed3c6ea68ac1f744f9fa443810a675bd2467ab7f1c8c2922d03a4b5a8795f9a'),
(3, 'this is a new comment', 'COE11B005', '', 1423817974, '002c5f4230c72e4696a68f63591abc7c0678fc73e4ded86e5fba21d7204b416a4e6c139fd1a0635af9b005afefd6effc7b6bab5f01a2bbad72ce32fde69eedf0'),
(4, 'THis is a new commnet today', 'COE11B005', '', 1423818066, '16462edf7108a40bc1639284722e6c662964c1d527ce89113d63264cc20841c0f297f6d1044894d581e3196b3d9ca89eb201f469edde1f5e2ae62a8e95b107e1'),
(5, 'fadsfa', 'COE11B005', '', 1423818104, '18d6f9b5a48789e88d055af1ca6e547874dfd4092d7648ce24f6ad2e123bab8c92ca2b566ee87e6335c7073d499c81a47dec69632126d12eb2159ef209a4d343');

-- --------------------------------------------------------

--
-- Table structure for table `p24c`
--

CREATE TABLE IF NOT EXISTS `p24c` (
`commentId` int(11) NOT NULL,
  `content` text NOT NULL,
  `userId` text NOT NULL,
  `personTags` longtext,
  `timestamp` bigint(20) NOT NULL,
  `commentIdHash` varchar(128) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `p24c`
--

INSERT INTO `p24c` (`commentId`, `content`, `userId`, `personTags`, `timestamp`, `commentIdHash`) VALUES
(1, 'fadsas', 'COE12B009', '', 1424017541, '8122b703cb14aa7fe4370e91dc2757ebd3dc7ace4be8a20642ef42e9f362d10ed57f29cfba40975fa15457fcf2fbab764bb19fb8e9f92e8cab7fa04a19fa47a5');

-- --------------------------------------------------------

--
-- Table structure for table `poll`
--

CREATE TABLE IF NOT EXISTS `poll` (
  `pollId` int(11) NOT NULL,
  `pollIdHash` varchar(128) NOT NULL,
  `userId` varchar(9) NOT NULL,
  `sharedWith` varchar(200) NOT NULL,
  `pollType` int(11) NOT NULL,
  `question` longtext NOT NULL,
  `options` mediumtext NOT NULL,
  `optionsType` tinyint(1) NOT NULL,
  `optionCount` int(11) NOT NULL,
  `optionVotes` text NOT NULL,
  `votedBy` longtext NOT NULL,
  `timestamp` bigint(20) NOT NULL,
  `approvalStatus` tinyint(1) NOT NULL DEFAULT '0',
  `pollStatus` tinyint(1) NOT NULL DEFAULT '1',
  `seenBy` longtext NOT NULL,
  `seenCount` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `poll`
--

INSERT INTO `poll` (`pollId`, `pollIdHash`, `userId`, `sharedWith`, `pollType`, `question`, `options`, `optionsType`, `optionCount`, `optionVotes`, `votedBy`, `timestamp`, `approvalStatus`, `pollStatus`, `seenBy`, `seenCount`) VALUES
(2, '5e35561202448dbb76e2a337060c28692a9d70c3627a97c2f2dc13c4542f49e5e4d97033b4719b3ec5836a1d1db51ce5640036ded3ea4e56f1ff4c245cfdb214', 'COE12B009', 'All', 1, 'Against whom India might loose the match in CWC 2015?', 'Austraila,Pakistan,South africa,England,New zealand,Sri Lanka', 2, 6, '1,0,1,0,0,0', 'COE12B009', 1424111130, 1, 1, '', 0),
(3, '6c3b5a62fa26c9e18e026fdc3feae29b824103141efe1da6d93e2427511c72003b6cb3cd9a735d3719da8a3b4460e1b7e86778633efe878136467ce91d22c427', 'COE12B009', 'All', 1, 'Will India win the world cup 2015?', 'Yes,No', 1, 2, '0,1', 'COE12B009', 1424113586, 1, 1, '', 0),
(1, 'e3f3f592e12c59604b055a6f77147d94945a6af96405b918fc5222bd099dcf2711ca6e3f08958365209eb8e280c53111dd13e992d6bfd708c76f29828d40f0f2', 'COE12B009', 'All', 1, 'Will India win the world cup 2015 in australia?', 'Yes,No', 1, 2, '1,0', 'COE12B009', 1424109708, 1, 1, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `postId` int(11) NOT NULL,
  `postIdHash` varchar(128) NOT NULL,
  `userId` varchar(9) NOT NULL,
  `subject` varchar(300) NOT NULL,
  `content` longtext NOT NULL,
  `filesAttached` longtext,
  `taggedUsers` longtext,
  `timestamp` bigint(20) NOT NULL,
  `lastUpdated` bigint(20) NOT NULL,
  `sharedWith` varchar(200) NOT NULL,
  `displayStatus` tinyint(1) NOT NULL DEFAULT '1',
  `starCount` int(11) NOT NULL DEFAULT '0',
  `starredBy` longtext,
  `mailCount` int(11) NOT NULL,
  `mailedBy` longtext,
  `seenCount` int(11) NOT NULL DEFAULT '0',
  `seenBy` longtext,
  `commentCount` int(11) NOT NULL,
  `followers` longtext,
  `lifetime` bigint(20) NOT NULL,
  `requestPermanence` tinyint(1) NOT NULL,
  `isPermanent` tinyint(1) NOT NULL DEFAULT '0',
  `likeIndex` bigint(20) NOT NULL,
  `commentIndex` bigint(20) NOT NULL,
  `popularityIndex` bigint(20) NOT NULL,
  `mailToIndex` bigint(20) NOT NULL,
  `impIndex` bigint(20) NOT NULL,
  `hiddenTo` text NOT NULL,
  `spamCount` int(11) NOT NULL DEFAULT '0',
  `reportedBy` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`postId`, `postIdHash`, `userId`, `subject`, `content`, `filesAttached`, `taggedUsers`, `timestamp`, `lastUpdated`, `sharedWith`, `displayStatus`, `starCount`, `starredBy`, `mailCount`, `mailedBy`, `seenCount`, `seenBy`, `commentCount`, `followers`, `lifetime`, `requestPermanence`, `isPermanent`, `likeIndex`, `commentIndex`, `popularityIndex`, `mailToIndex`, `impIndex`, `hiddenTo`, `spamCount`, `reportedBy`) VALUES
(3, '002c5f4230c72e4696a68f63591abc7c0678fc73e4ded86e5fba21d7204b416a4e6c139fd1a0635af9b005afefd6effc7b6bab5f01a2bbad72ce32fde69eedf0', 'COE12B009', 'Post 3', 'Post content 3 edited', '', NULL, 1417870325, 1421328664, 'All', 1, 3, 'COE12B010,COE12B011,COE12B009', 0, NULL, 0, NULL, 1, 'COE12B009', 180, 0, 0, 1421080280, 1418005632, 3406288165, 1417870325, 4256820930, '', 0, NULL),
(10, '063859ea196cd7a74b97a93fac2314c3f95488b92e3c01d6d7974bc5a7894fa492262404dbfec17d77a123ca815984845a5fcb321ba42368d68eeff01dadff55', 'COE12B009', 'Post 10', 'Post content 10', '', NULL, 1417870416, 1417870416, 'All', 1, 1, 'COE11B005', 0, NULL, 0, NULL, 1, 'COE12B009,COE12B013,COE11B008', 1433422416, 1, 0, 1420857513, 1419738167, 3408490947, 1417870416, 4256598345, '', 0, NULL),
(4, '16462edf7108a40bc1639284722e6c662964c1d527ce89113d63264cc20841c0f297f6d1044894d581e3196b3d9ca89eb201f469edde1f5e2ae62a8e95b107e1', 'COE12B009', 'Post 4', 'Post content 4', '', NULL, 1417870336, 1417870336, 'All', 1, 0, NULL, 0, NULL, 0, NULL, 1, 'COE12B009,COE12B011', 1433422336, 1, 0, 1417870336, 1419692526, -889527424, 1417870336, 0, '', 0, NULL),
(5, '18d6f9b5a48789e88d055af1ca6e547874dfd4092d7648ce24f6ad2e123bab8c92ca2b566ee87e6335c7073d499c81a47dec69632126d12eb2159ef209a4d343', 'COE12B009', 'Post 5', 'Post content 5', '', NULL, 1417870349, 1417870349, 'All', 1, 0, NULL, 0, NULL, 0, NULL, 0, 'COE12B009', 1433422349, 1, 0, 1417870349, 1417870349, 0, 1417870349, 0, '', 0, NULL),
(9, '364914000384bed0262785397eba883665368b890b61fb6e09fdf9de9dbc9e5f437fe5335631cc45573575bd08cc677a2a726e91eed4660fb5fc1cf4c06f6301', 'COE12B009', 'Post 9', 'Post content 9', '', NULL, 1417870407, 1417870407, 'All', 1, 1, 'COE11B005', 0, NULL, 0, NULL, 0, 'COE12B009', 1433422407, 1, 0, 1420730262, 1417870407, 3405748832, 1417870407, 4256471076, '', 0, NULL),
(7, '39571dfb43075615981912ab79caa736f0f04b2fd1b66a550871ca370ac321197984fb5c54b8c22e64d3dac535d8a4088e068122e06ce736b8b16f54f01b9190', 'COE12B009', 'Post 7', 'post content 7', '', NULL, 1417870378, 1417870378, 'All', 1, 1, 'COE11B005', 0, NULL, 0, NULL, 0, 'COE12B009', 1433422378, 1, 0, 1420730257, 1417870378, 3405748786, 1417870378, 4256471013, '', 0, NULL),
(2, '3ade034661698c76b1e1d166e9cdb24a50e36acebdf072ddf0c8c578cc6ee7a26ed3c6ea68ac1f744f9fa443810a675bd2467ab7f1c8c2922d03a4b5a8795f9a', 'COE12B009', 'Post 2', 'Post content 2', '', NULL, 1417870314, 1417870314, 'All', 1, 1, 'COE12B009', 0, NULL, 0, NULL, 0, 'COE12B009', 1433422314, 1, 0, 1419630830, 1417870314, 3404649270, 1417870314, 4255371458, '', 0, NULL),
(18, '3c5ef8611c22b918a88673b9a07b946515b6efb6569ba58b40b0d7704f4b3414c8e51edad46e7b288a669795316eaae6f6c1745cf11c207f6308df7b08a089c5', 'COE11B001', 'fdsf', 'dasfdasf', '', NULL, 1421617859, 1421617859, 'All', 1, 2, 'COE12B009,COE11B005', 0, NULL, 0, NULL, 1, 'COE11B001,COE12B009', 1421704259, 0, 0, 1422617354, 1421650723, 3412928366, 1421617859, 4265853072, '', 0, NULL),
(17, '68f33370d0db1f2037635cb9286a3c22db2e942145f9f80611d7001e8804e00400d8e4ebd036829caf3c9376dcf9b2bd61a0def437678b2aad705b24c336de71', 'COE12B009', 'fads', 'fdasfda', '', NULL, 1421558925, 1421558925, 'All', 1, 3, 'COE12B009,COE11B005,COE11B008', 1, 'COE12B009', 0, NULL, 5, 'COE12B009,COE12B013,COE12B001,COE11B005,COE12B025', 1437110925, 1, 0, 1421600046, 1422086015, -882446829, 1422783951, 4267167948, 'COE11B008,COE11B005', 0, NULL),
(1, '8122b703cb14aa7fe4370e91dc2757ebd3dc7ace4be8a20642ef42e9f362d10ed57f29cfba40975fa15457fcf2fbab764bb19fb8e9f92e8cab7fa04a19fa47a5', 'COE12B009', 'Post 1', 'Post content 1', '', NULL, 1417870276, 1417870276, 'All', 1, 0, NULL, 0, NULL, 0, NULL, 0, 'COE12B009', 1433422276, 1, 0, 1417870276, 1417870276, 0, 1417870276, 0, '', 0, NULL),
(24, '84c1044f26d289e6ee0e96c64eebf64f680713e8b3ea618a2b7a1b2c3442e3ec50bbd72a32a7bae8188b77299d143b48adc73d312a5670f2505a36e4b30a1161', 'COE12B009', '', 'raesfda', '', NULL, 1424009829, 1424009829, 'All', 1, 1, 'COE12B009', 0, NULL, 0, NULL, 1, 'COE12B009', 1424096229, 0, 0, 1424009843, 1424013700, -877338273, 1424009829, 4272029501, 'COE12B009', 1, 'COE12B009'),
(19, '8cacf9884b078223fd528638d7c152e70d572cc98a91d9513ca731fd3b01f1050a1074c88a12872748ad9c1f056b89a5f2b08514b691e92938c3be57cd8c4285', 'COE11B005', 'fds', 'fdas', '', NULL, 1423807743, 1423807743, 'b,m', 1, 1, 'COE11B005', 0, NULL, 0, NULL, 0, 'COE11B005', 1423894143, 0, 0, 1423813620, 1423807743, 3417144460, 1423807743, 4271429106, '', 0, NULL),
(11, '9915f5c0c382e3c9ae6dde708f26e1ea5092341b5d8a8e16d51f9bcd5b7ea0b00d15dfc2c5585e93a9293a11956da0e02943822847d495331cc7129c3400c8af', 'COE12B009', 'Post 11', 'Post content 11', '', NULL, 1417870429, 1417870429, 'All', 1, 2, 'COE12B009,COE11B005', 0, NULL, 0, NULL, 4, 'COE11B005', 1433422429, 1, 0, 1421725259, 1422851098, 3413716796, 1417870429, 4257466117, 'COE11B008', 0, NULL),
(6, 'b5609506aef9376108347f9ef0044d7b4254b86c99568a86ae3761b46e4ba405d160ef15637e30646924b6a53e7447bbcf40c4862e94723197b7ff1dfffa2676', 'COE12B009', 'Post 6', 'Post content 6', '', NULL, 1417870363, 1417870363, 'All', 1, 1, 'COE11B005', 0, NULL, 0, NULL, 1, 'COE12B009,COE12B011', 1433422363, 1, 0, 1420857515, 1419692505, 3408427022, 1417870363, 4256598241, '', 0, NULL),
(23, 'c8add0496b3861cf807270d4d11e33c59122c10ce7d62302b3b2f135cefed96aa4f6f040c7ad259543c8ff24ae4a189d953d727976132c30aabc36af40fceb8a', 'COE11B005', 'a', 'a', '', NULL, 1423817237, 1423817237, 'All', 1, 2, 'COE11B005,COE12B009', 0, NULL, 0, NULL, 5, 'COE11B005', 1423903637, 0, 0, 1423857166, 1423818015, 3417202387, 1423817237, 4271491640, '', 0, NULL),
(16, 'ca78af70697ec3785dfd3b0f4153491a70301f7a39d8ac2ba50fe65a9f695ebb03ef6d18040d85ede1de1e8a70e340f78feaf228530f7a5e79133b1dd5cdedb5', 'COE13B004', 'fds', 'fdsfds', '', NULL, 1421505323, 1421505323, 'All', 1, 0, NULL, 0, NULL, 0, NULL, 1, 'COE13B004,COE12B012', 1421591723, 0, 0, 1421505323, 1421531226, -883318256, 1421505323, 0, 'COE12B013', 0, NULL),
(8, 'd7e3c3e07e768c84515242733f4bdeb924e3471cc989b7fc395a6ec6ab0b4d726fccc77e93dbed8ba92e9b9574130f243947eb01353cf46b78d1c3525dfea2b3', 'COE12B009', 'Post 8', 'Post content 8', '', NULL, 1417870394, 1417870394, 'All', 1, 1, 'COE11B005', 0, NULL, 0, NULL, 0, 'COE12B009', 1433422394, 1, 0, 1420730255, 1417870394, 3405748806, 1417870394, 4256471043, '', 0, NULL),
(21, 'e869947b6db245934841b796dcb1476960c62bdb7d6060100626269b9b9c083ed5a1b417061bdf44f201da503b0ffeaeceec4bde585f359a70ade6ba7fd60125', 'COE11B005', 'fadsf', 'adfs', '', NULL, 1423817082, 1423817082, 'All', 1, 1, 'COE11B005', 0, NULL, 0, NULL, 0, 'COE11B005', 1423903482, 0, 0, 1423818218, 1423817082, 3417162133, 1423817082, 4271452382, '', 0, NULL),
(14, 'f4802c7c94b232011936f0004433d9f987175934a30a9f546ed5cd09a1437882db637a464f42326afeeb64472ed60be931f807a4f099bdd829162fdd911b221a', 'COE12B013', 'fadf', 'dfdf', '', NULL, 1421327282, 1421327282, 'All', 1, 0, NULL, 0, NULL, 0, NULL, 1, 'COE12B013', 1421413682, 0, 0, 1421327282, 1421445571, -883616214, 1421327282, 0, '', 0, NULL),
(20, 'fa5220f92c04bb06cde09e47a22153063f19651bd3e4c95498d6228077404f7edc1267ab45728393f1896987079df8d27cea8d470601c01fa4459e2e5cbd9ac6', 'COE11B005', 'fads', 'fdas', '', NULL, 1423817066, 1423817066, 'All', 1, 1, 'COE11B005', 0, NULL, 0, NULL, 0, 'COE11B005', 1423903466, 0, 0, 1423818269, 1423817066, 3417162161, 1423817066, 4271452401, '', 0, NULL),
(22, 'fe0c24ae925b445b203e0a9de702e7f9007b462d5450c6ddd3a4d05fa9912a09ea20c16d0f98a1096a7433d5c9aac021ac7f8a341ac00ac99d9c5a3e6f8cbda0', 'COE11B005', 'dfasf', 'afdsfd', '', NULL, 1423817230, 1423817230, 'All', 1, 2, 'COE11B005,COE12B009', 0, NULL, 0, NULL, 0, 'COE11B005', 1423903630, 0, 0, 1423857170, 1423817230, 3417201292, 1423817230, 4271491630, '', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
`projectId` int(11) NOT NULL,
  `userId` varchar(9) NOT NULL,
  `organisation` tinytext NOT NULL,
  `projectName` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  `start` bigint(20) NOT NULL,
  `end` bigint(20) NOT NULL,
  `description` text NOT NULL,
  `teamMembers` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`projectId`, `userId`, `organisation`, `projectName`, `role`, `start`, `end`, `description`, `teamMembers`) VALUES
(2, 'COE12B025', 'org 2', '4pi45', 'Backend developer, algo designer of post', 1410546600, 1419964200, '4pi is an interactive social media website like facebook for students of iiitKancheepuram', 'Not specified'),
(3, 'COE12B025', 'IIIITD&M Kancheepuram', 'Students portal', 'Web developer', 1420050600, 1422556200, 'fdasfdsfasfdasfdsfasfdasfdsfasfdasfdsfasfdasfdsfasfdasfdsfasfdasfdsfasfdasfdsfasfdasfdsfasfdasfdsfasfdasfdsfasfdasfdsfasfdasfdsfasfdasfdsfasfdasfdsfasfdasfdsfasfdasfdsfasfdasfdsfasfdasfdsfasfdasfdsfasfdasfdsfasfdasfdsfasfdasfdsfasfdasfdsfasfdasfdsfasfdasfdsfasfdasfdsfasfdasfdsfasfdasfdsfasfdasfdsfas', 'Avinash, Hari, Sai kumar'),
(4, 'COE12B025', '', 'fads', '', 1420569000, 1421087400, '', ''),
(7, 'COE12B025', '', 'Studnets portal', '', 0, 0, '', ''),
(10, 'COE12B025', '', 'new project', '', 0, 0, '', ''),
(11, 'COE12B005', 'kjfnbvsfv', 'asfgvdsak', 'SDFNJAS', 1202322600, 1422815400, 'sfdojgvspojk\nadfsjgvbpos\nd''jfgvf\nifojgvkf\nfjvokbg', 'jnkdvjn'),
(12, 'COE12B025', 'fdas', 'fdsf', 'fadsf', 1422815400, 1423247400, 'fdsf', 'fda'),
(14, 'COE11B005', 'ms', 'New project', 'developer', 1422901800, 1424457000, 'asdf asd fasf', 'a,a,b,,,c,,adf,'),
(17, 'COE12B009', '', 'fds', '', 0, 0, '', 'Individual'),
(18, 'COE12B009', '', 'fad', '', 0, 0, '', 'Individual'),
(19, 'COE12B009', '', 's', '', 0, 0, '', 'Individual');

-- --------------------------------------------------------

--
-- Table structure for table `reportspams`
--

CREATE TABLE IF NOT EXISTS `reportspams` (
`reportId` int(11) NOT NULL,
  `userId` varchar(9) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `objectId` int(11) NOT NULL,
  `objectType` int(11) NOT NULL,
  `reason` text NOT NULL,
  `adminClearance` tinyint(1) NOT NULL DEFAULT '0',
  `clearanceTimestamp` bigint(11) DEFAULT NULL,
  `admin` varchar(9) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `reportspams`
--

INSERT INTO `reportspams` (`reportId`, `userId`, `timestamp`, `objectId`, `objectType`, `reason`, `adminClearance`, `clearanceTimestamp`, `admin`) VALUES
(1, 'COE12B013', '2014-10-24 13:34:22', 2, 0, 'Some Hypothetical Reason!!', 0, NULL, NULL),
(2, 'COE12B009', '2015-02-15 18:37:23', 24, 0, 'fadsfads', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `resetpassword`
--

CREATE TABLE IF NOT EXISTS `resetpassword` (
`resetRequestId` int(11) NOT NULL,
  `extHash` varchar(128) NOT NULL,
  `isValid` tinyint(1) NOT NULL DEFAULT '1',
  `userId` char(9) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `resetpassword`
--

INSERT INTO `resetpassword` (`resetRequestId`, `extHash`, `isValid`, `userId`) VALUES
(1, 'e8ae6ce018cc60f1008950219edc50803a803721fc06a44e5228335b3c06562e36d10859816ec086d96686fe2850ddea6cca79a6be86b14a8112501a7a3bfc0d', 1, ''),
(2, 'eab25ae9896fdbc6633b9ab5d762740d428989dc98a94143b0cb4980e484f9cf0a083453e93353898bf101990a4bdf652742043fa3a67b5d221a27476993294e', 1, ''),
(3, '11043b2ed6700d79abbd0709b6432f2a49a1dce8ebc08a47bbe56f195a89ad38cf8f9b540105d9b8edc4999983f39fe3b8dc20d0adac4aedd1bdbe46db2dc977', 1, ''),
(4, '0e79e0c89ec1dbc3aa18e0e81d044e10cbcfc90f109999292963b30cf4605fb6d190e0ce996fd37300d09272b1352c84cc194558bbb4d76634b3de1ee3b5727b', 1, ''),
(5, 'db1d25f055444525ee593f9b05e9d7ae6a55e16b7d78bc495aa8bdb095a1be150feee4fb32455345092c0f04ae5e260bd6f987574fef4b33d80fd80c01be67d1', 1, ''),
(6, 'ca8f48bf8467d9d6ebd6304343376f1c7043615b08c5236527cd75d846120395a62aa734a3e1eb1f0ba28b6db6d62ad828d7b101e1e6bb453bda0bcbea99bf38', 1, ''),
(7, '2b613a4c17f5d26f5fb871a397e9f3b1584c042ebb150f241dbc22fd32b3a3f42c0892452f7bba2a6fb17dff89a87eaa599176e086d74efbe7276edcd2e974ca', 1, ''),
(8, '470abf61f8be056fad08b62e0e7a08de4022848ac12bf27263272e261839ff6bcd95a01d40d7c88fc6db8bc25e73cfccb71f7c793b596d5790bd1fcf6592553e', 1, ''),
(9, '0721646bd6055ec076a6abaeb96fcc2d7033d3235bf1edcc5e0f0d0179be751f92c345febf5fe6d8cfc084f5df1aa4de31276ce0fb9e7b305d83f516a266b9f6', 1, ''),
(10, 'e49246cd25efc7a5dd7fcc6052106c4658bdc61124a731d56cb1a1c666c24b922cfbb339d5fbe8b067f154466c70621a1722a7383dd8842fe177551922f59118', 1, ''),
(11, '1e1836e2fa772964e0d71b9cf15c9f0168ac2ac8838685ce6608ffb1c00130b04e768b60a96590aec840f83e4b093b378149b162463951ae80e36dec0a2b9bbd', 1, ''),
(12, '67f89ad12ac3dfebab50023d452a4f2650141ced42cc2030d0a3659e8addfab589fa8407dce2bcda5cbdb41f7b8e3940721ac8e91ca682273583391639af4145', 1, ''),
(13, '82986c0c89f2a7e1d21a46124f24a5de61d48ca03ee2de6ce3f1c118a9862ebf244e57007a2832d054cc986a37ffa78545109b9fc2e92e10fc76352f54776e8e', 1, ''),
(14, 'edc7c08ebdb22e16f6ae4c3a1d2104807e240a1cd3630bc65fa792c9fd6f604aa46f20b4120203af3c4903e6ee3614ee41910070289b1657862e7424af678a79', 1, ''),
(15, '71380de996d46f619bf34b7cc1a3b546fb9e5a381cc28e8553605e0d803883747999125136226b863b10f94bfae7991d207ac10a468bbd84b04735795a083287', 1, ''),
(16, 'dc882494cffa8813441ab84eeaa0a2a01f849416a80f29cc4ea54e5494a9b24e8aa81d948819c275195dab9fa282cff5ecbdabe9528f8e7bcad8253920218252', 1, ''),
(17, '91d4e4f004d9103984ab08cf5bf4bfc45a866206fdac5723f1c8a207ea3fbf62292bd158a61e1acdd908587d848c183d858b62ce4b66c654c4277154b6ac9fd9', 1, ''),
(18, '145c643a98769712c630886f1701e2f9a44fd49bb960af428786866374f06484f15b0150c83e1a688a7a1a856828b6391ec11be974542397b749f3f4a1417471', 1, ''),
(19, '8a02aa646d5dc7ec05260bed79fe7470e6ee566149db3932afe3edaee5243db90b4ec19ec77d94708d26a9f4fa7f6949783483ad39a2555553c1aad2317bea53', 1, 'coe12b013'),
(20, '8aa25f9fa631af941a6ba89c950e296cb558a960a9cec368e0d64cda4060c3af463fae836a2f724f957ae4b1217750e6e1e82e40cccdc4b093a3caafbfde1e51', 1, 'coe12b013'),
(21, 'e6132806d254a8463e522c1622d3de270d1135a6cfb47dad610fe783761768b5729a7e98631f7dd44e9d20fdff769ec88fac39d0a9cc837ad409ce74f8f8e3db', 1, 'coe12b013'),
(22, 'eb624260c8a717891f7ec1f265821dfa503efd23d06bc9796f418370b08a92334fdbe8c05f79f61a30ffb60578aaeab4bc4a7a48559b16320b3a4e899f70312c', 1, 'coe12b013'),
(23, '9fda4e1788fd20edb7cd8f36e148283c03cbbf08bc948c5ea4965c9ccbbd6f9cf23031086cd4614b80fcd2de2b1bec652690ef2621f981fd691b334c38a12a60', 1, 'coe12b013'),
(24, '344264879f55a3606d1bf77ae80e0900944beebff3e6acf0b8ac0d3539c122bafdbdac5c0c57ce3f85c5dcc52e9dc8ea58c46a1c624489855ed3446af118ea1b', 1, 'coe12b013'),
(25, '0d97166dcfb53332e0c0d013e3ed143e6d3a00095eb165532252fd4e1ea76f2e54e58afdf603bf6129a277cb5ba50b18ec6b7e831f74a8c79ff9743818136985', 1, 'coe12b013'),
(26, '5a68bb14d2b66a3affd6f74c09572b39c485c1785594bdd000d5a335a4d65561feb1b2eafeefecc6a1666b31ec550bc6ed11f77a98bd22dc91647fceba0ef62f', 1, 'coe12b013'),
(27, '8d4512721b4988aea9de4299025955d9adf812d0d204b7101d9e2adacc4a54de083f5b20c1f81b1cdde125b3fb34af6c63c88e96c42f62d2cdabfe81cf0bfdae', 1, 'coe12b013'),
(28, 'a6049e26843bacbd8ac1d78c44b68d738d2f59db5136ef414aa2d3e73974bb85b47a665f8963a70db0d27d4bed7995cd0caa32ab2dd774db68fe3e69e991cd8a', 0, 'coe12b013'),
(29, '3c14856abc63e241c1a4ba4add975f8834750c4530031c23d91fb3407783e74de0d3aae1d256008f3bd4382deea5ce1e6f31700e19eaaa289a9e7157e440a9fe', 0, 'coe12b013'),
(30, '578114846dbeffddd3f084d42cc6a8dd265ea687a19d25e0ffd87e9afcb50150d69272468eeada2a4e4bde8538986fa38b1642e152abba5a9211ffb1ca8c778e', 1, 'coe12b013'),
(31, 'fa8034ac82ffaa1794bc8b4fe950945dffb18211c3175b7e26f16baef53839bd82bfa9ae370329e5b0a0a62a1d2c9fa15d5114a3af74712c2a68417ba34f7411', 1, 'coe12b013'),
(32, '09db9b058e327c3436c0a6b474710a9c2bb38b6f2ac66fd70e1508f6fd14b8192464864fb3e85ca244e55cd37fd4064d6a66f4f114ac83e8c13c3a8dbaf95cef', 1, 'coe12b013'),
(33, '0dd8fa7f6fbb4c52976b2929bede3bf42054427939dda9b464b022f0edc48a9ab5fcd1c1670e66130d9b93aee61dea15b5eec795a9775699793a912d993d75d9', 1, 'coe12b009'),
(34, 'd0b090bcf5f3c91590176151007f6cb32f6f4cef5cc3290c378e290f893c6b40d49cb3a10c443eab75c396c494156d61ee49d4eac4dbe31245a3cc7d64e6d9f9', 1, 'coe12b005'),
(35, '78b6f2cc0c2a3ae5bac93110f2297dbf90a176ec1d78341134d3d75199d7684f50b49af720e7fa074fa912a695da5cfbc37471af09559be1fe5e7ac6566f3df9', 0, 'coe12b005'),
(36, 'cdd72c7c5fe317c435d3d60849b47b8bc73691a84961087df43c7d00f14d0b2946b6bc551fd5977b545ec32c6416e2e0cc674346b9aac8368956cd6041c060a1', 0, 'COE12B009'),
(37, 'd754ed86cee2e918cb2d7b427996a3d8d7f497acf549931783590093ca4ce2ec6659b36db2dcb7a5c886f6fd18b357646af0ac1140e7344cf0fea80516e71c88', 0, 'COE12B009'),
(38, '56066092369dfec01f0abe8ecad0680b3f347d61188d0fd2b58e59326fa9ace707656e1dd70d2e4e7d6a933cf8cc9aef88e3dc4d49f7557994e0f84a8ee763bc', 1, 'COE12B009');

-- --------------------------------------------------------

--
-- Table structure for table `skillset`
--

CREATE TABLE IF NOT EXISTS `skillset` (
  `userId` varchar(9) NOT NULL,
  `skills` text NOT NULL,
  `rating` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `skillset`
--

INSERT INTO `skillset` (`userId`, `skills`, `rating`) VALUES
('COE11B005', 'new skill', '86'),
('COE12B009', 'Javascript,HTML,PHP,CSS,gkhk,Laravel', '73,73,68,64,50,15'),
('COE12B014', 'php,matlab,Php,Phps,aa,gsf,as', '20,10,50,50,50,50,50'),
('COE12B024', 'php,matlab,MySQL,,New skill', '20,10,9,,50'),
('COE12B025', 'Photoshopfs,Photoshopfss,Photoshopfsssss,Photoshopfafadsfdas,php,mysql,Rubye,mysqlr,phpr,a,az,mysqls,phps,cxz,cxzsss,fdasf', '76,76,76,75,70,70,65,60,50,50,50,40,30,15,15,12');

-- --------------------------------------------------------

--
-- Table structure for table `suspicious`
--

CREATE TABLE IF NOT EXISTS `suspicious` (
`notificationId` int(11) NOT NULL,
  `userId` text NOT NULL,
  `suspicion` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=201 ;

--
-- Dumping data for table `suspicious`
--

INSERT INTO `suspicious` (`notificationId`, `userId`, `suspicion`, `timestamp`) VALUES
(1, 'COE12B009', 'Notify: Conn.Error:<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.logindetails'' doesn''t exist! In inserting LoginLog for userId:COE12B009', '2015-01-19 17:31:52'),
(2, 'COE12B006', 'Notify: Conn.Error<b>Prepare: </b> 1064 - You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ''AND event.eventIdHash!=?  ORDER BY timestamp DESC'' at line 1! While inserting in latestEvents', '2015-01-19 17:50:00'),
(3, 'COE12B006', 'Notify: Conn.Error<b>Prepare: </b> 1064 - You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ''AND event.eventIdHash!=?  ORDER BY timestamp DESC'' at line 1! While inserting in latestEvents', '2015-01-19 17:51:44'),
(4, 'COE12B006', 'Notify: Conn.Error<b>Prepare: </b> 1064 - You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ''AND event.eventIdHash!=?  ORDER BY timestamp DESC'' at line 1! While inserting in latestEvents', '2015-01-19 17:51:57'),
(5, 'COE12B006', 'Notify: Conn.Error<b>Prepare: </b> 1064 - You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ''AND event.eventIdHash!=?  ORDER BY timestamp DESC'' at line 1! While inserting in latestEvents', '2015-01-19 17:52:10'),
(6, 'COE12B006', 'Notify: Conn.Error<b>Prepare: </b> 1064 - You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ''AND event.eventIdHash!=?  ORDER BY timestamp DESC'' at line 1! While inserting in latestEvents', '2015-01-19 17:52:23'),
(7, 'COE12B006', 'Notify: Conn.Error<b>Prepare: </b> 1064 - You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ''AND event.eventIdHash!=?  ORDER BY timestamp DESC'' at line 1! While inserting in latestEvents', '2015-01-19 17:53:00'),
(8, 'COE12B006', 'Notify: Conn.Error<b>Prepare: </b> 1064 - You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ''AND event.eventIdHash!=?  ORDER BY timestamp DESC'' at line 1! While inserting in latestEvents', '2015-01-19 17:53:32'),
(9, 'COE12B006', 'Notify: Conn.Error<b>Prepare: </b> 1064 - You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ''AND event.eventIdHash!=? ORDER BY timestamp DESC'' at line 1! While inserting in latestEvents', '2015-01-19 17:57:56'),
(10, 'COE12B006', 'Notify: Conn.Error<b>Prepare: </b> 1064 - You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ''AND event.eventIdHash!=? ORDER BY timestamp DESC'' at line 1! While inserting in latestEvents', '2015-01-19 17:58:19'),
(11, 'COE12B006', 'Notify: Conn.Error<b>Prepare: </b> 1064 - You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ''AND event.eventIdHash!=? ORDER BY timestamp DESC'' at line 1! While inserting in latestEvents', '2015-01-19 17:58:39'),
(12, 'COE12B006', 'Notify: Conn.Error<b>Prepare: </b> 1064 - You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ''AND event.eventIdHash!=? ORDER BY timestamp DESC'' at line 1! While inserting in latestEvents', '2015-01-19 17:58:58'),
(13, 'COE12B006', 'Notify: Conn.Error<b>Prepare: </b> 1064 - You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ''AND event.eventIdHash!=? ORDER BY timestamp DESC'' at line 1! While inserting in latestEvents', '2015-01-19 18:03:44'),
(14, '0a806b877dee1e24a717de81ced1c7a4453d3f6f5a289110a1107ed0815c3302095f67c06174d3b244f7e169df9dde115babc9f0bef5765d40c547159b9d1c22', 'Blocked: Suspicious Session Variable in fetchLittlePolls,', '2015-01-19 18:15:20'),
(15, '0a806b877dee1e24a717de81ced1c7a4453d3f6f5a289110a1107ed0815c3302095f67c06174d3b244f7e169df9dde115babc9f0bef5765d40c547159b9d1c22', 'Blocked: Suspicious Session Variable in fetchLittleEvents,', '2015-01-19 18:15:20'),
(16, '0a806b877dee1e24a717de81ced1c7a4453d3f6f5a289110a1107ed0815c3302095f67c06174d3b244f7e169df9dde115babc9f0bef5765d40c547159b9d1c22', 'Blocked: Suspicious Session Variable in fetchLittlePosts,', '2015-01-19 18:15:20'),
(17, '', 'Notify: Conn.Error: ! In fetching Top Part of aboutMe:COE12B025', '2015-01-26 16:44:02'),
(18, '', 'Notify: Critical Error!! In createPost', '2015-01-28 13:55:36'),
(19, '', 'Notify: Critical Error!! In createPost', '2015-01-28 13:55:36'),
(20, '', 'Notify: Critical Error!! In createPost', '2015-01-28 13:56:06'),
(21, '', 'Notify: Critical Error!! In createPost', '2015-01-28 13:56:06'),
(22, '', 'Notify: Critical Error!! In createPost', '2015-01-28 13:56:54'),
(23, '', 'Notify: Critical Error!! In createPost', '2015-01-28 13:56:54'),
(24, '', 'Notify: Critical Error!! In createPost', '2015-01-28 13:57:14'),
(25, '', 'Notify: Critical Error!! In createPost', '2015-01-28 13:57:14'),
(26, 'COE13B004', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-28 13:58:38'),
(27, 'COE13B004', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-28 13:58:50'),
(28, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-28 16:44:25'),
(29, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-28 16:44:35'),
(30, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 06:12:25'),
(31, 'COE12B025', 'Notify: suspicious attempt to delete content in academics:', '2015-01-29 06:22:37'),
(32, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 07:33:19'),
(33, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 07:33:25'),
(34, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 10:21:06'),
(35, ',', 'Notify: Suspicious Session variable in CreatePost', '2015-01-29 11:52:03'),
(36, ',', 'Notify: Suspicious Session variable in CreatePost', '2015-01-29 11:52:03'),
(37, ',', 'Notify: Suspicious Session variable in CreatePost', '2015-01-29 11:52:12'),
(38, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 12:15:28'),
(39, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 13:56:35'),
(40, ',', 'Notify: Suspicious Session variable in CreatePost', '2015-01-29 14:47:11'),
(41, ',', 'Notify: Suspicious Session variable in CreatePost', '2015-01-29 14:47:11'),
(42, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 14:56:12'),
(43, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 15:02:42'),
(44, 'COE13B004', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 15:02:52'),
(45, '0a806b877dee1e24a717de81ced1c7a4453d3f6f5a289110a1107ed0815c3302095f67c06174d3b244f7e169df9dde115babc9f0bef5765d40c547159b9d1c22', 'Notify: Suspicious session variable in DeletePost', '2015-01-29 15:05:00'),
(46, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 21:00:59'),
(47, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 21:02:45'),
(48, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 21:02:55'),
(49, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 21:03:05'),
(50, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 21:03:10'),
(51, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 21:03:15'),
(52, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 21:03:20'),
(53, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 21:03:25'),
(54, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 21:03:35'),
(55, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 21:03:45'),
(56, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 21:03:55'),
(57, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 21:03:58'),
(58, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 21:04:08'),
(59, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 21:06:03'),
(60, 'COE12B009', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 21:08:50'),
(61, 'COE12B009', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 21:10:19'),
(62, 'COE12B009', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 21:11:59'),
(63, 'COE12B009', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 21:12:08'),
(64, 'COE12B009', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 21:12:18'),
(65, 'COE12B009', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 21:13:33'),
(66, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 21:15:02'),
(67, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 21:15:12'),
(68, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 21:18:49'),
(69, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 21:18:59'),
(70, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 21:19:09'),
(71, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 21:19:19'),
(72, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 21:19:29'),
(73, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 21:19:39'),
(74, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 21:19:49'),
(75, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 21:19:59'),
(76, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 21:20:09'),
(77, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 21:20:19'),
(78, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 21:20:29'),
(79, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 21:20:39'),
(80, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 21:20:49'),
(81, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 21:20:59'),
(82, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 21:21:09'),
(83, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 21:21:19'),
(84, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 21:21:29'),
(85, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 21:21:39'),
(86, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 21:21:49'),
(87, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 21:21:59'),
(88, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 21:22:09'),
(89, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1146 - Table ''iiitdmstudentsportal.event'' doesn''t exist! While inserting in littleEvents', '2015-01-29 21:47:45'),
(90, 'COE12B025', 'Notify: Conn.Error:<b>Prepare: </b> 1136 - Column count doesn''t match value count at row 1! In inserting LoginLog for userId:COE12B025', '2015-01-30 04:29:35'),
(91, 'COE12B025', 'Notify: Conn.Error:<b>Prepare: </b> 1136 - Column count doesn''t match value count at row 1! In inserting LoginLog for userId:COE12B025', '2015-01-30 04:29:40'),
(92, 'COE12B025', 'Notify: Conn.Error:<b>Prepare: </b> 1136 - Column count doesn''t match value count at row 1! In inserting LoginLog for userId:COE12B025', '2015-01-30 04:29:45'),
(93, 'COE12B025', 'Notify: Conn.Error:<b>Prepare: </b> 1136 - Column count doesn''t match value count at row 1! In inserting LoginLog for userId:COE12B025', '2015-01-30 04:30:23'),
(94, 'COE12B025', 'Notify: Conn.Error:<b>Prepare: </b> 1136 - Column count doesn''t match value count at row 1! In inserting LoginLog for userId:COE12B025', '2015-01-30 04:30:30'),
(95, 'COE12B025', 'Notify: Conn.Error:<b>Prepare: </b> 1136 - Column count doesn''t match value count at row 1! In inserting LoginLog for userId:COE12B025', '2015-01-30 04:30:46'),
(96, 'COE12B025', 'Notify: Conn.Error:<b>Prepare: </b> 1136 - Column count doesn''t match value count at row 1! In inserting LoginLog for userId:COE12B025', '2015-01-30 04:31:19'),
(97, 'COE12B025', 'Notify: Conn.Error:<b>Prepare: </b> 1136 - Column count doesn''t match value count at row 1! In inserting LoginLog for userId:COE12B025', '2015-01-30 04:31:55'),
(98, 'COE12B025', 'Notify: Conn.Error:<b>Prepare: </b> 1136 - Column count doesn''t match value count at row 1! In inserting LoginLog for userId:COE12B025', '2015-01-30 04:32:15'),
(99, 'COE12B025', 'Notify: Conn.Error:<b>Prepare: </b> 1136 - Column count doesn''t match value count at row 1! In inserting LoginLog for userId:COE12B025', '2015-01-30 04:35:46'),
(100, 'COE12B025', 'Notify: Conn.Error:<b>Prepare: </b> 1136 - Column count doesn''t match value count at row 1! In inserting LoginLog for userId:COE12B025', '2015-01-30 04:35:50'),
(101, 'COE12B025', 'Notify: Conn.Error:<b>Prepare: </b> 1136 - Column count doesn''t match value count at row 1! In inserting LoginLog for userId:COE12B025', '2015-01-30 04:38:43'),
(102, 'COE12B025', 'Notify: Conn.Error:<b>Prepare: </b> 1136 - Column count doesn''t match value count at row 1! In inserting LoginLog for userId:COE12B025', '2015-01-30 04:39:10'),
(103, 'COE12B009', 'Notify: Conn.Error<b>Prepare: </b> 1054 - Unknown column ''start'' in ''field list''! While creating record in experience', '2015-01-30 06:14:50'),
(104, 'COE12B009', 'Notify: Conn.Error<b>Prepare: </b> 1054 - Unknown column ''title'' in ''field list''! While creating record in experience', '2015-01-30 06:16:17'),
(105, 'COE12B025', 'Notify: Conn.Error:<b>Prepare: </b> 1052 - Column ''userId'' in where clause is ambiguous! In sending notifications for object id: , notif type: , to userId:COE12B025, FromUserId:', '2015-01-30 12:58:48'),
(106, 'COE12B025', 'Notify: Conn.Error:<b>Prepare: </b> 1052 - Column ''userId'' in where clause is ambiguous! In sending notifications for object id: , notif type: , to userId:COE12B025, FromUserId:', '2015-01-30 13:00:34'),
(107, 'COE12B025', 'Notify: Conn.Error:<b>Prepare: </b> 1052 - Column ''userId'' in where clause is ambiguous! In sending notifications for object id: , notif type: , to userId:COE12B025, FromUserId:', '2015-01-30 13:00:51'),
(108, 'COE12B025', 'Notify: Conn.Error:<b>Prepare: </b> 1052 - Column ''userId'' in where clause is ambiguous! In sending notifications for object id: , notif type: , to userId:COE12B025, FromUserId:', '2015-01-30 13:00:57'),
(109, 'COE12B025', 'Notify: Conn.Error:<b>Prepare: </b> 1052 - Column ''userId'' in where clause is ambiguous! In sending notifications for object id: , notif type: , to userId:COE12B025, FromUserId:', '2015-01-30 20:58:41'),
(110, 'COE12B024', 'Notify: Conn.Error:<b>Prepare: </b> 1052 - Column ''userId'' in where clause is ambiguous! In sending notifications for object id: , notif type: , to userId:COE12B024, FromUserId:', '2015-01-31 20:58:26'),
(111, 'COE12B013', 'Notify: Conn.Error:<b>Prepare: </b> 1052 - Column ''userId'' in where clause is ambiguous! In sending notifications for object id: , notif type: , to userId:COE12B013, FromUserId:', '2015-01-31 21:01:52'),
(112, 'COE12B025', 'Notify: Conn.Error:<b>Prepare: </b> 1052 - Column ''userId'' in where clause is ambiguous! In sending notifications for object id: , notif type: , to userId:COE12B025, FromUserId:', '2015-02-01 09:11:01'),
(113, 'COE12B005', 'Notify: Conn.Error:<b>Prepare: </b> 1052 - Column ''userId'' in where clause is ambiguous! In sending notifications for object id: , notif type: , to userId:COE12B005, FromUserId:', '2015-02-01 11:24:40'),
(114, 'COE12B025', 'Notify: suspicious attempt to change content in project:0', '2015-02-01 11:31:54'),
(115, 'COE12B025', 'Notify: suspicious attempt to change content in project:0', '2015-02-01 11:33:25'),
(116, 'COE12B025', 'Notify: suspicious attempt to change content in project:0', '2015-02-01 11:34:59'),
(117, 'COE12B025', 'Notify: suspicious attempt to change content in project:0', '2015-02-01 11:36:15'),
(118, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1054 - Unknown column ''start'' in ''field list''! While Editing record in experience', '2015-02-01 11:43:59'),
(119, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1054 - Unknown column ''start'' in ''field list''! While Editing record in experience', '2015-02-01 11:44:59'),
(120, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1054 - Unknown column ''start'' in ''field list''! While Editing record in experience', '2015-02-01 11:45:28'),
(121, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1054 - Unknown column ''start'' in ''field list''! While Editing record in experience', '2015-02-01 11:46:03'),
(122, 'COE12B025', 'Notify: Conn.Error:<b>Prepare: </b> 1052 - Column ''userId'' in where clause is ambiguous! In sending notifications for object id: , notif type: , to userId:COE12B025, FromUserId:', '2015-02-01 11:46:31'),
(123, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1054 - Unknown column ''start'' in ''field list''! While Editing record in experience', '2015-02-01 11:52:36'),
(124, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1054 - Unknown column ''start'' in ''field list''! While Editing record in experience', '2015-02-01 11:53:12'),
(125, 'COE12B025', 'Notify: Conn.Error<b>Prepare: </b> 1054 - Unknown column ''start'' in ''field list''! While Editing record in experience', '2015-02-01 11:54:01'),
(126, 'COE12B025', 'Notify: suspicious attempt to change content in academics:0', '2015-02-01 11:58:27'),
(127, 'COE12B025', 'Notify: suspicious attempt to change content in academics:0', '2015-02-01 11:59:03'),
(128, 'COE12B025', 'Notify: suspicious attempt to change content in academics:0', '2015-02-01 12:04:16'),
(129, 'COE12B025', 'Notify: suspicious attempt to change content in academics:0', '2015-02-01 12:04:36'),
(130, 'COE12B025', 'Notify: suspicious attempt to change content in academics:0', '2015-02-01 12:04:54'),
(131, 'COE12B025', 'Notify: suspicious attempt to change content in academics:0', '2015-02-01 12:05:22'),
(132, 'COE12B005', 'Notify: Conn.Error:<b>Prepare: </b> 1052 - Column ''userId'' in where clause is ambiguous! In sending notifications for object id: , notif type: , to userId:COE12B005, FromUserId:', '2015-02-01 12:05:59'),
(133, 'COE12B005', 'Notify: Conn.Error:<b>Prepare: </b> 1052 - Column ''userId'' in where clause is ambiguous! In sending notifications for object id: , notif type: , to userId:COE12B005, FromUserId:', '2015-02-01 12:06:27'),
(134, 'COE12B005', 'Notify: Conn.Error:<b>Prepare: </b> 1052 - Column ''userId'' in where clause is ambiguous! In sending notifications for object id: , notif type: , to userId:COE12B005, FromUserId:', '2015-02-01 12:06:54'),
(135, 'COE12B005', 'Notify: Conn.Error:<b>Prepare: </b> 1052 - Column ''userId'' in where clause is ambiguous! In sending notifications for object id: , notif type: , to userId:COE12B005, FromUserId:', '2015-02-01 12:07:50'),
(136, 'COE12B025', 'Notify: suspicious attempt to change content in academics:0', '2015-02-01 12:08:30'),
(137, 'COE12B025', 'Notify: suspicious attempt to change content in academics:0', '2015-02-01 12:16:50'),
(138, 'COE12B025', 'Notify: suspicious attempt to change content in academics:0', '2015-02-01 12:19:47'),
(139, 'COE12B025', 'Notify: suspicious attempt to change content in courses:0', '2015-02-01 12:35:06'),
(140, 'COE12B025', 'Notify: suspicious attempt to change content in achievements:0', '2015-02-01 12:37:55'),
(141, 'COE12B025', 'Notify: Conn.Error:<b>Prepare: </b> 1052 - Column ''userId'' in where clause is ambiguous! In sending notifications for object id: , notif type: , to userId:COE12B025, FromUserId:', '2015-02-02 14:53:13'),
(142, '', 'Notify: Wrong mode sent:', '2015-02-02 14:58:49'),
(143, '', 'Notify: Wrong mode sent:', '2015-02-02 14:59:46'),
(144, 'COE12B025', 'Notify: Conn.Error:<b>Prepare: </b> 1052 - Column ''userId'' in where clause is ambiguous! In sending notifications for object id: , notif type: , to userId:COE12B025, FromUserId:', '2015-02-06 05:29:51'),
(145, '', 'Notify: Conn.Error<b>Bind: </b> Bind array supplied must be a two dimensional associative array! While editing in about Edit', '2015-02-06 07:56:29'),
(146, '', 'Notify: Conn.Error<b>Bind: </b> Bind array supplied must be a two dimensional associative array! While editing in about Edit', '2015-02-06 07:59:59'),
(147, 'COE12B025', 'Notify: Conn.Error:<b>Prepare: </b> 1052 - Column ''userId'' in where clause is ambiguous! In sending notifications for object id: , notif type: , to userId:COE12B025, FromUserId:', '2015-02-06 13:44:17'),
(148, 'COE12B025', 'Notify: Conn.Error:<b>Prepare: </b> 1052 - Column ''userId'' in where clause is ambiguous! In sending notifications for object id: , notif type: , to userId:COE12B025, FromUserId:', '2015-02-06 13:45:04'),
(149, 'COE12B025', 'Notify: Conn.Error:<b>Prepare: </b> 1052 - Column ''userId'' in where clause is ambiguous! In sending notifications for object id: , notif type: , to userId:COE12B025, FromUserId:', '2015-02-06 13:47:04'),
(150, 'COE12B025', 'Notify: Conn.Error:<b>Prepare: </b> 1052 - Column ''userId'' in where clause is ambiguous! In sending notifications for object id: , notif type: , to userId:COE12B025, FromUserId:', '2015-02-06 13:47:11'),
(151, 'COE12B025', 'Notify: Conn.Error:<b>Prepare: </b> 1052 - Column ''userId'' in where clause is ambiguous! In sending notifications for object id: , notif type: , to userId:COE12B025, FromUserId:', '2015-02-06 13:50:23'),
(152, 'COE12B025', 'Notify: Conn.Error:<b>Prepare: </b> 1052 - Column ''userId'' in where clause is ambiguous! In sending notifications for object id: , notif type: , to userId:COE12B025, FromUserId:', '2015-02-06 13:55:16'),
(153, 'COE12B025', 'Notify: Conn.Error:<b>Prepare: </b> 1052 - Column ''userId'' in where clause is ambiguous! In sending notifications for object id: , notif type: , to userId:COE12B025, FromUserId:', '2015-02-06 13:55:59'),
(154, 'COE12B025', 'Notify: Conn.Error:<b>Prepare: </b> 1052 - Column ''userId'' in where clause is ambiguous! In sending notifications for object id: , notif type: , to userId:COE12B025, FromUserId:', '2015-02-06 13:56:37'),
(155, 'COE12B025', 'Notify: Conn.Error:<b>Prepare: </b> 1052 - Column ''userId'' in where clause is ambiguous! In sending notifications for object id: , notif type: , to userId:COE12B025, FromUserId:', '2015-02-06 13:56:39'),
(156, 'COE12B025', 'Notify: Conn.Error:<b>Prepare: </b> 1052 - Column ''userId'' in where clause is ambiguous! In sending notifications for object id: , notif type: , to userId:COE12B025, FromUserId:', '2015-02-06 13:57:07'),
(157, 'COE12B025', 'Notify: Conn.Error:<b>Prepare: </b> 1052 - Column ''userId'' in where clause is ambiguous! In sending notifications for object id: , notif type: , to userId:COE12B025, FromUserId:', '2015-02-06 15:44:17'),
(158, 'COE12B009', 'Notify: Conn.Error:<b>Prepare: </b> 1052 - Column ''userId'' in where clause is ambiguous! In sending notifications for object id: , notif type: , to userId:COE12B009, FromUserId:', '2015-02-07 13:24:33'),
(159, 'COE12B009', 'Notify: Conn.Error:<b>Prepare: </b> 1052 - Column ''userId'' in where clause is ambiguous! In sending notifications for object id: , notif type: , to userId:COE12B009, FromUserId:', '2015-02-07 13:28:17'),
(160, 'COE12B013', 'Notify: Conn.Error:<b>Prepare: </b> 1052 - Column ''userId'' in where clause is ambiguous! In sending notifications for object id: , notif type: , to userId:COE12B013, FromUserId:', '2015-02-07 13:28:27'),
(161, 'COE12B009', 'Notify: Conn.Error:<b>Prepare: </b> 1052 - Column ''userId'' in where clause is ambiguous! In sending notifications for object id: , notif type: , to userId:COE12B009, FromUserId:', '2015-02-08 13:11:09'),
(162, 'COE12B009', 'Notify: Conn.Error:<b>Prepare: </b> 1052 - Column ''userId'' in where clause is ambiguous! In sending notifications for object id: , notif type: , to userId:COE12B009, FromUserId:', '2015-02-08 14:09:57'),
(163, 'COE12B009', 'Notify: Conn.Error:<b>Prepare: </b> 1052 - Column ''userId'' in where clause is ambiguous! In sending notifications for object id: , notif type: , to userId:COE12B009, FromUserId:', '2015-02-08 14:10:33'),
(164, 'COE12B009', 'Notify: Conn.Error:<b>Prepare: </b> 1052 - Column ''userId'' in where clause is ambiguous! In sending notifications for object id: , notif type: , to userId:COE12B009, FromUserId:', '2015-02-08 14:14:16'),
(165, 'COE12B009', 'Notify: Conn.Error:<b>Prepare: </b> 1052 - Column ''userId'' in where clause is ambiguous! In sending notifications for object id: , notif type: , to userId:COE12B009, FromUserId:', '2015-02-08 14:14:31'),
(166, 'COE12B009', 'Notify: Conn.Error:<b>Prepare: </b> 1052 - Column ''userId'' in where clause is ambiguous! In sending notifications for object id: , notif type: , to userId:COE12B009, FromUserId:', '2015-02-08 14:20:19'),
(167, 'COE12B009', 'Notify: Conn.Error:<b>Prepare: </b> 1052 - Column ''userId'' in where clause is ambiguous! In sending notifications for object id: , notif type: , to userId:COE12B009, FromUserId:', '2015-02-08 17:40:55'),
(168, '', 'Notify: Conn.Error: ! In fetching Top Part of aboutMe:COE12B009', '2015-02-08 18:30:35'),
(169, '', 'Notify: Conn.Error<b>Prepare: </b> 1136 - Column count doesn''t match value count at row 1! While editing in about Edit', '2015-02-10 14:28:14'),
(170, 'COE12B009', 'Notify: Conn.Error<b>Bind: </b> Could not bind values to the query! While editing in about Edit', '2015-02-10 14:31:33'),
(171, 'COE12B009', 'Notify: Conn.Error<b>Bind: </b> Could not bind values to the query! While editing in about Edit', '2015-02-10 14:34:10'),
(172, 'COE12B009', 'Notify: Conn.Error<b>Bind: </b> Could not bind values to the query! While editing in about Edit', '2015-02-10 14:38:47'),
(173, 'COE12B009', 'Notify: Conn.Error<b>Bind: </b> Could not bind values to the query! While editing in about Edit', '2015-02-10 14:38:59'),
(174, '35ed1791e149553ba9d11bd2f57cb00e31903a2dab461259c435280ad699376696f29ebedfc4eb8996e28c5ed5055f01df9edca8b68c6cacf5c9a7b784174b91', 'Blocked: Suspicious Session Variable in setPassword,', '2015-02-10 16:37:35'),
(175, 'COE11B005', 'Notify: Conn.Error:<b>Prepare: </b> 0 - in inserting into reportspams. In reportpost.17', '2015-02-10 17:20:36'),
(176, '', 'Notify: SMTP Error: Could not authenticate.!!!! PostSubject: Mail Post Request for ''Post 11'' By ''BATTINOJU SAI KUMAR''', '2015-02-10 17:33:31'),
(177, 'COE11B005', 'Notify: Conn.Error:<b>Prepare: </b> 0 - in inserting into reportspams. In reportpost.11', '2015-02-13 06:06:14'),
(178, 'COE11B005', 'Notify: Conn.Error<b>Execute: </b> 1062 - Duplicate entry ''0'' for key ''PRIMARY''! In InsertFeedback', '2015-02-13 06:22:24'),
(179, '', 'Notify: Suspicious session variable in InsertComment', '2015-02-14 13:47:27'),
(180, ',', 'Notify: Suspicious Session variable in CreatePost', '2015-02-14 13:47:33'),
(181, ',', 'Notify: Suspicious Session variable in CreatePost', '2015-02-14 13:47:33'),
(182, '', 'Notify: SMTP Error: Could not connect to SMTP host.!!!! PostSubject: Registration starts on Students portal of IIITDM', '2015-02-14 19:48:29'),
(183, '', 'Notify: SMTP Error: Could not authenticate.!!!! PostSubject: Registration starts on Students portal of IIITDM', '2015-02-14 19:49:11'),
(184, 'COE12B009', 'Notify: Conn.Error:<b>Prepare: </b> 0 - in inserting into reportspams. In reportpost.17', '2015-02-15 14:02:35'),
(185, 'COE12B009', 'Notify: Conn.Error<b>Execute: </b> 1062 - Duplicate entry ''0'' for key ''PRIMARY''! In InsertFeedback', '2015-02-15 14:07:27'),
(186, 'COE12B009', 'Notify: Conn.Error:<b>Prepare: </b> 0 - in inserting into reportspams. In reportpost.24', '2015-02-15 16:10:01'),
(187, '', 'Notify: Suspicious session variable in InsertComment', '2015-02-15 16:52:06'),
(188, 'COE12B009', 'Notify: Conn.Error:<b>Prepare: </b> 0 - in inserting into reportspams. In reportpost.24', '2015-02-15 18:30:54'),
(189, 'COE12B009', 'Notify: Conn.Error:<b>Prepare: </b> 0 - in inserting into reportspams. In reportpost.24', '2015-02-15 18:31:56'),
(190, 'COE12B009', 'Notify: Conn.Error<b>Execute: </b> 1062 - Duplicate entry ''0'' for key ''PRIMARY''! In InsertFeedback', '2015-02-15 18:37:31'),
(191, '', 'Notify: <strong>Invalid address: </strong><br />!!!! MailSubject: kavinash366@gmail.com has sent you a message From 4Pi', '2015-02-16 18:50:34'),
(192, '', 'Notify: <strong>Invalid address: </strong><br />\n!!!! MailSubject: kavinash366@gmail.com has sent you a message From 4Pi', '2015-02-16 18:55:56'),
(193, '', 'Notify: <strong>Invalid address: </strong><br />\n!!!! MailSubject: kavinash366@gmail.com has sent you a message From 4Pi', '2015-02-16 18:56:59'),
(194, '', 'Notify: <strong>Invalid address: </strong><br />\n!!!! MailSubject: kavinash366@gmail.com has sent you a message From 4Pi', '2015-02-16 18:58:10'),
(195, '', 'Notify: <strong>Invalid address: </strong><br />\n!!!! MailSubject: kavinash366@gmail.com has sent you a message From 4Pi', '2015-02-16 18:58:12'),
(196, '', 'Notify: <strong>Invalid address: </strong><br />\n!!!! MailSubject: kavinash366@gmail.com has sent you a message From 4Pi', '2015-02-16 18:58:29'),
(197, '', 'Notify: <strong>Invalid address: </strong><br />\n!!!! MailSubject: kavinash366@gmail.com has sent you a message From 4Pi', '2015-02-16 18:58:40'),
(198, '', 'Notify: <strong>Invalid address: </strong><br />\n!!!! MailSubject: kavinash366@gmail.com has sent you a message From 4Pi', '2015-02-16 18:59:49'),
(199, '', 'Notify: <strong>Invalid address: </strong><br />\n!!!! MailSubject: kavinash366@gmail.com has sent you a message From 4Pi', '2015-02-16 19:00:02'),
(200, '', 'Notify: <strong>Invalid address: </strong><br />\n!!!! MailSubject: kavinash366@gmail.com has sent you a message From 4Pi', '2015-02-16 19:00:12');

-- --------------------------------------------------------

--
-- Table structure for table `thread`
--

CREATE TABLE IF NOT EXISTS `thread` (
  `userId` varchar(9) NOT NULL,
  `content` longtext NOT NULL,
  `TIMESTAMP` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `SHAREDWITH` varchar(200) NOT NULL,
  `reportedBy` longtext NOT NULL,
  `spamCount` int(11) NOT NULL,
  `threadId` int(11) NOT NULL,
  `threadIdHash` varchar(128) NOT NULL,
  `tags` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `taggedUsers` varchar(200) NOT NULL,
  `followers` longtext NOT NULL,
  `followCount` int(11) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `description` longtext NOT NULL,
  `popularityIndex` double NOT NULL,
  `helpfulIndex` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `threadanswer`
--

CREATE TABLE IF NOT EXISTS `threadanswer` (
  `userId` varchar(9) NOT NULL,
  `content` longtext NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sharedWith` text NOT NULL,
  `reportedBy` text NOT NULL,
  `spamCount` int(11) NOT NULL,
  `threadAnswerId` varchar(20) NOT NULL,
  `upvoteCount` int(11) NOT NULL,
  `downvoteCount` int(11) NOT NULL,
  `upvotedBy` longtext NOT NULL,
  `downvotedBy` longtext NOT NULL,
  `status` varchar(50) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `toolkit`
--

CREATE TABLE IF NOT EXISTS `toolkit` (
  `userId` varchar(9) NOT NULL,
  `tools` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `toolkit`
--

INSERT INTO `toolkit` (`userId`, `tools`) VALUES
('COE11B005', 'New tool,Another tool'),
('COE12B005', 'photoshop,dsgvjsdf;gvk'),
('COE12B009', 'Symbian,Kubntu'),
('COE12B013', ',tool one'),
('COE12B024', ',New tool'),
('coe12b025', 'fdasf,I wont say,Photoshop CC,ABCDE,fadsfasdsrew,alpha,Newab,Photoshopqsqqqafads,PH latste,Avinash');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `name` varchar(100) NOT NULL,
  `userId` varchar(9) NOT NULL,
  `gender` char(1) NOT NULL,
  `password` varchar(128) NOT NULL,
  `alias` varchar(40) DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `rating` double NOT NULL,
  `lastLogin` bigint(20) NOT NULL,
  `hasBlocked` longtext,
  `pollEligibility` tinyint(1) NOT NULL,
  `badges` longtext,
  `profilePic` longtext NOT NULL,
  `clubsInvolved` longtext,
  `userIdHash` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `userId`, `gender`, `password`, `alias`, `isActive`, `rating`, `lastLogin`, `hasBlocked`, `pollEligibility`, `badges`, `profilePic`, `clubsInvolved`, `userIdHash`) VALUES
('REDDIPOGU PAUL RAJ', 'MPD14I013', 'M', '', 'REDDIPOGU PAUL RAJ', 1, 0, 0, NULL, 0, NULL, '', NULL, '008229839116a55e46ba7b3fb469132330d796a30aacf654ff9070765847b52854c69aefb7ed2d23d66159c942985636ab3b2cb3c5f09b204884f4365180bbeb'),
('KUKKADAPU SAI ANJANEYA', 'MDM14B015', 'M', '', 'KUKKADAPU SAI ANJANEYA', 1, 0, 0, NULL, 0, NULL, '', NULL, '00deaa796efc105aa37d27a2692db50d087519b3006e1b2e17b644d3ca57a320ddb1f21a4d383f04fa5ec255c2be9c1bcf2563e3a9e5fb5633cbcdcdce0494d5'),
('SOUMYA ROKKAM', 'MDM13B028', 'F', '', 'SOUMYA ROKKAM', 1, 0, 0, NULL, 0, NULL, '', NULL, '010d253c192a91e715142c26f81d87e38fbe72ebbccb58711addd39295650ee5f4a964ca6e41c2a7c7b4bd7ed51a447ca2930900cc8cdecccab030a44bdf0bdd'),
('P. NAVEEN RAJAN', 'MFD14I006', 'M', '', 'P. NAVEEN RAJAN', 1, 0, 0, NULL, 0, NULL, '', NULL, '0165852d7dfbaeac6319d0d04994caa5821f904f7aba7ca0be00e0bc20e1111ed90cb024eded8906e224e33957a7341528cf86f8c69fadd4dd15ae53144ee30e'),
('ANKITH V', 'EDM12B005', 'M', '', 'ANKITH V', 1, 0, 0, NULL, 0, NULL, '', NULL, '02308784c141c0a147779536d6b3c41b052c0e51da9f8cda619c2b773a47b3710bc24cf40ca082aafc9ce7b32033628027a20328b301f4364e00cf790098c1db'),
('JAHNAVI ALIKE', 'CED14I014', 'F', '', 'JAHNAVI ALIKE', 1, 0, 0, NULL, 0, NULL, '', NULL, '02ca59162b9b8e95178dfd1b442027391facdb9aef1010eca1a98b987b41bf2693a6cfcce8671b6ecd8b12cce0768e2cc5ddeaf8d2feea4528420c3c60cffa9b'),
('BORRA PRAVALLIKA SRI', 'EDM14B008', 'F', '', 'BORRA PRAVALLIKA SRI', 1, 0, 0, NULL, 0, NULL, '', NULL, '0319fc005978942eb742a94ec1d92ab24d37213992eb408e724088c910038077231431d24884813cd972eedd1af09ba2cdf578b78dd84f0a0f2b9721e60c3be6'),
('AJAI BABU. A', 'MDS13M002', 'M', '', 'AJAI BABU. A', 1, 0, 0, NULL, 0, NULL, '', NULL, '037d8ed4dab225f11e91fbe962592412c5532f05280e172ad490ee3d7dfa765a43854424843fd9d9a5c1bf39ffab64c47685fd30e91cc5c50e99e929b88b4156'),
('SHIVAM SONI', 'MDM14B039', 'M', '', 'SHIVAM SONI', 1, 0, 0, NULL, 0, NULL, '', NULL, '03d455681d7dc32429a464455916e4829cf54dad7383e9f057fc9b9aa6a047a8878a139fae325d53a2557342edc08ccc4563f87d68ce3277a1bdcb2a567c6cf3'),
('VISHNU VARDHAN GUDE', 'COE14B041', 'M', '', 'VISHNU VARDHAN GUDE', 1, 0, 0, NULL, 0, NULL, '', NULL, '05441412da5c1d571f3273d3b3dc982e32cfa3cd1045c9f77904074363787dbc9d629eab6e4c22ce8c4ad58f220029890368107d8874727eb02992d52528738f'),
('UPPALAPATI DAKSHAJA', 'COE14B036', 'F', '', 'UPPALAPATI DAKSHAJA', 1, 0, 0, NULL, 0, NULL, '', NULL, '057b1c584db7022f2b8b8da96662c01d61328bc5841ac028edd0af31ffb4307e2e11eb7ec9bc701055a4e12b684aaa6e168c5b4c19bad5b98733db782487f239'),
('BANDIKE MANOHAR', 'MDS13M004', 'M', '', 'BANDIKE MANOHAR', 1, 0, 0, NULL, 0, NULL, '', NULL, '05bee664e8cb6dafaaf4281d0157a15c25488672b5643e6f1e62ef3cc9ba64b891536aca2fd0ce13af38c5474434a0202d7472991916247eb65c31cfb7b4f4c0'),
('PRANJAL CHOUBEY', 'COE12B024', 'M', '', 'PRANJAL CHOUBEY', 1, 0, 0, NULL, 0, NULL, '', NULL, '05ee9246c6e5ea4bd28b1900e6ed596536c3f1f709d879218c7a9cf39fbbabf771539a28eeb0c5f0ec4e4ef6aded0a6eddbb7f2a4d0f1745e50d4e13c7ef8e15'),
('KADIMISETTY AVINASH', 'COE12B009', 'M', '8f2505d5865262ea4a7f3419f211c29397228d183282ebf0a075562ee99b600cd79538a27cb5a179aadfcdb251fcedc0c1fb4dfdf057560bd85ace12901f4cc1', 'Kadimi', 1, 0, 0, NULL, 0, NULL, '', 'Webops, Zerone, Graphic Design', '05f6a1cb30f4d02dd3d82878c53d364d34f6fc4ab4c7ded096d3bfde7defc38344cdaa36ce02795ec010a1d60a2e6ba5279404c64368575f6862c8af20bb0e28'),
('SWETHA M MANUR', 'EDM11B025', 'F', '', 'SWETHA M MANUR', 1, 0, 0, NULL, 0, NULL, '', NULL, '05fe11d6ebd2515c9d02695874530b116a1aad0e8797a115185089de46df7c234923eafa69d21673e1ac7e1a8fc8506c3f94d5b1795542ece3c9de1d90d0be71'),
('DEEPAK', 'MDM13B004', 'M', '', 'DEEPAK', 1, 0, 0, NULL, 0, NULL, '', NULL, '0620ba1ecd0302240443d716fac598f63a202576e0d6d3108a328dcc073aa748707390e19efd239703a73681a5672e2d03f9daee7c2f49928aafbc2bf0a09cd5'),
('PANYALA SURYA KIRAN REDDY', 'EDM12B021', 'M', '', 'PANYALA SURYA KIRAN REDDY', 1, 0, 0, NULL, 0, NULL, '', NULL, '0666d510f9529149a8bddb68345827f6c44fc2175c44b611dd0fc32e28e19f9113151301101c0c83e7a87850227c3209cd42ac4c0068d309ada9fdbe76855efb'),
('AAQUILA ARUL ARZELA', 'EDM12B001', 'F', '', 'AAQUILA ARUL ARZELA', 1, 0, 0, NULL, 0, NULL, '', NULL, '06c4eb6f072861a506768dab564bff367f4f4e6a6a38b3acbac150fd40eb4e9e9f631886f4839ecb57581f59f480e9d90010d5feb4ab1fcaf95c4789d96056b3'),
('SAMANTHULA RAHUL', 'MDM13B025', 'M', '', 'SAMANTHULA RAHUL', 1, 0, 0, NULL, 0, NULL, '', NULL, '06d2a51b4d045bbfdd64cd8458aa5d5e242f3b99202f12434b892fab4c61e77da7e870cd300b733933007826fd9f16dc79074dc9f10c2dbc8fcea72e3342eff4'),
('VANUKURU LAKSHMI SOWJANYA', 'EDM13B035', 'F', '', 'VANUKURU LAKSHMI SOWJANYA', 1, 0, 0, NULL, 0, NULL, '', NULL, '06fa80c1113e233d834060fdf1f95b619cf5f560880c732fbe9f7b3d5e266f2849198f6a9196dee72b99dc1d486310fafd8711be8bd4c86ca71479e7630e20ca'),
('S KALYANI BAI', 'CED14I031', 'F', '', 'S KALYANI BAI', 1, 0, 0, NULL, 0, NULL, '', NULL, '08a8eae848b4481d61f72c075a5cb3b1222076371799ae4ea0c5592e9dce2cb5f013ac248ac7436a8acd4f3540d9a5e4c1a48ab090e940fba348cdaa900cfa66'),
('MALLESHWARI VINEETH', 'MFD14I018', 'M', '', 'MALLESHWARI VINEETH', 1, 0, 0, NULL, 0, NULL, '', NULL, '09465f30623083f7b387db3bb4a329d602419233697b30ca0317139859d1c87aad0561377e0d2e07627f7c3f4f35be6f891ce7b8ea51d375c4e10e580c9a97ae'),
('GANAPA UDAYA BHANU', 'EDM14B015', 'F', '', 'GANAPA UDAYA BHANU', 1, 0, 0, NULL, 0, NULL, '', NULL, '099976a99603372a74bb21acb38ae4026d1d7e693a14cfc399a69ad34abd72116272fd948fe3b7e17d4dda196f84fdaed1a97f3f74eae7e29f7ca2edd2aec0f0'),
('SOLUNKE YOGESH SHRIRAM', 'CDS14M011', 'M', '', 'SOLUNKE YOGESH SHRIRAM', 1, 0, 0, NULL, 0, NULL, '', NULL, '09e0a1a170e751166c70edb23d5900332e9835e4003c4a9f8b837780f989d0d925da275ff970bd894515a1d89edfe5a7a8fc24157604bfe22ba89c35429873a8'),
('PRADYUMNA KUMAR BISHOYI', 'CDS13M006', 'M', '', 'PRADYUMNA KUMAR BISHOYI', 1, 0, 0, NULL, 0, NULL, '', NULL, '09e8846b4b30d1bfb6839c60c727691aac055a5843c54b412ac2211845a1a2de759ec6fb1300582e89da1a74af499029905a5cf749596303fef51e6b17ff0156'),
('GOTTIPATI VYAS', 'COE14B009', 'M', '', 'GOTTIPATI VYAS', 1, 0, 0, NULL, 0, NULL, '', NULL, '0a2133ab0a5844a7ec57bde7394601051d67441fdf916673db9375806cb9308b35e970ce2d1155f247674cdd172292de5fff394b3de20b3a255ca03a933b0207'),
('CHAGAM YAMUNA', 'COE13B004', 'F', '', 'CHAGAM YAMUNA', 0, 0, 0, NULL, 0, NULL, '', NULL, '0a806b877dee1e24a717de81ced1c7a4453d3f6f5a289110a1107ed0815c3302095f67c06174d3b244f7e169df9dde115babc9f0bef5765d40c547159b9d1c22'),
('GOTTAPU AKHIL RAM', 'EVD14I007', 'M', '', 'GOTTAPU AKHIL RAM', 1, 0, 0, NULL, 0, NULL, '', NULL, '0a93aa56d042c1ff4231be79765bc63ccac22536a582e1d8e5c520cf1387c4a88920dea71e2aa6a95ad7a48caa3e0004a15db96928af9bd007e6ebe997ff7e84'),
('ATIQ BASHA K', 'MFD14I013', 'M', '', 'ATIQ BASHA K', 1, 0, 0, NULL, 0, NULL, '', NULL, '0b19b244933628547f541044dc3a7563daa3b1d1b37ee3880291edaca76f0a4eb86d349770495c37537fd37fa54d84d04c50a54fa62cd93e4175f09be1c2d205'),
('GOURAV PANDEY', 'MDS13M006', 'M', '', 'GOURAV PANDEY', 1, 0, 0, NULL, 0, NULL, '', NULL, '0b1ed87306c9b9ee6a652475d0235ee768bc9d9c2a98cc73625034876220f945428fc0cb3dcbb20d36a25139b5ac4d51e7021745272621c95fe5a6963ae22e48'),
('PRATEEK VERMA', 'CED14I028', 'M', '', 'PRATEEK VERMA', 1, 0, 0, NULL, 0, NULL, '', NULL, '0bbf68add4a9ea576354ad0a8bb83b2ac13243e841af0cecd182760eb75752fd68f32ef34f7e4671b032e10b33f4f7496cb005ed11760029cad2207bafe6bcbc'),
('KOMIRISHETTY OMSAI', 'CED14I017', 'M', '', 'KOMIRISHETTY OMSAI', 1, 0, 0, NULL, 0, NULL, '', NULL, '0d4a8128509eb5087d0b2175d140ecbee88c04c27bb5c2180ad47b873cb0d040e8af894fdc939a5796e7c3b1240f728fecd4f132dbfec6d8eee35284c66ea8a7'),
('P. GOHETH', 'MDS13M010', 'M', '', 'P. GOHETH', 1, 0, 0, NULL, 0, NULL, '', NULL, '0d59ebba32be7fd7967d8bf6183217b2f8bcdf1d22196a69bd2d7b3ccc2a2bec0e43a89fa0699bead6f29d97318dcabc4ebbc0057751f00bba1315d96ff48e32'),
('K RAMTHEERTH', 'MDM13B010', 'M', '', 'K RAMTHEERTH', 1, 0, 0, NULL, 0, NULL, '', NULL, '0d718b42ce2f2719a9b80231a8851beb7b323f6f1535b4c32bbb2196ec2d263c42e9f0a9f484cf95140f8b6c7a346690f8ae58885a220a8bbdf183c3242806dc'),
('SHASHANK JAIN', 'MDS14M012', 'M', '', 'SHASHANK JAIN', 1, 0, 0, NULL, 0, NULL, '', NULL, '0df0e5b1f0430e19da87880c511485e9b6c8a6363972c1e4e182d4eb5929a07eba669ae2f37a2d6808de0288f6851cbea701a9ec71f68fa477f1407240a41814'),
('PENDYALA SUDHEER BABU', 'COE11B020', 'M', '', 'PENDYALA SUDHEER BABU', 1, 0, 0, NULL, 0, NULL, '', NULL, '0e018a9111ae3943f3fca01d9b9b6d06794068be6b6d30834efce23c2d54edbaec2dc176ead909df2666a73dcdcb3f96861539c590e7cbaf9956a67538be4594'),
('GOVATHOTI MONISHKUMAR', 'CED14I012', 'M', '', 'GOVATHOTI MONISHKUMAR', 1, 0, 0, NULL, 0, NULL, '', NULL, '0e0416908c55b01c2ecfbc204b470b215d5d8de43a7cd47117ec017ea62bb042f381ba9c3cd8be2ccb2b102f6abbad536ac1817f2cb3c52dfe15993b63995700'),
('KOLLA PRADEEP', 'COE14B015', 'M', '', 'KOLLA PRADEEP', 1, 0, 0, NULL, 0, NULL, '', NULL, '0e228f7874de6345f54b5d55452aad28ba9f1ba93ba9a338029f24144bf809563941ba5e09071ada77ff3767a96d21136a4cec1b0c9f8e14f3c3ca5c42b48a1f'),
('BARADI SHASHANK REDDY', 'COE14B005', 'M', '', 'BARADI SHASHANK REDDY', 1, 0, 0, NULL, 0, NULL, '', NULL, '0ea53dd9cd9f75403a1c58f5059bf583f10d0f8bdbde3df7f1e3dcf8a40118d5ac4285cd1ebae4ea218839a7a40c72a93b857ea71827d9fab1f129e433d12c13'),
('KARRA SRIMAI', 'EVD14I010', 'F', '', 'KARRA SRIMAI', 1, 0, 0, NULL, 0, NULL, '', NULL, '0ec7db8494354590aec53141f0120cc54e5e1e7d7c7029413a0df906df15f9eca97cb2711848a5fc6edc42b3412e44456f1e2076a3fb167e73b60d7ebd43eacf'),
('JAJJARA SANDEEP', 'EDM13B010', 'M', '', 'JAJJARA SANDEEP', 1, 0, 0, NULL, 0, NULL, '', NULL, '0f34713aadb72dfa61870801c3d5b18ae2f9e02cddd7b39048af2140ab6fa0dd7458a656000ad987d5c51114f78242cfe3e5e5f6f372502884215adc1acfc5cb'),
('KADYALWAR ABHINAV SUNIL', 'MPD14I019', 'M', '', 'KADYALWAR ABHINAV SUNIL', 1, 0, 0, NULL, 0, NULL, '', NULL, '0f3948c7a83493c629a5994ced50b849717d1d9d02e318dc3eb451d371e12b2fb4aed936710add9374d02f6663a7d6c1528d2aa370638f0044362adbe4dafc3e'),
('LOHITHA POLA', 'COE14B019', 'F', '', 'LOHITHA POLA', 1, 0, 0, NULL, 0, NULL, '', NULL, '0fc765f1228344c37070d5eb29dae8c912e3130a2178141d341a279bd9ec01a40e74b09dc86d82a45c45f67c7c4e9cf77b56ae082a7d56968cd659b2b3a01fd9'),
('AVULA VENKATA SEETHARAMA SAI BHARGAV KUMAR ', 'EDM12B007', 'M', '', 'AVULA VENKATA SEETHARAMA SAI BHARGAV KUM', 1, 0, 0, NULL, 0, NULL, '', NULL, '0ffaa9826df0064ccc299255aaf9945fbb6828a0859159bdfef46a365a7a2f50681ed8f4a3993e884f43cc11accfae65a9b675fdda6f7d44fb0ba882a71aeb0a'),
('TEJA BALU', 'MFD14I014', 'M', '', 'TEJA BALU', 1, 0, 0, NULL, 0, NULL, '', NULL, '10f5e03e009a34f8f8b541e471bb37b192ef09436bc2b3a495618daa2b6a25e3c4d81e55a3271f7030b2d8e035f646aacb2e3f0adb9247f9d3142d23b37d2640'),
('GUDISE AKASH YADAV', 'MDM14B010', 'M', '', 'GUDISE AKASH YADAV', 1, 0, 0, NULL, 0, NULL, '', NULL, '11c764c66ab43e97faa46c72df22763dcffdb09bd4b1d0399bfee16c3f345ca568f5d380e4a041c1075a69a6d4265617fb0647369725e472500d12478f670d11'),
('PINDI JANAKI RAMYA', 'EDM14B032', 'F', '', 'PINDI JANAKI RAMYA', 1, 0, 0, NULL, 0, NULL, '', NULL, '11cd3de550a2ed87a8be7dd81f808d410d76517e8748a31f8d8b4dd7d4dad79fbfb44dc91e46db5dd68594732b388e93c84c68d8c7cf70452e944f39045be578'),
('SUSHMA', 'COE13B034', 'F', '', 'SUSHMA', 1, 0, 0, NULL, 0, NULL, '', NULL, '12653834a2e2097797fdc5d9d270e8f7ffdd7803fd6ea6e4a812863fe25655b4ee3d2e178df4a677fe7d344d48bf9e2a2ca31b7404b26a1a16d7903d4c7282fb'),
('UPPADA BALAKRISHNA', 'EDM11B027', 'M', '', 'UPPADA BALAKRISHNA', 1, 0, 0, NULL, 0, NULL, '', NULL, '13e50becde7260f2f17d00db71d7c3cc641b9a7b7bdbc31b826372f2e1be45f9dc52affefe27a3bf981d8b40da8e29aa073c1ce5b948ddca515eb022704f93f0'),
('SRIRAM PRASATH M', 'EDS14M012', 'M', '', 'SRIRAM PRASATH M', 1, 0, 0, NULL, 0, NULL, '', NULL, '1436bf6f68411297d7f0278b71e334a5d77e9a5671d5a5dcc98f259e3f16e6351ccd052febd973a7e50695e370cb15c6f7beac8543534881ce20c09951c1778a'),
('SRIVANI B', 'CED14I036', 'F', '', 'SRIVANI B', 1, 0, 0, NULL, 0, NULL, '', NULL, '14b784392d53052548fe283540314b78a6ad0273f27a52780b76207acb7b08bc2e827795803ff87975c119a17b3e1b42458c890fd9439ba12607ce9aec4abfed'),
('CHAKSHU PAHWA', 'EDS14M001', 'F', '', 'CHAKSHU PAHWA', 1, 0, 0, NULL, 0, NULL, '', NULL, '1505fa094080056d3fec887e54a22a89aa2ce75d4221d378b419764f3af56ee882476172b1d2d64bffa18b5220490ede920f991012a45d673113471553ada46f'),
('ANANTH B', 'MDM12B003', 'M', '', 'ANANTH B', 1, 0, 0, NULL, 0, NULL, '', NULL, '155f4d2802c8704c5f0a81c539330bf3667993389c80ae16ed3a51a86be23cebc44ccc4a0a4d8993a0247f76371f1997b83762830de1d1c77f4a6aa927731663'),
('S. NEERAJ', 'COE13B025', 'M', '', 'S. NEERAJ', 1, 0, 0, NULL, 0, NULL, '', NULL, '1564d57de388ccf0041ca0492d44843d67480325146e76d82ce34f857afba0b7590678ffeba68dd4d9d422f5c38db2f04a2f8599163f891526ccd724923a01e3'),
('ARO SATISH J', 'MDS14M001', 'M', '', 'ARO SATISH J', 1, 0, 0, NULL, 0, NULL, '', NULL, '15aa15b5e0cb6408f2066f10decff2bda53f604bd81227f279135833b57ab82d3437cf1b4196eebab2021a37d52e40542897f2fed2b869de9950f5ffbe9652d7'),
('MADHAMANCHI RAM MOHAN', 'MDM14B019', 'M', '', 'MADHAMANCHI RAM MOHAN', 1, 0, 0, NULL, 0, NULL, '', NULL, '15f71df256b77be528ab65177a3bfda743ae565cdd279aacdf122d0871127a2417d59b7f671ee7d1ccc6ffde91b4f4178319af131be436946a2e85d9008f3556'),
('SHYAM BHARAT PATHIVADA', 'CDS13M014', 'M', '', 'SHYAM BHARAT PATHIVADA', 1, 0, 0, NULL, 0, NULL, '', NULL, '162d6bd8eeed9c5004dd6a5626b0417583cd8383d3a5b22c985a3dd40a3d67f97cb389fa7e1b5d4fb6a9e8f79b372cacb34b77c4d4a899f4226f2e3fd3e30148'),
('PRATTIPATI VENKAT NIKHIL', 'MDM14B025', 'M', '', 'PRATTIPATI VENKAT NIKHIL', 1, 0, 0, NULL, 0, NULL, '', NULL, '1643f9f0ec43abb958baa14d2a907451ed0213cad7753f1886ab9a7cfff2c5255b33e11e7908eede80fa6c10f9a91289e1652f7c1b641f3af9bc0179f43f4b7d'),
('MOHAMMED AFROZE', 'EDM12B019', 'M', '', 'MOHAMMED AFROZE', 1, 0, 0, NULL, 0, NULL, '', NULL, '1686a6baf974077474d9d267b058a1681afc58e7475e77dcee8c7278e06fada6de0e4e791af0575a9b3fee52ca3080ee2be779050b1af6c9f161621915893610'),
('PARKALA VISHNU BHARADWAJ BAYARI', 'COE14B028', 'M', '', 'PARKALA VISHNU BHARADWAJ BAYARI', 1, 0, 0, NULL, 0, NULL, '', NULL, '170e80b05f8fd07e00cfcc715bfa7420f1082a8aefcc3d3b9156197db64d34f46b86c029baa23f7b6693f9935d733cd75f5986fc10aea4802c195d528e571f78'),
('BANDI SRIHITHA', 'EDM14B006', 'F', '', 'BANDI SRIHITHA', 1, 0, 0, NULL, 0, NULL, '', NULL, '173dc6e8384feb38ac164700857ac48888f2ffc09c0b01d295f7d602e5730e03ec611c7c89d501c6a7fac57046685cbbe56e8e81f99d77fecb0e55ecff135b76'),
('NELAPATILAVA PRASAD', 'CDS14M004', 'M', '', 'NELAPATILAVA PRASAD', 1, 0, 0, NULL, 0, NULL, '', NULL, '1769ffacb06ca33b157564cbf214be64ea0f7841cdf91bf9d9e97485193d4dd4886d78454d274f1b9974ca31eefc2fc1395f6a4c0da6d032e33d5221f6b985ef'),
('DHEERAVATHU VIVEK NAIK', 'COE14B008', 'M', '', 'DHEERAVATHU VIVEK NAIK', 1, 0, 0, NULL, 0, NULL, '', NULL, '178a5355c55c924c8e184e7c5ba54b9c197e0d4ef2fec5f86a47a21c6ba411a1b8bdae19b939823075cfcce2805f6d6e826c6dadf677b60f5df81bafa88d969b'),
('DAKA PAVAN KUMAR REDDY', 'MDM11B007', 'M', '', 'DAKA PAVAN KUMAR REDDY', 1, 0, 0, NULL, 0, NULL, '', NULL, '181b54f743f4c5e076e4a53d1f61d516699332ea218c6d4e5b547c78462c632d02b660a88682890088dabe05c606b0c3e93fa88ca4f54d664d3bd54a3c439258'),
('MANTHENA SAI VARMA', 'MPD14I004', 'M', '', 'MANTHENA SAI VARMA', 1, 0, 0, NULL, 0, NULL, '', NULL, '184cfed5690073488dbd47642b9deffadd9ac38bc4bf99f914943feef3a37fcd3ba99654f0a8a5a7d81984a8a6d5f99869c3c670178991e66ae3f4fddb121f06'),
('VEMPATI SUBRAMANYA SRINADH', 'MDM14B035', 'M', '', 'VEMPATI SUBRAMANYA SRINADH', 1, 0, 0, NULL, 0, NULL, '', NULL, '18a9f691988819b3de4fa53794b9b5900f70ac3007d2a283df914434c268d083f9f474cc9b1e64f841aaf24a32b7c239c45d2c9cc1952d7c24adffbb152f2b7d'),
('J V S GOWTHAM', 'MDM14B011', 'M', '', 'J V S GOWTHAM', 1, 0, 0, NULL, 0, NULL, '', NULL, '1916ef3a5d7f007481fc73a14db8874955562af5960998f4ac02fa96a59b609678222f876c902c682781bf6e78f5782c7cb77b3b4c76424f9c4f02f494b4629a'),
('KOTARU SATYA KIRAN', 'CED14I018', 'M', '', 'KOTARU SATYA KIRAN', 1, 0, 0, NULL, 0, NULL, '', NULL, '19d59b98d802a1fe4415bf0f5cf2943a9b3845637c890648afc0b6dce1d1c4dc4f812bb495a16f6ef6f4ee48d3e57534fa58b7eaa883076e199c74b1c6a609a3'),
('SWARESH UTTAM SANKPAL', 'COE11B025', 'M', '', 'SWARESH UTTAM SANKPAL', 1, 0, 0, NULL, 0, NULL, '', NULL, '1ab1718b8fe349d6ffcc040b278e3e9c9e9bef58fbe776523297b171840fa3267db182d36660b8e8d04a76a7ff2b62d24df680163af3312d012bd60bf65835db'),
('KIRAN CHANDRASHEKAR PATTANASHETTY', 'EDS14M008', 'M', '', 'KIRAN CHANDRASHEKAR PATTANASHETTY', 1, 0, 0, NULL, 0, NULL, '', NULL, '1b72880a6dd3861cbc168291e3098605dce0bb3a0ed97b2abc4213c0313b0e9c85911cb69af969deaf73c3679f64b265ecc696e3e2d135e23902f730ad0954d0'),
('KARTHIK MUKKA', 'EDM14B022', 'M', '', 'KARTHIK MUKKA', 1, 0, 0, NULL, 0, NULL, '', NULL, '1bf8d395f3903c69b968fb76498704fd603d22ef397b702aa83ca5d04a7985b470284b8ba5bcaa71d30b404e008b4fb9eff4990333330c9fea7768213201af34'),
('SALE MANOJ KUMAR', 'EDM12B026', 'M', '', 'SALE MANOJ KUMAR', 1, 0, 0, NULL, 0, NULL, '', NULL, '1c65ea0d316b0ebc15a52c3b30d3b3d80e6d33784edc6985446b34df6fd3d30aedd6bf350abc6b86dbd0ff8f5cb33be9dcb220bc4ba9b1cb580618ab27f76e22'),
('GOLLA BRAHMAM', 'MDM14B009', 'M', '', 'GOLLA BRAHMAM', 1, 0, 0, NULL, 0, NULL, '', NULL, '1d6aa5a0fe57adc43d14ce88fc58e46d4f698c8d52eaa64131d8557b8ab2ef2b02622f93b144edf727881f3019991b550d9a1168342ff16a004784b79a00e2d1'),
('VEGESNA S.M. SRINIVASAVARMA', 'EDS13M017', 'M', '', 'VEGESNA S.M. SRINIVASAVARMA', 1, 0, 0, NULL, 0, NULL, '', NULL, '1ddaf92a9382550636c919831b6d8a6e5578fe8123977e429a2e0afe2dfc5248f3aba12a6a52f952373361ba4d6c33d8179d4a4e265556a56d7c6003f9c7c7ab'),
('RATHOD RAJENDER', 'EDM13B026', 'M', '', 'RATHOD RAJENDER', 1, 0, 0, NULL, 0, NULL, '', NULL, '1e280b6e4ed647af7b8925097eb890e4a9a65d87f896d034dab68cc0a930ca1657577794c5c3327cc2f17e1b6b555636b499b4f0d40f15204a927fa7cbb95d0d'),
('GAYATRI R', 'EVD14I006', 'F', '', 'GAYATRI R', 1, 0, 0, NULL, 0, NULL, '', NULL, '2019b58e5b9fe15dffcc661bf39a771073ccd4fcf9cf68eb994a866d5a5f0a5326c5f2233e64af7d8f9c9c60fe59b0454e52573cb270390e119b424dc8d8618e'),
('KUMBHAR PRAMOD YALLAPPA', 'MDM11B013', 'M', '', 'KUMBHAR PRAMOD YALLAPPA', 1, 0, 0, NULL, 0, NULL, '', NULL, '203bcd81b3546ce5bbccdc5417b331d402f9719526cca5ac998b72a103ec40171bc29d01d2a5588d781650591ec9a06e5fe796c592af809ff17510a3a679d804'),
('PULIVARTHI NAGARJUNA', 'MDM11B022', 'M', '', 'PULIVARTHI NAGARJUNA', 1, 0, 0, NULL, 0, NULL, '', NULL, '2115731fbb7ba0d4305fbbaa655a4080d8948b0dfd30c3942f82eb571f3122160edbce4b8a446b18aa88bc92a2e8d156832679e668cbdc8b66ff3653747f3e53'),
('G ADHARSA', 'EDM14B013', 'M', '', 'G ADHARSA', 1, 0, 0, NULL, 0, NULL, '', NULL, '21e366638a7c05e74c3fedc42679c1c8d544b792d2ed3e0fd07004f03e86914fda658574f0ce8ce6ec2d74f59fd1c0c57a242ac9b0a2d53a79a8d0440abb1a8d'),
('M. MOHAMED ASAN BASIRI', 'COE12D001', 'M', '', 'M. MOHAMED ASAN BASIRI', 1, 0, 0, NULL, 0, NULL, '', NULL, '220c670e4c62a6786d86612912a1f0296c47e3f13051cf02fc86e884e40fe5fe43948a86557ac7321cd5b0212352dc4383d4ae16f58de059905a7e4916252fa8'),
('ABHISHEK DEVA', 'COE14B001', 'M', '', 'ABHISHEK DEVA', 1, 0, 0, NULL, 0, NULL, '', NULL, '22941e5eb30ac727d0fe6187b3c1fa4d8c1d300cf1c7d624ae80f29034d191c3b94836533d310c9b3faf5e90a486d62dbe9286a16242777f1928c4c6e643e1b7'),
('SOMA LOKESH KUMAR NAGA MANIKANTA', 'EDM11B022', 'M', '', 'SOMA LOKESH KUMAR NAGA MANIKANTA', 1, 0, 0, NULL, 0, NULL, '', NULL, '23e0f2eed4bbf1246e96790d6dedd467cf80b2dfed4d62076e1756bfd6525c1db99067aab93096675afbfb56291f326b0a8244eab60faa15dd98895326a96090'),
('M AZHAKU SAKTHI VEL', 'COE11B018', 'M', '', 'M AZHAKU SAKTHI VEL', 1, 0, 0, NULL, 0, NULL, '', NULL, '244f39502915c8cd2d9d225d4f7273e3dbfe9d01b41402f96201a57629bc34048dcf48b2fff92243a7346f2790c6a962cec24bc9ceb8e1530cc291d3e2ea3e00'),
('THORAHATULA RAGHAVENDRA SAGAR', 'COE14B035', 'M', '', 'THORAHATULA RAGHAVENDRA SAGAR', 1, 0, 0, NULL, 0, NULL, '', NULL, '249366ec4358099de929fd0a84b2722e680b7de3ce17ac3277a297e130d966617f6e333c375544691d23d559733dfbcd15233a4f6df41ee1457da7cb53e676e0'),
('PARMAR DHRUV CHETAN', 'EDM11B018', 'M', '', 'PARMAR DHRUV CHETAN', 1, 0, 0, NULL, 0, NULL, '', NULL, '24947acc72c12c329b4097e5b70ed93fcdf62ad11f426ba3cd486dca6a52d77fd6c28b61c4084ffa90bc7b8a7bc2ec818d478f218dff0cfc06c4f9dbeeff3583'),
('JAYARAJ. M', 'MDS14M008', 'M', '', 'JAYARAJ. M', 1, 0, 0, NULL, 0, NULL, '', NULL, '24c400a7206b38516d831b76ee6460e8fff5e934b5c5052506e21638a72c83657abf8b6ec829d83f5ee937e33e4efe7ff056cf7edfc6647e582e33cb1ab10d07'),
('SHUBHAM KUMAR RAJAK', 'MFD14I009', 'M', '', 'SHUBHAM KUMAR RAJAK', 1, 0, 0, NULL, 0, NULL, '', NULL, '24edf05f4c15d0dc58a6ebc381d62deba11427d4b2a89ea4115fd9701d2455885ab37d3612105690d97eb76dd4fec99b10524a0ac9304480708fef13bab55800'),
('VANKUDOTHU SHIVA PRASAD', 'EVD14I014', 'M', '', 'VANKUDOTHU SHIVA PRASAD', 1, 0, 0, NULL, 0, NULL, '', NULL, '253ee1a48d2857ef2788c85df41f4014b9fe4601d56b3d91c33228ff9e3975f31bbb475feeedb8f6a0409ab9219c9abe69c0b310ae733648a2ddf662ba38fd41'),
('CHARASALA CHARAN THEJA', 'ESD14I002', 'M', '', 'CHARASALA CHARAN THEJA', 1, 0, 0, NULL, 0, NULL, '', NULL, '258179f0a20d689cd183148a5471aa70b519daea4791007d84a9ede35d405f376d2ab05862399af7ffcee5176d040821b0133fb7245f43dd81d7bdfaa3c64cad'),
('DIVYA SRI MAHANTHI', 'MDM13B006', 'F', '', 'DIVYA SRI MAHANTHI', 1, 0, 0, NULL, 0, NULL, '', NULL, '25ce23bfc083fed8078b8fbb25277019504f17944518f46b5ff7b11669bf6a4f0525a9134fd57668c651ebb0f331290416b2664cab273218562ea9b02e809cc2'),
('CHEDHELLA VENKATA PRAVEENA', 'COE14B006', 'F', '', 'CHEDHELLA VENKATA PRAVEENA', 1, 0, 0, NULL, 0, NULL, '', NULL, '26ac2ff599d2c52c60592e961cc06a88371f8f18c486be4a7952db7ed7f2707fde9955f597d35787663d66fa47e5787cb8ec3db173c3438fc7df583a178f43e1'),
('VEMULA DILEEP', 'COE14B040', 'M', '', 'VEMULA DILEEP', 1, 0, 0, NULL, 0, NULL, '', NULL, '270507f9d8c40bf4b7038386c22b56b164674547cc16a48bbbf9c69d71be5071b15ae3d5cf5c2296940b696cbf6b838336d8684851042d421f713bbde2a0c3c9'),
('KARTHIKEYAN S', 'EDS14M007', 'M', '', 'KARTHIKEYAN S', 1, 0, 0, NULL, 0, NULL, '', NULL, '270bb83b8b45301f16cf7afcda012de00a63dcb2b292a40bf7cfce0e16fe2558064fae9267e304dc47ac49539eefa2bad4bf61fd5335f0e47db47bcfcfab9a40'),
('VENKATA MURALI KRISHNA GEDELA', 'CED14I039', 'M', '', 'VENKATA MURALI KRISHNA GEDELA', 1, 0, 0, NULL, 0, NULL, '', NULL, '270c03b9fe7c14ab924c40a92b2771d26eb2db21395b08c3a9aa73f445296a17459fe43a30d91536521cc65b19b7a6e04f323aceec40987fa6befc87948aa883'),
('RATHLA BALAJI NAIK', 'MDM11B024', 'M', '', 'RATHLA BALAJI NAIK', 1, 0, 0, NULL, 0, NULL, '', NULL, '2789502ae0e578074ad6fb20cbc4f27bd0bc2899f8de44dbd38f5b48e6daaf99373557dfc175941986d8ae0feb6cd99ce726a34d73b5ff0c2a7abd3d190f6850'),
('POORNIMA A P', 'CED14I027', 'F', '', 'POORNIMA A P', 1, 0, 0, NULL, 0, NULL, '', NULL, '27d2d7721913b1c2ce0997fb0dbcd287de9e10e749bb64b96ce1deb081f1d4e35f8f3c0e22a91f5c537fee51c6eae54a57775c508117cfe063bbad957887d7a4'),
('VENKATESAN. K.T', 'EDS13M018', 'M', '', 'VENKATESAN. K.T', 1, 0, 0, NULL, 0, NULL, '', NULL, '2822fcba787dacfd9b791d39c839494ccab8f5047ed1dc00861fdc5824a13027d0ee31ff541885d80fdc8b398f8a94ec10970ebe01f41760febd06c87b2496ab'),
('OSWALD. C', 'COE13D003', 'M', '', 'OSWALD. C', 1, 0, 0, NULL, 0, NULL, '', NULL, '28f9ce053f791e1af07428d5dbc3adcfb178933e41b0b9aaa2ceb005b77b48c5d106604204a091795994ee044d07e12c58d52060cd078820d3d83f3bf273be3a'),
('NAVYA BORRA', 'EVD14I016', 'F', '', 'NAVYA BORRA', 1, 0, 0, NULL, 0, NULL, '', NULL, '2a534a9d439f9b93c9ccb3bacd2e14962aade1a0d3ecd2d6427b0dd843355283eeaea6f04832d12d71f874b4de33f8e52f1d397943c8bec9761ce791694360ef'),
('SORNAPUDI LAKSHMI NARESH', 'EDM11B024', 'M', '', 'SORNAPUDI LAKSHMI NARESH', 1, 0, 0, NULL, 0, NULL, '', NULL, '2ad6d2a7be8e0f0ee5759a3a04885d4b1e49919f79472ac71b0b2d81a43ea8b41403044f2f8adb79431afa2d5e152ba837ba852b8164b372f440d8115475ece3'),
('ALURI MANASARAJ', 'EVD14I001', 'F', '', 'ALURI MANASARAJ', 1, 0, 0, NULL, 0, NULL, '', NULL, '2b5448787ab6726e20fc9e37e0d1eac6b34a627657cb8f04997a3e3435898d3d388696d55eb3b26cab5f5ece59948018d0ed81b177cbea7e6316ac8fb18f9114'),
('NARAYAN MURMU', 'MDM13B017', 'M', '', 'NARAYAN MURMU', 1, 0, 0, NULL, 0, NULL, '', NULL, '2bb02c80a420e3d3b2d4a4af14c4b91342f4ea8c9d6562e37b354c9e98e79c78a20feeda9662cc8e28efda6907ff56dad4903c119b2cb846c16df2a710ea09dd'),
('ATUKURI SAI CHAND', 'EVD14I002', 'M', '', 'ATUKURI SAI CHAND', 1, 0, 0, NULL, 0, NULL, '', NULL, '2bdc0f4e6cfaa2e73ad994018186c4edd62e02429c8f8ee0c87133f82d3836c26b274cbd3ed3ab09eeff50f9a8eaec1a49d62c965b3c573a61abebc2a13e585c'),
('NAKKA LAXMI', 'ESD14I007', 'F', '', 'NAKKA LAXMI', 1, 0, 0, NULL, 0, NULL, '', NULL, '2c356d184618f923612c0a1eb558a97886591bbcb61c4879c69e34c807d4d914b38afa8bc87e62461e05f9f368ea8faada7fed8e26585ab602de55c26efddf86'),
('K.SAICHARAN', 'MDM13B012', 'M', '', 'K.SAICHARAN', 1, 0, 0, NULL, 0, NULL, '', NULL, '2ca389db51bbea4630b209d818ebde3a60787d18151d1e6d8898aea5bf2a58b468ef9a434789568089cdd555022a2a041cfbc7830ee6a21695c776f57c8ddead'),
('ARUL MURUGAN B', 'MDM14D001', 'M', '', 'ARUL MURUGAN B', 1, 0, 0, NULL, 0, NULL, '', NULL, '2cdfcda0ac5b7db8174075a4249e6da0bd3975677368bed3c4fffcb5bf582ab08e3a7b6cb969dacdd92008ba446bcf811eef4dc8824d01554babb8ebb4026ba2'),
('KULDEEP GUNTA', 'COE12B012', 'M', '', 'KULDEEP GUNTA', 1, 0, 0, NULL, 0, NULL, '', NULL, '2e3f9f0daff1f77e46459809b486f592983a036e2f7d968e586d99424a9d59ed6be9ac43a061903f297a6dc5faa14954d5a3e33a236ea159f720cba72b07ca09'),
('SRIPATHI ANASUYA SAI SRUTHI', 'COE13B031', 'F', '', 'SRIPATHI ANASUYA SAI SRUTHI', 1, 0, 0, NULL, 0, NULL, '', NULL, '2e6f09062437a6daa71f96fac6a11f0ca78c632b0327cd12dd283ff2f537b250c1d3bc7fc0668352ea3bd0d58db8fd967e512a92a11a9001c6fadb598cd2f465'),
('BOGGAVARAPU SAI KRISHNA', 'CED14I042', 'M', '', 'BOGGAVARAPU SAI KRISHNA', 1, 0, 0, NULL, 0, NULL, '', NULL, '2e725bd90f57165890255d5825d49eb66ad287d7435af1dbfc8a2869a746f4a7a00bda0e29355a59e4dd993dd4f72591933a550e54c8ecc81a7909c6663acac6'),
('SALAVADI ANUSHA', 'EDM13B028', 'F', '', 'SALAVADI ANUSHA', 1, 0, 0, NULL, 0, NULL, '', NULL, '2ea7b642a8a00e284a0e34b86b87b08c99b03f643bc3e97fe3ac1443953eccc1e69e2f9266220c1ad655dbc8723adc55974e4fb3331225a7dbba3f5507a72097'),
('RAJ KUMAR RAVIDAS', 'EDM14B041', 'M', '', 'RAJ KUMAR RAVIDAS', 1, 0, 0, NULL, 0, NULL, '', NULL, '2ef91cd9ba52d6b9705fa18ca0507afbef8be9fde178ae11a3aba45153834e3d64843647349bc8c64710a6a7394c2edbcc56be044a714bf83a333f4fdad40066'),
('GANJANABOYINA SRIHARSHA', 'MDS14M005', 'M', '', 'GANJANABOYINA SRIHARSHA', 1, 0, 0, NULL, 0, NULL, '', NULL, '2f3b55584c5905c81855f322ee537812e71f6a4a29e4d7ca1927694665491aa7f4d2c2fb445a4a863caf3b2c4eb03eee274b208988a1a474deae087625dfc48d'),
('GANTA BINDU', 'CED14I010', 'F', '', 'GANTA BINDU', 1, 0, 0, NULL, 0, NULL, '', NULL, '2fff6ae8365dec8e03328ce1cdfa2c7b8e2a8b0264e8fc1850126941dcb0af6dcdb221f5bbbeb1b0b619fd6cbd683883a038edfa1e380510077ba325837b7a44'),
('APARNAA R', 'EDM14B003', 'F', '', 'APARNAA R', 1, 0, 0, NULL, 0, NULL, '', NULL, '31f2caf67dcab48c0e621bb47f7c0641f259731d16d2e375d2d646aaab8655d32ea09021f974b016e2a101a256d129092a9129070f0ec2f771690335c36dee94'),
('DIGALA LALIT KUMAR', 'MDM11B008', 'M', '', 'DIGALA LALIT KUMAR', 1, 0, 0, NULL, 0, NULL, '', NULL, '32e7cad272b7c967a9fc823d517a469680913404f6be42095fcaea1605119d9b0bfda0bd232137f32809e2e0047e1bb2832327fd54b0cdfce20f1c5c63ec3cfa'),
('K. BALAJI', 'MDM11D001', 'M', '', 'K. BALAJI', 1, 0, 0, NULL, 0, NULL, '', NULL, '3390f52ad76e18d4c2a1b6dc89ab3164c79597c8700ef3566fff3b028fcb647c859fc6d51dfee5b8326e198d8dfb1cff3c97be690a16d76eb5a59640e6abf38a'),
('AMBATI PRAVALLIKA', 'EDM12B004', 'F', '', 'AMBATI PRAVALLIKA', 1, 0, 0, NULL, 0, NULL, '', NULL, '33db9eb9e178a46eccffbb2c0e320bc0541fdd614e42384cc00c46602a7b8c7a6d3b2e2437c68dbdb89182c1b5a8824790d39defd919367e1cf1dd0017dc46e8'),
('CHAVALI KAMESWARA PAVAN SAIGOPAL', 'MDM12B006', 'M', '', 'CHAVALI KAMESWARA PAVAN SAIGOPAL', 1, 0, 0, NULL, 0, NULL, '', NULL, '34934f985e96d7a2178494539db4a54e62e595ae9ee916f36dd768a4a4ac44518f11022fa17869f35cf132591a81bd79083d2bb53bd6204bb51140c536e708a8'),
('RAVI TIWARI', 'MDS13M014', 'M', '', 'RAVI TIWARI', 1, 0, 0, NULL, 0, NULL, '', NULL, '350bab4e701cba7d4e97b1328e7846ae34bab3ff19661e5788a595588c353a11ddd0ae1574f623c0452513b601bbe3da45bac9eb7c722646c9c22ac2c7bf65d9'),
('CHINTHAKRINDA RAGHU RAM', 'EDM14B010', 'M', '', 'CHINTHAKRINDA RAGHU RAM', 1, 0, 0, NULL, 0, NULL, '', NULL, '351e9779f6feb8cab70a8321a70926d191bc6fb3b996569505e551f17cc7550898f07f443b0d4ea423e5303b2cbe0690cf0c09d812211fec26987d6b41702568'),
('RAJA SRAVYA TANMAYEE', 'EDM13B025', 'F', '', 'RAJA SRAVYA TANMAYEE', 1, 0, 0, NULL, 0, NULL, '', NULL, '35949f59384824f43b8d5874f32bddb70bea047835f51d7498f3df001930698be5bcede18d58a6bd47a9c39516e2eb2f90cf5f186162a13c94e4ea327fac4fa4'),
('CHAWHAN GANGARAM', 'MPD14I001', 'M', '', 'CHAWHAN GANGARAM', 1, 0, 0, NULL, 0, NULL, '', NULL, '35b8e1397afbc2a4740a937bfd7748452e0d3e25406683592e039e2eec13a2dab18eb05690c13aaa75a09dc000d5a2030955980ea37078dad037019d26c95a67'),
('C. PHALGUNA', 'CDS13M001', 'M', '604376fe68015020e85e0ea64c91d066aebf63c9c630ffd3761b4ee58215c9a55897ed718c0a512dbd62b3f47d7302edbe05a87166aafbc9e2557867873f7909', 'C. PHALGUNA', 0, 0, 0, NULL, 0, NULL, '', NULL, '35ed1791e149553ba9d11bd2f57cb00e31903a2dab461259c435280ad699376696f29ebedfc4eb8996e28c5ed5055f01df9edca8b68c6cacf5c9a7b784174b91'),
('PENAMAKURI V B ABHIRAMA SUBRAMANYAM', 'COE14B030', 'M', '', 'PENAMAKURI V B ABHIRAMA SUBRAMANYAM', 1, 0, 0, NULL, 0, NULL, '', NULL, '36684c1a8edbfb7274c65b992bb72c04485cf12f6e88fe2fe4709734bc23d37d82c93dff8cb0a80c721d25876341e49cecb17df563cc412f03c933f779e7214e'),
('SAURAV VERMA', 'MDM11B026', 'M', '', 'SAURAV VERMA', 1, 0, 0, NULL, 0, NULL, '', NULL, '3687d985c490fbbb81cd1049f1db9bcf4eeb3b2a818dc2bee2a1969b3326296544ca636f3863ffb357211a80477d5de0536cfebefa0d0acfe799ae613e53d7d8'),
('PALUKURTHI RESHMA CHAND', 'EDM14B031', 'F', '', 'PALUKURTHI RESHMA CHAND', 1, 0, 0, NULL, 0, NULL, '', NULL, '3779fafb439f9d4288db46acc603c774bbd4190dd95f5184715b41b55fcc75deca5d33b3cf408aeb63421d0ae93f59e1843603fc04ec7bf3cee7bdb5efc944fe'),
('ANTHONY VIJAY KUMAR MEKALA', 'COE11B002', 'M', '', 'ANTHONY VIJAY KUMAR MEKALA', 1, 0, 0, NULL, 0, NULL, '', NULL, '37d8175d8183733b69b3fecbf113227117a0c6fffb71ae3f633c6b7fee01903459b13499513c5e413a8cda910f2dda31d6ef0472e1eb2ba21f1cfadffde94021'),
('MADDALI KAMALA PREETHAM', 'MDM14B018', 'F', '', 'MADDALI KAMALA PREETHAM', 1, 0, 0, NULL, 0, NULL, '', NULL, '382415a8b772525a0cdfa2e742cf6eb5687dc89833dacdefe1ef0f1cafc2f2aa4378ad39998ea93fe0de5a550f19e9c0fb4fc584da12607f25dfad6315f81b18'),
('SHREYAS NARAHARI', 'CED14I035', 'M', '', 'SHREYAS NARAHARI', 1, 0, 0, NULL, 0, NULL, '', NULL, '3870648a9e134de56ca1743c9efa3ef63d36d95e51568d2a0d05129c841164d3cf9da40ef5bbd2d6540a6439e9611bcae8704391a383c2033b45d029b089c6aa'),
('ADDANKI SAI CHARAN', 'EDS13M003', 'M', '', 'ADDANKI SAI CHARAN', 1, 0, 0, NULL, 0, NULL, '', NULL, '3872595f35838e5f5b89de23bf61687cf54956bdee09c16ae9173fd7e1c31715cbc6c1f6fa954f8c3dbab22bfe6b402d7b160b89978dba838475b816f1cb7518'),
('GUTALA PARIMALA', 'EVD14I017', 'F', '', 'GUTALA PARIMALA', 1, 0, 0, NULL, 0, NULL, '', NULL, '38804a38f8ea2e62898910e3c0bb5a7195ba78998ee9f4ae90a9950eb8eedecc4b46bb9ddf3ca81000080455228eac03f3ebecddab17913bbabe7b7b6635b084'),
('SHIVA GANESH M', 'EVD14I019', 'M', '', 'SHIVA GANESH M', 1, 0, 0, NULL, 0, NULL, '', NULL, '38ac2db87b745ca1dafeb3a92a461bab8543e381d8f332f39f4021696e3f19cc509787e76f95646e2f33b99010c9503723612d498c53d19272cb684b20da6236'),
('NOONE RAMYA', 'COE12B019', 'F', '', 'NOONE RAMYA', 1, 0, 0, NULL, 0, NULL, '', NULL, '39823f7181cffd93ce5e4b0cae42ffa32cc35d2f58407d72a2565e3e482798ca9d1781032b9f9b140cace71222443e8bc83cb1bf3cd125fa7d12dbf236409baa'),
('MALINENI VENKATA MANMITHA', 'COE14B022', 'F', '', 'MALINENI VENKATA MANMITHA', 1, 0, 0, NULL, 0, NULL, '', NULL, '39a860ce5f4751b95821eb00fbb2545fbc2ff22b72a93b39e064921e1971db3df0e86d4bc36bbf83f76879ff58983737ea89f0db37f4787cef6cbe8212fc7247'),
('MOHIT VERMA', 'MDM11B017', 'M', '', 'MOHIT VERMA', 1, 0, 0, NULL, 0, NULL, '', NULL, '3a1013a421900b6d6c9ebd4721d7f2cbf71605788246296be73ad9a65d5c75079139fc928f44976397b8901e1de43eee1b146d658333c50892b068be8df8ce06'),
('KANAPARTHI V PHANI KUMAR', 'EDM13D001', 'M', '', 'KANAPARTHI V PHANI KUMAR', 1, 0, 0, NULL, 0, NULL, '', NULL, '3a78d6837e1fb77cd462af7fe90840db53c7f86a9fb96f80bb550f1bcddccb97ac2d7e844587994aeca4f9fc7eca32125a7428f987b5e050ac083ca4a331cf48'),
('VAMSHI GANGADHAR CHILUKA', 'COE14B039', 'M', '', 'VAMSHI GANGADHAR CHILUKA', 1, 0, 0, NULL, 0, NULL, '', NULL, '3b2b0449cdffb1a6e06f34bd1d85ee74b0bd07188642ba757efb94dd3f7f5e970c4f8c265aaf86d936b44af58824a450983071f43d884675ade123dead77e97a'),
('CHANDRASEKAR E', 'MDS14M002', 'M', '', 'CHANDRASEKAR E', 1, 0, 0, NULL, 0, NULL, '', NULL, '3be47ec2cb3513caa6c7e206bc0855d7abd28cb996f8aa0fa7081fcc0e79f81c50b9ff36dc476ed13f6ba9deab1af2a0153f73bd8aadbca9cd33dabfadb326d3'),
('BANDHAMRAVURI UTTEJ', 'EDM12B008', 'M', '', 'BANDHAMRAVURI UTTEJ', 1, 0, 0, NULL, 0, NULL, '', NULL, '3c239e815d5304d74252852bcad560cba3529376ae746ae5d8d1b5712c17ba42c02c84877467f361564fe3527ecbe40ceed3afbd445f3e98a2766bf21a00e777'),
('CHETAN SONI', 'CDS14M002', 'M', '', 'CHETAN SONI', 1, 0, 0, NULL, 0, NULL, '', NULL, '3c62b49fae9da6085ecdc9aaa3e556bceccd053622ddefb55e3655df483b8a5b9a966ebd106a7def4205fc09b060163586b87a7b00cb1c08d82976a3e28e6aff'),
('VISHNUBHOTLA RUKMINI DEVI', 'EDM13B037', 'F', '', 'VISHNUBHOTLA RUKMINI DEVI', 1, 0, 0, NULL, 0, NULL, '', NULL, '3c92c4c21699a01b48f042e01fdae048277e2d6520f31001743ebdb224abc5a7ac982553e5c9dc27cb0ed56659ff64b75bc9c550534e2a2fe2dc1a3a3357005f'),
('SIVACHITHAMBARAM. V', 'MDS13M017', 'M', '', 'SIVACHITHAMBARAM. V', 1, 0, 0, NULL, 0, NULL, '', NULL, '3cdbbbd60465d8abaf7c1699f40069541086916cc8b38d6f1cc66c91beabc48aeb4ac99035d5bbef302d879736cf9ad6de06cdb3096a2b2d306388d066907e3e'),
('JANASWAMY SRAVAN', 'EDM11B008', 'M', '', 'JANASWAMY SRAVAN', 1, 0, 0, NULL, 0, NULL, '', NULL, '3cf3415718a44be8655c6a940517f8a883ff97e645b94c731f3724a3e8222b449ce3e300f081067ebfd6004c11f703e88106898c78e923b8c6d371e0a09b1c79'),
('MAJETY HARI KRISHNA', 'COE12B013', 'M', '8a302a9c81acd95b6a4b3bd52262160ad7ea48b4b543c1ebde8cf657401ca36dc7d698b7ce34835b40b00c0e98b90dab18f4748d6946e0ecff7d0a10a8cbe323', 'RamaKrishna', 1, 0, 0, NULL, 0, NULL, '', NULL, '3d4c0a6316a9a7d0eb815cff29ee42428ba2b479744ad2ccd45c653ddbf0bbe90b136c18f8f3185856814a60762d29746512a294d22c8459e7862c83dd900a1e'),
('RAMANADHAM HEMANTH KUMAR', 'COE13B024', 'M', '', 'RAMANADHAM HEMANTH KUMAR', 1, 0, 0, NULL, 0, NULL, '', NULL, '3d837961ddd1c9517ec73369738f05f3626ca7c2cc9b68195c29be2fd96afba1c57cc3fa7e0f9454a3ef9bb463d1ad4a40449ccbb241897d52a58b1ed5bc02ab'),
('PREETIKA MURALIDHARAN', 'EDM13B024', 'F', '', 'PREETIKA MURALIDHARAN', 1, 0, 0, NULL, 0, NULL, '', NULL, '3d906426fa88a74d298017bd9973fdfa6b6c18207686a721487cc87a73dd7a94174e26fdf3438751c14d4579aa822ca82af77507539cb3bf1f2fc29483aad498'),
('SUDHARSANA K J L', 'EDM14B036', 'F', '', 'SUDHARSANA K J L', 1, 0, 0, NULL, 0, NULL, '', NULL, '3da3e3e267ef68559e74583de40b0b52a9ca9363713bea4fe42568a5a81acba3b05441a9d0034685c25000dfdfc2d837f934776d2df4b912da46ae63cf145029'),
('KORSA SANDHYA', 'COE13B013', 'F', '', 'KORSA SANDHYA', 1, 0, 0, NULL, 0, NULL, '', NULL, '3dd0d6e60edb195e265cbe86c3564cd6d0e9a5cea80dfcd5717ccba43fd88d1e526a85b5c956188dfd90b387b516441670af9790b1b68013d47627fe24811f10'),
('ARJUN ROHILLA', 'MPD14I018', 'M', '', 'ARJUN ROHILLA', 1, 0, 0, NULL, 0, NULL, '', NULL, '3e03ceb1c88b9cccb1ca7e2bbb240350db1ab6f99cb62193f824ba841d3bf9b47867a5abd4e6d44917a25e0eeca387cc342fa537146a58af7e7434c6400dd4d1'),
('ADITYA CHILUKURI', 'MDM12B002', 'M', '', 'ADITYA CHILUKURI', 1, 0, 0, NULL, 0, NULL, '', NULL, '3e45bf3ebba4f605e13ad0294582622d0e222851dd06bb7ba000341fd4136b312e8ad1dacc89743ac88710b0c377ed55036a055288cef1a430e0d4891a05eb44'),
('MASANAM SIVA SAI AKASH DEEP', 'EDM12B018', 'M', '', 'MASANAM SIVA SAI AKASH DEEP', 1, 0, 0, NULL, 0, NULL, '', NULL, '3eadc5923532b872e249605852c0e6bad4f44c8fcb1b8e721f02775aa1dd07e8ec7b889a44bddaaec1454ac33730f5f124bcfefeecbfc95840feb4b07a6006b5'),
('DEO SUDHANWA SUNIL', 'EDS14M003', 'M', '', 'DEO SUDHANWA SUNIL', 1, 0, 0, NULL, 0, NULL, '', NULL, '3f540f1eb19e6ab92890494c1e1079d118a6f5ea0b7ec3a7b687cbed05456c6185cc70dbd95c7e445f7bba42a5dfe8ee3a9b5e84f554155d28256885340ee588'),
('RATOD NAVEEN NAIK', 'EDM11B020', 'M', '', 'RATOD NAVEEN NAIK', 1, 0, 0, NULL, 0, NULL, '', NULL, '3f5657bba3e39353b4e7b0e7bd641a2f1b02bd18037e914dcb9a3968b1ae4919dd3ffc56f908fec139e2a958d7edf3cb72c0e1016ef94b20e4f21b9be59e0315'),
('PREETAM NAIK A', 'EDM12B022', 'M', '', 'PREETAM NAIK A', 1, 0, 0, NULL, 0, NULL, 'profilepics/preetham.jpg', NULL, '3fd06da92aa93343805845d14615f833b8340adaa3cb609c7999f3b8479b74ddc1a7f6cc6ba9c60c1ca3cd3c3137e50e201c7319791d824003d577183c8ab544'),
('MANNE SAI SRAVAN', 'EDM13B018', 'M', '', 'MANNE SAI SRAVAN', 1, 0, 0, NULL, 0, NULL, '', NULL, '401a984776fc54a6397e4b4687b0a6f8c81c2ed9ba2374361b25a28ff49ce632d2b6fe70c76f52519baffbb6ef13716b986010250a42bd7f2b3399e95163d662'),
('DOMINIC ANTONY', 'CDS13M002', 'M', '', 'DOMINIC ANTONY', 1, 0, 0, NULL, 0, NULL, '', NULL, '402e94b0df34d627fe02f41302cfd92c8298e7166c65e68c98bb7fc4a3fb879f63c83e2f3de10d58a0abb284952a1dfb67753d8b8d3d53fca4d3c6af3f680c4a'),
('CHINTHA SAI PRIYA', 'ESD14I003', 'F', '', 'CHINTHA SAI PRIYA', 1, 0, 0, NULL, 0, NULL, '', NULL, '42b2faad68ed9b867ae5827dba3786894b2547b9eee8098a38b13c30e6d20a04e939e2c5554956d9a82737c4d656d5d1c593260247860826376c701059b945bf'),
('UDA SAI KUMAR', 'MDM13B035', 'M', '', 'UDA SAI KUMAR', 1, 0, 0, NULL, 0, NULL, '', NULL, '42db55427576bdc4755a6089410ff2cde63f8537af58f39fe390e4e5ec16b9ef544a1d145263d960f1619cccdb9ff5cefef7feafc0b35e27c5325457fba6a4c8'),
('KANDIVALASA PAVAN KUMAR', 'MDM14B014', 'M', '', 'KANDIVALASA PAVAN KUMAR', 1, 0, 0, NULL, 0, NULL, '', NULL, '4315bfd863be2c06afb6247349cd0db12f1cc702cf465d1f43fd453efb495f47d77eeabbbaa85597ca5c10da3e48b50d3c8e1cf513909a12c01538eefef299d4'),
('ABINAYA J L', 'COE13B002', 'F', '', 'ABINAYA J L', 1, 0, 0, NULL, 0, NULL, '', NULL, '43167ed17cee7f46715c07f013dfc218210c352ad200d4eccc6bf16b6aff15663078bb2e239f46f406a9389f7da2b25686c5d1656d764a77011bc37b05110225'),
('MRIDUL GANDHI', 'MDM13B015', 'M', '', 'MRIDUL GANDHI', 1, 0, 0, NULL, 0, NULL, '', NULL, '4342de9c89633dbf0e3df7323732f1d7f8a82ba470d8a0f01940c656242078a346bd2351095932bd50cc942ee56ca859cc261bcc6d733fe31dc3cd9571df7e10'),
('G SREENIVAASAN', 'CED14I008', 'M', '', 'G SREENIVAASAN', 1, 0, 0, NULL, 0, NULL, '', NULL, '4384a42311ae7d5d504bf9b5169a3016d3874eebbbeb1cf4d7a57d91b90de0f3637c8560f24618e2ab847227202db4d54a78289a208a38da702d17e0159bc4d4'),
('DANNARAPU MOHAN SAI KRISHNA', 'MPD14I002', 'M', '', 'DANNARAPU MOHAN SAI KRISHNA', 1, 0, 0, NULL, 0, NULL, '', NULL, '449aa26a786faad7d7c43adc19ae0d8ec305c70995908d2c5183a8c3ecb43b1980f00460af5ea0ee69854bde3c33d181e1d5e90fa0f42b64dd11b0ac6b930ff8'),
('RINEETHA CHARLES', 'MDM12B019', 'F', '', 'RINEETHA CHARLES', 1, 0, 0, NULL, 0, NULL, '', NULL, '44dda7027590d1cbfed4c77e2b9c4fe4cc4cbfc3eb4a8fe84b67ccd9165508c788551cd9936c04af72cabaacb8e772ddc34a94f2d2d51220757e3ad293f3cb45'),
('IRUKUVAJJALA SUJITH', 'MDM12B010', 'M', '', 'IRUKUVAJJALA SUJITH', 1, 0, 0, NULL, 0, NULL, '', NULL, '44e8be7463a8561651c6e3c9379dbe7e4ca8f07371fc8f426f4147eebfa109c7941169b84e5fe3f30c89f30e4c7e710ce5eeda5a078d731f377055b1f7b6e889'),
('SHASHIDHAR D', 'EDM12B027', 'M', '', 'SHASHIDHAR D', 1, 0, 0, NULL, 0, NULL, '', NULL, '450867bd2e1eee26a4e77314c686c9508c7d3569c77581bd159c2e6d2f6d640b26819e5d9922a157d3d6c9b90451ac7c5b5ec371bd47a46fc765dfc33cf7d5a4'),
('GOJALA SRAVAN KUMAR', 'MPD14I017', 'M', '', 'GOJALA SRAVAN KUMAR', 1, 0, 0, NULL, 0, NULL, '', NULL, '45bd55feca4a17a27a3b97d3e78b5c832cb5246e0629f37f40483aa433696d23883b7729778d0a1e672c600483d7e2a6ea20049bf536322580fca0a03184c0e3'),
('MUDE ADITHYA NAIK', 'EDM14B028', 'M', '', 'MUDE ADITHYA NAIK', 1, 0, 0, NULL, 0, NULL, '', NULL, '45c917878842d63e69a8fb9882df27c1e9ffd694e533a2a248c89a13a6f0784a5e4618a811b445d298cd338a80652721116852085de2214949f3d9c6aca1406a'),
('KRITIKA PRAKASH', 'EDM14B025', 'F', '', 'KRITIKA PRAKASH', 1, 0, 0, NULL, 0, NULL, '', NULL, '45f9e503e7fcc1a86d07392a5b414440b7d255cb33dfa44c96a22a73610e4ffb47598502993797a262c2c7978237d1a6a95ca8f69187d03223598faf1941e6e5'),
('RAVIKANTI VIKRAM', 'EDM12B025', 'M', '', 'RAVIKANTI VIKRAM', 1, 0, 0, NULL, 0, NULL, '', NULL, '47bc07bd7e1e6855a543649b6cf841586447647b90fbed663d5435e981ffaabf1be91e99bc0cdd6b80b90ef414cd5b26c08a074aabd9bc33956decde05c41581'),
('INCHARA.K.M', 'COE14B010', 'F', '', 'INCHARA.K.M', 1, 0, 0, NULL, 0, NULL, '', NULL, '47c9ea46cc5c43514faf5fcfcc6bfd572352103b5357609d61a66bd0ba65d6a38d9f622ac1c8f2e55cdf48d581ca9a14a44877cfcceca990422bb1e23a051c94'),
('NITIN VIVEK BHARTI', 'COE12B018', 'M', '', 'NITIN VIVEK BHARTI', 1, 0, 0, NULL, 0, NULL, '', NULL, '485cc3afc5a2ec59dbadd9674bedb81bb4263d6156280906a891e29c0c5096191d83143c049e886c59106e826faf25c8b0b3518f68840d844e11b27630cbda79'),
('VYAS ADITYA KISHOR', 'MDM12B028', 'M', '', 'VYAS ADITYA KISHOR', 1, 0, 0, NULL, 0, NULL, '', NULL, '4867bbcdb68f52efaf247241592b7e61adf7f8e24be9febec18f898b5dc099276b2f8c1ecdb2e3eb85922fc6ec82721d71ab2afdacb71afef3b662be5428a3d0'),
('ASHISH KUMAR', 'MDM11B003', 'M', '', 'ASHISH KUMAR', 1, 0, 0, NULL, 0, NULL, '', NULL, '48d158fe601cd193ddcde26f8b046685761784f33ac6dba2e3f731dcc9f5aaba10fbba64bee0b09a576b372c2ea7dcae7f68de98b86264919a2aaf9955bbf7a4'),
('M.SAKTHI SUBITSHAH', 'EDS14M009', 'F', '', 'M.SAKTHI SUBITSHAH', 1, 0, 0, NULL, 0, NULL, '', NULL, '48d19e3bf5200ad62817e0f42ab1450ca02e4aa6e4b9fa52731e0965c44ac35c2ec4a16c9b4d7bff95c4b8a2c7a474864be2531c79842cb2cb39c4361788905d'),
('SIRUPA ROHAN', 'MDM14B032', 'M', '', 'SIRUPA ROHAN', 1, 0, 0, NULL, 0, NULL, '', NULL, '4905d9b0d83b2b31e4e299121ff90018c12bdc720bc14bd4cdeaff726b27bee49b74ddf282e49a61c4c0150f2d27f15662761f0cbf17313261c9c8a676a5a918'),
('SOUMYA S VASTRAD', 'EDM12B028', 'F', '', 'SOUMYA S VASTRAD', 1, 0, 0, NULL, 0, NULL, '', NULL, '495f5cc9fa37f9acc52df29f256a28a651cee25d51ff5e3633c4b1c2348c95f2a393ec2c71a37b0f927274288dfd06ff0198639cd1a482abddc587af328f372c'),
('NITHIN S', 'MDS13M009', 'M', '', 'NITHIN S', 1, 0, 0, NULL, 0, NULL, '', NULL, '49ae526267dd06b888a1a03568bef8b201d3321cfbc27ef8d0fee32ed1adf01e6a49b3b03d6312e0f69518d2c709ad3c05192f1399e2a0b84341809db2f1d092'),
('RUSAN KR BARIK', 'CDS13M010', 'M', '', 'RUSAN KR BARIK', 1, 0, 0, NULL, 0, NULL, '', NULL, '4a073d7faf55cfa7d577bee96bcaa6ca106d2a28ced8219ddafa9a6f71152eba36a3a56af9abf6b933524b821648ed2f1533fa323aeacb8cf07cc0542f639e72'),
('NENAVATH RAVI CHANDRA', 'MDM12B015', 'M', '', 'NENAVATH RAVI CHANDRA', 1, 0, 0, NULL, 0, NULL, '', NULL, '4b167f6a3e2ea6d252edcbf2f649d6f59cc834ce8574575ad42c269d26658d79e19e9fcdb6a5a80de90119118e818b5596b6660bfb7f942314933defcb7402af'),
('K ROOPESH REDDY', 'COE12B025', 'M', '', 'K ROOPESH REDDY', 1, 0, 0, NULL, 0, NULL, '', NULL, '4be99f55dd6ee8cbc5fe5ad6f9ee0b1475c4d9132850f06c7075816f8f27498320aeca901f750f7803c793d9a0da591cb1612ef0bc253646b02762edee710d5a'),
('AMITABH', 'EDS13M004', 'M', '', 'AMITABH', 1, 0, 0, NULL, 0, NULL, '', NULL, '4c193f771071c60857afb754315ed94e1cd5b48778822e627bdd23978787e5d7827ddbeef08b10766122832a7c5007baa8f993f54280e735f0a637241ebf6129'),
('KUCHIPUDI DIVYA', 'CED14I041', 'F', '', 'KUCHIPUDI DIVYA', 1, 0, 0, NULL, 0, NULL, '', NULL, '4d56c4d06359fc5325e66c24c61603acb2ecba088649d724fe9d5a5ab0244e34826dbd4187f78385d4793c473d3c02f86c541adfd0da5ae0b770882d0ba58aa8'),
('MANDRU MOUNICA RAJ', 'EDM14B040', 'F', '', 'MANDRU MOUNICA RAJ', 1, 0, 0, NULL, 0, NULL, '', NULL, '4da621b64e3133d4a6a0f3d189ae9759efe168933886b40dc21133b302c1c34bf3c03b44fdd64b6fa6bd077957a7c38fb15565af4eec4cfa10bbae7cc82cccaa'),
('GANTASALA SAI HEMANTH', 'COE12B005', 'M', '', 'GANTASALA SAI HEMANTH', 1, 0, 0, NULL, 0, NULL, '', NULL, '4dbb5a2f9314875d41855940f194da51e2bf06b8bfbbd53257fcfbb3115e468e6c6862485992163e22a7ba03b41bac72e128532b70032bbb5cdf6bf7d20de668'),
('PRABHU PRASAD NILAMADHAB BISWAL', 'CDS14M005', 'M', '', 'PRABHU PRASAD NILAMADHAB BISWAL', 1, 0, 0, NULL, 0, NULL, '', NULL, '4e6e5ac2c258ff8ce0839bc93873ce0c39e2d680507622d48baf098fcade961eceea2067d3c64874c2811d58765a52da4a890c68a83cb3b0c82d20c178d04f02'),
('GANDHAM KRISHNA SREE', 'CED14I009', 'F', '', 'GANDHAM KRISHNA SREE', 1, 0, 0, NULL, 0, NULL, '', NULL, '4eafea818dbc14234a1a2ed5af17dc848a3146f0940e87bb7fe8fe0b3776823c60599ec2119292c97137bbe0161c5fa69a4d4f577f540f8baa58112851cda82c'),
('MOHAMMAD ISHTIYAQ QURESHI', 'CDS13M004', 'M', '', 'MOHAMMAD ISHTIYAQ QURESHI', 1, 0, 0, NULL, 0, NULL, '', NULL, '4f5757a3baac366f179b53c13e9bc60dad86ba159d8980c5f5c8cbf7da225b0b829fd9ffe5ca1a9cb419e6666fda5ffbb4fd46c06d6b039c896e84576a20f77c'),
('PRAVESH SINGH KUSHWAH', 'EDS14M010', 'M', '', 'PRAVESH SINGH KUSHWAH', 1, 0, 0, NULL, 0, NULL, '', NULL, '4fc253b5c8b0c72c29f420dd1eb0556b86aa09dfaf4115ff5032e5543132daa1ab71e4109284f878bde25e15206b9936d8a6c06eef607a6c636e06d1c7356af3'),
('KOUSHIK SRIVATSAN MURALI', 'ESD14I005', 'M', '', 'KOUSHIK SRIVATSAN MURALI', 1, 0, 0, NULL, 0, NULL, '', NULL, '5032be7dee050616b6db46f0ce3df62bf191b25cf37ce00e6eee5235314c409a02942f3f5ac5c2249459412da2c74df13d29eb627df8b2ed67fcb085428dc14f'),
('JUNOOTHULA RASHMITHA REDDY', 'COE12B008', 'F', '', 'JUNOOTHULA RASHMITHA REDDY', 1, 0, 0, NULL, 0, NULL, '', NULL, '504834b9006d196e524d484f979724a1f26bf155e8ab0ada273bf00b9c82d188bc0431ba31fcf81e5f5c4ae088e9bc63f8fa99317dbe1112143271a1fdcd07f7'),
('VEMULA MUKTHI MUKESH', 'EDM14B038', 'M', '', 'VEMULA MUKTHI MUKESH', 1, 0, 0, NULL, 0, NULL, '', NULL, '5063212c04174f91033c9edb37f9e0a94d90e7b4926c2bbeba1c87336937dc1d3d7bdc9a02c12c95b50c37bb67a2cd377b568bef705568ff16a8e15ac518c0d5'),
('NISHANTH. P. V', 'EDS13M010', 'M', '', 'NISHANTH. P. V', 1, 0, 0, NULL, 0, NULL, '', NULL, '508c8e88c77f2a81e0296a1bf5b9ea046cbe71b8afb8c27f4ae6d5fa7a717e7dee847c8cb8f6091df1a67382e7296c01f1490958221a5dfe054bb23a991bd710'),
('SARATHI K', 'COE13B028', 'M', '', 'SARATHI K', 1, 0, 0, NULL, 0, NULL, '', NULL, '508e2c59edb238de38d47f244a62af6dd39738cf8e680750a3c912a88df32a905f665ee5c92ca7080363d6a5c29253b6e44af119b322597cdbcc96c8687bd5c0'),
('MUDIYALA JAHNAVI', 'MDM14B021', 'F', '', 'MUDIYALA JAHNAVI', 1, 0, 0, NULL, 0, NULL, '', NULL, '50967a623ec6fb0cc96ecd25f761e4cb353efb7b60a23133bbd5481a4304fc4a856c287d4f03b76afe2184660af26dab39ed2aa3f0b9d5fa6ce649f2dab96e75'),
('KOPPERLA RAGHU VARMA', 'MPD14I012', 'M', '', 'KOPPERLA RAGHU VARMA', 1, 0, 0, NULL, 0, NULL, '', NULL, '5226ebe74b155337a0b04caa587a26a5293e6fc07dff84622d9537a8dc73ce1c39bbe3f99fde5762dedb99997a224e28dd27ef1a5ed7c9aaea6ded681a7cd67e'),
('KOLA BALAJI SRITHEJA', 'MFD14I017', 'M', '', 'KOLA BALAJI SRITHEJA', 1, 0, 0, NULL, 0, NULL, '', NULL, '528a86ef80137ca0945df582a8a14f1fd1e0c7f63be0792bb0205f1b9e9aecf7da341a40b2fb433d27ac5ffe79f062ee7aad04fc22b97500e5b225099a7fe846'),
('VONTEDDU ANUSHA', 'MFD14I021', 'M', '', 'VONTEDDU ANUSHA', 1, 0, 0, NULL, 0, NULL, '', NULL, '52a58bd675ded4277d35a5afe78b5076cd1901a1580b97c721500ada2b417e95adc6a6d07ae437865a7ab1a0b28eaa074b7a5b96f7566344dd747c4f02aaf1e0'),
('NIHARIKHA.S', 'MPD14I010', 'F', '', 'NIHARIKHA.S', 1, 0, 0, NULL, 0, NULL, '', NULL, '52dc8edc0db042e1b5b21684ddf9b503ab91c6edbf7ec975326921fa3c010fe66b3f8e30a5db5dddbe908725cd6ce90135b1eb27c54f769371e87319ad01ce1b'),
('RINKU KUMAR GOUDA', 'MDS13M016', 'M', '', 'RINKU KUMAR GOUDA', 1, 0, 0, NULL, 0, NULL, '', NULL, '5344b82f65a77928acb495c8efd4697c1f8fe75f237f56d6a8d3b1ee1ae1260a7596fb75476a1c7c5c9ca14d9890440598070a1da9af2521d7f6388eee535d7b'),
('KOMMU LAKSHMI BHANU MOORTHY', 'COE13B012', 'M', '', 'KOMMU LAKSHMI BHANU MOORTHY', 1, 0, 0, NULL, 0, NULL, '', NULL, '55f272dca14d278a4b40fda79c23f1d3ae826b73c014f6a13947c7f9ac5462f486f087c3828a6792f7900ed7253bc870de62a101c46edf10e2cc8b10c6d92469'),
('MUKKALA AVINASH REDDY', 'EDM13B019', 'M', '', 'MUKKALA AVINASH REDDY', 1, 0, 0, NULL, 0, NULL, '', NULL, '56b741e9f9ef2e59115e67c19ca340a9af284f99e299e7cbc4dc5d63c7c099f9fcf161f6134d4fc83f6b0f66668e249944d062631aa973b4078db5d4fbf59094'),
('AMIT GOSWAMI', 'MFD14I001', 'M', '', 'AMIT GOSWAMI', 1, 0, 0, NULL, 0, NULL, '', NULL, '56b7a6b4596e96ee1bca265540ca8811b73034ca40d95d0ea4dff50a9d22a20b5ac6edfd4dabeeaee4f2e130a018c9732f2ac9265dbfb98524219c4c67745e7d'),
('SNEHIL WANKHEDE', 'MDM13B027', 'M', '', 'SNEHIL WANKHEDE', 1, 0, 0, NULL, 0, NULL, '', NULL, '56c89cad8f8f3324cbe38d9ea19343c516caef402d9a297786dc9e6b4123a453d032b95d95dd45206b6460a20594062c33c2c47b6138f053a1aa4da0f94fcd4a'),
('NAGALLA PRUTHVI', 'COE12B016', 'M', '', 'NAGALLA PRUTHVI', 1, 0, 0, NULL, 0, NULL, '', NULL, '56f7dd3179ed3c48542ed3ed014463ef08491f143edc735d291dffcb5c40416c40460f033f6e18d0d79ad0c388f2fa7fde04105fc08bdceb765983e387ff20f6'),
('ILLURI MADHULAHARI', 'COE11B012', 'F', '', 'ILLURI MADHULAHARI', 1, 0, 0, NULL, 0, NULL, '', NULL, '576ee9f1ec4eacb5ddb1b99232fb5ff17983976c0fc8ef60e7d485eb5abb6c318192ff6e8c34c20e29d49e5e3915a3513f4f16b5bd2c8b0a3662f2f86d822651'),
('DEVESH', 'MDM14B006', 'M', '', 'DEVESH', 1, 0, 0, NULL, 0, NULL, '', NULL, '57d7ebb0aa3d485e1756b8a5849056b0cfebb6760945eeeab7aad489f4c86fca430e1b890a39e2db76e71e2aef4884edfc0346d359e42f239906d34319be3441'),
('R.KIRAN KUMAR', 'EDM14B033', 'M', '', 'R.KIRAN KUMAR', 1, 0, 0, NULL, 0, NULL, '', NULL, '57f87250f7e6b197955a459bb162641cc5bbacb0533da2a349c6f39508d3b157f6941b54fbffe3d602851bfa2038b6760f03ef83bcef324a52654982eef405d1'),
('NETHAKANI SHRINIJA', 'COE14B025', 'F', '', 'NETHAKANI SHRINIJA', 1, 0, 0, NULL, 0, NULL, '', NULL, '586cdb793857943f11084ce1fa79cb9ccedc9c23f42f7ffd2a46f698195093b12495692961b33dfb13b82bc3d509ff5f249ec6ced24e68ababe0d55e508083cb'),
('R AKHIL ABHILASH', 'MDM11B023', 'M', '', 'R AKHIL ABHILASH', 1, 0, 0, NULL, 0, NULL, '', NULL, '592a1e230fa2050015b5bb6da3a8d2e01c1c8c0df023514975952069d630b7e5ddec90a136076b640bd4a301654c8849e10ca2a206d7a8e7ab0a224bae7ecf5f'),
('MOHIT MEENA', 'MPD14I005', 'M', '', 'MOHIT MEENA', 1, 0, 0, NULL, 0, NULL, '', NULL, '5a469c5b0fe543ef8018983957791ddba212757ba76c64c10db491452743df0c2c7a7178c5f2ef85a63bf27cfe29f29a54970b7fa98b7a0ece836f355de83f93'),
('ABHIJIT BALA', 'EDS13M002', 'M', '', 'ABHIJIT BALA', 1, 0, 0, NULL, 0, NULL, '', NULL, '5c3a45c329411cf5cc6d21944c6d28b7a03e5e773ef8d501b2f6331889f9801148b5e38b705071436f95a53f891807763f45c1f067349e68dec1f58c1670805b'),
('VEMULA SAI ISWARYA', 'ESD14I021', 'F', '', 'VEMULA SAI ISWARYA', 1, 0, 0, NULL, 0, NULL, '', NULL, '5c92250a642685f6966ff753067e6f0c00fef8eec2116c6754fe4657043053ec10c473002b2a84583f7fbb173d165ec90e0ad36a774e52f33bfbd53951424641'),
('YEVALKAR ABHISHEK ARUN', 'MDM11B028', 'M', '', 'YEVALKAR ABHISHEK ARUN', 1, 0, 0, NULL, 0, NULL, '', NULL, '5c941077f878345304f5ac58b3dda6cd756610a24c9c8c225d73890476692249e0e8786bd4ab4d45ffd91f2662094cf9a8178519d1bc70f6726b0a4a91a7eb19');
INSERT INTO `users` (`name`, `userId`, `gender`, `password`, `alias`, `isActive`, `rating`, `lastLogin`, `hasBlocked`, `pollEligibility`, `badges`, `profilePic`, `clubsInvolved`, `userIdHash`) VALUES
('VUYYURU ANUSHA', 'EDM12B031', 'F', '', 'VUYYURU ANUSHA', 1, 0, 0, NULL, 0, NULL, '', NULL, '5ca15f07e82cac43651208f0603b951585b9458ae252306b839708e623faaee9899b518a1e646a6c0f41ff130034bb0a3884f22307abf1ab6a706134d4abd6b5'),
('YASH MEHTA', 'MDM14B037', 'M', '', 'YASH MEHTA', 1, 0, 0, NULL, 0, NULL, '', NULL, '5ce5b6a45aabe0ab3d4685a51bb8a934978c145cc1947b3175532301d87b098074e5274ef76063235facd5b9e4aed10d44b1796f870526333b0242c831268740'),
('PURUSHOTHAMAN. B', 'CDS13M007', 'M', '', 'PURUSHOTHAMAN. B', 1, 0, 0, NULL, 0, NULL, '', NULL, '5d2174c5e4e3b809d7452cc3dfd02d6c96030b32ca9c469af9a3a3524ac1ab794acf3a29589a12ccd243d2bb6d2db2444fa562a9ae1484bc69b96f5442723935'),
('ARUNRAJ. R.S', 'MDS13M003', 'M', '', 'ARUNRAJ. R.S', 1, 0, 0, NULL, 0, NULL, '', NULL, '5d5c1d9fc177c7c55507ba3bc362e89d636d3991b67feb8e4375f1689e1bae9f1b5baca53ffe13a3433695364a73b97d380502dad48be704c1bb6271dc1dbe4c'),
('RAJIN M LINUS', 'EDM10D002', 'M', '', 'RAJIN M LINUS', 1, 0, 0, NULL, 0, NULL, '', NULL, '5d697ede4a2ec5ffcfdbb9dc79623d3dd564dca0bdd570dfae56cb66187ac20acecaf7bd812e0e9bc861b953bc0f95c4408cf19d7b5a8f5a2eba5570634642d8'),
('ROSHAN. G', 'MDM14B028', 'M', '', 'ROSHAN. G', 1, 0, 0, NULL, 0, NULL, '', NULL, '5d91c037e1e1f6062297bfa4246b093cfd54c288a74ec081d44bd98c57481ca934c05a9664f83d67893d9d7799c925785c7c234025fa47b4b795517b19c70086'),
('GANDHI SHUBHAM SUNIL', 'COE13B007', 'M', '', 'GANDHI SHUBHAM SUNIL', 1, 0, 0, NULL, 0, NULL, '', NULL, '5fff7fe73aa2bb1dee6b94c4accd074febd4b8e3506a9a54012658bd1bb23121ed62d902cbff9d0266b7883c258403b78db1f230d01d41e4d95ab8cd4abc5edb'),
('GUTLA AKHILA', 'MDM12B009', 'F', '', 'GUTLA AKHILA', 1, 0, 0, NULL, 0, NULL, '', NULL, '60028617830faa9dcd396e01bb6cc244f3153cb84954f64519520efaf1fd66c206a8b20eb30ad181c5646493a5dd7d8bf87477bb53dc8630228ad13fbe6afeef'),
('C.PRITHVI', 'MDM13B002', 'M', '', 'C.PRITHVI', 1, 0, 0, NULL, 0, NULL, '', NULL, '6018b6fdba759cad2dca9d7a5e4b27c612dfa8f8940e5a1587f566198c61628c72b15909988b4a99778d436bd078704f55ff31de7cf88a5e9868f3501524b349'),
('R AVINASH', 'COE13B023', 'M', '', 'R AVINASH', 1, 0, 0, NULL, 0, NULL, '', NULL, '6201bf4323329f1fbbc7479bc749ab18ace2af95f85a5266c9d5010f187bd624bc389a74e3aed771ccbd0b27cb25219f7bf3cdab434ed8ae7eb31240253fe2ad'),
('ADITYA NARAYANAN', 'EDM11B001', 'M', '', 'ADITYA NARAYANAN', 1, 0, 0, NULL, 0, NULL, '', NULL, '62c07eb52c94e5d78359d97c1df2e1ce4566dd9aa8ca32931edf1e1596430cbc893ac511d094d0b8b5aee82c9fec2d1a60b10322122b6d142afef518c2e4da47'),
('ATREYEE ACHARYA', 'ESD14I019', 'F', '', 'ATREYEE ACHARYA', 1, 0, 0, NULL, 0, NULL, '', NULL, '6315e06beb8dd72f0afcc63dbfd7df87457dd6379d940e3bc8e3e4bff0c9e39a5b922b12c21d6e3126125eb40773e3cb97f58564947a9b189e8ea6c0b61c01b2'),
('LAKAVATH RAM NAIK', 'COE11B017', 'M', '', 'LAKAVATH RAM NAIK', 1, 0, 0, NULL, 0, NULL, '', NULL, '6347fc7df9dd2381b344fcb2e3ee8c1c2870ddd18706653a7709ed097c3dcb5ea715587fb0b06d3a02c125f6e8b3221e8d006106d46d03d00562bd1541c32d8f'),
('JEYAPRADHAP. T', 'MDS14M009', 'M', '', 'JEYAPRADHAP. T', 1, 0, 0, NULL, 0, NULL, '', NULL, '63801261363a453dd737b4c6c621f063cab99d0be6d1c12b20bf92dbe91cc2d8f53a3beb9a2397a556c397291f2d33228064b22cd5893eaffbc21437fb5d05cd'),
('SIRIVELLA SAI PRANEETH', 'MDM14B031', 'M', '', 'SIRIVELLA SAI PRANEETH', 1, 0, 0, NULL, 0, NULL, '', NULL, '63aa1e8f8504450038b82d8963a206dabab5aaffd5aef090b12d05e91b15dfac7a770703575521185f0c9828443d3a07222b71b0afa0c3df09c75376de13377a'),
('BANDLAMUDI NANDINI', 'COE14B004', 'F', '', 'BANDLAMUDI NANDINI', 1, 0, 0, NULL, 0, NULL, '', NULL, '63f95645ad29c9e47b0cc83c40eba2767a45b3896c27851f450a5b4b4ad7d637bbef8ad0ffccad73086b566f72e0c562c63d6c2d881b5c3c78463b6c064cbf75'),
('AMGOTH SWAMINATH', 'EDM13B002', 'M', '', 'AMGOTH SWAMINATH', 1, 0, 0, NULL, 0, NULL, '', NULL, '6473204666bb0ad263cef00bca3437f3fedac26543f01ac45e1368f90d4ca08da87a82b9d6feb257ceb145a81c99b4b1b03d80b35bbe53224b9196fe28a2ae6f'),
('BONTHU BALA MANIKANTA', 'CED14I004', 'M', '', 'BONTHU BALA MANIKANTA', 1, 0, 0, NULL, 0, NULL, '', NULL, '6491c70261660bf713389dc9c8f3aa53929ca67d2d86962285db1aed51cdf3ab27301f5e32d40cd813aac98b026066017f4f731b9ed2c0c1add770a81b03e513'),
('AKKINAPALLI VINEETH BABU', 'ESD14I016', 'M', '', 'AKKINAPALLI VINEETH BABU', 1, 0, 0, NULL, 0, NULL, '', NULL, '64a10cace47d7abda50b224cf9ad436be14c91d008feaa5e8cb6f22bb0638a8cda93baa5b3e38c9f7911702a24e4af39544f9ab95bce3662c52d9d3c1544452f'),
('KOMARAVOLU KRISHNA KAUSHIK', 'EDM12B016', 'M', '', 'KOMARAVOLU KRISHNA KAUSHIK', 1, 0, 0, NULL, 0, NULL, '', NULL, '65376e3df0aaa1cfee4a646d788e3494c50068676e053d20d8af022b15ed9f7ecffc5d75c571d6e9edb5306c7721964d1a6e54dda269b4836dfd558a66b061d2'),
('SHAIK WASEEULLA', 'EVD14I013', 'M', '', 'SHAIK WASEEULLA', 1, 0, 0, NULL, 0, NULL, '', NULL, '654bd27ef55c09a07877a7ccae680a1c3167100d1ac4b2513796094d8fe57e2ce0c7ffa66996996d55e9e1868b697ed21eeb0ceb5b7d43beca5bb36250a8bca2'),
('PAWAN KUMAR SHARMA', 'MPD14I016', 'M', '', 'PAWAN KUMAR SHARMA', 1, 0, 0, NULL, 0, NULL, '', NULL, '65c4b0a8a7bd5b9801653d60f3d90e4625deb9ee3a94a32e8c4da9b576e2c848e7bb4b7d8ce1bc615579d795754c83f434c1dbbee02f3db5b438166149e244ba'),
('B AMULYA SAI', 'EDM14B005', 'F', '', 'B AMULYA SAI', 1, 0, 0, NULL, 0, NULL, '', NULL, '664fbbcaeb7b8be52e85a5e042d88c3f0be0d9c4aa460555e49356649af7a4e0b4e2e93711d0621be544135639fbf617400cf80d2f9c089b72c7421910184153'),
('KANDUKURI PHALGUNI AISHWARYA', 'EDM13B012', 'F', '', 'KANDUKURI PHALGUNI AISHWARYA', 1, 0, 0, NULL, 0, NULL, '', NULL, '66d0e39da7d5f1f9cd20b2b82cff9aa198e01a715fc8224db0d3de7c0dba19c2629c4c2c70973dc5de429be9e6bc50d5200db73cbdd3e6a0c276b29471676626'),
('DEWARLA SAI ANOOP', 'MDM13B005', 'M', '', 'DEWARLA SAI ANOOP', 1, 0, 0, NULL, 0, NULL, '', NULL, '6767745b5c1fa17451edb12c5a43644cef028b1b275d6ad635d15cdc40ad38d2e197e60a422e90f94a4474939d4cee429cce6ba5520a595f68b0395939c45589'),
('SAI GURUPRASAD JAKKALA', 'MDM13B024', 'M', '', 'SAI GURUPRASAD JAKKALA', 1, 0, 0, NULL, 0, NULL, '', NULL, '676ce8d2010d3e0116d7cf7610f56d95e7d6110fab0fcc9aa840325ae0e90d6ac977a1cc68d588a4519d489390ac0604e0a2fd59077ef77baa89c75013211de2'),
('KIRAN KUMAR K V', 'COE13B011', 'M', '', 'KIRAN KUMAR K V', 1, 0, 0, NULL, 0, NULL, '', NULL, '67d21498a7847d528d6ba50612130b9dc0b455a5c7a421dd9ae22804d0265d2a90cbe37b97fbc41d5067be742dd2189e224068eecc6bda8f6ac4e472bdc74ae4'),
('BHEMISHETTY GAUTHAM', 'MDS13M005', 'M', '', 'BHEMISHETTY GAUTHAM', 1, 0, 0, NULL, 0, NULL, '', NULL, '67d472b2823012b0f0825d618d626d58dc33a646f985a06eec69e20d51c4c8a415a37b4a1f2c3dc167825e090a83b926f7b80d5df289dbada89313337acd82f5'),
('PARANAM LALITHA', 'COE14B027', 'F', '', 'PARANAM LALITHA', 1, 0, 0, NULL, 0, NULL, '', NULL, '6806e6f008fea4f79250d2ba6a454b5edfbbc9a254715cedb3e65c14a39190ae3e8150599e062cd7ccabf3ccbd46dd3f2d6881c2bc04410d7299472b40074009'),
('DEEPAKKUMAR. R', 'MDM13D002', 'M', '', 'DEEPAKKUMAR. R', 1, 0, 0, NULL, 0, NULL, '', NULL, '684f714a3cdd0c3ca9aa4b679a92c73523624418ddb2c2b5323f4bd69b1e0f7ff52d20ee0bbfd648a69a74d9cbc0f01bb7cec4e6977149d19e2300fca444873e'),
('S. DINESH KUMAR', 'EDS13M012', 'M', '', 'S. DINESH KUMAR', 1, 0, 0, NULL, 0, NULL, '', NULL, '693bae2726466b566ab8c95d842225347caf92f0e0d668bd8eb943bc72f72ebf02379ba9b44d64e17c58b691c2c30975f8268418277687c2ada74033136cd379'),
('MADHU MOHAN ANBUMANI', 'CED14I022', 'M', '', 'MADHU MOHAN ANBUMANI', 1, 0, 0, NULL, 0, NULL, '', NULL, '6954972c43eb5ed81af7ff8eb1025084e8e7c91dfe14b98344710242c447f95ca32724ec8e46ae5a15578833723926a9e2863836adfd8beeeca001b066e25de0'),
('TUMMALA NAGA KULADEEP', 'COE11B026', 'M', '', 'TUMMALA NAGA KULADEEP', 1, 0, 0, NULL, 0, NULL, '', NULL, '6966db8c2b3e72f217793c7b2023581546641969b8ad06d968442ea72ff4adc71e5de0b3b4e29e5046f431d8850ca1e83a4231a90362b50ac7394d1c137c7ff1'),
('KATTA KOUSHIK REDDY', 'COE14B014', 'M', '', 'KATTA KOUSHIK REDDY', 1, 0, 0, NULL, 0, NULL, '', NULL, '69e7e41a1260aaf2b4cca5374d089e36a84a688991888b7ccba32f0bacaa72dc2af06125c92659babd4eee003d7a2ac425766caaf21182b6dd4100a336e01d29'),
('V SAI SRIHITHA REDDY', 'COE14B038', 'F', '', 'V SAI SRIHITHA REDDY', 1, 0, 0, NULL, 0, NULL, '', NULL, '6a40fb45256ec2e7f74f0634f71d6e5d061af57f7bee9adbb2ee9f9db733280cf1d32025eac728e1598034608aa46d329a57b0be66656dee6f1879529f8ee6e2'),
('JAGANATHAN A', 'MDS14M007', 'M', '', 'JAGANATHAN A', 1, 0, 0, NULL, 0, NULL, '', NULL, '6b4c591c2508bf007ec2cc89dcd65659e2922e98c40be5e6c88eef2d272ccf73b7141ef7dc0cc040882cc169251341a0c4b8d9dcd2aa2c5d1baefd86987c7b55'),
('SAIEMPU STEPHY', 'CED14I033', 'F', '', 'SAIEMPU STEPHY', 1, 0, 0, NULL, 0, NULL, '', NULL, '6ba3b503a8582b5fa9142d3e83063bd48ae166150d29f502132e5c9f850c70eee13149224d26c50448fbbfd22e8d9ca08a757370cf8b45c529c11b1c6f717723'),
('SHATAKSHI GARIYA', 'CED14I034', 'F', '', 'SHATAKSHI GARIYA', 1, 0, 0, NULL, 0, NULL, '', NULL, '6bd7b227d85abd372f729588de250270e5f818cf1ce699998cb35e47fa69d374f662bb18643672a475a2c3798746347f922b600686e40b4c9c5fbe4a6588d0f6'),
('K. RAMACHANDRAN', 'PHY10D001', 'M', '', 'K. RAMACHANDRAN', 1, 0, 0, NULL, 0, NULL, '', NULL, '6c19603da22107fb23275b30788b76d4ec028770d4425ee56142ff6ef87eca7048401332ed926dfb3bab0aa02cc6d9dde9e2de7cc48a31b9a1d85a0689b25979'),
('TUMMALA NIKHILA', 'EDM11B026', 'F', '', 'TUMMALA NIKHILA', 1, 0, 0, NULL, 0, NULL, '', NULL, '6ce4c7abe7db050ae0e9cf5131122e846de9f57a085cdb7ae0c5a4f1695cfa0337c6212e2ed8d0109a8b8e4f12379a2ab872ad460e4415db6530a6d7472c3abc'),
('SIDDHARTH SUBRAMANIAN RAMALINGAM', 'EDM14B035', 'M', '', 'SIDDHARTH SUBRAMANIAN RAMALINGAM', 1, 0, 0, NULL, 0, NULL, '', NULL, '6d1360a6afb837fa16599eebca1ea7fdab55c535e139955e6af390a607ba60f9524435967bc08142d0e7c602cc877025962f49bb82a7a48df6448b68ae3c38fa'),
('JITHIN MUTINENI', 'CED14I015', 'M', '', 'JITHIN MUTINENI', 1, 0, 0, NULL, 0, NULL, '', NULL, '6d57412413a9b3d5b445759f2a6e9029a3ae1d8e4479e77b9b3f1fff2041fdd04321e9d0af8846e655c132f88a63ebb009e53d1a94cb28fbb49ec7ca0b0b7884'),
('SUMIT RANJAN KUMAR', 'MDM13B030', 'M', '', 'SUMIT RANJAN KUMAR', 1, 0, 0, NULL, 0, NULL, '', NULL, '6df604181c9ac63068b6bd3c462a0e0fdf4767de87f8a2a6847d31635f8fce9114c7c3f6b9e90c5bc381f71f9247759b7fb442cec4f1e0dbd26b18843c26a138'),
('MADUGUNDA JEEVAN KUMAR', 'COE14B021', 'M', '', 'MADUGUNDA JEEVAN KUMAR', 1, 0, 0, NULL, 0, NULL, '', NULL, '6df7605cf48572f672cbda2cd81cb5dafbffdeb8ffb80a49a4dc420ad1be56a7aeeef51141ba2f92eea0f723eb846764ac29d88d225b974b2dd56ff3e4699c45'),
('RAVI RAJ', 'CDS14M007', 'M', '', 'RAVI RAJ', 1, 0, 0, NULL, 0, NULL, '', NULL, '6e539e45d739dc1859e74ae3b1d805b3f07a308c55c0ebeb569b70b5156c586ed0df044a205ca97f6f460b3b9467babb0062eaad2d489a32c5fdc7939f49acf4'),
('PEDAPATNAPU SAI ROHAN', 'MDM14B024', 'M', '', 'PEDAPATNAPU SAI ROHAN', 1, 0, 0, NULL, 0, NULL, '', NULL, '6e6a807b7d3068d7d41f178b1499b364a1d762a2d6707ef71339d713aa1b853263c0410be7ff897aed7093a28cfc0360c6047b32498e24c5fbd83b2c514603fd'),
('RANJEET KUMAR', 'EDS14M011', 'M', '', 'RANJEET KUMAR', 1, 0, 0, NULL, 0, NULL, '', NULL, '6e8d58a1ce5b7e5dfa78026390006225e48894231fd70fd34e031825ca4e8399a9ce2506232449a4f66a641e4a644eea82f06f3c85190bad5879db4d23e90788'),
('ASHISH', 'COE11B003', 'M', '', 'ASHISH', 1, 0, 0, NULL, 0, NULL, '', NULL, '6fb4f7733cd2b5013c74455061fa8b218fb24dba7982f2e39126ce0fda40a34d0903cda5cecc76b4549b994eef8859f712eb746ee5d1cd45e1b30112ee75d01b'),
('LEKHRAJ MEENA', 'MDM14B016', 'M', '', 'LEKHRAJ MEENA', 1, 0, 0, NULL, 0, NULL, '', NULL, '7173f36d3eb8c7c565afb5c2b3b0a4b6793fba9c697de5ab858f931954dc733e13d9eda1b9a216d46a3b9740044d7b80229a7e928abf3c0e6c0fae3c3c52f803'),
('CHAKSHU JAIN', 'COE13B005', 'M', '', 'CHAKSHU JAIN', 1, 0, 0, NULL, 0, NULL, '', NULL, '71a3c470c9bdd4100ac426c0de8340555201183980d36d858356b41a0b325f677d2425bf02d07f698b1b9b18bb688dc44ef53bb965739af5dd15a155a2431cc4'),
('VAKA BABU', 'EDS13M016', 'M', '', 'VAKA BABU', 1, 0, 0, NULL, 0, NULL, '', NULL, '72486418b086619525e85f2268d0cb4ecdc21d198376cf0df56c4008ca295ed38f3cdb19ff88eab9093c9dcbc39e9345507c1f571ea98f3317cbe249a8d5c0b2'),
('NANDYALA SAI PRASAD', 'MFD14I019', 'M', '', 'NANDYALA SAI PRASAD', 1, 0, 0, NULL, 0, NULL, '', NULL, '73af5dc1ed374255fe8cb6ea1d4c8e500882d2ea0480b0a6a482aa707231027b9c83e84e0b382024b2346178d3c0866911efa7a9de84a7f57294d75e2715a3fc'),
('AMRUTALURI VINEEL CHANDRA', 'MDM11B002', 'M', '', 'AMRUTALURI VINEEL CHANDRA', 1, 0, 0, NULL, 0, NULL, '', NULL, '7470b9a5561190d4591d8801c782ddef186cbfde3641328322a448dbba26565ccea4a3430ddbacba87a6fef0f696a46ba709657ed51be72e34d7393e6183cfb6'),
('HENDRY NEWMAN. J', 'CDS14M003', 'M', '', 'HENDRY NEWMAN. J', 1, 0, 0, NULL, 0, NULL, '', NULL, '74f0aa1bacd45440eeb599f336ba051a991d6d44a1c3e8b79a958d1ec13c61b69a05902ea7b1f036334c97d9e3d5957e39ce5e553ce3335bb34b2aca7e8f8a28'),
('ABHILASH JOSEPH ABRAHAM', 'MDM12B001', 'M', '', 'ABHILASH JOSEPH ABRAHAM', 1, 0, 0, NULL, 0, NULL, '', NULL, '7504e246ca51ae56bcce3e05af095f5646989a36894097865f9de9f54267f6970b6205989bfa5f110d7799fb85c03263ab9d8c9d45de9702fa3b66ac5338c5b6'),
('GUDDETI VENKAT SHIVA', 'COE12B006', 'M', '', 'GUDDETI VENKAT SHIVA', 1, 0, 0, NULL, 0, NULL, '', NULL, '7584300837eb947f858fca5bff0ecf25f150436c3adaa3442d1f7aa958b3c892009da0d8a217f76c538e0babe3680012c5bb2531467e766e64ed18026447bfdc'),
('MITTALA SURENDRA REDDY', 'ESD14I020', 'M', '', 'MITTALA SURENDRA REDDY', 1, 0, 0, NULL, 0, NULL, '', NULL, '75f1c2404a2e188101c73938e389bead10e4edcfba353aefce4a8d1dd6aba1e20258167dfeea5c83617fcc864d8645814b46e2cfbe30b1244ec5499abf09eb4e'),
('DANDIBOYENA GANGA SAI GIRISH', 'EDM14B012', 'M', '', 'DANDIBOYENA GANGA SAI GIRISH', 1, 0, 0, NULL, 0, NULL, '', NULL, '75f23b391912cb2a13428acd1a990cda499d12142266a57304356934c349b1a648a1d7a9ffe1d5c798d1594c205ba54afd130c99f1bc7e6f6763b27004a6fabf'),
('KUNAL VAIDYA', 'EDM14B026', 'M', '', 'KUNAL VAIDYA', 1, 0, 0, NULL, 0, NULL, '', NULL, '7613cd3b8e79fb4b7e0bd0d48991b9892c9c0a3578ca31084f9e6c659a0db195ac178901afed7c51cbad8270666319684d2a5ddd20d2b17aded0b2b87531054a'),
('MULLAPUDI JOSHI', 'MDM11B018', 'M', '', 'MULLAPUDI JOSHI', 1, 0, 0, NULL, 0, NULL, '', NULL, '766186af5fdab0d0d37db6a5b4c3517d24589ccfd53aa6a9ee034b387d14224b867c68445c166faeca2d12cbbd05064cf11fa52fe46c0ffb3ec2716cd69d50ee'),
('ANUJ AGRAWAL', 'MDM12B004', 'M', '', 'ANUJ AGRAWAL', 1, 0, 0, NULL, 0, NULL, '', NULL, '768d982ec0e2412b9a237a98d2b36d1f6dafe4f0f6df45d0d79c3b40fbf65fd70aa36dbd2b674d29f93c8d3a4873b9b73bd1bdc74449374342c85feced8885ca'),
('REHANA SIDDIQUI', 'CDS14M008', 'F', '', 'REHANA SIDDIQUI', 1, 0, 0, NULL, 0, NULL, '', NULL, '7715399363120e85023ba3dab3ce02b21e924434995b5cfb14fd40755c6d7f992c4fa7429af075ad94c9ee79b6120c27a3237814c2559f97933274c5c953f9fe'),
('BILLA NIKHIL', 'EDM14B007', 'M', '', 'BILLA NIKHIL', 1, 0, 0, NULL, 0, NULL, '', NULL, '778ee537f302916d04aa0ef60b513b6a11db3ff6203b549d6e8fdaf7471812b20adbe01a5d54a9bcc3ed45c920b86ac4fa999003ade72c33485801d3f4979fb0'),
('GUTTI NIKHILESH', 'MDM11B010', 'M', '', 'GUTTI NIKHILESH', 1, 0, 0, NULL, 0, NULL, '', NULL, '77b46cafea9ce4c296771964a7b0b4de085d8240f8e1ea9335f0935e895f12c1f6e46c55597c41653137c3713c4809a4d2b7d3bb9003795a1a27979b3e40b0c2'),
('DURVASULA VENKATA JAGANNADHA KRISHNA VAMSY', 'CED14I007', 'M', '', 'DURVASULA VENKATA JAGANNADHA KRISHNA VAM', 1, 0, 0, NULL, 0, NULL, '', NULL, '790012cb651ca29c588da71ce817c1f8ef93bdf07dcdbfc1f02656e8a717e24ecb63a30da9f053d29bfff6086a3c7271032fd4edeb7abe8b269b41fba61bca3d'),
('M V SAI TEJA', 'COE13B016', 'M', '', 'M V SAI TEJA', 1, 0, 0, NULL, 0, NULL, '', NULL, '79157b2f8d1a709a80fe71f606b42ee42076682dd3eb37a79c27a73dff1f283a5c97587716e3b43563af572a7447029d9ec19d0c44004e9a63163781cacec007'),
('AKANKSH KHOCHIKAR', 'COE14B002', 'M', '', 'AKANKSH KHOCHIKAR', 1, 0, 0, NULL, 0, NULL, '', NULL, '7a0665c4ef01e77d617282b82f3ddb9124804edd1b2368a3babb5b2a61874c418a7892adb5d927a0817867aa38bbc755ad58438b7d9a68f5c75f02938a62aec3'),
('D.RAVALI', 'EDM13B006', 'F', '', 'D.RAVALI', 1, 0, 0, NULL, 0, NULL, '', NULL, '7aaf632ba415bf56c1fde0facb011a1a6670ba0e30f9f518e7c25e737d5e695957a232a4e957202212f80fa4c97d0c38049287a4fab798c06d416f8e8578c82f'),
('KOTHA VVL GEETHA SRI', 'EDM14B023', 'F', '', 'KOTHA VVL GEETHA SRI', 1, 0, 0, NULL, 0, NULL, '', NULL, '7af97b2bf4176f1c8facf7b2d3137ed64cb97a3c47a44067b77a07d7268d622b72df294c836d1f97d2c017c30849cff980b508b25cb69c44de0dbc8c8d80e457'),
('SHASHANK NAMDEO', 'CDS13M012', 'M', '', 'SHASHANK NAMDEO', 1, 0, 0, NULL, 0, NULL, '', NULL, '7d18abf6b077e0547f6902b60de5f30f635059a3f3fab353c73c5b526e1eb61365473905d336fba4f8d78b5eb32031112dddeb6baf643f058589d02aec005a30'),
('DEVIKA S MENON', 'MDM14B007', 'F', '', 'DEVIKA S MENON', 1, 0, 0, NULL, 0, NULL, '', NULL, '7d3ee3935b5d60b731ff09b392a5ab50b679d3b62ac0e18ab0ce7392daf7080cea18f5d482ef856db68496e4d81613b3bde423220c05a813de69b038fb9d4f0d'),
('DEEPANSHU  GAUTAM', 'COE12B004', 'M', '', 'DEEPANSHU  GAUTAM', 1, 0, 0, NULL, 0, NULL, '', NULL, '7de8719c9a8c19b41a1787e46b3430f1f5a26af73d684023e6c274ff2951a212640a2a236ef8013bbb54968f9a12de9ed988bdf56f532b561226e7beb21e9874'),
('THATIKONDA CHETANA ROHIT', 'COE13B035', 'M', '', 'THATIKONDA CHETANA ROHIT', 1, 0, 0, NULL, 0, NULL, '', NULL, '7e510213c8a695108e836fa922b47701e204f6c07268f3c64efb8a99831640a70b6116052e6abb3390b94ac37e01ed374a087eeaefd4888a7afe080211f17b5c'),
('GANTLA SAI ASRITHA', 'EDM13B008', 'F', '', 'GANTLA SAI ASRITHA', 1, 0, 0, NULL, 0, NULL, '', NULL, '7ecaa07d83a208eb866d42cef9c5010f3489bc8cf9752661c47b26c61fe2c409b6274a1833c5c75859c73340ca9a1db18b737ba29850ef46796efdffbd1e8bf6'),
('ADITTYA', 'MDM13B001', 'M', '', 'ADITTYA', 1, 0, 0, NULL, 0, NULL, '', NULL, '7eeec8d2b67ccbb2967ca8fbd1829542f7e27fdc2d72d0c09dbb620005f981956ba3d1e95442aa56fc073cc486e829d42515d2357b4a523a1ae06b014980d968'),
('A STEEPHEN', 'MDM14B001', 'M', '', 'A STEEPHEN', 1, 0, 0, NULL, 0, NULL, '', NULL, '7f7c31df40bf15dbb9cbd87fa3a8a88a8a2059276f64ecaaeda33553ef46a55be78b808d18c35fecbd759608aa93eb9e7f01d0fca2e3396f0b5ae8c1fe714161'),
('SHIV SANKAR P', 'ESD14I012', 'M', '', 'SHIV SANKAR P', 1, 0, 0, NULL, 0, NULL, '', NULL, '7fb327f3433a6ddeb47113e5a8a4b0a964433cadc703de5deb42f5b9b0a0d97f80bbda6e87943dcb1860ca5b5ff74d1e463d651b732b498622ca0f7f10b6c862'),
('NANDAMURI SOWMIKA', 'EDM11B014', 'F', '', 'NANDAMURI SOWMIKA', 1, 0, 0, NULL, 0, NULL, '', NULL, '7fd621d828752661195b4423b673e404a5a6293cff0651bcbc841af3571038b5311aeb657c6ef19c78128c13f8d87ef551840abcd9b00c762e391d02a1c433e3'),
('UMMADIVARAPU MANIKANTA', 'EDS14M014', 'M', '', 'UMMADIVARAPU MANIKANTA', 1, 0, 0, NULL, 0, NULL, '', NULL, '801af68e001384785af8a0a5f2bfc51e49238e122031500e7770b1728a4573a3c1359cbbfb786c2a9e5e13606f021e0eb5a96cf27e7c4790b99a5a1570731626'),
('POYAREKAR SAIPRASAD SANJAY ', 'MDS13M011', 'M', '', 'POYAREKAR SAIPRASAD SANJAY ', 1, 0, 0, NULL, 0, NULL, '', NULL, '80786ffcd26a229b12005c5d418adaedc495d34524bf8c7e38cf13b6278e41b914acf5a49f42e2d4100c773aa4dfa9ad8112910f35f4234506478f82be1296a6'),
('NITIN SHRAVAN BASKARAN', 'CED14I025', 'M', '', 'NITIN SHRAVAN BASKARAN', 1, 0, 0, NULL, 0, NULL, '', NULL, '80fcee54f6f6ec9148cda5d5d6589aefb9e76b7eadbdd077b816c096f90f5366ea8b15c485a349d6be935af1f892f13fc3fc25d4a98d2899bb6d0c034d6d027c'),
('SHANTANU BARAI', 'CDS14M009', 'M', '', 'SHANTANU BARAI', 1, 0, 0, NULL, 0, NULL, '', NULL, '81198957b49fe32dac8eca0b7dfc137831c039d0bd65fb40acd77dc4e1fa1ab69192f17666199f301dfc4d12d09af3edf104d1120bf7beaf462a74d627ad3dc7'),
('POGULA SHIVA SHANKAR', 'MDM12B017', 'M', '', 'POGULA SHIVA SHANKAR', 1, 0, 0, NULL, 0, NULL, '', NULL, '812047eba215f51e22ca8738ff19f6a1d83703ec17e2951c16435dfef5bada553bb494ca95b23a0c094d4cbc6f466a222efe58e0fe106e561b1a13c24ffb477c'),
('PUNITH REDDY. V', 'MDS13M012', 'M', '', 'PUNITH REDDY. V', 1, 0, 0, NULL, 0, NULL, '', NULL, '817005b4495f69045b9e92e6c6426f07602db8afd9d00b91372a4e7e158eed7371b66a3a558238662e84b11c07e0f78c250a096385c19e14277e73663e48417a'),
('P L N THANOJ KUMAR', 'EDM11B016', 'M', '', 'P L N THANOJ KUMAR', 1, 0, 0, NULL, 0, NULL, '', NULL, '817a1ac8eafdc773db41686e2ac1000f0588ef76a286e1378d9453efca12843459f23bb191bdf2e259a81feda9d4402ea05c4b40779821880853321564ed0bdf'),
('VILLURI VENKATARAMANA', 'MDM13B038', 'M', '', 'VILLURI VENKATARAMANA', 1, 0, 0, NULL, 0, NULL, '', NULL, '821924404c817a14d67a1d7093e6b77c6bc9255f406db60771b91ae03dc542bbdccf65bc4b810123f0cd2a346010f2fb957267acb5bcd2137b1ae85edfc2d52a'),
('CHUNDURU SHIVA KAUSHIK', 'EDM13B005', 'M', '', 'CHUNDURU SHIVA KAUSHIK', 1, 0, 0, NULL, 0, NULL, '', NULL, '823074f521dc0bbac314604de86883ecc15c884733bc77a55e29478ba2913f4f43f107018032ed2f6152f111b0fd2927325854b316bdf639d9e97617f0535aee'),
('GOLLA AJAYA TEJASWI', 'COE11B011', 'M', '', 'GOLLA AJAYA TEJASWI', 1, 0, 0, NULL, 0, NULL, '', NULL, '8301a0dcc7ea8247a4266e1eaafcc1cbbb6dfa477de604faf602eecf838b7f6d2b7eacf71d3522ba25afe89dd0d00013b6382f02edb10f0e2c11c6c875db54c7'),
('ORUGUNDA RISHITHA', 'MDM14B022', 'F', '', 'ORUGUNDA RISHITHA', 1, 0, 0, NULL, 0, NULL, '', NULL, '831da691d6fb9e12c9a01600512efe3480db89bb218aefe5b7f8380253e59a969bb0691df9a853bdc136d9c3f3234021ba8c10ec905565c966bd9a863dd9e565'),
('POOJA MAHESH', 'EDM13B023', 'F', '', 'POOJA MAHESH', 1, 0, 0, NULL, 0, NULL, '', NULL, '83573c74bb07a93384e7b5e0c2b08f8d2913d9cbcff7a038df87e71e8ac55608d3e836b4c2edf6cad1f52dad5148a550062bb330fc661e5c6e1e98f54db2d1ec'),
('ACHANTA MOUNIKA', 'COE11B001', 'F', '', 'ACHANTA MOUNIKA', 1, 0, 0, NULL, 0, NULL, '', NULL, '835eaa750cb7e6607a6e96b7e8081a386210a76d7572930561081a4aabf4158837c554ee083364aca14a2958d759da76d1de652d2d7da90dd5562120265b3bee'),
('DAGGUMALLI SUDHEERA', 'COE14B007', 'F', '', 'DAGGUMALLI SUDHEERA', 1, 0, 0, NULL, 0, NULL, '', NULL, '83dfb4eb0a2ef28033575cbc0bf16c36d866a09b7005a79eb4ff86b18484c7791beaabd9dd892420bde7344323a4e577395b4015295f7f301ddf26ab659cc39a'),
('MORA RAJ KUMAR', 'EDM11B013', 'M', '', 'MORA RAJ KUMAR', 1, 0, 0, NULL, 0, NULL, '', NULL, '83ec02b960e7e40fa381e530b06fd2f30390510fc3381b9c6aa5af578e4c5d115ae928a465820a5c425bef3a1fd8d18dcb870c3a97f78773af2193d3e5e9ca13'),
('HERWADE SANKET KRISHNA', 'MDM13B009', 'M', '', 'HERWADE SANKET KRISHNA', 1, 0, 0, NULL, 0, NULL, '', NULL, '840f96e27892839cca6a653e7180fe6ef62403bdce081f7a22dd42f5b5a39684e6b059b300ea3a895f40a54ab523109ff1b73b3c28cf4740b10906665ad63157'),
('CHUNDURI VENKATA DHEERAJ KUMAR', 'EDM11B004', 'M', '', 'CHUNDURI VENKATA DHEERAJ KUMAR', 1, 0, 0, NULL, 0, NULL, '', NULL, '84ef79b6fc9a76e1964686f72ef7309d63432fd02174892e451ed1b237eb6fba88e81a2596fe1cc25dcaa24874951d9e3025172d126dfd55c3ac05c476c10d49'),
('KAVIYA R', 'EDM12B015', 'F', '', 'KAVIYA R', 1, 0, 0, NULL, 0, NULL, '', NULL, '84fbf69d7b3ca9dafb58fbf4c141e4996f3cdc8de59069ff4219a65fa5cc78d43f638b4741670d76e020f2eb8ef6942cfd4fd645f0be4f6817dbf8ee8f58aa0c'),
('MOGILI ADARSH', 'MDM13B014', 'M', '', 'MOGILI ADARSH', 1, 0, 0, NULL, 0, NULL, '', NULL, '8576e5e5fd62f69d06e94aa119348a565a9ad042fa57a73ef55f4ff9d3f8da24e58fe3467ea8e0bcfac858f8ee000899da2193b272a69bbe4c6c06dcb97849ab'),
('KONA SIRISHA', 'COE14B017', 'F', '', 'KONA SIRISHA', 1, 0, 0, NULL, 0, NULL, '', NULL, '85f7814034259c00cd2f05528044cb322502a06b3ef84d8e08164ec70de871ddc53a07dda4a6a27996ae36f86e551292ebdf94d13bcb9309d473cb1121980073'),
('SUDDARSI SANDEEP', 'MDM13B029', 'M', '', 'SUDDARSI SANDEEP', 1, 0, 0, NULL, 0, NULL, '', NULL, '86659d0cfde6febb160043cb2146d772d5fae0b80f4b1aefc9cba7eeb44ab3057a44fd4a118519369c813bd05364ac6982a70a082b2085b14c4fdec86aca5425'),
('SHINDE SWAPNIL SADASHIV ', 'CDS13M013', 'M', '', 'SHINDE SWAPNIL SADASHIV ', 1, 0, 0, NULL, 0, NULL, '', NULL, '8688ddc1d84c4efb2253a85872f9a97c26114c2edd1cfcad43c37d0bf4afa346dd6f27794dfd1b4a71ff220ace0e8b9d541269ace3d443e5030b797c9e81771a'),
('S MURALI KRISHNA NAIK', 'EDM13B027', 'M', '', 'S MURALI KRISHNA NAIK', 1, 0, 0, NULL, 0, NULL, '', NULL, '86ada4753fafc51a6a29631603e05259def150341399efcbcea4bd920db54af26066d67a8a3bf746727c330159320284323f9cb67169aa4020a7c481512d5a97'),
('RANJTH RAJ K S', 'CED14I030', 'M', '', 'RANJTH RAJ K S', 1, 0, 0, NULL, 0, NULL, '', NULL, '873187ced5d44baa776893f3ae0ff96d2fc41320896409bf3f2e77895b7ca884b79003f203527f67aec992fb525459b05e029ec4e430484d265590b7159e759f'),
('VANI MRUDULA MAGAPATI', 'EDM13B034', 'F', '', 'VANI MRUDULA MAGAPATI', 1, 0, 0, NULL, 0, NULL, '', NULL, '8744a3dbf9ec258705bd6c5340f5228e7472652a513146730ac2f4694e6a516f827018e100f1a9056aec54616f78b91896417d2065bf8923a1654554f9c65222'),
('DAMMU SAICHARAN REDDY', 'EDM11B005', 'M', '', 'DAMMU SAICHARAN REDDY', 1, 0, 0, NULL, 0, NULL, '', NULL, '8748ce0cc5c9905d0a1e47c992745c5d755898ba56033d6c2230b7c2d6b6fbd4b1a731bacc258e625c99400464a76a19cab94c495258188393fe0318413137fc'),
('KONA HARSHITA', 'COE14B016', 'F', '', 'KONA HARSHITA', 1, 0, 0, NULL, 0, NULL, '', NULL, '879eb8f670691be5b4ce748dfb4122c832529ae1e79bd39e7b50225fb4cd3245ae86cef8a31ddfc15cf3d04b4a6682454de6c836e0ad233d3f36d6dc048eadeb'),
('JUNOOTHULA HARSHITHA REDDY', 'EDM13B011', 'F', '', 'JUNOOTHULA HARSHITHA REDDY', 1, 0, 0, NULL, 0, NULL, '', NULL, '889b753ebee55fb7daa7843d707bb7d020c4c7c625a00322449e8d96e01408ac60931b2a972c04d1b4eb35384ba7616bd66aa4f3b972edf3db7db4bf38bb1b21'),
('SAJJA BALASUBRAMANYAM', 'COE12B026', 'M', '', 'SAJJA BALASUBRAMANYAM', 1, 0, 0, NULL, 0, NULL, '', NULL, '89657bec024e05730167b6fe0bfceee57e8ac01b76b70f0a073eb6997a9b183490b04f581c1b92fe063454ab9c5b00a406ef959f7473f7a7697e4e8d4d1abf75'),
('NIKHIL SHARMA', 'EDM11B015', 'M', '', 'NIKHIL SHARMA', 1, 0, 0, NULL, 0, NULL, '', NULL, '89cd3afa88a0c66434a742de109c65422fce17f9465a175009d852a39a0bba4f0d06ea019756ba7661690b0c2f6f6de4ffb5de291ffbeda882e049341b274701'),
('RICKEY RECON DALBEHERA', 'MDS13M015', 'M', '', 'RICKEY RECON DALBEHERA', 1, 0, 0, NULL, 0, NULL, '', NULL, '8a0d4e3e833c2f1dd8cdf08d72b424423dadd544073f85fbdf74d0bdc2dadc3692510d53abaf52b1bc93ec4fa7d9a8e9fef8f8c9ed7eb8bf86eedf38f74bf2d3'),
('ANISH ABRAHAM PHILIP', 'MPD14I020', 'M', '', 'ANISH ABRAHAM PHILIP', 1, 0, 0, NULL, 0, NULL, '', NULL, '8b2747c8ab4a864b527ee4554ede3bc64b02b36938ddd53c3024939db51d043706bb1ad00c38447b9d908dccd6e4b671ef94c23cb410aceaf623bc04afdb79ab'),
('NUKALAVAMSIKRISHNA', 'MDM11B020', 'M', '', 'NUKALAVAMSIKRISHNA', 1, 0, 0, NULL, 0, NULL, '', NULL, '8b490db4016829b1a10d23d05313adeb2dc67f2c158dfab3fb04d70f355f76dd83e280ad3cccfdc8b55cf947b8086e036a90f34f40e8a0bba07dc4e3151358cb'),
('NADIMPALLI KRUTHI MANOJNA', 'COE13B019', 'F', '', 'NADIMPALLI KRUTHI MANOJNA', 1, 0, 0, NULL, 0, NULL, '', NULL, '8caa75a36c286e900a8411a71ca459cf4a6df0afe5d0d339895bee7d9ee17a9f8ec351585ffd0811389a7b960efaf8fd31ee3852acfc345b1147ed822febb45e'),
('NEKKALA GANESH', 'MDS14M011', 'M', '', 'NEKKALA GANESH', 1, 0, 0, NULL, 0, NULL, '', NULL, '8d1f1f28129698df94e60db76e4db7536445a936770fa87214c0c876e91bd052385831be1581a106b44a89476053a4d1c85d3e65d7a26e4619c1a68a4e467fbb'),
('BANDARU SAI MAHEEDHAR', 'ESD14I001', 'M', '', 'BANDARU SAI MAHEEDHAR', 1, 0, 0, NULL, 0, NULL, '', NULL, '8e38cf9dd9507869601968a9b3e8aa6d304304869a663a5b0714023c5cc861b82ab05a8f33c81c650f559eca78d5238c24d13e829bd040150c7d9bcb246c28ee'),
('TALUPULA BALA NAGA YESWANTH', 'MDM13B031', 'M', '', 'TALUPULA BALA NAGA YESWANTH', 1, 0, 0, NULL, 0, NULL, '', NULL, '8f5e65ea2313792719f5dea3f389f8939793ad8c4b4c004f778c6190d8d2d19545219d989a97fb3046028667bed7fac43ef5a08beca2ec91063fdc3adc808433'),
('JASHWANTH NAIDU POGIRI', 'EDM14B018', 'M', '', 'JASHWANTH NAIDU POGIRI', 1, 0, 0, NULL, 0, NULL, '', NULL, '8f79bf149f14a8780d0c4ba99961f4b246def7286e9971f23b8bd7289882d2a5499313fbc862b7de292b11eba6eb080340772a7c8c7815d15c58a078f5bedd51'),
('N PRAMODH', 'MDM13B016', 'M', '', 'N PRAMODH', 1, 0, 0, NULL, 0, NULL, '', NULL, '8fb7a9cc6f5a747bd593d59b773fd6ebb28af66a56f979855ec457717da10b67472f5adbd203fec2906dc088b6baf662951b32afab86acc39a7661b53b8b6c3e'),
('SYED RUKHSANA', 'EDM13B038', 'F', '', 'SYED RUKHSANA', 1, 0, 0, NULL, 0, NULL, '', NULL, '90b1213cf23e96d122826a8bad95561312872418bfb67f56b7498d69a1f299e30c86a57de811e3a7db28d4b32caf03852d74a3677c702c8ffc50ad29db2337ab'),
('DEEPAK PANDA', 'MDS14M004', 'M', '', 'DEEPAK PANDA', 1, 0, 0, NULL, 0, NULL, '', NULL, '90e80a12cee567732e0b8cd0585efebb444c760b1f9338c0294a26873e0143bd53ecdea1cefa2b12e9e1d562afec1c38c15ba49f36a134aa9917a99c2497e03b'),
('TEJASWINI.CHATTY', 'MDM14B034', 'F', '', 'TEJASWINI.CHATTY', 1, 0, 0, NULL, 0, NULL, '', NULL, '9164c7cd5e2777e1bbb35bdc5a87e72b5966489e15fa6b8379a7b98896b2be16334c94242134736411793043f00456477e38778439d34a8bc4e9023c6fa43941'),
('KUDUPUDI RAJESH', 'EDM13B014', 'M', '', 'KUDUPUDI RAJESH', 1, 0, 0, NULL, 0, NULL, '', NULL, '91a80050ac0ff5aa2864f636a99b9f2be8e83c3d37f874ff5874529b17c2feb4d35d49ce6c3cb3f39c3e601cee43aa48b5d961b2c4ecce7ec3771dd08f1ad6e7'),
('B ARJUNA KRISHNA', 'COE14B003', 'M', '', 'B ARJUNA KRISHNA', 1, 0, 0, NULL, 0, NULL, '', NULL, '91dc2202f90df1b70d0223dfd17cae03ce63754da0f2a06657e2f45af80158cae78da844028ee8371f96fbeff3c525b2a61bed12b4dcc5ae688bf9eee56cb761'),
('KUCHIPUDI ANVESH', 'CED14I020', 'M', '', 'KUCHIPUDI ANVESH', 1, 0, 0, NULL, 0, NULL, '', NULL, '927f7b50b72e81cd96f42ddc3cfc03baece010788c5143a57e3e4358e29a617b75bba2774025d4de7ff548da5d84796899d6e1021ddd30ed56a4d391b3f530f2'),
('ROHIT RAJ', 'MDM13B021', 'M', '', 'ROHIT RAJ', 1, 0, 0, NULL, 0, NULL, '', NULL, '92a3950d0bb1c42556dd4dae68a20e70c7557e2333c30acc742afa066c1cc8d6a625ccd4db877338697e504f2bf6c5eb88135ca5d219b389459bf3fdde6ee5a0'),
('CHARLES BRONSON. A', 'MDS14M003', 'M', '', 'CHARLES BRONSON. A', 1, 0, 0, NULL, 0, NULL, '', NULL, '931f771c721ae489dc93672715449113fa51ad91fcabb29c0457414b339f0393010f510c0b155dd026cd5c6eae2abf6950214695a569d8a9def6eec144bad689'),
('JADDU SUDHEER', 'EVD14I020', 'M', '', 'JADDU SUDHEER', 1, 0, 0, NULL, 0, NULL, '', NULL, '936e461df3d298ce4c7f27d7f8c8a497514e12b43a09eedb5e52daf1e2f7bab21833fc273bc5adb42ef6e7df84a500c48e9f50ec3c619826c5a34c8526fb61b2'),
('SHREYA K', 'MDM12B024', 'F', '', 'SHREYA K', 1, 0, 0, NULL, 0, NULL, '', NULL, '936ecd5c4bff22c0c2517602e9b867e6a749228b90591d27a17f3c8b5cec3ec29c04bb525a79bc3adfe8b3a2b9ffdafff91f7a6f4b33b14b1839575e42a12b57'),
('ANUSHA BOJJA', 'EDM14B002', 'F', '', 'ANUSHA BOJJA', 1, 0, 0, NULL, 0, NULL, '', NULL, '93855311bfe5af4ea98d8d40eece2078221b95ea957c1b5db905840d90e33bb78d0fdd618883742ad368453339dafb016a9db67e1f0d3df53ecca7ab7022f8d0'),
('JEVASANKARI K S', 'ESD14I014', 'F', '', 'JEVASANKARI K S', 1, 0, 0, NULL, 0, NULL, '', NULL, '93d6f4e7e7574d8941459d4dc824b55745cebca68f5862adfcd524e01812b5ee9df63f296337664de640f285663ece642c2449d9000f2f9b502102adab81a5f2'),
('V NEEHARIKA', 'COE14B037', 'F', '', 'V NEEHARIKA', 1, 0, 0, NULL, 0, NULL, '', NULL, '940accd5eb2190ea8a131518da8899e13f63458d9f870d798494c253f64b2a9c9fea276f230e07bcbfba74a5bd776db0d6347322eb533f28606f3b42e3369dff'),
('DINESH. G', 'EDM14D003', 'M', '', 'DINESH. G', 1, 0, 0, NULL, 0, NULL, '', NULL, '950a15d8336298f9299bc299322629e7514050f1a8f3d1c36ed26a59d7c486fdbd623c585cc19140c331ada7bb0440a3062931c50659fa91eea4fb6a9e0a3ee1'),
('KAPIL GUPTA', 'COE12B010', 'M', '', 'KAPIL GUPTA', 1, 0, 0, NULL, 0, NULL, '', NULL, '9528039cb0e72686ca6f3488edd1e394c6d6c04e41803c2cf99fbc3c19f66e9b168fa0bcf17b5c09e84262e5da14451c64f3a1e0078b1470396624b2034816a2'),
('POLUPARTHI PAVAN SESHU KUMAR', 'COE14B031', 'M', '', 'POLUPARTHI PAVAN SESHU KUMAR', 1, 0, 0, NULL, 0, NULL, '', NULL, '9551c1a563e2ba05cd14786649093fd62ef264cdc210b422010f7875ce6ee7de5e82e3d20bdcab250102939aa0f2fffedf33918ae795ccb00debff8cd57e31ff'),
('S.KAUSHIK', 'CED14I032', 'M', '', 'S.KAUSHIK', 1, 0, 0, NULL, 0, NULL, '', NULL, '95a72c8e66128d36fe63ccfabe05fb1cb93b987e6d9c07f96c6772c1d64be9f93b1d47a0276db42abc31b7ffe089eac82697c4f6fb865869760cec4ca956017e'),
('RAVI CHANDRA GOLI', 'MDM12B018', 'M', '', 'RAVI CHANDRA GOLI', 1, 0, 0, NULL, 0, NULL, '', NULL, '95c2892bb4506db868b6734c900f1aa4938a4e12c7f2c407e8f26b207564a51e1b1be766fd04cdee4d63a71d080cba5060fb25ab5baddc9f233babf7d79b8cf2'),
('AVULA SANDEEP', 'COE11B004', 'M', '', 'AVULA SANDEEP', 1, 0, 0, NULL, 0, NULL, '', NULL, '95c51f650253dd06cffdc626fde9c17f0d8e77c7e0934621103ed453ce09e673f22d88783d38cd7fb87d0f17f4bbf34b9dda51c4e4e6f663c9474a3878aa9597'),
('DHAYALAN B', 'COE13B006', 'M', '', 'DHAYALAN B', 1, 0, 0, NULL, 0, NULL, '', NULL, '9717f9e852311865f5acdffc25f5634c08d553ce88f850e7ceece12ba3e00b217bfa224a3b702dbd4957ffc48bc58b97c329e5048e527805704011a9a22dbcb3'),
('SAI LIKITHA LAGUDU', 'COE14B033', 'F', '', 'SAI LIKITHA LAGUDU', 1, 0, 0, NULL, 0, NULL, '', NULL, '979bc38d6dd59a867b67b519cb6d4e739ee0f52a13b132ef337c55e072d333f8c630e7537d1c0583fb6c3ebc4d5960584f35d9584b799a1d2746ed8a4053bc28'),
('PRAHALAD YADAV', 'MFD14I007', 'M', '', 'PRAHALAD YADAV', 1, 0, 0, NULL, 0, NULL, '', NULL, '97dcc802c19e1f19a2c3ce933f1cae02c4310e3c2a9fea0e7725e914eddded429809104ca1ff0225262908d7af8560cac5492582a6189515a6553d9a65075c42'),
('M S ADARSH', 'EDM13B015', 'M', '', 'M S ADARSH', 1, 0, 0, NULL, 0, NULL, '', NULL, '97e2ddeba572f59dddff0cb4dd497c2b35d68600e308d5edbcf2e5897e809a0af71d2db0d85bef7321ee81865f87aeb4507bc09bb665d591ae971ba83a14ad60'),
('V.JANESHWARAN', 'MDM13B036', 'M', '', 'V.JANESHWARAN', 1, 0, 0, NULL, 0, NULL, '', NULL, '97ebe8ca718776f9d1e4b473cdd2a564557a30c385401d2c2be0304b492f4e7dbcd12ce032817d10021b7a50e91e127f740c12f1525c20d953999e8c35e2fe73'),
('KATHA KRISHNA MOHAN REDDY', 'COE11B014', 'M', '', 'KATHA KRISHNA MOHAN REDDY', 1, 0, 0, NULL, 0, NULL, '', NULL, '98420cb938844a93577e4b73e44ced13e79d37526539f411a54aa9edf3d9d255c0365c0d2ab81c4d80af65acc17a074d63202dab281c43f155ed7b85891a2069'),
('RAJAT SINGH', 'CED14I029', 'M', '', 'RAJAT SINGH', 1, 0, 0, NULL, 0, NULL, '', NULL, '9943f0baeeaf21435b943a6bd8d9cd5e414eed3c54dee4edb92a7ac16269dbc1ad70b8ad9ca07c7cd61d1408b5fc06a72f6a1ec5f3976d7904ad4af44a070050'),
('SARATHI KANNAN. R. S', 'EDS13M014', 'M', '', 'SARATHI KANNAN. R. S', 1, 0, 0, NULL, 0, NULL, '', NULL, '999df8dfabf1bbc3daef2be6781cfe9825b3d69e49e26bf3dcdb1be765a61795fae07a3cbd508421aab061e79683cf73b5ac919a0cb971566e61fa2f72438ede'),
('GANTA HARIKA', 'COE13B009', 'F', '', 'GANTA HARIKA', 1, 0, 0, NULL, 0, NULL, '', NULL, '99b4b051eb0e096f3a2cbc24f1f0d0a1f743b4390cc33344755015e268a92972410ddc674aee4593579e9fd3b4503f3f5a54929fa7c8566293743593e9ceaf64'),
('NALLAGATLA PRAVEENA', 'COE13B020', 'F', '', 'NALLAGATLA PRAVEENA', 1, 0, 0, NULL, 0, NULL, '', NULL, '9a0f06b16649733772787c5b8788bf0e38147796f793a2db13c02ae858c3f15b96edf6ba4af9484b39a08d1aa6b6234d2e40a0584800a9d1b5939745c025b0c8'),
('KOMARAGIRI GOWTHAMI', 'COE12B011', 'F', '', 'KOMARAGIRI GOWTHAMI', 1, 0, 0, NULL, 0, NULL, '', NULL, '9a5aef3a192ca6f694c05b337253b6481b35b760fed9f7a3eb123b5f7b99a4490abd7ece78c8a95b3aa5812f1dd122488a269b224733585b3970208305cc8f17'),
('TOKALA AVINASH RAJ', 'COE12B029', 'M', '', 'TOKALA AVINASH RAJ', 1, 0, 0, NULL, 0, NULL, '', NULL, '9ad75effde00d6fbe28f9f427a3c1e14c50e418253c6402eb85df25ff2abeb3e17531c9eb5cf2d77f094a1f249d97bf838b232270e39c57856085c7356b09549'),
('SHANTANU KARNWAL', 'COE13B029', 'M', '', 'SHANTANU KARNWAL', 1, 0, 0, NULL, 0, NULL, '', NULL, '9b047bad0ff4061b1bb74f95c1b7ccdc814e0dce08fc435b933fba81bc94c634d6e2a2eedd3722361e8ee376b995a6f0d8137f0596c5ed06f5d98fd30ed6dbc8'),
('PAWAR SUNIL KUMAR', 'ESD14I009', 'M', '', 'PAWAR SUNIL KUMAR', 1, 0, 0, NULL, 0, NULL, '', NULL, '9c6a1bab652e4bbacc7da0a9b4e8fab90da46364d4cf5d9f4b832aa894b12bd816f2d8d7f950afe831c09cb3cc539ed6fbb11be4700a952ccc8430a0daabd1e6'),
('K. MIDHUN KUMAR', 'EDM14B020', 'M', '', 'K. MIDHUN KUMAR', 1, 0, 0, NULL, 0, NULL, '', NULL, '9cb0410096c7fa04d84d264ceb7e9d6e92eadf8b6ed968d2c4a4ae0da4ddc5d18ed9cde77ebb4244147558d47ab494e10798c41b3d87c5c031bdb51c0eebfe09'),
('VINAYAGA MURUGA PANDY. N', 'MDM13D003', 'M', '', 'VINAYAGA MURUGA PANDY. N', 1, 0, 0, NULL, 0, NULL, '', NULL, '9cfebd1c09fc644ccb98812296115409b2ebec3667572db568c6ca96b36f4110adc5a1d093d1939a51dae0ab1ff92fc85bbf6582c1ae891b5c8ef8de44d7bb33'),
('KUNDAN KUMAR', 'MDM12B013', 'M', '', 'KUNDAN KUMAR', 1, 0, 0, NULL, 0, NULL, '', NULL, '9d513c29f8161bec9f553c17b503dc957c1341ebf072186a8da87b6bb72dfd0c530d1e9e2a7a2384453ef37c2c5f03848fa7572d9f418b691672d33c2d6b66db'),
('SADHIQUE K KUNHAHAMED', 'MDM12B021', 'M', '', 'SADHIQUE K KUNHAHAMED', 1, 0, 0, NULL, 0, NULL, '', NULL, '9db3e00767d9064982193035b03f337d661580b0a44fc08d3a0669b8940da63ec33d1b16fe2fa1535cab39bb6ca16b54fb9526899e57c96413422eeffb59e188'),
('VEGESHNA TARUN  NARENDRA VARMA  ', 'EDS14M015', 'M', '', 'VEGESHNA TARUN  NARENDRA VARMA  ', 1, 0, 0, NULL, 0, NULL, '', NULL, '9dfecfd27001219f4ec117f5a31549f67cd942c64c0519ce0d0c2cbe7851fd528f86178afa6f3103414920d0fe66eb7ca090119cc617e3c48feb1a91812e732c'),
('PARTHA SARADHI REDDY PERLA', 'MDM13B018', 'M', '', 'PARTHA SARADHI REDDY PERLA', 1, 0, 0, NULL, 0, NULL, '', NULL, '9e0dac687ff9fb35b70135b9b8620b774f1c9a9f0abd36227fbc6b83a59d27fe4578df3f636d2e70bf33fabd1bf4ff155a1b70160518868c82a8022147fdc2b6'),
('DARA SASI KUMAR', 'MFD14I002', 'M', '', 'DARA SASI KUMAR', 1, 0, 0, NULL, 0, NULL, '', NULL, '9e2e99d609f217034d4aa05aba5bb46f6f8d55e67c9907f8518f974d5591e1c654fd7806a2280a7c54895856469bbab920e8bf5c5fc3cf9124aee34cb04a8cb2'),
('SHANMUGAKUMAR. M', 'COE13D004', 'M', '', 'SHANMUGAKUMAR. M', 1, 0, 0, NULL, 0, NULL, '', NULL, '9ece7e4b9bfa2626b9d1786617be425de88eb9722a76926b044b0734d552deaab7330c1a143986fec62c573fd708c637fce36acea92e48b785dddb60d944e50c'),
('SUBHRAJIT BARICK', 'CDS14M013', 'M', '', 'SUBHRAJIT BARICK', 1, 0, 0, NULL, 0, NULL, '', NULL, '9f2661edf517c7ae5cceff98868bc10ccd8e0b2d712ce89d866d0a3c48d3bc75508b972a2aedba29b6952016c24bd9a21012b427ecce2e3505fd59e71a8f0c9c'),
('LOKESH KUMAR V', 'COE13B015', 'M', '', 'LOKESH KUMAR V', 1, 0, 0, NULL, 0, NULL, '', NULL, '9fce39959fe50b16269db6c30329b6c4c41491026bd40c9896afee9a9e9ab401b19d8368a07fc6a80c2812a81033341d733dfad0c6d90c73a638374681380467'),
('PIDUGU SAI KISHORE', 'COE12B021', 'M', '', 'PIDUGU SAI KISHORE', 1, 0, 0, NULL, 0, NULL, '', NULL, 'a16dd9acc5196d7f3ce052c2aeca2d7595da999c246f7db88cf80718ab2ce6f2752120083fbb03d98416da9fb610f7c3478b992d3e73152d730951b3b706db1f'),
('PULUGU VAMSI', 'ESD14I015', 'M', '', 'PULUGU VAMSI', 1, 0, 0, NULL, 0, NULL, '', NULL, 'a1aac64b33525263aec49725b262aac37ad7b4d5d0fed693a7a9e6d354d2a806858fb025e694fa7163876f5207adb71107bbe93e5e7c30a3ff4e2cee6ce5b8bc'),
('A. ANANTH', 'EDM14D001', 'M', '', 'A. ANANTH', 1, 0, 0, NULL, 0, NULL, '', NULL, 'a23bdeb3359ba85e416fc4fd60c4b2d685c9eec90fd501b2ec4edd783ec4200b5d1bcba53e3c58d3672e2e171ce1b5a4637d95eb88779c8c38a023911d367f81'),
('PILLALAMARRIKRISHNA CHANDRA', 'EDM13B022', 'M', '', 'PILLALAMARRIKRISHNA CHANDRA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'a280c44b8a862bd183a09afd3a9ccc5dd20bdea5fada2f19941d10f1401b7d29dc7b94fee3fc151a3124896b2232f9ebe8129ff49d17092a8e2fb9922ba0280f'),
('BODDETI V J SOWJANYA', 'COE12B002', 'F', '', 'BODDETI V J SOWJANYA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'a2a3fae8bc0905ca5451882ce151902a0c76a84cbd1a7d14b324e730be1575691b11a4f22ecd3b955691d34817ec2293b39f7991484af261cefa089e4778ea8e'),
('SRI SAI KUMAR R', 'COE11B024', 'M', '', 'SRI SAI KUMAR R', 1, 0, 0, NULL, 0, NULL, '', NULL, 'a2a75e29fc3f8a963563903dc3fdbaf2ceb7ac63e5a4f5a9d7f2649d869fef232a8b026a5ea923b6d94f57bd91ea09fe908c085f7bde770cb1abac21479cdb90'),
('XAVIER AROCKIARAJ S', 'EDM14D004', 'M', '', 'XAVIER AROCKIARAJ S', 1, 0, 0, NULL, 0, NULL, '', NULL, 'a2f7785ec3250fac5555fdf34ec47fd49c2a89284bcd0e0271871bd3fd3bffe6c307ea24e10bbd67f47976e81a1a8bfd316420fa7db2d5d521789277221490df'),
('SAMALA AKHILA', 'EDM13B029', 'F', '', 'SAMALA AKHILA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'a49d810c28f6234fd77ba2f444b39130859464269989d28ec0f7210605b2d774a56fc8b28bf0dca9133eb7640448232c61347e737da9d2659687e278e90ddf59'),
('MOOLAM HIMA SWETHA', 'COE13B018', 'F', '', 'MOOLAM HIMA SWETHA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'a4b0567cf16498ff7c401c3422afd81bc353eac90acf7b09ebe4ec2158f9120da9f038e7562bfdab32aff0b4ee5d7b276e15dc362ca3ad5901427c29fa2054df'),
('HARSHA.A', 'CED14I013', 'M', '', 'HARSHA.A', 1, 0, 0, NULL, 0, NULL, '', NULL, 'a4e9c0a0901eea9e663a940dffd644cdf71a390f63cda74135fb9732bfdb416ab365f68fef8518e7015dce54f73adcf0f9fc65c972029fbdc7217a0a43d7587e'),
('ALLU ASHA KUMARI', 'EDM12B003', 'F', '', 'ALLU ASHA KUMARI', 1, 0, 0, NULL, 0, NULL, '', NULL, 'a581611940a0930df6e4e7610011627a7234d2955a27e9ae5797624ac5893445a345d49a0ac8561aa8ad08c98821b4ba93cb6fc2fda574acf746defeabf203a1'),
('DAMACHERLA SAI NIKHIL', 'EDM14B011', 'M', '', 'DAMACHERLA SAI NIKHIL', 1, 0, 0, NULL, 0, NULL, '', NULL, 'a5cd7a198b4b7b8b961f527600719499753a609795bcb6f9df40a868f0a23961167628d291a90561249ffdf20d294bea8e116611277e63cf3072c6a0f4115a87'),
('NITISH KUMAR', 'CED14I026', 'M', '', 'NITISH KUMAR', 1, 0, 0, NULL, 0, NULL, '', NULL, 'a617681664d6f9fc3f1d08333df41059a614e2cdbf47b5d765067b6cc5bec28a13561ab273e36e093a76a3ec9a7569a5b79ab8c5aa58580c65a169a8c1dd9e4f'),
('MANDALAPU JASWANTHI', 'EDM14B027', 'F', '', 'MANDALAPU JASWANTHI', 1, 0, 0, NULL, 0, NULL, '', NULL, 'a739b29adb047c2f4b0fe660abbb7db1abddcdda150b3e2f1165c07b88b32a6d30eb05a2e8602fc1b476cdf864c64b5801246399036466d43e7269a5d686c1bd'),
('SUHANI CHANDRA G', 'EDM14B037', 'F', '', 'SUHANI CHANDRA G', 1, 0, 0, NULL, 0, NULL, '', NULL, 'a76745b933bd3d87abc03d2f3e4d77aa6b01c0ea71152b15785fb21d56050b569c6c56f5a69d89955dd8e10b3d7c39c05f4a39ed5e0be16925c213d08e1c5cdd'),
('EVA ROSEMARY RONALD', 'EVD14I005', 'F', '', 'EVA ROSEMARY RONALD', 1, 0, 0, NULL, 0, NULL, '', NULL, 'a785101006a474d0f36615444ff6ca52b5ec45374c1539e17052fef9800d6b08d5267df530d3dfadfed7d801ba56e39bc76fab42fe6ad12792fb8a751b4fe132'),
('VIKAS TIWARI', 'MDM12B025', 'M', '', 'VIKAS TIWARI', 1, 0, 0, NULL, 0, NULL, '', NULL, 'a7a303a4129bb86d1df48c508f918405c8cb35afcb6d38609e721c8456216d842015278766713965092849fc5d6402aa1256676e2ef127a57bf32c6960371a8b'),
('NAKKANABOINA RAMYA', 'EDM14B029', 'F', '', 'NAKKANABOINA RAMYA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'a7d9ac82609c0706977987db8240e0aaf09b972a76fa008b080e9958ec5973fe9fe6f0e204cffee7ee6726cab4a253e51d0016f484f8124e693001b505917ab2'),
('B ASHOK BABU', 'EDM11B002', 'M', '', 'B ASHOK BABU', 1, 0, 0, NULL, 0, NULL, '', NULL, 'a7ebdca22fbbafd0b6e09fd3cca635733d9ebcb8a5c2bef2c5efe4dea20c244ea5f02e86aa9e91371105f0d9f743d24714f45e0c6d59811a9fbe31b6527dfb8e'),
('SUDHEER SURENDRAN', 'COE13B032', 'M', '', 'SUDHEER SURENDRAN', 1, 0, 0, NULL, 0, NULL, '', NULL, 'a84518c6ddd01550da38fb65ba317582147db65559283ff851d47ba3660d5c01281cfd622aecc1eb4b1c856e86ad0791dbfe240e29c689588d76029393a53652'),
('MARISETTI NEEHARIKA', 'CED14I023', 'F', '', 'MARISETTI NEEHARIKA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'a8471292828fadad7ef06c9ad598fd9a3b5c133f6dd988c4fbe95e7a9faf1624f429afbb82bba32917415a1e3aa9bb61cd19489a16a5a90845795d0029d073f6'),
('KANTIPUDI SIRI', 'CED14I016', 'F', '', 'KANTIPUDI SIRI', 1, 0, 0, NULL, 0, NULL, '', NULL, 'a871a90095b2d6013c42e79a50242d573849ee7d3cea700cb54542cb96bd8595c9cff357a9566bbe2c5b338c78f63baaa7950917320a5a0ad8bbdc93b9fa0e06'),
('KANDHADI VENKAT VARA PRASAD REDDY', 'EDM14B021', 'M', '', 'KANDHADI VENKAT VARA PRASAD REDDY', 1, 0, 0, NULL, 0, NULL, '', NULL, 'aa57a0545e22871f851ef17e981bb112a6a67f0f40751258fb5fbe07633d5eb182a9a554417d20817319a6fbb87f3b045e949151e90900e3de44ead5f90e1777'),
('M ASHWINI', 'EDM11B012', 'F', '', 'M ASHWINI', 1, 0, 0, NULL, 0, NULL, '', NULL, 'aa6ae1b62f210a70f7a92b0c76c8b9bb7b6fdc80889e15c54a101a61494bd6f30c64e07cf16dc9f74dd5b6af91a2b3ef2b4376a42d6859eb85dfb8410548fd3a'),
('PONNEKANTI PRANEETH', 'COE12B022', 'M', '', 'PONNEKANTI PRANEETH', 1, 0, 0, NULL, 0, NULL, '', NULL, 'aa738f179a8fa675378c36166e799c51452215b20d25edb1cd80bc55073cd92ba52cd23877639600bfe50d7a7b4dc7c370ce98397014d64fd39fd4f90ac5521e'),
('M BALASUNDAR', 'MDM14B017', 'M', '', 'M BALASUNDAR', 1, 0, 0, NULL, 0, NULL, '', NULL, 'aaab38986ed8c19595b675acb7261af6e28ed06b437a3ada48a1ef684b83f54402d6be7e25fb8073363afb866b3c53d1d00639088400c70aa5e481f8969dc438'),
('KANCHARLA ANUHYA SOWBHAGYA REKHA', 'COE14B013', 'F', '', 'KANCHARLA ANUHYA SOWBHAGYA REKHA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'aad6998ed62cc32b77c1169ab92c69434ecff70a4b0dcd8b802ac35acee52d2a445cf3801337a4d5c5185f3f52f155500232c398290fd30be3636e2cd3e12217'),
('MADDINENI CHENCHUNAIDU', 'MPD14I009', 'M', '', 'MADDINENI CHENCHUNAIDU', 1, 0, 0, NULL, 0, NULL, '', NULL, 'ab7dcdf4e3a611367b5bee75a202485689f866686f5f0a76a1ab67767aa6dc97cba5dff2f3b309cc37ca204afbf7b6c1cf28a346011a50cd83e6065efd87d01a'),
('MUDDADA AKHIL GANDHI', 'EDM12B020', 'M', '', 'MUDDADA AKHIL GANDHI', 1, 0, 0, NULL, 0, NULL, '', NULL, 'ac596da20435604432f6ec1b63043bbd911c388d076650212955f9114dd6cd8b66dcf5c38b50217baafb9baffd721be450e5912dde0875fadd4acf7a878217ac'),
('KAMLESH CHOUDHARY', 'COE11B013', 'M', '', 'KAMLESH CHOUDHARY', 1, 0, 0, NULL, 0, NULL, '', NULL, 'adef5551eb7c0b4a3595e2229db3a0875a69be05a23e3600e6c70138b28d610e671c3fa3ce641b104289efd06156dac16155e5b99c7d9a54727fb9ebe17bdd5b'),
('G V BALAKRISHNA', 'MDM13B007', 'M', '', 'G V BALAKRISHNA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'ae11621216ac8eb4c2f4ae605ba8f9ae41884292e444ef4ceb925fb7ed6ba1092dde5a7b3e63c0b592d7328a4644377e317d02246e4dcdd4cff36bf02babfce3'),
('RAJESH LAGURI', 'EDM14B034', 'M', '', 'RAJESH LAGURI', 1, 0, 0, NULL, 0, NULL, '', NULL, 'ae1f0f30aac37e436520ea4c4a9c672e59a0532bac7825352f2cf79d5c6293f81a71904753bd47a5506839b5a929f5293e6ec8bd05531b7531cb5ddd0cdcc9bb'),
('SRINIVASAN. G', 'MDM14D002', 'M', '', 'SRINIVASAN. G', 1, 0, 0, NULL, 0, NULL, '', NULL, 'ae352c7119b746348aa6df2ad4a02bc12d7f7701868f8472dd60b348519f4baf14b91b94003f84d9c0b68c086da046b9591152c641eb940f517beeff63f01d19'),
('YASHESWI BOCHA', 'MDM11B027', 'M', '', 'YASHESWI BOCHA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'ae4ed98f9d37c015a0540c673dda0dbbaa853f3c1be4fdb0943ba166db498814c53bfec1cea3b4f7fd992b13a915d38d697088452b0fe1d784bcbb8db2250ad2'),
('VIGNESH SAIRAJ', 'EDM14B039', 'M', '', 'VIGNESH SAIRAJ', 1, 0, 0, NULL, 0, NULL, '', NULL, 'af69c2b5156ec60f0a44d8ef48350a210f407d9de68ef9b09c5a775320717e28b2939523017d998f2e4a9a450ecdba7daa9af2dbbb9759dabb8638c67f80e4f4'),
('ALAJANGI V V S S L P TEJASRI', 'EDM13B001', 'F', '', 'ALAJANGI V V S S L P TEJASRI', 1, 0, 0, NULL, 0, NULL, '', NULL, 'af9310c8be3a516c9de2c86f4194e4273f1a16e0a5af7306c4a4ed0622613726957cdec83019267bf6187815999eb4530d5cbcd2da61c668c51fbe33e2c9ed69'),
('SACHIN P R', 'ESD14I010', 'M', '', 'SACHIN P R', 1, 0, 0, NULL, 0, NULL, '', NULL, 'afb56a348ae69fe178cb420349265209080e583dfae14873b91a00f75d196ecf7fd3a69be67e4d4ef54349365dc056d9d92cb8a25c406588a7a2ff1787a81b6e'),
('DEETI SUNIL KUMAR', 'COE11B009', 'M', '', 'DEETI SUNIL KUMAR', 1, 0, 0, NULL, 0, NULL, '', NULL, 'b01b0414c3fd42ff18f7fadbbd9db16cec3e289341c213d94dc0d652719924793df9c74bef8e7f0399261b36d122a38e88f8e86bf118186a272d01ecea0bd07f'),
('KANJAR DE', 'COE10D001', 'M', '', 'KANJAR DE', 1, 0, 0, NULL, 0, NULL, '', NULL, 'b139072adc3f32b2c8607c86346394b7b3e891468ff7b3642a9af36542cae0132f6e77ca03514c797595d6a51558e15b2161afd1819696789631a5e1415f5736'),
('GANESH S', 'MDM12B007', 'M', '', 'GANESH S', 1, 0, 0, NULL, 0, NULL, '', NULL, 'b14992afc37c24b393520bd3f0d3a8ff28c47e5e423bde449c4025da41bd46af48a5d09bc85532ef9805ebe8d8b1430ee096076cc6550dcb78a5086a9671f10e'),
('ANKUR AGARWAL. P', 'EDS13M005', 'M', '', 'ANKUR AGARWAL. P', 1, 0, 0, NULL, 0, NULL, '', NULL, 'b286d9f741f5f452793f1a5b5f3e787f5e46334965320af9f1254155d268997367703e9204e9a81e16076f24e970f608280e2dccb7a34a2b39b452a49739e00b'),
('SOUMYAKANTA PRADHAN', 'CDS14M012', 'M', '', 'SOUMYAKANTA PRADHAN', 1, 0, 0, NULL, 0, NULL, '', NULL, 'b28f487f477fb20e0ae67a423f6b7883fde71c864d251a758fb38f467777ce04b0a0f210eae6025862fda65e583b706d229f1fbe8a0e0944ca6f5da75b57df7f'),
('INIYAI T', 'COE12B007', 'F', '', 'INIYAI T', 1, 0, 0, NULL, 0, NULL, '', NULL, 'b2b4f66b81cc2edb68ae11b15d9f5e1e3008e958f3fbe531e78998ccdbdc6728bb31ead5654ff8260d31703fbe29bb78aa0a5acd8b606b20b159d2b0301dd2fd'),
('MANO RAJASIMHAN. N', 'EDS13M009', 'M', '', 'MANO RAJASIMHAN. N', 1, 0, 0, NULL, 0, NULL, '', NULL, 'b39c44a62e8ffa756b8acfd206e6da7820e4a11bfd852be5b1153ae8645cd7ab3200439e70947db1c86dea23252f950c35662090cacc2cb9e6d35127fb413f82'),
('NADA ABDUL MAJEED PULATH', 'COE12B015', 'F', '', 'NADA ABDUL MAJEED PULATH', 1, 0, 0, NULL, 0, NULL, '', NULL, 'b3fd7fbadfee5bd693d377405f0c35f6cad4f06755a24d915a3c55bbb6e6cbf35226470c6728ae8964f634010a885eec9e5e63246b7e5b535495d5b48f313aea'),
('DASARI NAVEEN BABU', 'EDM12B009', 'M', '', 'DASARI NAVEEN BABU', 1, 0, 0, NULL, 0, NULL, '', NULL, 'b46c512654e4b27837540cb22682aafeb6398da8979e3ce8b82a8feea313f162a0f619aa85836ef1fed94e2b1c9bd74decab4b3fe22c7e75b7ef3e4e2255d398'),
('K SWATHI', 'MDM14B012', 'F', '', 'K SWATHI', 1, 0, 0, NULL, 0, NULL, '', NULL, 'b513a642fea2f93b2bef1587bbb48bd6bc6d13bf70d7f11ca34f65899cb03e6b37d8fd17b22c1c1ca8e2b0a62e7cf94e4079161a9d79001319388a42928f2f03'),
('NAVULURI MADHURI KRISHNA', 'EDM13B020', 'F', '', 'NAVULURI MADHURI KRISHNA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'b5329de7663475bde1163541bfd2d930294a191731c93b62c3c9e72ef8ad0c3f717e92d3443147ba94a26caa4a9b92112f05615fe00412158c43867c2e77a4e9'),
('PATNAM AKHIL', 'MDM14B023', 'M', '', 'PATNAM AKHIL', 1, 0, 0, NULL, 0, NULL, '', NULL, 'b55a97ce5dc1aa890a97900ec508166bcaafe1bdfaa12ec2a79a4941fc7a39897f59c8531d34828d71ca762e4e255f8b2fe4bb6d8f2ba447888d86dd25a5bec3'),
('SULTHANA SHAMS', 'ESD14I013', 'F', '', 'SULTHANA SHAMS', 1, 0, 0, NULL, 0, NULL, '', NULL, 'b55e62e5662ce93c5994e3a46352c97906cbbcfdbe7a62cb762eea53c0bc0734b098f27e864ac745cd429a3e054f853524754c818d5a7e47fbefebeb34e50f2c'),
('M AISHWARYA', 'COE14B020', 'F', '', 'M AISHWARYA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'b66a0fa7272ae0f213f14a3b41a4096160321a710319b1960dd4ff10759838959a2c634fc27cd1bbe88bc73027a7474557f702fe1d0bc932a05823bf5d89338b'),
('JACOB VAIDIAN P T', 'EDM12B013', 'M', '', 'JACOB VAIDIAN P T', 1, 0, 0, NULL, 0, NULL, '', NULL, 'b67ecebc35a431b51aa8880734837e43e09e5241dd4c75684e0e67efa6952230cb7a05fcd18b1111489749cbd996191142cc47a23c67b1b9e8d9828f5d6995e2'),
('VINEETH MOHAN K K', 'CDS13M015', 'M', '', 'VINEETH MOHAN K K', 1, 0, 0, NULL, 0, NULL, '', NULL, 'b698fe2e942f29536d89502f31022a82bab3a72837dba84fc922730438208f187378b3f27b4c35397eab1af712ca8e124dacb99aa898c063dbea1bf7a4a76044'),
('SUDHANSHU JAISWAL', 'CED14I037', 'M', '', 'SUDHANSHU JAISWAL', 1, 0, 0, NULL, 0, NULL, '', NULL, 'b70c3a5c9520a188f13374cc62add7c1a5fa49744e1a4b9b29c2871fc6c4f87897358b41454edaf418879fc60ee5ca11842ff2d6d9890034b1266fff256d86cb'),
('RAJINIKANTH NAIK BHUKYA', 'MDM14B026', 'M', '', 'RAJINIKANTH NAIK BHUKYA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'b7ad013fd68a5b426d1ed7cd6540bf85c4e4df314c894151c2309daa4095859cdcb41a4f839409a5deea082d029044e0e30952166e4920028d52df740568552b'),
('SHAKTI KUMAR B', 'ESD14I011', 'M', '', 'SHAKTI KUMAR B', 1, 0, 0, NULL, 0, NULL, '', NULL, 'b91c97711119c5522d47b110a24aa291fc82afc89d918bfd0933b15ee9377ccf4a8e6a3ab139c664cbef96a9a6d27dae9032c94ea8d58114d8e3b9eb71383045'),
('K DIVITHA', 'COE14B011', 'F', '', 'K DIVITHA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'b9cf45c9586393f95d17d382bf5405d18f70eabd89df1b0392f065df39192c57476aab6dcae780c8772786a81da9133debeafb25733f2d690ebac37081d87439');
INSERT INTO `users` (`name`, `userId`, `gender`, `password`, `alias`, `isActive`, `rating`, `lastLogin`, `hasBlocked`, `pollEligibility`, `badges`, `profilePic`, `clubsInvolved`, `userIdHash`) VALUES
('SAMPATH KUMAR R S', 'MDM13B026', 'M', '', 'SAMPATH KUMAR R S', 1, 0, 0, NULL, 0, NULL, '', NULL, 'ba6492db40b04a36d624d5b3cdfe9e22109805d9838765d0d4f3b95ace6059ab4bd4fe2826e882bfe5dd20764f6d58c411c2f0b2e953210734848e36258ff266'),
('NARA ASHOK CHAKRAVARTHY', 'COE14B024', 'M', '', 'NARA ASHOK CHAKRAVARTHY', 1, 0, 0, NULL, 0, NULL, '', NULL, 'baafca5825b6aa9fa7a113f71e5d98fd654e582b443eead5b67841928135b9ae2bdd586f497bbc0de7da4b831966ee207b4605aff5a196799e6a93e80804d09c'),
('NAGMANI KUMAR', 'CDS13M005', 'M', '', 'NAGMANI KUMAR', 1, 0, 0, NULL, 0, NULL, '', NULL, 'bb938fbd9f7cd52b32734c52851112cd2ba5b3eeb80f5e53558e99c3ddd636445a014859d64edf7c1b95dc6dd31253edf8383661707c9b61591557e69edf2621'),
('Murari Edwin Christopher', 'COE14B023', 'M', '', 'Murari Edwin Christopher', 1, 0, 0, NULL, 0, NULL, '', NULL, 'bb9569e8ca7e9df6cc64d274715c7490079158b7ff4c7c53442f6c7687117db4679e2c2833860da6891b5b5712de0e0457db59d079ba0ce183bab67d54c41954'),
('SHIVANSH DUBEY', 'EVD14I015', 'M', '', 'SHIVANSH DUBEY', 1, 0, 0, NULL, 0, NULL, '', NULL, 'bbacb956e85f77b7ff49c46a2c3a1ee588c5eaeb493507863b14ade9ee7ce6cb6db4db2a2c5058661bea5f22f1f6082b3c3c7693ba312cb7874baee1952e9eb4'),
('PUJARI KRISHNA SAGAR', 'EDM11B019', 'M', '', 'PUJARI KRISHNA SAGAR', 1, 0, 0, NULL, 0, NULL, '', NULL, 'bbafdb906395617bc7ab5747fc09db1f8ab5f94d0cb77eaad3dc579b93be71aa6fcec10840d8a7cd9ad3b2bae33839c751c42621f41fc1d4eec0498af9faa4bf'),
('KUMAR NRIPENDRA', 'MDS14M010', 'M', '', 'KUMAR NRIPENDRA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'bc08d156a3ee7fcbd123c6efc4c8d782381b6ece3125996f90b50c77fcdb473734e5821bd8ab44dbfd9484501fa00adb154ba44554ba293a0f01fe15be215caf'),
('SUSHMA PRIYA ANTHADUPULA', 'COE14B034', 'F', '', 'SUSHMA PRIYA ANTHADUPULA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'bcc97daee51c38611164d49764419a0dc7f9ca645dfc5bcb541d78af52839da6d4502db014797a07a8a5cf9fcd12270bfde1489dec51cd3e724f3aa92e96b975'),
('EGUTOORI NAVYA REDDY', 'ESD14I004', 'F', '', 'EGUTOORI NAVYA REDDY', 1, 0, 0, NULL, 0, NULL, '', NULL, 'be51a9e054300d6da8b16f57c33513d1502b363b97530383768e6016e7d8c47d84951e8f5bb901f4e7784bace52c9bdc8415ebbe273fdef7a13fd5f0bcc754f2'),
('RAMDINESH P.C', 'EDS13M011', 'M', '', 'RAMDINESH P.C', 1, 0, 0, NULL, 0, NULL, '', NULL, 'be61c9a3dabc27618d0096683fe23f63448c37179ed27380b462d3fadab16c55e99812eade3b217d70364b9be936efd33c49c09c7a05c29086cc84c02bd7eff4'),
('POOJITHA MOPARTHI', 'MFD14I012', 'F', '', 'POOJITHA MOPARTHI', 1, 0, 0, NULL, 0, NULL, '', NULL, 'be8d9646bc500f739cf59ae593e2adfefab6e6292ad79c48ce3742abbb740be62d213b61c08734759fb5d7a957d4ee9355ea6184066b22b875f0e0059c6d59d2'),
('CHERUKUPALLI PRANAV', 'EDM14B009', 'M', '', 'CHERUKUPALLI PRANAV', 1, 0, 0, NULL, 0, NULL, '', NULL, 'be92cc52beff3566eb5fd3d75a6dc089e54a022029f43cef8ab82cd86b020983b4d3bb0c9d8ba87e84074417bf85e67f3a1ccecf76cbbe403ef45d062588a2dc'),
('KOLANU VENKATA SATYA RAMAKANTH', 'MFD14I020', 'M', '', 'KOLANU VENKATA SATYA RAMAKANTH', 1, 0, 0, NULL, 0, NULL, '', NULL, 'bec369e3258ad85ff9c49d8e8e54f26b5af24c4994e1bb4a981312a02c76c4579f7511a9880cc806d7d10ea08b469293603e23cc5e8c9a9251c15fdf949ecf6c'),
('SHASHWAT SHIVAM', 'COE11B022', 'M', '', 'SHASHWAT SHIVAM', 1, 0, 0, NULL, 0, NULL, '', NULL, 'bef9c91cbd144e8c82370b1a4f79cf0940afe19a825d775faa4592a68be7020aa854188ce9f153585a14b33c9ba43d9b1877d0f9ecd67cd5bf1e99b19a636c4b'),
('GORLA CHINMAIE', 'EDM14B016', 'F', '', 'GORLA CHINMAIE', 1, 0, 0, NULL, 0, NULL, '', NULL, 'befae9f820d217b9b893f0d396991134b6ca2b764034f3ab682ca0aee7b2a9f04cefc19ee4f2ddfe4a5323fd9153f86973d964a1717f9af5f538cb774066c327'),
('MUKUL KUMAR', 'MPD14I006', 'M', '', 'MUKUL KUMAR', 1, 0, 0, NULL, 0, NULL, '', NULL, 'bf2567254d59561f2b359882bec25e6221d2a3824d38d76141adc1486f01884b6f11607778f49ed435faaafcccf9d1313730328aa4bcf0163d9ddde301924362'),
('AVULA HARSHA VARDHAN', 'EDM14B004', 'M', '', 'AVULA HARSHA VARDHAN', 1, 0, 0, NULL, 0, NULL, '', NULL, 'bf592fd48296d45902173c747150060e19d8301b4c550bb1ced52bcb79b524bdb4fbb32e8e8d5df514444fc9ab9bb6d6ca1b88df1b035f4bebb73ab8fe0c792d'),
('RANANAVARE ATUL SUBRAO', 'CDS13M009', 'M', '', 'RANANAVARE ATUL SUBRAO', 1, 0, 0, NULL, 0, NULL, '', NULL, 'bfe70914a6f1dd76d8bf42c772f61fd7dd9629c177b619b2479fcd0e742d18536e8de7a9812046c1b8020f9955530ee83e3adef37e0ff9511109a81951a09eb8'),
('ASHISH KUMAR', 'PHY13D001', 'M', '', 'ASHISH KUMAR', 1, 0, 0, NULL, 0, NULL, '', NULL, 'bffdac6909d27c450b2567549dd67dd6c2bc2b1f6e92a24389af9fafc05d48ede87f152711ed367b0010441bf4a283ad663220e2e23a8eac83623e0d6adb3b6a'),
('KRISHNA KUMARAN R', 'EDM14B024', 'M', '', 'KRISHNA KUMARAN R', 1, 0, 0, NULL, 0, NULL, '', NULL, 'c0215db1ab07bc220709d3a1514069c878cfe67eac49ec966907cdebc4e1bdb88af019fb60b00d5ccdd31146a1099458baed1844f10310462386e569db00a660'),
('GUGLAVATH VIJAY KUMAR', 'CED14I040', 'M', '', 'GUGLAVATH VIJAY KUMAR', 1, 0, 0, NULL, 0, NULL, '', NULL, 'c0523bc77ef79b00e888be1178895a6252dce6c0c9ab5b7d1833ffff69c54f875984a514bd6ef1bd9ac202b917c1fe4d60a10e6e42e97e181457715aa0f1351d'),
('SREEDHAR VISWAS', 'MDM14B033', 'M', '', 'SREEDHAR VISWAS', 1, 0, 0, NULL, 0, NULL, '', NULL, 'c127d3d2e6783acb80fd7de4d0bcb577db74c24d94bff59c97a91d1d7959715999b0308c1c47aabf0d5c086d8d0b60a831e45b0a4aa394c0097db7bcadea1758'),
('SAGGURTHI SUHAS', 'COE13B027', 'M', '', 'SAGGURTHI SUHAS', 1, 0, 0, NULL, 0, NULL, '', NULL, 'c165273b4559725608d93267ce2f17b17bfb8041861e5b337ce95c41d311af78446cb5165e7f3b55580ffe0c53f9057093a43ef72c2450716759f1382ce686ad'),
('K.DHEEPIKA', 'EVD14I009', 'F', '', 'K.DHEEPIKA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'c1d41668f1601e802de130158defc5fcdfbbf91588c985b33b66da1543a173699f55e87675cb332af04a68527078948926b2dae0ec57a30044876f126c471831'),
('S VIJAYA RAGHAVAN', 'MFD14I015', 'M', '', 'S VIJAYA RAGHAVAN', 1, 0, 0, NULL, 0, NULL, '', NULL, 'c239147a3478994de7a9b9f697f2478fce56e8f5c09ffec10868b8622e7ee26f3b519490ff754de523cf4d16b6e09cdf2ddcc5d17065c456f49ba66af7558453'),
('S CHANDRASEKAR', 'MDM13B022', 'M', '', 'S CHANDRASEKAR', 1, 0, 0, NULL, 0, NULL, '', NULL, 'c23feed4e4975704fdd6dc90d5cb0abada6ee0c2c4cbf4a3063982f6b3cf279431f19e5532df9cb8eb21fe1edd87f3d7bfd972b0623cd959a446c9cd6416cd5b'),
('IQRAM HAIDER', 'CDS13M003', 'M', '', 'IQRAM HAIDER', 1, 0, 0, NULL, 0, NULL, '', NULL, 'c2d56e380100844f68e3c083873afb2e774e5fb287b8124105ddd56d7bc74abba81c24f1045bdf1c5df77e5b5516fdfc1419dadcac62258a0f537e4abb37b1ac'),
('B TEJ KIRAN', 'EDM13B003', 'M', '', 'B TEJ KIRAN', 1, 0, 0, NULL, 0, NULL, '', NULL, 'c30bc4879d7020090e5bbdcdddc05a8945e9574facd40e0217d6e292a8b73b12018a0a9630cb57093200a561ef27fcd191ec6b953036c1ce640bf2775bc0d2ce'),
('VENNAMANENI MANOGNA', 'COE11B027', 'F', '', 'VENNAMANENI MANOGNA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'c37794f386c7fb60392b7cff0cae4603240351f4590f15357498913ca13cdc1b90afbe13210bcaa717dc250625e5cc48691737dbc2f3b0115863573163abe73d'),
('VADYALA SAI PRAVEEN REDDY', 'COE12B030', 'M', '', 'VADYALA SAI PRAVEEN REDDY', 1, 0, 0, NULL, 0, NULL, '', NULL, 'c4839917d560bbd038f45e9e9cbec588132c50969a7e46248a6754824d776d772e856a8e623605971534c095eba12b7875b157792ddd4184515dfde5a991b8f5'),
('NITHIN SHAMSUDHIN', 'COE12B017', 'M', '', 'NITHIN SHAMSUDHIN', 1, 0, 0, NULL, 0, NULL, '', NULL, 'c4b7d5e756d4d573e33f8a0b514669d1a3721de6ede1b7eb3b94b916fc5dc5f7888013c47c34c001b22a9b93bec03c3aec735d92ecb11c29ea95d43c0a34cb27'),
('SIDDHARTHA AGARWAL', 'COE11B023', 'M', '', 'SIDDHARTHA AGARWAL', 1, 0, 0, NULL, 0, NULL, '', NULL, 'c55429b6a824fa8a9c24f74e830a4c79e63a6e1f15d6dd12dac06560805a78e1d9a46e565b9eb6b9a40c2201ad71992b9fa99d7a252edf80e3b784ef2db791fd'),
('K. ARUN', 'EDM10D001', 'M', '', 'K. ARUN', 1, 0, 0, NULL, 0, NULL, '', NULL, 'c5b7bdbd2afb48b8b7c8b49e72b41833f3d5295a4176bde2a5124a10967e9496bff8c1a19726573a261bd22596e74802d7af787126df8d7395c8692142e2b637'),
('JATOTH NARENDAR NAIK', 'EDM14B019', 'M', '', 'JATOTH NARENDAR NAIK', 1, 0, 0, NULL, 0, NULL, '', NULL, 'c5e1d01ec086c08160b3b4e144fc82644efacd11b4a722124791690ff144f0d1132bcee376ba512ab72026ea031743d3ddecc13dcca5b6953de86309068f9062'),
('POTHULABOGUDA  MADHURI', 'COE12B023', 'F', '', 'POTHULABOGUDA  MADHURI', 1, 0, 0, NULL, 0, NULL, '', NULL, 'c627befc65cf9a5d9a72d93325f489dc5360e79ae30deb754ad78543bd824ce6d7636d87051c0e26171e0934db1db00c87059f2755f7af0cb166a721d6f84bf6'),
('CHIRINELLI NAVEEN KUMAR', 'MDM13B003', 'M', '', 'CHIRINELLI NAVEEN KUMAR', 1, 0, 0, NULL, 0, NULL, '', NULL, 'c6500edc02449319ab945ae984a5d2d453caaa77d53030ec81aad11fbf6e6fd0295db167c6e8ed20c5b9c77208ae1c2eca567411a2f820f7e0e0b3e79c0fea2d'),
('ABHAY KUMAR', 'EDS13M001', 'M', '', 'ABHAY KUMAR', 1, 0, 0, NULL, 0, NULL, '', NULL, 'c6dae8dc4086a3c05cb8b81f747ec8f4e3a26333173d31bd5c9a3eed07ae904816eb4f406c00821c9a551e2bd874ef16b3ef3a7dfee11a4f9180cfc7c9f31f29'),
('SIBBALA HEMANTH', 'MDM14B030', 'M', '', 'SIBBALA HEMANTH', 1, 0, 0, NULL, 0, NULL, '', NULL, 'c6f9e879e0eee365cf32a12e6b5f3dda462ce67268b66175664badd7abbb563b00eca0863f33041715ee25d74c8c797ce8daddc51b48b5559e1611b82afa0ac9'),
('SALIL SHARMA', 'CDS13M011', 'M', '', 'SALIL SHARMA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'c70b3335624cff931438e677fad399b49f41ea9dfe1ebbd7d8bfd55b54076693c274dcddb2fe891abbf5c7ac7a8a2c593435f0240e9c27250ff9b7186482618f'),
('S. DEVI YAMINI', 'MAT10D001', 'F', '', 'S. DEVI YAMINI', 1, 0, 0, NULL, 0, NULL, '', NULL, 'c928bf45e0d59fc77cc987bff1cbe4e44bea6dab153c94fcaa0637cbfa526b04565faaec0091ef4a317bbfa70bd1d928bad7bfbdc910133fc424bdbe743db7a0'),
('SREERAJ R', 'MFD14I010', 'M', '', 'SREERAJ R', 1, 0, 0, NULL, 0, NULL, '', NULL, 'c94bc52c05c38036630a301d860a96fb7b79831235dbc87bf43808004011e853fa004ef013657afa64e3d13755b5a6111576e219885c396246c8c60eee2588fc'),
('TARIGOPULA HOMA PRIYA', 'EDM13B033', 'F', '', 'TARIGOPULA HOMA PRIYA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'c9f11a2ae1c1818641282905937e306db0c3ff011b1cffbfbb4060ca26d54dd03afb198be14bd34327c9f9ea040a16d029faaa54c7efe956afc63d2266e89572'),
('CHINNI SUSRITH PRITHVI', 'CED14I005', 'M', '', 'CHINNI SUSRITH PRITHVI', 1, 0, 0, NULL, 0, NULL, '', NULL, 'ca1e119b8f983f9a53cf13c83035bf8d7e0cfdddc1627ee180735d986fab53ad0ddcc455e843ab907841daf5fb2ba163e01526ae437f2aadf9d3bc3e24fae8b0'),
('K S KHARTHICKEYEN', 'MDM13B011', 'M', '', 'K S KHARTHICKEYEN', 1, 0, 0, NULL, 0, NULL, '', NULL, 'caa0996bc9db3cf3ae98cfc8753a0ceec8a0a484e16e5668d7619ab76be694c8bf1b87614d8454c67f13ad5acbeb22ea3dd9c663053145a38469fed50e04899a'),
('MALLIKARJUN AKKENAPALLY', 'EDM13B016', 'M', '', 'MALLIKARJUN AKKENAPALLY', 1, 0, 0, NULL, 0, NULL, '', NULL, 'cbc60e77a7368c1f28e9ed4e936abf81e3ff442a35386e44b73fe49b075a2af079cee1ef14678838aa9812ea2821b03712304f8ce35a54a64df5607c60e26a9e'),
('ADARSH SHRIVASTAVA', 'COE13B003', 'M', '', 'ADARSH SHRIVASTAVA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'cc2da7fbde5aea53e782f0161be2388ed4afa91de426ce139b8f28ee612bd31c55d1be9e68a33bf358aa4ba70936e81339661212775d6c5593e7e3688775bc62'),
('YANDAPALLI VIJAY', 'MDM14B036', 'M', '', 'YANDAPALLI VIJAY', 1, 0, 0, NULL, 0, NULL, '', NULL, 'cd6e6a1c3e5102a35173ea78a69fadd124ba40e89c83e5ea8d1f54d5f20eee374837fc8898c7cd293883dfa0b8a23cc0584384753db44d0874661f5fdc20e0d8'),
('NUNAVATH MAHENDAR', 'COE13B021', 'M', '', 'NUNAVATH MAHENDAR', 1, 0, 0, NULL, 0, NULL, '', NULL, 'cd88a6ae5326da479e7c22a75fb065d33a297dd68c7cf0ad1e760ca32e17de56a1f4acda4ee02e24549084d718e1e9ae5673318340c2ae060ad0be3d8fe2ea8f'),
('M ABHISHRAVAN', 'EDM11B011', 'M', '', 'M ABHISHRAVAN', 1, 0, 0, NULL, 0, NULL, '', NULL, 'cdcd27dc2a3f54041839fb2fff06ea373df0b2e2b2fa5538f182171cc844f07cedcc681ffd86fd96ce520a8f84324d49b59770776a958635cf53fb0725bfe3d3'),
('SANTHOSH S', 'MDM13D001', 'M', '', 'SANTHOSH S', 1, 0, 0, NULL, 0, NULL, '', NULL, 'cdf7055e2d61ca02a68fbedb68d59d078d76d3ea026c043188721749f1d9aee0424ce315b958ade6aae34a655f2dd9335f96b620adb5acbbbca8c2b5b59507ec'),
('GADAMSETTY MURALIDHAR', 'EDS14M005', 'M', '', 'GADAMSETTY MURALIDHAR', 1, 0, 0, NULL, 0, NULL, '', NULL, 'ce5c50d8612696deb996a2d0fea4753b159464877eb7283256d7a884b3fd45884fa0918cf440d04e21e69209775883d02b1e5cff4657be0792c7b534890c4190'),
('MANIKANDAN. V.M', 'COE14D001', 'M', '', 'MANIKANDAN. V.M', 1, 0, 0, NULL, 0, NULL, '', NULL, 'ce9430b17af4ab107b2fa86f0a5d5511fa167a7554c58c524cd0543efd9c2987023ac2a115e670c8022e2bdc4c6e4580f794bf607e4cd23d5049ab6c90236cc7'),
('VANGALA SUSMITHA REDDY', 'EDM12B029', 'F', '', 'VANGALA SUSMITHA REDDY', 1, 0, 0, NULL, 0, NULL, '', NULL, 'cf06eea30b0c3559c1500980fa3a52659f3de98999816f3f416a7045ea7567e8530d4bc1a56f48705d563f7261ba901eff0a78ac9ae79ad68c6c08985010dea8'),
('GAURI RAJENDRA MAHALLE', 'MDS14M006', 'F', '', 'GAURI RAJENDRA MAHALLE', 1, 0, 0, NULL, 0, NULL, '', NULL, 'cf10ca44ebb42dc8980d16e5d49d1d471e877128bf6388cd310eeb30335b47b0233ccce3b8cb0160b05eddb728e39566f68eb18574f2e788c2af18e6bd9e5596'),
('RAMESH S', 'MDM13B020', 'M', '', 'RAMESH S', 1, 0, 0, NULL, 0, NULL, '', NULL, 'cf15531680c6291cdd302f8de7c2f699e62b5f9df591575c9a94ed8223a83f4b0e87eb1241542d454760a16e60f36ac2ced7b2f0b75cd37d26403105c315e7ef'),
('ANUMULA TEJASWI', 'EDM12B006', 'F', '', 'ANUMULA TEJASWI', 1, 0, 0, NULL, 0, NULL, '', NULL, 'cf5147c625ab273304bfa7dbc66b0fb74fbd9262189562125c5278a08a0211ab6b7200fa6bc8482d383655887c5ec81f96f6cd4cfc6af8b3cce47e9d17f5b5ad'),
('TEKUMATLA SHIVAKUMAR', 'MDM13B032', 'M', '', 'TEKUMATLA SHIVAKUMAR', 1, 0, 0, NULL, 0, NULL, '', NULL, 'cff5b1108237383dc8c0bfe19c45ab1103f8578a0947fcbbfb25bae7dc2a303556bc397b08b4caa73f7a7c770d0b7ff5015869ce9f39f40b58ac81eb2587a2ed'),
('GIRIDHARAN K', 'EDM12B012', 'M', '', 'GIRIDHARAN K', 1, 0, 0, NULL, 0, NULL, '', NULL, 'd01982741f7df6c2e1c3864ba6d532bddb92cdd5e8a1ac5fd92c7490530d02081ba4db63da955c3ff0f6614136d9eac8855fd3645cc5621b349916be2df30562'),
('SAGAR DOLAS', 'MDM11B025', 'M', '', 'SAGAR DOLAS', 1, 0, 0, NULL, 0, NULL, '', NULL, 'd01feffeeffe9639e8e04d4b8c91b17789c7233ac2af550083ff2e43da97bac31f5aca9ecf80cb5d5f5a40888dad5f03822bccc694bec20eb4ee273636616d43'),
('U VIVEK', 'MDM13B034', 'M', '', 'U VIVEK', 1, 0, 0, NULL, 0, NULL, '', NULL, 'd0b75a5439b2a2774fee4c372cdad9491ecb1503a3b53a6027a9a809601e44c7e10b5c50b0ea6ac319d44384050012e4f96194d692003f9083ec76fc855ab0a1'),
('VITHAL RAO V H R K', 'MDM12B027', 'M', '', 'VITHAL RAO V H R K', 1, 0, 0, NULL, 0, NULL, '', NULL, 'd0cfc3ee1cf93b62ecc1abd8f03f1b94d928b18df9bb7c5ade1ece3f2074899f2b533ddecd573823efe9b4ae68a111feacceea7f59178f469194d8e04ad9ce74'),
('MADALA RAJASEKHAR', 'MDM11B014', 'M', '', 'MADALA RAJASEKHAR', 1, 0, 0, NULL, 0, NULL, '', NULL, 'd0d17307b2561d7124795247b37f2d9090733cb9edea7ddd9d2e9fdfba311ff904801400d679ddec1365a7b2fd5a99c64abb2273ed5284ea57f2fad68b01d5b9'),
('RAJ RAUJI DESAI', 'MDS13M013', 'M', '', 'RAJ RAUJI DESAI', 1, 0, 0, NULL, 0, NULL, '', NULL, 'd0ff01b08419f68f9f408559ab341f6d04ddbfd87f9c2e6038208989ef238ab4a772277fd4bb14d33dd75f2bf423b70e9d27b28d876f9e61d9209b259d5e85c4'),
('ADITYA KULKARNI', 'MDM11B001', 'M', '', 'ADITYA KULKARNI', 1, 0, 0, NULL, 0, NULL, '', NULL, 'd1145f8fc1e4528b996e2b23dd0cea2c882e1187d6286c3a4f7cd0ef9bbe6a7c2b4bb2922f1deb031866ccc6852d8da2b1e83ce29b6531150e9f1c5b8b766a59'),
('LAWANYA. R', 'EDS13M008', 'F', '', 'LAWANYA. R', 1, 0, 0, NULL, 0, NULL, '', NULL, 'd154f9e47c556308172a6bf39cfd096c40555bade722d94110d1dbc54026f7651da38fa73702ffc37e703f020367edcc948ca0375c0a7337804301e0c4eefca5'),
('GOLI SAI KRISHNA', 'MDM12B008', 'M', '', 'GOLI SAI KRISHNA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'd18b173c66868a6922b02d258fe88745aedb75154e0a55308488a95d92e183e18178d16e697164ae6a86e79a53e2dd67e13edd82a1c1b47140219718fcdd36f2'),
('K S MANJUNATH', 'MDM11B011', 'M', '', 'K S MANJUNATH', 1, 0, 0, NULL, 0, NULL, '', NULL, 'd1da8e04642419d03627f56f06a6acbab485212601c8208c8bb8c32263cad56269a4c16dfbb1da0e9384e72928b1cba02f31b5b0aebf0cbe7b1e5c8617fa5135'),
('PASALA MONIKA LASYA PRIYA', 'ESD14I018', 'F', '', 'PASALA MONIKA LASYA PRIYA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'd2367a47b0ad382094d54b4c096e764de6f0462b37caf9c9a3a4e7118be3e85b6463255eafd47a574a79b53ce528de38a42880dc94d77530ee9cb8e9f609ce50'),
('GOWDHAM PRABHAKAR P G', 'EDS14M006', 'M', '', 'GOWDHAM PRABHAKAR P G', 1, 0, 0, NULL, 0, NULL, '', NULL, 'd23956fd02d83686af12f9f661d3104a1dd38e7766e9178c44f76b76bcb5c8b76cb1e1c0eebd8c9db928e55b39d5162944ec3c416e5c5693ad1ced33a7ca5940'),
('BEJJI PAVAN KUMAR', 'CED14I003', 'M', '', 'BEJJI PAVAN KUMAR', 1, 0, 0, NULL, 0, NULL, '', NULL, 'd2467d43b8ec36478438e8632c0401e314ec50c51950af3dc58d4b5479f9082b8378b7729d3ba960f0a859dbbca692a4e15958bd8bd1dc3f6950dab0d87085d6'),
('S.SESHURAM', 'COE13B026', 'M', '', 'S.SESHURAM', 1, 0, 0, NULL, 0, NULL, '', NULL, 'd2b38fac1959775c45d04b05f8a5b5b8b442c7526450afc98208412de161c2bd91df75134e8180ade251169a946f2d1342e858381c364619cb0c48c825602547'),
('CHANDU DS', 'EDM14D002', 'M', '', 'CHANDU DS', 1, 0, 0, NULL, 0, NULL, '', NULL, 'd337a580e9c3d6fcdb261c283b622f2db5478dc4be258b1327a83fe881e10b47131bf7b7f29dd3e6c19894a37fe71b7b1a4907d13a4494aa218af4ba5d82011d'),
('SREYAS.S', 'MPD14I015', 'M', '', 'SREYAS.S', 1, 0, 0, NULL, 0, NULL, '', NULL, 'd3ab667a96606f3306b7dc4bf6d996490d153aaff3686581823ed12197c520dd8e69ef61e909ed44464b19019be24e31ed1dd6485435567fbd1faef0ea9edeed'),
('JUBIN ANTONY J', 'MDM12B011', 'M', '', 'JUBIN ANTONY J', 1, 0, 0, NULL, 0, NULL, '', NULL, 'd4a32336d2b48d5a6b966212da0d8d8132ebe335fc4acd5c75ba95c7970bbb170e11012c57e773292d2875bf5a974c96b77a2acdfdccbdd83792a89c35d047e4'),
('S MAHESH VARMA', 'EDM11B021', 'M', '', 'S MAHESH VARMA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'd4abc98e745099bf4045293e096e15d6c379805ba1952eff2ef25798d744153c34221cd29cae7385a9200a781fa4f2f1d4299fafbfb939d113f3dd6eb2faea7f'),
('SAI MOULI MANOHAR RAO Y', 'MDM12B023', 'M', '', 'SAI MOULI MANOHAR RAO Y', 1, 0, 0, NULL, 0, NULL, '', NULL, 'd4fce574a26fb054ed2735c2db8af95e74ed0c9fc1abe6464058172f384bba93a3071fc2f80929d385c8b126ec52b52673e5fc0ae9f564af92a4e436e4f292fc'),
('L VIJAY SRI', 'COE13B014', 'F', '', 'L VIJAY SRI', 1, 0, 0, NULL, 0, NULL, '', NULL, 'd576fca831cd235c92363b7395f42c371f836c53347fa21e388388eb5d7c7b78c8fbb909c7295052192f7803dd1130dc250a1d124d3ea7182d88c0e6c0398676'),
('KANNAM SAI TEJA', 'MPD14I011', 'M', '', 'KANNAM SAI TEJA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'd5783f513ef7bdd8b9a0f30a15ab09e3ff690b08eb636537046c5ea67826f8911a63c1da2e1c79c6f1c61f7484d6dba0ec4c2448b2a272f74cbb0a325c0a7d25'),
('KORLAPATI PRANEETH', 'EDM12B017', 'M', '', 'KORLAPATI PRANEETH', 1, 0, 0, NULL, 0, NULL, '', NULL, 'd5a897854181d351cd727b94a63208cd0b43e7e6e60aa4e2a47b9b596e0a5d8fee14112e0abd7e7b47730ee0a0f21e117c52eab3962c4b90dc379590b61db36a'),
('RAM KUMAR Y', 'EDM12B023', 'M', '', 'RAM KUMAR Y', 1, 0, 0, NULL, 0, NULL, '', NULL, 'd5ff0a77e8fe5b425b035eb0d90870da2156ec127ec08a51371abd5da5aad462837bcc0054e52c1136dab184cf25f27e5a54fa43e907e0de45a0585d8fd76f53'),
('DEVARLA AVINASH ', 'EDM12B010', 'M', '', 'DEVARLA AVINASH ', 1, 0, 0, NULL, 0, NULL, '', NULL, 'd6857caf41a3b34eef6ddb080d74cdf5ef706471c6c79a78c65bd22b6020d039c118ee33476cf9f57fb37d0841d6ef0cf1cc6a23a0e1ef82742d2e5e6b26f8f0'),
('S. DHANALAKSHMI', 'MAT12D001', 'F', '', 'S. DHANALAKSHMI', 1, 0, 0, NULL, 0, NULL, '', NULL, 'd772e00648ac65b383bfd8b171ef609c5e3b39dfb0aa599aa0ecd7ae7c736531012c2186871efbe9f3f80f19e5d3b24aa3e81af1ccbb9bc916c8d2599b4b0f30'),
('INDURTHI SUSHMITHA', 'EDM14B017', 'F', '', 'INDURTHI SUSHMITHA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'd7e587a41f260e13447a4d86f787311bc62648235524e2c647685c62458638fdeb15fe84ddb1d15c6e5b7cb53b213fe0dd1c10aedda06d270566ffe0e17374d5'),
('DUGGIRALA PRASHANTH REDDY', 'CED14I006', 'M', '', 'DUGGIRALA PRASHANTH REDDY', 1, 0, 0, NULL, 0, NULL, '', NULL, 'd873ef3423c79838dc6d34616810b7439a46ff1386b0173da185bffaa853c07122a85d48385a7dbf2822fa1c7890cb1edc18f2e4d33821313d69c6a567e820b9'),
('DASARI ROBERTKIRAN', 'COE11B008', 'M', '', 'DASARI ROBERTKIRAN', 1, 0, 0, NULL, 0, NULL, '', NULL, 'd8a3aec7487bf58ca20276a3a2c16d8ff7916d6e4739dcc9072c37276ad1f2bc9a95c1fc8adbe2ec9a1ae7f0012b065d85b84ea5fdb795c334689a8339fbce20'),
('AZMERA ANKITHA', 'EVD14I003', 'F', '', 'AZMERA ANKITHA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'd974ef6ac3e8136ab32cd5fd3fc86cade44bfb71dbdb6a6ae1a8f3ce9e821723af0994e96189d747ee58a7d6a1f48a9f6a9edd84a9647f03d44b91e8978795ad'),
('R SANGAMALIKA', 'COE14B032', 'F', '', 'R SANGAMALIKA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'd9d41ef283cb9212f3c75b52b6b2d30e1b3a579cdb9a2173345caf21540a24ee0b8cc217fc922064c21a41cadf73eb7c03a7775efbd53639e44e4086565d07dc'),
('DHAYALAKUMAR .M', 'EDS14M004', 'M', '', 'DHAYALAKUMAR .M', 1, 0, 0, NULL, 0, NULL, '', NULL, 'd9d712cb8cc4fb3ddacc6e1477c1528ae57b9814ba9dc2511c47d73b0d31c3c8836c745e421e0bd9c709ca4c93799be9230e8a48796d550216f8a3e7e1eeb6d1'),
('VIKAS SRIVASTAVA', 'MDM13B037', 'M', '', 'VIKAS SRIVASTAVA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'da23cd713b6b91635d42ee1289ef5deeeebe3333e77d9c5188f1b6819cd953710e08cea0aa92154cb8214eb03f05aef80ccc72bb1048afdc3680fc03b3d926ad'),
('RANGU GOUTHAM', 'EDM12B024', 'M', '', 'RANGU GOUTHAM', 1, 0, 0, NULL, 0, NULL, '', NULL, 'da99dd6c5c5283a0c4493c113ed42d3c9d7646bca2e519fefbccd52eb053506e7c5a716ea7828e395fdb03ec7c31d90d21dadfa722a9ff64fe013f5a40f10757'),
('KANIMOZHI S', 'EDM13B013', 'F', '', 'KANIMOZHI S', 1, 0, 0, NULL, 0, NULL, '', NULL, 'db19bfc18818edcb879ccac4d30ebc7207fdd8bbc35a3a15dbb24dd4bcd89250e0ef2090cdf2cb93bd58d29f646aa1cdcf91cf65306000b7e38a550aac91fc93'),
('VIDYALAXMI DANI', 'CDS14M014', 'F', '', 'VIDYALAXMI DANI', 1, 0, 0, NULL, 0, NULL, '', NULL, 'db74143cf37e3a39d86bccdb74f47b85cdb68177230d63f15d07be8fc5c25eb89e1e5534369b1ccc336f20b974409155f92bb6294d0719be816dd89f63f3bf74'),
('JAISWAL SANKET VIJAY ', 'MDS13M007', 'M', '', 'JAISWAL SANKET VIJAY ', 1, 0, 0, NULL, 0, NULL, '', NULL, 'dbd3f50deea59ddafbd0b6b48fdbd5c1647a0b0a588ed178441cdfbe46a026e1e3e2688f477921fa4a4cdc960684d99403472a0447b3f18933ebd4885983e163'),
('SATYA RAO TAMADAPU', 'EDS13M015', 'M', '', 'SATYA RAO TAMADAPU', 1, 0, 0, NULL, 0, NULL, '', NULL, 'dc069fd3a2ae83dbcea4d140f56e2fcf79f0391397fa85d0603862c6c8d385ba595cab937e5e4ab4e82b3186069a4a4e9ba7ca4badb687e4d7d3342ae8a7d01a'),
('MANDAVA POOJITHA', 'EDM13B017', 'F', '', 'MANDAVA POOJITHA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'dc0d27215320b6e751d7093ca863a409f690064c8cd29be59b2160d9cba00f557b01788492b564e97877db1ebcb3be06abddfe37f1f251809ac652564db51eef'),
('RENJITH. P', 'COE14D002', 'M', '', 'RENJITH. P', 1, 0, 0, NULL, 0, NULL, '', NULL, 'dc15bd959b1019525413e34306ea97ddd62d0a3bb69a272d0c973dae0744fd5d2de5eed25084dacb0ddc81bafbe3dd77a3fc29b17ea168b975b59ac8dea633f1'),
('SUBRAMANIAN SAMINATHAN', 'MFD14I011', 'M', '', 'SUBRAMANIAN SAMINATHAN', 1, 0, 0, NULL, 0, NULL, '', NULL, 'dc4c4e9ae0523fa8c358c171b5ad1b4ef949928f0bf2d0a1f277c7a70a5404854a72826da0e3cf0759196fcb763198b2da2099bf5315d676e0aa7c26c8373e79'),
('RAJAMANURIVENKATA SRAVYA', 'CDS14M006', 'F', '', 'RAJAMANURIVENKATA SRAVYA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'dc9d163be904b74688abe218f4b4cf1eb7f43489b79c94431d49c76a0d133e209dcd6896a805196574c1f702798ead7a7c1a63e21eb61c9cb95b0d744977780f'),
('PEDIREDLA SAI CHARAN', 'COE14B029', 'M', '', 'PEDIREDLA SAI CHARAN', 1, 0, 0, NULL, 0, NULL, '', NULL, 'dca50664ce2c66c515c8fdb7f0698cb71779db465fae7ec2fd82b80b6b75076f7d49d8e3780fc0c949dfe2e7d3fb374888a562ca9973b7551302bf617ecff67a'),
('KOTHAMASU SHANMUKHA AKHIL', 'CED14I019', 'M', '', 'KOTHAMASU SHANMUKHA AKHIL', 1, 0, 0, NULL, 0, NULL, '', NULL, 'dcaa41342555100cccd7240548c63587917f989702c6ab5750895cb1956ff2993a7dad184a34183310deccd2f4a21c985badeb21e9f36194d2627146c44db771'),
('BALAKRISHNAN. N', 'EDS13M006', 'M', '', 'BALAKRISHNAN. N', 1, 0, 0, NULL, 0, NULL, '', NULL, 'dcc7c03ba132ce7f3027e1cb3b35ed0e49d045a88a2e58304f8b05130535fc8340c530d75bba539d4ce9cad484ec3d4d9e7c716c5e73e21948ca572560c3259e'),
('SHRUTI C SARASWATI', 'COE13B030', 'F', '', 'SHRUTI C SARASWATI', 1, 0, 0, NULL, 0, NULL, '', NULL, 'ddab2aefbd9ee3ea4d0f8282da0fe0f87e1786813069bfbbfbb3c4010739314ec1fcefde68339f787387eecfabfe7b904c87c1ff1061f73a8fa272baf94df8a7'),
('ASHISH AMERIA', 'MDM12B005', 'M', '', 'ASHISH AMERIA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'dddacf3cd50628960c9bb80d69cf09472c0fce5de8aa628a64b9eeb97355be18bc9744a600065cfd51d289e475ece7c6a4ab7c0639f5fb1b24d733ede47f9448'),
('PERLI RAVI TEJA', 'MDM12B016', 'M', '', 'PERLI RAVI TEJA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'dde69def2209d7917a3e4ccd5c6957e30f275dc365239fd51cb72201d5f3ae0dd20b0b0cd42973d4a07450d3a304ea7db09ddf3b0d6ccdd55616be6bb8769edc'),
('AMAN KUMAR', 'CED14I001', 'M', '', 'AMAN KUMAR', 1, 0, 0, NULL, 0, NULL, '', NULL, 'de48275b8b7bf427e8704f000007d28f2cfdc6491b60c0c720d0bf3f9e556728741ae47c9805f5875e90894b29cec46a130403f77c5a94e5f7d76db1a55ddcd4'),
('TUPILI SAI MANOJ REDDY', 'MDM13B033', 'M', '', 'TUPILI SAI MANOJ REDDY', 1, 0, 0, NULL, 0, NULL, '', NULL, 'de6d322b0124b35bfdfad0fb74e647f51c5918038212fdf4103e979cab103f664116f2027094615af03c8b7af38772189b67bc7cc1d776fba1ca686f8c20729e'),
('GEDI HARISH', 'EDM13B009', 'M', '', 'GEDI HARISH', 1, 0, 0, NULL, 0, NULL, '', NULL, 'dede9c9e2626bf08b4fca80495d8112f530627e6924f5de1c1d1b232f9f1905049745ccb9a59c403cf32006a963374baf0c69b4521356696da4ba83b6d4f4af5'),
('VINOD M', 'MDM12B026', 'M', '', 'VINOD M', 1, 0, 0, NULL, 0, NULL, '', NULL, 'df20ca1926be1cc296e484a4334095dcede1fd85e72b023ce7af1f29a0d84f79bdfb2f125a51e41e47a9d19814390948e844deb38609845b47874e4ed8a68683'),
('G ESWAR SAI KRISHNA', 'EDM14B014', 'M', '', 'G ESWAR SAI KRISHNA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'df3fbbfaf15c167723feb46039928dac48db7e3a5e1f8a14366f60a25030e9bf0a351d1a555bacab51c9af1512763beb7a3238c8e96c977a638a5a29f42a641b'),
('Aarthi M Sundaram', 'EDM12B002', 'F', '', 'Aarthi M Sundaram', 1, 0, 0, NULL, 0, NULL, '', NULL, 'df77438fd8e080b6645f647ee9198bc7583dbe80b1978a4f792bbe17303637e6266a496983678669483bbac48cbcf8e02baa5fba3b1c53cbfe4106a3124efa49'),
('SAI KRISHNA INENI', 'MDM12B022', 'M', '', 'SAI KRISHNA INENI', 1, 0, 0, NULL, 0, NULL, '', NULL, 'df9903eba4bd0156b430694ea26addafd4b954f90aa0e221215e8e42548469946408a268ccb77c263255dd9166ce8ab3aa35d98e97872701b25e3f3f4ede0834'),
('SUNAKAR PRUSTY', 'EDS14M013', 'M', '', 'SUNAKAR PRUSTY', 1, 0, 0, NULL, 0, NULL, '', NULL, 'dfac6a94420fa5bd7e31a7ebf05da39f35b030ccd2c3b068b23305a9ff9d2eb1e8a669d1da36753f42df8a4a2433f879096d232dce9db97c28e38671324a3bcd'),
('GAUTHAM MANOJ', 'MFD14I003', 'M', '', 'GAUTHAM MANOJ', 1, 0, 0, NULL, 0, NULL, '', NULL, 'dfbce9189a3e1301017421ec4860bc57f692d6dd996b97a9f97cae4cef7ae023c0a428d6085ed7bc1585f0ff7d33232de18af91269feddf521bb38762e80b0f5'),
('MALLAMPATI TARAKESH', 'MDM12B014', 'M', '', 'MALLAMPATI TARAKESH', 1, 0, 0, NULL, 0, NULL, '', NULL, 'dff784170d93b0a68e9d430794363c44918cd6cefbc06a9e758fd0bb55e1e0d8480fcb8350b21051fce588c7e1336fc28a1e1c39c381d2e3b01b6ae373dbacf4'),
('BETANAPALLI SATYANARAYANA', 'CDS14M001', 'M', '', 'BETANAPALLI SATYANARAYANA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'e03b3f939709976fbf7881b82060dee6fb9af908c71b2e3077e92c6af269716940d030b7206ee0282cec284bd2a584e67a9a81aad80869734dd1ba01b943b83d'),
('NEELI TIRUMALESH ARVIND', 'ESD14I008', 'M', '', 'NEELI TIRUMALESH ARVIND', 1, 0, 0, NULL, 0, NULL, '', NULL, 'e147e332b1fc172d8ae75ecf5927ab3d1bfc4f91ab9b67d48bbc837b7a5edbd9859be6b7eec9d7a8ae42da87daf22b8e985ff0f1036a21a2c42684fef0109387'),
('RAMYA SREE ALURI', 'MDM14B027', 'F', '', 'RAMYA SREE ALURI', 1, 0, 0, NULL, 0, NULL, '', NULL, 'e2835dc84f4ec78ce88dae634402c2d36586e7c0724074a6e88e4966bf54c94ab5a30808c53a4ed4c299e83e43f1b36a9f1fc144225ba6f2f988635273b2b976'),
('NIMMAKAYALA JAHNAVI', 'COE14B026', 'F', '', 'NIMMAKAYALA JAHNAVI', 1, 0, 0, NULL, 0, NULL, '', NULL, 'e2b7b09cd485f3d7c742a4cef3ac43edf440cd075f918885b5156d6534a2f46bdb11897f27816afa815a6947c0984a7ef561c50cfd5cb1ed4a1cbc6325adbf30'),
('P.K.ASHREYA', 'EDM13B021', 'M', '', 'P.K.ASHREYA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'e33a3cf5ea0de831d87cff814d2fe9c57a230e8c3f01c0124246dfac7f3bdc5b1227afe78216ca3299285a5eca61f4a90dcc5ea11c3eecf5b5b74131e9fdc053'),
('DEEPAK RANJAN PADHI', 'EDS14M002', 'M', '', 'DEEPAK RANJAN PADHI', 1, 0, 0, NULL, 0, NULL, '', NULL, 'e33d251550b89ae6c3b15c79d251b68870868d6c3769e5ec4b8fdcec88218cddc751756a5fa6fbd197cabb6a40af7ed8b508e15b489d29fb0b476175a3987206'),
('SIMMASETTY SOWMITH', 'COE12B028', 'M', '', 'SIMMASETTY SOWMITH', 1, 0, 0, NULL, 0, NULL, '', NULL, 'e348ac8b7c264a2f2da116272c6ced4ef68cecc3ec79d85345a22b64fc8d8580751f9202fe65ade3fa819d3f03b83cd62416ca2f525963bb98a822de7e64d70c'),
('T. P. SANDHYA', 'MAT11D001', 'F', '', 'T. P. SANDHYA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'e36778a6930ed840a7a36a5e04a9fd3e211e7c7efd3b29b38877792c52e45ff2a0d85a3b4f2af00de3443fb42bb1adc12aff37002280bd1aa6b598cfe3a8748f'),
('ANOOP KRISHNAN U', 'CED14I002', 'M', '', 'ANOOP KRISHNAN U', 1, 0, 0, NULL, 0, NULL, '', NULL, 'e372e16676413e3b316578cad85f7a8efad96b54dac50db84905bbd1b39b4bf24bf13a9c92bf15135c08b0d0ecafa0fc7d843c637e9e0df1ffb8949bbe6fe0da'),
('MUPPALLA SRAVAN KUMAR', 'ESD14I017', 'M', '', 'MUPPALLA SRAVAN KUMAR', 1, 0, 0, NULL, 0, NULL, '', NULL, 'e3d263f9c4efa950ef80b9bdb3a8b8f7e731a4784e3aa2cc7314f44fdf61d755d3f5efea3ad45b1066d280fb266752f4ad1290d456c56a0d62521b705778fb01'),
('KUSULURU BHARATH KUMAR REDDY', 'COE14B018', 'M', '', 'KUSULURU BHARATH KUMAR REDDY', 1, 0, 0, NULL, 0, NULL, '', NULL, 'e3e669aabe9618668bd3961f37e62f2772aab7403ac80e69f29b46d9d39761af99ffe714e86de654b0925c686336d150ecb08460b1ad4dd62598d47e2fa4c271'),
('SETTY ABHISHEK', 'MDM14B029', 'M', '', 'SETTY ABHISHEK', 1, 0, 0, NULL, 0, NULL, '', NULL, 'e3e73297bc0f590eaa3e8134a1e27a0c55e677a6ee3f9de8b4cc5a3fa6826ab16585f537494612149475fd8d787368bb7ae0c62652d110079e7e91cc37d998e8'),
('SHUBHAM KUMAR SINGH', 'COE12B027', 'M', '', 'SHUBHAM KUMAR SINGH', 1, 0, 0, NULL, 0, NULL, '', NULL, 'e3f749e0bcb5a17e3e86e3f95601f1ba47d64a9c4e68a2e6f9774b2beb3f7b95c4894163a515e006bb5f8a9fe21dd4f5f965d2eef2c4391411a84e7049f8d94d'),
('MEDHA VASISHTH', 'COE12B014', 'F', '', 'MEDHA VASISHTH', 1, 0, 0, NULL, 0, NULL, '', NULL, 'e4519ff936e37b3bffbe1417f3c13e971f117321ca65083fec9ad075c72607e70999d3a6616dba9b215b33021e3b1f224d96d310ea03da394d8a7e65f780f8b4'),
('POLAVAINA RAJENDAR', 'MDM13B019', 'M', '', 'POLAVAINA RAJENDAR', 1, 0, 0, NULL, 0, NULL, '', NULL, 'e55c35b72f5c4a59912efac13edf96a9c9cc4fafff6463e71bcba4f2c38ecc6d0d21048de8ed2e43e3088d659d94580591992c2a8c7d96b4611caa856a419fa2'),
('PUPPALA TIRUMALESWARA RAO', 'EVD14I012', 'M', '', 'PUPPALA TIRUMALESWARA RAO', 1, 0, 0, NULL, 0, NULL, '', NULL, 'e63a7d97a98867b7c8abdef35be6615a3f90e3715709e0405617ae1aca4b1d0b17f0fab7e9f47c04c122cb8d8a25a00e77e54341ebe9e811e4a45c02cbf29e22'),
('MUNIRAM MEENA', 'MDM11B019', 'M', '', 'MUNIRAM MEENA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'e6a2f3cdea952d5908eba4678cc613c87461f12f1fbd420e087ba29c1fb3f457d6db37d51f8819b4f8b3369ce6048c4c30dcc322805f5552c4355dfad9e58e32'),
('KABOTHU CHAITANYA', 'MDM14B013', 'M', '', 'KABOTHU CHAITANYA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'e7731c370071771c06371044cf1272bfe21e1eb510aaa547af06f5ef298bb5ea89da6314def14525aabb2e20e74342503555398eecd9b8d78c23a7762b9890ee'),
('AMUJALA VAMSI VIKAS', 'MDM14B003', 'M', '', 'AMUJALA VAMSI VIKAS', 1, 0, 0, NULL, 0, NULL, '', NULL, 'e7a50754122f1897e8f65625c65fe41bc70943437d2db277c51c3beac48d1a83f6b1f85261604fc000d6bee23bd2cfd8123e4039a67d52ded04d0f1e99000f04'),
('DUGGI DHEERAJ REDDY', 'MDM14B008', 'M', '', 'DUGGI DHEERAJ REDDY', 1, 0, 0, NULL, 0, NULL, '', NULL, 'e853c06de9a28128f3ddace83639e7408c393c22cac6d46b11c34c4331ab2d53912731f58d4c8e02c05d483439545a4e104b1cd32848fe3d249526b78e5da589'),
('PAPANABOYINA SRIKANTH', 'EDM11B017', 'M', '', 'PAPANABOYINA SRIKANTH', 1, 0, 0, NULL, 0, NULL, '', NULL, 'e95ad84a5e4e493b9103d4698b82ee28cd97b537674af988c480ebcc876d5646575993b47928d361b9675f49fcab3a02f7a8f4c07e77550ebb02537c5df557c3'),
('MALASANI PHANI', 'MDM14B020', 'M', '', 'MALASANI PHANI', 1, 0, 0, NULL, 0, NULL, '', NULL, 'e9b93af8ac8f6f5d01a21e62fbf0db3afd96a5e6ad19ea2dd58d0e88e9d1ca950094c09edbb8fb384cffa51f81bfe6ec00a5fb691fc7046934f5864de147735a'),
('ABDUL MAJEED K K', 'EDM12D001', 'M', '', 'ABDUL MAJEED K K', 1, 0, 0, NULL, 0, NULL, '', NULL, 'e9badb40cc0e3895bdd6d011cdbecf3f334b2ae4a62f0d2087b20183021eb27ad62718accdf977883149a79922ce520d6353ca5ac37b10942294dab55ba99f87'),
('KALVAPALLI SRAVANA CHANDRA', 'EDM12B014', 'F', '', 'KALVAPALLI SRAVANA CHANDRA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'ea6b6ab1adfae8d5e6a8e401210caacb3eade04327f930a76c5e4f1f004f035f7dc8ba772c52b01329d3eae0d8611a10f4498d5d494132fd91c166ac6c85a243'),
('BODDI REDDI SANJUSHA REDDY', 'EDM11B003', 'F', '', 'BODDI REDDI SANJUSHA REDDY', 1, 0, 0, NULL, 0, NULL, '', NULL, 'ea851dcf181ffeeb68519cbef3037ed8195caf9d3355798bb72a159e46e5b9fae8d5aa1df47d682fd0da7eb84d311fda3d6da1f140e93bf2f5a07e6e617699e7'),
('PARUPALLI MANOJ KUMAR', 'EVD14I011', 'M', '', 'PARUPALLI MANOJ KUMAR', 1, 0, 0, NULL, 0, NULL, '', NULL, 'eabe86573d2013f5eff459136cef06b421189f0923c50c97f6224feec7bdaac4d442b9d43546d6eb0d77e09bb31fe53ab2653b90965363fcada4a0895d63ddb3'),
('GOLLAPALLI ARUN TEJA', 'MDM13B008', 'M', '', 'GOLLAPALLI ARUN TEJA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'eac6694f83026e130b8756e7f8b19e1a05ff3b14c197163fbe99ef93f71040624acbfa2a265d0c28ce5b0afd45c94e1f8ed20c67e01f0aa2463fbf84c83d673e'),
('SIVAPRASAD SANTHOSH LIKITH NARAYAN', 'EDM13B031', 'M', '', 'SIVAPRASAD SANTHOSH LIKITH NARAYAN', 1, 0, 0, NULL, 0, NULL, '', NULL, 'eb2d33ac080cc2dd642c6c1bfede2dc605d52da5ce5f22abeaac3daccb2146cf1938800f52ff8dd0ddcec68c59fe1ed6a361849aec6f291cbe01a541ffe7b86f'),
('SUMA SODAGUDI', 'COE13B033', 'F', '', 'SUMA SODAGUDI', 1, 0, 0, NULL, 0, NULL, '', NULL, 'ec6589973e97e0d9f06e51cdd15d5fedb31a845cf41afb11698c1167ebd6f2b0ba1cfe852ffd6178be8220f03a9faff9de0fb6ba84fb10855bad70a16bb8a9eb'),
('A NIRMAL KUMAR', 'COE13B001', 'M', '', 'A NIRMAL KUMAR', 1, 0, 0, NULL, 0, NULL, '', NULL, 'ec9ace05d89ff03b6b383c205d05e9a0cb823a43e976f0fa1f82d8a282d2a02f9f50f18644345d7ec98251e04a3927aa65b6285894941299c3585102a9502364'),
('CHENGALA SUDHAKAR', 'MDM11B005', 'M', '', 'CHENGALA SUDHAKAR', 1, 0, 0, NULL, 0, NULL, '', NULL, 'ed07e5cf38117b46594a983d7a73fc4319bbf80777b258c6110d5b06f96703e7044a77fc89ed98ea6f15aa558698fc93d4010f0c0fa51b295e90756be2a1fd55'),
('B VENKATA SRUTHI', 'MPD14I014', 'F', '', 'B VENKATA SRUTHI', 1, 0, 0, NULL, 0, NULL, '', NULL, 'ed1599da49d4fbaf0bd26fb2d8ea8c2a2d54f284e76c0460882ab52bca27b8004538b4c2cc38ae21faa30105f4379b1a150f648efedba4f506473e99e40ebcce'),
('MAKULA KARTHIK', 'MDM11B016', 'M', '', 'MAKULA KARTHIK', 1, 0, 0, NULL, 0, NULL, '', NULL, 'ed8529126501c76d1aae4f76ef4e7a8ab90e972a87e1049c17e2f9575992008a0336af8806e64d9961661677a5108744d2e3b4647ee6b0f768a4b930ba551795'),
('DURGAVAJJULA SHAARADA YAMINI', 'EVD14I004', 'F', '', 'DURGAVAJJULA SHAARADA YAMINI', 1, 0, 0, NULL, 0, NULL, '', NULL, 'edff7be4e4e4e1ff121385da29fc701fb24351ef27aa3b2233450fa65ed6f2581527e9bdb3889da9a881d16e662d15c833c0905dc0091d073561e7d9603f14b7'),
('SHIVAM AWASTHI', 'CDS14M010', 'M', '', 'SHIVAM AWASTHI', 1, 0, 0, NULL, 0, NULL, '', NULL, 'ee6815814d3fa0f3943644cc1f22487f1266fa72a53e8bfe7b25b38530b59144cc383ef6ef4e062bc9d69572fd85101fa5a462de5688d1b17625e2536687113c'),
('NEKKANTI SAI VENKATESH', 'EDM14B030', 'M', '', 'NEKKANTI SAI VENKATESH', 1, 0, 0, NULL, 0, NULL, '', NULL, 'ee6e73f938f093ad40537bc610bd59a9b18f326995abc557c46b5758ca5cca2cdd0b95ac98f4eb1d2adfb9ad730b5788f1177d3a1d2cf4a7118444b5c727edc4'),
('THOKALA PRATHYUSHA.', 'COE13B036', 'F', '', 'THOKALA PRATHYUSHA.', 1, 0, 0, NULL, 0, NULL, '', NULL, 'eebd3fb805fef552e4c9ed1ad4e0b1768a4225242c06758570849c7394ef3f132bdbe4b19cb60af3f44b434a0166d1e9475d354428cdce3f8880dee4e4b33b95'),
('KRISHNA CHAURASIA', 'COE11B016', 'M', '', 'KRISHNA CHAURASIA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'ef970c3b40075dbc416db281a1c3f77ed4aafcf5b6b8d1eae000757a91f8edda8abe7b523a611424bb38cdd36c4b90fefd93aed417a992f0313d507ae237f019'),
('KOTHAPALLI SATYA DURGA PRASAD', 'MDM13B013', 'M', '', 'KOTHAPALLI SATYA DURGA PRASAD', 1, 0, 0, NULL, 0, NULL, '', NULL, 'efc5c1c3ed1c254370e550c4e4d951961b3b9d598b23c71019eed3f3bd0a7d1784bacbc1a994aed0b68f57d66190fafdf4522dacba3a8f2fff77a7e695937c02'),
('AJMEERA TEJASWI', 'EDM14B001', 'F', '', 'AJMEERA TEJASWI', 1, 0, 0, NULL, 0, NULL, '', NULL, 'f01122c308cb51204bbe37856e7a14657143a9f9560af2209750a241b1dfd01dca931cfe0f55debf1f55d3cb87f72c6d10579d305f8c8c1e87fa88971bcd605d'),
('NIKHIL ISAAC MANOHAR', 'CED14I024', 'M', '', 'NIKHIL ISAAC MANOHAR', 1, 0, 0, NULL, 0, NULL, '', NULL, 'f0a4e1edab39f1aa4387589d69c3b7a8030d13f0ca91f867dfb0b567e619160707480b16ef4f3098189cf8e94c1cc84b56f32dcce96cd0620cde55123e078113'),
('VIPUL GARHIYA', 'MDS14M013', 'M', '', 'VIPUL GARHIYA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'f11b7f71ae931b3cd6e2a49502a1d015264688dda0e6ccf3dc815e50c6927fb492fb05715cf570eb7cf317508c063a25a323d61dbfb1dd8bf09be754e5d72fdb'),
('VIGNESH N', 'EDM12B030', 'M', '', 'VIGNESH N', 1, 0, 0, NULL, 0, NULL, '', NULL, 'f188a9f48479d5945403e00d7e584f69d60ecba57508b917abbc93ad2e633dcec05b3260d0d8b36c2ce3152250bf111836f5c8df41bd6399dfcc79b6e2a31403'),
('NAGARJUNA YAPURI', 'MPD14I007', 'M', '', 'NAGARJUNA YAPURI', 1, 0, 0, NULL, 0, NULL, '', NULL, 'f1b71fc4e5bab6e57cab27ed50a5593247de5e269922956d8c1610514d6794df43098f84b3adbdaa71e6994ee7fa577f1702c93ed90fed5cce6cd8fa3106169c'),
('PRAVEEN KUMAR', 'COE13B022', 'M', '', 'PRAVEEN KUMAR', 1, 0, 0, NULL, 0, NULL, '', NULL, 'f1f3bea7c462e9bc93d9d09bff06186b9547056dfe33701bd17ea921229afb8d539f40c62b6f9b654d58e5dad11a2c2ef73834bfee0a82340ce596794d262f2a'),
('GULLIPALLI BINDU MEGHANA', 'EVD14I008', 'F', '', 'GULLIPALLI BINDU MEGHANA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'f20b90feb569416ca4dead2c4e9f90d5d3513297ab5a881508aab32dcdde982ed39bb19656466fd7bc9ce59c2aba1345fe40f2ca923399de027c1acffee4bf3c'),
('POLUR SAI SANKEERTH RAO', 'MDM11B021', 'M', '', 'POLUR SAI SANKEERTH RAO', 1, 0, 0, NULL, 0, NULL, '', NULL, 'f25e72dbe99dc56a4cc0c054bd2e88ad9f388fc3e5dd44f94a9959b1c035734e1a690f2dbd945b6939f71783164c54c10ef55c07d0b4ab825a13317481cca315'),
('GORUPUTI HARI KIRAN', 'MFD14I004', 'M', '', 'GORUPUTI HARI KIRAN', 1, 0, 0, NULL, 0, NULL, '', NULL, 'f2b7ca6055b5f032aa62622d7e54e298ee364d90629d6033f318e1636e00812237810617812be42389f98fa70b2a07339a1ca8581a7c1403f6dddec06781e879'),
('DESU HARSHA', 'MDM14B005', 'M', '', 'DESU HARSHA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'f3e9501f9852a9074533029312d89ad717b156a1ed1afcaa283f38cde20c0d66bf930e79df288f89b2dc9dc17c9eb4afa6c78361a7766242eb7ca95c799caeaa'),
('SHRAMIK PANDITRAO GAJLEKAR', 'MFD14I008', 'M', '', 'SHRAMIK PANDITRAO GAJLEKAR', 1, 0, 0, NULL, 0, NULL, '', NULL, 'f3f1b7c37b44303187c6c300f842c83ceb758ed8a7c71f4e01c21f0146a85e1edc319708a1e72725a31c015d656ddb75da44d9ac743dc6eaa80a58334af2c40b'),
('KOMMANABOINA MEGHANA SARAT', 'MDM12B012', 'F', '', 'KOMMANABOINA MEGHANA SARAT', 1, 0, 0, NULL, 0, NULL, '', NULL, 'f5fac19bf5fd66d2d37b48fb8c23a486ca264c878f640e7814efd02b711b9f5ba996298c765689448b98e2c5bacd97aa57c5be94969048a73aa280e41322e748'),
('VANKADARI MEGHANA', 'CED14I038', 'F', '', 'VANKADARI MEGHANA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'f6a2306316f8638889ef51030d82897c4e36e77170fd34efcbaffd24479cbf043bba0e8ccec6b2ac2683f9e5894fc3f923382ed337f29040adee84e9e1d5d42e'),
('MOHIT SINGHANIYA', 'COE11B019', 'M', '', 'MOHIT SINGHANIYA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'f71826cca4d40e139c3af707ba76a2b6c1ac9c8b82db71e270d511afa287b087eadca14326f81c47d064e50695675209b181597d275d0738128f1968877ebd88'),
('GANDRA V MURALI KRISHNA REDDY', 'EDS13M007', 'M', '', 'GANDRA V MURALI KRISHNA REDDY', 1, 0, 0, NULL, 0, NULL, '', NULL, 'f7f0f1918e73dcac8571b1adc944f7a17c016441b4563f114d16ce50fca85b68cce274a238569083b00a44f55aefbe1223527e1cf1eafc92a8b29639af6566ac'),
('KAJA PRANEETHA', 'COE14B012', 'F', '', 'KAJA PRANEETHA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'f82cd79d0f97ef0109d5d05e20e7c2c1465c2260a38bc76a0a305f0e0c499a5791d410a2c4c6392b8792227b0f32fdf2f88aa348928f406081a561d3702e2fb7'),
('ABHINAV KUMAR SHARMA', 'MDS13M001', 'M', '', 'ABHINAV KUMAR SHARMA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'f87c31fca4a790b6ef9f5c9a1b3fb8365bb81f438709e79ed4a93434a2440b51978a8fda1d8d4724dd92d35836c30c5577b9ae25a082495dbce5a2aa900e2c59'),
('RITESH MEENA', 'MDM12B020', 'M', '', 'RITESH MEENA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'f9e973d4960f7ea3cb44defac73dbaf31de64be0bac1a3e9e86937d6b2da15ddf2c90d2cf58dcb03646e739c4da06deb001e7a1d419346a5c55473a2a7219dfc'),
('BURUGUPALLI NAVEEN KUMAR', 'MDM14B038', 'M', '', 'BURUGUPALLI NAVEEN KUMAR', 1, 0, 0, NULL, 0, NULL, '', NULL, 'f9eccc19d301428a865542985c2f7414e4972a0218e6264c616d60d95ccbdc6b90d4c9da0b222b053ba8f0cf1bb6cadae4de3cfd8b3a521d37704b9746e2e457'),
('BATTINOJU SAI KUMAR', 'COE11B005', 'M', '6cfbdce3707f99bb916ff13036a94c07be3dfc7f9697612b6337854ca9910ce2b588eb5c9c4e5fe2552f3c08a3e8c18b95c07dfb1e6e417a9216db4c6a731bd5', 'BATTINOJU SAI KUMAR', 1, 0, 0, NULL, 0, NULL, '', NULL, 'fb16030008b6d90832588f821761942b0efe7b8596f953d4235682adf9a624de1006e1124ff2d426ca95a09dfd29e148c7466811feaae9cc91b577741e891b39'),
('GUBBALA ANIL', 'EDM11B007', 'M', '', 'GUBBALA ANIL', 1, 0, 0, NULL, 0, NULL, '', NULL, 'fb1973fd66805d14823253844f1fd2f6ab0db3e05410a755d370d156cca226b7c23f7321e0ef95d46b231d8088c0a1a4696d726db342216625553833cc43fcc2'),
('KAVYA P', 'COE11B015', 'F', '', 'KAVYA P', 1, 0, 0, NULL, 0, NULL, '', NULL, 'fb5d104f0c62a62cef086cf9a7dde2773738e395f24ff4b32a0cf70b7fb25c263c45fa2451b4b7dac10b117316019c78a7190686a2853d02c7c6de58a0f36597'),
('GATTI SAI SUBRAHMANYASWAMY', 'MPD14I003', 'M', '', 'GATTI SAI SUBRAHMANYASWAMY', 1, 0, 0, NULL, 0, NULL, '', NULL, 'fb7c641b4c653a1157dd3723d8edeb4b89ce0ebba37db34ea1b2c4f94bd2755b5fd939bfac2f2ab525e23570265e6355b25583b6fed1f22b145d84f26a4e310b'),
('OGURI SRI SIVA KRISHNA TEJA', 'COE12B020', 'M', '', 'OGURI SRI SIVA KRISHNA TEJA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'fb8d8e564bfe30b6cf6e40256e374e32a7ba251c0f05416a8c2fb49de139752e6403520b2417d247405f3a90a9e3f0c04691b9d9fe734ff6a85c3e9ac234a851'),
('MANASA KORADA', 'MFD14I016', 'F', '', 'MANASA KORADA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'fb9da4075d15a490b14f0c756160b2a9245c81c4557d574175160bf7bb576fd1e42805eb3e44de7464ac8544388baaf2f926577baeadda8e13888e63ea1ea7e3'),
('DURGAM GOUTHAM RAJ', 'MDM11B009', 'M', '', 'DURGAM GOUTHAM RAJ', 1, 0, 0, NULL, 0, NULL, '', NULL, 'fbc5eb2cd103555263021ed04a9c166aed0dae4b4e6abb06cb5cec07bad4dbab0cfda56210edd70700626c9a24a233afa019a0ae1ee119d492248f2b6ac9f86e'),
('S. KRISHNAKARTHIK', 'EDS13M013', 'M', '', 'S. KRISHNAKARTHIK', 1, 0, 0, NULL, 0, NULL, '', NULL, 'fc4115fa2feead620e00eb79eb3e7b9f80afed48e4e8e60e5faee56d9157a6d7239fa0af9c288e59c8374510a8aa77e7d212a71b95d1afaf7aac2d7a756deea6'),
('VATHOJU.NIKHIL RAGHAVENDRA', 'MPD14I008', 'M', '', 'VATHOJU.NIKHIL RAGHAVENDRA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'fc849686201ddf66d2e9bb4cdc248c9634f938539281582475d61aa33f664b6c6c8237ec02334ae465607ecb2337814b4d78005ae59d83d8e6d68647fe1699d1'),
('KARTHICK. K', 'MDS13M008', 'M', '', 'KARTHICK. K', 1, 0, 0, NULL, 0, NULL, '', NULL, 'fd23a89f27cfefeb341a5f6a2a936b656635aa0cd9be96fb1ca9c62c777c4cef3ce5d3817301a4e088c95760e91612dfbeb592e8f127d967ab372b6bf3dcb2ab'),
('KORLABANDI SISIRSIMHA', 'EDM11B010', 'M', '', 'KORLABANDI SISIRSIMHA', 1, 0, 0, NULL, 0, NULL, '', NULL, 'fd3ca9fe75b5bca10b8e43193a4d01e5d2b46fca81b954d66f1a19b55b0ce58b71e53bdae4debc12c6d90ed9f94dd0031fcaf307aa03a1061ba826c913c9ff7a'),
('AMGOTH SURYA PAMAR', 'MDM14B002', 'M', '', 'AMGOTH SURYA PAMAR', 1, 0, 0, NULL, 0, NULL, '', NULL, 'fe1e20d53f42b5b2451658c7c940ef216d59c3c517b1a583d507dcb6e6a9d165c8e3f07876fedd7d76d3dd775ca0f353a11ba3633f81b363c98364ae1395879e'),
('KUMAR ABHIMANYU', 'MDM11B012', 'M', '', 'KUMAR ABHIMANYU', 1, 0, 0, NULL, 0, NULL, '', NULL, 'fe21346ba9501ee0925b701255b4b3cc156cf41d468e3dac9567392301813cd26c71e7adb33fbdaf5508b423e722dc11ce1638d4a4bedd04be8321bdc070df99'),
('JATIN', 'EVD14I018', 'M', '', 'JATIN', 1, 0, 0, NULL, 0, NULL, '', NULL, 'fe5d1bde6ab4ac5ee999fa07ad5622a3297a02c01c468287e38260199027b1bf5ec0d9a5423f87a69e3474b4fc801fe98564116b4036fbe912bc8e4236834fad'),
('M NIKHIL', 'CED14I021', 'M', '', 'M NIKHIL', 1, 0, 0, NULL, 0, NULL, '', NULL, 'fe74052672c184f92f0bdd7bc78df2e81f7eb8ef391181aaabc94b8773275db71a21c8a7d4929154aa2c232a75287986df33cc74408de7c69631672c9aa61eb6'),
('SONTI AUROBINDO MALLESWAR', 'EDM11B023', 'M', '', 'SONTI AUROBINDO MALLESWAR', 1, 0, 0, NULL, 0, NULL, '', NULL, 'fe90d88b1f24b338034722437ddefd3716091bc0dc40406de4adea3de224b7e6a97a09c8b30b2faeba445f544ed72138ec9679619143f6b7d0ca16c6a8a1b5d6'),
('ANITA SEERVI', 'COE12B001', 'F', '', 'ANITA SEERVI', 1, 0, 0, NULL, 0, NULL, '', NULL, 'fff55f5fe37220e6fd63e2af28b8dad183563e8e6f3f43b03cf376ae91b4a28711122a12c2615ebbc306ba49de6caa5b459eb28bef6c7ef07c0a3d6c3c7a4f1b');

-- --------------------------------------------------------

--
-- Table structure for table `workshops`
--

CREATE TABLE IF NOT EXISTS `workshops` (
`workshopId` int(11) NOT NULL,
  `userId` varchar(9) NOT NULL,
  `workshopName` varchar(50) NOT NULL,
  `start` bigint(20) NOT NULL,
  `end` bigint(20) NOT NULL,
  `place` varchar(100) NOT NULL,
  `attendersCount` int(5) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `workshops`
--

INSERT INTO `workshops` (`workshopId`, `userId`, `workshopName`, `start`, `end`, `place`, `attendersCount`) VALUES
(1, 'coe12b025', 'dds', 0, 0, 'bombay', 200),
(2, 'COE12B025', 'AndroidWorkshopp', -19800, -19800, 'IIT MADRAS', 100),
(3, 'COE12B025', 'fadsf', 0, 0, '', 0),
(4, 'COE12B024', 'fadsf', 1420050600, 1422729000, '', 0),
(5, 'COE12B025', 'Hackfest', 1422729000, 1422729000, 'fdas', 15),
(6, 'COE12B025', 'Hackfest', 1422729000, 1422729000, 'fdas', 15),
(7, 'COE12B025', 'Hackfest fc', 1422729000, 1422729000, 'fdas', 15),
(11, 'COE12B009', 'fads', 0, 0, 'fads', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
 ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `academics`
--
ALTER TABLE `academics`
 ADD PRIMARY KEY (`degreeId`);

--
-- Indexes for table `achievements`
--
ALTER TABLE `achievements`
 ADD PRIMARY KEY (`achievementId`);

--
-- Indexes for table `certifiedcourses`
--
ALTER TABLE `certifiedcourses`
 ADD PRIMARY KEY (`courseId`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
 ADD PRIMARY KEY (`eventIdHash`), ADD FULLTEXT KEY `eventIdHash` (`eventIdHash`), ADD FULLTEXT KEY `eventName` (`eventName`), ADD FULLTEXT KEY `content` (`content`), ADD FULLTEXT KEY `eventName_2` (`eventName`);

--
-- Indexes for table `experience`
--
ALTER TABLE `experience`
 ADD PRIMARY KEY (`experienceId`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
 ADD PRIMARY KEY (`feedbackId`);

--
-- Indexes for table `ideaposttable`
--
ALTER TABLE `ideaposttable`
 ADD PRIMARY KEY (`ideaPostId`);

--
-- Indexes for table `interests`
--
ALTER TABLE `interests`
 ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `leavemessage`
--
ALTER TABLE `leavemessage`
 ADD PRIMARY KEY (`extHash`), ADD UNIQUE KEY `extHash` (`extHash`);

--
-- Indexes for table `loginlog`
--
ALTER TABLE `loginlog`
 ADD PRIMARY KEY (`logId`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
 ADD UNIQUE KEY `unique_index` (`userId`,`type`,`objectId`,`objectType`);

--
-- Indexes for table `p1c`
--
ALTER TABLE `p1c`
 ADD PRIMARY KEY (`commentId`,`commentIdHash`);

--
-- Indexes for table `p2c`
--
ALTER TABLE `p2c`
 ADD PRIMARY KEY (`commentId`,`commentIdHash`);

--
-- Indexes for table `p3c`
--
ALTER TABLE `p3c`
 ADD PRIMARY KEY (`commentId`,`commentIdHash`);

--
-- Indexes for table `p4c`
--
ALTER TABLE `p4c`
 ADD PRIMARY KEY (`commentId`,`commentIdHash`);

--
-- Indexes for table `p5c`
--
ALTER TABLE `p5c`
 ADD PRIMARY KEY (`commentId`,`commentIdHash`);

--
-- Indexes for table `p6c`
--
ALTER TABLE `p6c`
 ADD PRIMARY KEY (`commentId`,`commentIdHash`);

--
-- Indexes for table `p7c`
--
ALTER TABLE `p7c`
 ADD PRIMARY KEY (`commentId`,`commentIdHash`);

--
-- Indexes for table `p8c`
--
ALTER TABLE `p8c`
 ADD PRIMARY KEY (`commentId`,`commentIdHash`);

--
-- Indexes for table `p9c`
--
ALTER TABLE `p9c`
 ADD PRIMARY KEY (`commentId`,`commentIdHash`);

--
-- Indexes for table `p10c`
--
ALTER TABLE `p10c`
 ADD PRIMARY KEY (`commentId`,`commentIdHash`);

--
-- Indexes for table `p11c`
--
ALTER TABLE `p11c`
 ADD PRIMARY KEY (`commentId`,`commentIdHash`);

--
-- Indexes for table `p14c`
--
ALTER TABLE `p14c`
 ADD PRIMARY KEY (`commentId`,`commentIdHash`);

--
-- Indexes for table `p16c`
--
ALTER TABLE `p16c`
 ADD PRIMARY KEY (`commentId`,`commentIdHash`);

--
-- Indexes for table `p17c`
--
ALTER TABLE `p17c`
 ADD PRIMARY KEY (`commentId`,`commentIdHash`);

--
-- Indexes for table `p18c`
--
ALTER TABLE `p18c`
 ADD PRIMARY KEY (`commentId`,`commentIdHash`);

--
-- Indexes for table `p19c`
--
ALTER TABLE `p19c`
 ADD PRIMARY KEY (`commentId`,`commentIdHash`);

--
-- Indexes for table `p20c`
--
ALTER TABLE `p20c`
 ADD PRIMARY KEY (`commentId`,`commentIdHash`);

--
-- Indexes for table `p21c`
--
ALTER TABLE `p21c`
 ADD PRIMARY KEY (`commentId`,`commentIdHash`);

--
-- Indexes for table `p22c`
--
ALTER TABLE `p22c`
 ADD PRIMARY KEY (`commentId`,`commentIdHash`);

--
-- Indexes for table `p23c`
--
ALTER TABLE `p23c`
 ADD PRIMARY KEY (`commentId`,`commentIdHash`);

--
-- Indexes for table `p24c`
--
ALTER TABLE `p24c`
 ADD PRIMARY KEY (`commentId`,`commentIdHash`);

--
-- Indexes for table `poll`
--
ALTER TABLE `poll`
 ADD PRIMARY KEY (`pollIdHash`), ADD FULLTEXT KEY `pollIdHash` (`pollIdHash`), ADD FULLTEXT KEY `question` (`question`), ADD FULLTEXT KEY `options` (`options`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
 ADD PRIMARY KEY (`postIdHash`), ADD FULLTEXT KEY `postIdHash` (`postIdHash`), ADD FULLTEXT KEY `postIdHash_2` (`postIdHash`), ADD FULLTEXT KEY `content` (`content`), ADD FULLTEXT KEY `subject` (`subject`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
 ADD PRIMARY KEY (`projectId`);

--
-- Indexes for table `reportspams`
--
ALTER TABLE `reportspams`
 ADD PRIMARY KEY (`reportId`);

--
-- Indexes for table `resetpassword`
--
ALTER TABLE `resetpassword`
 ADD PRIMARY KEY (`resetRequestId`);

--
-- Indexes for table `skillset`
--
ALTER TABLE `skillset`
 ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `suspicious`
--
ALTER TABLE `suspicious`
 ADD PRIMARY KEY (`notificationId`);

--
-- Indexes for table `thread`
--
ALTER TABLE `thread`
 ADD PRIMARY KEY (`threadIdHash`);

--
-- Indexes for table `threadanswer`
--
ALTER TABLE `threadanswer`
 ADD PRIMARY KEY (`threadAnswerId`);

--
-- Indexes for table `toolkit`
--
ALTER TABLE `toolkit`
 ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`userIdHash`), ADD FULLTEXT KEY `userId` (`userId`), ADD FULLTEXT KEY `name` (`name`);

--
-- Indexes for table `workshops`
--
ALTER TABLE `workshops`
 ADD PRIMARY KEY (`workshopId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academics`
--
ALTER TABLE `academics`
MODIFY `degreeId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `achievements`
--
ALTER TABLE `achievements`
MODIFY `achievementId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `certifiedcourses`
--
ALTER TABLE `certifiedcourses`
MODIFY `courseId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `experience`
--
ALTER TABLE `experience`
MODIFY `experienceId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
MODIFY `feedbackId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `loginlog`
--
ALTER TABLE `loginlog`
MODIFY `logId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=120;
--
-- AUTO_INCREMENT for table `p1c`
--
ALTER TABLE `p1c`
MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `p2c`
--
ALTER TABLE `p2c`
MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `p3c`
--
ALTER TABLE `p3c`
MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `p4c`
--
ALTER TABLE `p4c`
MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `p5c`
--
ALTER TABLE `p5c`
MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `p6c`
--
ALTER TABLE `p6c`
MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `p7c`
--
ALTER TABLE `p7c`
MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `p8c`
--
ALTER TABLE `p8c`
MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `p9c`
--
ALTER TABLE `p9c`
MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `p10c`
--
ALTER TABLE `p10c`
MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `p11c`
--
ALTER TABLE `p11c`
MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `p14c`
--
ALTER TABLE `p14c`
MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `p16c`
--
ALTER TABLE `p16c`
MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `p17c`
--
ALTER TABLE `p17c`
MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `p18c`
--
ALTER TABLE `p18c`
MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `p19c`
--
ALTER TABLE `p19c`
MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `p20c`
--
ALTER TABLE `p20c`
MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `p21c`
--
ALTER TABLE `p21c`
MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `p22c`
--
ALTER TABLE `p22c`
MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `p23c`
--
ALTER TABLE `p23c`
MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `p24c`
--
ALTER TABLE `p24c`
MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
MODIFY `projectId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `reportspams`
--
ALTER TABLE `reportspams`
MODIFY `reportId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `resetpassword`
--
ALTER TABLE `resetpassword`
MODIFY `resetRequestId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `suspicious`
--
ALTER TABLE `suspicious`
MODIFY `notificationId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=201;
--
-- AUTO_INCREMENT for table `workshops`
--
ALTER TABLE `workshops`
MODIFY `workshopId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
