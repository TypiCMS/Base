let mix = require('laravel-mix');

/**
 * Compile CSS
 */
mix.sass('resources/assets/scss/admin.scss', 'public/css');
mix.sass('resources/assets/scss/public.scss', 'public/css');

/**
 * Compile JS
 */
mix.js('resources/assets/js/admin.js', 'public/js');
mix.js('resources/assets/js/public.js', 'public/js');

/**
 * Copy font-awesome files
 */
mix.copy('node_modules/font-awesome/fonts', 'public/fonts');

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
    mix.copy('node_modules/ckeditor/plugins/' + plugin, 'public/components/ckeditor/plugins/' + plugin);
});

/**
 * Copy CKEditor skins files
 */
mix.copy('node_modules/ckeditor/skins', 'public/components/ckeditor/skins');

/**
 * Versioning process
 */
mix.version();

mix.browserSync('typicms.test');
