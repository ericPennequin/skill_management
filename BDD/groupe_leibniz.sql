-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Lun 12 Février 2018 à 16:41
-- Version du serveur :  5.7.21
-- Version de PHP :  7.0.27-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `groupe_leibniz`
--

-- --------------------------------------------------------

--
-- Structure de la table `data`
--

CREATE TABLE `data` (
  `id_data` int(10) UNSIGNED NOT NULL,
  `id_project` int(10) UNSIGNED NOT NULL,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `establishment`
--

CREATE TABLE `establishment` (
  `id_establishment` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `establishment`
--

INSERT INTO `establishment` (`id_establishment`, `name`, `city`) VALUES
(1, ' ', ' '),
(2, 'CEFIM', 'Tours'),
(3, 'PolyTech Tours', 'Tours'),
(4, 'Lycée de Lamotte Beuvron', 'Lamotte Beuvron');

-- --------------------------------------------------------

--
-- Structure de la table `link_project_skill`
--

CREATE TABLE `link_project_skill` (
  `id_project` int(10) UNSIGNED NOT NULL,
  `id_skill` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `link_project_skill`
--

INSERT INTO `link_project_skill` (`id_project`, `id_skill`) VALUES
(1, 1),
(2, 1),
(1, 2),
(2, 3),
(2, 4),
(1, 5),
(1, 6),
(2, 9);

-- --------------------------------------------------------

--
-- Structure de la table `person`
--

CREATE TABLE `person` (
  `id_person` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `cell_number` int(11) DEFAULT NULL,
  `id_establishment` int(10) UNSIGNED NOT NULL,
  `admin` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `picture` blob
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `person`
--

INSERT INTO `person` (`id_person`, `firstname`, `lastname`, `email`, `pwd`, `cell_number`, `id_establishment`, `admin`, `status`, `picture`) VALUES
(1, 'Jean-Lou', 'LEBARS', 'jllebars@cefim.eu', 'jllb', 678912345, 2, 0, 1, NULL),
(2, 'Jean Bernard', 'Le Tekos', 'jbletekos@gmail.com', 'jblt', 606060606, 4, 0, 1, NULL),
(3, 'Charles', 'DeMogency', 'charlesedemogency@demogency.com', 'cdm', 698754321, 3, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `project`
--

CREATE TABLE `project` (
  `id_project` int(10) UNSIGNED NOT NULL,
  `id_establishment` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` longtext,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `project`
--

INSERT INTO `project` (`id_project`, `id_establishment`, `name`, `description`, `status`) VALUES
(1, 2, 'Gestion de compétences', 'Application web de gestion de compétences permettant la consultation de projets et de profils de référents en liens avec les compétences recherchées', 1),
(2, 2, 'Gestion de stages', 'Application web de gestion de stages qui permet la rencontre de personnes en recherche de stages avec des entreprises recherchant des stagiaires', 1);

-- --------------------------------------------------------

--
-- Structure de la table `search`
--

CREATE TABLE `search` (
  `id_search` int(10) UNSIGNED NOT NULL,
  `search` varchar(100) NOT NULL,
  `counter` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `search`
--

INSERT INTO `search` (`id_search`, `search`, `counter`) VALUES
(1, 'Java', 7),
(2, 'PHP', 5),
(3, 'JavaScript', 4),
(4, 'JS', 4),
(5, 'Kahoot', 4),
(6, 'HTML', 3),
(7, 'CSS', 1);

-- --------------------------------------------------------

--
-- Structure de la table `skill`
--

CREATE TABLE `skill` (
  `id_skill` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `skill`
--

INSERT INTO `skill` (`id_skill`, `name`) VALUES
(1, 'Java'),
(2, 'JavaScript'),
(3, 'PHP'),
(4, 'HTML'),
(5, 'CSS'),
(6, 'Symfony'),
(7, 'C'),
(8, 'C++'),
(9, 'SQL'),
(10, 'Kahoot');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id_data`,`id_project`),
  ADD KEY `fk_project_data_idx` (`id_project`);

--
-- Index pour la table `establishment`
--
ALTER TABLE `establishment`
  ADD PRIMARY KEY (`id_establishment`),
  ADD UNIQUE KEY `id_establishment_UNIQUE` (`id_establishment`);

--
-- Index pour la table `link_project_skill`
--
ALTER TABLE `link_project_skill`
  ADD PRIMARY KEY (`id_project`,`id_skill`),
  ADD KEY `fk_skill_person_idx` (`id_skill`);

--
-- Index pour la table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id_person`,`id_establishment`),
  ADD UNIQUE KEY `id_person_UNIQUE` (`id_person`),
  ADD UNIQUE KEY `id_establishment_UNIQUE` (`id_establishment`);

--
-- Index pour la table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id_project`,`id_establishment`),
  ADD KEY `fk_establishment_project_idx` (`id_establishment`);

--
-- Index pour la table `search`
--
ALTER TABLE `search`
  ADD PRIMARY KEY (`id_search`),
  ADD UNIQUE KEY `id_search_UNIQUE` (`id_search`),
  ADD UNIQUE KEY `search_UNIQUE` (`search`);

--
-- Index pour la table `skill`
--
ALTER TABLE `skill`
  ADD PRIMARY KEY (`id_skill`),
  ADD UNIQUE KEY `id_skill_UNIQUE` (`id_skill`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `establishment`
--
ALTER TABLE `establishment`
  MODIFY `id_establishment` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `person`
--
ALTER TABLE `person`
  MODIFY `id_person` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `data`
--
ALTER TABLE `data`
  ADD CONSTRAINT `fk_project_data` FOREIGN KEY (`id_project`) REFERENCES `project` (`id_project`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `link_project_skill`
--
ALTER TABLE `link_project_skill`
  ADD CONSTRAINT `fk_person_skill` FOREIGN KEY (`id_project`) REFERENCES `project` (`id_project`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_skill_person` FOREIGN KEY (`id_skill`) REFERENCES `skill` (`id_skill`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `person`
--
ALTER TABLE `person`
  ADD CONSTRAINT `fk_person_establishment` FOREIGN KEY (`id_establishment`) REFERENCES `establishment` (`id_establishment`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `fk_establishment_project` FOREIGN KEY (`id_establishment`) REFERENCES `establishment` (`id_establishment`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
