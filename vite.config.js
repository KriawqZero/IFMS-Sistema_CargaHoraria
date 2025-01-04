import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/scss/app.scss',
                'resources/scss/dashboard.scss',
                'resources/scss/login.scss',
            ],
            refresh: true,
        }),
    ],
    build: {
        rollupOptions: {
            output: {
                assetFileNames: 'assets/[name].[hash].[ext]', // Pasta organizada para imagens e outros arquivos
            },
        },
    },
});
