const { task, series, dest, src, watch } = require('gulp');
const config = require('./config/settings');

// utils
const $ = require('./utils/plugins');
const pumped = require('./utils/pumped');



/**
 * 本番テーマAssetsディレクトリーから
 * SVGを消去
 */
task('svg:clean', done => {
		$.del(config.svg.clean, {
						force: true
				})
				.then(() => { done() });
});


/**
 * Production
 */
task('svg:prod', done => {
		src(config.svg.src)
				.pipe($.plumber())

		.pipe($.svgmin({
				multipass: true
		}))

		.pipe(dest(config.svg.dest))
				.pipe($.notify({
						message: pumped('SVGs Compressed'),
						onLast: true
				}));

		done();
});




/**
 * Dev
 */
task('svg:dev', () => {
		src(config.svg.src)
				.pipe($.plumber())

		.pipe(dest(config.svg.dest))
				.pipe($.notify({
						message: pumped('SVGs Moved'),
						onLast: true
				}))

		.on('end', $.browser.reload)
});




/**
 * Watch
 */
task('svg:watch', () => {
		watch(config.svg.watch, series('svg:dev'));
});