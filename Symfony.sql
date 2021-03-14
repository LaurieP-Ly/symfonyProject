-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  jeu. 11 mars 2021 à 22:37
-- Version du serveur :  5.7.31-0ubuntu0.18.04.1
-- Version de PHP :  7.2.24-0ubuntu0.18.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `Symfony`
--

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `id` int(11) NOT NULL,
  `id_user_id` int(11) NOT NULL,
  `prix` double NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`id`, `id_user_id`, `prix`, `date`) VALUES
(18, 1, 60, '11-03-2021--19:35:29');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210306134624', '2021-03-06 14:46:42', 73),
('DoctrineMigrations\\Version20210306150443', '2021-03-06 16:10:45', 104),
('DoctrineMigrations\\Version20210306151534', '2021-03-06 16:15:49', 66),
('DoctrineMigrations\\Version20210309105853', '2021-03-09 11:59:08', 107),
('DoctrineMigrations\\Version20210310103334', '2021-03-10 11:33:54', 352),
('DoctrineMigrations\\Version20210310185146', '2021-03-10 19:52:01', 501),
('DoctrineMigrations\\Version20210310214258', '2021-03-10 22:43:16', 108);

-- --------------------------------------------------------

--
-- Structure de la table `horaire`
--

CREATE TABLE `horaire` (
  `id` int(11) NOT NULL,
  `id_sport_id` int(11) NOT NULL,
  `jour` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `heure` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `horaire`
--

INSERT INTO `horaire` (`id`, `id_sport_id`, `jour`, `heure`) VALUES
(1, 1, 'Mardi', '14:00'),
(2, 2, 'Lundi', '17:00'),
(3, 3, 'Mercredi', '16:00'),
(4, 4, 'Vendredi', '15:00'),
(5, 5, 'Jeudi', '18:00'),
(6, 6, 'Samedi', '13:00'),
(7, 7, 'Vendredi', '17:00'),
(8, 5, 'Lundi', '14:00'),
(9, 3, 'Mardi', '13:00'),
(10, 2, 'Mardi', '13:00');

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `id_horaire_id` int(11) NOT NULL,
  `id_commande_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `id_horaire_id`, `id_commande_id`) VALUES
(13, 2, 18),
(14, 5, 18);

-- --------------------------------------------------------

--
-- Structure de la table `sport`
--

CREATE TABLE `sport` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sport`
--

INSERT INTO `sport` (`id`, `nom`, `description`, `img`) VALUES
(1, 'Beach-Volleyball', 'Durée de l\'activité : 2h', 'img/volleyball-451581_1280.jpg'),
(2, 'Volley-Ball', 'Durée de l\'activité : 1h30', 'img/ball-1930191_1280.jpg'),
(3, 'BasketBall', 'Durée de l\'activité : 1h30', 'img/basketball-4743466_1280.jpg'),
(4, 'FootBall', 'Durée de l\'activité : 2h', 'img/football-3471402_1280.jpg'),
(5, 'Tennis', 'Durée de l\'activité : 2h', 'img/tennis-5782695_1280.jpg'),
(6, 'Badminton', 'Durée de l\'activité : 1h30', 'img/badminton-1428046_1280.jpg'),
(7, 'Natation', 'Durée de l\'activité : 1h20', 'img/swimmers-79592_1280.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `roles`) VALUES
(1, 'test@gmail.com', '$2y$13$FGjOhYndS2QlcVyqVs6RP.KnaGgc7rgVDSyQVPHgO7ti5MZjlxSOa', NULL),
(2, 'admin@project.com', '$2y$13$9F63ZBY6ptGm1CAA7/sDju9NZZNYm7LB2KV1KBY8K8pJFxI6wXxtW', '[\"ROLE_ADMIN\"]'),
(3, 'jj@gmail.com', '$2y$13$Sz6rvuzsglpd1SwS5pJ4HOve3Wfqnna7e4ncIlhZXykIY0E8GdlDa', '[]');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_35D4282C79F37AE5` (`id_user_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `horaire`
--
ALTER TABLE `horaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BBC83DB6FCA3506D` (`id_sport_id`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4DA239FD4FC5C2` (`id_horaire_id`),
  ADD KEY `IDX_4DA2399AF8E3A3` (`id_commande_id`);

--
-- Index pour la table `sport`
--
ALTER TABLE `sport`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `horaire`
--
ALTER TABLE `horaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `sport`
--
ALTER TABLE `sport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `FK_35D4282C79F37AE5` FOREIGN KEY (`id_user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `horaire`
--
ALTER TABLE `horaire`
  ADD CONSTRAINT `FK_BBC83DB6FCA3506D` FOREIGN KEY (`id_sport_id`) REFERENCES `sport` (`id`);

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `FK_4DA2399AF8E3A3` FOREIGN KEY (`id_commande_id`) REFERENCES `commandes` (`id`),
  ADD CONSTRAINT `FK_4DA239FD4FC5C2` FOREIGN KEY (`id_horaire_id`) REFERENCES `horaire` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
