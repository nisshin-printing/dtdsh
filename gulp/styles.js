'use strict';

const { gulp, src, task, series, dest } = require('gulp');
const config = require('./config/settings');

// utils
const $ = require('./utils/plugins');
const pumped = require('./utils/pumped');



/**
 * 本番テーマディレクトリーから
 * すべてのCSS/MAPを消去
 */
task('styles:clean', done => {
		$.del(config.styles.clean, {
						force: true
				})
				.then(() => { done() });
});


/**
 * Image圧縮
 */
task('styles:prod', done => {
		src(config.styles.src)
				.pipe($.plumber())

		.pipe($.sass.sync(config.styles.sass).on('error', $.sass.logError))

		.pipe($.autoprefixer(config.styles.autoprefixer))

		.pipe($.cssnano(config.styles.minify))

		.pipe(dest(config.styles.dest))
				.pipe($.notify({
						message: pumped('SASS Compiled & Minified.'),
						onLast: true
				}));


		done();
});




task('styles:dev', () => {
		src(config.styles.src)
				.pipe($.plumber())

		.pipe($.sourcemaps.init())

		.pipe($.sass.sync(config.styles.sass).on('error', $.sass.logError))

		.pipe($.autoprefixer(config.styles.autoprefixer))

		.pipe($.sourcemaps.write('./'))

		.pipe(dest(config.styles.dest))
				.pipe($.browser.stream({ match: '**/*.css' }))
				.pipe($.notify({
						message: pumped('SASS Compiled.'),
						onLast: true
				}))
});

task('styles:watch', () => {
		$.watch(config.styles.watch, series('styles:dev'));
});