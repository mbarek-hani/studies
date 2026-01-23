import { createSlice, createAsyncThunk } from "@reduxjs/toolkit";
import axios from "axios";

const URL = "http://localhost:3000/stagiaires";

// --- PARTIE 2 : THUNKS ---
export const fetchStagiaires = createAsyncThunk(
  "stagiaires/fetch",
  async () => {
    const response = await axios.get(URL);
    return response.data;
  },
);

export const addStagiaire = createAsyncThunk(
  "stagiaires/add",
  async (stagiaire) => {
    const response = await axios.post(URL, stagiaire);
    return response.data;
  },
);

export const updateStagiaire = createAsyncThunk(
  "stagiaires/update",
  async (stagiaire) => {
    const response = await axios.put(`${URL}/${stagiaire.id}`, stagiaire);
    return response.data;
  },
);

export const deleteStagiaire = createAsyncThunk(
  "stagiaires/delete",
  async (id) => {
    await axios.delete(`${URL}/${id}`);
    return id;
  },
);

// --- PARTIE 3 : SLICE ---
const initialState = {
  items: [],
  loading: false,
  error: null,
  filters: {
    filiere: "",
    groupe: "",
    searchTerm: "",
    actifOnly: false,
  },
};

const stagiairesSlice = createSlice({
  name: "stagiaires",
  initialState,
  reducers: {
    setFiliereFilter: (state, action) => {
      state.filters.filiere = action.payload;
    },
    setGroupeFilter: (state, action) => {
      state.filters.groupe = action.payload;
    },
    setSearchTerm: (state, action) => {
      state.filters.searchTerm = action.payload;
    },
    setActifOnly: (state, action) => {
      state.filters.actifOnly = action.payload;
    },
    clearFilters: (state) => {
      state.filters = {
        filiere: "",
        groupe: "",
        searchTerm: "",
        actifOnly: false,
      };
    },
  },
  extraReducers: (builder) => {
    builder
      // Fetch
      .addCase(fetchStagiaires.pending, (state) => {
        state.loading = true;
        state.error = null;
      })
      .addCase(fetchStagiaires.fulfilled, (state, action) => {
        state.loading = false;
        state.items = action.payload;
      })
      .addCase(fetchStagiaires.rejected, (state, action) => {
        state.loading = false;
        state.error = action.error.message;
      })
      // Add
      .addCase(addStagiaire.fulfilled, (state, action) => {
        state.items.push(action.payload);
      })
      // Update
      .addCase(updateStagiaire.fulfilled, (state, action) => {
        const index = state.items.findIndex((s) => s.id === action.payload.id);
        if (index !== -1) state.items[index] = action.payload;
      })
      // Delete
      .addCase(deleteStagiaire.fulfilled, (state, action) => {
        state.items = state.items.filter((s) => s.id !== action.payload);
      });
  },
});

export const {
  setFiliereFilter,
  setGroupeFilter,
  setSearchTerm,
  setActifOnly,
  clearFilters,
} = stagiairesSlice.actions;
export default stagiairesSlice.reducer;
