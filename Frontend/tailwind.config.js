/** @type {import("tailwindcss").Config} */
export default {
    content: ["./index.html", "./src/**/*.{js,ts,jsx,tsx}"],
    theme: {
        extend: {
            colors: {
                "custom-purple": "#1A1523",
                "custom-dark-purple": "#251B2E",
                "custom-light-purple": "#8B5CF6",
            },
        },
    },
    plugins: [],
};
