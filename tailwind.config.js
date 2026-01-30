import defaultTheme from 'tailwindcss/defaultTheme'
import forms from '@tailwindcss/forms'

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    darkMode: 'class', // Aktifkan dark mode berbasis class .dark

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    DEFAULT: '#3B82F6',   // blue-500
                    dark: '#2563EB',      // blue-600
                },
                background: {
                    light: '#fcfbfbff',    // white 
                    dark: '#1F2937',      // gray-800
                },
                text: {
                    light: '#1F2937',     // gray-800
                    dark: '#F1F5F9',      // slate-100
                },
                table: {
                    dark: '#1E293B',      // slate-800
                    border: '#334155',    // slate-700
                },
                chart: {
                    gridLight: 'rgba(100, 100, 100, 0.15)',
                    gridDark: 'rgba(200, 200, 200, 0.4)',
                    textLight: '#333',
                    textDark: '#ccc',
                },
            },
            boxShadow: {
                'outline-light': '0 0 0 2px rgba(59, 130, 246, 0.5)',
                'outline-dark': '0 0 0 2px rgba(147, 197, 253, 0.4)',
            },
            borderColor: {
                light: '#D1D5DB',        // gray-300
                dark: '#374151',         // gray-700
            }
        },
    },

    plugins: [
        forms,
        // Aktifkan jika butuh plugin tambahan
        // require('@tailwindcss/typography'),
        // require('@tailwindcss/aspect-ratio'),
        // require('@tailwindcss/line-clamp'),
    ],
}
