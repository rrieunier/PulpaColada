-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 03, 2018 at 10:59 PM
-- Server version: 5.6.38
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `PulpaColada`
--
CREATE DATABASE IF NOT EXISTS `PulpaColada`
  DEFAULT CHARACTER SET utf8
  COLLATE utf8_general_ci;
USE `PulpaColada`;

-- --------------------------------------------------------

--
-- Table structure for table `ADHERENT`
--

CREATE TABLE `ADHERENT` (
  `id`          INT(11)     NOT NULL,
  `prenom`      VARCHAR(20) NOT NULL,
  `nom`         VARCHAR(50) NOT NULL,
  `promo`       INT(11)     NOT NULL DEFAULT '0',
  `commentaire` TEXT
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ADMIN`
--

CREATE TABLE `ADMIN` (
  `id`         INT(11)      NOT NULL,
  `email`      VARCHAR(100) NOT NULL,
  `mdp`        CHAR(64) DEFAULT NULL,
  `prenom`     VARCHAR(20)  NOT NULL,
  `nom`        VARCHAR(50)  NOT NULL,
  `poste`      VARCHAR(30)  NOT NULL,
  `photo`      BLOB,
  `couverture` BLOB,
  `bio`        TEXT
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `AFFINITE`
--

CREATE TABLE `AFFINITE` (
  `joueur`      INT(11) NOT NULL,
  `joueurVoulu` INT(11) NOT NULL
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `EQUIPE`
--

CREATE TABLE `EQUIPE` (
  `numero`   INT(11)   NOT NULL,
  `nom`      VARCHAR(30)    DEFAULT NULL,
  `heureFin` TIMESTAMP NULL DEFAULT NULL
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `EVENEMENT`
--

CREATE TABLE `EVENEMENT` (
  `id`          INT(11)      NOT NULL,
  `nom`         VARCHAR(100) NOT NULL,
  `debut`       TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fin`         TIMESTAMP    NULL     DEFAULT NULL,
  `description` TEXT         NOT NULL
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `JOUEUR`
--

CREATE TABLE `JOUEUR` (
  `id`          INT(11)      NOT NULL,
  `email`       VARCHAR(100) NOT NULL,
  `prenom`      VARCHAR(30)  NOT NULL,
  `nom`         VARCHAR(50)  NOT NULL,
  `surnom`      VARCHAR(20)  NOT NULL,
  `heureZombie` TIMESTAMP    NULL DEFAULT NULL,
  `heureMort`   TIMESTAMP    NULL DEFAULT NULL,
  `equipe`      INT(11)           DEFAULT NULL
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ADHERENT`
--
ALTER TABLE `ADHERENT`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ADMIN`
--
ALTER TABLE `ADMIN`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `AFFINITE`
--
ALTER TABLE `AFFINITE`
  ADD PRIMARY KEY (`joueur`, `joueurVoulu`),
  ADD KEY `joueur2` (`joueurVoulu`);

--
-- Indexes for table `EQUIPE`
--
ALTER TABLE `EQUIPE`
  ADD PRIMARY KEY (`numero`);

--
-- Indexes for table `EVENEMENT`
--
ALTER TABLE `EVENEMENT`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom` (`nom`);

--
-- Indexes for table `JOUEUR`
--
ALTER TABLE `JOUEUR`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `surnom` (`surnom`),
  ADD UNIQUE KEY `prenom` (`prenom`, `nom`),
  ADD KEY `equipe` (`equipe`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ADHERENT`
--
ALTER TABLE `ADHERENT`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ADMIN`
--
ALTER TABLE `ADMIN`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EQUIPE`
--
ALTER TABLE `EQUIPE`
  MODIFY `numero` INT(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EVENEMENT`
--
ALTER TABLE `EVENEMENT`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `JOUEUR`
--
ALTER TABLE `JOUEUR`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `AFFINITE`
--
ALTER TABLE `AFFINITE`
  ADD CONSTRAINT `joueur1` FOREIGN KEY (`joueur`) REFERENCES `JOUEUR` (`id`),
  ADD CONSTRAINT `joueur2` FOREIGN KEY (`joueurVoulu`) REFERENCES `JOUEUR` (`id`);

--
-- Constraints for table `JOUEUR`
--
ALTER TABLE `JOUEUR`
  ADD CONSTRAINT `equipe` FOREIGN KEY (`equipe`) REFERENCES `EQUIPE` (`numero`);

# Privileges for `valhalla`@`localhost`

GRANT ALL PRIVILEGES ON PulpaColada.* TO 'valhalla'@'localhost'
IDENTIFIED BY PASSWORD '*49EDC878BA92F1D5B46DB8428F9394B094DB712F'
WITH GRANT OPTION;