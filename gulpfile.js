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
    imagemin   = require('gulp-imagemin'),
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

    return gulp.src('app/assets/less/public/master.less')
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

    return gulp.src('app/assets/less/admin/master.less')
        .pipe(less())
        .on('error', swallowError)
        .pipe(prefix('last 2 versions', '> 1%', 'Explorer 7', 'Android 2'))
        .pipe(minifyCSS())
        .pipe(rename(destFile))
        .pipe(gulp.dest(destDir))
        .pipe(livereload())
        .pipe(notify('Admin CSS minified'));

});

gulp.task('img', function () {

    var destDir = 'public/img';

    return gulp.src('app/assets/img/*')
        .pipe(newer(destDir))
        .pipe(imagemin({
            progressive: true,
            svgoPlugins: [{removeViewBox: false}]
        }))
        .pipe(gulp.dest(destDir));

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

// Publish pickadate locales
gulp.task('pickadate-locales', function () {

    var destDir = 'public/js/pickadate-locales';

    return gulp.src([
            'bower_components/pickadate/lib/translations/fr_FR.js',
            'bower_components/pickadate/lib/translations/nl_NL.js',
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

gulp.task('js-admin', function () {

    var destDir = 'public/js/admin/',
        destFile = 'components.min.js',
        files = bowerFiles({checkExistence: true});
    
    files.push(path.resolve() + '/app/assets/js/admin/*');
    files.push(path.resolve() + '/app/assets/typicms/**/*.js');

    return gulp.src(files)
        .pipe(filter([
            '**/*.js',
            '!tinymce*'
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
        files = bowerFiles({checkExistence: true});

    files.push(path.resolve() + '/app/assets/js/public/*');

    return gulp.src(files)
        .pipe(filter([
            '**/*.js',
            '!tinymce*',
            '!jquery-ui*',
            '!jquery.ui*',
            '!picker*',
            '!sifter*',
            '!microplugin*',
            '!selectize*',
            '!alertify*',
            '!fastclick*',
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
            'app/assets/typicms/**/*.js'
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
    gulp.watch('app/assets/less/public/**/*.less', ['less-public']);
    gulp.watch('app/assets/less/admin/**/*.less', ['less-admin']);
    gulp.watch('app/assets/less/*.less', ['less-public', 'less-admin']);
    gulp.watch('app/assets/js/public/**/*.js', ['js-public']);
    gulp.watch('app/assets/js/admin/**/*.js', ['js-admin']);
    gulp.watch('app/assets/typicms/**/*.js', ['js-admin']);
});

// What tasks does running gulp trigger?
gulp.task('default', [
    'less-public',
    'less-admin',
    'js-public',
    'js-admin',
    'img',
    'fonts',
    'pickadate-locales',
    'angular-locales',
    'fancybox-img',
    'watch'
]);
