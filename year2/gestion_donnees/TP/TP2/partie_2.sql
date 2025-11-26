CREATE DATABASE TP1;
USE TP1;

CREATE TABLE Client (
    idc INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50),
    prenom VARCHAR(50),
    ville VARCHAR(50)
);

CREATE TABLE Produit (
    idp INT PRIMARY KEY AUTO_INCREMENT,
    libelle VARCHAR(100),
    prixunitaire DECIMAL(10,2)
);

CREATE TABLE Commande (
    idcmd INT PRIMARY KEY AUTO_INCREMENT,
    idc INT,
    idp INT,
    datecmd DATE,
    qtitecmd INT,
    FOREIGN KEY (idc) REFERENCES Client(idc),
    FOREIGN KEY (idp) REFERENCES Produit(idp)
);

INSERT INTO Client (nom, prenom, ville) VALUES
('Benali', 'Ahmed', 'Agadir'),
('El Amrani', 'Fatima', 'Casablanca'),
('Tazi', 'Mohammed', 'Rabat'),
('Berrada', 'Sara', 'Marrakech'),
('Chakir', 'Youssef', 'Tanger'),
('Alami', 'Laila', 'Fes'),
('Mansouri', 'Hassan', 'Agadir'),
('Kettani', 'Nadia', 'Casablanca'),
('Idrissi', 'Karim', 'Essaouira'),
('Ziani', 'Amina', 'Agadir'),
('Hafidi', 'Omar', 'Meknes'),
('Belkadi', 'Samira', 'Tetouan'),
('Fassi', 'Mehdi', 'Rabat'),
('Lahlou', 'Zineb', 'Agadir'),
('Rachidi', 'Tarik', 'Marrakech');

-- =====================================================
-- Insert Test Data into PRODUIT Table
-- =====================================================
INSERT INTO Produit (libelle, prixunitaire) VALUES
('Ordinateur Portable HP', 6500.00),
('Smartphone Samsung Galaxy', 3200.00),
('Tablette iPad', 4500.00),
('Clavier Sans Fil', 250.00),
('Souris Optique', 120.00),
('Écran LCD 24 pouces', 1800.00),
('Imprimante Laser', 2200.00),
('Disque Dur Externe 1To', 650.00),
('Webcam HD', 380.00),
('Casque Audio Bluetooth', 450.00),
('Chargeur Universel', 180.00),
('Câble HDMI', 95.00),
('Routeur WiFi', 520.00),
('Adaptateur USB-C', 150.00),
('Batterie Externe 20000mAh', 320.00),
('Support Laptop', 280.00),
('Microphone USB', 550.00),
('Enceinte Bluetooth', 680.00),
('Tapis de Souris Gaming', 140.00),
('Clé USB 64GB', 110.00);

-- =====================================================
-- Insert Test Data into COMMANDE Table
-- =====================================================
INSERT INTO Commande (idc, idp, datecmd, qtitecmd) VALUES
(1, 1, '2024-01-15', 1),
(1, 4, '2024-01-15', 2),
(1, 5, '2024-02-20', 1),
(2, 2, '2024-01-18', 1),
(2, 10, '2024-01-18', 1),
(2, 15, '2024-03-05', 2),
(3, 3, '2024-02-01', 1),
(3, 6, '2024-02-01', 1),
(3, 7, '2024-02-15', 1),
(4, 2, '2024-02-10', 2),
(4, 11, '2024-03-12', 3),
(5, 1, '2024-02-14', 1),
(5, 8, '2024-02-14', 2),
(5, 13, '2024-03-20', 1),
(6, 4, '2024-03-01', 1),
(6, 5, '2024-03-01', 1),
(6, 19, '2024-03-01', 3),
(7, 7, '2024-03-08', 1),
(7, 9, '2024-03-25', 2),
(8, 3, '2024-03-15', 1),
(8, 10, '2024-04-02', 1),
(8, 18, '2024-04-02', 1),
(9, 2, '2024-04-05', 1),
(9, 12, '2024-04-05', 5),
(9, 20, '2024-04-10', 10),
(10, 6, '2024-04-12', 2),
(10, 14, '2024-05-01', 3),
(11, 1, '2024-05-05', 1),
(11, 16, '2024-05-05', 2),
(12, 17, '2024-05-10', 1),
(12, 8, '2024-05-15', 1),
(13, 7, '2024-05-20', 2),
(13, 9, '2024-06-01', 1),
(13, 11, '2024-06-01', 5),
(14, 4, '2024-06-10', 1),
(14, 5, '2024-06-10', 1),
(14, 15, '2024-06-15', 1),
(15, 1, '2024-06-20', 1),
(15, 3, '2024-07-01', 1),
(15, 18, '2024-07-05', 2);

DELIMITER $$
CREATE PROCEDURE AjoutClient(IN p_nom VARCHAR(50), IN p_prenom VARCHAR(50), IN p_ville VARCHAR(50))
BEGIN
    INSERT INTO Client(nom, prenom, ville)
    VALUES(p_nom, p_prenom, p_ville);
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE AjoutProduit(IN p_libelle VARCHAR(100), IN p_prix DECIMAL(10,2))
BEGIN
    INSERT INTO Produit(libelle, prixunitaire)
    VALUES(p_libelle, p_prix);
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE Commander(IN p_idc INT, IN p_idp INT, IN p_date DATE, IN p_qte INT)
BEGIN
    INSERT INTO Commande(idc,idp,datecmd,qtitecmd)
    VALUES(p_idc, p_idp, p_date, p_qte);
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE ClientsParLettre(IN p_lettre VARCHAR(1))
BEGIN
    SELECT * FROM Client
    WHERE nom LIKE CONCAT(p_lettre, '%');
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE CommandesParPeriode(IN d1 DATE, IN d2 DATE)
BEGIN
    SELECT * FROM Commande
    WHERE datecmd BETWEEN d1 AND d2;

    SET @nb = (SELECT COUNT(*) FROM Commande WHERE datecmd BETWEEN d1 AND d2);

    IF @nb > 100 THEN
        SELECT 'Période rouge' AS Observation;
    ELSEIF @nb BETWEEN 50 AND 100 THEN
        SELECT 'Période jaune' AS Observation;
    ELSE
        SELECT 'Période blanche' AS Observation;
    END IF;
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE meilleur5()
BEGIN
    CREATE TEMPORARY TABLE IF NOT EXISTS Meilleur5 (
        idcmd INT,
        idc INT,
        idp INT,
        datecmd DATE,
        qtitecmd INT
    );

    INSERT INTO Top5
    SELECT * FROM Commande
    ORDER BY qtitecmd DESC
    LIMIT 5;
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE ObservationClients()
BEGIN
    SELECT 
        c.idc,
        c.nom,
        c.prenom,
        COUNT(cmd.idcmd) AS nb_commandes,
        CASE
            WHEN COUNT(cmd.idcmd) > 10 THEN 'Client classe A'
            WHEN COUNT(cmd.idcmd) BETWEEN 5 AND 10 THEN 'Client classe B'
            WHEN COUNT(cmd.idcmd) BETWEEN 2 AND 5 THEN 'Client classe C'
            ELSE 'nbre commande <2'
        END AS Observation
    FROM Client c
    LEFT JOIN Commande cmd 
        ON c.idc = cmd.idc 
        AND YEAR(cmd.datecmd) = YEAR(CURDATE())
    GROUP BY c.idc;
END $$
DELIMITER ;

CALL `ObservationClients`();