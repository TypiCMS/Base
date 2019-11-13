const mix = require('laravel-mix');

/**
 * Compile CSS
 */
mix.sass('resources/scss/admin.scss', 'public/css', { implementation: require('node-sass') });
mix.sass('resources/scss/public.scss', 'public/css', { implementation: require('node-sass') });

/**
 * Compile JS
 */
mix.js('resources/js/admin.js', 'public/js');
mix.js('resources/js/public.js', 'public/js');

/**
 * Copy font-awesome files
 */
mix.copy('node_modules/font-awesome/fonts', 'public/fonts');

/**
 * Copy CKEditor main files
 */
mix.copy('node_modules/ckeditor4/ckeditor.js', 'public/components/ckeditor/ckeditor.js');
mix.copy('node_modules/ckeditor4/contents.css', 'public/components/ckeditor/contents.css');

/**
 * Copy CKEditor lang files
 */
mix.copy('node_modules/ckeditor4/lang/fr.js', 'public/components/ckeditor/lang/fr.js');
mix.copy('node_modules/ckeditor4/lang/es.js', 'public/components/ckeditor/lang/es.js');
mix.copy('node_modules/ckeditor4/lang/nl.js', 'public/components/ckeditor/lang/nl.js');
mix.copy('node_modules/ckeditor4/lang/en.js', 'public/components/ckeditor/lang/en.js');

/**
 * Copy CKEditor plugins files
 */
var plugins = [
    'dialogadvtab',
    'div',
    'image',
    'image2',
    'justify',
    'link',
    'magicline',
    'panelbutton',
    'pastefromword',
    'scayt',
    'showblocks',
    'specialchar',
    'table',
    'tableselection',
    'widget',
    'wsc',
];
plugins.forEach(function(plugin) {
    mix.copy('node_modules/ckeditor4/plugins/' + plugin, 'public/components/ckeditor/plugins/' + plugin);
});

/**
 * Copy CKEditor skins files
 */
mix.copy('node_modules/ckeditor4/skins', 'public/components/ckeditor/skins');

/**
 * Versioning process
 */
mix.version();

/**
 * BrowserSync
 */
mix.browserSync('typicms.test');

/**
 * Options
 */
mix.options({
    processCssUrls: false,
    autoprefixer: {
        options: {
            overrideBrowserslist: ['last 10 versions'],
        },
    },
});

/**
 * Source maps
 */
// if (!mix.inProduction()) {
//     mix.webpackConfig({
//         devtool: 'source-map',
//     }).sourceMaps();
// }
