# 📚 Gestion de Bibliothèque

Application CRUD complète de gestion de bibliothèque avec React + Redux Toolkit.

**Session 18 - Module M203 - ISTA 2024/2025**

---

## 🚀 Installation

```bash
# Installer les dépendances
npm install

# Lancer le serveur API (JSON Server) - Terminal 1
npm run server

# Lancer l'application React - Terminal 2
npm run dev
```

L'application sera disponible sur : `http://localhost:5173`
L'API sera disponible sur : `http://localhost:3001`

---

## 📁 Structure du Projet

```
src/
├── app/
│   └── store.js              # Configuration Redux
├── features/
│   └── books/
│       ├── booksSlice.js     # State + Reducers + Thunks
│       └── booksSelectors.js # Selectors
├── components/
│   ├── BookList.jsx          # Liste des livres
│   ├── BookCard.jsx          # Carte d'un livre
│   ├── BookForm.jsx          # Formulaire ajout/édition
│   └── BookFilter.jsx        # Filtres et recherche
├── pages/
│   ├── HomePage.jsx          # Page d'accueil
│   ├── AddBookPage.jsx       # Page ajout
│   └── EditBookPage.jsx      # Page édition
├── App.jsx                   # Routes
├── main.jsx                  # Point d'entrée (Provider + Router)
└── index.css                 # Styles
```

---

## 🎯 Fonctionnalités

### CRUD Complet
- ✅ **C**reate : Ajouter un livre
- ✅ **R**ead : Afficher la liste des livres
- ✅ **U**pdate : Modifier un livre
- ✅ **D**elete : Supprimer un livre

### Filtres
- 🔍 Recherche par titre ou auteur
- 📂 Filtrage par genre
- ✓ Afficher uniquement les livres disponibles

### Gestion d'état
- ⏳ État de chargement (loading)
- ❌ Gestion des erreurs
- 🔄 Bouton "Réessayer"

---

## 🛠️ Technologies

| Technologie | Version | Rôle |
|-------------|---------|------|
| React | 18.x | Interface utilisateur |
| Redux Toolkit | 2.x | Gestion d'état |
| React Router | 6.x | Navigation |
| JSON Server | 1.x | API REST simulée |
| Vite | 5.x | Build tool |

---

## 📚 Modèle de Données

```javascript
{
  id: 1,
  title: "Le Petit Prince",
  author: "Antoine de Saint-Exupéry",
  genre: "Roman",
  year: 1943,
  available: true  // true = disponible, false = emprunté
}
```

---

## 🔑 Concepts Redux Abordés

### Store
```javascript
configureStore({ reducer: { books: booksReducer } })
```

### Thunks (createAsyncThunk)
- `fetchBooks` - GET /books
- `addBook` - POST /books
- `updateBook` - PUT /books/:id
- `deleteBook` - DELETE /books/:id

### Slice (createSlice)
- Reducers synchrones : `setGenreFilter`, `setSearchTerm`, etc.
- extraReducers : `pending`, `fulfilled`, `rejected`

### Selectors
- Simples : `selectAllBooks`, `selectLoading`
- Avec paramètre : `selectBookById`
- Avec logique : `selectFilteredBooks`

---

## 📝 Commandes

```bash
npm run dev      # Lancer Vite (React)
npm run server   # Lancer JSON Server (API)
npm run build    # Build production
npm run preview  # Prévisualiser le build
```

---

## 👨‍🏫 Auteur

Étude de cas réalisée pour le module M203 - Développement Front-End
ISTA - 2ème Année DEVOWFS - 2024/2025
