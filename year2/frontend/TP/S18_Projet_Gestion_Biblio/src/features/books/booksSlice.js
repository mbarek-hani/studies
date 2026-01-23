import { createSlice, createAsyncThunk } from '@reduxjs/toolkit'

const API_URL = 'http://localhost:3001/books'

// ============================================
// THUNKS ASYNCHRONES (CRUD)
// ============================================

// READ : Récupérer tous les livres
export const fetchBooks = createAsyncThunk(
  'books/fetchBooks',
  async (_, { rejectWithValue }) => {
    try {
      const response = await fetch(API_URL)
      if (!response.ok) {
        throw new Error('Erreur lors du chargement des livres')
      }
      return response.json()
    } catch (error) {
      return rejectWithValue(error.message)
    }
  }
)

// CREATE : Ajouter un livre
export const addBook = createAsyncThunk(
  'books/addBook',
  async (bookData, { rejectWithValue }) => {
    try {
      const response = await fetch(API_URL, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(bookData)
      })
      if (!response.ok) {
        throw new Error('Erreur lors de la création du livre')
      }
      return response.json()
    } catch (error) {
      return rejectWithValue(error.message)
    }
  }
)

// UPDATE : Modifier un livre
export const updateBook = createAsyncThunk(
  'books/updateBook',
  async ({ id, ...bookData }, { rejectWithValue }) => {
    try {
      const response = await fetch(`${API_URL}/${id}`, {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(bookData)
      })
      if (!response.ok) {
        throw new Error('Erreur lors de la modification du livre')
      }
      return response.json()
    } catch (error) {
      return rejectWithValue(error.message)
    }
  }
)

// DELETE : Supprimer un livre
export const deleteBook = createAsyncThunk(
  'books/deleteBook',
  async (bookId, { rejectWithValue }) => {
    try {
      const response = await fetch(`${API_URL}/${bookId}`, {
        method: 'DELETE'
      })
      if (!response.ok) {
        throw new Error('Erreur lors de la suppression du livre')
      }
      return bookId // Retourner l'ID pour le filtrer du state
    } catch (error) {
      return rejectWithValue(error.message)
    }
  }
)

// ============================================
// SLICE
// ============================================

const initialState = {
  items: [],
  loading: false,
  error: null,
  filters: {
    genre: 'all',
    searchTerm: '',
    availableOnly: false
  }
}

const booksSlice = createSlice({
  name: 'books',
  initialState,
  
  // Reducers synchrones (pour les filtres)
  reducers: {
    setGenreFilter: (state, action) => {
      state.filters.genre = action.payload
    },
    setSearchTerm: (state, action) => {
      state.filters.searchTerm = action.payload
    },
    setAvailableOnly: (state, action) => {
      state.filters.availableOnly = action.payload
    },
    clearFilters: (state) => {
      state.filters = {
        genre: 'all',
        searchTerm: '',
        availableOnly: false
      }
    },
    clearError: (state) => {
      state.error = null
    }
  },
  
  // Reducers asynchrones (pour les thunks)
  extraReducers: (builder) => {
    builder
      // ===== FETCH BOOKS =====
      .addCase(fetchBooks.pending, (state) => {
        state.loading = true
        state.error = null
      })
      .addCase(fetchBooks.fulfilled, (state, action) => {
        state.loading = false
        state.items = action.payload
      })
      .addCase(fetchBooks.rejected, (state, action) => {
        state.loading = false
        state.error = action.payload
      })
      
      // ===== ADD BOOK =====
      .addCase(addBook.pending, (state) => {
        state.loading = true
        state.error = null
      })
      .addCase(addBook.fulfilled, (state, action) => {
        state.loading = false
        state.items.push(action.payload)
      })
      .addCase(addBook.rejected, (state, action) => {
        state.loading = false
        state.error = action.payload
      })
      
      // ===== UPDATE BOOK =====
      .addCase(updateBook.pending, (state) => {
        state.loading = true
        state.error = null
      })
      .addCase(updateBook.fulfilled, (state, action) => {
        state.loading = false
        const index = state.items.findIndex(book => book.id === action.payload.id)
        if (index !== -1) {
          state.items[index] = action.payload
        }
      })
      .addCase(updateBook.rejected, (state, action) => {
        state.loading = false
        state.error = action.payload
      })
      
      // ===== DELETE BOOK =====
      .addCase(deleteBook.pending, (state) => {
        state.loading = true
        state.error = null
      })
      .addCase(deleteBook.fulfilled, (state, action) => {
        state.loading = false
        state.items = state.items.filter(book => book.id !== action.payload)
      })
      .addCase(deleteBook.rejected, (state, action) => {
        state.loading = false
        state.error = action.payload
      })
  }
})

// Exporter les actions
export const { 
  setGenreFilter, 
  setSearchTerm, 
  setAvailableOnly, 
  clearFilters,
  clearError 
} = booksSlice.actions

// Exporter le reducer
export default booksSlice.reducer
