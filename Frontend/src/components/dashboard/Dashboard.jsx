import Sidebar from "./Sidebar.jsx";
import MainContent from "./mainContent/MainContent.jsx";
import { useAuth } from "../../hooks/useAuth.js";

export default function Dashboard() {
    const { auth } = useAuth();
    console.log(`Token from dashboard: ${auth?.token}`);
    return (
        <>
            <div className="min-h-screen flex">
                <Sidebar />
                <MainContent />
            </div>
        </>
    );
}
