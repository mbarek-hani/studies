import { useState, useEffect } from 'react'
import { useDispatch, useSelector } from 'react-redux'
import { useNavigate } from 'react-router-dom'
import { addBook, updateBook } from '../features/books/booksSlice'
import { selectLoading } from '../features/books/booksSelectors'

function BookForm({ existingBook = null }) {
  const dispatch = useDispatch()
  const navigate = useNavigate()
  const loading = useSelector(selectLoading)

  // State local pour le formulaire
  const [formData, setFormData] = useState({
    title: '',
    author: '',
    genre: '',
    year: '',
    available: true
  })

  // Pré-remplir si mode édition
  useEffect(() => {
    if (existingBook) {
      setFormData({
        title: existingBook.title,
        author: existingBook.author,
        genre: existingBook.genre,
        year: existingBook.year,
        available: existingBook.available
      })
    }
  }, [existingBook])

  // Gestion des changements
  const handleChange = (e) => {
    const { name, value, type, checked } = e.target
    setFormData(prev => ({
      ...prev,
      [name]: type === 'checkbox' ? checked : value
    }))
  }

  // Soumission du formulaire
  const handleSubmit = async (e) => {
    e.preventDefault()

    // Préparer les données (convertir year en number)
    const bookData = {
      ...formData,
      year: parseInt(formData.year) || new Date().getFullYear()
    }

    if (existingBook) {
      // Mode ÉDITION
      await dispatch(updateBook({ id: existingBook.id, ...bookData }))
    } else {
      // Mode AJOUT
      await dispatch(addBook(bookData))
    }

    // Rediriger vers la liste
    navigate('/')
  }

  const genres = ['Roman', 'Science-Fiction', 'Science', 'Histoire', 'Informatique', 'Philosophie', 'Biographie']

  return (
    <form onSubmit={handleSubmit} className="form-container">
      {/* Titre */}
      <div className="form-group">
        <label htmlFor="title">Titre *</label>
        <input
          type="text"
          id="title"
          name="title"
          className="form-control"
          value={formData.title}
          onChange={handleChange}
          placeholder="Ex: Le Petit Prince"
          required
        />
      </div>

      {/* Auteur */}
      <div className="form-group">
        <label htmlFor="author">Auteur *</label>
        <input
          type="text"
          id="author"
          name="author"
          className="form-control"
          value={formData.author}
          onChange={handleChange}
          placeholder="Ex: Antoine de Saint-Exupéry"
          required
        />
      </div>

      {/* Genre */}
      <div className="form-group">
        <label htmlFor="genre">Genre *</label>
        <select
          id="genre"
          name="genre"
          className="form-control"
          value={formData.genre}
          onChange={handleChange}
          required
        >
          <option value="">-- Sélectionner un genre --</option>
          {genres.map(genre => (
            <option key={genre} value={genre}>{genre}</option>
          ))}
        </select>
      </div>

      {/* Année */}
      <div className="form-group">
        <label htmlFor="year">Année de publication</label>
        <input
          type="number"
          id="year"
          name="year"
          className="form-control"
          value={formData.year}
          onChange={handleChange}
          placeholder="Ex: 1943"
          min="1000"
          max={new Date().getFullYear()}
        />
      </div>

      {/* Disponibilité */}
      <div className="form-group">
        <label className="form-check">
          <input
            type="checkbox"
            name="available"
            checked={formData.available}
            onChange={handleChange}
          />
          <span>Disponible pour emprunt</span>
        </label>
      </div>

      {/* Boutons */}
      <div className="form-actions">
        <button 
          type="submit" 
          className="btn btn-success"
          disabled={loading}
        >
          {loading ? '⏳ En cours...' : (existingBook ? '✓ Modifier' : '+ Ajouter')}
        </button>
        <button 
          type="button" 
          className="btn btn-secondary"
          onClick={() => navigate('/')}
        >
          Annuler
        </button>
      </div>
    </form>
  )
}

export default BookForm
