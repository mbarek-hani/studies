CREATE DATABASE GestionStag;

USE GestionStag;

-- Secteur Table
CREATE TABLE Secteur (
    CodSecteur INT PRIMARY KEY,
    NomSecteur VARCHAR(100) NOT NULL
);

-- Filiere Table
CREATE TABLE Filiere (
    NumFiliere INT PRIMARY KEY,
    NomFiliere VARCHAR(100) NOT NULL,
    CodSecteur INT,
    FOREIGN KEY (CodSecteur) REFERENCES Secteur(CodSecteur) ON DELETE SET NULL
);

-- Stagiaire Table
CREATE TABLE Stagiaire (
    NumStagiaire INT PRIMARY KEY,
    NomStagiaire VARCHAR(100) NOT NULL,
    SexeStagiaire ENUM('M', 'F') NOT NULL,
    DateNaissance DATE NOT NULL,
    NumFiliere INT,
    FOREIGN KEY (NumFiliere) REFERENCES Filiere(NumFiliere) ON DELETE SET NULL
);

-- Module Table
CREATE TABLE Module (
    NumModule INT PRIMARY KEY,
    NomModule VARCHAR(100) NOT NULL
);

-- Programme Table (Associative Table between Filiere and Module)
CREATE TABLE Programme (
    NumFiliere INT,
    NumModule INT,
    Coefficient INT NOT NULL,
    PRIMARY KEY (NumFiliere, NumModule),
    FOREIGN KEY (NumFiliere) REFERENCES Filiere(NumFiliere) ON DELETE CASCADE,
    FOREIGN KEY (NumModule) REFERENCES Module(NumModule) ON DELETE CASCADE
);

-- Notation Table (Associative Table between Stagiaire and Module)
CREATE TABLE Notation (
    NumModule INT,
    NumStagiaire INT,
    Note DECIMAL(5,2) CHECK (Note >= 0 AND Note <= 20),
    PRIMARY KEY (NumModule, NumStagiaire),
    FOREIGN KEY (NumModule) REFERENCES Module(NumModule) ON DELETE CASCADE,
    FOREIGN KEY (NumStagiaire) REFERENCES Stagiaire(NumStagiaire) ON DELETE CASCADE
);

-- Insert Data
INSERT INTO Secteur VALUES (1, 'Informatique'), (2, 'Gestion'), (3, 'Commerce');
INSERT INTO Filiere VALUES (1, 'Développement Web', 1), (2, 'Réseaux', 1), (3, 'Comptabilité', 2);
INSERT INTO Stagiaire VALUES 
    (1, 'Alice', 'F', '2000-05-10', 1),
    (2, 'Bob', 'M', '1999-09-15', 2),
    (3, 'Charlie', 'M', '2001-01-20', 3),
    (4, 'Diana', 'F', '2002-07-08', NULL);
INSERT INTO Module VALUES 
    (1, 'Base de Données'), 
    (2, 'Programmation'), 
    (3, 'Sécurité'), 
    (4, 'Gestion Financière');
INSERT INTO Programme VALUES 
    (1, 1, 4), (1, 2, 3), (2, 3, 5), (3, 4, 4);
INSERT INTO Notation VALUES 
    (1, 1, 15.5), 
    (2, 1, 18.0), 
    (3, 2, 12.0),
    (4, 3, 14.5);
    
select * from Notation;
select * from Notation;