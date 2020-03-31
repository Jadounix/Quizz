-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 20 mars 2020 à 12:22
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `site_quiz`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `login_ad` varchar(20) NOT NULL,
  `mdp_ad` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`login_ad`, `mdp_ad`) VALUES
('youyou', 5678);

-- --------------------------------------------------------

--
-- Structure de la table `joueur`
--

CREATE TABLE `joueur` (
  `login_joueur` varchar(20) NOT NULL,
  `mdp_joueur` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Insertion  la table `joueur`
--

INSERT INTO `joueur` (`login_joueur`, `mdp_joueur`) VALUES
('toto', 1234);

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE `question` (
  `no_question` int(20) NOT NULL,
  `lib_question` varchar(200) NOT NULL,
  `bonne_rep` varchar(200) NOT NULL,
  `type` varchar(20) NOT NULL,
  `no_quiz` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Insertion des questions du premier quiz dans la table `question`
--

INSERT INTO `question` (`no_question`, `lib_question`, `bonne_rep`, `type`, `no_quiz`) VALUES
(1, 'Combien de questions un quiz doit-il contenir ?', '10', 'ouverte', 1),
(2, 'Comment trouver un bon thème de quiz ?', 'Demander à Juliette et Jade une idée', 'CM', 1),
(3, 'Parmi les propositions suivantes, laquelle n\'est pas un type de question valable pour un quiz ?', 'Question entrouverte', 'CM', 1),
(4, 'Que faut-il faire pour rendre un quiz moins ennuyeux ?', 'Le rendre drôle par la question : Que faut-il faire pour rendre un quiz moins ennuyeux ?', 'CM', 1),
(5, 'Quel temps faut-il allouer pour un quiz de 10 questions', '5', 'ouverte', 1),
(6, 'De quel pays est originaire le Trivial Pursuit ?', 'Québec', 'CM', 1),
(7, 'Laquelle de ces propositions n\'est pas un support de quiz ?', 'Un journal intime', 'CM', 1),
(8, ' Au tarot, comment nomme-t-on les cartes 1, 21 et l’excuse ?', 'Les bouts', 'CM', 1),
(9, 'La question précédente aurait pu être dans un quiz dont le thème serait.. ?', 'Les jeux de cartes', 'CM', 1),
(10, 'Quelle est la qualité primordiale d\'un quiz ?', 'Flatter l\'égo de la personne avec des questions faciles (mais pas trop non plus)', 'CM', 1);

-- --------------------------------------------------------

--
-- Structure de la table `quiz`
--

CREATE TABLE `quiz` (
  `no_quiz` int(20) NOT NULL,
  `nom` varchar(200) NOT NULL,
  `meilleur_score` int(20) NOT NULL,
  `meilleur_temps` int(20) NOT NULL,
  `temps_max` int(20) NOT NULL,
  `nb_question` int(20) NOT NULL,
  `login_ad` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Insertion du premier quiz dans la table `quiz`
--

INSERT INTO `quiz` (`no_quiz`, `nom`, `meilleur_score`, `meilleur_temps`, `temps_max`, `nb_question`, `login_ad`) VALUES
(1, 'Comment faire un Quiz ?', 0, 0, 5, 10, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE `reponse` (
  `no_rep` int(20) NOT NULL,
  `lib_rep` varchar(200) NOT NULL,
  `no_question` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Insertion des réponses du premier quiz dans la table `reponse`
--

INSERT INTO `reponse` (`no_rep`, `lib_rep`, `no_question`) VALUES
(1, 'Chercher sur internet', 2),
(2, 'Demander à Juliette et Jade une idée', 2),
(3, 'Regarder le ciel en espérant un signe divin', 2),
(4, 'Question entrouverte', 3),
(5, 'Question ouverte', 3),
(6, 'Question à choix multiples', 3),
(7, 'Mettre la même question en boucle', 4),
(8, 'Faire un quiz qui contient plus de 100 questions', 4),
(9, 'Le rendre drôle par la question : Que faut-il faire pour rendre un quiz moins ennuyeux ?', 4),
(10, 'Québec', 6),
(11, 'Norvège', 6),
(12, 'Etats-Unis', 6),
(13, 'Un journal intime', 7),
(14, 'Un jeu de société', 7),
(15, 'Un site web', 7),
(16, 'Un jeu télévisé', 7),
(17, 'Les as', 8),
(18, 'Les champions', 8),
(19, 'Les bouts', 8),
(20, 'Les jeux de cartes', 9),
(21, 'Les animaux', 9),
(22, 'L\'ENSC', 9),
(23, 'Augmenter la culture générale', 10),
(24, 'Flatter l\'égo de la personne avec des questions faciles (mais pas trop non plus)', 10),
(25, 'Détendre la personne devant une tâche divertissante', 10),
(50, '1', 11),
(51, '2', 11),
(52, '3', 11);

-- --------------------------------------------------------

--
-- Structure de la table `score`
--

CREATE TABLE `score` (
  `no_score` int(20) NOT NULL,
  `nb_points` int(20) NOT NULL,
  `temps` int(20) NOT NULL,
  `login_joueur` varchar(20) NOT NULL,
  `no_quiz` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Insertion d'un score comme exemple dans la table `score`
--

INSERT INTO `score` (`no_score`, `nb_points`, `temps`, `login_joueur`, `no_quiz`) VALUES
(1, 7, 0, 'toto', NULL);

--
-- Clé primaire de la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`login_ad`);

--
-- Clé primaire de la table `joueur`
--
ALTER TABLE `joueur`
  ADD PRIMARY KEY (`login_joueur`);

--
-- Clé primaire de la table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`no_question`);

--
-- Clé primaire de la table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`no_quiz`);

--
-- Clé primaire de la table `reponse`
--
ALTER TABLE `reponse`
  ADD PRIMARY KEY (`no_rep`);

--
-- Clé primaire de la table `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`no_score`);

--
-- AUTO_INCREMENT pour la table `question`
--
ALTER TABLE `question`
  MODIFY `no_question` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `no_quiz` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `reponse`
--
ALTER TABLE `reponse`
  MODIFY `no_rep` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT pour la table `score`
--
ALTER TABLE `score`
  MODIFY `no_score` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
