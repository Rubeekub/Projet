-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 16 fév. 2024 à 15:46
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
  `id_categorie` int UNSIGNED DEFAULT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `titre` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `ville` varchar(150) NOT NULL,
  `duree_de_publication` int DEFAULT NULL,
  `prix_vente` decimal(10,2) NOT NULL,
  `cout_annonce` decimal(5,2) DEFAULT NULL,
  `date_validation` datetime DEFAULT NULL,
  `date_fin_publication` datetime DEFAULT NULL,
  `date_vente` datetime DEFAULT NULL,
  `publication_validee` tinyint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `annonces`
--

INSERT INTO `annonces` (`id_annonce`, `id_photos`, `id_utilisateur`, `id_categorie`, `date_creation`, `titre`, `description`, `ville`, `duree_de_publication`, `prix_vente`, `cout_annonce`, `date_validation`, `date_fin_publication`, `date_vente`, `publication_validee`) VALUES
(1, NULL, 12, NULL, '2024-02-16 15:00:50', 'fgsd', 'dgdf', 'nice', NULL, '1.00', NULL, NULL, NULL, NULL, NULL),
(2, NULL, 12, NULL, '2024-02-16 15:11:37', 'fgsd', 'dgdf', 'nice', NULL, '1.00', NULL, NULL, NULL, NULL, NULL),
(3, NULL, 12, NULL, '2024-02-16 15:13:37', 'essai', 'vrai', 'nice', NULL, '2.00', NULL, NULL, NULL, NULL, NULL),
(4, NULL, 12, NULL, '2024-02-16 15:20:14', 'essai', 'vrai', 'nice', NULL, '2.00', NULL, NULL, NULL, NULL, NULL),
(5, NULL, 12, NULL, '2024-02-16 15:20:53', 'essai', 'vrai', 'nice', NULL, '5.00', NULL, NULL, NULL, NULL, NULL),
(6, NULL, 12, NULL, '2024-02-16 15:24:04', 'fgsd', 'dgdf', 'nice', NULL, '1.00', NULL, NULL, NULL, NULL, NULL),
(7, NULL, 12, NULL, '2024-02-16 15:24:26', 'fgsd', 'dgdf', 'nice', NULL, '1.00', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `avatars`
--

CREATE TABLE `avatars` (
  `id_avatar` int UNSIGNED NOT NULL,
  `id_utilisateur` int UNSIGNED NOT NULL,
  `path` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `avatars`
--

INSERT INTO `avatars` (`id_avatar`, `id_utilisateur`, `path`) VALUES
(1, 12, 'img/jetee-au-bord-lac-hallstatt-autriche_181624-44201.avif');

-- --------------------------------------------------------

--
-- Structure de la table `cagnotte`
--

CREATE TABLE `cagnotte` (
  `id_cagnotte` int UNSIGNED NOT NULL,
  `#id_utilisateur` int UNSIGNED NOT NULL,
  `somme` float DEFAULT NULL,
  `nom_operation` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id_categorie` int UNSIGNED NOT NULL,
  `nom_categorie` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `immobilier`
--

CREATE TABLE `immobilier` (
  `id_immobilier` int UNSIGNED NOT NULL,
  `#id_categories` int UNSIGNED NOT NULL,
  `nom_annonce` varchar(200) NOT NULL,
  `annee_construction` datetime(4) DEFAULT NULL,
  `nombre_piece` int DEFAULT NULL,
  `garage` tinyint DEFAULT NULL,
  `jardin` tinyint DEFAULT NULL,
  `etage` int DEFAULT NULL,
  `appartement` tinyint DEFAULT NULL,
  `maison` tinyint DEFAULT NULL,
  `ascenseur` tinyint DEFAULT NULL,
  `surface` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id_message` int UNSIGNED NOT NULL,
  `#id_utilisateur` int UNSIGNED NOT NULL,
  `message` varchar(45) NOT NULL,
  `expediteur` varchar(50) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `mode_paiement`
--

CREATE TABLE `mode_paiement` (
  `id_mode_paiement` int UNSIGNED NOT NULL,
  `#id_cagnotte` int UNSIGNED NOT NULL,
  `libelé` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `outils`
--

CREATE TABLE `outils` (
  `id_annonce_outil` int UNSIGNED NOT NULL,
  `#id_cat_outils` int UNSIGNED NOT NULL,
  `nom_outils` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `photos`
--

CREATE TABLE `photos` (
  `id_photo` int UNSIGNED NOT NULL,
  `id_utilisateur` int NOT NULL,
  `path` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `is_main_photo` tinyint DEFAULT '0',
  `legende` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `transactions`
--

CREATE TABLE `transactions` (
  `id_transaction` int UNSIGNED NOT NULL,
  `id_utilisateur` int UNSIGNED NOT NULL,
  `num_operation` varchar(100) NOT NULL,
  `somme` float NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `tutos`
--

CREATE TABLE `tutos` (
  `id_categories_tutos` int UNSIGNED NOT NULL,
  `id_categories` int UNSIGNED NOT NULL,
  `nom_tutos` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id_utilisateur` int UNSIGNED NOT NULL,
  `niv_administration` tinyint NOT NULL DEFAULT '0',
  `pseudo` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `nom` varchar(150) DEFAULT NULL,
  `prenom` varchar(150) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `num_telephone` varchar(20) DEFAULT NULL,
  `adresse_postale` varchar(250) DEFAULT NULL,
  `code_postal` int DEFAULT NULL,
  `ville` varchar(150) DEFAULT NULL,
  `date_inscription` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `token` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `solde_cagnotte` float UNSIGNED DEFAULT NULL,
  `notes_utilisateurs` int DEFAULT NULL,
  `perim` int DEFAULT NULL,
  `actif` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `niv_administration`, `pseudo`, `email`, `password`, `nom`, `prenom`, `date_naissance`, `num_telephone`, `adresse_postale`, `code_postal`, `ville`, `date_inscription`, `token`, `solde_cagnotte`, `notes_utilisateurs`, `perim`, `actif`) VALUES
(11, 0, NULL, 'totyo@toto.bin', '$2y$10$pxz0sK00uT.j9E5/NXsBVeaQ09qmKnWxhXR.TiQ1vwyapZ17F.fau', 'toto', NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-12 12:35:11', NULL, NULL, NULL, NULL, 1),
(12, 0, NULL, 'totyo@ttata.bin', '$2y$10$xMg5HkOin/a/dU.g14M4KeJiTF/jP8.Hrp7FzfLyJgF1MkKkKzE5C', 'tata', NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-16 15:54:16', NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `vehicules`
--

CREATE TABLE `vehicules` (
  `idannonce_vehicules` int UNSIGNED NOT NULL,
  `#id_catetegories` int UNSIGNED NOT NULL,
  `nom_vehicule` varchar(45) NOT NULL,
  `couleurs` varchar(50) DEFAULT NULL,
  `modèle` varchar(45) DEFAULT NULL,
  `annee` datetime(4) DEFAULT NULL,
  `energie` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `vetements`
--

CREATE TABLE `vetements` (
  `id_vetement` int UNSIGNED NOT NULL,
  `#id_categories` int UNSIGNED NOT NULL,
  `nom_vetement` varchar(45) NOT NULL,
  `veste` tinyint DEFAULT NULL,
  `pull` tinyint DEFAULT NULL,
  `taille` varchar(45) DEFAULT NULL,
  `t_shirt` tinyint DEFAULT NULL,
  `robe` tinyint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `annonces`
--
ALTER TABLE `annonces`
  ADD PRIMARY KEY (`id_annonce`),
  ADD KEY `FK3` (`id_utilisateur`),
  ADD KEY `fk_annonces_Categories1` (`id_categorie`),
  ADD KEY `fk_annonces_Photos1` (`id_photos`);

--
-- Index pour la table `avatars`
--
ALTER TABLE `avatars`
  ADD PRIMARY KEY (`id_avatar`),
  ADD KEY `id_utilisateurs` (`id_utilisateur`) USING BTREE;

--
-- Index pour la table `cagnotte`
--
ALTER TABLE `cagnotte`
  ADD PRIMARY KEY (`id_cagnotte`),
  ADD UNIQUE KEY `idmode_paiement_UNIQUE` (`id_cagnotte`),
  ADD KEY `fk_cagnotte_utilisateurs1` (`#id_utilisateur`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_categorie`),
  ADD UNIQUE KEY `id_categorie_UNIQUE` (`id_categorie`);

--
-- Index pour la table `immobilier`
--
ALTER TABLE `immobilier`
  ADD PRIMARY KEY (`id_immobilier`),
  ADD UNIQUE KEY `idannonce_immobilier_UNIQUE` (`id_immobilier`),
  ADD KEY `fk_Immobilier_Categories1` (`#id_categories`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id_message`),
  ADD UNIQUE KEY `id_message_UNIQUE` (`id_message`),
  ADD KEY `fk_messages_utilisateurs1` (`#id_utilisateur`);

--
-- Index pour la table `mode_paiement`
--
ALTER TABLE `mode_paiement`
  ADD PRIMARY KEY (`id_mode_paiement`),
  ADD UNIQUE KEY `idmode_paiement_UNIQUE` (`id_mode_paiement`),
  ADD KEY `fk_mode_paiement_cagnotte1` (`#id_cagnotte`);

--
-- Index pour la table `outils`
--
ALTER TABLE `outils`
  ADD PRIMARY KEY (`id_annonce_outil`),
  ADD UNIQUE KEY `idannonces_outils_UNIQUE` (`id_annonce_outil`),
  ADD KEY `fk_annonce_outils_Categories1` (`#id_cat_outils`);

--
-- Index pour la table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id_photo`),
  ADD KEY `id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id_transaction`),
  ADD KEY `fk_Transactions_Utilisateurs1` (`id_utilisateur`);

--
-- Index pour la table `tutos`
--
ALTER TABLE `tutos`
  ADD PRIMARY KEY (`id_categories_tutos`),
  ADD UNIQUE KEY `idtutos_UNIQUE` (`id_categories_tutos`),
  ADD KEY `fk_tutos_Categories1` (`id_categories`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- Index pour la table `vehicules`
--
ALTER TABLE `vehicules`
  ADD PRIMARY KEY (`idannonce_vehicules`),
  ADD UNIQUE KEY `idannonce_vehicules_UNIQUE` (`idannonce_vehicules`),
  ADD KEY `fk_annonce_vehicules_Categories1` (`#id_catetegories`);

--
-- Index pour la table `vetements`
--
ALTER TABLE `vetements`
  ADD PRIMARY KEY (`id_vetement`),
  ADD KEY `fk_vetements_Categories1` (`#id_categories`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `annonces`
--
ALTER TABLE `annonces`
  MODIFY `id_annonce` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `avatars`
--
ALTER TABLE `avatars`
  MODIFY `id_avatar` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `cagnotte`
--
ALTER TABLE `cagnotte`
  MODIFY `id_cagnotte` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_categorie` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `immobilier`
--
ALTER TABLE `immobilier`
  MODIFY `id_immobilier` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id_message` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `mode_paiement`
--
ALTER TABLE `mode_paiement`
  MODIFY `id_mode_paiement` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `outils`
--
ALTER TABLE `outils`
  MODIFY `id_annonce_outil` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `photos`
--
ALTER TABLE `photos`
  MODIFY `id_photo` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id_transaction` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tutos`
--
ALTER TABLE `tutos`
  MODIFY `id_categories_tutos` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_utilisateur` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `vehicules`
--
ALTER TABLE `vehicules`
  MODIFY `idannonce_vehicules` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `vetements`
--
ALTER TABLE `vetements`
  MODIFY `id_vetement` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `annonces`
--
ALTER TABLE `annonces`
  ADD CONSTRAINT `FK3` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_annonces_Categories1` FOREIGN KEY (`id_categorie`) REFERENCES `categories` (`id_categorie`),
  ADD CONSTRAINT `fk_annonces_Photos1` FOREIGN KEY (`id_photos`) REFERENCES `photos` (`id_photo`);

--
-- Contraintes pour la table `avatars`
--
ALTER TABLE `avatars`
  ADD CONSTRAINT `fk_Avatars_Utilisateurs1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`);

--
-- Contraintes pour la table `cagnotte`
--
ALTER TABLE `cagnotte`
  ADD CONSTRAINT `fk_cagnotte_utilisateurs1` FOREIGN KEY (`#id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`);

--
-- Contraintes pour la table `immobilier`
--
ALTER TABLE `immobilier`
  ADD CONSTRAINT `fk_Immobilier_Categories1` FOREIGN KEY (`#id_categories`) REFERENCES `categories` (`id_categorie`);

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_messages_utilisateurs1` FOREIGN KEY (`#id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`);

--
-- Contraintes pour la table `mode_paiement`
--
ALTER TABLE `mode_paiement`
  ADD CONSTRAINT `fk_mode_paiement_cagnotte1` FOREIGN KEY (`#id_cagnotte`) REFERENCES `cagnotte` (`id_cagnotte`);

--
-- Contraintes pour la table `outils`
--
ALTER TABLE `outils`
  ADD CONSTRAINT `fk_annonce_outils_Categories1` FOREIGN KEY (`#id_cat_outils`) REFERENCES `categories` (`id_categorie`);

--
-- Contraintes pour la table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `fk_Transactions_Utilisateurs1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `tutos`
--
ALTER TABLE `tutos`
  ADD CONSTRAINT `fk_tutos_Categories1` FOREIGN KEY (`id_categories`) REFERENCES `categories` (`id_categorie`);

--
-- Contraintes pour la table `vehicules`
--
ALTER TABLE `vehicules`
  ADD CONSTRAINT `fk_annonce_vehicules_Categories1` FOREIGN KEY (`#id_catetegories`) REFERENCES `categories` (`id_categorie`);

--
-- Contraintes pour la table `vetements`
--
ALTER TABLE `vetements`
  ADD CONSTRAINT `fk_vetements_Categories1` FOREIGN KEY (`#id_categories`) REFERENCES `categories` (`id_categorie`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
