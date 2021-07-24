const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors')
module.exports = {
    mode: 'jit',
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        fontSize: {
            'base': '1rem',
            'lg': '1.125rem',
            'xl': '1.25rem',
            '2xl': '1.5rem',
            '3xl': '1.875rem'
        },
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
                "sans-serif": ["Raleway", ...defaultTheme.fontFamily.serif]
            },
            colors: {
                cyan: colors.indigo,
                indigo: colors.indigo,
                purple: {
                    light: "#DE21FF",
                    darker: "#632A6D"
                },
            },
            opacity: {
                "10": "0.1",
                "20": "0.2",
                "95": "0.95"
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
                "18": "4.5rem",
                "84": "21rem",
                "78": "19.5rem"
            },
            margin: {
                "100": "28rem",
                "17": "4.2rem",
                "4.5": "1.125rem"
            },
            height: {
                "84": "21rem",
                "30": "7.5rem"
            },
            padding:{
                "4.5":"1.125rem",
                "1.5":"0.375rem"
            },
            inset:{
                "42":"10.625rem"
            }
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
