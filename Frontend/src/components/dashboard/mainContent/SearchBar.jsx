import CurrentDate from "./rightSection/CurrentDate.jsx";

export default function SearchBar() {
    return (
        <>
            <div className="grid grid-cols-3 items-center gap-4 mb-12">
                {/* Search Input */}
                <div className="relative col-span-2">
                    <input
                        type="text"
                        placeholder="Search for subscriptions, payouts, and reminders"
                        className="w-full bg-custom-dark-purple rounded-lg py-3 px-4 pr-12 text-sm focus:outline-none focus:ring-2 focus:ring-custom-light-purple"
                    />
                    <button className="absolute right-3 top-1/2 -translate-y-1/2">
                        <svg
                            className="w-5 h-5 text-gray-400"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            strokeWidth="2"
                        >
                            <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </div>

                {/* Current Date */}
                <div className="flex justify-end">
                    <div className="w-1/3">
                        <CurrentDate />
                    </div>
                </div>
            </div>
        </>
    );
}
