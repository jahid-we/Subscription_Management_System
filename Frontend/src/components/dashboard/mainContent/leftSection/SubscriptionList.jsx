import { useEffect, useState } from "react";
import { useAuth } from "../../../../hooks/useAuth.js";

export default function SubscriptionList() {
    const [subscriptions, setSubscriptions] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    const { auth } = useAuth();
    console.log(`Auth token: ${auth.token}`);

    useEffect(() => {
        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(";").shift();
            return null;
        }
        const myCookie = getCookie("token");

        console.log(`My Cookie: ${getCookie("token")}`);
        console.log(`My Cookie 2: ${myCookie}`);
        const fetchSubscriptions = async () => {
            if (!auth?.token) {
                setError("No token found, please log in.");
                setLoading(false);
                return;
            }

            try {
                const response = await fetch(
                    "http://127.0.0.1:8000/api/v1/subscription-list",
                    {
                        method: "GET",
                        headers: {
                            "Content-Type": "application/json",
                            // Authorization: `Bearer ${auth.token}`,
                        },
                        credentials: "include", // Include cookies
                    },
                );

                if (!response.ok) {
                    const errorData = await response.json();
                    console.error("Server Response:", errorData);
                    throw new Error(
                        errorData.error || "Failed to fetch subscriptions",
                    );
                }

                const data = await response.json();
                console.log(`Data is: ${data}`);
                setSubscriptions(data?.subscriptions || []);
            } catch (err) {
                setError(err.message || "Error fetching subscriptions");
            } finally {
                setLoading(false);
            }
        };

        fetchSubscriptions();
    }, [auth?.token]);

    if (loading) {
        return <div>Loading subscriptions...</div>;
    }

    if (error) {
        return <div className="text-red-500">{error}</div>;
    }

    return (
        <div className="bg-custom-dark-purple rounded-lg p-6">
            <h2 className="font-medium mb-6">
                My subscriptions{" "}
                <span className="text-sm text-gray-400">
                    ({subscriptions.length} active)
                </span>
            </h2>
            <div className="space-y-4 mb-6">
                {subscriptions.map((subscription, index) => (
                    <div
                        key={index}
                        className="flex items-center justify-between"
                    >
                        <div className="flex items-center gap-4">
                            <img
                                src={subscription.image || "/placeholder.svg"}
                                className="w-10 h-10 rounded-full bg-gray-600"
                                alt="Subscription"
                            />
                            <span>{subscription.name}</span>
                        </div>
                        <div className="text-gray-400">
                            {subscription.type || "Subscription Type"}
                        </div>
                        <div className="text-yellow-500">
                            {subscription.status || "Status"}
                        </div>
                    </div>
                ))}
            </div>
            <button className="w-full bg-custom-light-purple hover:bg-purple-700 py-2 rounded-lg">
                View all subscriptions
            </button>
        </div>
    );
}
