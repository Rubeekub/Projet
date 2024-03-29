-- MySQL Script generated by MySQL Workbench
-- Fri Feb  9 12:30:33 2024
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema projet_annonces
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `projet_annonces` ;

-- -----------------------------------------------------
-- Schema projet_annonces
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `projet_annonces` DEFAULT CHARACTER SET utf8 ;
USE `projet_annonces` ;

-- -----------------------------------------------------
-- Table `projet_annonces`.`utilisateurs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projet_annonces`.`utilisateurs` ;

CREATE TABLE IF NOT EXISTS `projet_annonces`.`utilisateurs` (
  `id_utilisateur` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `niv_administration` TINYINT NOT NULL DEFAULT 0,
  `pseudo` VARCHAR(150) NOT NULL,
  `email` VARCHAR(250) NOT NULL,
  `mdp_hash` VARCHAR(250) NOT NULL,
  `nom` VARCHAR(150) NULL,
  `prenom` VARCHAR(150) NULL,
  `date_naissance` DATE NULL,
  `num_telephone` VARCHAR(20) NULL,
  `adresse_postale` VARCHAR(250) NULL,
  `code_postal` INT NULL,
  `ville` VARCHAR(150) NULL,
  `date_inscription` DATETIME NOT NULL DEFAULT NOW(),
  `token` VARCHAR(250) NOT NULL,
  `date_validite_token` DATETIME NOT NULL,
  `solde_cagnotte` FLOAT UNSIGNED NULL,
  `url_avatar` VARCHAR(250) NOT NULL,
  `notes_utilisateurs` INT NULL,
  `reset_token` VARCHAR(250) NULL,
  `perim` INT NOT NULL,
  `actif` TINYINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_utilisateur`));


-- -----------------------------------------------------
-- Table `projet_annonces`.`categories`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projet_annonces`.`categories` ;

CREATE TABLE IF NOT EXISTS `projet_annonces`.`categories` (
  `id_categorie` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom_categorie` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`id_categorie`));

CREATE UNIQUE INDEX `id_categorie_UNIQUE` ON `projet_annonces`.`categories` (`id_categorie` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `projet_annonces`.`photos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projet_annonces`.`photos` ;

CREATE TABLE IF NOT EXISTS `projet_annonces`.`photos` (
  `id_photo` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `url_photo` VARCHAR(250) NOT NULL,
  `is_main_photo` TINYINT NULL DEFAULT 0,
  `legende` VARCHAR(150) NULL,
  PRIMARY KEY (`id_photo`));


-- -----------------------------------------------------
-- Table `projet_annonces`.`annonces`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projet_annonces`.`annonces` ;

CREATE TABLE IF NOT EXISTS `projet_annonces`.`annonces` (
  `id_annonce` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_photos` INT UNSIGNED NOT NULL,
  `id_utilisateurs` INT UNSIGNED NOT NULL,
  `id_categories` INT UNSIGNED NOT NULL,
  `date_creation` DATETIME NOT NULL,
  `titre` VARCHAR(150) NOT NULL,
  `description` TEXT NOT NULL,
  `duree_de_publication` INT NOT NULL,
  `prix_vente` DECIMAL(19,4) NULL DEFAULT NULL,
  `cout_annonce` DECIMAL(19,4) NULL DEFAULT NULL,
  `date_validation` DATETIME NULL DEFAULT NULL,
  `date_fin_publication` DATETIME NULL DEFAULT NULL,
  `date_vente` DATETIME NULL DEFAULT NULL,
  `publication_validee` TINYINT NULL,
  PRIMARY KEY (`id_annonce`),
  CONSTRAINT `FK3`
    FOREIGN KEY (`id_utilisateurs`)
    REFERENCES `projet_annonces`.`utilisateurs` (`id_utilisateur`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_annonces_Categories1`
    FOREIGN KEY (`id_categories`)
    REFERENCES `projet_annonces`.`categories` (`id_categorie`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_annonces_Photos1`
    FOREIGN KEY (`id_photos`)
    REFERENCES `projet_annonces`.`photos` (`id_photo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE UNIQUE INDEX `id_annonce_UNIQUE` ON `projet_annonces`.`annonces` (`id_annonce` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `projet_annonces`.`transactions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projet_annonces`.`transactions` ;

CREATE TABLE IF NOT EXISTS `projet_annonces`.`transactions` (
  `id_transaction` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_utilisateur` INT UNSIGNED NOT NULL,
  `num_operation` VARCHAR(100) NOT NULL,
  `somme` FLOAT NOT NULL,
  `date` DATETIME NOT NULL,
  PRIMARY KEY (`id_transaction`),
  CONSTRAINT `fk_Transactions_Utilisateurs1`
    FOREIGN KEY (`id_utilisateur`)
    REFERENCES `projet_annonces`.`utilisateurs` (`id_utilisateur`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projet_annonces`.`cagnotte`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projet_annonces`.`cagnotte` ;

CREATE TABLE IF NOT EXISTS `projet_annonces`.`cagnotte` (
  `id_cagnotte` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `#id_utilisateur` INT UNSIGNED NOT NULL,
  `somme` FLOAT NULL,
  `nom_operation` VARCHAR(45) NULL,
  PRIMARY KEY (`id_cagnotte`),
  CONSTRAINT `fk_cagnotte_utilisateurs1`
    FOREIGN KEY (`#id_utilisateur`)
    REFERENCES `projet_annonces`.`utilisateurs` (`id_utilisateur`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE UNIQUE INDEX `idmode_paiement_UNIQUE` ON `projet_annonces`.`cagnotte` (`id_cagnotte` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `projet_annonces`.`mode_paiement`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projet_annonces`.`mode_paiement` ;

CREATE TABLE IF NOT EXISTS `projet_annonces`.`mode_paiement` (
  `id_mode_paiement` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `#id_cagnotte` INT UNSIGNED NOT NULL,
  `libelé` INT NULL,
  PRIMARY KEY (`id_mode_paiement`),
  CONSTRAINT `fk_mode_paiement_cagnotte1`
    FOREIGN KEY (`#id_cagnotte`)
    REFERENCES `projet_annonces`.`cagnotte` (`id_cagnotte`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE UNIQUE INDEX `idmode_paiement_UNIQUE` ON `projet_annonces`.`mode_paiement` (`id_mode_paiement` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `projet_annonces`.`messages`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projet_annonces`.`messages` ;

CREATE TABLE IF NOT EXISTS `projet_annonces`.`messages` (
  `id_message` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `#id_utilisateur` INT UNSIGNED NOT NULL,
  `message` VARCHAR(45) NOT NULL,
  `expediteur` VARCHAR(50) NOT NULL,
  `date` DATETIME NOT NULL,
  PRIMARY KEY (`id_message`),
  CONSTRAINT `fk_messages_utilisateurs1`
    FOREIGN KEY (`#id_utilisateur`)
    REFERENCES `projet_annonces`.`utilisateurs` (`id_utilisateur`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `id_message_UNIQUE` ON `projet_annonces`.`messages` (`id_message` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `projet_annonces`.`immobilier`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projet_annonces`.`immobilier` ;

CREATE TABLE IF NOT EXISTS `projet_annonces`.`immobilier` (
  `id_immobilier` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `#id_categories` INT UNSIGNED NOT NULL,
  `nom_annonce` VARCHAR(200) NOT NULL,
  `annee_construction` DATETIME(4) NULL,
  `nombre_piece` INT(2) NULL,
  `garage` TINYINT NULL,
  `jardin` TINYINT NULL,
  `etage` INT(2) NULL DEFAULT NULL,
  `appartement` TINYINT NULL,
  `maison` TINYINT NULL,
  `ascenseur` TINYINT NULL,
  `surface` INT(5) NULL,
  PRIMARY KEY (`id_immobilier`),
  CONSTRAINT `fk_Immobilier_Categories1`
    FOREIGN KEY (`#id_categories`)
    REFERENCES `projet_annonces`.`categories` (`id_categorie`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `idannonce_immobilier_UNIQUE` ON `projet_annonces`.`immobilier` (`id_immobilier` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `projet_annonces`.`vehicules`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projet_annonces`.`vehicules` ;

CREATE TABLE IF NOT EXISTS `projet_annonces`.`vehicules` (
  `idannonce_vehicules` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `#id_catetegories` INT UNSIGNED NOT NULL,
  `nom_vehicule` VARCHAR(45) NOT NULL,
  `couleurs` VARCHAR(50) NULL,
  `modèle` VARCHAR(45) NULL,
  `annee` DATETIME(4) NULL,
  `energie` VARCHAR(45) NULL,
  PRIMARY KEY (`idannonce_vehicules`),
  CONSTRAINT `fk_annonce_vehicules_Categories1`
    FOREIGN KEY (`#id_catetegories`)
    REFERENCES `projet_annonces`.`categories` (`id_categorie`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `idannonce_vehicules_UNIQUE` ON `projet_annonces`.`vehicules` (`idannonce_vehicules` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `projet_annonces`.`vetements`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projet_annonces`.`vetements` ;

CREATE TABLE IF NOT EXISTS `projet_annonces`.`vetements` (
  `id_vetement` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `#id_categories` INT UNSIGNED NOT NULL,
  `nom_vetement` VARCHAR(45) NOT NULL,
  `veste` TINYINT NULL,
  `pull` TINYINT NULL,
  `taille` VARCHAR(45) NULL,
  `t_shirt` TINYINT NULL,
  `robe` TINYINT NULL,
  PRIMARY KEY (`id_vetement`),
  CONSTRAINT `fk_vetements_Categories1`
    FOREIGN KEY (`#id_categories`)
    REFERENCES `projet_annonces`.`categories` (`id_categorie`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projet_annonces`.`outils`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projet_annonces`.`outils` ;

CREATE TABLE IF NOT EXISTS `projet_annonces`.`outils` (
  `id_annonce_outil` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `#id_cat_outils` INT UNSIGNED NOT NULL,
  `nom_outils` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_annonce_outil`),
  CONSTRAINT `fk_annonce_outils_Categories1`
    FOREIGN KEY (`#id_cat_outils`)
    REFERENCES `projet_annonces`.`categories` (`id_categorie`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `idannonces_outils_UNIQUE` ON `projet_annonces`.`outils` (`id_annonce_outil` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `projet_annonces`.`tutos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projet_annonces`.`tutos` ;

CREATE TABLE IF NOT EXISTS `projet_annonces`.`tutos` (
  `id_categories_tutos` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_categories` INT UNSIGNED NOT NULL,
  `nom_tutos` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`id_categories_tutos`),
  CONSTRAINT `fk_tutos_Categories1`
    FOREIGN KEY (`id_categories`)
    REFERENCES `projet_annonces`.`categories` (`id_categorie`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `idtutos_UNIQUE` ON `projet_annonces`.`tutos` (`id_categories_tutos` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `projet_annonces`.`avatars`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projet_annonces`.`avatars` ;

CREATE TABLE IF NOT EXISTS `projet_annonces`.`avatars` (
  `id_avatars` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_utilisateurs` INT UNSIGNED NOT NULL,
  `cheminacces` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`id_avatars`),
  CONSTRAINT `fk_Avatars_Utilisateurs1`
    FOREIGN KEY (`id_utilisateurs`)
    REFERENCES `projet_annonces`.`utilisateurs` (`id_utilisateur`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `idAvatars_UNIQUE` ON `projet_annonces`.`avatars` (`id_avatars` ASC) VISIBLE;

CREATE UNIQUE INDEX `id_utilisateurs_UNIQUE` ON `projet_annonces`.`avatars` (`id_utilisateurs` ASC) VISIBLE;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
petites_annoncesprojet_annonces