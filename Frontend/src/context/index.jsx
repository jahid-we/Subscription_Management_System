// import { createContext, useState, useEffect } from "react";
// import { jwtDecode } from "jwt-decode";
//
// export const AuthContext = createContext();
//
// export const AuthProvider = ({ children }) => {
//     const [auth, setAuth] = useState({ token: null });
//     const [loading, setLoading] = useState(true);
//
//     useEffect(() => {
//         const token = localStorage.getItem("token");
//
//         if (token) {
//             try {
//                 const decoded = jwtDecode(token);
//                 console.log(decoded);
//                 console.log("Retrieved token:", token);
//                 setAuth({ token });
//             } catch (err) {
//                 console.error("Error decoding token:", err);
//                 setAuth({ token: null });
//             }
//         }
//         setLoading(false);
//     }, []);
//
//     return (
//         <AuthContext.Provider value={{ auth, setAuth, loading }}>
//             {children}
//         </AuthContext.Provider>
//     );
// };

import { createContext, useState, useEffect } from "react";
import { jwtDecode } from "jwt-decode";

export const AuthContext = createContext();

export const AuthProvider = ({ children }) => {
    const [auth, setAuth] = useState({ token: null });
    const [loading, setLoading] = useState(true);

    // Utility function to get the token from cookies
    const getCookie = (name) => {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(";").shift();
        return null;
    };

    useEffect(() => {
        const token = getCookie("token");
        if (token) {
            try {
                setAuth({ token });
            } catch (err) {
                console.error("Error decoding token:", err);
                setAuth({ token: null });
            }
        }
        setLoading(false);
    }, []);

    return (
        <AuthContext.Provider value={{ auth, setAuth, loading }}>
            {children}
        </AuthContext.Provider>
    );
};
