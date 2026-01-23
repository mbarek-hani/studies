// ============================================
// SELECTORS SIMPLES
// ============================================

export const selectAllBooks = (state) => state.books.items

export const selectLoading = (state) => state.books.loading

export const selectError = (state) => state.books.error

export const selectFilters = (state) => state.books.filters

// ============================================
// SELECTOR AVEC PARAMETRE
// ============================================

export const selectBookById = (state, bookId) => 
  state.books.items.find(book => book.id === bookId)

// ============================================
// SELECTORS AVEC LOGIQUE
// ============================================

// Extraire les genres uniques
export const selectGenres = (state) => {
  const genres = state.books.items.map(book => book.genre)
  const uniqueGenres = [...new Set(genres)]
  return ['all', ...uniqueGenres.sort()]
}

// Filtrer les livres selon les critères
export const selectFilteredBooks = (state) => {
  const { items, filters } = state.books
  const { genre, searchTerm, availableOnly } = filters
  
  return items.filter(book => {
    // Filtre par genre
    const matchGenre = genre === 'all' || book.genre === genre
    
    // Filtre par recherche (titre OU auteur)
    const term = searchTerm.toLowerCase()
    const matchSearch = 
      book.title.toLowerCase().includes(term) ||
      book.author.toLowerCase().includes(term)
    
    // Filtre par disponibilité
    const matchAvailable = !availableOnly || book.available === true
    
    return matchGenre && matchSearch && matchAvailable
  })
}

// Compter les livres filtrés
export const selectFilteredCount = (state) => 
  selectFilteredBooks(state).length

// ============================================
// STATISTIQUES
// ============================================

export const selectStats = (state) => {
  const books = state.books.items
  return {
    total: books.length,
    available: books.filter(book => book.available).length,
    borrowed: books.filter(book => !book.available).length
  }
}
