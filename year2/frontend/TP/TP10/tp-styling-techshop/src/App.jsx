import { useState } from 'react';
import { Routes, Route } from 'react-router-dom';

// Components
import NavBar from './components/NavBar';
import Home from './components/Home';
import ProductForm from './components/ProductForm';
import ProductList from './components/ProductList';
import ProductTable from './components/ProductTable';

// Data
import { initialProducts } from './data/products';

function App() {
  const [products, setProducts] = useState(initialProducts);

  // Ajouter un produit
  const handleAddProduct = (newProduct) => {
    setProducts([...products, newProduct]);
    alert('Produit ajouté avec succès !');
  };

  // Modifier un produit (simulation)
  const handleEditProduct = (id) => {
    const product = products.find(p => p.id === id);
    if (product) {
      alert(`Modifier le produit: ${product.name}`);
    }
  };

  // Supprimer un produit
  const handleDeleteProduct = (id) => {
    if (window.confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')) {
      setProducts(products.filter(p => p.id !== id));
    }
  };

  return (
    <div>
      {/* Navigation */}
      <NavBar />
      
      {/* Contenu principal */}
      <main>
        <Routes>
          {/* Page d'accueil */}
          <Route path="/" element={<Home />} />
          
          {/* Liste des produits (Cards) */}
          <Route 
            path="/products" 
            element={
              <ProductList 
                products={products}
                onEdit={handleEditProduct}
                onDelete={handleDeleteProduct}
              />
            } 
          />
          
          {/* Formulaire d'ajout */}
          <Route 
            path="/add" 
            element={<ProductForm onSubmit={handleAddProduct} />} 
          />
          
          {/* Gestion (Tableau) */}
          <Route 
            path="/manage" 
            element={
              <ProductTable 
                products={products}
                onEdit={handleEditProduct}
                onDelete={handleDeleteProduct}
              />
            } 
          />
          
          {/* Page 404 */}
          <Route 
            path="*" 
            element={
              <div style={{ padding: '40px', textAlign: 'center' }}>
                <h1>404 - Page non trouvée</h1>
              </div>
            } 
          />
        </Routes>
      </main>
    </div>
  );
}

export default App;
