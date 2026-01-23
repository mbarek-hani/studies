import { useEffect } from 'react'
import { useParams, Link } from 'react-router-dom'
import { useSelector, useDispatch } from 'react-redux'
import { fetchBooks } from '../features/books/booksSlice'
import { selectBookById, selectLoading } from '../features/books/booksSelectors'
import BookForm from '../components/BookForm'

function EditBookPage() {
  const { id } = useParams()
  const dispatch = useDispatch()
  
  // Sélectionner le livre par ID
  const book = useSelector(state => selectBookById(state, id))
  const loading = useSelector(selectLoading)

  // Charger les livres si pas encore chargés
  useEffect(() => {
    if (!book) {
      dispatch(fetchBooks())
    }
  }, [book, dispatch])

  // État de chargement
  if (loading) {
    return (
      <div className="loading">
        <div className="loading-spinner"></div>
        <p>Chargement...</p>
      </div>
    )
  }

  // Livre non trouvé
  if (!book) {
    return (
      <div className="not-found">
        <h2>📭 Livre non trouvé</h2>
        <p>Le livre avec l'ID {id} n'existe pas.</p>
        <Link to="/" className="btn btn-primary">
          ← Retour au catalogue
        </Link>
      </div>
    )
  }

  return (
    <div>
      <Link to="/" className="back-link">← Retour au catalogue</Link>
      <h1 className="page-title">✏️ Modifier : {book.title}</h1>
      <BookForm existingBook={book} />
    </div>
  )
}

export default EditBookPage
