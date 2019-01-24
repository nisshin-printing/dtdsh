'use strict';

const gulp = require('gulp');
const config = require('./config/settings');
const webpack = require('webpack');
const gulpWebpack = require('webpack-stream');
const named = require('vinyl-named');
const LodashModuleReplacementPlugin = require('lodash-webpack-plugin');

// utils
const $ = require('./utils/plugins');
const pumped = require('./utils/pumped');
const notifaker = require('./utils/notifaker');
const logStats = require('./utils/webpackLogStats');
const deepMerge = require('./utils/deepMerge');


let recipe = {
		mode: 'development',
		cache: true,
		resolve: {
				extensions: ['.js', '.jsx']
		},
		output: {
				chunkFilename: 'chunk-[name].js'
		},
		module: {
				rules: [{
						test: /\.jsx?$/,
						exclude: [
								/bower_components/,
								/node_modules/
						],
						use: [{
								loader: 'babel-loader',
								options: {
										presets: [
												['@babel/preset-env', { modules: false }]
										]
								}
						}]
				}]
		},
		plugins: [
				new LodashModuleReplacementPlugin,
				new webpack.DefinePlugin({
						__DEV__: JSON.stringify(JSON.parse(process.env.BUILD_DEV || 'true'))
				})
		]
};


/**
 * Clean
 */
gulp.task('scripts:clean', done => {
		$.del(config.scripts.clean, {
				force: true
		}).then(() => { done(); });
});


/**
 * Watch
 */
gulp.task('scripts:watch', () => {
		recipe = deepMerge(recipe, { mode: 'development' });
		gulp.src(config.scripts.src)
				.pipe($.plumber())

		.pipe(named())

		.pipe(gulpWebpack(
						recipe,
						null,
						function(err, stats) {
								logStats(err, stats, {
										watch: true
								});

								$.browser.reload();
								notifaker(pumped('JS Packaged'));
						}))
				.pipe(gulp.dest(config.scripts.dest));
});


/**
 * Develop
 */
gulp.task('scripts:dev', () => {
		recipe = deepMerge(recipe, { mode: 'development' });
		gulp.src(config.scripts.src)
				.pipe($.plumber())
				.pipe(named())
				.pipe(gulpWebpack(
						recipe,
						null,
						function(err, stats) {
								logStats(err, stats);
								$.browser.reload();
								notifaker(pumped('JS Packaged'));
						}))

		.pipe(gulp.dest(config.scripts.dest));
});

/**
 * Production
 */
gulp.task('scripts:prod', done => {
		recipe = deepMerge(recipe, { mode: 'production' });
		gulp.src(config.scripts.src)
				.pipe($.plumber())

		.pipe(named())

		.pipe(gulpWebpack(recipe))
				.pipe(gulp.dest(config.scripts.dest))
				.pipe($.notify({
						message: pumped('JS Packaged & Minified!'),
						onLast: true
				}));

		done();
});