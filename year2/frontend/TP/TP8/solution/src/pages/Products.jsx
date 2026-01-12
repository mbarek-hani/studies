import { ProductCard } from "@/components";
import { useEffect } from "react";
import { useState } from "react";

function Products() {
  const [products, setProducts] = useState([]);
  const [isLoading, setIsLoading] = useState(true);
  const [error, setError] = useState(null);

  async function getProducts() {
    setIsLoading(true);
    try {
      const response = await fetch("https://fakestoreapi.com/products");
      const data = await response.json();
      setProducts(data);
      setError(null);
      setIsLoading(false);
    } catch (e) {
      setError("Error: " + e.message);
    } finally {
      setIsLoading(false);
    }
  }

  useEffect(() => {
    getProducts();
  }, []);

  if (isLoading) {
    return <p>Loading...</p>;
  }

  if (error) {
    return <p>{error}</p>;
  }

  return (
    <>
      <h1>Products</h1>
      <div>
        {products.map((product) => (
          <ProductCard key={product.id} product={product} />
        ))}
      </div>
    </>
  );
}

export default Products;
