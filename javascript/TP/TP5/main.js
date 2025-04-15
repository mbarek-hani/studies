//Exercice 11

// let forward = true;
// let i = 0;
// let somme = 0;
// let moyenne = 0;
// while (forward) {
//     let note = Number(prompt(`Entrer la note ${i + 1} :`));
//     i++;
//     somme += note;
//     forward = confirm("Voulez-vous continuer à saisir des notes?");
// }
// moyenne = somme / i;
// console.log(`La somme des notes est de : ${somme.toFixed(2)}`);
// console.log("La moyenne des notes est de : " + moyenne.toFixed(2));

//Exercice 12

let secretNumber = Number(prompt("Joueur 1, entrez un entier :"));
let guess;
let attempts = 0;

do {
    guess = Number(prompt("Joueur 2, devinez l'entier :"));
    attempts++;
    if (guess < secretNumber) {
        console.log("L'entier est plus grand.");
    } else if (guess > secretNumber) {
        console.log("L'entier est plus petit.");
    }
} while (guess !== secretNumber);

console.log(`Bravo ! Vous avez trouvé l'entier en ${attempts} tentatives.`);

//Exercice 13
// let N = Number(prompt("Entrez un nombre entier :"));
// let isPrime = true;

// if (N <= 1) {
//     isPrime = false;
// } else {
//     for (let j = 2; j <= Math.sqrt(N); j++) {
//         if (N % j === 0) {
//             isPrime = false;
//             break;
//         }
//     }
// }

// if (isPrime) {
//     console.log(`${N} est un nombre premier.`);
// } else {
//     console.log(`${N} n'est pas un nombre premier.`);
// }

//EXercice 14
// let annee = Number(prompt("Entrez une année :"));
// let estBissextile;

// if ((annee % 4 === 0 && annee % 100 !== 0) || annee % 400 === 0) {
//     estBissextile = true;
// } else {
//     estBissextile = false;
// }

// if (estBissextile) {
//     console.log(`${annee} est une année bissextile.`);
// } else {
//     console.log(`${annee} est une année commune.`);
// }
