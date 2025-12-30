const nombres = [1, 2, 3, 4, 5];

const carres = nombres.map(n => n * n);

const dizaines = nombres.map(n => n * 10);

const etudiants = [
  { nom: "Alami", note: 16 },
  { nom: "Brahim", note: 14 },
  { nom: "Chafik", note: 18 }
];

const noms = etudiants.map(etudiant => etudiant.nom);

const notesSur100 = etudiants.map(etudiant => (etudiant.note / 20) * 100);