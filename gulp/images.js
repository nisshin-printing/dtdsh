const { task, src, dest, watch, series } = require('gulp');
const config = require('./config/settings');

// utils
const $ = require('./utils/plugins');
const pumped = require('./utils/pumped');

/**
 * 本番テーマAssetsディレクトリーから
 * すべての画像を消去
 */
task('images:clean', done => {
		$.del(config.images.clean, {
						force: true
				})
				.then(() => { done() });
});


/**
 * Image圧縮
 */

task('images:prod', done => {
		src(config.images.src)
				.pipe($.plumber())

		.pipe($.imagemin({
				progressive: true,
				interlaced: true
		}))

		.pipe(dest(config.images.dest))
				.pipe($.notify({
						message: pumped('Images Compressed'),
						onLast: true
				}));

		done();
});

task('images:dev', () => {
		src(config.images.src)
				.pipe($.plumber())

		.pipe(dest(config.images.dest))
				.pipe($.notify({
						message: pumped('Images Moved'),
						onLast: true
				}))

		.on('end', $.browser.reload);
});

task('images:watch', () => {
		watch(config.images.watch, series('images:dev'));
});