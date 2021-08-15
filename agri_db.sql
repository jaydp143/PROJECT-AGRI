-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2021 at 01:16 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agri_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ecosystem`
--

CREATE TABLE `tbl_ecosystem` (
  `eco_id` int(150) NOT NULL,
  `ecosystem` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_ecosystem`
--

INSERT INTO `tbl_ecosystem` (`eco_id`, `ecosystem`) VALUES
(1, 'IRRIGATED'),
(2, 'RAINFED'),
(3, 'UPLAND');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_harvesting`
--

CREATE TABLE `tbl_harvesting` (
  `harvest_id` int(150) NOT NULL,
  `mun_id` int(150) NOT NULL,
  `seed_id` int(150) NOT NULL,
  `seed_type_id` int(150) NOT NULL,
  `eco_id` int(150) NOT NULL,
  `season` varchar(100) NOT NULL,
  `area` int(150) NOT NULL,
  `yield` int(150) NOT NULL,
  `production` int(150) NOT NULL,
  `date_monitored` date NOT NULL,
  `user` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_harvesting`
--

INSERT INTO `tbl_harvesting` (`harvest_id`, `mun_id`, `seed_id`, `seed_type_id`, `eco_id`, `season`, `area`, `yield`, `production`, `date_monitored`, `user`) VALUES
(1, 5, 1, 1, 1, 'DRY', 10, 10, 100, '2020-12-03', 'admin'),
(2, 5, 2, 1, 1, 'DRY', 10, 10, 100, '2020-12-03', 'admin'),
(3, 5, 3, 1, 1, 'DRY', 10, 10, 100, '2020-12-03', 'admin'),
(4, 5, 4, 2, 1, 'DRY', 10, 10, 100, '2020-12-03', 'admin'),
(5, 5, 5, 2, 1, 'DRY', 10, 10, 100, '2020-12-03', 'admin'),
(6, 5, 6, 2, 1, 'DRY', 10, 10, 100, '2020-12-03', 'admin'),
(7, 5, 7, 2, 1, 'DRY', 10, 10, 100, '2020-12-03', 'admin'),
(8, 5, 8, 2, 1, 'DRY', 10, 10, 100, '2020-12-03', 'admin'),
(9, 5, 9, 2, 1, 'DRY', 10, 10, 100, '2020-12-03', 'admin'),
(10, 5, 10, 3, 1, 'DRY', 10, 10, 100, '2020-12-03', 'admin'),
(11, 5, 11, 3, 1, 'DRY', 10, 10, 100, '2020-12-03', 'admin'),
(12, 5, 12, 3, 1, 'DRY', 10, 10, 100, '2020-12-03', 'admin'),
(13, 5, 13, 4, 1, 'DRY', 10, 10, 100, '2020-12-03', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_municipality`
--

CREATE TABLE `tbl_municipality` (
  `mun_id` int(150) NOT NULL,
  `municipality` varchar(100) DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_municipality`
--

INSERT INTO `tbl_municipality` (`mun_id`, `municipality`, `district`) VALUES
(1, 'Agno', '1'),
(2, 'Alaminos City', '1'),
(3, 'Anda', '1'),
(4, 'Bani', '1'),
(5, 'Bolinao', '1'),
(6, 'Burgos', '1'),
(7, 'Dasol', '1'),
(8, 'Infanta', '1'),
(9, 'Mabini', '1'),
(10, 'Sual', '1'),
(11, 'Aguilar', '2'),
(12, 'Basista', '2'),
(13, 'Binmaley', '2'),
(14, 'Bugallon', '2'),
(15, 'Labrador', '2'),
(16, 'Lingayen', '2'),
(17, 'Mangatarem', '2'),
(18, 'Urbiztondo', '2'),
(19, 'Bayambang', '3'),
(20, 'Calasiao', '3'),
(21, 'Malasiqui', '3'),
(22, 'Mapandan', '3'),
(23, 'San Carlos City', '3'),
(24, 'Santa Barbara', '3'),
(25, 'Dagupan City', '4'),
(26, 'Manaoag', '4'),
(27, 'Mangaldan', '4'),
(28, 'San Fabian', '4'),
(29, 'San Jacinto', '4'),
(30, 'Alcala', '5'),
(31, 'Bautista', '5'),
(32, 'Binalonan', '5'),
(33, 'Laoac', '5'),
(34, 'Pozorrubio', '5'),
(35, 'Santo Tomas', '5'),
(36, 'Sison', '5'),
(37, 'Urdaneta City', '5'),
(38, 'Villasis', '5'),
(39, 'Asingan', '6'),
(40, 'Balungao', '6'),
(41, 'Natividad', '6'),
(42, 'Rosales', '6'),
(43, 'San Manuel', '6'),
(44, 'San Nicolas', '6'),
(45, 'San Quintin', '6'),
(46, 'Santa Maria', '6'),
(47, 'Tayug', '6'),
(48, 'Umingan', '6');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_planting`
--

CREATE TABLE `tbl_planting` (
  `planting_id` int(150) NOT NULL,
  `mun_id` int(150) NOT NULL,
  `seed_id` int(150) NOT NULL,
  `seed_type_id` int(150) NOT NULL,
  `eco_id` int(150) NOT NULL,
  `season` varchar(100) NOT NULL,
  `areas` decimal(10,2) NOT NULL,
  `farmers` int(150) NOT NULL,
  `date_monitored` date NOT NULL,
  `user` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_planting`
--

INSERT INTO `tbl_planting` (`planting_id`, `mun_id`, `seed_id`, `seed_type_id`, `eco_id`, `season`, `areas`, `farmers`, `date_monitored`, `user`) VALUES
(27, 6, 1, 1, 1, 'DRY', '10.00', 10, '2020-12-03', 'admin'),
(28, 6, 2, 1, 1, 'DRY', '10.00', 10, '2020-12-03', 'admin'),
(29, 6, 3, 1, 1, 'DRY', '10.00', 10, '2020-12-03', 'admin'),
(30, 6, 4, 2, 1, 'DRY', '10.00', 10, '2020-12-03', 'admin'),
(31, 6, 5, 2, 1, 'DRY', '10.00', 10, '2020-12-03', 'admin'),
(32, 6, 6, 2, 1, 'DRY', '10.00', 10, '2020-12-03', 'admin'),
(33, 6, 7, 2, 1, 'DRY', '10.00', 10, '2020-12-03', 'admin'),
(34, 6, 8, 2, 1, 'DRY', '10.00', 10, '2020-12-03', 'admin'),
(35, 6, 9, 2, 1, 'DRY', '10.00', 10, '2020-12-03', 'admin'),
(36, 6, 10, 3, 1, 'DRY', '10.00', 10, '2020-12-03', 'admin'),
(37, 6, 11, 3, 1, 'DRY', '10.00', 10, '2020-12-03', 'admin'),
(38, 6, 12, 3, 1, 'DRY', '10.00', 10, '2020-12-03', 'admin'),
(39, 6, 13, 4, 1, 'DRY', '10.00', 10, '2020-12-03', 'admin'),
(40, 6, 1, 1, 2, 'DRY', '1.00', 1, '2020-12-31', 'admin'),
(41, 6, 2, 1, 2, 'DRY', '1.00', 1, '2020-12-31', 'admin'),
(42, 6, 3, 1, 2, 'DRY', '1.00', 1, '2020-12-31', 'admin'),
(43, 6, 4, 2, 2, 'DRY', '1.00', 1, '2020-12-31', 'admin'),
(44, 6, 5, 2, 2, 'DRY', '1.00', 1, '2020-12-31', 'admin'),
(45, 6, 6, 2, 2, 'DRY', '1.00', 1, '2020-12-31', 'admin'),
(46, 6, 7, 2, 2, 'DRY', '1.00', 1, '2020-12-31', 'admin'),
(47, 6, 8, 2, 2, 'DRY', '1.00', 1, '2020-12-31', 'admin'),
(48, 6, 9, 2, 2, 'DRY', '1.00', 1, '2020-12-31', 'admin'),
(49, 6, 10, 3, 2, 'DRY', '1.00', 1, '2020-12-31', 'admin'),
(50, 6, 11, 3, 2, 'DRY', '1.00', 1, '2020-12-31', 'admin'),
(51, 6, 12, 3, 2, 'DRY', '1.00', 1, '2020-12-31', 'admin'),
(52, 6, 13, 4, 2, 'DRY', '1.00', 1, '2020-12-31', 'admin'),
(53, 6, 1, 1, 3, 'DRY', '1.00', 1, '2021-01-01', 'admin'),
(54, 6, 2, 1, 3, 'DRY', '1.00', 1, '2021-01-01', 'admin'),
(55, 6, 3, 1, 3, 'DRY', '1.00', 1, '2021-01-01', 'admin'),
(56, 6, 4, 2, 3, 'DRY', '1.00', 1, '2021-01-01', 'admin'),
(57, 6, 5, 2, 3, 'DRY', '1.00', 1, '2021-01-01', 'admin'),
(58, 6, 6, 2, 3, 'DRY', '1.00', 1, '2021-01-01', 'admin'),
(59, 6, 7, 2, 3, 'DRY', '1.00', 1, '2021-01-01', 'admin'),
(60, 6, 8, 2, 3, 'DRY', '1.00', 1, '2021-01-01', 'admin'),
(61, 6, 9, 2, 3, 'DRY', '1.00', 1, '2021-01-01', 'admin'),
(62, 6, 10, 3, 3, 'DRY', '1.00', 1, '2021-01-01', 'admin'),
(63, 6, 11, 3, 3, 'DRY', '1.00', 1, '2021-01-01', 'admin'),
(64, 6, 12, 3, 3, 'DRY', '1.00', 1, '2021-01-01', 'admin'),
(65, 6, 13, 4, 3, 'DRY', '1.00', 1, '2021-01-01', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_seed`
--

CREATE TABLE `tbl_seed` (
  `seed_id` int(150) NOT NULL,
  `seed_description` varchar(150) NOT NULL,
  `seed_type_id` int(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_seed`
--

INSERT INTO `tbl_seed` (`seed_id`, `seed_description`, `seed_type_id`) VALUES
(1, 'ALPAS EXPANDED HYBRID', 1),
(2, 'REGULAR', 1),
(3, 'HYTA ROLL OVER', 1),
(4, 'RCEF', 2),
(5, 'INBRED ENHANCE/ALPAS', 2),
(6, 'BUFFER', 2),
(7, 'REGULAR (LGU SUBSIDY/DIRECT PURCHASED', 2),
(8, 'FS-RS (SEED PRODUCTION)', 2),
(9, 'RS-CS (SEED PRODUCTION', 2),
(10, 'Good Seeds from Tagged FS/RS by Seed Growers', 3),
(11, 'Good Seeds from Starter RS & CS by CSB/GSR', 3),
(12, 'Good Seeds from Traditional Varieties', 3),
(13, 'FARMERS SAVED SEEDS', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_seed_type`
--

CREATE TABLE `tbl_seed_type` (
  `seed_type_id` int(150) NOT NULL,
  `seed_type` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_seed_type`
--

INSERT INTO `tbl_seed_type` (`seed_type_id`, `seed_type`) VALUES
(1, 'HYBRID'),
(2, 'TAGGED SEEDS(Registered, Certified)'),
(3, 'UNTAGGED(Good Seeds)'),
(4, 'FARMERS SAVED SEEDS');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stages`
--

CREATE TABLE `tbl_stages` (
  `stage_id` int(11) NOT NULL,
  `stage_num` int(11) NOT NULL,
  `phase` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `max_days` int(11) NOT NULL,
  `min_days` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_target`
--

CREATE TABLE `tbl_target` (
  `target_id` int(100) NOT NULL,
  `mun_id` int(100) NOT NULL,
  `program` varchar(100) NOT NULL,
  `season` varchar(100) NOT NULL,
  `year` year(4) NOT NULL,
  `target` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_target`
--

INSERT INTO `tbl_target` (`target_id`, `mun_id`, `program`, `season`, `year`, `target`) VALUES
(48, 1, 'PLANTING', 'DRY', 2020, '1000.00'),
(49, 11, 'PLANTING', 'DRY', 2020, '1000.00'),
(50, 2, 'PLANTING', 'DRY', 2020, '1000.00'),
(51, 30, 'PLANTING', 'DRY', 2020, '1000.00'),
(52, 3, 'PLANTING', 'DRY', 2020, '1000.00'),
(53, 39, 'PLANTING', 'DRY', 2020, '1000.00'),
(54, 40, 'PLANTING', 'DRY', 2020, '1000.00'),
(55, 4, 'PLANTING', 'DRY', 2020, '1000.00'),
(56, 12, 'PLANTING', 'DRY', 2020, '1000.00'),
(57, 31, 'PLANTING', 'DRY', 2020, '1000.00'),
(58, 19, 'PLANTING', 'DRY', 2020, '1000.00'),
(59, 32, 'PLANTING', 'DRY', 2020, '1000.00'),
(60, 13, 'PLANTING', 'DRY', 2020, '1000.00'),
(61, 5, 'PLANTING', 'DRY', 2020, '1000.00'),
(62, 14, 'PLANTING', 'DRY', 2020, '1000.00'),
(63, 6, 'PLANTING', 'DRY', 2020, '1000.00'),
(64, 20, 'PLANTING', 'DRY', 2020, '1000.00'),
(65, 25, 'PLANTING', 'DRY', 2020, '1000.00'),
(66, 7, 'PLANTING', 'DRY', 2020, '1000.00'),
(67, 8, 'PLANTING', 'DRY', 2020, '1000.00'),
(68, 15, 'PLANTING', 'DRY', 2020, '1000.00'),
(69, 33, 'PLANTING', 'DRY', 2020, '1000.00'),
(70, 16, 'PLANTING', 'DRY', 2020, '1000.00'),
(71, 9, 'PLANTING', 'DRY', 2020, '1000.00'),
(72, 21, 'PLANTING', 'DRY', 2020, '1000.00'),
(73, 26, 'PLANTING', 'DRY', 2020, '1000.00'),
(74, 27, 'PLANTING', 'DRY', 2020, '1000.00'),
(75, 17, 'PLANTING', 'DRY', 2020, '1000.00'),
(76, 22, 'PLANTING', 'DRY', 2020, '1000.00'),
(77, 41, 'PLANTING', 'DRY', 2020, '1000.00'),
(78, 34, 'PLANTING', 'DRY', 2020, '1000.00'),
(79, 42, 'PLANTING', 'DRY', 2020, '1000.00'),
(80, 23, 'PLANTING', 'DRY', 2020, '1000.00'),
(81, 28, 'PLANTING', 'DRY', 2020, '1000.00'),
(82, 29, 'PLANTING', 'DRY', 2020, '1000.00'),
(83, 43, 'PLANTING', 'DRY', 2020, '1000.00'),
(84, 44, 'PLANTING', 'DRY', 2020, '1000.00'),
(85, 45, 'PLANTING', 'DRY', 2020, '1000.00'),
(86, 24, 'PLANTING', 'DRY', 2020, '1000.00'),
(87, 46, 'PLANTING', 'DRY', 2020, '1000.00'),
(88, 35, 'PLANTING', 'DRY', 2020, '1000.00'),
(89, 36, 'PLANTING', 'DRY', 2020, '1000.00'),
(90, 10, 'PLANTING', 'DRY', 2020, '1000.00'),
(91, 47, 'PLANTING', 'DRY', 2020, '1000.00'),
(92, 18, 'PLANTING', 'DRY', 2020, '1000.00'),
(93, 37, 'PLANTING', 'DRY', 2020, '1000.00'),
(94, 38, 'PLANTING', 'DRY', 2020, '1000.00'),
(95, 1, 'PLANTING', 'WET', 2020, '1000.00'),
(96, 11, 'PLANTING', 'WET', 2020, '1000.00'),
(97, 2, 'PLANTING', 'WET', 2020, '1000.00'),
(98, 30, 'PLANTING', 'WET', 2020, '1000.00'),
(99, 3, 'PLANTING', 'WET', 2020, '1000.00'),
(100, 39, 'PLANTING', 'WET', 2020, '1000.00'),
(101, 40, 'PLANTING', 'WET', 2020, '1000.00'),
(102, 4, 'PLANTING', 'WET', 2020, '1000.00'),
(103, 12, 'PLANTING', 'WET', 2020, '1000.00'),
(104, 31, 'PLANTING', 'WET', 2020, '1000.00'),
(105, 19, 'PLANTING', 'WET', 2020, '1000.00'),
(106, 32, 'PLANTING', 'WET', 2020, '1000.00'),
(107, 13, 'PLANTING', 'WET', 2020, '1000.00'),
(108, 5, 'PLANTING', 'WET', 2020, '1000.00'),
(109, 14, 'PLANTING', 'WET', 2020, '1000.00'),
(110, 6, 'PLANTING', 'WET', 2020, '1000.00'),
(111, 20, 'PLANTING', 'WET', 2020, '1000.00'),
(112, 25, 'PLANTING', 'WET', 2020, '1000.00'),
(113, 7, 'PLANTING', 'WET', 2020, '1000.00'),
(114, 8, 'PLANTING', 'WET', 2020, '1000.00'),
(115, 15, 'PLANTING', 'WET', 2020, '1000.00'),
(116, 33, 'PLANTING', 'WET', 2020, '1000.00'),
(117, 16, 'PLANTING', 'WET', 2020, '1000.00'),
(118, 9, 'PLANTING', 'WET', 2020, '1000.00'),
(119, 21, 'PLANTING', 'WET', 2020, '1000.00'),
(120, 26, 'PLANTING', 'WET', 2020, '1000.00'),
(121, 27, 'PLANTING', 'WET', 2020, '1000.00'),
(122, 17, 'PLANTING', 'WET', 2020, '1000.00'),
(123, 22, 'PLANTING', 'WET', 2020, '1000.00'),
(124, 41, 'PLANTING', 'WET', 2020, '1000.00'),
(125, 34, 'PLANTING', 'WET', 2020, '1000.00'),
(126, 42, 'PLANTING', 'WET', 2020, '1000.00'),
(127, 23, 'PLANTING', 'WET', 2020, '1000.00'),
(128, 28, 'PLANTING', 'WET', 2020, '1000.00'),
(129, 29, 'PLANTING', 'WET', 2020, '1000.00'),
(130, 43, 'PLANTING', 'WET', 2020, '1000.00'),
(131, 44, 'PLANTING', 'WET', 2020, '1000.00'),
(132, 45, 'PLANTING', 'WET', 2020, '1000.00'),
(133, 24, 'PLANTING', 'WET', 2020, '1000.00'),
(134, 46, 'PLANTING', 'WET', 2020, '1000.00'),
(135, 35, 'PLANTING', 'WET', 2020, '1000.00'),
(136, 36, 'PLANTING', 'WET', 2020, '1000.00'),
(137, 10, 'PLANTING', 'WET', 2020, '1000.00'),
(138, 47, 'PLANTING', 'WET', 2020, '1000.00'),
(139, 18, 'PLANTING', 'WET', 2020, '1000.00'),
(140, 37, 'PLANTING', 'WET', 2020, '1000.00'),
(141, 38, 'PLANTING', 'WET', 2020, '1000.00'),
(142, 1, 'HARVESTING', 'DRY', 2020, '1000.00'),
(143, 11, 'HARVESTING', 'DRY', 2020, '1000.00'),
(144, 2, 'HARVESTING', 'DRY', 2020, '1000.00'),
(145, 30, 'HARVESTING', 'DRY', 2020, '1000.00'),
(146, 3, 'HARVESTING', 'DRY', 2020, '1000.00'),
(147, 39, 'HARVESTING', 'DRY', 2020, '1000.00'),
(148, 40, 'HARVESTING', 'DRY', 2020, '1000.00'),
(149, 4, 'HARVESTING', 'DRY', 2020, '1000.00'),
(150, 12, 'HARVESTING', 'DRY', 2020, '1000.00'),
(151, 31, 'HARVESTING', 'DRY', 2020, '1000.00'),
(152, 19, 'HARVESTING', 'DRY', 2020, '1000.00'),
(153, 32, 'HARVESTING', 'DRY', 2020, '1000.00'),
(154, 13, 'HARVESTING', 'DRY', 2020, '1000.00'),
(155, 5, 'HARVESTING', 'DRY', 2020, '1000.00'),
(156, 14, 'HARVESTING', 'DRY', 2020, '1000.00'),
(157, 6, 'HARVESTING', 'DRY', 2020, '1000.00'),
(158, 20, 'HARVESTING', 'DRY', 2020, '1000.00'),
(159, 25, 'HARVESTING', 'DRY', 2020, '1000.00'),
(160, 7, 'HARVESTING', 'DRY', 2020, '1000.00'),
(161, 8, 'HARVESTING', 'DRY', 2020, '1000.00'),
(162, 15, 'HARVESTING', 'DRY', 2020, '1000.00'),
(163, 33, 'HARVESTING', 'DRY', 2020, '1000.00'),
(164, 16, 'HARVESTING', 'DRY', 2020, '1000.00'),
(165, 9, 'HARVESTING', 'DRY', 2020, '1000.00'),
(166, 21, 'HARVESTING', 'DRY', 2020, '1000.00'),
(167, 26, 'HARVESTING', 'DRY', 2020, '1000.00'),
(168, 27, 'HARVESTING', 'DRY', 2020, '1000.00'),
(169, 17, 'HARVESTING', 'DRY', 2020, '1000.00'),
(170, 22, 'HARVESTING', 'DRY', 2020, '1000.00'),
(171, 41, 'HARVESTING', 'DRY', 2020, '1000.00'),
(172, 34, 'HARVESTING', 'DRY', 2020, '1000.00'),
(173, 42, 'HARVESTING', 'DRY', 2020, '1000.00'),
(174, 23, 'HARVESTING', 'DRY', 2020, '1000.00'),
(175, 28, 'HARVESTING', 'DRY', 2020, '1000.00'),
(176, 29, 'HARVESTING', 'DRY', 2020, '1000.00'),
(177, 43, 'HARVESTING', 'DRY', 2020, '1000.00'),
(178, 44, 'HARVESTING', 'DRY', 2020, '1000.00'),
(179, 45, 'HARVESTING', 'DRY', 2020, '1000.00'),
(180, 24, 'HARVESTING', 'DRY', 2020, '1000.00'),
(181, 46, 'HARVESTING', 'DRY', 2020, '1000.00'),
(182, 35, 'HARVESTING', 'DRY', 2020, '1000.00'),
(183, 36, 'HARVESTING', 'DRY', 2020, '1000.00'),
(184, 10, 'HARVESTING', 'DRY', 2020, '1000.00'),
(185, 47, 'HARVESTING', 'DRY', 2020, '1000.00'),
(186, 18, 'HARVESTING', 'DRY', 2020, '1000.00'),
(187, 37, 'HARVESTING', 'DRY', 2020, '1000.00'),
(188, 38, 'HARVESTING', 'DRY', 2020, '1000.00'),
(189, 1, 'HARVESTING', 'WET', 2020, '1000.00'),
(190, 11, 'HARVESTING', 'WET', 2020, '1000.00'),
(191, 2, 'HARVESTING', 'WET', 2020, '1000.00'),
(192, 30, 'HARVESTING', 'WET', 2020, '1000.00'),
(193, 3, 'HARVESTING', 'WET', 2020, '1000.00'),
(194, 39, 'HARVESTING', 'WET', 2020, '1000.00'),
(195, 40, 'HARVESTING', 'WET', 2020, '1000.00'),
(196, 4, 'HARVESTING', 'WET', 2020, '1000.00'),
(197, 12, 'HARVESTING', 'WET', 2020, '1000.00'),
(198, 31, 'HARVESTING', 'WET', 2020, '1000.00'),
(199, 19, 'HARVESTING', 'WET', 2020, '1000.00'),
(200, 32, 'HARVESTING', 'WET', 2020, '1000.00'),
(201, 13, 'HARVESTING', 'WET', 2020, '1000.00'),
(202, 5, 'HARVESTING', 'WET', 2020, '1000.00'),
(203, 14, 'HARVESTING', 'WET', 2020, '1000.00'),
(204, 6, 'HARVESTING', 'WET', 2020, '1000.00'),
(205, 20, 'HARVESTING', 'WET', 2020, '1000.00'),
(206, 25, 'HARVESTING', 'WET', 2020, '1000.00'),
(207, 7, 'HARVESTING', 'WET', 2020, '1000.00'),
(208, 8, 'HARVESTING', 'WET', 2020, '1000.00'),
(209, 15, 'HARVESTING', 'WET', 2020, '1000.00'),
(210, 33, 'HARVESTING', 'WET', 2020, '1000.00'),
(211, 16, 'HARVESTING', 'WET', 2020, '1000.00'),
(212, 9, 'HARVESTING', 'WET', 2020, '1000.00'),
(213, 21, 'HARVESTING', 'WET', 2020, '1000.00'),
(214, 26, 'HARVESTING', 'WET', 2020, '1000.00'),
(215, 27, 'HARVESTING', 'WET', 2020, '1000.00'),
(216, 17, 'HARVESTING', 'WET', 2020, '1000.00'),
(217, 22, 'HARVESTING', 'WET', 2020, '1000.00'),
(218, 41, 'HARVESTING', 'WET', 2020, '1000.00'),
(219, 34, 'HARVESTING', 'WET', 2020, '1000.00'),
(220, 42, 'HARVESTING', 'WET', 2020, '1000.00'),
(221, 23, 'HARVESTING', 'WET', 2020, '1000.00'),
(222, 28, 'HARVESTING', 'WET', 2020, '1000.00'),
(223, 29, 'HARVESTING', 'WET', 2020, '1000.00'),
(224, 43, 'HARVESTING', 'WET', 2020, '1000.00'),
(225, 44, 'HARVESTING', 'WET', 2020, '1000.00'),
(226, 45, 'HARVESTING', 'WET', 2020, '1000.00'),
(227, 24, 'HARVESTING', 'WET', 2020, '1000.00'),
(228, 46, 'HARVESTING', 'WET', 2020, '1000.00'),
(229, 35, 'HARVESTING', 'WET', 2020, '1000.00'),
(230, 36, 'HARVESTING', 'WET', 2020, '1000.00'),
(231, 10, 'HARVESTING', 'WET', 2020, '1000.00'),
(232, 47, 'HARVESTING', 'WET', 2020, '1000.00'),
(233, 18, 'HARVESTING', 'WET', 2020, '1000.00'),
(234, 37, 'HARVESTING', 'WET', 2020, '1000.00'),
(235, 38, 'HARVESTING', 'WET', 2020, '1000.00'),
(236, 48, 'PLANTING', 'DRY', 2020, '1000.00'),
(237, 48, 'PLANTING', 'WET', 2020, '1000.00'),
(238, 48, 'HARVESTING', 'DRY', 2020, '1000.00'),
(239, 48, 'HARVESTING', 'WET', 2020, '1000.00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `password_temp` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `contact_no` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `house_no` varchar(100) NOT NULL,
  `street` varchar(100) NOT NULL,
  `barangay` varchar(100) NOT NULL,
  `municipality` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `userlevel` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `username`, `password`, `password_temp`, `firstname`, `middlename`, `lastname`, `contact_no`, `email`, `house_no`, `street`, `barangay`, `municipality`, `province`, `userlevel`) VALUES
(1, 'admin', '8833f1325fb6341757b30f6de91487a5', 'gabriel123', 'gabriel', 'cantor', 'luacan', '09958901259', 'gabrielcedrickl@gmail.com', '85', 'rizal', 'poblacion', 'mangaldan', 'pangasinan', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_ecosystem`
--
ALTER TABLE `tbl_ecosystem`
  ADD PRIMARY KEY (`eco_id`);

--
-- Indexes for table `tbl_harvesting`
--
ALTER TABLE `tbl_harvesting`
  ADD PRIMARY KEY (`harvest_id`);

--
-- Indexes for table `tbl_municipality`
--
ALTER TABLE `tbl_municipality`
  ADD PRIMARY KEY (`mun_id`);

--
-- Indexes for table `tbl_planting`
--
ALTER TABLE `tbl_planting`
  ADD PRIMARY KEY (`planting_id`);

--
-- Indexes for table `tbl_seed`
--
ALTER TABLE `tbl_seed`
  ADD PRIMARY KEY (`seed_id`);

--
-- Indexes for table `tbl_seed_type`
--
ALTER TABLE `tbl_seed_type`
  ADD PRIMARY KEY (`seed_type_id`);

--
-- Indexes for table `tbl_stages`
--
ALTER TABLE `tbl_stages`
  ADD PRIMARY KEY (`stage_id`);

--
-- Indexes for table `tbl_target`
--
ALTER TABLE `tbl_target`
  ADD PRIMARY KEY (`target_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_ecosystem`
--
ALTER TABLE `tbl_ecosystem`
  MODIFY `eco_id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_harvesting`
--
ALTER TABLE `tbl_harvesting`
  MODIFY `harvest_id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tbl_municipality`
--
ALTER TABLE `tbl_municipality`
  MODIFY `mun_id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `tbl_planting`
--
ALTER TABLE `tbl_planting`
  MODIFY `planting_id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `tbl_seed`
--
ALTER TABLE `tbl_seed`
  MODIFY `seed_id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tbl_seed_type`
--
ALTER TABLE `tbl_seed_type`
  MODIFY `seed_type_id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_stages`
--
ALTER TABLE `tbl_stages`
  MODIFY `stage_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_target`
--
ALTER TABLE `tbl_target`
  MODIFY `target_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
