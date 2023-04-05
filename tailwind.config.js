const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        './node_modules/@protonemedia/inertiajs-tables-laravel-query-builder/**/*.{js,vue}',
    ],

    theme: {
        screens: {
            xsm: '468px',
            sm: '640px',
            md: '768px',
            lg: '1024px',
            xl: '1280px',
            '2xl': '1536px',
        },
        extend: {
            fontFamily: {
                sans: ['Sofia', ...defaultTheme.fontFamily.sans],
                'sofia_bold': ['Sofia Bold','Sofia', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'primary': {
                  50: '#F3EDE7',
                  100: '#E4E2DA',
                  200: '#D9D2CC',
                  300: '#A89E90',
                  400: '#000000',
                },
            },
            animation: {
                scale: 'scale 0.3s ease-in-out',
            },
            keyframes: {
                scale :{
                    '0%' : {transform: 'scale(1)'},
                    '50%' : {transform: 'scale(1.1)'},
                    '100%' : {transform: 'scale(1)'},
                }
            },
        },
    },
    

    plugins: [require('@tailwindcss/forms')],
};
