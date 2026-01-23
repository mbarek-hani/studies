// TODO: Styliser ce composant avec Bootstrap
// Classes suggérées: card, h-100, shadow-sm, card-img-top, card-body, card-title, card-text
// badge, bg-secondary, btn, btn-warning, btn-danger, btn-sm

function ProductCard({ product, onEdit, onDelete }) {
  return (
    <div className="card h-100 w-100 shadow-sm">
      <img
        src={product.images}
        className="card-img-top"
        alt={product.title}
        style={{ height: "200px", objectFit: "cover" }}
      />

      <div className="card-body d-flex flex-column">
        <span className="badge bg-secondary mb-2 align-self-start">
          {product.category}
        </span>

        <h5 className="card-title text-truncate">{product.title}</h5>

        <p className="card-text text-muted small">{product.description}</p>

        <div className="mt-auto pt-3 border-top">
          <div className="d-flex justify-content-between align-items-center">
            <span className="fw-bold text-primary">{product.price} DH</span>

            <div className="btn-group">
              <button
                className="btn btn-warning btn-sm me-2"
                onClick={() => onEdit(product.id)}
              >
                Modifier
              </button>
              <button
                className="btn btn-danger btn-sm"
                onClick={() => onDelete(product.id)}
              >
                Supprimer
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}

export default ProductCard;
