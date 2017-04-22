-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 22, 2017 at 04:25 PM
-- Server version: 5.6.26-log
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `properties`
--

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1492800966),
('m130524_201442_init', 1492877175),
('m170421_190658_properties', 1492877176),
('m170422_050727_populate_database', 1492877176);

-- --------------------------------------------------------

--
-- Table structure for table `object`
--

CREATE TABLE `object` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `object`
--

INSERT INTO `object` (`id`, `name`, `type_id`, `created_at`) VALUES
(1, 'Tesla Model X P100D', 2, '2017-04-22 16:06:16'),
(2, 'Mercedes-Benz CLS-klasse II (W218) 350', 2, '2017-04-22 16:06:16'),
(3, 'Scania R-series', 2, '2017-04-22 16:06:16'),
(4, 'Komatsu', 1, '2017-04-22 16:06:16'),
(5, 'Hyundai', 1, '2017-04-22 16:06:16'),
(6, 'Golden Dragon', 3, '2017-04-22 16:06:16'),
(7, 'Golden Dragon', 3, '2017-04-22 16:06:16');

-- --------------------------------------------------------

--
-- Table structure for table `objects_properties`
--

CREATE TABLE `objects_properties` (
  `id` int(11) NOT NULL,
  `object_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `value_int` int(11) DEFAULT NULL,
  `value_text` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `objects_properties`
--

INSERT INTO `objects_properties` (`id`, `object_id`, `property_id`, `value_int`, `value_text`) VALUES
(1, 1, 4, 762, NULL),
(2, 2, 4, 306, NULL),
(3, 2, 5, 1, NULL),
(4, 3, 4, 450, NULL),
(5, 3, 5, 0, NULL),
(6, 4, 2, 8000, NULL),
(7, 4, 3, NULL, 'LW80'),
(8, 4, 1, 10, NULL),
(9, 5, 2, 15000, NULL),
(10, 5, 3, NULL, 'Gold'),
(11, 5, 1, 11, NULL),
(12, 6, 7, 30, NULL),
(13, 6, 6, NULL, 'XML 6126JR'),
(14, 7, 7, 37, NULL),
(15, 7, 6, NULL, 'XML 6125CR');

-- --------------------------------------------------------

--
-- Table structure for table `object_property`
--

CREATE TABLE `object_property` (
  `id` int(11) NOT NULL,
  `object_type_id` int(11) NOT NULL COMMENT 'Тип объекта',
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Название свойства',
  `data_type` int(11) NOT NULL COMMENT 'Тип данных (1=integer/bool; 2=text)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `object_property`
--

INSERT INTO `object_property` (`id`, `object_type_id`, `name`, `data_type`) VALUES
(1, 1, 'высота', 1),
(2, 1, 'грузоподъемность', 1),
(3, 1, 'модель', 2),
(4, 2, 'мощность', 1),
(5, 2, 'легковой или нет', 1),
(6, 3, 'модель', 2),
(7, 3, 'пассажировместимость', 1);

-- --------------------------------------------------------

--
-- Table structure for table `object_type`
--

CREATE TABLE `object_type` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `object_type`
--

INSERT INTO `object_type` (`id`, `name`) VALUES
(3, 'автобус'),
(1, 'кран'),
(2, 'машина');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `object`
--
ALTER TABLE `object`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_object_type` (`type_id`);

--
-- Indexes for table `objects_properties`
--
ALTER TABLE `objects_properties`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_objects_properties` (`object_id`,`property_id`),
  ADD KEY `fk_property` (`property_id`);

--
-- Indexes for table `object_property`
--
ALTER TABLE `object_property`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_object_property` (`object_type_id`,`name`);

--
-- Indexes for table `object_type`
--
ALTER TABLE `object_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_object_type` (`name`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `object`
--
ALTER TABLE `object`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `objects_properties`
--
ALTER TABLE `objects_properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `object_property`
--
ALTER TABLE `object_property`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `object_type`
--
ALTER TABLE `object_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `object`
--
ALTER TABLE `object`
  ADD CONSTRAINT `fk_object_type` FOREIGN KEY (`type_id`) REFERENCES `object_type` (`id`);

--
-- Constraints for table `objects_properties`
--
ALTER TABLE `objects_properties`
  ADD CONSTRAINT `fk_object` FOREIGN KEY (`object_id`) REFERENCES `object` (`id`),
  ADD CONSTRAINT `fk_property` FOREIGN KEY (`property_id`) REFERENCES `object_property` (`id`);

--
-- Constraints for table `object_property`
--
ALTER TABLE `object_property`
  ADD CONSTRAINT `fk_object_type_id` FOREIGN KEY (`object_type_id`) REFERENCES `object_type` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
