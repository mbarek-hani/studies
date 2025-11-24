DELIMITER &&
CREATE PROCEDURE `sp_1`()
begin
select NumFiliere, NomFiliere from Filiere;
end &&
DELIMITER ;

DELIMITER &&
CREATE PROCEDURE `sp_2`(nom_secteur varchar(255))
begin
select f.NumFiliere, f.NomFiliere from Filiere f inner join Secteur s using(CodSecteur) where NomSecteur=nom_secteur;
end &&
DELIMITER ;

DELIMITER &&
CREATE PROCEDURE `sp_3`(nom_filiere varchar(255))
begin
select m.NumModule, m.NomModule
from Programme p
inner join Module m using(NumModule)
inner join Filiere f using(NumFiliere)
where f.NomFiliere=nom_filiere;
end &&
DELIMITER ;

DELIMITER &&
CREATE PROCEDURE `sp_4`(IN in_NomSecteur VARCHAR(100))
BEGIN
    SELECT DISTINCT m.NumModule, m.NomModule
    FROM Module m
    JOIN Programme p ON m.NumModule = p.NumModule
    JOIN Filiere f ON p.NumFiliere = f.NumFiliere
    JOIN Secteur s ON f.CodSecteur = s.CodSecteur
    WHERE s.NomSecteur = in_NomSecteur
    ORDER BY m.NumModule;
END &&
DELIMITER ;

DELIMITER &&
CREATE PROCEDURE `sp_5`()
BEGIN
    SELECT st.NumStagiaire, st.NomStagiaire
    FROM Stagiaire st
    LEFT JOIN Notation n ON st.NumStagiaire = n.NumStagiaire
    WHERE n.NumModule IS NULL
    ORDER BY st.NumStagiaire;
END &&
DELIMITER ;

DELIMITER &&
CREATE PROCEDURE `sp_6`()
BEGIN
    SELECT COUNT(*) AS NombreFiliere
    FROM Filiere;
END &&
DELIMITER ;

DELIMITER &&
CREATE PROCEDURE `sp_7`()
BEGIN
    SELECT f.NumFiliere, f.NomFiliere, COUNT(p.NumModule) AS NombreModules
    FROM Filiere f
    LEFT JOIN Programme p ON f.NumFiliere = p.NumFiliere
    GROUP BY f.NumFiliere, f.NomFiliere
    ORDER BY f.NumFiliere;
END &&
DELIMITER ;

DELIMITER &&
CREATE PROCEDURE `sp_8`(IN in_NomSecteur VARCHAR(100))
BEGIN
    SELECT f.NumFiliere, f.NomFiliere, COUNT(p.NumModule) AS NombreModules
    FROM Filiere f
    LEFT JOIN Programme p ON f.NumFiliere = p.NumFiliere
    JOIN Secteur s ON f.CodSecteur = s.CodSecteur
    WHERE s.NomSecteur = in_NomSecteur
    GROUP BY f.NumFiliere, f.NomFiliere
    ORDER BY f.NumFiliere;
END &&
DELIMITER ;

DELIMITER &&
CREATE PROCEDURE `sp_9`()
BEGIN
    SELECT f.NumFiliere, f.NomFiliere, COUNT(p.NumModule) AS NombreModules
    FROM Filiere f
    JOIN Programme p ON f.NumFiliere = p.NumFiliere
    GROUP BY f.NumFiliere, f.NomFiliere
    HAVING COUNT(p.NumModule) > 10
    ORDER BY NombreModules DESC;
END &&
DELIMITER ;

DELIMITER &&
CREATE PROCEDURE `sp_10`(IN in_Date DATE)
BEGIN
    SELECT NumStagiaire, NomStagiaire, DateNaissance
    FROM Stagiaire
    WHERE DateNaissance < in_Date
    ORDER BY DateNaissance;
END &&
DELIMITER ;

DELIMITER &&
CREATE PROCEDURE `sp_11`(IN in_NumStagiaire INT)
BEGIN
    SELECT m.NumModule, m.NomModule, n.Note,
           COALESCE(p.Coefficient, 0) AS Coefficient
    FROM Notation n
    JOIN Module m ON n.NumModule = m.NumModule
    LEFT JOIN Stagiaire s ON n.NumStagiaire = s.NumStagiaire
    LEFT JOIN Programme p ON p.NumFiliere = s.NumFiliere AND p.NumModule = m.NumModule
    WHERE n.NumStagiaire = in_NumStagiaire
    ORDER BY m.NumModule;
END &&
DELIMITER ;

DELIMITER &&
CREATE PROCEDURE `sp_12`(IN in_NomSecteur VARCHAR(100))
BEGIN
    DECLARE cnt_filiere INT DEFAULT 0;
    
    SELECT COUNT(*) INTO cnt_filiere
    FROM Filiere f
    JOIN Secteur s ON f.CodSecteur = s.CodSecteur
    WHERE s.NomSecteur = in_NomSecteur;

    IF cnt_filiere = 0 THEN
        
        SELECT 'Aucune filière trouvée pour ce secteur' AS Info;
    ELSE
        SELECT m.NumModule, m.NomModule
        FROM Module m
        JOIN Programme p ON m.NumModule = p.NumModule
        JOIN Filiere f ON p.NumFiliere = f.NumFiliere
        JOIN Secteur s ON f.CodSecteur = s.CodSecteur
        WHERE s.NomSecteur = in_NomSecteur
        GROUP BY m.NumModule, m.NomModule
        HAVING COUNT(DISTINCT p.NumFiliere) = cnt_filiere
        ORDER BY m.NumModule;
    END IF;
END &&
DELIMITER ;

DELIMITER &&
CREATE PROCEDURE `sp_13`(IN in_NumStagiaire INT, IN in_NumModule INT)
BEGIN
    SELECT n.NumModule, m.NomModule, n.NumStagiaire, n.Note
    FROM Notation n
    JOIN Module m ON n.NumModule = m.NumModule
    WHERE n.NumStagiaire = in_NumStagiaire
      AND n.NumModule = in_NumModule;
END &&
DELIMITER ;

/* Partie 2 */

create database if not exists tp_partie_2;

use tp_partie_2;

create table Client (
    idc int not null primary key auto_increment, 
    nom varchar(255),
    prenom varchar(255),
    ville varchar(255)
);

create table Produit (
    idp int not null primary key auto_increment,
    libelle varchar(255),
    prixunitaire decimal(10, 2)
);

create table Commande (
    idcmd int not null primary key auto_increment,
    idc int,
    idp int,
    datecmd date,
    qtitecmd int,
    foreign key(idc) references Client(idc),
    foreign key(idp) references Produit(idp)
);
