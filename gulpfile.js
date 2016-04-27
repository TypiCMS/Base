var elixir = require('laravel-elixir'),
    gulp = require('gulp');

elixir.config.js.browserify.transformers.push(
    { name: 'require-globify'},
    { name: 'stringify' }
);

// Admin CSS
elixir(function(mix) {
    mix.less('resources/assets/less/admin/admin.less');
});

// Public CSS
elixir(function(mix) {
    mix.less('resources/assets/less/public/public.less');
});

// Publish Font Awesome fonts
elixir(function(mix) {
    mix.copy('node_modules/font-awesome/fonts', 'public/fonts');
});

// Publish Fancybox images
elixir(function(mix) {
    mix.copy('node_modules/fancybox/dist/img', 'public/components/fancybox/source');
});

// Publish CKEditor files
gulp.task('ckeditor', function () {

    // Base files
    gulp.src([
        'node_modules/ckeditor/ckeditor.js',
        'node_modules/ckeditor/styles.js',
        'node_modules/ckeditor/contents.css'
    ])
    .pipe(gulp.dest('public/components/ckeditor'));

    // Lang files
    gulp.src([
            'node_modules/ckeditor/lang/fr.js',
            'node_modules/ckeditor/lang/es.js',
            'node_modules/ckeditor/lang/pt.js',
            'node_modules/ckeditor/lang/de.js',
            'node_modules/ckeditor/lang/en.js',
            'node_modules/ckeditor/lang/nl.js'
        ])
        .pipe(gulp.dest('public/components/ckeditor/lang'));

    // Plugins
    var plugins = ['clipboard', 'image', 'image2', 'justify', 'lineutils', 'link', 'magicline', 'panelbutton', 'showblocks', 'specialchar', 'table', 'widget'];
    for (var i = 0; i < plugins.length; i++) {
        gulp.src(['node_modules/ckeditor/plugins/' + plugins[i] + '/**/*'])
            .pipe(gulp.dest('public/components/ckeditor/plugins/' + plugins[i]));
    }

});

elixir(function(mix) {
    mix.browserify('admin.js');
});

elixir(function(mix) {
    mix.browserify('public.js');
});

gulp.task('js-public', function () {

    var destDir = 'public/js/public',
        destFile = 'components.min.js',
        files = [
            'node_modules/jquery/dist/jquery.js',
            'node_modules/bootstrap/js/dropdown.js',
            'node_modules/bootstrap/js/collapse.js',
            'node_modules/bootstrap/js/alert.js',
            'node_modules/bootstrap/js/tab.js',
            'node_modules/bootstrap/js/transition.js',
            'node_modules/fancybox/dist/js/jquery.fancybox.js',
            'node_modules/swiper/dist/js/swiper.jquery.js',
            'resources/assets/js/public/*'
        ];

    return gulp.src(files)
        .pipe(concat('components.js'))
        .pipe(uglify())
        .on('error', swallowError)
        .pipe(rename(destFile))
        .pipe(gulp.dest(destDir));

});
