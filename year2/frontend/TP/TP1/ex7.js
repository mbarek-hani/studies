const produits = [
  { nom: "Ordinateur", prix: 3000, categorie: "Informatique" },
  { nom: "Souris", prix: 150, categorie: "Informatique" },
  { nom: "Bureau", prix: 800, categorie: "Mobilier" },
  { nom: "Clavier", prix: 500, categorie: "Informatique" },
  { nom: "Écran", prix: 2500, categorie: "Informatique" }
];

const produitsInformatique = produits.filter(p => p.categorie === "Informatique");

const produitsMoinsDe1000 = produits.filter(p => p.prix < 1000);

const produitsInfoPlus2000 = produits.filter(p => p.categorie === "Informatique" && p.prix >= 2000);