import { useState, useEffect } from "react";
import axios from "axios";
import { useAuth } from "../../hooks/useAuth.js";
import { useNavigate } from "react-router-dom";

export default function Profile() {
    const [profile, setProfile] = useState({
        name: "",
        email: "",
        phone: "",
        address: "",
    });
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState("");
    const { auth } = useAuth();
    const navigate = useNavigate();
    console.log(auth?.token);

    useEffect(() => {
        const fetchProfile = async () => {
            try {
                const response = await fetch(
                    "http://127.0.0.1:8000/api/v1/user-profile-info",
                    {
                        method: "GET",
                        headers: {
                            Authorization: `Bearer ${auth?.token}`,
                            "Content-Type": "application/json",
                        },
                        credentials: "include",
                    },
                );

                if (response.status === 401) {
                    setError("Session expired. Please log in again.");
                    navigate("/login");
                    return;
                }

                if (!response.ok) {
                    throw new Error("Failed to fetch profile information.");
                }

                const data = await response.json();
                setProfile(data.data);
            } catch (err) {
                console.error("Error fetching profile:", err);
                setError("Failed to fetch profile information.");
            } finally {
                setLoading(false);
            }
        };

        fetchProfile();
    }, []);

    const handleChange = (e) => {
        const { name, value } = e.target;
        setProfile((prev) => ({ ...prev, [name]: value }));
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            const response = await fetch(
                "http://127.0.0.1:8000/api/v1/user-profile-update",
                {
                    method: "POST",
                    headers: {
                        Authorization: `Bearer ${auth?.token}`,
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify(profile),
                },
            );

            if (response.data.status === "success") {
                alert("Profile updated successfully!");
            } else {
                alert("Failed to update profile.");
            }
        } catch (err) {
            alert("Error updating profile.");
        }
    };

    if (loading) return <p>Loading...</p>;
    if (error) return <p>{error}</p>;

    return (
        <div className="p-8 bg-custom-dark-purple text-white">
            <h1 className="text-2xl font-bold mb-4">Edit Profile</h1>
            <form onSubmit={handleSubmit} className="space-y-4">
                <div>
                    <label className="block mb-1">Name:</label>
                    <input
                        type="text"
                        name="name"
                        value={profile.name}
                        onChange={handleChange}
                        className="w-full p-2 rounded bg-custom-light-purple"
                    />
                </div>
                <div>
                    <label className="block mb-1">Email:</label>
                    <input
                        type="email"
                        name="email"
                        value={profile.email}
                        onChange={handleChange}
                        className="w-full p-2 rounded bg-custom-light-purple"
                    />
                </div>
                <div>
                    <label className="block mb-1">Phone:</label>
                    <input
                        type="text"
                        name="phone"
                        value={profile.phone}
                        onChange={handleChange}
                        className="w-full p-2 rounded bg-custom-light-purple"
                    />
                </div>
                <div>
                    <label className="block mb-1">Address:</label>
                    <input
                        type="text"
                        name="address"
                        value={profile.address}
                        onChange={handleChange}
                        className="w-full p-2 rounded bg-custom-light-purple"
                    />
                </div>
                <button
                    type="submit"
                    className="bg-purple-600 p-2 rounded text-white hover:bg-purple-700"
                >
                    Update Profile
                </button>
            </form>
        </div>
    );
}
