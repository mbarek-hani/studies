// 2 Partie 1 : Création de la Base de Données et Collections
// 2.1 Exercice 1.1 : Créer la base de données
// Créer une base de données nommée centreFormation.
    
const database = 'centreFormation';
use(database);


// 2.2 Exercice 1.2 : Créer les collections
// Créer les trois collections : stagiaires, formations, et inscriptions. Ensuite, vérifier que les
db.createCollection('stagiaires');
db.createCollection('formations');
db.createCollection('inscriptions');
// collections sont bien créées.


// 3 Partie 2 : Opérations de Création (Create)
// 3.1 Exercice 2.1 : Insertion simple (insertOne)
db.stagiaires.insertOne({
    _id: "STG001",
    nom: "Alami",
    prenom: "Youssef",
    email: "youssef.alami@email.com",
    telephone: "0612345678",
    dateNaissance: "2000-05-15",
    adresse: {
        rue: "Rue Hassan II",
        ville: "Agadir",
        codePostal: "80000"
    }
})


// 3.2 Exercice 2.2 : Insertion multiple (insertMany)
db.formations.insertMany([
    {
        _id: "FORM001",
        titre: "Developpement Web Full Stack",
        duree: 6,
        prix: 15000,
        niveau: "Debutant",
        modules: ["HTML/CSS", "JavaScript", "PHP", "MySQL"]
    },
    {
        _id: "FORM002",
        titre: "Administration Systemes et Reseaux",
        duree: 5,
        prix: 12000,
        niveau: "Intermediaire",
        modules: ["Linux", "Windows Server", "Reseaux", "Securite"]
    },
    {
        _id: "FORM003",
        titre: "Data Science et Machine Learning",
        duree: 7,
        prix: 18000,
        niveau: "Avance",
        modules: ["Python", "Statistiques", "Machine Learning", "Visualisation de donnees"]
    }
])

db.stagiaires.insertMany([
    {
        _id: "STG002",
        nom: "Benjelloun",
        prenom: "Laila",
        email: "laila.benjelloun@email.com",
        telephone: "0623456789",
        dateNaissance: "1999-08-22",
        adresse: {
            rue: "Avenue Mohammed V",
            ville: "Casablanca",
            codePostal: "20000"
        }
    },
    {
        _id: "STG003",
        nom: "Mansouri",
        prenom: "Omar",
        email: "omar.mansouri@email.com",
        telephone: "0634567890",
        dateNaissance: "2001-03-10",
        adresse: {
            rue: "Rue Fes",
            ville: "Casablanca",
            codePostal: "20000"
        }
    },
    {
        _id: "STG004",
        nom: "Chakiri",
        prenom: "Sara",
        email: "sara.chakiri@email.com",
        telephone: "0645678901",
        dateNaissance: "2000-11-05",
        adresse: {
            rue: "Boulevard Zerktouni",
            ville: "Agadir",
            codePostal: "80000"
        }
    },
    {
        _id: "STG005",
        nom: "El Amrani",
        prenom: "Nadia",
        email: "nadia.elamrani@email.com",
        telephone: "0656789012",
        dateNaissance: "1998-07-25",
        adresse: {
            rue: "Rue Tanger",
            ville: "Marrakech",
            codePostal: "40000"
        }
    }
])


db.inscriptions.insertMany([
    {
        _id: "INS001",
        stagiaireId: "STG001",
        formationId: "FORM001",
        dateInscription: "2025-01-10",
        statut: "en cours",
        noteFinale: null
    },
    {
        _id: "INS002",
        stagiaireId: "STG002",
        formationId: "FORM002",
        dateInscription: "2024-11-20",
        statut: "abandonne",
        noteFinale: null
    },
    {
        _id: "INS003",
        stagiaireId: "STG003",
        formationId: "FORM001",
        dateInscription: "2024-10-15",
        statut: "en cours",
        noteFinale: null
    },
    {
        _id: "INS004",
        stagiaireId: "STG004",
        formationId: "FORM003",
        dateInscription: "2025-02-05",
        statut: "en cours",
        noteFinale: null
    }
])


// 4 Partie 3 : Opérations de Lecture (Read)

// 4.1 Exercice 3.1 : Lecture simple (find)
// Question 1 : Afficher tous les stagiaires.
db.stagiaires.find();

// Question 2 : Afficher toutes les formations
db.formations.find();


// 4.2 Exercice 3.2 : Lecture avec filtre simple
// Question 3 : Trouver le stagiaire avec _id : "STG001".
db.stagiaires.find({_id: "STG001"})

// Question 4 : Trouver tous les stagiaires de la ville "Agadir".
db.stagiaires.find({"adresse.ville": "Agadir"})

// Question 5 : Trouver toutes les formations de niveau "Debutant".
db.formations.find({niveau: "Debutant"})


// 4.3 Exercice 3.3 : Opérateurs de comparaison
// Question 6 : Trouver les formations dont le prix est supérieur à 15000.
db.formations.find({prix: {$gt: 15000}})

// Question 7 : Trouver les formations dont la durée est inférieure ou égale à 6 mois.
db.formations.find({duree: {$lte: 6}})

// Question 8 : Trouver les inscriptions avec statut "termine".
db.inscriptions.find({statut: "termine"})


// 4.4 Exercice 3.4 : Opérateurs logiques
// Question 9 : Trouver les formations de niveau "Debutant" ET prix inférieur à 16000.
db.formations.find({
    $and: [
        {niveau: "Debutant"},
        {prix: {$lt: 16000}}
    ]
})

// Question 10 : Trouver les stagiaires d'Agadir OU de Casablanca.
db.stagiaires.find({
    $or: [
        {"adresse.ville": "Agadir"},
        {"adresse.ville": "Casablanca"}
    ]
})


// 4.5 Exercice 3.5 : Projection
// Question 11 : Afficher seulement le nom et prénom des stagiaires (sans _id).
db.stagiaires.find(
    {},
    {nom: 1, prenom: 1, _id: 0}
)

// Question 12 : Afficher les formations sans le champ modules.
db.formations.find(
    {},
    {modules: 0}
)


// 4.6 Exercice 3.6 : Tri et limitation
// Question 13 : Afficher les formations triées par prix (croissant).
db.formations.find().sort({prix: 1})

// Question 14 : Afficher les 3 premières inscriptions.
db.inscriptions.find().limit(3)

// Question 15 : Compter le nombre total de stagiaires.
db.stagiaires.find().count()


// 4.7 Exercice 3.7 : Recherche dans les tableaux
// Question 16 : Trouver les formations qui contiennent le module "JavaScript".
db.formations.find({
    modules: "JavaScript"
})

// Question 17 : Trouver les formations qui contiennent "Python" ET "Machine Learning"
db.formations.find({
    modules: {$all: ["Python", "Machine Learning"]}
})


// 5 Partie 4 : Opérations de Mise à Jour (Update)
// 5.1 Exercice 4.1 : Mise à jour simple (updateOne)
// Question 18 : Mettre à jour le téléphone du stagiaire "STG001" à "0611111111".
db.stagiaires.updateOne(
    {_id: "STG001"},
    {$set: {telephone: "0611111111"}}
)

// Question 19 : Changer le statut de l'inscription "INS001" à "termine" et ajouter une noteFinale de 15.5.
db.inscriptions.updateOne(
    {_id: "INS001"},
    {$set: {statut: "termine", noteFinale: 15.5}}
)


// 5.2 Exercice 4.2 : Opérateur $inc
// Question 20 : Augmenter le prix de la formation "FORM001" de 1000.
db.formations.updateOne(
    {_id: "FORM001"},
    {$inc: {prix: 1000}}
)


// 5.3 Exercice 4.3 : Opérateur $push (tableaux)
// Question 21 : Ajouter le module "React" à la formation "FORM001".
db.formations.updateOne(
    {_id: "FORM001"},
    {$push: {modules: "React"}}
)


// 5.4 Exercice 4.4 : Mise à jour de documents embarqués
// Question 22 : Modifier la ville du stagiaire "STG002" à "Rabat".
db.stagiaires.updateOne(
    {_id: "STG002"},
    {$set: {"adresse.ville": "Rabat"}}
)


// 5.5 Exercice 4.5 : Mise à jour multiple (updateMany)
// Question 23 : Ajouter un champ "actif : true" à tous les stagiaires d'Agadir.
db.stagiaires.updateMany(
    {"adresse.ville": "Agadir"},
    {$set: {actif: true}}
)


// 5.6 Exercice 4.6 : Opérateur $pull (retirer d'un tableau)
// Question 24 : Retirer le module "MySQL" de la formation "FORM001".
db.formations.updateOne(
    {_id: "FORM001"},
    {$pull: {modules: "MySQL"}}
)


// 6 Partie 5 : Opérations de Suppression (Delete)
// 6.1 Exercice 5.1 : Suppression simple (deleteOne)
// Question 25 : Supprimer l'inscription "INS002".
db.inscriptions.deleteOne({_id: "INS002"})


// 6.2 Exercice 5.2 : Suppression multiple (deleteMany)
// Question 26 : Supprimer toutes les inscriptions avec statut "abandonne".
db.inscriptions.deleteMany({statut: "abandonne"})

// Question 27 : Supprimer tous les stagiaires de la ville "Marrakech".
db.stagiaires.deleteMany({"adresse.ville": "Marrakech"})


// 6.3 Exercice 5.3 : Suppression avec opérateurs
// Question 28 : Supprimer les formations dont le prix est supérieur à 18000.
db.formations.deleteMany({prix: {$gt: 18000}})


// 7 Partie 6 : Framework d'Agrégation
// 7.1 Exercice 6.1 : Utilisation de $match
// Question 29 : Utiliser l'agrégation avec $match pour filtrer les stagiaires de la ville "Casablanca".
db.stagiaires.aggregate([
    {$match: {"adresse.ville": "Casablanca"}}
])


// 7.2 Exercice 6.2 : Utilisation de $group pour compter
// Question 30 : Compter le nombre de stagiaires par ville en utilisant $group.
db.stagiaires.aggregate([
    {
        $group: {
            _id: "$adresse.ville",
            nombreStagiaires: {$sum: 1}
        }
    }
])

// Question 31 : Compter le nombre d'inscriptions par statut.
db.inscriptions.aggregate([
    {
        $group: {
            _id: "$statut",
            nombreInscriptions: {$sum: 1}
        }
    }
])


// 7.3 Exercice 6.3 : Utilisation de $group avec statistiques
// Question 32 : Calculer le prix moyen des formations par niveau.
db.formations.aggregate([
    {
        $group: {
            _id: "$niveau",
            prixMoyen: {$avg: "$prix"}
        }
    }
])

// Question 34 : Trouver le prix minimum et maximum des formations en une seule requête.
db.formations.aggregate([
    {
        $group: {
            _id: null,
            prixMinimum: {$min: "$prix"},
            prixMaximum: {$max: "$prix"}
        }
    }
])


// 7.4 Exercice 6.4 : Combinaison $match + $group + $sort
// Question 35 : Trouver le nombre d'inscriptions "en cours" par formation, puis trier par nombre décroissant.
db.inscriptions.aggregate([
    {$match: {statut: "en cours"}},
    {
        $group: {
            _id: "$formationId",
            nombreInscriptions: {$sum: 1}
        }
    },
    {$sort: {nombreInscriptions: -1}}
])


// 7.5 Exercice 6.5 : Utilisation de $unwind
// Question 36 : Utiliser $unwind pour décomposer le tableau "modules" de chaque formation, 
// puis compter combien de fois chaque module apparaît dans toutes les formations.
db.formations.aggregate([
    {$unwind: "$modules"},
    {
        $group: {
            _id: "$modules",
            count: {$sum: 1}
        }
    },
    {$sort: {count: -1}}
])


// 7.6 Exercice 6.6 : Utilisation de $project
// Question 39 : Créer une vue des stagiaires avec un champ "nomComplet" qui concatène le prénom
// et le nom, et un champ "ville" extrait de l'adresse.
db.stagiaires.aggregate([
    {
        $project: {
            nomComplet: {$concat: ["$prenom", " ", "$nom"]},
            ville: "$adresse.ville"
        }
    }
])

// Question 40 : Pour chaque formation, afficher le titre et calculer un champ "prixParMois" 
// (prix divisé par durée).
db.formations.aggregate([
    {
        $project: {
            titre: 1,
            prixParMois: {$divide: ["$prix", "$duree"]}
        }
    }
])


// 8 Questions Bonus (Avancées)
// Question 29 (Bonus) : Utiliser $exists pour trouver les inscriptions qui ont une note finale 
// (noteFinale existe et n'est pas null).
db.inscriptions.find({
    noteFinale: {$exists: true, $ne: null}
})

// Question 30 (Bonus) : Utiliser $regex pour trouver les stagiaires dont l'email contient "email.com".
db.stagiaires.find({
    email: {$regex: "email.com"}
})

// Question 31 (Bonus) : Créer une requête d'agrégation simple pour compter les inscriptions par statut.
db.inscriptions.aggregate([
    {
        $group: {
            _id: "$statut",
            total: {$sum: 1}
        }
    }
])