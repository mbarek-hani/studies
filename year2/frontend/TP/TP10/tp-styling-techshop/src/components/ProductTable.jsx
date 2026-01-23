function ProductTable({ products, onEdit, onDelete }) {
  return (
    <div className="container py-4">
      <h2 className="text-center mb-3">Liste des Produits</h2>

      {products.length > 0 ? (
        <div className="table-responsive">
          <table className="table table-striped table-hover align-middle">
            <thead className="table-dark">
              <tr>
                <th>#</th>
                <th>Image</th>
                <th>Catégorie</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Prix (DH)</th>
                <th>Actions</th>
              </tr>
            </thead>

            <tbody>
              {products.map((product, index) => (
                <tr key={product.id}>
                  <td>{index + 1}</td>
                  <td>
                    <img
                      src={product.images?.[0]}
                      alt={product.title}
                      style={{
                        width: "60px",
                        height: "60px",
                        objectFit: "cover",
                      }}
                    />
                  </td>
                  <td>{product.category}</td>
                  <td>{product.title}</td>
                  <td className="text-truncate" style={{ maxWidth: "200px" }}>
                    {product.description}
                  </td>
                  <td className="fw-bold text-primary">{product.price}</td>
                  <td>
                    <div className="btn-group">
                      <button
                        className="btn btn-sm btn-outline-warning"
                        onClick={() => onEdit(product.id)}
                      >
                        Modifier
                      </button>
                      <button
                        className="btn btn-sm btn-outline-danger"
                        onClick={() => onDelete(product.id)}
                      >
                        Supprimer
                      </button>
                    </div>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      ) : (
        <p className="text-center text-muted mt-4">Aucun produit disponible.</p>
      )}
    </div>
  );
}

export default ProductTable;
