const defaultTheme = require("tailwindcss/defaultTheme");
const colors = require("tailwindcss/colors");
module.exports = {
    mode: "jit",
    purge: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],

    theme: {
        fontSize: {
            xxs: "0.625rem",
            xs: "0.875rem",
            xm: "0.75rem",
            base: "1rem",
            lg: "1.125rem",
            xl: "1.25rem",
            "2xl": "1.5rem",
            "3xl": "1.875rem",
            "4xl": "2rem",
            "5xl": "2.25rem",
            sm: "0.985rem",
        },
        extend: {
            fontFamily: {
                sans: ["Nunito", ...defaultTheme.fontFamily.sans],
                "sans-serif": ["Raleway", ...defaultTheme.fontFamily.serif],
            },
            colors: {
                cyan: colors.indigo,
                indigo: colors.indigo,
                purple: {
                    light: "#DE21FF",
                    darker: "#632A6D",
                    darken: "#4338CA",
                },
                green: {
                    light: "#ECFEEE",
                    darker: "#00960F",
                },
                red: {
                    light: "#C9000033",
                    darker: "#FF0000",
                },
                gray: {
                    grayer: "#f3f4f6",
                    lightest: "#F9FAFC",
                    lighter: "#5C5C66",
                    darker: "#333333",
                    darken: "#8A8A99",
                    background: "#E5E5E5",
                },
                purplish: {
                    light: "#F2F1FE"
                }
            },
            opacity: {
                10: "0.1",
                20: "0.2",
                95: "0.95",
            },
            width: {
                "1/10": "10%",
                "1.5/10": "15%",
                "2/10": "20%",
                "2.5/10": "25%",
                "3/10": "30%",
                "3.5/10": "35%",
                "4/10": "40%",
                "4.5/10": "45%",
                "5/10": "50%",
                "5.5/10": "55%",
                "6/10": "60%",
                "6.5/10": "65%",
                "7/10": "70%",
                "7.5/10": "75%",
                "8/10": "80%",
                "8.5/10": "85%",
                "9/10": "90%",
                "9.5/10": "95%",
                "10/10": "100%",
                "62/100": "62%",
                18: "4.5rem",
                84: "21rem",
                74: "18.5rem",
                78: "19.5rem",
                111: "444px",
                175: "690px",
            },
            margin: {
                100: "28rem",
                17: "4.2rem",
                4.5: "1.125rem",
                23: "92px",
                6.5: "1.625rem",
                18.5: "4.625rem",
            },
            height: {
                84: "21rem",
                30: "7.5rem",
                10.5: "2.625rem",
                content: "max-content",
            },
            padding: {
                4.5: "1.125rem",
                1.5: "0.375rem",
            },
            inset: {
                42: "10.625rem",
            },
            maxWidth: {
                xlg: "40rem",
            },
        },
    },

    variants: {
        extend: {
            opacity: ["disabled"],
        },
    },

    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
    ],
};
