/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ["./src/Resources/**/*.blade.php", "./src/Resources/**/*.js"],

    theme: {
        container: {
            center: true,

            screens: {
                "2xl": "1440px",
            },

            padding: {
                DEFAULT: "90px",
            },
        },

        screens: {
            sm: "525px",
            md: "768px",
            lg: "1024px",
            xl: "1240px",
            "2xl": "1440px",
            1180: "1180px",
            1060: "1060px",
            991: "991px",
            868: "868px",
        },

        extend: {
            colors: {
                navyBlue: "#060C3B",
                lightOrange: "#F6F2EB",
                darkGreen: '#40994A',
                darkBlue: '#0044F2',
                darkPink: '#F85156',
                // Salem Store Brand Colors
                gold: {
                    DEFAULT: '#C4A35A',
                    light: '#D4B86A',
                    dark: '#A68B4B',
                    muted: '#E8DCC4',
                },
                brandBlack: {
                    DEFAULT: '#000000',
                    light: '#1A1A1A',
                    muted: '#333333',
                },
            },

            fontFamily: {
                poppins: ["Poppins"],
                dmserif: ["DM Serif Display"],
            },
        }
    },

    plugins: [],

    safelist: [
        {
            pattern: /icon-/,
        },
        {
            pattern: /bg-gold/,
        },
        {
            pattern: /text-gold/,
        },
        {
            pattern: /border-gold/,
        },
        {
            pattern: /bg-brandBlack/,
        },
        {
            pattern: /text-brandBlack/,
        },
        {
            pattern: /border-brandBlack/,
        },
        {
            pattern: /hover:bg-gold/,
        },
        {
            pattern: /hover:text-gold/,
        },
        {
            pattern: /placeholder:text-gold/,
        },
        {
            pattern: /from-brandBlack/,
        },
        {
            pattern: /via-brandBlack/,
        },
        {
            pattern: /to-brandBlack/,
        },
    ]
};
