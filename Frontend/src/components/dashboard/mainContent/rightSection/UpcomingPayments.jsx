export default function UpcomingPayments() {
    return (
        <>
            <h2 className="font-medium mb-6">Upcoming payment this month</h2>
            <div className="space-y-4">
                <div className="bg-custom-dark-purple rounded-lg p-4 flex gap-4">
                    <div className="bg-gray-800 rounded w-12 h-12 flex items-center justify-center font-medium">
                        2
                    </div>
                    <div className="flex-1">
                        <div className="font-medium">
                            Subscription renewal alert
                        </div>
                        <div className="text-sm text-gray-400">
                            3 of 4 payments, Recharge
                        </div>
                    </div>
                    <div className="text-sm text-gray-400">10:00-11:30</div>
                </div>
                <div className="bg-custom-dark-purple rounded-lg p-4 flex gap-4">
                    <div className="bg-gray-800 rounded w-12 h-12 flex items-center justify-center font-medium">
                        8
                    </div>
                    <div className="flex-1">
                        <div className="font-medium">Payment Due</div>
                        <div className="text-sm text-gray-400">
                            3 of 4 payments, Electricity
                        </div>
                    </div>
                    <div className="text-sm text-gray-400">11:00-12:30</div>
                </div>
                <div className="bg-custom-dark-purple rounded-lg p-4 flex gap-4">
                    <div className="bg-gray-800 rounded w-12 h-12 flex items-center justify-center font-medium">
                        11
                    </div>
                    <div className="flex-1">
                        <div className="font-medium">Subscription upgrade</div>
                        <div className="text-sm text-gray-400">
                            1 of 2 upgrades, Phone
                        </div>
                    </div>
                    <div className="text-sm text-gray-400">10:00-11:30</div>
                </div>
                <div className="bg-custom-dark-purple rounded-lg p-4 flex gap-4">
                    <div className="bg-gray-800 rounded w-12 h-12 flex items-center justify-center font-medium">
                        23
                    </div>
                    <div className="flex-1">
                        <div className="font-medium">Bill payment alert</div>
                        <div className="text-sm text-gray-400">
                            2 of 4 payments, Tuition fees
                        </div>
                    </div>
                    <div className="text-sm text-gray-400">10:00-11:30</div>
                </div>
                <div className="bg-custom-dark-purple rounded-lg p-4 flex gap-4">
                    <div className="bg-gray-800 rounded w-12 h-12 flex items-center justify-center font-medium">
                        27
                    </div>
                    <div className="flex-1">
                        <div className="font-medium">Subscription Due</div>
                        <div className="text-sm text-gray-400">
                            1 of 4 payments, Water Bill
                        </div>
                    </div>
                    <div className="text-sm text-gray-400">10:00-11:30</div>
                </div>
            </div>
        </>
    );
}
