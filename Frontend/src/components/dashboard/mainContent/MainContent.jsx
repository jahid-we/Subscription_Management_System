import SearchBar from "./SearchBar.jsx";
import Header from "./Header.jsx";
import LeftSection from "./leftSection/LeftSection.jsx";
import RightSection from "./rightSection/RightSection.jsx";

export default function MainContent() {
    return (
        <>
            <main className="flex-1 p-8">
                {/*Search Bar*/}
                <SearchBar />

                {/*Header Section */}
                <Header />

                <div className="grid grid-cols-3 gap-8">
                    {/*Left Section*/}
                    <LeftSection />

                    {/*Right Section*/}
                    <RightSection />
                </div>
            </main>
        </>
    );
}
