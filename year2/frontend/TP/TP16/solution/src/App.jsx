import { Routes, Route, Link } from "react-router-dom";
import HomePage from "./pages/HomePage";
import AddStagiairePage from "./pages/AddStagiairePage";
import EditStagiairePage from "./pages/EditStagiairePage";

function App() {
  return (
    <div className="App" style={{ padding: "20px" }}>
      <nav
        style={{
          marginBottom: "20px",
          borderBottom: "1px solid #ccc",
          paddingBottom: "10px",
        }}
      >
        <Link to="/" style={{ marginRight: "15px" }}>
          Accueil
        </Link>
        <Link to="/add">Ajouter un Stagiaire</Link>
      </nav>

      <Routes>
        <Route path="/" element={<HomePage />} />
        <Route path="/add" element={<AddStagiairePage />} />
        <Route path="/edit/:id" element={<EditStagiairePage />} />
      </Routes>
    </div>
  );
}

export default App;
