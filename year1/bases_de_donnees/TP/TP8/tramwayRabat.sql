drop database if exists `tramwayRabat`;

create database if not exists `tramwayRabat`;

show create database `tramwayRabat`;
use `tramwayRabat`;
create table if not exists `arrondissement` (
    `numArrondissement` int primary key not null auto_increment,
    `sperficie` double,
    `rbnHabitants` int
);

create table if not exists `station` (
    `numStation` int primary key not null auto_increment,
    `nomStation` varchar(45),
    `numArrondissement` int,
    constraint `fk1_station` foreign key (`numArrondissement`) references `arrondissement`(`numArrondissement`)
);
create table if not exists `ligne` (
    `numLigne` int primary key not null auto_increment,
    `nbrStation` int,
    `nbrPassager2018` int,
    `DateMService` date,
    `stationDepart` int,
    `stationArrivee` int,
    constraint `fk1_ligne` foreign key (`stationDepart`) references `station`(`numStation`),
    constraint `fk2_ligne` foreign key (`stationArrivee`) references `station`(`numStation`)
);

create table if not exists `travaux` (
    `numArrondissement` int,
    `numLigne` int,
    `dateDebut` date primary key not null,
    `duree` double,
    constraint `fk1_travaux` foreign key (`numArrondissement`) references `arrondissement`(`numArrondissement`),
    constraint `fk2_travaux` foreign key (`numLigne`) references `ligne`(`numLigne`)
);

create index `idx_numArrondissement` on `station`(`numArrondissement`);
create index `idx_stationDepart` on `ligne`(`stationDepart`);
create index `idx_stationArrivee` on `ligne`(`stationArrivee`);
create index `idx_numArrondissement` on `travaux`(`numArrondissement`);
create index `idx_numLigne` on `travaux`(`numLigne`);
alter table `arrondissement` 
    add `nomArrond` varchar(45);

alter table `arrondissement` 
    change column `rbnHabitants` `nbrHabitants` int;
alter table `ligne`
    change column `nbrPassager2018` `nbrPassager2020` int;

select * from `arrondissement`;
select * from `ligne`;

insert into `arrondissement` (`superficie`, `nbrHabitants`, `nomArrond`) values
     (102, 10, "arrondissement2"),
     (80, 8, "arrondissement3"),
     (35.54, 5, "arrondissement4"),
     (302.5, 20, "arrondissement5"),
     (20.3, 3, "arrondissement6"),
     (12.5, 2, "arrondissement7"),
     (150.12, 12, "arrondissement8") ;

alter table `arrondissement`
    change column `sperficie` `superficie` double;
