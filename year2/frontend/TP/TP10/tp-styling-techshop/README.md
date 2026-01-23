# TP Styling - TechShop

## 📋 Description

Ce projet est un TP pour apprendre à styliser des composants React avec **CSS** et **Bootstrap**.

L'application TechShop contient :
- Une **NavBar** de navigation
- Un **Formulaire** d'ajout de produit
- Des **Cards** de produits en grille
- Un **Tableau** de gestion avec actions

## 🚀 Installation

```bash
# 1. Installer les dépendances
npm install

# 2. Installer Bootstrap
npm install bootstrap

# 3. Lancer le serveur de développement
npm run dev
```

## 📁 Structure du Projet

```
tp-styling-techshop/
├── src/
│   ├── components/
│   │   ├── NavBar.jsx          ← À styliser
│   │   ├── ProductForm.jsx     ← À styliser
│   │   ├── ProductCard.jsx     ← À styliser
│   │   ├── ProductList.jsx     ← À styliser
│   │   └── ProductTable.jsx    ← À styliser
│   ├── data/
│   │   └── products.js         ← Données de test
│   ├── styles/                 ← Vos fichiers CSS (optionnel)
│   ├── App.jsx
│   ├── main.jsx                ← Importer Bootstrap ici
│   └── index.css
├── maquettes/                  ← Images à reproduire
└── package.json
```

## ✅ Étapes du TP

### Étape 0 : Configurer Bootstrap

Dans `src/main.jsx`, décommentez les imports Bootstrap :

```jsx
import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap/dist/js/bootstrap.bundle.min.js'
```

### Étape 1 : NavBar (30 min)

Styliser la barre de navigation avec les classes Bootstrap :
- `navbar navbar-expand-lg navbar-dark bg-dark`
- `container`, `navbar-brand`
- `navbar-nav ms-auto`, `nav-item`, `nav-link`

### Étape 2 : Formulaire (40 min)

Styliser le formulaire avec :
- Structure Card : `card`, `card-body`, `shadow`
- Champs : `form-control`, `form-label`, `form-select`
- Bouton : `btn btn-primary w-100`

### Étape 3 : Cards (40 min)

Styliser les cards et la grille :
- Card : `card h-100 shadow-sm`, `card-body`
- Grille : `row g-4`, `col-12 col-md-6 col-lg-4`
- Boutons : `btn btn-warning btn-sm`, `btn btn-danger btn-sm`

### Étape 4 : Tableau (40 min)

Styliser le tableau de gestion :
- Table : `table table-striped table-hover`
- Responsive : `table-responsive`
- Badges : `badge bg-success`, `bg-warning`, `bg-danger`

## 📚 Classes Bootstrap Utiles

| Composant | Classes |
|-----------|---------|
| NavBar | `navbar`, `navbar-dark`, `bg-dark`, `navbar-expand-lg` |
| Container | `container`, `container-fluid` |
| Grille | `row`, `col-md-6`, `col-lg-4`, `g-4` |
| Card | `card`, `card-body`, `card-title`, `h-100`, `shadow` |
| Table | `table`, `table-striped`, `table-hover`, `table-responsive` |
| Boutons | `btn`, `btn-primary`, `btn-warning`, `btn-danger`, `btn-sm` |
| Formulaire | `form-control`, `form-label`, `form-select`, `mb-3` |
| Badge | `badge`, `bg-success`, `bg-warning`, `bg-danger` |
| Espacement | `mt-4`, `mb-3`, `py-4`, `me-2` |
| Flexbox | `d-flex`, `justify-content-between`, `align-items-center` |

## 🎯 Objectifs

À la fin du TP, vous devez :
- [ ] Avoir une NavBar responsive avec liens actifs
- [ ] Avoir un formulaire centré dans une Card
- [ ] Avoir une grille de Cards responsive (3 colonnes)
- [ ] Avoir un tableau avec badges et boutons d'action

## 📖 Ressources

- [Bootstrap Documentation](https://getbootstrap.com/docs/)
- [React Router NavLink](https://reactrouter.com/en/main/components/nav-link)
- [Bootstrap Grid System](https://getbootstrap.com/docs/5.3/layout/grid/)
- [Bootstrap Tables](https://getbootstrap.com/docs/5.3/content/tables/)

---

Bon courage ! 🚀
