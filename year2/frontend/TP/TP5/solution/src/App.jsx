import { useState } from "react";
import "./App.css";

export default function App() {
  const [taille, setTaille] = useState("");
  const [genre, setGenre] = useState("");
  const [resultat, setResultat] = useState("");
  const image =
    genre === "homme" ? "/homme.jpg" : genre === "femme" ? "/femme.jpg" : "";

  const calculer = () => {
    if (!Number.isInteger(Number(taille))) {
      setResultat("La taille doit être un entier !");
      return;
    }

    if (taille < 150) {
      setResultat("La taille doit être ≥ 150 cm");
      return;
    }

    let poidsIdeal = 0;

    if (genre === "homme") {
      poidsIdeal = taille - 100 - (taille - 150) / 4;
    } else if (genre === "femme") {
      poidsIdeal = taille - 100 - (taille - 150) / 2;
    } else {
      setResultat("Veuillez choisir un genre");
      return;
    }

    setResultat(`Poids idéal est : ${Math.round(poidsIdeal)} KG`);
  };

  return (
    <div className="container">
      <h2>Calculatrice du poids idéal</h2>

      <label>Taille en CM:</label>
      <input
        type="text"
        value={taille}
        onChange={(e) => setTaille(e.target.value)}
      />

      <label>Genre:</label>
      <select value={genre} onChange={(e) => setGenre(e.target.value)}>
        <option value="">Choisissez le genre</option>
        <option value="homme">Homme</option>
        <option value="femme">Femme</option>
      </select>

      {image && <img src={image} alt="genre" className="avatar" />}

      <label>Poids idéal:</label>
      <input type="text" value={resultat} disabled />

      <button onClick={calculer}>Calculer</button>
    </div>
  );
}
