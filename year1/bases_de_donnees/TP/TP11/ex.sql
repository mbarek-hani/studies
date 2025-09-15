-- Representation(numRep, titreRep, lieuRep)
-- Musicien(numMus, nom, #numRep)
-- Programmer(date, tarif, #numRep)

select titreRep as titre from Representation;

select titreRep as titre from Representation where lieu = "théâtre allissa";

select m.nom, r.titreRep as titre
from Musiscien m
inner join
Representation r on
m.numRep = r.numRep;

select r.titreRep as titre, r.lieuRep as lieu, p.tarif
from Representation r
inner join
Programmer p
on r.numRep = p.numRep
where p.date = "2008-07-25";

select count(*) from Representation where numRep = 'n°20';

select r.numRep, r.titreRep, r.lieu, p.date from Representation r 
inner join Programmer p 
on r.numRep = p.numRep 
where p.tarif <= 20;