import React, { useState, useEffect } from "react";
import { useDispatch, useSelector } from "react-redux";
import { useNavigate, useParams } from "react-router-dom";
import { addStagiaire, updateStagiaire } from "../stagiairesSlice";
import { selectStagiaireById } from "../stagiairesSelectors";

const StagiaireForm = () => {
  const { id } = useParams();
  const isEdit = !!id;
  const navigate = useNavigate();
  const dispatch = useDispatch();

  // Select stagiaire if edit mode
  const existingStagiaire = useSelector((state) =>
    isEdit ? selectStagiaireById(state, id) : null,
  );

  const [formData, setFormData] = useState({
    nom: "",
    email: "",
    filiere: "DEVOWFS",
    groupe: "A",
    annee: 1,
    actif: true,
  });

  useEffect(() => {
    if (isEdit && existingStagiaire) {
      setFormData(existingStagiaire);
    }
  }, [isEdit, existingStagiaire]);

  const handleSubmit = (e) => {
    e.preventDefault();
    if (isEdit) {
      dispatch(updateStagiaire({ ...formData, id: Number(id) }));
    } else {
      // ID généré par json-server automatiquement
      dispatch(addStagiaire(formData));
    }
    navigate("/");
  };

  const handleChange = (e) => {
    const { name, value, type, checked } = e.target;
    setFormData((prev) => ({
      ...prev,
      [name]: type === "checkbox" ? checked : value,
    }));
  };

  return (
    <div>
      <h2>{isEdit ? "Modifier" : "Ajouter"} un Stagiaire</h2>
      <form
        onSubmit={handleSubmit}
        style={{
          maxWidth: "400px",
          display: "flex",
          flexDirection: "column",
          gap: "10px",
        }}
      >
        <input
          name="nom"
          value={formData.nom}
          onChange={handleChange}
          placeholder="Nom complet"
          required
        />
        <input
          name="email"
          value={formData.email}
          onChange={handleChange}
          placeholder="Email"
          required
        />

        <select name="filiere" value={formData.filiere} onChange={handleChange}>
          <option value="DEVOWFS">DEVOWFS</option>
          <option value="IDOSR">IDOSR</option>
          <option value="INFRA">INFRA</option>
          <option value="GCRH">GCRH</option>
        </select>

        <select name="groupe" value={formData.groupe} onChange={handleChange}>
          <option value="A">A</option>
          <option value="B">B</option>
          <option value="C">C</option>
        </select>

        <input
          type="number"
          name="annee"
          value={formData.annee}
          onChange={handleChange}
          min="1"
          max="2"
        />

        <label>
          <input
            type="checkbox"
            name="actif"
            checked={formData.actif}
            onChange={handleChange}
          />
          Actif / Inscrit
        </label>

        <button type="submit">
          {isEdit ? "Mettre à jour" : "Enregistrer"}
        </button>
      </form>
    </div>
  );
};

export default StagiaireForm;
