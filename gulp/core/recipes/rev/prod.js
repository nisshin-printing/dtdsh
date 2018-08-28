const gulp = require('gulp');
const plumber = require('gulp-plumber');
const rev = require('gulp-rev');
const revReplace = require('gulp-rev-rewrite');

// utils
const pumped = require('../../utils/pumped');

// config
const config = require('../../config/rev');

/**
 * 静的ファイルにハッシュ追加
 *
 */
module.exports = function() {
		return gulp.src(confg.paths.src)
				.pipe(plumber())

		.pipe(rev())

		.pipe(gulp.dest(config.paths.dest))
				.pipe(notify({
						message: pumped('Added Revision'),
						onLast: true
				}))

		.pipe(rev.manifestFile())

		.pipe(gulp.dest(config.paths.manifest))
				.pipe(notify({
						message: pumped('Added Manifest File'),
						onLast: true
				}));
}