import { useState, useEffect } from "react";

function UsersList() {
  const [users, setUsers] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  async function getUsers() {
    setLoading(true);
    setError(null);
    try {
      const response = await fetch(
        "https://jsonplaceholder.typicode.com/users",
      );
      if (!response.ok) {
        throw new Error("server error");
      }
      const data = await response.json();
      setUsers(data);
    } catch (e) {
      setError(e.message);
    } finally {
      setLoading(false);
    }
  }

  useEffect(() => {
    getUsers();
  }, []);
  if (loading) return <p> Chargement ... </p>;
  if (error) return <p style={{ color: "red" }}> Erreur : {error} </p>;
  return (
    <div>
      <h2> Liste des Utilisateurs </h2>
      <button onClick={getUsers}>Refraichir</button>
      <ul>
        {users.map((user) => (
          <li key={user.id}>
            {user.name} - {user.email} - {user.address.city}
          </li>
        ))}
      </ul>
    </div>
  );
}

export default UsersList;
