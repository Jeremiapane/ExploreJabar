import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            fontSize: {
                h1: [
                    "48px",
                    {
                        lineHeight: "67.2px",
                        letterSpacing: "1.5px",
                        fontWeight: "600",
                    },
                ],
                h2: [
                    "36px",
                    {
                        lineHeight: "54px",
                        letterSpacing: "1px",
                        fontWeight: "600",
                    },
                ],
                h3: [
                    "24px",
                    {
                        lineHeight: "36px",
                        letterSpacing: "0.5px",
                        fontWeight: "600",
                    },
                ],
                "body-600": [
                    "16px",
                    {
                        lineHeight: "24px",
                        letterSpacing: "0%",
                        fontWeight: "600",
                    },
                ],
                "body-500": [
                    "16px",
                    {
                        lineHeight: "24px",
                        letterSpacing: "0%",
                        fontWeight: "500",
                    },
                ],
                "body-400": [
                    "16px",
                    {
                        lineHeight: "24px",
                        letterSpacing: "0%",
                        fontWeight: "400",
                    },
                ],
                "span-600": [
                    "14px",
                    {
                        lineHeight: "24px",
                        letterSpacing: "0%",
                        fontWeight: "600",
                    },
                ],
                "span-500": [
                    "14px",
                    {
                        lineHeight: "24px",
                        letterSpacing: "0%",
                        fontWeight: "500",
                    },
                ],
                "span-400": [
                    "14px",
                    {
                        lineHeight: "24px",
                        letterSpacing: "0%",
                        fontWeight: "400",
                    },
                ],
            },
            colors: {
                background: "#F5F5F5",
                notice: "#FFD700",
                negative: {
                    DEFAULT: "#FF3B30",
                    100: "#FFA19B",
                },
                positive: {
                    DEFAULT: "#4CD964",
                    100: "#A9EDB5",
                },
                neutral: {
                    black: "#010217",
                    white: "#FCFCFC",
                    gray: {
                        800: "#666666",
                        600: "#999999",
                        400: "#BEBEBE",
                        200: "#D8D8D8",
                        100: "#EAEAEA",
                    },
                },
                primary: {
                    500: "#050EC8",
                    600: "#02065A",
                    400: "#CCCEF4",
                },
                secondary: {
                    800: "#021E30",
                    600: "#032741",
                    500: "#04395E",
                    400: "#065C8C",
                    100: "#E3F9FF",
                },
            },
        },
    },

    plugins: [
        forms,
        require("flowbite/plugin", "@tailwindcss/typography")({
            charts: true,
        }),
    ],
};
