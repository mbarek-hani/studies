import { createSelector } from "@reduxjs/toolkit";

// 4.1 Selecteurs simples
export const selectAllStagiaires = (state) => state.stagiaires.items;
export const selectLoading = (state) => state.stagiaires.loading;
export const selectError = (state) => state.stagiaires.error;
export const selectFilters = (state) => state.stagiaires.filters;

// 4.2 Selecteur par ID
export const selectStagiaireById = (state, id) =>
  state.stagiaires.items.find((s) => s.id === Number(id));

// 4.3 Selecteur filtré
export const selectFilteredStagiaires = createSelector(
  [selectAllStagiaires, selectFilters],
  (items, filters) => {
    return items.filter((s) => {
      const matchFiliere = filters.filiere
        ? s.filiere === filters.filiere
        : true;
      const matchGroupe = filters.groupe ? s.groupe === filters.groupe : true;
      const matchSearch =
        s.nom.toLowerCase().includes(filters.searchTerm.toLowerCase()) ||
        s.email.toLowerCase().includes(filters.searchTerm.toLowerCase());
      const matchActif = filters.actifOnly ? s.actif === true : true;

      return matchFiliere && matchGroupe && matchSearch && matchActif;
    });
  },
);

// 4.4 Selecteur statistiques (Calculé sur le total des items)
export const selectStats = createSelector([selectAllStagiaires], (items) => {
  const stats = {
    total: items.length,
    actifs: items.filter((s) => s.actif).length,
    abandons: items.filter((s) => !s.actif).length,
    parFiliere: {},
  };

  items.forEach((s) => {
    stats.parFiliere[s.filiere] = (stats.parFiliere[s.filiere] || 0) + 1;
  });

  return stats;
});
