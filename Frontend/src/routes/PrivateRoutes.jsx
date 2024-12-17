import { Navigate } from "react-router-dom";
import { useContext } from "react";
import { AuthContext } from "../context/index.jsx";

export default function PrivateRoute({ children }) {
    const { auth, loading } = useContext(AuthContext);

    if (loading) {
        return <p>Loading...</p>;
    }

    if (!auth?.token) {
        console.log("Unauthorized access, redirecting to /login");
        return <Navigate to="/login" />;
    }

    return children;
}
