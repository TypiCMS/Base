const { mix } = require('laravel-mix');

mix.options({ processCssUrls: false });

/**
 * Compile CSS
 */
mix.sass('resources/assets/sass/admin.sass', 'public/css');
mix.sass('resources/assets/sass/public.sass', 'public/css');

/**
 * Compile JS
 */
mix.js('resources/assets/js/admin.js', 'public/js');
mix.js('resources/assets/js/public.js', 'public/js');

/**
 * Copy font-awesome files
 */
mix.copyDirectory('node_modules/font-awesome/fonts', 'public/fonts');

/**
 * Copy CKEditor main files
 */
mix.copy('node_modules/ckeditor/ckeditor.js', 'public/components/ckeditor/ckeditor.js');
mix.copy('node_modules/ckeditor/contents.css', 'public/components/ckeditor/contents.css');

/**
 * Copy CKEditor lang files
 */
mix.copy('node_modules/ckeditor/lang/fr.js', 'public/components/ckeditor/lang/fr.js');
mix.copy('node_modules/ckeditor/lang/es.js', 'public/components/ckeditor/lang/es.js');
mix.copy('node_modules/ckeditor/lang/nl.js', 'public/components/ckeditor/lang/nl.js');
mix.copy('node_modules/ckeditor/lang/en.js', 'public/components/ckeditor/lang/en.js');

/**
 * Copy CKEditor plugins files
 */
var plugins = [
    'clipboard',
    'div',
    'image',
    'image2',
    'justify',
    'lineutils',
    'link',
    'magicline',
    'panelbutton',
    'pastefromword',
    'scayt',
    'showblocks',
    'specialchar',
    'table',
    'widget',
    'widgetselection',
    'wsc',
];
plugins.forEach(function (plugin) {
    mix.copyDirectory('node_modules/ckeditor/plugins/' + plugin, 'public/components/ckeditor/plugins/' + plugin);
});

/**
 * Copy CKEditor skins files
 */
mix.copyDirectory('node_modules/ckeditor/skins', 'public/components/ckeditor/skins');

/**
 * Versioning process
 */
if (mix.config.inProduction) {
    mix.version();
}

mix.browserSync('typicms.dev');
