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

//function Voiture(marque, modele, annee) {
//    this.marque = marque;
//    this.modele = modele;
//    this.annee = annee;
//}

//Voiture.prototype.afficherInfo = function () {
//    console.log(
//        `voiturde marque ${this.marque}, modèle ${this.modele}, année ${this.annee}`
//    );
//};
//
//let bmw = new Voiture("BMW", "G45", 2020);
//
//for (let prop in bmw) {
//    if (typeof bmw[prop] !== "function") {
//        console.log(`${prop} = ${bmw[prop]}`);
//    }
//}
//
//bmw.afficherInfo();
//
//const propriete = prompt("quelle propriete voulez vous supprimer?");
//let estExiste = false;
//for (let prop in bmw) {
//    if (prop == propriete) {
//        delete bmw[prop];
//        estExiste = true;
//        console.log(`le prpriete ${propriete} est bien supprimer.`);
//    }
//}
//if (!estExiste) {
//    console.log("Cette propriete n'existe pas.");
//}
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
