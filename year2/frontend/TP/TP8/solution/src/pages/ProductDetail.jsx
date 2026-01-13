import { useParams, useNavigate } from "react-router-dom";
import { useState, useEffect } from "react";

function ProductDetail() {
  const { id } = useParams();
  const navigate = useNavigate();
  const [product, setProduct] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  const handleAddToCart = () => {
    alert("Produit ajouté au panier !");
    setTimeout(() => {
      navigate("/products");
    }, 1000);
  };

  useEffect(() => {
    async function getProduct() {
      setLoading(true);
      setError(null);
      try {
        const response = await fetch(`https://fakestoreapi.com/products/${id}`);
        if (!response.ok) {
          throw new Error("Produit non trouvé");
        }
        const data = await response.json();
        setProduct(data);
      } catch (e) {
        setError(e.message);
      } finally {
        setLoading(false);
      }
    }
    getProduct();
  }, [id]);

  if (loading) {
    return <div>Chargement...</div>;
  }

  if (error) {
    return <div>{error}</div>;
  }

  return (
    <div>
      <button onClick={() => navigate(-1)}>Retour</button>
      <img src={product.image} width="400" />
      <h1>{product.title}</h1>
      <p>{product.description}</p>
      <p>Prix: {product.price} DH</p>
      <p>Catégorie: {product.category}</p>
      <p>
        Note: {product.rating.rate} ({product.rating.count})
      </p>
      <button onClick={handleAddToCart}>Ajouter au panier</button>
    </div>
  );
}

export default ProductDetail;
