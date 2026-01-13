import { Link, useNavigate } from "react-router-dom";

function ProductCard({ product, onDelete }) {
  const navigate = useNavigate();
  function truncate(text, maxLength = 30) {
    if (!text) return "";
    return text.length > maxLength ? text.slice(0, maxLength) + "..." : text;
  }
  return (
    <div className="product-card">
      <img src={product.image} width="150" height="150" />
      <h3>{truncate(product.title, 30)}</h3>
      <p>{product.price} DH</p>
      <p>
        Note: {product.rating.rate} ({product.rating.count})
      </p>
      <button onClick={() => onDelete(product.id)}>Supprimer</button>
      <button onClick={() => navigate(`/products/edit/${product.id}`)}>
        Modifier
      </button>
      <Link to={`/products/${product.id}`}>Voir details</Link>
    </div>
  );
}

export default ProductCard;
