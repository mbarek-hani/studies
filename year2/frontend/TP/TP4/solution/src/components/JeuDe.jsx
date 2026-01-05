import { useState } from "react";

export default function JeuDe({ cache }) {
  const [face, setFace] = useState(null);
  const [compteur, setCompteur] = useState(0);
  const [fin, setFin] = useState(false);

  const jouer = () => {
    if (fin) return;

    const valeur = Math.floor(Math.random() * 6) + 1;

    setFace(valeur);
    setCompteur((prev) => prev + 1);

    if (valeur === cache) {
      setFin(true);
    }
  };

  const initialiser = () => {
    setFace(null);
    setCompteur(0);
    setFin(false);
  };

  const getImage = () => {
    if (face === null) return "/0.png";
    return `/${face}.png`;
  };

  const styleImageDe = { width: "60px", height: "60px" };
  const styleImageJeu = { width: "100px", height: "100px" };

  return (
    <div>
      <img src="/0.png" style={styleImageJeu} />
      <h1>Jeu de Dé</h1>

      <h2>Face : {face !== null ? face : "—"}</h2>
      <img src={getImage()} style={styleImageDe} />

      <h2>Nombre d'essais : {compteur}</h2>

      {!fin && <button onClick={jouer}>Jouer</button>}

      {fin && (
        <>
          <p>Bravo vous avez trouvé la face cachée</p>
          <button onClick={initialiser}>Initialiser</button>
        </>
      )}
    </div>
  );
}
