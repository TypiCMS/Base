let mix = require('laravel-mix').mix;

/**
 * Compile CSS
 */
mix.sass('resources/assets/sass/admin.sass', 'public/css').version();
mix.sass('resources/assets/sass/public.sass', 'public/css').version();

/**
 * Compile JS
 */
mix.js('resources/assets/js/admin.js', 'public/js').version();
mix.js('resources/assets/js/public.js', 'public/js').version();

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
var plugins = ['clipboard', 'image', 'image2', 'justify', 'lineutils', 'link', 'magicline', 'panelbutton', 'showblocks', 'specialchar', 'table', 'widget', 'div', 'scayt', 'wsc', 'pastefromword', 'widgetselection'];
plugins.forEach(function (plugin) {
    mix.copy('node_modules/ckeditor/plugins/' + plugin, 'public/components/ckeditor/plugins/' + plugin);
});

/**
 * Copy CKEditor skins files
 */
mix.copy('node_modules/ckeditor/skins', 'public/components/ckeditor/skins');
