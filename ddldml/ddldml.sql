-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 01, 2019 at 08:08 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobseekr`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'engineering');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `city` varchar(50) NOT NULL,
  `website` varchar(50) NOT NULL,
  `about` varchar(1000) NOT NULL,
  `industry_id` varchar(10) NOT NULL,
  `logo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `address`, `city`, `website`, `about`, `industry_id`, `logo`) VALUES
(1, 'Telkom University', 'Jalan Telekomunikasi No. 1', 'Bandung', 'https://telkomuniversity.ac.id', 'ICT Campus', 'amz', 'null'),
(2, 'Proofn', 'jalan', 'bandung', 'proofn.id', 'social media', 'amz', 'null'),
(3, 'proofn', 'jalan', 'bandung', 'proofn.id', 'social media', 'it', 'null'),
(4, 'mitrais', 'jalan i gusti ngurah rai', 'denpasar', 'mitrais.com', 'the leading software development service', 'it', 'null'),
(5, 'Mitrais', 'jalan i gusti ngurah rai', 'denpasar', 'mitrais.com', 'the leading software development service', 'it', 'null');

-- --------------------------------------------------------

--
-- Table structure for table `industry`
--

CREATE TABLE `industry` (
  `id` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `industry`
--

INSERT INTO `industry` (`id`, `name`) VALUES
('amz', 'Amazon'),
('it', 'IT Services'),
('motgrap', 'Motion graphics'),
('telyu', 'Telkom University Indonesia');

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `employment_type` varchar(50) DEFAULT NULL,
  `job_summary` varchar(500) DEFAULT NULL,
  `min_qualification` varchar(500) DEFAULT NULL,
  `position` varchar(500) DEFAULT NULL,
  `expire_date` date DEFAULT NULL,
  `salary` int(10) DEFAULT NULL,
  `company_id` int(10) DEFAULT NULL,
  `category_id` int(10) DEFAULT NULL,
  `industry_id` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`id`, `name`, `employment_type`, `job_summary`, `min_qualification`, `position`, `expire_date`, `salary`, `company_id`, `category_id`, `industry_id`) VALUES
(1, 'backend', 'full time', 'ngetik kodingan', 'S1', 'backend', '2019-11-20', 500000, 5, 1, 'it'),
(3, 'frontend', 'full time', 'ngetik kodingan', 'S1', 'frontend', '2019-11-20', 500000, 2, 1, 'it'),
(4, 'avatar', 'full time', 'ngetik kodingan', 'S1', 'avatar', '2019-11-20', 500000, 1, 1, 'it'),
(5, 'avatar', 'full time', 'ngetik kodingan', 'S1', 'avatar', '2019-11-20', 500000, 1, 1, 'it');

-- --------------------------------------------------------

--
-- Table structure for table `jobseeker`
--

CREATE TABLE `jobseeker` (
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `phoneNumber` varchar(50) DEFAULT NULL,
  `summary` varchar(500) DEFAULT NULL,
  `cv_id` int(10) DEFAULT NULL,
  `resume_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobseeker`
--

INSERT INTO `jobseeker` (`name`, `email`, `password`, `username`, `address`, `phoneNumber`, `summary`, `cv_id`, `resume_id`) VALUES
('puspa', 'ayuputupuspasari@student.telkomuniversity.ac.id', 'puspasari24', NULL, NULL, NULL, NULL, NULL, NULL),
('bel', 'bel@gmail.com', 'belacantik', NULL, NULL, NULL, NULL, NULL, NULL),
('vayu', 'hi@vayu.id', 'inivayu', NULL, 'jalan ', '081', 'vayu', NULL, NULL),
('pbo', 'pbo@gmail.com', 'pbo', NULL, NULL, NULL, NULL, NULL, NULL),
('vayuprana', 'vayu@televicient.tk', 'inivayu', NULL, 'jalan 2', '082', 'vayupranavayu', NULL, NULL),
('vayuprana', 'vayuprana@televicient.tk', 'inivayu', NULL, 'jalan 3', '083', 'vayupranavayuprana', NULL, NULL),
('vayupranaditya', 'vayupranaditya@televicient.tk', 'inivayu', NULL, 'jalan 4', '084', 'vayupranaditya', NULL, NULL),
('vayupranadityap', 'vayupranadityap@televicient.tk', 'inivayu', NULL, 'jalan 5', '085', 'vayupranadityap', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `job_application`
--

CREATE TABLE `job_application` (
  `id` int(10) NOT NULL,
  `owner` varchar(50) NOT NULL,
  `job_id` int(10) NOT NULL,
  `summary` varchar(500) NOT NULL,
  `cv_id` int(10) NOT NULL,
  `resume_id` int(10) NOT NULL,
  `is_accepted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_application`
--

INSERT INTO `job_application` (`id`, `owner`, `job_id`, `summary`, `cv_id`, `resume_id`, `is_accepted`) VALUES
(1, 'hi@vayu.id', 3, "I\'m the god of code", 3, 2, 1),
(2, 'hi@vayu.id', 3, "I\'m the god of code", 3, 2, NULL),
(3, 'hi@vayu.id', 4, 'vayu', 0, 0, 1),
(4, 'hi@vayu.id', 4, 'vayu', 0, 0, NULL),
(5, 'hi@vayu.id', 4, 'vayu', 0, 0, NULL),
(6, 'hi@vayu.id', 4, 'vayu', 0, 0, 0),
(7, 'hi@vayu.id', 4, 'vayu', 0, 0, 1),
(8, 'hi@vayu.id', 1, 'vayu', 0, 0, 1),
(9, 'hi@vayu.id', 1, 'Saya merupakan orang yang suka nasi dengan kegemaran bernafas selagi kecil tetapi saat besar saya mulai suka lontong dengan spesialisasi pada senapan mesin tanpa keinginan untuk melihat ke luar karena di luar ada lampu yang bisa menghangatkan kopi yang dingin karena dinginnya cooling pad yang membuat kopi menjadi hitam sehitam tinta pada saat pemilihan presma yang merupakan jabatan tertinggi di suatu kampung.', 0, 0, 1),
(10, 'ayuputupuspasari@student.telkomuniversity.ac.id', 3, 'saya ayu :)', 0, 0, 1),
(11, 'bel@gmail.com', 1, 'dafaaaaaaaaaaa', 0, 0, 0),
(12, 'pbo@gmail.com', 1, 'hai', 0, 0, 1),
(13, 'hi@vayu.id', 1, 'vayu', 0, 0, NULL),
(14, 'hi@vayu.id', 4, 'vayu', 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `recruiter`
--

CREATE TABLE `recruiter` (
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `phoneNumber` varchar(50) DEFAULT NULL,
  `company_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recruiter`
--

INSERT INTO `recruiter` (`name`, `email`, `password`, `username`, `address`, `phoneNumber`, `company_id`) VALUES
('I Gusti Ayu Putu Puspasari', 'ayuputupuspasari@gmail.com', 'inipuspa', NULL, NULL, NULL, NULL),
('vay', 'hi@vay.id', 'inivayu', NULL, NULL, NULL, 1),
('vayuu', 'hi@vayuu.id', 'iniVayuu', NULL, NULL, NULL, NULL),
('pbo', 'pbo@pbo.id', 'pbo', NULL, NULL, NULL, NULL),
('shin', 'shindy@gmail.com', 'shindyshin', NULL, NULL, NULL, NULL),
('I Gusti Bagus Vayupranaditya', 'vayu@vayu.id', 'inivayu', NULL, NULL, NULL, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `industry`
--
ALTER TABLE `industry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobseeker`
--
ALTER TABLE `jobseeker`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `job_application`
--
ALTER TABLE `job_application`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recruiter`
--
ALTER TABLE `recruiter`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `job_application`
--
ALTER TABLE `job_application`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
