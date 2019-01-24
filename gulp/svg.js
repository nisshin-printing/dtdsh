'use strict';

const gulp = require('gulp');
const config = require('./config/settings');

// utils
const $ = require('./utils/plugins');
const pumped = require('./utils/pumped');



/**
 * 本番テーマAssetsディレクトリーから
 * SVGを消去
 */
gulp.task('svg:clean', done => {
		$.del(config.svg.clean, {
						force: true
				})
				.then(() => { done() });
});


/**
 * Production
 */
gulp.task('svg:prod', done => {
		gulp.src(config.svg.src)
				.pipe($.plumber())

		.pipe($.svgmin({
				multipass: true
		}))

		.pipe(gulp.dest(config.svg.dest))
				.pipe($.notify({
						message: pumped('SVGs Compressed'),
						onLast: true
				}));

		done();
});




/**
 * Dev
 */
gulp.task('svg:dev', () => {
		gulp.src(config.svg.src)
				.pipe($.plumber())

		.pipe(gulp.dest(config.svg.dest))
				.pipe($.notify({
						message: pumped('SVGs Moved'),
						onLast: true
				}))

		.on('end', $.browser.reload)
});




/**
 * Watch
 */
gulp.task('svg:watch', done => {
		$.watch(config.svg.watch, () => {
				gulp.start('svg:dev');
		});

		done();
});