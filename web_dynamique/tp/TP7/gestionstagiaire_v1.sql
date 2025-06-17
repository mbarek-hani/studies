-- ============================================
-- Base de données: gestionstagiaire_v1
-- ============================================

-- Création de la base de données
CREATE DATABASE IF NOT EXISTS gestionstagiaire_v1;
USE gestionstagiaire_v1;

-- ============================================
-- Table: compteadministrateur
-- ============================================
CREATE TABLE compteadministrateur (
    loginAdmin VARCHAR(20) NOT NULL,
    motPasse VARCHAR(20) NOT NULL,
    nom VARCHAR(30) NOT NULL,
    prenom VARCHAR(30) NOT NULL,
    PRIMARY KEY (loginAdmin)
);

-- ============================================
-- Table: filiere
-- ============================================
CREATE TABLE filiere (
    idFiliere VARCHAR(15) NOT NULL,
    intitule VARCHAR(30) NOT NULL,
    nombreGroupe INT NOT NULL,
    PRIMARY KEY (idFiliere)
);

-- ============================================
-- Table: stagiaire
-- ============================================
CREATE TABLE stagiaire (
    idStagiaire INT NOT NULL AUTO_INCREMENT,
    nom VARCHAR(30) NOT NULL,
    prenom VARCHAR(30) NOT NULL,
    dateNaissance DATE NOT NULL,
    photoProfil TEXT,
    idFiliere VARCHAR(15) NOT NULL,
    PRIMARY KEY (idStagiaire),
    FOREIGN KEY (idFiliere) REFERENCES filiere(idFiliere)
        ON DELETE CASCADE 
        ON UPDATE CASCADE
);

-- ============================================
-- Insertion de données de test
-- ============================================

-- Données pour la table compteadministrateur
INSERT INTO compteadministrateur (loginAdmin, motPasse, nom, prenom) VALUES
('admin', 'admin123', 'Alami', 'Mohamed'),
('user1', 'pass123', 'Bennani', 'Fatima'),
('user2', 'test456', 'Khaldi', 'Ahmed');

-- Données pour la table filiere
INSERT INTO filiere (idFiliere, intitule, nombreGroupe) VALUES
('DEV', 'Développement Digital', 3),
('GES', 'Gestion Entreprise', 2),
('COM', 'Commerce Digital', 2),
('RES', 'Réseaux Informatique', 1),
('OFF', 'Bureautique Office', 1);

-- Données pour la table stagiaire
INSERT INTO stagiaire (nom, prenom, dateNaissance, photoProfil, idFiliere) VALUES
('Toumi', 'Youssef', '2000-05-15', NULL, 'DEV'),
('Fassi', 'Aicha', '1999-12-22', NULL, 'GES'),
('Berrada', 'Karim', '2001-03-08', NULL, 'DEV'),
('Senhaji', 'Nadia', '2000-09-17', NULL, 'COM'),
('Mansouri', 'Omar', '1999-07-03', NULL, 'RES'),
('Idrissi', 'Salma', '2001-01-25', NULL, 'DEV'),
('Zahra', 'Hassan', '2000-11-12', NULL, 'GES'),
('Amrani', 'Laila', '1999-04-30', NULL, 'OFF');
