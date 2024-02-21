import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    prefix: 't-',

    daisyui: {
        themes: [
            {
                light: {
                    "base-100": '#FFFFFF',
                    "base-200": '#EBEDF3',
                    "primary": '#F64360'
                }
            }
        ]
    },

    plugins: [forms, require("daisyui")],
};
