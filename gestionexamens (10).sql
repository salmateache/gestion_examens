-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 24 jan. 2025 à 00:05
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.1.12

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
(7, 'ProfIdrais', '$2y$10$rH0oMj2eTMYj9XWaFg/nQ.LAfj7RnXvnCmStUpkh94tic7/YlU7QK', 'active', 5, 1),
(9, 'hajar', '$2y$10$tan3gZ6VKs1.0mIGLosXeuMv/s03RrTPT.AmK0asMBfkAhQeg8gdq', 'Active', 9, 1),
(10, 'IDRAIS', '$2y$10$9O/s8l6nZiWfPMtp9rUJmu41X2rDQS3tzu0ZAClOrj3rPuN39u0L.', 'Active', 10, 1),
(11, 'Mehdi Soufi', '$2y$10$9O/s8l6nZiWfPMtp9rUJmu41X2rDQS3tzu0ZAClOrj3rPuN39u0L.', 'active', 11, 1),
(12, 'MeryemBen', '$2y$10$8qu1e8fDPMouNSJafXmTMe84b3YT6vfPe15dkp5iNg/DC1pxoMFbu', 'Active', 12, 2),
(13, 'Nada', '$2y$10$hiky8Abf1UQnw6Le6ePPGOCtZs8v1ccTweQaKSR6txj1NHa0b.jTO', 'Active', 13, 2),
(16, 'ABDO', '$2y$10$ViW2UNhXRSRrt8Hp7vjM1u8g1eGV7vWxqOZFmj4SWbT6xOvl9iHdW', 'Active', 16, 1),
(18, 'Hiba', '$2y$10$Cp5G/CSm642aJAwS7ayIV.E47vmzrGnxmQmxDNJyO/C9gKiRDmQYS', 'Active', 18, 2),
(21, 'Fati', '$2y$10$LdbCQMWORw74QXLZPRpjbuEkO.icYwPXQgQ7fGCOgslYseqLxNfUe', 'Active', 21, 2);

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `idEtudiant` int(11) NOT NULL,
  `idUtilisateur` int(11) DEFAULT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `idFiliere` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`idEtudiant`, `idUtilisateur`, `nom`, `prenom`, `email`, `idFiliere`) VALUES
(1, 12, 'Benhadia', 'Meryem', 'meryem@example.com', 1),
(3, 21, 'Khardadi', 'Fati', 'fati@gmail.com', 1);

--
-- Déclencheurs `etudiant`
--
DELIMITER $$
CREATE TRIGGER `before_insert_etudiant` BEFORE INSERT ON `etudiant` FOR EACH ROW BEGIN
    DECLARE roleEtudiant INT;
    -- Récupérer le rôle de l'utilisateur inséré
    SELECT idRole INTO roleEtudiant FROM utilisateur WHERE idUtilisateur = NEW.idUtilisateur;
    
    -- Vérifier si l'utilisateur a bien le rôle "2" (étudiant)
    IF roleEtudiant <> 2 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Erreur : idUtilisateur doit être un utilisateur avec idRole = 2';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `examen`
--

CREATE TABLE `examen` (
  `idExamen` int(11) NOT NULL,
  `idModule` int(11) NOT NULL,
  `dateExamen` date NOT NULL,
  `noteMaximale` decimal(5,2) NOT NULL,
  `libelleExamen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `examen`
--

INSERT INTO `examen` (`idExamen`, `idModule`, `dateExamen`, `noteMaximale`, `libelleExamen`) VALUES
(1, 1, '2025-02-15', '20.00', 'Examen final'),
(2, 2, '2025-03-10', '20.00', 'Examen final'),
(3, 3, '2025-04-05', '20.00', 'Examen oral'),
(4, 2, '2025-05-20', '20.00', 'Examen de tp');

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
(3, 'IDIA'),
(1, 'IL'),
(2, 'ILLSE');

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
(1, 'Recherche opérationnelle 2', 1, 2),
(2, 'Design Thinking', 1, 5),
(3, 'Génie logiciel avancé', 1, 5);

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

CREATE TABLE `note` (
  `idNote` int(11) NOT NULL,
  `idEtudiant` int(11) NOT NULL,
  `note` decimal(5,2) DEFAULT NULL,
  `commentaire` text DEFAULT NULL,
  `idExamen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `note`
--

INSERT INTO `note` (`idNote`, `idEtudiant`, `note`, `commentaire`, `idExamen`) VALUES
(35, 1, '18.00', 'Très bon travail', 1),
(36, 1, '20.00', 'très très excellent travail', 4),
(37, 1, '19.00', 'Excellent', 2),
(39, 3, '17.00', 'Bien', 4),
(40, 3, '15.00', 'Bien', 3);

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
(2, 9, 'ou-hidauyyu', 'hajaroiU', 'exampleey@gmail.comJ', '2025-01-11', 'InformatiqueRlC'),
(4, 10, 'Idrais', 'Jaafar', 'idrais@gmail.com', '2025-01-13', 'Informatique'),
(5, 11, 'Soufi', 'Mehdi', 'profsoufi66@gmail.com', '2025-01-21', 'Informatique'),
(7, 16, 'Abdellah', 'Benhadia', 'IOSJU@gmail.com', '2025-01-21', 'Informatique');

-- --------------------------------------------------------

--
-- Structure de la table `reclamation`
--

CREATE TABLE `reclamation` (
  `idReclamation` int(11) NOT NULL,
  `id_etudiant` int(11) NOT NULL,
  `id_module` int(11) NOT NULL,
  `id_examen` int(11) NOT NULL,
  `justification` text DEFAULT NULL,
  `piece_joinee` varchar(255) DEFAULT NULL,
  `date_reclamation` timestamp NOT NULL DEFAULT current_timestamp(),
  `statut` varchar(20) NOT NULL DEFAULT 'en_attente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reclamation`
--

INSERT INTO `reclamation` (`idReclamation`, `id_etudiant`, `id_module`, `id_examen`, `justification`, `piece_joinee`, `date_reclamation`, `statut`) VALUES
(28, 1, 2, 4, 'LPKOJIHUYGTVGX', 'assets/uploads/1737673029_4f876fb8dcc8f8a9759b.pdf', '2025-01-23 21:57:09', 'En attente'),
(29, 1, 1, 1, 'Reclamation sur une note', 'assets/uploads/1737673263_a1e443afc1dc7cf6d00f.docx', '2025-01-23 22:01:03', 'En attente'),
(30, 1, 2, 1, 'reclamation sue la note de l\'examen final', 'assets/uploads/1737673330_96fb7950ad46f7398315.png', '2025-01-23 22:02:10', 'acceptee'),
(31, 3, 2, 4, 'reclamation', 'assets/uploads/1737673368_258c85d038b63e45966f.png', '2025-01-23 22:02:48', 'rejetee');

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
(5, 'Jaafar Idrais', 'example@example.com', '1988-01-22', 1),
(6, 'Meryem Benhadia', 'meryem@gmail.com', '2004-01-27', 1),
(9, 'hajar ouhida', 'hajar.ohd9@gmail.com', '2003-11-15', 1),
(10, 'Idrais Jaafar', 'id@gmail.com', '2025-01-31', 1),
(11, 'Soufi Mehdi', 'profsoufi@gmail.com', '1976-01-08', 1),
(12, 'Meryem Benhadia', 'meryembenhadia@gmail.com', '2004-01-27', 2),
(13, 'Azrour Nada', 'nadaazrour@gmail.com', '2003-05-17', 2),
(16, 'Abdellah Benhadia', 'IOSJU@gmail.com', '2025-01-03', 1),
(18, 'Hiba Benhadia', 'hiba@gmail.com', '2010-11-15', 2),
(21, 'Fati Khardadi', 'fati@gmail.com', '2003-11-26', 2);

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
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`idEtudiant`),
  ADD KEY `idUtilisateur` (`idUtilisateur`),
  ADD KEY `idFiliere` (`idFiliere`);

--
-- Index pour la table `examen`
--
ALTER TABLE `examen`
  ADD PRIMARY KEY (`idExamen`),
  ADD KEY `idModule` (`idModule`);

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
  ADD KEY `fk_note_examen` (`idExamen`);

--
-- Index pour la table `professeur`
--
ALTER TABLE `professeur`
  ADD PRIMARY KEY (`idProfesseur`),
  ADD KEY `professeur_ibfk_1` (`idUtilisateur`);

--
-- Index pour la table `reclamation`
--
ALTER TABLE `reclamation`
  ADD PRIMARY KEY (`idReclamation`),
  ADD KEY `id_etudiant` (`id_etudiant`),
  ADD KEY `id_module` (`id_module`),
  ADD KEY `id_examen` (`id_examen`);

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
  MODIFY `idCompte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `etudiant`
--
ALTER TABLE `etudiant`
  MODIFY `idEtudiant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `examen`
--
ALTER TABLE `examen`
  MODIFY `idExamen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `filiere`
--
ALTER TABLE `filiere`
  MODIFY `idFiliere` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `module`
--
ALTER TABLE `module`
  MODIFY `idModule` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `note`
--
ALTER TABLE `note`
  MODIFY `idNote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `professeur`
--
ALTER TABLE `professeur`
  MODIFY `idProfesseur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `reclamation`
--
ALTER TABLE `reclamation`
  MODIFY `idReclamation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `idRole` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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
-- Contraintes pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `etudiant_ibfk_1` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE CASCADE,
  ADD CONSTRAINT `etudiant_ibfk_2` FOREIGN KEY (`idFiliere`) REFERENCES `filiere` (`idFiliere`) ON DELETE SET NULL;

--
-- Contraintes pour la table `examen`
--
ALTER TABLE `examen`
  ADD CONSTRAINT `examen_ibfk_1` FOREIGN KEY (`idModule`) REFERENCES `module` (`idModule`) ON DELETE CASCADE;

--
-- Contraintes pour la table `module`
--
ALTER TABLE `module`
  ADD CONSTRAINT `fk_idProfesseur` FOREIGN KEY (`idProfesseur`) REFERENCES `professeur` (`idProfesseur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_module_filiere` FOREIGN KEY (`idFiliere`) REFERENCES `filiere` (`idFiliere`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `fk_note_etudiant` FOREIGN KEY (`idEtudiant`) REFERENCES `etudiant` (`idEtudiant`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_note_examen` FOREIGN KEY (`idExamen`) REFERENCES `examen` (`idExamen`) ON DELETE CASCADE;

--
-- Contraintes pour la table `professeur`
--
ALTER TABLE `professeur`
  ADD CONSTRAINT `professeur_ibfk_1` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reclamation`
--
ALTER TABLE `reclamation`
  ADD CONSTRAINT `reclamation_ibfk_1` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiant` (`idEtudiant`) ON DELETE CASCADE,
  ADD CONSTRAINT `reclamation_ibfk_2` FOREIGN KEY (`id_module`) REFERENCES `module` (`idModule`) ON DELETE CASCADE,
  ADD CONSTRAINT `reclamation_ibfk_3` FOREIGN KEY (`id_examen`) REFERENCES `examen` (`idExamen`) ON DELETE CASCADE;

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`idRole`) REFERENCES `role` (`idRole`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
