import { Link } from 'react-router-dom'

function BookCard({ book, onDelete }) {
  return (
    <div className="book-card">
      {/* Header */}
      <div className="book-card-header">
        <h3 className="book-title">{book.title}</h3>
        <p className="book-author">{book.author}</p>
      </div>

      {/* Body */}
      <div className="book-card-body">
        <div className="book-info">
          <div className="book-info-item">
            <span>📂</span>
            <span>{book.genre}</span>
          </div>
          <div className="book-info-item">
            <span>📅</span>
            <span>{book.year}</span>
          </div>
          <div className="book-info-item">
            <span 
              className={`book-badge ${book.available ? 'badge-available' : 'badge-borrowed'}`}
            >
              {book.available ? '✓ Disponible' : '⏳ Emprunté'}
            </span>
          </div>
        </div>

        {/* Actions */}
        <div className="book-card-actions">
          <Link to={`/edit/${book.id}`} className="btn btn-primary btn-sm">
            ✏️ Modifier
          </Link>
          <button 
            className="btn btn-danger btn-sm"
            onClick={onDelete}
          >
            🗑️ Supprimer
          </button>
        </div>
      </div>
    </div>
  )
}

export default BookCard
