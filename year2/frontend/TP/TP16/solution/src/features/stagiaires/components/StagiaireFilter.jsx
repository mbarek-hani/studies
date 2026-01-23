import React from "react";
import { useDispatch, useSelector } from "react-redux";
import {
  setFiliereFilter,
  setGroupeFilter,
  setSearchTerm,
  setActifOnly,
  clearFilters,
} from "../stagiairesSlice";
import { selectFilters } from "../stagiairesSelectors";

const StagiaireFilter = () => {
  const dispatch = useDispatch();
  const filters = useSelector(selectFilters);

  return (
    <div
      className="filter-container"
      style={{
        marginBottom: "20px",
        padding: "15px",
        border: "1px solid #ddd",
      }}
    >
      <input
        type="text"
        placeholder="Rechercher nom ou email..."
        value={filters.searchTerm}
        onChange={(e) => dispatch(setSearchTerm(e.target.value))}
      />

      <select
        value={filters.filiere}
        onChange={(e) => dispatch(setFiliereFilter(e.target.value))}
      >
        <option value="">Toutes les filières</option>
        <option value="DEVOWFS">DEVOWFS</option>
        <option value="IDOSR">IDOSR</option>
        <option value="INFRA">INFRA</option>
        <option value="GCRH">GCRH</option>
      </select>

      <select
        value={filters.groupe}
        onChange={(e) => dispatch(setGroupeFilter(e.target.value))}
      >
        <option value="">Tous les groupes</option>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
      </select>

      <label>
        <input
          type="checkbox"
          checked={filters.actifOnly}
          onChange={(e) => dispatch(setActifOnly(e.target.checked))}
        />
        Actifs uniquement
      </label>

      <button onClick={() => dispatch(clearFilters())}>Effacer Filtres</button>
    </div>
  );
};

export default StagiaireFilter;
