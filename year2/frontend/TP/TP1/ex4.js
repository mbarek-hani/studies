const voiture = {
  marque: "Toyota",
  modele: "Corolla",
  annee: 2020
};

const { marque, modele } = voiture;

const { annee: anneeFabrication } = voiture;

const { proprietaire = "Inconnu" } = voiture;

const fruits = ["Pomme", "Banane", "Orange", "Fraise"];

const [premier, deuxieme] = fruits;

const [seulementPremier] = fruits;