import {
  INCREMENT,
  DECREMENT,
  INCREMENT_BY,
  RESET
} from '../actions/counterActions';

const initialState = {
  count: 0
};

function counterReducer(state = initialState, action) {
  switch (action.type) {
    case INCREMENT:
      return {
        ...state,
        count: state.count + 1
      };

    case DECREMENT:
      return {
        ...state,
        count: state.count - 1
      };

    case INCREMENT_BY:
      return {
        ...state,
        count: state.count + action.payload
      };

    case RESET:
      return {
        ...state,
        count: 0
      };

    default:
      return state; 
  }
}

export default counterReducer;
