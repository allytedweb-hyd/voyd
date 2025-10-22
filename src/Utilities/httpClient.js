import axios from "axios";
import { environmentUrl } from "../env/enviroment";

export const httpClient = axios.create({
  baseURL: environmentUrl,
  headers: {
    "Content-Type": "application/json",
    Authorization:
      localStorage.getItem("token") == null
        ? null
        : `Bearer ${localStorage.getItem("token")}`,
  },
});

export const verifyJwtToken = (token) => {
  if (!token) {
    return false;
  }
  try {
    const payload = JSON.parse(atob(token.split(".")[1]));
    const expiry = payload.exp * 1000;
    return Date.now() > expiry;
  } catch (error) {
    console.log("verify token error====", error);
  }
};
