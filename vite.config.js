import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';

export default defineConfig({
    build: {
        chunkSizeWarningLimit: 2000,
    },
    css: {
        preprocessorOptions: {
            scss: {
                api: 'modern-compiler',
                silenceDeprecations: ['import', 'global-builtin', 'color-functions', 'if-function'],
            },
        },
        devSourcemap: true,
    },
    plugins: [
        laravel({
            input: ['resources/scss/public.scss', 'resources/scss/admin.scss', 'resources/js/public.js', 'resources/js/admin.js', 'resources/js/admin/theme-switcher.ts'],
            refresh: ['resources/views/**'],
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
