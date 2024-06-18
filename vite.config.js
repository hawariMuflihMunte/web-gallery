import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';
import path from 'path';

export default defineConfig({
    plugins: [
        react(),
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/bootstrap-icons.css',
                'resources/js/app.jsx',
                'resources/js/filepond.js',
                'resources/js/flowbite.js',
                'resources/js/alpine.js',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '~bootstrap-icons': path.resolve(__dirname, 'node_modules/bootstrap-icons'),
            '~flowbite': path.resolve(__dirname, 'node_modules/flowbite'),
        }
    }
});
