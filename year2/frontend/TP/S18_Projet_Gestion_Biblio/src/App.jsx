import { Routes, Route, Link } from 'react-router-dom'
import HomePage from './pages/HomePage'
import AddBookPage from './pages/AddBookPage'
import EditBookPage from './pages/EditBookPage'

function App() {
  return (
    <div className="app">
      {/* Navigation */}
      <nav className="navbar">
        <div className="nav-brand">
          <span className="nav-icon">📚</span>
          <span>Bibliothèque</span>
        </div>
        <div className="nav-links">
          <Link to="/" className="nav-link">Accueil</Link>
          <Link to="/add" className="nav-link nav-link-primary">+ Ajouter Livre</Link>
        </div>
      </nav>

      {/* Contenu principal */}
      <main className="main-content">
        <Routes>
          <Route path="/" element={<HomePage />} />
          <Route path="/add" element={<AddBookPage />} />
          <Route path="/edit/:id" element={<EditBookPage />} />
        </Routes>
      </main>

      {/* Footer */}
      <footer className="footer">
        <p>Session 18 - Redux Toolkit | ISTA 2025/2026</p>
      </footer>
    </div>
  )
}

export default App
