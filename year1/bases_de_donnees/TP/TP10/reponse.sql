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
order by F.`titreForm`;

--Q3
select I.`typeCours`, count(F.`titreForm`) as `nombre_inscription` from `Inscription` I
inner join `SESSION` S
on S.`codeSess` = I.`codeSess`
inner join `Formation` F
on F.`SESSION_codeSess` = S.`codeSess`
where F.`titreForm` = "Soft skills"
group by I.`typeCours`;

--Q4

SELECT 
    f.titreForm,
    COUNT(numinscription) AS `Nombre inscriptions distantielles`
FROM 
    Formation f
INNER JOIN 
    SESSION s ON f.SESSION_codeSess = s.codeSess
INNER JOIN 
    Inscription i ON s.codeSess = i.codeSess
WHERE 
    i.typeCours = 'Distanciel'
GROUP BY 
    f.titreForm
HAVING 
    `Nombre inscriptions distantielles` >= 3
ORDER BY 
    `Nombre inscriptions distantielles`;


--Q5
SELECT 
    `sp`.`nomSpec`,
    `f`.`titreForm`,
    `f`.`dureeForm`,
    `f`.`prixForm`
FROM 
    `SPECIALITE` `sp`
INNER JOIN 
    `Catalogue` `c` ON `sp`.`codeSpec` = `c`.`codeSpec`
INNER JOIN 
    `Formation` `f` ON `c`.`codeForm` = `f`.`codeForm`
WHERE 
    `sp`.`active` = 1
ORDER BY 
    `sp`.`nomSpec` DESC;

--Q6
(SELECT 
    f.titreForm,
    COUNT(numinscription) AS `Nombre inscriptions distantielles`
FROM 
    Formation f
INNER JOIN 
    SESSION s ON f.SESSION_codeSess = s.codeSess
INNER JOIN 
    Inscription i ON s.codeSess = i.codeSess
WHERE 
    i.typeCours = 'Distanciel'
GROUP BY 
    f.titreForm
HAVING 
    `Nombre inscriptions distantielles` >= 3
ORDER BY 
    `Nombre inscriptions distantielles`)
union
(SELECT 
    f.titreForm,
    COUNT(numinscription) AS `Nombre inscriptions présentielles`
FROM 
    Formation f
INNER JOIN 
    SESSION s ON f.SESSION_codeSess = s.codeSess
INNER JOIN 
    Inscription i ON s.codeSess = i.codeSess
WHERE 
    i.typeCours = 'Presentiel'
GROUP BY 
    f.titreForm
HAVING 
    `Nombre inscriptions présentielles` >= 4
ORDER BY 
    `Nombre inscriptions présentielles`);

--Q7
SELECT 
    YEAR(s.dateDebut) AS `Année`,
    MONTH(s.dateDebut) AS `Mois`,
    SUM(f.prixForm) AS `Total des prix`
FROM
    SESSION s
JOIN
    Formation f ON s.codeSess = f.SESSION_codeSess
GROUP BY
    `Année`, `Mois`;


