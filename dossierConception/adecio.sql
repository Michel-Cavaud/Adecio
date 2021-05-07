-- phpMyAdmin SQL Dump
-- version 4.6.6deb4+deb9u2
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Ven 07 Mai 2021 à 09:00
-- Version du serveur :  10.1.48-MariaDB-0+deb9u1
-- Version de PHP :  7.3.27-9+0~20210227.82+debian9~1.gbpa4a3d6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `adecio`
--
CREATE DATABASE IF NOT EXISTS `adecio` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `adecio`;

-- --------------------------------------------------------

--
-- Structure de la table `admin_articles`
--

CREATE TABLE `admin_articles` (
  `id_admin_articles` int(11) NOT NULL,
  `articles_admin_articles` text,
  `position_admin_articles` tinyint(4) NOT NULL,
  `id_pages` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `admin_images`
--

CREATE TABLE `admin_images` (
  `id_admin_images` int(11) NOT NULL,
  `nom_admin_images` varchar(50) DEFAULT NULL,
  `ext_admin_images` varchar(10) DEFAULT NULL,
  `position_admin_images` smallint(6) DEFAULT NULL,
  `id_pages` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id_articles` int(11) NOT NULL,
  `article_articles` text,
  `position_articles` smallint(6) DEFAULT NULL,
  `id_pages` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE `images` (
  `id_images` int(11) NOT NULL,
  `nom_images` varchar(50) DEFAULT NULL,
  `ext_images` varchar(10) DEFAULT NULL,
  `position_images` smallint(6) DEFAULT NULL,
  `id_pages` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `pages`
--

CREATE TABLE `pages` (
  `id_pages` int(11) NOT NULL,
  `nom_pages` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id_utilisateurs` int(11) NOT NULL,
  `pseudo_utilisateurs` varchar(100) NOT NULL,
  `email_utilisateurs` varchar(150) NOT NULL,
  `mdp_utilisateurs` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_articles_page`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `view_articles_page` (
`articles` text
,`position` smallint(6)
,`pages` varchar(50)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_articles_page_admin`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `view_articles_page_admin` (
`articles` text
,`position` tinyint(4)
,`pages` varchar(50)
,`idpage` int(11)
,`id_articles` int(11)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_images_page`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `view_images_page` (
`nom` varchar(50)
,`ext` varchar(10)
,`position` smallint(6)
,`pages` varchar(50)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_images_page_admin`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `view_images_page_admin` (
`nom` varchar(50)
,`ext` varchar(10)
,`position` smallint(6)
,`pages` varchar(50)
,`id_images` int(11)
);

-- --------------------------------------------------------

--
-- Structure de la vue `view_articles_page`
--
DROP TABLE IF EXISTS `view_articles_page`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_articles_page`  AS  select `a`.`article_articles` AS `articles`,`a`.`position_articles` AS `position`,`p`.`nom_pages` AS `pages` from (`articles` `a` join `pages` `p`) where (`p`.`id_pages` = `a`.`id_pages`) order by `a`.`position_articles` ;

-- --------------------------------------------------------

--
-- Structure de la vue `view_articles_page_admin`
--
DROP TABLE IF EXISTS `view_articles_page_admin`;

CREATE ALGORITHM=UNDEFINED DEFINER=`michelgard`@`localhost` SQL SECURITY DEFINER VIEW `view_articles_page_admin`  AS  select `a`.`articles_admin_articles` AS `articles`,`a`.`position_admin_articles` AS `position`,`p`.`nom_pages` AS `pages`,`a`.`id_pages` AS `idpage`,`a`.`id_admin_articles` AS `id_articles` from (`admin_articles` `a` join `pages` `p`) where (`p`.`id_pages` = `a`.`id_pages`) order by `a`.`position_admin_articles` ;

-- --------------------------------------------------------

--
-- Structure de la vue `view_images_page`
--
DROP TABLE IF EXISTS `view_images_page`;

CREATE ALGORITHM=UNDEFINED DEFINER=`michelgard`@`localhost` SQL SECURITY DEFINER VIEW `view_images_page`  AS  select `i`.`nom_images` AS `nom`,`i`.`ext_images` AS `ext`,`i`.`position_images` AS `position`,`p`.`nom_pages` AS `pages` from (`images` `i` join `pages` `p`) where (`i`.`id_pages` = `p`.`id_pages`) order by `i`.`position_images` ;

-- --------------------------------------------------------

--
-- Structure de la vue `view_images_page_admin`
--
DROP TABLE IF EXISTS `view_images_page_admin`;

CREATE ALGORITHM=UNDEFINED DEFINER=`michelgard`@`localhost` SQL SECURITY DEFINER VIEW `view_images_page_admin`  AS  select `i`.`nom_admin_images` AS `nom`,`i`.`ext_admin_images` AS `ext`,`i`.`position_admin_images` AS `position`,`p`.`nom_pages` AS `pages`,`i`.`id_admin_images` AS `id_images` from (`admin_images` `i` join `pages` `p`) where (`i`.`id_pages` = `p`.`id_pages`) order by `i`.`position_admin_images` ;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `admin_articles`
--
ALTER TABLE `admin_articles`
  ADD PRIMARY KEY (`id_admin_articles`),
  ADD KEY `id_pages` (`id_pages`);

--
-- Index pour la table `admin_images`
--
ALTER TABLE `admin_images`
  ADD PRIMARY KEY (`id_admin_images`),
  ADD KEY `id_pages` (`id_pages`);

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id_articles`),
  ADD KEY `id_pages` (`id_pages`);

--
-- Index pour la table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id_images`),
  ADD KEY `id_pages` (`id_pages`);

--
-- Index pour la table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id_pages`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id_utilisateurs`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `admin_articles`
--
ALTER TABLE `admin_articles`
  MODIFY `id_admin_articles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=546;
--
-- AUTO_INCREMENT pour la table `admin_images`
--
ALTER TABLE `admin_images`
  MODIFY `id_admin_images` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id_articles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=546;
--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `id_images` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT pour la table `pages`
--
ALTER TABLE `pages`
  MODIFY `id_pages` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_utilisateurs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `admin_articles`
--
ALTER TABLE `admin_articles`
  ADD CONSTRAINT `admin_articles_ibfk_1` FOREIGN KEY (`id_pages`) REFERENCES `pages` (`id_pages`);

--
-- Contraintes pour la table `admin_images`
--
ALTER TABLE `admin_images`
  ADD CONSTRAINT `admin_images_ibfk_1` FOREIGN KEY (`id_pages`) REFERENCES `pages` (`id_pages`);

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`id_pages`) REFERENCES `pages` (`id_pages`);

--
-- Contraintes pour la table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`id_pages`) REFERENCES `pages` (`id_pages`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
