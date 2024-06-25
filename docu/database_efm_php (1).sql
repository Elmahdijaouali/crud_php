-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 25 juin 2024 à 19:55
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `database_efm_php`
--

-- --------------------------------------------------------

--
-- Structure de la table `description_voyage`
--

CREATE TABLE `description_voyage` (
  `codeDesc` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `villeD` varchar(255) DEFAULT NULL,
  `villeA` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `description_voyage`
--

INSERT INTO `description_voyage` (`codeDesc`, `description`, `villeD`, `villeA`) VALUES
(4, 'voyage with friends', 'azemmor ', 'rebat '),
(5, 'voyage avec la famille ', 'azemmor ', 'tanga'),
(6, 'voyage ', 'Eljadida', 'Marrakech ');

-- --------------------------------------------------------

--
-- Structure de la table `employe`
--

CREATE TABLE `employe` (
  `codeEmp` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `fonction` varchar(255) DEFAULT NULL,
  `user` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `idgroup` int(11) NOT NULL DEFAULT 0,
  `gender` varchar(20) NOT NULL,
  `photo_profile` text NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `employe`
--

INSERT INTO `employe` (`codeEmp`, `nom`, `fonction`, `user`, `pwd`, `idgroup`, `gender`, `photo_profile`, `date_creation`) VALUES
(6, 'mehdi', 'developer full stack ', 'admin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1, 'homme', '1707397903281lhh0nb2w.png', '2024-06-16 08:11:29'),
(7, 'Mohamed jouali', 'developer front end ', 'joualimohamed12', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 0, 'homme', 'téléchargement (9).jpg', '2024-06-16 14:05:45'),
(8, 'brahim', 'developer', 'brahim024', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 0, 'homme', 'download.jpeg', '2024-06-16 23:18:15'),
(9, 'employe', 'testing', 'employe', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 0, 'homme', 'téléchargement (1).jpg', '2024-06-16 23:25:39'),
(10, 'test', 'testing', 'testemploye', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 0, 'homme', '', '2024-06-19 09:53:44');

-- --------------------------------------------------------

--
-- Structure de la table `inscription`
--

CREATE TABLE `inscription` (
  `codeInsc` int(11) NOT NULL,
  `codeEmp` int(11) DEFAULT NULL,
  `codeVoyage` int(11) DEFAULT NULL,
  `nbrePers` int(11) DEFAULT NULL,
  `dateVoy` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `inscription`
--

INSERT INTO `inscription` (`codeInsc`, `codeEmp`, `codeVoyage`, `nbrePers`, `dateVoy`) VALUES
(28, 9, NULL, 10, '2024-06-05');

-- --------------------------------------------------------

--
-- Structure de la table `transport`
--

CREATE TABLE `transport` (
  `codeTrans` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `vitesse` int(11) DEFAULT NULL,
  `nbrPlace` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `transport`
--

INSERT INTO `transport` (`codeTrans`, `type`, `vitesse`, `nbrPlace`) VALUES
(1, 'bus', 360, 900),
(2, 'car', 80, 30),
(3, 'big_bus', 40, 60);

-- --------------------------------------------------------

--
-- Structure de la table `voyage`
--

CREATE TABLE `voyage` (
  `codeVoyage` int(11) NOT NULL,
  `codeTrans` int(11) DEFAULT NULL,
  `codeDesc` int(11) DEFAULT NULL,
  `prixTicket` int(11) DEFAULT NULL,
  `duree` time DEFAULT NULL,
  `heureDepart` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `voyage`
--

INSERT INTO `voyage` (`codeVoyage`, `codeTrans`, `codeDesc`, `prixTicket`, `duree`, `heureDepart`) VALUES
(7, 2, 5, 300, '05:00:00', '08:57:22'),
(10, 1, 6, 25, '02:39:00', '15:39:00');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `description_voyage`
--
ALTER TABLE `description_voyage`
  ADD PRIMARY KEY (`codeDesc`);

--
-- Index pour la table `employe`
--
ALTER TABLE `employe`
  ADD PRIMARY KEY (`codeEmp`);

--
-- Index pour la table `inscription`
--
ALTER TABLE `inscription`
  ADD PRIMARY KEY (`codeInsc`),
  ADD KEY `codeEmp` (`codeEmp`),
  ADD KEY `codeVoyage` (`codeVoyage`);

--
-- Index pour la table `transport`
--
ALTER TABLE `transport`
  ADD PRIMARY KEY (`codeTrans`);

--
-- Index pour la table `voyage`
--
ALTER TABLE `voyage`
  ADD PRIMARY KEY (`codeVoyage`),
  ADD KEY `codeTrans` (`codeTrans`),
  ADD KEY `codeDesc` (`codeDesc`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `description_voyage`
--
ALTER TABLE `description_voyage`
  MODIFY `codeDesc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `employe`
--
ALTER TABLE `employe`
  MODIFY `codeEmp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `inscription`
--
ALTER TABLE `inscription`
  MODIFY `codeInsc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `transport`
--
ALTER TABLE `transport`
  MODIFY `codeTrans` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `voyage`
--
ALTER TABLE `voyage`
  MODIFY `codeVoyage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `inscription`
--
ALTER TABLE `inscription`
  ADD CONSTRAINT `inscription_ibfk_1` FOREIGN KEY (`codeEmp`) REFERENCES `employe` (`codeEmp`),
  ADD CONSTRAINT `inscription_ibfk_2` FOREIGN KEY (`codeVoyage`) REFERENCES `voyage` (`codeVoyage`);

--
-- Contraintes pour la table `voyage`
--
ALTER TABLE `voyage`
  ADD CONSTRAINT `voyage_ibfk_1` FOREIGN KEY (`codeTrans`) REFERENCES `transport` (`codeTrans`),
  ADD CONSTRAINT `voyage_ibfk_2` FOREIGN KEY (`codeDesc`) REFERENCES `description_voyage` (`codeDesc`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
