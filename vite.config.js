import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/scss/public.scss', 'resources/js/public.js'],
            refresh: true,
        }),
    ],
});
