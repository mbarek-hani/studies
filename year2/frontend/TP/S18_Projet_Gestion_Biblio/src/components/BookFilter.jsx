import { useDispatch, useSelector } from 'react-redux'
import { 
  setGenreFilter, 
  setSearchTerm, 
  setAvailableOnly, 
  clearFilters 
} from '../features/books/booksSlice'
import { selectFilters, selectGenres } from '../features/books/booksSelectors'

function BookFilter() {
  const dispatch = useDispatch()
  const filters = useSelector(selectFilters)
  const genres = useSelector(selectGenres)

  return (
    <div className="filters">
      {/* Recherche */}
      <div className="filter-group">
        <label>Rechercher</label>
        <input
          type="text"
          className="filter-input"
          placeholder="Titre ou auteur..."
          value={filters.searchTerm}
          onChange={(e) => dispatch(setSearchTerm(e.target.value))}
        />
      </div>

      {/* Filtre par genre */}
      <div className="filter-group">
        <label>Genre</label>
        <select
          className="filter-select"
          value={filters.genre}
          onChange={(e) => dispatch(setGenreFilter(e.target.value))}
        >
          {genres.map(genre => (
            <option key={genre} value={genre}>
              {genre === 'all' ? '📚 Tous les genres' : genre}
            </option>
          ))}
        </select>
      </div>

      {/* Filtre disponibilité */}
      <label className="filter-checkbox">
        <input
          type="checkbox"
          checked={filters.availableOnly}
          onChange={(e) => dispatch(setAvailableOnly(e.target.checked))}
        />
        Disponibles uniquement
      </label>

      {/* Bouton reset */}
      <button 
        className="btn-clear"
        onClick={() => dispatch(clearFilters())}
      >
        ✕ Effacer filtres
      </button>
    </div>
  )
}

export default BookFilter
