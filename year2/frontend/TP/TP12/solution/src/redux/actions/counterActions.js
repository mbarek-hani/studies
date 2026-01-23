// TYPES
export const INCREMENT = 'INCREMENT';
export const DECREMENT = 'DECREMENT';
export const INCREMENT_BY = 'INCREMENT_BY';
export const RESET = 'RESET';

// ACTION CREATORS
export const increment = () => {
  return { type: INCREMENT };
};

export const decrement = () => {
  return { type: DECREMENT };
};

export const incrementBy = (amount) => {
  return {
    type: INCREMENT_BY,
    payload: amount
  };
};

export const reset = () => {
  return { type: RESET };
};
