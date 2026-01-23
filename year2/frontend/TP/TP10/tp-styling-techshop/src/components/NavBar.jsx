import { Link, NavLink } from "react-router-dom";

// TODO: Styliser ce composant avec Bootstrap
// Classes suggérées: navbar, navbar-expand-lg, navbar-dark, bg-dark, container, navbar-brand, navbar-nav, nav-item, nav-link

function NavBar() {
  return (
    <nav className=" w-100 bg-dark px-5 fs-5 d-flex p-2 justify-content-between aligne-items-center">
      <div>
        <Link to="/" className="text-white text-decoration-none">
          TechShop
        </Link>
      </div>

      <ul className="d-flex list-unstyled gap-4">
        <li>
          <NavLink
            to="/"
            className={({ isActive }) =>
              `${
                isActive ? "text-white" : "text-secondary"
              } text-decoration-none`
            }
          >
            Accueil
          </NavLink>
        </li>
        <li>
          <NavLink
            to="/products"
            className={({ isActive }) =>
              `${
                isActive ? "text-white" : "text-secondary"
              } text-decoration-none`
            }
          >
            Produits
          </NavLink>
        </li>
        <li>
          <NavLink
            to="/add"
            className={({ isActive }) =>
              `${
                isActive ? "text-white" : "text-secondary"
              } text-decoration-none`
            }
          >
            Ajouter
          </NavLink>
        </li>
        <li>
          <NavLink
            to="/manage"
            className={({ isActive }) =>
              `${
                isActive ? "text-white" : "text-secondary"
              } text-decoration-none`
            }
          >
            Gestion
          </NavLink>
        </li>
      </ul>
    </nav>
  );
}

export default NavBar;
