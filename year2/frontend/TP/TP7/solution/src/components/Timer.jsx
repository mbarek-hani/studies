import { useState, useEffect } from "react";

function Timer() {
  const [seconds, setSeconds] = useState(0);
  const [isActive, setIsActive] = useState(false);

  useEffect(() => {
    if (isActive) {
      const id = setInterval(() => setSeconds((s) => s + 1), 1000);
      return () => clearInterval(id);
    }
  }, [isActive]);

  function handleStart() {
    if (!isActive) {
      setIsActive(true);
    }
  }

  function handleStop() {
    if (isActive) {
      setIsActive(false);
    }
  }

  return (
    <div>
      <h2> Timer : {seconds}s </h2>
      <button onClick={handleStart}>Start</button>
      <button onClick={handleStop}>Stop</button>
    </div>
  );
}

export default Timer;
