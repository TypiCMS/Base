const mix = require('laravel-mix');
// var LiveReloadPlugin = require('webpack-livereload-plugin');

/**
 * Compile CSS
 */
mix.sass('resources/scss/admin.scss', 'public/css');
mix.sass('resources/scss/public.scss', 'public/css');

/**
 * Compile JS
 */
mix.js('resources/js/admin.js', 'public/js').vue();
mix.js('resources/js/public.js', 'public/js');

/**
 * Copy CKEditor main files
 */
mix.copy('node_modules/ckeditor4/ckeditor.js', 'public/components/ckeditor4/ckeditor.js');
mix.copy('node_modules/ckeditor4/contents.css', 'public/components/ckeditor4/contents.css');

/**
 * Copy CKEditor lang files
 */
mix.copy('node_modules/ckeditor4/lang/fr.js', 'public/components/ckeditor4/lang/fr.js');
mix.copy('node_modules/ckeditor4/lang/es.js', 'public/components/ckeditor4/lang/es.js');
mix.copy('node_modules/ckeditor4/lang/nl.js', 'public/components/ckeditor4/lang/nl.js');
mix.copy('node_modules/ckeditor4/lang/en.js', 'public/components/ckeditor4/lang/en.js');

/**
 * Copy CKEditor plugins files
 */
var plugins = [
    'dialog',
    'dialogadvtab',
    'div',
    'embed',
    'embedbase',
    'image',
    'image2',
    'justify',
    'link',
    'magicline',
    'panelbutton',
    'pastefromgdocs',
    'pastefromword',
    'pastetools',
    'scayt',
    'showblocks',
    'specialchar',
    'table',
    'tableselection',
    'tabletools',
    'widget',
    'wsc',
];
plugins.forEach(function (plugin) {
    mix.copy('node_modules/ckeditor4/plugins/' + plugin, 'public/components/ckeditor4/plugins/' + plugin);
});

/**
 * Copy CKEditor skins files
 */
mix.copy('node_modules/ckeditor4/skins', 'public/components/ckeditor4/skins');

/**
 * Versioning process
 */
mix.version();

/**
 * BrowserSync
 */
mix.browserSync({
    proxy: 'typicms.test',
    open: false,
    notify: false,
    ui: false,
    online: false,
    browser: 'google chrome',
});

/**
 * Options
 */
mix.options({
    processCssUrls: false,
});

/**
 * Livereload
 */
// mix.webpackConfig({
//     plugins: [new LiveReloadPlugin()],
// });

/**
 * Source maps
 */
// if (!mix.inProduction()) {
//     mix.webpackConfig({
//         devtool: 'source-map',
//     }).sourceMaps();
// }
