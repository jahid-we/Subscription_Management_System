import { useState } from "react";
import { Link } from "react-router-dom";

export default function ForgotPassword() {
    const [email, setEmail] = useState("");
    const [message, setMessage] = useState(null);
    const [error, setError] = useState(null);

    const handleSubmit = async (e) => {
        e.preventDefault();
        setMessage(null);
        setError(null);

        try {
            const response = await fetch(
                "http://127.0.0.1:8000/api/v1/forgot-password",
                {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({ email }),
                },
            );

            const data = await response.json();

            if (response.ok && data.status === "success") {
                setMessage(
                    "Password reset instructions have been sent to your email.",
                );
                setEmail("");
            } else {
                setError(data.data || "Unable to process the request.");
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
                        Forgot Password
                    </h1>
                    <p className="text-gray-400">
                        Enter your email to receive password reset instructions
                    </p>
                </div>
                <div className="space-y-6 bg-[#231f31] p-8 rounded-lg">
                    {message && (
                        <div className="text-green-500 text-sm text-center mb-4">
                            {message}
                        </div>
                    )}
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
                        <button
                            type="submit"
                            className="w-full py-2 px-4 bg-[#f6b03e] hover:bg-[#f6b03e]/90 text-black font-medium rounded-md transition-colors duration-200"
                        >
                            Send Reset Link
                        </button>
                    </form>
                    <div className="text-center text-sm">
                        <span className="text-gray-400">
                            Remembered your password?{" "}
                        </span>
                        <Link
                            to="/login"
                            className="text-[#f6b03e] hover:text-[#f6b03e]/90"
                        >
                            Sign in
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    );
}
