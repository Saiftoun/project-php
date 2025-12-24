-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 24 déc. 2025 à 14:12
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
-- Base de données : `project1`
--

-- --------------------------------------------------------

--
-- Structure de la table `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE IF NOT EXISTS `brands` (
  `id` int NOT NULL AUTO_INCREMENT,
  `brand_title` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `brands`
--

INSERT INTO `brands` (`id`, `brand_title`, `created_at`) VALUES
(1, 'HelloFresh', '2025-12-05 02:36:03'),
(2, 'Picard ', '2025-12-05 02:36:03'),
(3, 'Ocean Spray\n', '2025-12-05 02:36:03'),
(4, 'Innocent\nWeight Watchers\n', '2025-12-05 02:36:03'),
(5, 'Amy\'s Kitchen\n', '2025-12-05 02:36:03'),
(6, 'DoleNaturalia', '2025-12-19 01:04:06');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_title` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `category_title`, `created_at`) VALUES
(1, 'Végétarien\n', '2025-12-05 02:35:52'),
(2, 'Sans gluten\n', '2025-12-05 02:35:52'),
(3, 'Sans lactose\n', '2025-12-05 02:35:52'),
(4, 'Paléo', '2025-12-05 02:35:52'),
(5, 'Keto ', '2025-12-05 02:35:52'),
(6, 'Vegan', '2025-12-19 00:38:42'),
(7, 'Jus', '2025-12-20 21:13:03');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_title` varchar(255) NOT NULL,
  `product_description` text NOT NULL,
  `product_keyword` varchar(255) NOT NULL,
  `category_id` int NOT NULL,
  `brand_id` int NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `brand_id` (`brand_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `product_title`, `product_description`, `product_keyword`, `category_id`, `brand_id`, `product_image`, `product_price`, `created_at`) VALUES
(1, 'Jus de Fraise', 'Bon', 'Fraise', 7, 4, 'jus de fraise.jpg', 50.00, '2025-12-20 22:51:46'),
(2, 'Jus de kiwi', 'bonne', 'kiwi', 7, 1, 'jus de kiwi.jpg', 7.00, '2025-12-20 23:24:59'),
(3, 'Jus de melon', 'Bonne', 'melon', 7, 4, 'jus-de-melon.jpg', 10.00, '2025-12-21 00:21:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
