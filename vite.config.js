import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue2';
import { viteStaticCopy } from 'vite-plugin-static-copy';

export default defineConfig({
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm.js',
        },
    },
    plugins: [
        laravel({
            input: ['resources/scss/public.scss', 'resources/scss/admin.scss', 'resources/js/public.js', 'resources/js/admin.js'],
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
        viteStaticCopy({
            targets: [
                // Photoswipe files
                {
                    src: ['node_modules/photoswipe/dist/photoswipe-lightbox.esm.min.js', 'node_modules/photoswipe/dist/photoswipe.esm.min.js'],
                    dest: '../../public/components/photoswipe/',
                },
                // Main CKEditor files and skins
                {
                    src: ['node_modules/ckeditor4/ckeditor.js', 'node_modules/ckeditor4/contents.css', 'node_modules/ckeditor4/skins'],
                    dest: '../../public/components/ckeditor4/',
                },
                // CKEditor locales
                {
                    src: ['node_modules/ckeditor4/lang/fr.js', 'node_modules/ckeditor4/lang/nl.js', 'node_modules/ckeditor4/lang/en.js', 'node_modules/ckeditor4/lang/es.js'],
                    dest: '../../public/components/ckeditor4/lang/',
                },
                // CKEditor plugins
                {
                    src: [
                        'node_modules/ckeditor4/plugins/dialog',
                        'node_modules/ckeditor4/plugins/dialogadvtab',
                        'node_modules/ckeditor4/plugins/div',
                        'node_modules/ckeditor4/plugins/embed',
                        'node_modules/ckeditor4/plugins/embedbase',
                        'node_modules/ckeditor4/plugins/image',
                        'node_modules/ckeditor4/plugins/image2',
                        'node_modules/ckeditor4/plugins/justify',
                        'node_modules/ckeditor4/plugins/link',
                        'node_modules/ckeditor4/plugins/magicline',
                        'node_modules/ckeditor4/plugins/panelbutton',
                        'node_modules/ckeditor4/plugins/pastefromgdocs',
                        'node_modules/ckeditor4/plugins/pastefromword',
                        'node_modules/ckeditor4/plugins/pastetools',
                        'node_modules/ckeditor4/plugins/scayt',
                        'node_modules/ckeditor4/plugins/showblocks',
                        'node_modules/ckeditor4/plugins/specialchar',
                        'node_modules/ckeditor4/plugins/table',
                        'node_modules/ckeditor4/plugins/tableselection',
                        'node_modules/ckeditor4/plugins/tabletools',
                        'node_modules/ckeditor4/plugins/widget',
                    ],
                    dest: '../../public/components/ckeditor4/plugins/',
                },
            ],
        }),
    ],
});
