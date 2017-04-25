-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mer 29 Mars 2017 à 15:02
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `skewers`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `user` varchar(255) NOT NULL,
  `id_a` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `admin`
--

INSERT INTO `admin` (`user`, `id_a`, `nom`, `prenom`, `mail`, `mdp`) VALUES
('admin', 1, 'Hoang', 'Shazad', 'shazad@skewers.com', '1234'),
('', 2, 'Soumahoro', 'Vatogba', 'vato@skewers.com', '1234'),
('', 3, 'Fanivo', 'Dylan', 'dylan@skewers.com', '1234'),
('', 4, '', 'Aina', 'aina@skewers.com', '1234'),
('', 5, 'Josy', 'Damien', 'damien@skewers.com', '1234\r\n');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id_cat` int(11) NOT NULL,
  `nom_cat` varchar(255) DEFAULT NULL,
  `detail_cat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id_cat`, `nom_cat`, `detail_cat`) VALUES
(1, 'informatique', 'Informatique'),
(2, 'transport', 'Transport'),
(3, 'videosgames', 'Jeux vidéos'),
(4, 'sport', 'Sport');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id_c` int(11) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `code_postal` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `mdp` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `statut` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`id_c`, `address`, `code_postal`, `ville`, `nom`, `prenom`, `mdp`, `mail`, `statut`) VALUES
(1, 'ededed', '5656', 'dourdan', 'Boss', 'Boss', '123456', 'a@a.com', '1'),
(2, 'rue du tai', '91410', 'saucisse', 'Fory', 'Lataka', '$2y$10$pnhEdipyVZNIB1.OlrOMj.EKbf/nPdP5TgdvtQOn.Vnw65mW/Q93m', 'f@f.com', NULL),
(3, 'zczcezce', '2121', 'czecz', 'Fory', 'Fory', '$2y$10$gqVp2869Jiewtnf8x7.ZW.eVlB0ZG79jmSEHgDBE/OoYe5dDSuAZC', 'fory@a.com', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id_com` int(11) NOT NULL,
  `prix_com` float DEFAULT NULL,
  `nbr_art_com` int(11) DEFAULT NULL,
  `statut_com` varchar(25) DEFAULT NULL,
  `id_c` int(11) DEFAULT NULL,
  `id_pay` int(11) DEFAULT NULL,
  `id_moy_liv` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `commande`
--

INSERT INTO `commande` (`id_com`, `prix_com`, `nbr_art_com`, `statut_com`, `id_c`, `id_pay`, `id_moy_liv`) VALUES
(1, 200530, 3, 'ok', 3, NULL, NULL),
(2, 60, 1, 'ok', 3, NULL, NULL),
(3, 200620, 4, 'ok', 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `comprend`
--

CREATE TABLE `comprend` (
  `id_com` int(11) NOT NULL,
  `id_p` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `moy_livraison`
--

CREATE TABLE `moy_livraison` (
  `id_moy_liv` int(11) NOT NULL,
  `type_moy_liv` char(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `moy_pay`
--

CREATE TABLE `moy_pay` (
  `id_pay` int(11) NOT NULL,
  `type_moy_pay` varchar(25) DEFAULT NULL,
  `min_moy_pay` int(11) DEFAULT NULL,
  `max_moy_pay` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id_panier` int(255) NOT NULL,
  `id_c` int(255) NOT NULL,
  `id_p` int(255) NOT NULL,
  `Nb_du_produit` int(255) NOT NULL,
  `Sous_total` int(255) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id_p` int(11) NOT NULL,
  `id_c` int(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'img' COMMENT 'adresse image',
  `Nom_produit` varchar(255) NOT NULL,
  `motcle` varchar(255) NOT NULL DEFAULT 'mot',
  `description` varchar(255) DEFAULT NULL,
  `prix_p` int(25) DEFAULT NULL,
  `Statut` tinyint(1) DEFAULT '0',
  `id_cat` int(11) DEFAULT NULL,
  `uploaded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `edited` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`id_p`, `id_c`, `image`, `Nom_produit`, `motcle`, `description`, `prix_p`, `Statut`, `id_cat`, `uploaded`, `edited`) VALUES
(1, 0, '1/4k-TV-Hero.jpg', 'TV UHD Sony', '', NULL, 2, 1, 1, '2017-03-24 17:58:05', '2017-03-24 17:58:05'),
(2, 0, '2/adidas-conext15.jpg', 'Ballon adidas', '', NULL, 20, 1, 4, '2017-03-24 17:58:05', '2017-03-24 17:58:05'),
(3, 0, '3/gtx1080.png', 'Carte graphique GTX 1080', '', NULL, 450, 1, 1, '2017-03-24 17:58:05', '2017-03-24 17:58:05'),
(4, 0, '4/gta5.jpg', 'Grand theft auto 5', 'gta,#action', 'Jeu d\'action', 60, 0, 3, '2017-03-25 20:47:32', '2017-03-25 20:47:32'),
(5, 0, '5/audi_r8.jpg', 'Audi R8', '', NULL, 200000, 0, 2, '2017-03-25 20:50:22', '2017-03-25 20:50:22'),
(6, 0, '6/macbook-pro-17.png', 'MacBook Pro 17 pouces', '', NULL, 2500, 1, 1, '2017-03-25 20:51:44', '2017-03-25 20:51:44'),
(7, 0, '7/samsung-850-pro.jpg', 'SSD Samsung 850 pro 500 GB', '', NULL, 180, 1, 1, '2017-03-25 20:53:26', '2017-03-25 20:53:26'),
(8, 0, '8/msi.jpg', 'MSi PC Gamer ', '', NULL, 1200, 1, 1, '2017-03-25 20:54:28', '2017-03-25 20:54:28'),
(9, 0, '9/VTT.jpg', 'VTT super', '', 'Roulez à toute vitesse', 150, 1, 4, '2017-03-25 20:56:28', '2017-03-25 20:56:28'),
(11, 3, 'img', 'PS1', 'mot', 'Décrivez votre produit', 500, 0, 3, '2017-03-29 13:44:43', '2017-03-29 13:44:43'),
(12, 3, 'img', 'HDD', 'mot', 'Disque dur', 600, 0, 1, '2017-03-29 13:45:26', '2017-03-29 13:45:26'),
(13, 3, 'img', 'HDD', 'mot', 'Disque dur', 600, 0, 1, '2017-03-29 13:45:26', '2017-03-29 13:45:26');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_a`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_cat`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_c`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_com`),
  ADD KEY `FK_commande_id_c` (`id_c`),
  ADD KEY `FK_commande_id_pay` (`id_pay`),
  ADD KEY `FK_commande_id_moy_liv` (`id_moy_liv`);

--
-- Index pour la table `comprend`
--
ALTER TABLE `comprend`
  ADD PRIMARY KEY (`id_com`,`id_p`),
  ADD KEY `FK_comprend_id_p` (`id_p`);

--
-- Index pour la table `moy_livraison`
--
ALTER TABLE `moy_livraison`
  ADD PRIMARY KEY (`id_moy_liv`);

--
-- Index pour la table `moy_pay`
--
ALTER TABLE `moy_pay`
  ADD PRIMARY KEY (`id_pay`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id_panier`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_p`),
  ADD KEY `FK_produit_id_cat` (`id_cat`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_a` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id_c` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_com` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `moy_livraison`
--
ALTER TABLE `moy_livraison`
  MODIFY `id_moy_liv` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `moy_pay`
--
ALTER TABLE `moy_pay`
  MODIFY `id_pay` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `id_panier` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_p` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `FK_commande_id_c` FOREIGN KEY (`id_c`) REFERENCES `client` (`id_c`),
  ADD CONSTRAINT `FK_commande_id_moy_liv` FOREIGN KEY (`id_moy_liv`) REFERENCES `moy_livraison` (`id_moy_liv`),
  ADD CONSTRAINT `FK_commande_id_pay` FOREIGN KEY (`id_pay`) REFERENCES `moy_pay` (`id_pay`);

--
-- Contraintes pour la table `comprend`
--
ALTER TABLE `comprend`
  ADD CONSTRAINT `FK_comprend_id_com` FOREIGN KEY (`id_com`) REFERENCES `commande` (`id_com`),
  ADD CONSTRAINT `FK_comprend_id_p` FOREIGN KEY (`id_p`) REFERENCES `produit` (`id_p`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `FK_produit_id_cat` FOREIGN KEY (`id_cat`) REFERENCES `categorie` (`id_cat`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
