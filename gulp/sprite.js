const { task, series, dest, src, watch } = require('gulp');
const path = require('path');
const config = require('./config/settings');

// utils
const $ = require('./utils/plugins');
const pumped = require('./utils/pumped');
const getFolders = require('./utils/getFolders');



/**
 * 本番テーマAssetsディレクトリーから
 * SVG Spriteを消去
 */
task('sprite:clean', done => {
		$.del(config.svg.clean, {
						force: true
				})
				.then(() => { done() });
});




/**
 * Dev & Prod
 */
task('sprite:dev', () => {
		src(config.sprite.src).pipe($.plumber())
				.pipe($.svgSprite({
						mode: {
								inline: true,
								symbol: {
										dest: '.',
										sprite: config.sprite.name
								}
						},
						shape: {
								id: {
										generator: config.sprite.geneartor
								}
						}
				}))

		.on('error', $.util.log)

		.pipe($.svgmin({
				multipass: true,
				plugins: [
						{ cleanupIDs: false },
						{ removeAttrs: { attrs: 'fill' } }
				]
		}))

		.pipe(dest(config.sprite.dest))
				.pipe($.notify({
						message: pumped('Svg Sprites Generated'),
						onLast: true
				}))

		.on('end', $.browser.reload);
});



/**
 * Production
 */
task('sprite:prod', done => {
		src(config.sprite.src).pipe($.plumber())
				.pipe($.svgSprite({
						mode: {
								inline: true,
								symbol: {
										dest: '.',
										sprite: config.sprite.name
								}
						},
						shape: {
								id: {
										generator: config.sprite.geneartor
								}
						}
				}))

		.on('error', $.util.log)

		.pipe($.svgmin({
				multipass: true,
				plugins: [
						{ cleanupIDs: false },
						{ removeAttrs: { attrs: 'fill' } }
				]
		}))

		.pipe(dest(config.sprite.dest))
				.pipe($.notify({
						message: pumped('Svg Sprites Generated'),
						onLast: true
				}));

		done();
});




/**
 * Watch
 */
task('sprite:watch', () => {
		watch(config.svg.watch, series('sprite:dev'));
});