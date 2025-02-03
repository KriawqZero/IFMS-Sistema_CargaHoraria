import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite'

export default defineConfig({
    plugins: [
        tailwindcss(),
        laravel({
            input: [
                'resources/js/main.js',
                'resources/css/app.css',
                'resources/css/main.css',
                'resources/js/components/seletor-turma.js',
            ],
            refresh: true,
        }),
    ]
});
