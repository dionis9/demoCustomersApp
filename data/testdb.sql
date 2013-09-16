-- phpMyAdmin SQL Dump

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `testdb`
--
CREATE DATABASE IF NOT EXISTS `testdb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `testdb`;

-- --------------------------------------------------------

--
-- Table structure for table `customerbizstates`
--

CREATE TABLE IF NOT EXISTS `customerbizstates` (
  `customers_id` int(10) unsigned NOT NULL,
  `states_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`customers_id`,`states_id`),
  KEY `fk_customer_biz_states_states1_idx` (`states_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customerbizstates`
--

INSERT INTO `customerbizstates` (`customers_id`, `states_id`) VALUES
(1, 1),
(1, 4),
(3, 6),
(1, 7),
(6, 8),
(1, 9),
(6, 9),
(2, 10),
(2, 12),
(2, 13),
(3, 13);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `states_id` int(10) unsigned NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_customers_states_idx` (`states_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `states_id`, `email`) VALUES
(1, 'Qwe Inc.', 1, 'admin@qwe.org'),
(2, 'Asd Inc.', 9, 'asd@gmail.com'),
(3, 'Zxc Inc.', 6, 'as.sa@iei.com'),
(6, 'Bla Inc.', 4, 'bla@yahoo.com');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE IF NOT EXISTS `states` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`) VALUES
(1, 'Alaska'),
(2, 'Alabama'),
(3, 'Arkansas'),
(4, 'Arizona'),
(5, 'California'),
(6, 'Colorado'),
(7, 'Connecticut'),
(8, 'Delaware'),
(9, 'Florida'),
(10, 'Georgia'),
(11, 'Hawaii'),
(12, 'Iowa'),
(13, 'Idaho');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customerbizstates`
--
ALTER TABLE `customerbizstates`
  ADD CONSTRAINT `fk_customer_biz_states_customers1` FOREIGN KEY (`customers_id`) REFERENCES `customers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_customer_biz_states_states1` FOREIGN KEY (`states_id`) REFERENCES `states` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `fk_customers_states` FOREIGN KEY (`states_id`) REFERENCES `states` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
