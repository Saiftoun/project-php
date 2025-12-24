-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 23 déc. 2025 à 21:50
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `crudoperation`
--

-- --------------------------------------------------------

--
-- Structure de la table `crud`
--

DROP TABLE IF EXISTS `crud`;
CREATE TABLE IF NOT EXISTS `crud` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `crud`
--

INSERT INTO `crud` (`id`, `name`, `email`, `mobile`, `password`) VALUES
(19, 'fatma', 'fatma@gmail.com', '12345678', '$2y$10$NJQU6u72PseWvGpw18iZj.xNr0dAJZRi2HEAcS65KOZuPVKV0DhZC'),
(12, 'd', 'd@d', '1', '$2y$10$Guh/6SM6xPAoC0m/5I08RO2UbGYOQi4wx0nl3NIYyKWWp8GjYrwoW'),
(16, 'ss', 's@g', '123', '$2y$10$nqUoplnvnn25XNQJkMlYvuxNZZy92yuDuabZI4ys2qXfGVDrM8CKW'),
(17, 'ffd', 'fddfg@fdgd', '122', '$2y$10$8d/v8affzVtB1LrJLue6VOw2Je8H3OwXDqRpk4Sps0Xs66blLtpVK'),
(18, 'sasa', 'sa@gma', '55', '$2y$10$fV.iqSgkPvDKNBZ4mEJP7ujOkMb.aJAGIPgTTPsnIh/NurYVr8hJC');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
