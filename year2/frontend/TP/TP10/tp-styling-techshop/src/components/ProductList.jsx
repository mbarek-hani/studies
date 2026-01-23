import { Col, Row } from "react-bootstrap";
import ProductCard from "./ProductCard";

function ProductList({ products, onEdit, onDelete }) {
  return (
    <div className="d-flex flex-column align-items-center justify-content-start min-vh-100 p-4">
      <h2>Nos Produits</h2>
      <p>{products.length} produit(s) disponible(s)</p>

      <Row className="g-4 d-">
        {products.map((product) => (
          <Col key={product.id} xs={12} sm={6} md={4} lg={3}>
            <ProductCard
              product={product}
              onEdit={onEdit}
              onDelete={onDelete}
            />
          </Col>
        ))}
      </Row>

      {products.length === 0 && <p>Aucun produit disponible.</p>}
    </div>
  );
}

export default ProductList;
