// EXERCICE 1
// const nombres = parseInt(prompt("combien de nombre vous allez entrer ?"));

// let s = 0,
//     m;
// for (let i = 0; i < nombres; i++) {
//     let nbr = parseInt(prompt("entrez le nombre " + i+1));
//     s += nbr;
// }

// m = s / nombres;

// console.log("la somme des nombres que vous allez entrer est", s);
// console.log("la moyenne des nombres que vous allez entrer est", m);

//EXERCICE 2
// const nombre = parseInt(prompt("saisir un nombre entier : "));

// let produit = 1;

// for (let i = 1; i <= nombre; i++) {
//     produit *= i;
// }

// console.log("la factorielle de " + nombre + " est : ", produit);

//EXERCICE 3

//fibonacci
// const nombre = parseInt(prompt("saisir un nombre entier : "));
// if (nombre === 0) {
//     console.log(0);
// } else if (nombre === 1) {
//     console.log(1);
//}
// let a = 0,b = 1,c;
// for (let i = 2; i <= nombre; i++) {
//     c = a + b;
//     a = b;
//     b = c;
//     console.log(c);
// }

//EXERCICE 4

let max = -Infinity;

for (let i = 0; i < 10; i++) {
    let nbr = parseInt(prompt("Entrez le nombre " + (i + 1) + " :"));
    if (nbr > max) {
        max = nbr;
    }
}

console.log("Le maximum parmi les nombres saisis est : ", max);
