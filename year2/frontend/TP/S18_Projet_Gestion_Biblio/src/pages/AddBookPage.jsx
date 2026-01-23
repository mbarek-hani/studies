import { Link } from 'react-router-dom'
import BookForm from '../components/BookForm'

function AddBookPage() {
  return (
    <div>
      <Link to="/" className="back-link">← Retour au catalogue</Link>
      <h1 className="page-title">📖 Ajouter un Livre</h1>
      <BookForm />
    </div>
  )
}

export default AddBookPage
