use centreFormation;

-- Q1
SELECT COUNT(*) AS nombre_etudiants FROM ETUDIANT;

-- Q2
SELECT 
    numCINEtu,
    nomEtu,
    prenomEtu,
    dateNaissance,
    TIMESTAMPDIFF(YEAR, dateNaissance, CURRENT_DATE) AS age
FROM 
    ETUDIANT;

SELECT 
    numCINEtu,
    nomEtu,
    prenomEtu,
    dateNaissance,
    floor(DATEDIFF(CURRENT_DATE, dateNaissance)/365.25) AS age
FROM 
    ETUDIANT;
-- Q3
SELECT 
    codeForm, 
    titreForm, 
    prixForm
FROM 
    Formation 
WHERE 
    prixForm = (SELECT MAX(prixForm) FROM Formation);

SELECT 
    codeForm, 
    titreForm, 
    prixForm
FROM 
    Formation 
WHERE 
    prixForm = (SELECT MIN(prixForm) FROM Formation);

select max(prixForm) as plus_chere from `Formation`;

-- Q4

SELECT SUM(prixForm) AS cout_total FROM Formation;

-- Q5
SELECT 
    s.codeSess,
    s.nomSess,
    COUNT(i.numCINEtu) AS nombre_etudiants
FROM 
    SESSION s
LEFT JOIN 
    Inscription i ON s.codeSess = i.codeSess
GROUP BY 
    s.codeSess, s.nomSess
ORDER BY 
    s.codeSess;

-- Q6
SELECT DISTINCT numCINEtu 
FROM Inscription;

-- Q7
SELECT 
    e.numCINEtu,
    e.nomEtu,
    e.prenomEtu,
    COUNT(i.codeSess) AS nombre_inscriptions
FROM 
    ETUDIANT e
LEFT JOIN 
    Inscription i ON e.numCINEtu = i.numCINEtu
GROUP BY 
    e.numCINEtu, e.nomEtu, e.prenomEtu
ORDER BY 
    nombre_inscriptions DESC;

-- Q8
