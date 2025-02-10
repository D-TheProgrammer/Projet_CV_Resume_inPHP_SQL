-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 10 fév. 2025 à 18:07
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
-- Base de données : `site_cv`
--

-- --------------------------------------------------------

--
-- Structure de la table `competence_info`
--

CREATE TABLE `competence_info` (
  `id_competence` int(11) NOT NULL,
  `nom_competence` varchar(60) NOT NULL,
  `niveau_competence` int(11) NOT NULL,
  `image_competence` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `competence_info`
--

INSERT INTO `competence_info` (`id_competence`, `nom_competence`, `niveau_competence`, `image_competence`) VALUES
(1, 'Prolog', 5, 'gestion_image/prolog.png'),
(2, 'Kotlin', 3, 'gestion_image/kotlin.png'),
(3, 'Python', 4, 'gestion_image/python.png'),
(4, 'Suite Adobe', 4, 'gestion_image/adobe.png'),
(5, 'JavaScript', 4, 'gestion_image/javascript.png'),
(6, 'PHP', 5, 'gestion_image/php.png'),
(7, 'Langage C et C++', 4, 'gestion_image/c_cpp.png'),
(8, 'HTML / CSS', 4, 'gestion_image/html_css.png');

-- --------------------------------------------------------

--
-- Structure de la table `experience_info`
--

CREATE TABLE `experience_info` (
  `id_experience` int(11) NOT NULL,
  `nom_experience` varchar(256) NOT NULL,
  `date_experience` int(11) NOT NULL,
  `description_experience` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `experience_info`
--

INSERT INTO `experience_info` (`id_experience`, `nom_experience`, `date_experience`, `description_experience`) VALUES
(1, 'Réalisation d\'un Sokoban en C', 2024, 'Création d\'un programme en langage C pour résoudre et jouer avec des plateaux de Sokoban'),
(2, 'Stéganographie en Python', 2023, 'Mise en place d\'un programme permettant de dissimuler une image dans une autre de manière imperceptible'),
(3, 'Création d\'un Chat textuel et graphique en Python', 2023, 'Projet en langage Python avec Tkinter permettant à deux personnes de communiquer via un serveur'),
(4, 'Programmation d\'un portfolio', 2021, 'Réalisation d\'un portfolio en PHP et HTML avec une base de données MySQL');

-- --------------------------------------------------------

--
-- Structure de la table `formation_info`
--

CREATE TABLE `formation_info` (
  `id_formation` int(11) NOT NULL,
  `nom_formation` varchar(256) NOT NULL,
  `lieu_formation` varchar(260) NOT NULL,
  `description_formation` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `formation_info`
--

INSERT INTO `formation_info` (`id_formation`, `nom_formation`, `lieu_formation`, `description_formation`) VALUES
(1, '2021-2024 Licence Informatique', 'Place de la formation', 'Développement web et bases de données\r\nAlgorithmique et structures de données\r\nProgrammation orientée objet\r\nMoteurs de jeu '),
(2, '2019-2021 DUT Métiers du Multimédia et de l\'Internet (MMI)', 'Place de la formation', 'Audiovisuel : Création et montage de scènes et de bruitages\r\nMotion design : Animation d\'images et de formes numériques\r\nInfographie : Création de visuels (affiches, cartes postales...) et utilisation de maquettes (mockups)');

-- --------------------------------------------------------

--
-- Structure de la table `langue_info`
--

CREATE TABLE `langue_info` (
  `id_langue` int(11) NOT NULL,
  `nom_langue` varchar(60) NOT NULL,
  `niveau_langue` varchar(60) NOT NULL,
  `image_langue` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `langue_info`
--

INSERT INTO `langue_info` (`id_langue`, `nom_langue`, `niveau_langue`, `image_langue`) VALUES
(1, 'Anglais', 'Mention Européenne Anglais Certificat B1 de Cambridge', 'gestion_image/usuk.png'),
(2, 'Français', 'C2', 'gestion_image/france.png'),
(3, 'Espagnol', 'A2', 'gestion_image/espagne.png');

-- --------------------------------------------------------

--
-- Structure de la table `personne_info`
--

CREATE TABLE `personne_info` (
  `id` int(255) NOT NULL,
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(25) NOT NULL,
  `nationalite` varchar(25) NOT NULL,
  `numero` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `linkedin` varchar(250) NOT NULL,
  `adresse` varchar(250) NOT NULL,
  `github` varchar(250) NOT NULL,
  `profil` text NOT NULL,
  `date_naissance` varchar(15) NOT NULL,
  `couleur_cv` text NOT NULL,
  `logo_site` text NOT NULL,
  `diplome_profil` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `personne_info`
--

INSERT INTO `personne_info` (`id`, `nom`, `prenom`, `nationalite`, `numero`, `email`, `linkedin`, `adresse`, `github`, `profil`, `date_naissance`, `couleur_cv`, `logo_site`, `diplome_profil`) VALUES
(1, 'LASTNAME', 'Firstname', 'Francaise', '01 02 03 05 00', 'email@email.com', 'https://fr.linkedin.com/', '13 rue du Douze , Paris', 'https://github.com/', 'Je suis une personne sérieuse, motivée et volontaire, dotée d\'une grande capacité de travail, ce qui\r\nme permet de m\'intégrer très facilement dans un groupe. Durant mon temps libre, je pratique le basketball et je joue aux jeux vidéo. De nature compétitive, je suis\r\ntoujours à la recherche de nouveaux défis à relever.', '2024-10-24', '#00a1ff', 'gestion_image/logo_damien.png', '• BAC S - Sciences de l\'ingénieur, spécialité ISN,\r\nMention Européenne Anglais (Lycée Général) \\n\r\n• DUT Métiers du Multimédia et de l\'Internet');

-- --------------------------------------------------------

--
-- Structure de la table `projet_info`
--

CREATE TABLE `projet_info` (
  `id_projet` int(11) NOT NULL,
  `nom_projet` text NOT NULL,
  `description_projet` text NOT NULL,
  `image_projet` text NOT NULL,
  `lien_projet` text NOT NULL,
  `couleur_projet` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `projet_info`
--

INSERT INTO `projet_info` (`id_projet`, `nom_projet`, `description_projet`, `image_projet`, `lien_projet`, `couleur_projet`) VALUES
(1, 'Polyominoes Tiling Js', 'Ce projet permet d\'étudier les polyominos et de proposer des solutions de pavage avec une ou plusieurs pièces fixes, en 2D avec l\'API Canvas, en 3D avec la librairie three.js.', 'gestion_image/polyominos.png', 'https://github.com/D-TheProgrammer/PolyominoesTilingJs-PavagesPolyominosJS', '#EEEE00'),
(2, 'Security- Project Linear Cryptanalysis', 'Implémentation d’une attaque par cryptanalyse linéaire sur un algorithme de chiffrement ToyCipher en utilisant des approximations linéaires de la boîte de substitution pour réduire l\'espace de recherche des clés. Ensuite, il teste les K0 retenus pour retrouver la clé de chiffrement.', 'gestion_image/cryptologie_lineaire.png', 'https://github.com/D-TheProgrammer/Security-Projet_Linear_cryptanalysis', 'green'),
(3, 'Project Youtube Replica in XML XSL HTM', 'Projet Réplique de la page d\'accueil Youtube via un fichier XML et XSL qui créeront un HTML', 'gestion_image/replica_youtube.png', 'https://github.com/D-TheProgrammer/Projet_Youtube_Replica_in_XML_XSL_HTML', 'red'),
(4, 'Project CastlevaniaJS', 'Plongez dans l\'aventure gothique de « Castlevania » en JavaScript, mêlant tradition et modernité. Affrontez des monstres légendaires dans des décors captivants.', 'img_projet/castlevania.png', 'https://github.com/D-TheProgrammer/Projet-CastlevaniaJS', '#EEEE00'),
(5, 'Project Ai BigData Clustering', 'Le projet sur lequel j\'ai travaillé s\'appelle cluster.py et utilise les fichiers iris_label.csv (pour leur type) et iris_data.csv(pour leur coordonées) pour traiter les données, notamment en effectuant du clustering et en changeant la couleur des points (représentant des fleurs) en fonction de leur proximité avec un centre.', 'gestion_image/projet_clustering.png', 'https://github.com/D-TheProgrammer/Projet_Ai_BigData_Clustering', 'blue'),
(6, 'Project Sokoban Solver In C', 'Le but de ce projet est de réaliser le jeu Sokoban ainsi que son résolveur. Un joueur doit déplacer des caisses vers des cibles en se déplaçant dans quatre directions : haut, droite, bas et gauche. Le joueur doit être prudent lorsqu\'il pousse les caisses, car il ne peut pas les déplacer à travers les murs et n\'a pas la force nécessaire pour pousser deux caisses en même temps. ', 'gestion_image/sokoban.png', 'https://github.com/D-TheProgrammer/Projet_Sokoban_Solver_In_C', 'green'),
(25, 'Nom de Projet Test1', 'ceci est un text pour un projet 1 il sert juste a montré que cest posible de créer un truc tres rapidement \r\nil sera jaune vert bleu rouge', 'gestion_image/capture_d_ecran_2024-10-17_185112.png', 'http:aa.com', '#EEEE00');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `competence_info`
--
ALTER TABLE `competence_info`
  ADD PRIMARY KEY (`id_competence`);

--
-- Index pour la table `experience_info`
--
ALTER TABLE `experience_info`
  ADD PRIMARY KEY (`id_experience`);

--
-- Index pour la table `formation_info`
--
ALTER TABLE `formation_info`
  ADD PRIMARY KEY (`id_formation`);

--
-- Index pour la table `langue_info`
--
ALTER TABLE `langue_info`
  ADD PRIMARY KEY (`id_langue`);

--
-- Index pour la table `personne_info`
--
ALTER TABLE `personne_info`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `projet_info`
--
ALTER TABLE `projet_info`
  ADD PRIMARY KEY (`id_projet`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `competence_info`
--
ALTER TABLE `competence_info`
  MODIFY `id_competence` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `experience_info`
--
ALTER TABLE `experience_info`
  MODIFY `id_experience` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `formation_info`
--
ALTER TABLE `formation_info`
  MODIFY `id_formation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `langue_info`
--
ALTER TABLE `langue_info`
  MODIFY `id_langue` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `personne_info`
--
ALTER TABLE `personne_info`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `projet_info`
--
ALTER TABLE `projet_info`
  MODIFY `id_projet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
