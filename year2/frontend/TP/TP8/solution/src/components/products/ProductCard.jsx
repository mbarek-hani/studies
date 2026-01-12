function ProductCard({ product }) {
  function truncate(text, maxLength = 30) {
    if (!text) return "";
    return text.length > maxLength ? text.slice(0, maxLength) + "..." : text;
  }
  return (
    <div>
      <img src={product.image} width={150} height={150} />
      <h4>{truncate(product.title, 30)}</h4>
      <p>
        <span>{product.price}</span>
        <span>
          {product.rating.rate}({product.rating.count})
        </span>
      </p>
    </div>
  );
}

export default ProductCard;
