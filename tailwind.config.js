const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        // Screens
        screens: {
            sm: "640px",
            md: "768px",
            lg: "1230px",
        },
        // Container
        container: {
            center: true,
        },
        transitionDuration: {
            300: '300ms',
            500: '500ms',
            1500: '1500ms',
        },
        borderWidth: {
            0: "0px",
            2: "2px",
            6: "6px",
            8: "8px",
            default: "1px",
        },
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            // Colors
            colors: {
                base: {
                    'white': '#ffffff', // Снежно-белый
                    'gray': '#979dac', // Шиферный серый
                    'gray-dark': '#838895',
                },
            },
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('tailwind-scrollbar')({ nocompatible: true }),
    ],
};
