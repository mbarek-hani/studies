import { Link } from "react-router-dom";

function Home() {
  return (
    <>
      <h1>Bienvenue sur TechShop</h1>
      <Link to="/products">
        <button>Voir nos produits</button>
      </Link>
    </>
  );
}

export default Home;
