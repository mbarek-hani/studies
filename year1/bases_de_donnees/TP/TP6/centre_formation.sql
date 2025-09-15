create database if not exists centre_formation;
use centre_formation;
-- la table etudiant
create table if not exists etudiant (
	numCINEtu varchar(10) primary key not null,
    nomEtu varchar(45) not null,
    prenomEtu varchar(45) not null,
    dateNaissEtu date not null,
    niveauEtu varchar(45) not null,
    nomvilleEtu varchar(45) not null,
    adresseEtu varchar(100) not null
);
-- la table formation
create table if not exists formation (
	codeForm int primary key not null auto_increment,
    titreForm varchar(45) not null,
    duree decimal(5) not null,
    prixForm decimal(5) not null
);
-- la table 