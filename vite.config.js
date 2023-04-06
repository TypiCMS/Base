import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue2';

export default defineConfig({
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm.js',
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/scss/public.scss',
                'resources/scss/admin.scss',
                'resources/js/public.js',
                'resources/js/admin.js',
            ],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    // base: null,
                    // includeAbsolute: false,
                },
            },
        }),
    ],
});
