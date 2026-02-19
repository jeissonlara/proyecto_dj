import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'neon-purple': '#c026d3',
                'neon-pink': '#ec4899',
                'neon-cyan': '#22d3ee',
                'neon-blue': '#3b82f6',
            },
            animation: {
                'blob': 'blob 12s infinite',
                'fade-cycle': 'fade-cycle 10s ease-in-out infinite',
                'fade-in': 'fadeIn 1.5s ease-in forwards',
                'wave': 'wave 3s ease-in-out infinite',
                'pulse-slow': 'pulse-slow 2s ease-in-out infinite',
                'fade-in-out': 'fade-in-out 4s ease-in-out infinite',
            },
            keyframes: {
                blob: {
                    '0%, 100%': { transform: 'translate(0,0) scale(1)' },
                    '33%': { transform: 'translate(30px,-50px) scale(1.1)' },
                    '66%': { transform: 'translate(-20px,20px) scale(0.9)' },
                },
                'fade-cycle': {
                    '0%,100%': { opacity: '0' },
                    '20%,80%': { opacity: '1' },
                },
                fadeIn: {
                    '0%': { opacity: '0', transform: 'translateY(20px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                wave: {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(-10px)' },
                },
                'pulse-slow': {
                    '0%, 100%': { transform: 'scale(1)', opacity: '1' },
                    '50%': { transform: 'scale(1.05)', opacity: '0.9' },
                },
                'fade-in-out': {
                    '0%, 100%': { opacity: '0.7' },
                    '50%': { opacity: '1' },
                },
            }
        },
    },

    plugins: [forms],
};
