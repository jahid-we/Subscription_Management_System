import { useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import { useAuth } from "../../hooks/useAuth.js";

export default function Login() {
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const [error, setError] = useState(null);
    const navigate = useNavigate();
    const { setAuth } = useAuth();

    const handleSubmit = async (e) => {
        e.preventDefault();
        setError(null);

        try {
            const response = await fetch(
                "http://127.0.0.1:8000/api/v1/user-login",
                {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    credentials: "include",
                    body: JSON.stringify({ email, password }),
                },
            );

            const data = await response.json();
            console.log(`Token from login: ${data?.token}`);

            if (response.ok && data.status === "success") {
                setAuth({ token: data?.token });
                navigate("/dashboard");
            } else {
                setError(data.data || "Login failed. Please try again.");
            }
        } catch (err) {
            setError("An error occurred. Please try again.");
        }
    };

    return (
        <div className="min-h-screen bg-[#1a1625] flex items-center justify-center p-4">
            <div className="w-full max-w-md space-y-8">
                <div className="space-y-2 text-center">
                    <h1 className="text-3xl font-bold tracking-tighter text-white">
                        Welcome back
                    </h1>
                    <p className="text-gray-400">
                        Enter your credentials to access your account
                    </p>
                </div>
                <div className="space-y-6 bg-[#231f31] p-8 rounded-lg">
                    {error && (
                        <div className="text-red-500 text-sm text-center mb-4">
                            {error}
                        </div>
                    )}
                    <form className="space-y-4" onSubmit={handleSubmit}>
                        <div className="space-y-2">
                            <label htmlFor="email" className="block text-white">
                                Email
                            </label>
                            <input
                                id="email"
                                name="email"
                                type="email"
                                value={email}
                                onChange={(e) => setEmail(e.target.value)}
                                required
                                placeholder="Enter your email"
                                className="w-full px-3 py-2 bg-[#1a1625] border border-[#2f2b3a] rounded-md text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#f6b03e] focus:border-[#f6b03e]"
                            />
                        </div>
                        <div className="space-y-2">
                            <div className="flex items-center justify-between">
                                <label
                                    htmlFor="password"
                                    className="text-white"
                                >
                                    Password
                                </label>
                                <Link
                                    to="/forgot-password"
                                    className="text-sm text-[#f6b03e] hover:text-[#f6b03e]/90"
                                >
                                    Forgot password?
                                </Link>
                            </div>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                value={password}
                                onChange={(e) => setPassword(e.target.value)}
                                required
                                placeholder="Enter your password"
                                className="w-full px-3 py-2 bg-[#1a1625] border border-[#2f2b3a] rounded-md text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#f6b03e] focus:border-[#f6b03e]"
                            />
                        </div>
                        <button
                            type="submit"
                            className="w-full py-2 px-4 bg-[#f6b03e] hover:bg-[#f6b03e]/90 text-black font-medium rounded-md transition-colors duration-200"
                        >
                            Sign in
                        </button>
                    </form>
                    <div className="text-center text-sm">
                        <span className="text-gray-400">
                            Don't have an account?{" "}
                        </span>
                        <Link
                            to="#"
                            className="text-[#f6b03e] hover:text-[#f6b03e]/90"
                        >
                            Sign up
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    );
}
