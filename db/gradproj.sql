-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 28 Mar 2022, 09:05:26
-- Sunucu sürümü: 10.4.21-MariaDB
-- PHP Sürümü: 7.4.23

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
(1, 'Ömer', 'YILDIRIM', 'flashomer@gmail.com', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 2);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `black_list`
--

CREATE TABLE `black_list` (
  `ip_info` text DEFAULT NULL,
  `hash_info` text DEFAULT NULL,
  `url_info` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `connections`
--

CREATE TABLE `connections` (
  `id` int(11) NOT NULL,
  `connection_name` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `connection_info`
--

CREATE TABLE `connection_info` (
  `id` int(11) NOT NULL,
  `api_username` text NOT NULL,
  `api_key` text NOT NULL,
  `fetch_time` text NOT NULL,
  `api_query` text NOT NULL,
  `blackOrWhite` text NOT NULL,
  `created_time` text NOT NULL,
  `userwhocreated` text NOT NULL,
  `creationReason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `db_info`
--

CREATE TABLE `db_info` (
  `ip_info` text NOT NULL,
  `hash_info` text NOT NULL,
  `url_info` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `scanned_db`
--

CREATE TABLE `scanned_db` (
  `id` int(11) NOT NULL,
  `scanned_ip` text NOT NULL,
  `scanned_hash` text NOT NULL,
  `scanned_url` text NOT NULL,
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

INSERT INTO `scanned_db` (`id`, `scanned_ip`, `scanned_hash`, `scanned_url`, `scanned_time`, `status`, `which_api_src`, `blocked`, `country`, `city`) VALUES
(1, '192.168.1.1', '', '', '2022-03-27 11:47:00', 1, 'api1', '0', 'turkey', 'ankara'),
(2, '', 'e0d123e5f316bef78bfdf5a008837577', '', '2022-03-27 11:47:00', 1, 'api2', '1', 'turkey', 'istanbul'),
(3, '', '', 'https://www.google.com.tr/', '2022-03-27 11:49:17', 0, 'api3', '1', 'turkey', 'izmir'),
(4, '', '', 'https://www.google.com.tr/', '2022-03-27 11:49:17', 1, 'api3', '1', 'turkey', 'izmir');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `scan_info`
--

CREATE TABLE `scan_info` (
  `status` int(11) NOT NULL,
  `time` date NOT NULL,
  `which_api_src` text NOT NULL,
  `blocked` text NOT NULL,
  `country` text NOT NULL,
  `city` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user_groups`
--

CREATE TABLE `user_groups` (
  `admin` text NOT NULL,
  `auditor` text NOT NULL,
  `system` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `white_list`
--

CREATE TABLE `white_list` (
  `ip_info` text DEFAULT NULL,
  `hash_info` text DEFAULT NULL,
  `url_info` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Tablo için indeksler `connection_info`
--
ALTER TABLE `connection_info`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `connections`
--
ALTER TABLE `connections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `connection_info`
--
ALTER TABLE `connection_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `scanned_db`
--
ALTER TABLE `scanned_db`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `siem_logs`
--
ALTER TABLE `siem_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `connection_info`
--
ALTER TABLE `connection_info`
  ADD CONSTRAINT `connection_info_ibfk_1` FOREIGN KEY (`id`) REFERENCES `connections` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
