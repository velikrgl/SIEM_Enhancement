-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 27 Nis 2022, 22:46:18
-- Sunucu sürümü: 10.4.22-MariaDB
-- PHP Sürümü: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `gradproj`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `access_request`
--

CREATE TABLE `access_request` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `surname` text NOT NULL,
  `email` text NOT NULL,
  `topic` text NOT NULL,
  `explanation` text NOT NULL,
  `time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `email` text NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` text NOT NULL,
  `authorization` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `accounts`
--

INSERT INTO `accounts` (`id`, `name`, `surname`, `email`, `username`, `password`, `authorization`) VALUES
(1, 'Ömer', 'YILDIRIM', 'flashomer@gmail.com', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 2),
(3, 'Veli', 'Karagül', 'velikrgl@yahoo.com', 'velikrgl', 'c4ca4238a0b923820dcc509a6f75849b', 2);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `connections`
--

CREATE TABLE `connections` (
  `id` int(11) NOT NULL,
  `connection_name` text NOT NULL,
  `api_query` text NOT NULL,
  `fetch_time` text NOT NULL,
  `blackOrWhite` int(11) NOT NULL,
  `createdTime` date NOT NULL DEFAULT current_timestamp(),
  `userwhocreated` text NOT NULL DEFAULT 'admin',
  `creationReason` text DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `connections`
--

INSERT INTO `connections` (`id`, `connection_name`, `api_query`, `fetch_time`, `blackOrWhite`, `createdTime`, `userwhocreated`, `creationReason`, `status`) VALUES
(1, 'misp', 'misp.com', '60', 1, '2022-04-02', 'admin', 'misp connection', 0),
(2, 'usom', 'usom.com', '60', 1, '2022-04-02', 'admin', 'usom usage', 1),
(3, 'opencti', '', '', 0, '2022-04-02', '', NULL, 1),
(4, 'virustotal', 'virustatal.com.tr', '80', 0, '2022-04-02', 'velikrgl', 'virustotal connections', 1),
(12, 'test', 'test.com.tr', '60', 1, '2022-04-20', 'admin', 'test ', 1),
(14, 'openctiNegative', 'opencti.com.tr', '150', 1, '2022-04-20', 'admin', NULL, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `db_status`
--

CREATE TABLE `db_status` (
  `id` int(11) NOT NULL,
  `ip_hash_url` text NOT NULL,
  `info_type` int(11) DEFAULT 1,
  `type` int(11) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `db_status`
--

INSERT INTO `db_status` (`id`, `ip_hash_url`, `info_type`, `type`) VALUES
(1, '172.16.253.54', 1, 1),
(2, 'c4ca4238a0b923820dcc509a6f75849b', 1, 2),
(3, 'c4ca4238a0b923820dcc509a6f75849b', 1, 2),
(4, 'c4ca4238a0b923820dcc509a6f75849b', 1, 2),
(5, 'c4ca4238a0b923820dcc509a6f75849b', 1, 2),
(6, 'c4ca4238a0b923820dcc509a6f75849b', 1, 2),
(7, 'c4ca4238a0b923820dcc509a6f75849b', 1, 2),
(8, 'c4ca4238a0b923820dcc509a6f75849b', 1, 2),
(9, 'c4ca4238a0b923820dcc509a6f75849b', 1, 2),
(10, 'c4ca4238a0b923820dcc509a6f75849b', 1, 2),
(11, 'c4ca4238a0b923820dcc509a6f75849b', 1, 2),
(12, 'c4ca4238a0b923820dcc509a6f75849b', 1, 2),
(13, 'c4ca4238a0b923820dcc509a6f75849b', 1, 2),
(14, 'c4ca4238a0b923820dcc509a6f75849b', 1, 2),
(15, 'c4ca4238a0b923820dcc509a6f75849b', 1, 2),
(16, 'c4ca4238a0b923820dcc509a6f75849b', 1, 2),
(17, 'c4ca4238a0b923820dcc509a6f75849b', 1, 2),
(18, 'c4ca4238a0b923820dcc509a6f75849b', 1, 2),
(19, 'https://www.md5hashgenerator.com/', 2, 3),
(20, 'https://www.md5hashgenerator.com/', 2, 3),
(21, 'https://www.md5hashgenerator.com/', 2, 3),
(22, 'https://www.md5hashgenerator.com/', 2, 3),
(23, 'https://www.md5hashgenerator.com/', 2, 3),
(24, 'https://www.md5hashgenerator.com/', 2, 3),
(25, 'https://www.md5hashgenerator.com/', 2, 3),
(26, 'https://www.md5hashgenerator.com/', 2, 3),
(27, 'https://www.md5hashgenerator.com/', 2, 3),
(28, 'https://www.md5hashgenerator.com/', 2, 3),
(29, 'https://www.md5hashgenerator.com/', 2, 3),
(30, 'https://www.md5hashgenerator.com/', 2, 3),
(31, 'https://www.md5hashgenerator.com/', 2, 3),
(32, 'https://www.md5hashgenerator.com/', 2, 3),
(33, 'https://www.md5hashgenerator.com/', 2, 3),
(34, 'https://www.md5hashgenerator.com/', 2, 3),
(35, 'https://www.md5hashgenerator.com/', 2, 3),
(36, 'https://www.md5hashgenerator.com/', 2, 3),
(37, 'https://www.md5hashgenerator.com/', 2, 3),
(38, 'https://www.md5hashgenerator.com/', 2, 3),
(39, 'c4ca4238a0b923820dcc509a6f75849b', 1, 2),
(40, 'c4ca4238a0b923820dcc509a6f75849b', 1, 2),
(41, 'c4ca4238a0b923820dcc509a6f75849b', 1, 2),
(42, 'c4ca4238a0b923820dcc509a6f75849b', 1, 2),
(43, 'c4ca4238a0b923820dcc509a6f75849b', 1, 2),
(44, 'c4ca4238a0b923820dcc509a6f75849b', 1, 2),
(45, 'c4ca4238a0b923820dcc509a6f75849b', 1, 2),
(46, 'c4ca4238a0b923820dcc509a6f75849b', 1, 2),
(47, 'c4ca4238a0b923820dcc509a6f75849b', 1, 2),
(48, 'c4ca4238a0b923820dcc509a6f75849b', 1, 2),
(49, 'c4ca4238a0b923820dcc509a6f75849b', 1, 2),
(50, 'c4ca4238a0b923820dcc509a6f75849b', 1, 2);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `scanned_db`
--

CREATE TABLE `scanned_db` (
  `id` int(11) NOT NULL,
  `scanned_source` text NOT NULL,
  `scanned_type` int(2) NOT NULL,
  `scanned_time` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `which_api_src` text NOT NULL,
  `blocked` text NOT NULL,
  `country` text NOT NULL,
  `city` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `scanned_db`
--

INSERT INTO `scanned_db` (`id`, `scanned_source`, `scanned_type`, `scanned_time`, `status`, `which_api_src`, `blocked`, `country`, `city`) VALUES
(2, '192.168.16.80', 2, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(5, '192.168.16.80', 2, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(8, '192.168.16.80', 2, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(11, '192.168.16.80', 2, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(14, '192.168.15.225', 2, '2022-03-29 11:23:03', 1, 'api2', '0', 'USA', 'istanbul'),
(16, '192.168.16.80', 1, '2022-03-29 11:23:03', 1, 'api1', '0', 'Turkey', 'ankara'),
(17, '192.168.16.80', 2, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(19, '192.168.1.1', 1, '2022-03-29 11:23:03', 1, 'api1', '0', 'FRENCH', 'ankara'),
(20, '192.168.16.80', 2, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(22, '192.168.16.80', 1, '2022-03-29 11:23:03', 1, 'api1', '0', 'Turkey', 'ankara'),
(23, '192.168.16.80', 2, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(25, '192.168.16.80', 1, '2022-03-29 11:23:03', 1, 'api1', '0', 'Turkey', 'ankara'),
(26, '192.168.16.80', 2, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(28, '192.168.16.80', 1, '2022-03-29 11:23:03', 1, 'api1', '0', 'Turkey', 'ankara'),
(29, '192.168.16.80', 2, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(31, '192.168.16.80', 1, '2022-03-29 11:23:03', 1, 'api1', '0', 'Turkey', 'ankara'),
(32, '192.168.16.80', 2, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(33, '192.168.16.80', 3, '2022-03-29 11:23:03', 1, 'api3', '0', 'Turkey', 'izmir'),
(34, '192.168.16.80', 1, '2022-03-29 11:23:03', 1, 'api1', '0', 'Turkey', 'ankara'),
(35, '192.168.16.80', 2, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(36, '192.168.16.80', 3, '2022-03-29 11:23:03', 1, 'api3', '0', 'Turkey', 'izmir'),
(37, '192.168.16.80', 1, '2022-03-29 11:23:03', 1, 'api1', '0', 'Turkey', 'ankara'),
(38, '192.168.16.80', 2, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(39, '192.168.16.80', 3, '2022-03-29 11:23:03', 1, 'api3', '0', 'Turkey', 'izmir'),
(40, '192.168.16.80', 1, '2022-03-29 11:23:03', 1, 'api1', '0', 'Turkey', 'ankara'),
(41, '192.168.16.80', 2, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(42, '192.168.16.80', 3, '2022-03-29 11:23:03', 1, 'api3', '0', 'Turkey', 'izmir'),
(43, '192.168.16.80', 1, '2022-03-29 11:23:03', 1, 'api1', '0', 'Turkey', 'ankara'),
(44, '192.168.16.80', 2, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(45, '192.168.16.80', 3, '2022-03-29 11:23:03', 1, 'api3', '0', 'Turkey', 'izmir'),
(46, '172.16.255.3', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'GERMANY', 'BERLIN'),
(47, '172.16.255.3', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'GERMANY', 'BERLIN'),
(48, '172.16.255.3', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'GERMANY', 'BERLIN'),
(49, '172.16.255.3', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'GERMANY', 'BERLIN'),
(50, '172.16.255.3', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'GERMANY', 'BERLIN'),
(51, '172.16.255.3', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'GERMANY', 'BERLIN'),
(52, '172.16.255.3', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'GERMANY', 'BERLIN'),
(53, '172.16.255.30', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'ITALY', 'ROMA'),
(54, '172.16.255.30', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'ITALY', 'ROMA'),
(55, '172.16.255.30', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'ITALY', 'ROMA'),
(56, '192.168.16.100', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'GREECE', 'ATINA'),
(57, '192.168.16.100', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'GREECE', 'ATINA'),
(58, '192.168.16.100', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'GREECE', 'ATINA'),
(59, '168.245.66.42', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'CANADA', 'TORONTO'),
(60, '168.245.66.42', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'CANADA', 'TORONTO'),
(61, '168.245.66.42', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'CANADA', 'TORONTO'),
(62, '168.245.66.42', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'CANADA', 'TORONTO'),
(63, '168.245.66.42', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'CANADA', 'TORONTO'),
(64, '168.245.66.42', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'CANADA', 'TORONTO'),
(65, '168.245.66.42', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'CANADA', 'TORONTO'),
(66, '168.245.66.42', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'CANADA', 'TORONTO'),
(67, '168.245.66.42', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'CANADA', 'TORONTO'),
(68, '168.245.66.42', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'CANADA', 'TORONTO'),
(69, '168.245.66.42', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'CANADA', 'TORONTO'),
(70, '192.168.15.225', 2, '2022-03-29 11:23:03', 1, 'api2', '0', 'USA', 'California'),
(71, '172.16.255.30', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'ITALY', 'ROMA'),
(72, '172.16.255.30', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'ITALY', 'ROMA'),
(73, '172.16.255.30', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'ITALY', 'ROMA'),
(74, '192.168.16.100', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'GREECE', 'ATINA'),
(75, '192.168.16.100', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'GREECE', 'ATINA'),
(76, '172.16.255.30', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'ITALY', 'ROMA'),
(77, '192.168.16.30', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'POLAND', 'WARSAW'),
(78, '192.168.16.30', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'POLAND', 'WARSAW'),
(79, '192.168.16.30', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'POLAND', 'WARSAW'),
(80, '192.168.16.30', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'POLAND', 'WARSAW'),
(81, '192.168.16.30', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'POLAND', 'WARSAW'),
(82, '192.168.16.30', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'POLAND', 'WARSAW'),
(83, '192.168.16.30', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'POLAND', 'WARSAW'),
(84, '192.168.16.30', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'POLAND', 'WARSAW'),
(85, '192.168.16.30', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'POLAND', 'WARSAW'),
(86, '192.168.16.30', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'POLAND', 'WARSAW'),
(87, '192.168.16.30', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'POLAND', 'WARSAW'),
(88, '192.168.16.30', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'POLAND', 'WARSAW'),
(89, '192.168.16.30', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'POLAND', 'WARSAW'),
(90, '192.168.16.30', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'POLAND', 'WARSAW'),
(91, '192.168.16.30', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'POLAND', 'WARSAW'),
(92, '192.168.16.30', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'POLAND', 'WARSAW'),
(93, '192.168.16.30', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'POLAND', 'WARSAW'),
(94, '172.16.255.40', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'BULGARIA', 'MONTANA'),
(95, '172.16.255.40', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'BULGARIA', 'MONTANA'),
(96, '172.16.255.40', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'BULGARIA', 'MONTANA'),
(97, '172.16.255.40', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'BULGARIA', 'MONTANA'),
(98, '172.16.255.40', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'BULGARIA', 'MONTANA'),
(99, '172.16.255.40', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'BULGARIA', 'MONTANA'),
(100, '172.16.255.40', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'BULGARIA', 'MONTANA'),
(101, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'MOSCOW'),
(102, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'MOSCOW'),
(103, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'MOSCOW'),
(104, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'MOSCOW'),
(105, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'MOSCOW'),
(106, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'MOSCOW'),
(107, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'MOSCOW'),
(108, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'MOSCOW'),
(109, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'MOSCOW'),
(110, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'MOSCOW'),
(111, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'MOSCOW'),
(112, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'MOSCOW'),
(113, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'MOSCOW'),
(114, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'MOSCOW'),
(115, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'MOSCOW'),
(116, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'MOSCOW'),
(117, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'MOSCOW'),
(118, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'MOSCOW'),
(119, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'MOSCOW'),
(120, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'MOSCOW'),
(121, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'SHANGHAI'),
(122, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'SHANGHAI'),
(123, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'SHANGHAI'),
(124, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'SHANGHAI'),
(125, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'SHANGHAI'),
(126, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'SHANGHAI'),
(127, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'SHANGHAI'),
(128, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'SHANGHAI'),
(129, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'SHANGHAI'),
(130, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'SHANGHAI'),
(131, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'SHANGHAI'),
(132, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'SHANGHAI'),
(133, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'SHANGHAI'),
(134, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'SHANGHAI'),
(135, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'SHANGHAI'),
(136, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'SHANGHAI'),
(137, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'SHANGHAI'),
(138, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'SHANGHAI'),
(139, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'SHANGHAI'),
(140, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'SHANGHAI'),
(141, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'SHANGHAI'),
(142, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'SHANGHAI'),
(143, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'SHANGHAI'),
(144, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'SHANGHAI'),
(145, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'SHANGHAI'),
(146, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'SHANGHAI'),
(147, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'SHANGHAI'),
(148, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'SHANGHAI'),
(149, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'SHANGHAI'),
(150, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'SHANGHAI'),
(151, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'SHANGHAI'),
(152, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'SHANGHAI'),
(153, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'SHANGHAI'),
(154, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'SHANGHAI'),
(155, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'SHANGHAI'),
(156, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'SHANGHAI'),
(157, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'SHANGHAI'),
(158, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'SHANGHAI'),
(159, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'SHANGHAI'),
(160, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'SHANGHAI'),
(161, '192.168.16.10', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'RUSSIA', 'SHANGHAI'),
(162, '192.168.16.20', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'JAPAN', 'TOKYO'),
(163, '192.168.16.20', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'JAPAN', 'TOKYO'),
(164, '192.168.16.20', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'JAPAN', 'TOKYO'),
(165, '192.168.16.20', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'JAPAN', 'TOKYO'),
(166, '172.16.255.3', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'GERMANY', 'BERLIN'),
(167, '172.16.255.3', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'GERMANY', 'BERLIN'),
(168, '172.16.255.3', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'GERMANY', 'BERLIN'),
(169, '172.16.255.3', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'GERMANY', 'BERLIN'),
(170, '172.16.255.3', 1, '2022-04-22 23:06:28', 1, 'usom', '1', 'GERMANY', 'BERLIN'),
(171, 'c4ca4238a0b923820dcc509a6f75849b', 1, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(172, 'c4ca4238a0b923820dcc509a6f75849b', 1, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(173, 'c4ca4238a0b923820dcc509a6f75849b', 1, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(174, 'c4ca4238a0b923820dcc509a6f75849b', 1, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(175, 'c4ca4238a0b923820dcc509a6f75849b', 1, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(176, 'c4ca4238a0b923820dcc509a6f75849b', 1, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(177, 'c4ca4238a0b923820dcc509a6f75849b', 1, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(178, 'c4ca4238a0b923820dcc509a6f75849b', 1, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(179, 'c4ca4238a0b923820dcc509a6f75849b', 1, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(180, 'c4ca4238a0b923820dcc509a6f75849b', 1, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(181, 'c4ca4238a0b923820dcc509a6f75849b', 1, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(182, 'c4ca4238a0b923820dcc509a6f75849b', 1, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(183, 'c4ca4238a0b923820dcc509a6f75849b', 1, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(184, 'c4ca4238a0b923820dcc509a6f75849b', 1, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(185, 'c4ca4238a0b923820dcc509a6f75849b', 1, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(186, 'c4ca4238a0b923820dcc509a6f75849b', 1, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(187, 'c4ca4238a0b923820dcc509a6f75849b', 1, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(188, 'c4ca4238a0b923820dcc509a6f75849b', 1, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(189, 'c4ca4238a0b923820dcc509a6f75849b', 1, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(190, 'c4ca4238a0b923820dcc509a6f75849b', 1, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(191, 'https://www.md5hashgenerator.com/', 3, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(192, 'https://www.md5hashgenerator.com/', 3, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(193, 'https://www.md5hashgenerator.com/', 3, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(194, 'https://www.md5hashgenerator.com/', 3, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(195, 'https://www.md5hashgenerator.com/', 3, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(196, 'https://www.md5hashgenerator.com/', 3, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(197, 'https://www.md5hashgenerator.com/', 3, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(198, 'https://www.md5hashgenerator.com/', 3, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(199, 'https://www.md5hashgenerator.com/', 3, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(200, 'https://www.md5hashgenerator.com/', 3, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(201, 'https://www.md5hashgenerator.com/', 3, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(202, 'https://www.md5hashgenerator.com/', 3, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(203, 'https://www.md5hashgenerator.com/', 3, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(204, 'https://www.md5hashgenerator.com/', 3, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(205, 'https://www.md5hashgenerator.com/', 3, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(206, 'https://www.md5hashgenerator.com/', 3, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(207, 'https://www.md5hashgenerator.com/', 3, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(208, 'https://www.md5hashgenerator.com/', 3, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul'),
(209, 'https://www.md5hashgenerator.com/', 3, '2022-03-29 11:23:03', 1, 'api2', '0', 'Turkey', 'istanbul');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `siem_logs`
--

CREATE TABLE `siem_logs` (
  `id` int(11) NOT NULL,
  `log_id` int(11) NOT NULL,
  `log_time` date NOT NULL,
  `dest_ip` text NOT NULL,
  `dest_port` text NOT NULL,
  `source_ip` text NOT NULL,
  `source_port` text NOT NULL,
  `action` text NOT NULL,
  `protocol` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `siem_logs`
--

INSERT INTO `siem_logs` (`id`, `log_id`, `log_time`, `dest_ip`, `dest_port`, `source_ip`, `source_port`, `action`, `protocol`) VALUES
(1, 4625, '2022-04-05', '192.168.15.225', '443', '192.168.15.220', '55002', 'TCP', 'HTTPS'),
(2, 4625, '2022-04-05', '192.168.15.225', '443', '192.168.15.220', '55002', 'TCP', 'HTTPS'),
(3, 4625, '2022-04-05', '192.168.15.225', '443', '192.168.15.220', '55002', 'TCP', 'HTTPS'),
(4, 4625, '2022-04-05', '192.168.15.225', '443', '192.168.15.220', '55002', 'TCP', 'HTTPS'),
(5, 4625, '2022-04-05', '192.168.15.225', '443', '192.168.15.220', '55002', 'TCP', 'HTTPS');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `access_request`
--
ALTER TABLE `access_request`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `connections`
--
ALTER TABLE `connections`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `db_status`
--
ALTER TABLE `db_status`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `scanned_db`
--
ALTER TABLE `scanned_db`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `siem_logs`
--
ALTER TABLE `siem_logs`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `access_request`
--
ALTER TABLE `access_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `connections`
--
ALTER TABLE `connections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Tablo için AUTO_INCREMENT değeri `db_status`
--
ALTER TABLE `db_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Tablo için AUTO_INCREMENT değeri `scanned_db`
--
ALTER TABLE `scanned_db`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=210;

--
-- Tablo için AUTO_INCREMENT değeri `siem_logs`
--
ALTER TABLE `siem_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
