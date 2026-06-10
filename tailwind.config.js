import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './app/Livewire/**/*.php', // ← AÑADE ESTA LÍNEA para Livewire
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Añade tus colores personalizados
                'gamenova-primary': '#0a0e27',
                'gamenova-purple': '#7c3aed',
                'gamenova-pink': '#ec4899',
                'gamenova-yellow': '#f59e0b',
                'gamenova-green': '#10b981',
                'gamenova-gray': '#94a3b8',
                'gamenova-card': '#0f172a',
                'gamenova-red': '#ef4444',
            },
        },
    },

    plugins: [forms],
};
