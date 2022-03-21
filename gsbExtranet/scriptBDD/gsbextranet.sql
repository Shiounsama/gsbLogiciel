-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 27 sep. 2021 à 14:28
-- Version du serveur :  8.0.21
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gsbextranet`
--

-- --------------------------------------------------------

--
-- Structure de la table `historiqueconnexion`
--

DROP TABLE IF EXISTS `historiqueconnexion`;
CREATE TABLE IF NOT EXISTS `historiqueconnexion` (
  `idMedecin` int NOT NULL,
  `dateDebutLog` datetime NOT NULL,
  `dateFinLog` datetime DEFAULT NULL,
  PRIMARY KEY (`idMedecin`,`dateDebutLog`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `historiqueconnexion`
--

INSERT INTO `historiqueconnexion` (`idMedecin`, `dateDebutLog`, `dateFinLog`) VALUES
(7, '2021-09-24 17:21:32', '2021-09-24 17:21:32'),
(8, '2021-09-24 17:23:21', '2021-09-24 17:23:21'),
(8, '2021-09-24 17:24:27', '2021-09-24 17:24:27');

-- --------------------------------------------------------

--
-- Structure de la table `maintenance`
--

DROP TABLE IF EXISTS `maintenance`;
CREATE TABLE IF NOT EXISTS `maintenance` (
  `id` int NOT NULL AUTO_INCREMENT,
  `informations` varchar(255) DEFAULT NULL,
  `dateDebut` date DEFAULT NULL,
  `dateFin` date DEFAULT NULL,
  `actif` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `maintenance`
--

INSERT INTO `maintenance` (`id`, `informations`, `dateDebut`, `dateFin`, `actif`) VALUES
(1, 'Bonjour, notre site est actuellement en cours de maintenance.', '2021-09-22', '2021-09-24', 0);

-- --------------------------------------------------------

--
-- Structure de la table `maintenanceprevention`
--

DROP TABLE IF EXISTS `maintenanceprevention`;
CREATE TABLE IF NOT EXISTS `maintenanceprevention` (
  `id` int NOT NULL AUTO_INCREMENT,
  `informations` varchar(255) DEFAULT NULL,
  `dateDebut` date DEFAULT NULL,
  `dateFin` date DEFAULT NULL,
  `actif` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `maintenanceprevention`
--

INSERT INTO `maintenanceprevention` (`id`, `informations`, `dateDebut`, `dateFin`, `actif`) VALUES
(1, 'Bonjour, l\'équipe GSB procédera à une maintenance de notre site', '2021-09-16', '2021-09-17', 0);

-- --------------------------------------------------------

--
-- Structure de la table `medecin`
--

DROP TABLE IF EXISTS `medecin`;
CREATE TABLE IF NOT EXISTS `medecin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(40) DEFAULT NULL,
  `prenom` varchar(30) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `dateNaissance` year DEFAULT NULL,
  `motDePasse` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `dateCreation` datetime DEFAULT NULL,
  `rpps` varchar(10) DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  `dateDiplome` year DEFAULT NULL,
  `dateConsentement` date DEFAULT NULL,
  `access` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `medecin`
--

INSERT INTO `medecin` (`id`, `nom`, `prenom`, `mail`, `dateNaissance`, `motDePasse`, `dateCreation`, `rpps`, `token`, `dateDiplome`, `dateConsentement`, `access`) VALUES
(7, 'Auque', 'Fabien', 'fabien.auque@gmail.com', NULL, '488f7691a83b4eea14e8b8651fd9a6e4', '2021-09-24 17:21:32', NULL, NULL, NULL, '2021-09-24', 0),
(8, 'ADMIN', 'ADMIN', 'fabien.auque.admin@gmail.com', NULL, '488f7691a83b4eea14e8b8651fd9a6e4', '2021-09-24 17:23:19', NULL, NULL, NULL, '2021-09-24', 1);

-- --------------------------------------------------------

--
-- Structure de la table `medecinproduit`
--

DROP TABLE IF EXISTS `medecinproduit`;
CREATE TABLE IF NOT EXISTS `medecinproduit` (
  `idMedecin` int NOT NULL,
  `idProduit` int NOT NULL,
  `Date` date NOT NULL,
  `Heure` time NOT NULL,
  PRIMARY KEY (`idMedecin`,`idProduit`,`Date`,`Heure`),
  KEY `idProduit` (`idProduit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `medecinvisio`
--

DROP TABLE IF EXISTS `medecinvisio`;
CREATE TABLE IF NOT EXISTS `medecinvisio` (
  `idMedecin` int NOT NULL,
  `idVisio` int NOT NULL,
  `dateInscription` date NOT NULL,
  PRIMARY KEY (`idMedecin`,`idVisio`),
  KEY `idVisio` (`idVisio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id` int NOT NULL,
  `nom` varchar(60) NOT NULL,
  `objectif` mediumtext NOT NULL,
  `information` mediumtext NOT NULL,
  `effetIndesirable` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `visioconference`
--

DROP TABLE IF EXISTS `visioconference`;
CREATE TABLE IF NOT EXISTS `visioconference` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nomVisio` varchar(100) DEFAULT NULL,
  `objectif` text,
  `url` varchar(100) DEFAULT NULL,
  `dateVisio` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `historiqueconnexion`
--
ALTER TABLE `historiqueconnexion`
  ADD CONSTRAINT `historiqueconnexion_ibfk_1` FOREIGN KEY (`idMedecin`) REFERENCES `medecin` (`id`);

--
-- Contraintes pour la table `medecinproduit`
--
ALTER TABLE `medecinproduit`
  ADD CONSTRAINT `medecinproduit_ibfk_1` FOREIGN KEY (`idMedecin`) REFERENCES `medecin` (`id`),
  ADD CONSTRAINT `medecinproduit_ibfk_2` FOREIGN KEY (`idProduit`) REFERENCES `produit` (`id`);

--
-- Contraintes pour la table `medecinvisio`
--
ALTER TABLE `medecinvisio`
  ADD CONSTRAINT `medecinvisio_ibfk_1` FOREIGN KEY (`idMedecin`) REFERENCES `medecin` (`id`),
  ADD CONSTRAINT `medecinvisio_ibfk_2` FOREIGN KEY (`idVisio`) REFERENCES `visioconference` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
