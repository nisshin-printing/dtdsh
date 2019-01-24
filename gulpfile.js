const { gulp, task, parallel, series } = require('gulp');
require('require-dir')('./gulp');

// utils
const validateConfig = require('./gulp/utils/validateConfig');
const lazyQuire = require('./gulp/utils/lazyQuire');
const $ = require('./gulp/utils/plugins');

// config
const project = require('./project.config');

// validate the project
// configuration
validateConfig(project);

// gulpfile booting message
$.util.log($.util.colors.green('Starting to Gulp! Please wait...'));



/**
 * Grouped
 */
task('default', parallel(
		'svg:watch',
		'sprite:watch',
		'images:watch',
		'scripts:watch',
		'styles:watch',
		'theme:watch',
		'browser:sync',
));

task('build', series(
		parallel(
				'svg:clean',
				'sprite:clean',
				'images:clean',
				'scripts:clean',
				'styles:clean',
				'theme:clean',
		),
		parallel(
				'svg:prod',
				'sprite:prod',
				'images:prod',
				'scripts:prod',
				'styles:prod',
				'theme:prod',
		)
));