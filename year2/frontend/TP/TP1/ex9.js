const etudiants = [
  { id: 1, nom: "Alami", prenom: "Ahmed", age: 20, notes: [16, 14, 18, 15] },
  { id: 2, nom: "Brahim", prenom: "Sara", age: 21, notes: [12, 13, 11, 14] },
  { id: 3, nom: "Chafik", prenom: "Omar", age: 19, notes: [17, 16, 19, 18] },
  { id: 4, nom: "Daoudi", prenom: "Fatima", age: 22, notes: [15, 16, 15, 17] }
];

const calculerMoyenne = (etudiant) => {
  return etudiant.notes.reduce((acc, note) => acc + note, 0) / etudiant.notes.length;
};

const ajouterMoyennes = (etudiants) => {
  return etudiants.map(etudiant => ({
    ...etudiant,
    moyenne: calculerMoyenne(etudiant)
  }));
};

const etudiantsBrillants = (etudiants) => {
  return ajouterMoyennes(etudiants).filter(etudiant => etudiant.moyenne >= 15);
};

const meilleurEtudiant = (etudiants) => {
  const etudiantsAvecMoyennes = ajouterMoyennes(etudiants);
  return etudiantsAvecMoyennes.reduce((meilleur, etudiant) => 
    etudiant.moyenne > meilleur.moyenne ? etudiant : meilleur
  );
};

const afficherEtudiant = (etudiant) => {
  const { nom, prenom, age, moyenne } = etudiant;
  return `${prenom} ${nom}, ${age} ans, moyenne: ${moyenne.toFixed(2)}/20`;
};