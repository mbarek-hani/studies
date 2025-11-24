DROP DATABASE IF EXISTS stagiairesdb;
CREATE DATABASE stagiairesdb;
USE stagiairesdb;

-- TABLE Filiere
CREATE TABLE filiere (
    id_filiere INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100)
);

-- TABLE Module
CREATE TABLE module (
    id_module INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100),
    coef INT,
    id_filiere INT,
    FOREIGN KEY (id_filiere) REFERENCES filiere(id_filiere)
);

-- TABLE Stagiaire
CREATE TABLE stagiaire (
    id_stagiaire INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    date_naissance DATE,
    id_filiere INT,
    FOREIGN KEY (id_filiere) REFERENCES filiere(id_filiere)
);

-- TABLE Note
CREATE TABLE note (
    id_note INT PRIMARY KEY AUTO_INCREMENT,
    id_stagiaire INT,
    id_module INT,
    note DECIMAL(5,2),
    FOREIGN KEY (id_stagiaire) REFERENCES stagiaire(id_stagiaire),
    FOREIGN KEY (id_module) REFERENCES module(id_module)
);

INSERT INTO filiere(nom) VALUES ('Informatique'), ('Gestion');

INSERT INTO module(nom, coef, id_filiere) VALUES
('Algo', 3, 1),
('BD', 2, 1),
('Compta', 4, 2),
('Marketing', 2, 2);

INSERT INTO stagiaire(nom, prenom, date_naissance, id_filiere) VALUES
('Hani', 'Mbarek', '2005-05-12', 1),
('Azarguy', 'Yassine', '2004-09-20', 1),
('Jakouri', 'Ayoub', '2003-03-01', 2);

INSERT INTO note(id_stagiaire, id_module, note) VALUES
(1, 1, 14),
(1, 2, 16),

(2, 1, 10),
(2, 2, 12),

(3, 3, 8),
(3, 4, 10);

-- Question 1
DELIMITER $$

CREATE FUNCTION FN1_AnneeEnCours()
RETURNS INT
BEGIN
    RETURN YEAR(CURDATE());
END$$

DELIMITER ;

-- Question 2
DELIMITER $$

CREATE FUNCTION FN2_AgeStagiaire(dateNaissance DATE)
RETURNS INT
DETERMINISTIC
BEGIN
    RETURN TIMESTAMPDIFF(YEAR, dateNaissance, CURDATE());
END$$

DELIMITER ;

-- Question 3
DELIMITER $$

CREATE FUNCTION FN3_Resultat(note DECIMAL(5,2))
RETURNS VARCHAR(20)
BEGIN
    IF note >= 10 THEN
        RETURN 'Admis';
    ELSE
        RETURN 'Ajourne';
    END IF;
END$$

DELIMITER ;

-- Question 4
DELIMITER $$

CREATE FUNCTION FN4_NbModulesFiliere(idFiliere INT)
RETURNS INT
DETERMINISTIC
BEGIN
    DECLARE nb INT;
    SELECT COUNT(*) INTO nb
    FROM module WHERE id_filiere = idFiliere;
    RETURN nb;
END$$

DELIMITER ;

-- Question 5
DELIMITER $$

CREATE FUNCTION FN5_CoefMoyenFiliere(idFiliere INT)
RETURNS DECIMAL(5,2)
DETERMINISTIC
BEGIN
    DECLARE res DECIMAL(5,2);
    SELECT AVG(coef) INTO res
    FROM module WHERE id_filiere = idFiliere;
    RETURN res;
END$$

DELIMITER ;

-- Question 6
DELIMITER $$

CREATE FUNCTION FN6_MoyenneSimple(idStag INT)
RETURNS DECIMAL(5,2)
DETERMINISTIC
BEGIN
    DECLARE moy DECIMAL(5,2);
    SELECT AVG(note) INTO moy
    FROM note WHERE id_stagiaire = idStag;
    RETURN moy;
END$$

DELIMITER ;

-- Question 7
DELIMITER $$

CREATE FUNCTION FN7_Mention(moy DECIMAL(5,2))
RETURNS VARCHAR(20)
DETERMINISTIC
BEGIN
    IF moy >= 16 THEN RETURN 'Très Bien';
    ELSEIF moy >= 14 THEN RETURN 'Bien';
    ELSEIF moy >= 12 THEN RETURN 'Assez Bien';
    ELSEIF moy >= 10 THEN RETURN 'Passable';
    ELSE RETURN 'Insuffisant';
    END IF;
END$$

DELIMITER ;

-- Question 8
DELIMITER $$

CREATE FUNCTION FN8_MoyennePonderee(idStag INT)
RETURNS DECIMAL(5,2)
DETERMINISTIC
BEGIN
    DECLARE mp DECIMAL(5,2);

    SELECT SUM(n.note * m.coef) / SUM(m.coef)
    INTO mp
    FROM note n 
    JOIN module m ON n.id_module = m.id_module
    WHERE id_stagiaire = idStag;

    RETURN mp;
END$$

DELIMITER ;

-- Question 9
DELIMITER $$

CREATE FUNCTION FN9_Statut(idStag INT)
RETURNS VARCHAR(20)
DETERMINISTIC
BEGIN
    DECLARE m DECIMAL(5,2);
    SET m = FN8_MoyennePonderee(idStag);

    IF m >= 10 THEN RETURN 'Admis';
    ELSE RETURN 'Ajourne';
    END IF;
END$$

DELIMITER ;

-- Procédure qui appelle la fonction
DELIMITER $$
CREATE PROCEDURE PRC_StatutStagiaire(IN idStag INT)
BEGIN
    SELECT FN9_Statut(idStag) AS statut;
END$$

DELIMITER ;

-- Question 10
SHOW FUNCTION STATUS WHERE Db = 'stagiairesdb';

-- Tests de vérification
SELECT FN1_AnneeEnCours();

SELECT FN2_AgeStagiaire('2001-12-04');

SELECT FN3_Resultat(9), FN3_Resultat(12);

SELECT FN4_NbModulesFiliere(1);  
SELECT FN5_CoefMoyenFiliere(1);

SELECT FN6_MoyenneSimple(1);

SELECT FN7_Mention(15), FN7_Mention(11);

SELECT FN8_MoyennePonderee(1);

SELECT FN9_Statut(1);

CALL PRC_StatutStagiaire(1);

