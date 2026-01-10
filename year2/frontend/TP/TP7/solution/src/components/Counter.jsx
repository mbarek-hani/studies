import { useState, useEffect } from "react";
function Counter() {
  const [count, setCount] = useState(0);
  useEffect(() => {
    document.title = `count is ${count}`;
  }, [count]);
  return (
    <div>
      <h2> Compteur : {count} </h2>
      <button onClick={() => setCount((c) => c + 1)}>incrémenter</button>
      <button onClick={() => setCount((c) => c - 1)}>décrémenter</button>
    </div>
  );
}

export default Counter;
