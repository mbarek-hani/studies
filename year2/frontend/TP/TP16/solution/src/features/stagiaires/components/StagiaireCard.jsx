import React from "react";
import { useDispatch } from "react-redux";
import { deleteStagiaire } from "../stagiairesSlice";
import { Link } from "react-router-dom";

const StagiaireCard = ({ stagiaire }) => {
  const dispatch = useDispatch();

  const handleDelete = () => {
    if (window.confirm("Voulez-vous vraiment supprimer ce stagiaire ?")) {
      dispatch(deleteStagiaire(stagiaire.id));
    }
  };

  return (
    <div
      style={{
        border: "1px solid #ccc",
        padding: "10px",
        margin: "10px",
        borderRadius: "5px",
      }}
    >
      <h3>{stagiaire.nom}</h3>
      <p>Email: {stagiaire.email}</p>
      <p>
        Filière: {stagiaire.filiere} | Groupe: {stagiaire.groupe}
      </p>
      <p>Année: {stagiaire.annee}</p>
      <span
        style={{
          backgroundColor: stagiaire.actif ? "green" : "red",
          color: "white",
          padding: "3px 8px",
          borderRadius: "4px",
        }}
      >
        {stagiaire.actif ? "Inscrit" : "Abandon"}
      </span>
      <div style={{ marginTop: "10px" }}>
        <Link to={`/edit/${stagiaire.id}`}>
          <button>Modifier</button>
        </Link>
        <button
          onClick={handleDelete}
          style={{ marginLeft: "5px", backgroundColor: "tomato" }}
        >
          Supprimer
        </button>
      </div>
    </div>
  );
};

export default StagiaireCard;
