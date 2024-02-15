-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 15 fév. 2024 à 15:50
-- Version du serveur : 8.0.30
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet_annonces`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonces`
--

CREATE TABLE `annonces` (
  `id_annonce` int UNSIGNED NOT NULL,
  `id_photos` int UNSIGNED DEFAULT NULL,
  `id_utilisateur` int UNSIGNED NOT NULL,
  `id_categories` int UNSIGNED DEFAULT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `titre` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `ville` varchar(150) NOT NULL,
  `duree_de_publication` int DEFAULT NULL,
  `prix_vente` decimal(19,4) DEFAULT NULL,
  `cout_annonce` decimal(19,4) DEFAULT NULL,
  `date_validation` datetime DEFAULT NULL,
  `date_fin_publication` datetime DEFAULT NULL,
  `date_vente` datetime DEFAULT NULL,
  `publication_validee` tinyint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `annonces`
--

INSERT INTO `annonces` (`id_annonce`, `id_photos`, `id_utilisateur`, `id_categories`, `date_creation`, `titre`, `description`, `ville`, `duree_de_publication`, `prix_vente`, `cout_annonce`, `date_validation`, `date_fin_publication`, `date_vente`, `publication_validee`) VALUES
(1, NULL, 11, NULL, '2024-02-15 15:48:08', 'fgsd', 'dgdf', 'nice', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `annonces`
--
ALTER TABLE `annonces`
  ADD PRIMARY KEY (`id_annonce`),
  ADD KEY `FK3` (`id_utilisateur`),
  ADD KEY `fk_annonces_Categories1` (`id_categories`),
  ADD KEY `fk_annonces_Photos1` (`id_photos`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `annonces`
--
ALTER TABLE `annonces`
  MODIFY `id_annonce` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `annonces`
--
ALTER TABLE `annonces`
  ADD CONSTRAINT `FK3` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_annonces_Categories1` FOREIGN KEY (`id_categories`) REFERENCES `categories` (`id_categorie`),
  ADD CONSTRAINT `fk_annonces_Photos1` FOREIGN KEY (`id_photos`) REFERENCES `photos` (`id_photo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
