import { useState } from "react";

function ProductForm({ onAddProduct }) {
  const [formData, setFormData] = useState({
    title: "",
    price: "",
    category: "",
    image: "",
  });

  const handleChange = (e) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value,
    });
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    onAddProduct(formData);
    setFormData({
      title: "",
      price: "",
      category: "",
      image: "",
    });
  };

  return (
    <form onSubmit={handleSubmit}>
      <input
        type="text"
        name="title"
        placeholder="Titre"
        value={formData.title}
        onChange={handleChange}
        required
      />
      <input
        type="number"
        name="price"
        placeholder="Prix"
        value={formData.price}
        onChange={handleChange}
        required
      />
      <input
        type="text"
        name="category"
        placeholder="Catégorie"
        value={formData.category}
        onChange={handleChange}
        required
      />
      <input
        type="text"
        name="image"
        placeholder="URL de l'image"
        value={formData.image}
        onChange={handleChange}
        required
      />
      <button type="submit">Ajouter</button>
    </form>
  );
}

export default ProductForm;
