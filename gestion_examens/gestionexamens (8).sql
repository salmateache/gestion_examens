-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : dim. 12 jan. 2025 à 17:27
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
-- Base de données : `gestionexamens`
--

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE `compte` (
  `idCompte` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `etat` varchar(50) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `idRole` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `compte`
--

INSERT INTO `compte` (`idCompte`, `username`, `password`, `etat`, `idUtilisateur`, `idRole`) VALUES
(4, 'salma', '$2y$10$ngntEgT4OilGtYJlTzDioeSatVPqjreGZaaYztrNTdfL3SEAOvJBi', 'Active', 2, 2),
(5, 'salmateache', '$2y$10$vBQCzzRGgAunO44lfv5xmeWphhHOKAtY6ogePpOZQCMO/gimupoDq', 'Active', 3, 2),
(6, 'salmateach', '$2y$10$dgNiPGg3LpjmrA2QhfdGm.jSGTczwbqwcqorUXTSLJCpQZu1V58Ay', 'Active', 4, 2),
(7, 'ProfIdrais', '$2y$10$rH0oMj2eTMYj9XWaFg/nQ.LAfj7RnXvnCmStUpkh94tic7/YlU7QK', 'active', 5, 1),
(8, 'Meryem', '$2y$10$28yp2vffCUWVvYila9.lSOYV6ypqnQqugdKhesFrp4eX9SAPewYvW', 'Active', 8, 1),
(9, 'hajar', '$2y$10$dbM.pLHj2/ZCFxCmtNA8yOre9HQEX1qCvDZ.sVspA7m2l.yrqTooC', 'Active', 9, 1),
(10, 'salmaton', '$2y$10$Vqj3r1u1v4w6iTsilYkH6.sePJafRC9aVP1Yy5PdzHarUhX/.JeOm', 'Active', 10, 1);

-- --------------------------------------------------------

--
-- Structure de la table `filiere`
--

CREATE TABLE `filiere` (
  `idFiliere` int(11) NOT NULL,
  `nomFiliere` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `filiere`
--

INSERT INTO `filiere` (`idFiliere`, `nomFiliere`) VALUES
(3, 'É'),
(2, 'Génie Civil'),
(1, 'Informatique');

-- --------------------------------------------------------

--
-- Structure de la table `module`
--

CREATE TABLE `module` (
  `idModule` int(11) NOT NULL,
  `nomModule` varchar(100) NOT NULL,
  `idFiliere` int(11) NOT NULL,
  `idProfesseur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `module`
--

INSERT INTO `module` (`idModule`, `nomModule`, `idFiliere`, `idProfesseur`) VALUES
(11, 'Recherche opérationnelle 2', 1, 2),
(12, 'M2', 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

CREATE TABLE `note` (
  `idNote` int(11) NOT NULL,
  `idEtudiant` int(11) NOT NULL,
  `idModule` int(11) NOT NULL,
  `note` decimal(5,2) DEFAULT NULL,
  `commentaire` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `professeur`
--

CREATE TABLE `professeur` (
  `idProfesseur` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `departement` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `professeur`
--

INSERT INTO `professeur` (`idProfesseur`, `idUtilisateur`, `nom`, `prenom`, `email`, `date`, `departement`) VALUES
(1, 5, 'Idrais', 'Jaafar', 'example@example.com', '2025-01-09', 'Informatique'),
(2, 9, 'ou-hidauyyuaa', 'hajariiiira', 'exampley@gmail.com', '2025-01-11', 'InformatiqueRlCaaa'),
(3, 10, 'SAMA', '', 'salmteache0@gmail.com', '2025-01-11', 'Informatique');

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `idRole` int(11) NOT NULL,
  `nomRole` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`idRole`, `nomRole`) VALUES
(1, 'Enseignant'),
(2, 'Etudiant');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `idUtilisateur` int(11) NOT NULL,
  `nom_complet` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dateNaissance` date DEFAULT NULL,
  `idRole` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `nom_complet`, `email`, `dateNaissance`, `idRole`) VALUES
(1, 'Idrais Jaafar', 'example@gmail.com', '2024-12-17', 1),
(2, 'Salma', 'salmateache0@gmail.com', '2025-01-26', 2),
(3, 'Salmaa', 'salmateache@gmail.com', '2025-01-24', 2),
(4, 'Salmaaa', 'salmateach@gmail.com', '2025-01-01', 2),
(5, 'Jaafar Idrais', 'example@example.com', '1988-01-22', 1),
(6, 'Meryem Benhadia', 'meryem@gmail.com', '2004-01-27', 1),
(8, 'Abdellah Benhadia', 'IOSJU@gmail.com', '2004-01-01', 1),
(9, 'hajar ouhida', 'hajar.ohd9@gmail.com', '2003-11-15', 1),
(10, 'SAMA', 'salmteache0@gmail.com', '2025-01-15', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`idCompte`),
  ADD KEY `idUtilisateur` (`idUtilisateur`),
  ADD KEY `idRole` (`idRole`);

--
-- Index pour la table `filiere`
--
ALTER TABLE `filiere`
  ADD PRIMARY KEY (`idFiliere`),
  ADD UNIQUE KEY `nomFiliere` (`nomFiliere`);

--
-- Index pour la table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`idModule`),
  ADD KEY `idFiliere` (`idFiliere`),
  ADD KEY `idProfesseur` (`idProfesseur`);

--
-- Index pour la table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`idNote`),
  ADD KEY `idEtudiant` (`idEtudiant`),
  ADD KEY `idModule` (`idModule`);

--
-- Index pour la table `professeur`
--
ALTER TABLE `professeur`
  ADD PRIMARY KEY (`idProfesseur`),
  ADD KEY `professeur_ibfk_1` (`idUtilisateur`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`idRole`),
  ADD UNIQUE KEY `nomRole` (`nomRole`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`idUtilisateur`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idRole` (`idRole`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `compte`
--
ALTER TABLE `compte`
  MODIFY `idCompte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `filiere`
--
ALTER TABLE `filiere`
  MODIFY `idFiliere` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `module`
--
ALTER TABLE `module`
  MODIFY `idModule` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `note`
--
ALTER TABLE `note`
  MODIFY `idNote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `professeur`
--
ALTER TABLE `professeur`
  MODIFY `idProfesseur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `idRole` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `compte`
--
ALTER TABLE `compte`
  ADD CONSTRAINT `compte_ibfk_1` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE CASCADE,
  ADD CONSTRAINT `compte_ibfk_2` FOREIGN KEY (`idRole`) REFERENCES `role` (`idRole`) ON DELETE CASCADE;

--
-- Contraintes pour la table `module`
--
ALTER TABLE `module`
  ADD CONSTRAINT `fk_idProfesseur` FOREIGN KEY (`idProfesseur`) REFERENCES `professeur` (`idProfesseur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `note_ibfk_1` FOREIGN KEY (`idEtudiant`) REFERENCES `utilisateur` (`idUtilisateur`),
  ADD CONSTRAINT `note_ibfk_2` FOREIGN KEY (`idModule`) REFERENCES `module` (`idModule`);

--
-- Contraintes pour la table `professeur`
--
ALTER TABLE `professeur`
  ADD CONSTRAINT `professeur_ibfk_1` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE CASCADE;

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`idRole`) REFERENCES `role` (`idRole`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
