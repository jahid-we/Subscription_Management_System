import CurrentMonthsOverview from "./CurrentMonthsOverview.jsx";
import UpcomingPayments from "./UpcomingPayments.jsx";

export default function RightSection() {
    return (
        <>
            <div>
                {/*Current Month Overview*/}
                <CurrentMonthsOverview />

                {/*Upcoming Payments*/}
                <UpcomingPayments />
                <button className="w-full bg-custom-light-purple hover:bg-purple-700 py-2 rounded-lg mt-4">
                    View full list
                </button>
            </div>
        </>
    );
}
