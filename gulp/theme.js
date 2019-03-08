const { task, src, watch, dest, series } = require('gulp');
const config = require('./config/settings');
const transform = require('vinyl-transform');
const path = require('path');
const map = require('map-stream');

// utils
const $ = require('./utils/plugins');
const pumped = require('./utils/pumped');

// templates
const includeDev = require('./templates/devmode-php-include');
const style = require('./templates/wordpress-style-css');
const bSSnippet = require('./templates/browser-sync-snippet');

/**
 * 本番テーマを消去
 */
task('theme:clean', done => {
		$.del(config.theme.clean, {
						force: true
				})
				.then(() => { done() });
});


/**
 * Move the Theme
 */

task('theme:dev', () => {
		const filterPHP = $.filter('**/*.php', { restore: true });
		const filterFunc = $.filter('functions.php', { restore: true });

		return src(config.theme.src)
				.pipe($.plumber())

		.pipe(filterPHP)
				.pipe(transform(function(filename) {
						return map(function(chunk, next) {

								let definitions = [];
								if (new RegExp(["(^|\\s)template Name:.*"].join('|'), 'g')) {
										definitions = chunk.toString().match(new RegExp(["(^|\\s)template Name:.*"].join('|'), 'g'));
								}

								const relativeFilename = path.relative(config.theme.dest, filename);
								return next(null, includeDev(relativeFilename, definitions));
						});
				}))
				.pipe(filterPHP.restore)

		.pipe($.add({
				'.gitignore': '*',
				'style.css': style
		}))

		.pipe(filterFunc)
				.pipe($.insert.append(bSSnippet))
				.pipe(filterFunc.restore)

		.pipe(dest(config.theme.dest))
				.pipe($.notify({
						message: pumped('Theme Moved!'),
						onLast: true
				}))

		.on('end', $.browser.reload);
});


task('theme:prod', done => {
		return src(config.theme.src)
				.pipe($.plumber())

		.pipe($.add({
				'.gitignore': '*',
				'style.css': style
		}))

		.pipe(dest(config.theme.dest))
				.pipe($.notify({
						message: pumped('Theme Moved!'),
						onLast: true
				}))

		done();
});


task('theme:watch', () => {
		watch(config.theme.watch, series('theme:dev'));
});