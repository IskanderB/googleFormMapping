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
        fontSize: {
            'xs': ['12px', {lineHeight: '14px'}],
            'sm': ['14px', {lineHeight: '20px'}],
            'base': ['16px', {lineHeight: '24px'}],
            'lg': ['18px', {lineHeight: '28px'}],
            '2lg': ['20px', {lineHeight: '24px'}],
            '3lg': ['24px', {lineHeight: '36px'}],
            'xl': ['32px', {lineHeight: '38px'}],
            '2xl': ['40px', {lineHeight: '48px'}],
            '2.5xl': ['44px', {lineHeight: '56px'}],
            '3xl': ['48px;', {lineHeight: '56px'}],
            '4xl': ['64px;', {lineHeight: '72px'}],
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
                    'gray-lite': '#d4def0',
                },
            },
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('tailwind-scrollbar')({ nocompatible: true }),
    ],
};
