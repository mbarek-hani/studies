//Exercice 1

// let nombre = prompt("Entrez un nombre entier");
// if (isNaN(nombre)) {
//     console.error("Erreur : Vous n'avez pas saisi un nombre entier");
// } else {
//     nombre = parseInt(nombre);
//     let msg = nombre % 2 === 0 ? "pair" : "impair";
//     console.log(`Le nombre ${nombre} est ${msg}`);
// }

//Exercice 2

// let nombre1 = prompt("Entrez le premier nombre");
// let nombre2 = prompt("Entrez le deuxième nombre");

// if (isNaN(nombre1) || isNaN(nombre2)) {
//     console.error("Erreur : Vous n'avez pas saisi des nombres valides");
// } else {
//     nombre1 = parseFloat(nombre1);
//     nombre2 = parseFloat(nombre2);

//     if (nombre1 > nombre2) {
//         console.log(`Le nombre ${nombre1} est le plus grand`);
//     } else if (nombre2 > nombre1) {
//         console.log(`Le nombre ${nombre2} est le plus grand`);
//     } else {
//         console.log("Les deux nombres sont égaux");
//     }
// }

//Exercice 3

// let note = prompt("Entrez une note entre 0 et 20");

// if (isNaN(note)) {
//     console.error("Erreur : Vous n'avez pas saisi un nombre");
// } else {
//     note = parseFloat(note);

//     if (note >= 0 && note <= 20) {
//         console.log(`La note ${note} est valide`);
//     } else {
//         console.error("Erreur : La note doit être comprise entre 0 et 20");
//     }
// }

//Exercice 4

// let m = prompt("Entrez le premier nombre (m)");
// let n = prompt("Entrez le deuxième nombre (n)");

// if (isNaN(m) || isNaN(n)) {
//     console.error("Erreur : Vous n'avez pas saisi des nombres valides");
// } else {
//     m = parseFloat(m);
//     n = parseFloat(n);
//     let produit = m * n;

//     if (produit > 0) {
//         console.log("Le produit est positif");
//     } else if (produit < 0) {
//         console.log("Le produit est négatif");
//     } else {
//         console.log("Le produit est nul");
//     }
// }

//Exercice 5

// let note = prompt("Entrez une note entre 0 et 100");

// if (isNaN(note)) {
//     console.error("Erreur : Vous n'avez pas saisi un nombre");
// } else {
//     note = parseFloat(note);

//     if (note >= 0 && note <= 100) {
//         if (note >= 90) {
//             console.log("Excellent");
//         } else if (note >= 70) {
//             console.log("Bien");
//         } else if (note >= 50) {
//             console.log("Moyen");
//         } else {
//             console.log("Insuffisant");
//         }
//     } else {
//         console.error("Erreur : La note doit être comprise entre 0 et 100");
//     }
// }

//Exercice 6

let mois = prompt("Entrez un numéro de mois (1-12)");

if (isNaN(mois)) {
    console.error("Erreur : Vous n'avez pas saisi un nombre");
} else {
    mois = parseInt(mois);
    let moisEnLettres;

    switch (mois) {
        case 1:
            moisEnLettres = "Janvier";
            break;
        case 2:
            moisEnLettres = "Février";
            break;
        case 3:
            moisEnLettres = "Mars";
            break;
        case 4:
            moisEnLettres = "Avril";
            break;
        case 5:
            moisEnLettres = "Mai";
            break;
        case 6:
            moisEnLettres = "Juin";
            break;
        case 7:
            moisEnLettres = "Juillet";
            break;
        case 8:
            moisEnLettres = "Août";
            break;
        case 9:
            moisEnLettres = "Septembre";
            break;
        case 10:
            moisEnLettres = "Octobre";
            break;
        case 11:
            moisEnLettres = "Novembre";
            break;
        case 12:
            moisEnLettres = "Décembre";
            break;
        default:
            console.error(
                "Erreur : Le numéro du mois doit être compris entre 1 et 12"
            );
            return;
    }

    console.log(`Le mois numéro ${mois} est ${moisEnLettres}`);
}
