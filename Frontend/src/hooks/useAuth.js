import { useContext, useDebugValue } from "react";
import { AuthContext } from "../context/index.jsx";

export const useAuth = () => {
    const { auth } = useContext(AuthContext);
    useDebugValue(auth, (auth) =>
        auth?.token ? "User logged in" : "User logged out",
    );
    return useContext(AuthContext);
};
