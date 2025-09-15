use centreFormation;

update `SESSION` set `dateDebut` = "2025-07-12", `dateFin` = "2027-03-18" where `codeSess` = 1102;
alter table `SESSION` MODIFY `dateFin` date not null; -- corriger la column dateFin dans SESSION
-- Q1
select * from `ETUDIANT`;
select * from `SESSION`;
select * from `Formation`;
select * from `SPECIALITE`;
select * from `Inscription`;
select * from `Catalogue`;

-- Q2
select * from `ETUDIANT` where `villeEtu` = 'Tanger';
select * from `ETUDIANT` where `villeEtu` like 'Tanger';

-- Q3
select * from `Formation` where `prixForm` > 3000;

-- Q4
select codeForm, titreForm, prixForm/dureeForm as prixJournalier from `Formation`;

-- Q5

select * 
    from 
    `Formation` as f 
    join `SESSION` as s 
    on f.`SESSION_codeSess` = s.`codeSess` 
    where s.`dateDebut` > CURRENT_DATE;

select * from `Formation` where `SESSION_codeSess` in (select codeSess from `SESSION` where `dateDebut` > CURRENT_DATE);


-- Q6
 select i.`numCINEtu` from `Inscription` as i where `codeSess` = 1302 order by i.`numCINEtu` asc;

 -- Q7
 select * from `SPECIALITE` where active = 1;
