'use strict';

var elixir = require('laravel-elixir'),
    gulp = require('gulp');

/**
 * Compile CSS
 */
elixir(function (mix) {
    mix.sass('admin.sass')
       .sass('public.sass');
});


/**
 * Copy files
 */
elixir(function (mix) {
    mix.copy('node_modules/font-awesome/fonts', 'public/fonts');
});


/**
 * Compile JS
 */
elixir(function (mix) {
    mix.webpack('admin.js')
       .webpack('public.js');
});


/**
 * Copy CKEditor files
 */
gulp.task('ckeditor', function () {

    // Base files
    gulp.src([
        'node_modules/ckeditor/ckeditor.js',
        'node_modules/ckeditor/contents.css'
    ]).pipe(gulp.dest('public/components/ckeditor'));

    // Lang files
    gulp.src([
        'node_modules/ckeditor/lang/fr.js',
        'node_modules/ckeditor/lang/es.js',
        'node_modules/ckeditor/lang/pt.js',
        'node_modules/ckeditor/lang/de.js',
        'node_modules/ckeditor/lang/en.js',
        'node_modules/ckeditor/lang/nl.js'
    ]).pipe(gulp.dest('public/components/ckeditor/lang'));

    // Plugins
    var plugins = ['clipboard', 'image', 'image2', 'justify', 'lineutils', 'link', 'magicline', 'panelbutton', 'showblocks', 'specialchar', 'table', 'widget', 'div', 'scayt', 'wsc', 'pastefromword', 'widgetselection'];
    plugins.forEach(function (plugin) {
        gulp.src(['node_modules/ckeditor/plugins/' + plugin + '/**/*'])
            .pipe(gulp.dest('public/components/ckeditor/plugins/' + plugin));
    });

    // Skins
    gulp.src(['node_modules/ckeditor/skins/**/*'])
        .pipe(gulp.dest('public/components/ckeditor/skins'));

});
