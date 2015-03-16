var gulp       = require('gulp'),
    gutil      = require('gulp-util'),
    notify     = require('gulp-notify'),
    less       = require('gulp-less'),
    concat     = require('gulp-concat'),
    path       = require('path'),
    minifyCSS  = require('gulp-minify-css'),
    uglify     = require('gulp-uglify'),
    watch      = require('gulp-watch'),
    bowerFiles = require('main-bower-files'),
    livereload = require('gulp-livereload'),
    rename     = require('gulp-rename'),
    filter     = require('gulp-filter'),
    newer      = require('gulp-newer'),
    prefix     = require('gulp-autoprefixer'),
    ngAnnotate = require('gulp-ng-annotate'),
    gettext    = require('gulp-angular-gettext');

function swallowError (error) {
    console.log(error.toString());
    this.emit('end');
}

// Compile Less and save to css directory
gulp.task('less-public', function () {

    var destDir = 'public/css/',
        destFile = 'public.css';

    return gulp.src('resources/assets/less/public/master.less')
        .pipe(less())
        .on('error', swallowError)
        .pipe(prefix('last 2 versions', '> 1%', 'Explorer 7', 'Android 2'))
        .pipe(minifyCSS())
        .pipe(rename(destFile))
        .pipe(gulp.dest(destDir))
        .pipe(livereload())
        .pipe(notify('Public CSS minified'));

});

gulp.task('less-admin', function () {

    var destDir = 'public/css/',
        destFile = 'admin.css';

    return gulp.src('resources/assets/less/admin/master.less')
        .pipe(less())
        .on('error', swallowError)
        .pipe(prefix('last 2 versions', '> 1%', 'Explorer 7', 'Android 2'))
        .pipe(minifyCSS())
        .pipe(rename(destFile))
        .pipe(gulp.dest(destDir))
        .pipe(livereload())
        .pipe(notify('Admin CSS minified'));

});

// Publish fonts
gulp.task('fonts', function () {

    var destDir = 'public/fonts';

    return gulp.src([
            'bower_components/font-awesome/fonts/*'
        ])
        .pipe(newer(destDir))
        .pipe(gulp.dest(destDir));

});

// Publish angular locales
gulp.task('angular-locales', function () {

    var destDir = 'public/js/angular-locales';

    return gulp.src([
            'bower_components/angular-i18n/angular-locale_fr-fr.js',
            'bower_components/angular-i18n/angular-locale_nl-nl.js'
        ])
        .pipe(newer(destDir))
        .pipe(gulp.dest(destDir));

});

// Publish Fancybox images
gulp.task('fancybox-img', function () {

    var destDir = 'public/components/fancybox/source';

    return gulp.src([
            'bower_components/fancybox/source/*.gif',
            'bower_components/fancybox/source/*.png'
        ])
        .pipe(newer(destDir))
        .pipe(gulp.dest(destDir));

});

// Publish CKEditor
gulp.task('ckeditor', function () {

    // Base files
    gulp.src([
        'bower_components/ckeditor/ckeditor.js',
        'bower_components/ckeditor/styles.js',
        'bower_components/ckeditor/contents.css'
    ])
    .pipe(gulp.dest('public/components/ckeditor'));

    // Lang files
    gulp.src([
            'bower_components/ckeditor/lang/fr.js',
            'bower_components/ckeditor/lang/es.js',
            'bower_components/ckeditor/lang/pt.js',
            'bower_components/ckeditor/lang/de.js',
            'bower_components/ckeditor/lang/en.js',
            'bower_components/ckeditor/lang/nl.js'
        ])
        .pipe(gulp.dest('public/components/ckeditor/lang'));

    // Plugins
    var plugins = [
        'anchor',
        'colors',
        'image',
        'image2',
        'justify',
        'lineutils',
        'link',
        'others',
        'panelbutton',
        'clipboard',
        'showblocks',
        'specialchar',
        'table',
        'widget'
    ];
    for (var i = 0; i < plugins.length; i++) {
        gulp.src(['bower_components/ckeditor/plugins/' + plugins[i] + '/**/*'])
            .pipe(gulp.dest('public/components/ckeditor/plugins/' + plugins[i]));
    }

});

gulp.task('js-admin', function () {

    var destDir = 'public/js/admin/',
        destFile = 'components.min.js',
        files = bowerFiles();
    
    files.push(path.resolve() + '/resources/assets/js/admin/*');
    files.push(path.resolve() + '/resources/assets/typicms/**/*.js');

    return gulp.src(files)
        .pipe(filter([
            '**/*.js'
        ]))
        .pipe(newer(destDir + destFile))
        .pipe(concat('components.js'))
        .pipe(ngAnnotate())
        .pipe(uglify())
        .pipe(rename(destFile))
        .pipe(gulp.dest(destDir))
        .pipe(notify('js-admin done'));

});

gulp.task('js-public', function () {

    var destDir = 'public/js/public/',
        destFile = 'components.min.js',
        files = bowerFiles();

    files.push(path.resolve() + '/resources/assets/js/public/*');

    return gulp.src(files)
        .pipe(filter([
            '**/*.js',
            '!jquery-ui*',
            '!jquery.ui*',
            '!picker*',
            '!sifter*',
            '!microplugin*',
            '!selectize*',
            '!alertify*',
            '!angular*',
            '!smart-table*',
            '!dropzone*'
        ]))
        .pipe(newer(destDir + destFile))
        .pipe(concat('components.js'))
        .pipe(uglify())
        .pipe(rename(destFile))
        .pipe(gulp.dest(destDir))
        .pipe(notify('js-public done'));

});

gulp.task('pot', function () {
    return gulp.src([
            'public/views/partials/**/*.html',
            'app/TypiCMS/Modules/**/Views/**/admin/*.php',
            'resources/assets/typicms/**/*.js'
        ])
        .pipe(gettext.extract('template.pot', {
            // options to pass to angular-gettext-tools...
        }))
        .pipe(gulp.dest('po/'));
});

gulp.task('translations', function () {
    return gulp.src('po/**/*.po')
        .pipe(gettext.compile({
            // options to pass to angular-gettext-tools...
            format: 'json'
        }))
        .pipe(gulp.dest('public/languages/'));
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
});

// What tasks does running gulp trigger?
gulp.task('default', [
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
