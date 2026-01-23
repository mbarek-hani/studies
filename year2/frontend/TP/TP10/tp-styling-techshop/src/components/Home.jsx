import { Link } from "react-router-dom";

// TODO: Styliser ce composant avec Bootstrap
// Creer une Hero Section avec :
// - Fond colore (bg-dark, bg-primary, ou gradient)
// - Centrage vertical et horizontal
// - Titre principal grand
// - Sous-titre descriptif
// - Bouton CTA vers /products
// Classes suggerees: container, d-flex, flex-column, justify-content-center,
// align-items-center, text-center, vh-100, bg-dark, text-white, btn, btn-primary, btn-lg

function Home() {
  return (
    <div className="bg-dark text-white vh-100  d-flex flex-column justify-content-center align-items-center">
      <h1>Bienvenue sur TechShop</h1>
      <p>Votre boutique en ligne de produits tech</p>
      <p>Decouvrez notre selection de smartphones, laptops et accessoires</p>
      <Link className="text-decoration-none btn btn-primary" to="/products">
        Voir les Produits
      </Link>
    </div>
  );
}

export default Home;
