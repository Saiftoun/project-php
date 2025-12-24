-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 23 déc. 2025 à 22:25
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
-- Base de données : `signupforms`
--

-- --------------------------------------------------------

--
-- Structure de la table `registration`
--

DROP TABLE IF EXISTS `registration`;
CREATE TABLE IF NOT EXISTS `registration` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `registration`
--

INSERT INTO `registration` (`id`, `username`, `password`) VALUES
(1, 'youssef', '123'),
(2, 'ali', '1234'),
(3, 'mohmed', '12345'),
(4, 'rayan', '123456'),
(5, 'Sara', '12345'),
(6, 'yassir', '111'),
(7, 'sirine', '1236'),
(8, 'yasser', '5666'),
(9, 'youssef1', '$2y$10$xuMLlw.jd4g9MJyurSmLU.zqMvBdfIfz2R4Ekxrcl/5.rXP/5l9jW'),
(10, 'youssef8', '$2y$10$wRJDWfITUa0iWLtaAFHlKeLlXewiMSZFeiF7xeJvE/1HkPlfZJ2oy'),
(11, 'youssef7', '$2y$10$4K7yG4w8P1Q8TXiugS9hMeJIgFhrSYJhw4yfsQEqxXiHbuxCGyR1m'),
(12, 'ahmed', '$2y$10$WvJelOLMalYdhFjYXdQTMenQl7/n9CvhN7UWl64fBCuO4t6WPBVOq'),
(13, 'youssef5', '$2y$10$HWJ86WFLjCQQzPgZMb0dHurzYB7bOYb/Ul/GaJCaHlCl0ihxOsjua'),
(14, 'kkk', '$2y$10$Qjz1D5eV31.CxDwwjvZ8ju3wZTRFfx2tBtuRqKvptJeeryexVVVCi'),
(15, 'youssef4', '$2y$10$sEk0IQAagCiiAoFUVFMPZu3BQ.eES/6SAy66AT04j8ruyVmzbxSRO'),
(16, 'dsv', '$2y$10$Bmrqa80UFK6.IdUUufnRK.8NkHTS604pH7XQGLt1LxYpcUMACLlDK'),
(17, 'sasas', '$2y$10$fxQqbCfsjQtd2levf5zkj.hFE6VWRTwt2EO4SmpPSS29qaS89N8BO'),
(18, '88', '$2y$10$IjPQUcXg4ggblYlhPFqCIuCSNy6jz9vaPcPGHe4qQeJ6qsJWguTiO'),
(19, '77', '$2y$10$rgLJ/YcjlJpXqeRVE/lve.QnPOxCinVn77IUM0Jwzd2tXddDIEU3W'),
(20, 'dd', '$2y$10$sraQzENByizNLqNFk6eo9eFhhw88x5kfTLp8Od4Z11oRyD079KPL.'),
(21, 'f', '$2y$10$IIMFgaqFxh0UylAxPpYAmOuJyZK3fWiXboyxGk3jBlyaIotbgEEDO'),
(22, 'e', '$2y$10$1usZ3CfVChuDLxa.wVsZtOGXIOoH9WLoUQh8gfH4NyGsevWsmJ.sG');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
