const fruits = ["Pomme", "Banane", "Fraise"];
const legumes = ["Carotte", "Tomate", "Courgette"];

const aliments = [...fruits, ...legumes];

const nouveauxFruits = [...fruits, "Orange"];

const personne = {
  nom: "Alami",
  prenom: "Sara",
  age: 20
};

const personneComplete = { ...personne, ville: "Agadir" };

const personneVieillie = { ...personne, age: 21 };