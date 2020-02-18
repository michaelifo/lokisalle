-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 18 fév. 2020 à 16:20
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `lokisalle`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `id_avis` int(3) NOT NULL,
  `id_membre` int(3) NOT NULL,
  `id_salle` int(3) NOT NULL,
  `commentaire` text NOT NULL,
  `note` text NOT NULL,
  `date_enregistrement` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id_avis`, `id_membre`, `id_salle`, `commentaire`, `note`, `date_enregistrement`) VALUES
(2, 10, 1, 'gdgdfgdfgdf', '★★★★★', '2020-02-18 13:24:39'),
(3, 1, 1, 'qsdqdsqsdq', '★★★', '2020-02-18 13:27:33'),
(4, 2, 2, 'dsqdqsdqsd', '★★★★', '2020-02-18 15:35:05'),
(5, 1, 3, 'sdfsdfsdsdf', '★★★★★', '2020-02-18 15:36:59'),
(6, 1, 4, 'sdfsfsdf', '★★★★★', '2020-02-18 15:37:06'),
(7, 1, 5, 'sdfsdfsdf', '★★★★★', '2020-02-18 15:37:14'),
(8, 1, 7, 'sdfsdfsdfsdf', '★★★★★', '2020-02-18 15:37:22');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id_commande` int(3) NOT NULL,
  `id_membre` int(3) NOT NULL,
  `id_produit` int(3) NOT NULL,
  `date_enregistrement` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id_commande`, `id_membre`, `id_produit`, `date_enregistrement`) VALUES
(21, 10, 4, '2020-02-18 11:13:11'),
(22, 10, 5, '2020-02-18 11:13:14'),
(24, 10, 3, '2020-02-18 11:13:49'),
(26, 10, 6, '2020-02-18 11:26:35'),
(28, 10, 1, '2020-02-18 13:07:41'),
(29, 1, 2, '2020-02-18 15:36:34');

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id_membre` int(3) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `mdp` varchar(60) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `civilite` enum('homme','femme') NOT NULL,
  `statut` int(1) NOT NULL,
  `date_enregistrement` datetime NOT NULL,
  `confirmation_token` varchar(60) DEFAULT NULL,
  `confirmed_at` datetime DEFAULT NULL,
  `reset_token` varchar(60) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `remember_token` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id_membre`, `pseudo`, `mdp`, `nom`, `prenom`, `email`, `civilite`, `statut`, `date_enregistrement`, `confirmation_token`, `confirmed_at`, `reset_token`, `reset_at`, `remember_token`) VALUES
(1, 'erza', '$2y$10$UUr8gzQBF37Wv/9riaov7Oq9NuMyIf2XAFM68R31kIigUT3yNFAl2', 'Scarlet', 'Erza', 'erza@gmail.com', 'femme', 1, '2020-02-14 23:08:04', NULL, '2020-02-14 23:08:36', NULL, NULL, 't1oj8rMvEYoWC0EOZhAxREz6yC5eRow2mUy8BXTTWQbGSsf6tzfydPvvulNZgFyNsoCFTEjvGzz4hmOdE6SeepEYLVZ1nT54xtKySlfW0aRzwqrBgCchTg6kdk14qs1HNWhcqxmk3iwwvmqtfKAfCh7PJ0rdK4vJ0tcvaaypsxcxg3WCDRq4rFJxcA1jxtFh9AtsgOF6tHu3lEyuh7L4EtbiR19EOKERqvAN4xgywBJpLi8HWj4roLFIDZ'),
(2, 'natsu', '$2y$10$e7v3XUoxJuWDc/jiVuSGMOKApDvcq212S..OoYPYg/wGTO3Sexe4a', 'Dragnir', 'Natsu', 'natsu@gmail.com', 'homme', 0, '2020-02-15 15:30:25', NULL, '2020-02-15 15:30:54', NULL, NULL, 'IoGCfHkiJJ6kOdrbUFwMlmyGmnigXWkSKDw13y0iy1MTehDXw1hnAvrfhNrVFOicPQevxCm7lOZhEpurfUhC7LmVmyk3ekCIrMvHavSpZIBTAEqCg2PR3SMSw5nDvw4bAm66Eg0daLzhd0CrfODlcOp29g3f21XXorWsAei9KCJesOwccQjypbMmG8pWay6Zdrgk495LR7aVrpZdhaMnrWwnQkfyAuhH1yiEFQEAKKGLenKxr37VTsgx14'),
(3, 'lucy', '$2y$10$xzlqybqUHo1nHyi5V8vZbeW7AafW5hHKEq6HNijhVL6jp487roZne', 'lucy', 'lucy', 'lucy@gmail.com', 'femme', 0, '2020-02-15 19:57:53', NULL, '2020-02-15 19:58:02', NULL, NULL, NULL),
(4, 'naruto', '$2y$10$fhdIqDrimSXmKfVf5K1p/uOH/K89gvFxOcBcCJVdh3XKgq5ZVar/2', 'Uzumaki', 'Naruto', 'naruto@gmail.com', 'homme', 2, '2020-02-15 19:59:47', NULL, '2020-02-15 19:59:58', NULL, NULL, NULL),
(9, 'hinata', '$2y$10$g/0cYD/Jokqo2Gc4Yn/zbOnGBoXlazIX928O5kUexOFfUkntt5Y7G', 'Hyuga', 'Hinata', 'hinata@gmail.com', 'femme', 0, '2020-02-16 17:34:32', NULL, '2020-02-16 17:34:39', NULL, NULL, NULL),
(10, 'admin', '$2y$10$yCZg7b/4u76pwf7I2JuJreIurve7RQhu1Ir2bj1WZzXGX4q.RkiQW', 'Admin', 'Boss', 'michael.ifocop@gmail.com', 'homme', 1, '2020-02-18 10:45:02', NULL, '2020-02-18 10:46:06', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id_produit` int(3) NOT NULL,
  `id_salle` int(3) NOT NULL,
  `date_arrivee` datetime NOT NULL,
  `date_depart` datetime NOT NULL,
  `prix` int(3) NOT NULL,
  `etat` enum('libre','reservation') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `id_salle`, `date_arrivee`, `date_depart`, `prix`, `etat`) VALUES
(1, 1, '2021-02-01 08:00:00', '2021-02-16 17:00:00', 1200, 'reservation'),
(2, 2, '2021-01-01 08:00:00', '2021-01-16 17:00:00', 1050, 'reservation'),
(3, 3, '2021-03-01 08:00:00', '2021-03-16 17:00:00', 1150, 'reservation'),
(4, 4, '2021-04-01 08:00:00', '2021-04-16 17:00:00', 850, 'reservation'),
(5, 5, '2021-05-01 08:00:00', '2021-05-16 17:00:00', 1050, 'reservation'),
(6, 7, '2021-06-01 08:00:00', '2021-06-16 17:00:00', 1600, 'reservation');

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE `salle` (
  `id_salle` int(3) NOT NULL,
  `titre` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(200) NOT NULL,
  `pays` varchar(20) NOT NULL,
  `ville` varchar(20) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `cp` int(5) NOT NULL,
  `capacite` int(3) NOT NULL,
  `categorie` enum('réunion','bureau','formation') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `salle`
--

INSERT INTO `salle` (`id_salle`, `titre`, `description`, `photo`, `pays`, `ville`, `adresse`, `cp`, `capacite`, `categorie`) VALUES
(1, 'Cézanne', 'La salle cézanne parfaite pour vos réunions d\'entreprise', 'cezanne.jpg', 'France', 'Paris', '30 rue mademoiselle', 75015, 30, 'réunion'),
(2, 'Mozart', 'Cette salle vous permettra de recevoir vos collaborateurs en petit comité', 'mozart.jpg', 'France', 'Paris', '17 rue de turbigo', 75008, 5, 'réunion'),
(3, 'Picasso', 'Cette salle vous permettra de conférencer avec vos collègues', 'picasso.jpg', 'France', 'Lyon', '28 quai claude bernard Lyon', 69007, 14, 'formation'),
(4, 'Voltaire', 'Cette salle, vous étonnera par ses nombreuses fonctionnalités.', 'voltaire.jpg', 'france', 'Marseille', '5 rue du ciel', 13001, 9, 'bureau'),
(5, 'Nation', 'Cette salle met l\'accent sur la convivialité et la sérénité.', 'nation.jpg', 'france', 'Paris', '27 rue de la nation', 75014, 22, 'réunion'),
(7, 'Canière', 'Dotée d\'une très grande capacité d\'accueil, il est possible d\'y organiser un grand rassemblement.', 'caniere.jpg', 'france', 'Lyon', '7 rue de la folie', 69008, 50, 'réunion');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id_avis`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_commande`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id_membre`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_produit`);

--
-- Index pour la table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`id_salle`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `id_avis` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_commande` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id_membre` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_produit` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `salle`
--
ALTER TABLE `salle`
  MODIFY `id_salle` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
