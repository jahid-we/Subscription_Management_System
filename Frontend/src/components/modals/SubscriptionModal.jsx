import { useState } from "react";

export function SubscriptionModal({ isOpen, onClose }) {
    const [formData, setFormData] = useState({
        name: "",
        subscriptionName: "",
        type: "",
        fee: "",
        paymentDate: "",
    });

    const handleInputChange = (e) => {
        const { name, value } = e.target;
        setFormData((prev) => ({ ...prev, [name]: value }));
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        if (Object.values(formData).every((field) => field.trim() !== "")) {
            console.log("Subscription added:", formData);
            onClose();
            setFormData({
                name: "",
                subscriptionName: "",
                type: "",
                fee: "",
                paymentDate: "",
            });
        } else {
            alert("Please fill in all fields");
        }
    };

    if (!isOpen) return null;

    return (
        <div className="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
            <div className="w-full max-w-md bg-[#231f31] rounded-lg p-8">
                <h2 className="text-2xl font-bold text-white mb-6 text-center">
                    Add New Subscription
                </h2>
                <form onSubmit={handleSubmit} className="space-y-4">
                    <div className="space-y-2">
                        <label
                            htmlFor="name"
                            className="block text-sm font-medium text-white"
                        >
                            Name
                        </label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value={formData.name}
                            onChange={handleInputChange}
                            className="w-full px-3 py-2 bg-[#1a1625] border border-[#2f2b3a] rounded-md text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#f6b03e] focus:border-[#f6b03e]"
                            placeholder="Enter name"
                        />
                    </div>
                    <div className="space-y-2">
                        <label
                            htmlFor="subscriptionName"
                            className="block text-sm font-medium text-white"
                        >
                            Subscription
                        </label>
                        <input
                            type="text"
                            id="subscriptionName"
                            name="subscriptionName"
                            value={formData.subscriptionName}
                            onChange={handleInputChange}
                            className="w-full px-3 py-2 bg-[#1a1625] border border-[#2f2b3a] rounded-md text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#f6b03e] focus:border-[#f6b03e]"
                            placeholder="Enter subscription name"
                        />
                    </div>
                    <div className="space-y-2">
                        <label
                            htmlFor="type"
                            className="block text-sm font-medium text-white"
                        >
                            Type
                        </label>
                        <input
                            type="text"
                            id="type"
                            name="type"
                            value={formData.type}
                            onChange={handleInputChange}
                            className="w-full px-3 py-2 bg-[#1a1625] border border-[#2f2b3a] rounded-md text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#f6b03e] focus:border-[#f6b03e]"
                            placeholder="Enter type"
                        />
                    </div>
                    <div className="space-y-2">
                        <label
                            htmlFor="fee"
                            className="block text-sm font-medium text-white"
                        >
                            Fee
                        </label>
                        <input
                            type="number"
                            id="fee"
                            name="fee"
                            value={formData.fee}
                            onChange={handleInputChange}
                            className="w-full px-3 py-2 bg-[#1a1625] border border-[#2f2b3a] rounded-md text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#f6b03e] focus:border-[#f6b03e]"
                            placeholder="Enter fee"
                        />
                    </div>
                    <div className="space-y-2">
                        <label
                            htmlFor="paymentDate"
                            className="block text-sm font-medium text-white"
                        >
                            Payment Date
                        </label>
                        <input
                            type="date"
                            id="paymentDate"
                            name="paymentDate"
                            value={formData.paymentDate}
                            onChange={handleInputChange}
                            className="w-full px-3 py-2 bg-[#1a1625] border border-[#2f2b3a] rounded-md text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#f6b03e] focus:border-[#f6b03e]"
                        />
                    </div>
                    <div className="flex justify-end">
                        <button
                            type="submit"
                            className="px-4 py-2 bg-[#f6b03e] hover:bg-[#f6b03e]/90 text-black font-medium rounded-md transition-colors duration-200"
                        >
                            Submit
                        </button>
                        <button
                            type="button"
                            onClick={onClose}
                            className="ml-2 px-4 py-2 bg-[#2f2b3a] hover:bg-[#2f2b3a]/90 text-white font-medium rounded-md transition-colors duration-200"
                        >
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    );
}
