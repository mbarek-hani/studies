import { useSelector, useDispatch } from "react-redux";
import {
  increment,
  decrement,
  incrementBy,
  reset,
} from "../redux/actions/counterActions";

function Counter() {
  const count = useSelector((state) => state.counter.count);
  const dispatch = useDispatch();

  return (
    <div>
      <h1>Compteur Redux</h1>

      <h2>{count}</h2>

      <div>
        <button onClick={() => dispatch(increment())}>+1</button>
        <button onClick={() => dispatch(decrement())}>-1</button>
        <button onClick={() => dispatch(incrementBy(5))}>+5</button>
        <button onClick={() => dispatch(reset())}>Reset</button>
      </div>
    </div>
  );
}

export default Counter;
