import React, { useEffect } from "react";
import { useDispatch, useSelector } from "react-redux";
import { fetchStagiaires } from "../stagiairesSlice";
import {
  selectFilteredStagiaires,
  selectLoading,
  selectError,
  selectStats,
} from "../stagiairesSelectors";
import StagiaireCard from "./StagiaireCard";
import StagiaireFilter from "./StagiaireFilter";

const StagiaireList = () => {
  const dispatch = useDispatch();
  const stagiaires = useSelector(selectFilteredStagiaires);
  const loading = useSelector(selectLoading);
  const error = useSelector(selectError);
  const stats = useSelector(selectStats);

  useEffect(() => {
    dispatch(fetchStagiaires());
  }, [dispatch]);

  if (loading) return <p>Chargement...</p>;
  if (error) return <p style={{ color: "red" }}>Erreur : {error}</p>;

  return (
    <div>
      <h2>Liste des Stagiaires</h2>

      {/* Statistiques */}
      <div
        style={{ background: "#f0f0f0", padding: "10px", marginBottom: "10px" }}
      >
        <strong>Total: {stats.total}</strong> | Actifs: {stats.actifs} |
        Abandons: {stats.abandons} <br />
        Par filière: {JSON.stringify(stats.parFiliere)}
      </div>

      <StagiaireFilter />

      <div
        style={{
          display: "grid",
          gridTemplateColumns: "repeat(auto-fill, minmax(250px, 1fr))",
        }}
      >
        {stagiaires.map((stagiaire) => (
          <StagiaireCard key={stagiaire.id} stagiaire={stagiaire} />
        ))}
      </div>
      {stagiaires.length === 0 && <p>Aucun stagiaire trouvé.</p>}
    </div>
  );
};

export default StagiaireList;
