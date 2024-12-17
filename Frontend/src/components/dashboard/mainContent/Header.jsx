import { useState } from "react";
import { SubscriptionModal } from "../../modals/SubscriptionModal.jsx";

export default function Header() {
    const [isModalOpen, setIsModalOpen] = useState(false);

    return (
        <>
            <div className="flex justify-between items-center mb-8">
                <div>
                    <h1 className="text-2xl font-semibold mb-2">
                        Get started with SubsManage
                    </h1>
                    <p className="text-gray-400">
                        View, progress and manage subscription efficiently
                    </p>
                </div>
                <button
                    className="bg-yellow-500 hover:bg-yellow-600 text-black px-6 py-2 rounded-lg font-medium"
                    onClick={() => setIsModalOpen(true)}
                >
                    +Add Subscription
                </button>
            </div>
            <SubscriptionModal
                isOpen={isModalOpen}
                onClose={() => setIsModalOpen(false)}
            />
        </>
    );
}
