// Exercice1

// let compteBancaire = {
//     titulaire: "",
//     solde: 0.0,
//     deposer: function (montant) {
//         this.solde += montant;
//     },
//     retirer: function (montant) {
//         if (this.solde < montant) {
//             console.log("Solde insuffisant");
//             return;
//         }
//         this.solde -= montant;
//     },
// };

// compteBancaire.deposer(500);
// compteBancaire.retirer(200);
// compteBancaire.retirer(1000);
// console.log(compteBancaire.solde);

// Exercice 2

// let voiture = {
//     marque: "BMW",
//     modele: "G45",
//     annee: 2020,
//     afficherInfo: function () {
//         console.log(
//             `voiturde marque ${this.marque}, modèle ${this.modele}, année ${this.annee}`
//         );
//     },
// };

// for (let prop in voiture) {
//     console.log(`${prop} = ${voiture[prop]}`);
// }

// voiture.afficherInfo();
// const propriete = prompt(
//     "Choisissez quelle propriété vous souhaitez supprimer (marque, modèle, année, afficherInfo)"
// );
// switch (propriete) {
//     case "marque":
//         delete voiture.marque;
//         break;
//     case "modèle":
//         delete voiture.modele;
//         break;
//     case "année":
//         delete voiture.annee;
//         break;
//     case "afficherInfo":
//         delete voiture.afficherInfo;
//         break;
//     default:
//         console.log("wrong input");
// }

// for (let prop in voiture) {
//     console.log(`${prop} = ${voiture[prop]}`);
// }

// Exercice 3

let annuaire = {
    said: "06 62 62 62 62",
    jamal: "06 67 67 67 67",
    numeroTel: function (nom) {
        if (this[nom] != undefined && typeof this[nom] != "function") {
            console.log(this[nom]);
        } else {
            console.log(`Le contact ${nom} n'existe pas dans annuaire.`);
        }
    },
    listerContact: function () {
        for (let contact in this) {
            if (typeof this[contact] != "function") {
                console.log(`${contact} : ${this[contact]}`);
            }
        }
    },
    ajouterContact: function (nom, numero) {
        this[nom] = numero;
    },
    supprimerContact: function (nom) {
        delete this[nom];
    },
};

annuaire.numeroTel("said");
annuaire.numeroTel("mbarek");
annuaire.ajouterContact("mbarek", "061020304050");
annuaire.numeroTel("mbarek");
annuaire.supprimerContact("mbarek");
annuaire.supprimerContact("hani");
annuaire.listerContact();
