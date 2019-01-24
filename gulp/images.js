'use strict';

const gulp = require('gulp');
const config = require('./config/settings');

// utils
const $ = require('./utils/plugins');
const pumped = require('./utils/pumped');

/**
 * 本番テーマAssetsディレクトリーから
 * すべての画像を消去
 */
gulp.task('images:clean', done => {
		$.del(config.images.clean, {
						force: true
				})
				.then(() => { done() });
});


/**
 * Image圧縮
 */

gulp.task('images:prod', done => {
		gulp.src(config.images.src)
				.pipe($.plumber())

		.pipe($.imagemin({
				progressive: true,
				interlaced: true
		}))

		.pipe(gulp.dest(config.images.dest))
				.pipe($.notify({
						message: pumped('Images Compressed'),
						onLast: true
				}));

		done();
});

gulp.task('images:dev', () => {
		gulp.src(config.images.src)
				.pipe($.plumber())

		.pipe(gulp.dest(config.images.dest))
				.pipe($.notify({
						message: pumped('Images Moved'),
						onLast: true
				}))

		.on('end', $.browser.reload);
});

gulp.task('images:watch', () => {
		$.watch(config.images.watch, gulp.series('images:dev'));
});