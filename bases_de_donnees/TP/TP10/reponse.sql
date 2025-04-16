use centreFormation;

--Q1
select F.`titreForm`, S.`nomSess`, S.`dateDebut`, S.`dateFin` 
from `Formation` F
inner join `SESSION` S
on F.`SESSION_codeSess` = S.`codeSess`
where S.`dateDebut` > CURRENT_DATE;

--Q2
select F.`titreForm`, E.`numCINEtu`, E.`nomEtu`, E.`prenomEtu` from `Inscription` I
inner join `SESSION` S
on S.`codeSess` = I.`codeSess`
inner join `ETUDIANT` E
on E.`numCINEtu` = I.`numCINEtu`
inner join `Formation` F
on F.`SESSION_codeSess` = S.`codeSess`
order by F.`titreForm` asc;

--Q3
select I.`typeCours`, count(F.`titreForm`) as `nombre_inscription` from `Inscription` I
inner join `SESSION` S
on S.`codeSess` = I.`codeSess`
inner join `Formation` F
on F.`SESSION_codeSess` = S.`codeSess`
where F.`titreForm` = "Soft skills"
group by I.`typeCours`;

--Q4
select * from `Inscription` I
join `SESSION` S
on S.`codeSess` = I.`codeSess`
join `Formation` F
where I.`typeCours` = "Distanciel";


--Q5
SELECT 
    `sp`.`nomSpec`,
    `f`.`titreForm`,
    `f`.`dureeForm`,
    `f`.`prixForm`
FROM 
    `SPECIALITE` `sp`
JOIN 
    `Catalogue` `c` ON `sp`.`codeSpec` = `c`.`codeSpec`
JOIN 
    `Formation` `f` ON `c`.`codeForm` = `f`.`codeForm`
WHERE 
    `sp`.`active` = 1
ORDER BY 
    `sp`.`nomSpec` DESC;

