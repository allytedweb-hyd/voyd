import { createSlice } from "@reduxjs/toolkit";

const initialState = {
  user: null, // Initial state for the user
};

const userSlice = createSlice({
  name: "user", // Slice name
  initialState, // Initial state
  reducers: {
    // Reducer to create/set the user
    createUser: (state, action) => {
      state.user = action.payload; // Update the state with the user data
    },
    // Reducer to remove the user
    removeUser: (state) => {
      state.user = null; // Reset the user state to null
    },
  },
});

// Export the actions
export const { createUser, removeUser } = userSlice.actions;

// Export the reducer
export default userSlice.reducer;
