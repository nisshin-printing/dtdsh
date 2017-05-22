var gulp = require('gulp');
var plumber = require('gulp-plumber');
var sourcemaps = require('gulp-sourcemaps');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var notify = require('gulp-notify');
var browserSync = require('browser-sync');

// utils
var pumped = require('../../utils/pumped');

// config
var config = require('../../config/styles.js');

/**
 * Compile SCSS to CSS,
 * create Sourcemaps
 * and trigger
 * Browser-sync
 *
 *
 */
module.exports = function(cb) {
    return gulp.src(config.paths.src)
        .pipe(plumber())

    .pipe(sourcemaps.init())
        .pipe(sass.sync(config.options.sass).on('error', sass.logError))
        .pipe(autoprefixer(config.options.autoprefixer))
        .pipe(sourcemaps.write('./'))

    .pipe(gulp.dest(config.paths.dest))

    .pipe(browserSync.stream({ match: '**/*.css' }))

    .pipe(notify({
        message: pumped('SCSS Compiled.'),
        onLast: true
    }));
};