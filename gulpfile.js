var gulp       = require('gulp'),
    gutil      = require('gulp-util'),
    less       = require('gulp-less'),
    concat     = require('gulp-concat'),
    minifyCSS  = require('gulp-minify-css'),
    uglify     = require('gulp-uglify'),
    watch      = require('gulp-watch'),
    livereload = require('gulp-livereload'),
    rename     = require('gulp-rename'),
    prefix     = require('gulp-autoprefixer'),
    ngAnnotate = require('gulp-ng-annotate'),
    del        = require('del'),
    rev        = require('gulp-rev'),
    vinylPaths = require('vinyl-paths');

function swallowError (error) {
    console.log(error.toString());
    this.emit('end');
}

// Compile Less and save to css directory
gulp.task('less-public', function () {

    return gulp.src('resources/assets/less/public/master.less')
        .pipe(less())
        .on('error', swallowError)
        .pipe(prefix({
            browsers: ['> 1%', 'IE > 8'],
            cascade: false
        }))
        .pipe(minifyCSS())
        .pipe(rename('public.css'))
        .pipe(gulp.dest('public/css'))
        .pipe(livereload());

});

gulp.task('less-admin', function () {

    return gulp.src('resources/assets/less/admin/master.less')
        .pipe(less())
        .on('error', swallowError)
        .pipe(prefix({
            browsers: ['> 1%', 'IE > 8'],
            cascade: false
        }))
        .pipe(minifyCSS())
        .pipe(rename('admin.css'))
        .pipe(gulp.dest('public/css'))
        .pipe(livereload());

});

// version
gulp.task('version', function() {

    var publicDir = 'public',
        buildDir = publicDir + '/build',
        files = vinylPaths();

    del.sync(buildDir + '/*', { force: true });

    return gulp.src([
            publicDir + '/css/*',
            publicDir + '/js/admin/*',
            publicDir + '/js/public/*'
        ], { base: './' + publicDir })
        .pipe(gulp.dest(buildDir))
        .pipe(files)
        .pipe(rev())
        .pipe(gulp.dest(buildDir))
        .pipe(rev.manifest())
        .pipe(gulp.dest(buildDir))
        .on('end', function() {
            del(files.paths);
        });
});

// Publish fonts
gulp.task('fonts', function () {

    var destDir = 'public/fonts';

    return gulp.src([
            'node_modules/font-awesome/fonts/*'
        ])
        .pipe(gulp.dest(destDir));

});

// Publish angular locales
gulp.task('angular-locales', function () {

    var destDir = 'public/js/angular-locales';

    return gulp.src([
            'node_modules/angular-i18n/angular-locale_fr-fr.js',
            'node_modules/angular-i18n/angular-locale_nl-nl.js'
        ])
        .pipe(gulp.dest(destDir));

});

// Publish Fancybox images
gulp.task('fancybox-img', function () {

    var destDir = 'public/components/fancybox/source';

    return gulp.src('node_modules/fancybox/dist/img/*')
        .pipe(gulp.dest(destDir));

});

// Publish CKEditor
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
    var plugins = [
        'clipboard',
        'image',
        'image2',
        'justify',
        'lineutils',
        'link',
        'magicline',
        'panelbutton',
        'pastefromword',
        'showblocks',
        'specialchar',
        'table',
        'widget'
    ];
    for (var i = 0; i < plugins.length; i++) {
        gulp.src(['node_modules/ckeditor/plugins/' + plugins[i] + '/**/*'])
            .pipe(gulp.dest('public/components/ckeditor/plugins/' + plugins[i]));
    }

});

gulp.task('js-admin', function () {

    var destDir = 'public/js/admin',
        destFile = 'components.min.js',
        files = [
            'node_modules/jquery/dist/jquery.js',
            'node_modules/angular/angular.js',
            'node_modules/angular-resource/angular-resource.js',
            'node_modules/angular-smart-table/dist/smart-table.js',
            'node_modules/angular-ui-tree/dist/angular-ui-tree.js',
            // 'node_modules/vue/vue.js',
            // 'node_modules/vue-tables/lib/dist/v-client-table.js',
            'node_modules/bootstrap/js/dropdown.js',
            'node_modules/bootstrap/js/collapse.js',
            'node_modules/bootstrap/js/alert.js',
            'node_modules/bootstrap/js/tab.js',
            'node_modules/bootstrap/js/transition.js',
            'node_modules/alertify.js/dist/js/alertify.js',
            'node_modules/dropzone/dist/dropzone.js',
            'node_modules/selectize/dist/js/standalone/selectize.js',
            'node_modules/fancybox/dist/js/jquery.fancybox.js',
            'resources/assets/js/admin/*',
            'resources/assets/typicms/**/*.js'
        ];

    return gulp.src(files)
        .pipe(concat('components.js'))
        .pipe(ngAnnotate())
        .pipe(uglify())
        .on('error', swallowError)
        .pipe(rename(destFile))
        .pipe(gulp.dest(destDir));

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

// Keep an eye on Less and JS files for changes…
gulp.task('watch', function () {
    livereload.listen();
    gulp.watch('resources/assets/less/public/**/*.less', ['less-public']);
    gulp.watch('resources/assets/less/admin/**/*.less', ['less-admin']);
    gulp.watch('resources/assets/less/*.less', ['less-public', 'less-admin']);
    gulp.watch('resources/assets/js/public/**/*.js', ['js-public']);
    gulp.watch('resources/assets/js/admin/**/*.js', ['js-admin']);
    gulp.watch('resources/assets/typicms/**/*.js', ['js-admin']);
    gulp.watch(['public/css/*.css', 'public/js/admin/*.js', 'public/js/public/*.js'], ['version']);
});

// What tasks does running gulp trigger?
gulp.task('all', [
    'less-public',
    'less-admin',
    'js-public',
    'js-admin',
    'fonts',
    'angular-locales',
    'fancybox-img',
    'ckeditor',
    'watch'
]);

gulp.task('default', [
    'less-public',
    'js-public',
    'watch'
]);
