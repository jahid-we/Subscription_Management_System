export default function CurrentDate() {
    const today = new Date();
    const formattedDate = today.toLocaleDateString("en-US", {
        day: "numeric",
        month: "short",
        year: "numeric",
    });

    return (
        <div className="bg-custom-light-purple rounded-lg px-6 py-2">
            {formattedDate.toUpperCase()}
        </div>
    );
}
