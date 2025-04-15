create database if not exists `gestionNotes`;

use `gestionNotes`;

create table if not exists `Produits` (
    `Num_Produit` varchar(18) primary key,
    `Descriprti` varchar(40) default "Non specifie",
    `cout` decimal(10, 2) not null check (cout >= 0),
    `prix` decimal(10, 2) not null,
    `Date_ajout` date,
    constraint `check1` check(`prix` >= `cout`)
);

create table if not exists`Commandes` (
    `id_com` int not null primary key auto_increment,
    `description` varchar(256),
    `Num_Produit` varchar(18),
    constraint `pk1_Commandes` foreign key (`Num_Produit`) references `Produits`(`Num_Produit`) on delete cascade
);


insert into `Produits`(`Num_Produit`, `Descriprti`, `cout`, `prix`, `Date_ajout`) values 
    ('P12','', 8, 14, CURRENT_DATE),
    ('P100','Laptop', 8, 14, '2011-12-04'),
    ('P5231JK12', 'refrigirateur', 8, 14, '2025-01-12')
    ;

insert into `Produits`(`Num_Produit`, `Descriprti`, `cout`, `prix`, `Date_ajout`) values 
    ('A23H', default, 20, 25, '2012-05-12')
    ;

insert into `Commandes`(`description`, `Num_Produit`) values
    ('desc1', 'P100'),
    ('desc2', 'P100'),
    ('desc3', 'A23H'),
    ('desc4', 'P12');

update `Produits` set `descriprti` = 'Voiture' where `Num_Produit` = 'A23H';

delete from `Produits` where `Num_Produit` = "P100";

select * from `Produits`;

select * from `Commandes`;