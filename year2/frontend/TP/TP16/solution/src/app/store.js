import { configureStore } from "@reduxjs/toolkit";
import stagiairesReducer from "../features/stagiaires/stagiairesSlice";

export const store = configureStore({
  reducer: {
    stagiaires: stagiairesReducer,
  },
});
