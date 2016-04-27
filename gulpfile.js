'use strict';

var elixir = require('laravel-elixir'),
    gulp = require('gulp');

elixir.config.js.browserify.transformers.push({
    name: 'require-globify'
}, {
    name: 'stringify'
});

elixir(function (mix) {
    mix.less('resources/assets/less/admin/admin.less')
        .less('resources/assets/less/public/public.less');
});

elixir(function (mix) {
    mix.copy('node_modules/font-awesome/fonts', 'public/fonts')
        .copy('node_modules/fancybox/dist/img', 'public/components/fancybox/source');
});

elixir(function (mix) {
    mix.browserify('admin.js')
        .browserify('public.js');
});

// Publish CKEditor files
gulp.task('ckeditor', function () {

    // Base files
    gulp.src([
        'node_modules/ckeditor/ckeditor.js',
        'node_modules/ckeditor/styles.js',
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
    var plugins = ['clipboard', 'image', 'image2', 'justify', 'lineutils', 'link', 'magicline', 'panelbutton', 'showblocks', 'specialchar', 'table', 'widget'];
    plugins.forEach(function (plugin) {
        gulp.src(['node_modules/ckeditor/plugins/' + plugin + '/**/*'])
            .pipe(gulp.dest('public/components/ckeditor/plugins/' + plugin));
    });

});
