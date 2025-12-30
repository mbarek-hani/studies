// Exercice 1 : Map - Multiplier par 3
const nums = [2, 5, 8, 7, 3];
const nouvNums = nums.map(n => n * 3);
console.log("Exercice 1 - nouvNums:", nouvNums);

// Exercice 2 : Filter + Map - Noms des membres
const personnes = [
  { nom: "Rami", age: 33, estMember: true },
  { nom: "Fatihi", age: 24, estMember: false },
  { nom: "Chakib", age: 45, estMember: true },
  { nom: "Mounir", age: 37, estMember: false }
];
const nomAges = personnes.filter(p => p.estMember).map(p => p.nom);
console.log("Exercice 2 - nomAges:", nomAges);

// Exercice 3 : Reduce, Map, Destructuring
const nombres = [1, 2, 6, 8, 4, 6, 4, 7, 9, 10, 40, 3, 17];
const somme = nombres.reduce((acc, n) => acc + n, 0);
const doubles = nombres.map(n => n * 2);
const [premier, ...reste] = nombres;
const dernier = reste[reste.length - 1];
const produit = premier * dernier;
console.log("Exercice 3 - Somme:", somme);
console.log("Exercice 3 - Doubles:", doubles);
console.log("Exercice 3 - Produit premier*dernier:", produit);

// Exercice 4 : Map, Reduce, Destructuring avec objets
const personnesEx4 = [
  { nom: "Ahmed", age: 25 },
  { nom: "Sara", age: 30 },
  { nom: "Omar", age: 35 },
  { nom: "Fatima", age: 28 }
];
const nomsMajuscules = personnesEx4.map(p => p.nom.toUpperCase());
const sommeAges = personnesEx4.reduce((acc, p) => acc + p.age, 0);
[personnesEx4[0].age, personnesEx4[personnesEx4.length - 1].age] = [personnesEx4[personnesEx4.length - 1].age, personnesEx4[0].age];
console.log("Exercice 4 - Noms en majuscules:", nomsMajuscules);
console.log("Exercice 4 - Somme des âges:", sommeAges);
console.log("Exercice 4 - Tableau après échange:", personnesEx4);

// Exercice 5 : Classes Document et Livre
class Document {
  constructor(id, dateEdition) {
    this.id = id;
    this.dateEdition = dateEdition;
  }
}

class Livre extends Document {
  constructor(id, dateEdition, titre, auteur) {
    super(id, dateEdition);
    this.titre = titre;
    this.auteur = auteur;
  }

  infoLivre() {
    return `Livre: ${this.titre}, Auteur: ${this.auteur}, ID: ${this.id}, Date: ${this.dateEdition}`;
  }
}

const doc1 = new Document(1, "2023-01-15");
const doc2 = new Document(2, "2023-02-20");
const livre1 = new Livre(101, "2022-05-10", "POO en Java", "Martin Dupont");
const livre2 = new Livre(102, "2023-03-12", "JavaScript Avancé", "Sophie Laurent");
const livre3 = new Livre(103, "2023-06-18", "React pour débutants", "Pierre Durand");

console.log("Exercice 5 - Info Livre 1:", livre1.infoLivre());
console.log("Exercice 5 - Info Livre 2:", livre2.infoLivre());
console.log("Exercice 5 - Info Livre 3:", livre3.infoLivre());

// Exercice 6 : Classe Book
class Book {
  constructor(title, author, description, pages) {
    this.title = title;
    this.author = author;
    this.description = description;
    this.pages = pages;
    this.currentPage = 1;
    this.read = false;
  }

  readBook(page) {
    if (page < 1 || page > this.pages) {
      console.log(0);
      return 0;
    } else if (page >= 1 && page < this.pages) {
      this.currentPage = page;
      console.log("En cours de lecture");
      return 1;
    } else if (page === this.pages) {
      this.currentPage = page;
      this.read = true;
      console.log("Lu");
      return 1;
    }
  }
}

const books = [
  new Book("Le Petit Prince", "Antoine de Saint-Exupéry", "Un conte philosophique", 96),
  new Book("1984", "George Orwell", "Roman dystopique", 328),
  new Book("L'Étranger", "Albert Camus", "Roman existentialiste", 186)
];

console.log("Exercice 6 - Livre affiché:", books[0]);
books[0].readBook(50);
books[0].readBook(96);

// Exercice 7 : Map - Carré des éléments
const inputEx7 = [1, 2, 3, 4, 5];
const carres = inputEx7.map(n => n * n);
console.log("Exercice 7 - Carrés:", carres);

// Exercice 8 : Filter et Reduce
const inputEx8 = [1, -2, 3, 4, -5];
const positifs = inputEx8.filter(n => n > 0);
console.log("Exercice 8 - Éléments positifs:", positifs);
const sommeEx8 = inputEx8.reduce((acc, n) => acc + n, 0);
console.log("Exercice 8 - Somme totale:", sommeEx8);
const sommePositifs = inputEx8.filter(n => n > 0).reduce((acc, n) => acc + n, 0);
console.log("Exercice 8 - Somme des positifs:", sommePositifs);

// Exercice 9 : Manipulation Array de livres
let livres = [
  { id: 10, titre: 'POO', auteur: 'RAMI', prix: 300 },
  { id: 11, titre: 'JS ES6', auteur: 'FAMI', prix: 230 },
  { id: 12, titre: 'Algorithme', auteur: 'KARIMI', prix: 330 },
  { id: 13, titre: 'HTML & CSS', auteur: 'RAMI', prix: 340 }
];

const titres = livres.map(l => l.titre);
console.log("Exercice 9.1 - Titres:", titres);

const livresRami = livres.filter(l => l.auteur === 'RAMI');
console.log("Exercice 9.2 - Livres de RAMI:", livresRami);

const livreId12 = livres.find(l => l.id === 12);
console.log("Exercice 9.3 - Livre ID 12:", livreId12);

const totalPrix = livres.reduce((acc, l) => acc + l.prix, 0);
console.log("Exercice 9.4 - Total des prix:", totalPrix);

const mesLivres = [...livres];
console.log("Exercice 9.5 - Copie mesLivres:", mesLivres);

// Exercice 10 : Fonction décrémenter (code pour compteur.js)
console.log("Exercice 10 - Fonction décrémenter:");
function decrementer(temps) {
  time = { ...temps };
  return function () {
    time.second--;
    if (time.second < 0) {
      time.second = 59;
      time.minute--;
      if (time.minute < 0) {
        time.minute = 59;
        time.heure--;
        if (time.heure < 0) {
          time.heure = 0;
          time.minute = 0;
          time.second = 0;
        }
      }
    }
    affiche(time);
    currentTime = time;
    return time;
  };
}

