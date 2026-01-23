import { useEffect } from 'react'
import { useDispatch, useSelector } from 'react-redux'
import { fetchBooks, deleteBook } from '../features/books/booksSlice'
import { 
  selectFilteredBooks, 
  selectLoading, 
  selectError, 
  selectStats,
  selectFilteredCount
} from '../features/books/booksSelectors'
import BookCard from './BookCard'
import BookFilter from './BookFilter'

function BookList() {
  const dispatch = useDispatch()
  const books = useSelector(selectFilteredBooks)
  const loading = useSelector(selectLoading)
  const error = useSelector(selectError)
  const stats = useSelector(selectStats)
  const filteredCount = useSelector(selectFilteredCount)

  // Charger les livres au montage
  useEffect(() => {
    dispatch(fetchBooks())
  }, [dispatch])

  // Gestion de la suppression
  const handleDelete = (id, title) => {
    if (window.confirm(`Supprimer "${title}" ?`)) {
      dispatch(deleteBook(id))
    }
  }

  // État de chargement
  if (loading && books.length === 0) {
    return (
      <div className="loading">
        <div className="loading-spinner"></div>
        <p>Chargement des livres...</p>
      </div>
    )
  }

  // État d'erreur
  if (error) {
    return (
      <div className="error">
        <p>❌ Erreur : {error}</p>
        <div className="error-actions">
          <button 
            className="btn btn-primary"
            onClick={() => dispatch(fetchBooks())}
          >
            🔄 Réessayer
          </button>
        </div>
      </div>
    )
  }

  return (
    <div>
      {/* Statistiques */}
      <div className="stats-bar">
        <div className="stat-item total">
          <span className="stat-number">{stats.total}</span>
          <span>Total</span>
        </div>
        <div className="stat-item available">
          <span className="stat-number">{stats.available}</span>
          <span>Disponibles</span>
        </div>
        <div className="stat-item borrowed">
          <span className="stat-number">{stats.borrowed}</span>
          <span>Empruntés</span>
        </div>
      </div>

      {/* Filtres */}
      <BookFilter />

      {/* Nombre de résultats */}
      <p className="results-count">
        {filteredCount} livre(s) trouvé(s)
      </p>

      {/* Liste des livres */}
      {books.length === 0 ? (
        <div className="not-found">
          <p>📭 Aucun livre ne correspond aux critères.</p>
        </div>
      ) : (
        <div className="books-grid">
          {books.map(book => (
            <BookCard 
              key={book.id} 
              book={book}
              onDelete={() => handleDelete(book.id, book.title)}
            />
          ))}
        </div>
      )}
    </div>
  )
}

export default BookList
