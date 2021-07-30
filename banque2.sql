-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 28, 2021 at 09:42 AM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `banque`
--

-- --------------------------------------------------------

--
-- Table structure for table `compte`
--

DROP TABLE IF EXISTS `compte`;
CREATE TABLE IF NOT EXISTS `compte` (
  `numero` varchar(15) NOT NULL,
  `titulaire` int(11) NOT NULL,
  `solde` float DEFAULT '0',
  PRIMARY KEY (`numero`),
  KEY `titulaire` (`titulaire`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `compte`
--

INSERT INTO `compte` (`numero`, `titulaire`, `solde`) VALUES
('000001', 1, 300);

-- --------------------------------------------------------

--
-- Table structure for table `personne`
--

DROP TABLE IF EXISTS `personne`;
CREATE TABLE IF NOT EXISTS `personne` (
  `personne_id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(25) DEFAULT NULL,
  `prenom` varchar(25) DEFAULT NULL,
  `dateNaiss` datetime DEFAULT NULL,
  PRIMARY KEY (`personne_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `personne`
--

INSERT INTO `personne` (`personne_id`, `nom`, `prenom`, `dateNaiss`) VALUES
(1, 'Doe', 'John', '2000-01-01 00:00:00'),
(2, 'Doe', 'Mike', '1995-02-10 00:00:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
