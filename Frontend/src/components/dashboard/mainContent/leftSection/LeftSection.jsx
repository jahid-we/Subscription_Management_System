import SubscriptionList from "./SubscriptionList.jsx";
import GraphSection from "./GraphSection.jsx";

export default function LeftSection() {
    return (
        <>
            <div className="col-span-2 space-y-8">
                {/*Subscriptions List */}
                <SubscriptionList />

                {/*GraphSection Section */}
                <GraphSection />
            </div>
        </>
    );
}
