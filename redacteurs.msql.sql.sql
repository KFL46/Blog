-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 17 mars 2020 à 13:48
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `redacteurs`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) NOT NULL,
  `text` text NOT NULL,
  `datepublication` datetime NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) DEFAULT NULL,
  `idredacteur` tinyint(3) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idpseudo` (`idredacteur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `commentaire` varchar(255) NOT NULL,
  `datepublication` datetime NOT NULL DEFAULT current_timestamp(),
  `idarticle` smallint(5) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `datepublication` (`datepublication`),
  KEY `idarticle` (`idarticle`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `redacteur`
--

DROP TABLE IF EXISTS `redacteur`;
CREATE TABLE IF NOT EXISTS `redacteur` (
  `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `passwordhash` char(60) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom` (`nom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
