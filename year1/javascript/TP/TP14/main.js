const panierJSON = ` 
                            { 
                                "utilisateur": "Ali", 
                                "articles": [ 
                                    { "nom": "Clavier", "quantite": 1, "prixUnitaire": 150 }, 
                                    { "nom": "Souris", "quantite": 2, "prixUnitaire": 75 }, 
                                    { "nom": "Écran", "quantite": 1, "prixUnitaire": 1200 } 
                                ] 
                            } 
                            `;
const panier = JSON.parse(panierJSON);

console.log(panier.utilisateur);

const nouvelArticle = {
    nom: "Tapis de souris",
    quantite: 1,
    prixUnitaire: 50,
};

panier.articles.push(nouvelArticle);

let index = null;
for (let i = 0; i < panier.articles.length; i++) {
    if (panier.articles[i].nom === "Souris") {
        index = i;
        break;
    }
}

if (index !== null) {
    panier.articles.splice(index, 1);
}

let total = 0;
for (let i = 0; i < panier.articles.length; i++) {
    panier.articles[i].total =
        panier.articles[i].prixUnitaire * panier.articles[i].quantite;
    console.log(panier.articles[i]);
    total += panier.articles[i].total;
}

console.log("total : ", total);
