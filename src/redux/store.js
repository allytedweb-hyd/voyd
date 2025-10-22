import { configureStore } from "@reduxjs/toolkit";
import userReducer from "./slices/userSlice"; // Import the userSlice reducer
import shopCategory from "./slices/shopCategorySlice";

const store = configureStore({
  reducer: {
    user: userReducer, // Add the user reducer to the store
    tab: shopCategory,
  },
});

export default store;
