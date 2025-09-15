DROP DATABASE centreFormation;
CREATE SCHEMA IF NOT EXISTS `centreFormation` DEFAULT CHARACTER SET utf8 ;
USE `centreFormation` ;
-- -----------------------------------------------------
-- Table `centreFormation`.`ETUDIANT`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `centreFormation`.`ETUDIANT` (
    `numCINEtu` VARCHAR(10) NOT NULL,
    `nomEtu` VARCHAR(45) NULL,
    `prenomEtu` VARCHAR(45) NULL,
    `dateNaissance` DATE NULL,
    `adressEtu` VARCHAR(45) NULL,
    `villeEtu` VARCHAR(45) NULL,
    `niveauEtu` VARCHAR(45) NULL,
    PRIMARY KEY (`numCINEtu`)
) ENGINE = InnoDB;
-- -----------------------------------------------------
-- Table `centreFormation`.`SESSION`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `centreFormation`.`SESSION` (
    `codeSess` INT NOT NULL,
    `nomSess` VARCHAR(45) NULL,
    `dateDebut` DATE NULL,
    `dateFin` VARCHAR(45) NULL,
    PRIMARY KEY (`codeSess`)
) ENGINE = InnoDB;
-- -----------------------------------------------------
-- Table `centreFormation`.`Formation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `centreFormation`.`Formation` (
    `codeForm` INT NOT NULL,
    `titreForm` VARCHAR(45) NULL,
    `dureeForm` DOUBLE NULL,
    `prixForm` DOUBLE NULL,
    `SESSION_codeSess` INT NOT NULL,
    PRIMARY KEY (`codeForm`, `SESSION_codeSess`),
    INDEX `fk_Formation_SESSION1_idx` (`SESSION_codeSess` ASC) VISIBLE,
    CONSTRAINT `fk_Formation_SESSION1`
    FOREIGN KEY (`SESSION_codeSess`)
    REFERENCES `centreFormation`.`SESSION` (`codeSess`)
    ON DELETE NO ACTION 
    ON UPDATE NO ACTION
) ENGINE = InnoDB;
-- -----------------------------------------------------
-- Table `centreFormation`.`SPECIALITE`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `centreFormation`.`SPECIALITE` (
    `codeSpec` INT NOT NULL,
    `nomSpec` VARCHAR(45) NULL,
    `descSpec` VARCHAR(45) NULL,
    PRIMARY KEY (`codeSpec`)
) ENGINE = InnoDB;
-- -----------------------------------------------------
-- Table `centreFormation`.`Inscription`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `centreFormation`.`Inscription` (
    `codeSess` INT NOT NULL,
    `numCINEtu` VARCHAR(10) NOT NULL,
    `typeCours` VARCHAR(45),
    PRIMARY KEY (`codeSess`, `numCINEtu`),
    INDEX `fk_SESSION_has_ETUDIANT_ETUDIANT1_idx` (`numCINEtu` ASC) VISIBLE,
    INDEX `fk_SESSION_has_ETUDIANT_SESSION_idx` (`codeSess` ASC) VISIBLE,
    CONSTRAINT `fk_SESSION_has_ETUDIANT_SESSION`
    FOREIGN KEY (`codeSess`)
    REFERENCES `centreFormation`.`SESSION` (`codeSess`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    CONSTRAINT `fk_SESSION_has_ETUDIANT_ETUDIANT1`
    FOREIGN KEY (`numCINEtu`)
    REFERENCES `centreFormation`.`ETUDIANT` (`numCINEtu`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE = InnoDB;
-- -----------------------------------------------------
-- Table `centreFormation`.`Catalogue`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `centreFormation`.`Catalogue` (
    `codeSpec` INT NOT NULL,
    `codeForm` INT NOT NULL,
    PRIMARY KEY (`codeSpec`, `codeForm`),
    INDEX `fk_SPECIALITE_has_Formation_Formation1_idx` (`codeForm` ASC) VISIBLE,
    INDEX `fk_SPECIALITE_has_Formation_SPECIALITE1_idx` (`codeSpec` ASC) VISIBLE,
    CONSTRAINT `fk_SPECIALITE_has_Formation_SPECIALITE1`
    FOREIGN KEY (`codeSpec`)
    REFERENCES `centreFormation`.`SPECIALITE` (`codeSpec`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    CONSTRAINT `fk_SPECIALITE_has_Formation_Formation1`
    FOREIGN KEY (`codeForm`)
    REFERENCES `centreFormation`.`Formation` (`codeForm`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE = InnoDB;

alter table `centreFormation`.`SPECIALITE` add `active` boolean not null;

INSERT INTO `centreFormation`.`ETUDIANT` VALUES
    ('AB234567', 'Alami', 'Ahmad', '1986-01-01', 'Rue du port, 13', 'Tanger', 'bac'),
    ('G5346789', 'Toumi', 'Aicha', '2000-12-03', 'N12 immeuble Jaouhara', 'Casablanca', 'Master'),
    ('C0987265', 'Souni', 'Sanaa', '1998-04-30', 'Place du peuple n 2', 'Tanger', 'Niveau bac'),
    ('D2356903', 'Idrissi Alami', 'Mohammed', '1996-05-05', 'Lotissement najah, rue n 12 immeuble 3', 'Rabat', 'Bac+ 4'),
    ('Y1234987', 'Ouled thami', 'Ali', '1979-04-12', 'La ville haute, rue chouhada n 6', 'Tanger', 'Bachelor'),
    ('J3578902', 'Ben Omar', 'Abd Allah', '1990-05-25', 'Villa Amina n12 bir rami', 'Kenitra', 'Phd'),
    ('F9827363', 'Boudiaf', 'Fatima Zohra', '1997-10-01', 'Immeuble iftikhar, n 13 ettakaddoum', 'Rabat', 'Bac + 2');


INSERT INTO `centreFormation`.`SESSION` VALUES
    (1101, 'Session1101', '2022-01-02', '2022-01-14'),
    (1102, 'Session 1102', '2022-02-03', '2022-02-15'),
    (1201, 'Session 1201', '2022-03-04', '2022-03-18'),
    (1202, 'Session 1202', '2022-04-05', '2022-04-19'),
    (1301, 'Session 1301', '2022-01-06', '2022-01-21'),
    (1302, 'Session 1302', '2022-05-07', '2022-05-22'),
    (1303, 'Session 1303', '2022-06-08', '2022-06-23'),
    (1401, 'Session 1401', '2022-09-01', '2022-09-11'),
    (1402, 'Session 1402', '2022-08-08', '2022-08-18'),
    (1501, 'Session 1501', '2022-11-11', '2022-12-01'),
    (1502, 'Session 1502', '2022-09-12', '2022-10-02'),
    (1601, 'Session 1601', '2022-09-13', '2022-09-25'),
    (1602, 'Session 1602', '2022-10-14', '2022-10-26'),
    (1104, 'Session 1104', '2022-10-15', '2022-10-27'),
    (1203, 'Session 1203', '2022-11-16', '2022-11-30'),
    (1204, 'Session 1204', '2022-12-17', '2022-12-31');
INSERT INTO `centreFormation`.`Formation` VALUES
    (11, 'Programming Java', 12, 3600, 1101),
    (12, 'web developpment', 14, 4200, 1102),
    (13, 'Anglais technique', 15, 3750, 1202),
    (14, 'Communication', 10, 2500, 1101),
    (15, 'Base de données Oracle', 20, 6000, 1401),
    (16, 'Soft skills', 12, 3000, 1501);

INSERT INTO `centreFormation`.`SPECIALITE` VALUES
    (101, 'GL', 'Genie logiciel et developpement', 1),
    (102, 'Data', 'Data engineering', 1),
    (103, 'Langues', 'Anglais, Français', 1),
    (104, 'Communication', 'Communication', 1),
    (105, 'Securite', 'Reseaux et securite', 0);

INSERT INTO `centreFormation`.`Catalogue` VALUES
    (101, 11),
    (101, 12),
    (102, 15),
    (101, 15),
    (103, 13),
    (104, 13),
    (104, 14),
    (104, 16);

INSERT INTO `centreFormation`.`Inscription` VALUES
    (1101, 'AB234567', 'Distanciel'),
    (1101, 'G5346789', 'Distanciel'),
    (1101, 'C0987265', 'Distanciel'),
    (1101, 'D2356903', 'Distanciel'),
    (1101, 'Y1234987', 'Distanciel'),
    (1101, 'J3578902', 'Distanciel'),
    (1101, 'F9827363', 'Distanciel'),
    (1201, 'AB234567', 'Presentiel'),
    (1201, 'G5346789', 'Presentiel'),
    (1201, 'C0987265', 'Presentiel'),
    (1201, 'D2356903', 'Presentiel'),
    (1201, 'Y1234987', 'Presentiel'),
    (1201, 'J3578902', 'Presentiel'),
    (1302, 'AB234567', 'Presentiel'),
    (1302, 'G5346789', 'Distanciel'),
    (1302, 'C0987265', 'Presentiel'),
    (1302, 'D2356903', 'Distanciel'),
    (1302, 'Y1234987', 'Presentiel'),
    (1401, 'G5346789', 'Distanciel'),
    (1401, 'C0987265', 'Distanciel'),
    (1401, 'D2356903', 'Distanciel'),
    (1401, 'Y1234987', 'Distanciel'),
    (1401, 'J3578902', 'Distanciel'),
    (1401, 'F9827363', 'Distanciel'),
    (1501, 'AB234567', 'Distanciel'),
    (1501, 'G5346789', 'Presentiel'),
    (1501, 'C0987265', 'Distanciel'),
    (1501, 'D2356903', 'Presentiel'),
    (1501, 'Y1234987', 'Presentiel'),
    (1501, 'J3578902', 'Presentiel'),
    (1501, 'F9827363', 'Presentiel');

alter table `SESSION` MODIFY `dateFin` date not null; -- corriger la column dateFin dans SESSION